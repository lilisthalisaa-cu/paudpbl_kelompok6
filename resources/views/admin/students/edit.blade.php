@extends('admin.layouts.app')

@section('title','Edit Siswa')

@section('content')

<div class="card student-form-card">

  <div class="card-head">

    <div>
      <h2 class="card-title">
        Edit Siswa
      </h2>

      <div class="muted">
        Perbarui data siswa.
      </div>
    </div>

  </div>

  <form method="POST"
        action="{{ route('admin.students.update',$student) }}">

    @csrf
    @method('PUT')

    <div class="form">

      {{-- NAMA --}}
      <div>

        <label class="label">
          Nama
        </label>

        <input
          class="input"
          name="name"
          value="{{ old('name',$student->name) }}"
          placeholder="Nama lengkap siswa">

      </div>

      {{-- NISN --}}
      <div>

        <label class="label">
          NISN
        </label>

        <input
          class="input"
          name="nisn"
          value="{{ old('nisn',$student->nisn) }}"
          placeholder="NISN siswa">

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
                {{ old('school_class_id', $student->school_class_id) == $c->id ? 'checked' : '' }}>

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
          class="input"
          name="parent_name"
          value="{{ old('parent_name',$student->parent_name) }}"
          placeholder="Nama orang tua">

      </div>

      {{-- TELEPON --}}
      <div>

        <label class="label">
          Telepon Orang Tua
        </label>

        <input
          class="input"
          name="parent_phone"
          value="{{ old('parent_phone',$student->parent_phone) }}"
          placeholder="08xxxxxxxxxx">

      </div>

      {{-- ALAMAT --}}
      <div class="full">

        <label class="label">
          Alamat
        </label>

        <textarea
          class="textarea"
          name="address"
          placeholder="Alamat siswa">{{ old('address',$student->address) }}</textarea>

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
                 {{ old('is_active', $student->is_active) ? 'checked' : '' }}>

          <span>Aktif</span>

        </label>

      </div>

    </div>

    {{-- ACTION --}}
    <div class="actions">

      <button class="btn-save"
              type="submit">

        Update

      </button>

      <a href="{{ route('admin.students.index') }}"
         class="btn-cancel">

        Kembali

      </a>

    </div>

  </form>

</div>

@endsection