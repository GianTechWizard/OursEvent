-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2025 at 02:33 AM
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
-- Database: `oursevents`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_event` int(11) NOT NULL,
  `judul_event` varchar(150) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `pembicara` varchar(150) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `kuota` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `poster` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_event`, `judul_event`, `id_kategori`, `pembicara`, `tanggal`, `jam`, `lokasi`, `deskripsi`, `kuota`, `harga`, `poster`) VALUES
(1, 'Seminar Nasional Pendidikan 2025', 1, 'Dr. Andi Wijaya', '2025-08-12', '09:00:00', 'Aula Universitas ABC', 'Seminar nasional mengenai perkembangan pendidikan di Indonesia.', 200, 50000, 'poster-seminar2025.jpg'),
(2, 'Research Camp 2025 KSEI Kesyala x Fossei Banten', 3, 'Zidni Fiqhan M.Pd., M.Sy , Heni Latifah W S, S.Ag & Ahmad Muhlisin,S.Pd ', '2025-04-05', '08:00:00', 'Zoom Meeting', 'Webinar mengenai informasi Karya Tulis Ilmiah, Business Plan & Sharia Policy case Study', 200, 50000, 'poster-Webinar-ResearchCamp2025.jpg'),
(3, 'Seminar Pendidikan Nasional 2025', 1, 'Bina Danny Ramdhan Gani, S.E., M.H. & Dr. H. Purwanto, S.Pd, M.Pd.', '2025-05-10', '07:00:00', 'Gedung Achmad Sanusi', 'Seminar Nasional yang membahas bagaimana proses transformasi  SDM berbasis karakter & etika memiliki pengaruh penting di tengah arus kebijakan', 200, 50000, 'poster-seminar-SeminarNasional2025.jpg'),
(4, 'Forum  Akademisi dan Dosen  Peneliti (FAST) Seminar Nasional', 1, 'Prof. M. Faris Al Fadhat , M.A., Ph.D', '0000-00-00', '09:00:00', 'Via Zoom', 'Poster ini menginformasikan seminar nasional gratis bertajuk \"Strategi Sukses Jabatan Fungsional\" yang diadakan via Zoom pada 17 Mei 2025 oleh Forum Akademisi dan Dosen Peneliti (FAST). Menghadirkan tiga narasumber ahli dan memberikan e-sertifikat.', 200, 50000, 'poster-seminar-SeminarNasonal.jpg'),
(5, 'Workshop Digital Content Creator', 2, 'Fatur Rohman, S.I.Kom', '2025-11-05', '09:00:00', 'Ruang Audio SMP Islam Brawijaya', 'Poster ini menginformasikan workshop \"Digital Content Creator\" untuk siswa SMP Islam Brawijaya Mojokerto pada 10-11 Mei 2025. Peserta akan belajar membuat konten dengan cara asik, mendapat kaos, konsumsi, dan e-sertifikat. Kuota terbatas untuk 35 peserta.', 200, 50000, 'poster-workshop-WorkshopDigital2025.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_event`
--

CREATE TABLE `kategori_event` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_event`
--

INSERT INTO `kategori_event` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Seminar'),
(2, 'Workshop'),
(3, 'Webinar');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_event`
--

CREATE TABLE `pendaftaran_event` (
  `id_daftar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `status` enum('Pending','Paid','Cancel') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran_event`
--

INSERT INTO `pendaftaran_event` (`id_daftar`, `id_user`, `id_event`, `jumlah_tiket`, `total_biaya`, `status`) VALUES
(1, 2, 1, 1, 50000, 'Pending'),
(2, 3, 1, 2, 100000, 'Paid'),
(3, 3, 1, 1, 50000, 'Cancel'),
(9, 17, 2, 1, 50000, ''),
(10, 17, 4, 1, 50000, ''),
(11, 17, 4, 1, 50000, ''),
(12, 17, 5, 1, 50000, ''),
(13, 17, 5, 1, 50000, ''),
(14, 17, 5, 1, 50000, ''),
(15, 17, 3, 1, 50000, ''),
(16, 17, 1, 1, 50000, ''),
(17, 17, 2, 1, 50000, ''),
(18, 17, 1, 1, 50000, ''),
(19, 17, 3, 1, 50000, ''),
(20, 17, 5, 1, 50000, ''),
(21, 17, 1, 1, 50000, ''),
(22, 17, 3, 1, 50000, ''),
(23, 17, 3, 1, 50000, ''),
(24, 17, 5, 1, 50000, ''),
(25, 17, 2, 1, 50000, ''),
(26, 17, 2, 1, 50000, ''),
(27, 17, 3, 1, 50000, ''),
(28, 17, 2, 1, 50000, ''),
(29, 17, 2, 1, 50000, ''),
(30, 17, 5, 1, 50000, ''),
(31, 17, 2, 1, 50000, ''),
(32, 17, 5, 1, 50000, ''),
(33, 17, 2, 1, 50000, ''),
(34, 17, 3, 1, 50000, ''),
(35, 17, 1, 1, 50000, ''),
(36, 17, 3, 1, 50000, ''),
(37, 17, 3, 1, 50000, ''),
(38, 17, 5, 1, 50000, ''),
(39, 17, 4, 1, 50000, ''),
(40, 17, 3, 1, 50000, ''),
(41, 17, 4, 1, 50000, ''),
(42, 17, 4, 1, 50000, ''),
(43, 17, 1, 1, 50000, ''),
(44, 17, 4, 1, 50000, ''),
(45, 18, 2, 1, 50000, ''),
(46, 18, 2, 1, 50000, ''),
(47, 18, 5, 1, 50000, ''),
(48, 18, 2, 1, 50000, ''),
(54, 21, 1, 1, 50000, ''),
(55, 21, 1, 1, 50000, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `institusi` varchar(100) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `no_hp`, `institusi`, `role`, `created_at`) VALUES
(1, 'Admin Utama', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '08123456789', NULL, 'admin', '2025-11-25 16:56:11'),
(2, 'Gigi', 'gigi@example.com', 'Gigi1234', '081234111111', NULL, 'user', '2025-11-26 15:32:21'),
(3, 'Budi Santoso', 'budi@example.com', '9c5fa085ce256c7c598f6710584ab25d', '081233333333', NULL, 'user', '2025-11-26 15:32:21'),
(4, '', 'gi@gmail.com', '', '01234567890', 'UAJY', '', '2025-12-03 10:04:54'),
(5, '', 'er@gmail.com', '', '123456789', 'Atma', '', '2025-12-04 21:04:32'),
(10, 'GianLageeee', 'bu@gmail.com', '$2y$10$IenK37pFWVxuzXiTAPrNdeofDFm4gBOT9hftinM.0s1JgNJPBR6VS', '01234567890', 'AtmaJoyo', '', '2025-12-04 21:42:28'),
(11, 'uhuy', 'bebebe@gmail.com', '$2y$10$1E1kerFDrdn84G95q/XnmOyYZuOMszDO3T/qC5vQb52BogrYErUnW', '01234567890', 'AtmaJoyoe', '', '2025-12-04 21:48:14'),
(12, 'heheh', 'h@gmail.com', '$2y$10$kU29qpqWPJdQR1f1fx45lugHPQq0yhmSYtq23wVvn3LuAuIZcGNsy', '123456789098', 'JY', '', '2025-12-04 22:44:25'),
(13, 'GIANT', 'NTT@gmail.com', '$2y$10$dirZ2FJV8ThEYCYieV8.ouxg22LNk3n6VtxpDOd8D156joc5wTdNm', '33', 'JAYAJAYA', '', '2025-12-05 15:17:53'),
(14, 'akuaku', 'awok@gmail.com', '$2y$10$RQKs9RR3aWi99Al/jcG/OeeXAdNd62iAWpuFtiwNK8puMaaUBw/M.', '123456789876543', 'eyeye', '', '2025-12-05 15:22:16'),
(16, 'koko', 'wewu@gmail.com', '$2y$10$S.1pcPYUp/LBSOwkSoNXFu.KBNIvSE1Ap.VLCViyTs.ZNTLi6b3M.', '09876543', 'wewe', '', '2025-12-05 18:15:06'),
(17, 'baru', 'rabu@gmail.com', '$2y$10$zRervS.OEM0xo.akDysvKOXoempBpgRYvar77N1SvyiOjgUYW/2oS', '12345678989', 'JAYAJEYE', '', '2025-12-08 01:00:07'),
(18, 'DEMOdemo', 'Dadu@example.com', '$2y$10$RHrsXExSyt83Tj3UijfNhuGr1wJQD6e22jeHW70QWNonnDvVMw99q', '0987654321', 'ATMAJAYAJOGJAaa', '', '2025-12-08 19:12:01'),
(21, 'venin', 'de@gmail.com', '$2y$10$icckgwqPkFm0I1cRItDdSel3kDX2ib75PsK8DHtECYFHAAhceYrQu', '12345678910111111', 'jooyo', '', '2025-12-09 07:16:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori_event`
--
ALTER TABLE `kategori_event`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pendaftaran_event`
--
ALTER TABLE `pendaftaran_event`
  ADD PRIMARY KEY (`id_daftar`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_event`
--
ALTER TABLE `kategori_event`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pendaftaran_event`
--
ALTER TABLE `pendaftaran_event`
  MODIFY `id_daftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_event` (`id_kategori`);

--
-- Constraints for table `pendaftaran_event`
--
ALTER TABLE `pendaftaran_event`
  ADD CONSTRAINT `pendaftaran_event_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `pendaftaran_event_ibfk_2` FOREIGN KEY (`id_event`) REFERENCES `events` (`id_event`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
