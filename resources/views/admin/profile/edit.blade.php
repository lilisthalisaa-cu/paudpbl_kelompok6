@extends('admin.layouts.app')

@section('content')

<div class="school-profile-wrapper">

    <div class="school-profile-section">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="title">
                    Edit Profil Sekolah
                </h2>

                <p class="subtitle">
                    Perbarui informasi sekolah.
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
                               value="{{ $profile->title }}"
                               required>

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Deskripsi
                        </label>

                        <textarea name="description"
                                  class="textarea"
                                  rows="5">{{ $profile->description }}</textarea>

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Alamat
                        </label>

                        <textarea name="address"
                                  class="textarea"
                                  rows="3">{{ $profile->address }}</textarea>

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               class="input"
                               value="{{ $profile->email }}">

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Nomor Telepon
                        </label>

                        <input type="text"
                               name="phone"
                               class="input"
                               value="{{ $profile->phone }}">

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Visi
                        </label>

                        <textarea name="vision"
                                  class="textarea"
                                  rows="4">{{ $profile->vision }}</textarea>

                    </div>

                    <div class="mb-4">

                        <label class="label">
                            Misi
                        </label>

                        <textarea name="mission"
                                  class="textarea"
                                  rows="5">{{ $profile->mission }}</textarea>

                    </div>

                    <div class="actions">

                        <button class="btn-save">
                            Update Profil
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection