<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::controller(ItemController::class)
    ->prefix('items')
    ->name('items.')
    ->group(function () {
        Route::get('/', 'index')->name('index');

        Route::middleware('role:admin,staff')->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{item}/edit', 'edit')->name('edit');
            Route::match(['put', 'patch'], '/{item}', 'update')->name('update');
            Route::delete('/{item}', 'destroy')->name('destroy');
        });
    });
