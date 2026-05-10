@extends('admin.layouts.app')

@section('title', 'Pembayaran Siswa')

@section('content')

<div class="payment-page">

  <div class="payment-card">

    <div class="card-head">

      <div>

        <h2 class="payment-title">
          Pembayaran Siswa
        </h2>

        <div class="payment-muted">
          Kelola pembayaran SPP siswa.
        </div>

      </div>

    </div>

    <table class="payment-table">

      <thead>

        <tr>

          <th>Nama</th>

          <th>NISN</th>

          <th>Kelas</th>

          <th>Detail</th>

        </tr>

      </thead>

      <tbody>

        @foreach($students as $s)

        <tr>

          <td>
            {{ $s->name }}
          </td>

          <td>
            {{ $s->nisn }}
          </td>

          <td>
            {{ $s->schoolClass->name ?? '-' }}
          </td>

          <td>

            <a href="{{ route('admin.payment.show', $s->id) }}"
               class="btn-detail">

              Lihat

            </a>

          </td>

        </tr>

        @endforeach

      </tbody>

    </table>

  </div>

</div>

@endsection