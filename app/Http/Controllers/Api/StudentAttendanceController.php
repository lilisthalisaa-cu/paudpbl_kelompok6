<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $studentId = $request->student_id;

        $attendances = StudentAttendance::query();

        if ($studentId) {
            $attendances->where('student_id', $studentId);
        }

        return response()->json([
            'success' => true,
            'data' => $attendances
                ->orderBy('date', 'desc')
                ->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'date' => 'required|date',
            'status' => 'required',
            'note' => 'nullable',
        ]);

        $attendance = StudentAttendance::create([
            'student_id' => $request->student_id,
            'date' => $request->date,
            'status' => $request->status,
            'note' => $request->note,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Presensi siswa berhasil disimpan',
            'data' => $attendance,
        ], 201);
    }
}