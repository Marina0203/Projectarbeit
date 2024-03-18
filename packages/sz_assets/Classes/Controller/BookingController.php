<?php

declare(strict_types=1);

namespace SUNZINET\SzAssets\Controller;

use Psr\Http\Message\ResponseInterface;
use SUNZINET\SzAssets\Domain\Model\Booking;
use SUNZINET\SzAssets\Domain\Repository\BookingRepository;
use SUNZINET\SzAssets\Domain\Repository\RoomRepository;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\MailerInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class BookingController extends ActionController
{
    protected BookingRepository $bookingRepository;
    protected RoomRepository $roomRepository;
    protected PersistenceManager $persistenceManager;

    public function injectBookingRepository(BookingRepository $bookingRepository): void
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function injectRoomRepository(RoomRepository $roomRepository): void
    {
        $this->roomRepository = $roomRepository;
    }

    public function __construct(
        PersistenceManager $persistenceManager
    ) {
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * @throws InvalidQueryException
     */
    public function listAction(): ResponseInterface
    {
        $rooms = $this->roomRepository->findAll();

        // if day is set, use it, otherwise use today
        if($this->request->hasArgument('day')) {
            $day = $this->request->getArgument('day');
        } else {
            $day = date('Y-m-d');
        }

        // find bookings for the day
        $bookings = $this->bookingRepository->findByDay(strtotime($day));

        // find room bookings for the day
        $roomBookings = [];
        foreach ($rooms as $room) {
            $roomBookings[$room->getUid()] = $this->bookingRepository
                ->findByRoomAndDate($room, strtotime($day))->count();
        }

        $this->view->assignMultiple([
            'bookings' => $bookings,
            'rooms' => $rooms,
            'roomBookings' => $roomBookings,
            'day' => $day,
        ]);
        return $this->htmlResponse();
    }

    /**
     * @throws IllegalObjectTypeException
     * @throws \Exception
     * @throws TransportExceptionInterface
     */
    public function bookAction(): ResponseInterface
    {
        $arguments = $this->request->getArguments();
        // if arguments doesn't contain room, userFirstName, userLastName, userEmail, startDate, endDate return to list
        if (! isset($arguments['room'], $arguments['userFirstName'], $arguments['userLastName'], $arguments['userEmail'], $arguments['startDate'])) {
            return $this->redirect('list');
        }

        $startDate = new \DateTime($arguments['startDate']);

        // check if the room is already booked
        $bookings = $this->bookingRepository->findByRoomAndDate(
            $this->roomRepository->findByUid((int)$arguments['room']),
            $startDate->getTimestamp()
        );

        // if the room is already booked, return to list
        $rooms = $this->roomRepository->findAll();
        forEach ($rooms as $room) {
            if ($room->getSeatCount() === $bookings->count()) {
                $this->addFlashMessage('Room is already booked', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
                return $this->redirect('list');
            }
        }

        // create a new booking
        $booking = GeneralUtility::makeInstance(Booking::class);
        $booking->setRoom($this->roomRepository->findByUid((int)$arguments['room']));
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
            ->assign('booking', $booking);
        GeneralUtility::makeInstance(MailerInterface::class)->send($email);
    }
}
