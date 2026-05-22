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

    
    public function rekapSiswa(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');
        $kelas = $request->kelas;

        $classes = SchoolClass::all();

        $query = StudentAttendance::query()

            ->select(
                'student_id',

                DB::raw("SUM(status = 'HADIR') as hadir"),
                DB::raw("SUM(status = 'IZIN') as izin"),
                DB::raw("SUM(status = 'SAKIT') as sakit"),
                DB::raw("SUM(status = 'ALPA') as alpha"),
                DB::raw("COUNT(*) as total")
            )

            ->whereMonth('date', $bulan)
            ->whereYear('date', $tahun)

            ->with('student.schoolClass');

        // FILTER KELAS
        if ($kelas) {

            $query->whereHas('student', function ($q) use ($kelas) {

                $q->where('school_class_id', $kelas);

            });

        }

        $detailSiswa = $query
            ->groupBy('student_id')
            ->get();

        return view('admin.rekap.siswa', compact(
            'detailSiswa',
            'classes',
            'bulan',
            'tahun',
            'kelas'
        ));
    }


   
    // DETAIL REKAP SISWA
    public function detailSiswa(Request $request, $id)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');
        $kelas = $request->kelas;

        $query = StudentAttendance::with('student.schoolClass')
            ->where('student_id', $id)
            ->whereMonth('date', $bulan)
            ->whereYear('date', $tahun);

        // FILTER KELAS
        if ($kelas) {

            $query->whereHas('student', function ($q) use ($kelas) {

                $q->where('school_class_id', $kelas);

            });

        }

        $data = $query
            ->orderBy('date', 'desc')
            ->get();

        $kelasData = optional(
            optional($data->first())->student
        )->schoolClass;

        $rekap = [

            'hadir' => $data->where('status', 'HADIR')->count(),

            'izin'  => $data->where('status', 'IZIN')->count(),

            'sakit' => $data->where('status', 'SAKIT')->count(),

            'alpha' => $data->where('status', 'ALPA')->count(),

            'total' => $data->count()

        ];

        return view('admin.rekap.siswa-detail', compact(
            'data',
            'rekap',
            'bulan',
            'tahun',
            'kelas',
            'kelasData'
        ));
    }
    
    public function rekapGuru(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        
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
    
    public function detailGuru(Request $request, $id)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $status = $request->status;

        // ambil data presensi guru
        $query = TeacherAttendance::with('teacher.user')
            ->where('teacher_id', $id)
            ->whereMonth('date', $bulan)
            ->whereYear('date', $tahun);

        // filter status
        if ($status) {
            $query->where('status', strtoupper($status));
        }

        // urut berdasarkan tanggal
        $presensi = $query
            ->orderBy('date', 'desc')
            ->get();

        // ambil data guru
        $guru = TeacherAttendance::with('teacher.user')
            ->where('teacher_id', $id)
            ->first();

        return view('admin.rekap.guru-detail', compact(
            'presensi',
            'guru',
            'bulan',
            'tahun',
            'status'
        ));
    }

    public function viewSuratGuru($id)
    {
        $presensi = TeacherAttendance::findOrFail($id);

        if (!$presensi->surat) {
            abort(404);
        }

        $path = storage_path('app/private/' . $presensi->surat);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

   
    // FORMAT REKAP
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

