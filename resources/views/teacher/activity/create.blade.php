@extends('teacher.layouts.app')

@section('title','Input Kegiatan Siswa')

@section('content')

<div class="card activity-card">

    <div class="card-head top-head">

        <div>

            <h2 class="card-title">
                Input Kegiatan Harian
            </h2>

            <div class="muted">
                Input kegiatan seluruh siswa dalam 1 hari.
            </div>

        </div>

        <a href="{{ route('teacher.activity.index') }}"
           class="btn-outline-activity">

            Lihat Data Kegiatan

        </a>

    </div>

    @if(session('success'))

        <div class="success-box">
            {{ session('success') }}
        </div>

    @endif

    @if ($errors->any())

    <div class="error-box">

        <strong>
            ⚠ Gagal menyimpan kegiatan
        </strong>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

    <form method="POST"
          action="{{ route('teacher.activity.store') }}"
          enctype="multipart/form-data">

        @csrf

        <div class="activity-top-form">

            <div>

                <label class="label">
                    Tanggal
                </label>

                <input type="date"
                       name="activity_date"
                       class="input"
                       value="{{ old('activity_date', date('Y-m-d')) }}">

            </div>

            <div>

                <label class="label">
                    Pelajaran 1
                </label>

                <input type="text"
                       name="title_1"
                       class="input"
                       placeholder="Contoh: Mewarnai"
                       value="{{ old('title_1') }}">

            </div>

            <div>

                <label class="label">
                    Pelajaran 2
                </label>

                <input type="text"
                       name="title_2"
                       class="input"
                       placeholder="Contoh: Bernyanyi"
                       value="{{ old('title_2') }}">

            </div>

            <div>

                <label class="label">
                    Pelajaran 3
                </label>

                <input type="text"
                       name="title_3"
                       class="input"
                       placeholder="Contoh: Senam"
                       value="{{ old('title_3') }}">

            </div>

        </div>

        <div class="table-wrap">

            <table class="activity-table custom-activity-table">

                <thead>

                    <tr>

                        <th class="col-student">
                            Nama Siswa
                        </th>

                        <th class="col-activity">
                            Kegiatan 1
                        </th>

                        <th class="col-activity">
                            Kegiatan 2
                        </th>

                        <th class="col-activity">
                            Kegiatan 3
                        </th>

                        <th class="col-photo">
                            Foto<br>Hasil Karya
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($students as $student)

                    <tr>

                        <td class="student-name">
                            {{ $student->name }}
                        </td>

                        <td>

                            <textarea
                                name="activities[{{ $student->id }}][desc_1]"
                                class="input activity-textarea"
                                placeholder="Keterangan kegiatan">{{ old("activities.$student->id.desc_1") }}</textarea>

                        </td>

                        <td>

                            <textarea
                                name="activities[{{ $student->id }}][desc_2]"
                                class="input activity-textarea"
                                placeholder="Keterangan kegiatan">{{ old("activities.$student->id.desc_2") }}</textarea>

                        </td>

                        <td>

                            <textarea
                                name="activities[{{ $student->id }}][desc_3]"
                                class="input activity-textarea"
                                placeholder="Keterangan kegiatan">{{ old("activities.$student->id.desc_3") }}</textarea>

                        </td>

                        <td class="photo-upload-cell">

                            <label class="upload-btn">

                                Pilih Foto

                                <input type="file"
                                       name="activities[{{ $student->id }}][photo]"
                                       class="hidden-file-input"
                                       accept="image/*"
                                       onchange="updateFileName(this)">

                            </label>

                            <div class="file-name"></div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="activity-action">

            <button type="submit"
                    class="btn-save-activity">

                Simpan Kegiatan

            </button>

        </div>

    </form>

</div>

<script>
function updateFileName(input) {

    let fileName = '';

    if (input.files.length) {
        fileName = input.files[0].name;
    }

    input.closest('td')
         .querySelector('.file-name')
         .textContent = fileName;
}
</script>

@endsection