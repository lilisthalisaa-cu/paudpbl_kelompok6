<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UnifiedLoginController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\RecapController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [UnifiedLoginController::class, 'create'])->name('login');
Route::post('/login', [UnifiedLoginController::class, 'store'])->name('login.post');
Route::post('/logout', [UnifiedLoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('/teachers', TeacherController::class);
    Route::resource('/students', StudentController::class);

    // Route::get('/recap/teachers', [RecapController::class, 'teachers'])->name('recap.teachers');
    // Route::get('/recap/students', [RecapController::class, 'students'])->name('recap.students');

});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});