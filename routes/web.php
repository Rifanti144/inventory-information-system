<?php


use App\Http\Controllers\vehiclecontroller;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/','//vehicles/create');
Route::resource('vehicles', vehiclecontroller::class)->except('show');