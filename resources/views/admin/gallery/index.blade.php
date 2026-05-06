@extends('admin.layouts.app')

@section('content')

<div class="card-table">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-start mb-3">

        <div>
            <h2 class="title">Data Galeri</h2>
            <p class="subtitle">Kelola data galeri PAUD.</p>
        </div>

        <a href="{{ route('admin.gallery.create') }}" class="btn-add">
            + Tambah Galeri
        </a>

    </div>

    <!-- SEARCH (BIAR SAMA KAYAK PROFILE) -->
    <form method="GET" class="mb-3">
        <div class="d-flex gap-2">
            <input 
                type="text" 
                name="q"
                class="form-control"
                placeholder="Cari judul..."
                style="max-width:300px;"
            >
            <button class="btn btn-secondary">Cari</button>
        </div>
    </form>

    <!-- TABLE -->
    <div class="table-wrap">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($galleries as $key => $gallery)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $gallery->title }}</td>

                    <td>
                        @if($gallery->image)
                            <img src="{{ asset('storage/' . $gallery->image) }}" class="img-table">
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        <div class="action-btn">
                            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn-edit">
                                Edit
                            </a>

                            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" class="btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="4" class="table-empty">
                        Belum ada data galeri
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection