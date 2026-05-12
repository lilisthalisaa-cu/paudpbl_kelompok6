<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Models\TeacherAttendance;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\DB;
use App\Exports\RekapGuruExport;
use Maatwebsite\Excel\Facades\Excel;

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

        // 🔥 FILTER KELAS
        $classes = SchoolClass::all();

        return view('admin.rekap.siswa', compact(
            'rekap',
            'classes'
        ));
    }

    // ========================
    // DETAIL REKAP SISWA
    // ========================
    public function detailSiswa(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');
        $kelas = $request->kelas;

        $query = StudentAttendance::with('student.schoolClass')
            ->whereMonth('date', $bulan)
            ->whereYear('date', $tahun);

        // 🔥 FILTER KELAS
        if ($kelas) {
            $query->whereHas('student', function ($q) use ($kelas) {
                $q->where('school_class_id', $kelas);
            });
        }

        $data = $query->get();

        $rekap = [
            'hadir' => $data->where('status', 'HADIR')->count(),
            'izin'  => $data->where('status', 'IZIN')->count(),
            'sakit' => $data->where('status', 'SAKIT')->count(),
            'alpha' => $data->where('status', 'ALPA')->count(),
            'total' => $data->count()
        ];

        // 🔥 AMBIL DATA KELAS
        $kelasData = SchoolClass::find($kelas);

        return view('admin.rekap.siswa-detail', compact(
            'rekap',
            'kelasData',
            'bulan',
            'tahun',
            'data'
        ));
    }

    // ========================
    // REKAP GURU
    // ========================
    // public function rekapGuru(Request $request)
    // {
    //     $bulan = $request->bulan ?? date('m');
    //     $tahun = $request->tahun ?? date('Y');

    //     $data = TeacherAttendance::whereMonth('date', $bulan)
    //         ->whereYear('date', $tahun)
    //         ->get();

    //     $rekap = [
    //     'hadir' => $data->where('status', 'HADIR')->count(),
    //     'tidak_hadir' => $data->where('status', 'TIDAK_HADIR')->count(),
    //     'total' => $data->count()
    // ];

    //    return view('admin.rekap.guru', compact('rekap'));
    // }

    public function rekapGuru(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        // =========================
        // SUMMARY CARD
        // =========================
        $summary = TeacherAttendance::whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->selectRaw("
            SUM(status = 'HADIR') as hadir,
            SUM(status = 'IZIN') as izin,
            SUM(status = 'CUTI') as cuti,
            SUM(status = 'SAKIT') as sakit,
            COUNT(*) as total
        ")
            ->first();

        // =========================
        // DETAIL PER GURU
        // =========================
        $detailGuru = TeacherAttendance::select(
            'teacher_id',
            DB::raw("SUM(status = 'HADIR') as hadir"),
            DB::raw("SUM(status = 'IZIN') as izin"),
            DB::raw("SUM(status = 'CUTI') as cuti"),
            DB::raw("SUM(status = 'SAKIT') as sakit"),
            DB::raw("COUNT(*) as total")
        )
            ->with('teacher.user')
            ->whereMonth('date', $bulan)
            ->whereYear('date', $tahun)
            ->groupBy('teacher_id')
            ->get();

        return view('admin.rekap.guru', compact(
            'summary',
            'detailGuru',
            'bulan',
            'tahun'
        ));
    }

    public function exportGuru(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $fileName = 'Rekap_Presensi_Guru_' . $bulan . '_' . $tahun . '.xlsx';

        return Excel::download(
            new RekapGuruExport($bulan, $tahun),
            $fileName
        );
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