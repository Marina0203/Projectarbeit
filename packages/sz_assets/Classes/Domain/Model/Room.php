<?php

declare(strict_types=1);

namespace SUNZINET\SzAssets\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Room extends AbstractEntity
{
    protected string $title = '';
    protected string $cssClass = '';

    /**
     * @var ObjectStorage<Seat>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $seats = null;

    public function __construct()
    {
        $this->seats = new ObjectStorage();
    }
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCssClass(): string
    {
        return $this->cssClass;
    }

    public function setCssClass(string $cssClass): void
    {
        $this->cssClass = $cssClass;
    }

    public function getSeats(): ?ObjectStorage
    {
        return $this->seats;
    }

    public function setSeats(?ObjectStorage $seats): void
    {
        $this->seats = $seats;
    }
}
