-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 8.0.18 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk aplikasi_penjualan
CREATE DATABASE IF NOT EXISTS `aplikasi_penjualan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `aplikasi_penjualan`;

-- membuang struktur untuk table aplikasi_penjualan.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `pemasok` varchar(150) NOT NULL,
  `kode_barcode` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel aplikasi_penjualan.barang: 2 rows
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` (`id`, `nama`, `jumlah`, `pemasok`, `kode_barcode`) VALUES
	(1, 'AC Panasonic', 0, 'UFO Elektronik', '123'),
	(2, 'Teh Sariwangi', 0, 'PT. Sariwangi Kalsel', '345621');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- membuang struktur untuk table aplikasi_penjualan.harga_unit_barang
CREATE TABLE IF NOT EXISTS `harga_unit_barang` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `barang_id` int(10) NOT NULL,
  `harga` bigint(50) NOT NULL,
  `tanggal` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `pemasok` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel aplikasi_penjualan.harga_unit_barang: 12 rows
/*!40000 ALTER TABLE `harga_unit_barang` DISABLE KEYS */;
INSERT INTO `harga_unit_barang` (`id`, `barang_id`, `harga`, `tanggal`, `user_id`, `pemasok`) VALUES
	(1, 0, 111111, '2021-07-16', 1, 'UFO Elektronik'),
	(2, 1, 600020, '2021-07-24', 1, 'UFO Elektronik'),
	(3, 0, 111114, '2021-07-17', 1, 'UFO Elektronik22'),
	(4, 1, 222233, '2021-07-16', 1, 'UFO Elektronik'),
	(5, 1, 200001, '2021-10-07', 1, 'DEPO Gemilang'),
	(6, 1, 204400, '1970-01-01', 1, 'Pasar Kiji2'),
	(7, 1, 230401, '2021-10-07', 1, 'Deop'),
	(8, 1, 11, '2021-07-22', 1, '123'),
	(9, 1, 300000, '2021-07-24', 1, 'PT. Gudang Hirang'),
	(10, 1, 500000, '2021-07-25', 1, 'CV. Hanbag'),
	(11, 1, 222222, '2021-07-02', 1, 'UFO Elektronik'),
	(12, 2, 40000, '2021-08-06', 1, 'UFO Elektronik');
/*!40000 ALTER TABLE `harga_unit_barang` ENABLE KEYS */;

-- membuang struktur untuk table aplikasi_penjualan.hpp
CREATE TABLE IF NOT EXISTS `hpp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL DEFAULT '0',
  `barang_id` int(11) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL DEFAULT '0000-00-00',
  `harga` mediumint(9) NOT NULL DEFAULT '0',
  `qty` mediumint(9) NOT NULL DEFAULT '0',
  `sisa` mediumint(9) NOT NULL DEFAULT '0',
  `jenis` int(11) NOT NULL DEFAULT '0' COMMENT '0 : Saldo awal, 1 : beli, 2: jual',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='kartu persediaan untuk menghitung hpp produk bisa metode fifo atau lifo';

-- Membuang data untuk tabel aplikasi_penjualan.hpp: 18 rows
/*!40000 ALTER TABLE `hpp` DISABLE KEYS */;
INSERT INTO `hpp` (`id`, `transaksi_id`, `barang_id`, `tanggal`, `harga`, `qty`, `sisa`, `jenis`) VALUES
	(1, 4, 1, '2021-12-29', 90000, 2, 2, 1),
	(2, 5, 1, '2021-12-30', 100000, 4, 4, 1),
	(3, 6, 1, '2021-12-30', 110000, 4, 3, 1),
	(4, 7, 1, '2021-12-30', 120000, 55, 4, 1),
	(5, 7, 1, '0000-00-00', 130000, 24, 2, 1),
	(15, 16, 1, '2022-01-07', 99000, 2, 0, 2),
	(14, 15, 1, '2022-01-07', 110000, 1, 0, 2),
	(13, 14, 1, '2022-01-07', 99000, 2, 0, 2),
	(12, 13, 1, '2022-01-07', 99000, 2, 0, 2),
	(11, 12, 1, '2022-01-07', 99000, 2, 0, 2),
	(16, 17, 1, '2022-01-07', 110000, 2, 0, 2),
	(17, 18, 1, '2022-01-07', 66000, 1, 0, 2),
	(18, 19, 1, '2022-01-07', 110000, 1, 0, 2),
	(19, 20, 1, '2022-01-07', 148500, 2, 0, 2),
	(20, 21, 1, '2022-01-07', 148500, 1, 0, 1),
	(21, 21, 1, '2022-01-07', 148500, 1, 0, 1),
	(22, 22, 2, '2022-02-16', 200000, 1, 0, 1),
	(23, 22, 1, '2022-02-16', 148500, 3, 0, 1);
/*!40000 ALTER TABLE `hpp` ENABLE KEYS */;

-- membuang struktur untuk table aplikasi_penjualan.pelanggan
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `telp` varchar(150) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel aplikasi_penjualan.pelanggan: 6 rows
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` (`id`, `nama`, `telp`, `alamat`) VALUES
	(1, 'Burhan', '081212332148', 'Jalan Reksana Dona XI A19'),
	(2, 'sss', 'sss', 'sss'),
	(3, 'sss', 'sdfa', 'asfsaf'),
	(4, 'sssd', 'ddd', 'ddd'),
	(5, 'ddds', 'sss', 'sdsfs'),
	(6, 'Abdi33333', '101020202', 'Jalan makasar');
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;

