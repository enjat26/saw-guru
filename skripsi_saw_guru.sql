-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2020 at 11:04 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_saw_guru`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` int(11) NOT NULL,
  `bidang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id_bidang`, `bidang`) VALUES
(1, 'Guru Tetap'),
(2, 'Guru Tidak Tetap');

-- --------------------------------------------------------

--
-- Table structure for table `crips`
--

CREATE TABLE `crips` (
  `id_crips` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `nilai_bobot` double(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crips`
--

INSERT INTO `crips` (`id_crips`, `id_kriteria`, `keterangan`, `nilai_bobot`) VALUES
(1, 1, 'Sangat Baik', 4.00),
(2, 1, 'Baik', 3.00),
(3, 1, 'Kurang Baik', 2.00),
(4, 1, 'Sangat Buruk', 1.00),
(5, 2, 'Sangat Baik', 4.00),
(6, 2, 'Baik', 3.00),
(7, 2, 'Kurang Baik', 2.00),
(8, 2, 'Sangat Buruk', 1.00),
(9, 3, 'Sangat Baik', 4.00),
(10, 3, 'Baik', 3.00),
(11, 3, 'Kurang Baik', 2.00),
(12, 3, 'Sangat Buruk', 1.00),
(13, 4, 'Sangat Baik', 4.00),
(14, 4, 'Baik', 3.00),
(15, 4, 'Kurang Baik', 2.00),
(16, 4, 'Sangat Buruk', 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(255) DEFAULT NULL,
  `jk` varchar(20) DEFAULT NULL,
  `tempat` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_tlp` varchar(255) DEFAULT NULL,
  `bidang` varchar(50) DEFAULT NULL,
  `nilai_guru` double(11,2) DEFAULT 0.00,
  `status_guru` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `jk`, `tempat`, `tgl_lahir`, `alamat`, `no_tlp`, `bidang`, `nilai_guru`, `status_guru`) VALUES
(1, 'Koko', 'Laki-laki', 'Serang', '2020-05-01', 'Serang', '03943049', 'Guru Tetap', 4.00, 'Masuk Klasifikasi'),
(2, 'Dani', 'Laki-laki', 'Serang', '2019-08-20', 'Serang', '032838923', 'Guru Tetap', 3.00, 'Masuk Klasifikasi'),
(3, 'Rizki', 'Laki-laki', 'Serang', '2020-05-18', 'Serang', '0434889', 'Guru Tetap', 2.00, 'Tidak Masuk Klasifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(10) DEFAULT NULL,
  `nama_kriteria` varchar(70) DEFAULT NULL,
  `bobot_kriteria` int(11) DEFAULT NULL,
  `atribut` varchar(20) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot_kriteria`, `atribut`, `kategori`) VALUES
(1, 'KDR001', 'Mengenal Karakteristik Peserta Didik', 4, 'Benefit', 'Padagodik'),
(2, 'KDR002', 'Penguasaan Materi', 4, 'Benefit', 'Profesional'),
(3, 'KDR003', 'Etos Kerja, Tanggung Jawab Menjadi Guru', 4, 'Benefit', 'Kepribadian'),
(4, 'KDR004', 'Bersikap Inkusif, Objektif Dan Tidak Diskriminatif', 4, 'Benefit', 'Sosial');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `kode_penilaian` char(10) DEFAULT NULL,
  `tgl_penilaian` date DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `id_user` int(11) DEFAULT NULL,
  `jml_guru` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `kode_penilaian`, `tgl_penilaian`, `status`, `id_user`, `jml_guru`) VALUES
(11, 'PNL001', '2020-05-07', 0, 4, 0),
(12, 'PNL002', '2020-05-07', 0, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_bidang`
--

CREATE TABLE `penilaian_bidang` (
  `id` int(11) NOT NULL,
  `bidang` varchar(255) DEFAULT NULL,
  `id_penilaian` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `jml_guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian_bidang`
--

INSERT INTO `penilaian_bidang` (`id`, `bidang`, `id_penilaian`, `status`, `jml_guru`) VALUES
(1, 'Guru Tetap', 11, 1, 2),
(2, 'Guru Tetap', 12, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_dt`
--

CREATE TABLE `penilaian_dt` (
  `id` int(11) NOT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `id_penilaian` int(11) NOT NULL DEFAULT 0,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_crips` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian_dt`
--

INSERT INTO `penilaian_dt` (`id`, `id_guru`, `id_penilaian`, `id_kriteria`, `id_crips`, `nilai`) VALUES
(9, 1, 11, 1, 1, 4),
(10, 1, 11, 2, 5, 4),
(11, 1, 11, 3, 10, 3),
(12, 1, 11, 4, 13, 4),
(13, 2, 11, 1, 2, 3),
(14, 2, 11, 2, 6, 3),
(15, 2, 11, 3, 10, 3),
(16, 2, 11, 4, 14, 3),
(17, 3, 11, 1, 3, 2),
(18, 3, 11, 2, 8, 1),
(19, 3, 11, 3, 11, 2),
(20, 3, 11, 4, 15, 2),
(21, 1, 12, 1, 1, 4),
(22, 1, 12, 2, 8, 1),
(23, 1, 12, 3, 10, 3),
(24, 1, 12, 4, 14, 3),
(25, 2, 12, 1, 2, 3),
(26, 2, 12, 2, 7, 2),
(27, 2, 12, 3, 11, 2),
(28, 2, 12, 4, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `username` char(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role`, `email`, `img`) VALUES
(4, 'Admin', 'admin', '$2y$10$41UtNJc5QFJbgLWtqDZm..ziGXPFlKziMHowHFT68PfsCzvuuIfLW', 'Administrator', 'Serang@gmail.com', '5a1111bdc7dbd.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`),
  ADD UNIQUE KEY `bidang` (`bidang`);

--
-- Indexes for table `crips`
--
ALTER TABLE `crips`
  ADD PRIMARY KEY (`id_crips`),
  ADD KEY `fk_kriteria` (`id_kriteria`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`),
  ADD KEY `fk_bidang` (`bidang`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indexes for table `penilaian_bidang`
--
ALTER TABLE `penilaian_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilaian_dt`
--
ALTER TABLE `penilaian_dt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_guru` (`id_guru`),
  ADD KEY `fk_penilaian` (`id_penilaian`),
  ADD KEY `fk_crips` (`id_crips`),
  ADD KEY `fk_kriteria` (`id_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crips`
--
ALTER TABLE `crips`
  MODIFY `id_crips` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penilaian_bidang`
--
ALTER TABLE `penilaian_bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penilaian_dt`
--
ALTER TABLE `penilaian_dt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crips`
--
ALTER TABLE `crips`
  ADD CONSTRAINT `fk_kriteria_crips` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `fk_bidang` FOREIGN KEY (`bidang`) REFERENCES `bidang` (`bidang`) ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `penilaian_dt`
--
ALTER TABLE `penilaian_dt`
  ADD CONSTRAINT `fk_crips` FOREIGN KEY (`id_crips`) REFERENCES `crips` (`id_crips`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_guru` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_penilaian` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
