@extends('admin.layouts.app')
@section('title','Data Guru')

@section('content')
<div class="card">
  <div class="toolbar">
    <div>
      <h2 class="card-title">Data Guru</h2>
      <div class="muted">Kelola data guru PAUD.</div>
    </div>

    <a class="btn btn-primary" href="{{ route('admin.teachers.create') }}">+ Tambah Guru</a>
  </div>

  <form class="search" method="GET">
    <input class="input" name="q" value="{{ request('q') }}" placeholder="Cari nama / NIP / email">
    <button class="btn btn-outline" type="submit">Cari</button>
  </form>

  <div style="margin-top:12px;overflow:auto">
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>NIP</th>
          <th>Email</th>
          <th>Telepon</th>
          <th>Kelas</th>
          <th>Role</th>
          <th>Status</th>
          <th style="width:180px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($teachers as $t)
        <tr>
          <td>{{ $t->user->name ?? '-' }}</td>
          <td>{{ $t->nip ?? '-' }}</td>
          <td>{{ $t->user->email ?? '-' }}</td>
          <td>{{ $t->phone ?? '-' }}</td>

          {{-- FIX KELAS --}}
          <td>{{ $t->schoolClass->name ?? '-' }}</td>

          {{-- TAMBAH ROLE --}}
          <td>
            @if($t->user->role == 'admin')
            Operator
            @else
            Guru
            @endif
          </td>

          <td>
            <span class="badge badge-ok">Aktif</span>
          </td>

          <td>
            <a class="btn btn-outline" href="{{ route('admin.teachers.edit',$t) }}">Edit</a>

            <form method="POST" action="{{ route('admin.teachers.destroy',$t) }}" style="display:inline" onsubmit="return confirm('Hapus data guru ini?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="8" class="muted" style="padding:16px;text-align:center">
            Belum ada data guru.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div style="margin-top:12px;">
    {{ $teachers->links() }}
  </div>
</div>
@endsection