-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2022 at 07:41 PM
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
-- Database: `pokemart_vendors`
--
CREATE DATABASE IF NOT EXISTS `pokemart_vendors` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pokemart_vendors`;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(20) NOT NULL,
  `vendor_code` varchar(20) NOT NULL,
  `vendor_city` varchar(20) NOT NULL,
  `vendor_region` varchar(20) NOT NULL,
  `vendor_country` varchar(20) NOT NULL,
  `vendor_zip_code` varchar(20) NOT NULL,
  `vendor_contact_name` varchar(20) NOT NULL,
  `vendor_contact_title` varchar(20) NOT NULL,
  `vendor_contact_route` int(11) NOT NULL,
  `vendor_contact_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `vendor_code`, `vendor_city`, `vendor_region`, `vendor_country`, `vendor_zip_code`, `vendor_contact_name`, `vendor_contact_title`, `vendor_contact_route`, `vendor_contact_number`) VALUES
(1, 'Silph Corporation', 'S', 'Saffron City', 'Kanto', 'Japan', '510-0007', 'Alfred Silph', 'President', 7, '122-562'),
(2, 'Devon Corporation', 'D', 'Rustboro City', 'Hoenn', 'Japan', '810-0006', 'Joseph Stone', 'President', 116, '544-789'),
(3, 'Violeta Corporation ', 'V', 'Violet City', 'Johto', 'Japan', '610-0017', 'Violet Evergarden ', 'Vice President', 32, '437-890'),
(4, 'Misty Corporation', 'M', 'Jubilife City', 'Sinnoh', 'Japan', '210-0014', 'Eric Leif', 'Vice President', 202, '245-910'),
(5, 'Rocko Corporation ', 'R', 'Virbank City', 'Unova', 'United States', '410-0107', 'Senku Ishigami', 'President', 20, '765-842'),
(6, 'Alola Corporation', 'A', 'Hau\'oli City', 'Alola', 'United States', '310-1212', 'Llima Moon', 'Vice President', 2, '912-780');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
