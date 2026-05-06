@extends('admin.layouts.app')

@section('content')

<div class="card-table">

    <!-- TOP -->
    <div class="d-flex justify-content-between align-items-start mb-4">

        <div>
            <a href="{{ route('admin.rekap.index') }}" class="btn btn-secondary mb-2">
                ← Kembali
            </a>

            <h2 class="title">Rekap Absensi Siswa</h2>
            <p class="subtitle">Ringkasan kehadiran siswa berdasarkan periode.</p>
        </div>

        <!-- FILTER -->
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

    <!-- CARD STATISTIK (FIX RAPI & CENTER) -->
    <div class="d-flex justify-content-center flex-wrap gap-4 mb-4">

        <div class="rekap-stat" style="width:180px;">
            <div class="rekap-stat-icon" style="background:#22c55e;">✔</div>
            <h6>Hadir</h6>
            <h3>{{ $rekap['hadir'] ?? 0 }}</h3>
        </div>

        <div class="rekap-stat" style="width:180px;">
            <div class="rekap-stat-icon" style="background:#f59e0b;">📄</div>
            <h6>Izin</h6>
            <h3>{{ $rekap['izin'] ?? 0 }}</h3>
        </div>

        <div class="rekap-stat" style="width:180px;">
            <div class="rekap-stat-icon" style="background:#3b82f6;">💙</div>
            <h6>Sakit</h6>
            <h3>{{ $rekap['sakit'] ?? 0 }}</h3>
        </div>

        <div class="rekap-stat" style="width:180px;">
            <div class="rekap-stat-icon" style="background:#ef4444;">✖</div>
            <h6>Alpha</h6>
            <h3>{{ $rekap['alpha'] ?? 0 }}</h3>
        </div>

        <div class="rekap-stat" style="width:180px;">
            <div class="rekap-stat-icon" style="background:#6b7280;">👥</div>
            <h6>Total</h6>
            <h3>{{ $rekap['total'] ?? 0 }}</h3>
        </div>

    </div>

    <!-- TABLE -->
    <h5 class="mb-3">Detail Rekap Siswa</h5>

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
                    <td>Izin</td>
                    <td>{{ $rekap['izin'] ?? 0 }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Sakit</td>
                    <td>{{ $rekap['sakit'] ?? 0 }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Alpha</td>
                    <td>{{ $rekap['alpha'] ?? 0 }}</td>
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