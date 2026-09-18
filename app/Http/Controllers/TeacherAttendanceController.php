<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherAttendanceController extends Controller
{
    public function create()
    {
        $today = now()->toDateString();

        $teacher = Teacher::where('user_id', Auth::id())->first();

        $attendance = null;

        if ($teacher !== null) {
            $attendance = TeacherAttendance::where('teacher_id', $teacher->id)
                ->whereDate('date', $today)
                ->first();
        }

        return view('teacher.attendance.create', compact('attendance', 'today'));
    }

    public function index(Request $request)
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();

        $query = TeacherAttendance::query();

        if ($teacher !== null) {
            $query->where('teacher_id', $teacher->id);
        }

        if ($request->month) {
            $query->whereMonth('date', date('m', strtotime($request->month)))
                  ->whereYear('date', date('Y', strtotime($request->month)));
        }

        $attendances = $query->latest()->get();

        return view('teacher.attendance.index', compact('attendances'));
    }

    
    // HADIR
    public function hadir()
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();

        if (!$teacher) {
            return back()->withErrors('Guru tidak ditemukan.');
        }

        $todayAttendance = TeacherAttendance::where('teacher_id', $teacher->id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($todayAttendance) {
            return back()->withErrors('Anda sudah melakukan presensi hari ini.');
        }

        TeacherAttendance::create([
            'teacher_id' => $teacher->id,
            'date' => now()->toDateString(),
            'status' => 'HADIR',
            'jam_masuk' => now()->format('H:i:s'),
        ]);

        return back()->with('success', 'Berhasil presensi hadir.');
    }

    
    // PULANG
    public function pulang()
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();

        if (!$teacher) {
            return back()->withErrors('Guru tidak ditemukan.');
        }

        $attendance = TeacherAttendance::where('teacher_id', $teacher->id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if (!$attendance) {
            return back()->withErrors('Presensi hari ini belum ditemukan.');
        }

        if ($attendance->jam_pulang) {
            return back()->withErrors('Anda sudah melakukan presensi pulang.');
        }

        $attendance->update([
            'jam_pulang' => now()->format('H:i:s')
        ]);

        return back()->with('success', 'Berhasil presensi pulang.');
    }

   
    // IZIN / CUTI / SAKIT
    public function izin(Request $request)
    {
        $request->validate([
            'status' => 'required|in:IZIN,CUTI,SAKIT',
            'note' => 'required|string|max:255',
            'surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ],
            [
            'status.required' => 'Status presensi wajib dipilih.',
            'status.in'       => 'Status presensi tidak valid.',
            'surat.mimes'     => 'File surat hanya boleh PDF, JPG, JPEG, atau PNG.',
            'surat.max'       => 'Ukuran surat maksimal 2 MB.',
            'note.required'   => 'Keterangan wajib diisi.',
        ]);

        $teacher = Teacher::where('user_id', Auth::id())->first();

        if (!$teacher) {
            return back()->withErrors('Guru tidak ditemukan.');
        }

        $todayAttendance = TeacherAttendance::where('teacher_id', $teacher->id)
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($todayAttendance) {
            return back()->withErrors('Presensi hari ini sudah tersedia.');
        }

        $surat = null;

        if ($request->hasFile('surat')) {
            $surat = $request->file('surat')->store('surat', 'private');
        }

        TeacherAttendance::create([
            'teacher_id' => $teacher->id,
            'date' => now()->toDateString(),
            'status' => $request->status,
            'note' => $request->note,
            'surat' => $surat,
        ]);

        return back()->with('success', 'Izin berhasil dikirim.');
    }
}