@extends('admin.layouts.app')
@section('title','Tambah Guru')

@section('content')
<div class="card" style="max-width:900px;">
  <div class="card-head">
    <div>
      <h2 class="card-title">Tambah Guru</h2>
      <div class="muted">Isi data guru untuk disimpan ke sistem.</div>
    </div>
  </div>

  <form method="POST" action="{{ route('admin.teachers.store') }}">
    @csrf

    <div class="form">
      {{-- NAME -> jadi nama --}}
      <div>
        <label class="label">Nama</label>
        <input class="input" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap guru">
        @error('nama')<div class="muted" style="color:#dc2626">{{ $message }}</div>@enderror
      </div>

      {{-- EMAIL --}}
      <div>
        <label class="label">Email</label>
        <input class="input" name="email" value="{{ old('email') }}" placeholder="email@contoh.com">
        @error('email')<div class="muted" style="color:#dc2626">{{ $message }}</div>@enderror
      </div>

      {{-- PASSWORD (WAJIB untuk user login) --}}
      <div>
        <label class="label">Password</label>
        <input class="input" type="password" name="password" placeholder="Minimal 6 karakter">
        @error('password')<div class="muted" style="color:#dc2626">{{ $message }}</div>@enderror
      </div>

      {{-- CLASS --}}
      <div>
        <label class="label">Class</label>
        <select class="input" name="class_id">
          <option value="">-- Pilih Class --</option>
          @foreach($classes as $c)
            <option value="{{ $c->id }}">{{ $c->nama_kelas }}</option>
          @endforeach
        </select>
        @error('class_id')<div class="muted" style="color:#dc2626">{{ $message }}</div>@enderror
      </div>

      {{-- FIELD LAMA (BIAR TETAP ADA) --}}
      <div>
        <label class="label">NIP (opsional)</label>
        <input class="input" name="nip" value="{{ old('nip') }}">
      </div>

      <div>
        <label class="label">Telepon (opsional)</label>
        <input class="input" name="phone" value="{{ old('phone') }}">
      </div>

      <div class="full">
        <label class="label">Alamat (opsional)</label>
        <textarea class="textarea" name="address">{{ old('address') }}</textarea>
      </div>

      <div class="full">
        <label class="label">Status</label>
        <div class="check">
          <input type="checkbox" name="is_active" value="1" checked>
          <span>Aktif</span>
        </div>
      </div>
    </div>

    <div class="actions">
      <button class="btn btn-primary" type="submit">Simpan</button>
      <a class="btn btn-outline" href="{{ route('admin.teachers.index') }}">Kembali</a>
    </div>
  </form>
</div>
@endsection