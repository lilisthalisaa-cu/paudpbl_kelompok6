<!-- TOPBAR -->
<div class="topbar">
  <div class="container flex between">
    <div>📍 Dusun Pasinan Timur, Banyuwangi</div>
    <div>📞 0821-4518-2975</div>
  </div>
</div>

<!-- NAVBAR -->
<div class="navbar">
  <div class="container flex between align-center">

    <!-- LOGO -->
    <h2 class="logo">PAUD Raudhatul Ilmi</h2>

    <!-- HAMBURGER -->
    <div class="menu-toggle" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <!-- MENU -->
    <nav id="menu">

      <a href="/">Home</a>

      <div class="dropdown">
        <a href="#">Tentang ▾</a>

        <div class="dropdown-menu">
          <a href="/profile">Profil Sekolah</a>
          <a href="/visi-misi" class="{{ request()->is('visi-misi') ? 'active' : '' }}">
            Visi Misi
          </a>
          <a href="/struktur">Struktur</a>
        </div>
      </div>

      <a href="#">Program</a>
      <a href="/gallery">Gallery</a>
      <a href="#">Contact</a>

    </nav>

  </div>
</div>