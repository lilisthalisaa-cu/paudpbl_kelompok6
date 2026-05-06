<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Models\TeacherAttendance;

class RekapAbsensiController extends Controller
{
    // halaman awal
    public function index()
    {
        return view('admin.rekap.index');
    }

    // ========================
    // REKAP SISWA
    // ========================
    public function rekapSiswa(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $data = StudentAttendance::whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->get();

        $rekap = [
        'hadir' => $data->where('status', 'HADIR')->count(),
        'izin'  => $data->where('status', 'IZIN')->count(),
        'sakit' => $data->where('status', 'SAKIT')->count(),
        'alpha' => $data->where('status', 'ALPA')->count(),
        'total' => $data->count()
    ];

       return view('admin.rekap.siswa', compact('rekap'));
    }

    // ========================
    // REKAP GURU
    // ========================
    public function rekapGuru(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $data = TeacherAttendance::whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->get();

        $rekap = [
        'hadir' => $data->where('status', 'HADIR')->count(),
        'tidak_hadir' => $data->where('status', 'TIDAK_HADIR')->count(),
        'total' => $data->count()
    ];

       return view('admin.rekap.guru', compact('rekap'));
    }

    // ========================
    // FORMAT REKAP
    // ========================
    private function formatRekap($data)
    {
    return [
        'hadir' => $data->where('status', 'HADIR')->count(),
        'izin'  => $data->where('status', 'IZIN')->count(),
        'sakit' => $data->where('status', 'SAKIT')->count(),
        'alpha' => $data->where('status', 'ALPA')->count(),
        'total' => $data->count()
    ];
    }
}