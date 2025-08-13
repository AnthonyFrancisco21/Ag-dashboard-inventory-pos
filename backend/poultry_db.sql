-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2025 at 02:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poultry_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `fname`, `lname`, `admin_email`, `admin_pass`, `is_deleted`) VALUES
(1, 'anthony', 'francsico', 'admin@gmail.com', '$2y$10$04SmRPRb7N1O2Xu1AWClUe.4wLEkHJoSKsk/aTb6KH6M3fG6xSgom', 0),
(2, 'user', 'admin', 'user@gmail.com', '$2y$10$lNhw0VH3LyF582Q0PeJ6MeP/diNZT0IahgF.lVI0TYIA2cVK6YoFi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `categories` enum('feeds','Supplements','Equipment','Accessories','others') NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `product_name`, `categories`, `image_path`, `unit`, `price`, `admin_id`, `is_deleted`) VALUES
(1, 'Cord Pellet', 'feeds', 'product_images/img_689c444ca11b31.38164855.jpg', 'kilo', 45.00, 1, 0),
(2, 'Chicken Grower Mash', 'feeds', 'product_images/img_689c447dd49434.15516164.png', 'kilo', 30.00, 1, 0),
(3, 'Pit Fighter Breeder Layer Pellet', 'feeds', 'product_images/img_689c44a71d2a26.64759496.jpg', 'kilo', 50.00, 1, 0),
(4, 'Broiler Finisher Pellet', 'feeds', 'product_images/img_689c454f739245.86416271.png', 'kilo', 46.00, 1, 0),
(5, 'Cattle Concentrate', 'feeds', 'product_images/img_689c45721921b0.49993438.jpg', 'kilo', 50.00, 1, 0),
(6, 'Derby Grains Special 16-POWER MIX', 'feeds', 'product_images/img_689c45b9b54f07.64234972.jpg', 'kilo', 34.00, 1, 0),
(7, 'VitaBoost Poultry Multivitamins', 'Supplements', 'product_images/img_689c47ef366c51.43843426.jpg', 'bottle', 400.00, 1, 0),
(8, 'CalciPlus Egg Shell Strengthener', 'Supplements', 'product_images/img_689c481683dc39.95154219.jpg', 'bottle', 180.00, 1, 0),
(9, 'ProBio Feed Digestive Enhancer', 'Supplements', 'product_images/mamaclay-logo.png', 'bottle', 200.00, 1, 0),
(10, 'Steel Cockfight Leg Bands', 'Equipment', 'product_images/img_689c484c297b36.89066625.jpg', 'piece', 75.00, 1, 0),
(11, 'Professional Cockfight Knife Set', 'Equipment', 'product_images/mamaclay-logo.png', 'piece', 1800.00, 1, 0),
(12, 'Bamboo Poultry Transport Cage', 'Equipment', 'product_images/mamaclay-logo.png', 'piece', 270.00, 1, 0),
(13, 'PawPal Adjustable Nylon Collar (M)', 'Accessories', 'product_images/mamaclay-logo.png', 'piece', 200.00, 1, 0),
(14, 'WalkEase Leash 1.5 m', 'Accessories', 'product_images/img_689c4bdad8f063.42311478.jpg', 'piece', 80.00, 1, 0),
(15, 'WhiskerBowl Stainless Pet Bowl (900 ml)', 'Accessories', 'product_images/mamaclay-logo.png', 'piece', 100.00, 1, 0),
(16, 'EggCarton Max Pack', 'others', 'product_images/mamaclay-logo.png', 'piece', 50.00, 1, 0),
(17, 'Nesting Box Pads', 'others', 'product_images/mamaclay-logo.png', 'piece', 40.00, 1, 0),
(18, 'Poultry ScalePro Digital Weigher', 'others', 'product_images/img_689c4a954ef466.41307281.jpg', 'piece', 25.00, 1, 0),
(19, 'feeds', 'Equipment', 'product_images/mamaclay-logo.png', 'bottle', 12.00, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `review_tbl`
--

CREATE TABLE `review_tbl` (
  `review_id` int(11) NOT NULL,
  `review` varchar(225) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` enum('accept','reject','pending') NOT NULL DEFAULT 'pending',
  `date_submitted` date DEFAULT curdate(),
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_item_tbl`
--

CREATE TABLE `sale_item_tbl` (
  `sale_item_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sub_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_item_tbl`
--

INSERT INTO `sale_item_tbl` (`sale_item_id`, `sale_id`, `product_id`, `quantity`, `price`, `sub_total`) VALUES
(1, 1, 1, 2.00, 45.00, 90.00),
(2, 2, 1, 2.00, 45.00, 90.00),
(3, 2, 5, 1.00, 50.00, 50.00),
(4, 2, 11, 1.00, 1800.00, 1800.00),
(5, 3, 14, 1.00, 80.00, 80.00),
(6, 4, 17, 2.00, 40.00, 80.00);

-- --------------------------------------------------------

--
-- Table structure for table `sale_tbl`
--

CREATE TABLE `sale_tbl` (
  `sale_id` int(11) NOT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `change_due` decimal(10,2) NOT NULL,
  `date_sold` date DEFAULT curdate(),
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_tbl`
--

INSERT INTO `sale_tbl` (`sale_id`, `total_price`, `amount_paid`, `change_due`, `date_sold`, `admin_id`) VALUES
(1, 90.00, 100.00, 10.00, '2025-08-13', 1),
(2, 1940.00, 2000.00, 60.00, '2025-08-13', 1),
(3, 80.00, 100.00, 20.00, '2025-08-13', 1),
(4, 80.00, 100.00, 20.00, '2025-08-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit_tbl`
--

CREATE TABLE `unit_tbl` (
  `unit_id` int(11) NOT NULL,
  `unit_name` enum('kilo','sack','bottle','pack','piece') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_tbl`
--

INSERT INTO `unit_tbl` (`unit_id`, `unit_name`) VALUES
(1, 'kilo'),
(2, 'sack'),
(3, 'bottle'),
(4, 'pack'),
(5, 'piece');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `review_tbl`
--
ALTER TABLE `review_tbl`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `sale_item_tbl`
--
ALTER TABLE `sale_item_tbl`
  ADD PRIMARY KEY (`sale_item_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_sale` (`sale_id`);

--
-- Indexes for table `sale_tbl`
--
ALTER TABLE `sale_tbl`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `unit_tbl`
--
ALTER TABLE `unit_tbl`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `review_tbl`
--
ALTER TABLE `review_tbl`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_item_tbl`
--
ALTER TABLE `sale_item_tbl`
  MODIFY `sale_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sale_tbl`
--
ALTER TABLE `sale_tbl`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unit_tbl`
--
ALTER TABLE `unit_tbl`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD CONSTRAINT `product_tbl_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin_tbl` (`admin_id`);

--
-- Constraints for table `review_tbl`
--
ALTER TABLE `review_tbl`
  ADD CONSTRAINT `review_tbl_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_tbl` (`admin_id`);

--
-- Constraints for table `sale_item_tbl`
--
ALTER TABLE `sale_item_tbl`
  ADD CONSTRAINT `fk_sale` FOREIGN KEY (`sale_id`) REFERENCES `sale_tbl` (`sale_id`),
  ADD CONSTRAINT `sale_item_tbl_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_tbl` (`product_id`);

--
-- Constraints for table `sale_tbl`
--
ALTER TABLE `sale_tbl`
  ADD CONSTRAINT `sale_tbl_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_tbl` (`admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
