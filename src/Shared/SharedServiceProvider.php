<?php

namespace Src\Shared;

use Illuminate\Support\ServiceProvider;

class SharedServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Utils/Front/Resources/Views', 'Shared');
    }

    public function register()
    {
    }
}
