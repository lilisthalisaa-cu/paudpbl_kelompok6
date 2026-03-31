<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UnifiedLoginController;

//Login
Route::middleware('guest')->group(function () {

    Route::get('/login', [UnifiedLoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [UnifiedLoginController::class, 'login'])
        ->name('login.post');
});

// Logout
Route::middleware('auth')->group(function () {

    Route::post('/logout', [UnifiedLoginController::class, 'logout'])
        ->name('logout');
});