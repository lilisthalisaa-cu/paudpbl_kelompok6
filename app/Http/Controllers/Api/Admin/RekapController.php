<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherAttendance;
use App\Exports\RekapGuruExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function guru()
    {
        $teachers = Teacher::with('user')->get();

        $data = $teachers->map(function ($teacher) {

            return [

                'id' => $teacher->id,

                'name' =>
                $teacher->user?->name ?? '-',

                'hadir' =>
                TeacherAttendance::where(
                    'teacher_id',
                    $teacher->id
                )
                    ->where(
                        'status',
                        'HADIR'
                    )
                    ->count(),

                'izin' =>
                TeacherAttendance::where(
                    'teacher_id',
                    $teacher->id
                )
                    ->where(
                        'status',
                        'IZIN'
                    )
                    ->count(),

                'sakit' =>
                TeacherAttendance::where(
                    'teacher_id',
                    $teacher->id
                )
                    ->where(
                        'status',
                        'SAKIT'
                    )
                    ->count(),

                'alpha' =>
                TeacherAttendance::where(
                    'teacher_id',
                    $teacher->id
                )
                    ->where(
                        'status',
                        'CUTI'
                    )
                    ->count(),
            ];
        });

        return response()->json(
            $data
        );
    }

    public function detailGuru($id)
    {
        $teacher = Teacher::with('user')
            ->findOrFail($id);

        $attendances =
            TeacherAttendance::where(
                'teacher_id',
                $id
            )
            ->orderBy(
                'date',
                'desc'
            )
            ->get()
            ->map(function ($item) {

                return [

                    'tanggal' =>
                    $item->date
                        ? $item->date->format('d-m-Y')
                        : '-',

                    'status' =>
                    $item->status ?? '-',

                    'jam_masuk' =>
                    $item->jam_masuk ?? '-',

                    'jam_pulang' =>
                    $item->jam_pulang ?? '-',

                    'catatan' =>
                    $item->note ?? '-',
                ];
            });

        return response()->json([

            'teacher' => [

                'id' =>
                $teacher->id,

                'name' =>
                $teacher->user?->name ?? '-',
            ],

            'attendances' =>
            $attendances,
        ]);
    }

    public function exportGuru(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        return Excel::download(
            new RekapGuruExport(
                $bulan,
                $tahun
            ),
            'rekap_guru.xlsx'
        );
    }

    public function siswa()
{
    $students = \App\Models\Student::all();

    $data = $students->map(function ($student) {

        return [

            'id' => $student->id,

            'name' => $student->name,

            'hadir' =>
                \App\Models\StudentAttendance::where(
                    'student_id',
                    $student->id
                )
                ->where(
                    'status',
                    'HADIR'
                )
                ->count(),

            'izin' =>
                \App\Models\StudentAttendance::where(
                    'student_id',
                    $student->id
                )
                ->where(
                    'status',
                    'IZIN'
                )
                ->count(),

            'sakit' =>
                \App\Models\StudentAttendance::where(
                    'student_id',
                    $student->id
                )
                ->where(
                    'status',
                    'SAKIT'
                )
                ->count(),

            'alpha' =>
                \App\Models\StudentAttendance::where(
                    'student_id',
                    $student->id
                )
                ->where(
                    'status',
                    'ALPHA'
                )
                ->count(),
        ];
    });

    return response()->json(
        $data
    );
}

    public function detailSiswa($id)
{
    $student =
        \App\Models\Student::findOrFail(
            $id
        );

    $attendances =
        \App\Models\StudentAttendance::where(
            'student_id',
            $id
        )
        ->orderBy(
            'date',
            'desc'
        )
        ->get()
        ->map(function ($item) {

            return [

                'tanggal' =>
                    $item->date
                        ? $item->date->format(
                            'd-m-Y'
                        )
                        : '-',

                'status' =>
                    $item->status ?? '-',

                'catatan' =>
                    $item->note ?? '-',
            ];
        });

    return response()->json([

        'student' => [

            'id' =>
                $student->id,

            'name' =>
                $student->name,
        ],

        'attendances' =>
            $attendances,
    ]);
}
}
