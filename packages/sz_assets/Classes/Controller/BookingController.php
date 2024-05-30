<?php

declare(strict_types=1);

namespace SUNZINET\SzAssets\Controller;

use Psr\Http\Message\ResponseInterface;
use SUNZINET\SzAssets\Domain\Model\Booking;
use SUNZINET\SzAssets\Domain\Repository\BookingRepository;
use SUNZINET\SzAssets\Domain\Repository\RoomRepository;
use SUNZINET\SzAssets\Domain\Repository\SeatRepository;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\MailerInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

use function PHPUnit\Framework\throwException;

class BookingController extends ActionController
{
    // Attributes
    protected BookingRepository $bookingRepository;
    protected RoomRepository $roomRepository;
    protected SeatRepository $seatRepository;
    protected PersistenceManager $persistenceManager;

    // Injects of repositories
    public function injectBookingRepository(BookingRepository $bookingRepository): void
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function injectRoomRepository(RoomRepository $roomRepository): void
    {
        $this->roomRepository = $roomRepository;
    }

    public function injectSeatRepository(SeatRepository $seatRepository): void
    {
        $this->seatRepository = $seatRepository;
    }

    public function __construct(
        PersistenceManager $persistenceManager
    ) {
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * This action lists all rooms and bookings for a given day
     * @throws InvalidQueryException
     */
    public function listAction(): ResponseInterface
    {
        // if day is set, use it, otherwise use today
        if($this->request->hasArgument('day')) {
            $day = $this->request->getArgument('day');
        } else {
            $day = date('Y-m-d');
        }

        // get all bookings for the day
        $bookings = $this->bookingRepository->findByDay(strtotime($day));
        // get all rooms
        $rooms = $this->roomRepository->findAll();

        // assign variables to the view
        $this->view->assignMultiple([
            'bookings' => $bookings,
            'rooms' => $rooms,
            'day' => $day,
        ]);
        return $this->htmlResponse();
    }

    /**
     * This action receives the booking data and creates a new booking entry
     * @throws IllegalObjectTypeException
     * @throws \Exception
     * @throws TransportExceptionInterface
     */
    public function bookAction(): ResponseInterface
    {
        $arguments = $this->request->getArguments();
        // if arguments don't contain one of the required fields, throw an exception
        if (!$arguments['room'] || !$arguments['seat'] || !$arguments['userFirstName'] || !$arguments['userLastName'] || !$arguments['userEmail'] || !$arguments['startDate']) {
            throw new \Exception('Missing required fields');
        }

        $startDate = new \DateTime($arguments['startDate']);

        // check if the room is already booked
        $bookings = $this->bookingRepository->findByRoomAndSeatAndDate(
            $this->roomRepository->findByUid((int)$arguments['room']),
            $this->seatRepository->findByUid((int)$arguments['seat']),
            $startDate->getTimestamp()
        );

        // if the seat is already booked, return to list
        if ($bookings->count()) {
            $this->addFlashMessage('Seat is already booked', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            return $this->redirect('list');
        }

        // create a new booking
        $booking = GeneralUtility::makeInstance(Booking::class);
        $booking->setRoom($this->roomRepository->findByUid((int)$arguments['room']));
        $booking->setSeat($this->seatRepository->findByUid((int)$arguments['seat']));
        $booking->setUserFirstName($arguments['userFirstName']);
        $booking->setUserLastName($arguments['userLastName']);
        $booking->setUserEmail($arguments['userEmail']);
        $booking->setStartDate($startDate);
        $this->bookingRepository->add($booking);
        $this->persistenceManager->persistAll();

        // send mail
        $this->sendMail($booking);

        $this->view->assign('booking', $booking);
        return $this->htmlResponse();
    }

    /**
     * This function sends a mail to the user
     * @throws TransportExceptionInterface
     */
    private function sendMail(Booking $booking): void
    {
        $email = GeneralUtility::makeInstance(FluidEmail::class);
        $email
            ->to($booking->getUserEmail())
            ->from('info@sunzinet.com')
            ->subject('Booking confirmation')
            ->format(FluidEmail::FORMAT_HTML)
            ->setTemplate('BookingConfirmation')
            ->assign('booking', $booking); // assign the booking to the template
        GeneralUtility::makeInstance(MailerInterface::class)->send($email);
    }
}
