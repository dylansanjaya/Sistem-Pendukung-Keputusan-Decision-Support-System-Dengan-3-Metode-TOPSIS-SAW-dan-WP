-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2023 at 09:53 AM
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
(21, 'a'),
(25, 'Adler'),
(25, 'Gallagher'),
(25, 'Brian'),
(25, 'Assholee');

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
(25, 60, 10, 100, 60, 98, 10);

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
(25, 0.1775, 0.0296, 0.2959, 0.1775, 0.2899, 0.0296),
(25, 0.1775, 0.0296, 0.2959, 0.1775, 0.2899, 0.0296),
(25, 0.1775, 0.0296, 0.2959, 0.1775, 0.2899, 0.0296),
(25, 0.1775, 0.0296, 0.2959, 0.1775, 0.2899, 0.0296);

-- --------------------------------------------------------

--
-- Table structure for table `bobot_normal_w`
--

CREATE TABLE `bobot_normal_w` (
  `id_pemilihan` int(11) NOT NULL,
  `c1` double NOT NULL,
  `c2` double NOT NULL,
  `c3` double NOT NULL,
  `c4` double NOT NULL,
  `c5` double NOT NULL,
  `c6` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bobot_normal_w`
--

INSERT INTO `bobot_normal_w` (`id_pemilihan`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
(25, 0.1775, 0.0296, 0.2959, -0.1775, -0.2899, -0.0296),
(25, 0.1775, 0.0296, 0.2959, -0.1775, -0.2899, -0.0296),
(25, 0.1775, 0.0296, 0.2959, -0.1775, -0.2899, -0.0296),
(25, 0.1775, 0.0296, 0.2959, -0.1775, -0.2899, -0.0296);

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
(25, 'Gallagher', 0.8614);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_saw`
--

CREATE TABLE `hasil_saw` (
  `id_pemilihan` int(11) NOT NULL,
  `alternatif` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `vs` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_saw`
--

INSERT INTO `hasil_saw` (`id_pemilihan`, `alternatif`, `vs`) VALUES
(25, 'Gallagher', 0.9098);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_wp`
--

CREATE TABLE `hasil_wp` (
  `id_pemilihan` int(11) NOT NULL,
  `alternatif` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `vw` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_wp`
--

INSERT INTO `hasil_wp` (`id_pemilihan`, `alternatif`, `vw`) VALUES
(25, 'Gallagher', 0.381);

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
(25, 48.409, 37.187),
(25, 12.0513, 74.9286),
(25, 74.7506, 14.9984),
(25, 33.7694, 51.1045);

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
(25, 0.4602, 0.4981, 0.3235, 0.4303, 0.4373, 0.4878),
(25, 0.5369, 0.4358, 0.5392, 0.5164, 0.0729, 0.5543),
(25, 0.4602, 0.5603, 0.4313, 0.4303, 0.8017, 0.4878),
(25, 0.5369, 0.4981, 0.647, 0.6025, 0.4009, 0.4656);

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

--
-- Dumping data for table `matrik_r_saw`
--

INSERT INTO `matrik_r_saw` (`id_pemilihan`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
(25, 0.8571, 0.8889, 0.5, 1, 0.1667, 0.9545),
(25, 1, 0.7778, 0.8333, 0.8333, 1, 0.84),
(25, 0.8571, 1, 0.6667, 1, 0.0909, 0.9545),
(25, 1, 0.8889, 1, 0.7143, 0.1818, 1);

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

--
-- Dumping data for table `matrik_v_saw`
--

INSERT INTO `matrik_v_saw` (`id_pemilihan`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
(25, 0.1521, 0.0263, 0.148, 0.1775, 0.0483, 0.0283),
(25, 0.1775, 0.023, 0.2466, 0.1479, 0.2899, 0.0249),
(25, 0.1521, 0.0296, 0.1973, 0.1775, 0.0264, 0.0283),
(25, 0.1775, 0.0263, 0.2959, 0.1268, 0.0527, 0.0296);

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
(25, 27.612, 4.981, 32.35, 25.818, 42.8554, 4.878),
(25, 32.214, 4.358, 53.92, 30.984, 7.1442, 5.543),
(25, 27.612, 5.603, 43.13, 25.818, 78.5666, 4.878),
(25, 32.214, 4.981, 64.7, 36.15, 39.2882, 4.656);

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
(21, 6, 8, 4, 8, 3, 25),
(25, 6, 8, 3, 5, 12, 22),
(25, 7, 7, 5, 6, 2, 25),
(25, 6, 9, 4, 5, 22, 22),
(25, 7, 8, 6, 7, 11, 21);

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
(25, 'positif', 32.214, 5.603, 64.7, 25.818, 7.1442, 4.656),
(25, 'negatif', 27.612, 4.358, 32.35, 36.15, 78.5666, 5.543);

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
(21, 'TEST TEMPLAAATING', '2023-05-15', 'nilai-alternatif'),
(25, 'Test WP Final', '2023-05-16', 'selesaiwp');

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
(25, 0.4344),
(25, 0.8614),
(25, 0.1671),
(25, 0.6021);

-- --------------------------------------------------------

--
-- Table structure for table `ranking_saw`
--

CREATE TABLE `ranking_saw` (
  `id_pemilihan` int(11) NOT NULL,
  `vs` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ranking_saw`
--

INSERT INTO `ranking_saw` (`id_pemilihan`, `vs`) VALUES
(25, 0.5805),
(25, 0.9098),
(25, 0.6112),
(25, 0.7088);

-- --------------------------------------------------------

--
-- Table structure for table `ranking_wp`
--

CREATE TABLE `ranking_wp` (
  `id_pemilihan` int(11) NOT NULL,
  `vw` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ranking_wp`
--

INSERT INTO `ranking_wp` (`id_pemilihan`, `vw`) VALUES
(25, 0.1973),
(25, 0.381),
(25, 0.1809),
(25, 0.2409);

-- --------------------------------------------------------

--
-- Table structure for table `s_normal_wp`
--

CREATE TABLE `s_normal_wp` (
  `id_pemilihan` int(11) NOT NULL,
  `s` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s_normal_wp`
--

INSERT INTO `s_normal_wp` (`id_pemilihan`, `s`) VALUES
(25, 0.67511220505616),
(25, 1.3033935317555),
(25, 0.61879351606855),
(25, 0.8240413179698);

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
-- Indexes for table `bobot_normal_w`
--
ALTER TABLE `bobot_normal_w`
  ADD KEY `bobotnormal_w_ibfk_1` (`id_pemilihan`);

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
-- Indexes for table `hasil_wp`
--
ALTER TABLE `hasil_wp`
  ADD KEY `hasil_wp_ibfk_1` (`id_pemilihan`);

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
-- Indexes for table `ranking_wp`
--
ALTER TABLE `ranking_wp`
  ADD KEY `ranking_wp_ibfk_saw_1` (`id_pemilihan`);

--
-- Indexes for table `s_normal_wp`
--
ALTER TABLE `s_normal_wp`
  ADD KEY `s_normal_wp_ibfk_1` (`id_pemilihan`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- Constraints for table `bobot_normal_w`
--
ALTER TABLE `bobot_normal_w`
  ADD CONSTRAINT `bobotnormal_w_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `hasil_wp`
--
ALTER TABLE `hasil_wp`
  ADD CONSTRAINT `hasil_wp_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `ranking_wp`
--
ALTER TABLE `ranking_wp`
  ADD CONSTRAINT `ranking_wp_ibfk_saw_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `s_normal_wp`
--
ALTER TABLE `s_normal_wp`
  ADD CONSTRAINT `s_normal_wp_ibfk_1` FOREIGN KEY (`id_pemilihan`) REFERENCES `pemilihan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
