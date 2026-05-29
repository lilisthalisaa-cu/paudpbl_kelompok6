<?php

namespace App\Exports;

use App\Models\Teacher;
use App\Models\TeacherAttendance;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class RekapGuruExport implements FromCollection, ShouldAutoSize, WithStyles
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $teachers = Teacher::with('user')->get();

        $rows = collect([
            ['PEMERINTAH KABUPATEN BANYUWANGI'],
            ['DINAS PENDIDIKAN'],
            ['KOORDINATOR WILAYAH SATUAN PENDIDIKAN KECAMATAN SINGOJURUH'],
            ['KB ROUDLOTUL ILMI'],
            [''],
        ]);

        // HEADER
        $header = ['Tanggal'];

        foreach ($teachers as $teacher) {
            $header[] = $teacher->user->name;
        }

        $rows->push($header);

        // TOTAL HARI DALAM BULAN
        $jumlahHari = cal_days_in_month(
            CAL_GREGORIAN,
            $this->bulan,
            $this->tahun
        );

        // LOOP TANGGAL
        for ($tanggal = 1; $tanggal <= $jumlahHari; $tanggal++) {

            $row = [$tanggal];

            foreach ($teachers as $teacher) {

                $attendance = TeacherAttendance::where('teacher_id', $teacher->id)
                    ->whereDate(
                        'date',
                        $this->tahun . '-' .
                            str_pad($this->bulan, 2, '0', STR_PAD_LEFT) . '-' .
                            str_pad($tanggal, 2, '0', STR_PAD_LEFT)
                    )
                    ->first();

                if ($attendance) {

                    if ($attendance->status == 'HADIR') {

                        $row[] =
                            date('H:i', strtotime($attendance->jam_masuk))
                            . ' - ' .
                            date('H:i', strtotime($attendance->jam_pulang));
                    } else {

                        $row[] = $attendance->status;
                    }
                } else {

                    $row[] = '-';
                }
            }

            $rows->push($row);
        }

        return new Collection($rows);
    }

    public function styles(Worksheet $sheet)
    {
        // bold header sekolah
        $sheet->getStyle('A1:A4')->getFont()->setBold(true);

        // center header sekolah
        $sheet->getStyle('A1:A4')->getAlignment()->setHorizontal('center');

        // merge title
        $lastColumn = $sheet->getHighestColumn();

        $sheet->mergeCells("A1:{$lastColumn}1");
        $sheet->mergeCells("A2:{$lastColumn}2");
        $sheet->mergeCells("A3:{$lastColumn}3");
        $sheet->mergeCells("A4:{$lastColumn}4");

        // bold tabel header
        $sheet->getStyle('A6:Z6')->getFont()->setBold(true);

        return [];
    }
}
