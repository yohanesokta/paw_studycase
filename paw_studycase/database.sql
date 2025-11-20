CREATE TABLE `user` (
    `id` VARCHAR(100) NOT NULL,
    `nama` VARCHAR(100) NOT NULL,
    `no_telepon` VARCHAR(15) DEFAULT NULL,
    `role` ENUM('admin', 'pelanggan') NOT NULL,
    `alamat` VARCHAR(255),
    `profile` TEXT,
    `email` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `cucian` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nama` VARCHAR(255) NOT NULL,
    `harga` INT NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `pesanan` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `tanggal` DATE NOT NULL DEFAULT (CURRENT_DATE),
    `berat` FLOAT NOT NULL,
    `harga` INT NOT NULL,
    `jenis_cucian` ENUM('kering', 'basah') NOT NULL,
    `id_user` VARCHAR(100) NOT NULL,
    `id_admin` VARCHAR(100) NOT NULL,
    `status` ENUM('diambil', 'belum_diambil', 'pending') NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `pesanan_user`
        FOREIGN KEY (`id_user`) REFERENCES `user`(`id`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `pesanan_admin`
        FOREIGN KEY (`id_admin`) REFERENCES `user`(`id`)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `transaksi` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `tanggal` DATE NOT NULL DEFAULT (CURRENT_DATE),
    `berat` FLOAT NOT NULL,
    `harga` INT NOT NULL,
    `jenis_cucian` ENUM('kering', 'basah') NOT NULL,
    `id_user` VARCHAR(100) NOT NULL,
    `id_pesanan` INT NOT NULL,
    `status` ENUM('dibayar', 'belum_dibayar') NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `transaksi_user`
        FOREIGN KEY (`id_user`) REFERENCES `user`(`id`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `transaksi_pesanan`
        FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan`(`id`)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `report` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `id_transaksi` INT NOT NULL,
    `harga` INT NOT NULL,
    `alamat` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `report_transaksi`
        FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi`(`id`)
        ON DELETE RESTRICT ON UPDATE RESTRICT
);
