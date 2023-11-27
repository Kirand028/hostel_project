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
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `email` varchar(100) NOT NULL,
  `cardno` bigint(50) NOT NULL,
  `cardhname` varchar(100) NOT NULL,
  `exmonth` int(50) NOT NULL,
  `exyear` int(50) NOT NULL,
  `cvv` int(50) NOT NULL,
  `fees` int(50) NOT NULL,
  `month_meal_price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`email`, `cardno`, `cardhname`, `exmonth`, `exyear`, `cvv`, `fees`, `month_meal_price`) VALUES
('luffy@gmail.com', 10192982928, 'Luffy', 4, 2025, 329282, 30000, 0),
('vanik@gmail.com', 101028837192, 'Vani', 5, 2025, 420922, 44000, 0),
('savina@GMAILCOM', 101092938727, 'savina', 8, 2024, 32029, 28000, 0),
('KAVYA@GMAILCOM', 383827271524, 'kavya', 4, 2025, 32992, 28000, 1000),
('ravi@gmail.com', 829281801010, 'ravi', 4, 2025, 329282, 40000, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`cardno`),
  ADD KEY `emailid` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `emailid` FOREIGN KEY (`email`) REFERENCES `stregister` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
