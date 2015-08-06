-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2014 at 03:23 PM
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
-- Table structure for table `books_info`
--

CREATE TABLE IF NOT EXISTS `books_info` (
  `flag` tinyint(1) NOT NULL,
  `accession_no` int(11) NOT NULL AUTO_INCREMENT,
  `call_no` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `published_date` varchar(255) DEFAULT NULL,
  `published_place` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `price` float(255,2) DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `volume` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `bill_no` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `date_added` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`accession_no`),
  UNIQUE KEY `accession_no` (`accession_no`),
  UNIQUE KEY `call_no` (`call_no`,`accession_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `constants`
--

CREATE TABLE IF NOT EXISTS `constants` (
  `depid` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(255) NOT NULL,
  `numbooks` int(11) NOT NULL,
  PRIMARY KEY (`depid`),
  UNIQUE KEY `department` (`department`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `issued`
--

CREATE TABLE IF NOT EXISTS `issued` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `accession_no` varchar(255) NOT NULL,
  `call_no` varchar(255) NOT NULL,
  `lib_id` varchar(255) NOT NULL,
  `issued_date` varchar(255) NOT NULL,
  `due_date` varchar(255) NOT NULL,
  `issued_by` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lib_id` (`lib_id`,`call_no`),
  KEY `accession_no` (`accession_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_added` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `staff` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `date_added`, `action`, `item`, `description`, `staff`, `file`) VALUES
(1, 'Wednesday, 27th August 2014, 07:05:38 PM', 'Login', 'thapasujan5@gmail.com', 'Staff:Sujan Thapa Logged in Successfully ', 'thapasujan5@gmail.com', 'source/logs/logins/Logins@Wednesday, 27th August 2014.txt'),
(2, 'Wednesday, 27th August 2014, 07:05:38 PM', 'Login', 'thapasujan5@gmail.com', 'Staff:Sujan Thapa Logged in Successfully ', 'thapasujan5@gmail.com', 'source/logs/staff/thapasujan5@gmail.com@Wednesday, 27th August 2014.txt'),
(3, 'Wednesday, 27th August 2014, 07:05:38 PM', 'Login', 'thapasujan5@gmail.com', 'Staff:Sujan Thapa Logged in Successfully ', 'thapasujan5@gmail.com', 'source/logs/system/System@Wednesday, 27th August 2014.txt'),
(4, 'Wednesday, 27th August 2014, 07:05:38 PM', 'Login', 'thapasujan5@gmail.com', 'Staff:Sujan Thapa Logged in Successfully ', 'thapasujan5@gmail.com', 'source/logs/admin/thapasujan5@gmail.com@Wednesday, 27th August 2014.txt'),
(5, 'Wednesday, 27th August 2014, 07:06:55 PM', 'Update_StaffPhoto', 'thapasujan5@gmail.com', 'Update Success:NewPhoto:Sujan_Thapa_thapasujan5@gmail.com_27-08-2014_1409145715.jpg', 'thapasujan5@gmail.com', 'source/logs/staff/thapasujan5@gmail.com@Wednesday, 27th August 2014.txt'),
(6, 'Wednesday, 27th August 2014, 07:06:56 PM', 'Update_StaffPhoto', 'thapasujan5@gmail.com', 'Update Success:NewPhoto:Sujan_Thapa_thapasujan5@gmail.com_27-08-2014_1409145715.jpg', 'thapasujan5@gmail.com', 'source/logs/system/System@Wednesday, 27th August 2014.txt');

-- --------------------------------------------------------

--
-- Table structure for table `lostbooks`
--

CREATE TABLE IF NOT EXISTS `lostbooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book` varchar(255) NOT NULL,
  `member` varchar(255) NOT NULL,
  `date_reported` varchar(255) NOT NULL,
  `staff` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `fine_amount` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members_info`
--

CREATE TABLE IF NOT EXISTS `members_info` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `lib_id` varchar(255) NOT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `temporary_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `batch` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `member_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lib_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobile_number` (`mobile_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('Sujan', 'Thapa', 'thapasujan5@gmail.com', 'sujan', '9849950086', 'male', 'Kathmandu', 'Dhading', 'Admin', 'Thursday,August  27,2014 7:05PM', 'Sujan_Thapa_thapasujan5@gmail.com_27-08-2014_1409145715.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists_info`
--

CREATE TABLE IF NOT EXISTS `wishlists_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `notify_flag` tinyint(1) NOT NULL,
  `date_created` varchar(255) NOT NULL,
  `seen_status` tinyint(1) DEFAULT NULL,
  `availability` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`title`,`authors`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
