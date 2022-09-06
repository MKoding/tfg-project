<?php

namespace Src\Public;

use Illuminate\Support\ServiceProvider;

class PublicServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Front/Routes/PublicRoutes.php');
        $this->loadViewsFrom(__DIR__ . '/Front/Resources/Views', 'Public');
    }

    public function register()
    {
    }
}
