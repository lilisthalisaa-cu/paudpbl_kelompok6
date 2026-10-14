@extends('admin.layouts.app')

@section('title', 'Tambah Siswa')

@section('content')

<div class="card student-form-card">
    <div class="card-head">
        <div>
            <h2 class="card-title">Tambah Siswa</h2>
            <div class="muted">
                Isi data siswa untuk kebutuhan presensi & laporan.
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.students.store') }}">
        @csrf

        <div class="form">
            <div>
                <label class="label">Nama</label>
                <input type="text" class="input" name="name"
                    value="{{ old('name') }}" placeholder="Nama lengkap siswa" required>
            </div>

            <div>
                <label class="label">NISN</label>
                <input type="text" class="input" name="nisn"
                    value="{{ old('nisn') }}" placeholder="NISN siswa" required>
            </div>

            <div class="full">
                <label class="label">Jenis Kelamin</label>
                <div class="class-button-group">
                    <label class="class-button">
                        <input type="radio" name="gender" value="L"
                            {{ old('gender') == 'L' ? 'checked' : '' }}>
                        <span>L</span>
                    </label>

                    <label class="class-button">
                        <input type="radio" name="gender" value="P"
                            {{ old('gender') == 'P' ? 'checked' : '' }}>
                        <span>P</span>
                    </label>
                </div>
            </div>

            <div class="full">
                <label class="label">Kelas</label>
                <div class="class-button-group">
                    @foreach ($classes as $c)
                        <label class="class-button">
                            <input type="radio" name="school_class_id"
                                value="{{ $c->id }}"
                                {{ old('school_class_id') == $c->id ? 'checked' : '' }}>
                            <span>Kelas {{ $c->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="label">Nama Orang Tua</label>
                <input type="text" class="input" name="parent_name"
                    id="parentName" value="{{ old('parent_name') }}"
                    placeholder="Nama orang tua" required>
            </div>

            <div>
                <label class="label">Telepon Orang Tua</label>
                <input type="text" class="input" name="parent_phone"
                    value="{{ old('parent_phone') }}"
                    placeholder="08xxxxxxxxxx">
            </div>

            <div class="full">
                <label class="label">Akun Orang Tua</label>
                <div class="class-button-group">
                    <label class="class-button">
                        <input type="radio" name="account_mode" value="existing"
                            {{ old('account_mode', 'existing') == 'existing' ? 'checked' : '' }}>
                        <span>Gunakan akun yang sudah ada</span>
                    </label>

                    <label class="class-button">
                        <input type="radio" name="account_mode" value="new"
                            {{ old('account_mode') == 'new' ? 'checked' : '' }}>
                        <span>Buat akun baru</span>
                    </label>
                </div>
            </div>

            <div class="full" id="existingAccountFields">
                <label class="label">Pilih Akun Orang Tua</label>
                <select class="input" name="parent_user_id" id="parentUserId">
                    <option value="">-- Pilih akun orang tua --</option>
                    @foreach ($parentUsers as $parentUser)
                        <option value="{{ $parentUser->id }}"
                            data-parent-name="{{ $parentUser->name }}"
                            {{ old('parent_user_id') == $parentUser->id ? 'selected' : '' }}>
                            {{ $parentUser->name }} — {{ $parentUser->username }}
                        </option>
                    @endforeach
                </select>
                <div class="muted">
                    Akun yang dipilih akan digunakan tanpa membuat akun duplikat.
                </div>
            </div>

            <div id="newAccountFields" class="full">
                <div>
                    <label class="label">Username Parent</label>
                    <input type="text" class="input" name="username"
                        id="parentUsername" value="{{ old('username') }}"
                        placeholder="Username untuk login orang tua">
                </div>

                <div style="margin-top: 12px;">
                    <label class="label">Password Parent</label>
                    <div class="password-wrapper">
                        <input type="password" class="input"
                            id="studentPassword" name="password"
                            placeholder="Minimal 6 karakter">
                        <button type="button" class="toggle-password"
                            id="toggleStudentPassword">👁</button>
                    </div>
                </div>
            </div>

            <div class="full">
                <label class="label">Alamat</label>
                <textarea class="textarea" name="address"
                    placeholder="Alamat siswa">{{ old('address') }}</textarea>
            </div>

            <div class="full">
                <label class="label">Status</label>
                <label class="status-check">
                    <input type="checkbox" name="is_active" value="1"
                        {{ old('is_active', '1') ? 'checked' : '' }}>
                    <span>Aktif</span>
                </label>
            </div>
        </div>

        <div class="actions">
            <button class="btn-save" type="submit">Simpan</button>
            <a href="{{ route('admin.students.index') }}" class="btn-cancel">
                Kembali
            </a>
        </div>
    </form>
</div>

<script>
    const accountModeInputs = document.querySelectorAll(
        'input[name="account_mode"]'
    );

    const existingFields = document.getElementById('existingAccountFields');
    const newFields = document.getElementById('newAccountFields');
    const parentUserSelect = document.getElementById('parentUserId');
    const parentNameInput = document.getElementById('parentName');
    const usernameInput = document.getElementById('parentUsername');
    const passwordInput = document.getElementById('studentPassword');

    function updateAccountFields() {
        const mode = document.querySelector(
            'input[name="account_mode"]:checked'
        )?.value;

        const isExisting = mode === 'existing';

        existingFields.hidden = !isExisting;
        newFields.hidden = isExisting;

        parentUserSelect.required = isExisting;
        usernameInput.required = !isExisting;
        passwordInput.required = !isExisting;

        parentUserSelect.disabled = !isExisting;
        usernameInput.disabled = isExisting;
        passwordInput.disabled = isExisting;

        if (isExisting) {
            updateParentName();
        }
    }

    function updateParentName() {
        const selected = parentUserSelect.options[parentUserSelect.selectedIndex];

        if (selected && selected.value) {
            parentNameInput.value = selected.dataset.parentName || '';
        }
    }

    accountModeInputs.forEach(input => {
        input.addEventListener('change', updateAccountFields);
    });

    parentUserSelect.addEventListener('change', updateParentName);

    document.getElementById('toggleStudentPassword')
        .addEventListener('click', function () {
            passwordInput.type =
                passwordInput.type === 'password' ? 'text' : 'password';

            this.textContent =
                passwordInput.type === 'password' ? '👁' : '🙈';
        });

    updateAccountFields();
</script>

@endsection