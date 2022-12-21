-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 21 Des 2022 pada 07.46
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apl_absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_provinsis`
--

-- CREATE TABLE `ref_provinsis` (
--   `id` bigint(20) UNSIGNED NOT NULL,
--   `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ref_provinsis`
--

INSERT INTO `ref_provinsis` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(11, 'ACEH', NULL, NULL),
(12, 'SUMATERA UTARA', NULL, NULL),
(13, 'SUMATERA BARAT', NULL, NULL),
(14, 'RIAU', NULL, NULL),
(15, 'JAMBI', NULL, NULL),
(16, 'SUMATERA SELATAN', NULL, NULL),
(17, 'BENGKULU', NULL, NULL),
(18, 'LAMPUNG', NULL, NULL),
(19, 'KEPULAUAN BANGKA BELITUNG', NULL, NULL),
(21, 'KEPULAUAN RIAU', NULL, NULL),
(31, 'DKI JAKARTA', NULL, NULL),
(32, 'JAWA BARAT', NULL, NULL),
(33, 'JAWA TENGAH', NULL, NULL),
(34, 'DAERAH ISTIMEWA YOGYAKARTA', NULL, NULL),
(35, 'JAWA TIMUR', NULL, NULL),
(36, 'BANTEN', NULL, NULL),
(51, 'BALI', NULL, NULL),
(52, 'NUSA TENGGARA BARAT', NULL, NULL),
(53, 'NUSA TENGGARA TIMUR', NULL, NULL),
(61, 'KALIMANTAN BARAT', NULL, NULL),
(62, 'KALIMANTAN TENGAH', NULL, NULL),
(63, 'KALIMANTAN SELATAN', NULL, NULL),
(64, 'KALIMANTAN TIMUR', NULL, NULL),
(65, 'KALIMANTAN UTARA', NULL, NULL),
(71, 'SULAWESI UTARA', NULL, NULL),
(72, 'SULAWESI TENGAH', NULL, NULL),
(73, 'SULAWESI SELATAN', NULL, NULL),
(74, 'SULAWESI TENGGARA', NULL, NULL),
(75, 'GORONTALO', NULL, NULL),
(76, 'SULAWESI BARAT', NULL, NULL),
(81, 'MALUKU', NULL, NULL),
(82, 'MALUKU UTARA', NULL, NULL),
(91, 'P A P U A', NULL, NULL),
(92, 'PAPUA BARAT', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ref_provinsis`
--
ALTER TABLE `ref_provinsis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ref_provinsis`
--
ALTER TABLE `ref_provinsis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
