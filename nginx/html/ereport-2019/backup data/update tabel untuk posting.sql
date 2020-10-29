/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.19-0ubuntu0.16.04.1 : Database - ereporting_2018
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `jurnal` */

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `jenis_transaksi` int(11) DEFAULT NULL,
  `no_urut` int(11) DEFAULT NULL,
  `kode_akun` varchar(50) DEFAULT NULL,
  `jenis_jurnal` varchar(50) DEFAULT NULL,
  `kode_pengguna` varchar(50) DEFAULT NULL,
  `kode_lapor` varchar(50) DEFAULT NULL,
  `kode_organisasi` varchar(50) DEFAULT NULL,
  `kd_org_catat` varchar(50) DEFAULT NULL,
  `akun_debet` varchar(50) DEFAULT NULL,
  `akun_kredit` varchar(50) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `keterangan` text,
  `status` varchar(50) DEFAULT NULL,
  `urut_tampil` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1980 DEFAULT CHARSET=latin1;

/*Table structure for table `posting` */

CREATE TABLE `posting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(50) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `jenis_transaksi` int(11) DEFAULT NULL,
  `no_urut` int(11) DEFAULT NULL,
  `kode_akun` varchar(50) DEFAULT NULL,
  `jenis_jurnal` varchar(50) DEFAULT NULL,
  `kode_pengguna` varchar(50) DEFAULT NULL,
  `kode_lapor` varchar(50) DEFAULT NULL,
  `kode_organisasi` varchar(50) DEFAULT NULL,
  `kd_org_catat` varchar(50) DEFAULT NULL,
  `kode_rekening` varchar(50) DEFAULT NULL,
  `debet` double DEFAULT NULL,
  `kredit` double DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenistransaksiidx` (`jenis_transaksi`),
  KEY `jenisjurnalidx` (`jenis_jurnal`),
  KEY `kodeakunidx` (`kode_akun`),
  KEY `kodelaporidx` (`kode_lapor`),
  KEY `kodeorganisasiidx` (`kode_organisasi`)
) ENGINE=InnoDB AUTO_INCREMENT=1153 DEFAULT CHARSET=latin1;

/*Table structure for table `proses_posting` */

CREATE TABLE `proses_posting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('Berhenti','Berjalan','Sukses','Gagal') DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `kode_organisasi` varchar(255) DEFAULT NULL,
  `kode_pengguna` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
