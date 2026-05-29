@extends('admin.layouts.app')

@section('content')

<div class="card-table rekap-guru-page">

    <!-- TOP -->
    <div class="top-section">

        <!-- LEFT -->
        <div>

            <a href="{{ route('admin.rekap.guru') }}"
               class="btn-back-rekap mb-3">

                ← Kembali

            </a>

            <h2 class="title">
                Detail Presensi Guru
            </h2>

            <p class="subtitle mb-1">
                Riwayat presensi guru berdasarkan periode.
            </p>

            <p class="text-muted mb-0">

                <strong>
                    {{ $guru->teacher->user->name ?? '-' }}
                </strong>

                •

                {{ \Carbon\Carbon::create()->month((int)$bulan)->translatedFormat('F') }}

                {{ $tahun }}

            </p>

        </div>

        <!-- FILTER -->
        <form method="GET" class="filter-form">

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

                    <option value="cuti"
                        {{ request('status') == 'cuti' ? 'selected' : '' }}>
                        Cuti
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
                    <th>Catatan</th>
                    <th>Surat</th>
                </tr>
            </thead>

            <tbody>

                @forelse($presensi as $item)

                <tr>

                    <td>
                        {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->date)->translatedFormat('l') }}
                    </td>

                    <td>

                        <span class="badge-status badge-{{ strtolower($item->status) }}">

                            {{ ucfirst(strtolower($item->status)) }}

                        </span>

                    </td>

                    <td>
                        {{ $item->note ?? '-' }}
                    </td>

                    <td>

                        @if($item->surat)

                            <a href="{{ route('admin.rekap.guru.surat', $item->id) }}"
                               target="_blank"
                               class="link-surat">

                                📄 Lihat Surat

                            </a>

                        @else
                            -
                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="empty-rekap">

                        Belum ada data presensi pada periode ini.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection

