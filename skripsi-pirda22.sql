/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `anggota` (
  `id_anggota` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `no_kartu` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `no_registrasi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `ktp` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `luas_plasma` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `no_rek` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_tahun` int NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `id_tahun` (`id_tahun`),
  CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `bulan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bulan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `galeri` (
  `id_galeri` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_galeri`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `kontak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pembagian_hasil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_anggota` int NOT NULL,
  `tanggal` date NOT NULL,
  `pendapatan` int NOT NULL,
  `potongan` int NOT NULL,
  `total_bersih` int NOT NULL,
  `id_tahun` int NOT NULL,
  `id_bulan` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_anggota` (`id_anggota`),
  KEY `id_tahun` (`id_tahun`),
  KEY `id_bulan` (`id_bulan`),
  CONSTRAINT `pembagian_hasil_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE,
  CONSTRAINT `pembagian_hasil_ibfk_2` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pembagian_hasil_ibfk_3` FOREIGN KEY (`id_bulan`) REFERENCES `bulan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pengumuman` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pengumuman` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pengurus` (
  `id_pengurus` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ktp` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_pengurus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `profil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `simpanan_pokok` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_anggota` int DEFAULT NULL,
  `simpanan` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_anggota` (`id_anggota`),
  CONSTRAINT `simpanan_pokok_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `simpanan_wajib` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_anggota` int NOT NULL,
  `tanggal` date NOT NULL,
  `simpanan_wajib` bigint NOT NULL,
  `id_bulan` int NOT NULL,
  `id_tahun` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_anggota` (`id_anggota`),
  KEY `id_tahun` (`id_tahun`),
  KEY `id_bulan` (`id_bulan`),
  CONSTRAINT `simpanan_wajib_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE,
  CONSTRAINT `simpanan_wajib_ibfk_3` FOREIGN KEY (`id_tahun`) REFERENCES `tahun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `simpanan_wajib_ibfk_4` FOREIGN KEY (`id_bulan`) REFERENCES `bulan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `tahun` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tahun` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'Admin', 'e3afed0047b08059d0fada10f400c1e5');


INSERT INTO `anggota` (`id_anggota`, `username`, `password`, `nama`, `no_kartu`, `no_registrasi`, `alamat`, `ktp`, `luas_plasma`, `foto`, `no_rek`, `bank`, `id_tahun`, `no_hp`) VALUES
(1, 'tina', 'ef2afe0ea76c76b6b4b1ee92864c4d5c', 'Tina Kurniana', '001', 'T.II/WH/0001', 'aaa', '98737818', '0.5', '64d8cdfe487a9.png', '123', 'BNI', 1, '082148307204');
INSERT INTO `anggota` (`id_anggota`, `username`, `password`, `nama`, `no_kartu`, `no_registrasi`, `alamat`, `ktp`, `luas_plasma`, `foto`, `no_rek`, `bank`, `id_tahun`, `no_hp`) VALUES
(2, 'tina', 'ef2afe0ea76c76b6b4b1ee92864c4d5c', 'Tina Kurniana', '001', 'T.II/WH/0001', 'aaa', '98737818', '0.5', '64d8cdfe487a9.png', '123', 'BNI', 1, '089530656545');


INSERT INTO `bulan` (`id`, `bulan`) VALUES
(1, 'Januari');
INSERT INTO `bulan` (`id`, `bulan`) VALUES
(2, 'Februari');
INSERT INTO `bulan` (`id`, `bulan`) VALUES
(3, 'Maret');
INSERT INTO `bulan` (`id`, `bulan`) VALUES
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

INSERT INTO `galeri` (`id_galeri`, `foto`, `judul`, `keterangan`) VALUES
(1, '6501adbb97be8.jpg', 'asd', 'asd');




INSERT INTO `pembagian_hasil` (`id`, `id_anggota`, `tanggal`, `pendapatan`, `potongan`, `total_bersih`, `id_tahun`, `id_bulan`) VALUES
(1, 1, '2019-01-01', 15000, 5000, 10000, 1, 1);
INSERT INTO `pembagian_hasil` (`id`, `id_anggota`, `tanggal`, `pendapatan`, `potongan`, `total_bersih`, `id_tahun`, `id_bulan`) VALUES
(2, 1, '2019-02-01', 20000, 5000, 15000, 1, 2);


INSERT INTO `pengumuman` (`id`, `pengumuman`, `judul`) VALUES
(2, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'INI JUDUL PENGUMUMAN');
INSERT INTO `pengumuman` (`id`, `pengumuman`, `judul`) VALUES
(3, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 'bbbbb');
INSERT INTO `pengumuman` (`id`, `pengumuman`, `judul`) VALUES
(4, 'cccccccccccccccccccccccccccccccccccccccccccccccc', 'cccccc');





INSERT INTO `simpanan_pokok` (`id`, `id_anggota`, `simpanan`) VALUES
(1, 1, 50000);


INSERT INTO `simpanan_wajib` (`id`, `id_anggota`, `tanggal`, `simpanan_wajib`, `id_bulan`, `id_tahun`) VALUES
(1, 1, '2019-01-01', 5000, 1, 1);
INSERT INTO `simpanan_wajib` (`id`, `id_anggota`, `tanggal`, `simpanan_wajib`, `id_bulan`, `id_tahun`) VALUES
(2, 1, '2019-02-01', 5000, 2, 1);


INSERT INTO `tahun` (`id`, `tahun`) VALUES
(1, 2019);
INSERT INTO `tahun` (`id`, `tahun`) VALUES
(2, 2022);
INSERT INTO `tahun` (`id`, `tahun`) VALUES
(3, 2023);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;