-- membuang struktur untuk table aplikasi_penjualan.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `telp` varchar(150) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel aplikasi_penjualan.supplier: 2 rows
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
	(7, 'Gustov Pvt. ', '451151541', 'Jalan India'),
	(8, 'Tesla', '94949494', 'Jalan Kelayan');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;

-- membuang struktur untuk table aplikasi_penjualan.transaksi
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `kode` mediumint(9) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL,
  `pelanggan_id` int(8) DEFAULT NULL,
  `supplier_id` int(8) DEFAULT NULL,
  `user_id` int(8) NOT NULL,
  `jenis` int(8) NOT NULL COMMENT '1: pembelian; 2: penjualan',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel aplikasi_penjualan.transaksi: 22 rows
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` (`id`, `kode`, `tanggal`, `pelanggan_id`, `supplier_id`, `user_id`, `jenis`) VALUES
	(1, 1, '2021-12-29', NULL, NULL, 1, 2),
	(2, 2, '2021-12-29', NULL, NULL, 1, 2),
	(3, 2, '2021-12-29', NULL, NULL, 1, 2),
	(4, 2, '2021-12-29', NULL, NULL, 1, 1),
	(5, 3, '2021-12-30', NULL, NULL, 1, 1),
	(6, 4, '2021-12-30', NULL, NULL, 1, 1),
	(7, 5, '2021-12-30', NULL, 7, 1, 1),
	(8, 6, '2022-01-04', NULL, NULL, 1, 2),
	(9, 7, '2022-01-07', NULL, NULL, 1, 2),
	(10, 8, '2022-01-07', NULL, NULL, 1, 2),
	(11, 9, '2022-01-07', NULL, NULL, 1, 2),
	(12, 10, '2022-01-07', NULL, NULL, 1, 2),
	(13, 11, '2022-01-07', NULL, NULL, 1, 2),
	(14, 11, '2022-01-07', NULL, NULL, 1, 2),
	(15, 12, '2022-01-07', NULL, NULL, 1, 2),
	(16, 13, '2022-01-07', NULL, NULL, 1, 2),
	(17, 14, '2022-01-07', NULL, NULL, 1, 2),
	(18, 15, '2022-01-07', NULL, NULL, 1, 2),
	(19, 16, '2022-01-07', NULL, NULL, 1, 2),
	(20, 17, '2022-01-07', NULL, NULL, 1, 2),
	(21, 18, '2022-01-07', NULL, NULL, 1, 1),
	(22, 19, '2022-02-16', NULL, NULL, 1, 1);
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;

-- membuang struktur untuk table aplikasi_penjualan.transaksi_detail
CREATE TABLE IF NOT EXISTS `transaksi_detail` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(50) NOT NULL,
  `qty` int(6) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `total` bigint(50) NOT NULL,
  `barang_id` int(150) NOT NULL,
  `time` int(150) NOT NULL,
  `status_temporary` int(1) DEFAULT '1',
  `user_id` int(50) NOT NULL,
  `updated_by` int(20) NOT NULL,
  `jenis` int(1) NOT NULL COMMENT '1 : Pembelian, 2: Penjualan',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel aplikasi_penjualan.transaksi_detail: 31 rows
/*!40000 ALTER TABLE `transaksi_detail` DISABLE KEYS */;
INSERT INTO `transaksi_detail` (`id`, `transaksi_id`, `qty`, `harga`, `total`, `barang_id`, `time`, `status_temporary`, `user_id`, `updated_by`, `jenis`) VALUES
	(1, 1, 3, 200001, 600003, 1, 1640820068, 0, 1, 0, 0),
	(2, 1, 1, 100000, 100000, 1, 1640820068, 0, 1, 0, 0),
	(3, 4, 2, 100000, 200000, 1, 1640820155, 0, 1, 0, 0),
	(4, 5, 4, 100000, 400000, 1, 1640823242, 0, 1, 0, 0),
	(5, 6, 4, 100000, 400000, 1, 1640823315, 0, 1, 0, 0),
	(6, 7, 55, 100000, 5500000, 1, 1640823378, 0, 1, 0, 0),
	(7, 8, 20, 0, 0, 1, 1641267194, 0, 1, 0, 0),
	(8, 8, 2, 99000, 198000, 1, 1641267194, 0, 1, 0, 1),
	(9, 0, 1, 99000, 99000, 1, 1641285597, 1, 1, 0, 1),
	(10, 9, 2, 99000, 198000, 1, 1641519831, 0, 1, 0, 1),
	(11, 10, 2, 99000, 198000, 1, 1641520034, 0, 1, 0, 1),
	(12, 12, 2, 99000, 198000, 1, 1641520160, 0, 1, 0, 1),
	(13, 14, 2, 99000, 198000, 1, 1641524414, 0, 1, 0, 1),
	(14, 15, 1, 110000, 110000, 1, 1641526057, 0, 1, 0, 1),
	(15, 16, 2, 99000, 198000, 1, 1641526274, 0, 1, 0, 1),
	(16, 17, 2, 110000, 220000, 1, 1641536825, 0, 1, 0, 1),
	(17, 18, 1, 66000, 66000, 1, 1641536874, 0, 1, 0, 1),
	(18, 19, 1, 110000, 110000, 1, 1641537072, 0, 1, 0, 1),
	(19, 20, 2, 148500, 297000, 1, 1641537142, 0, 1, 0, 1),
	(20, 0, 1, 99000, 99000, 1, 1641537186, 1, 1, 0, 2),
	(21, 0, 2, 0, 0, 1, 1641537384, 1, 1, 0, 1),
	(22, 0, 1, 0, 0, 1, 1641537384, 1, 1, 0, 1),
	(23, 0, 1, 0, 0, 1, 1641537384, 1, 1, 0, 1),
	(24, 0, 1, 0, 0, 1, 1641537384, 1, 1, 0, 1),
	(25, 21, 1, 148500, 148500, 1, 1641539916, 0, 1, 0, 1),
	(26, 21, 1, 148500, 148500, 1, 1641539916, 0, 1, 0, 1),
	(27, 0, 2, 148500, 297000, 1, 1644975675, 1, 1, 0, 1),
	(28, 22, 1, 200000, 200000, 2, 1644976165, 0, 1, 0, 1),
	(29, 22, 3, 148500, 445500, 1, 1644976165, 0, 1, 0, 1),
	(30, 0, 2, 200000, 400000, 2, 1644976836, 1, 1, 0, 1),
	(31, 0, 2, 148500, 297000, 1, 1644977583, 1, 1, 0, 1);
/*!40000 ALTER TABLE `transaksi_detail` ENABLE KEYS */;

-- membuang struktur untuk table aplikasi_penjualan.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `last_login` int(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel aplikasi_penjualan.user: 1 rows
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `nama`, `email`, `password`, `last_login`) VALUES
	(1, 'admin', 'admin@email.com', '$2y$10$mxlNxJmO/z.t2Sbl2gVg6.fwZ7Y0TLVyUFWArgCEvvc8dte0bXrIu', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
