# ************************************************************
# Sequel Ace SQL dump
# Version 20067
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 5.7.44)
# Database: darsun
# Generation Time: 2024-06-03 01:49:05 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table absents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `absents`;

CREATE TABLE `absents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` int(11) DEFAULT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `absents` WRITE;
/*!40000 ALTER TABLE `absents` DISABLE KEYS */;

INSERT INTO `absents` (`id`, `schedule_id`, `mahasiswa_id`, `tanggal`, `status`, `created_at`, `updated_at`)
VALUES
	(9,28,8,'2024-06-01','HADIR','2024-05-31 09:12:28','2024-05-31 09:19:38'),
	(10,28,9,'2024-06-01','SAKIT','2024-05-31 09:12:28','2024-05-31 09:19:38'),
	(11,28,7,'2024-06-01','SAKIT','2024-05-31 09:12:28','2024-05-31 09:19:38'),
	(12,28,11,'2024-06-01','HADIR','2024-05-31 09:12:28','2024-05-31 09:19:38');

/*!40000 ALTER TABLE `absents` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table akademiks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `akademiks`;

CREATE TABLE `akademiks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `akademiks` WRITE;
/*!40000 ALTER TABLE `akademiks` DISABLE KEYS */;

INSERT INTO `akademiks` (`id`, `nama`, `tanggal_mulai`, `tanggal_akhir`, `semester`, `tahun_ajaran`, `keterangan`, `created_at`, `updated_at`)
VALUES
	(1,'123','2024-06-21','2024-06-15','Genap','2023/2024','1231231','2024-06-02 12:22:05','2024-06-02 12:22:05');

/*!40000 ALTER TABLE `akademiks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table classes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `classes`;

CREATE TABLE `classes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_ajaran` year(4) DEFAULT NULL,
  `current_semaster` int(11) DEFAULT '1',
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;

INSERT INTO `classes` (`id`, `nama`, `tahun_ajaran`, `current_semaster`, `gender`, `created_at`, `updated_at`)
VALUES
	(3,'ANSHORI','2021',6,'Laki-laki','2024-05-18 07:05:30','2024-05-18 07:05:30'),
	(4,'ANSHORI','2021',6,'Perempuan','2024-05-18 07:05:47','2024-05-18 07:05:47'),
	(5,'ADZKIYA','2022',4,'Laki-laki','2024-05-18 07:06:00','2024-05-18 07:06:00'),
	(6,'ADZKIYA','2024',4,'Perempuan','2024-05-18 07:06:00','2024-05-18 07:06:00'),
	(7,'MATSNAWI','2023',2,'Perempuan','2024-05-18 07:06:00','2024-05-18 07:06:00'),
	(8,'MATSNAWI','2023',2,'Laki-laki','2024-05-18 07:06:00','2024-05-18 07:06:00'),
	(9,'RABBANI','2020',8,'Laki-laki','2024-05-18 07:06:00','2024-05-18 07:06:00'),
	(10,'RABBANI','2020',8,'Perempuan','2024-05-18 07:06:00','2024-05-18 07:06:00');

/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table detail_invoices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `detail_invoices`;

CREATE TABLE `detail_invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `name_payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table dosens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dosens`;

CREATE TABLE `dosens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_induk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `dosens` WRITE;
/*!40000 ALTER TABLE `dosens` DISABLE KEYS */;

