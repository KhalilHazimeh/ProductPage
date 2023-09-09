-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2023 at 11:38 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, 'Laperva'),
(2, 'Body Builder '),
(8, 'Mass Gainer');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Proteins'),
(2, 'Whey Protein Isolate'),
(3, 'Sport Gainer'),
(9, 'Mass Gainer');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`) VALUES
(1, 'Flavor'),
(2, 'Size'),
(3, 'Color'),
(4, 'Ingredient');

-- --------------------------------------------------------

--
-- Table structure for table `option_values`
--

CREATE TABLE `option_values` (
  `id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `value_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `option_values`
--

INSERT INTO `option_values` (`id`, `option_id`, `value_name`) VALUES
(5, 2, '2 LB'),
(6, 2, '3 LB'),
(7, 2, '4 LB'),
(8, 2, '5 LB'),
(9, 2, '6 LB'),
(10, 2, '7 LB'),
(11, 2, '8 LB'),
(12, 2, '9 LB'),
(13, 2, '10 Lb'),
(14, 1, 'Strawberry'),
(15, 1, 'Strawberry Cream'),
(16, 1, 'Belgian Chocolate'),
(17, 1, 'Cafe Late'),
(18, 1, 'Chocolate Coconut'),
(19, 1, 'Pina Colada'),
(20, 1, 'Banana'),
(21, 1, 'Belgian Tofe'),
(22, 1, 'Dreamy Vanilla'),
(23, 1, 'Belgian Vanilla'),
(24, 1, 'Choco Peanut'),
(25, 1, 'Vanilla Caramel'),
(26, 1, 'Milk Chocolate'),
(27, 1, 'Strawberry Milkshake'),
(28, 1, 'Strawberry Cotton Candy'),
(29, 1, 'Cookies and Cream'),
(30, 1, 'Double Chip Chocolate');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `old-price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `old-price`, `image`, `brand_id`) VALUES
(1, 'Khalil Hazimeh', 1241, 121, '0', 1),
(2, 'Lapreva Boduy Bilder', 319, 121, '0', 2),
(3, 'Mr. Lilac', 319, 275, '0', 1),
(27, 'A 1', 12, 14, '0', 1),
(28, 'A 2', 13, 14, '0', 2),
(29, '111', 12, 12, '0', 2),
(30, 'Aee', 11, 22, '0', 2),
(31, 'Aee', 11, 22, '0', 2),
(32, 'Aee', 11, 22, '0', 2),
(33, 'R1', 12, 2, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`product_id`, `category_id`) VALUES
(0, 1),
(1, 1),
(1, 2),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_options`
--

CREATE TABLE `product_options` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_options`
--

INSERT INTO `product_options` (`id`, `product_id`, `option_id`) VALUES
(109, 27, 1),
(110, 27, 2),
(111, 28, 1),
(112, 28, 2),
(113, 29, 1),
(114, 29, 2),
(115, 30, 1),
(116, 30, 2),
(117, 31, 1),
(118, 31, 2),
(119, 32, 1),
(120, 32, 2),
(121, 33, 1),
(122, 33, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_option_combinations`
--

CREATE TABLE `product_option_combinations` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `first_option_id` int(11) NOT NULL,
  `first_option_value_id` int(11) NOT NULL,
  `second_option_id` int(11) DEFAULT NULL,
  `second_option_value_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_option_combinations`
--

INSERT INTO `product_option_combinations` (`id`, `product_id`, `first_option_id`, `first_option_value_id`, `second_option_id`, `second_option_value_id`) VALUES
(57, 27, 1, 15, 1, 6),
(58, 27, 2, 15, 2, 6),
(59, 28, 1, 17, 1, 5),
(60, 28, 2, 17, 2, 5),
(61, 28, 1, 18, 1, 7),
(62, 28, 2, 18, 2, 7),
(65, 32, 1, 14, 2, 5),
(66, 32, 1, 14, 2, 5),
(67, 32, 1, 14, 2, 7),
(68, 32, 1, 14, 2, 7),
(69, 32, 1, 14, 2, 9),
(70, 32, 1, 14, 2, 9),
(71, 33, 1, 14, 2, 5),
(72, 33, 1, 14, 2, 7),
(73, 33, 1, 14, 2, 9),
(74, 33, 1, 17, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pwd`) VALUES
(1, 'Khalil', 'khalil123'),
(17, 'Abdullah', 'abdullah123'),
(19, 'Ali', 'ali123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_values`
--
ALTER TABLE `option_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key-name-1` (`option_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `product_categories_ibfk_2` (`category_id`);

--
-- Indexes for table `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key-2-1` (`product_id`),
  ADD KEY `key-2-2` (`option_id`);

--
-- Indexes for table `product_option_combinations`
--
ALTER TABLE `product_option_combinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key-1-1` (`product_id`),
  ADD KEY `key-1-2` (`first_option_id`),
  ADD KEY `key-1-3` (`first_option_value_id`),
  ADD KEY `key-1-4` (`second_option_id`),
  ADD KEY `key-1-5` (`second_option_value_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `option_values`
--
ALTER TABLE `option_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_options`
--
ALTER TABLE `product_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `product_option_combinations`
--
ALTER TABLE `product_option_combinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `option_values`
--
ALTER TABLE `option_values`
  ADD CONSTRAINT `key-name-1` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`);

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_options`
--
ALTER TABLE `product_options`
  ADD CONSTRAINT `key-2-2` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_option_combinations`
--
ALTER TABLE `product_option_combinations`
  ADD CONSTRAINT `key-1-2` FOREIGN KEY (`first_option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `key-1-3` FOREIGN KEY (`first_option_value_id`) REFERENCES `option_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `key-1-4` FOREIGN KEY (`second_option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `key-1-5` FOREIGN KEY (`second_option_value_id`) REFERENCES `option_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
