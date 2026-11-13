<?php

use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::controller(VendorController::class)
    ->prefix('vendors')
    ->name('vendors.')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::middleware('role:admin,staff')->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{vendor}/edit', 'edit')->name('edit');
            Route::match(['put', 'patch'], '/{vendor}', 'update')->name('update');
            Route::delete('/{vendor}', 'destroy')->name('destroy');
        });
    });
