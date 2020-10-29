/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.19-0ubuntu0.16.04.1 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `tanda_tangan` (
	`id` int (11),
	`status` char (33),
	`tanggal` date ,
	`pejabat_penanda_tangan_1` varchar (765),
	`pejabat_penanda_tangan_2` varchar (765),
	`nama` varchar (765),
	`nip` varchar (765),
	`jabatan` varchar (765),
	`created_at` timestamp ,
	`updated_at` timestamp 
); 
insert into `tanda_tangan` (`id`, `status`, `tanggal`, `pejabat_penanda_tangan_1`, `pejabat_penanda_tangan_2`, `nama`, `nip`, `jabatan`, `created_at`, `updated_at`) values('1','Tidak Aktif','2018-12-21','An. Walikota Semarang','Pj. Sekretaris daerah','Ir. Agus Riyanto','192.168.111.222','Pembina Muda Utama','2018-07-28 20:05:16','2018-07-29 03:05:16');
