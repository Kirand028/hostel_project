-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 08:08 AM
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
  `seater` int(50) NOT NULL,
  `roomfor` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `filled` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mroom`
--

INSERT INTO `mroom` (`roomno`, `seater`, `roomfor`, `status`, `filled`) VALUES
('b101', 4, 'MALE', 'AVAILABLE', 1),
('B102', 4, 'MALE', 'AVAILABLE', 1),
('G101', 4, 'FEMALE', 'AVAILABLE', 2),
('G102', 4, 'FEMALE', 'AVAILABLE', 1),
('Not Assigned', 0, 'none', 'none', 0);

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
