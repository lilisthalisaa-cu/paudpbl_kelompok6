@extends('parent.layouts.app')

@section('title', 'Pembayaran SPP')

@section('content')

<div class="container">

  <!-- HEADER -->
  <div class="page-header">
    Informasi Pembayaran SPP 💰
  </div>

  <div style="display:flex; gap:20px; flex-wrap:wrap;">

    <!-- 🔥 KIRI -->
    <div style="flex:1; min-width:280px;">
      <div class="card">

        <h5 style="margin-bottom:10px;">Informasi Tagihan</h5>
        <hr>

        <p><strong>Nama Siswa:</strong> {{ $student->name }}</p>
        <p><strong>NISN:</strong> {{ $student->nisn }}</p>
        <p><strong>Nama Ibu:</strong> {{ $student->parent_name }}</p>
        <p><strong>Kelas:</strong> {{ $student->schoolClass->name ?? '-' }}</p>

        <p><strong>Tahun Ajaran:</strong>
          {{ $student->created_at->format('Y') }}/{{ $student->created_at->format('Y') + 1 }}
        </p>

        <hr>

        <p>
          <strong>Total Tagihan:</strong><br>
          <span style="font-size:18px; font-weight:700;">
            Rp {{ number_format($payments->sum('jumlah'), 0, ',', '.') }}
          </span>
        </p>

      </div>
    </div>

    <!-- 🔥 KANAN -->
    <div style="flex:2; min-width:320px;">
      <div class="card">

        <h5 style="margin-bottom:10px;">Pembayaran Bulanan</h5>
        <hr>

        <table class="table">
          <thead>
            <tr>
              <th>Bulan</th>
              <th>Nominal</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody>
            @forelse($payments as $p)
            <tr>
              <td>{{ $p->bulan }}</td>
              <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
              <td>
                @if($p->status == 'lunas')
                  <span class="status-badge status-lunas">Lunas</span>
                @else
                  <span class="status-badge status-belum">Belum Bayar</span>
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="3" style="text-align:center;">
                Belum ada data pembayaran
              </td>
            </tr>
            @endforelse
          </tbody>

        </table>

      </div>
    </div>

  </div>

</div>

@endsection