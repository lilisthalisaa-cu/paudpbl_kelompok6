@extends('admin.layouts.app')

@section('title', 'Edit Struktur')

@section('content')

<div class="program-form-page">

    <div class="program-form-wrapper">

        <div class="program-form-header">

            <h1>
                Edit Struktur
            </h1>

            <p>
                Update data struktur organisasi.
            </p>

        </div>

        <form
           action="{{ route('admin.structure.update', $structure->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="program-form-grid">

                <div class="program-form-group">

                    <label>
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ $structure->name }}"
                        required
                    >

                </div>

                <div class="program-form-group">

                    <label>
                        Jabatan
                    </label>

                    <input
                        type="text"
                        name="position"
                        value="{{ $structure->position }}"
                        required
                    >

                </div>

                <div class="program-form-group">

                    <label>
                        Jenis
                    </label>

                    <select
                        name="type"
                        required
                    >

                        <option
                            value="kepala"
                            {{ $structure->type == 'kepala' ? 'selected' : '' }}
                        >
                            Kepala Sekolah
                        </option>

                        <option
                            value="guru"
                            {{ $structure->type == 'guru' ? 'selected' : '' }}
                        >
                            Guru
                        </option>

                    </select>

                </div>

                <div class="program-form-group full">

                    <label>
                        Upload Foto
                    </label>

                    <input
                        type="file"
                        name="image"
                    >

                </div>

                <div class="program-form-group full">

                    <label>
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                    >{{ $structure->description }}</textarea>

                </div>

            </div>

            <div class="program-form-action">

                <a href="{{ route('admin.structure.index') }}"
                   class="btn-program-cancel">

                    Kembali

                </a>

                <button
                    type="submit"
                    class="btn-program-save"
                >

                    Update Struktur

                </button>

            </div>

        </form>

    </div>

</div>

@endsection