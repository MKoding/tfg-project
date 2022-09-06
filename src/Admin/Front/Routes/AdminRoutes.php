<?php

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
    }
);
