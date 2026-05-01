@extends('admin.layouts.app')

@section('title', 'Pembayaran Siswa')

@section('content')

<div class="container mt-4">

  <h3>Pembayaran Siswa</h3>

  <div class="card p-4 mt-3">

    <div class="row">

      <div class="col-md-4">
        <div class="p-3 h-100">
          <h5>Informasi Siswa</h5>
          <hr>
          <p><strong>Nama:</strong> {{ $student->name }}</p>
          <p><strong>NISN:</strong> {{ $student->nisn }}</p>
          <p><strong>Kelas:</strong> {{ $student->schoolClass->name ?? '-' }}</p>
        </div>
      </div>

      <div class="col-md-8">

        <div class="card payment-box p-3">

          <h5>Pembayaran Bulanan</h5>
          <hr>

          <table class="table">
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
                <td>{{ $p->bulan }}</td>
                <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>

                <td>
                  @if($p->status == 'lunas')
                    <span class="status-badge status-lunas">Lunas</span>
                  @else
                    <span class="status-badge status-belum">Belum Bayar</span>
                  @endif
                </td>

                <td>
                  @if($p->status != 'lunas')
                    <button 
                      class="btn-orange btn-sm btn-bayar"
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

</div>

<!-- MODAL -->
<div class="modal fade" id="modalBayar" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content p-3">

      <h5>Konfirmasi Pembayaran</h5>
      <p id="modalText"></p>

      <form id="formBayar" method="POST" action="{{ route('admin.payment.store') }}">
        @csrf
        <input type="hidden" name="student_id" id="student_id">
        <input type="hidden" name="bulan" id="bulan">
        <input type="hidden" name="jumlah" id="jumlah">

        <button type="submit" class="btn btn-success">
          Ya, Bayar
        </button>
      </form>

    </div>
  </div>
</div>

<script>
document.querySelectorAll('.btn-bayar').forEach(btn => {
    btn.addEventListener('click', function() {
        document.getElementById('student_id').value = this.dataset.student;
        document.getElementById('bulan').value = this.dataset.bulan;
        document.getElementById('jumlah').value = this.dataset.jumlah;

        document.getElementById('modalText').innerText =
            'Bayar SPP bulan ' + this.dataset.bulan + '?';
    });
});
</script>

@endsection