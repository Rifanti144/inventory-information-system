<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
| Logged-in users only (and only while the account is active)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'active'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    /*
    |----------------------------------------------------------------------
    | READ access: every role (admin, staff, viewer)
    |----------------------------------------------------------------------
    */
    Route::resource('items', ItemController::class)->only('index');
    Route::resource('vendors', VendorController::class)->only('index');
    Route::resource('warehouses', WarehouseController::class)->only('index');
    Route::get('/fleet', [FleetController::class, 'index'])->name('fleet.index');

    /*
    |----------------------------------------------------------------------
    | WRITE access: admin and staff only (viewer gets 403).
    | Vendor additionally checks VendorPolicy inside the controller
    | (staff may only edit their own record, only admin may delete).
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('items', ItemController::class)->except(['index', 'show']);
        Route::resource('vendors', VendorController::class)->except(['index', 'show']);
        Route::resource('warehouses', WarehouseController::class)->except(['index', 'show']);

        // Operational Fleet - placeholder, see FleetController
        Route::get('/fleet/create', [FleetController::class, 'create'])->name('fleet.create');
    });

    /*
    |----------------------------------------------------------------------
    | ADMIN only: manage roles and activate / deactivate accounts
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    });
});
