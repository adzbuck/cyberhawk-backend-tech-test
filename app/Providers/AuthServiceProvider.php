<?php

namespace App\Providers;

use App\Models\Farm;
use App\Models\Turbine;
use App\Policies\FarmPolicy;
use App\Policies\TurbinePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         Farm::class => FarmPolicy::class,
         Turbine::class => TurbinePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
