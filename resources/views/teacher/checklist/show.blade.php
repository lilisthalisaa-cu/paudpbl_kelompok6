@extends('teacher.layouts.app')

@section('content')
@php
    $firstChecklist = $checklists->first();
    $studentGroups = $checklists->groupBy('student_id');

    $objectives = $checklists
        ->pluck('learning_objective')
        ->filter()
        ->unique()
        ->values();
@endphp

<div class="report-page">
    <div class="report-actions">
        <a href="{{ route('teacher.checklist.index') }}" class="report-back">
            &larr; Kembali ke Daftar Checklist
        </a>

        <button type="button" onclick="window.print()" class="report-print">
            Export File
        </button>
    </div>

    <div class="report-paper">
        <header class="report-header">
            <div class="report-logo">
                <img
                    src="{{ asset('images/LogoPaud.jpeg') }}"
                    alt="Logo KB Roudlotul Ilmi"
                >
            </div>

            <div class="report-heading">
                <h1>CEKLIST HARIAN</h1>
                <h2>KB ROUDLOTUL ILMI</h2>
                <h3>2026/2027</h3>
            </div>

            <div class="report-date">
                Singojuruh,
                {{ $firstChecklist?->date
                    ? \Carbon\Carbon::parse($firstChecklist->date)->translatedFormat('d F Y')
                    : now()->translatedFormat('d F Y') }}
            </div>
        </header>

        <div class="report-theme">
            TEMA : {{ strtoupper($firstChecklist?->theme ?? '-') }}
        </div>

        <div class="report-table-wrapper">
            <table class="report-table">
                <thead>
                    <tr>
                        <th rowspan="2" class="number-column">No</th>
                        <th rowspan="2" class="objective-column">
                            Tujuan Pembelajaran
                        </th>
                        <th colspan="{{ $studentGroups->count() + 2 }}">
                            Hasil Pengamatan
                        </th>
                    </tr>
                    <tr>
                        <th class="context-column">Konteks</th>

                        @foreach ($studentGroups as $studentChecklists)
                            <th class="student-column">
                                {{ $studentChecklists->first()->student?->name ?? 'Siswa' }}
                            </th>
                        @endforeach

                        <th class="notes-column">Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($objectives as $objective)
                        @php
                            $objectiveItems = $checklists->where(
                                'learning_objective',
                                $objective
                            );

                            $firstItem = $objectiveItems->first();
                        @endphp

                        <tr>
                            <td class="center">{{ $loop->iteration }}</td>

                            <td>{{ $objective }}</td>

                            <td>{{ $firstItem?->context ?? '-' }}</td>

                            @foreach ($studentGroups as $studentChecklists)
                                @php
                                    $studentItem = $studentChecklists->firstWhere(
                                        'learning_objective',
                                        $objective
                                    );
                                @endphp

                                <td class="center">
                                    {{ $studentItem?->status ?? '-' }}
                                </td>
                            @endforeach

                            <td>{{ $firstItem?->notes ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $studentGroups->count() + 3 }}" class="center">
                                Belum ada data checklist.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <footer class="report-signatures">
            <div class="signature-principal">
                <p>Mengetahui,</p>
                <p>Kepala KB Roudlotul Ilmi</p>
                <strong>WIDYAWATI, S.Pd</strong>
            </div>

            <div class="signature-teacher">
                <p>Wali Kelas {{ $firstChecklist?->schoolClass?->name ?? '-' }}</p>
                <strong>________________________</strong>
            </div>
        </footer>
    </div>
</div>
@endsection