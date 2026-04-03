@extends('parent.layouts.app')

@section('title', 'Dashboard Orang Tua')

@section('content')
<div class="card">
  <div class="card-head">
    <div>
      <h2 class="card-title">Dashboard Orang Tua</h2>
      <div class="muted">Selamat datang, {{ auth()->user()->name }}</div>
    </div>
  </div>

  <div class="stats-grid">
    <div class="stat">
      <small>Nama Anak</small>
      <strong>{{ $student->name ?? 'Belum tersedia' }}</strong>
    </div>

    <div class="stat">
      <small>NISN</small>
      <strong>{{ $student->nisn ?? '-' }}</strong>
    </div>

    <div class="stat">
      <small>Kelas</small>
      <strong>{{ optional($student->schoolClass)->name ?? '-' }}</strong>
    </div>
  </div>
</div>


<div class="card" style="margin-top:18px;">
  <div class="card-head">
    <div>
      <h3 class="card-title">Perkembangan & Kegiatan Harian</h3>
      <div class="muted">Informasi kegiatan anak di sekolah.</div>
    </div>
  </div>

  @if(!empty($activities) && count($activities) > 0)
    <table class="table">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Kegiatan</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        @foreach($activities as $activity)
          <tr>
            <td>{{ $activity->date ?? '-' }}</td>
            <td>{{ $activity->title ?? '-' }}</td>
            <td>{{ $activity->description ?? '-' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="muted">Belum ada data kegiatan harian.</div>
  @endif
</div>


<div class="card" style="margin-top:18px;">
  <div class="card-head">
    <div>
      <h3 class="card-title">Informasi Pembayaran SPP</h3>
      <div class="muted">Status dan riwayat pembayaran anak.</div>
    </div>
  </div>

  <div class="stats-grid" style="margin-bottom:16px;">
    <div class="stat">
      <small>Status Pembayaran</small>
      <strong>{{ $paymentStatus ?? 'Belum tersedia' }}</strong>
    </div>

    <div class="stat">
      <small>Nominal SPP</small>
      <strong>
        Rp {{ number_format($paymentAmount ?? 0, 0, ',', '.') }}
      </strong>
    </div>

    <div class="stat">
      <small>Total Riwayat</small>
      <strong>
        {{ !empty($paymentHistories) ? count($paymentHistories) : 0 }}
      </strong>
    </div>
  </div>

  @if(!empty($paymentHistories) && count($paymentHistories) > 0)
    <table class="table">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Nominal</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($paymentHistories as $payment)
          <tr>
            <td>{{ $payment->date ?? '-' }}</td>
            <td>Rp {{ number_format($payment->amount ?? 0, 0, ',', '.') }}</td>
            <td>
              @if(($payment->status ?? '') === 'Lunas')
                <span class="badge badge-ok">Lunas</span>
              @else
                <span class="badge badge-off">Belum</span>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="muted">Belum ada riwayat pembayaran.</div>
  @endif
</div>
@endsection