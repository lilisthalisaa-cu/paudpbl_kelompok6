<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ParentAccount;
use App\Models\StudentAttendance;
use App\Models\DevelopmentNote;
use App\Models\ActivityStudent;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ParentDashboardController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('id');
    }

    private function getData()
    {
        $parent = ParentAccount::find(
            session('parent_id')
        );

        if (!$parent) {
            return null;
        }

        // LOGIN BERDASARKAN NISN
        $student = Student::with('schoolClass')

            ->where(
                'nisn',
                $parent->nisn
            )

            ->first();

        return compact(
            'parent',
            'student'
        );
    }

    public function index()
    {
        $data = $this->getData();

        if (!$data) {

            return redirect()
                ->route('parent.login');
        }

        return view(
            'parent.dashboard.index',
            $data
        );
    }

    public function student()
    {
        $data = $this->getData();

        if (!$data) {

            return redirect()
                ->route('parent.login');
        }

        return view(
            'parent.student.index',
            $data
        );
    }

    public function attendance(Request $request)
    {
        $data = $this->getData();

        if (!$data) {

            return redirect()
                ->route('parent.login');
        }

        $student = $data['student'];

        if (!$student) {

            return back()->with(
                'error',
                'Data siswa tidak ditemukan'
            );
        }

        $month = $request->month
            ?? now()->format('Y-m');

        $date = Carbon::parse($month);

        $attendances = StudentAttendance::where(
                'student_id',
                $student->id
            )

            ->whereRaw(
                "DATE(date) BETWEEN ? AND ?",
                [
                    $date->startOfMonth()->toDateString(),
                    $date->endOfMonth()->toDateString()
                ]
            )

            ->orderBy('date', 'desc')

            ->get();

        return view(
            'parent.attendance.index',
            [

                'student' => $student,

                'attendances' => $attendances,

                'month' => $month

            ]
        );
    }

    public function development(Request $request)
    {
        $data = $this->getData();

        if (!$data) {

            return redirect()
                ->route('parent.login');
        }

        $student = $data['student'];

        if (!$student) {

            return back()->with(
                'error',
                'Data siswa tidak ditemukan'
            );
        }

        $month = $request->month
            ?? now()->format('Y-m');

        [$year, $monthOnly] = explode('-', $month);

        // DATA GRAFIK
        $chartDevelopments = DevelopmentNote::where(
                'student_id',
                $student->id
            )

            ->where(
                'year',
                (int)$year
            )

            ->orderBy('month', 'asc')

            ->get();

        // DATA TABEL
        $developments = DevelopmentNote::where(
                'student_id',
                $student->id
            )

            ->where(
                'month',
                (int)$monthOnly
            )

            ->where(
                'year',
                (int)$year
            )

            ->orderBy('month', 'desc')

            ->get();

        return view(
            'parent.development.index',
            [

                'student' => $student,

                'developments' => $developments,

                'chartDevelopments' => $chartDevelopments,

                'month' => $month

            ]
        );
    }

    public function activity(Request $request)
    {
        $data = $this->getData();

        if (!$data) {

            return redirect()
                ->route('parent.login');
        }

        $student = $data['student'];

        if (!$student) {

            return back()->with(
                'error',
                'Data siswa tidak ditemukan'
            );
        }

        $query = ActivityStudent::with('activity')

            ->where(
                'student_id',
                $student->id
            );

        if ($request->date) {

            $query->whereHas(
                'activity',
                function ($q) use ($request) {

                    $q->whereDate(
                        'date',
                        $request->date
                    );
                }
            );
        }

        $activities = $query

            ->latest()

            ->get();

        return view(
            'parent.activity.index',
            [

                'student' => $student,

                'activities' => $activities,

            ]
        );
    }

    public function payment()
    {
        $data = $this->getData();

        if (!$data) {

            return redirect()
                ->route('parent.login');
        }

        return view(
            'parent.payment.index',
            $data
        );
    }
}