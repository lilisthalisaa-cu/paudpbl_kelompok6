@extends('admin.layouts.app')

@section('content')

<div class="school-profile-wrapper">

    <div class="school-profile-section">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

            <div>

                <h2 class="title">
                    Tambah Profil Sekolah
                </h2>

                <p class="subtitle">
                    Tambahkan informasi profil sekolah.
                </p>

            </div>

            <a href="{{ route('admin.profile.index') }}"
               class="btn btn-outline">
                ← Kembali
            </a>

        </div>

        <form method="POST"
              action="{{ route('admin.profile.store') }}"
              enctype="multipart/form-data">

            @csrf

            <div class="school-profile-grid">

                <!-- FOTO -->
                <div>

                    <div class="school-profile-image-preview">

                        <img src="{{ asset('images/sekolah.jpg') }}">

                    </div>

                    <div class="mt-3">

                        <label class="label">
                            Upload Foto
                        </label>

                        <input type="file"
                               name="image"
                               class="input">

                    </div>

                </div>

                <div class="school-profile-form">

                    <div class="mb-4">

                        <label class="label">
                            Nama / Judul Sekolah
                        </label>

                        <input type="text"
                               name="title"
                               class="input"
                               required>

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Deskripsi Sekolah
                        </label>

                        <textarea name="description"
                                  class="textarea"
                                  rows="10"></textarea>

                    </div>

                    <div class="actions">

                        <button class="btn-save">
                            Simpan Profil
                        </button>

                        <a href="{{ route('admin.profile.index') }}"
                           class="btn-cancel">
                            Batal
                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection