-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2022 at 07:39 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `card_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_info`
--

CREATE TABLE `card_info` (
  `CIID` int(11) NOT NULL,
  `CPID` int(11) NOT NULL,
  `card_holder_name` varchar(30) NOT NULL,
  `card_number` bigint(16) NOT NULL,
  `cvv` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `street_add_1` text NOT NULL,
  `street_add_2` text NOT NULL,
  `city` text NOT NULL,
  `zip_code` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_info`
--
ALTER TABLE `card_info`
  ADD PRIMARY KEY (`CIID`,`CPID`),
  ADD KEY `CPID` (`CIID`),
  ADD KEY `CPID_2` (`CPID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
