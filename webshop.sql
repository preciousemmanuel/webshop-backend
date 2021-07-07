-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2021 at 06:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `delivery_fee` decimal(10,2) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `first_name`, `last_name`, `address`, `email`, `phone`, `note`, `delivery_fee`, `city`, `created_at`, `status`) VALUES
(13, 'Precious', 'Emmanuel', 'Rumunduru', 'emmaprechi@gmail.com', '08105175548', 'note', NULL, NULL, '2021-07-07 11:45:57', 'Delivered'),
(14, 'Precious', 'Emmanuel', 'Rumunduru', 'emmaprechi@gmail.com', '08105175548', '', NULL, NULL, '2021-07-07 11:48:53', 'Canceled'),
(15, 'Precious', 'Emmanuel', 'Rumunduru', 'emmaprechi@gmail.com', '08105175548', '', NULL, NULL, '2021-07-07 11:49:26', 'pending'),
(16, 'Precious', 'Emmanuel', 'Rumunduru', 'emmaprechi@gmail.com', '08105175548', 'thanks', NULL, NULL, '2021-07-07 12:34:43', 'Delivered'),
(17, 'Precious', 'Emmanuel', 'Rumunduru', 'emmaprechi@gmail.com', '08105175548', '', NULL, NULL, '2021-07-07 12:37:35', 'pending'),
(18, 'Precious', 'Emmanuel', 'Rumunduru', 'emmaprechi@gmail.com', '08105175548', '', NULL, NULL, '2021-07-07 12:38:39', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_history`
--

CREATE TABLE `tbl_order_history` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order_history`
--

INSERT INTO `tbl_order_history` (`id`, `product_id`, `quantity`, `amount`, `total_amount`, `order_id`, `created_at`) VALUES
(15, 1, 1, '3000.00', '0.00', 13, '2021-07-07 11:45:57'),
(16, 3, 1, '4000.00', '0.00', 13, '2021-07-07 11:45:57'),
(17, 3, 1, '4000.00', '0.00', 14, '2021-07-07 11:48:53'),
(18, 1, 1, '3000.00', '0.00', 14, '2021-07-07 11:48:53'),
(19, 3, 1, '4000.00', '0.00', 15, '2021-07-07 11:49:26'),
(20, 3, 1, '4000.00', '4000.00', 16, '2021-07-07 12:34:43'),
(21, 1, 1, '3000.00', '3000.00', 16, '2021-07-07 12:34:43'),
(22, 3, 1, '4000.00', '4000.00', 17, '2021-07-07 12:37:35'),
(23, 1, 1, '3000.00', '3000.00', 17, '2021-07-07 12:37:35'),
(24, 1, 1, '3000.00', '3000.00', 18, '2021-07-07 12:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `other_images` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `description`, `main_image`, `user_id`, `created_at`, `quantity`, `price`, `updated_at`, `other_images`) VALUES
(1, 'Chair', 'This is a fine chair', 'pic6.jpg', 0, '2021-07-05 23:52:44', 20, 3000.00, '2021-07-05 23:52:44', NULL),
(3, 'Chika Product', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla p', 'pic5.jpg', 1, '2021-07-06 01:08:50', 30, 4000.00, '2021-07-06 01:08:50', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `access_token`, `created_at`, `password`, `auth_key`, `username`) VALUES
(1, 'Femi', '23333', '2021-07-06 02:15:21', '202cb962ac59075b964b07152d234b70', '21212', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_history`
--
ALTER TABLE `tbl_order_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_order_history`
--
ALTER TABLE `tbl_order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
