@extends('admin.layouts.app')

@section('title','Data Siswa')

@section('content')

<div class="card">

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

          <th>Kelas</th>

          <th>Orang Tua</th>

          <th>Telepon</th>

          <th>Status</th>

          <th class="aksi-col">
            Aksi
          </th>

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

          <td class="aksi-group">

            <a href="{{ route('admin.students.edit',$s) }}"
               class="btn btn-outline btn-edit">

              Edit

            </a>

            <form method="POST"
                  action="{{ route('admin.students.destroy',$s) }}"
                  style="display:inline-block"
                  onsubmit="return confirm('Hapus data siswa ini?')">

              @csrf
              @method('DELETE')

              <button
                type="submit"
                class="btn btn-danger btn-delete">

                Hapus

              </button>

            </form>

          </td>

        </tr>

        @empty

        <tr>

          <td colspan="7"
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