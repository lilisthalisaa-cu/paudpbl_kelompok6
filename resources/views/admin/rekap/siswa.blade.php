@extends('admin.layouts.app')

@section('content')

<div class="card-table">

    <!-- BACK -->
    <a href="{{ route('admin.rekap.index') }}"
       class="btn btn-secondary mb-4">
        ← Kembali
    </a>

    <!-- TITLE -->
    <h2 class="title">
        Rekap Absensi Siswa
    </h2>

    <p class="subtitle">
        Pilih periode dan kelas terlebih dahulu.
    </p>

    <!-- FORM FILTER -->
    <form action="{{ route('admin.rekap.siswa.detail') }}"
          method="GET">

        <div class="d-flex gap-3 flex-wrap align-items-end">

            <!-- BULAN -->
            <div class="filter-group">

                <label>Bulan</label>

                <select name="bulan"
                        class="form-control filter-select-fix custom-select">

                    @for($i=1;$i<=12;$i++)

                        <option value="{{ $i }}"
                            {{ date('m') == $i ? 'selected' : '' }}>

                            {{ date('F', mktime(0,0,0,$i,1)) }}

                        </option>

                    @endfor

                </select>

            </div>

            <!-- TAHUN -->
            <div class="filter-group">

                <label>Tahun</label>

                <select name="tahun"
                        class="form-control filter-select-fix custom-select">

                    @for($i=date('Y');$i>=2020;$i--)

                        <option value="{{ $i }}"
                            {{ date('Y') == $i ? 'selected' : '' }}>

                            {{ $i }}

                        </option>

                    @endfor

                </select>

            </div>

            <!-- KELAS -->
            <div class="filter-group">

                <label>Kelas</label>

                <select name="kelas"
                        class="form-control filter-select-fix custom-select">

                    @foreach($classes as $class)

                        <option value="{{ $class->id }}">
                            {{ $class->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <!-- BUTTON -->
            <button class="btn btn-success">
                Terapkan
            </button>

        </div>

    </form>

</div>

@endsection