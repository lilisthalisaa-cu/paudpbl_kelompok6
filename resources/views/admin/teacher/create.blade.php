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
                Tambahkan data guru dan akun login guru.
            </div>

        </div>

    </div>

    <form
        method="POST"
        action="{{ route('admin.teachers.store') }}">

        @csrf

        <div class="form-grid">

            {{-- NAMA GURU --}}
            <div>

                <label class="label">
                    Nama Guru
                </label>

                <input
                    class="input"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Nama guru"
                    required>

            </div>

            {{-- USERNAME --}}
            <div>

                <label class="label">
                    Username
                </label>

                <input
                    class="input"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Username login"
                    required>

            </div>

            {{-- PASSWORD --}}
            <div class="full-width">

                <label class="label">
                    Password
                </label>

                <div class="password-wrapper">

                    <input
                        type="password"
                        class="input"
                        id="teacherPassword"
                        name="password"
                        placeholder="Minimal 6 karakter"
                        required>

                    <button
                        type="button"
                        class="toggle-password"
                        id="toggleTeacherPassword">

                        👁

                    </button>

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

        </div>

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
        .getElementById('toggleTeacherPassword')
        .addEventListener('click', function() {

            const password =
                document.getElementById('teacherPassword');

            if (password.type === 'password') {

                password.type = 'text';
                this.innerHTML = '🙈';

            } else {

                password.type = 'password';
                this.innerHTML = '👁';

            }

        });
</script>

@endsection