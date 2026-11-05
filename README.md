# Hastaka Holiday

Sistem Informasi Rekomendasi Paket Wisata berbasis web yang dibangun dengan **CodeIgniter 3** dan **Tailwind CSS**, menggunakan metode **SAW (Simple Additive Weighting)** untuk merekomendasikan paket wisata sesuai kriteria pengguna.

## Fitur Utama

- Manajemen paket wisata (tambah, edit, hapus, tampilkan)
- Sistem rekomendasi paket wisata dengan metode SAW
- Manajemen pemesanan paket wisata
- Manajemen user (admin dan pelanggan) dengan autentikasi
- Manajemen akomodasi, transportasi, dan mitra (bus/hotel)
- Bukti transfer pembayaran
- Dashboard admin untuk monitoring pemesanan

## Teknologi

- [CodeIgniter 3](https://codeigniter.com/) - PHP Framework
- [Tailwind CSS](https://tailwindcss.com/) - CSS Framework
- MySQL / MariaDB - Database
- Composer - Dependency Management

## Struktur Folder

```
hastaka/
├── application/          # Kode aplikasi CodeIgniter
├── system/               # Core CodeIgniter (jangan diubah)
├── database/             # Dump database (hastaka_holiday.sql)
├── vendor/               # Dependency Composer
├── index.php             # Entry point
├── .htaccess             # Konfigurasi Apache
├── composer.json         # Konfigurasi Composer
├── README.md             # Dokumentasi ini
└── license.txt           # Lisensi MIT
```

## Cara Instalasi

1. **Clone repositori**
   ```bash
   git clone <url-repositori>
   cd hastaka
   ```

2. **Install dependency Composer**
   ```bash
   composer install
   ```

3. **Konfigurasi database**
   Salin file contoh konfigurasi database:
   ```bash
   cp application/config/database.example.php application/config/database.php
   ```
   Buka `application/config/database.php` dan sesuaikan dengan kredensial database Anda:
   ```php
   'username' => 'your_db_username',
   'password' => 'your_db_password',
   'database' => 'your_db_name',
   ```

4. **Konfigurasi email (opsional)**
   Salin file contoh konfigurasi email:
   ```bash
   cp application/config/email.example.php application/config/email.php
   ```
   Isi dengan kredensial SMTP Anda.

5. **Import database**
   Buat database baru lalu impor file dump:
   ```bash
   mysql -u username -p nama_database < database/hastaka_holiday.sql
   ```

6. **Jalankan aplikasi**
   Buka `http://localhost/hastaka/` di browser Anda.

## Akun Admin Contoh

Setelah import database, Anda dapat login dengan akun admin contoh:

| Field | Nilai |
|-------|-------|
| Email | admin@example.com |
| Password | admin123 |

> ⚠️ **Penting:** Segera ganti password admin setelah login pertama kali untuk keamanan.

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](license.txt).

## Catatan Pengembangan

File konfigurasi sensitif (`database.php`, `email.php`) dan folder upload (`application/assets/images/`) **tidak** disertakan dalam repositori publik. Silakan buat sendiri sesuai kebutuhan produksi.