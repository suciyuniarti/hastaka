-- ============================================================
-- DATABASE: db_wisata_saw
-- Sistem Informasi Rekomendasi Paket Wisata - Metode SAW
-- ============================================================

CREATE DATABASE IF NOT EXISTS db_wisata_saw;
USE db_wisata_saw;

-- ============================================================
-- Tabel 1: users
-- ============================================================
CREATE TABLE IF NOT EXISTS users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'pelanggan') NOT NULL DEFAULT 'pelanggan',
    status ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- Tabel 2: paket_wisata
-- ============================================================
CREATE TABLE IF NOT EXISTS paket_wisata (
    id_paket INT AUTO_INCREMENT PRIMARY KEY,
    nama_paket VARCHAR(150) NOT NULL,
    deskripsi TEXT NOT NULL,
    foto VARCHAR(255) DEFAULT 'default.jpg',
    harga INT NOT NULL DEFAULT 0,
    durasi_hari INT NOT NULL DEFAULT 1,
    jumlah_destinasi INT NOT NULL DEFAULT 1,
    rating DOUBLE NOT NULL DEFAULT 0,
    status ENUM('tersedia', 'penuh') NOT NULL DEFAULT 'tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- Tabel 3: kriteria
-- ============================================================
CREATE TABLE IF NOT EXISTS kriteria (
    id_kriteria INT AUTO_INCREMENT PRIMARY KEY,
    kode_kriteria VARCHAR(10) NOT NULL,
    nama_kriteria VARCHAR(50) NOT NULL,
    sifat ENUM('benefit', 'cost') NOT NULL
);

-- ============================================================
-- Tabel 4: nilai_alternatif
-- ============================================================
CREATE TABLE IF NOT EXISTS nilai_alternatif (
    id_nilai INT AUTO_INCREMENT PRIMARY KEY,
    id_paket INT NOT NULL,
    id_kriteria INT NOT NULL,
    nilai DOUBLE NOT NULL DEFAULT 0,
    FOREIGN KEY (id_paket) REFERENCES paket_wisata(id_paket) ON DELETE CASCADE,
    FOREIGN KEY (id_kriteria) REFERENCES kriteria(id_kriteria) ON DELETE CASCADE,
    UNIQUE KEY unique_paket_kriteria (id_paket, id_kriteria)
);

-- ============================================================
-- Tabel 5: pemesanan
-- ============================================================
CREATE TABLE IF NOT EXISTS pemesanan (
    id_pemesanan INT AUTO_INCREMENT PRIMARY KEY,
    kode_booking VARCHAR(20) NOT NULL UNIQUE,
    id_user INT NOT NULL,
    id_paket INT NOT NULL,
    tgl_keberangkatan DATE NOT NULL,
    jumlah_peserta INT NOT NULL DEFAULT 1,
    total_bayar INT NOT NULL DEFAULT 0,
    status_pemesanan ENUM('pending', 'dikonfirmasi', 'selesai', 'dibatalkan') NOT NULL DEFAULT 'pending',
    catatan TEXT,
    tgl_transaksi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_paket) REFERENCES paket_wisata(id_paket) ON DELETE CASCADE
);

-- ============================================================
-- Data Awal: Admin default
-- Password: admin123
-- ============================================================
INSERT INTO users (nama_lengkap, email, password, role, status) VALUES
('Administrator', 'admin@hastaka.com', '$2y$10$kucDq/Bmvt3QQhnDaNMij.dy1jZwbQHa9JmpP7tgVyLyPBAACW6iu', 'admin', 'aktif');

-- ============================================================
-- Data Awal: Kriteria SAW
-- ============================================================
INSERT INTO kriteria (kode_kriteria, nama_kriteria, sifat) VALUES
('C1', 'Harga Paket', 'cost'),
('C2', 'Durasi Wisata', 'benefit'),
('C3', 'Fasilitas / Destinasi', 'benefit'),
('C4', 'Rating / Ulasan', 'benefit');

