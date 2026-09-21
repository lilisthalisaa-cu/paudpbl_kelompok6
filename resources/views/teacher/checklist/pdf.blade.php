<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <link
        rel="stylesheet"
        href="{{ public_path('css/teacher-pdf.css') }}"
    >

    <title>Checklist Harian</title>
</head>

<body class="pdf-checklist-page">

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


            {{-- =============================================
                 TABEL CHECKLIST
                 ============================================= --}}

            <table class="pdf-checklist-table">

                <thead>

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