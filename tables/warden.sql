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
-- Table structure for table `warden`
--

CREATE TABLE `warden` (
  `wid` varchar(50) NOT NULL,
  `wname` varchar(50) NOT NULL,
  `wgender` varchar(50) NOT NULL,
  `wage` int(50) NOT NULL,
  `wadhar` bigint(50) NOT NULL,
  `waddress` varchar(250) NOT NULL,
  `phone` bigint(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `wpass` varchar(16) NOT NULL,
  `warden_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warden`
--

INSERT INTO `warden` (`wid`, `wname`, `wgender`, `wage`, `wadhar`, `waddress`, `phone`, `email`, `wpass`, `warden_status`) VALUES
('wf101', 'rani', 'FEMALE', 30, 987000876003, 'udupi mangalore mysore', 8760000001, 'rani@gmail.com', 'BW&biw6X', 'ACTIVE'),
('wm101', 'Harish', 'male', 30, 997867645427, 'kundapura managlore', 9987654559, 'harishram@gmail.com', 'harish12', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `warden`
--
ALTER TABLE `warden`
  ADD PRIMARY KEY (`wid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
