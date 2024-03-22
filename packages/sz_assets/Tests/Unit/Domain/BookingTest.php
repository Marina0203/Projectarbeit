<?php

declare(strict_types=1);

namespace SUNZINET\SzAssets\Domain\Model;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\TestingFramework\Core\BaseTestCase;

class BookingTest extends BaseTestCase
{
    protected Booking $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new Booking();
    }

    /**
     * @test
     */
    public function getRoomReturnsInitialValue(): void
    {
        self::assertEquals(
            new Room(),
            $this->subject->getRoom()
        );
    }

    /**
     * @test
     */
    public function setRoomValue(): void
    {
        $this->subject->setRoom(new Room());
        self::assertEquals(
            new Room(),
            $this->subject->getRoom()
        );
    }

    /**
     * @test
     */
    public function getSeatReturnsInitialValue(): void
    {
        self::assertNull(
            $this->subject->getSeat()
        );
    }

    /**
     * @test
     */
    public function setSeatValue(): void
    {
        $this->subject->setSeat(new Seat());
        self::assertEquals(
            new Seat(),
            $this->subject->getSeat()
        );
    }

    /**
     * @test
     */
    public function getUserFirstNameReturnsInitialValue(): void
    {
        self::assertSame(
            '',
            $this->subject->getUserFirstName()
        );
    }

    /**
     * @test
     */
    public function setUserFirstNameForString(): void
    {
        $this->subject->setUserFirstName('First Name');
        self::assertEquals('First Name', $this->subject->getUserFirstName());
    }

    /**
     * @test
     */
    public function getUserLastNameReturnsInitialValue(): void
    {
        self::assertSame(
            '',
            $this->subject->getUserLastName()
        );
    }

    /**
     * @test
     */
    public function setUserLastNameForString(): void
    {
        $this->subject->setUserLastName('Last Name');
        self::assertEquals('Last Name', $this->subject->getUserLastName());
    }

    /**
     * @test
     */
    public function getUserEmailReturnsInitialValue(): void
    {
        self::assertSame(
            '',
            $this->subject->getUserEmail()
        );
    }

    /**
     * @test
     */
    public function setUserEmailForString(): void
    {
        $this->subject->setUserEmail('test@email.de');
        self::assertEquals('test@email.de', $this->subject->getUserEmail());
    }

    /**
     * @test
     */
    public function getStartDateReturnsInitialValue(): void
    {
        self::assertNull(
            $this->subject->getStartDate()
        );
    }

    /**
     * @test
     */
    public function setStartDateForInt(): void
    {
        $this->subject->setStartDate(new \DateTime('2024-11-11'));
        self::assertEquals(new \DateTime('2024-11-11'), $this->subject->getStartDate());
    }
}
