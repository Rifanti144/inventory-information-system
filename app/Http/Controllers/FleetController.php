<?php

namespace App\Http\Controllers;

/**
 * PLACEHOLDER - Operational Fleet module (Individual D).
 *
 * To build it later:
 *  1. php artisan make:model Fleet -m   (add `use BelongsToUser;` to the model and a user_id column in the migration,
 *     exactly like database/migrations/*_create_warehouses_table.php)
 *  2. Replace the two fleet routes in routes/web.php with:
 *        Route::resource('fleet', FleetController::class)->except('show');
 *  3. Add store/edit/update/destroy methods here and fill in resources/views/fleet/*.blade.php
 *     (copy resources/views/warehouses/* as a starting point).
 */
class FleetController extends Controller
{
    public function index()
    {
        return view('fleet.index');
    }

    public function create()
    {
        return view('fleet.create');
    }
}
