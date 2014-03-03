-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2014 at 05:45 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `linkoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE IF NOT EXISTS `urls` (
  `url_id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(500) NOT NULL,
  `code` varchar(500) NOT NULL,
  PRIMARY KEY (`url_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`url_id`, `url`, `code`) VALUES
(1, 'http://linkedin.com/pk/kaamranahmed/', '9iWbId'),
(2, 'http://www.google.com', '3TZ2Ue'),
(3, 'http://www.google.com', 'LoOxl4'),
(4, 'http://www.googe.com', 'L6DFuT'),
(5, 'http://www.google.com', 'HgTf8q'),
(6, 'http://www.google.com', 'iAP4O6'),
(7, 'http://www.google.com', 'SW6x4p'),
(8, 'http://www.google.com', 'vkn08S'),
(9, 'http://www.goog.ecom', 'WjqHex'),
(10, 'jasdf://ss.adfo', 'eWJD4c'),
(11, 'http://www.google.com', '7WbIAJ'),
(12, 'http://www.google.com/', 'ZVGBpe'),
(13, 'http://www.google.com', 'yBXcOn'),
(14, 'http://www.google.com', 'FEquol'),
(15, 'http://www.google.com', 'YeGtyl'),
(16, 'http://www.google.com', 'rqDFTw');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
