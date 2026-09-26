<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Ceklist Harian</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 22px 18px 25px 18px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            font-size: 8px;
            color: #000;
        }

        /* ================= HEADER ================= */

        .header {
            text-align: center;
            margin-bottom: 14px;
        }

        .header h1 {
            margin: 0;
            font-size: 17px;
            font-weight: bold;
        }

        .header h2 {
            margin: 4px 0 0;
            font-size: 14px;
            font-weight: bold;
        }

        .date {
            text-align: right;
            font-size: 8px;
            margin-bottom: 6px;
        }


        /* ================= TEMA ================= */

        .theme-box {
            border: 1px solid #000;
            padding: 7px 9px;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 0;
        }


        /* ================= TABLE ================= */

        .checklist-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .checklist-table th,
        .checklist-table td {
            border: 1px solid #000;
        }

        .checklist-table th {
            background: #FFD966;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }

        .checklist-table td {
            vertical-align: middle;
        }


        /* ================= HEADER TABLE ================= */

        .header-main {
            height: 30px;
            font-size: 9px;
        }

        .header-sub {
            height: 28px;
            font-size: 8px;
        }


        /* ================= KOLOM ================= */

        .no-column {
            width: 4%;
        }

        .objective-column {
            width: 24%;
        }

        .context-column {
            width: 25%;
        }

        .ket-column {
            width: 8%;
        }


        /* ================= ISI ================= */

        .no {
            text-align: center;
            font-weight: bold;
            padding: 5px;
        }

        .objective {
            padding: 6px;
            text-align: left;
            line-height: 1.35;
        }

        .context {
            padding: 6px;
            text-align: left;
            line-height: 1.35;
        }

        .student {
            text-align: center;
            padding: 5px 3px;
            word-wrap: break-word;
        }

        .status {
            text-align: center;
            font-weight: bold;
            font-size: 9px;
            padding: 7px 2px;
        }

        .ket {
            text-align: center;
            padding: 5px;
            word-wrap: break-word;
            font-size: 7px;
        }


        /* ================= TANDA TANGAN ================= */

        .signature {
            width: 100%;
            margin-top: 22px;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table td {
            border: none;
            width: 50%;
            vertical-align: top;
            font-size: 8px;
        }

        .signature-left {
            text-align: left;
        }

        .signature-right {
            text-align: center;
        }

        .signature-space {
            height: 45px;
        }

        .signature-name {
            font-weight: bold;
        }


        /* ================= FOOTER ================= */

        .footer {
            text-align: center;
            margin-top: 12px;
            font-size: 7px;
        }
    </style>
    <link
        rel="stylesheet"
        href="{{ public_path('css/teacher-pdf.css') }}"
    >

    <title>Checklist Harian</title>
</head>


<body>

    @php

        $firstChecklist = $checklists->first();

        $objectives = $checklists->groupBy('learning_objective');

        $students = $checklists
            ->sortBy(function ($item) {
                return $item->student->name ?? '';
            })
            ->pluck('student')
            ->filter()
            ->unique('id')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Lebar kolom siswa otomatis
        |--------------------------------------------------------------------------
        */

        $studentCount = $students->count();

        $studentWidth = $studentCount > 0
            ? 39 / $studentCount
            : 10;

    @endphp


    {{-- ================= HEADER ================= --}}

    <div class="header">

        <h1>CEKLIST HARIAN</h1>

        <h2>KB ROUDLOTUL ILMI</h2>

    </div>


    {{-- ================= TANGGAL ================= --}}

    <div class="date">

        {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}

    </div>


    {{-- ================= TEMA ================= --}}

    <div class="theme-box">

        TEMA :
        {{ $firstChecklist->theme ?? '-' }}

    </div>


    {{-- ================= TABEL ================= --}}

    <table class="checklist-table">

        <thead>

            {{-- BARIS HEADER PERTAMA --}}
            <tr class="header-main">

                <th
                    rowspan="2"
                    class="no-column">
                    No
                </th>

                <th
                    rowspan="2"
                    class="objective-column">
                    Tujuan Pembelajaran
                </th>

                <th
                    colspan="{{ $studentCount + 1 }}">
                    Hasil Pengamatan
                </th>

                <th
                    rowspan="2"
                    class="ket-column">
                    Ket
                </th>

            </tr>


            {{-- BARIS HEADER KEDUA --}}
            <tr class="header-sub">

                <th class="context-column">
                    Konteks
                </th>


                @foreach ($students as $student)

                    <th
                        style="width: {{ $studentWidth }}%;">

                        {{ $student->name }}

                    </th>

                @endforeach

            </tr>

        </thead>


        <tbody>

            @forelse ($objectives as $objective => $objectiveChecklists)

                @php
                    $firstObjective = $objectiveChecklists->first();
                @endphp

                <tr>

                    {{-- NO --}}
                    <td class="no">

                        {{ $loop->iteration }}

                    </td>


                    {{-- TUJUAN PEMBELAJARAN --}}
                    <td class="objective">

                        {{ $objective }}

                    </td>


                    {{-- KONTEKS --}}
                    <td class="context">

                        {{ $firstObjective->context ?? '-' }}

                    </td>


                    {{-- STATUS SETIAP ANAK --}}
                    @foreach ($students as $student)

                        @php

                            $studentChecklist = $objectiveChecklists
                                ->firstWhere(
                                    'student_id',
                                    $student->id
                                );

                        @endphp

                        <td
                            class="status"
                            style="width: {{ $studentWidth }}%;">

                            @if ($studentChecklist)

                                {{ $studentChecklist->status ?? '-' }}

                            @else

                                -

                            @endif

                        </td>

                    @endforeach


                    {{-- KETERANGAN --}}
                    <td class="ket">

                        {{ $firstObjective->notes ?? '-' }}

                    </td>

    {{-- =====================================================
         DATA SISWA
         ===================================================== --}}

    @php

        $students = $checklists
            ->filter(function ($item) {
                return $item->student;
            })
            ->groupBy('student_id');

        /*
         * Satu baris mewakili satu tujuan pembelajaran.
         * Data dikelompokkan berdasarkan observation + context.
         */
        $rows = $checklists->groupBy(function ($item) {
            return ($item->observation ?? '-') . '||' . ($item->context ?? '-');
        });

        /*
         * Maksimal 10 siswa dalam satu halaman.
         */
        $studentChunks = $students->values()->chunk(10);

    @endphp


    {{-- =====================================================
         HEADER HALAMAN
         ===================================================== --}}

    <div class="pdf-header">

        <table class="pdf-header-table">

            <tr>

                {{-- LOGO --}}

                <td class="pdf-logo-cell">

                    @php
                        $logoPath = public_path('images/LogoPaud.jpeg');
                    @endphp

                    @if (file_exists($logoPath))

                        <img
                            src="data:image/jpeg;base64,{{ base64_encode(file_get_contents($logoPath)) }}"
                            class="pdf-logo"
                        >

                    @endif

                </td>


                {{-- JUDUL --}}

                <td class="pdf-title-cell">

                    <div>CEKLIST HARIAN</div>
                    <div>KB ROUDLOTUL ILMI</div>
                    <div>2024/2025</div>

                </td>


                {{-- TANGGAL --}}

                <td class="pdf-date-cell">

                    Singojuruh,
                    {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}

                </td>

            </tr>

        </table>

    </div>


    {{-- =====================================================
         JIKA TIDAK ADA DATA
         ===================================================== --}}

    @if ($students->isEmpty())

        <table class="pdf-theme-table">

            <tr>

                <td>
                    TEMA :
                    {{ strtoupper($checklists->first()->theme ?? 'KEGIATAN HARIAN') }}
                </td>

            </tr>

        </table>


        <table class="pdf-checklist-table">

            <tr>

                <td
                    colspan="4"
                    style="text-align:center;padding:20px;"
                >
                    Belum ada data checklist harian.
                </td>

            </tr>

        </table>

    @else


        {{-- =================================================
             LOOP HALAMAN
             ================================================= --}}

        @foreach ($studentChunks as $chunkIndex => $studentChunk)

            {{-- PAGE BREAK UNTUK HALAMAN BERIKUTNYA --}}

            @if ($chunkIndex > 0)

                <div class="pdf-page-break"></div>

                <div class="pdf-page-header">

                    <div>CEKLIST HARIAN</div>
                    <div>KB ROUDLOTUL ILMI</div>
                    <div>2024/2025</div>

                </div>

            @endif


            {{-- =============================================
                 TEMA
                 ============================================= --}}

            <table class="pdf-theme-table">

                <tr>

                    <td>
                        TEMA :
                        {{ strtoupper($checklists->first()->theme ?? 'KEGIATAN HARIAN') }}
                    </td>

                </tr>

            </table>

                <tr>

                    <td
                        colspan="{{ $studentCount + 4 }}"
                        style="text-align: center; padding: 10px;">

                        Belum ada data checklist harian.

                    </td>

                </tr>

            {{-- =============================================
                 TABEL CHECKLIST
                 ============================================= --}}

            <table class="pdf-checklist-table">

                <thead>


    {{-- ================= TANDA TANGAN ================= --}}

    <div class="signature">

        <table class="signature-table">

            <tr>

                <td class="signature-left">

                    Mengetahui,

                    <br>

                    Kepala KB Roudlotul Ilmi

                    <div class="signature-space"></div>

                    <span class="signature-name">
                        ........................................
                    </span>

                </td>


                <td class="signature-right">

                    Wali Kelas
                    {{ $firstChecklist->schoolClass->name ?? '-' }}

                    <div class="signature-space"></div>

                    <span class="signature-name">
                        ........................................
                    </span>

                </td>

            </tr>

        </table>

    </div>


    {{-- ================= FOOTER ================= --}}

    <div class="footer">

        SIPARI - Sistem Informasi PAUD Roudlotul Ilmi

    </div>
                    {{-- =====================================
                         BARIS HEADER PERTAMA
                         ===================================== --}}

                    <tr>

                        <th
                            rowspan="2"
                            class="pdf-col-no"
                        >
                            No
                        </th>


                        <th
                            rowspan="2"
                            class="pdf-col-tujuan"
                        >
                            Tujuan Pembelajaran
                        </th>


                        {{-- 
                            Hasil Pengamatan terdiri dari:
                            1. Konteks
                            2. Kolom setiap siswa
                            3. Keterangan
                        --}}

                        <th
                            colspan="{{ 2 + count($studentChunk) }}"
                            class="pdf-hasil-header"
                        >
                            Hasil Pengamatan
                        </th>

                    </tr>


                    {{-- =====================================
                         BARIS HEADER KEDUA
                         ===================================== --}}

                    <tr>

                        {{-- KONTEKS --}}

                        <th class="pdf-col-konteks">
                            Konteks
                        </th>


                        {{-- NAMA SISWA --}}

                        @foreach ($studentChunk as $student)

                            <th class="pdf-student-col">

                                {{ $student->first()->student->name ?? '-' }}

                            </th>

                        @endforeach


                        {{-- KETERANGAN --}}

                        <th class="pdf-keterangan-col">
                            Keterangan
                        </th>

                    </tr>

                </thead>


                {{-- =========================================
                     DATA CHECKLIST
                     ========================================= --}}

                <tbody>

                    @foreach ($rows as $rowIndex => $rowGroup)

                        @php
                            $firstRow = $rowGroup->first();

                            /*
                             * Ambil seluruh keterangan/notes
                             * dari checklist siswa pada baris ini.
                             */
                            $notes = $rowGroup
                                ->filter(function ($item) {
                                    return !empty($item->notes);
                                })
                                ->map(function ($item) {
                                    return $item->notes;
                                })
                                ->unique()
                                ->values();
                        @endphp


                        <tr>

                            {{-- =================================
                                 NO
                                 ================================= --}}

                            <td class="pdf-number">

                                {{ $loop->iteration }}

                            </td>


                            {{-- =================================
                                 TUJUAN PEMBELAJARAN
                                 ================================= --}}

                            <td class="pdf-objective">

                                {{ $firstRow->observation ?? '-' }}

                            </td>


                            {{-- =================================
                                 KONTEKS
                                 ================================= --}}

                            <td class="pdf-context">

                                {{ $firstRow->context ?? '-' }}

                            </td>


                            {{-- =================================
                                 STATUS SETIAP SISWA
                                 ================================= --}}

                            @foreach ($studentChunk as $student)

                                @php

                                    $studentChecklist = $rowGroup
                                        ->where(
                                            'student_id',
                                            $student->first()->student_id
                                        )
                                        ->first();

                                @endphp


                                <td class="pdf-status">

                                    @if ($studentChecklist)

                                        @if ($studentChecklist->status === 'SM')

                                            <span class="pdf-status-sm">
                                                SM
                                            </span>

                                        @else

                                            <span class="pdf-status-bm">
                                                BM
                                            </span>

                                        @endif

                                    @endif

                                </td>

                            @endforeach


                            {{-- =================================
                                 KETERANGAN
                                 ================================= --}}

                            <td class="pdf-keterangan">

                                @if ($notes->isNotEmpty())

                                    @foreach ($notes as $note)

                                        <div>
                                            {{ $note }}
                                        </div>

                                    @endforeach

                                @else

                                    -

                                @endif

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>


            {{-- =============================================
                 TANDA TANGAN
                 ============================================= --}}

            @if ($loop->last)

                <table class="pdf-signature">

                    <tr>

                        <td class="pdf-signature-left">

                            Mengetahui,<br>
                            Kepala KB Roudlotul Ilmi

                        </td>


                        <td></td>


                        <td class="pdf-signature-right">

                            Wali Kelas B

                        </td>

                    </tr>


                    <tr class="pdf-signature-space">

                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>


                    <tr>

                        <td class="pdf-signature-left">

                            <strong>
                                WIDYAWATI, S.Pd
                            </strong>

                        </td>


                        <td></td>


                        <td class="pdf-signature-right">

                            <strong>
                                RETNO PUJIASTUTI O, S.Psi
                            </strong>

                        </td>

                    </tr>

                </table>

            @endif

        @endforeach

    @endif

</body>

</html>