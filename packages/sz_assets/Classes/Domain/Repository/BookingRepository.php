<?php

namespace SUNZINET\SzAssets\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;

class BookingRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    // find bookings by day
    /**
     * @param $day int
     * @throws InvalidQueryException
     */
    public function findByDay(int $day): array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        $today = $day;
        $tomorrow = $today + 86400;
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->greaterThanOrEqual('startDate', $today),
                $query->lessThan('startDate', $tomorrow)
            )
        );
        return $query->execute();
    }

    // find bookings by room start date and end date
    /**
     * @throws InvalidQueryException
     */
    public function findByRoomAndDate($room, $day): array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        $today = $day;
        $tomorrow = $today + 86400;
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('room', $room),
                $query->logicalAnd(
                    $query->greaterThanOrEqual('startDate', $today),
                    $query->lessThanOrEqual('startDate', $tomorrow)
                ),
            )
        );
        return $query->execute();
    }
}
