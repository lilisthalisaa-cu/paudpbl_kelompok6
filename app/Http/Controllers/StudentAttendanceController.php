<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    private function teacherClassId()
    {
        return Teacher::where(
            'user_id',
            Auth::id()
        )->value('school_class_id');
    }

    public function create()
    {
        $classId = $this->teacherClassId();

        $students = Student::where(
                'school_class_id',
                $classId
            )
            ->orderBy('name')
            ->get();

        $today = now()->toDateString();

        return view(
            'teacher.student_attendance.create',
            compact('students', 'today')
        );
    }

    public function store(Request $request)
    {
        $classId = $this->teacherClassId();

        $student = Student::where(
                'school_class_id',
                $classId
            )
            ->findOrFail($request->student_id);

        $request->validate([
            'student_id' => [
                'required',
                'exists:students,id'
            ],

            'date' => [
                'required',
                'date'
            ],

            'status' => [
                'required',
                'in:HADIR,IZIN,SAKIT,ALPA'
            ],

            'note' => [
                'nullable',
                'string',
                'max:255'
            ],
        ]);

        StudentAttendance::updateOrCreate(

            [
                'student_id' => $student->id,
                'date' => $request->date,
            ],

            [
                'status' => $request->status,
                'note' => $request->note,
            ]

        );

        return back()->with(
            'success',
            'Absensi siswa berhasil disimpan.'
        );
    }

    public function bulkCreate()
    {
        $classId = $this->teacherClassId();

        $students = Student::where(
                'school_class_id',
                $classId
            )
            ->orderBy('name')
            ->get();

        $today = now()->toDateString();

        return view(
            'teacher.student_attendance.bulk_create',
            compact('students', 'today')
        );
    }

    public function bulkStore(Request $request)
    {
        $classId = $this->teacherClassId();

        $request->validate([
            'attendances' => [
                'required',
                'array'
            ],
        ]);

        foreach ($request->attendances as $studentId => $dates) {

            $student = Student::where(
                    'school_class_id',
                    $classId
                )
                ->find($studentId);

            if (!$student) {
                continue;
            }

            foreach ($dates as $date => $attendance) {

                if (!empty($attendance['status'])) {

                    StudentAttendance::updateOrCreate(

                        [
                            'student_id' => $studentId,
                            'date' => $date,
                        ],

                        [
                            'status' => $attendance['status'],
                            'note' => $attendance['note'] ?? null,
                        ]

                    );
                }
            }
        }

        return back()->with(
            'success',
            'Absensi siswa berhasil disimpan.'
        );
    }

    public function index(Request $request)
    {
        $classId = $this->teacherClassId();

        $query = StudentAttendance::with('student')

            ->whereHas('student', function ($q) use ($classId) {

                $q->where(
                    'school_class_id',
                    $classId
                );

            });

        $date = $request->date
            ?? now()->toDateString();

        $query->whereDate('date', $date);

        $attendances = $query
            ->latest()
            ->get();

        $rekap = [

            'hadir' => $attendances
                ->where('status', 'HADIR')
                ->count(),

            'izin' => $attendances
                ->where('status', 'IZIN')
                ->count(),

            'sakit' => $attendances
                ->where('status', 'SAKIT')
                ->count(),

            'alpa' => $attendances
                ->where('status', 'ALPA')
                ->count(),

        ];

        return view(
            'teacher.student_attendance.index',
            compact(
                'attendances',
                'rekap',
                'date'
            )
        );
    }
}