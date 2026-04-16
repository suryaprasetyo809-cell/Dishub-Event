# 🚌 Website Event Dishub Jawa Tengah

Sistem informasi dan pendaftaran event resmi **Dinas Perhubungan Provinsi Jawa Tengah**. Aplikasi ini berbasis PHP murni (Native PHP) dengan database MySQL, memungkinkan peserta mendaftar event dan admin mengelola data peserta serta event secara terpusat.

---

## 📸 Preview

| Halaman Utama | Admin Login |
|---|---|
| Navbar biru + hero fullscreen | Form login Admin Dishub |

---

## ✨ Fitur

### 👥 Publik
- **Beranda** — Landing page dengan hero fullscreen & navigasi
- **Profil** — Informasi profil Dinas Perhubungan Jawa Tengah
- **Visi Misi** — Halaman visi dan misi instansi
- **Daftar Event** — Lihat daftar event yang tersedia
- **Pendaftaran** — Formulir pendaftaran peserta (dengan tanda tangan digital)

### 🔒 Admin
- **Login Admin** — Autentikasi admin dengan password terenkripsi (bcrypt)
- **Dashboard** — Ringkasan statistik event dan peserta
- **Kelola Event** — CRUD event (tambah, edit, hapus)
- **Daftar Peserta** — Lihat & kelola peserta per event
- **Cetak Peserta** — Ekspor/cetak data peserta

---

## 🛠️ Tech Stack

| Komponen | Teknologi |
|---|---|
| Backend | PHP (Native / Vanilla PHP) |
| Database | MySQL 8.x |
| Frontend | HTML5, CSS3 (Vanilla) |
| Web Server | Apache (via Laragon/XAMPP) |
| Tanda Tangan | Canvas API (JavaScript) |
| Dependencies | Composer (`thecodingmachine/safe`) |

---

## 📁 Struktur Direktori

```
dishub_event/
├── admin/                  # Panel admin
│   ├── dashboard.php       # Dashboard admin
│   ├── event.php           # Kelola event
│   ├── daftar_peserta.php  # Data peserta
│   ├── cetak_peserta.php   # Cetak peserta
│   ├── login.php           # Halaman login
│   ├── proses_login.php    # Proses autentikasi
│   └── logout.php          # Logout
├── assets/                 # Gambar, CSS, JS
│   └── img/                # Logo & pamflet
├── config/
│   └── database.php        # Konfigurasi koneksi MySQL
├── vendor/                 # Dependensi Composer
├── database.sql            # Skema & data awal database
├── index.php               # Halaman beranda
├── profil.php              # Halaman profil
├── visi_misi.php           # Halaman visi misi
├── daftar_event.php        # List event publik
├── daftar.php              # Form pendaftaran peserta
├── proses_daftar.php       # Proses simpan pendaftaran
├── composer.json           # Konfigurasi Composer
└── README.md               # Dokumentasi proyek
```

---

## ⚙️ Instalasi & Konfigurasi

### Prasyarat
- **PHP** >= 8.0
- **MySQL** >= 8.0
- **Web Server**: Apache/Nginx (Laragon, XAMPP, atau WAMP)
- **Composer** (untuk dependensi)

### 1. Clone / Salin Proyek

```bash
# Clone atau salin folder ke direktori web server
# Laragon:
C:\laragon\www\dishub_event\

# XAMPP:
C:\xampp\htdocs\dishub_event\

# Atau buat junction (Windows):
New-Item -ItemType Junction -Path "C:\laragon\www\dishub_event" -Target "C:\path\to\dishub_event"
```

### 2. Import Database

Gunakan salah satu cara berikut:

**Via MySQL CLI (Laragon):**
```powershell
$mysql = "C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysql.exe"
Get-Content "database.sql" | & $mysql -u root
```

**Via MySQL CLI (XAMPP):**
```bash
mysql -u root -p < database.sql
```

**Via phpMyAdmin:**
1. Buka `http://localhost/phpmyadmin`
2. Klik **Import** → pilih `database.sql`
3. Klik **Go**

> Perintah `CREATE DATABASE IF NOT EXISTS dishub_event;` sudah termasuk di dalam `database.sql`, jadi database akan dibuat otomatis.

### 3. Konfigurasi Koneksi Database

Edit file `config/database.php`:

