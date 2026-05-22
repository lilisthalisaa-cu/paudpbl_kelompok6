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

            <!-- MENU -->
            <div class="menu">

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

                <!-- WEBSITE DROPDOWN -->
                <div class="website-dropdown">

                    <button class="website-btn">

                        Website ▼

                    </button>

                    <div class="website-dropdown-content">

                        <!-- PROFILE -->
                        <a href="{{ route('admin.profile.index') }}"
                            class="{{ request()->routeIs('admin.profile.*') ? 'active-dropdown' : '' }}">

                            Profil

                        </a>

                        <!-- PROGRAM -->
                        <a href="{{ route('admin.program.index') }}"
                            class="{{ request()->routeIs('admin.program.*') ? 'active-dropdown' : '' }}">

                            Program

                        </a>

                        <!-- STRUKTUR -->
                        <a href="{{ route('admin.structure.index') }}"
                            class="{{ request()->routeIs('admin.structure.*') ? 'active-dropdown' : '' }}">

                            Struktur

                        </a>

                        <!-- GALLERY -->
                        <a href="{{ route('admin.gallery.index') }}"
                            class="{{ request()->routeIs('admin.gallery.*') ? 'active-dropdown' : '' }}">

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

        <!-- ALERT -->
        @if(session('success'))

        <div class="alert-success-custom">

            {{ session('success') }}

        </div>

        @endif

        <!-- CONTENT -->
        @yield('content')

    </div>

    <!-- SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>