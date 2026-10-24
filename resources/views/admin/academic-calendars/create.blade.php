@extends('admin.layouts.app')

@section('title', 'Tambah Kegiatan')

@section('content')
<div class="academic-form-page">

    <div class="academic-form-breadcrumb">
        <a href="{{ url('/admin/dashboard') }}">⌂</a>
        <span>/</span>
        <a href="{{ url('/admin/academic-calendars') }}">Kalender Akademik</a>
        <span>/</span>
        <span>Tambah Kegiatan</span>
    </div>

    <div class="academic-form-heading">
        <div class="academic-form-heading-icon">▦</div>
        <div>
            <h1>Tambah Kegiatan</h1>
            <p>Isi informasi kegiatan yang akan ditampilkan pada kalender akademik.</p>
        </div>
    </div>

    <form action="{{ route('admin.academic-calendars.store') }}"
          method="POST">
        @csrf

        <div class="academic-form-layout">

            <div class="academic-form-main">

                <div class="academic-form-card">

                    <div class="academic-form-group">
                        <label for="title">Nama Kegiatan <span>*</span></label>
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               placeholder="Contoh: Pengenalan Lingkungan Sekolah"
                               required>
                        @error('title')
                            <small class="academic-form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="academic-form-group">
                        <label for="category">Kategori <span>*</span></label>
                        <select id="category" name="category" required>
                            <option value="">Pilih kategori kegiatan</option>
                            <option value="Kegiatan Sekolah" {{ old('category') == 'Kegiatan Sekolah' ? 'selected' : '' }}>Kegiatan Sekolah</option>
                            <option value="Kegiatan Siswa" {{ old('category') == 'Kegiatan Siswa' ? 'selected' : '' }}>Kegiatan Siswa</option>
                            <option value="Pertemuan" {{ old('category') == 'Pertemuan' ? 'selected' : '' }}>Pertemuan</option>
                            <option value="Hari Libur" {{ old('category') == 'Hari Libur' ? 'selected' : '' }}>Hari Libur</option>
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
                                   value="{{ old('start_date') }}"
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
                                   value="{{ old('end_date') }}">
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
                                  placeholder="Tuliskan detail kegiatan...">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="academic-form-error">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="academic-form-actions">
                    <a href="{{ url('/admin/academic-calendars') }}"
                       class="academic-btn-cancel">Batal</a>

                    <button type="submit" class="academic-btn-save">
                        <span>▣</span> Simpan Kegiatan
                    </button>
                </div>

            </div>

            <aside class="academic-form-sidebar">

                <div class="academic-calendar-illustration">
                    <div class="academic-calendar-art">🗓️</div>
                    <div class="academic-plant plant-left">🌿</div>
                    <div class="academic-plant plant-right">🌱</div>
                </div>

                <div class="academic-tips-card">
                    <h3><span>💡</span> Tips</h3>
                    <ul>
                        <li>Gunakan nama kegiatan yang jelas.</li>
                        <li>Pilih kategori yang sesuai.</li>
                        <li>Tanggal selesai boleh dikosongkan jika kegiatan hanya satu hari.</li>
                        <li>Deskripsi membantu orang tua memahami kegiatan.</li>
                    </ul>
                </div>

            </aside>

        </div>
    </form>
</div>
@endsection
