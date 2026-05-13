@extends('admin.layouts.app')

@section('content')

<div class="card-table">

    <!-- TOP -->
    <div class="d-flex justify-content-between align-items-start mb-4">

        <div>

            <a href="{{ route('admin.rekap.siswa') }}"
               class="btn btn-secondary mb-3">
                ← Kembali
            </a>

            <h2 class="title">
                Rekap Absensi Kelas A
            </h2>

            <p class="subtitle">
                Ringkasan kehadiran siswa kelas A berdasarkan periode.
            </p>

        </div>

        <!-- INFO FILTER -->
        <div class="d-flex gap-3 flex-wrap">

            <div class="filter-group">
                <label>Bulan</label>

                <input type="text"
                       class="form-control"
                       value="{{ date('F', mktime(0,0,0,$bulan,1)) }}"
                       readonly>
            </div>

            <div class="filter-group">
                <label>Tahun</label>

                <input type="text"
                       class="form-control"
                       value="{{ $tahun }}"
                       readonly>
            </div>

        </div>

    </div>

    <!-- CARD STATISTIK -->
    <div class="d-flex justify-content-center flex-wrap gap-4 mb-5">

        <div class="rekap-stat" style="width:180px;">
            <div class="rekap-stat-icon" style="background:#22c55e;">
                ✔
            </div>

            <h6>Hadir</h6>

            <h3>{{ $rekap['hadir'] ?? 0 }}</h3>
        </div>

        <div class="rekap-stat" style="width:180px;">
            <div class="rekap-stat-icon" style="background:#f59e0b;">
                📄
            </div>

            <h6>Izin</h6>

            <h3>{{ $rekap['izin'] ?? 0 }}</h3>
        </div>

        <div class="rekap-stat" style="width:180px;">
            <div class="rekap-stat-icon" style="background:#3b82f6;">
                💙
            </div>

            <h6>Sakit</h6>

            <h3>{{ $rekap['sakit'] ?? 0 }}</h3>
        </div>

        <div class="rekap-stat" style="width:180px;">
            <div class="rekap-stat-icon" style="background:#ef4444;">
                ✖
            </div>

            <h6>Alpha</h6>

            <h3>{{ $rekap['alpha'] ?? 0 }}</h3>
        </div>

        <div class="rekap-stat" style="width:180px;">
            <div class="rekap-stat-icon" style="background:#6b7280;">
                👥
            </div>

            <h6>Total</h6>

            <h3>{{ $rekap['total'] ?? 0 }}</h3>
        </div>

    </div>

    <!-- TABLE -->
    <h4 class="mb-3">
        Detail Rekap Siswa Kelas A
    </h4>

    <div class="table-wrap">

        <table class="table-custom">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>

                @forelse($data as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $item->student->name ?? '-' }}
                        </td>

                        <td>{{ $item->status }}</td>

                        <td>{{ $item->date }}</td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="table-empty">
                            Belum ada data absensi kelas A
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection