@extends('teacher.layouts.app')

@section('title', 'Daftar Checklist Harian')

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
            <h1>Checklist Harian</h1>
            <p>Catat hasil pengamatan perkembangan anak setiap hari.</p>
        </div>

    </div>


    {{-- ================= TAB ================= --}}
    <div class="checklist-tabs">

        <a href="{{ route('teacher.checklist.create') }}">
            📝 Input Checklist
        </a>

        <a href="{{ route('teacher.checklist.index') }}" class="active">
            📄 Daftar Checklist
        </a>

    </div>


    {{-- ================= SUCCESS ================= --}}
    @if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif


    {{-- ================= ERROR ================= --}}
    @if ($errors->any())
    <div class="alert-error">

        <strong>Terjadi kesalahan:</strong>

        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
    @endif


    {{-- ================= CARD ================= --}}
    <div class="checklist-card">

        {{-- CARD HEADER --}}
        <div class="checklist-card-header">

            <div>
                <h2>Daftar Checklist Harian</h2>
                <p>Data checklist harian siswa yang sudah disimpan.</p>
            </div>

                <a
                    href="{{ url('/teacher/checklist/' . now()->format('Y-m-d') . '/export') }}"
                    class="btn btn-export"
                >
                    📄 Export PDF
                </a>

        </div>


        {{-- ================= FILTER ================= --}}
        <form
            action="{{ route('teacher.checklist.index') }}"
            method="GET"
            class="checklist-filter">

            {{-- TANGGAL --}}
            <div class="checklist-filter-group">

                <label for="date">
                    Tanggal
                </label>

                <input
                    type="date"
                    name="date"
                    id="date"
                    value="{{ request('date') }}"
                    class="form-control">

            </div>


            {{-- TEMA --}}
            <div class="checklist-filter-group">

                <label for="theme">
                    Tema
                </label>

                <input
                    type="text"
                    name="theme"
                    id="theme"
                    value="{{ request('theme') }}"
                    class="form-control"
                    placeholder="Cari tema...">

            </div>


            {{-- CARI SISWA --}}
            <div class="checklist-filter-group">

                <label for="student">
                    Cari Siswa
                </label>

                <input
                    type="text"
                    name="student"
                    id="student"
                    value="{{ request('student') }}"
                    class="form-control"
                    placeholder="Cari nama siswa...">

            </div>


            {{-- BUTTON --}}
            <div class="checklist-filter-actions">

                <button
                    type="submit"
                    class="btn btn-search">
                    🔍 Cari
                </button>

                <a
                    href="{{ route('teacher.checklist.index') }}"
                    class="btn btn-reset">
                    Reset
                </a>

            </div>

        </form>


        {{-- ================= TABLE ================= --}}
        <div class="table-wrapper">

            <table class="checklist-table">

                <thead>
                    <tr>

                        <th>No</th>

                        <th>Nama Anak</th>

                        <th>Tanggal</th>

                        <th>Kelas</th>

                        <th>Tema</th>

                        <th>Konteks Kegiatan</th>

                        <th>Observasi</th>

                        <th>Status</th>

                        <th>Catatan</th>

                        <th>Aksi</th>

                    </tr>
                </thead>


                <tbody>

                    @forelse ($checklists as $index => $checklist)

                    <tr>

                        {{-- NO --}}
                        <td>
                            {{ $checklists->firstItem() + $index }}
                        </td>


                        {{-- NAMA --}}
                        <td>
                            <strong>
                                {{ $checklist->student->name ?? '-' }}
                            </strong>
                        </td>


                        {{-- TANGGAL --}}
                        <td>
                            {{ \Carbon\Carbon::parse($checklist->date)->format('d/m/Y') }}
                        </td>


                        {{-- KELAS --}}
                        <td>
                            {{ $checklist->schoolClass->name ?? '-' }}
                        </td>


                        {{-- TEMA --}}
                        <td>
                            {{ $checklist->theme ?: '-' }}
                        </td>


                        {{-- KONTEKS --}}
                        <td>
                            {{ $checklist->context ?: '-' }}
                        </td>


                        {{-- OBSERVASI --}}
                        <td>
                            {{ $checklist->observation ?: '-' }}
                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if ($checklist->status === 'SM')

                            <span class="status-badge status-sm">
                                Sudah Muncul
                            </span>

                            @else

                            <span class="status-badge status-bm">
                                Belum Muncul
                            </span>

                            @endif

                        </td>


                        {{-- CATATAN --}}
                        <td>
                            {{ $checklist->notes ?: '-' }}
                        </td>


                        {{-- AKSI --}}
                        <td>

                            <a
                                href="{{ route('teacher.checklist.show', $checklist->id) }}"
                                class="btn btn-detail">
                                Lihat
                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="10"
                            class="empty-checklist">

                            <div class="empty-icon">
                                📝
                            </div>

                            <strong>
                                Belum ada data checklist harian.
                            </strong>

                            <p>
                                Silakan input checklist terlebih dahulu.
                            </p>

                            <a
                                href="{{ route('teacher.checklist.create') }}"
                                class="btn btn-submit">
                                + Tambah Checklist
                            </a>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- ================= PAGINATION ================= --}}
        @if ($checklists->hasPages())

        <div class="checklist-pagination">
            {{ $checklists->links() }}
        </div>

        @endif

    </div>

</div>

@endsection