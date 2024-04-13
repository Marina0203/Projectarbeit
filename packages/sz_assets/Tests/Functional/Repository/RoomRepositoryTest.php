<?php

declare(strict_types=1);

namespace SUNZINET\SzAssets\Domain\Repository;

use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;
class RoomRepositoryTest extends FunctionalTestCase
{
    /**
     * @var RoomRepository
     */
    protected $subject = null;
    protected array $testExtensionsToLoad = ['typo3conf/ext/sz_assets'];

    protected function setUp(): void
    {
        parent::setUp();

        $this->importCSVDataSet('EXT:sz_assets/Tests/Functional/Fixtures/tx_szassets_domain_model_room.csv');
        $this->subject = new RoomRepository;
    }

    /**
     * @test
     */
    public function findRecordsByUid(): void
    {
        $room = $this->subject->findByUid(1);
        self::assertEquals('Room 1', $room->getTitle());
    }

    /**
     * @test
     */
    public function testFindAll(): void
    {
        self::assertEquals(5, $this->subject->findAll()->count());
    }
}
