@extends('admin.layouts.app')

@section('title', 'Tambah Program')

@section('content')

<div class="program-form-page">

    <div class="program-form-wrapper">

        {{-- HEADER --}}
        <div class="program-form-header">

            <div>

                <h1>
                    Tambah Program
                </h1>

                <p>
                    Tambahkan program kegiatan sekolah.
                </p>

            </div>

        </div>

        {{-- FORM --}}
        <form
            action="{{ route('admin.program.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="program-form-grid">

                {{-- TITLE --}}
                <div class="program-form-group">

                    <label>
                        Nama Program
                    </label>

                    <input
                        type="text"
                        name="title"
                        placeholder="Masukkan nama program"
                        required
                    >

                </div>

                {{-- TYPE --}}
                <div class="program-form-group">

                    <label>
                        Jenis Program
                    </label>

                    <select
                        name="type"
                        required
                    >

                        <option value="">
                            Pilih Jenis
                        </option>

                        <option value="mingguan">
                            Mingguan
                        </option>

                        <option value="bulanan">
                            Bulanan
                        </option>

                        <option value="tahunan">
                            Tahunan
                        </option>

                    </select>

                </div>

                {{-- IMAGE --}}
                <div class="program-form-group full">

                    <label>
                        Foto Program
                    </label>

                    <input
                        type="file"
                        name="image"
                        required
                    >

                </div>

                {{-- DESCRIPTION --}}
                <div class="program-form-group full">

                    <label>
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        placeholder="Masukkan deskripsi program"
                        required
                    ></textarea>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="program-form-action">

                <a href="{{ route('admin.program.index') }}"
                   class="btn-program-cancel">

                    Kembali

                </a>

                <button
                    type="submit"
                    class="btn-program-save"
                >

                    Simpan Program

                </button>

            </div>

        </form>

    </div>

</div>

@endsection