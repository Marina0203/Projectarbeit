<?php

declare(strict_types=1);

namespace SUNZINET\SzAssets\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

final class SeatViewHelper extends AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    protected $escapeOutput = false;
    public function initializeArguments(): void
    {
        $this->registerArgument('bookings', 'array', 'The bookings array',);
        $this->registerArgument('seatId', 'int', 'The seat ID to check for', true);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext,
    ): string {
        $bookings = $arguments['bookings'];
        $seatId = $arguments['seatId'];

        if (!$bookings) {
            return sprintf('<button id="%s" class="btn btn-primary btn-dialog"></button>', $seatId);
        }

        $isBooked = null;
        foreach ($bookings as $booking) {
            if ($booking->getSeat()->getUid() === $seatId) {
                 $isBooked = $booking;
            }
        }
        if ($isBooked) {
            return sprintf(
                '<button id="%1$s" class="btn btn-danger" data-title="%2$s %3$s"></button>',
                $seatId,
                $isBooked->getUserFirstName(),
                $isBooked->getUserLastName(),
            );
        } else {
            return sprintf('<button id="%s" class="btn btn-primary btn-dialog"></button>', $seatId);
        }
    }
}
