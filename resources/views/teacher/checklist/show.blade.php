@extends('teacher.layouts.app')

@section('title', 'Detail Checklist Harian')

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
            <h1>Detail Checklist Harian</h1>
            <p>Detail hasil pengamatan perkembangan anak.</p>
        </div>
    </div>

    {{-- TAB --}}
    <div class="checklist-tabs">

        <a href="{{ route('teacher.checklist.create') }}">
            📝 Input Checklist
        </a>

        <a href="{{ route('teacher.checklist.index') }}">
            📄 Daftar Checklist
        </a>

    </div>

    <div class="checklist-card">

        <div class="checklist-card-header">

            <div>
                <h2>Detail Pengamatan Anak</h2>
                <p>Informasi checklist harian yang telah disimpan.</p>
            </div>

                <a
                    href="{{ route('teacher.checklist.index') }}"
                    class="btn btn-back"
                >
                    ← Kembali
                </a>
        </div>

        <div class="student-card">

            <div class="student-header">

                <div class="student-number">
                    1
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

                <div class="form-group">

                    <label>Nama Anak</label>

                    <div class="form-control">
                        {{ $checklist->student->name ?? '-' }}
                    </div>

                </div>

                <div class="form-group">

                    <label>Tanggal</label>

                    <div class="form-control">
                        {{ \Carbon\Carbon::parse($checklist->date)->format('d/m/Y') }}
                    </div>

                </div>

                <div class="form-group">

                    <label>Kelas</label>

                    <div class="form-control">
                        {{ $checklist->schoolClass->name ?? '-' }}
                    </div>

                </div>

                <div class="form-group">

                    <label>Tema</label>

                    <div class="form-control">
                        {{ $checklist->theme ?: '-' }}
                    </div>

                </div>

                <div class="form-group">

                    <label>Tujuan Pembelajaran / Observasi</label>

                    <div class="form-control">
                        {{ $checklist->observation ?: '-' }}
                    </div>

                </div>

                <div class="form-group">

                    <label>Konteks Kegiatan</label>

                    <div class="form-control">
                        {{ $checklist->context ?: '-' }}
                    </div>

                </div>

                <div class="form-group">

                    <label>Status Pengamatan</label>

                    <div>
                        @if ($checklist->status === 'SM')
                            <span class="status-badge status-sm">
                                Sudah Muncul
                            </span>
                        @else
                            <span class="status-badge status-bm">
                                Belum Muncul
                            </span>
                        @endif
                    </div>

                </div>

                <div class="form-group">

                    <label>Keterangan Tambahan</label>

                    <div class="form-control">
                        {{ $checklist->notes ?: '-' }}
                    </div>

                </div>

                <div class="form-group">

                    <label>Guru</label>

                    <div class="form-control">
                        {{ $checklist->teacher->name ?? '-' }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection