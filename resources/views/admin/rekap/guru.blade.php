@extends('admin.layouts.app')

@section('content')

<div class="card-table">

    <!-- TOP -->
    <div class="d-flex justify-content-between align-items-start mb-4">

        <!-- LEFT -->
        <div>
            <a href="{{ route('admin.rekap.index') }}" class="btn btn-secondary mb-2">
                ← Kembali
            </a>

            <h2 class="title">Rekap Presensi Guru</h2>
            <p class="subtitle">Ringkasan kehadiran guru berdasarkan periode.</p>
            <p class="text-muted mb-0">
                Periode Rekap:
                <strong>
                    {{ date('F', mktime(0,0,0,$bulan,1)) }} {{ $tahun }}
                </strong>
            </p>
        </div>

        <!-- RIGHT FILTER -->
        <form method="GET" class="d-flex gap-3 align-items-end">

            <div class="filter-group">
                <label>Bulan</label>
                <select name="bulan" class="form-control filter-select-fix custom-select">
                    @for($i=1;$i<=12;$i++)
                        <option value="{{ $i }}"
                        {{ request('bulan', date('m')) == $i ? 'selected' : '' }}>
                        {{ date('F', mktime(0,0,0,$i,1)) }}
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

            <button class="btn btn-success">Terapkan</button>

            <a href="{{ route('admin.rekap.guru.export', [
                'bulan' => request('bulan', date('m')),
                'tahun' => request('tahun', date('Y'))
            ]) }}"
            class="btn btn-primary">
                Export Excel
            </a>

        </form>

    </div>

    <!-- CARD -->
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="rekap-stat">
                <div class="rekap-stat-icon icon-hadir">✔</div>
                <h6>Hadir</h6>
                <h3>{{ $summary->hadir ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="rekap-stat">
                <div class="rekap-stat-icon icon-izin">📝</div>
                <h6>Izin</h6>
                <h3>{{ $summary->izin ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="rekap-stat">
                <div class="rekap-stat-icon icon-cuti">📅</div>
                <h6>Cuti</h6>
                <h3>{{ $summary->cuti ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="rekap-stat">
                <div class="rekap-stat-icon icon-sakit">🤒</div>
                <h6>Sakit</h6>
                <h3>{{ $summary->sakit ?? 0 }}</h3>
            </div>
        </div>

    </div>

    <!-- TABLE -->
   <h5 class="card-title">Detail Rekap Guru</h5>

    <div class="table-wrap">
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
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">
                        Data rekap guru belum tersedia
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection