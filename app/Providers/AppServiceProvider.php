<?php

namespace App\Providers;

use App\Services\Company\Contracts\RadiusSearchScenarioInterface;
use App\Services\Company\Contracts\RectangleSearchScenarioInterface;
use App\Services\Company\Scenarios\ActivityTitleSearchScenario;
use App\Services\Company\Scenarios\RadiusSearchScenario;
use App\Services\Company\Scenarios\RectangleSearchScenario;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RectangleSearchScenarioInterface::class, RectangleSearchScenario::class);
        $this->app->bind(RadiusSearchScenarioInterface::class, RadiusSearchScenario::class);
        $this->app->bind(ActivityTitleSearchScenario::class, RadiusSearchScenario::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
