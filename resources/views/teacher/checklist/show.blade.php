@extends('teacher.layouts.app')

@section('title', 'Detail Checklist Harian')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/teacher/checklist.css') }}">
@endpush

@section('content')

<div class="checklist-page">

    {{-- ================= HEADER ================= --}}
    <div class="checklist-heading">

        <div class="checklist-icon">
            📋
        </div>

        <div>
            <h1>Detail Checklist Harian</h1>
            <p>Hasil pengamatan perkembangan anak.</p>
        </div>

    </div>


    {{-- ================= TAB ================= --}}
    <div class="checklist-tabs">

        <a href="{{ route('teacher.checklist.create') }}">
            📝 Input Checklist
        </a>

        <a href="{{ route('teacher.checklist.index') }}">
            📄 Daftar Checklist
        </a>

    </div>


    {{-- ================= CARD INFORMASI ================= --}}
    <div class="checklist-card">

        <div class="checklist-card-header">

            <div>
                <h2>Checklist Harian</h2>

                <p>
                    Tanggal:
                    <strong>
                        {{ \Carbon\Carbon::parse($firstChecklist->date)->format('d/m/Y') }}
                    </strong>
                </p>

                <p>
                    Kelas:
                    <strong>
                        {{ $firstChecklist->schoolClass->name ?? '-' }}
                    </strong>
                </p>

                <p>
                    Tema:
                    <strong>
                        {{ $firstChecklist->theme ?? '-' }}
                    </strong>
                </p>
            </div>

            <div>
                <a
                    href="{{ route('teacher.checklist.index') }}"
                    class="btn btn-reset"
                >
                    ← Kembali
                </a>
            </div>

        </div>


        {{-- ================= REKAP CHECKLIST ================= --}}
        <div class="table-wrapper">

            <table class="checklist-table">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>
                            Tujuan Pembelajaran
                        </th>

                        <th>
                            Konteks Kegiatan
                        </th>

                        @foreach ($students as $student)

                            <th>
                                {{ $student->name }}
                            </th>

                        @endforeach

                    </tr>

                </thead>


                <tbody>

                    @forelse ($objectives as $objective => $objectiveChecklists)

                        <tr>

                            {{-- NO --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- TUJUAN PEMBELAJARAN --}}
                            <td>
                                {{ $objective ?: '-' }}
                            </td>


                            {{-- KONTEKS --}}
                            <td>
                                {{ $objectiveChecklists->first()->context ?? '-' }}
                            </td>


                            {{-- STATUS SETIAP ANAK --}}
                            @foreach ($students as $student)

                                @php
                                    $studentChecklist = $objectiveChecklists
                                        ->firstWhere('student_id', $student->id);
                                @endphp

                                <td>

                                    @if ($studentChecklist)

                                        @if ($studentChecklist->status === 'SM')

                                            <span class="status-badge status-sm">
                                                SM
                                            </span>

                                        @elseif ($studentChecklist->status === 'BM')

                                            <span class="status-badge status-bm">
                                                BM
                                            </span>

                                        @else

                                            -

                                        @endif

                                    @else

                                        -

                                    @endif

                                </td>

                            @endforeach

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="{{ 3 + $students->count() }}"
                                style="text-align: center;"
                            >
                                Belum ada data checklist.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- ================= KETERANGAN ================= --}}
        <div class="checklist-card-header">

            <div>

                <h2>Keterangan</h2>

                @php
                    $notes = $checklists
                        ->pluck('notes')
                        ->filter()
                        ->unique();
                @endphp

                @forelse ($notes as $note)

                    <p>
                        {{ $note }}
                    </p>

                @empty

                    <p>
                        Tidak ada keterangan.
                    </p>

                @endforelse

            </div>

        </div>


        {{-- ================= DETAIL PENGAMATAN ================= --}}
        <div class="checklist-card-header">

            <div>

                <h2>Detail Pengamatan Anak</h2>

                <p>
                    Informasi checklist harian yang telah disimpan.
                </p>

            </div>

        </div>


        {{-- ================= DETAIL SETIAP ANAK ================= --}}
        @forelse ($checklists as $index => $checklist)

            <div class="student-card">

                <div class="student-header">

                    <div class="student-number">
                        {{ $index + 1 }}
                    </div>

                    <div class="student-info">

                        <h3>
                            {{ $checklist->student->name ?? '-' }}
                        </h3>

                        <p>
                            Detail hasil pengamatan siswa
                        </p>

                    </div>

                </div>


                <div class="student-form">

                    {{-- NAMA ANAK --}}
                    <div class="form-group">

                        <label>
                            Nama Anak
                        </label>

                        <div class="form-control">
                            {{ $checklist->student->name ?? '-' }}
                        </div>

                    </div>


                    {{-- TANGGAL --}}
                    <div class="form-group">

                        <label>
                            Tanggal
                        </label>

                        <div class="form-control">
                            {{ \Carbon\Carbon::parse($checklist->date)->format('d/m/Y') }}
                        </div>

                    </div>


                    {{-- KELAS --}}
                    <div class="form-group">

                        <label>
                            Kelas
                        </label>

                        <div class="form-control">
                            {{ $checklist->schoolClass->name ?? '-' }}
                        </div>

                    </div>


                    {{-- TEMA --}}
                    <div class="form-group">

                        <label>
                            Tema
                        </label>

                        <div class="form-control">
                            {{ $checklist->theme ?: '-' }}
                        </div>

                    </div>


                    {{-- TUJUAN PEMBELAJARAN --}}
                    <div class="form-group">

                        <label>
                            Tujuan Pembelajaran
                        </label>

                        <div class="form-control">
                            {{ $checklist->learning_objective ?: '-' }}
                        </div>

                    </div>


                    {{-- KONTEKS KEGIATAN --}}
                    <div class="form-group">

                        <label>
                            Konteks Kegiatan
                        </label>

                        <div class="form-control">
                            {{ $checklist->context ?: '-' }}
                        </div>

                    </div>


                    {{-- OBSERVASI --}}
                    <div class="form-group">

                        <label>
                            Hasil Pengamatan
                        </label>

                        <div class="form-control">
                            {{ $checklist->observation ?: '-' }}
                        </div>

                    </div>


                    {{-- STATUS --}}
                    <div class="form-group">

                        <label>
                            Status Pengamatan
                        </label>

                        <div>

                            @if ($checklist->status === 'SM')

                                <span class="status-badge status-sm">
                                    Sudah Muncul
                                </span>

                            @elseif ($checklist->status === 'BM')

                                <span class="status-badge status-bm">
                                    Belum Muncul
                                </span>

                            @else

                                <span class="status-badge">
                                    -

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- KETERANGAN --}}
                    <div class="form-group">

                        <label>
                            Keterangan Tambahan
                        </label>

                        <div class="form-control">
                            {{ $checklist->notes ?: '-' }}
                        </div>

                    </div>


                    {{-- GURU --}}
                    <div class="form-group">

                        <label>
                            Guru
                        </label>

                        <div class="form-control">
                            {{ $checklist->teacher->name ?? '-' }}
                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="student-card">

                <p>
                    Belum ada detail pengamatan anak.
                </p>

            </div>

        @endforelse


        {{-- ================= TOMBOL KEMBALI ================= --}}
        <div class="checklist-actions">

            <a
                href="{{ route('teacher.checklist.index') }}"
                class="btn btn-reset"
            >
                ← Kembali ke Daftar Checklist
            </a>

        </div>

    </div>

</div>

@endsection