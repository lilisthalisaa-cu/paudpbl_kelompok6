@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <!-- HEADER -->
        <div class="card-head">
            <div>
                <h3 class="card-title">Tambah Profile</h3>
                <p class="muted">Isi data profile untuk ditampilkan.</p>
            </div>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form">

                <!-- JUDUL -->
                <div class="full">
                    <label class="label">Judul</label>
                    <input type="text" name="title" class="input" required>
                </div>

                <!-- DESKRIPSI -->
                <div class="full">
                    <label class="label">Deskripsi</label>
                    <textarea name="description" class="textarea"></textarea>
                </div>

                <!-- GAMBAR -->
                <div class="full">
                    <label class="label">Gambar (Opsional)</label>
                    <input type="file" name="image" class="input">
                </div>

            </div>

            <!-- BUTTON -->
            <div class="actions">
                  <button class="btn-update-fix">Simpan</button>
                <a href="{{ route('admin.profile.index') }}" class="btn btn-outline">Kembali</a>
            </div>

        </form>

    </div>

</div>

@endsection