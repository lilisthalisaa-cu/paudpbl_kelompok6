@extends('admin.layouts.app')

@section('title', 'Kalender Akademik')

@section('content')
@php
    $today = now()->startOfDay();
    $totalCalendar = $calendars->count();
    $ongoingCalendar = 0;
    $upcomingCalendar = 0;
    $finishedCalendar = 0;

    foreach ($calendars as $item) {
        $start = \Carbon\Carbon::parse($item->start_date)->startOfDay();
        $end = $item->end_date
            ? \Carbon\Carbon::parse($item->end_date)->startOfDay()
            : $start;

        if ($start->gt($today)) {
            $upcomingCalendar++;
        } elseif ($end->lt($today)) {
            $finishedCalendar++;
        } else {
            $ongoingCalendar++;
        }
    }
@endphp

<div class="academic-index-page">

    <div class="academic-index-heading">
        <div>
            <h1>Kalender Akademik</h1>
            <p>Daftar seluruh kegiatan yang akan ditampilkan pada kalender akademik.</p>
        </div>

        <div class="academic-index-toolbar">
            <input type="text" id="calendarSearch"
                   placeholder="⌕ Cari nama kegiatan...">

            <select id="calendarCategory">
                <option value="">Semua Kategori</option>
                <option value="Kegiatan Sekolah">Kegiatan Sekolah</option>
                <option value="Kegiatan Siswa">Kegiatan Siswa</option>
                <option value="Pertemuan">Pertemuan</option>
                <option value="Hari Libur">Hari Libur</option>
            </select>

            <a href="{{ url('/admin/academic-calendars/create') }}"
               class="academic-add-button">
                <span>＋</span> Tambah Kegiatan
            </a>
        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="academic-stats-grid">
        <div class="academic-stat-card">
            <div class="academic-stat-icon icon-blue">▦</div>
            <div>
                <span>Total Kegiatan</span>
                <strong>{{ $totalCalendar }}</strong>
                <small>Seluruh kegiatan akademik</small>
            </div>
        </div>

        <div class="academic-stat-card">
            <div class="academic-stat-icon icon-green">◷</div>
            <div>
                <span>Kegiatan Berlangsung</span>
                <strong>{{ $ongoingCalendar }}</strong>
                <small>Sedang berlangsung</small>
            </div>
        </div>

        <div class="academic-stat-card">
            <div class="academic-stat-icon icon-orange">▦</div>
            <div>
                <span>Akan Datang</span>
                <strong>{{ $upcomingCalendar }}</strong>
                <small>Kegiatan mendatang</small>
            </div>
        </div>

        <div class="academic-stat-card">
            <div class="academic-stat-icon icon-red">✓</div>
            <div>
                <span>Selesai</span>
                <strong>{{ $finishedCalendar }}</strong>
                <small>Kegiatan telah selesai</small>
            </div>
        </div>
    </div>

    {{-- TABEL KEGIATAN --}}
    <div class="academic-table-card">
        <div class="academic-table-scroll">
            <table class="academic-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Kategori</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="calendarTableBody">
                    @forelse ($calendars as $calendar)
                        @php
                            $start = \Carbon\Carbon::parse($calendar->start_date)->startOfDay();
                            $end = $calendar->end_date
                                ? \Carbon\Carbon::parse($calendar->end_date)->startOfDay()
                                : $start;

                            if ($start->gt($today)) {
                                $status = 'Akan Datang';
                                $statusClass = 'status-upcoming';
                            } elseif ($end->lt($today)) {
                                $status = 'Selesai';
                                $statusClass = 'status-finished';
                            } else {
                                $status = 'Berlangsung';
                                $statusClass = 'status-ongoing';
                            }

                            $categoryClasses = [
                                'Kegiatan Sekolah' => 'category-school',
                                'Kegiatan Siswa' => 'category-student',
                                'Pertemuan' => 'category-meeting',
                                'Hari Libur' => 'category-holiday',
                            ];

                            $categoryClass = $categoryClasses[$calendar->category] ?? '';
                        @endphp

                        <tr class="calendar-row"
                            data-title="{{ strtolower($calendar->title) }}"
                            data-category="{{ $calendar->category }}">
                            <td>{{ $loop->iteration }}</td>

                            <td class="academic-name">
                                {{ $calendar->title }}
                            </td>

                            <td>
                                <span class="academic-category {{ $categoryClass }}">
                                    {{ $calendar->category }}
                                </span>
                            </td>

                            <td>{{ $start->format('d M Y') }}</td>

                            <td>
                                {{ $calendar->end_date ? $end->format('d M Y') : '—' }}
                            </td>

                            <td>
                                <span class="academic-status {{ $statusClass }}">
                                    {{ $status }}
                                </span>
                            </td>

                            <td class="academic-description"
                                title="{{ $calendar->description }}">
                                {{ $calendar->description ?: '—' }}
                            </td>

                            <td>
                                <div class="academic-action-buttons">
                                    <a href="{{ url('/admin/academic-calendars/'.$calendar->id) }}"
                                       class="academic-action view"
                                       title="Detail">⌕</a>

                                    <a href="{{ url('/admin/academic-calendars/'.$calendar->id.'/edit') }}"
                                       class="academic-action edit"
                                       title="Edit">✎</a>

                                    <form action="{{ url('/admin/academic-calendars/'.$calendar->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="academic-action delete"
                                                title="Hapus">×</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="calendarEmptyRow">
                            <td colspan="8" class="academic-empty">
                                Belum ada kegiatan kalender akademik.
                            </td>
                        </tr>
                    @endforelse

                    <tr id="calendarNoResult" style="display: none;">
                        <td colspan="8" class="academic-empty">
                            Tidak ada kegiatan yang sesuai dengan pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="academic-table-footer">
            <span id="calendarCount">
                Menampilkan {{ $totalCalendar }} dari {{ $totalCalendar }} data
            </span>
        </div>
    </div>

</div>

{{-- PENCARIAN DAN FILTER KATEGORI --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('calendarSearch');
    const category = document.getElementById('calendarCategory');
    const rows = Array.from(document.querySelectorAll('.calendar-row'));
    const count = document.getElementById('calendarCount');
    const noResult = document.getElementById('calendarNoResult');

    function filterCalendars() {
        const keyword = search.value.trim().toLowerCase();
        const selectedCategory = category.value;
        let visibleCount = 0;

        rows.forEach(function (row) {
            const matchesSearch =
                (row.dataset.title || '').includes(keyword);

            const matchesCategory =
                selectedCategory === '' ||
                row.dataset.category === selectedCategory;

            const visible = matchesSearch && matchesCategory;
            row.style.display = visible ? '' : 'none';

            if (visible) {
                visibleCount++;
                row.cells[0].textContent = visibleCount;
            }
        });

        count.textContent =
            'Menampilkan ' + visibleCount + ' dari ' + rows.length + ' data';

        noResult.style.display =
            visibleCount === 0 && rows.length > 0 ? '' : 'none';
    }

    search.addEventListener('input', filterCalendars);
    category.addEventListener('change', filterCalendars);
});
</script>
@endsection