# SIPARI
## Sistem Informasi PAUD Roudlotul Ilmi

SIPARI (Sistem Informasi PAUD Roudlotul Ilmi) merupakan aplikasi berbasis web yang dikembangkan dalam kegiatan **Project Based Learning (PBL) Tahun 2026** Program Studi Teknologi Rekayasa Perangkat Lunak, Politeknik Negeri Banyuwangi.

Aplikasi ini bertujuan untuk membantu digitalisasi administrasi dan penyampaian informasi di PAUD Roudlotul Ilmi, Banyuwangi. Sistem mendukung pengelolaan data guru, siswa, kegiatan harian, perkembangan siswa, presensi, pembayaran SPP, hingga website profil sekolah sehingga proses administrasi menjadi lebih efektif, terintegrasi, dan mudah diakses.

## Identitas Kelompok
Kelas: 3B TRPL
1. Lilis Thalisa 
2. Ajeng Maulida Puspita
3. Nisa Eka Kholifaturrizkiah
4. Siti Faiqotul Kifiyah

---

# Fitur Utama

## Admin
- Login Admin
- Dashboard Admin
- Kelola Data Guru
- Kelola Data Siswa
- Kelola Pembayaran SPP
- Kelola Website Sekolah
- Kelola Profil Sekolah
- Kelola Program Sekolah
- Kelola Galeri
- Rekap Presensi Guru
- Rekap Presensi Siswa

## Guru
- Login Guru
- Dashboard Guru
- Presensi Guru
- Presensi Siswa
- Input Kegiatan Harian Siswa
- Input Perkembangan Siswa
- Melihat Data Siswa

## Orang Tua
- Login Orang Tua
- Dashboard Orang Tua
- Melihat Informasi Data Anak
- Melihat Kegiatan Harian Anak
- Melihat Perkembangan Anak
- Melihat Status Pembayaran SPP

## Website Publik
- Beranda
- Profil Sekolah
- Program Sekolah
- Galeri
- Kontak

---

# Tech Stack

## Backend
- PHP 8.x
- Laravel 12

## Frontend
- Blade Template
- HTML5
- CSS3
- JavaScript
- Bootstrap 5

## Database
- MySQL

## Development Tools
- Visual Studio Code
- Laragon
- Git
- GitHub
- Figma
- Notion

---

# Panduan Instalasi

## 1. Clone Repository

```bash
git clone https://github.com/TRPL-JBI/pbl-2026-kelompok-6-sipari.git
```

## 2. Masuk ke Folder Project

```bash
cd pbl-2026-kelompok-6-sipari
```

## 3. Install Dependency

```bash
composer install
```

```bash
npm install
```

## 4. Copy File Environment

```bash
cp .env.example .env
```

## 5. Generate Application Key

```bash
php artisan key:generate
```

## 6. Konfigurasi Database

Sesuaikan konfigurasi database pada file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sipari
DB_USERNAME=root
DB_PASSWORD=
```

## 7. Migrasi Database dan Seeder

```bash
php artisan migrate --seed
```

## 8. Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser dan akses:

```
http://127.0.0.1:8000
```

---

# Struktur Folder

```
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

---

# Anggota Kelompok 6 - Shining Star

| Nama | Kontribusi |
|------|------------|
| Ajeng Maulida | Backend, Frontend, Website Publik, Pembayaran SPP |
| Nisa | Backend Presensi, Frontend Dashboard Guru |
| Lilis | Backend Database, Kegiatan Harian, Perkembangan Siswa, CMS |
| Fia | UI/UX Design, Authentication, Frontend |

---

# Mitra

**PAUD Roudlotul Ilmi**

Alamat:

Dusun Pasinan Timur, Kecamatan Singojuruh, Kabupaten Banyuwangi, Jawa Timur.

---

# Mata Kuliah

**Project Based Learning (PBL) Tahun 2026**

Program Studi Teknologi Rekayasa Perangkat Lunak

Politeknik Negeri Banyuwangi

---

# Informasi Tambahan

Repository ini dibuat sebagai bagian dari pengumpulan proyek **Project Based Learning (PBL) Tahun 2026**.

Seluruh proses pengembangan dilakukan menggunakan metode **Agile Scrum** yang terdiri dari lima sprint pengembangan, mulai dari analisis kebutuhan pengguna, perancangan antarmuka, implementasi sistem, pengujian, hingga finalisasi aplikasi.

---

# Lisensi

Project ini dikembangkan untuk keperluan akademik dalam kegiatan **Project Based Learning (PBL)** Program Studi Teknologi Rekayasa Perangkat Lunak, Politeknik Negeri Banyuwangi.

© 2026 Kelompok 6 - Shining Star
