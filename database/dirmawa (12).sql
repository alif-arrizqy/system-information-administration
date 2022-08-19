-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2022 at 05:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dirmawa`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggaran`
--

CREATE TABLE `anggaran` (
  `id_anggaran` int(11) NOT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `pagu_anggaran` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggaran`
--

INSERT INTO `anggaran` (`id_anggaran`, `id_lembaga`, `pagu_anggaran`, `created_at`, `updated_at`) VALUES
(1, 35, 78000000, NULL, '2022-08-09 15:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `dana_subsidi`
--

CREATE TABLE `dana_subsidi` (
  `id_subsidi` int(11) UNSIGNED NOT NULL,
  `id_lembaga` int(11) NOT NULL,
  `lembaga_penerima` int(11) NOT NULL,
  `judul_kegiatan` varchar(100) NOT NULL,
  `pengajuan_anggaran` int(11) NOT NULL,
  `anggaran_diterima` int(11) NOT NULL,
  `file` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) UNSIGNED NOT NULL,
  `nama_fakultas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`) VALUES
(1, 'Fakultas Hukum'),
(2, 'Fakultas Ekonomi dan Bisnis'),
(3, 'Fakultas Keguruan dan Ilmu Pendidikan'),
(4, 'Fakultas Ilmu Sosial dan Ilmu Budaya'),
(5, 'Fakultas Teknik'),
(6, 'Fakultas Matematika & Ilmu Pengetahuan Alam');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kegiatan`
--

CREATE TABLE `laporan_kegiatan` (
  `id_laporan_keg` int(11) NOT NULL,
  `id_lembaga` int(11) NOT NULL,
  `id_proposal` int(11) DEFAULT NULL,
  `realisasi_anggaran` int(11) DEFAULT NULL,
  `files` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `lembaga`
--

CREATE TABLE `lembaga` (
  `id_lembaga` int(11) UNSIGNED NOT NULL,
  `nama_lembaga` varchar(100) NOT NULL,
  `tingkat_lembaga` int(11) NOT NULL,
  `id_fakultas` int(11) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lembaga`
--

INSERT INTO `lembaga` (`id_lembaga`, `nama_lembaga`, `tingkat_lembaga`, `id_fakultas`, `id_prodi`) VALUES
(1, 'WAREK 1', 0, NULL, NULL),
(2, 'WAREK 2', 0, NULL, NULL),
(3, 'WAREK 3', 0, NULL, NULL),
(4, 'DIRMAWA', 0, NULL, NULL),
(5, 'DEKAN FH', 3, 1, NULL),
(6, 'WADEK 1 FH', 3, 1, NULL),
(7, 'WADEK 2 FH', 3, 1, NULL),
(8, 'ASWADEK 1 FH', 3, 1, NULL),
(9, 'ASWADEK 2 FH', 3, 1, NULL),
(10, 'DEKAN FE', 3, 2, NULL),
(11, 'WADEK 1 FE', 3, 2, NULL),
(12, 'WADEK 2 FE', 3, 2, NULL),
(13, 'ASWADEK 1 FE', 3, 2, NULL),
(14, 'ASWADEK 2 FE', 3, 2, NULL),
(15, 'DEKAN FKIP', 3, 3, NULL),
(16, 'WADEK 1 FKIP', 3, 3, NULL),
(17, 'WADEK 2 FKIP', 3, 3, NULL),
(18, 'ASWADEK 1 FKIP', 3, 3, NULL),
(19, 'ASWADEK 2 FKIP', 3, 3, NULL),
(20, 'DEKAN FISIB', 3, 4, NULL),
(21, 'WADEK 1 FISIB', 3, 4, NULL),
(22, 'WADEK 2 FISIB', 3, 4, NULL),
(23, 'ASWADEK 1 FISIB', 3, 4, NULL),
(24, 'ASWADEK 2 FISIB', 3, 4, NULL),
(25, 'DEKAN FT', 3, 5, NULL),
(26, 'WADEK 1 FT', 3, 5, NULL),
(27, 'WADEK 2 FT', 3, 5, NULL),
(28, 'ASWADEK 1 FT', 3, 5, NULL),
(29, 'ASWADEK 2 FT', 3, 5, NULL),
(30, 'DEKAN FMIPA', 3, 6, NULL),
(31, 'WADEK 1 FMIPA', 3, 6, NULL),
(32, 'WADEK 2 FMIPA', 3, 6, NULL),
(33, 'ASWADEK 1 FMIPA', 3, 6, NULL),
(34, 'ASWADEK 2 FMIPA', 3, 6, NULL),
(35, 'BEM_KBM', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(12, '2022-08-09-134643', 'App\\Database\\Migrations\\Fakultas', 'default', 'App', 1660871737, 1),
(13, '2022-08-09-135552', 'App\\Database\\Migrations\\ProgramStudi', 'default', 'App', 1660871737, 1),
(14, '2022-08-09-144558', 'App\\Database\\Migrations\\Lembaga', 'default', 'App', 1660871737, 1),
(21, '2022-08-10-013003', 'App\\Database\\Migrations\\Surat', 'default', 'App', 1660873804, 2),
(22, '2022-08-19-011425', 'App\\Database\\Migrations\\DanaSubsidi', 'default', 'App', 1660873807, 3);

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id_prodi` int(11) UNSIGNED NOT NULL,
  `nama_prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id_prodi`, `nama_prodi`) VALUES
(1, 'Hukum'),
(2, 'Manajemen'),
(3, 'Akuntansi'),
(4, 'Bisnis Digital'),
(5, 'Bahasa Sastra Indonesia'),
(6, 'Bahasa Inggris'),
(7, 'Bahasa Pendidikan Biologi'),
(8, 'Bahasa Pendidikan IPA'),
(9, 'PGSD'),
(10, 'PPG FKIP'),
(11, 'Bahasa & Sastra Inggris'),
(12, 'Bahasa & Sastra Jepang'),
(13, 'Bahasa & Sastra Indonesia'),
(14, 'Ilmu Komunikasi'),
(15, 'Geologi'),
(16, 'Perencanaan Wilayah & Kota'),
(17, 'Sipil'),
(18, 'Teknik Elektro'),
(19, 'Teknik Geodesi'),
(20, 'Biologi'),
(21, 'Kimia'),
(22, 'Matematika'),
(23, 'Ilmu Komputer'),
(24, 'Farmasi');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id_proposal` int(11) NOT NULL,
  `id_lembaga` int(11) NOT NULL,
  `lembaga_penerima` int(11) NOT NULL,
  `lembaga_disposisi` int(11) NOT NULL,
  `lembaga_mengetahui` int(11) NOT NULL,
  `judul_kegiatan` varchar(50) DEFAULT NULL,
  `pengajuan_anggaran` int(20) DEFAULT NULL,
  `anggaran_diterima` int(20) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id_surat` int(11) UNSIGNED NOT NULL,
  `id_lembaga` int(11) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `jenis_surat` int(11) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `lembaga_penerima` int(11) NOT NULL,
  `nama_disposisi` varchar(100) NOT NULL,
  `lembaga_disposisi` int(11) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `file` text NOT NULL,
  `perihal` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `fullname`, `username`, `password`, `status`, `id_lembaga`, `foto`) VALUES
(1, 'Andi Chairunnas', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 4, '1660879896_e83e208b431aa18967da.jpg'),
(12, 'Gozali yasser', 'warek1', 'e456c7dd9c9a0fa491abf69384e10fd6', 3, 1, 'avatar-13_1660920638_4b3a9e9598526fbd5e6a.png'),
(13, 'Dimas Ukin', 'bem_kbm', 'a008e730692c5b56719645acad8db899', 1, 35, 'logo@300x_1660921295_bd292fa8edebf4963e1b.png'),
(14, 'asas', 'warek3', '5823e678e29df2707b6d57206f350548', 3, 3, 'logo@300x_1660921718_93a4738ba271a55e06d0.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id_anggaran`);

--
-- Indexes for table `dana_subsidi`
--
ALTER TABLE `dana_subsidi`
  ADD PRIMARY KEY (`id_subsidi`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  ADD PRIMARY KEY (`id_laporan_keg`) USING BTREE;

--
-- Indexes for table `lembaga`
--
ALTER TABLE `lembaga`
  ADD PRIMARY KEY (`id_lembaga`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id_proposal`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`),
  ADD UNIQUE KEY `no_surat` (`no_surat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dana_subsidi`
--
ALTER TABLE `dana_subsidi`
  MODIFY `id_subsidi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  MODIFY `id_laporan_keg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lembaga`
--
ALTER TABLE `lembaga`
  MODIFY `id_lembaga` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id_prodi` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id_proposal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
