<?php

declare(strict_types=1);

namespace SUNZINET\SzAssets\Domain\Model;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\TestingFramework\Core\BaseTestCase;

class RoomTest extends BaseTestCase
{
    protected Room $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new Room();
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValue(): void
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForString(): void
    {
        $this->subject->setTitle('Title');
        self::assertEquals('Title', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function getSeatsReturnsInitialValue(): void
    {
        self::assertEquals(
            new ObjectStorage(),
            $this->subject->getSeats()
        );
    }

    /**
     * @test
     */
    public function setSeatsValue(): void
    {
        $this->subject->setSeats(new ObjectStorage());
        self::assertEquals(
            new ObjectStorage(),
            $this->subject->getSeats()
        );
    }
}
