@extends('admin.layouts.app')

@section('content')

<div class="school-profile-wrapper">

    <div class="school-profile-section">

        <div class="profile-header">

            <div>

                <h2 class="title">
                    Tambah Profil Sekolah
                </h2>

                <p class="subtitle">
                    Tambahkan informasi profil sekolah.
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
            action="{{ route('admin.profile.store') }}"
        >

            @csrf

            <div class="school-profile-form">

                <div class="form-group">

                    <label>
                        Nama Sekolah
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="input"
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
                        required
                    ></textarea>

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
                    ></textarea>

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
                        ></textarea>

                    </div>

                    <div class="form-group">

                        <label>
                            Misi
                        </label>

                        <textarea
                            name="mission"
                            class="textarea"
                            rows="5"
                        ></textarea>

                    </div>

                </div>

                <div class="actions">

                    <button class="btn-save">

                        Simpan Profil

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection