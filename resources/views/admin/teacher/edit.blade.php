@extends('admin.layouts.app')

@section('title','Edit Guru')

@section('content')

<div class="card teacher-form-card">

  <div class="card-head">

    <div>
      <h2 class="card-title">
        Edit Guru
      </h2>

      <div class="muted">
        Perbarui data guru.
      </div>
    </div>

  </div>

  <form method="POST"
        action="{{ route('admin.teachers.update',$teacher) }}">

    @csrf
    @method('PUT')

    <div class="form-grid">

      {{-- NAMA --}}
      <div>

        <label class="label">
          Nama
        </label>

        <input
          class="input"
          name="nama"
          value="{{ old('nama',$teacher->user->name ?? '') }}"
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
          value="{{ old('email',$teacher->user->email ?? '') }}"
          placeholder="Email guru">

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

              {{ ($teacher->user->role ?? '') == 'teacher' ? 'checked' : '' }}>

            <span>
              Guru
            </span>

          </label>

          <label class="class-option">

            <input
              type="radio"
              name="role"
              value="operator"

              {{ ($teacher->user->role ?? '') == 'operator' ? 'checked' : '' }}>

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

              {{ old('class_id', $teacher->school_class_id) == $c->id ? 'checked' : '' }}>

            <span>
              {{ $c->name }}
            </span>

          </label>

          @endforeach

        </div>

      </div>

      {{-- TELEPON --}}
      <div>

        <label class="label">
          Telepon
        </label>

        <input
          class="input"
          name="phone"
          value="{{ old('phone',$teacher->phone) }}"
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
          placeholder="Alamat lengkap guru">{{ old('address',$teacher->address) }}</textarea>

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
            {{ old('is_active', true) ? 'checked' : '' }}>

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

        Update

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

function toggleClassButtons(roleValue){

  let kelasOptions =
    document.querySelectorAll(
      '.class-option input[name="class_id"]'
    );

  if(roleValue === 'operator'){

    kelasOptions.forEach(function(item){

      item.checked = false;
      item.disabled = true;

    });

  }else{

    kelasOptions.forEach(function(item){

      item.disabled = false;

    });

  }

}

document
  .querySelectorAll('input[name="role"]')

  .forEach(function(roleRadio){

    roleRadio.addEventListener('change', function(){

      toggleClassButtons(this.value);

    });

});

window.onload = function(){

  let selectedRole =
    document.querySelector(
      'input[name="role"]:checked'
    );

  if(selectedRole){

    toggleClassButtons(selectedRole.value);

  }

};

</script>

@endsection