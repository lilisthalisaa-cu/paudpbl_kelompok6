@extends('teacher.layouts.app')

@section('title', 'Input Checklist Harian')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/teacher.css') }}">
@endpush

@section('content')
@php
$objectives = [
1 => [
'objective' => 'Anak mengenal doa sebelum bepergian',
'context' => 'Mengajak anak membaca doa sebelum bepergian bersama-sama.',
],
2 => [
'objective' => 'Anak berhitung sederhana jumlah benda/objek di tempat rekreasi (jumlah pohon, hewan).',
'context' => 'Menunjukkan gambar atau mainan hewan dan menyebutkan namanya.',
],
3 => [
'objective' => 'Anak percaya diri menceritakan pengalaman rekreasinya',
'context' => 'Membacakan buku cerita “Pergi ke Kebun Binatang” dengan gambar menarik.',
],
4 => [
'objective' => 'Anak mencoba aktivitas seni seperti menggambar atau mewarnai tempat rekreasi',
'context' => 'Anak mewarnai gambar hewan favorit mereka, seperti gajah atau singa.',
],
];

$theme = 'REKREASI (1)';
$students = $students->values();
@endphp

<div class="daily-checklist">
    <div class="dc-panel">


        {{-- HEADER --}}
        <header class="dc-heading">
            <div class="dc-icon">📋</div>
            <div>
                <h1>Input Checklist Harian</h1>
                <p>Isi status perkembangan siswa untuk kegiatan hari ini.</p>
            </div>
        </header>

        {{-- TAB INPUT DAN DAFTAR CHECKLIST --}}
        <div class="dc-mini-tabs">
            <a href="{{ route('teacher.checklist.create') }}" class="active">
                Input Checklist
            </a>

            <a href="{{ route('teacher.checklist.index') }}">
                Daftar Checklist
            </a>
        </div>


        {{-- VALIDASI --}}
        @if ($errors->any())
        <div class="dc-alert">
            <strong>Periksa kembali data berikut:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- INFORMASI TANGGAL, TEMA, DAN KELAS --}}
        <section class="dc-summary">
            <div class="dc-summary-item">
                <span class="dc-summary-icon">▦</span>
                <div>
                    <small>Tanggal</small>
                    <strong>{{ now()->translatedFormat('l, d F Y') }}</strong>
                </div>
            </div>

            <div class="dc-summary-item">
                <span class="dc-summary-icon">▤</span>
                <div>
                    <small>Tema</small>
                    <strong>{{ $theme }}</strong>
                </div>
            </div>

            <div class="dc-summary-item">
                <span class="dc-summary-icon">♧</span>
                <div>
                    <small>Kelas</small>
                    <strong>{{ $teacher->schoolClass->name ?? $teacher->school_class_id }}</strong>
                </div>
            </div>
        </section>

        <form id="dailyChecklistForm" action="{{ route('teacher.checklist.store') }}" method="POST">
            @csrf

            <input type="hidden" name="date" value="{{ now()->toDateString() }}">
            <input type="hidden" name="theme" value="{{ $theme }}">

            {{-- PILIH TUJUAN PEMBELAJARAN SAJA --}}
            <section class="dc-filter dc-filter-single">
                <div class="dc-field">
                    <label for="objectiveSelect">Pilih Tujuan Pembelajaran</label>
                    <select id="objectiveSelect">
                        @foreach ($objectives as $id => $item)
                        <option value="{{ $id }}">
                            {{ $id }}. {{ $item['objective'] }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </section>

            {{-- INFORMASI TUJUAN DAN KONTEKS OTOMATIS --}}
            <section class="dc-info">
                <div class="dc-info-item">
                    <span class="dc-info-icon">◎</span>
                    <div>
                        <strong>Tujuan Pembelajaran</strong>
                        <p id="objectiveText">{{ $objectives[1]['objective'] }}</p>
                    </div>
                </div>

                <div class="dc-info-item">
                    <span class="dc-info-icon">▤</span>
                    <div>
                        <strong>Konteks Kegiatan</strong>
                        <p id="contextText">{{ $objectives[1]['context'] }}</p>
                    </div>
                </div>
            </section>

            {{-- DAFTAR SISWA --}}
            <section class="dc-students">
                <div class="dc-list-heading">
                    <div class="dc-list-title">
                        <span class="dc-student-icon">♧</span>
                        <h2>
                            Daftar Siswa
                            <span>({{ $students->count() }} siswa)</span>
                        </h2>
                    </div>

                    <div class="dc-list-tools">
                        <div class="dc-search-wrap">
                            <span>⌕</span>
                            <input type="search" id="studentSearch" placeholder="Cari nama siswa..."
                                aria-label="Cari nama siswa">
                        </div>

                        <label for="perPage">Tampilkan</label>
                        <select id="perPage" class="dc-per-page">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="99999">Semua</option>
                        </select>
                        <span>siswa</span>
                    </div>
                </div>

                <div class="dc-table-wrap">
                    <table class="dc-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th class="dc-status-heading" colspan="2">
                                    Status Perkembangan
                                </th>
                            </tr>
                        </thead>

                        @foreach ($objectives as $objectiveId => $item)
                        <tbody class="dc-objective-body" data-objective="{{ $objectiveId }}" @if ($objectiveId !==1)
                            hidden @endif>
                            @forelse ($students as $index => $student)
                            <tr class="dc-student-row" data-name="{{ strtolower($student->name) }}">
                                <td class="dc-row-number">
                                    {{ $index + 1 }}
                                </td>

                                <td class="dc-student-name">
                                    {{ $student->name }}

                                    <input type="hidden" name="checklists[{{ $index }}][student_id]"
                                        value="{{ $student->id }}">

                                    <input type="hidden"
                                        name="checklists[{{ $index }}][objectives][{{ $objectiveId }}][learning_objective]"
                                        value="{{ $item['objective'] }}">

                                    <input type="hidden"
                                        name="checklists[{{ $index }}][objectives][{{ $objectiveId }}][context]"
                                        value="{{ $item['context'] }}">
                                </td>

                                <td>
                                    <label class="dc-radio">
                                        <input type="radio"
                                            name="checklists[{{ $index }}][objectives][{{ $objectiveId }}][status]"
                                            value="SM"
                                            @checked(old("checklists.$index.objectives.$objectiveId.status")==='SM' )>
                                        <span>SM</span>
                                    </label>
                                </td>

                                <td>
                                    <label class="dc-radio">
                                        <input type="radio"
                                            name="checklists[{{ $index }}][objectives][{{ $objectiveId }}][status]"
                                            value="BM"
                                            @checked(old("checklists.$index.objectives.$objectiveId.status")==='BM' )>
                                        <span>BM</span>
                                    </label>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="dc-empty">
                                    Belum ada siswa pada kelas ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        @endforeach
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="dc-pagination">
                    <div class="dc-pages" id="pagination"></div>
                    <span id="pageInfo" aria-live="polite"></span>
                </div>
            </section>

            {{-- SATU KETERANGAN UNTUK SEMUA SISWA --}}
            <section class="dc-notes">
                <div class="dc-notes-description">
                    <span class="dc-notes-icon">▤</span>
                    <div>
                        <h3>Keterangan Kegiatan (untuk semua siswa)</h3>
                        <p>Catatan kegiatan yang berlaku untuk seluruh siswa hari ini.</p>
                    </div>
                </div>

                <div class="dc-notes-input">
                    <textarea id="sharedNotes" name="notes" rows="3" maxlength="500"
                        placeholder="Tulis keterangan kegiatan...">{{ old('notes') }}</textarea>

                    <div class="dc-counter">
                        <span id="notesCount">{{ strlen(old('notes', '')) }}</span>/500
                    </div>
                </div>
            </section>

            {{-- TOMBOL --}}
            <div class="dc-actions">
                <button type="reset" class="dc-btn dc-reset">
                    <span>↻</span>
                    Reset Semua
                </button>

                <button type="submit" class="dc-btn dc-save">
                    <span>▣</span>
                    Simpan Checklist
                </button>
            </div>
        </form>
    </div>
</div>

<script type="application/json" id="objectiveData">
@json($objectives)
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const objectiveSelect = document.getElementById('objectiveSelect');
    const objectiveText = document.getElementById('objectiveText');
    const contextText = document.getElementById('contextText');
    const bodies = Array.from(document.querySelectorAll('.dc-objective-body'));
    const search = document.getElementById('studentSearch');
    const perPage = document.getElementById('perPage');
    const pagination = document.getElementById('pagination');
    const pageInfo = document.getElementById('pageInfo');
    const notes = document.getElementById('sharedNotes');
    const notesCount = document.getElementById('notesCount');
    const form = document.getElementById('dailyChecklistForm');

    const objectives = JSON.parse(
        document.getElementById('objectiveData').textContent
    );

    let currentPage = 1;

    function renderStudents() {
        const activeBody = bodies.find(
            body => body.dataset.objective === objectiveSelect.value
        );

        if (!activeBody) return;

        const rows = Array.from(
            activeBody.querySelectorAll('.dc-student-row')
        );

        const keyword = search.value.trim().toLowerCase();

        const filteredRows = rows.filter(row =>
            row.dataset.name.includes(keyword)
        );

        const limit = Number(perPage.value);
        const totalPages = Math.max(
            1,
            Math.ceil(filteredRows.length / limit)
        );

        currentPage = Math.min(currentPage, totalPages);

        rows.forEach(row => {
            row.hidden = true;
        });

        filteredRows.forEach((row, index) => {
            row.querySelector('.dc-row-number').textContent = index + 1;

            row.hidden = !(
                index >= (currentPage - 1) * limit &&
                index < currentPage * limit
            );
        });

        pagination.innerHTML = '';

        function addPage(label, page, active = false, disabled = false) {
            const button = document.createElement('button');

            button.type = 'button';
            button.className = 'dc-page-btn' + (active ? ' active' : '');
            button.textContent = label;
            button.disabled = disabled;

            button.addEventListener('click', function() {
                currentPage = page;
                renderStudents();
            });

            pagination.appendChild(button);
        }

        addPage('‹', Math.max(1, currentPage - 1), false, currentPage === 1);

        for (let page = 1; page <= totalPages; page++) {
            addPage(String(page), page, page === currentPage);
        }

        addPage(
            '›',
            Math.min(totalPages, currentPage + 1),
            false,
            currentPage === totalPages
        );

        const start = filteredRows.length ?
            (currentPage - 1) * limit + 1 :
            0;

        const end = Math.min(currentPage * limit, filteredRows.length);

        pageInfo.textContent =
            `${start}–${end} dari ${filteredRows.length} siswa`;
    }

    function changeObjective(id) {
        const item = objectives[id];

        if (!item) return;

        objectiveSelect.value = String(id);
        objectiveText.textContent = item.objective;
        contextText.textContent = item.context;

        bodies.forEach(body => {
            body.hidden = body.dataset.objective !== String(id);
        });

        currentPage = 1;
        renderStudents();
    }

    objectiveSelect.addEventListener('change', function() {
        changeObjective(this.value);
    });

    search.addEventListener('input', function() {
        currentPage = 1;
        renderStudents();
    });

    perPage.addEventListener('change', function() {
        currentPage = 1;
        renderStudents();
    });

    notes.addEventListener('input', function() {
        notesCount.textContent = this.value.length;
    });

    form.addEventListener('reset', function() {
        setTimeout(function() {
            search.value = '';
            perPage.value = '10';
            currentPage = 1;
            changeObjective('1');
            notesCount.textContent = notes.value.length;
        }, 0);
    });

    form.addEventListener('submit', function(event) {
        const activeBody = bodies.find(
            body => body.dataset.objective === objectiveSelect.value
        );

        if (!activeBody) return;

        const incomplete = Array.from(
            activeBody.querySelectorAll('.dc-student-row')
        ).some(row => !row.querySelector('input[type="radio"]:checked'));

        if (incomplete) {
            event.preventDefault();

            alert(
                'Status SM/BM belum lengkap untuk semua siswa pada tujuan pembelajaran yang dipilih.'
            );
        }
    });

    changeObjective('1');
});
</script>
@endsection