@extends('admin.layouts.app')

@section('content')

<div class="card-table rekap-guru-page">

    <!-- TOP -->
    <div class="top-section">

        <!-- LEFT -->
        <div>
            <a href="{{ route('admin.rekap.index') }}"
                class="btn-back-rekap mb-2">

                ← Kembali
            </a>

            <h2 class="title">Rekap Presensi Guru</h2>
            <p class="subtitle">Ringkasan kehadiran guru berdasarkan periode.</p>
            <p class="text-muted mb-0">
                Periode Rekap:
                <strong>
                    {{ \Carbon\Carbon::create()->month((int)$bulan)->translatedFormat('F') }}
                    {{ $tahun }}
                </strong>
            </p>
        </div>

        <!-- RIGHT FILTER -->
        <form method="GET" class="filter-form">

            <div class="filter-group">
                <label>Bulan</label>
                <select name="bulan" class="form-control filter-select-fix custom-select">
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
                <select name="tahun" class="form-control filter-select-fix custom-select">
                    @for($i=date('Y');$i>=2020;$i--)
                    <option value="{{ $i }}"
                        {{ request('tahun', date('Y')) == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                    @endfor
                </select>
            </div>

            <button class="btn-filter-rekap">
                Terapkan
            </button>

            <a href="{{ route('admin.rekap.guru.export', [
                'bulan' => request('bulan', date('m')),
                'tahun' => request('tahun', date('Y'))
            ]) }}"
            class="btn-export-rekap">
                Export Excel
            </a>

        </form>

    </div>


    <!-- TABLE -->
   <div class="d-flex justify-content-between align-items-center mb-3">

        <h5 class="card-title mb-0">
            Rekap Presensi Guru
        </h5>

        <input
            type="text"
            class="form-control search-guru"
            placeholder="Cari nama guru..."
        >

    </div>

    <div class="table-wrap modern-table">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Guru</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Cuti</th>
                    <th>Sakit</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($detailGuru as $index => $guru)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $guru->teacher->user->name ?? '-' }}</td>
                    <td>{{ $guru->hadir }}</td>
                    <td>{{ $guru->izin }}</td>
                    <td>{{ $guru->cuti }}</td>
                    <td>{{ $guru->sakit }}</td>
                    <td>{{ $guru->total }}</td>

                    <td>
                        <a href="{{ route('admin.rekap.guru.detail', $guru->teacher_id) }}"
                        class="btn-detail-rekap">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty-rekap">
                        Data rekap guru belum tersedia
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection