<?php

namespace Src\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Front/Routes/AdminRoutes.php');
        $this->loadViewsFrom(__DIR__ . '/Front/Resources/Views', 'Admin');
    }

    public function register()
    {
    }
}
