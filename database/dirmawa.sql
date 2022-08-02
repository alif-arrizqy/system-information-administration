-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2022 at 03:39 AM
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
-- Table structure for table `laporan_kegiatan`
--

CREATE TABLE `laporan_kegiatan` (
  `id_laporan_keg` int(11) NOT NULL,
  `id_lembaga` int(11) NOT NULL,
  `judul_kegiatan` varchar(50) DEFAULT NULL,
  `anggaran` int(11) DEFAULT NULL,
  `realisasi_anggaran` int(11) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `lembaga`
--

CREATE TABLE `lembaga` (
  `id_lembaga` int(11) NOT NULL,
  `nama_lembaga` varchar(50) DEFAULT NULL,
  `tingkat_lembaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lembaga`
--

INSERT INTO `lembaga` (`id_lembaga`, `nama_lembaga`, `tingkat_lembaga`) VALUES
(1, 'DIRMAWA', 0),
(2, 'BEM KBM', 0),
(3, 'BLM KBM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id_proposal` int(11) NOT NULL,
  `id_lembaga` int(11) NOT NULL,
  `judul_kegiatan` varchar(50) DEFAULT NULL,
  `pengajuan_anggaran` int(20) DEFAULT NULL,
  `anggaran_diterima` int(20) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id_proposal`, `id_lembaga`, `judul_kegiatan`, `pengajuan_anggaran`, `anggaran_diterima`, `file`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'mariocf', 1100000, NULL, '1658332221_188ad0e15a556fc9cc54.pdf', 1, '2022-07-19 15:51:04', '2022-07-20 15:59:22'),
(2, 2, 'muda nikaha', 1200000, 5000000, '1658332383_a6d5a46e7059fe8c5b16.pdf', 1, '2022-07-19 15:56:27', '2022-07-21 07:15:38'),
(3, 2, 'taylor swift pensi', 19000000, 20000000, '1658332326_a684aef8d90f896260fd.pdf', 1, '2022-07-19 16:01:44', '2022-07-21 07:18:09'),
(4, 2, 'pinisirin', 3400000, NULL, '1658331827_1a2363e943956cdc5ba6.pdf', 1, '2022-07-20 14:12:59', '2022-07-21 04:52:10'),
(5, 2, 'emng babi', 10010111, 0, '1658331768_8733afb29f37906a1bdd.pdf', 2, '2022-07-20 14:19:46', '2022-07-21 07:17:55'),
(8, 3, 'amazing', 1000000, 0, NULL, 2, '2022-07-21 04:45:01', '2022-07-21 07:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id_surat` int(11) NOT NULL,
  `id_lembaga` int(11) DEFAULT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `jenis_surat` int(11) DEFAULT NULL,
  `nama_pengirim` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `perihal` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id_surat`, `id_lembaga`, `no_surat`, `tanggal_surat`, `jenis_surat`, `nama_pengirim`, `jabatan`, `file`, `perihal`, `created_at`, `updated_at`) VALUES
(1, 2, 'SDE/XXI/012/SE', '2022-07-21', 0, 'gozali', 'ketua', 'cc.pdf', 'dana masjid', '2022-07-21 08:58:17', NULL);

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
  `id_lembaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `fullname`, `username`, `password`, `status`, `id_lembaga`) VALUES
(1, 'atik medixa', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 1),
(2, 'ahmad', 'bem_kbm', 'a008e730692c5b56719645acad8db899', 1, 2);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id_proposal`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  MODIFY `id_laporan_keg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lembaga`
--
ALTER TABLE `lembaga`
  MODIFY `id_lembaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id_proposal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
