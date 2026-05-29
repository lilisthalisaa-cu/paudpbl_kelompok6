@extends('teacher.layouts.app')

@section('title','Rekap Perkembangan Anak')

@section('content')

@php

$labels = [];
$tbData = [];
$bbData = [];

foreach($data as $d){

    $labels[] = \Carbon\Carbon::create()
        ->month((int)$d->month)
        ->translatedFormat('M');

    $tbData[] = $d->tb ?? 0;

    $bbData[] = $d->bb ?? 0;
}

@endphp

<div class="card development-card">

    <div class="card-head top-head">

        <div>
            <h2 class="card-title">
                Rekap Perkembangan Anak
            </h2>

            <div class="muted">
                Riwayat perkembangan siswa per tahun.
            </div>
        </div>

        <a href="{{ route('teacher.development.create') }}"
           class="btn-rekap">

            Input Perkembangan

        </a>

    </div>

    {{-- FILTER --}}
    <form method="GET"
          class="development-filter">

        <select name="student_id"
                class="input"
                onchange="this.form.submit()">

            <option value="">
                Semua Siswa
            </option>

            @foreach($students as $s)

                <option value="{{ $s->id }}"
                    {{ request('student_id') == $s->id ? 'selected' : '' }}>

                    {{ $s->name }}

                </option>

            @endforeach

        </select>

        <input type="number"
               name="year"
               class="input"
               value="{{ $year }}"
               onchange="this.form.submit()">

    </form>

    {{-- GRAFIK --}}
    <div class="chart-card">

        <canvas id="tbChart"></canvas>

    </div>

    <div class="chart-card chart-space">

        <canvas id="bbChart"></canvas>

    </div>

    {{-- TABLE --}}
    <div class="development-table-wrap">

        <table class="development-table">

            <thead>

                <tr>

                    <th>Nama</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>TB</th>
                    <th>BB</th>
                    <th>Catatan</th>

                </tr>

            </thead>

            <tbody>

                @forelse($data as $d)

                    <tr>

                        <td>
                            {{ $d->student->name }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::create()->month((int)$d->month)->translatedFormat('F') }}
                        </td>

                        <td>
                            {{ $d->year }}
                        </td>

                        <td>
                            {{ $d->tb }} cm
                        </td>

                        <td>
                            {{ $d->bb }} kg
                        </td>

                        <td>
                            {{ $d->description }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="empty-table">

                            Belum ada data perkembangan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="application/json" id="chart-labels">
{!! json_encode($labels) !!}
</script>

<script type="application/json" id="chart-tb">
{!! json_encode($tbData) !!}
</script>

<script type="application/json" id="chart-bb">
{!! json_encode($bbData) !!}
</script>

<script>

const labels = JSON.parse(
    document.getElementById('chart-labels').textContent
);

const tbData = JSON.parse(
    document.getElementById('chart-tb').textContent
);

const bbData = JSON.parse(
    document.getElementById('chart-bb').textContent
);

new Chart(document.getElementById('tbChart'), {

    type: 'line',

    data: {

        labels: labels,

        datasets: [{

            label: 'Tinggi Badan',

            data: tbData,

            tension: 0.3,

            borderWidth: 3

        }]

    }

});

new Chart(document.getElementById('bbChart'), {

    type: 'line',

    data: {

        labels: labels,

        datasets: [{

            label: 'Berat Badan',

            data: bbData,

            tension: 0.3,

            borderWidth: 3

        }]

    }

});

</script>

@endsection