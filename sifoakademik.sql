-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 04:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sifoakademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `siswa_nisn` varchar(20) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('hadir','izin','alpha') NOT NULL DEFAULT 'alpha'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `siswa_nisn`, `kelas_id`, `tanggal`, `status`) VALUES
(12, '0123456789', 23, '2024-12-23', 'hadir'),
(13, '1122334456', 23, '2024-12-23', 'hadir'),
(14, '1234567890', 23, '2024-12-23', 'hadir'),
(15, '2345678901', 23, '2024-12-23', 'hadir'),
(16, '3456789012', 23, '2024-12-23', 'hadir'),
(17, '4567890123', 23, '2024-12-23', 'hadir'),
(18, '5678901234', 23, '2024-12-23', 'hadir'),
(19, '6789012345', 23, '2024-12-23', 'hadir'),
(20, '7890123456', 23, '2024-12-23', 'hadir'),
(21, '8901234567', 23, '2024-12-23', 'hadir');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `jabatan`, `telepon`) VALUES
(1, 'erna123', '123456', 'Ernawati Sukamulia', 'Guru Biologi', '082119278222'),
(2, 'edo123', '123456', 'Edo Prasetia', 'Guru Kimia', '081234567890'),
(3, 'budi456', '123456', 'Budi Setiawan', 'Guru Matematika', '081234567891'),
(4, 'citra789', '123456', 'Citra Dewi', 'Guru Fisika', '081234567892'),
(5, 'dani1011', '123456', 'Dani Rahman', 'Guru Biologi', '081234567893'),
(6, 'eka1213', '123456', 'Eka Putri', 'Guru Bahasa Indonesia', '081234567894'),
(7, 'faisal1415', '123456', 'Faisal Maulana', 'Guru Bahasa Inggris', '081234567895'),
(8, 'gina1617', '123456', 'Gina Sari', 'Guru Sejarah', '081234567896'),
(9, 'hendra1819', '123456', 'Hendra Santoso', 'Guru Ekonomi', '081234567897'),
(10, 'indah2021', '123456', 'Indah Pramesti', 'Guru Geografi', '081234567898'),
(11, 'joko2223', '123456', 'Joko Susanto', 'Guru Pendidikan Pancasila', '081234567899');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `jurusan` enum('MIPA','IPS') NOT NULL,
  `tingkat` enum('X','XI','XII') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `jurusan`, `tingkat`) VALUES
