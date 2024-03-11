<?php

declare(strict_types=1);

namespace SUNZINET\SzAssets\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Booking extends AbstractEntity
{
    protected Room|null $room = null;
    protected string $userFirstName = '';
    protected string $userLastName = '';
    protected string $userEmail = '';
    protected \DateTime $startDate;

    public function __construct()
    {
        $this->room = new Room();
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): void
    {
        $this->room = $room;
    }

    public function getUserFirstName(): string
    {
        return $this->userFirstName;
    }

    public function setUserFirstName(string $userFirstName): void
    {
        $this->userFirstName = $userFirstName;
    }

    public function getUserLastName(): string
    {
        return $this->userLastName;
    }

    public function setUserLastName(string $userLastName): void
    {
        $this->userLastName = $userLastName;
    }

    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    public function setUserEmail(string $userEmail): void
    {
        $this->userEmail = $userEmail;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }
}
