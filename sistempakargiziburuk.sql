-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2026 at 09:11 AM
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
-- Database: `sistempakargiziburuk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `nama_gejala` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `id_admin`, `id_penyakit`, `nama_gejala`) VALUES
(12, 1, 2, 'sangat kurus dan wajah membulat'),
(13, 1, 2, 'perut mencekung dan otot mengecil'),
(14, 1, 2, 'kulit keriput terjadi kelainan kulit'),
(15, 1, 2, 'pengurangan lemak bawah kulit seperti marasmus'),
(16, 1, 3, 'rambut terlihat tipis dan mudah dicabut'),
(17, 1, 3, 'susah buang air besar'),
(18, 1, 3, 'mudah terjangkit penyakit'),
(19, 1, 3, 'bentuk fisik beruah'),
(20, 1, 3, 'sangat kurus'),
(21, 1, 3, 'wajah seperti orang tua'),
(22, 1, 3, 'perut cekung'),
(23, 1, 3, 'kulit kering'),
(24, 1, 3, 'cengeng dan mudah bawel'),
(25, 1, 3, 'bagian daerah pantat tampak seperti memakai celana longgar'),
(26, 1, 3, 'berat badan hanya sekitar 60% dari seharusnya'),
(27, 1, 3, 'otot mengecil'),
(28, 1, 2, 'nnnnnn'),
(30, 1, 5, 'berat badan sulit naik'),
(31, 1, 5, 'tubuh terlihat lebih kurus'),
(32, 1, 5, 'mudah lelah'),
(33, 1, 5, 'sering sakit'),
(34, 1, 5, 'pertumbuhan melambat'),
(35, 1, 4, 'badan sangat kurus (wasting)'),
(36, 1, 4, 'lemah'),
(37, 1, 4, 'rambut mudah rontok'),
(38, 1, 4, 'kulit kering'),
(39, 1, 4, 'perut bisa tampak buncit'),
(40, 1, 4, 'serta rentan infeksi'),
(41, 1, 6, 'tinggi badan lebih pendek dibanding anak seusianya'),
(42, 1, 6, 'pertumbuhan lambat'),
(43, 1, 6, 'perkembangan otak dan motorik terlambat'),
(44, 1, 6, 'serta mudah sakit');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `namapasien` varchar(100) NOT NULL,
  `jeniskelamin` varchar(50) NOT NULL,
  `hasildiagnosa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_penyakit`, `namapasien`, `jeniskelamin`, `hasildiagnosa`) VALUES
(23, 3, 'YOSEP', 'Laki-Laki', 'Marasmus');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_penyakit`, `nilai`) VALUES
(3611, 2, 0.52),
(3612, 2, 0.52),
(3613, 2, 0.48),
(3614, 2, 0.48),
(3615, 2, 0.48),
(3616, 2, 0.48),
(3617, 3, 0.48),
(3618, 3, 0.48),
(3619, 3, 0.52),
(3620, 3, 0.52),
(3621, 3, 0.52),
(3622, 3, 0.52);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_akhir`
--

CREATE TABLE `nilai_akhir` (
  `id_nilaiakhir` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `nilai_akhir` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_akhir`
--

INSERT INTO `nilai_akhir` (`id_nilaiakhir`, `id_penyakit`, `nilai_akhir`) VALUES
(350, 2, 0.00478465),
(351, 3, 0.00561532);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `usernameuser` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `usia` varchar(10) NOT NULL,
  `password_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `id_admin`, `nama_pasien`, `usernameuser`, `jk`, `usia`, `password_user`) VALUES
(6, 1, 'YOSEP', 'YOSEP', 'Laki-Laki', '20 tahun', 'YOSEP');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `nama_penyakit` varchar(30) NOT NULL,
  `solusi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `id_pasien`, `nama_penyakit`, `solusi`) VALUES
(2, 1, 'Marasmik-Kwarshiorkor', 'testing2'),
(3, 1, 'Marasmus', 'Testing 3'),
(4, 1, 'Gizi Buruk', 'Memberikan asupan makanan tinggi energi dan protein, disertai penanganan medis '),
(5, 1, 'gizi kurang', 'Meningkatkan konsumsi makanan bergizi seimbang,'),
(6, 1, 'Stunting', 'mpasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  ADD PRIMARY KEY (`id_nilaiakhir`),
  ADD KEY `id_penyakit` (`id_penyakit`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3623;

--
-- AUTO_INCREMENT for table `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  MODIFY `id_nilaiakhir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gejala`
--
ALTER TABLE `gejala`
  ADD CONSTRAINT `gejala_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`),
  ADD CONSTRAINT `gejala_ibfk_2` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);

--
-- Constraints for table `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  ADD CONSTRAINT `nilai_akhir_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`);

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
