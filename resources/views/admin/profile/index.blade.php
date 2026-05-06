@extends('admin.layouts.app')

@section('content')

<div class="card-table">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-start mb-3">

        <div>
            <h2 class="title">Data Profile</h2>
            <p class="subtitle">Kelola data profile PAUD.</p>
        </div>

        <a href="{{ route('admin.profile.create') }}" class="btn-add">
            + Tambah Profile
        </a>

    </div>

    <!-- SEARCH -->
    <form method="GET" class="mb-3">
        <div class="d-flex gap-2">
            <input 
                type="text" 
                name="q" 
                value="{{ request('q') }}"
                class="form-control" 
                placeholder="Cari judul / deskripsi..."
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
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($profiles as $key => $profile)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $profile->title }}</td>
                    <td>{{ Str::limit($profile->description, 50) }}</td>

                    <td>
                        @if($profile->image)
                            <img src="{{ asset('storage/' . $profile->image) }}" class="img-table">
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        <div class="action-btn">
                            <a href="{{ route('admin.profile.edit', $profile->id) }}" class="btn-edit">
                                Edit
                            </a>

                            <form action="{{ route('admin.profile.destroy', $profile->id) }}" method="POST">
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
                    <td colspan="5" class="table-empty">
                        Belum ada data profile
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection