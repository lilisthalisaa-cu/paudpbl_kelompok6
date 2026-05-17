@extends('admin.layouts.app')

@section('content')

<div class="card-table">

    <h2 class="title text-center">Rekap Presensi</h2>
    <p class="subtitle text-center">Pilih jenis rekap yang ingin ditampilkan.</p>

    <div class="rekap-grid">

        <!-- REKAP GURU -->
        <a href="/admin/rekap-absensi/guru" class="rekap-card">
           <div class="rekap-icon guru">
             👩‍🏫
           </div>

            <h4>Rekap Guru</h4>
            <p>Lihat rekap presensi data guru</p>
        </a>

        <!-- REKAP SISWA -->
        <a href="/admin/rekap-absensi/siswa" class="rekap-card">
            <div class="rekap-icon siswa">
              👨‍🎓
            </div>
            <h4>Rekap Siswa</h4>
            <p>Lihat rekap presensi data siswa</p>
        </a>

    </div>

</div>

@endsection