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

        {{-- DATA DEFAULT UNTUK CONTROLLER --}}
        <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
        <input type="hidden" name="class_id" value="1">
        <input type="hidden" name="theme" value="">

        <div class="checklist-card">

            <h2>Data Pengamatan Anak</h2>

            <div class="student-card">

                <div class="student-header">
                    <div class="student-number">
                        1
                    </div>

                    <div class="student-info">
                        <h3>Data Pengamatan Siswa</h3>
                        <p>Pilih anak dan isi hasil pengamatannya.</p>
                    </div>
                </div>

                <div class="student-form">

                    {{-- NAMA ANAK --}}
                    <div class="form-group">
                        <label for="student_id">
                            Nama Anak <span class="required">*</span>
                        </label>

                        <select
                            name="checklists[0][student_id]"
                            id="student_id"
                            class="form-control"
                            required
                        >
                            <option value="">Pilih Nama Anak</option>

                            @foreach ($students as $student)
                                <option
                                    value="{{ $student->id }}"
                                    {{ old('checklists.0.student_id') == $student->id ? 'selected' : '' }}
                                >
                                    {{ $student->name }}

                                    @if (!empty($student->nisn))
                                        - {{ $student->nisn }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- TUJUAN PEMBELAJARAN --}}
                    <div class="form-group">
                        <label for="observation">
                            Tujuan Pembelajaran <span class="required">*</span>
                        </label>

                        <textarea
                            name="checklists[0][observation]"
                            id="observation"
                            class="form-control"
                            placeholder="Tuliskan tujuan pembelajaran atau hasil pengamatan anak..."
                            required
                        >{{ old('checklists.0.observation') }}</textarea>
                    </div>

                    {{-- KONTEKS KEGIATAN --}}
                    <div class="form-group">
                        <label for="context">
                            Konteks Kegiatan <span class="required">*</span>
                        </label>

                        <textarea
                            name="checklists[0][context]"
                            id="context"
                            class="form-control"
                            placeholder="Tuliskan kegiatan yang dilakukan anak..."
                            required
                        >{{ old('checklists.0.context') }}</textarea>
                    </div>

                    {{-- STATUS DAN CATATAN --}}
                    <div class="observation-status-grid">

                        <div class="status-group">

                            <div class="form-group">
                                <label>
                                    Status Pengamatan <span class="required">*</span>
                                </label>

                                <div class="status-options">

                                    <div class="status-option">
                                        <input
                                            type="radio"
                                            name="checklists[0][status]"
                                            id="status_sm"
                                            value="SM"
                                            {{ old('checklists.0.status') == 'SM' ? 'checked' : '' }}
                                            required
                                        >

                                        <label for="status_sm">
                                            Sudah Muncul
                                        </label>
                                    </div>

                                    <div class="status-option">
                                        <input
                                            type="radio"
                                            name="checklists[0][status]"
                                            id="status_bm"
                                            value="BM"
                                            {{ old('checklists.0.status') == 'BM' ? 'checked' : '' }}
                                        >

                                        <label for="status_bm">
                                            Belum Muncul
                                        </label>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="notes">
                                Keterangan Tambahan
                            </label>

                            <div class="textarea-wrapper">
                                <textarea
                                    name="checklists[0][notes]"
                                    id="notes"
                                    class="form-control"
                                    maxlength="500"
                                    placeholder="Tambahkan keterangan jika diperlukan..."
                                >{{ old('checklists.0.notes') }}</textarea>

                                <div class="counter">
                                    Maksimal 500 karakter
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

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