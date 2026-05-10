@extends('admin.layouts.app')

@section('title','Tambah Guru')

@section('content')

<div class="card teacher-form-card">

  <div class="card-head">

    <div>
      <h2 class="card-title">
        Tambah Guru
      </h2>

      <div class="muted">
        Isi data guru untuk disimpan ke sistem.
      </div>
    </div>

  </div>

  <form method="POST"
    action="{{ route('admin.teachers.store') }}">

    @csrf

    <div class="form-grid">

      {{-- NAMA --}}
      <div>

        <label class="label">
          Nama
        </label>

        <input
          class="input"
          name="nama"
          value="{{ old('nama') }}"
          placeholder="Nama lengkap guru">

      </div>

      {{-- EMAIL --}}
      <div>

        <label class="label">
          Email
        </label>

        <input
          class="input"
          type="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="Email guru">

      </div>

      {{-- PASSWORD --}}
      <div>

        <label class="label">
          Password
        </label>

        <input
          class="input"
          type="password"
          name="password"
          placeholder="Password akun">

      </div>

      {{-- ROLE --}}
      <div class="full-width">

        <label class="label">
          Role
        </label>

        <div class="class-buttons role-buttons">

          <label class="class-option">

            <input
              type="radio"
              name="role"
              value="teacher"
              checked>

            <span>
              Guru
            </span>

          </label>

          <label class="class-option">

            <input
              type="radio"
              name="role"
              value="operator">

            <span>
              Operator
            </span>

          </label>

        </div>

      </div>

      {{-- KELAS --}}
      <div class="full-width">

        <label class="label">
          Kelas
        </label>

        <div class="class-buttons">

          @foreach($classes as $c)

          <label class="class-option">

            <input
              type="radio"
              name="class_id"
              value="{{ $c->id }}"

              {{ old('class_id') == $c->id ? 'checked' : '' }}>

            <span>
              {{ $c->name }}
            </span>

          </label>

          @endforeach

        </div>

      </div>

      {{-- NIP --}}
      <div>

        <label class="label">
          NIP
        </label>

        <input
          class="input"
          name="nip"
          value="{{ old('nip') }}"
          placeholder="Nomor induk pegawai">

      </div>

      {{-- TELEPON --}}
      <div>

        <label class="label">
          Telepon
        </label>

        <input
          class="input"
          name="phone"
          value="{{ old('phone') }}"
          placeholder="08xxxxxxxxxx">

      </div>

      {{-- ALAMAT --}}
      <div class="full-width">

        <label class="label">
          Alamat
        </label>

        <textarea
          class="textarea"
          name="address"
          placeholder="Alamat lengkap guru">{{ old('address') }}</textarea>

      </div>

      {{-- STATUS --}}
      <div class="full-width">

        <label class="label">
          Status
        </label>

        <label class="switch-wrap">

          <input
            type="checkbox"
            name="is_active"
            value="1"
            checked>

          <span class="switch-text">
            Aktif
          </span>

        </label>

      </div>

    </div>

    {{-- ACTION --}}
    <div class="form-actions">

      <button
        class="btn-save"
        type="submit">

        Simpan

      </button>

      <a
        class="btn-cancel"
        href="{{ route('admin.teachers.index') }}">

        Kembali

      </a>

    </div>

  </form>

</div>

<script>
  document
    .querySelectorAll('input[name="role"]')

    .forEach(function(roleRadio) {

      roleRadio.addEventListener('change', function() {

        let kelasOptions =
          document.querySelectorAll(
            '.class-option input[name="class_id"]'
          );

        if (this.value === 'operator') {

          kelasOptions.forEach(function(item) {

            item.checked = false;
            item.disabled = true;

          });

        } else {

          kelasOptions.forEach(function(item) {

            item.disabled = false;

          });

        }

      });

    });
</script>

@endsection