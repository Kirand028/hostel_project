-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 12:30 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `mroom`
--

CREATE TABLE `mroom` (
  `roomno` varchar(50) NOT NULL,
  `seater` varchar(50) NOT NULL,
  `roomfor` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mroom`
--

INSERT INTO `mroom` (`roomno`, `seater`, `roomfor`, `status`) VALUES
('1', '4', 'BOYS', 'AVAILABLE'),
('2', '4', 'BOYS', 'AVAILABLE'),
('3', '4', 'BOYS', 'AVAILABLE'),
('4', '4', 'BOYS', 'FULL'),
('5', '4', 'BOYS', 'FULL'),
('6', '4', 'GIRLS', 'FULL'),
('7', '4', 'GIRLS', 'FULL'),
('8', '4', 'GIRLS', 'FULL'),
('9', '4', 'GIRLS', 'FULL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mroom`
--
ALTER TABLE `mroom`
  ADD PRIMARY KEY (`roomno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
