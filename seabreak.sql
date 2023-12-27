-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 10:18 AM
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
-- Database: `seabreak`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `transaction_number` varchar(45) NOT NULL,
  `customer_name` varchar(45) NOT NULL,
  `product_name` varchar(45) NOT NULL,
  `size` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(45) NOT NULL,
  `money_paid` varchar(45) NOT NULL,
  `customer_change` decimal(10,0) DEFAULT 0,
  `order_date` date NOT NULL,
  `emp_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `transaction_number`, `customer_name`, `product_name`, `size`, `quantity`, `price`, `money_paid`, `customer_change`, `order_date`, `emp_name`) VALUES
(76, 'SBRK-1696583901-6687', 'Ace', 'Iced Coffee', 'Small', 3, '75', '1100', 50, '2023-12-04', 'admin'),
(77, 'SBRK-1696583901-6687', 'Ace', 'Iced Coffee', 'Medium', 5, '375', '1100', 50, '2023-12-01', 'admin'),
(78, 'SBRK-1696583901-6687', 'Ace', 'Iced Coffee', 'Large', 6, '600', '1100', 50, '2023-12-18', 'admin'),
(79, 'SBRK-1696583935-3378', 'test', 'Iced Coffee', 'Large', 11, '1100', '2000', 900, '2023-12-24', 'admin'),
(80, 'SBRK-1696658267-9838', 'Ace', 'Black Coffee', 'Small', 1, '50', '200', 150, '2023-12-27', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `amount`, `date`) VALUES
(1, 75, '2023-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `small_price` varchar(45) DEFAULT NULL,
  `medium_price` varchar(45) DEFAULT NULL,
  `large_price` varchar(45) DEFAULT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `small_price`, `medium_price`, `large_price`, `image`) VALUES
(30, 'Black Coffee', '50', '', '100', 'black coffee.jpg'),
(34, 'Iced Coffee', '25', '75', '100', 'iced_coffee-removebg-preview.png'),
(36, 'Sampleeeeeeeeeeeeeeeeeeeeee', '50', '75', '100', 'caramel.png'),
(37, 'Test', '50', '75', '100', 'irish.png');

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `supply_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`supply_id`, `name`, `quantity`) VALUES
(1, 'coffee box', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `emp_name` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `emp_name`, `username`, `password`, `user_type`) VALUES
(6, 'admin', 'admin', 'admin', 'Admin'),
(8, 'Cashier', 'cashier', '111', 'Cashier'),
(9, 'Johan Sudstain', 'bigdaddy', 'bigdaddy', 'Manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`supply_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `supply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
