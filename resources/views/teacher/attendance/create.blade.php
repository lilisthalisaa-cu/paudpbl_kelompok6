@extends('teacher.layouts.app')

@section('title', 'Input Absensi Guru')

@section('content')

<div class="card">

  <div class="card-head top-head">

    <div>
      <h2 class="card-title">Input Presensi Guru</h2>
      <div class="muted">
        Lakukan presensi kehadiran hari ini.
      </div>
    </div>

    <a href="{{ route('teacher.attendance.index') }}" class="btn-rekap">
      Lihat Rekap
    </a>

  </div>

  {{-- SUCCESS --}}
  @if(session('success'))
  <div class="auth-error">
    {{ session('success') }}
  </div>
  @endif

  {{-- ERROR --}}
  @if ($errors->any())

<div class="error-box">

    <strong>
        Gagal mengirim presensi
    </strong>

    <ul>

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

  {{-- INFO --}}
  <div class="attendance-box">

    <div class="attendance-detail-box">

      <div class="info-item">
        Tanggal :
        <span>{{ now()->format('d M Y') }}</span>
      </div>

      @if($attendance)

      <div class="info-item">
        Status :
        <span>{{ $attendance->status }}</span>
      </div>

      <div class="info-item">
        Jam Masuk :
        <span>{{ $attendance->jam_masuk ?? '-' }}</span>
      </div>

      <div class="info-item">
        Jam Pulang :
        <span>{{ $attendance->jam_pulang ?? '-' }}</span>
      </div>

      @endif

    </div>
    @if($attendance && $attendance->jam_pulang)

    <div class="attendance-success">
      Presensi hari ini selesai ✅
    </div>

    @endif

  </div>

  {{-- BELUM ABSEN --}}
  @if(!$attendance)

  <div class="action-group">

    {{-- HADIR --}}
    <form method="POST"
      action="{{ route('teacher.attendance.hadir') }}">
      @csrf

      <button type="submit"
        class="btn-action btn-hadir">
        Hadir
      </button>
    </form>

    {{-- TOMBOL IZIN --}}
    <button onclick="toggleIzinForm()"
      type="button"
      class="btn-action btn-izin">
      Izin / Cuti
    </button>

  </div>

  {{-- FORM IZIN --}}
  <div id="izinForm"
    class="form-box"
    style="display:none;">

    <form method="POST"
      action="{{ route('teacher.attendance.izin') }}"
      enctype="multipart/form-data">

      @csrf

      <div class="field">
        <label class="label">Jenis</label>

        <div class="status-group">

          <label class="status-option">
            <input type="radio" 
                   name="status" 
                   value="IZIN" 
                   {{ old('status') == 'IZIN' ? 'checked' : '' }}
                   required>
            <span>Izin</span>
          </label>

          <label class="status-option">
            <input type="radio" 
                   name="status" 
                   value="SAKIT"
                   {{ old('status') == 'SAKIT' ? 'checked' : '' }}>
            <span>Sakit</span>
          </label>

          <label class="status-option">
            <input type="radio" 
                   name="status" 
                   value="CUTI"
                   {{ old('status') == 'CUTI' ? 'checked' : '' }}>
            <span>Cuti</span>
          </label>

        </div>
      </div>

      <div class="field">
        <label class="label">Catatan</label>

        <textarea name="note"
          class="input"
          rows="4"
          placeholder="Masukkan keterangan">{{ old('note') }}</textarea>
      </div>

      <div class="field">
        <label class="label">Upload Surat</label>

        <input type="file"
          name="surat"
          class="input">
      </div>

      <button type="submit"
        class="btn-action btn-izin">
        Kirim Izin
      </button>

    </form>

  </div>

  {{-- SUDAH HADIR --}}
  @elseif($attendance->status == 'HADIR' && !$attendance->jam_pulang)

  <form method="POST"
    action="{{ route('teacher.attendance.pulang') }}">
    @csrf

    <button type="submit"
      class="btn-action btn-pulang">
      Pulang
    </button>
  </form>

  {{-- SELESAI --}}
  @else
  @endif

</div>

<script>
  function toggleIzinForm() {
    const form = document.getElementById('izinForm');

    if (form.style.display === 'none') {
      form.style.display = 'block';
    } else {
      form.style.display = 'none';
    }
  }
</script>

@endsection