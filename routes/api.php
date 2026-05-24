<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\UnifiedLoginController;

Route::post('/login', [
    UnifiedLoginController::class,
    'apiLogin'
]);