-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2019 at 09:45 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_ditto`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_paket`
--

CREATE TABLE `detail_paket` (
  `id_detail_paket` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_trans`
--

CREATE TABLE `detail_trans` (
  `id_detail` int(11) NOT NULL,
  `id_trans` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_trans`
--

INSERT INTO `detail_trans` (`id_detail`, `id_trans`, `id_menu`, `qty`, `total`) VALUES
(1, 1, 1, 1, 10000),
(2, 1, 12, 1, 5000),
(3, 1, 2, 1, 8000),
(4, 2, 10, 1, 10000),
(5, 2, 2, 1, 8000),
(6, 2, 6, 1, 8000),
(7, 3, 10, 1, 10000),
(8, 3, 1, 1, 10000),
(9, 3, 2, 1, 8000),
(10, 4, 6, 1, 8000),
(11, 4, 2, 1, 8000),
(12, 4, 10, 1, 10000),
(13, 4, 1, 1, 10000),
(14, 5, 10, 1, 10000),
(15, 5, 1, 1, 10000),
(16, 5, 17, 1, 10000),
(17, 5, 2, 1, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(20) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `disct_` int(11) NOT NULL,
  `gross_amount` int(11) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `kode`, `id_group`, `id_paket`, `harga`, `disct_`, `gross_amount`, `gambar`) VALUES
(1, 'Kopi Robusta', 'KR', 1, 0, 10000, 0, 0, ''),
(2, 'Kentang Goreng', 'KG', 2, 0, 8000, 0, 0, ''),
(3, 'Americano', 'AMC', 1, 0, 5000, 0, 0, ''),
(4, 'V60/Flower', 'V60', 1, 0, 8000, 0, 0, ''),
(5, 'Tempe Mendoan', 'TM', 2, 0, 8000, 0, 0, ''),
(6, 'Pisang Crispy', 'PC', 2, 0, 8000, 0, 0, ''),
(7, 'Milk Soda', 'MS', 1, 0, 12000, 0, 0, ''),
(8, 'Latte / Flat White', 'LT', 1, 0, 10000, 0, 0, ''),
(9, 'Kopi Susu Desa', 'KSD', 1, 0, 10000, 0, 0, ''),
(10, 'Cappucino', 'CPC', 1, 0, 10000, 0, 0, ''),
(11, 'Chocolate', 'CLT', 1, 0, 10000, 0, 0, ''),
(12, 'Teh', 'ET', 1, 0, 5000, 0, 0, ''),
(13, 'Air Mineral', 'AM', 1, 0, 4000, 0, 0, ''),
(14, 'Espresso', 'EPSS', 1, 0, 8000, 0, 0, ''),
(15, 'Coffee Beer', 'CB', 1, 0, 15000, 0, 0, ''),
(16, 'Supresso', 'SPSS', 1, 0, 10000, 0, 0, ''),
(17, 'Mocha', 'MCH', 1, 0, 10000, 0, 0, ''),
(18, 'Donat Kentang', 'DK', 2, 0, 8000, 0, 0, ''),
(19, 'Machiato', 'MCT', 1, 0, 12000, 0, 0, ''),
(20, 'Mint Tea', 'MT', 1, 0, 8000, 0, 0, ''),
(21, 'Grape Squash', 'GS', 1, 0, 10000, 0, 0, ''),
(22, 'Tubruk Arabica', 'TA', 1, 0, 8000, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `menu_grup`
--

CREATE TABLE `menu_grup` (
  `id_group` int(11) NOT NULL,
  `nama_menu_group` varchar(100) NOT NULL,
  `gambar_group` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_assoc`
--

CREATE TABLE `temp_assoc` (
  `id_assoc` int(11) NOT NULL,
  `confidence` int(11) NOT NULL,
  `tgl_assoc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_assoc`
--

INSERT INTO `temp_assoc` (`id_assoc`, `confidence`, `tgl_assoc`) VALUES
(1, 100, '2019-08-17'),
(2, 75, '2019-08-17'),
(3, 75, '2019-08-17'),
(4, 80, '2019-08-17'),
(5, 80, '2019-08-17'),
(6, 100, '2019-08-17'),
(7, 100, '2019-08-17'),
(8, 100, '2019-08-17'),
(9, 75, '2019-08-17'),
(10, 100, '2019-08-17'),
(11, 75, '2019-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `temp_assoc_detail`
--

CREATE TABLE `temp_assoc_detail` (
  `id_assoc_detail` int(11) NOT NULL,
  `id_assoc` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_assoc_detail`
--

INSERT INTO `temp_assoc_detail` (`id_assoc_detail`, `id_assoc`, `kode`) VALUES
(1, 1, 'KR'),
(2, 1, 'KG'),
(3, 2, 'KR'),
(4, 2, 'CPC'),
(5, 3, 'KR'),
(6, 3, 'KG'),
(7, 3, 'CPC'),
(8, 4, 'KR'),
(9, 4, 'KG'),
(10, 5, 'KG'),
(11, 5, 'CPC'),
(12, 6, 'KG'),
(13, 6, 'PC'),
(14, 7, 'CPC'),
(15, 7, 'PC'),
(16, 8, 'KG'),
(17, 8, 'CPC'),
(18, 8, 'PC'),
(19, 9, 'KR'),
(20, 9, 'CPC'),
(21, 10, 'KG'),
(22, 10, 'CPC'),
(23, 11, 'KR'),
(24, 11, 'KG'),
(25, 11, 'CPC');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_trans` int(11) NOT NULL,
  `ammount` int(11) NOT NULL,
  `no_meja` int(11) NOT NULL,
  `tgl_trans` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_trans`, `ammount`, `no_meja`, `tgl_trans`) VALUES
(1, 23000, 1, '2019-08-01'),
(2, 26000, 2, '2019-08-03'),
(3, 28000, 3, '2019-08-08'),
(4, 36000, 1, '2019-08-11'),
(5, 38000, 2, '2019-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'dito', 'f6943b8c64042f28124e7c73c62ebde1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_paket`
--
ALTER TABLE `detail_paket`
  ADD PRIMARY KEY (`id_detail_paket`);

--
-- Indexes for table `detail_trans`
--
ALTER TABLE `detail_trans`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_trans` (`id_trans`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_grup`
--
ALTER TABLE `menu_grup`
  ADD PRIMARY KEY (`id_group`);

--
-- Indexes for table `temp_assoc`
--
ALTER TABLE `temp_assoc`
  ADD PRIMARY KEY (`id_assoc`);

--
-- Indexes for table `temp_assoc_detail`
--
ALTER TABLE `temp_assoc_detail`
  ADD PRIMARY KEY (`id_assoc_detail`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_trans`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_paket`
--
ALTER TABLE `detail_paket`
  MODIFY `id_detail_paket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_trans`
--
ALTER TABLE `detail_trans`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `menu_grup`
--
ALTER TABLE `menu_grup`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_assoc`
--
ALTER TABLE `temp_assoc`
  MODIFY `id_assoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `temp_assoc_detail`
--
ALTER TABLE `temp_assoc_detail`
  MODIFY `id_assoc_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_trans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_trans`
--
ALTER TABLE `detail_trans`
  ADD CONSTRAINT `detail_trans_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`),
  ADD CONSTRAINT `detail_trans_ibfk_2` FOREIGN KEY (`id_trans`) REFERENCES `transaksi` (`id_trans`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
