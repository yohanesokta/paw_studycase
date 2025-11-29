-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for laundry-online
DROP DATABASE IF EXISTS `laundry-online`;
CREATE DATABASE IF NOT EXISTS `laundry-online` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `laundry-online`;

-- Dumping structure for table laundry-online.cucian
DROP TABLE IF EXISTS `cucian`;
CREATE TABLE IF NOT EXISTS `cucian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `harga` int NOT NULL,
  `estimate` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laundry-online.cucian: ~5 rows (approximately)
INSERT IGNORE INTO `cucian` (`id`, `nama`, `harga`, `estimate`) VALUES
	(1, 'Cuci Basah', 3000, 2),
	(2, 'Cuci Kering', 4000, 2),
	(3, 'Cuci Kering Setrika', 5000, 3),
	(4, 'Cuci Express ( Kering )', 10000, 1),
	(5, 'Cuci Express ( Kering Strika )', 12000, 1);

-- Dumping structure for table laundry-online.pesanan
DROP TABLE IF EXISTS `pesanan`;
CREATE TABLE IF NOT EXISTS `pesanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `berat` float DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `id_cucian` int NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `status` enum('diambil','belum_diambil','pending') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pesanan_user` (`id_user`),
  KEY `pesanan_cucian` (`id_cucian`),
  CONSTRAINT `pesanan_cucian` FOREIGN KEY (`id_cucian`) REFERENCES `cucian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pesanan_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laundry-online.pesanan: ~0 rows (approximately)

-- Dumping structure for table laundry-online.report
DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `harga` int NOT NULL,
  `alamat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `report_transaksi` (`id_transaksi`),
  CONSTRAINT `report_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laundry-online.report: ~0 rows (approximately)

-- Dumping structure for table laundry-online.transaksi
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `berat` float NOT NULL,
  `harga` int NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `id_admin` varchar(100) NOT NULL,
  `id_pesanan` int NOT NULL,
  `status` enum('dibayar','belum_dibayar') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_user` (`id_user`),
  KEY `transaksi_pesanan` (`id_pesanan`),
  KEY `transaksi_admin` (`id_admin`),
  CONSTRAINT `transaksi_admin` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laundry-online.transaksi: ~0 rows (approximately)

-- Dumping structure for table laundry-online.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(36) NOT NULL DEFAULT (uuid()),
  `google_id` varchar(100) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `role` enum('admin','pelanggan') NOT NULL DEFAULT 'pelanggan',
  `alamat` varchar(255) DEFAULT NULL,
  `profile` text,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `google_id` (`google_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table laundry-online.user: ~0 rows (approximately)
INSERT IGNORE INTO `user` (`id`, `google_id`, `nama`, `no_telepon`, `role`, `alamat`, `profile`, `email`, `password`) VALUES
	('3bc16476-caf2-11f0-8d6e-2c58b92caf88', '104744461616458354198', '24-160 SURYA MAULANA AKHMAD', '085946902276', 'pelanggan', 'adsad', 'https://lh3.googleusercontent.com/a/ACg8ocJe1azGvMAY--ut-VgC91ker7YotvnVo81dKSQdma0VZg5Iw_w=s96-c', 'suryamaulana757@gmail.com', NULL),
	('5e9d8f3f-caf5-11f0-8d6e-2c58b92caf88', '108936036093892735574', '33 Surya Maulana Akhmad', '085946902276', 'pelanggan', 'asdadasdsss', 'https://lh3.googleusercontent.com/a/ACg8ocIaVW9omyVN7Um2eOYjLkMDJyCtGN8OWNBxgMFrPAfJ4iv_jSWDdg=s96-c', 'suryamaulana789456123@gmail.com', NULL),
	('7fca2e6c-caf5-11f0-8d6e-2c58b92caf88', NULL, 'Zidan', '085946902276', 'pelanggan', 'Lumajang', NULL, 'zidan@gmail.com', '$2y$12$WExWsN3FpB/MfzOboPasoOI6DVpOkEkFH7zW6a1JZeNSdQ5ti.DD2'),
	('bb3f17b3-caf0-11f0-8d6e-2c58b92caf88', NULL, 'Anjasmara', '85946902277', 'pelanggan', 'anjas', NULL, 'anjas@gmail.com', '$2y$12$EDRVQ9QYaUx0qulS7v0eUOYGic9dFF04yGzYsWxquIPfxVzVaOs4a');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
