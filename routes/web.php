<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(base_path('routes/guest.php'));

Route::middleware(['auth', 'active'])->group(function () {
    require __DIR__.'/user.php';

    require __DIR__.'/modules/items.php';
    require __DIR__.'/modules/vendors.php';
    require __DIR__.'/modules/warehouses.php';
    require __DIR__.'/modules/fleet.php';

    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin/users.php'));
});
