
@extends('admin.layouts.app')

@section('title', 'Edit Kegiatan')

@section('content')
<div class="academic-form-page">

    <div class="academic-form-breadcrumb">
        <a href="{{ url('/admin/dashboard') }}">⌂</a>
        <span>/</span>
        <a href="{{ url('/admin/academic-calendars') }}">Kalender Akademik</a>
        <span>/</span>
        <span>Edit Kegiatan</span>
    </div>

    <div class="academic-form-heading">
        <div class="academic-form-heading-icon">✎</div>
        <div>
            <h1>Edit Kegiatan</h1>
            <p>Ubah informasi kegiatan pada kalender akademik.</p>
        </div>
    </div>

    <form action="{{ url('/admin/academic-calendars/' . $academicCalendar->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="academic-form-layout">

            <div class="academic-form-main">
                <div class="academic-form-card">

                    <div class="academic-form-group">
                        <label for="title">Nama Kegiatan <span>*</span></label>
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title', $academicCalendar->title) }}"
                               placeholder="Masukkan nama kegiatan"
                               required>
                        @error('title')
                            <small class="academic-form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="academic-form-group">
                        <label for="category">Kategori <span>*</span></label>
                        <select id="category" name="category" required>
                            <option value="">Pilih kategori kegiatan</option>
                            <option value="Kegiatan Sekolah" {{ old('category', $academicCalendar->category) == 'Kegiatan Sekolah' ? 'selected' : '' }}>Kegiatan Sekolah</option>
                            <option value="Kegiatan Siswa" {{ old('category', $academicCalendar->category) == 'Kegiatan Siswa' ? 'selected' : '' }}>Kegiatan Siswa</option>
                            <option value="Pertemuan" {{ old('category', $academicCalendar->category) == 'Pertemuan' ? 'selected' : '' }}>Pertemuan</option>
                            <option value="Hari Libur" {{ old('category', $academicCalendar->category) == 'Hari Libur' ? 'selected' : '' }}>Hari Libur</option>
                        </select>
                        @error('category')
                            <small class="academic-form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="academic-form-row">
                        <div class="academic-form-group">
                            <label for="start_date">Tanggal Mulai <span>*</span></label>
                            <input type="date"
                                   id="start_date"
                                   name="start_date"
                                   value="{{ old('start_date', $academicCalendar->start_date?->format('Y-m-d')) }}"
                                   required>
                            @error('start_date')
                                <small class="academic-form-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="academic-form-group">
                            <label for="end_date">Tanggal Selesai (Opsional)</label>
                            <input type="date"
                                   id="end_date"
                                   name="end_date"
                                   value="{{ old('end_date', $academicCalendar->end_date?->format('Y-m-d')) }}">
                            @error('end_date')
                                <small class="academic-form-error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="academic-form-group">
                        <label for="description">Deskripsi / Keterangan (Opsional)</label>
                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  placeholder="Tuliskan detail kegiatan...">{{ old('description', $academicCalendar->description) }}</textarea>
                        @error('description')
                            <small class="academic-form-error">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="academic-form-actions">
                    <a href="{{ url('/admin/academic-calendars') }}"
                       class="academic-btn-cancel">Batal</a>

                    <button type="submit" class="academic-btn-save">
                        <span>▣</span> Update Kegiatan
                    </button>
                </div>
            </div>

            <aside class="academic-form-sidebar">

                <div class="academic-calendar-illustration">
                    <div class="academic-calendar-art">🗓️</div>
                    <div class="academic-plant plant-left">🌿</div>
                    <div class="academic-plant plant-right">🌱</div>
                </div>

                <div class="academic-tips-card academic-tips-info">
                    <h3><span>ℹ️</span> Perhatian</h3>
                    <ul>
                        <li>Pastikan informasi kegiatan sudah benar.</li>
                        <li>Perubahan akan memengaruhi informasi kalender akademik.</li>
                        <li>Orang tua dapat melihat informasi kegiatan yang telah diperbarui.</li>
                    </ul>
                </div>

            </aside>

        </div>
    </form>
</div>
@endsection