(23, '1', 'MIPA', 'X'),
(24, '2', 'MIPA', 'X'),
(25, '3', 'MIPA', 'X'),
(26, '1', 'IPS', 'X'),
(27, '2', 'IPS', 'X'),
(28, '3', 'IPS', 'X'),
(29, '1', 'MIPA', 'XI'),
(30, '2', 'MIPA', 'XI'),
(31, '3', 'MIPA', 'XI'),
(32, '1', 'IPS', 'XI'),
(33, '2', 'IPS', 'XI'),
(34, '3', 'IPS', 'XI'),
(35, '1', 'MIPA', 'XII'),
(36, '2', 'MIPA', 'XII'),
(37, '3', 'MIPA', 'XII'),
(38, '1', 'IPS', 'XII'),
(39, '2', 'IPS', 'XII'),
(40, '3', 'IPS', 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_mata_pelajaran`
--

CREATE TABLE `kelas_mata_pelajaran` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `mata_pelajaran_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kepsek`
--

CREATE TABLE `kepsek` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kepsek`
--

INSERT INTO `kepsek` (`id`, `username`, `password`) VALUES
(1, 'Daniel123', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mata_pelajaran` int(11) NOT NULL,
  `nama_mata_pelajaran` varchar(100) NOT NULL,
  `tingkat` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mata_pelajaran`, `nama_mata_pelajaran`, `tingkat`) VALUES
(61, 'Pendidikan Agama dan Budi Pekerti', 'X'),
(62, 'Pendidikan Pancasila dan Kewarganegaraan', 'X'),
(63, 'Bahasa Indonesia', 'X'),
(64, 'Matematika', 'X'),
(65, 'Sejarah Indonesia', 'X'),
(66, 'Bahasa Inggris', 'X'),
(67, 'Seni Budaya', 'X'),
(68, 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'X'),
(69, 'Informatika', 'X'),
(70, 'Fisika', 'X'),
(71, 'Kimia', 'X'),
(72, 'Biologi', 'X'),
(73, 'Geografi', 'X'),
(74, 'Ekonomi', 'X'),
(75, 'Sosiologi', 'X'),
(76, 'Pendidikan Agama dan Budi Pekerti', 'XI'),
(77, 'Pendidikan Pancasila dan Kewarganegaraan', 'XI'),
(78, 'Bahasa Indonesia', 'XI'),
(79, 'Matematika', 'XI'),
(80, 'Sejarah Indonesia', 'XI'),
(81, 'Bahasa Inggris', 'XI'),
(82, 'Seni Budaya', 'XI'),
(83, 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'XI'),
(84, 'Fisika', 'XI'),
(85, 'Kimia', 'XI'),
(86, 'Biologi', 'XI'),
(87, 'Geografi', 'XI'),
(88, 'Ekonomi', 'XI'),
(89, 'Sosiologi', 'XI'),
(90, 'Pendidikan Agama dan Budi Pekerti', 'XII'),
(91, 'Pendidikan Pancasila dan Kewarganegaraan', 'XII'),
(92, 'Bahasa Indonesia', 'XII'),
(93, 'Matematika', 'XII'),
(94, 'Bahasa Inggris', 'XII'),
(95, 'Seni Budaya', 'XII'),
(96, 'Pendidikan Jasmani, Olahraga, dan Kesehatan', 'XII'),
(97, 'Fisika', 'XII'),
(98, 'Kimia', 'XII'),
(99, 'Biologi', 'XII'),
(100, 'Geografi', 'XII'),
(101, 'Ekonomi', 'XII'),
(102, 'Sosiologi', 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `siswa_nisn` varchar(20) NOT NULL,
  `bukti_transfer` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `siswa_nisn`, `bukti_transfer`, `status`, `created_at`) VALUES
(12, '1122334456', 'butki_pembayaran_spp.jpg', 'approved', '2024-12-23 14:23:59');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `angkatan` year(4) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama`, `angkatan`, `kelas_id`, `password`) VALUES
('0123456789', 'Joko Susanto', '2024', 23, ''),
('1122334456', 'Daniel Prasetio Budiman', '2024', 23, '123456'),
('1234567890', 'Andi Prasetyo', '2024', 23, ''),
('2345678901', 'Budi Setiawan', '2024', 23, ''),
('3456789012', 'Citra Dewi', '2024', 23, ''),
('4567890123', 'Dani Rahman', '2024', 23, ''),
('5678901234', 'Eka Putri', '2024', 23, ''),
('6789012345', 'Faisal Maulana', '2024', 23, ''),
('7890123456', 'Gina Sari', '2024', 23, ''),
('8901234567', 'Hendra Santoso', '2024', 23, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_nisn` (`siswa_nisn`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_mata_pelajaran`
--
ALTER TABLE `kelas_mata_pelajaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id` (`kelas_id`),
  ADD KEY `mata_pelajaran_id` (`mata_pelajaran_id`);

--
-- Indexes for table `kepsek`
--
ALTER TABLE `kepsek`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mata_pelajaran`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_nisn` (`siswa_nisn`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `kelas_mata_pelajaran`
--
ALTER TABLE `kelas_mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kepsek`
--
ALTER TABLE `kepsek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_mata_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_kelas_fk` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_siswa_fk` FOREIGN KEY (`siswa_nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE;

--
-- Constraints for table `kelas_mata_pelajaran`
--
ALTER TABLE `kelas_mata_pelajaran`
  ADD CONSTRAINT `kelas_mata_pelajaran_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_mata_pelajaran_ibfk_2` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajaran` (`id_mata_pelajaran`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`siswa_nisn`) REFERENCES `siswa` (`nisn`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
