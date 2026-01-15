-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jan 2026 pada 14.22
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
-- Database: `absensi_sma`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT curdate(),
  `jam_masuk` time NOT NULL DEFAULT curtime(),
  `status` enum('Hadir','Izin','Sakit') DEFAULT 'Hadir',
  `keterangan` enum('Hadir','Sakit','Izin','Alpa') DEFAULT 'Hadir',
  `bukti_foto` varchar(255) DEFAULT NULL,
  `status_validasi` enum('Pending','Disetujui','Ditolak') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `user_id`, `tanggal`, `jam_masuk`, `status`, `keterangan`, `bukti_foto`, `status_validasi`) VALUES
(1, 8, '2026-01-11', '22:01:21', 'Hadir', NULL, NULL, 'Pending'),
(2, 9, '2026-01-11', '22:02:05', 'Hadir', NULL, NULL, 'Ditolak'),
(4, 11, '2026-01-11', '22:27:05', 'Sakit', NULL, NULL, 'Disetujui'),
(5, 8, '2026-01-12', '00:50:22', 'Hadir', NULL, NULL, 'Pending'),
(6, 13, '2026-01-13', '17:52:59', 'Hadir', NULL, NULL, 'Pending'),
(7, 13, '2026-01-13', '18:01:42', 'Hadir', NULL, NULL, 'Pending'),
(8, 13, '2026-01-13', '18:05:51', 'Hadir', NULL, NULL, 'Pending'),
(9, 14, '2026-01-13', '18:13:13', 'Hadir', NULL, NULL, 'Disetujui'),
(11, 8, '2026-01-13', '18:15:14', 'Hadir', NULL, NULL, 'Pending'),
(12, 14, '2026-01-13', '18:16:33', 'Hadir', NULL, NULL, 'Pending'),
(13, 8, '2026-01-13', '18:22:49', 'Hadir', NULL, NULL, 'Pending'),
(14, 8, '2026-01-13', '18:30:34', 'Hadir', NULL, NULL, 'Pending'),
(15, 8, '2026-01-14', '11:25:29', 'Hadir', NULL, NULL, 'Ditolak'),
(16, 8, '2026-01-14', '12:15:07', 'Hadir', 'Hadir', 'BUKTI_8_1768367707.png', 'Disetujui'),
(17, 8, '2026-01-14', '12:21:04', 'Hadir', 'Izin', 'BUKTI_8_1768368064.jpg', 'Disetujui'),
(18, 14, '2026-01-14', '12:27:40', 'Hadir', 'Hadir', 'BUKTI_14_1768368460.png', 'Disetujui'),
(19, 9, '2026-01-15', '11:58:37', 'Hadir', 'Hadir', 'BUKTI_1768453117.jpg', 'Disetujui'),
(20, 14, '2026-01-15', '12:15:39', 'Hadir', 'Izin', 'BUKTI_1768454139.jpg', 'Disetujui'),
(21, 12, '2026-01-15', '12:26:18', 'Hadir', 'Hadir', 'BUKTI_1768454778.jpg', 'Pending'),
(22, 13, '2026-01-15', '12:29:16', 'Hadir', 'Sakit', 'BUKTI_1768454956.jpg', 'Disetujui'),
(23, 11, '2026-01-15', '19:49:52', 'Hadir', 'Hadir', 'BUKTI_1768481392.jpg', 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT 'default.png',
  `alamat` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `nama_lengkap`, `nisn`, `kelas`, `foto_profil`, `alamat`, `foto`) VALUES
(1, 8, 'nramlyh', NULL, '12 IPA', 'default.png', NULL, 'user_8_1768145268.jpg'),
(2, 9, 'teyung', NULL, '12 IPA', 'default.png', NULL, 'user_9_1768145247.jpg'),
(4, 11, 'jungkok', NULL, '12 IPS', 'default.png', NULL, 'user_11_1768145217.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','siswa') NOT NULL DEFAULT 'siswa',
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `kelas`, `username`, `password`, `role`, `foto`, `created_at`) VALUES
(1, 'admin1', '12 IPA', 'admin1', 'admin123', 'admin', NULL, '2026-01-11 14:20:35'),
(5, 'admin', '12 IPA', 'admin', 'admin123', 'admin', 'logo.png', '2026-01-11 14:32:07'),
(8, 'amel', '12 IPA', 'amel', '123', 'siswa', 'amel', '2026-01-11 15:01:15'),
(9, 'teyung', '12 IPA', 'teyung', '123', 'siswa', 'teyung', '2026-01-11 15:01:49'),
(11, 'jungkok', '12 IPA', 'jungkok', '123', 'siswa', 'jungkok', '2026-01-11 15:25:07'),
(12, 'ive yu', '12 MIPA', 'ivee', '123', 'siswa', 'ive_yu_1768454750', '2026-01-11 18:13:02'),
(13, 'cincau', '11 MIPA', 'cincau', '123', 'siswa', 'cincau_1768454877', '2026-01-13 10:52:15'),
(14, 'fajarsadboy', '10 IIS', 'fajar', '123', 'siswa', 'fajarsadboy_1768454124', '2026-01-13 11:12:58');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_absensi` (`user_id`);

--
-- Indeks untuk tabel `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `fk_user_profile` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `fk_user_absensi` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
