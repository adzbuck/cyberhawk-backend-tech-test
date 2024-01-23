<?php

namespace Tests\Unit\Repository;

use App\Models\Farm;
use App\Repository\FarmRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FarmRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_all_returns_empty_collection()
    {
        /** @var FarmRepositoryInterface $farmRepo */
        $farmRepo = app(FarmRepositoryInterface::class);

        $actualResult = $farmRepo->fetchAll();

        $this->assertInstanceOf(Collection::class, $actualResult);
        $this->assertEmpty($actualResult->toArray());
    }

    public function test_fetch_all_returns_single_result_in_collection()
    {
        Farm::factory()
            ->count(1)
            ->create();

        /** @var FarmRepositoryInterface $farmRepo */
        $farmRepo = app(FarmRepositoryInterface::class);

        $actualResult = $farmRepo->fetchAll();

        $this->assertInstanceOf(Collection::class, $actualResult);
        $this->assertNotEmpty($actualResult->toArray());
        $this->assertCount(1, $actualResult);

        $actualResult
            ->each(
                fn (Farm $actualModel) => $this->assertDatabaseHas(Farm::class, $actualModel->getAttributes())
            );
    }

    public function test_fetch_all_returns_multiple_results_in_collection()
    {
        Farm::factory()
            ->count(5)
            ->create();

        /** @var FarmRepositoryInterface $farmRepo */
        $farmRepo = app(FarmRepositoryInterface::class);

        $actualResult = $farmRepo->fetchAll();

        $this->assertInstanceOf(Collection::class, $actualResult);
        $this->assertNotEmpty($actualResult->toArray());
        $this->assertCount(5, $actualResult);

        $actualResult
            ->each(
                fn (Farm $actualModel) => $this->assertDatabaseHas(Farm::class, $actualModel->getAttributes())
            );
    }

    public function test_fetch_by_id_returns_null()
    {
        /** @var FarmRepositoryInterface $farmRepo */
        $farmRepo = app(FarmRepositoryInterface::class);

        $actualResult = $farmRepo->fetchById(5);

        $this->assertNull($actualResult);
    }

    public function test_fetch_by_id_returns_model()
    {
        Farm::factory()
            ->createOne(['id' => 3]);

        /** @var FarmRepositoryInterface $farmRepo */
        $farmRepo = app(FarmRepositoryInterface::class);

        $actualResult = $farmRepo->fetchById(3);

        $this->assertInstanceOf(Farm::class, $actualResult);
        $this->assertEquals(3, $actualResult->id);
        $this->assertDatabaseHas(Farm::class, $actualResult->getAttributes());
    }
}
