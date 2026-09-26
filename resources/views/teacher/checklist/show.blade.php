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


        {{-- ================= CHECKLIST ================= --}}
        <div class="table-wrapper">

            <table class="checklist-table">

                <thead>

                    <tr>

                        <th>
                            No
                        </th>

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

                    @foreach ($objectives as $objective => $objectiveChecklists)

                    <tr>

                        {{-- NO --}}
                        <td>
                            {{ $loop->iteration }}
                        </td>


                        {{-- TUJUAN --}}
                        <td>
                            {{ $objective }}
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

                    @endforeach

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

    </div>

</div>

@endsection