@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h3>Tambah Profile</h3>

    <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Gambar (Opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.profile.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection