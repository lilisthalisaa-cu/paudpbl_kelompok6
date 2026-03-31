<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StudentController;

Route::get('/', function () {
    return redirect('/admin/students');
});

// GROUP ADMIN 
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('students', StudentController::class);
});