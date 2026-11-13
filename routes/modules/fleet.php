<?php

use App\Http\Controllers\FleetController;
use Illuminate\Support\Facades\Route;

Route::controller(FleetController::class)
    ->prefix('fleet')
    ->name('fleet.')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::middleware('role:admin,staff')->group(function () {
            Route::get('/create', 'create')->name('create');
        });
    });
