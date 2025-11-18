CREATE TABLE `user` (
    `id` VARCHAR(100) NOT NULL DEFAULT uuid(),
    `nama` VARCHAR(100) NOT NULL ,
    `no_telepon` VARCHAR(10) NULL DEFAULT NULL ,
    `role` ENUM('admin','pelanggan') NOT NULL ,
PRIMARY KEY (`id`));

CREATE TABLE `cucian` (
    `id` int(11) NOT NULL,
    `nama` varchar(255) NOT NULL,
    `harga` int(255) NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE `pesanan`
  (
     `id`           INT NOT NULL auto_increment,
     `tanggal`      DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
     `berat`        FLOAT NOT NULL,
     `harga`        INT NOT NULL,
     `jenis_cucian` ENUM('kering', 'basah') NOT NULL,
     `id_user`      VARCHAR(100) NOT NULL,
     `id_admin`     VARCHAR(100) NOT NULL,
     `status`       ENUM('diambil', 'belum_diambil', 'pending') NOT NULL,
     PRIMARY KEY (`id`)
  ); 

ALTER TABLE `pesanan`
ADD CONSTRAINT `pesanan_user` FOREIGN KEY (`id_user`) REFERENCES `user`(`id`) ON
DELETE CASCADE ON UPDATE CASCADE; 

ALTER TABLE `pesanan`
ADD CONSTRAINT `pesanan_admin` FOREIGN KEY (`id_admin`) REFERENCES `user`(`id`) ON
DELETE CASCADE ON UPDATE CASCADE;

CREATE TABLE `transaksi`
  (
     `id`           INT NOT NULL auto_increment,
     `tanggal`      DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
     `berat`        FLOAT NOT NULL,
     `harga`        INT NOT NULL,
     `jenis_cucian` ENUM('kering', 'basah') NOT NULL,
     `id_user`      VARCHAR(100) NOT NULL,
     `id_pesanan`   INT NOT NULL,
     `status`       ENUM('dibayar', 'belum_dibayar') NOT NULL,
     PRIMARY KEY (`id`)
  ); 

ALTER TABLE `transaksi`
ADD CONSTRAINT `transaksi_user` FOREIGN KEY (`id_user`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE CASCADE; 

ALTER TABLE `transaksi`
ADD CONSTRAINT `transaksi_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;


CREATE TABLE `report` (
    `id` int AUTO_INCREMENT,
    `id_transaksi` int,
    `harga` int(255) NOT NULL,
    `alamat` varchar(255) NOT NULL,
    PRIMARY KEY(`id`)
);

ALTER TABLE `report` ADD CONSTRAINT `report_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;