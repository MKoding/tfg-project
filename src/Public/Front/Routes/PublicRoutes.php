<?php

use Illuminate\Support\Facades\Route;
use Src\Public\Front\src\Controllers\GetHome\GetHomeController;

Route::group(
    [],
    function () {
        Route::get(
            '/',
            GetHomeController::class
        )->name('public.home');
    }
);
