@extends('admin.layouts.app')

@section('title', 'Tambah Struktur')

@section('content')

<div class="program-form-page">

    <div class="program-form-wrapper">
            @if ($errors->any())

        <div class="error-box">

            <strong>
                Gagal menyimpan data struktur
            </strong>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

            </div>

                @endif

            <div class="program-form-header">

            <h1>
                Tambah Struktur
            </h1>

            <p>
                Tambahkan data struktur organisasi.
            </p>

        </div>

        <form
            action="{{ route('admin.structure.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="program-form-grid">

                <div class="program-form-group">

                    <label>
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
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

                        <option value="">
                            Pilih Jenis
                        </option>

                        <option value="kepala">
                            Kepala Sekolah
                        </option>

                        <option value="guru">
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
                    ></textarea>

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

                    Simpan Struktur

                </button>

            </div>

        </form>

    </div>

</div>

@endsection