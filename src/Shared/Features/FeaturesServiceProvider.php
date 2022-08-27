<?php

namespace Src\Shared\Features;

use Src\Shared\Features\Core\Infrastructure\FeaturesDependencyInjection;
use Illuminate\Support\ServiceProvider;

class FeaturesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Front/Routes/FeatureFlagsRoutes.php');
        $this->loadMigrationsFrom(__DIR__ . '/Core/Infrastructure/Persistence/Migrations');
    }

    public function register()
    {
        $this->app->register(FeaturesDependencyInjection::class);
    }
}
