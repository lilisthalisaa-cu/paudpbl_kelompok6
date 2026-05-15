@extends('admin.layouts.app')

@section('content')

<div class="card-table rekap-siswa-page">

    <!-- TOP -->
    <div class="top-section">

        <!-- LEFT -->
        <div>

            <a href="{{ route('admin.rekap.index') }}"
               class="btn-back-rekap">

                ← Kembali

            </a>

            <h2 class="title">
                Rekap Presensi Siswa
            </h2>

            <p class="subtitle mb-1">
                Ringkasan presensi siswa berdasarkan kelas dan periode.
            </p>

            <p class="text-muted mb-0">

                Periode Rekap:

                <strong>

                    {{ \Carbon\Carbon::create()->month((int)$bulan)->translatedFormat('F') }}
                    {{ $tahun }}

                </strong>

            </p>

        </div>

        <!-- FILTER -->
        <form method="GET" class="filter-form">

            <div class="filter-group">

                <label>Bulan</label>

                <select
                    name="bulan"
                    class="form-control filter-select-fix custom-select">

                    @for($i=1;$i<=12;$i++)

                        <option value="{{ $i }}"
                            {{ request('bulan', date('m')) == $i ? 'selected' : '' }}>

                            {{ \Carbon\Carbon::create()->month((int)$i)->translatedFormat('F') }}

                        </option>

                    @endfor

                </select>

            </div>

            <div class="filter-group">

                <label>Tahun</label>

                <select
                    name="tahun"
                    class="form-control filter-select-fix custom-select">

                    @for($i=date('Y');$i>=2020;$i--)

                        <option value="{{ $i }}"
                            {{ request('tahun', date('Y')) == $i ? 'selected' : '' }}>

                            {{ $i }}

                        </option>

                    @endfor

                </select>

            </div>

            <div class="filter-group">

                <label>Kelas</label>

                <select
                    name="kelas"
                    class="form-control filter-select-fix custom-select">

                    @foreach($classes as $class)

                        <option value="{{ $class->id }}"
                            {{ request('kelas') == $class->id ? 'selected' : '' }}>

                            {{ $class->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <button class="btn-filter-rekap">
                Terapkan
            </button>

        </form>

    </div>

    <!-- TABLE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="card-title mb-0">
            Rekap Presensi Siswa
        </h5>

        <input
            type="text"
            class="form-control search-siswa"
            placeholder="Cari nama siswa..."
        >

    </div>

    <!-- TABLE -->
    <div class="table-wrap modern-table">

        <table class="table-custom">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alpha</th>
                    <th>Total</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($detailSiswa as $index => $siswa)

                <tr>

                    <td>{{ $index + 1 }}</td>

                    <td>
                        {{ $siswa->student->name ?? '-' }}
                    </td>

                    <td>{{ $siswa->hadir }}</td>

                    <td>{{ $siswa->izin }}</td>

                    <td>{{ $siswa->sakit }}</td>

                    <td>{{ $siswa->alpha }}</td>

                    <td>{{ $siswa->total }}</td>

                    <td>

                        <a href="{{ route('admin.rekap.siswa.detail', [
                            'id' => $siswa->student_id,
                            'bulan' => request('bulan'),
                            'tahun' => request('tahun'),
                            'kelas' => request('kelas')
                        ]) }}"
                        class="btn-detail-rekap">

                            Detail

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" class="empty-rekap">

                        Belum ada data presensi pada periode ini.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
