<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UnifiedLoginController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\RecapController;
use App\Http\Controllers\Parent\ParentDashboardController;

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

});

Route::middleware('parent')->prefix('parent')->name('parent.')->group(function () {

    Route::get('/dashboard', [ParentDashboardController::class, 'index'])
        ->name('dashboard');

});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});

Route::middleware(['auth', 'checkRole:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard-secure', function () {
        return view('admin.dashboard');
    });

});

Route::middleware(['parent', 'checkRole:parent'])->prefix('parent')->group(function () {

    Route::get('/dashboard-secure', [ParentDashboardController::class, 'index']);

});

Route::get('/teacher/daily-activity', function () {
    return view('teacher.daily_activity');
});

Route::get('/teacher/monthly-report', function () {
    return view('teacher.monthly_report');
});

Route::get('/teacher/teacher-attendance', function () {
    return view('teacher.teacher_attendance');
});