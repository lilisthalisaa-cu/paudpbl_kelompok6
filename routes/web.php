<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UnifiedLoginController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentActivityController;
use App\Http\Controllers\DevelopmentNoteController;
use App\Http\Controllers\TeacherStudentController;
use App\Http\Controllers\RekapAbsensiController;
use App\Http\Controllers\Parent\ParentDashboardController;
use App\Http\Controllers\Parent\PaymentController as ParentPaymentController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\GalleryController;


use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;


Route::name('website.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

    Route::get('/visi-misi', function () {
        return view('website.visimisi');
    })->name('visimisi');

    Route::get('/struktur', function () {
        return view('website.struktur');
    })->name('struktur');

    Route::get('/program', function () {
        return view('website.program');
    })->name('program');

    Route::get('/contact', function () {
        return view('website.contact');
    })->name('contact');
});


Route::controller(UnifiedLoginController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);


    Route::resource('profile', AdminProfileController::class);
    Route::resource('gallery', AdminGalleryController::class);


    Route::get('/konten', function () {
        return view('admin.konten.index');
    })->name('konten');

    Route::get('/konten/create', function () {
        return view('admin.konten.create');
    })->name('konten.create');

    Route::get('/konten/edit', function () {
        return view('admin.konten.edit');
    })->name('konten.edit');

    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');

    Route::prefix('rekap-absensi')->name('rekap.')->group(function () {
        Route::get('/', [RekapAbsensiController::class, 'index'])->name('index');
        Route::get('/siswa', [RekapAbsensiController::class, 'rekapSiswa'])->name('siswa');
        Route::get('/siswa/{id}/detail', [RekapAbsensiController::class, 'detailSiswa'])->name('siswa.detail');
        Route::get('/guru', [RekapAbsensiController::class, 'rekapGuru'])->name('guru');
        Route::get('/guru/export', [RekapAbsensiController::class, 'exportGuru'])->name('guru.export');
        Route::get('/guru/{id}/detail', [RekapAbsensiController::class, 'detailGuru'])->name('guru.detail');
        Route::get('/guru/surat/{id}', [RekapAbsensiController::class, 'viewSuratGuru'])->name('guru.surat');
    });
});


Route::middleware('auth')->prefix('teacher')->name('teacher.')->group(function () {

    Route::view('/dashboard', 'teacher.dashboard.index')->name('dashboard');

    Route::controller(TeacherAttendanceController::class)->group(function () {
        Route::get('/attendance', 'index')->name('attendance.index');
        Route::get('/attendance/create', 'create')->name('attendance.create');
        Route::post('/attendance/store', 'store')->name('attendance.store');
        Route::post('/attendance/hadir', 'hadir')->name('attendance.hadir');
        Route::post('/attendance/pulang', 'pulang')->name('attendance.pulang');
        Route::post('/attendance/izin', 'izin')->name('attendance.izin');
    });

    Route::controller(StudentAttendanceController::class)->group(function () {
        Route::get('/student-attendance/bulk-create', 'bulkCreate')->name('student_attendance.bulk_create');
        Route::post('/student-attendance/bulk-store', 'bulkStore')->name('student_attendance.bulk_store');
    });

    Route::controller(TeacherStudentController::class)->group(function () {
        Route::get('/students', 'index')->name('students.index');
        Route::get('/students/{student}', 'show')->name('students.show');
    });

    Route::controller(StudentActivityController::class)->group(function () {
        Route::get('/activity', 'index')->name('activity.index');
        Route::get('/activity/create', 'create')->name('activity.create');
        Route::post('/activity/store', 'store')->name('activity.store');
    });

    Route::controller(DevelopmentNoteController::class)->group(function () {
        Route::get('/development', 'index')->name('development.index');
        Route::get('/development/create', 'create')->name('development.create');
        Route::post('/development/store', 'store')->name('development.store');
        Route::get('/development/{development}/edit', 'edit')->name('development.edit');
        Route::put('/development/{development}', 'update')->name('development.update');
    });
});


Route::middleware('parent')->prefix('parent')->name('parent.')->group(function () {

    Route::controller(ParentDashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/student', 'student')->name('student');
        Route::get('/attendance', 'attendance')->name('attendance');
        Route::get('/development', 'development')->name('development');
        Route::get('/activity', 'activity')->name('activity');
    });

    Route::get('/payment', [ParentPaymentController::class, 'index'])->name('payment');
});


Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});
