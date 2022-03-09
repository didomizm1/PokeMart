-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2022 at 05:51 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `z_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `z_report`
--

CREATE TABLE `z_report` (
  `ZRID` int(11) NOT NULL,
  `EPID` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `total_cash_started` double NOT NULL,
  `total_cash_ended` double NOT NULL,
  `cash_difference` double NOT NULL,
  `items_sold` int(11) NOT NULL,
  `number_of_transactions` int(11) NOT NULL,
  `cash_sales` double NOT NULL,
  `credit_sales` double NOT NULL,
  `total_sales` double NOT NULL,
  `cash_refunds` double NOT NULL,
  `credit_refunds` double NOT NULL,
  `total_refunds` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `z_report`
--
ALTER TABLE `z_report`
  ADD PRIMARY KEY (`ZRID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `z_report`
--
ALTER TABLE `z_report`
  MODIFY `ZRID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
