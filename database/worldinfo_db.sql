-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2026 pada 13.23
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `worldinfo_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_settings`
--

CREATE TABLE `api_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_api` varchar(100) NOT NULL,
  `base_url` text NOT NULL,
  `method` varchar(10) NOT NULL DEFAULT 'GET',
  `api_key` text DEFAULT NULL,
  `auth_header` varchar(100) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `last_sync` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `api_settings`
--

INSERT INTO `api_settings` (`id`, `nama_api`, `base_url`, `method`, `api_key`, `auth_header`, `status`, `last_sync`, `created_at`, `updated_at`) VALUES
(2, 'NEGARA', 'https://restcountries.com/v3.1/all?fields=name,flags,capital,region,subregion,population,cca3', 'GET', NULL, NULL, 'Aktif', NULL, '2026-06-09 16:29:58', '2026-06-10 11:02:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorite_countries`
--

CREATE TABLE `favorite_countries` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_negara` varchar(100) NOT NULL,
  `official_name` varchar(150) DEFAULT NULL,
  `flag` text DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `subregion` varchar(100) DEFAULT NULL,
  `capital` varchar(100) DEFAULT NULL,
  `population` bigint(20) UNSIGNED DEFAULT NULL,
  `languages` text DEFAULT NULL,
  `currencies` text DEFAULT NULL,
  `timezones` text DEFAULT NULL,
  `maps_url` text DEFAULT NULL,
  `status_wishlist` varchar(50) NOT NULL DEFAULT 'Wishlist',
  `catatan` text DEFAULT NULL,
  `tanggal_ditambahkan` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `managed_countries`
--

CREATE TABLE `managed_countries` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `official_name` varchar(150) DEFAULT NULL,
  `code` varchar(3) DEFAULT NULL,
  `flag_url` text DEFAULT NULL,
  `capital` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `subregion` varchar(100) DEFAULT NULL,
  `population` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `languages` text DEFAULT NULL,
  `currencies` text DEFAULT NULL,
  `timezones` text DEFAULT NULL,
  `maps_url` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@worldinfo.test', '$2y$10$kl2HaQxnTb7meROmONeRQeUra8a9yoeV/B1iMYCZC92AEIznidpm.', 'admin', '2026-06-09 23:22:16', '2026-06-09 23:22:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `api_settings`
--
ALTER TABLE `api_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `favorite_countries`
--
ALTER TABLE `favorite_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `managed_countries`
--
ALTER TABLE `managed_countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `managed_countries_name_unique` (`name`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `api_settings`
--
ALTER TABLE `api_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `favorite_countries`
--
ALTER TABLE `favorite_countries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `managed_countries`
--
ALTER TABLE `managed_countries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
