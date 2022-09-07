<?php

namespace Src\Public\Front\Routes;

use Illuminate\Support\Facades\Route;
use Src\Public\Front\src\Controllers\GetFeatureTwo\GetFeatureTwoController;
use Src\Public\Front\src\Controllers\GetHome\GetHomeController;

Route::group(
    [],
    function () {
        Route::get(
            '/',
            GetHomeController::class
        )->name('public.home');

        Route::get(
            '/feature-two',
            GetFeatureTwoController::class
        )->name('public.feature-two');
    }
);
