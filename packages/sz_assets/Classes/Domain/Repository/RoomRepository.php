<?php

namespace SUNZINET\SzAssets\Domain\Repository;

class RoomRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    // default sorting
    protected $defaultOrderings = [
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
    ];
}
