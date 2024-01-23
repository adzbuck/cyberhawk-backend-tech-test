<?php

namespace Tests\Feature\Controllers;

use App\Models\Farm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class FarmControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_farm_controller_index_returns_a_successful_response()
    {
        $response = $this->get('/api/farms');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_the_farm_controller_index_returns_empty_response()
    {
        $response = $this->get('/api/farms');

        $response->assertJsonStructure(['data']);
        $response->assertJsonCount(0, 'data');
    }

    public function test_the_farm_controller_index_returns_single_response()
    {
        Farm::factory()
            ->count(1)
            ->create();

        $response = $this->get('/api/farms');
        $response->assertJsonStructure(['data']);
        $response->assertJsonCount(1, 'data');

        collect($response->json('data'))
            ->map(fn (array $data) => $this->fixTimestampDates($data))
            ->each(
                fn (array $data) => $this->assertDatabaseHas(Farm::class, $data)
            );
    }

    public function test_the_farm_controller_index_returns_multiple_response()
    {
        Farm::factory()
            ->count(5)
            ->create();

        $response = $this->get('/api/farms');
        $response->assertJsonStructure(['data']);
        $response->assertJsonCount(5, 'data');

        collect($response->json('data'))
            ->map(fn (array $data) => $this->fixTimestampDates($data))
            ->each(
                fn (array $data) => $this->assertDatabaseHas(Farm::class, $data)
            );
    }

    public function test_the_farm_controller_show_returns_404_response()
    {
        $response = $this->get('/api/farms/5');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_the_farm_controller_show_returns_404_response_when_a_float()
    {
        Farm::factory()
            ->createOne(['id' => 5]);

        $response = $this->get('/api/farms/5.5');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_the_farm_controller_show_returns_404_response_when_not_a_number()
    {
        Farm::factory()
            ->count(5)
            ->create();

        $response = $this->get('/api/farms/test');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_the_farm_controller_show_returns_single_response()
    {
        Farm::factory()
            ->createOne(['id' => 3]);

        $response = $this->get('/api/farms/3');
        $response->assertJsonStructure(
            [
                'data' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                ]
            ]
        );
        $this->assertEquals(3, $response->json('data.id'));
        $this->assertDatabaseHas(Farm::class, $this->fixTimestampDates($response->json('data')));
    }
}
