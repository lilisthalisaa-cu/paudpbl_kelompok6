@extends('admin.layouts.app')

@section('content')

<div class="gallery-wrapper">

    <div class="gallery-card">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

            <div>

                <h2 class="gallery-title">
                    Tambah Galeri
                </h2>

                <p class="gallery-subtitle">
                    Tambahkan galeri kegiatan sekolah.
                </p>

            </div>

            <a href="{{ route('admin.gallery.index') }}"
                class="btn-cancel">
                ← Kembali
            </a>

        </div>

        <!-- ERROR -->
        @if ($errors->any())

        <div class="alert alert-danger mb-4">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        <!-- FORM -->
        <form action="{{ route('admin.gallery.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="school-profile-grid">

                <div class="mt-3">

                    <label class="label">
                        Upload Foto
                    </label>

                    <input type="file"
                        name="image"
                        class="input"
                        required>

                </div>

            </div>

            <!-- FORM INPUT -->
            <div class="school-profile-form">

                <!-- JUDUL -->
                <div class="mb-4 mt-4">

                    <label class="label">
                        Judul Galeri
                    </label>

                    <input type="text"
                        name="title"
                        class="input"
                        placeholder="Masukkan judul galeri"
                        required>

                </div>

                <!-- KATEGORI -->
                <div class="mb-4">

                    <label class="label">
                        Kategori
                    </label>

                    <select name="category"
                        class="input">

                        <option value="Kegiatan Belajar">
                            Kegiatan Belajar
                        </option>

                        <option value="Outdoor">
                            Outdoor
                        </option>

                        <option value="Keagamaan">
                            Keagamaan
                        </option>

                        <option value="Acara">
                            Acara
                        </option>

                    </select>

                </div>

                <!-- BUTTON -->
                <div class="actions">

                    <button type="submit"
                        class="btn-save"
                        onclick="this.disabled=true; this.innerText='Menyimpan...'; this.form.submit();">

                        Simpan Galeri

                    </button>

                    <a href="{{ route('admin.gallery.index') }}"
                        class="btn-cancel">
                        Batal
                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection