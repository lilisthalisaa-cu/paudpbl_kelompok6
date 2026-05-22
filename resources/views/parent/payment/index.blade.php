@extends('parent.layouts.app')

@section('title', 'Pembayaran SPP')

@section('content')

<div class="container">

  <!-- HEADER -->
  <div class="page-header">

    Informasi Pembayaran SPP 💰

  </div>

  {{-- ERROR --}}
  @if(session('error'))

  <div style="
    background:#fee2e2;
    color:#991b1b;
    padding:14px 16px;
    border-radius:10px;
    margin-bottom:20px;
    font-size:14px;
  ">

    {{ session('error') }}

  </div>

  @endif

  @if($student)

  <div style="
    display:flex;
    gap:20px;
    flex-wrap:wrap;
  ">

    <!-- CARD INFORMASI -->
    <div style="
      flex:1;
      min-width:280px;
    ">

      <div class="card">

        <h5 style="
          margin-bottom:10px;
          font-weight:700;
          font-size:16px;
        ">

          Informasi Tagihan

        </h5>

        <hr>

        <div style="
          display:flex;
          flex-direction:column;
          gap:12px;
          font-size:14px;
          color:#374151;
        ">

          <div>
            <strong>Nama Siswa:</strong>
            {{ $student->name ?? '-' }}
          </div>

          <div>
            <strong>NISN:</strong>
            {{ $student->nisn ?? '-' }}
          </div>

          <div>
            <strong>Nama Orang Tua:</strong>
            {{ $student->parent_name ?? '-' }}
          </div>

          <div>
            <strong>Kelas:</strong>
            {{ $student?->schoolClass?->name ?? '-' }}
          </div>

          <div>
            <strong>Tahun Ajaran:</strong>

            @if($student->created_at)

              {{ $student->created_at->format('Y') }}/{{ $student->created_at->format('Y') + 1 }}

            @else

              -

            @endif

          </div>

        </div>

        <hr style="margin:20px 0;">

        <div>

          <div style="
            font-size:13px;
            color:#6b7280;
            margin-bottom:6px;
          ">

            Total Tagihan

          </div>

          <div style="
            font-size:24px;
            font-weight:800;
            color:#111827;
          ">

            Rp {{ number_format($payments->sum('jumlah'), 0, ',', '.') }}

          </div>

        </div>

      </div>

    </div>

    <!-- TABEL PEMBAYARAN -->
    <div style="
      flex:2;
      min-width:320px;
    ">

      <div class="card">

        <h5 style="
          margin-bottom:10px;
          font-weight:700;
          font-size:16px;
        ">

          Pembayaran Bulanan

        </h5>

        <hr>

        <div class="table-wrap">

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

                <td>
                  {{ $p->bulan ?? '-' }}
                </td>

                <td>
                  Rp {{ number_format($p->jumlah ?? 0, 0, ',', '.') }}
                </td>

                <td>

                  @if(($p->status ?? '') == 'lunas')

                    <span class="status-badge status-lunas">

                      Lunas

                    </span>

                  @else

                    <span class="status-badge status-belum">

                      Belum Bayar

                    </span>

                  @endif

                </td>

              </tr>

              @empty

              <tr>

                <td colspan="3"
                    style="
                      text-align:center;
                      padding:30px;
                      color:#6b7280;
                    ">

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

  @else

  <div class="card">

    <div style="
      text-align:center;
      padding:40px;
      color:#6b7280;
      font-size:14px;
    ">

      Data siswa belum tersedia

    </div>

  </div>

  @endif

</div>

@endsection