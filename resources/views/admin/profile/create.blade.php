@extends('admin.layouts.app')

@section('content')

<div class="school-profile-wrapper">

    <div class="school-profile-section">

        <div class="d-flex justify-content-between align-items-center mb-4">

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
                            Foto Sekolah
                        </label>

                        <input type="file"
                               name="image"
                               class="input">

                    </div>

                </div>

                <!-- FORM -->
                <div class="school-profile-form">

                    <div class="mb-4">

                        <label class="label">
                            Nama Sekolah
                        </label>

                        <input type="text"
                               name="title"
                               class="input"
                               required>

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Deskripsi
                        </label>

                        <textarea name="description"
                                  class="textarea"
                                  rows="5"
                                  required></textarea>

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Alamat
                        </label>

                        <textarea name="address"
                                  class="textarea"
                                  rows="3"></textarea>

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               class="input">

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Nomor Telepon
                        </label>

                        <input type="text"
                               name="phone"
                               class="input">

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Visi
                        </label>

                        <textarea name="vision"
                                  class="textarea"
                                  rows="4"></textarea>

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Misi
                        </label>

                        <textarea name="mission"
                                  class="textarea"
                                  rows="5"></textarea>

                    </div>

                    <div class="actions">

                        <button class="btn-save">
                            Simpan Profil
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection