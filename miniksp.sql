-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2022 at 04:08 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miniksp`
--

-- --------------------------------------------------------

--
-- Table structure for table `angsurans`
--

CREATE TABLE `angsurans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `jumlah_cicilan` float NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_ledgers`
--

CREATE TABLE `general_ledgers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` int(11) DEFAULT 0,
  `total` int(11) NOT NULL,
  `jenis_transaksi` enum('debet','wajib','sukarela','operasional','pinjaman','pengembalian','shu','denda') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_pembukuan` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_ledgers`
--

INSERT INTO `general_ledgers` (`id`, `transaksi_id`, `total`, `jenis_transaksi`, `user_id`, `status_pembukuan`, `created_at`, `updated_at`) VALUES
(81, 110, 2500, 'wajib', 1, '1', '2022-09-10 06:15:03', NULL),
(82, 111, 5000, 'sukarela', 1, '1', '2022-09-10 06:15:23', NULL),
(83, 112, 2500, 'wajib', 1, '1', '2022-09-10 07:01:32', NULL),
(84, 113, 10000, 'sukarela', 1, '1', '2022-09-10 07:01:45', NULL),
(85, 114, 6000, 'pinjaman', 1, '1', '2022-10-01 00:45:05', NULL),
(86, 115, 3060, 'pengembalian', 1, '1', '2022-10-01 03:37:34', NULL),
(87, 116, 3060, 'pengembalian', 1, '1', '2022-10-02 03:46:15', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kas_keluar`
-- (See below for the actual view)
--
CREATE TABLE `kas_keluar` (
`total` decimal(34,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `kas_masuk`
-- (See below for the actual view)
--
CREATE TABLE `kas_masuk` (
`total` decimal(36,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `laba`
-- (See below for the actual view)
--
CREATE TABLE `laba` (
`laba` double(19,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2022_07_09_160313_create_table_nasabah', 1),
(12, '2022_07_22_122618_create_table_transaksi', 2),
(16, '2022_07_27_090823_create_table_general_ledgers', 3),
(17, '2022_07_28_103653_create_pinjamans', 3),
(18, '2022_07_28_143647_create_angsurans', 3),
(19, '2022_08_07_134902_create_pengembalians', 4);

-- --------------------------------------------------------

--
-- Table structure for table `nasabahs`
--

CREATE TABLE `nasabahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saldo_akhir` int(20) NOT NULL DEFAULT 0,
  `status_pinjaman` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nasabahs`
--

INSERT INTO `nasabahs` (`id`, `nama_lengkap`, `no_rekening`, `alamat`, `telp`, `foto`, `saldo_akhir`, `status_pinjaman`, `created_at`, `updated_at`) VALUES
(36, 'Babe Cabita', '12345678', 'Leuwigajah', '', '', 7500, '0', NULL, '2022-09-10 06:15:23'),
(37, 'Charlie van houten', '13245678', 'Bandung', '', '', 12500, '0', NULL, '2022-09-10 07:01:45'),
(38, 'B. Pamungkas', '13425678', 'Cisarua', '', '', 0, '0', NULL, NULL),
(46, 'Roy suryo', '33125671', 'Cirebon', '071111111', 'user-check.svg', 0, '0', '2022-08-14 21:12:33', '2022-08-14 21:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalians`
--

CREATE TABLE `pengembalians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pinjaman_id` int(11) NOT NULL,
  `jumlah_cicilan` double(8,2) NOT NULL,
  `status_pinjam` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `aktif` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalians`
--

INSERT INTO `pengembalians` (`id`, `pinjaman_id`, `jumlah_cicilan`, `status_pinjam`, `aktif`, `created_at`, `updated_at`) VALUES
(6, 65, 3060.00, '0', '1', '2022-10-01 03:37:34', NULL),
(7, 65, 3060.00, '0', '1', '2022-10-02 03:46:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pinjamans`
--

CREATE TABLE `pinjamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `no_rekening` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `angsuran` int(11) NOT NULL,
  `persen` double(5,2) NOT NULL,
  `skema` enum('flat','nflat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `ket` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pinjamans`
--

INSERT INTO `pinjamans` (`id`, `transaksi_id`, `no_rekening`, `nama_lengkap`, `total`, `angsuran`, `persen`, `skema`, `status`, `ket`, `aktif`, `created_at`, `updated_at`) VALUES
(65, 114, '12345678', 'Babe Cabita', 6000, 2, 2.00, 'flat', '0', 'belanja', '1', '2022-10-01 00:45:05', '2022-10-01 00:45:05');

-- --------------------------------------------------------

--
-- Stand-in structure for view `sisa_kas`
-- (See below for the actual view)
--
CREATE TABLE `sisa_kas` (
`total` decimal(37,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tot_pinjam`
-- (See below for the actual view)
--
CREATE TABLE `tot_pinjam` (
`total` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `jenis_transaksi` enum('debet','wajib','sukarela','operasional','pinjaman','pengembalian','shu','denda') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `nasabah_id`, `total`, `jenis_transaksi`, `user_id`, `created_at`, `updated_at`) VALUES
(110, 36, 2500, 'wajib', 1, '2022-09-10 06:15:03', '2022-09-10 06:15:03'),
(111, 36, 5000, 'sukarela', 1, '2022-09-10 06:15:23', '2022-09-10 06:15:23'),
(112, 37, 2500, 'wajib', 1, '2022-09-10 07:01:32', '2022-09-10 07:01:32'),
(113, 37, 10000, 'sukarela', 1, '2022-09-10 07:01:45', '2022-09-10 07:01:45'),
(114, 36, 6000, 'pinjaman', 1, '2022-10-01 00:45:05', NULL),
(115, 36, 3060, 'pengembalian', 1, '2022-10-01 03:37:34', NULL),
(116, 36, 3060, 'pengembalian', 1, '2022-10-02 03:46:15', NULL);

--
-- Triggers `transaksis`
--
DELIMITER $$
CREATE TRIGGER `pembukuan` AFTER INSERT ON `transaksis` FOR EACH ROW INSERT INTO general_ledgers (transaksi_id,total,jenis_transaksi,user_id,created_at) SELECT id,total,jenis_transaksi,user_id,created_at FROM transaksis ORDER BY id DESC LIMIT 1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@miniksp.com', NULL, '$2y$10$zaFjW3Nzs/B.aSg4l8xmOO2iWCvqzcnPg7L5b0OLihIcmVRuN9Xwm', NULL, '2022-07-20 07:48:43', '2022-07-20 07:48:43'),
(5, 'polungga', 'polungga@miniksp.com', NULL, '$2y$10$vneClJ2NJPYnU8zYUCXeKOfVjvPkJvgqFmerKO34ZfgWuC.lzzI82', NULL, '2022-08-19 02:33:14', '2022-08-19 02:33:14');

-- --------------------------------------------------------

--
-- Structure for view `kas_keluar`
--
DROP TABLE IF EXISTS `kas_keluar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kas_keluar`  AS SELECT (select ifnull(sum(`a`.`total`),0) from `general_ledgers` `a` where `a`.`jenis_transaksi` = 'debet' and `a`.`status_pembukuan` = '1') + (select ifnull(sum(`a`.`total`),0) from `general_ledgers` `a` where `a`.`jenis_transaksi` = 'operasional' and `a`.`status_pembukuan` = '1') + (select ifnull(sum(`a`.`total`),0) from `general_ledgers` `a` where `a`.`jenis_transaksi` = 'pinjaman' and `a`.`status_pembukuan` = '1') AS `total` ;

-- --------------------------------------------------------

--
-- Structure for view `kas_masuk`
--
DROP TABLE IF EXISTS `kas_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kas_masuk`  AS SELECT (select ifnull(sum(`a`.`total`),0) from `general_ledgers` `a` where `a`.`jenis_transaksi` = 'pengembalian' and `a`.`status_pembukuan` = '1') + (select ifnull(sum(`a`.`total`),0) from `general_ledgers` `a` where `a`.`jenis_transaksi` = 'shu' and `a`.`status_pembukuan` = '1') + (select ifnull(sum(`a`.`total`),0) from `general_ledgers` `a` where `a`.`jenis_transaksi` = 'wajib' and `a`.`status_pembukuan` = '1') + (select ifnull(sum(`a`.`total`),0) from `general_ledgers` `a` where `a`.`jenis_transaksi` = 'sukarela' and `a`.`status_pembukuan` = '1') + (select ifnull(sum(`a`.`total`),0) from `general_ledgers` `a` where `a`.`jenis_transaksi` = 'denda' and `a`.`status_pembukuan` = '1') AS `total` ;

-- --------------------------------------------------------

--
-- Structure for view `laba`
--
DROP TABLE IF EXISTS `laba`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laba`  AS SELECT (select ifnull(sum(`a`.`jumlah_cicilan`),0) from `pengembalians` `a` where `a`.`status_pinjam` = '0' and `a`.`aktif` = '1') - (select ifnull(sum(`b`.`total`),0) from `pinjamans` `b` where `b`.`status` = '0' and `b`.`aktif` = '1') AS `laba` ;

-- --------------------------------------------------------

--
-- Structure for view `sisa_kas`
--
DROP TABLE IF EXISTS `sisa_kas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sisa_kas`  AS SELECT (select `kas_masuk`.`total` from `kas_masuk`) - (select `kas_keluar`.`total` from `kas_keluar`) AS `total` ;

-- --------------------------------------------------------

--
-- Structure for view `tot_pinjam`
--
DROP TABLE IF EXISTS `tot_pinjam`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tot_pinjam`  AS SELECT ifnull(sum(`pinjamans`.`total`),0) AS `total` FROM `pinjamans` WHERE `pinjamans`.`status` = '1' ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angsurans`
--
ALTER TABLE `angsurans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_ledgers`
--
ALTER TABLE `general_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nasabahs`
--
ALTER TABLE `nasabahs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_rekening` (`no_rekening`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengembalians`
--
ALTER TABLE `pengembalians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pinjamans`
--
ALTER TABLE `pinjamans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
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
-- AUTO_INCREMENT for table `angsurans`
--
ALTER TABLE `angsurans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_ledgers`
--
ALTER TABLE `general_ledgers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `nasabahs`
--
ALTER TABLE `nasabahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `pengembalians`
--
ALTER TABLE `pengembalians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinjamans`
--
ALTER TABLE `pinjamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
