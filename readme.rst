# Hastaka Holiday

Sistem informasi berbasis web untuk **Hastaka Holiday Tour & Travel** (Bandung Raya) yang mengintegrasikan **rekomendasi paket wisata** menggunakan algoritma **Simple Additive Weighting (SAW)** dengan **pemesanan dan pengelolaan transaksi secara online**.

Proyek ini dikembangkan sebagai bagian dari penelitian skripsi **"Penerapan Algoritma Simple Additive Weighting pada Sistem Informasi Rekomendasi Paket Wisata"**.

---

## Latar Belakang

Sebelumnya, pengelolaan data pemesanan dan transaksi dilakukan di Microsoft Excel yang terpisah dari website, sementara fitur website terbatas sehingga calon pelanggan lebih memilih memesan lewat WhatsApp. Website juga hanya menampilkan daftar paket tanpa fitur untuk membandingkan harga, durasi, destinasi, dan aktivitas.

Sistem ini dibuat untuk:
1. Membantu calon pelanggan menentukan paket wisata yang paling sesuai preferensinya secara objektif.
2. Mengintegrasikan pemesanan, pembayaran, dan pengelolaan data dalam satu sistem.

---

## Fitur Utama

### Pengunjung (Guest) dan Pelanggan
- **Katalog Paket Wisata**: daftar paket beserta detail destinasi, fasilitas, aktivitas, dan harga (tanpa login).
- **Rekomendasi Paket (SAW)**: pengguna mengisi tingkat kepentingan (skala 1-5) pada setiap kriteria, lalu sistem menampilkan paket yang diurutkan berdasarkan nilai preferensi tertinggi beserta persentase kecocokan. **Tidak perlu login.**
- **Kategori Program dan Data Klien**: informasi layanan dan klien yang pernah bekerja sama.
- **Registrasi dan Login**: wajib untuk melakukan pemesanan.
- **Pemesanan Online**: tanggal dan jam keberangkatan, jumlah peserta, titik kumpul, layanan akomodasi tambahan (opsional), dan perhitungan total tagihan otomatis.
- **Pilihan Pembayaran**: lunas atau DP, dengan unggah bukti transfer.
- **Invoice dan Riwayat Transaksi**: kode booking unik dan pemantauan status (*pending*, *dikonfirmasi*, *dibatalkan*).

### Admin
- **Dashboard** ringkasan transaksi, paket, dan pendapatan.
- **Kelola Data Master**: Paket Wisata, Kategori Program, Destinasi, Fasilitas, Aktivitas, Akomodasi, dan Klien.
- **Kelola Atribut Kriteria SAW**: mengatur sifat kriteria (*cost*/*benefit*) yang langsung berlaku pada perhitungan berikutnya.
- **Kelola Transaksi**: memeriksa bukti transfer, mengonfirmasi atau membatalkan pesanan, serta menghubungi pelanggan via WhatsApp dengan pesan otomatis berisi kode booking.
- **Kelola Pelanggan**: melihat dan menonaktifkan akun.
- **Laporan Transaksi**: filter berdasarkan periode dan cetak ke PDF.

---

## Algoritma SAW

### Kriteria

| Kode | Kriteria | Atribut |
|------|----------|---------|
| C1 | Harga Paket | Cost |
| C2 | Durasi Perjalanan | Benefit |
| C3 | Jumlah Destinasi | Benefit |
| C4 | Jumlah Aktivitas | Benefit |

Nilai C1-C4 diambil otomatis dari data paket. Jumlah destinasi dan aktivitas dihitung dari item yang dicentang admin, sehingga tidak diinput manual.

### Tahapan Perhitungan

1. **Input bobot**: pengguna memberi nilai 1-5 untuk tiap kriteria (bobot dinamis).
2. **Normalisasi bobot**: `Wj = wj / Σwj`
3. **Matriks keputusan (X)**: nilai tiap paket yang berstatus tersedia terhadap C1-C4.
4. **Normalisasi matriks**:
   - Benefit: `rij = Xij / Max(Xij)`
   - Cost: `rij = Min(Xij) / Xij`
5. **Nilai preferensi**: `Vi = Σ (Wj × rij)`
6. **Perangkingan**: paket diurutkan dari `Vi` terbesar ke terkecil. Paket teratas diberi label "Paling cocok".

---

## Teknologi

| Komponen | Teknologi |
|----------|-----------|
| Backend | PHP, CodeIgniter 3 (arsitektur MVC) |
| Frontend | HTML, Tailwind CSS, JavaScript |
| Database | MySQL (`db_wisata_saw`) |
| Metode Pengembangan | Prototype |
| Pemodelan | UML (Use Case, Activity, Sequence, Class) dan ERD |

---

## Kebutuhan Sistem

- PHP 5.6 atau lebih baru 
- MySQL
- Web server Apache XAMPP
- Browser modern

---

## Struktur Folder

```
application/
├── controllers/   # Logika aplikasi (halaman pelanggan dan admin)
├── models/        # Interaksi dengan database
├── views/         # Tampilan (HTML + Tailwind CSS)
└── config/        # Konfigurasi aplikasi dan database
assets/            # CSS, JavaScript, dan gambar
system/            # Inti framework CodeIgniter
```

---

## Alur Pemesanan

1. Pelanggan memilih paket sendiri atau melalui rekomendasi SAW.
2. Login, lalu mengisi form pemesanan dan memilih tipe pembayaran (lunas/DP).
3. Sistem menghitung total tagihan dan menyimpan pesanan dengan status *pending*.
4. Pelanggan mengunggah bukti transfer dan mendapat invoice dengan kode booking.
5. Admin memverifikasi pembayaran lalu mengonfirmasi atau membatalkan pesanan.
6. Admin dapat menghubungi pelanggan via WhatsApp bila diperlukan.

---

## Lisensi

Proyek ini dikembangkan untuk keperluan akademik dan operasional **Hastaka Holiday Tour & Travel**.
