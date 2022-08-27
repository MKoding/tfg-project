<?php

use Illuminate\Support\Facades\Route;
use Src\Admin\Front\src\Controllers\GetFeatureFlags\GetFeatureFlagsController;
use Src\Shared\Features\Front\src\Controllers\AddFeatureFlag\AddFeatureFlagController;
use Src\Shared\Features\Front\src\Controllers\DeleteFeatureFlag\DeleteFeatureFlagController;
use Src\Shared\Features\Front\src\Controllers\EditFeatureFlag\EditFeatureFlagController;

Route::group(
    [
        'prefix' => 'feature-flags',
    ],
    function () {
        Route::post(
            '/add',
            AddFeatureFlagController::class
        )->name('feature-flags.add');

        Route::post(
            '/edit',
            EditFeatureFlagController::class
        )->name('feature-flags.edit');

        Route::post(
            '/delete',
            DeleteFeatureFlagController::class
        )->name('feature-flags.delete');
    }
);
