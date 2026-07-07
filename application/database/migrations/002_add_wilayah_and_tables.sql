-- Tambah kolom wilayah ke tabel akomodasi
ALTER TABLE akomodasi 
ADD COLUMN wilayah TEXT NULL 
AFTER deskripsi;

-- Buat tabel paket_akomodasi (many-to-many)
CREATE TABLE IF NOT EXISTS paket_akomodasi (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_paket INT NOT NULL,
  id_akomodasi INT NOT NULL,
  UNIQUE KEY unique_paket_akomodasi (id_paket, id_akomodasi),
  FOREIGN KEY (id_paket) REFERENCES paket_wisata(id_paket) ON DELETE CASCADE,
  FOREIGN KEY (id_akomodasi) REFERENCES akomodasi(id_akomodasi) ON DELETE CASCADE
);

-- Buat tabel pemesanan_akomodasi (snapshot saat booking)
CREATE TABLE IF NOT EXISTS pemesanan_akomodasi (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_pemesanan INT NOT NULL,
  id_akomodasi INT NOT NULL,
  nama_akomodasi VARCHAR(100) NOT NULL,
  harga_per_orang DECIMAL(15,2) NOT NULL,
  jumlah_peserta INT NOT NULL,
  subtotal DECIMAL(15,2) NOT NULL,
  FOREIGN KEY (id_pemesanan) REFERENCES pemesanan(id_pemesanan) ON DELETE CASCADE,
  FOREIGN KEY (id_akomodasi) REFERENCES akomodasi(id_akomodasi) ON DELETE CASCADE
);