-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2022 at 02:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pokemart_db`
--
CREATE DATABASE IF NOT EXISTS `pokemart_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pokemart_db`;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `CIID` int(11) NOT NULL,
  `SCID` int(11) NOT NULL,
  `IID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_price` double NOT NULL,
  `item_tax` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

CREATE TABLE `customer_profile` (
  `CID` int(11) NOT NULL,
  `UPID` int(11) NOT NULL,
  `number_of_purchases` int(11) NOT NULL,
  `total_money_spent` double NOT NULL,
  `last_purchase_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `active_orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_profile`
--

CREATE TABLE `employee_profile` (
  `EID` int(11) NOT NULL,
  `UPID` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `weekly_earnings` double NOT NULL,
  `number_of_sales` int(11) NOT NULL,
  `total_revenue` double NOT NULL,
  `employee_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `IID` int(11) NOT NULL,
  `VID` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `japanese_item_name` varchar(255) NOT NULL,
  `item_description` text NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `selling_price` double(10,2) NOT NULL,
  `cost` double(10,2) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `reorder_amount` int(11) NOT NULL,
  `base_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `SCID` int(11) NOT NULL,
  `CID` int(11) NOT NULL,
  `number_of_items` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `total_tax` double NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `ULID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `is_success` tinyint(1) NOT NULL,
  `login_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `UPID` int(11) NOT NULL,
  `ULID` int(11) NOT NULL,
  `user_role_type` int(1) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `street_1` varchar(100) NOT NULL,
  `street_2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `home_phone_number` varchar(50) NOT NULL,
  `cell_phone_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `VID` int(11) NOT NULL,
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

INSERT INTO `vendors` (`VID`, `vendor_name`, `vendor_code`, `vendor_city`, `vendor_region`, `vendor_country`, `vendor_zip_code`, `vendor_contact_name`, `vendor_contact_title`, `vendor_contact_route`, `vendor_contact_number`) VALUES
(1, 'Silph Corporation', 'S', 'Saffron City', 'Kanto', 'Japan', '510-0007', 'Alfred Silph', 'President', 7, '122-562'),
(2, 'Devon Corporation', 'D', 'Rustboro City', 'Hoenn', 'Japan', '810-0006', 'Joseph Stone', 'President', 116, '544-789'),
(3, 'Violeta Corporation ', 'V', 'Violet City', 'Johto', 'Japan', '610-0017', 'Violet Evergarden ', 'Vice President', 32, '437-890'),
(4, 'Misty Corporation', 'M', 'Jubilife City', 'Sinnoh', 'Japan', '210-0014', 'Eric Leif', 'Vice President', 202, '245-910'),
(5, 'Rocko Corporation ', 'R', 'Virbank City', 'Unova', 'United States', '410-0107', 'Senku Ishigami', 'President', 20, '765-842'),
(6, 'Alola Corporation', 'A', 'Hau\'oli City', 'Alola', 'United States', '310-1212', 'Llima Moon', 'Vice President', 2, '912-780');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `WID` int(11) NOT NULL,
  `CID` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `number_of_items` int(11) NOT NULL,
  `total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_item`
--

CREATE TABLE `wishlist_item` (
  `WIID` int(11) NOT NULL,
  `WID` int(11) NOT NULL,
  `IID` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `item_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`CIID`),
  ADD KEY `SCID` (`SCID`),
  ADD KEY `IID` (`IID`);

--
-- Indexes for table `customer_profile`
--
ALTER TABLE `customer_profile`
  ADD PRIMARY KEY (`CID`),
  ADD KEY `UPID` (`UPID`) USING BTREE;

--
-- Indexes for table `employee_profile`
--
ALTER TABLE `employee_profile`
  ADD PRIMARY KEY (`EID`),
  ADD KEY `UPID` (`UPID`) USING BTREE;

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`IID`),
  ADD KEY `VID` (`VID`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`SCID`),
  ADD KEY `CID` (`CID`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`ULID`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`UPID`),
  ADD KEY `ULID` (`ULID`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`VID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`WID`),
  ADD KEY `CID` (`CID`);

--
-- Indexes for table `wishlist_item`
--
ALTER TABLE `wishlist_item`
  ADD PRIMARY KEY (`WIID`),
  ADD KEY `WID` (`WID`),
  ADD KEY `IID` (`IID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `CIID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_profile`
--
ALTER TABLE `employee_profile`
  MODIFY `EID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `IID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `SCID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `ULID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `UPID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `VID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `WID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist_item`
--
ALTER TABLE `wishlist_item`
  MODIFY `WIID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`SCID`) REFERENCES `shopping_cart` (`SCID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`IID`) REFERENCES `inventory` (`IID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `customer_profile`
--
ALTER TABLE `customer_profile`
  ADD CONSTRAINT `customer_profile_ibfk_1` FOREIGN KEY (`UPID`) REFERENCES `user_profile` (`UPID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `employee_profile`
--
ALTER TABLE `employee_profile`
  ADD CONSTRAINT `employee_profile_ibfk_1` FOREIGN KEY (`UPID`) REFERENCES `user_profile` (`UPID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`VID`) REFERENCES `vendors` (`VID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`CID`) REFERENCES `customer_profile` (`CID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`ULID`) REFERENCES `user_login` (`ULID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`CID`) REFERENCES `customer_profile` (`CID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wishlist_item`
--
ALTER TABLE `wishlist_item`
  ADD CONSTRAINT `wishlist_item_ibfk_1` FOREIGN KEY (`WID`) REFERENCES `wishlist` (`WID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_item_ibfk_2` FOREIGN KEY (`IID`) REFERENCES `inventory` (`IID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