-- ============================================================
-- Data Awal: Paket Wisata Contoh
-- ============================================================
INSERT INTO paket_wisata (nama_paket, deskripsi, foto, harga, durasi_hari, jumlah_destinasi, rating, status) VALUES
('Paket Wisata Bali', 'Nikmati keindahan pantai Bali dengan kunjungan ke Tanah Lot, Kuta, Seminyak, dan Ubud. Termasuk hotel bintang 3 dan transportasi.', 'bali.jpg', 2500000, 3, 4, 4.5, 'tersedia'),
('Paket Wisata Bromo', 'Saksikan matahari terbit di Gunung Bromo. Kunjungan ke Penanjakan, Lautan Pasir, dan Kawah Bromo. Termasuk jeep dan penginapan.', 'bromo.jpg', 1800000, 2, 3, 4.7, 'tersedia'),
('Paket Wisata Raja Ampat', 'Eksplorasi surga bawah laut Raja Ampat. Snorkeling di 5 spot terbaik, kunjungan ke Pulau Misool dan Waigeo.', 'rajaampat.jpg', 4500000, 4, 5, 4.8, 'tersedia'),
('Paket Wisata Yogyakarta', 'Kunjungi Candi Borobudur, Prambanan, Malioboro, dan Pantai Parangtritis. Termasuk guide lokal dan transportasi.', 'yogya.jpg', 1500000, 3, 4, 4.3, 'tersedia'),
('Paket Wisata Lombok', 'Nikmati pantai-pantai eksotis Lombok: Gili Trawangan, Gili Meno, Pantai Tanjung Aan, dan Gunung Rinjani.', 'lombok.jpg', 3200000, 4, 5, 4.6, 'tersedia');

-- ============================================================
-- Data Awal: Nilai Alternatif (Matriks Keputusan X)
-- ============================================================
-- Paket Bali (id_paket=1): Harga=2500000, Durasi=3, Destinasi=4, Rating=4.5
INSERT INTO nilai_alternatif (id_paket, id_kriteria, nilai) VALUES
(1, 1, 2500000), (1, 2, 3), (1, 3, 4), (1, 4, 4.5);

-- Paket Bromo (id_paket=2): Harga=1800000, Durasi=2, Destinasi=3, Rating=4.7
INSERT INTO nilai_alternatif (id_paket, id_kriteria, nilai) VALUES
(2, 1, 1800000), (2, 2, 2), (2, 3, 3), (2, 4, 4.7);

-- Paket Raja Ampat (id_paket=3): Harga=4500000, Durasi=4, Destinasi=5, Rating=4.8
INSERT INTO nilai_alternatif (id_paket, id_kriteria, nilai) VALUES
(3, 1, 4500000), (3, 2, 4), (3, 3, 5), (3, 4, 4.8);

-- Paket Yogyakarta (id_paket=4): Harga=1500000, Durasi=3, Destinasi=4, Rating=4.3
INSERT INTO nilai_alternatif (id_paket, id_kriteria, nilai) VALUES
(4, 1, 1500000), (4, 2, 3), (4, 3, 4), (4, 4, 4.3);

-- Paket Lombok (id_paket=5): Harga=3200000, Durasi=4, Destinasi=5, Rating=4.6
INSERT INTO nilai_alternatif (id_paket, id_kriteria, nilai) VALUES
(5, 1, 3200000), (5, 2, 4), (5, 3, 5), (5, 4, 4.6);

-- ============================================================
-- Data Awal: Pelanggan contoh
-- Password: pelanggan123
-- ============================================================
INSERT INTO users (nama_lengkap, email, password, role, status) VALUES
('John Doe', 'john@example.com', '$2y$10$w4AkGzcxkzvmVeiugtq7OuDZjCt5WYSWCleV4WIFutZZq8sbYP4W2', 'pelanggan', 'aktif');
