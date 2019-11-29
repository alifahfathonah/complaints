-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2018 at 05:11 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `identitas_id` int(11) NOT NULL,
  `identitas_website` varchar(100) NOT NULL,
  `identitas_deskripsi` text NOT NULL,
  `identitas_keyword` text NOT NULL,
  `identitas_favicon` varchar(200) NOT NULL,
  `identitas_author` varchar(50) NOT NULL,
  `identitas_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `identitas_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`identitas_id`, `identitas_website`, `identitas_deskripsi`, `identitas_keyword`, `identitas_favicon`, `identitas_author`, `identitas_created`, `identitas_updated`) VALUES
(1, 'Humas Disdik', 'Sistem Informasi Pengaduan Masyarakat Pendidikan Humas Disdik Jabar', 'arsip', 'logo.png', 'Elizabet Lumbantoruan', '2018-04-19 02:11:14', '2018-05-12 21:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `laporan_id` int(4) NOT NULL,
  `laporan_judul` varchar(100) NOT NULL,
  `laporan_isi` varchar(500) NOT NULL,
  `laporan_solusi` varchar(500) NOT NULL,
  `laporan_approve` tinyint(1) NOT NULL DEFAULT '0',
  `laporan_status` tinyint(1) NOT NULL DEFAULT '0',
  `masyarakat_username` varchar(12) NOT NULL,
  `pengaduan_id` int(4) NOT NULL,
  `laporan_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `laporan_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `masyarakat_username` varchar(30) NOT NULL,
  `masyarakat_password` varchar(50) NOT NULL,
  `masyarakat_nama` varchar(100) NOT NULL,
  `masyarakat_email` varchar(100) NOT NULL,
  `masyarakat_alamat` varchar(200) NOT NULL,
  `masyarakat_notelp` varchar(20) NOT NULL,
  `masyarakat_no` varchar(50) NOT NULL,
  `masyarakat_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `masyarakat_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pekerjaan_id` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`masyarakat_username`, `masyarakat_password`, `masyarakat_nama`, `masyarakat_email`, `masyarakat_alamat`, `masyarakat_notelp`, `masyarakat_no`, `masyarakat_created`, `masyarakat_updated`, `pekerjaan_id`) VALUES
('masyarakat', 'd9a8c6c010a37fdc9850fe6d8c064880', 'Masyarakat', 'masyarakat@gmail.com', 'Bandung', '08123456789', '0101010101', '2018-08-21 19:54:26', '2018-08-21 19:54:26', '9');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `pekerjaan_id` int(11) NOT NULL,
  `pekerjaan_jenis` varchar(100) NOT NULL,
  `pekerjaan_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pekerjaan_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`pekerjaan_id`, `pekerjaan_jenis`, `pekerjaan_created`, `pekerjaan_updated`) VALUES
(6, 'Guru', '2018-05-12 21:01:57', '2018-05-12 21:01:57'),
(7, 'Polisi', '2018-05-12 21:02:11', '2018-05-12 21:02:11'),
(8, 'Wiraswasta', '2018-05-12 21:02:21', '2018-05-12 21:02:21'),
(9, 'Dokter', '2018-05-12 21:02:31', '2018-05-12 21:02:31'),
(10, 'Jaksa', '2018-05-12 21:02:46', '2018-05-12 21:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `pengaduan_id` int(4) NOT NULL,
  `pengaduan_jenis` varchar(100) NOT NULL,
  `pengaduan_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pengaduan_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`pengaduan_id`, `pengaduan_jenis`, `pengaduan_created`, `pengaduan_updated`) VALUES
(3, 'Pungutan Liar', '2018-05-12 21:19:04', '2018-05-12 21:19:04'),
(4, 'Ijazah Sekolah', '2018-05-12 21:19:15', '2018-05-12 21:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_role` varchar(30) NOT NULL,
  `user_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `user_nama`, `user_role`, `user_created`, `user_updated`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin', '2018-04-29 11:48:35', '2018-04-29 11:48:35'),
('masyarakat', 'd9a8c6c010a37fdc9850fe6d8c064880', 'Masyarakat', 'user', '2018-08-21 19:54:26', '2018-08-21 19:54:26'),
('pejabat', 'e0c4bde30c959d22007497388ca42a4e', 'Pejabat', 'pejabat', '2018-08-20 23:59:25', '2018-08-20 23:59:25'),
('sekdis', '5f20f129bd6bd931be0d3e99fc2fb720', 'Sekdis', 'sekdis', '2018-08-20 23:59:44', '2018-08-20 23:59:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`identitas_id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`laporan_id`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`masyarakat_username`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`pekerjaan_id`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`pengaduan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `laporan_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `pekerjaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `pengaduan_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
