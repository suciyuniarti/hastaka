# TODO — Tugas 1 & 2

## TUGAS 1 — Fix bug paket status 'penuh' tidak muncul
- [x] Tambah method `get_all_paket_untuk_publik()` di `Paket_model.php`
- [x] Ubah `Paket::index()` panggil `get_all_paket_untuk_publik()`
- [x] Test manual (paket 'penuh' muncul & bisa difilter)

## TUGAS 2 — Ganti LABEL "Penuh" jadi "Tidak Tersedia" (value DB tetap 'penuh')
- [x] `paket.php` baris 49-52: teks tombol filter -> "Tidak Tersedia" (data-filter tetap 'penuh')
- [x] `paket.php` baris 79-80: badge teks kondisional
- [x] `home.php` baris 112-113: badge teks kondisional
- [x] `detail_paket.php` baris 70-71: badge teks kondisional
- [x] `detail_paket.php` baris 166: teks "Paket Penuh" -> "Paket Tidak Tersedia"
- [x] `admin/paket.php` baris 75-76: badge teks kondisional
- [x] `admin/paket.php` baris 150 & 268: teks option -> "Tidak Tersedia"
- [x] `admin/paket_form.php` baris 65: teks option -> "Tidak Tersedia"

## TAMBAHAN — Paket 'penuh' ('Tidak Tersedia') tidak bisa dipesan
### LAPIS 1 — Client-side (detail_paket.php)
- [x] Logika Action diurutkan ulang: cek `status != 'tersedia'` PALING AWAL
- [x] Paket tidak tersedia -> tombol muted non-klik "Paket Tidak Tersedia" (tanpa href)
- [x] Berlaku untuk semua pengguna (guest, pelanggan, admin)
### LAPIS 2 — Server-side (Pemesanan::booking) — keamanan data
- [x] Tambah guard `if ($data['paket']->status != 'tersedia')` di luar blok form_validation
- [x] Berlaku untuk GET & POST, redirect ke detail paket + flash error
- [x] Cegah insert DB untuk paket tidak tersedia

## TAMBAHAN — Styling badge status di halaman publik
- [x] Tambah definisi `.badge-penuh` (dan `.status-penuh`) di `admin.css`
- [x] Warna: `background #334155` (slate-700) + `color #FFFFFF` — kontras tegas vs badge Tersedia (emerald)
- [x] Berlaku konsisten di paket.php, home.php, detail_paket.php (semua load admin.css)
- [x] Admin pakai `.badge-habis` (terpisah) -> tidak terpengaruh

## TAMBAHAN — Fix z-index popup bukti transfer (transaksi.php)
- [x] Temuan: `#bukti-modal` & `#detail-modal` sama-sama `z-50`; bukti-modal muncul lebih dulu di DOM -> tertutup detail-modal
- [x] Fix: `#bukti-modal` jadi `z-[1100]` (di atas z-50 & di atas .modal-overlay z:1000)
- [x] Test: buka detail transaksi -> klik bukti transfer -> gambar tampil di depan, bisa ditutup balik ke modal

## VERIFIKASI / PENGUJIAN
- [x] Laporan akhir format Sebelum/Sesudah
- [x] Test manual halaman publik & admin
