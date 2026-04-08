-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2026 at 08:33 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_siswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id_aspirasi` bigint UNSIGNED NOT NULL,
  `nis` bigint UNSIGNED NOT NULL,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `lokasi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Menunggu','Proses','Selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu',
  `feedback` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aspirasi`
--

INSERT INTO `aspirasi` (`id_aspirasi`, `nis`, `id_kategori`, `lokasi`, `ket`, `foto`, `status`, `feedback`, `created_at`, `updated_at`) VALUES
(8, 5, 1, 'XII LPKC 2', 'papan tulis tidak dihapus', 'pengaduan/DX9wSuwYqZE3B8RpBieMIpHCJIOfJwwEs53KIRKH.jpg', 'Proses', 'mohon kamu menyuruh petugas piket', '2026-04-08 03:59:48', '2026-04-08 04:12:58'),
(10, 6, 1, 'xii 2', 'SUHAB', 'pengaduan/9XbaebJyBlKi7odHga3i1i8Czs9ZwChslBojQXMl.jpg', 'Selesai', 'telah kami selesaikan mohon di cek', '2026-04-08 04:03:18', '2026-04-08 04:12:09'),
(12, 7, 2, 'XII LPKC 2', 'toilet kotor', 'pengaduan/5czR38M4FGsNLWM78t6SD5qUMyGLTmhLkaqr4qvj.jpg', 'Menunggu', NULL, '2026-04-08 04:32:10', '2026-04-08 04:32:10'),
(13, 6, 1, 'XII LPKC 2', 'kursinya rusak', 'pengaduan/NuRqYsrfWbzaGXXQerqDfcZkr859ImRneR8Ih4su.jpg', 'Proses', 'baiklah', '2026-04-08 06:25:58', '2026-04-08 06:26:29'),
(14, 8, 3, 'XII TKR 2', 'nyobak', 'pengaduan/wyMmyK0rATFC5aEbEdN9cDqJ8S7pfJ1AGLTX9AFj.jpg', 'Selesai', 'sudah selesai', '2026-04-08 06:27:58', '2026-04-08 06:29:16'),
(15, 9, 2, 'XII RPL 2', 'didepan toilet banyk sampah', 'pengaduan/m2070Y9hC76ZuG5QnxfU5Zfxu2MKEpwJ6JVoEX0c.jpg', 'Selesai', 'sudah selesai, mohon di cek.', '2026-04-08 07:01:51', '2026-04-08 07:41:32'),
(16, 10, 3, 'XII RPL 2', 'lampu di ruangan rpl 2 redup, kurang cahaya', 'pengaduan/jCqVNjjZ61oFlmJJHUD71ltTlUiQ6NRPUbkZq6GK.jpg', 'Proses', 'baik akan segera kami tindak lanjuti', '2026-04-08 07:21:48', '2026-04-08 07:30:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD KEY `aspirasi_nis_foreign` (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id_aspirasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD CONSTRAINT `aspirasi_nis_foreign` FOREIGN KEY (`nis`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
