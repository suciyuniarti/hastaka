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
    bobot DECIMAL(5,4) DEFAULT 0.25,
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
    id_akomodasi INT NOT NULL DEFAULT 1,
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
-- Tabel 6: akomodasi
-- ============================================================
CREATE TABLE IF NOT EXISTS akomodasi (
    id_akomodasi INT AUTO_INCREMENT PRIMARY KEY,
    nama_akomodasi VARCHAR(100) NOT NULL,
    icon VARCHAR(50) DEFAULT 'directions_bus',
    harga_tambahan INT NOT NULL DEFAULT 0,
    deskripsi TEXT,
    is_active ENUM('y','n') NOT NULL DEFAULT 'y',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- Tabel 7: bank
-- ============================================================
CREATE TABLE IF NOT EXISTS bank (
    id_bank INT AUTO_INCREMENT PRIMARY KEY,
    nama_bank VARCHAR(100) NOT NULL,
    jenis VARCHAR(50) DEFAULT NULL,
    nomor_rekening VARCHAR(50) NOT NULL,
    atas_nama VARCHAR(120) NOT NULL,
    cabang VARCHAR(120) DEFAULT NULL,
    is_active ENUM('y','n') NOT NULL DEFAULT 'y',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Data awal bank (contoh)
INSERT INTO bank (nama_bank, jenis, nomor_rekening, atas_nama, cabang, is_active)
VALUES
('BCA', 'Transfer Bank', '1234567890', 'Hastaka Holiday', 'Surabaya', 'y');

-- ============================================================
-- Data awal akomodasi
-- ============================================================
INSERT INTO akomodasi (nama_akomodasi, icon, harga_tambahan, deskripsi) VALUES
('Full Bus', 'directions_bus', 500000, 'Transportasi seluruh perjalanan menggunakan bus pariwisata'),
('Full Pesawat', 'flight', 1500000, 'Transportasi udara PP sesuai jadwal'),
('Full Kereta', 'train', 300000, 'Transportasi kereta api PP'),
('Mix (Bus + Pesawat)', 'commute', 800000, 'Kombinasi bus dan pesawat sesuai rute');


-- ============================================================
-- Data Awal: Admin default
-- Password: admin123
-- ============================================================
INSERT INTO users (nama_lengkap, email, password, role, status) VALUES
('Administrator', 'admin@hastaka.com', '$2y$10$kucDq/Bmvt3QQhnDaNMij.dy1jZwbQHa9JmpP7tgVyLyPBAACW6iu', 'admin', 'aktif');

-- ============================================================
-- Data Awal: Kriteria SAW
-- ============================================================
INSERT INTO kriteria (kode_kriteria, nama_kriteria, bobot, sifat) VALUES
('C1', 'Harga Paket', 0.25, 'cost'),
('C2', 'Durasi Wisata', 0.25, 'benefit'),
('C3', 'Fasilitas / Destinasi', 0.25, 'benefit'),
('C4', 'Rating / Ulasan', 0.25, 'benefit');

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

-- ============================================================
-- Tabel 8: paket_akomodasi (pivot)
-- ============================================================
CREATE TABLE IF NOT EXISTS paket_akomodasi (
    id_paket INT NOT NULL,
    id_akomodasi INT NOT NULL,
    PRIMARY KEY (id_paket, id_akomodasi),
    FOREIGN KEY (id_paket) REFERENCES paket_wisata(id_paket) ON DELETE CASCADE,
    FOREIGN KEY (id_akomodasi) REFERENCES akomodasi(id_akomodasi) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ============================================================
-- Tabel 9: partner_bus
-- ============================================================
CREATE TABLE IF NOT EXISTS partner_bus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    kota VARCHAR(100) DEFAULT NULL,
    gambar VARCHAR(255) DEFAULT NULL,
    is_active ENUM('y','n') NOT NULL DEFAULT 'y',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- Tabel 9: partner_hotel
-- ============================================================
CREATE TABLE IF NOT EXISTS partner_hotel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    bintang INT DEFAULT NULL,
    icon VARCHAR(50) DEFAULT 'hotel',
    deskripsi TEXT,
    gambar VARCHAR(255) DEFAULT NULL,
    is_active ENUM('y','n') NOT NULL DEFAULT 'y',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- Data awal Partner Bus
-- ============================================================
INSERT INTO partner_bus (nama, kota, is_active) VALUES
('Jackal Holiday', 'Surabaya', 'y'),
('Prabu Jaya Trans', 'Surabaya', 'y'),
('Ness', 'Surabaya', 'y'),
('Surya Putra', 'Malang', 'y'),
('Armada', 'Surabaya', 'y'),
('Blue Bird', 'Surabaya', 'y'),
('Bhineka', 'Surabaya', 'y'),
('Josal', 'Surabaya', 'y'),
('Ashroof', 'Surabaya', 'y');

-- ============================================================
-- Data awal Partner Hotel
-- ============================================================
INSERT INTO partner_hotel (nama, bintang, icon, deskripsi, is_active) VALUES
('Hotel Bintang 3', 3, 'hotel', 'Fasilitas lengkap dengan harga terjangkau di setiap kota tujuan', 'y'),
('Hotel Bintang 4', 4, 'hotel', 'Kamar luas dengan layanan premium dan lokasi strategis', 'y'),
('Homestay & Villa', 0, 'cottage', 'Penginapan nyaman dengan nuansa lokal untuk pengalaman autentik', 'y'),
('Resort & Apartment', 0, 'apartment', 'Pilihan premium untuk liburan yang lebih eksklusif', 'y');
