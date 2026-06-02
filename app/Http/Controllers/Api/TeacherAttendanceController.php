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

        if ($request->filled('status')) {

            $attendance = TeacherAttendance::create([
                'teacher_id' => $request->teacher_id,
                'date'       => $request->date,
                'status'     => strtoupper($request->status),
                'note'       => $request->note,
            ]);

            return response()->json([
                'success' => true,
                'type'    => 'permission',
                'data'    => $attendance,
            ]);
        }

        $attendance = TeacherAttendance::where(
            'teacher_id',
            $request->teacher_id
        )
            ->whereDate('date', $request->date)
            ->first();

        // IZIN / SAKIT / CUTI
        if ($request->filled('status')) {

            $attendance = TeacherAttendance::create([
                'teacher_id' => $request->teacher_id,
                'date'       => $request->date,
                'status'     => strtoupper($request->status),
                'note'       => $request->note,
            ]);

            return response()->json([
                'success' => true,
                'type'    => 'izin',
                'data'    => $attendance,
            ]);
        }

        // HADIR
        if (!$attendance) {

            $attendance = TeacherAttendance::create([
                'teacher_id' => $request->teacher_id,
                'date'       => $request->date,
                'status'     => 'HADIR',
                'check_in'   => now()->format('H:i:s'),
            ]);

            return response()->json([
                'success' => true,
                'type'    => 'check_in',
                'data'    => $attendance,
            ]);
        }

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
