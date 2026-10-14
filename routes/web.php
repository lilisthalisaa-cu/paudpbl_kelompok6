
<?php

use Illuminate\Support\Facades\Route;

// Autentikasi
use App\Http\Controllers\Auth\UnifiedLoginController;

// Controller Admin
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\StructureController as AdminStructureController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\AcademicCalendarController as AdminAcademicCalendarController;

// Controller Guru dan fitur bersama
use App\Http\Controllers\TeacherAttendanceController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DevelopmentNoteController;
use App\Http\Controllers\TeacherStudentController;
use App\Http\Controllers\RekapAbsensiController;
use App\Http\Controllers\ChecklistPdfController;
use App\Http\Controllers\DailyChecklistController;

// Controller Orang Tua
use App\Http\Controllers\Parent\ParentDashboardController;
use App\Http\Controllers\Parent\PaymentController as ParentPaymentController;
use App\Http\Controllers\AcademicCalendarController as ParentAcademicCalendarController;

// Controller Website
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\GalleryController;
use App\Http\Controllers\Website\ProgramController;
use App\Http\Controllers\Website\StructureController;


/*
|--------------------------------------------------------------------------
| WEBSITE PUBLIK
|--------------------------------------------------------------------------
*/

Route::name('website.')->group(function () {

    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/profile', [ProfileController::class, 'profile'])
        ->name('profile');

    Route::get('/visi-misi', [ProfileController::class, 'visimisi'])
        ->name('visimisi');

    Route::get('/contact', [ProfileController::class, 'contact'])
        ->name('contact');

    Route::get('/gallery', [GalleryController::class, 'index'])
        ->name('gallery');

    Route::get('/program', [ProgramController::class, 'index'])
        ->name('program');

    Route::get('/struktur', [StructureController::class, 'index'])
        ->name('struktur');

});


/*
|--------------------------------------------------------------------------
| AUTENTIKASI
|--------------------------------------------------------------------------
*/

Route::controller(UnifiedLoginController::class)->group(function () {

    Route::get('/login', 'create')
        ->name('login');

    Route::post('/login', 'store')
        ->name('login.post');

    Route::post('/logout', 'logout')
        ->name('logout');

});


/*
|--------------------------------------------------------------------------
| DASHBOARD DAN FITUR ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard')
            ->name('dashboard');

        // Data guru dan siswa
        Route::resource('teachers', TeacherController::class);
        Route::resource('students', StudentController::class);

        // Pengelolaan konten website
        Route::resource('profile', AdminProfileController::class);
        Route::resource('gallery', AdminGalleryController::class);
        Route::resource('program', AdminProgramController::class);
        Route::resource('structure', AdminStructureController::class);
        Route::resource('contact', AdminContactController::class);


        /*
        |--------------------------------------------------------------------------
        | KALENDER AKADEMIK - ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/academic-calendars',
            [AdminAcademicCalendarController::class, 'index']
        )->name('academic-calendars.index');

        Route::post(
            '/academic-calendars',
            [AdminAcademicCalendarController::class, 'store']
        )->name('academic-calendars.store');

        Route::get(
            '/academic-calendars/{academicCalendar}',
            [AdminAcademicCalendarController::class, 'show']
        )->name('academic-calendars.show');

        Route::put(
            '/academic-calendars/{academicCalendar}',
            [AdminAcademicCalendarController::class, 'update']
        )->name('academic-calendars.update');

        Route::delete(
            '/academic-calendars/{academicCalendar}',
            [AdminAcademicCalendarController::class, 'destroy']
        )->name('academic-calendars.destroy');


        /*
        |--------------------------------------------------------------------------
        | KONTEN ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get('/konten', function () {
            return view('admin.konten.index');
        })->name('konten');

        Route::get('/konten/create', function () {
            return view('admin.konten.create');
        })->name('konten.create');

        Route::get('/konten/edit', function () {
            return view('admin.konten.edit');
        })->name('konten.edit');


        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/payment',
            [PaymentController::class, 'index']
        )->name('payment.index');

        Route::get(
            '/payment/{id}',
            [PaymentController::class, 'show']
        )->name('payment.show');

        Route::post(
            '/payment/store',
            [PaymentController::class, 'store']
        )->name('payment.store');


        /*
        |--------------------------------------------------------------------------
        | REKAP ABSENSI ADMIN
        |--------------------------------------------------------------------------
        */

        Route::prefix('rekap-absensi')
            ->name('rekap.')
            ->group(function () {

                Route::get(
                    '/',
                    [RekapAbsensiController::class, 'index']
                )->name('index');

                Route::get(
                    '/siswa',
                    [RekapAbsensiController::class, 'rekapSiswa']
                )->name('siswa');

                Route::get(
                    '/siswa/{id}/detail',
                    [RekapAbsensiController::class, 'detailSiswa']
                )->name('siswa.detail');

                Route::get(
                    '/guru',
                    [RekapAbsensiController::class, 'rekapGuru']
                )->name('guru');

                Route::get(
                    '/guru/export',
                    [RekapAbsensiController::class, 'exportGuru']
                )->name('guru.export');

                Route::get(
                    '/guru/{id}/detail',
                    [RekapAbsensiController::class, 'detailGuru']
                )->name('guru.detail');

                Route::get(
                    '/guru/surat/{id}',
                    [RekapAbsensiController::class, 'viewSuratGuru']
                )->name('guru.surat');

            });

    });


