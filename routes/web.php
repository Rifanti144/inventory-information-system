<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guests only. The main page is named "login" so Laravel's auth redirect lands here.
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::view('/', 'main')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

/*
|--------------------------------------------------------------------------
| Logged-in users only
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Modules (replace the legacy input-form / output-form / edit-form ... .php files)
    Route::resource('items', ItemController::class)->except('show');
    Route::resource('vendors', VendorController::class)->except('show');
    Route::resource('warehouses', WarehouseController::class)->except('show');

    // Operational Fleet - placeholder, see FleetController
    Route::get('/fleet', [FleetController::class, 'index'])->name('fleet.index');
    Route::get('/fleet/create', [FleetController::class, 'create'])->name('fleet.create');
});
