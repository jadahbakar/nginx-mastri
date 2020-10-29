/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.19-0ubuntu0.16.04.1 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `proses_laporan_konsolidasi` (
	`id` int (11),
	`jenis_laporan` varchar (765),
	`status` char (24),
	`tahun` int (11),
	`url_file` text ,
	`direktori_file` text ,
	`nama_file` text ,
	`kode_pengguna` varchar (765),
	`created_at` timestamp ,
	`updated_at` timestamp 
); 
