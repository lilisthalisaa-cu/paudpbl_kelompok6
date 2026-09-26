@extends('teacher.layouts.app')

@section('title', 'Checklist Harian')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/teacher/checklist.css') }}">
@endpush

@section('content')
<div class="checklist-page">

    {{-- HEADER --}}
    <div class="checklist-heading">
        <div class="checklist-icon">
            📋
        </div>

        <div>
            <h1>Checklist Harian</h1>
            <p>Catat hasil pengamatan perkembangan anak setiap hari.</p>
        </div>
    </div>

    {{-- TABS --}}
    <div class="checklist-tabs">
        <a href="{{ route('teacher.checklist.create') }}" class="active">
            📝 Input Checklist
        </a>

        <a href="{{ route('teacher.checklist.index') }}">
            📄 Daftar Checklist
        </a>
    </div>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert-error">
            <strong>Terjadi kesalahan:</strong>

            <ul style="margin: 6px 0 0 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teacher.checklist.store') }}" method="POST">
        @csrf

        {{-- DATA DEFAULT --}}
        <input type="hidden" name="date" value="{{ $today }}">

        <div class="checklist-card">

            <h2>Data Checklist Harian</h2>

            {{-- TEMA --}}
            @if ($checklistData)
                <div class="form-group">
                    <label>Tema</label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $checklistData['theme'] }}"
                        readonly
                    >

                    <input
                        type="hidden"
                        name="theme"
                        value="{{ $checklistData['theme'] }}"
                    >
                </div>
            @endif

            {{-- TABEL CHECKLIST --}}
            @if ($checklistData)

                <div class="form-group">
                    <label>
                        Hasil Pengamatan
                    </label>
                </div>

                <div class="checklist-input-table-wrapper">

                    <table class="checklist-table">

                        <thead>

                            {{-- BARIS JUDUL --}}
                            <tr>
                                <th rowspan="2" class="col-no">
                                    No
                                </th>

                                <th rowspan="2" class="col-objective">
                                    Tujuan Pembelajaran
                                </th>

                                <th rowspan="2" class="col-context">
                                    Konteks
                                </th>

                                <th
                                    colspan="{{ $students->count() * 2 }}"
                                    class="col-observation"
                                >
                                    Hasil Pengamatan
                                </th>

                                <th rowspan="2" class="col-notes">
                                    Ket
                                </th>
                            </tr>

                            {{-- NAMA SISWA --}}
                            <tr>

                                @foreach ($students as $student)

                                    <th
                                        colspan="2"
                                        class="student-name"
                                    >
                                        {{ $student->name }}
                                    </th>

                                @endforeach

                            </tr>

                            {{-- SM / BM --}}
                            <tr>

                                <th></th>
                                <th></th>
                                <th></th>

                                @foreach ($students as $student)

                                    <th class="status-header">
                                        SM
                                    </th>

                                    <th class="status-header">
                                        BM
                                    </th>

                                @endforeach

                                <th></th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($checklistData['learning_objectives'] as $index => $objective)

                                <tr>

                                    {{-- NOMOR --}}
                                    <td class="text-center">
                                        {{ $index + 1 }}
                                    </td>

                                    {{-- TUJUAN PEMBELAJARAN --}}
                                    <td class="objective-cell">
                                        {{ $objective }}
                                    </td>

                                    {{-- KONTEKS --}}
                                    <td class="context-cell">
                                         {{ $checklistData['contexts'][$index] }}
                                    </td>

                                    {{-- STATUS SETIAP SISWA --}}
                                    @foreach ($students as $student)

                                        <td class="status-cell">

                                            <input
                                                type="radio"
                                                name="checklists[{{ $index }}][students][{{ $student->id }}][status]"
                                                value="SM"
                                                id="sm_{{ $index }}_{{ $student->id }}"
                                                required
                                            >

                                            <label
                                                for="sm_{{ $index }}_{{ $student->id }}"
                                                class="status-radio"
                                            >
                                                SM
                                            </label>

                                        </td>

                                        <td class="status-cell">

                                            <input
                                                type="radio"
                                                name="checklists[{{ $index }}][students][{{ $student->id }}][status]"
                                                value="BM"
                                                id="bm_{{ $index }}_{{ $student->id }}"
                                            >

                                            <label
                                                for="bm_{{ $index }}_{{ $student->id }}"
                                                class="status-radio"
                                            >
                                                BM
                                            </label>

                                        </td>

                                    @endforeach

                                    {{-- KETERANGAN PER TUJUAN --}}
                                    <td class="notes-cell">

                                        <textarea
                                            name="checklists[{{ $index }}][notes]"
                                            placeholder="Keterangan..."
                                            maxlength="500"
                                        >{{ old("checklists.$index.notes") }}</textarea>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

            {{-- BUTTON --}}
            <div class="checklist-actions">

                <button type="reset" class="btn btn-reset">
                    ↺ Reset
                </button>

                <button type="submit" class="btn btn-submit">
                    ✓ Simpan Checklist
                </button>

            </div>

        </div>

    </form>

</div>
@endsection