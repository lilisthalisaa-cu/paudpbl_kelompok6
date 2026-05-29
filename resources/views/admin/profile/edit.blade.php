@extends('admin.layouts.app')

@section('content')

<div class="school-profile-wrapper">

    <div class="school-profile-section">

        <div class="profile-header">

            <div>

                <h2 class="title">
                    Edit Profil Sekolah
                </h2>

                <p class="subtitle">
                    Perbarui informasi sekolah.
                </p>

            </div>

            <a
                href="{{ route('admin.profile.index') }}"
                class="btn-outline"
            >

                ← Kembali

            </a>

        </div>

        <form
            method="POST"
            action="{{ route('admin.profile.update', $profile->id) }}"
        >

            @csrf
            @method('PUT')

            <div class="school-profile-form">

                <div class="form-group">

                    <label>
                        Nama Sekolah
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="input"
                        value="{{ $profile->title }}"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        class="textarea"
                        rows="5"
                    >{{ $profile->description }}</textarea>

                </div>

                <div class="form-grid">

                    <div class="form-group">

                        <label>
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="input"
                            value="{{ $profile->email }}"
                        >

                    </div>

                    <div class="form-group">

                        <label>
                            Nomor Telepon
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="input"
                            value="{{ $profile->phone }}"
                        >

                    </div>

                </div>

                <div class="form-group">

                    <label>
                        Alamat
                    </label>

                    <textarea
                        name="address"
                        class="textarea"
                        rows="3"
                    >{{ $profile->address }}</textarea>

                </div>

                <div class="form-grid">

                    <div class="form-group">

                        <label>
                            Visi
                        </label>

                        <textarea
                            name="vision"
                            class="textarea"
                            rows="5"
                        >{{ $profile->vision }}</textarea>

                    </div>

                    <div class="form-group">

                        <label>
                            Misi
                        </label>

                        <textarea
                            name="mission"
                            class="textarea"
                            rows="5"
                        >{{ $profile->mission }}</textarea>

                    </div>

                </div>

                <div class="actions">

                    <button class="btn-save">

                        Update Profil

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection