@extends('admin.layouts.app')

@section('title', 'Pembayaran Siswa')

@section('content')

<div class="container mt-4">

  <h3>Pembayaran Siswa</h3>

  <div class="card p-4 mt-3">

    <div class="table-wrapper">
      <table class="table mb-0">
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
            <td>{{ $s->name }}</td>
            <td>{{ $s->nisn }}</td>
            <td>{{ $s->schoolClass->name ?? '-' }}</td>
            <td>
              <a href="{{ route('admin.payment.show', $s->id) }}" class="btn-orange btn-sm">
                Lihat
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>

      </table>
    </div>

  </div>

</div>

@endsection