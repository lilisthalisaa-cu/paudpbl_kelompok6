@extends('admin.layouts.app')
@section('title','Data Guru')

@section('content')

<div class="card teacher-card">

  <div class="toolbar">

    <div>
      <h2 class="card-title">
        Data Guru
      </h2>

      <div class="muted">
        Kelola data guru PAUD.
      </div>
    </div>

    <a
      class="btn-add-teacher"
      href="{{ route('admin.teachers.create') }}">

      + Tambah Guru

    </a>

  </div>

  <form class="search-box" method="GET">

    <input
      class="input"
      name="q"
      value="{{ request('q') }}"
      placeholder="Cari nama / NIP / email">

    <button
      class="btn-search"
      type="submit">

      Cari

    </button>

  </form>

  <div class="table-wrapper">

    <table class="table teacher-table">

      <thead>

        <tr>
          <th>Nama</th>
          <th>NIP</th>
          <th>Email</th>
          <th>Telepon</th>
          <th>Kelas</th>
          <th>Role</th>
          <th>Status</th>
          <th style="width:220px;">
            Aksi
          </th>
        </tr>

      </thead>

      <tbody>

        @forelse($teachers as $t)

        <tr>

          <td>
            {{ $t->user->name ?? '-' }}
          </td>

          <td>
            {{ $t->nip ?? '-' }}
          </td>

          <td>
            {{ $t->user->email ?? '-' }}
          </td>

          <td>
            {{ $t->phone ?? '-' }}
          </td>

          <td>
            {{ $t->schoolClass->name ?? '-' }}
          </td>

          <td>

            @if($t->user->role == 'operator')

              Operator

            @elseif($t->user->role == 'teacher')

              Guru

            @elseif($t->user->role == 'admin')

              Admin

            @else

              -

            @endif

          </td>

          <td>

            <span class="status-badge">

              Aktif

            </span>

          </td>

          <td class="action-buttons">

            <a
              class="btn-edit"
              href="{{ route('admin.teachers.edit',$t) }}">

              Edit

            </a>

            <form
              method="POST"
              action="{{ route('admin.teachers.destroy',$t) }}"
              style="display:inline-block;"
              onsubmit="return confirm('Hapus data guru ini?')">

              @csrf
              @method('DELETE')

              <button
                class="btn-delete"
                type="submit">

                Hapus

              </button>

            </form>

          </td>

        </tr>

        @empty

        <tr>

          <td
            colspan="8"
            class="empty-text">

            Belum ada data guru.

          </td>

        </tr>

        @endforelse

      </tbody>

    </table>

  </div>

  <div class="pagination-wrap">

    {{ $teachers->links() }}

  </div>

</div>

<style>

.teacher-card{
  border-radius:28px;
  padding:24px;
}

.toolbar{
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:20px;
  margin-bottom:24px;
}

.search-box{
  display:flex;
  align-items:center;
  gap:12px;
  margin-bottom:20px;
}

.search-box .input{
  max-width:360px;
}

.table-wrapper{
  overflow:auto;
}

.teacher-table{
  width:100%;
  border-collapse:collapse;
}

.teacher-table thead th{
  padding:18px 14px;
  font-size:16px;
  font-weight:800;
  color:#111827;
  border-bottom:1px solid #e5e7eb;
}

.teacher-table tbody td{
  padding:18px 14px;
  border-bottom:1px solid #f1f5f9;
  color:#111827;
  font-size:15px;
}

.teacher-table tbody tr:hover{
  background:#fafafa;
}

.status-badge{
  display:inline-flex;
  align-items:center;
  justify-content:center;

  padding:8px 18px;

  background:#dcfce7;
  color:#166534;

  border-radius:999px;

  font-size:14px;
  font-weight:700;

  border:1px solid #bbf7d0;
}

.action-buttons{
  display:flex;
  align-items:center;
  gap:10px;
}

.btn-add-teacher{
  background:#f59e0b;
  color:white;
  padding:14px 26px;
  border-radius:18px;
  font-weight:800;
  text-decoration:none;
  transition:.2s;
}

.btn-add-teacher:hover{
  background:#ea980c;
}

.btn-edit{
  display:inline-flex;
  align-items:center;
  justify-content:center;

  padding:12px 22px;

  border-radius:16px;

  background:white;
  color:#111827;

  border:1px solid #d1d5db;

  font-weight:700;
  text-decoration:none;

  transition:.2s;
}

.btn-edit:hover{
  background:#f9fafb;
}

.btn-delete{
  border:none;

  background:#ef4444;
  color:white;

  padding:12px 22px;

  border-radius:16px;

  font-weight:700;

  cursor:pointer;

  transition:.2s;
}

.btn-delete:hover{
  background:#dc2626;
}

.btn-search{
  border:none;

  background:#111827;
  color:white;

  padding:12px 18px;

  border-radius:14px;

  font-weight:700;

  cursor:pointer;
}

.empty-text{
  text-align:center;
  padding:28px !important;
  color:#6b7280;
}

.pagination-wrap{
  margin-top:20px;
}

</style>

@endsection