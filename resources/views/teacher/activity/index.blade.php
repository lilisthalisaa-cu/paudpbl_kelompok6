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

        <a href="{{ route('teacher.dashboard') }}"
           class="btn-outline-activity">

            ← Kembali

        </a>

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
                    <th>Nama Siswa</th>
                    <th>Kegiatan</th>
                    <th>Foto</th>

                </tr>

            </thead>

            <tbody>

                @forelse($activities as $activity)

                    @foreach($activity->activityStudents as $item)

                    <tr>

                        <td>
                            {{ \Carbon\Carbon::parse($activity->date)->translatedFormat('d M Y') }}
                        </td>

                        <td>
                            {{ $item->student->name ?? '-' }}
                        </td>

                        <td class="activity-desc">

                            <strong>
                                {{ $activity->activity_1 }}
                            </strong>

                            <br>

                            {{ $item->desc_1 }}

                            @if($activity->activity_2)

                                <br><br>

                                <strong>
                                    {{ $activity->activity_2 }}
                                </strong>

                                <br>

                                {{ $item->desc_2 }}

                            @endif

                            @if($activity->activity_3)

                                <br><br>

                                <strong>
                                    {{ $activity->activity_3 }}
                                </strong>

                                <br>

                                {{ $item->desc_3 }}

                            @endif

                        </td>

                        <td>

                            @if($item->photo)

                                <img
                                    src="{{ route('teacher.activity.photo', $item->id) }}"
                                    class="activity-photo">

                            @else

                                -

                            @endif

                        </td>

                    </tr>

                    @endforeach

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