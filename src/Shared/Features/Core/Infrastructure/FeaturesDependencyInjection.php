<?php

namespace Src\Shared\Features\Core\Infrastructure;

use Doctrine\Persistence\ManagerRegistry;
use Illuminate\Support\ServiceProvider;
use Src\Shared\Features\Core\Domain\Repositories\FeatureFlagRepository;
use Src\Shared\Features\Core\Infrastructure\Persistence\Repositories\DoctrineFeatureFlagRepository;

class FeaturesDependencyInjection extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(FeatureFlagRepository::class, fn () => new DoctrineFeatureFlagRepository(app(ManagerRegistry::class)));
    }
}
