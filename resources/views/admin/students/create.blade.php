@extends('admin.layouts.app')

@section('title','Tambah Siswa')

@section('content')

<div class="card student-form-card">

  <div class="card-head">
    <div>

      <h2 class="card-title">
        Tambah Siswa
      </h2>

      <div class="muted">
        Isi data siswa untuk kebutuhan presensi & laporan.
      </div>

    </div>
  </div>

  <form method="POST"
    action="{{ route('admin.students.store') }}">

    @csrf

    <div class="form">

      {{-- NAMA --}}
      <div>

        <label class="label">
          Nama
        </label>

        <input
          type="text"
          class="input"
          name="name"
          value="{{ old('name') }}"
          placeholder="Nama lengkap siswa">

      </div>

      {{-- NISN --}}
      <div>

        <label class="label">
          NISN
        </label>

        <input
          type="text"
          class="input"
          name="nisn"
          value="{{ old('nisn') }}"
          placeholder="NISN siswa">

      </div>

      {{-- JENIS KELAMIN --}}
      <div class="full">

        <label class="label">
          Jenis Kelamin
        </label>

        <div class="class-button-group">

          <label class="class-button">

            <input
              type="radio"
              name="gender"
              value="L"
              {{ old('gender') == 'L' ? 'checked' : '' }}>

            <span>
              Laki-laki
            </span>

          </label>

          <label class="class-button">

            <input
              type="radio"
              name="gender"
              value="P"
              {{ old('gender') == 'P' ? 'checked' : '' }}>

            <span>
              Perempuan
            </span>

          </label>

        </div>

      </div>

      {{-- KELAS --}}
      <div class="full">

        <label class="label">
          Kelas
        </label>

        <div class="class-button-group">

          @foreach($classes as $c)

          <label class="class-button">

            <input
              type="radio"
              name="school_class_id"
              value="{{ $c->id }}"
              {{ old('school_class_id') == $c->id ? 'checked' : '' }}>

            <span>
              Kelas {{ $c->name }}
            </span>

          </label>

          @endforeach

        </div>

      </div>

      {{-- ORANG TUA --}}
      <div>

        <label class="label">
          Nama Orang Tua
        </label>

        <input
          type="text"
          class="input"
          name="parent_name"
          value="{{ old('parent_name') }}"
          placeholder="Nama orang tua">

      </div>

      {{-- TELEPON --}}
      <div>

        <label class="label">
          Telepon Orang Tua
        </label>

        <input
          type="text"
          class="input"
          name="parent_phone"
          value="{{ old('parent_phone') }}"
          placeholder="08xxxxxxxxxx">

      </div>

      {{-- USERNAME PARENT --}}
      <div>

        <label class="label">
          Username Parent
        </label>

        <input
          type="text"
          class="input"
          name="username"
          value="{{ old('username') }}"
          placeholder="Username login parent">

      </div>

      {{-- PASSWORD PARENT --}}
      <div>

        <label class="label">
          Password Parent
        </label>

        <input
          type="password"
          class="input"
          name="password"
          placeholder="Password login parent">

      </div>

      {{-- ALAMAT --}}
      <div class="full">

        <label class="label">
          Alamat
        </label>

        <textarea
          class="textarea"
          name="address"
          placeholder="Alamat siswa">{{ old('address') }}</textarea>

      </div>

      {{-- STATUS --}}
      <div class="full">

        <label class="label">
          Status
        </label>

        <label class="status-check">

          <input type="checkbox"
            name="is_active"
            value="1"
            checked>

          <span>
            Aktif
          </span>

        </label>

      </div>

    </div>

    {{-- ACTION --}}
    <div class="actions">

      <button class="btn-save"
        type="submit">

        Simpan

      </button>

      <a href="{{ route('admin.students.index') }}"
        class="btn-cancel">

        Kembali

      </a>

    </div>

  </form>

</div>

@endsection