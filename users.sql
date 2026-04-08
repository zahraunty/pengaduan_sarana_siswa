-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2026 at 08:05 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','siswa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nis`, `kelas`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'zahra aninda aviva', '090220252703', 'XII RPL 2', NULL, NULL, '$2y$12$v8NXvOHtEFZpOE0JcHmAo.n9DcE7uawmcYPAivx7JKQjuT3dMBuC6', 'siswa', NULL, '2026-04-07 20:03:21', '2026-04-07 20:03:21'),
(2, 'zahra aninda aviva', 'admin@gmail.com', '0', 'admin@gmail.com', NULL, '$2y$12$7LdzXYFB97RpD6Kd7j8LQuF4GRbZFDQeJzFwEv860DZZe7i5H4Yha', 'admin', NULL, '2026-04-07 20:05:17', '2026-04-07 20:05:17'),
(3, 'zahra aninda aviva', 'admin2@gmail.com', 'rpl', 'admin2@gmail.com', NULL, '$2y$12$DJ5vNfayrYot7XvU89Rc9.KI20MGgDIo49yJC8p4Ed4PekAHOgHjm', 'admin', NULL, '2026-04-07 20:09:17', '2026-04-07 20:09:17'),
(4, 'jahra', '090220', 'XII RPL 2', NULL, NULL, '$2y$12$gk7jiyFF55LazFGELZIbzucJRDSNXAnHmcR3M4GGGUVgxJLj/U/wO', 'siswa', NULL, '2026-04-07 20:40:44', '2026-04-07 20:40:44'),
(5, 'zahra aviva', '12345678', 'XII RPL 2', NULL, NULL, '$2y$12$gOIIxVDh3/r8pI46RsL9ce4iH.PSLDBQIWKzewDPWcN.7KltkxhTa', 'siswa', NULL, '2026-04-07 20:45:42', '2026-04-07 20:45:42'),
(6, 'Syafira Oktavian', '09876556789', 'XII TKJ 2', NULL, NULL, '$2y$12$lJpXdylQHEtKwx9qB/EfEO/y0W.n4woVyZX5Yn4Mt/GWAmPedNocS', 'siswa', NULL, '2026-04-08 04:02:09', '2026-04-08 04:02:09'),
(7, 'tiara', '45678987654456', 'XII LPKC 2', NULL, NULL, '$2y$12$GguMYcUb0CYlOq1C.5m4yuVIclwjmL4gcbD85Btx7CuvO5lTG4Vby', 'siswa', NULL, '2026-04-08 04:30:57', '2026-04-08 04:30:57'),
(8, 'aninda', '567876543456', 'XII TKR 1', NULL, NULL, '$2y$12$AOe5uqCJ1Nzsv9UCjitg/uUcAsGqcYf/TUMPXDakDziRiAhVzCuI6', 'siswa', NULL, '2026-04-08 06:27:28', '2026-04-08 06:27:28'),
(9, 'zahra aninda apipah', '345676543234', 'XII RPL 2', NULL, NULL, '$2y$12$7Xr2hhNZpCssboT.ES0JAuiYnQXHoSlSZVLuOSGt3rtk8O.JeHrem', 'siswa', NULL, '2026-04-08 07:01:21', '2026-04-08 07:01:21'),
(10, 'zahra aninda apipah', '4567765432345', 'XII RPL 2', NULL, NULL, '$2y$12$/gtSzBjPI/UtNFMYLd6bvO27aUxWgVHNLZ52P/XX2qERSr4vOsIYC', 'siswa', NULL, '2026-04-08 07:16:11', '2026-04-08 07:16:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nis_unique` (`nis`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
