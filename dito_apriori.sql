-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2019 at 06:33 PM
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
-- Database: `dito_apriori`
--

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
  `kategori` smallint(6) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `kode`, `kategori`, `harga`) VALUES
(1, 'Kopi Robusta', 'KR', 1, 10000),
(2, 'Kentang Goreng', 'KG', 2, 8000),
(3, 'Americano', 'AMC', 1, 5000),
(4, 'V60/Flower', 'V60', 1, 8000),
(5, 'Tempe Mendoan', 'TM', 2, 8000),
(6, 'Pisang Crispy', 'PC', 2, 8000),
(7, 'Milk Soda', 'MS', 1, 12000),
(8, 'Latte / Flat White', 'LT', 1, 10000),
(9, 'Kopi Susu Desa', 'KSD', 1, 10000),
(10, 'Cappucino', 'CPC', 1, 10000),
(11, 'Chocolate', 'CLT', 1, 10000),
(12, 'Teh', 'ET', 1, 5000),
(13, 'Air Mineral', 'AM', 1, 4000),
(14, 'Espresso', 'EPSS', 1, 8000),
(15, 'Coffee Beer', 'CB', 1, 15000),
(16, 'Supresso', 'SPSS', 1, 10000),
(17, 'Mocha', 'MCH', 1, 10000),
(18, 'Donat Kentang', 'DK', 2, 8000),
(19, 'Machiato', 'MCT', 1, 12000),
(20, 'Mint Tea', 'MT', 1, 8000),
(21, 'Grape Squash', 'GS', 1, 10000),
(22, 'Tubruk Arabica', 'TA', 1, 8000);

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
-- AUTO_INCREMENT for table `detail_trans`
--
ALTER TABLE `detail_trans`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
