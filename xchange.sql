-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2017 at 08:08 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(12) NOT NULL,
  `email` varchar(25) NOT NULL,
  `USD` int(11) NOT NULL,
  `EUR` int(11) NOT NULL,
  `GBP` int(11) NOT NULL,
  `KES` int(11) NOT NULL,
  `UGS` int(11) NOT NULL,
  `TZS` int(11) NOT NULL,
  `BTC` int(11) NOT NULL,
  `ETH` int(11) NOT NULL,
  `LTC` int(11) NOT NULL,
  `PPC` int(11) NOT NULL,
  `DOGE` int(11) NOT NULL,
  `account_status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(9) NOT NULL,
  `order_type` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `currency_type` varchar(25) NOT NULL,
  `amount` int(9) NOT NULL,
  `rate` int(9) NOT NULL,
  `increment_rate_by` int(11) NOT NULL,
  `requested_currency` varchar(3) NOT NULL,
  `charges` int(9) NOT NULL,
  `order_status` int(1) NOT NULL,
  `requested_amount` int(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pool`
--

CREATE TABLE `pool` (
  `date` int(11) NOT NULL,
  `total_transactions` int(11) NOT NULL,
  `total_users` int(11) NOT NULL,
  `total_orders` int(11) NOT NULL,
  `total_charges` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(9) NOT NULL,
  `date` date NOT NULL,
  `transaction_type` varchar(25) NOT NULL,
  `amount` int(9) NOT NULL,
  `currency_type` varchar(25) NOT NULL,
  `to/from` varchar(128) NOT NULL,
  `charges` int(9) NOT NULL,
  `transaction_status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(9) NOT NULL,
  `username` varchar(25) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(25) NOT NULL,
  `phone` int(25) NOT NULL,
  `address` int(9) NOT NULL,
  `postal_code` int(9) NOT NULL,
  `birth_year` int(4) NOT NULL,
  `pin_code` int(6) NOT NULL,
  `user_status` int(1) NOT NULL,
  `region_code` int(128) NOT NULL,
  `user_type` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `email` varchar(25) NOT NULL,
  `question_id` int(1) NOT NULL,
  `answer` varchar(128) NOT NULL,
  `document` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
