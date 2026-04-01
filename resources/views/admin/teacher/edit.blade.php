@extends('admin.layouts.app')
@section('title','Edit Guru')

@section('content')
<div class="card" style="max-width:900px;">
  <div class="card-head">
    <div>
      <h2 class="card-title">Edit Guru</h2>
      <div class="muted">Perbarui data guru.</div>
    </div>
  </div>

  <form method="POST" action="{{ route('admin.teachers.update',$teacher) }}">
    @csrf @method('PUT')

    <div class="form">
      {{-- NAME dari user --}}
      <div>
        <label class="label">Nama</label>
        <input class="input" name="nama" value="{{ old('nama',$teacher->user->nama ?? '') }}">
        @error('nama')<div class="muted" style="color:#dc2626">{{ $message }}</div>@enderror
      </div>

      {{-- NIP tetap --}}
      <div>
        <label class="label">NIP (opsional)</label>
        <input class="input" name="nip" value="{{ old('nip',$teacher->nip) }}">
        @error('nip')<div class="muted" style="color:#dc2626">{{ $message }}</div>@enderror
      </div>

      {{-- EMAIL dari user --}}
      <div>
        <label class="label">Email</label>
        <input class="input" name="email" value="{{ old('email',$teacher->user->email ?? '') }}">
        @error('email')<div class="muted" style="color:#dc2626">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="label">Telepon (opsional)</label>
        <input class="input" name="phone" value="{{ old('phone',$teacher->phone) }}">
      </div>

      <div class="full">
        <label class="label">Alamat (opsional)</label>
        <textarea class="textarea" name="address">{{ old('address',$teacher->address) }}</textarea>
      </div>

      {{-- CLASS --}}
      <div>
        <label class="label">Kelas</label>
        <select class="input" name="class_id">
          @foreach($classes as $c)
            <option value="{{ $c->id }}" {{ $teacher->class_id == $c->id ? 'selected' : '' }}>
              {{ $c->nama_kelas }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="full">
        <label class="label">Status</label>
        <div class="check">
          <input type="checkbox" name="is_active" value="1" @checked(old('is_active',$teacher->is_active ?? true))>
          <span>Aktif</span>
        </div>
      </div>
    </div>

    <div class="actions">
      <button class="btn btn-primary" type="submit">Update</button>
      <a class="btn btn-outline" href="{{ route('admin.teachers.index') }}">Kembali</a>
    </div>
  </form>
</div>
@endsection