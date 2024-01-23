<?php

namespace Tests\Unit\Services;

use App\Models\Farm;
use App\Repository\FarmRepositoryInterface;
use App\Services\FarmService;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class FarmServiceTest extends TestCase
{
    public function test_fetch_all_returns_empty_collection()
    {
        $farmRepo = $this->getMockBuilder(FarmRepositoryInterface::class)
            ->getMock();

        $farmService = new FarmService($farmRepo);

        $farmRepo
            ->expects($this->once())
            ->method('fetchAll')
            ->willReturn(
                Collection::empty()
            );

        $actualResult = $farmService->fetchAll();

        $this->assertInstanceOf(Collection::class, $actualResult);
        $this->assertEmpty($actualResult->toArray());
    }

    public function test_fetch_all_returns_single_result_in_collection()
    {
        $givenFarms = Farm::factory()
            ->count(1)
            ->make();

        $farmRepo = $this->getMockBuilder(FarmRepositoryInterface::class)
            ->getMock();

        $farmService = new FarmService($farmRepo);

        $farmRepo
            ->expects($this->once())
            ->method('fetchAll')
            ->willReturn($givenFarms);

        $actualResult = $farmService->fetchAll();

        $this->assertInstanceOf(Collection::class, $actualResult);
        $this->assertNotEmpty($actualResult->toArray());
        $this->assertCount(1, $actualResult);
        $this->assertSame($givenFarms, $actualResult);
    }

    public function test_fetch_all_returns_multiple_results_in_collection()
    {
        $givenFarms = Farm::factory()
            ->count(5)
            ->make();

        $farmRepo = $this->getMockBuilder(FarmRepositoryInterface::class)
            ->getMock();

        $farmService = new FarmService($farmRepo);

        $farmRepo
            ->expects($this->once())
            ->method('fetchAll')
            ->willReturn($givenFarms);

        $actualResult = $farmService->fetchAll();

        $this->assertInstanceOf(Collection::class, $actualResult);
        $this->assertNotEmpty($actualResult->toArray());
        $this->assertCount(5, $actualResult);
        $this->assertSame($givenFarms, $actualResult);
    }

    public function test_fetch_by_id_returns_null()
    {
        $farmRepo = $this->getMockBuilder(FarmRepositoryInterface::class)
            ->getMock();

        $farmService = new FarmService($farmRepo);

        $farmRepo
            ->expects($this->once())
            ->method('fetchById')
            ->with(5)
            ->willReturn(null);

        $actualResult = $farmService->fetchById(5);

        $this->assertNull($actualResult);
    }

    public function test_fetch_by_id_returns_model()
    {
        /** @var Farm $givenFarm */
        $givenFarm = Farm::factory()
            ->count(1)
            ->makeOne(['id' => 4]);

        $farmRepo = $this->getMockBuilder(FarmRepositoryInterface::class)
            ->getMock();

        $farmService = new FarmService($farmRepo);

        $farmRepo
            ->expects($this->once())
            ->method('fetchById')
            ->with(4)
            ->willReturn($givenFarm);

        $actualResult = $farmService->fetchById(4);

        $this->assertInstanceOf(Farm::class, $actualResult);
        $this->assertEquals(4, $actualResult->id);
        $this->assertSame($givenFarm, $actualResult);
    }
}
