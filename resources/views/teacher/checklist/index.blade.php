@extends('teacher.layouts.app')

@section('content')
<div class="checklist-page">

    {{-- HEADER --}}
    <div class="checklist-page-header">
        <div class="checklist-page-icon">📋</div>
        <div>
            <h1>Daftar Checklist Harian</h1>
            <p>Data hasil pengamatan perkembangan anak yang sudah disimpan.</p>
        </div>
    </div>

        {{-- TOMBOL KEMBALI KE INPUT CHECKLIST --}}
    <div class="checklist-back-action">
        <a href="{{ route('teacher.checklist.create') }}"
           class="checklist-back-button">
            &larr; Kembali ke Input Checklist
        </a>
    </div>

    {{-- FILTER --}}
    <div class="checklist-filter">
        <form method="GET"
              action="{{ route('teacher.checklist.index') }}"
              class="checklist-filter-form">

            <div class="filter-field">
                <label for="tanggal">Tanggal</label>
                <input type="date"
                       id="tanggal"
                       name="date"
                       value="{{ request('date') }}">
            </div>

            <div class="filter-field">
                <label for="tema">Tema</label>
                <input type="text"
                       id="tema"
                       name="theme"
                       placeholder="Cari tema..."
                       value="{{ request('theme') }}">
            </div>

            <div class="filter-field">
                <label for="siswa">Cari Siswa</label>
                <input type="text"
                       id="siswa"
                       name="student"
                       placeholder="Cari nama siswa..."
                       value="{{ request('student') }}">
            </div>

            <button type="submit" class="btn-search">
                🔍 Cari
            </button>

            <a href="{{ route('teacher.checklist.index') }}"
               class="btn-reset">
                Reset
            </a>

        </form>
    </div>

    {{-- TABEL DAFTAR CHECKLIST --}}
    <div class="checklist-table-card">

        <div class="checklist-table-heading">
            <h2>Daftar Checklist Harian</h2>
            <p>Detail hasil checklist siswa per hari, tema, dan tujuan pembelajaran.</p>
        </div>

        <div class="checklist-table-wrapper">
            <table class="checklist-result-table">

                <thead>
                    <tr>
                        <th rowspan="2" class="col-no">No</th>
                        <th rowspan="2" class="col-student">Nama Siswa</th>

                        <th colspan="2" class="objective objective-1">
                            1. Anak mengenal doa sebelum bepergian
                        </th>

                        <th colspan="2" class="objective objective-2">
                            2. Anak berhitung sederhana jumlah benda/objek
                            di tempat rekreasi
                        </th>

                        <th colspan="2" class="objective objective-3">
                            3. Anak percaya diri menceritakan pengalaman
                            rekreasinya
                        </th>

                        <th colspan="2" class="objective objective-4">
                            4. Anak mencoba aktivitas seni seperti
                            menggambar atau mewarnai
                        </th>

                        <th rowspan="2" class="col-notes">Keterangan</th>
                        <th rowspan="2" class="col-action">Aksi</th>
                    </tr>

                    <tr>
                        <th class="objective-1">Konteks Kegiatan</th>
                        <th class="objective-1 col-status">Nilai</th>

                        <th class="objective-2">Konteks Kegiatan</th>
                        <th class="objective-2 col-status">Nilai</th>

                        <th class="objective-3">Konteks Kegiatan</th>
                        <th class="objective-3 col-status">Nilai</th>

                        <th class="objective-4">Konteks Kegiatan</th>
                        <th class="objective-4 col-status">Nilai</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($checklists as $checklist)
                    <tr>
                        {{-- NOMOR --}}
                        <td class="text-center">
                            {{ $checklists->firstItem()
                                ? $checklists->firstItem() + $loop->index
                                : $loop->iteration }}
                        </td>

                        {{-- NAMA SISWA --}}
                        <td class="student-name">
                            {{ $checklist->student->name ?? '-' }}
                        </td>

                        {{-- TUJUAN PEMBELAJARAN 1 --}}
                        <td>
                            {{ $checklist->context ?? '-' }}
                        </td>

                        <td class="text-center">
                            @if (($checklist->status ?? '') === 'SM')
                                <span class="status-badge status-sm">SM</span>
                            @elseif (($checklist->status ?? '') === 'BM')
                                <span class="status-badge status-bm">BM</span>
                            @else
                                -
                            @endif
                        </td>

                        {{-- TUJUAN PEMBELAJARAN 2 --}}
                        <td>-</td>
                        <td class="text-center">-</td>

                        {{-- TUJUAN PEMBELAJARAN 3 --}}
                        <td>-</td>
                        <td class="text-center">-</td>

                        {{-- TUJUAN PEMBELAJARAN 4 --}}
                        <td>-</td>
                        <td class="text-center">-</td>

                        {{-- KETERANGAN --}}
                        <td>
                            {{ $checklist->notes ?? '-' }}
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <div class="checklist-actions">
                                <a href="{{ route(
                                    'teacher.checklist.show',
                                    $checklist->checklist_id
                                ) }}"
                                   class="btn-action btn-view"
                                   title="Lihat detail">
                                    Lihat
                                </a>
                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="12" class="empty-data">
                            Belum ada data checklist yang tersimpan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- FOOTER DAN PAGINATION --}}
        <div class="checklist-table-footer">
            <span>
                Menampilkan {{ $checklists->count() }} data checklist
            </span>

            @if (method_exists($checklists, 'links'))
                <div class="checklist-pagination">
                    {{ $checklists->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
