@extends('admin.layouts.app')

@section('content')

<div class="school-profile-wrapper">

    <div class="school-profile-section">

        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

            <div>

                <h2 class="title">
                    Edit Profil Sekolah
                </h2>

                <p class="subtitle">
                    Perbarui informasi profil sekolah.
                </p>

            </div>

            <a href="{{ route('admin.profile.index') }}"
               class="btn btn-outline">
                ← Kembali
            </a>

        </div>

        <form method="POST"
              action="{{ route('admin.profile.update', $profile->id) }}"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="school-profile-grid">

                <!-- FOTO -->
                <div>

                    <div class="school-profile-image-preview">

                        <img src="{{ $profile->image
                            ? asset('storage/' . $profile->image)
                            : asset('images/sekolah.jpg') }}">

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

                <!-- FORM -->
                <div class="school-profile-form">

                    <!-- NAMA -->
                    <div class="mb-4">

                        <label class="label">
                            Nama / Judul Sekolah
                        </label>

                        <input type="text"
                               name="title"
                               class="input"
                               value="{{ $profile->title }}"
                               required>

                    </div>

                    <!-- DESKRIPSI -->
                    <div class="mb-4">

                        <label class="label">
                            Deskripsi Sekolah
                        </label>

                        <textarea name="description"
                                  class="textarea"
                                  rows="5">{{ $profile->description }}</textarea>

                    </div>

                    <!-- NPSN -->
                    <div class="mb-4">

                        <label class="label">
                            NPSN
                        </label>

                        <input type="text"
                               name="npsn"
                               class="input"
                               value="{{ $profile->npsn }}">

                    </div>

                    <!-- ALAMAT -->
                    <div class="mb-4">

                        <label class="label">
                            Alamat
                        </label>

                        <textarea name="address"
                                  class="textarea"
                                  rows="3">{{ $profile->address }}</textarea>

                    </div>

                    <!-- EMAIL -->
                    <div class="mb-4">

                        <label class="label">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               class="input"
                               value="{{ $profile->email }}">

                    </div>

                    <!-- TELEPON -->
                    <div class="mb-4">

                        <label class="label">
                            Telepon
                        </label>

                        <input type="text"
                               name="phone"
                               class="input"
                               value="{{ $profile->phone }}">

                    </div>

                    <!-- KEPALA SEKOLAH -->
                    <div class="mb-4">

                        <label class="label">
                            Kepala Sekolah
                        </label>

                        <input type="text"
                               name="principal"
                               class="input"
                               value="{{ $profile->principal }}">

                    </div>

                    <!-- TANGGAL BERDIRI -->
                    <div class="mb-4">

                        <label class="label">
                            Tanggal Berdiri
                        </label>

                        <input type="text"
                               name="established"
                               class="input"
                               value="{{ $profile->established }}">

                    </div>

                    <!-- VISI -->
                    <div class="mb-4">

                        <label class="label">
                            Visi
                        </label>

                        <textarea name="vision"
                                  class="textarea"
                                  rows="4">{{ $profile->vision }}</textarea>

                    </div>

                    <!-- MISI -->
                    <div class="mb-4">

                        <label class="label">
                            Misi
                        </label>

                        <textarea name="mission"
                                  class="textarea"
                                  rows="5">{{ $profile->mission }}</textarea>

                    </div>

                    <!-- BUTTON -->
                    <div class="actions">

                        <button class="btn-save">
                            Update Profil
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