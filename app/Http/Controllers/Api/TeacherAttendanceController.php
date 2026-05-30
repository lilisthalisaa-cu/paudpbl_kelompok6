<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    // ================= GET ATTENDANCE =================

    public function index(Request $request)
    {
        $teacherId = $request->teacher_id;

        $attendances = TeacherAttendance::query();

        if ($teacherId) {
            $attendances->where('teacher_id', $teacherId);
        }

        $attendances = $attendances
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'role' => 'teacher',
            'data' => $attendances,
        ]);
    }

    // ================= STORE ATTENDANCE =================

    public function store(Request $request)
    {
        $attendance = TeacherAttendance::where(
            'teacher_id',
            $request->teacher_id
        )
            ->whereDate('date', $request->date)
            ->first();

        // ABSEN MASUK
        if (!$attendance) {

            $attendance = TeacherAttendance::create([
                'teacher_id' => $request->teacher_id,
                'date'       => $request->date,
                'check_in'   => now()->format('H:i:s'),
            ]);

            return response()->json([
                'success' => true,
                'type'    => 'check_in',
                'data'    => $attendance,
            ]);
        }

        // ABSEN PULANG
        if (!$attendance->check_out) {

            $attendance->update([
                'check_out' => now()->format('H:i:s'),
            ]);

            return response()->json([
                'success' => true,
                'type'    => 'check_out',
                'data'    => $attendance,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Presensi hari ini sudah selesai',
        ]);
    }
}
