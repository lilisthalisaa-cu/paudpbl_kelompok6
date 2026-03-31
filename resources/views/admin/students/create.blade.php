@extends('admin.layouts.app')
@section('title','Tambah Siswa')

@section('content')
<div class="card" style="max-width:980px;">
  <div class="card-head">
    <div>
      <h2 class="card-title">Tambah Siswa</h2>
      <div class="muted">Isi data siswa untuk kebutuhan absensi & laporan.</div>
    </div>
  </div>

  <form method="POST" action="{{ route('admin.students.store') }}">
    @csrf

    <div class="form">
      <div>
        <label class="label">Nama</label>
        <input class="input" name="name" value="{{ old('name') }}" placeholder="Nama lengkap siswa">
        @error('name')<div class="muted" style="color:#dc2626">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="label">NISN (opsional)</label>
        <input class="input" name="nisn" value="{{ old('nisn') }}" placeholder="NISN siswa">
        @error('nisn')<div class="muted" style="color:#dc2626">{{ $message }}</div>@enderror
      </div>

      <div class="full">
        <label class="label">Kelas (opsional)</label>
        <select class="select" name="school_class_id">
          <option value="">- Pilih Kelas -</option>
          @foreach(\App\Models\SchoolClass::orderBy('name')->get() as $c)
            <option value="{{ $c->id }}" @selected(old('school_class_id')==$c->id)>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="label">Nama Orang Tua (opsional)</label>
        <input class="input" name="parent_name" value="{{ old('parent_name') }}" placeholder="Nama orang tua/wali">
      </div>

      <div>
        <label class="label">Telepon Orang Tua (opsional)</label>
        <input class="input" name="parent_phone" value="{{ old('parent_phone') }}" placeholder="08xxxxxxxxxx">
      </div>

      <div class="full">
        <label class="label">Alamat (opsional)</label>
        <textarea class="textarea" name="address" placeholder="Alamat lengkap">{{ old('address') }}</textarea>
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
      <a class="btn btn-outline" href="{{ route('admin.students.index') }}">Kembali</a>
    </div>
  </form>
</div>
@endsection