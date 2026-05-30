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
use App\Http\Controllers\Api\RekapController;
use App\Http\Controllers\Api\ParentProfileController;
use App\Http\Controllers\Api\ParentActivityController;
use App\Http\Controllers\Api\ParentGrowthController;
use App\Http\Controllers\Api\ParentPaymentController;
use App\Http\Controllers\Api\TeacherActivityController;
use App\Http\Controllers\Api\TeacherStudentController;
//use App\Http\Controllers\Api\TeacherAttendanceController;
use App\Http\Controllers\Api\StudentAttendanceController;
use App\Http\Controllers\Api\TeacherDevelopmentNoteController;

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
    [TeacherController::class, 'index']
);

Route::post(
    '/teachers/store',
    [TeacherController::class, 'store']
);

Route::post(
    '/teachers/update/{id}',
    [TeacherController::class, 'update']
);

Route::delete(
    '/teachers/delete/{id}',
    [TeacherController::class, 'destroy']
);

Route::get(
    '/students',
    [StudentController::class, 'index']
);

Route::post(
    '/students/store',
    [StudentController::class, 'store']
);

Route::post(
    '/students/update/{id}',
    [StudentController::class, 'update']
);

Route::delete(
    '/students/delete/{id}',
    [StudentController::class, 'destroy']
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
    [
        GalleryController::class,
        'index'
    ]
);

Route::post(
    '/gallery/store',
    [
        GalleryController::class,
        'store'
    ]
);

Route::post(
    '/gallery/update/{id}',
    [
        GalleryController::class,
        'update'
    ]
);

Route::delete(
    '/gallery/delete/{id}',
    [
        GalleryController::class,
        'destroy'
    ]
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


    '/rekap/guru',
    [RekapController::class, 'guru']
);

Route::get(
    '/rekap/guru/{id}',
    [RekapController::class, 'detailGuru']
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

Route::prefix('teacher')->group(function () {

    Route::get(
        '/activities',
        [TeacherActivityController::class, 'index']
    );

    Route::post(
        '/activities',
        [TeacherActivityController::class, 'store']
    );

    Route::get(
        '/students',
        [TeacherStudentController::class, 'index']
    );

    // Route::get(
    //     '/attendance',
    //     [TeacherAttendanceController::class, 'index']
    // );

    // Route::post(
    //     '/attendance',
    //     [TeacherAttendanceController::class, 'store']
    // );

    Route::get(
        '/development-notes',
        [TeacherDevelopmentNoteController::class, 'index']
    );

    Route::post(
        '/development-notes',
        [TeacherDevelopmentNoteController::class, 'store']
    );

});

Route::prefix('student')->group(function () {

    Route::get(
        '/attendance',
        [StudentAttendanceController::class, 'index']
    );

    Route::post(
        '/attendance',
        [StudentAttendanceController::class, 'store']
    );
});
