/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.28-MariaDB : Database - skripsi-pirda2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`skripsi-pirda2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `skripsi-pirda2`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`username`,`password`) values 
(1,'Admin','e3afed0047b08059d0fada10f400c1e5');

/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_kartu` varchar(255) NOT NULL,
  `no_registrasi` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `ktp` varchar(16) NOT NULL,
  `luas_plasma` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `no_rek` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `id_tahun` (`id_tahun`),
  CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `anggota` */

insert  into `anggota`(`id_anggota`,`username`,`password`,`nama`,`no_kartu`,`no_registrasi`,`alamat`,`ktp`,`luas_plasma`,`foto`,`no_rek`,`bank`,`id_tahun`,`no_hp`,`status`) values 
(1,'tina','ef2afe0ea76c76b6b4b1ee92864c4d5c','Tina Kurniana','001','T.II/WH/0001','aaa','98737818','0.5','64d8cdfe487a9.png','123','BNI',1,'082148307204','Aktif'),
(2,'tina','ef2afe0ea76c76b6b4b1ee92864c4d5c','Tina Kurniana','001','T.II/WH/0001','aaa','98737818','0.5','64d8cdfe487a9.png','123','BNI',1,'089530656545','Non aktif');

/*Table structure for table `bulan` */

DROP TABLE IF EXISTS `bulan`;

CREATE TABLE `bulan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bulan` */

insert  into `bulan`(`id`,`bulan`) values 
(1,'Januari'),
(2,'Februari'),
(3,'Maret'),
(4,'April'),
(5,'Mei'),
(6,'Juni'),
(7,'Juli'),
(8,'Agustus'),
(9,'September'),
(10,'Oktober'),
(11,'November'),
(12,'Desember');

/*Table structure for table `galeri` */

DROP TABLE IF EXISTS `galeri`;

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_galeri`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `galeri` */

insert  into `galeri`(`id_galeri`,`foto`,`judul`,`keterangan`) values 
(1,'6501adbb97be8.jpg','asd','asd');

/*Table structure for table `kontak` */

DROP TABLE IF EXISTS `kontak`;

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alamat` text NOT NULL,
  `telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kontak` */

insert  into `kontak`(`id`,`alamat`,`telp`,`email`) values 
(1,'Murutuwu, Kec. Paju Epat, Kabupaten Barito Timur, Kalimantan Tengah 73614','0852-4801-3601','pt.sgm@gmail.com');

/*Table structure for table `pembagian_hasil` */

DROP TABLE IF EXISTS `pembagian_hasil`;

CREATE TABLE `pembagian_hasil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `pendapatan` int(11) NOT NULL,
  `potongan` int(11) NOT NULL,
  `total_bersih` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `id_bulan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_anggota` (`id_anggota`),
  KEY `id_tahun` (`id_tahun`),
  KEY `id_bulan` (`id_bulan`),
  CONSTRAINT `pembagian_hasil_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE,
  CONSTRAINT `pembagian_hasil_ibfk_2` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pembagian_hasil_ibfk_3` FOREIGN KEY (`id_bulan`) REFERENCES `bulan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembagian_hasil` */

insert  into `pembagian_hasil`(`id`,`id_anggota`,`tanggal`,`pendapatan`,`potongan`,`total_bersih`,`id_tahun`,`id_bulan`) values 
(1,1,'2019-01-01',15000,5000,10000,1,1),
(2,1,'2019-02-01',20000,5000,15000,1,2);

/*Table structure for table `pengumuman` */

DROP TABLE IF EXISTS `pengumuman`;

CREATE TABLE `pengumuman` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pengumuman` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengumuman` */

/*Table structure for table `pengurus` */

DROP TABLE IF EXISTS `pengurus`;

CREATE TABLE `pengurus` (
  `id_pengurus` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `ktp` varchar(16) NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pengurus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengurus` */

/*Table structure for table `profil` */

DROP TABLE IF EXISTS `profil`;

CREATE TABLE `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `profil` */

insert  into `profil`(`id`,`keterangan`) values 
(2,'<p>PT. Sawit Graha Manunggal adalah sebuah perusahaan perkebunan sawit swasta yang merupakan bagian dari Anglo Eastern Plantation (AEP) Group yaitu perusahaan PMA yang berdiri sejak tahun 1985, berkedudukan di Inggris dan terdaftar di London Stock Exchange.&nbsp;Pada tanggal 10 Desember 2007, AEP Indonesia berekspansi ke Kalimantan Tengah, tepatnya di daerah Tamiang Layang dan membangun kebun yang bernama PT. Sawit Graha Manunggal. Wilayah kerja PT. Sawit Graha Manunggal berada di Kabupaten Barito Timur dengan lokasi meliputi 6 wilayah kecamatan yaitu : Kecamatan Dusun Timur, Kecamatan Karusen Janang, Kecamatan Paku, Kecamatan Dusun Tengah, Kecamatan Paju Epat, dan Kecamatan Pematang Karau. Pembangunan usaha perkebunan dilakukan melalui pola Kebun Inti &amp; Kebun Kemitraan (Kebun Plasma dan Kebun Kas Desa)</p>\r\n');

/*Table structure for table `simpanan_pokok` */

DROP TABLE IF EXISTS `simpanan_pokok`;

CREATE TABLE `simpanan_pokok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) DEFAULT NULL,
  `simpanan` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_anggota` (`id_anggota`),
  CONSTRAINT `simpanan_pokok_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `simpanan_pokok` */

insert  into `simpanan_pokok`(`id`,`id_anggota`,`simpanan`) values 
(1,1,50000);

/*Table structure for table `simpanan_wajib` */

DROP TABLE IF EXISTS `simpanan_wajib`;

CREATE TABLE `simpanan_wajib` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `simpanan_wajib` bigint(20) NOT NULL,
  `id_bulan` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_anggota` (`id_anggota`),
  KEY `id_tahun` (`id_tahun`),
  KEY `id_bulan` (`id_bulan`),
  CONSTRAINT `simpanan_wajib_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE,
  CONSTRAINT `simpanan_wajib_ibfk_3` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `simpanan_wajib_ibfk_4` FOREIGN KEY (`id_bulan`) REFERENCES `bulan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `simpanan_wajib` */

insert  into `simpanan_wajib`(`id`,`id_anggota`,`tanggal`,`simpanan_wajib`,`id_bulan`,`id_tahun`) values 
(1,1,'2019-01-01',5000,1,1),
(2,1,'2019-02-01',5000,2,1);

/*Table structure for table `tahun` */

DROP TABLE IF EXISTS `tahun`;

CREATE TABLE `tahun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tahun` */

insert  into `tahun`(`id`,`tahun`) values 
(1,2019),
(2,2022),
(3,2023);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
