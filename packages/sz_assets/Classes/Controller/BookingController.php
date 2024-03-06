<?php

declare(strict_types=1);

namespace SUNZINET\SzAssets\Controller;

use Psr\Http\Message\ResponseInterface;
use SUNZINET\SzAssets\Domain\Repository\BookingRepository;
use SUNZINET\SzAssets\Domain\Repository\RoomRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BookingController extends ActionController
{
    protected BookingRepository $bookingRepository;
    protected RoomRepository $roomRepository;

    public function injectBookingRepository(BookingRepository $bookingRepository): void
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function injectRoomRepository(RoomRepository $roomRepository): void
    {
        $this->roomRepository = $roomRepository;
    }

    public function listAction(): ResponseInterface
    {
        $bookings = $this->bookingRepository->findAll();
        $rooms = $this->roomRepository->findAll();
        $this->view->assignMultiple([
            'bookings' => $bookings,
            'rooms' => $rooms
        ]);
        return $this->htmlResponse();
    }

    public function bookAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }
}
