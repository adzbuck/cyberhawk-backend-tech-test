<?php

namespace App\Providers;

use App\Repository\Eloquent\FarmRepository;
use App\Repository\Eloquent\TurbineRepository;
use App\Repository\FarmRepositoryInterface;
use App\Repository\TurbineRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(FarmRepositoryInterface::class, FarmRepository::class);
        $this->app->bind(TurbineRepositoryInterface::class, TurbineRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
