@extends('admin.layouts.app')

@section('content')

<div class="school-profile-wrapper">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

        <div>

            <h2 class="title">
                Profil Sekolah
            </h2>

            <p class="subtitle">
                Kelola informasi profil sekolah PAUD.
            </p>

        </div>

        <a href="{{ route('admin.profile.create') }}"
           class="btn-add">
            + Tambah Profil
        </a>

    </div>

    @if($profile)

    <div class="school-profile-card">

        <!-- FOTO -->
        <div class="school-profile-image">

            <img src="{{ $profile->image
                ? asset('storage/' . $profile->image)
                : asset('images/sekolah.jpg') }}"
                 alt="Sekolah">

        </div>

        <!-- INFO -->
        <div class="school-profile-info">

            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                <div>

                    <h3 class="school-profile-title">
                        {{ $profile->title }}
                    </h3>

                    <span class="school-profile-badge">
                        PAUD
                    </span>

                </div>

                <a href="{{ route('admin.profile.edit', $profile->id) }}"
                   class="school-profile-edit">
                    ✏ Edit Profil
                </a>

            </div>

            <div class="school-profile-list">

                <div class="school-profile-item">
                    📍 Dusun Pasinan Timur, Singojuruh, Banyuwangi
                </div>

                <div class="school-profile-item">
                    ✉ kbroudlotulilmisngojuruh@gmail.com
                </div>

                <div class="school-profile-item">
                    ☎️ +62 821 4518 2975
                </div>


                <div class="school-profile-item">
                    📅 Berdiri sejak 2008
                </div>

                <div class="school-profile-item">
                    👤 Kepala Sekolah : Widyawati
                </div>

            </div>

        </div>

    </div>

    <div class="school-profile-section">

        <h4 class="school-profile-section-title">
            Informasi Lengkap
        </h4>

        <div class="school-profile-grid">

            <!-- LEFT -->
            <div class="school-profile-column">

                <div class="school-profile-box">
                    <strong>Nama Sekolah</strong>
                    <p>{{ $profile->title }}</p>
                </div>

                <div class="school-profile-box">
                    <strong>NPSN</strong>
                    <p>69818309</p>
                </div>

                <div class="school-profile-box">
                    <strong>Jenis Lembaga</strong>
                    <p>PAUD (Kelompok Bermain)</p>
                </div>

                <div class="school-profile-box">
                    <strong>Alamat</strong>
                    <p>Dusun Pasinan Timur, Singojuruh, Banyuwangi</p>
                </div>

                <div class="school-profile-box">
                    <strong>Email</strong>
                    <p>kbroudlotulilmisingojuruh@gmail.com</p>
                </div>

            </div>

    
            <div class="school-profile-column">


                <div class="school-profile-box">
                    <strong>Tanggal Berdiri</strong>
                    <p>17 Juli 2008</p>
                </div>

                <div class="school-profile-box">
                    <strong>Kepala Sekolah</strong>
                    <p>WIDYAWATI</p>
                </div>

                <div class="school-profile-box">
                    <strong>Visi</strong>
                    <p>
                    “Terciptanya Anak Mandiri, Cerdas dan Berbudi Pekerti”

                    </p>
                </div>

                <div class="school-profile-box">
                    <strong>Misi</strong>

                    <ul>
                        <li>Melatih Anak mandiri melalui kegiatan Pembiasaan sehari hari</li>
                        <li>Melaksanakan Pembelajaran yang menyenangkan untuk menumbuhkan Ide dan Bernyanyi sesuai kemampuan anak</li>
                        <li>Melatih Untuk bersikap sopan santun</li>
                    </ul>

                </div>

            </div>

        </div>

    </div>

    <div class="school-profile-section">

        <h4 class="school-profile-section-title">
            Fasilitas Sekolah
        </h4>

        <div class="school-profile-facilities">

            <!-- RUANG KELAS -->
            <div class="school-profile-facility">

                <div class="school-profile-facility-icon">
                    🏫
                </div>

                <h5>Ruang Kelas</h5>

                <p>2 Ruang</p>

            </div>

            <!-- RUANG GURU -->
            <div class="school-profile-facility">

                <div class="school-profile-facility-icon">
                    👩‍🏫
                </div>

                <h5>Ruang Guru</h5>

                <p>1 Ruang</p>

            </div>

        
            <div class="school-profile-facility">

                <div class="school-profile-facility-icon">
                    🌳
                </div>

                <h5>Halaman Bermain</h5>

                <p>Luas</p>

            </div>

        </div>

    </div>

    @else

    <div class="card-table text-center">

        <h4 class="mb-3">
            Belum Ada Data Profil
        </h4>

        <a href="{{ route('admin.profile.create') }}"
           class="btn-add">
            + Tambah Profil
        </a>

    </div>

    @endif

</div>

@endsection