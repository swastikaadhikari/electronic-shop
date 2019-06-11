-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2019 at 12:12 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electronics`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_add_admin`
--

CREATE TABLE `tbl_add_admin` (
  `admin_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_add_admin`
--

INSERT INTO `tbl_add_admin` (`admin_id`, `firstName`, `lastName`, `email`, `username`, `password`) VALUES
(3, 'Sarena', 'acharya', 'arena@gmail.com', 'sarena', '$2y$10$rMcAGBSPm3us4dija/tuq.LTpP7II4Rm/QmlvUP5k7yH.iTtqOIoG'),
(5, 'Dikshya', 'Ghale', 'dikki@gmail.com', 'dikshya', '$2y$10$prqwxiOtNBXCKiX5tLklgOmp6i08Nr3wPNooC5bb90UdGbJO5IRS6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `email`, `password`) VALUES
(1, 'swastika@gmail.com', '$2y$10$04mLSYqwCCXFG1FHg5T0NOpLbKvtfA5yn9VPMgBILX0AemhTjV3pK');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `Quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `customer_id`, `product_id`, `Quantity`) VALUES
(1, 21, 27, 2),
(2, 21, 27, 4),
(3, 21, 28, 3),
(4, 21, 28, 4),
(5, 21, 26, 3),
(6, 22, 38, 3),
(8, 23, 34, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(22, 'PHONE'),
(23, 'LAPTOPS'),
(24, 'CAMERA'),
(25, 'TV'),
(26, 'GAMING'),
(27, 'HEATER');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_notify` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `fullName`, `email`, `contact_no`, `password`, `email_notify`) VALUES
(12, 'Dikshya Ghale', 'dikshya@gmail.com', '98678900', '$2y$10$ugj.Bj/aGT0sWONnrcXXAeouqJrCcL3jgz5bc0oNQNoQo9Y1tCYN2', 0),
(13, 'Nitu Das', 'nitu@gmail.com', '9809090', '$2y$10$eHm1l.slaPEp7PYyDOqwl.n3Lrfx5YrL9wbrCdNEpCtHrH6YnJ126', 0),
(19, 'dikki ghale', 'dikki@gmail.com', '9090909', '$2y$10$rqPqWVlHtV8MkSMz5X8TP.iq0JcA8hsNA0uFNiUolxMkJe0yxGJnu', 1),
(21, 'sarina acharya', 'sarina@gmail.com', '90909090', '$2y$10$ZH8DDmYcHkTZN84u7x8rgeUq2LHzS8CM5kQrp4G3pzjJ2u/93x6TK', NULL),
(22, 'Arya Karki', 'arya@gmail.com', '9841890900', '$2y$10$XB6FdgTZY3mJWwC8Dba7wef75yknJjZwA9jcX5g266EkBvR9GZfcW', 1),
(23, 'Alexa Thapa', 'alexa@gmail.com', '98790909', '$2y$10$EqClkrWEqUtMd5oGcU1LDef/VJxrYb3ZA0LTtRRpQJd48S5fZ0DxC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `shipped` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `cart_id`, `cus_name`, `phone_no`, `city`, `street`, `country`, `shipped`, `date`) VALUES
(2, 2, 'Tsering khando lama', '98790909', 'ktm', 'jorpati2', 'Nepal', 0, '2019-01-11 15:59:14'),
(3, 3, 'Tsering khando lama', '98790909', 'ktm', 'jorpati2', 'Nepal', 0, '2019-01-11 15:59:14'),
(4, 4, 'Tsering khando lama', '98790909', 'ktm', 'jorpati2', 'Nepal', 0, '2019-01-11 15:59:14'),
(5, 6, 'Arya Karki', '980900098', 'Kathmandu', 'kalanki', 'Nepal', 0, '2019-01-13 12:59:17'),
(7, 8, 'Alexa Karki', '98909000', 'Kathmandu', 'kapan', 'Nepal', 0, '2019-01-13 15:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `product_detail` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `feature_product` varchar(255) NOT NULL,
  `img_upload` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `customer_id`, `category_id`, `product_name`, `brand`, `product_detail`, `price`, `feature_product`, `img_upload`) VALUES
(25, NULL, 24, 'DSLR CAMERA', 'CANON', 'it\'s nice', '30000', 'YES', '2.jpg'),
(26, NULL, 22, 'IPHONE', 'APPLE', 'water resistance\r\ndual camera\r\n5\'8 display', '400000', 'NO', '3.jpg'),
(27, NULL, 23, 'LENOVO thinkpad X270', 'LENOVO grp ltd.', 'display 14 inches\r\nRAM 8GB\r\n2TB HDD', '50000', 'NO', '4.jpg'),
(28, NULL, 24, 'DSLR D5300', 'NIKON', 'Single lens\r\n1.5x lens', '4000', 'YES', '5.jpg'),
(29, NULL, 22, 'SAMSUNG GALAXY S9', 'SAMSUNG', 'Finger print Scanner\r\nDual Camera\r\n5.8 inch tall\r\n6.8 display\r\n', '2500', 'YES', '6.jpg'),
(30, NULL, 22, 'OPPO F9', 'OPPO', 'FLASH CHARGE,6.3 inch tall, 4 or 6 GB RAM', '2700', 'NO', '7.jpg'),
(31, NULL, 23, 'DELL INSPIRON', 'DELL', 'CORE i7, 7th Gen, 15.6\"HD DISPLAY, 2TB HDD', '30000', 'YES', '1.jpg'),
(32, NULL, 25, 'QLED SMART TV', 'SAMSUNG', 'Pure entertainment for your eyes\r\nRealistic picture\r\nNo more remotes\r\nconnect with your device', '3500', 'YES', '8.jpg'),
(34, NULL, 25, 'LG OLED TV', 'LG Electronics', 'Compatible smart home device, intelligent processor \r\n', '4000', 'NO', '9.png'),
(36, NULL, 26, 'Play station portable', 'Sony Computer Entertainment', '3D Graphics, Memory Stick Port,Wifi wireless port', '25000', 'YES', '10.jpg'),
(38, NULL, 26, 'Nintendo Switch', 'Nintendo', 'LCD touchscreen, 6.2 inch', '20000', 'NO', '13.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `review_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `review_text` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`review_id`, `customer_id`, `product_id`, `review_date`, `review_text`, `approved`) VALUES
(15, 21, 27, '2019-01-10 07:56:16', 'Excellent features and easy to use', 0),
(16, 21, 26, '2019-01-10 07:57:06', 'display is nice ', 0),
(17, 21, 28, '2019-01-11 23:29:30', 'it\'s display is nice', 0),
(18, 22, 38, '2019-01-13 12:57:59', 'it\'s nice', 0),
(19, 23, 38, '2019-01-13 15:27:23', 'It\'s display is nice', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_add_admin`
--
ALTER TABLE `tbl_add_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_add_admin`
--
ALTER TABLE `tbl_add_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `tbl_cart` (`cart_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD CONSTRAINT `tbl_review_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_review_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
