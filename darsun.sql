-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 12:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darsun`
--

-- --------------------------------------------------------

--
-- Table structure for table `absents`
--

CREATE TABLE `absents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `mahasiswa_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `akademiks`
--

CREATE TABLE `akademiks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `tahun_ajaran` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tahun_ajaran` year(4) DEFAULT NULL,
  `smester` int(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `nama`, `tahun_ajaran`, `smester`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Kelas A', '2020', NULL, 'Laki-laki', '2024-01-18 02:25:06', '2024-01-18 02:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `dosens`
--

CREATE TABLE `dosens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `nomor_induk` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosens`
--

INSERT INTO `dosens` (`id`, `user_id`, `nomor_induk`, `jabatan`, `tipe`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2', 'Dosen', '2024-01-18 02:24:11', '2024-01-18 02:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `edarans`
--

CREATE TABLE `edarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasantris`
--

CREATE TABLE `mahasantris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `nama_depan` varchar(255) DEFAULT NULL,
  `nama_belakang` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `handphone` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `suku` varchar(255) DEFAULT NULL,
  `saudara` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `tempat_ayah` varchar(255) DEFAULT NULL,
  `lahir_ayah` date DEFAULT NULL,
  `pendidikan_ayah` varchar(255) DEFAULT NULL,
  `pekerjaan_ayah` varchar(255) DEFAULT NULL,
  `penghasilan_ayah` varchar(255) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `tempat_ibu` varchar(255) DEFAULT NULL,
  `lahir_ibu` date DEFAULT NULL,
  `pendidikan_ibu` varchar(255) DEFAULT NULL,
  `pekerjaan_ibu` varchar(255) DEFAULT NULL,
  `penghasilan_ibu` varchar(255) DEFAULT NULL,
  `nama_wali` varchar(255) DEFAULT NULL,
  `alamat_wali` text DEFAULT NULL,
  `handphone_wali` varchar(255) DEFAULT NULL,
  `whatsapp_wali` varchar(255) DEFAULT NULL,
  `asal_sekolah` varchar(255) DEFAULT NULL,
  `alamat_sekolah` text DEFAULT NULL,
  `nomor_ijazah` varchar(255) DEFAULT NULL,
  `tanggal_ijazah` date DEFAULT NULL,
  `asal_pesantren` varchar(255) DEFAULT NULL,
  `alamat_pesantren` text DEFAULT NULL,
  `hobi` varchar(255) DEFAULT NULL,
  `golongan_darah` varchar(255) DEFAULT NULL,
  `berat_badan` varchar(255) DEFAULT NULL,
  `tinggi_badan` varchar(255) DEFAULT NULL,
  `penyakit` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `class_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasantris`
--

INSERT INTO `mahasantris` (`id`, `user_id`, `kelas_id`, `nim`, `nama_depan`, `nama_belakang`, `email`, `handphone`, `nik`, `alamat`, `kode_pos`, `tanggal_lahir`, `suku`, `saudara`, `whatsapp`, `foto`, `nama_ayah`, `tempat_ayah`, `lahir_ayah`, `pendidikan_ayah`, `pekerjaan_ayah`, `penghasilan_ayah`, `nama_ibu`, `tempat_ibu`, `lahir_ibu`, `pendidikan_ibu`, `pekerjaan_ibu`, `penghasilan_ibu`, `nama_wali`, `alamat_wali`, `handphone_wali`, `whatsapp_wali`, `asal_sekolah`, `alamat_sekolah`, `nomor_ijazah`, `tanggal_ijazah`, `asal_pesantren`, `alamat_pesantren`, `hobi`, `golongan_darah`, `berat_badan`, `tinggi_badan`, `penyakit`, `jenis_kelamin`, `class_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, '139172931', 'test', 'nama', NULL, NULL, '139172931', NULL, NULL, NULL, NULL, NULL, '139172931', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '139172931', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'aktif', '2024-01-18 02:24:51', '2024-01-18 02:24:51'),
(2, '1', 1, '139172931', 'test', NULL, NULL, NULL, '139172931', NULL, NULL, NULL, NULL, NULL, '139172931', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '139172931', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Laki-laki', NULL, 'aktif', '2024-01-18 04:01:03', '2024-01-18 04:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliahs`
--

CREATE TABLE `mata_kuliahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `smester` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_kuliahs`
--

INSERT INTO `mata_kuliahs` (`id`, `nama`, `kode`, `sks`, `smester`, `created_at`, `updated_at`) VALUES
(1, 'asdf', 'asdf', 1, 1, '2024-01-18 04:00:24', '2024-01-18 04:00:24'),
(2, 'asdfas', 'dfasdf', 2, 2, '2024-01-18 04:02:22', '2024-01-18 04:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_12_062518_create_dosens_table', 1),
(7, '2023_11_12_093844_create_mata_kuliahs_table', 1),
(8, '2023_11_13_072258_create_akademiks_table', 1),
(9, '2023_11_13_072305_create_edarans_table', 1),
(10, '2023_12_03_042736_create_mahasantris_table', 1),
(11, '2024_01_01_133557_create_classes_table', 1),
(12, '2024_01_01_221259_create_schedules_table', 1),
(13, '2024_01_08_232919_alter_mahasantris_table', 1),
(14, '2024_01_10_010033_create__absents_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `mata_kuliah_id` int(11) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `start_date` time DEFAULT NULL,
  `end_date` time DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `class_id`, `mata_kuliah_id`, `dosen_id`, `day`, `start_date`, `end_date`, `place`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Selasa', '12:00:00', '12:00:00', '1', '2024-01-18 04:01:32', '2024-01-18 04:01:32'),
(2, 1, 2, 1, 'Selasa', '12:00:00', '12:00:00', '2', '2024-01-18 04:02:40', '2024-01-18 04:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'admin@mail.com', NULL, '$2y$10$tk/Lw.a1M7BDMUf2gW0/GuYj9BXL3wQPvWYkrlXDAywajTOAyQsI2', 'Dosen', NULL, '2024-01-18 02:24:11', '2024-01-18 02:24:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absents`
--
ALTER TABLE `absents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akademiks`
--
ALTER TABLE `akademiks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `edarans`
--
ALTER TABLE `edarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `mahasantris`
--
ALTER TABLE `mahasantris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absents`
--
ALTER TABLE `absents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `akademiks`
--
ALTER TABLE `akademiks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dosens`
--
ALTER TABLE `dosens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `edarans`
--
ALTER TABLE `edarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasantris`
--
ALTER TABLE `mahasantris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
