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
-- Table structure for table `stregister`
--

CREATE TABLE `stregister` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `fmname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `blood` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `caste` varchar(50) NOT NULL,
  `adhar` bigint(50) NOT NULL,
  `clgname` varchar(50) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `rollno` varchar(50) NOT NULL,
  `coursedur` int(50) NOT NULL,
  `pymark` int(50) NOT NULL,
  `joindate` date NOT NULL,
  `stay` date NOT NULL,
  `mobno` bigint(50) NOT NULL,
  `pmobno` bigint(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `paddress` varchar(150) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `pincode` int(50) NOT NULL,
  `roomno` varchar(50) NOT NULL,
  `student_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stregister`
--

INSERT INTO `stregister` (`fname`, `lname`, `fmname`, `dob`, `blood`, `gender`, `caste`, `adhar`, `clgname`, `regno`, `course`, `rollno`, `coursedur`, `pymark`, `joindate`, `stay`, `mobno`, `pmobno`, `email`, `paddress`, `country`, `state`, `district`, `pincode`, `roomno`, `student_status`) VALUES
('Kavya', 'l', 'shiva', '1993-02-01', 'O+', 'FEMALE', 'shetty', 100000000002, 'bb hegde', '202123156718', 'BBA', '10010', 3, 47, '2023-07-02', '2023-12-02', 1000000001, 1000000003, 'KAVYA@GMAILCOM', 'mangalore', 'india', 'karnataka', 'managalore', 100053, 'G101', 'ACTIVE'),
('Luffy', 's', 'Dragon', '1992-01-01', 'O-', 'MALE', 'devadiga', 100000000122, 'ak hs college', '2012315272719', 'BCA', '282992', 2, 78, '2023-07-02', '2024-01-02', 1000000002, 1000000027, 'luffy@gmail.com', 'east blue', 'eastblue', 'east', 'east', 100012, 'B102', 'ACTIVE'),
('Ravi', 'k', 'raju', '1999-03-02', 'B-', 'MALE', 'mogaveer', 100000000004, 'bb hegde college kundapura', '201231500000', 'BBA', '10001000', 4, 36, '2023-07-02', '2024-07-02', 1000000003, 1000000018, 'ravi@gmail.com', 'jaj ajaj', 'aja', 'jjaj', 'diodj', 100002, 'b101', 'ACTIVE'),
('savina', 'l', 'shiva', '1993-02-01', 'O+', 'FEMALE', 'shetty', 100000000002, 'bb hegde', '2021231522800', 'BBA', '91001', 3, 68, '2023-07-02', '2024-02-02', 1000000003, 1000000005, 'savina@GMAILCOM', 'mangalore', 'india', 'karnataka', 'managalore', 100053, 'G102', 'ACTIVE'),
('vani', 'r', 'mani', '1998-04-01', 'A-', 'FEMALE', 'shetty', 100000000002, 'bhandarkars arts and science college kundapura', '201231522100', 'BA', '262728', 3, 95, '2023-07-02', '2024-07-02', 1000000002, 1000000004, 'vanik@gmail.com', 'sg', 'kka', 'kskk', 'hdhd', 100002, 'G101', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stregister`
--
ALTER TABLE `stregister`
  ADD PRIMARY KEY (`email`),
  ADD KEY `room_id` (`roomno`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stregister`
--
ALTER TABLE `stregister`
  ADD CONSTRAINT `room_id` FOREIGN KEY (`roomno`) REFERENCES `mroom` (`roomno`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
