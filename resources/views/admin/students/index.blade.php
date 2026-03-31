@extends('admin.layouts.app')
@section('title','Data Siswa')

@section('content')
<div class="card">
  <div class="toolbar">
    <div>
      <h2 class="card-title">Data Siswa</h2>
      <div class="muted">Kelola data siswa PAUD.</div>
    </div>
    <a class="btn btn-primary" href="{{ route('admin.students.create') }}">+ Tambah Siswa</a>
  </div>

  <form class="search" method="GET">
    <input class="input" name="q" value="{{ request('q') }}" placeholder="Cari nama / NISN / orang tua">
    <button class="btn btn-outline" type="submit">Cari</button>
  </form>

  <div style="margin-top:12px;overflow:auto">
    <table class="table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>NISN</th>
          <th>Orang Tua</th>
          <th>Telepon</th>
          <th>Status</th>
          <th style="width:180px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($students as $s)
          <tr>
            <td>{{ $s->name }}</td>
            <td>{{ $s->nisn ?? '-' }}</td>
            <td>{{ $s->parent_name ?? '-' }}</td>
            <td>{{ $s->parent_phone ?? '-' }}</td>
            <td>
              @if($s->is_active)
                <span class="badge badge-ok">Aktif</span>
              @else
                <span class="badge badge-off">Nonaktif</span>
              @endif
            </td>
            <td>
              <a class="btn btn-outline" href="{{ route('admin.students.edit',$s) }}">Edit</a>
              <form method="POST" action="{{ route('admin.students.destroy',$s) }}" style="display:inline" onsubmit="return confirm('Hapus data siswa ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger" type="submit">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="muted" style="padding:16px;text-align:center;">Belum ada data siswa.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div style="margin-top:12px;">
    {{ $students->links() }}
  </div>
</div>
@endsection