<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\Turbine;
use Illuminate\Database\Seeder;

class FarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Farm::factory()
            ->count(10)
            ->has(Turbine::factory()->count(4))
            ->create();
    }
}
