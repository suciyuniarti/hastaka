CREATE TABLE IF NOT EXISTS `pemesanan_akomodasi` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_pemesanan` INT(11) NOT NULL,
  `id_akomodasi` INT(11) NOT NULL,
  `harga_tambahan` DECIMAL(15,2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `id_pemesanan` (`id_pemesanan`),
  KEY `id_akomodasi` (`id_akomodasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;