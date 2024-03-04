<?php

declare(strict_types=1);

namespace SUNZINET\SzAssets\Controller;

use Psr\Http\Message\ResponseInterface;
use SUNZINET\SzAssets\Domain\Repository\BookingRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BookingController extends ActionController
{
    protected BookingRepository $bookingRepository;

    public function injectBookingRepository(BookingRepository $bookingRepository): void
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function listAction(): ResponseInterface
    {
        $bookings = $this->bookingRepository->findAll();
        $this->view->assign('bookings', $bookings);
        return $this->htmlResponse();
    }

}
