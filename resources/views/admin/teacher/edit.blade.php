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

      <div>
        <label class="label">Nama</label>
        <input class="input" name="nama" value="{{ old('nama',$teacher->user->name ?? '') }}">
      </div>

      <div>
        <label class="label">Email</label>
        <input class="input" name="email" value="{{ old('email',$teacher->user->email ?? '') }}">
      </div>

      
      <div>
        <label class="label">Role</label>
        <select class="input" name="role" id="role">
          <option value="teacher" {{ $teacher->user->role == 'teacher' ? 'selected' : '' }}>Guru</option>
          <option value="operator" {{ $teacher->user->role == 'operator' ? 'selected' : '' }}>Operator</option>
        </select>
      </div>

      
      <div>
        <label class="label">Kelas</label>
        <select class="input" name="class_id" id="class_id">
          <option value="">-- Pilih Kelas --</option>

          @foreach($classes as $c)
            <option value="{{ $c->id }}"
              {{ old('class_id', $teacher->school_class_id) == $c->id ? 'selected' : '' }}>
              {{ $c->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="label">Telepon</label>
        <input class="input" name="phone" value="{{ old('phone',$teacher->phone) }}">
      </div>

      <div class="full">
        <label class="label">Alamat</label>
        <textarea class="textarea" name="address">{{ old('address',$teacher->address) }}</textarea>
      </div>

      <div class="full">
        <label class="label">Status</label>
        <div class="check">
          <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
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