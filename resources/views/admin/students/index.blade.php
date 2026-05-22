@extends('admin.layouts.app')

@section('title','Data Siswa')

@section('content')

<div class="card">

  <style>

    .card{
      overflow-x:auto;
    }

    .table-wrap{
      width:100%;
      overflow-x:auto;
    }

    .student-table{
      width:100%;
      min-width:1200px;
      border-collapse:collapse;
    }

    .student-table th{
      background:#f3f4f6;
      text-align:left;
      padding:18px 20px;
      font-size:15px;
      font-weight:700;
      color:#111827;
      white-space:nowrap;
    }

    .student-table td{
      padding:20px;
      border-top:1px solid #e5e7eb;
      font-size:15px;
      color:#111827;
      vertical-align:middle;
      white-space:nowrap;
    }

    .student-table tbody tr:hover{
      background:#f9fafb;
    }

    .aksi-group{
      display:flex;
      align-items:center;
      gap:10px;
      flex-wrap:nowrap;
    }

    .btn-edit,
    .btn-delete{
      min-width:90px;
      text-align:center;
      white-space:nowrap;
    }

  </style>

  <div class="toolbar">

    <div>

      <h2 class="card-title">
        Data Siswa
      </h2>

      <div class="muted">
        Kelola data siswa PAUD.
      </div>

    </div>

    <a href="{{ route('admin.students.create') }}"
       class="btn btn-primary btn-add">

      + Tambah Siswa

    </a>

  </div>

  {{-- SEARCH --}}
  <form class="search" method="GET">

    <input
      type="text"
      class="input"
      name="q"
      value="{{ request('q') }}"
      placeholder="Cari nama / NISN / orang tua">

    <button
      type="submit"
      class="btn btn-search">

      Cari

    </button>

  </form>

  {{-- TABLE --}}
  <div class="table-wrap">

    <table class="student-table">

      <thead>

        <tr>

          <th>Nama</th>

          <th>NISN</th>

          <th>Jenis Kelamin</th>

          <th>Kelas</th>

          <th>Orang Tua</th>

          <th>Telepon</th>

          <th>Status</th>

          <th>Aksi</th>

        </tr>

      </thead>

      <tbody>

        @forelse($students as $s)

        <tr>

          <td>
            {{ $s->name }}
          </td>

          <td>
            {{ $s->nisn ?? '-' }}
          </td>

          <td>
            {{ $s->gender ?? '-' }}
          </td>

          <td>
            {{ optional($s->schoolClass)->name ?? '-' }}
          </td>

          <td>
            {{ $s->parent_name ?? '-' }}
          </td>

          <td>
            {{ $s->parent_phone ?? '-' }}
          </td>

          <td>

            @if($s->is_active)

              <span class="badge badge-ok">
                Aktif
              </span>

            @else

              <span class="badge badge-off">
                Nonaktif
              </span>

            @endif

          </td>

          <td>

            <div class="aksi-group">

              <a href="{{ route('admin.students.edit',$s) }}"
                 class="btn btn-outline btn-edit">

                Edit

              </a>

              <form method="POST"
                    action="{{ route('admin.students.destroy',$s) }}"
                    onsubmit="return confirm('Hapus data siswa ini?')">

                @csrf
                @method('DELETE')

                <button
                  type="submit"
                  class="btn btn-danger btn-delete">

                  Hapus

                </button>

              </form>

            </div>

          </td>

        </tr>

        @empty

        <tr>

          <td colspan="8"
              class="empty-table">

            Belum ada data siswa.

          </td>

        </tr>

        @endforelse

      </tbody>

    </table>

  </div>

  {{-- PAGINATION --}}
  <div class="pagination-wrap">

    {{ $students->links() }}

  </div>

</div>

@endsection