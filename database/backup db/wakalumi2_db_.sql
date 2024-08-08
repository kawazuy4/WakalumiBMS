-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 10:29 PM
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
-- Database: `wakalumi2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountsholder`
--

CREATE TABLE `accountsholder` (
  `account` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birth_place` varchar(50) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `contact` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `postal` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `house_address` varchar(200) NOT NULL,
  `npwp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountsholder`
--

INSERT INTO `accountsholder` (`account`, `name`, `birth_place`, `nik`, `contact`, `dob`, `gender`, `email`, `postal`, `city`, `house_address`, `npwp`) VALUES
('IND1010000145', 'Budi van der Berg', 'Azura', '12345678901', 2147483647, '1990-05-14', 'Laki-laki', 'budivanderberg@gmail.com', 16789, 'Azura', 'Jl. Mawar No. 23', '123456789012345'),
('IND1010000156', 'Siti de Vries', 'Eldoria', '23456789012', 2147483647, '1985-03-25', 'Perempuan', 'sitidevries@gmail.com', 16890, 'Eldoria', 'Jl. Melati No. 56', '234567890123456'),
('IND1010000167', 'Agus van Dijk', 'Luminara', '34567890123', 2147483647, '1988-11-30', 'Laki-laki', 'agusvandijk@gmail.com', 16901, 'Luminara', 'Jl. Anggrek No. 12', '345678901234567'),
('IND1010000178', 'Nur Bakker', 'Aetheria', '45678901234', 2147483647, '1992-07-18', 'Perempuan', 'nurbakker@gmail.com', 16123, 'Aetheria', 'Jl. Kenanga No. 34', '456789012345678'),
('IND1010000189', 'Dewi van der Meer', 'Solara', '56789012345', 2147483647, '1987-02-09', 'Perempuan', 'dewivandermeer@gmail.com', 16234, 'Solara', 'Jl. Teratai No. 78', '567890123456789'),
('IND1010000191', 'Andi Janssen', 'Valoria', '67890123456', 2147483647, '1993-08-22', 'Laki-laki', 'andijanssen@gmail.com', 16345, 'Valoria', 'Jl. Cempaka No. 45', '678901234567890'),
('IND1010000202', 'Ratna de Boer', 'Nivara', '78901234567', 2147483647, '1989-06-17', 'Perempuan', 'ratnadeboer@gmail.com', 16456, 'Nivara', 'Jl. Dahlia No. 67', '789012345678901'),
('IND1010000213', 'Yusuf van Leeuwen', 'Theron', '89012345678', 2147483647, '1991-09-05', 'Laki-laki', 'yusufvanleeuwen@gmail.com', 16567, 'Theron', 'Jl. Bougenville No. 80', '890123456789012'),
('IND1010000224', 'Ayu van Rijn', 'Elaria', '90123456789', 2147483647, '1986-12-12', 'Perempuan', 'ayuvanrijn@gmail.com', 16678, 'Elaria', 'Jl. Kemuning No. 21', '901234567890123'),
('IND1010000235', 'Bambang de Groot', 'Zephyria', '12345678012', 2147483647, '1990-03-28', 'Laki-laki', 'bambangdegroot@gmail.com', 16789, 'Zephyria', 'Jl. Jempiring No. 34', '123456780123456');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_info`
--

CREATE TABLE `accounts_info` (
  `account` varchar(20) NOT NULL,
  `account_title` varchar(200) NOT NULL,
  `account_type` varchar(20) NOT NULL,
  `balance` int(11) NOT NULL,
  `register_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts_info`
--

INSERT INTO `accounts_info` (`account`, `account_title`, `account_type`, `balance`, `register_date`) VALUES
('IND1010000145', 'Budi van der Berg', 'Tabungan', 11130000, '2023-03-14'),
('IND1010000156', 'Siti de Vries', 'Giro', 6024000, '2023-08-22'),
('IND1010000167', 'Agus van Dijk', 'Tabungan', 3457000, '2023-11-15'),
('IND1010000178', 'Nur Bakker', 'Giro', 8433000, '2024-04-30'),
('IND1010000189', 'Dewi van der Meer', 'Tabungan', 9024000, '2024-01-10'),
('IND1010000191', 'Andi Janssen', 'Giro', 1235000, '2023-09-05'),
('IND1010000202', 'Ratna de Boer', 'Tabungan', 6433000, '2024-07-21'),
('IND1010000213', 'Yusuf van Leeuwen', 'Giro', 2446000, '2023-06-17'),
('IND1010000224', 'Ayu van Rijn', 'Tabungan', 8766000, '2023-02-26'),
('IND1010000235', 'Bambang de Groot', 'Giro', 3500000, '2024-11-12');

-- --------------------------------------------------------

--
-- Table structure for table `account_history`
--

CREATE TABLE `account_history` (
  `account` varchar(20) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `s_name` varchar(50) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `r_name` varchar(50) NOT NULL,
  `dt` varchar(30) NOT NULL,
  `tm` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_history`
--

INSERT INTO `account_history` (`account`, `sender`, `s_name`, `receiver`, `r_name`, `dt`, `tm`, `type`, `amount`, `no`) VALUES
('IND1010000145', 'IND1010000156', 'Budi van der Berg', 'IND1010000167', 'Siti de Vries', '2024-06-15', '12:34:56', 'Transaksi', 234000, 1),
('IND1010000178', 'IND1010000189', 'Nur Bakker', 'IND1010000191', 'Dewi van der Meer', '2024-07-20', '08:23:45', 'Transaksi', 460000, 2),
('IND1010000202', 'IND1010000213', 'Ratna de Boer', 'IND1010000224', 'Yusuf van Leeuwen', '2024-08-10', '15:16:17', 'Transaksi', 1580000, 3),
('IND1010000235', 'IND1010000145', 'Bambang de Groot', 'IND1010000156', 'Budi van der Berg', '2024-09-05', '09:08:07', 'Transaksi', 700000, 4),
('IND1010000167', 'IND1010000178', 'Agus van Dijk', 'IND1010000189', 'Nur Bakker', '2024-10-12', '11:22:33', 'Diterima', 320000, 5),
('IND1010000191', 'IND1010000202', 'Andi Janssen', 'IND1010000213', 'Ratna de Boer', '2024-11-03', '10:45:56', 'Transaksi', 980000, 6),
('IND1010000224', 'IND1010000235', 'Ayu van Rijn', 'IND1010000145', 'Bambang de Groot', '2024-12-01', '17:18:19', 'Transaksi', 4150000, 7),
('IND1010000156', 'IND1010000167', 'Siti de Vries', 'IND1010000178', 'Agus van Dijk', '2024-06-22', '13:14:15', 'Diterima', 1330000, 8),
('IND1010000189', 'IND1010000191', 'Dewi van der Meer', 'IND1010000202', 'Andi Janssen', '2024-07-30', '14:15:16', 'Transaksi', 2420000, 9),
('IND1010000213', 'IND1010000224', 'Yusuf van Leeuwen', 'IND1010000235', 'Ayu van Rijn', '2024-08-25', '16:17:18', 'Diterima', 3160000, 10),
('IND1010000145', 'IND1010000156', 'Budi van der Berg', 'IND1010000167', 'Siti de Vries', '2024-09-18', '19:20:21', 'Transaksi', 2840000, 11),
('IND1010000178', 'IND1010000189', 'Nur Bakker', 'IND1010000191', 'Dewi van der Meer', '2024-10-25', '20:21:22', 'Transaksi', 4390000, 12),
('IND1010000202', 'IND1010000213', 'Ratna de Boer', 'IND1010000224', 'Yusuf van Leeuwen', '2024-11-28', '21:22:23', 'Transaksi', 1560000, 13),
('IND1010000235', 'IND1010000145', 'Bambang de Groot', 'IND1010000156', 'Budi van der Berg', '2024-12-11', '22:23:24', 'Diterima', 4790000, 14),
('IND1010000167', 'IND1010000178', 'Agus van Dijk', 'IND1010000189', 'Nur Bakker', '2024-06-03', '23:24:25', 'Transaksi', 800000, 15),
('IND1010000191', 'IND1010000202', 'Andi Janssen', 'IND1010000213', 'Ratna de Boer', '2024-07-12', '00:25:26', 'Transaksi', 3670000, 16),
('IND1010000224', 'IND1010000235', 'Ayu van Rijn', 'IND1010000145', 'Bambang de Groot', '2024-08-15', '01:26:27', 'Transaksi', 1450000, 17),
('IND1010000156', 'IND1010000167', 'Siti de Vries', 'IND1010000178', 'Agus van Dijk', '2024-09-20', '02:27:28', 'Diterima', 3280000, 18),
('IND1010000189', 'IND1010000191', 'Dewi van der Meer', 'IND1010000202', 'Andi Janssen', '2024-10-28', '03:28:29', 'Transaksi', 2960000, 19),
('IND1010000213', 'IND1010000224', 'Yusuf van Leeuwen', 'IND1010000235', 'Ayu van Rijn', '2024-11-30', '04:29:30', 'Transaksi', 2580000, 20),
('IND1010000145', 'IND1010000156', 'Budi van der Berg', 'IND1010000167', 'Siti de Vries', '2024-06-25', '05:30:31', 'Diterima', 4780000, 21),
('IND1010000178', 'IND1010000189', 'Nur Bakker', 'IND1010000191', 'Dewi van der Meer', '2024-07-10', '06:31:32', 'Diterima', 1930000, 22),
('IND1010000202', 'IND1010000213', 'Ratna de Boer', 'IND1010000224', 'Yusuf van Leeuwen', '2024-08-19', '07:32:33', 'Transaksi', 4700000, 23),
('IND1010000235', 'IND1010000145', 'Bambang de Groot', 'IND1010000156', 'Budi van der Berg', '2024-09-24', '08:33:34', 'Transaksi', 3840000, 24),
('IND1010000167', 'IND1010000178', 'Agus van Dijk', 'IND1010000189', 'Nur Bakker', '2024-10-15', '09:34:35', 'Diterima', 890000, 25),
('IND1010000191', 'IND1010000202', 'Andi Janssen', 'IND1010000213', 'Ratna de Boer', '2024-11-20', '10:35:36', 'Diterima', 2700000, 26),
('IND1010000224', 'IND1010000235', 'Ayu van Rijn', 'IND1010000145', 'Bambang de Groot', '2024-12-02', '11:36:37', 'Diterima', 4340000, 27),
('IND1010000156', 'IND1010000167', 'Siti de Vries', 'IND1010000178', 'Agus van Dijk', '2024-06-11', '12:37:38', 'Transaksi', 3120000, 28),
('IND1010000189', 'IND1010000191', 'Dewi van der Meer', 'IND1010000202', 'Andi Janssen', '2024-07-21', '13:38:39', 'Transaksi', 4940000, 29),
('IND1010000213', 'IND1010000224', 'Yusuf van Leeuwen', 'IND1010000235', 'Ayu van Rijn', '2024-08-29', '14:39:40', 'Transaksi', 3680000, 30),
('IND1010000145', 'IND1010000145', 'Budi van der Berg', 'IND1010000145', 'Budi van der Berg', '2024-06-17', '12:01:23', 'Deposit', 480000, 31),
('IND1010000156', 'IND1010000156', 'Siti de Vries', 'IND1010000156', 'Siti de Vries', '2024-06-18', '13:02:34', 'Ditarik', 750000, 32),
('IND1010000167', 'IND1010000167', 'Agus van Dijk', 'IND1010000167', 'Agus van Dijk', '2024-06-19', '14:03:45', 'Deposit', 1320000, 33),
('IND1010000178', 'IND1010000178', 'Nur Bakker', 'IND1010000178', 'Nur Bakker', '2024-06-20', '15:04:56', 'Ditarik', 2630000, 34),
('IND1010000189', 'IND1010000189', 'Dewi van der Meer', 'IND1010000189', 'Dewi van der Meer', '2024-06-21', '16:05:07', 'Deposit', 3520000, 35),
('IND1010000191', 'IND1010000191', 'Andi Janssen', 'IND1010000191', 'Andi Janssen', '2024-06-22', '17:06:18', 'Ditarik', 1450000, 36),
('IND1010000202', 'IND1010000202', 'Ratna de Boer', 'IND1010000202', 'Ratna de Boer', '2024-06-23', '18:07:29', 'Deposit', 4210000, 37),
('IND1010000213', 'IND1010000213', 'Yusuf van Leeuwen', 'IND1010000213', 'Yusuf van Leeuwen', '2024-06-24', '19:08:40', 'Ditarik', 3680000, 38),
('IND1010000224', 'IND1010000224', 'Ayu van Rijn', 'IND1010000224', 'Ayu van Rijn', '2024-06-25', '20:09:51', 'Deposit', 2530000, 39),
('IND1010000235', 'IND1010000235', 'Bambang de Groot', 'IND1010000235', 'Bambang de Groot', '2024-06-26', '21:10:02', 'Ditarik', 4700000, 40),
('IND1010000145', 'IND1010000145', 'Budi van der Berg', 'IND1010000145', 'Budi van der Berg', '2024-06-27', '22:11:13', 'Deposit', 1890000, 41),
('IND1010000156', 'IND1010000156', 'Siti de Vries', 'IND1010000156', 'Siti de Vries', '2024-06-28', '23:12:24', 'Ditarik', 750000, 42),
('IND1010000167', 'IND1010000167', 'Agus van Dijk', 'IND1010000167', 'Agus van Dijk', '2024-06-29', '00:13:35', 'Deposit', 3650000, 43),
('IND1010000178', 'IND1010000178', 'Nur Bakker', 'IND1010000178', 'Nur Bakker', '2024-06-30', '01:14:46', 'Ditarik', 2820000, 44),
('IND1010000189', 'IND1010000189', 'Dewi van der Meer', 'IND1010000189', 'Dewi van der Meer', '2024-07-01', '02:15:57', 'Deposit', 4590000, 45),
('IND1010000191', 'IND1010000191', 'Andi Janssen', 'IND1010000191', 'Andi Janssen', '2024-07-02', '03:16:08', 'Ditarik', 1780000, 46),
('IND1010000202', 'IND1010000202', 'Ratna de Boer', 'IND1010000202', 'Ratna de Boer', '2024-07-03', '04:17:19', 'Deposit', 4100000, 47),
('IND1010000213', 'IND1010000213', 'Yusuf van Leeuwen', 'IND1010000213', 'Yusuf van Leeuwen', '2024-07-04', '05:18:30', 'Ditarik', 1980000, 48),
('IND1010000224', 'IND1010000224', 'Ayu van Rijn', 'IND1010000224', 'Ayu van Rijn', '2024-07-05', '06:19:41', 'Deposit', 3920000, 49),
('IND1010000235', 'IND1010000235', 'Bambang de Groot', 'IND1010000235', 'Bambang de Groot', '2024-07-06', '07:20:52', 'Ditarik', 3720000, 50),
('IND1010000303', 'IND1010000303', 'hjfgfgfgh', 'null', 'null', '2024-05-19', '09:50:28', 'Deposit', 1000000, 127),
('IND1010000145', 'IND1010000145', 'Budi van der Berg', 'IND1010000156', 'Siti de Vries', '2024-05-19', '08:08:22', 'Transaksi', 50000, 128),
('IND1010000156', 'IND1010000145', 'Budi van der Berg', 'IND1010000156', 'Siti de Vries', '2024-05-19', '08:08:22', 'Diterima', 50000, 129),
('IND1010000145', 'IND1010000145', 'Budi van der Berg', 'null', 'null', '2024-06-08', '05:57:37', 'Ditarik', 100000, 131),
('IND1010000189', 'IND1010000189', 'Dewi van der Meer', 'IND1010000213', 'Yusuf van Leeuwen', '2024-06-08', '06:05:09', 'Transaksi', 100000, 132),
('IND1010000213', 'IND1010000189', 'Dewi van der Meer', 'IND1010000213', 'Yusuf van Leeuwen', '2024-06-08', '06:05:09', 'Diterima', 100000, 133),
('IND1010000178', 'IND1010000178', 'Nur Bakker', 'null', 'null', '2024-06-08', '07:11:42', 'Ditarik', 100000, 134),
('IND1010000145', 'IND1010000145', 'Budi van der Berg', 'null', 'null', '2024-06-22', '11:42:01', 'Deposit', 500000, 135),
('IND1010000145', 'IND1010000145', 'Budi van der Berg', 'null', 'null', '2024-06-22', '11:46:00', 'Deposit', 50000, 136),
('IND1010000145', 'IND1010000145', 'Budi van der Berg', 'null', 'null', '2024-06-22', '11:47:33', 'Deposit', 100000, 137),
('IND1010000145', 'IND1010000145', 'Budi van der Berg', 'null', 'null', '2024-06-22', '11:47:52', 'Deposit', 2000000, 138),
('IND1010000145', 'IND1010000145', 'Budi van der Berg', 'null', 'null', '2024-06-22', '11:48:48', 'Deposit', 10000000, 139),
('IND1010000145', 'IND1010000145', 'Budi van der Berg', 'IND1010000178', 'Nur Bakker', '2024-06-23', '02:54:30', 'Transaksi', 1000000, 140),
('IND1010000178', 'IND1010000145', 'Budi van der Berg', 'IND1010000178', 'Nur Bakker', '2024-06-23', '02:54:30', 'Diterima', 1000000, 141),
('IND1010000145', 'IND1010000145', 'Budi van der Berg', 'null', 'null', '2024-06-23', '03:18:46', 'Ditarik', 20000, 142);

-- --------------------------------------------------------

--
-- Table structure for table `counting`
--

CREATE TABLE `counting` (
  `acc_count` bigint(20) NOT NULL,
  `emp_id` bigint(20) NOT NULL,
  `loanacc_count` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counting`
--

INSERT INTO `counting` (`acc_count`, `emp_id`, `loanacc_count`) VALUES
(1010000303, 500100, 20200011002);

-- --------------------------------------------------------

--
-- Table structure for table `emp_details`
--

CREATE TABLE `emp_details` (
  `id` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birth_place` varchar(50) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `marital` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `postal` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `house_address` varchar(200) NOT NULL,
  `edu` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `exp` varchar(30) NOT NULL,
  `hired_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_details`
--

INSERT INTO `emp_details` (`id`, `name`, `birth_place`, `nik`, `contact`, `dob`, `gender`, `marital`, `email`, `postal`, `city`, `house_address`, `edu`, `title`, `exp`, `hired_date`) VALUES
('ADN100002', 'Citra Surya', 'Solaris Town', '320012345678901', '08123456789', '1985-08-22', 'Perempuan', 'Belum Menikah', 'citra.surya@gmail.com', '54321', 'Luna', 'Jl. Matahari No. 21', 'D3', 'Manajer', '5 Tahun', '2020-12-12'),
('ADN100004', 'Cahaya Dewi', 'Celestial Heights', '320082345670912', '08123456789', '1978-12-01', 'Perempuan', 'Menikah', 'cahaya.dewi@gmail.com', '21453', 'Orion', 'Jl. Bintang Laut No. 67', 'S2', 'Akuntan', 'Di Atas 5 Tahun', '2019-10-10'),
('ADN100008', 'Gita Meteor', 'Galaxy City', '320022345679876', '08123456789', '1972-06-08', 'Perempuan', 'Menikah', 'gita.meteor@gmail.com', '12345', 'Asteroid', 'Jl. Bintang Jauh No. 56', 'S1', 'Insinyur', 'Di Atas 5 Tahun', '2018-05-20'),
('EMP3003', 'Kaka Kaku', 'Depok', '125124124124', '08124912312', '1998-10-12', 'Perempuan', 'Belum Menikah', 'kakakaku@gmail.com', '221341', 'Depok', 'Jl. Kenangan', 'SMA', 'Developer', '3 Tahun', '2024-05-19'),
('EMP3004', 'sdfsdfasd', 'fsdfasdfas', '2134234234', '2341234', '2024-05-25', 'Laki-laki', 'Belum Menikah', 'sdfsdfasd@gmail.com', '123123', 'fsgsgasdg', 'fgasdgasdfsdfs', 'sma', 'dfsd', '5 Tahun', '2024-05-19'),
('EMP500001', 'Agus Starlight', 'Galactic City', '320042562584759', '08123456789', '1990-03-15', 'Laki-laki', 'Menikah', 'agusstarlight@gmail.com', '12345', 'Nebula', 'Jl. Bintang No. 45', 'S1', 'Insinyur', '3 Tahun', '2022-05-05'),
('EMP500003', 'Andika Aurora', 'Stellar City', '320092345671234', '08123456789', '1998-05-10', 'Laki-laki', 'Belum Menikah', 'andika.aurora@gmail.com', '43210', 'Cosmo', 'Jl. Langit No. 34', 'SMA/Sederajat', 'Staff IT', '1 Tahun', '2023-08-18'),
('EMP500005', 'Bima Supernova', 'Astral Village', '320052345679843', '08123456789', '2000-02-28', 'Laki-laki', 'Belum Menikah', 'bima.supernova@gmail.com', '54321', 'Pleiades', 'Jl. Gugus Bintang No. 78', 'D3', 'Developer', '2 Tahun', '2023-04-25'),
('EMP500006', 'Dara Comet', '', '320032345678765', '08123456781', '1995-09-20', 'Perempuan', 'Belum Menikah', 'dara.comet@gmail.com', '21453', 'Aurora', 'Jl. Komet No. 12', 'S1', 'Lulusan Baru', 'Lulusan Baru', '2024-01-15'),
('EMP500007', 'Fajar Quasar', 'Nebula Town', '320072345675432', '08123456789', '1982-11-05', 'Laki-laki', 'Menikah', 'fajar.quasar@gmail.com', '54321', 'Andromeda', 'Jl. Quasar No. 90', 'S2', 'Manajer', 'Di Atas 5 Tahun', '2021-07-30'),
('EMP500009', 'Hari Nova', 'Comet Heights', '320062345678945', '08123456789', '1992-04-17', 'Laki-laki', 'menika  h', 'hari.nova@gmail.com', '21453', 'Black Hole', 'Jl. Matahari Terbenam No. 23', 'S1', 'Developer', '4 Tahun', '2022-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `emp_history`
--

CREATE TABLE `emp_history` (
  `id` varchar(20) NOT NULL,
  `log_date_time` varchar(40) NOT NULL,
  `logout_date_time` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_history`
--

INSERT INTO `emp_history` (`id`, `log_date_time`, `logout_date_time`) VALUES
('EMP500001', '2024-01-01 08:23:14', '2024-01-01 16:45:27'),
('ADN100002', '2024-02-14 10:30:45', '2024-02-14 18:20:59'),
('EMP500003', '2024-03-25 09:15:22', '2024-03-25 17:55:36'),
('ADN100004', '2024-04-04 07:50:11', '2024-04-04 15:10:28'),
('EMP500005', '2024-02-29 11:11:11', '2024-02-29 19:19:19'),
('ADN100002', '2024-03-10 13:30:30', '2024-03-10 21:45:45'),
('EMP500007', '2024-01-15 16:40:40', '2024-01-15 23:55:55'),
('ADN100008', '2024-02-20 18:00:00', '2024-02-20 23:59:59'),
('EMP500009', '2024-04-02 09:30:30', '2024-04-02 17:45:45'),
('ADN100002', '2024-03-18 08:15:15', '2024-03-18 16:30:30'),
('ADN100008', '2024-05-19 07:02:04', 'logged still'),
('EMP500001', '2024-06-06 07:45:06', 'logged still'),
('ADN100002', '2024-06-07 02:09:25', 'logged still'),
('ADN100002', '2024-06-08 01:31:24', 'logged still'),
('ADN100002', '2024-06-14 01:50:46', '2024-06-14 02:46:48'),
('ADN100002', '2024-06-14 02:48:40', 'logged still'),
('ADN100002', '2024-06-14 04:45:31', '2024-06-14 09:51:15'),
('EMP500001', '2024-06-14 09:51:35', 'logged still'),
('ADN100002', '2024-06-22 10:43:02', '2024-06-22 10:43:14'),
('ADN100002', '2024-06-22 10:43:34', '2024-06-22 10:43:38'),
('ADN100002', '2024-06-22 10:44:12', '2024-06-22 22:55:07'),
('ADN100002', '2024-06-22 10:55:56', '2024-06-23 00:46:42'),
('ADN100002', '2024-06-23 12:46:46', '2024-06-23 03:24:25'),
('ADN100002', '2024-06-23 03:24:42', 'logged still');

-- --------------------------------------------------------

--
-- Table structure for table `loanaccounts_info`
--

CREATE TABLE `loanaccounts_info` (
  `loan_account` varchar(20) NOT NULL,
  `loanaccount_title` varchar(200) NOT NULL,
  `loanaccount_type` varchar(20) NOT NULL,
  `loan_amount` int(11) NOT NULL,
  `periode` int(5) NOT NULL,
  `layaway` int(11) NOT NULL,
  `loan_status` varchar(20) NOT NULL,
  `layaway_count` int(5) NOT NULL,
  `register_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loanaccounts_info`
--

INSERT INTO `loanaccounts_info` (`loan_account`, `loanaccount_title`, `loanaccount_type`, `loan_amount`, `periode`, `layaway`, `loan_status`, `layaway_count`, `register_date`) VALUES
('LOAN20200001123', 'Adi Müller', 'Pinjaman', 1000000, 6, 166666, 'Belum Lunas', 2, '2023-03-15'),
('LOAN20200002134', 'Budi Schmidt', 'Pinjaman', 5000000, 12, 416666, 'Belum Lunas', 4, '2023-05-20'),
('LOAN20200003145', 'Citra Bauer', 'Pinjaman', 1000000, 18, 60555, 'Belum Lunas', 17, '2023-07-25'),
('LOAN20200004156', 'Dewi Weber', 'Pinjaman', 1500000, 24, 62500, 'Belum Lunas', 12, '2023-09-30'),
('LOAN20200005167', 'Eko Wagner', 'Pinjaman', 3000000, 30, 100000, 'Belum Lunas', 10, '2023-11-05'),
('LOAN20200006178', 'Fajar Fischer', 'Pinjaman', 4000000, 36, 111111, 'Belum Lunas', 8, '2024-01-10'),
('LOAN20200007189', 'Gita Becker', 'Pinjaman', 2500000, 6, 416666, 'Lunas', 0, '2024-03-15'),
('LOAN20200008190', 'Hadi Maier', 'Pinjaman', 1000000, 12, 83333, 'Belum Lunas', 5, '2024-05-20'),
('LOAN20200009101', 'Intan Schmitz', 'Pinjaman', 2000000, 18, 111111, 'Belum Lunas', 3, '2024-07-25'),
('LOAN20200010112', 'Joko Keller', 'Pinjaman', 1500000, 24, 62500, 'Lunas', 0, '2024-09-30'),
('LOAN1', 'Ivan', 'Pinjaman', 1000000, 6, 175000, 'Belum Lunas', 6, '2024-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `loanaccount_history`
--

CREATE TABLE `loanaccount_history` (
  `loan_account` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dt` varchar(30) NOT NULL,
  `tm` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loanaccount_history`
--

INSERT INTO `loanaccount_history` (`loan_account`, `name`, `dt`, `tm`, `type`, `no`) VALUES
('LOAN20200001123', 'Adi Müller', '2024-07-01', '12:34:56', 'Pinjam', 1),
('LOAN20200002134', 'Budi Schmidt', '2024-08-15', '13:45:23', 'Bayar Angsuran', 2),
('LOAN20200003145', 'Citra Bauer', '2024-09-20', '14:56:45', 'Pinjam', 3),
('LOAN20200004156', 'Dewi Weber', '2024-10-25', '15:34:12', 'Bayar Angsuran', 4),
('LOAN20200005167', 'Eko Wagner', '2024-11-30', '16:45:56', 'Pinjam', 5),
('LOAN20200006178', 'Fajar Fischer', '2024-12-05', '17:56:34', 'Bayar Angsuran', 6),
('LOAN20200007189', 'Gita Becker', '2024-06-01', '08:12:34', 'Pinjam', 7),
('LOAN20200008190', 'Hadi Maier', '2024-06-15', '09:23:45', 'Bayar Angsuran', 8),
('LOAN20200009101', 'Intan Schmitz', '2024-07-20', '10:34:56', 'Pinjam', 9),
('LOAN20200010112', 'Joko Keller', '2024-08-25', '11:45:23', 'Bayar Angsuran', 10),
('LOAN20200003145', 'Citra Bauer', '2024-06-07', '04:34:48', 'Pinjam', 130),
('LOAN20200003145', 'Citra Bauer', '2024-06-07', '04:37:01', 'Pinjam', 131),
('LOAN20200003145', 'Citra Bauer', '2024-06-07', '04:37:54', 'Bayar Angsuran', 132),
('LOAN1', 'Ivan', '2024-06-23', '02:20:27', 'Pinjaman', 133);

-- --------------------------------------------------------

--
-- Table structure for table `loan_accountsholder`
--

CREATE TABLE `loan_accountsholder` (
  `loan_account` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birth_place` varchar(50) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `postal` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `house_address` varchar(200) NOT NULL,
  `npwp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_accountsholder`
--

INSERT INTO `loan_accountsholder` (`loan_account`, `name`, `birth_place`, `nik`, `contact`, `dob`, `gender`, `email`, `postal`, `city`, `house_address`, `npwp`) VALUES
('LOAN1', 'Ivan', 'Depok', '1343212', '08998123881', '2001-06-23', 'Laki-laki', 'ivan@gmail.com', '12332', 'Depok', 'Jl. Kenangan', '889889889'),
('LOAN20200001123', 'Adi Müller', 'Avalon', '1234567890123456', '081234567890', '1990-01-01', 'Laki-laki', 'adimuller@gmail.com', '16123', 'Camelot', 'Jl. Merdeka No. 12', '1234567890'),
('LOAN20200002134', 'Budi Schmidt', 'Camelot', '2345678901234567', '081234567891', '1991-02-01', 'Laki-laki', 'budischmidt@gmail.com', '16234', 'Avalon', 'Jl. Jaya No. 23', '2345678901'),
('LOAN20200003145', 'Citra Bauer', 'Eldorado', '3456789012345678', '081234567892', '1992-03-01', 'Perempuan', 'citrabauer@gmail.com', '16345', 'Eldorado', 'Jl. Makmur No. 34', '3456789012'),
('LOAN20200004156', 'Dewi Weber', 'Shangri-La', '4567890123456789', '081234567893', '1993-04-01', 'Perempuan', 'dewiweber@gmail.com', '16456', 'Camelot', 'Jl. Sejahtera No. 45', '4567890123'),
('LOAN20200005167', 'Eko Wagner', 'Atlantis', '5678901234567890', '081234567894', '1994-05-01', 'Laki-laki', 'ekowagner@gmail.com', '16567', 'Avalon', 'Jl. Harmoni No. 56', '5678901234'),
('LOAN20200006178', 'Fajar Fischer', 'Camelot', '6789012345678901', '081234567895', '1995-06-01', 'Laki-laki', 'fajarfischer@gmail.com', '16678', 'Eldorado', 'Jl. Sentosa No. 67', '6789012345'),
('LOAN20200007189', 'Gita Becker', 'Eldorado', '7890123456789012', '081234567896', '1996-07-01', 'Perempuan', 'gitabecker@gmail.com', '16789', 'Camelot', 'Jl. Damai No. 78', '7890123456'),
('LOAN20200008190', 'Hadi Maier', 'Avalon', '8901234567890123', '081234567897', '1997-08-01', 'Laki-laki', 'hadimaier@gmail.com', '16890', 'Shangri-La', 'Jl. Rukun No. 89', '8901234567'),
('LOAN20200009101', 'Intan Schmitz', 'Shangri-La', '9012345678901234', '081234567898', '1998-09-01', 'Perempuan', 'intanschmitz@gmail.com', '16901', 'Atlantis', 'Jl. Suci No. 90', '9012345678'),
('LOAN20200010112', 'Joko Keller', 'Atlantis', '0123456789012345', '081234567899', '1999-10-01', 'Laki-laki', 'jokokeller@gmail.com', '16112', 'Shangri-La', 'Jl. Luhur No. 91', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `status`) VALUES
('ADN100002', 'citra.surya@gmail.com', 'admin', 'Admin', 'Active'),
('ADN100004', 'cahaya.dewi@gmail.com', 'admin', 'Admin', 'Active'),
('ADN100008', 'gita.meteor@gmail.com', 'admin', 'Admin', 'Active'),
('EMP3003', 'kakakaku@gmail.com', '51815682', 'Employee', 'Block'),
('EMP3004', 'sdfsdfasd@gmail.com', '39190241', 'Employee', 'Block'),
('EMP500001', 'agusstarlight@gmail.com', 'admin', 'Employee', 'Active'),
('EMP500003', 'andika.aurora@gmail.com', 'admin', 'Employee', 'Active'),
('EMP500005', 'bima.supernova@gmail.com', 'admin', 'Employee', 'Active'),
('EMP500006', 'dara.comet@gmail.com', 'admin', 'Employee', 'Active'),
('EMP500007', 'fajar.quasar@gmail.com', 'admin', 'Employee', 'Active'),
('EMP500009', 'hari.nova@gmail.com', 'admin', 'Employee', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountsholder`
--
ALTER TABLE `accountsholder`
  ADD PRIMARY KEY (`account`);

--
-- Indexes for table `accounts_info`
--
ALTER TABLE `accounts_info`
  ADD KEY `account` (`account`);

--
-- Indexes for table `account_history`
--
ALTER TABLE `account_history`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `emp_details`
--
ALTER TABLE `emp_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_history`
--
ALTER TABLE `emp_history`
  ADD KEY `id` (`id`);

--
-- Indexes for table `loanaccounts_info`
--
ALTER TABLE `loanaccounts_info`
  ADD KEY `loan_account` (`loan_account`);

--
-- Indexes for table `loanaccount_history`
--
ALTER TABLE `loanaccount_history`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `loan_accountsholder`
--
ALTER TABLE `loan_accountsholder`
  ADD PRIMARY KEY (`loan_account`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_history`
--
ALTER TABLE `account_history`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `loanaccount_history`
--
ALTER TABLE `loanaccount_history`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts_info`
--
ALTER TABLE `accounts_info`
  ADD CONSTRAINT `accounts_info_ibfk_1` FOREIGN KEY (`account`) REFERENCES `accountsholder` (`account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emp_history`
--
ALTER TABLE `emp_history`
  ADD CONSTRAINT `emp_history_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loanaccounts_info`
--
ALTER TABLE `loanaccounts_info`
  ADD CONSTRAINT `loanaccounts_info_ibfk_1` FOREIGN KEY (`loan_account`) REFERENCES `loan_accountsholder` (`loan_account`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `emp_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
