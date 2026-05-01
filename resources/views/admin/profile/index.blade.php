@extends('admin.layouts.app')

@section('content')

<div class="card-table">
    <div class="card-header">
        <div>
            <h3 class="title">Data Profile</h3>
            <p class="subtitle">Kelola data profile PAUD.</p>

            <a href="{{ route('admin.profile.create') }}" class="btn-orange btn-add-profile">
                + Tambah Profile
            </a>

            <div class="card-table">

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
                                        <button class="btn-delete">Hapus</button>
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

            @endsection