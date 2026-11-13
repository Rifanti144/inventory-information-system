<?php

use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::controller(WarehouseController::class)
    ->prefix('warehouses')
    ->name('warehouses.')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::middleware('role:admin,staff')->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{warehouse}/edit', 'edit')->name('edit');
            Route::match(['put', 'patch'], '/{warehouse}', 'update')->name('update');
            Route::delete('/{warehouse}', 'destroy')->name('destroy');
        });
    });
