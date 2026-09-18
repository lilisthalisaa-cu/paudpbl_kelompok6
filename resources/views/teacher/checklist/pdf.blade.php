<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checklist Harian</title>
</head>

<body class="pdf-checklist-page">

    <div class="pdf-checklist-header">
        <h1>Checklist Harian</h1>
        <p>Catatan hasil pengamatan perkembangan anak setiap hari.</p>
    </div>

    <div class="pdf-checklist-info">
        <table>
            <tr>
                <td><strong>Guru</strong></td>
                <td>: {{ $teacher->name ?? '-' }}</td>
            </tr>

            <tr>
                <td><strong>Tanggal</strong></td>
                <td>
                    : {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}
                </td>
            </tr>
        </table>
    </div>

    <table class="pdf-checklist-table">

        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anak</th>
                <th>Tanggal</th>
                <th>Kelas</th>
                <th>Tema</th>
                <th>Konteks Kegiatan</th>
                <th>Observasi</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($checklists as $index => $checklist)

                <tr>
                    <td>
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $checklist->student->name ?? '-' }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($checklist->date)->format('d/m/Y') }}
                    </td>

                    <td>
                        {{ $checklist->schoolClass->name ?? '-' }}
                    </td>

                    <td>
                        {{ $checklist->theme ?? '-' }}
                    </td>

                    <td>
                        {{ $checklist->context ?? '-' }}
                    </td>

                    <td>
                        {{ $checklist->observation ?? '-' }}
                    </td>

                    <td>
                        @if ($checklist->status === 'SM')
                            Sudah Muncul
                        @else
                            Belum Muncul
                        @endif
                    </td>

                    <td>
                        {{ $checklist->notes ?? '-' }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="9" class="pdf-checklist-empty">
                        Belum ada data checklist harian.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="pdf-checklist-footer">
        SIPARI - Sistem Informasi PAUD Roudlotul Ilmi
    </div>

</body>
</html>