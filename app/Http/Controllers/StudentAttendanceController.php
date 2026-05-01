<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    public function create()
    {
        $students = Student::orderBy('name')->get();
        $today = now()->toDateString();

        return view('teacher.student_attendance.create', compact('students', 'today'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'date' => ['required', 'date'],
            'status' => ['required', 'in:HADIR,IZIN,SAKIT,ALPA'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        StudentAttendance::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'date' => $request->date,
            ],
            [
                'status' => $request->status,
                'note' => $request->note,
            ]
        );

        return back()->with('success', 'Absensi siswa berhasil disimpan.');
    }

    public function bulkCreate()
    {
        $students = Student::orderBy('name')->get();
        $today = now()->toDateString();

        return view('teacher.student_attendance.bulk_create', compact('students', 'today'));
    }

    public function bulkStore(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date'],
            'attendances' => ['required', 'array'],
        ]);

        foreach ($request->attendances as $studentId => $attendance) {
            if (!empty($attendance['status'])) {
                StudentAttendance::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'date' => $request->date,
                    ],
                    [
                        'status' => $attendance['status'],
                        'note' => $attendance['note'] ?? null,
                    ]
                );
            }
        }

        return redirect()->route('teacher.student_attendance.index')->with('success', 'Absensi siswa berhasil disimpan.');
    }

    public function index(Request $request)
    {

        $classId = Auth::user()->teacher->school_class_id;

        $query = StudentAttendance::with('student')
            ->whereHas('student', function ($q) use ($classId) {
                $q->where('school_class_id', $classId);
            });

        $date = $request->date ?? now()->toDateString();

        $query->whereDate('date', $date);

        $attendances = $query->latest()->get();


        $rekap = [
            'hadir' => $attendances->where('status', 'HADIR')->count(),
            'izin'  => $attendances->where('status', 'IZIN')->count(),
            'sakit' => $attendances->where('status', 'SAKIT')->count(),
            'alpa'  => $attendances->where('status', 'ALPA')->count(),
        ];

        return view('teacher.student_attendance.index', compact('attendances', 'rekap', 'date'));
    }
}
