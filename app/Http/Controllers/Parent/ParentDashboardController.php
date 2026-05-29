<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\DevelopmentNote;
use App\Models\ActivityStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ParentDashboardController extends Controller
{
    public function __construct()
    {
        Carbon::setLocale('id');
    }

    private function getData()
    {
        $parent = Auth::user();

        if (!$parent) {
            return null;
        }

        $student = Student::with('schoolClass')
            ->where('nisn', trim($parent->username))
            ->first();

        return compact(
            'parent',
            'student'
        );
    }

    public function index()
    {
        $data = $this->getData();

        return view(
            'parent.dashboard.index',
            $data
        );
    }

    public function student()
    {
        $data = $this->getData();

        return view(
            'parent.student.index',
            $data
        );
    }

    public function attendance(Request $request)
    {
        $data = $this->getData();

        $student = $data['student'];
        $parent = $data['parent'];

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
            compact(
                'student',
                'attendances',
                'month',
                'parent'
            )
        );
    }

    public function development(Request $request)
    {
        $data = $this->getData();

        $student = $data['student'];
        $parent = $data['parent'];

        $month = $request->month
            ?? now()->format('Y-m');

        [$year, $monthOnly] = explode('-', $month);

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
            compact(
                'student',
                'developments',
                'chartDevelopments',
                'month',
                'parent'
            )
        );
    }

    public function activity(Request $request)
    {
        $data = $this->getData();

        $student = $data['student'];
        $parent = $data['parent'];

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
            compact(
                'student',
                'activities',
                'parent'
            )
        );
    }

    public function payment()
    {
        $data = $this->getData();

        return view(
            'parent.payment.index',
            $data
        );
    }
}