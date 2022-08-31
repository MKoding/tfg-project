<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Src\Admin\Front\src\Controllers\GetFeatureFlags\GetFeatureFlagsController;

Route::group(
    [
        'prefix' => 'admin',
    ],
    function () {
        Route::get(
            '/feature-flags',
            GetFeatureFlagsController::class
        )->name('admin.feature-flags');

        Route::get(
            '/run-laravel-first-boot',
            function () {
                Artisan::call('key:generate');
                Artisan::call('migrate');

                return 'Laravel first configuration run successfully.';
            }
        )->name('admin.migrations');
    }
);
