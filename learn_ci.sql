-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2017 at 08:30 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learn_ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ma_so` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_dn`
--

CREATE TABLE `admin_dn` (
  `ma_so_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_so_dn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doanh_nghiep`
--

CREATE TABLE `doanh_nghiep` (
  `ma_so` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten_dn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deadline_nhan_ho_so` date DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `hinh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ds_dang_ky`
--

CREATE TABLE `ds_dang_ky` (
  `ma_so_sv` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_so_dn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `type` tinyint(4) NOT NULL,
  `read` tinyint(4) DEFAULT '0',
  `write` tinyint(4) DEFAULT '0',
  `admin` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_dn` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sinhvien` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`type`, `read`, `write`, `admin`, `admin_dn`, `sinhvien`) VALUES
(1, 1, 1, '1', '1', '1'),
(2, 1, 0, '0', '1', '1'),
(3, 1, 0, '0', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sinh_vien`
--

CREATE TABLE `sinh_vien` (
  `ma_so` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ho_ten` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sdt` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deadline_chon_dn` date DEFAULT NULL,
  `sl_dn_toi_da` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sinh_vien`
--

INSERT INTO `sinh_vien` (`ma_so`, `ho_ten`, `sdt`, `deadline_chon_dn`, `sl_dn_toi_da`) VALUES
('12', 'Trần Điểm', '0123', '2017-11-15', 3),
('123', 'Trần Nguyễn', '012345678', '2017-11-11', 20),
('51201991', 'Truong Bach Long', '0123456789', '2017-12-10', 0),
('51203073', 'Tran Thien Phuc', '01202519959', '2017-12-10', 2),
('512030731', 'Tran Thien Phuc', '01202519959', '2017-12-10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ma_so` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(10) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `disabled` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ma_so`, `username`, `password`, `type`, `email`, `disabled`) VALUES
('12', 'admin', '123', 3, '1', 0),
('123', 'Phuc', '123', 3, 'a@b.c', 1),
('51201991', 'long123', '123456', 3, 'a@b.c', 0),
('51203073', 'dustintran', '123456', 3, 'a@b.c', 0),
('512030731', 'phuc1', '123456', 3, 'a@b.c', 0),
('admin', 'PhucAd', '123456', 3, '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ma_so`),
  ADD UNIQUE KEY `admin_ma_so_uindex` (`ma_so`);

--
-- Indexes for table `doanh_nghiep`
--
ALTER TABLE `doanh_nghiep`
  ADD PRIMARY KEY (`ma_so`),
  ADD UNIQUE KEY `doanh_nghiep_ma_so_uindex` (`ma_so`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`type`),
  ADD UNIQUE KEY `permission_type_uindex` (`type`);

--
-- Indexes for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD PRIMARY KEY (`ma_so`),
  ADD UNIQUE KEY `sinh_vien_ma_so_uindex` (`ma_so`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ma_so`),
  ADD UNIQUE KEY `user_ma_so_uindex` (`ma_so`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
