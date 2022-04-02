-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2022 at 07:17 PM
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
-- Database: `transactions`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_transaction`
--

CREATE TABLE `customer_transaction` (
  `CTID` int(11) NOT NULL,
  `CPID` int(11) NOT NULL,
  `IID` int(11) NOT NULL,
  `cart_item` int(11) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_cost` double(10,2) NOT NULL,
  `date_stamp` int(11) NOT NULL,
  `transaction_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_transaction`
--

CREATE TABLE `vendor_transaction` (
  `VTID` int(11) NOT NULL,
  `VID` int(11) NOT NULL,
  `IID` int(11) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_cost` double(10,2) NOT NULL,
  `date_stamp` date NOT NULL,
  `transaction_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_transaction`
--
ALTER TABLE `customer_transaction`
  ADD PRIMARY KEY (`CTID`,`CPID`),
  ADD KEY `CTID` (`CTID`,`CPID`);

--
-- Indexes for table `vendor_transaction`
--
ALTER TABLE `vendor_transaction`
  ADD PRIMARY KEY (`VTID`,`VID`),
  ADD KEY `VID` (`VID`),
  ADD KEY `VTID` (`VTID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vendor_transaction`
--
ALTER TABLE `vendor_transaction`
  ADD CONSTRAINT `vendor_transaction_ibfk_1` FOREIGN KEY (`VID`) REFERENCES `transaction` (`VID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
