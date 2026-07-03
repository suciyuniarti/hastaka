-- Migration: Tambah kolom bobot ke tabel kriteria
-- Jalankan jika tabel kriteria sudah ada tanpa kolom bobot

ALTER TABLE kriteria ADD COLUMN bobot DECIMAL(5,4) DEFAULT 0.25 AFTER nama_kriteria;

-- Set default bobot 0.25 untuk masing-masing kriteria (total = 1)
UPDATE kriteria SET bobot = 0.25 WHERE kode_kriteria IN ('C1', 'C2', 'C3', 'C4');