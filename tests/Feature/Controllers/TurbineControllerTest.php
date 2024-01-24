<?php

namespace Tests\Feature\Controllers;

use App\Models\Farm;
use App\Models\Turbine;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TurbineControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_turbine_controller_index_returns_a_successful_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        $response = $this->getJson('/api/turbines');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_the_turbine_controller_index_unauthenticated_response()
    {
        $response = $this->getJson('/api/turbines');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_the_turbine_controller_index_returns_empty_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        $response = $this->getJson('/api/turbines');

        $response->assertJsonStructure(['data']);
        $response->assertJsonCount(0, 'data');
    }

    public function test_the_turbine_controller_index_returns_single_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Turbine::factory()
            ->count(1)
            ->create();

        $response = $this->getJson('/api/turbines');
        $response->assertJsonStructure(['data']);
        $response->assertJsonCount(1, 'data');

        $this->assertDatabaseHas(
            Turbine::class,
            $this->fixTimestampDates($response->json('data.0'))
        );
    }

    public function test_the_turbine_controller_index_returns_multiple_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Turbine::factory()
            ->count(5)
            ->create();

        $response = $this->getJson('/api/turbines');
        $response->assertJsonStructure(['data']);
        $response->assertJsonCount(5, 'data');

        collect($response->json('data'))
            ->map(fn (array $data) => $this->fixTimestampDates($data))
            ->each(
                fn (array $data) => $this->assertDatabaseHas(Turbine::class, $data)
            );
    }

    public function test_the_turbine_controller_index_returns_404_response_when_farm_id_a_float()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Farm::factory()
            ->createOne(['id' => 5]);

        $response = $this->getJson('/api/farms/4.5/turbines');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_the_turbine_controller_index_returns_404_response_when_farm_id_not_a_number()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Farm::factory()
            ->count(5)
            ->create();

        $response = $this->getJson('/api/farms/test/turbines');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_the_turbine_controller_index_returns_a_404_response_when_filtered_by_farm()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        $response = $this->getJson('/api/farms/1/turbines');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_the_turbine_controller_index_returns_a_successful_response_when_filtered_by_farm()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Farm::factory()
            ->createOne(['id' => 1]);

        $response = $this->getJson('/api/farms/1/turbines');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_the_turbine_controller_index_returns_single_results_response_when_filtered_by_farm()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Farm::factory()
            ->createOne();

        Turbine::factory()
            ->createOne(['farm_id' => 1]);

        $response = $this->getJson('/api/farms/1/turbines');

        $response->assertJsonStructure(['data']);
        $response->assertJsonCount(1, 'data');

        $this->assertDatabaseHas(
            Turbine::class,
            $this->fixTimestampDates($response->json('data.0'))
        );
    }

    public function test_the_turbine_controller_index_returns_multiple_results_response_when_filtered_by_farm()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Farm::factory()
            ->count(5)
            ->has(Turbine::factory()->count(5))
            ->create();

        $response = $this->getJson('/api/farms/1/turbines');

        $response->assertJsonStructure(['data']);
        $response->assertJsonCount(5, 'data');

        collect($response->json('data'))
            ->map(fn (array $data) => $this->fixTimestampDates($data))
            ->each(
                fn (array $data) => $this->assertDatabaseHas(Turbine::class, $data)
            );
    }

    public function test_the_turbine_controller_show_returns_404_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        $response = $this->getJson('/api/turbines/5');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_the_turbine_controller_show_returns_404_response_when_turbine_id_a_float()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Turbine::factory()
            ->createOne(['id' => 5]);

        $response = $this->getJson('/api/turbines/5.4');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_the_turbine_controller_show_returns_404_response_when_turbine_id_not_a_number()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Turbine::factory()
            ->count(5)
            ->create();

        $response = $this->getJson('/api/turbines/test');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_the_turbine_controller_show_unauthenticated_response()
    {
        $response = $this->getJson('/api/turbines/1');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_the_turbine_controller_show_returns_single_response()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Turbine::factory()
            ->createOne(['id' => 3]);

        $response = $this->getJson('/api/turbines/3');
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
        $this->assertDatabaseHas(Turbine::class, $this->fixTimestampDates($response->json('data')));
    }

    public function test_the_turbine_controller_show_returns_single_response_when_filtered_by_farm_id()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Farm::factory()
            ->createOne(['id' => 2]);

        Turbine::factory()
            ->createOne(['id' => 3, 'farm_id' => 2]);

        $response = $this->getJson('/api/farms/2/turbines/3');
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
        $this->assertDatabaseHas(Turbine::class, $this->fixTimestampDates($response->json('data')));
    }

    public function test_the_turbine_controller_show_returns_404_response_when_farm_id_invalid()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Farm::factory()
            ->createOne(['id' => 2]);

        Turbine::factory()
            ->createOne(['id' => 3, 'farm_id' => 2]);

        $response = $this->getJson('/api/farms/1/turbines/3');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_the_turbine_controller_show_returns_404_response_when_farm_id_a_float()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Farm::factory()
            ->createOne(['id' => 5]);

        Turbine::factory()
            ->createOne(['id' => 4]);

        $response = $this->getJson('/api/farms/5.4/turbines/4');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_the_turbine_controller_show_returns_404_response_when_farm_id_not_a_number()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*'],
        );

        Farm::factory()
            ->count(5)
            ->create();

        Turbine::factory()
            ->createOne(['id' => 5]);

        $response = $this->getJson('/api/farms/test/turbines/3');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
