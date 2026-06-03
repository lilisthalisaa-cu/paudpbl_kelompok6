<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\UnifiedLoginController;

use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\TeacherController;
use App\Http\Controllers\Api\Admin\StudentController;
use App\Http\Controllers\Api\Admin\SchoolClassController;
use App\Http\Controllers\Api\Admin\PaymentController;
use App\Http\Controllers\Api\Admin\ProfileController;
use App\Http\Controllers\Api\Admin\ProgramController;
use App\Http\Controllers\Api\Admin\GalleryController;
use App\Http\Controllers\Api\Admin\StructureController;
use App\Http\Controllers\Api\Admin\RekapController;
use App\Http\Controllers\Api\ParentProfileController;
use App\Http\Controllers\Api\ParentActivityController;
use App\Http\Controllers\Api\ParentGrowthController;
use App\Http\Controllers\Api\ParentPaymentController;
use App\Http\Controllers\Api\TeacherActivityController;
use App\Http\Controllers\Api\TeacherStudentController;
use App\Http\Controllers\Api\TeacherAttendanceController;
use App\Http\Controllers\Api\StudentAttendanceController;
use App\Http\Controllers\Api\TeacherDevelopmentNoteController;
use App\Http\Controllers\Api\StudentAttendanceController;
// use App\Http\Controllers\Api\TeacherAttendanceController;

Route::post(
    '/login',
    [
        UnifiedLoginController::class,
        'apiLogin'
    ]
);

Route::prefix('admin')->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
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
        '/admin/students/{id}',
        [StudentController::class, 'destroy']
    );

    Route::get(
        '/classes',
        [SchoolClassController::class, 'index']
    );

    Route::get(
        '/payments',
        [PaymentController::class, 'index']
    );

    Route::get(
        '/payments/{id}',
        [PaymentController::class, 'show']
    );

    Route::post(
        '/payments/store',
        [PaymentController::class, 'store']
    );

    Route::get(
        '/profile',
        [ProfileController::class, 'index']
    );

    Route::post(
        '/profile/update',
        [ProfileController::class, 'update']
    );

    Route::get(
        '/programs',
        [ProgramController::class, 'index']
    );

    Route::post(
        '/programs/store',
        [ProgramController::class, 'store']
    );

    Route::post(
        '/programs/update/{id}',
        [ProgramController::class, 'update']
    );

    Route::delete(
        '/programs/delete/{id}',
        [ProgramController::class, 'destroy']
    );

    Route::get(
        '/gallery',
        [GalleryController::class, 'index']
    );

    Route::post(
        '/gallery/store',
        [GalleryController::class, 'store']
    );

    Route::post(
        '/gallery/update/{id}',
        [GalleryController::class, 'update']
    );

    Route::delete(
        '/gallery/delete/{id}',
        [GalleryController::class, 'destroy']
    );

    Route::get(
        '/structures',
        [StructureController::class, 'index']
    );

    Route::post(
        '/structures/store',
        [StructureController::class, 'store']
    );

    Route::post(
        '/structures/update/{id}',
        [StructureController::class, 'update']
    );

    Route::delete(
        '/structures/delete/{id}',
        [StructureController::class, 'destroy']
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
    '/rekap/guru/export',
    [RekapController::class, 'exportGuru']
    );
});
Route::get(

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
    '/parent/activity/photo/{id}',
    [
        ParentActivityController::class,
        'photo'
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
        [
            TeacherActivityController::class,
            'index'
        ]
    );

    Route::post(
        '/activities',
        [
            TeacherActivityController::class,
            'store'
        ]
    );

    Route::get(
        '/students',
        [
            TeacherStudentController::class,
            'index'
        ]
    );

    Route::get(
        '/attendance',
        [TeacherAttendanceController::class, 'index']
    );

    Route::post(
        '/attendance',
        [TeacherAttendanceController::class, 'store']
    );

    Route::get(
        '/development-notes',
        [
            TeacherDevelopmentNoteController::class,
            'index'
        ]
    );

    Route::post(
        '/development-notes',
        [
            TeacherDevelopmentNoteController::class,
            'store'
        ]
    );
});

Route::prefix('student')->group(function () {

    Route::get(
        '/attendance',
        [
            StudentAttendanceController::class,
            'index'
        ]
    );

    Route::post(
        '/attendance',
        [
            StudentAttendanceController::class,
            'store'
        ]
    );
});