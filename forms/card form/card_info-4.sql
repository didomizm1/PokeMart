-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2022 at 09:51 PM
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
-- Database: `phpmyadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_info`
--

CREATE TABLE `card_info` (
  `CIID` int(11) NOT NULL,
  `CPID` int(11) NOT NULL,
  `card_holder_name` text COLLATE utf8_bin NOT NULL,
  `card_number` bigint(16) NOT NULL,
  `cvv` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL DEFAULT 2022,
  `street_add_1` text COLLATE utf8_bin NOT NULL,
  `street_add_2` text COLLATE utf8_bin NOT NULL,
  `city` text COLLATE utf8_bin NOT NULL,
  `zip_code` int(5) NOT NULL,
  `save_card` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `card_info`
--

INSERT INTO `card_info` (`CIID`, `CPID`, `card_holder_name`, `card_number`, `cvv`, `month`, `year`, `street_add_1`, `street_add_2`, `city`, `zip_code`, `save_card`) VALUES
(1, 0, 'first last name', 1212121212121212, 123, 2, 2026, '', 'street 1', 'New York', 12345, 0),
(2, 0, 'first last name', 1234567890121234, 123, 2, 2027, 'address', 'apt.2', 'New York', 16272, 0),
(3, 0, 'abc', 172783919212352, 534, 2, 2022, 'street1', 'apt1', 'New york', 12312, 0),
(4, 0, 'cdb', 1234567123456712, 726, 5, 2022, 'steet add', 'apt.1', 'New York', 26217, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_info`
--
ALTER TABLE `card_info`
  ADD PRIMARY KEY (`CIID`),
  ADD KEY `CARD_COUNT` (`CIID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
