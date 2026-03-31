<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UnifiedLoginController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;

// Redirect awal
Route::get('/', function () {
    return redirect('/admin/students');
});

// login
Route::middleware('guest')->group(function () {

    Route::get('/login', [UnifiedLoginController::class, 'create'])
        ->name('login');

    Route::post('/login', [UnifiedLoginController::class, 'store'])
        ->name('login.post');
});

// Admin area (auth)
Route::middleware('auth')->group(function () {

    Route::post('/logout', [UnifiedLoginController::class, 'logout'])
        ->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('students', StudentController::class);

        Route::resource('teachers', TeacherController::class);
    });
});