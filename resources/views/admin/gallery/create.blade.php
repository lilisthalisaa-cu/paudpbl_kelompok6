@extends('admin.layouts.app')

@section('content')

<div class="main-container">

    <div class="card-table">

        <!-- HEADER -->
        <h2 class="title">Tambah Galeri</h2>
        <p class="subtitle">Isi data galeri untuk ditampilkan.</p>

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
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- JUDUL -->
            <div class="mb-3">
                <label class="label">Judul</label>
                <input type="text" name="title" class="input" required>
            </div>

            <!-- GAMBAR -->
            <div class="mb-3">
                <label class="label">Gambar</label>
                <input type="file" name="image" class="input" required>
            </div>

            <!-- BUTTON -->
            <div class="actions">
                <button class="btn-update-fix">Simpan</button>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline">Kembali</a>
            </div>

        </form>

    </div>

</div>

@endsection