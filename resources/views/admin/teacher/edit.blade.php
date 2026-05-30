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

    <form
        method="POST"
        action="{{ route('admin.teachers.update',$teacher) }}">

        @csrf
        @method('PUT')

        <div class="form-grid">

            {{-- NAMA GURU --}}
            <div class="full-width">

                <label class="label">
                    Nama Guru
                </label>

                <input
                    type="text"
                    class="input"
                    value="{{ $teacher->user->name }}"
                    readonly>

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
                            {{ old('class_id',$teacher->school_class_id) == $c->id ? 'checked' : '' }}>

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
                    value="{{ old('nip',$teacher->nip) }}"
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

        </div>

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

@endsection