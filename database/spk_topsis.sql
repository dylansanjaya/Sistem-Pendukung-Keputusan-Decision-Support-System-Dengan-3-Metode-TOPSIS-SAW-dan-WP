-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 05:48 PM
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
-- Database: `spk_topsis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$TR7tJBifQZWyvGpfTo4RDueN9ebAkyJG8T2kDo56yPyWZiCYh4dbe');

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_pemilihan` int(11) NOT NULL,
  `alternatif` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_pemilihan`, `alternatif`) VALUES
(7, 'Budi'),
(7, 'Adrian'),
(7, 'Abraham'),
(21, 'Arnold'),
(21, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `id_pemilihan` int(11) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL,
  `c6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bobot_normal`
--

CREATE TABLE `bobot_normal` (
  `id_pemilihan` int(11) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL,
  `c6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_pemilihan` int(11) NOT NULL,
  `alternatif` varchar(255) NOT NULL,
  `v` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_saw`
--

CREATE TABLE `hasil_saw` (
  `id_pemilihan` int(11) NOT NULL,
  `alternatif` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `vs` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jarak_solusi_ideal`
--

CREATE TABLE `jarak_solusi_ideal` (
  `id_pemilihan` int(11) NOT NULL,
  `positif` double NOT NULL,
  `negatif` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matrik_r`
--

CREATE TABLE `matrik_r` (
  `id_pemilihan` int(11) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL,
  `c6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matrik_r_saw`
--

CREATE TABLE `matrik_r_saw` (
  `id_pemilihan` int(11) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL,
  `c6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matrik_v_saw`
--

CREATE TABLE `matrik_v_saw` (
  `id_pemilihan` int(11) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL,
  `c6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matrik_y`
--

CREATE TABLE `matrik_y` (
  `id_pemilihan` int(11) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL,
  `c6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_pemilihan` int(11) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL,
  `c6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_pemilihan`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
(21, 12, 18, 1, 3, 2, 20),
(21, 6, 8, 4, 8, 3, 25);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_ideal`
--

CREATE TABLE `nilai_ideal` (
  `id_pemilihan` int(11) NOT NULL,
  `ideal` varchar(20) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL,
  `c6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemilihan`
--

CREATE TABLE `pemilihan` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pemilihan`
--

INSERT INTO `pemilihan` (`id`, `keterangan`, `tanggal`, `status`) VALUES
(6, 'Brandon', '2023-05-09', 'id'),
(7, 'Udin Gaming', '2023-05-12', 'alternatif'),
(21, 'TEST TEMPLAAATING', '2023-05-15', 'nilai-alternatif');

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `id_pemilihan` int(11) NOT NULL,
  `v` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ranking_saw`
--

CREATE TABLE `ranking_saw` (
  `id_pemilihan` int(11) NOT NULL,
  `vs` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indexes for table `bobot_normal`
--
ALTER TABLE `bobot_normal`
  ADD KEY `bobotnormal_ibfk_1` (`id_pemilihan`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indexes for table `hasil_saw`
--
ALTER TABLE `hasil_saw`
  ADD KEY `hasil_ibfk_saw_1` (`id_pemilihan`);

--
-- Indexes for table `jarak_solusi_ideal`
--
ALTER TABLE `jarak_solusi_ideal`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indexes for table `matrik_r`
--
ALTER TABLE `matrik_r`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indexes for table `matrik_r_saw`
--
ALTER TABLE `matrik_r_saw`
  ADD KEY `matrik_r_saw_ibfk_1` (`id_pemilihan`);

--
-- Indexes for table `matrik_v_saw`
--
ALTER TABLE `matrik_v_saw`
  ADD KEY `matrik_v_saw_ibfk_1` (`id_pemilihan`);

--
-- Indexes for table `matrik_y`
--
ALTER TABLE `matrik_y`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indexes for table `nilai_ideal`
--
ALTER TABLE `nilai_ideal`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indexes for table `pemilihan`
--
ALTER TABLE `pemilihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD KEY `id_pemilihan` (`id_pemilihan`);

--
-- Indexes for table `ranking_saw`
--
ALTER TABLE `ranking_saw`
  ADD KEY `ranking_ibfk_saw_1` (`id_pemilihan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemilihan`
--
ALTER TABLE `pemilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bobot`
--
ALTER TABLE `bobot`
  ADD CONSTRAINT `bobot_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bobot_normal`
--
ALTER TABLE `bobot_normal`
  ADD CONSTRAINT `bobotnormal_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hasil_saw`
--
ALTER TABLE `hasil_saw`
  ADD CONSTRAINT `hasil_ibfk_saw_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jarak_solusi_ideal`
--
ALTER TABLE `jarak_solusi_ideal`
  ADD CONSTRAINT `jarak_solusi_ideal_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `matrik_r`
--
ALTER TABLE `matrik_r`
  ADD CONSTRAINT `matrik_r_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `matrik_r_saw`
--
ALTER TABLE `matrik_r_saw`
  ADD CONSTRAINT `matrik_r_saw_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `matrik_v_saw`
--
ALTER TABLE `matrik_v_saw`
  ADD CONSTRAINT `matrik_v_saw_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `matrik_y`
--
ALTER TABLE `matrik_y`
  ADD CONSTRAINT `matrik_y_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_ideal`
--
ALTER TABLE `nilai_ideal`
  ADD CONSTRAINT `nilai_ideal_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ranking`
--
ALTER TABLE `ranking`
  ADD CONSTRAINT `ranking_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ranking_saw`
--
ALTER TABLE `ranking_saw`
  ADD CONSTRAINT `ranking_ibfk_saw_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
