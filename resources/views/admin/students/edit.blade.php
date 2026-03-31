@extends('admin.layouts.app')
@section('title','Edit Siswa')

@section('content')
<div class="card" style="max-width:980px;">
  <div class="card-head">
    <div>
      <h2 class="card-title">Edit Siswa</h2>
      <div class="muted">Perbarui data siswa.</div>
    </div>
  </div>

  <form method="POST" action="{{ route('admin.students.update',$student) }}">
    @csrf @method('PUT')

    <div class="form">
      <div>
        <label class="label">Nama</label>
        <input class="input" name="name" value="{{ old('name',$student->name) }}">
        @error('name')<div class="muted" style="color:#dc2626">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="label">NISN (opsional)</label>
        <input class="input" name="nisn" value="{{ old('nisn',$student->nisn) }}">
        @error('nisn')<div class="muted" style="color:#dc2626">{{ $message }}</div>@enderror
      </div>

      <div class="full">
        <label class="label">Kelas (opsional)</label>
        <select class="select" name="school_class_id">
          <option value="">- Pilih Kelas -</option>
          @foreach(\App\Models\SchoolClass::orderBy('name')->get() as $c)
            <option value="{{ $c->id }}" @selected(old('school_class_id',$student->school_class_id)==$c->id)>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="label">Nama Orang Tua (opsional)</label>
        <input class="input" name="parent_name" value="{{ old('parent_name',$student->parent_name) }}">
      </div>

      <div>
        <label class="label">Telepon Orang Tua (opsional)</label>
        <input class="input" name="parent_phone" value="{{ old('parent_phone',$student->parent_phone) }}">
      </div>

      <div class="full">
        <label class="label">Alamat (opsional)</label>
        <textarea class="textarea" name="address">{{ old('address',$student->address) }}</textarea>
      </div>

      <div class="full">
        <label class="label">Status</label>
        <div class="check">
          <input type="checkbox" name="is_active" value="1" @checked(old('is_active',$student->is_active))>
          <span>Aktif</span>
        </div>
      </div>
    </div>

    <div class="actions">
      <button class="btn btn-primary" type="submit">Update</button>
      <a class="btn btn-outline" href="{{ route('admin.students.index') }}">Kembali</a>
    </div>
  </form>
</div>
@endsection