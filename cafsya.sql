-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2023 at 07:28 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafsya`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_pesanan`
--

CREATE TABLE `item_pesanan` (
  `idItemPesanan` bigint(20) NOT NULL,
  `idPesanan` bigint(20) NOT NULL,
  `idMenu` bigint(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_pesanan`
--

INSERT INTO `item_pesanan` (`idItemPesanan`, `idPesanan`, `idMenu`, `jumlah`, `total`) VALUES
(1, 1, 6, 1, 25000),
(2, 1, 8, 1, 15000),
(3, 1, 10, 2, 36000),
(4, 2, 8, 2, 30000),
(5, 3, 6, 1, 25000),
(6, 3, 8, 1, 15000),
(7, 4, 6, 1, 25000),
(8, 5, 12, 1, 35000),
(9, 6, 12, 2, 70000),
(10, 6, 15, 1, 25000),
(11, 7, 6, 2, 50000),
(12, 7, 10, 1, 18000),
(13, 8, 11, 1, 16000);

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `idMeja` int(10) UNSIGNED NOT NULL,
  `status` enum('Terisi','Kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`idMeja`, `status`) VALUES
(1, 'Kosong'),
(2, 'Terisi'),
(3, 'Terisi'),
(4, 'Kosong'),
(5, 'Kosong'),
(6, 'Kosong'),
(7, 'Kosong'),
(8, 'Terisi'),
(9, 'Kosong');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idMenu` int(10) UNSIGNED NOT NULL,
  `namaMenu` varchar(30) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `status` enum('Tersedia','Habis') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idMenu`, `namaMenu`, `harga`, `gambar`, `stok`, `status`) VALUES
(6, 'Mile Cake Matcha', '25000', 'mile.jpg', 20, 'Tersedia'),
(8, 'Original Pancake', '15000', 'ori-pancake.jpg', 20, 'Tersedia'),
(10, 'Ice Americano Sweet', '18000', 'ice-americano.jpg', 20, 'Tersedia'),
(11, 'Gellato Berry', '16000', 'gelato-strawbery.jpg', 30, 'Tersedia'),
(12, 'Pizza Cheese', '35000', 'pija-cheese.jpg', 15, 'Tersedia'),
(14, 'Ice Taro Milk', '19000', 'ice-taro.png', 16, 'Tersedia'),
(15, 'Thai Tea', '25000', 'thai-tea.jpg', 14, 'Tersedia'),
(16, 'Burger', '15000', 'burger.jpg', 2, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `idPesan` int(10) UNSIGNED NOT NULL,
  `idMeja` int(11) NOT NULL,
  `namaPelanggan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('Dibuat','Diantar') NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`idPesan`, `idMeja`, `namaPelanggan`, `jumlah`, `total`, `status`, `tanggal`) VALUES
(2, 6, 'Tasya', 2, 30000, 'Diantar', '2023-02-14 05:19:34'),
(3, 5, 'Luna', 2, 40000, 'Diantar', '2023-02-14 05:29:57'),
(4, 7, 'Caca', 1, 25000, 'Diantar', '2023-02-14 05:24:08'),
(5, 8, 'weri', 1, 35000, 'Diantar', '2023-02-14 05:51:52'),
(6, 6, 'Dita', 3, 95000, 'Diantar', '2023-02-14 06:23:59'),
(7, 8, 'Nisa', 3, 68000, 'Dibuat', '2023-02-14 05:55:40'),
(8, 5, 'Wahab', 1, 16000, 'Diantar', '2023-02-14 06:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idTrans` int(10) UNSIGNED NOT NULL,
  `idPesan` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('Lunas','Tertunda') NOT NULL DEFAULT 'Tertunda',
  `tanggal` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idTrans`, `idPesan`, `total`, `status`, `tanggal`) VALUES
(2, 2, 30000, 'Lunas', '2023-02-13 21:19:34'),
(3, 3, 300000, 'Lunas', '2023-02-13 21:29:57'),
(4, 4, 100000, 'Lunas', '2023-02-13 21:24:08'),
(5, 5, 50000, 'Lunas', '2023-02-13 21:51:52'),
(6, 6, 100000, 'Lunas', '2023-02-13 22:23:59'),
(7, 7, 0, 'Tertunda', '2023-02-13 21:55:40'),
(8, 8, 20000, 'Lunas', '2023-02-13 22:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `namaUser` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'KASIR',
  `status` enum('Aktif','Pasif') NOT NULL DEFAULT 'Pasif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `namaUser`, `username`, `password`, `level`, `status`) VALUES
(6, 'Tasya Ramadhinta', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'ADMIN', 'Aktif'),
(9, 'Ramadhinta', 'Ramadhinta', '103f09fac33402093f30beb9e3c6fb4328dbf358', 'KASIR', 'Pasif'),
(15, 'Tasyarkh', 'Manager', '1a8565a9dc72048ba03b4156be3e569f22771f23', 'MANAGER', 'Aktif'),
(16, 'Khoirnunnisa ', 'Kasir', '8691e4fc53b99da544ce86e22acba62d13352eff', 'KASIR', 'Aktif'),
(20, 'Lula', 'lula', 'f8449a28b3d63c3e0efbeafec9c951acef201c23', 'ADMIN', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_pesanan`
--
ALTER TABLE `item_pesanan`
  ADD PRIMARY KEY (`idItemPesanan`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`idMeja`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idMenu`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idPesan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idTrans`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_pesanan`
--
ALTER TABLE `item_pesanan`
  MODIFY `idItemPesanan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `idMeja` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idMenu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `idPesan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idTrans` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
