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
                Pilih akun guru yang sudah terdaftar.
            </div>

        </div>

    </div>

    <form
        method="POST"
        action="{{ route('admin.teachers.store') }}">

        @csrf

        <div class="form-grid">

            {{-- PILIH USER --}}
            <div class="full-width">

                <label class="label">
                    Guru
                </label>

                <select
                    name="user_id"
                    class="input"
                    required>

                    <option value="">
                        Pilih Guru
                    </option>

                    @foreach($users as $user)

                    <option
                        value="{{ $user->id }}"
                        {{ old('user_id') == $user->id ? 'selected' : '' }}>

                        {{ $user->name }}

                    </option>

                    @endforeach

                </select>

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

@endsection