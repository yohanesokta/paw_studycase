-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: gcp.gajahweb.tech
-- Waktu pembuatan: 30 Nov 2025 pada 07.28
-- Versi server: 12.1.2-MariaDB-ubu2404
-- Versi PHP: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `fresh_loandry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cucian`
--

CREATE TABLE `cucian` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `estimate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `cucian`
--

INSERT INTO `cucian` (`id`, `nama`, `harga`, `estimate`) VALUES
(1, 'Cuci Basah', 3000, 2),
(2, 'Cuci Kering', 4000, 2),
(3, 'Cuci Kering Setrika', 5000, 3),
(4, 'Cuci Express ( Kering )', 10000, 1),
(5, 'Cuci Express ( Kering Strika )', 12000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `berat` float DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `id_cucian` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `status` enum('diambil','belum_diambil','pending') NOT NULL,
  `verifed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `tanggal`, `berat`, `harga`, `id_cucian`, `id_user`, `status`, `verifed`) VALUES
(1, '2025-11-27 09:05:31', 80000, 240000000, 1, 'b92d7be8-cb6f-11f0-8e73-8ee87e1c2d5a', 'diambil', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `berat` float NOT NULL,
  `harga` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `id_admin` varchar(100) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `status` enum('dibayar','belum_dibayar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` varchar(36) NOT NULL DEFAULT uuid(),
  `google_id` varchar(100) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `role` enum('admin','pelanggan') NOT NULL DEFAULT 'pelanggan',
  `alamat` varchar(255) DEFAULT NULL,
  `profile` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `google_id`, `nama`, `no_telepon`, `role`, `alamat`, `profile`, `email`, `password`) VALUES
('11184b27-cd42-11f0-8e73-8ee87e1c2d5a', '106457975532789462908', '24-139 MOHAMMAD ANDRI FIRMANSYAH', '1111', 'pelanggan', 'Haloha', 'https://lh3.googleusercontent.com/a/ACg8ocIhOyFsb1hl-_-nGvK5ER0nqSyAz979qJTeVC0j3I6zLnoHmJsy=s96-c', 'andrifirmansyah381@gmail.com', NULL),
('2e3dee41-cb94-11f0-8e73-8ee87e1c2d5a', NULL, 'Anjasmara', '085946902276', 'pelanggan', 'Lumajang', NULL, 'anjas@gmail.com', '$2y$10$lAYyOKE.klz7NQsBmfUIYOJCdwtRsbgPEShqneuuwgmaDOwfLh8ya'),
('637b2c11-cb86-11f0-8e73-8ee87e1c2d5a', '104744461616458354198', '24-160 SURYA MAULANA AKHMAD', '085946902276', 'pelanggan', 'Lumajang', 'https://lh3.googleusercontent.com/a/ACg8ocJe1azGvMAY--ut-VgC91ker7YotvnVo81dKSQdma0VZg5Iw_w=s96-c', 'suryamaulana757@gmail.com', NULL),
('a79b62b7-cb72-11f0-8e73-8ee87e1c2d5a', '114201935386364963735', 'YOHANES OKTANIO', '081977330481', 'pelanggan', 'NGANAN LURUS TERUS NGIRI', 'https://lh3.googleusercontent.com/a/ACg8ocJ1S3CzbD-mpShGtlDRJ79eu_BPe9XlhSPvgAk8LzCgmp5vd_8=s96-c', 'yohanes.oktanio4@smk.belajar.id', NULL),
('b92d7be8-cb6f-11f0-8e73-8ee87e1c2d5a', NULL, 'Yohanes Oktanio', '081977330481', 'admin', 'Kabuh Jombang Jatim', NULL, 'yohanesoktanio@outlook.com', '$2y$10$jLQrSw9lKDzsoOpf47IMxuCuC5/5.MhD9ZSG2V1Uz8Lw4j7q05Jr6'),
('c30c7031-cb93-11f0-8e73-8ee87e1c2d5a', NULL, 'Lumajang', '085946902276', 'pelanggan', 'Lumajang', NULL, 'Lumajang', '$2y$10$3lrk9Dfzl2GzW2ITd8yxiew6qsxSw1Lx4RZ.8qEjPMo31aXVi8s2m');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `cucian`
--
ALTER TABLE `cucian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_user` (`id_user`),
  ADD KEY `pesanan_cucian` (`id_cucian`);

--
-- Indeks untuk tabel `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_user` (`id_user`),
  ADD KEY `transaksi_pesanan` (`id_pesanan`),
  ADD KEY `transaksi_admin` (`id_admin`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `google_id` (`google_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cucian`
--
ALTER TABLE `cucian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_cucian` FOREIGN KEY (`id_cucian`) REFERENCES `cucian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_admin` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