INSERT INTO `dosens` (`id`, `user_id`, `nomor_induk`, `jabatan`, `tipe`, `created_at`, `updated_at`)
VALUES
	(2,'8','ZUH','Khadim Ma\'had','Dosen','2024-05-18 06:38:58','2024-05-27 09:53:08'),
	(3,'9','SBH','Dosen','Dosen','2024-05-20 06:59:02','2024-05-20 06:59:02'),
	(4,'16','FZL','Dosen','Dosen','2024-05-20 09:00:09','2024-05-20 09:00:09'),
	(5,'17','HNF','Dosen','Dosen','2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(6,'18','UNU','Dosen','Dosen','2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(7,'19','ANH','WAKA BIDANG. AKADEMIK / MUSYRIF MPM & IMDAR','Musyrif','2024-05-27 06:39:02','2024-05-27 06:39:02'),
	(8,'20','DZU','WAKA BID. KEMAHASANTRIAN / MUSYRIF MPM & IMDAR','Musyrif','2024-05-27 06:40:46','2024-05-27 06:40:46'),
	(9,'21','MMA','MUSYRIF PA / MUSYRIF LDPM','Musyrif','2024-05-27 06:45:04','2024-05-27 06:45:04'),
	(10,'22','THB','DOSEN','Dosen','2024-05-27 07:07:53','2024-05-27 07:07:53'),
	(11,'23','SHD','DOSEN','Dosen','2024-05-27 08:02:51','2024-05-27 08:02:51'),
	(12,'24','AIZ','DOSEN','Dosen','2024-05-27 08:47:26','2024-05-27 08:47:26'),
	(13,'25','AUM','MUSYRIF PA / MUSYRIF NABAWI','Musyrif','2024-05-27 08:58:57','2024-05-27 08:58:57'),
	(14,'26','AHZ','MUSYRIF PA / MUSYRIF SIDS','Musyrif','2024-05-27 09:00:16','2024-05-27 09:00:16'),
	(15,'27','MAW','DOSEN','Dosen','2024-05-27 09:01:25','2024-05-27 09:01:25'),
	(16,'28','BDR','DOSEN','Dosen','2024-05-27 09:03:01','2024-05-27 09:03:01'),
	(17,'29','BLQ','MUSYRIF PA / MUSYRIF MPM & IMDAR','Musyrif','2024-05-27 09:07:13','2024-05-27 09:07:13'),
	(18,'30','WAC','MUSYRIF PA / MUSYRIF SIDS','Musyrif','2024-05-27 09:13:09','2024-05-27 09:13:09'),
	(19,'31','MAZ','MUSYRIF PA / MUSYRIF ITQAN','Musyrif','2024-05-27 09:16:52','2024-05-27 09:16:52'),
	(20,'32','NAF','MUSYRIF PA / MUSYRIF NABAWI','Musyrif','2024-05-27 09:18:17','2024-05-27 09:18:17'),
	(21,'33','SMN','DOSEN','Dosen','2024-05-27 09:20:59','2024-05-27 09:20:59'),
	(22,'34','AND','DOSEN','Dosen','2024-05-27 09:22:51','2024-05-27 09:22:51'),
	(23,'35','EMH','DOSEN','Dosen','2024-05-27 09:23:59','2024-05-27 09:23:59'),
	(24,'36','AEN','DOSEN','Dosen','2024-05-27 09:25:25','2024-05-27 09:25:25'),
	(25,'37','FJF','DOSEN','Dosen','2024-05-27 09:26:13','2024-05-27 09:26:13'),
	(26,'38','AMU','DOSEN','Dosen','2024-05-27 09:27:59','2024-05-27 09:27:59'),
	(27,'39','HSN','BENDAHARA MA\'HAD/DOSEN','Dosen','2024-05-27 09:29:38','2024-05-27 09:29:38'),
	(28,'40','HHB','DOSEN','Dosen','2024-05-27 09:31:29','2024-05-27 09:31:29'),
	(29,'41','MKH','DOSEN','Dosen','2024-05-27 09:38:15','2024-05-27 09:38:15'),
	(30,'42','HMF','DOSEN','Dosen','2024-05-27 09:40:46','2024-05-27 09:40:46'),
	(31,'43','MSF','DOSEN','Dosen','2024-05-27 09:41:38','2024-05-27 09:41:38'),
	(32,'44','MHA','DOSEN','Dosen','2024-05-27 09:43:42','2024-05-27 09:43:42'),
	(33,'45','NFM','DOSEN','Dosen','2024-05-27 09:45:04','2024-05-27 09:45:04'),
	(34,'46','IUA','DOSEN','Dosen','2024-05-27 09:46:05','2024-05-27 09:46:05'),
	(35,'47','AHO','DOSEN','Dosen','2024-05-27 09:47:45','2024-05-27 09:47:45');

/*!40000 ALTER TABLE `dosens` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table edarans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `edarans`;

CREATE TABLE `edarans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table invoices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mahasantri_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table mahasantris
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mahasantris`;

CREATE TABLE `mahasantris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_depan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_belakang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `handphone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saudara` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lahir_ayah` date DEFAULT NULL,
  `pendidikan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penghasilan_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lahir_ibu` date DEFAULT NULL,
  `pendidikan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penghasilan_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_wali` text COLLATE utf8mb4_unicode_ci,
  `handphone_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_wali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_sekolah` text COLLATE utf8mb4_unicode_ci,
  `nomor_ijazah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_ijazah` date DEFAULT NULL,
  `asal_pesantren` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pesantren` text COLLATE utf8mb4_unicode_ci,
  `hobi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan_darah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berat_badan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinggi_badan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penyakit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_kemampuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `mahasantris` WRITE;
/*!40000 ALTER TABLE `mahasantris` DISABLE KEYS */;

INSERT INTO `mahasantris` (`id`, `user_id`, `kelas_id`, `nim`, `nama_depan`, `nama_belakang`, `email`, `handphone`, `nik`, `alamat`, `kode_pos`, `tanggal_lahir`, `tempat_lahir`, `suku`, `saudara`, `anak_ke`, `whatsapp`, `foto`, `nama_ayah`, `tempat_ayah`, `lahir_ayah`, `pendidikan_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`, `nama_ibu`, `tempat_ibu`, `lahir_ibu`, `pendidikan_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`, `nama_wali`, `alamat_wali`, `handphone_wali`, `whatsapp_wali`, `asal_sekolah`, `alamat_sekolah`, `nomor_ijazah`, `tanggal_ijazah`, `asal_pesantren`, `alamat_pesantren`, `hobi`, `golongan_darah`, `berat_badan`, `tinggi_badan`, `penyakit`, `jenis_kelamin`, `kondisi_kemampuan`, `status`, `created_at`, `updated_at`)
VALUES
	(6,'10',8,'139172931','Mochammad Nagieb Jihadil','Akbar','naghieb@gmail.com',NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Laki-laki',NULL,'aktif','2024-05-20 07:32:20','2024-05-20 07:32:20'),
	(7,'11',7,'139172931','Imas','Musfiroh','imas@gmail.com',NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Perempuan',NULL,'aktif','2024-05-20 07:36:22','2024-05-20 07:36:22'),
	(8,'12',7,'139172931','Ari','Mulyadi','ari@gmail.com',NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Laki-laki',NULL,'aktif','2024-05-20 07:46:38','2024-05-20 07:46:38'),
	(9,'13',7,'139172931','Husna','Shabrina','husna@gmail.com',NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Perempuan',NULL,'aktif','2024-05-20 07:47:39','2024-05-20 07:47:39'),
	(10,'14',3,'139172931','Zainuddin','Nur','zay@gmail.com',NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Laki-laki',NULL,'aktif','2024-05-20 07:48:51','2024-05-20 07:48:51'),
	(11,'15',7,'139172931','Siti','Firgiya','firgi@gmail.com',NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'139172931',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Perempuan',NULL,'aktif','2024-05-20 07:49:43','2024-05-20 07:49:43');

/*!40000 ALTER TABLE `mahasantris` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table mata_kuliahs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mata_kuliahs`;

CREATE TABLE `mata_kuliahs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `smester` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `mata_kuliahs` WRITE;
/*!40000 ALTER TABLE `mata_kuliahs` DISABLE KEYS */;

INSERT INTO `mata_kuliahs` (`id`, `nama`, `kode`, `sks`, `smester`, `created_at`, `updated_at`)
VALUES
	(11,'Sahih al-Bukhari I','HDS-SB',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(12,'Sahih al-Bukhari II','HDS-SB',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(13,'Sahih al-Bukhari III','HDS-SB',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(14,'Sahih al-Bukhari IV','HDS-SB',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(15,'Sahih al-Bukhari V','HDS-SB',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(16,'Sahih al-Bukhari VI','HDS-SB',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(17,'Sahih al-Bukhari VII','HDS-SB',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(18,'Sahih al-Bukhari VIII','HDS-SB',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(21,'Sahih Muslim I','HDS-SM',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(22,'Sahih Muslim II','HDS-SM',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(23,'Sahih Muslim III','HDS-SM',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(24,'Sahih Muslim IV','HDS-SM',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(25,'Sahih Muslim V','HDS-SM',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(26,'Sahih Muslim VI','HDS-SM',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(27,'Sahih Muslim VII','HDS-SM',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(28,'Sahih Muslim VIII','HDS-SM',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(29,'Sunan Abi Dawud I','HDS-SAB',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(30,'Sunan Abi Dawud II','HDS-SAB',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(31,'Sunan Abi Dawud III','HDS-SAB',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(32,'Sunan Abi Dawud IV','HDS-SAB',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(33,'Sunan Abi Dawud V','HDS-SAB',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(34,'Sunan Abi Dawud VI','HDS-SAB',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(35,'Sunan Abi Dawud VII','HDS-SAB',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(36,'Sunan Abi Dawud VIII','HDS-SAB',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(37,'Sunan al-Tirmidhi I','HDS-ST',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(38,'Sahih al-Tirmidhi II','HDS-ST',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(39,'Sahih al-Tirmidhi III','HDS-ST',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(40,'Sahih al-Tirmidhi IV','HDS-ST',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(41,'Sahih al-Tirmidhi V','HDS-ST',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(42,'Sahih al-Tirmidhi VI','HDS-ST',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(43,'Sahih al-Tirmidhi VII','HDS-ST',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(44,'Sahih al-Tirmidhi VIII','HDS-ST',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(45,'Sunan al-Nasa‘i I','HDS-SN',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(46,'Sunan al-Nasa‘i II','HDS-SN',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(47,'Sunan al-Nasa‘i III','HDS-SN',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(48,'Sunan al-Nasa‘i IV','HDS-SN',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(49,'Sunan al-Nasa‘i V','HDS-SN',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(50,'Sunan al-Nasa‘i VI','HDS-SN',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(51,'Sunan al-Nasa‘i VII','HDS-SN',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(52,'Sunan al-Nasa‘i VIII','HDS-SN',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(53,'Sunan Ibn Majah I','HDS-SIM\r\n',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(54,'Sunan Ibn Majah II','HDS-SIM\r\n',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(55,'Sunan Ibn Majah III','HDS-SIM\r\n',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(56,'Sunan Ibn Majah IV','HDS-SIM\r\n',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(57,'Sunan Ibn Majah V','HDS-SIM\r\n',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(58,'Sunan Ibn Majah VI','HDS-SIM\r\n',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(59,'Sunan Ibn Majah VII','HDS-SIM\r\n',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(60,'Sunan Ibn Majah VIII','HDS-SIM\r\n',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(61,'al-Fiqh al-Muqaran I','FQH-FM',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(62,'al-Fiqh al-Muqaran II','FQH-FM',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(63,'al-Fiqh al-Muqaran III','FQH-FM',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(64,'al-Fiqh al-Muqaran IV','FQH-FM',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(65,'al-Fiqh al-Muqaran V','FQH-FM',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(66,'al-Fiqh al-Muqaran VI','FQH-FM',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(67,'al-Fiqh al-Muqaran VII','FQH-FM',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(68,'al-Fiqh al-Muqaran VIII','FQH-FM',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(69,'al-Qawa\'id al-Fiqhiyah I','FQH-QF',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(70,'al-Qawa\'id al-Fiqhiyah II','FQH-QF',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(71,'al-Qawa\'id al-Fiqhiyah III','FQH-QF',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(72,'al-Qawa\'id al-Fiqhiyah IV','FQH-QF',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(73,'al-Qawa\'id al-Fiqhiyah V','FQH-QF',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(74,'al-Qawa\'id al-Fiqhiyah VI','FQH-QF',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(75,'al-Qawa\'id al-Fiqhiyah VII','FQH-QF',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(76,'al-Qawa\'id al-Fiqhiyah VIII','FQH-QF',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(77,'al-Aqidah I','AKD-IA',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(78,'al-Aqidah II','AKD-IA',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(79,'al-Aqidah III','AKD-IA',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(80,'al-Aqidah IV','AKD-IA',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(81,'al-Aqidah V','AKD-IA',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(82,'al-Aqidah VI','AKD-IA',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(83,'al-Aqidah VII','AKD-IA',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(84,'al-Aqidah VIII','AKD-IA',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(85,'‘Ilm al-Hadith I','HDS-IH',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(86,'‘Ilm al-Hadith II','HDS-IH',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(87,'‘Ilm al-Hadith III','HDS-IH',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(88,'‘Ilm al-Hadith IV','HDS-IH',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(89,'‘Ilm al-Hadith V','HDS-IH',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(90,'‘Ilm al-Hadith VI','HDS-IH',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(91,'‘Ilm al-Hadith VII','HDS-IH',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(92,'‘Ilm al-Hadith VIII','HDS-IH',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(93,'Mustalah al-Hadith I','HDS-IMH',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(94,'Mustalah al-Hadith II','HDS-IMH',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(95,'al-Qawa’id al-‘Arabiyyah I','BHS-QA',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(96,'al-Qawa’id al-‘Arabiyyah II','BHS-QA',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(97,'Arabic Language I','BHS-TLA',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(98,'Arabic Language II','BHS-TLA',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(99,'Arabic Language III','BHS-TLA',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(100,'Arabic Language IV','BHS-TLA',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(101,'Tahfidh al-Qur\'an I','QRN-TQ',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(102,'Tahfidh al-Qur\'an II','QRN-TQ',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(103,'Tahfidh al-Qur\'an III','QRN-TQ',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(104,'Tahfidh al-Qur\'an IV','QRN-TQ',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(105,'Tahfidh al-Qur\'an V','QRN-TQ',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(106,'Tahfidh al-Qur\'an VI','QRN-TQ',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(107,'Tahfidh al-Qur\'an VII','QRN-TQ',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(108,'Tahfidh al-Qur\'an VIII','QRN-TQ',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(109,'al-Iltizam bi al-Nizam I','NA-IBN',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(110,'al-Iltizam bi al-Nizam II','NA-IBN',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(111,'al-Iltizam bi al-Nizam III','NA-IBN',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(112,'al-Iltizam bi al-Nizam IV','NA-IBN',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(113,'al-Iltizam bi al-Nizam V','NA-IBN',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(114,'al-Iltizam bi al-Nizam VI','NA-IBN',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(115,'al-Iltizam bi al-Nizam VII','NA-IBN',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(116,'al-Iltizam bi al-Nizam VIII','NA-IBN',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(117,'al-Suluk I','NA-S',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(118,'al-Suluk II','NA-S',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(119,'al-Suluk III','NA-S',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(120,'al-Suluk IV','NA-S',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(121,'al-Suluk V','NA-S',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(122,'al-Suluk VI','NA-S',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(123,'al-Suluk VII','NA-S',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(124,'al-Suluk VIII','NA-S',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(125,'al-Nasyat I','NA-N',2,1,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(126,'al-Nasyat II','NA-N',2,2,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(127,'al-Nasyat III','NA-N',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(128,'al-Nasyat IV','NA-N',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(129,'al-Nasyat V','NA-N',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(130,'al-Nasyat VI','NA-N',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(131,'al-Nasyat VII','NA-N',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(132,'al-Nasyat VIII','NA-N',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(133,'al-Takhrij wa Dirasah al-Asanid','HDS-TWA',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(134,'Al-Balaghah wa Diwan al-Syafi’i (Banat)','BHS-BWD',2,3,'2024-05-18 06:41:02','2024-05-28 01:52:50'),
	(135,'‘Ulum al-Sanad','HDS-US',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(136,'Dirasah al-Kutub al-Hadisiyyah (Banat)','BHS-DKH',2,4,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(137,'Manhaj al-Naqd','HDS-MN',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(138,'‘Ulum al-Qur’an','QRN-UQ',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(139,'Turuq Fahm al-Hadith','HDS-TFH',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(140,'‘Ulum al-Tafsir','QRN-UT',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(141,'English Language I','BHS-ELP',2,5,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(142,'English Language II','BHS-ELP',2,6,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(143,'English Language III','BHS-ELP',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(144,'English Language IV','BHS-ELP',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(145,'al-Tahqiq wa Dirasah al-Makhtutat','BHS-TWDM',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(146,'Asalib Ghazw al-Fikry','AKD-AGF',2,7,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(147,'al-Fiqh wa Usuluhu al-Mu‘asir','FQH-FMWU',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(148,'al-Firaq wa al-Madzahib al-Fiqhiyah','AKD-FWMF',2,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(149,'Risalah Takhrij  al-Hadith','AKD-FWMF',6,8,'2024-05-18 06:41:02','2024-05-18 06:41:02'),
	(150,'Al-Balaghah wa Diwan al-Syafi’i (Banin)','BHS-BWD',2,4,'2024-05-18 06:41:02','2024-05-28 01:52:50'),
	(151,'Dirasah al-Kutub al-Hadisiyyah (Banin)','BHS-DKH',2,3,'2024-05-18 06:41:02','2024-05-18 06:41:02');

/*!40000 ALTER TABLE `mata_kuliahs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table matkul_dosens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `matkul_dosens`;

CREATE TABLE `matkul_dosens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) DEFAULT NULL,
  `matkul_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `matkul_dosens` WRITE;
/*!40000 ALTER TABLE `matkul_dosens` DISABLE KEYS */;

INSERT INTO `matkul_dosens` (`id`, `dosen_id`, `matkul_id`, `created_at`, `updated_at`)
VALUES
	(40,5,61,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(41,5,62,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(42,5,63,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(43,5,64,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(44,5,65,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(45,5,66,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(46,5,67,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(47,5,68,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(48,5,69,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(49,5,70,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(50,5,71,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(51,5,72,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(52,5,73,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(53,5,74,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(54,5,75,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(55,5,76,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(56,5,147,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(57,5,148,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(58,6,49,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(59,6,50,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(60,6,51,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(61,6,52,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(62,6,56,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(63,6,57,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(64,6,58,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(65,6,59,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(66,6,77,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(67,6,78,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(68,6,79,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(69,6,80,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(70,6,85,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(71,6,86,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(72,6,87,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(73,6,88,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(74,7,94,'2024-05-27 06:39:02','2024-05-27 06:39:02'),
	(77,11,94,'2024-05-27 08:02:51','2024-05-27 08:02:51'),
	(78,12,148,'2024-05-27 08:47:26','2024-05-27 08:47:26'),
	(79,8,116,'2024-05-27 08:56:11','2024-05-27 08:56:11'),
	(80,8,124,'2024-05-27 08:56:11','2024-05-27 08:56:11'),
	(81,8,132,'2024-05-27 08:56:11','2024-05-27 08:56:11'),
	(85,13,112,'2024-05-27 08:58:57','2024-05-27 08:58:57'),
	(86,13,120,'2024-05-27 08:58:57','2024-05-27 08:58:57'),
	(87,13,128,'2024-05-27 08:58:57','2024-05-27 08:58:57'),
	(88,14,114,'2024-05-27 09:00:16','2024-05-27 09:00:16'),
	(89,14,122,'2024-05-27 09:00:16','2024-05-27 09:00:16'),
	(90,14,130,'2024-05-27 09:00:16','2024-05-27 09:00:16'),
	(91,15,96,'2024-05-27 09:01:25','2024-05-27 09:01:25'),
	(92,16,96,'2024-05-27 09:03:01','2024-05-27 09:03:01'),
	(94,17,116,'2024-05-27 09:11:38','2024-05-27 09:11:38'),
	(95,17,124,'2024-05-27 09:11:38','2024-05-27 09:11:38'),
	(96,17,132,'2024-05-27 09:11:38','2024-05-27 09:11:38'),
	(97,17,140,'2024-05-27 09:11:38','2024-05-27 09:11:38'),
	(98,18,114,'2024-05-27 09:13:09','2024-05-27 09:13:09'),
	(99,18,122,'2024-05-27 09:13:09','2024-05-27 09:13:09'),
	(100,18,130,'2024-05-27 09:13:09','2024-05-27 09:13:09'),
	(101,19,110,'2024-05-27 09:16:52','2024-05-27 09:16:52'),
	(102,19,118,'2024-05-27 09:16:52','2024-05-27 09:16:52'),
	(103,19,126,'2024-05-27 09:16:52','2024-05-27 09:16:52'),
	(104,20,112,'2024-05-27 09:18:17','2024-05-27 09:18:17'),
	(105,20,120,'2024-05-27 09:18:17','2024-05-27 09:18:17'),
	(106,20,128,'2024-05-27 09:18:17','2024-05-27 09:18:17'),
	(107,21,98,'2024-05-27 09:20:59','2024-05-27 09:20:59'),
	(110,24,136,'2024-05-27 09:25:25','2024-05-27 09:25:25'),
	(111,25,100,'2024-05-27 09:26:13','2024-05-27 09:26:13'),
	(112,26,104,'2024-05-27 09:27:59','2024-05-27 09:27:59'),
	(113,26,108,'2024-05-27 09:27:59','2024-05-27 09:27:59'),
	(114,27,139,'2024-05-27 09:29:38','2024-05-27 09:29:38'),
	(115,28,142,'2024-05-27 09:31:29','2024-05-27 09:31:29'),
	(116,9,106,'2024-05-27 09:32:59','2024-05-27 09:32:59'),
	(117,9,110,'2024-05-27 09:32:59','2024-05-27 09:32:59'),
	(118,9,118,'2024-05-27 09:32:59','2024-05-27 09:32:59'),
	(119,9,126,'2024-05-27 09:32:59','2024-05-27 09:32:59'),
	(120,29,147,'2024-05-27 09:38:15','2024-05-27 09:38:15'),
	(121,30,139,'2024-05-27 09:40:46','2024-05-27 09:40:46'),
	(122,31,148,'2024-05-27 09:41:38','2024-05-27 09:41:38'),
	(123,32,144,'2024-05-27 09:43:42','2024-05-27 09:43:42'),
	(124,33,102,'2024-05-27 09:45:04','2024-05-27 09:45:04'),
	(125,33,108,'2024-05-27 09:45:04','2024-05-27 09:45:04'),
	(126,34,104,'2024-05-27 09:46:05','2024-05-27 09:46:05'),
	(127,34,106,'2024-05-27 09:46:05','2024-05-27 09:46:05'),
	(128,35,145,'2024-05-27 09:47:45','2024-05-27 09:47:45'),
	(129,2,11,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(130,2,12,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(131,2,13,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(132,2,14,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(133,2,15,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(134,2,16,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(135,2,17,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(136,2,18,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(137,2,21,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(138,2,22,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(139,2,23,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(140,2,24,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(141,2,25,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(142,2,26,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(143,2,27,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(144,2,28,'2024-05-27 09:53:08','2024-05-27 09:53:08'),
	(145,3,33,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(146,3,34,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(147,3,35,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(148,3,36,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(149,3,41,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(150,3,42,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(151,3,43,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(152,3,44,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(153,3,57,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(154,3,58,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(155,3,59,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(156,3,60,'2024-05-27 09:56:34','2024-05-27 09:56:34'),
	(157,10,30,'2024-05-27 09:59:08','2024-05-27 09:59:08'),
	(158,10,32,'2024-05-27 09:59:08','2024-05-27 09:59:08'),
	(159,10,37,'2024-05-27 09:59:08','2024-05-27 09:59:08'),
	(160,10,38,'2024-05-27 09:59:08','2024-05-27 09:59:08'),
	(161,10,39,'2024-05-27 09:59:08','2024-05-27 09:59:08'),
	(162,10,40,'2024-05-27 09:59:08','2024-05-27 09:59:08'),
	(163,4,45,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(164,4,46,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(165,4,47,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(166,4,48,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(167,4,53,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(168,4,54,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(169,4,55,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(170,4,56,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(171,4,81,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(172,4,82,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(173,4,83,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(174,4,84,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(175,4,89,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(176,4,90,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(177,4,91,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(178,4,92,'2024-05-27 10:02:25','2024-05-27 10:02:25'),
	(179,22,133,'2024-05-28 02:23:03','2024-05-28 02:23:03'),
	(180,22,135,'2024-05-28 02:23:03','2024-05-28 02:23:03'),
	(181,23,134,'2024-05-28 02:44:31','2024-05-28 02:44:31'),
	(182,23,150,'2024-05-28 02:44:31','2024-05-28 02:44:31');

/*!40000 ALTER TABLE `matkul_dosens` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
	(3,'2019_08_19_000000_create_failed_jobs_table',1),
	(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
	(5,'2023_11_12_062518_create_dosens_table',1),
	(6,'2023_11_12_093844_create_mata_kuliahs_table',1),
	(7,'2023_11_13_072258_create_akademiks_table',1),
	(8,'2023_11_13_072305_create_edarans_table',1),
	(9,'2023_12_03_042736_create_mahasantris_table',1),
	(10,'2024_01_01_133557_create_classes_table',1),
	(11,'2024_01_01_221259_create_schedules_table',2),
	(12,'2024_01_08_232919_alter_mahasantris_table',3),
	(13,'2024_01_10_010033_create__absents_table',4),
	(14,'2014_10_12_100000_create_password_resets_table',5),
	(15,'2024_01_19_004124_create_scores_table',6),
	(16,'2024_01_21_095607_create_matkul_dosens_table',7),
	(17,'2024_01_21_125827_alter_schedules_table',8),
	(18,'2024_02_09_041602_create_payment_types_table',9),
	(19,'2024_02_09_082959_alter_class_table',10),
	(22,'2024_02_11_105034_create_invoices_table',11),
	(23,'2024_02_11_105052_create_detail_invoices_table',11),
	(24,'2024_02_21_011828_create_prestasis_table',12),
	(25,'2024_05_31_104605_alter_schedule_table',13);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_reset_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table payment_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payment_types`;

CREATE TABLE `payment_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `payment_types` WRITE;
/*!40000 ALTER TABLE `payment_types` DISABLE KEYS */;

INSERT INTO `payment_types` (`id`, `name`, `type`, `nominal`, `created_at`, `updated_at`)
VALUES
	(1,'Wakaf Wajib','3',6000000,'2024-02-09 11:01:24','2024-02-09 11:01:24'),
	(2,'SPP','1',3000000,'2024-02-09 11:01:44','2024-02-09 11:01:44'),
	(3,'Kalender','1',50000,'2024-02-09 11:02:06','2024-02-09 11:02:06'),
	(4,'hangeuo','2',700000,'2024-02-09 11:02:32','2024-02-09 11:02:32'),
	(5,'kitab-kitab','2',8000000,'2024-02-09 11:02:47','2024-02-09 11:02:47');

/*!40000 ALTER TABLE `payment_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table prestasis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prestasis`;

CREATE TABLE `prestasis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `prestasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table schedules
# ------------------------------------------------------------

DROP TABLE IF EXISTS `schedules`;

CREATE TABLE `schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(11) DEFAULT NULL,
  `mata_kuliah_id` int(11) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` time DEFAULT NULL,
  `end_date` time DEFAULT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` int(11) DEFAULT '1',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Banin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;

INSERT INTO `schedules` (`id`, `class_id`, `mata_kuliah_id`, `dosen_id`, `day`, `start_date`, `end_date`, `place`, `semester`, `type`, `created_at`, `updated_at`)
VALUES
	(11,5,14,2,'Sabtu','05:00:00','06:30:00','Aula Kiai Idris Kamali',1,'Banin','2024-05-27 09:51:08','2024-05-27 09:51:08'),
	(12,5,24,2,'Sabtu','05:00:00','06:30:00','Aula Kiai Idris Kamali',1,'Banin','2024-05-27 09:53:57','2024-05-27 09:53:57'),
	(13,5,32,10,'Minggu','05:00:00','06:30:00','Masjid Muniroh Salamah',1,'Banin','2024-05-27 09:58:07','2024-05-27 09:58:07'),
	(14,5,40,10,'Minggu','05:00:00','06:30:00','Masjid Muniroh Salamah',1,'Banin','2024-05-27 10:00:32','2024-05-27 10:00:32'),
	(15,5,48,4,'Selasa','05:00:00','06:30:00','Masjid Muniroh Salamah',1,'Banin','2024-05-27 10:03:55','2024-05-27 10:03:55'),
	(16,5,56,4,'Selasa','05:00:00','06:30:00','Masjid Muniroh Salamah',1,'Banin','2024-05-27 10:06:52','2024-05-27 10:06:52'),
	(17,5,64,5,'Kamis','05:00:00','06:30:00','Aula Kiai Idris Kamali',1,'Banin','2024-05-27 10:08:10','2024-05-27 10:08:10'),
	(18,5,72,5,'Kamis','05:00:00','06:30:00','Aula Kiai Idris Kamali',1,'Banin','2024-05-27 10:08:50','2024-05-27 10:08:50'),
	(19,5,80,6,'Senin','05:00:00','06:30:00','Aula Kiai Idris Kamali',1,'Banin','2024-05-27 10:11:00','2024-05-27 10:11:00'),
	(20,5,88,6,'Senin','05:00:00','06:30:00','Aula Kiai Idris Kamali',1,'Banin','2024-05-27 10:11:34','2024-05-27 10:11:34'),
	(21,5,100,25,'Kamis','19:30:00','21:00:00','Kelas Madrasah',1,'Banin','2024-05-27 10:13:27','2024-05-27 10:13:27'),
	(22,5,104,26,'Kamis','15:30:00','17:00:00','Masjid Muniroh Salamah',1,'Banin','2024-05-27 10:14:40','2024-05-27 10:14:40'),
	(23,5,112,13,'Senin','12:00:00','13:00:00','Aula Kiai Idris Kamali',1,'Banin','2024-05-27 10:15:44','2024-05-27 10:15:44'),
	(24,5,120,13,'Senin','12:00:00','13:00:00','-',1,'Banin','2024-05-28 01:30:36','2024-05-28 01:30:36'),
	(25,5,128,13,'Senin','12:00:00','13:00:00','Opsional',1,'Banin','2024-05-28 01:35:33','2024-05-28 01:35:33'),
	(26,5,135,22,'Selasa','15:30:00','17:00:00','Maktabah Banin',1,'Banin/Banat','2024-05-28 02:43:41','2024-05-28 02:43:41'),
	(27,5,150,23,'Selasa','19:30:00','21:00:00','Aula Kiai Idris Kamali',1,'Banin','2024-05-28 02:45:49','2024-05-28 02:45:49'),
	(28,7,21,2,'Rabu','12:00:00','13:00:00','mesjid',1,'Banat','2024-05-31 06:10:43','2024-05-31 06:10:43'),
	(29,7,11,2,'Rabu','12:12:00',NULL,'1',1,'Banat','2024-05-31 10:50:17','2024-05-31 10:50:17'),
	(30,7,39,10,'Rabu','12:00:00','12:00:00','1222',1,'Banat','2024-05-31 10:50:52','2024-05-31 10:50:52'),
	(31,7,38,10,'Rabu','12:00:00','12:00:00','eqweqwe',2,'Banat','2024-05-31 10:51:58','2024-05-31 10:51:58'),
	(34,7,48,4,'Selasa','12:00:00','12:00:00','Masjit lantai 1',NULL,'Banat','2024-06-02 12:06:17','2024-06-02 12:06:57');

/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table scores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `scores`;

CREATE TABLE `scores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `total_pelajaran` int(11) DEFAULT NULL,
  `persentasi_kehadiran` int(11) DEFAULT NULL,
  `akademik` double(8,2) DEFAULT NULL,
  `non_akademik` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'admin','admin@gmail.com',NULL,'$2y$10$wEjrDpK90Jvz9GLYlIZI5e7LKjMJ375MmlY2QARKxMCg44xu/cNXy','Admin',NULL,'2024-02-09 07:54:59','2024-02-09 07:54:59'),
	(2,'thoriq','dosen@gmail.com',NULL,'$2y$10$0yISeN.Y./p/W6pF5yM3AeAk/6t7iDwoft8l0FDKxzuj8WFSoqP8W','Dosen',NULL,'2024-02-09 07:57:58','2024-02-09 07:57:58'),
	(3,'Bahri Maknun','mahasantri@gmail.com',NULL,'$2y$10$BRti/dnyDrBon09H8rAosOc.L/6UK5drBP4s7QKxkNwaxd6dmVky6','Mahasantri',NULL,'2024-02-09 08:01:44','2024-02-09 08:01:44'),
	(4,'Dimas Putra Pamungkas','dimas@gmail.com',NULL,'$2y$10$2rQbPqQ.ZMw38dsADYhG2eRoc.OhNHcMz39tY/C2HkQ5/gX9dyvmi','Mahasantri',NULL,'2024-05-14 05:03:57','2024-05-14 05:03:57'),
	(5,'Muhammad Ibnu Fadil','ibnufadhil102@gmail.com',NULL,'$2y$10$8G8V5FmNWFAf80XEcM9TZekcicfji6Br.KrYJ.WczCiRjUqUXsiDG','Mahasantri',NULL,'2024-05-17 02:18:00','2024-05-17 02:18:00'),
	(6,'Ahmad Syafiq Maulana','syafiq.maulana20@mhs.uinjkt.ac.id',NULL,'$2y$10$zO4YmILmx3Cz2g4wB6zUBeGcv6sHZoIJXuXqJEs4IpJHOptxQPlvC','Mahasantri',NULL,'2024-05-18 02:02:44','2024-05-18 02:02:44'),
	(7,'Putri Annafi\'ah','putriannafiah@gmail.com',NULL,'$2y$10$VLbgZro0zjC1msC85ApNUuoDwi4J9OZMuMYYg3w8Q7N10bY7DSk9m','Mahasantri',NULL,'2024-05-18 02:12:56','2024-05-18 02:12:56'),
	(8,'Zia Ul Haramein Lc., M.Si','djioel@gmail.com',NULL,'$2y$10$sBdMbYRVTAFe.P5ndz5UBejeqOTZatDh5/OryzGaXqG7pEHLi5FTG','Dosen',NULL,'2024-05-18 06:38:58','2024-05-18 06:38:58'),
	(9,'Ust. Samsul Bahri, LC., MA.','samsul@gmail.com',NULL,'$2y$10$tDt1bhfDrDSQC5PdjUx3we1EfE7v4dx5wRrJC7UcJwq7oQ.2qkCZ2','Dosen',NULL,'2024-05-20 06:59:02','2024-05-20 06:59:02'),
	(10,'Mochammad Nagieb Jihadil Akbar','naghieb@gmail.com',NULL,'$2y$10$ZstolCvyV3Lbc2a8oDzrdedVCA30rQ80c7VK4italaB.FqOoIpxLu','Mahasantri',NULL,'2024-05-20 07:32:20','2024-05-20 07:32:20'),
	(11,'Imas Musfiroh','imas@gmail.com',NULL,'$2y$10$MPAQEtyfLlAi6uFwQdotBuunojzIbBMbQvLh4kJOTlk5u6eamvlTK','Mahasantri',NULL,'2024-05-20 07:36:22','2024-05-20 07:36:22'),
	(12,'Ari Mulyadi','ari@gmail.com',NULL,'$2y$10$2.8EH.UvtWprcP0VnY6h9ex9SGVJO7ftnA2jQFW8GwftggyJ4Vppq','Mahasantri',NULL,'2024-05-20 07:46:38','2024-05-20 07:46:38'),
	(13,'Husna Shabrina','husna@gmail.com',NULL,'$2y$10$QkqX3BnU..tTWDJ1uPIrKOn0Eel8roJ47VaAvNNibUNi5UMXJGhja','Mahasantri',NULL,'2024-05-20 07:47:39','2024-05-20 07:47:39'),
	(14,'Zainuddin Nur','zay@gmail.com',NULL,'$2y$10$vF.7UrL4c6qJAVuu8N43auf5jTmbxYj1mWGZxvV.vTG5Qq4vItPVS','Mahasantri',NULL,'2024-05-20 07:48:51','2024-05-20 07:48:51'),
	(15,'Siti Firgiya','firgi@gmail.com',NULL,'$2y$10$atT97N00nw.AgHouJ5o4Z.h9NeanWJRB6lKy0LQTL.C/rrjjQTWjO','Mahasantri',NULL,'2024-05-20 07:49:43','2024-05-20 07:49:43'),
	(16,'Ust. Dr. Fazlurrahman, LC., MA.','fazlu@gmail.com',NULL,'$2y$10$92qcT33F7kRZWpRSqSU5zObereDa6Xdx2KqcjFQx29uksDFT895ta','Dosen',NULL,'2024-05-20 09:00:09','2024-05-20 09:00:09'),
	(17,'Ust. Muhammad Hanifuddin, LC., S.S.I., S.Sos., M.I.P.','hanif@gmail.com',NULL,'$2y$10$DK0D37.6TQ2iIZ7k4QHV6.TUhDWs3Vy1LQZWxyADFLlz1udGEdaVG','Dosen',NULL,'2024-05-20 09:01:18','2024-05-20 09:01:18'),
	(18,'Ust. Ulin Nuha, LC., MA.','ulin@gmail.com',NULL,'$2y$10$CAaAVoHp5A.q4DnIv7Hy0ugZ20cLOv0KvJxUwCqJouRg./0Hj45Vi','Dosen',NULL,'2024-05-20 09:03:31','2024-05-20 09:03:31'),
	(19,'Amien Nurhakim, LC., MA.','amien@gmail.com',NULL,'$2y$10$X0tvbRTD8quDQIrodL7CdOOsePYPXIcqzBTFK7GhtnB2n0AJTNGiq','Dosen',NULL,'2024-05-27 06:39:02','2024-05-27 06:39:02'),
	(20,'Dzulhikam Masyfuqil Ibad, LC., MA.','dzul@gmail.com',NULL,'$2y$10$ye8r0Q7CXuKbY0hR4LW4MOrUfoXIwDQKVL.UC.nx0vH4aQuQUrnVW','Dosen',NULL,'2024-05-27 06:40:46','2024-05-27 06:40:46'),
	(21,'Muhammad Miqdad Al Farizi, LC., S.Ag.','miqdad@gmail.com',NULL,'$2y$10$K9w5Df.Bpdk6ruoC7dhye.EiycgH3eI6zgjqCB59aXxcaMxyVnSTC','Dosen',NULL,'2024-05-27 06:45:04','2024-05-27 06:45:04'),
	(22,'Ust. Tubagus Hasan Basri, LC., M.Ag.','tb@gmail.com',NULL,'$2y$10$zyS196aD8aIvjBLCmGt2WuKG0XNTef/ftoZ6P.d7D9czh3y0UwH.G','Dosen',NULL,'2024-05-27 07:07:53','2024-05-27 07:07:53'),
	(23,'Ust. Dr. Syarif Hidayatullah, LC., M.Hum.','syarif@gmail.com',NULL,'$2y$10$2PzdRKWYotUAMywqNXcQc.SIwp.HT9m8vIi9qM4HvbRNc7tDa6dQG','Dosen',NULL,'2024-05-27 08:02:51','2024-05-27 08:02:51'),
	(24,'Ust. Dr. Alvian Iqbal Zahasfan, LC., MA.','alvian@gmail.com',NULL,'$2y$10$19kXsFB/do99E//ViTNCDuG5Sk4xzFFbxYP1dqDxSjPWNHVpASzO2','Dosen',NULL,'2024-05-27 08:47:26','2024-05-27 08:47:26'),
	(25,'Afrian Ulu Millah, LC. S.S.I','afriyan@gmail.com',NULL,'$2y$10$MNC3npamma2OxPBRyzEIUu4VuuQelFLiuQXK6yMXXxo.u/Imizsg2','Dosen',NULL,'2024-05-27 08:58:57','2024-05-27 08:58:57'),
	(26,'Ahmad Zaki, LC.','zaky@gmail.com',NULL,'$2y$10$.E9h7J.0TIAtcklT/1F6s.cQbZleOp1NXjVpPsiMUk0IrznEAT8iy','Dosen',NULL,'2024-05-27 09:00:16','2024-05-27 09:00:16'),
	(27,'Ust. Dr. Muhbib Abdul Wahab, MA.','muhbib@gmail.com',NULL,'$2y$10$NZKWebfwGCv.d4q7D7NYTOC2hUfpxPP6pPVwwGTOkLPPzvnDOq.xS','Dosen',NULL,'2024-05-27 09:01:25','2024-05-27 09:01:25'),
	(28,'Ust. Badruddin Abdurrahman, Lc.','badruddin@gmail.com',NULL,'$2y$10$UpHx4nBqQZGp07XNh5gzoOzj9VauMdEZrfKA0b2HuegI73NFyKUc.','Dosen',NULL,'2024-05-27 09:03:01','2024-05-27 09:03:01'),
	(29,'Balqis Inas, LC., S.S.I.','balqis@gmail.com',NULL,'$2y$10$xtGF/eJzY.NlzdxGJqHTfeXB83YKC6uFLnWF10SM4n6p3psShGLcC','Dosen',NULL,'2024-05-27 09:07:13','2024-05-27 09:07:13'),
	(30,'Wilda Ana Chamidah, LC., S.Sos.','wilda@gmail.com',NULL,'$2y$10$2y357iULFM.ZFsjw8k5ASu6SpCJ47vbKn.QiQJifapqKYeptkvjoO','Dosen',NULL,'2024-05-27 09:13:09','2024-05-27 09:13:09'),
	(31,'Maziyah, LC.','maze@gmail.com',NULL,'$2y$10$6KSgDMoqWP/2fQW0fl4AuepMHpHvZFotGXtIfz193WLF0nniys6BG','Dosen',NULL,'2024-05-27 09:16:52','2024-05-27 09:16:52'),
	(32,'Nurul Afifah, LC., S.S.I.','nurulafifah@gmail.com',NULL,'$2y$10$ICG6JzkGsjK4XvKQYszLr.fJuZJc8oDg85hM9zJzowCzFGRA0Igfe','Dosen',NULL,'2024-05-27 09:18:17','2024-05-27 09:18:17'),
	(33,'Ust. Subhan Mahsuni, LC., S.Hum.','subhan@gmail.com',NULL,'$2y$10$tGNHOCw9SHh133x1pag16.USbLgIH527px0HUJb3GJ94fpqe35awS','Dosen',NULL,'2024-05-27 09:20:59','2024-05-27 09:20:59'),
	(34,'Ust. Dr. Andi Rahman, LC., MA.','andiwowo@gmail.com',NULL,'$2y$10$SRbSjottiEvDI9DJ.WhmN.rBOIPPtJfxlD4ADgoPL2aSCOYLSZwUi','Dosen',NULL,'2024-05-27 09:22:51','2024-05-27 09:22:51'),
	(35,'Ust. Erta Mahyuddin, LC., M.Pd.I.','erta@gmail.com',NULL,'$2y$10$MNx8ANqRHYV6MrOaxs.YGuhjsBIQCxeLe2d8mhFuHzI6gSal08t9a','Dosen',NULL,'2024-05-27 09:23:59','2024-05-27 09:23:59'),
	(36,'Ust. Aenul Yakin, LC., S.Ag.','aenul@gmail.com',NULL,'$2y$10$t86iAB7V8LW9yDDgcNMNdO9kfr2nkoblP6HwWeqc.FzRxEkOxDwAW','Dosen',NULL,'2024-05-27 09:25:25','2024-05-27 09:25:25'),
	(37,'Ust. Fajrin Fauzi, LC., M.Pd.','fajrin@gmail.com',NULL,'$2y$10$6q/ecV7EsB1PA2Ocf37zpeJrgnPOMyPPKGq8h85.35RICtky8nAd6','Dosen',NULL,'2024-05-27 09:26:13','2024-05-27 09:26:13'),
	(38,'Ust. Ahmad Munshorif, LC., MA.','amu@gmail.com',NULL,'$2y$10$y9DOBCUcb1vpthNb0hFnxOCS87qPHJ26kIhewlCjIROU3ler2f8V2','Dosen',NULL,'2024-05-27 09:27:59','2024-05-27 09:27:59'),
	(39,'Ust. Hasan Sobari, LC., S.Fil.','acan@gmail.com',NULL,'$2y$10$HNxnrcywCLfQ2MD9LVaqn.cZ0O26xZQ/Cmu0f5dZzSSPBhdRf9shS','Dosen',NULL,'2024-05-27 09:29:38','2024-05-27 09:29:38'),
	(40,'Ust. Haqim Hasan al Bana, LC., M.Pd.','haqim@gmail.com',NULL,'$2y$10$LWzB0TQU2GdObR9/KLklYuJRiC14zG069mBq5tjx0sZf0JZglFnJa','Dosen',NULL,'2024-05-27 09:31:29','2024-05-27 09:31:29'),
	(41,'Ust. M. Khoirul Huda, LC., MA.','huda@gmail.com',NULL,'$2y$10$2kc9XlQ601AL.fekaIfr9eUVFri733xW6R9TkYhL4TTZQSSwrokAe','Dosen',NULL,'2024-05-27 09:38:15','2024-05-27 09:38:15'),
	(42,'Ust. Hilmy Firdausy, LC., MA.','hilmy@gmail.com',NULL,'$2y$10$DdSCsy08vZQYppYPw.3xiOgrQWlGjOjvmYPLuQjrZ2SSslvWB1m0u','Dosen',NULL,'2024-05-27 09:40:46','2024-05-27 09:40:46'),
	(43,'Ust. M. Syarofuddin Firdaus, S.H., MA.','firdaus@gmail.com',NULL,'$2y$10$PUCRRw/J53ixJDiNGsIe1.eUcMtYbeSclNtrjpPH6rDNMJ9WbzWfG','Dosen',NULL,'2024-05-27 09:41:38','2024-05-27 09:41:38'),
	(44,'Ust. Mahbub Hifdzil Akbar, LC., MA.','mahbub@gmail.com',NULL,'$2y$10$1b74D6xfpYzYPvqKOeUVl.4WOswnb46MSJqkgzxGHeS7pcU7DeNJS','Dosen',NULL,'2024-05-27 09:43:42','2024-05-27 09:43:42'),
	(45,'Usth. Nur Fadhila Myanti Efha, S.Ag.','fadhila@gmail.com',NULL,'$2y$10$h6KiFVHpbDU9faBjqogF1.MXw2RPbohC/6DpOHWb9IrY8iJGLQtki','Dosen',NULL,'2024-05-27 09:45:04','2024-05-27 09:45:04'),
	(46,'Usth. Isna Ulya Azizah, LC., M.Ag.','isnaulya@gmail.com',NULL,'$2y$10$0lKgHoGkyIA/Ufn3ZhUvXePd8UpXoXa2D7piS9P2ryiJsk.JpnJVK','Dosen',NULL,'2024-05-27 09:46:05','2024-05-27 09:46:05'),
	(47,'Ibnu Kharish LC, M.Hum','ustahong@gmail.com',NULL,'$2y$10$fFmAwJrVKX3Dnb1kzYkc..XMFY2go4GVZrsACA4ujWzy5f1ORLyIq','Dosen',NULL,'2024-05-27 09:47:45','2024-05-27 09:47:45');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
