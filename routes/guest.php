<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'main')->name('login');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->middleware('throttle:10,1')->name('login.attempt');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.store');
});
