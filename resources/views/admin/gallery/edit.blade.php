@extends('admin.layouts.app')

@section('content')

<div class="main-container">

    <div class="card-table">

        <!-- HEADER -->
        <h2 class="title">Edit Galeri</h2>
        <p class="subtitle">Ubah data galeri yang ditampilkan.</p>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('admin.gallery.update', $gallery->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <!-- JUDUL -->
            <div class="mb-3">

                <label class="label">
                    Judul
                </label>

                <input type="text"
                       name="title"
                       class="input"
                       value="{{ $gallery->title }}"
                       required>

            </div>

            <!-- KATEGORI -->
            <div class="mb-3">

                <label class="label">
                    Kategori
                </label>

                <select name="category"
                        class="input">

                    <option value="Kegiatan Belajar"
                        {{ $gallery->category == 'Kegiatan Belajar' ? 'selected' : '' }}>
                        Kegiatan Belajar
                    </option>

                    <option value="Outdoor"
                        {{ $gallery->category == 'Outdoor' ? 'selected' : '' }}>
                        Outdoor
                    </option>

                    <option value="Keagamaan"
                        {{ $gallery->category == 'Keagamaan' ? 'selected' : '' }}>
                        Keagamaan
                    </option>

                    <option value="Acara"
                        {{ $gallery->category == 'Acara' ? 'selected' : '' }}>
                        Acara
                    </option>

                </select>

            </div>

            <!-- GAMBAR -->
            <div class="mb-3">

                <label class="label">
                    Gambar (Opsional)
                </label>

                <input type="file"
                       name="image"
                       class="input">

            </div>

            <!-- PREVIEW -->
            @if($gallery->image)

            <div class="mb-3">

                <label class="label">
                    Gambar Saat Ini
                </label>

                <br>

                <img src="{{ asset('storage/' . $gallery->image) }}"
                     class="img-table">

            </div>

            @endif

            <!-- BUTTON -->
            <div class="actions">

                <button class="btn-update-fix">
                    Update
                </button>

                <a href="{{ route('admin.gallery.index') }}"
                   class="btn-cancel">
                    ← Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection