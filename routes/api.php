<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\UnifiedLoginController;

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SchoolClassController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\StructureController;
use App\Http\Controllers\Api\ParentProfileController;
use App\Http\Controllers\Api\ParentActivityController;
use App\Http\Controllers\Api\ParentGrowthController;
use App\Http\Controllers\Api\ParentPaymentController;

Route::post(
    '/login',
    [
        UnifiedLoginController::class,
        'apiLogin'
    ]
);

Route::get(
    '/admin/dashboard',
    [
        DashboardController::class,
        'index'
    ]
);

Route::get(
    '/teachers',
    [
        TeacherController::class,
        'index'
    ]
);

Route::get(
    '/students',
    [
        StudentController::class,
        'index'
    ]
);

Route::get(
    '/classes',
    [
        SchoolClassController::class,
        'index'
    ]
);

Route::get(
    '/payments',
    [
        PaymentController::class,
        'index'
    ]
);

Route::get(
    '/payments/{id}',
    [
        PaymentController::class,
        'show'
    ]
);

Route::post(
    '/payments/store',
    [
        PaymentController::class,
        'store'
    ]
);

Route::get(
    '/profile',
    [
        ProfileController::class,
        'index'
    ]
);

Route::post(
    '/profile/update',
    [
        ProfileController::class,
        'update'
    ]
);

Route::get(
    '/programs',
    [
        ProgramController::class,
        'index'
    ]
);

Route::post(
    '/programs/store',
    [
        ProgramController::class,
        'store'
    ]
);

Route::post(
    '/programs/update/{id}',
    [
        ProgramController::class,
        'update'
    ]
);

Route::delete(
    '/programs/delete/{id}',
    [
        ProgramController::class,
        'destroy'
    ]
);

/// GALLERY
Route::get(
    '/gallery',
    [GalleryController::class,
     'index']
);

Route::post(
    '/gallery/store',
    [GalleryController::class,
     'store']
);

Route::post(
    '/gallery/update/{id}',
    [GalleryController::class,
     'update']
);

Route::delete(
    '/gallery/delete/{id}',
    [GalleryController::class,
     'destroy']
);

Route::get(
    '/structures',
    [
        StructureController::class,
        'index'
    ]
);

Route::post(
    '/structures/store',
    [
        StructureController::class,
        'store'
    ]
);

Route::post(
    '/structures/update/{id}',
    [
        StructureController::class,
        'update'
    ]
);

Route::delete(
    '/structures/delete/{id}',
    [
        StructureController::class,
        'destroy'
    ]
);

    Route::get(
    '/parent/payments',
    [
        ParentPaymentController::class,
        'index'
    ]
);

Route::get(
    '/parent/profile',
    [
        ParentProfileController::class,
        'index'
    ]
);

Route::get(
    '/parent/activities',
    [
        ParentActivityController::class,
        'index'
    ]
);

Route::get(
    '/parent/growths',
    [
        ParentGrowthController::class,
        'index'
    ]
);