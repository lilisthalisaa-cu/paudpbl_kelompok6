<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{

    public function create()
{
    $today = now()->toDateString();

    $teacher = Teacher::where('user_id', auth()->id())->first();

    $attendance = null;

    if ($teacher) {
        $attendance = TeacherAttendance::where('teacher_id', $teacher->id)
            ->whereDate('date', $today)
            ->first();
    }

    return view('teacher.attendance.create', compact('attendance', 'today'));
}

public function index(Request $request)
{
    $teacher = Teacher::where('user_id', auth()->id())->first();

    $query = TeacherAttendance::query();

    if ($teacher) {
        $query->where('teacher_id', $teacher->id);
    }

    if ($request->month) {
        $query->whereMonth('date', date('m', strtotime($request->month)))
              ->whereYear('date', date('Y', strtotime($request->month)));
    }

    $attendances = $query->latest()->get();

    return view('teacher.attendance.index', compact('attendances'));
}

    public function store(Request $request)
    {
        
        $request->validate([
            'date' => ['required', 'date'],
            'status' => ['required', 'in:HADIR,TIDAK_HADIR'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        
        $teacher = Teacher::where('user_id', auth()->id())->first();
 

        if (!$teacher) {
            return back()->withErrors('User belum terdaftar sebagai guru.');
        }

        TeacherAttendance::updateOrCreate(
            [
                'teacher_id' => $teacher->id,
                'date' => $request->date,
            ],
            [
                'status' => $request->status,
                'note' => $request->note,
            ]
        );

        return redirect()->route('teacher.attendance.index')
            ->with('success', 'Absensi guru berhasil disimpan.');
    }

}