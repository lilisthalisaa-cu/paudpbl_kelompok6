<!-- TOPBAR -->
<div class="topbar">

    <div class="container topbar-wrap">

        <div class="topbar-left">
            📍 Dusun Pasinan Timur, Banyuwangi
        </div>

        <div class="topbar-right">
            📞 0821-4518-2975
        </div>

    </div>

</div>

<!-- NAVBAR -->
<header class="navbar">

    <div class="container navbar-wrap">

        <!-- LOGO -->
        <a href="/" class="logo">
            KB Roudlotul Ilmi
        </a>

        <!-- HAMBURGER -->
        <button class="menu-toggle" onclick="toggleMenu()">

            <span></span>
            <span></span>
            <span></span>

        </button>

        <!-- MENU -->
        <nav id="menu">

            <a href="/">
                Home
            </a>

            <!-- DROPDOWN -->
            <div class="dropdown">

                <a href="#" class="dropdown-toggle">
                    Tentang
                </a>

                <div class="dropdown-menu">

                    <a href="/profile">
                        Profil Sekolah
                    </a>

                    <a href="/visi-misi">
                        Visi Misi
                    </a>

                    <a href="/struktur">
                        Struktur Organisasi
                    </a>

                </div>

            </div>

            <a href="{{ route('website.program') }}">
                Program
            </a>

            <a href="/gallery">
                Gallery
            </a>

            <a href="/contact">
                Contact
            </a>

            <!-- LOGIN BUTTON -->
            <a href="/login" class="login-btn">
                Login
            </a>

        </nav>

    </div>

</header>