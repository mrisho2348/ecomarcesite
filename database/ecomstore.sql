-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 07:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(9, 13, 0, 1),
(10, 13, 0, 1),
(11, 13, 0, 21),
(12, 13, 0, 21),
(13, 13, 0, 21),
(14, 13, 14, 1),
(15, 13, 14, 1),
(16, 13, 10, 1),
(17, 13, 10, 1),
(18, 13, 10, 1),
(19, 13, 10, 1),
(20, 13, 10, 1),
(21, 13, 10, 1),
(22, 13, 10, 1),
(23, 13, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_slug` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `cat_slug`) VALUES
(1, 'Laptops', 'laptops'),
(2, 'Desktop PC', 'desktop-pc'),
(3, 'Tablets', 'tablets'),
(4, 'Smart Phones', '');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `sales_id`, `product_id`, `quantity`) VALUES
(14, 9, 11, 2),
(15, 9, 13, 5),
(16, 9, 3, 2),
(17, 9, 1, 3),
(18, 10, 13, 3),
(19, 10, 2, 4),
(20, 10, 19, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_price` double NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `date_view` date NOT NULL,
  `counter` int(11) NOT NULL,
  `description` text NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `additional_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `product_price`, `product_image`, `date_view`, `counter`, `description`, `stock_quantity`, `additional_info`) VALUES
(1, 1, 'DELL Inspiron 15 7000 15.6', 899, 'dell-inspiron-15-7000-15-6.jpg', '2018-07-09', 2, '', 400, ''),
(2, 1, 'MICROSOFT Surface Pro 4 & Typecover - 128 GB', 799, 'microsoft-surface-pro-4-typecover-128-gb.jpg', '2018-05-10', 3, '', 400, ''),
(3, 1, 'DELL Inspiron 15 5000 15.6', 599, 'dell-inspiron-15-5000-15-6.jpg', '2018-05-12', 1, '', 400, ''),
(4, 1, 'LENOVO Ideapad 320s-14IKB 14\" Laptop - Grey', 399, 'lenovo-ideapad-320s-14ikb-14-laptop-grey.jpg', '2018-05-10', 3, '', 400, ''),
(5, 3, 'APPLE 9.7\" iPad - 32 GB, Gold', 339, 'apple-9-7-ipad-32-gb-gold.jpg', '2018-07-09', 3, '', 400, ''),
(6, 1, 'DELL Inspiron 15 5000 15', 449.99, 'dell-inspiron-15-5000-15.jpg', '0000-00-00', 0, '', 400, ''),
(7, 3, 'APPLE 10.5\" iPad Pro - 64 GB, Space Grey (2017)', 619, 'apple-10-5-ipad-pro-64-gb-space-grey-2017.jpg', '0000-00-00', 0, '', 400, ''),
(8, 1, 'ASUS Transformer Mini T102HA 10.1\" 2 in 1 - Silver', 549.99, 'asus-transformer-mini-t102ha-10-1-2-1-silver.jpg', '0000-00-00', 0, '', 400, ''),
(9, 2, 'PC SPECIALIST Vortex Core Lite Gaming PC', 599.99, 'pc-specialist-vortex-core-lite-gaming-pc.jpg', '0000-00-00', 0, '', 400, ''),
(10, 2, 'DELL Inspiron 5675 Gaming PC - Recon Blue', 599.99, 'dell-inspiron-5675-gaming-pc-recon-blue.jpg', '2018-05-10', 1, '', 400, ''),
(11, 2, 'HP Barebones OMEN X 900-099nn Gaming PC', 489.98, 'hp-barebones-omen-x-900-099nn-gaming-pc.jpg', '2018-05-12', 1, '', 400, ''),
(12, 2, 'ACER Aspire GX-781 Gaming PC', 749.99, 'acer-aspire-gx-781-gaming-pc.jpg', '2018-05-12', 3, '', 400, ''),
(13, 2, 'HP Pavilion Power 580-015na Gaming PC', 799.99, 'hp-pavilion-power-580-015na-gaming-pc.jpg', '2018-05-12', 1, '', 400, ''),
(14, 2, 'LENOVO Legion Y520 Gaming PC', 899.99, 'lenovo-legion-y520-gaming-pc.jpg', '2018-05-10', 13, '', 400, ''),
(15, 2, 'PC SPECIALIST Vortex Minerva XT-R Gaming PC', 999.99, 'pc-specialist-vortex-minerva-xt-r-gaming-pc.jpg', '2018-07-09', 1, '', 400, ''),
(16, 2, 'PC SPECIALIST Vortex Core II Gaming PC', 649.99, 'pc-specialist-vortex-core-ii-gaming-pc.jpg', '2018-05-10', 2, '', 400, ''),
(17, 3, 'AMAZON Fire 7 Tablet with Alexa (2017) - 8 GB, Black', 49.99, 'amazon-fire-7-tablet-alexa-2017-8-gb-black.jpg', '2018-05-12', 1, '', 400, ''),
(18, 3, 'AMAZON Fire HD 8 Tablet with Alexa (2017) - 16 GB, Black', 79.99, 'amazon-fire-hd-8-tablet-alexa-2017-16-gb-black.jpg', '2018-05-12', 2, '', 400, ''),
(19, 3, 'AMAZON Fire HD 8 Tablet with Alexa (2017) - 32 GB, Black', 99.99, 'amazon-fire-hd-8-tablet-alexa-2017-32-gb-black.jpg', '2018-05-10', 1, '', 400, ''),
(20, 3, 'APPLE 9.7\" iPad - 32 GB, Space Grey', 339, 'apple-9-7-ipad-32-gb-space-grey.jpg', '2018-05-12', 1, '', 400, ''),
(27, 1, 'Dell XPS 15 9560', 1599, 'dell-xps-15-9560.jpg', '2018-07-09', 9, '', 400, ''),
(28, 4, 'Samsung Note 8', 829, 'samsung-note-8.jpg', '0000-00-00', 0, '', 400, ''),
(29, 4, 'Samsung Galaxy S9+ [128 GB]', 889.99, 'samsung-galaxy-s9-128-gb.jpg', '2018-07-09', 3, '', 400, ''),
(32, 0, '', 0, '', '0000-00-00', 0, '', 400, ''),
(33, 0, '', 0, '', '0000-00-00', 0, '', 400, ''),
(34, 0, '', 0, '', '0000-00-00', 0, '', 400, ''),
(35, 4, 'AJX Jeans', 23333, '', '0000-00-00', 0, '', 400, ''),
(36, 4, 'AJX Jeans', 23333, 'images/6486610adde39.jpg', '0000-00-00', 0, '', 400, ''),
(37, 0, '', 0, '', '0000-00-00', 0, '', 400, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_name`, `user_email`, `product_id`, `rating`, `review`, `created_at`, `updated_at`) VALUES
(1, 'ss', 'ssgmail@gmail.com', 10, 1, 'degfgfg', '2023-06-12 05:48:45', '2023-06-12 05:48:45'),
(2, 'ss', 'ssgmail@gmail.com', 10, 1, 'degfgfg', '2023-06-12 05:50:13', '2023-06-12 05:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_id` varchar(50) NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `pay_id`, `sales_date`) VALUES
(9, 9, 'PAY-1RT494832H294925RLLZ7TZA', '2018-05-10'),
(10, 9, 'PAY-21700797GV667562HLLZ7ZVY', '2018-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contact_info` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `address`, `contact_info`, `photo`, `created_on`) VALUES
(1, 'admin@admin.com', '$2y$10$0SHFfoWzz8WZpdu9Qw//E.tWamILbiNCX7bqhy3od0gvK5.kSJ8N2', 'Code', 'Projects', '', '', 'thanos1.jpg', '2018-05-01'),
(9, 'harry@den.com', '$2y$10$Oongyx.Rv0Y/vbHGOxywl.qf18bXFiZOcEaI4ZpRRLzFNGKAhObSC', 'Harry', 'Den', 'Silay City, Negros Occidental', '09092735719', 'male2.png', '2018-05-09'),
(12, 'christine@gmail.com', '$2y$10$ozW4c8r313YiBsf7HD7m6egZwpvoE983IHfZsPRxrO1hWXfPRpxHO', 'Christine', 'becker', 'demo', '7542214500', 'female3.jpg', '2018-07-09'),
(13, 'mrisho@gmail.com', '$2y$10$CaAbtwAgZYbzXT/VGfbg8.NYqE0NnMjUzoMip3n9gTpIAMMpEaiSC', 'mrisho', 'hamisi', 'chukwani', '245556566', 'photos/carousel-2.jpg', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
