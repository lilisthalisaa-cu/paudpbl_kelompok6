@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h3>Edit Profile</h3>

    <form method="POST" action="{{ route('admin.profile.update', $data->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control"
                   value="{{ $data->title }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ $data->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Gambar (Opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        @if($data->image)
            <img src="{{ asset('storage/'.$data->image) }}" width="120" class="mb-3">
        @endif

        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.profile.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection