@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Galeri</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" required>
        </div>

        <div class="mb-3">
            <label>Gambar (opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        {{-- tampilkan gambar lama --}}
        <div class="mb-3">
            <label>Gambar Saat Ini:</label><br>
            <img src="{{ asset('storage/' . $gallery->image) }}" width="150">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection