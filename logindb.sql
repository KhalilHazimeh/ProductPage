-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2023 at 08:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `phone_number`, `email`, `address`, `total_price`, `order_date`) VALUES
(4, 'Khalil Hazimeh', '70420961', 'khalkhool1999@gmail.com', 'Hariri Building Shohada Square - Zaroob Njasa - Hariri Buidling - 7th floor', 24059, '2023-09-26 14:38:07'),
(5, 'Rami Mohsen', '03239957', 'rami@gmail.com', 'Hariri Building Shohada Square - Zaroob Njasa - Hariri Buidling - 7th floor', 957, '2023-09-26 14:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option1_id` int(11) NOT NULL,
  `option2_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_product_id`, `order_id`, `product_id`, `option1_id`, `option2_id`, `quantity`, `price`) VALUES
(4, 4, 1, 18, 8, 4, 4964.00),
(5, 4, 1, 14, 5, 1, 1241.00),
(6, 4, 2, 17, 5, 2, 638.00),
(7, 4, 2, 14, 9, 2, 638.00),
(8, 4, 34, 15, 0, 1, 410.00),
(9, 5, 2, 19, 5, 1, 319.00),
(10, 5, 2, 17, 5, 1, 319.00),
(11, 5, 2, 14, 9, 1, 319.00);

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
(1, 'Khalil Hazimeh', 1241, 121, 'images\\BsPIf08zG9TFDvJkgT75QEUHpDiq1CGxMxdv1ujM.jpg', 1),
(2, 'Lapreva Boduy Bilder', 319, 121, 'images\\cbQSvFiAo9zMDGSZVZaeVBXnufColeuYiRzMtwce.jpg', 2),
(3, 'Mr. Lilac', 319, 312, 'images\\nwGM1Rzm9Q8rtxuSEi0buHcjfBmhz077VyzROqoC.png', 8),
(34, 'Mass Gainer', 410, 436, 'images\\nwGM1Rzm9Q8rtxuSEi0buHcjfBmhz077VyzROqoC.png', 8);

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
(3, 2),
(34, 1),
(34, 2),
(34, 3),
(35, 2),
(35, 3),
(36, 1),
(37, 1),
(37, 2);

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
(136, 2, 1),
(137, 2, 2),
(148, 3, 1),
(152, 1, 1),
(153, 1, 2),
(158, 34, 1);

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
(113, 2, 1, 19, 2, 5),
(114, 2, 1, 17, 2, 5),
(115, 2, 1, 14, 2, 9),
(116, 2, 1, 28, 2, 5),
(141, 1, 1, 18, 2, 8),
(142, 1, 1, 14, 2, 5),
(143, 1, 1, 29, 2, 5),
(148, 34, 1, 15, NULL, NULL);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_product_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `product_options`
--
ALTER TABLE `product_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `product_option_combinations`
--
ALTER TABLE `product_option_combinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

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
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

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