```php
<?php
$conn = mysqli_connect("localhost", "root", "", "dishub_event");

if (!$conn) {
    die("Gagal koneksi database: " . mysqli_connect_error());
}
```

| Parameter | Default | Keterangan |
|---|---|---|
| `host` | `localhost` | Host MySQL |
| `user` | `root` | Username MySQL |
| `password` | `""` *(kosong)* | Password MySQL (sesuaikan) |
| `database` | `dishub_event` | Nama database |

### 4. Install Dependensi Composer

```bash
composer install
```

### 5. Jalankan Proyek

Pastikan Apache dan MySQL sudah berjalan, lalu akses:

```
http://localhost/dishub_event/
```

---

## 🗄️ Skema Database

### Tabel `admin`
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | INT AUTO_INCREMENT | Primary Key |
| `username` | VARCHAR(50) | Username admin |
| `password` | VARCHAR(255) | Password (bcrypt hash) |

### Tabel `events`
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | INT AUTO_INCREMENT | Primary Key |
| `nama_event` | VARCHAR(100) | Nama kegiatan/event |
| `tanggal_event` | DATE | Tanggal pelaksanaan |

### Tabel `peserta`
| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | INT AUTO_INCREMENT | Primary Key |
| `nama` | VARCHAR(100) | Nama peserta |
| `jabatan` | VARCHAR(100) | Jabatan peserta |
| `bidang` | VARCHAR(100) | Bidang/unit kerja |
| `no_hp` | VARCHAR(20) | Nomor HP |
| `tanggal_event` | DATE | Tanggal event dihadiri |
| `event_id` | INT | Foreign Key → `events.id` |
| `tanda_tangan` | LONGTEXT | Base64 data tanda tangan |

---

## 🔑 Akun Default Admin

| Username | Password |
|---|---|
| `admin` | `admin123` |

> ⚠️ **Ganti password admin** setelah pertama kali login untuk keamanan!

---

| Dashboard Admin | `http://localhost/dishub_event/admin/dashboard.php` |

---

## 🌐 Tunneling & Sharing (Akses Eksternal)

Untuk membagikan link aplikasi ini ke luar jaringan lokal (internet), Anda dapat menggunakan tool tunneling. Berikut adalah beberapa caranya:

### 1. Menggunakan LocalTunnel (Mudah & Gratis)
Pastikan Anda sudah menginstall **Node.js**, lalu jalankan perintah berikut di terminal:
```bash
# Ganti port 80 jika Laragon Anda menggunakan port lain
npx localtunnel --port 80
```
Anda akan mendapatkan URL seperti `https://moody-goose-88.loca.lt` yang bisa dibagikan.

### 2. Menggunakan Laragon (Built-in)
Laragon memiliki fitur sharing otomatis menggunakan **Ngrok**:
1. Pastikan Apache & MySQL berjalan.
2. Klik kanan pada panel **Laragon** → **www** → **dishub_event** → **Share**.
3. Laragon akan membuka terminal Ngrok dan memberikan public URL.

### 3. Menggunakan Ngrok (Manual)
1. Download Ngrok di [ngrok.com](https://ngrok.com/).
2. Jalankan perintah:
```bash
ngrok http 80
```

> [!IMPORTANT]
> - URL Tunnel bersifat **sementara**. Jika terminal ditutup, link akan mati.
> - Pastikan koneksi internet Anda stabil saat melakukan tunneling.

---

---

## 🔧 Troubleshooting

### ❌ Gagal koneksi database
- Pastikan MySQL sudah berjalan (via Laragon/XAMPP panel)
- Cek kredensial di `config/database.php`
- Pastikan database `dishub_event` sudah diimport

### ❌ Halaman tidak ditemukan (404)
- Pastikan proyek ada di folder yang tepat (`www/` atau `htdocs/`)
- Pastikan Apache sudah berjalan

### ❌ Error `mysqli_connect`
- PHP extension `mysqli` harus aktif
- Cek `php.ini` dan pastikan `extension=mysqli` tidak dikomentari

---

## 📄 Lisensi

Proyek ini dikembangkan untuk keperluan internal **Dinas Perhubungan Provinsi Jawa Tengah**.

---

*© 2026 Dinas Perhubungan Provinsi Jawa Tengah*
