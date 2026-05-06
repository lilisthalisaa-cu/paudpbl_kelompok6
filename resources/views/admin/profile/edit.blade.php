@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <!-- HEADER -->
        <div class="card-head">
            <div>
                <h3 class="card-title">Edit Profile</h3>
                <p class="muted">Perbarui data profile yang sudah ada.</p>
            </div>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('admin.profile.update', $profile->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form">

                <!-- JUDUL -->
                <div class="full">
                    <label class="label">Judul</label>
                    <input type="text" name="title" class="input"
                           value="{{ $profile->title }}" required>
                </div>

                <!-- DESKRIPSI -->
                <div class="full">
                    <label class="label">Deskripsi</label>
                    <textarea name="description" class="textarea">{{ $profile->description }}</textarea>
                </div>

                <!-- GAMBAR -->
                <div class="full">
                    <label class="label">Gambar (Opsional)</label>
                    <input type="file" name="image" class="input">
                </div>

                <!-- PREVIEW GAMBAR -->
                @if($profile->image)
                <div class="full">
                    <label class="label">Gambar Saat Ini</label>
                    <img src="{{ asset('storage/'.$profile->image) }}" class="img-table">
                </div>
                @endif

            </div>

            <!-- BUTTON -->
            <div class="actions">
                <button class="btn-update-fix">Update</button>
                <a href="{{ route('admin.profile.index') }}" class="btn btn-outline">Kembali</a>
            </div>

        </form>

    </div>

</div>

@endsection