/*
|--------------------------------------------------------------------------
| DASHBOARD DAN FITUR GURU
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        Route::view('/dashboard', 'teacher.dashboard.index')
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | ABSENSI GURU
        |--------------------------------------------------------------------------
        */

        Route::controller(TeacherAttendanceController::class)->group(function () {

            Route::get('/attendance', 'index')
                ->name('attendance.index');

            Route::get('/attendance/create', 'create')
                ->name('attendance.create');

            Route::post('/attendance/hadir', 'hadir')
                ->name('attendance.hadir');

            Route::post('/attendance/pulang', 'pulang')
                ->name('attendance.pulang');

            Route::post('/attendance/izin', 'izin')
                ->name('attendance.izin');

        });


        /*
        |--------------------------------------------------------------------------
        | ABSENSI SISWA
        |--------------------------------------------------------------------------
        */

        Route::controller(StudentAttendanceController::class)->group(function () {

            Route::get(
                '/student-attendance/bulk-create',
                'bulkCreate'
            )->name('student_attendance.bulk_create');

            Route::post(
                '/student-attendance/bulk-store',
                'bulkStore'
            )->name('student_attendance.bulk_store');

        });


        /*
        |--------------------------------------------------------------------------
        | DATA SISWA
        |--------------------------------------------------------------------------
        */

        Route::controller(TeacherStudentController::class)->group(function () {

            Route::get('/students', 'index')
                ->name('students.index');

            Route::get('/students/{student}', 'show')
                ->name('students.show');

        });


        /*
        |--------------------------------------------------------------------------
        | KEGIATAN GURU
        |--------------------------------------------------------------------------
        */

        Route::controller(ActivityController::class)->group(function () {

            Route::get('/activity', 'index')
                ->name('activity.index');

            Route::get('/activity/create', 'create')
                ->name('activity.create');

            Route::post('/activity/store', 'store')
                ->name('activity.store');

            Route::get('/activity/photo/{id}', 'viewPhoto')
                ->name('activity.photo');

        });


        /*
        |--------------------------------------------------------------------------
        | CATATAN PERKEMBANGAN
        |--------------------------------------------------------------------------
        */

        Route::controller(DevelopmentNoteController::class)->group(function () {

            Route::get('/development', 'index')
                ->name('development.index');

            Route::get('/development/create', 'create')
                ->name('development.create');

            Route::post('/development/store', 'store')
                ->name('development.store');

            Route::get('/development/{development}/edit', 'edit')
                ->name('development.edit');

            Route::put('/development/{development}', 'update')
                ->name('development.update');

        });


        /*
        |--------------------------------------------------------------------------
        | CHECKLIST HARIAN
        |--------------------------------------------------------------------------
        */

        Route::controller(DailyChecklistController::class)->group(function () {

            Route::get('/checklist', 'index')
                ->name('checklist.index');

            Route::get('/checklist/create', 'create')
                ->name('checklist.create');

            Route::post('/checklist/store', 'store')
                ->name('checklist.store');

            Route::get('/checklist/{id}', 'show')
                ->name('checklist.show');

        });

        Route::get(
            '/checklist/{date}/export',
            [ChecklistPdfController::class, 'export']
        )->name('checklist.export');

    });


/*
|--------------------------------------------------------------------------
| DASHBOARD DAN FITUR ORANG TUA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:parent'])
    ->prefix('parent')
    ->name('parent.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD ORANG TUA
        |--------------------------------------------------------------------------
        */

        Route::controller(ParentDashboardController::class)->group(function () {

            Route::get('/dashboard', 'index')
                ->name('dashboard');

            Route::get('/student', 'student')
                ->name('student');

            Route::get('/attendance', 'attendance')
                ->name('attendance');

            Route::get('/development', 'development')
                ->name('development');

            Route::get('/activity', 'activity')
                ->name('activity');

        });


        /*
        |--------------------------------------------------------------------------
        | KALENDER AKADEMIK - ORANG TUA (HANYA BACA)
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/academic-calendars',
            [ParentAcademicCalendarController::class, 'index']
        )->name('academic-calendars.index');

        Route::get(
            '/academic-calendars/{academicCalendar}',
            [ParentAcademicCalendarController::class, 'show']
        )->name('academic-calendars.show');


        /*
        |--------------------------------------------------------------------------
        | KEGIATAN DAN PEMBAYARAN ORANG TUA
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/activity/photo/{id}',
            [ActivityController::class, 'viewPhoto']
        )->name('activity.photo');

        Route::get(
            '/payment',
            [ParentPaymentController::class, 'index']
        )->name('payment');

    });


/*
|--------------------------------------------------------------------------
| REDIRECT DASHBOARD UMUM
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});