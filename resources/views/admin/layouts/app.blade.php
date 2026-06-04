<!doctype html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title', 'Admin PAUD')
    </title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>

    <!-- TOPBAR -->
    <div class="topbar">

        <div class="wrap">

            <div class="left">

                <span>
                    Dusun Pasinan Timur, Singojuruh, Banyuwangi
                </span>

                <span>
                    kbroudlotulilmisngojuruh@gmail.com
                </span>

            </div>

            <div>
                +62 821 4518 2975
            </div>

        </div>

    </div>

    <!-- NAVBAR -->
    <div class="navbar">

        <div class="wrap">

            <!-- BRAND -->
            <div class="brand">
                KB Roudlotul Ilmi
            </div>

            <!-- BURGER -->
            <button class="menu-toggle"
                onclick="toggleAdminMenu()">

                <span></span>
                <span></span>
                <span></span>

            </button>

            <!-- MENU -->
            <div class="menu"
                id="adminMenu">

                <!-- DASHBOARD -->
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                    Dashboard

                </a>

                <!-- GURU -->
                <a href="{{ route('admin.teachers.index') }}"
                    class="{{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">

                    Guru

                </a>

                <!-- SISWA -->
                <a href="{{ route('admin.students.index') }}"
                    class="{{ request()->routeIs('admin.students.*') ? 'active' : '' }}">

                    Siswa

                </a>

                <!-- REKAP -->
                <a href="{{ route('admin.rekap.index') }}"
                    class="{{ request()->routeIs('admin.rekap.*') ? 'active' : '' }}">

                    Rekap

                </a>

                <!-- PEMBAYARAN -->
                <a href="{{ route('admin.payment.index') }}"
                    class="{{ request()->routeIs('admin.payment.*') ? 'active' : '' }}">

                    Pembayaran

                </a>

                <!-- WEBSITE -->
                <div class="website-dropdown">

                    <button class="website-btn"
                        type="button"
                        onclick="toggleWebsiteDropdown()">

                        Website

                    </button>

                    <div class="website-dropdown-content">

                        <a href="{{ route('admin.profile.index') }}">
                            Profil
                        </a>

                        <a href="{{ route('admin.program.index') }}">
                            Program
                        </a>

                        <a href="{{ route('admin.structure.index') }}">
                            Struktur
                        </a>

                        <a href="{{ route('admin.gallery.index') }}">
                            Galeri
                        </a>

                    </div>

                </div>

                <!-- LOGOUT -->
                <form method="POST"
                    action="{{ route('logout') }}"
                    style="margin:0;">

                    @csrf

                    <button class="btn-logout"
                        type="submit">

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </div>

    <!-- HERO -->
    @yield('hero')

    <!-- CONTENT -->
    <div class="main-container">

        @if(session('success'))

        <div class="alert-success-custom">

            {{ session('success') }}

        </div>

        @endif

        @yield('content')

    </div>

    <!-- SCRIPT -->
    <script>
        function toggleAdminMenu() {

            document
                .getElementById('adminMenu')
                .classList
                .toggle('show');
        }

        function toggleWebsiteDropdown() {

            document
                .querySelector('.website-dropdown')
                .classList
                .toggle('active');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(event, form, title = 'Hapus Data?') {

            event.preventDefault();

            Swal.fire({
                title: title,
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>