<?php

declare(strict_types=1);

namespace SUNZINET\SzAssets\Domain\Model;

class Room extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    protected string $title = '';
    protected int $seatCount = 0;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSeatCount(): int
    {
        return $this->seatCount;
    }

    public function setSeatCount(int $seatCount): void
    {
        $this->seatCount = $seatCount;
    }
}
