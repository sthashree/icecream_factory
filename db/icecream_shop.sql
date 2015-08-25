-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2015 at 04:22 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `icecream_shop`
--
CREATE DATABASE IF NOT EXISTS `icecream_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `icecream_shop`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` float NOT NULL,
  `ordered_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `created_user` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

DROP TABLE IF EXISTS `cart_product`;
CREATE TABLE IF NOT EXISTS `cart_product` (
  `cart_product_id` int(10) NOT NULL AUTO_INCREMENT,
  `cart_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_type_id` int(10) NOT NULL,
  `flavour_id` int(10) NOT NULL,
  `no_of_scoop` int(10) NOT NULL,
  `actual_price` float NOT NULL,
  `final_price` float NOT NULL,
  `modified_user` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `discount` float NOT NULL,
  `discount_amount` int(11) NOT NULL,
  PRIMARY KEY (`cart_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
  `discount_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `discount` float NOT NULL,
  PRIMARY KEY (`discount_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `product_id`, `discount`) VALUES
(1, 2, 10),
(2, 3, 25);

-- --------------------------------------------------------

--
-- Table structure for table `flavours`
--

DROP TABLE IF EXISTS `flavours`;
CREATE TABLE IF NOT EXISTS `flavours` (
  `flavour_id` int(10) NOT NULL AUTO_INCREMENT,
  `flavour_name` varchar(20) NOT NULL,
  `modified_user` int(10) NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`flavour_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `flavours`
--

INSERT INTO `flavours` (`flavour_id`, `flavour_name`, `modified_user`, `modified_date`) VALUES
(1, 'strawberry', 0, '2015-08-23 14:29:02'),
(2, 'vanilla', 0, '2015-08-23 14:29:15'),
(3, 'chocolate', 0, '2015-08-23 14:29:15'),
(4, 'vanilla-strawberry', 0, '2015-08-23 14:29:33'),
(5, 'vanilla-chocolate', 0, '2015-08-23 14:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(20) NOT NULL,
  `max_scoop` int(2) NOT NULL,
  `flavour_max` int(10) NOT NULL,
  `discount` tinyint(1) NOT NULL,
  `modified_user` int(10) NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `max_scoop`, `flavour_max`, `discount`, `modified_user`, `modified_date`) VALUES
(1, 'Icecream Cone', 2, 1, 0, 0, '2015-08-23 14:10:31'),
(2, 'Milkshakes', 0, 1, 1, 0, '2015-08-23 19:43:12'),
(3, 'Float', 1000, 1000, 1, 0, '2015-08-23 19:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

DROP TABLE IF EXISTS `product_price`;
CREATE TABLE IF NOT EXISTS `product_price` (
  `price_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `type_id` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `modified_user` int(10) NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`price_id`, `product_id`, `type_id`, `price`, `modified_user`, `modified_date`) VALUES
(1, 1, 2, 110, 0, '2015-08-23 20:22:53'),
(2, 1, 3, 105, 0, '2015-08-23 20:24:48'),
(3, 1, 4, 110, 0, '2015-08-23 20:24:48'),
(4, 2, 5, 50, 0, '2015-08-23 20:24:48'),
(5, 2, 6, 30, 0, '2015-08-23 20:24:48'),
(6, 2, 7, 110, 0, '2015-08-23 20:24:48'),
(7, 3, 8, 110, 0, '2015-08-23 20:24:48'),
(8, 3, 8, 50, 0, '2015-08-23 20:24:48'),
(9, 3, 9, 120, 0, '2015-08-23 20:24:48'),
(10, 3, 10, 210, 0, '2015-08-23 20:24:48'),
(11, 1, 1, 100, 0, '2015-08-23 20:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

DROP TABLE IF EXISTS `product_type`;
CREATE TABLE IF NOT EXISTS `product_type` (
  `type_id` int(10) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) NOT NULL,
  `product_id` int(10) NOT NULL,
  `modified_user` int(10) NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`type_id`, `type_name`, `product_id`, `modified_user`, `modified_date`) VALUES
(1, 'Cone type 1', 1, 0, '2015-08-23 14:32:46'),
(2, 'Cone type 2', 1, 0, '2015-08-23 14:32:46'),
(3, 'Cone type 3', 0, 0, '2015-08-23 14:33:10'),
(4, 'Cone type 4', 1, 0, '2015-08-23 14:33:10'),
(5, 'Skim', 2, 0, '2015-08-23 16:41:55'),
(6, 'Whole', 2, 0, '2015-08-23 16:44:01'),
(7, '2% Milk', 2, 0, '2015-08-23 16:42:29'),
(8, 'Soda 1', 3, 0, '2015-08-23 16:43:09'),
(9, 'Soda2', 3, 0, '2015-08-23 16:43:09'),
(10, 'Soda3', 3, 0, '2015-08-23 16:43:27'),
(11, 'Soda 4', 3, 0, '2015-08-23 16:43:27');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
