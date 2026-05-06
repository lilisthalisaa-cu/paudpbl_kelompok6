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
        </div>

        <!-- RIGHT FILTER -->
        <form method="GET" class="d-flex gap-3 align-items-end">

            <div class="filter-group">
                <label>Bulan</label>
                <select name="bulan" class="form-control filter-select-fix custom-select">
                    @for($i=1;$i<=12;$i++)
                        <option value="{{ $i }}">{{ date('F', mktime(0,0,0,$i,1)) }}</option>
                    @endfor
                </select>
            </div>

            <div class="filter-group">
                <label>Tahun</label>
                <select name="tahun" class="form-control filter-select-fix custom-select">
                    @for($i=date('Y');$i>=2020;$i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <button class="btn btn-success">Terapkan</button>

        </form>

    </div>

    <!-- CARD -->
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="rekap-stat">
                <div class="rekap-stat-icon icon-hadir">✔</div>
                <h6>Hadir</h6>
                <h3>{{ $rekap['hadir'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="rekap-stat">
                <div class="rekap-stat-icon icon-tidak">✖</div>
                <h6>Tidak Hadir</h6>
                <h3>{{ $rekap['tidak_hadir'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="rekap-stat">
                <div class="rekap-stat-icon icon-total">👥</div>
                <h6>Total</h6>
                <h3>{{ $rekap['total'] ?? 0 }}</h3>
            </div>
        </div>

    </div>

    <!-- TABLE -->
    <h5 class="mb-3">Detail Rekap Guru</h5>

    <div class="table-wrap">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Hadir</td>
                    <td>{{ $rekap['hadir'] ?? 0 }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Tidak Hadir</td>
                    <td>{{ $rekap['tidak_hadir'] ?? 0 }}</td>
                </tr>
                <tr class="table-total">
                    <td colspan="2"><b>Total</b></td>
                    <td><b>{{ $rekap['total'] ?? 0 }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@endsection