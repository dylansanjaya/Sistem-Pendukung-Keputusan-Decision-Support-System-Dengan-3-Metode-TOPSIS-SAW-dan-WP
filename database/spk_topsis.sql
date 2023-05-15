-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 09:14 AM
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
(16, 'Budi'),
(16, 'Bupa'),
(17, 'Arnold'),
(17, 'Arnold'),
(18, 'Budi'),
(18, 'Arnold'),
(19, 'Arnold'),
(19, 'asu');

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

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id_pemilihan`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
(16, 90, 78, 100, 90, 98, 90),
(17, 90, 100, 90, 100, 100, 78),
(18, 60, 60, 60, 60, 60, 60),
(19, 10, 20, 30, 40, 50, 60);

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

--
-- Dumping data for table `bobot_normal`
--

INSERT INTO `bobot_normal` (`id_pemilihan`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
(18, 0.1667, 0.1667, 0.1667, 0.1667, 0.1667, 0.1667),
(18, 0.1667, 0.1667, 0.1667, 0.1667, 0.1667, 0.1667),
(19, 0.0476, 0.0952, 0.1429, 0.1905, 0.2381, 0.2857),
(19, 0.0476, 0.0952, 0.1429, 0.1905, 0.2381, 0.2857);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_pemilihan` int(11) NOT NULL,
  `alternatif` varchar(255) NOT NULL,
  `v` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_pemilihan`, `alternatif`, `v`) VALUES
(16, 'Bupa', 0.565),
(17, 'Arnold', 0.5033),
(18, 'Budi', 0.6514),
(19, 'Arnold', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jarak_solusi_ideal`
--

CREATE TABLE `jarak_solusi_ideal` (
  `id_pemilihan` int(11) NOT NULL,
  `positif` double NOT NULL,
  `negatif` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jarak_solusi_ideal`
--

INSERT INTO `jarak_solusi_ideal` (`id_pemilihan`, `positif`, `negatif`) VALUES
(16, 97.7626, 75.2712),
(16, 75.2712, 97.7626),
(17, 82.0881, 81.02),
(17, 81.02, 82.0881),
(18, 37.3586, 69.7994),
(18, 69.7994, 37.3586),
(19, 0, 30.954),
(19, 30.954, 0);

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

--
-- Dumping data for table `matrik_r`
--

INSERT INTO `matrik_r` (`id_pemilihan`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
(16, 0.5039, 0.9912, 0.8575, 0.8137, 0.9959, 0.7809),
(16, 0.8638, 0.1322, 0.5145, 0.5812, 0.0905, 0.6247),
(17, 0.4472, 0.2873, 0.5547, 0.7071, 0.1789, 0.6459),
(17, 0.8944, 0.9578, 0.832, 0.7071, 0.9839, 0.7634),
(18, 0.9806, 0.9912, 0.7071, 0.7593, 0.9363, 0.7926),
(18, 0.1961, 0.1322, 0.7071, 0.6508, 0.3511, 0.6097),
(19, 0.7071, 0.7071, 0.7071, 0.6585, 0.3511, 0.6247),
(19, 0.7071, 0.7071, 0.7071, 0.7526, 0.9363, 0.7809);

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

--
-- Dumping data for table `matrik_y`
--

INSERT INTO `matrik_y` (`id_pemilihan`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
(16, 45.351, 77.3136, 85.75, 73.233, 97.5982, 70.281),
(16, 77.742, 10.3116, 51.45, 52.308, 8.869, 56.223),
(17, 40.248, 28.73, 49.923, 70.71, 17.89, 50.3802),
(17, 80.496, 95.78, 74.88, 70.71, 98.39, 59.5452),
(18, 58.836, 59.472, 42.426, 45.558, 56.178, 47.556),
(18, 11.766, 7.932, 42.426, 39.048, 21.066, 36.582),
(19, 7.071, 14.142, 21.213, 26.34, 17.555, 37.482),
(19, 7.071, 14.142, 21.213, 30.104, 46.815, 46.854);

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
(16, 7, 60, 5, 7, 11, 25),
(16, 12, 8, 3, 5, 1, 20),
(17, 6, 18, 2, 7, 2, 22),
(17, 12, 60, 3, 7, 11, 26),
(18, 60, 60, 1, 7, 8, 26),
(18, 12, 8, 1, 6, 3, 20),
(19, 12, 60, 3, 7, 3, 20),
(19, 12, 60, 3, 8, 8, 25);

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

--
-- Dumping data for table `nilai_ideal`
--

INSERT INTO `nilai_ideal` (`id_pemilihan`, `ideal`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
(16, 'positif', 77.742, 77.3136, 85.75, 52.308, 8.869, 56.223),
(16, 'negatif', 45.351, 10.3116, 51.45, 73.233, 97.5982, 70.281),
(17, 'positif', 80.496, 95.78, 74.88, 70.71, 17.89, 50.3802),
(17, 'negatif', 40.248, 28.73, 49.923, 70.71, 98.39, 59.5452),
(18, 'positif', 58.836, 59.472, 42.426, 39.048, 21.066, 36.582),
(18, 'negatif', 11.766, 7.932, 42.426, 45.558, 56.178, 47.556),
(19, 'positif', 7.071, 14.142, 21.213, 26.34, 17.555, 37.482),
(19, 'negatif', 7.071, 14.142, 21.213, 30.104, 46.815, 46.854);

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
(16, 'Bismillah', '2023-05-15', 'selesai'),
(17, 'Eh brader', '2023-05-15', 'selesai'),
(18, 'Udin Gaming', '2023-05-15', 'selesai'),
(19, 'Udin Gaming', '2023-05-15', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `id_pemilihan` int(11) NOT NULL,
  `v` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ranking`
--

INSERT INTO `ranking` (`id_pemilihan`, `v`) VALUES
(16, 0.435),
(16, 0.565),
(17, 0.4967),
(17, 0.5033),
(18, 0.6514),
(18, 0.3486),
(19, 1),
(19, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  ADD CONSTRAINT `bobotnormal_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`);

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
