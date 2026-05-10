@extends('teacher.layouts.app')

@section('title','Data Kegiatan')

@section('content')

<div class="card activity-card">

    <div class="card-head top-head">

        <div>
            <h2 class="card-title">
                Data Kegiatan Siswa
            </h2>

            <div class="muted">
                Riwayat kegiatan harian siswa.
            </div>
        </div>

    </div>

    @if(session('success'))

        <div class="success-box">
            {{ session('success') }}
        </div>

    @endif

    <div class="table-wrap">

        <table class="activity-table">

            <thead>

                <tr>

                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Kegiatan</th>
                    <th>Foto</th>

                </tr>

            </thead>

            <tbody>

                @forelse($activities as $a)

                <tr>

                    <td>
                        {{ \Carbon\Carbon::parse($a->date)->translatedFormat('d M Y') }}
                    </td>

                    <td>
                        {{ $a->student->name }}
                    </td>

                    <td class="activity-desc">
                        {!! nl2br(e($a->description)) !!}
                    </td>

                    <td>

                        @if($a->photo)

                        <img src="{{ asset('storage/'.$a->photo) }}"
                             class="activity-photo">

                        @else

                        -

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4"
                        class="empty-table">

                        Belum ada data kegiatan.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection