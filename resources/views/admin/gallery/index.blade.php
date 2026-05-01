@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Galeri</h2>

    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary mb-3">
        Tambah Galeri
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($galleries as $key => $gallery)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $gallery->title }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $gallery->image) }}" width="100">
                    </td>
                    <td>
                        <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection