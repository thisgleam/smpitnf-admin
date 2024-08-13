-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 05:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smpitnf`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `email`, `username`, `password`, `level`, `created`) VALUES
(6, 'gleam', 'thisgleam@gmail.com', 'aa', '$2y$10$8gXZiU135N33wQoFfu/hT.8eNgYHUyS7CCe6FPz41QR/lkrNF/cIy', '1', '2024-08-12 12:27:00'),
(10, 's', 'thisgleam@gmail.com1', 'b', '$2y$10$xfGCu8sZfgigJmmTlywQfOLdAaKSJJYcmz1372yE7C9ygHJDPVxlO', '1', '2024-08-13 14:08:37'),
(11, 'g', 'thisgleam@gmail.com', 'g', '$2y$10$Z/GV38YKDAZssZaJNjR8Ke6CCoOJ1mNzDJvFTW6lFwF9/crC7SS12', '1', '2024-08-13 14:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `data_dokumen`
--

CREATE TABLE `data_dokumen` (
  `id` int(11) NOT NULL,
  `jenis_dok` varchar(50) NOT NULL,
  `ruang` varchar(25) NOT NULL,
  `lemari` varchar(25) NOT NULL,
  `rak` varchar(25) NOT NULL,
  `box` varchar(25) NOT NULL,
  `map` varchar(25) NOT NULL,
  `urut` varchar(25) NOT NULL,
  `no_dok` varchar(50) NOT NULL,
  `nama_dok` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(11) NOT NULL,
  `tanggal_dok` varchar(11) NOT NULL,
  `tanggal_upload` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_dokumen`
--

INSERT INTO `data_dokumen` (`id`, `jenis_dok`, `ruang`, `lemari`, `rak`, `box`, `map`, `urut`, `no_dok`, `nama_dok`, `tahun_ajaran`, `tanggal_dok`, `tanggal_upload`, `tanggal_diubah`) VALUES
(20, 'Surat', 'B12', 'lemari_tes2', 'rak_tes', 'box_tes', 'map_tes', 'urut_tes', '1111', 'KL', '1981/0981', '28-09-2009', '2024-08-04 13:59:09', '2024-08-06 01:48:59'),
(23, '1', 'B66', 'lemari_tes', 'rak_tes', 'box_tes', 'map_tes', 'urut_tes', '1', '1', '1', '1', '2024-08-06 02:11:19', '2024-08-06 02:11:19'),
(24, 'ba', 'ba', 'ba', 'ba', 'ba', 'ba', 'ba', '42', 'ba', 'ba', 'ba', '2024-08-07 03:32:32', '2024-08-07 03:33:02'),
(25, 'ijazah', 'b', 'n', 'n', 'nm', 'm', 'l', '11', 'Surat', '2024/2025', '19-07-2024', '2024-08-07 05:55:57', '2024-08-07 05:55:57'),
(28, 'n', 'n', 'n', 'n', 'n', 'n', 'n', '7', 'm', 'm', 'm', '2024-08-13 05:38:08', '2024-08-13 05:38:08'),
(29, 'n', 'n', 'n', 'n', 'n', 'n', 'n', '7', 'm', 'm', 'm', '2024-08-13 05:38:19', '2024-08-13 05:38:19'),
(30, 'n', 'n', 'n', 'n', 'n', 'n', 'n', '7', 'm', 'm', 'm', '2024-08-13 05:38:21', '2024-08-13 05:38:21'),
(31, 'm', 'm', 'm', 'm', 'm', 'm', 'm', '8', 'm', 'm', 'm', '2024-08-13 05:41:49', '2024-08-13 05:41:49'),
(32, 'x', 'x', 'x', 'x', 'x', 'x', 'x', '1', 'x', 'x', 'x', '2024-08-13 05:43:16', '2024-08-13 05:43:16'),
(38, 'j', 'j', 'j', 'j', 'j', 'j', 'j', '41', 'j', 'j', 'j', '2024-08-13 07:52:24', '2024-08-13 09:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `data_materi`
--

CREATE TABLE `data_materi` (
  `id_materi` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `mata_pelajaran` varchar(50) DEFAULT NULL,
  `link_materi` varchar(255) DEFAULT NULL,
  `tipe_file` varchar(20) DEFAULT NULL,
  `tanggal_upload` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_diubah` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_materi`
--

INSERT INTO `data_materi` (`id_materi`, `judul`, `deskripsi`, `mata_pelajaran`, `link_materi`, `tipe_file`, `tanggal_upload`, `tanggal_diubah`) VALUES
(7, 'TABEL PROBABILITAS', 'TABEL', 'PROBSTAT', 'PROBSTAT', 'PDF', '2024-08-04 11:06:25', '2024-08-05 07:57:47'),
(8, 'TABEL PROBABILITASa', 'WAWASAN', 'APA AJA', 'https://app.getgrass.io/dashboard', 'WEB', '2024-08-05 08:46:10', '2024-08-05 08:46:10'),
(11, 'JUDUL', 'DESKRIPSI', 'MAPEL', 'https://chatgpt.com/', 'WEB', '2024-08-06 01:42:07', '2024-08-06 01:42:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `level` varchar(2) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `nama`, `level`, `ip_address`, `login_time`) VALUES
(1, 'gleam', '1', '::1', '2024-08-13 07:54:58'),
(2, 'gleam', '1', '::1', '2024-08-13 07:59:10'),
(3, 'gleam', '1', '::1', '2024-08-13 08:03:44'),
(4, 'gleam', '2', '::1', '2024-08-13 08:15:05'),
(5, 'gleam', '2', '::1', '2024-08-13 08:15:30'),
(6, 'gleam', '1', '::1', '0000-00-00 00:00:00'),
(7, 'gleam', '1', '::1', '0000-00-00 00:00:00'),
(8, 'gleam', '1', '::1', '0000-00-00 00:00:00'),
(9, 'gleam', '1', '::1', '0000-00-00 00:00:00'),
(10, 'gleam', '1', '::1', '2024-08-13 08:22:24'),
(11, 'gleam', '2', '::1', '2024-08-13 08:23:58'),
(12, 'gleam', '1', '::1', '2024-08-13 08:24:12'),
(13, 'gleam', '1', '::1', '2024-08-13 09:46:30'),
(14, 'gleam', '1', '::1', '2024-08-13 09:49:59'),
(15, 'gleam', '1', '::1', '2024-08-13 09:50:48'),
(16, 'gleam', '1', '::1', '2024-08-13 09:51:46'),
(17, 'gleam', '1', '::1', '2024-08-13 09:59:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `data_dokumen`
--
ALTER TABLE `data_dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruang` (`ruang`) USING BTREE,
  ADD KEY `lemari` (`lemari`,`rak`,`box`,`map`,`urut`);

--
-- Indexes for table `data_materi`
--
ALTER TABLE `data_materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `data_dokumen`
--
ALTER TABLE `data_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `data_materi`
--
ALTER TABLE `data_materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
