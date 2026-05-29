@extends('admin.layouts.app')

@section('content')

<div class="card-table rekap-siswa-detail-page">

    <!-- TOP -->
    <div class="top-section">

        <!-- LEFT -->
        <div>

            <a href="{{ route('admin.rekap.siswa') }}"
               class="btn-back-rekap mb-3">

                ← Kembali

            </a>

            <h2 class="title">
                Detail Presensi Siswa
            </h2>

            <p class="subtitle mb-1">
                Riwayat presensi siswa berdasarkan periode.
            </p>

            <p class="text-muted mb-0">

                <strong>
                    {{ $data->first()->student->name ?? '-' }}
                </strong>

                •

                {{ $kelasData->name ?? '-' }}

                •

                {{ \Carbon\Carbon::create()->month((int)$bulan)->translatedFormat('F') }}

                {{ $tahun }}

            </p>

        </div>

        <!-- FILTER -->
        <form method="GET" class="filter-form">

            <input type="hidden" name="bulan" value="{{ $bulan }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">
            <input type="hidden" name="kelas" value="{{ $kelas }}">

            <div class="filter-group">

                <label>Status</label>

                <select
                    name="status"
                    onchange="this.form.submit()"
                    class="form-control filter-select-fix custom-select">

                    <option value="">Semua</option>

                    <option value="hadir"
                        {{ request('status') == 'hadir' ? 'selected' : '' }}>
                        Hadir
                    </option>

                    <option value="izin"
                        {{ request('status') == 'izin' ? 'selected' : '' }}>
                        Izin
                    </option>

                    <option value="sakit"
                        {{ request('status') == 'sakit' ? 'selected' : '' }}>
                        Sakit
                    </option>

                    <option value="alpha"
                        {{ request('status') == 'alpha' ? 'selected' : '' }}>
                        Alpha
                    </option>

                </select>

            </div>

        </form>

    </div>

    <!-- TABLE -->
    <div class="table-wrap">

        <table class="table-custom">

            <thead>

                <tr>

                    <th>Tanggal</th>
                    <th>Hari</th>
                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                @forelse($data as $item)

                <tr>

                    <td>
                        {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->date)->translatedFormat('l') }}
                    </td>

                    <td>

                        <span class="badge-status
                            @if(strtolower($item->status) == 'hadir')
                                badge-hadir
                            @elseif(strtolower($item->status) == 'izin')
                                badge-izin
                            @elseif(strtolower($item->status) == 'sakit')
                                badge-sakit
                            @else
                                badge-alpha
                            @endif
                        ">

                            {{ ucfirst(strtolower($item->status)) }}

                        </span>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3" class="empty-rekap">

                        Belum ada data presensi pada periode ini.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection