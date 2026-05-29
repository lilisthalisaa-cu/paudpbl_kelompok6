@extends('admin.layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')

<div class="payment-page">

  <div class="payment-card">

    <div class="card-head">

      <div>

        <h2 class="payment-title">
          Detail Pembayaran
        </h2>

        <div class="payment-muted">
          Informasi pembayaran siswa.
        </div>

      </div>

    </div>

    <div class="payment-layout">

      {{-- INFO --}}
      <div class="info-card">

        <div class="info-title">
          Informasi Siswa
        </div>

        <div class="info-item">
          <strong>Nama:</strong>
          {{ $student->name }}
        </div>

        <div class="info-item">
          <strong>NISN:</strong>
          {{ $student->nisn }}
        </div>

        <div class="info-item">
          <strong>Kelas:</strong>
          {{ $student->schoolClass->name ?? '-' }}
        </div>

      </div>

      {{-- TABLE --}}
      <div class="payment-table-card">

        <div class="table-title">
          Pembayaran Bulanan
        </div>

        <table class="payment-table">

          <thead>

            <tr>

              <th>Bulan</th>

              <th>Nominal</th>

              <th>Status</th>

              <th>Aksi</th>

            </tr>

          </thead>

          <tbody>

            @foreach($payments as $p)

            <tr>

              <td>
                {{ $p->bulan }}
              </td>

              <td>
                Rp {{ number_format($p->jumlah,0,',','.') }}
              </td>

              <td>

                @if($p->status == 'lunas')

                  <span class="status-badge status-lunas">
                    Lunas
                  </span>

                @else

                  <span class="status-badge status-belum">
                    Belum Bayar
                  </span>

                @endif

              </td>

              <td>

                @if($p->status != 'lunas')

                <button
                  class="btn-bayar btn-open-modal"
                  data-student="{{ $student->id }}"
                  data-bulan="{{ $p->bulan }}"
                  data-jumlah="{{ $p->jumlah }}"
                  data-bs-toggle="modal"
                  data-bs-target="#modalBayar">

                  Bayar

                </button>

                @else

                -

                @endif

              </td>

            </tr>

            @endforeach

          </tbody>

        </table>

      </div>

    </div>

  </div>

</div>

{{-- MODAL --}}
<div class="modal fade"
     id="modalBayar"
     tabindex="-1">

  <div class="modal-dialog">

    <div class="modal-content p-4">

      <h5 class="modal-title-payment">
        Konfirmasi Pembayaran
      </h5>

      <p id="modalText"></p>

      <form id="formBayar"
            method="POST"
            action="{{ route('admin.payment.store') }}">

        @csrf

        <input type="hidden"
               name="student_id"
               id="student_id">

        <input type="hidden"
               name="bulan"
               id="bulan">

        <input type="hidden"
               name="jumlah"
               id="jumlah">

        <button type="submit"
                class="modal-btn">

          Ya, Bayar

        </button>

      </form>

    </div>

  </div>

</div>

<script>

document.querySelectorAll('.btn-open-modal')

.forEach(btn => {

    btn.addEventListener('click', function(){

        document.getElementById('student_id').value =
            this.dataset.student;

        document.getElementById('bulan').value =
            this.dataset.bulan;

        document.getElementById('jumlah').value =
            this.dataset.jumlah;

        document.getElementById('modalText').innerText =
            'Bayar SPP bulan ' + this.dataset.bulan + '?';

    });

});

</script>

@endsection