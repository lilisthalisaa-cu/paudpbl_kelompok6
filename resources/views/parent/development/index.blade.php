{{-- @formatter:off --}}

@extends('parent.layouts.app')

@section('title', 'Perkembangan Anak')

@section('content')

<div class="development-page">

  {{-- HERO --}}
  <div class="development-hero">

    <h2>
      Perkembangan Anak 📈
    </h2>

    <p>
      Catatan perkembangan anak dari guru
    </p>

  </div>

  {{-- FILTER --}}
  <div class="development-card">

    <form method="GET"
      class="development-filter">

      <div class="filter-label">
        📅 Pilih Bulan
      </div>

      <input
        type="month"
        name="month"
        value="{{ $month ?? '' }}"
        class="input">

      <button type="submit"
        class="btn-orange">

        Filter

      </button>

    </form>

    @if($month)

    <div class="filter-info">

      Menampilkan data bulan

      <strong>
        {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}
      </strong>

    </div>

    @endif

  </div>

  @if(isset($developments) && $developments->count() > 0)

  @php
  $latest = $developments->last();
  @endphp

  {{-- SUMMARY --}}
  <div class="summary-grid">

    <div class="summary-card">

      <div class="summary-title">
        Tinggi Badan
      </div>

      <div class="summary-value">
        {{ $latest->tb ?? '-' }} cm
      </div>

    </div>

    <div class="summary-card">

      <div class="summary-title">
        Berat Badan
      </div>

      <div class="summary-value">
        {{ $latest->bb ?? '-' }} kg
      </div>

    </div>

  </div>

  {{-- GRAFIK TINGGI BADAN --}}
  <div class="chart-card">

    <div class="section-title">
      Grafik Tinggi Badan
    </div>

    <div style="height:560px; margin-top:20px;">

      <canvas id="tbChart"></canvas>

    </div>

  </div>

  {{-- GRAFIK BERAT BADAN --}}
  <div class="chart-card">

    <div class="section-title">
      Grafik Berat Badan
    </div>

    <div style="height:560px; margin-top:20px;">

      <canvas id="bbChart"></canvas>

    </div>

  </div>

  {{-- REKAP PERKEMBANGAN --}}
  <div class="timeline-card">

    <div class="section-title">
      Rekap Perkembangan Anak
    </div>

    <div class="table-wrap">

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

          @foreach($developments as $d)

          <tr>

            <td>
              {{ $d->student->name ?? '-' }}
            </td>

            <td>

              @php
              $bulan = [
              1 => 'Januari',
              2 => 'Februari',
              3 => 'Maret',
              4 => 'April',
              5 => 'Mei',
              6 => 'Juni',
              7 => 'Juli',
              8 => 'Agustus',
              9 => 'September',
              10 => 'Oktober',
              11 => 'November',
              12 => 'Desember'
              ];
              @endphp

              {{ $bulan[(int)$d->month] ?? '-' }}

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

          @endforeach

          </tbody>

      </table>

    </div>

  </div>

  @php

  $chartLabels = [];
  $chartTinggi = [];
  $chartBerat = [];

  $namaBulan = [
  1 => 'Jan',
  2 => 'Feb',
  3 => 'Mar',
  4 => 'Apr',
  5 => 'Mei',
  6 => 'Jun',
  7 => 'Jul',
  8 => 'Agu',
  9 => 'Sep',
  10 => 'Okt',
  11 => 'Nov',
  12 => 'Des'
  ];

  foreach($chartDevelopments as $d){

  $chartLabels[] = $namaBulan[(int)$d->month] ?? '-';

  $chartTinggi[] = $d->tb;
  $chartBerat[] = $d->bb;
  }

  @endphp
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script type="application/json" id="chart-labels">
    @json($chartLabels)
  </script>

  <script type="application/json" id="chart-tinggi">
    @json($chartTinggi)
  </script>

  <script type="application/json" id="chart-berat">
    @json($chartBerat)
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {

      const labels = JSON.parse(
        document.getElementById('chart-labels').textContent
      );

      const tinggiData = JSON.parse(
        document.getElementById('chart-tinggi').textContent
      );

      const beratData = JSON.parse(
        document.getElementById('chart-berat').textContent
      );

      // chart tinggi
      const tbCanvas = document.getElementById('tbChart');

      if (tbCanvas) {

        new Chart(tbCanvas, {

          type: 'line',

          data: {

            labels: labels,

            datasets: [{

              label: 'Tinggi Badan',

              data: tinggiData,

              borderColor: '#36A2EB',

              backgroundColor: '#36A2EB',

              borderWidth: 4,

              tension: 0.4,

              pointRadius: 6,

              pointHoverRadius: 8,

              fill: false,

              showLine: true

            }]
          },

          options: {

            responsive: true,

            maintainAspectRatio: false

          }

        });

      }

      // chart berat
      const bbCanvas = document.getElementById('bbChart');

      if (bbCanvas) {

        new Chart(bbCanvas, {

          type: 'line',

          data: {

            labels: labels,

            datasets: [{

              label: 'Berat Badan',

              data: beratData,

              borderColor: '#36A2EB',

              backgroundColor: '#36A2EB',

              borderWidth: 4,

              tension: 0.4,

              pointRadius: 6,

              pointHoverRadius: 8,

              fill: false,

              showLine: true

            }]

          },

          options: {

            responsive: true,

            maintainAspectRatio: false

          }

        });

      }

    });
  </script>
  @endif

  @endsection