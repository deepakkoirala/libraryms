-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2014 at 11:44 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `staffs_info`
--

CREATE TABLE IF NOT EXISTS `staffs_info` (
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `temporary_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `date_joined` varchar(255) NOT NULL,
  `staff_image` varchar(255) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffs_info`
--

INSERT INTO `staffs_info` (`fname`, `lname`, `email`, `password`, `phone`, `sex`, `temporary_address`, `permanent_address`, `position`, `date_joined`, `staff_image`) VALUES
('Sujan', 'Thapa', 'thapasujan5@gmail.com', 'sujan', '9849950086', 'male', 'Kathmandu', 'Dhading', 'Admin', 'Wednesday, 27th August 2014, 07:05:29 PM ', 'Sujan_Thapa_thapasujan5@gmail.com_27-08-2014_1409145715.jpg'),
('Upama', 'Acharya', 'upamaacharya@gmail.com', 'upama', '9841009743', 'Female', 'Lalitpur', 'Kathmandu', 'Staff', 'Thursday, 28th August 2014, 08:37:44 PM', 'Upama_Acharya_upamaacharya@gmail.com_28-08-2014_1409237599.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
