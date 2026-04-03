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

      <div>
        <label class="label">Nama</label>
        <input class="input" name="nama" value="{{ old('nama') }}">
      </div>

      <div>
        <label class="label">Email</label>
        <input class="input" name="email" value="{{ old('email') }}">
      </div>

      <div>
        <label class="label">Password</label>
        <input class="input" type="password" name="password">
      </div>

      
      <div>
        <label class="label">Role</label>
        <select class="input" name="role" id="role">
          <option value="teacher">Guru</option>
          <option value="operator">Operator</option>
        </select>
      </div>

      
      <div>
        <label class="label">Kelas</label>
        <select class="input" name="class_id" id="class_id">
          <option value="">-- Pilih Kelas --</option>

          @foreach($classes as $c)
            <option value="{{ $c->id }}">
              {{ $c->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="label">NIP</label>
        <input class="input" name="nip" value="{{ old('nip') }}">
      </div>

      <div>
        <label class="label">Telepon</label>
        <input class="input" name="phone" value="{{ old('phone') }}">
      </div>

      <div class="full">
        <label class="label">Alamat</label>
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


<script>
document.getElementById('role').addEventListener('change', function() {
    let kelas = document.getElementById('class_id');

    if (this.value === 'operator') {
        kelas.value = '';
        kelas.disabled = true;
    } else {
        kelas.disabled = false;
    }
});
</script>

@endsection