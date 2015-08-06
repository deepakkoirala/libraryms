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

--
-- Dumping data for table `members_info`
--

INSERT INTO `members_info` (`id`, `fname`, `lname`, `lib_id`, `mobile_number`, `email`, `password`, `temporary_address`, `permanent_address`, `father_name`, `batch`, `category`, `department`, `member_image`) VALUES
(0, 'Bibek', 'Bhandari', '12067', '9849483241', 'adoniskorpion@gmail.com', 'mmm', 'Kathmandu', 'Dhading', 'Bidur Bahadur Bhandari', 2009, 'Student', 'ICT', 'Bibek_Bhandari__28-08-2014_1409237706.jpg'),
(0, 'Ashish ', 'prasain', '17607', '9841957000', 'duet_ashish@yahoo.com', 'Ashish ', 'kalanki', 'chitwan', 'Rudra prasad prasain', 2009, 'Student', 'ICT', 'Ashish _prasain__28-08-2014_1409237699.jpg'),
(0, 'Saroj', 'Upreti', '22624', '9841797049', 'eevanupreti@gmail.com', 'upreti', 'Kathmandu', 'Gongabu', 'Prakash Upreti', 2009, 'Student', 'ICT', 'Saroj_Upreti_22624_25-08-2014_1408965953.png'),
(0, 'Ajusha', 'Rizal', '22715', '9841486844', 'ajusha_16@hotmail.com', 'secret', 'Kathmandu', 'Kathmandu', 'Keshav Rizal', 2009, 'Student', 'ICT', 'Ajusha_Rizal__28-08-2014_1409237668.jpg'),
(0, 'Sandeep', 'Lamichhane', '23189', '9849166313', 'sanzip1721@hotmail.com', 'Sandeep', 'Kapan', 'Kapan', '', 2009, 'Student', 'ICT', 'Sandeep_Lamichhane__28-08-2014_1409237866.jpg'),
(0, 'Abinesh', 'Koirala', '23412', '9841388889', 'abine_koirala@yahoo.com', 'Abinesh', 'Bhaktapur', 'Biratnagar', 'Roshan Koirala', 2009, 'Student', 'ICT', 'Abinesh_Koirala__29-08-2014_1409303974.jpg'),
(0, 'Sujan', 'Thapa', '24223', '9849950086', 'thapasujan5@gmail.com', 'mmm', 'Kathmandu', 'Dhading, Nepal', 'Atma Ram Thapa', 2009, 'Student', 'ICT', 'Sujan_Thapa__28-08-2014_1409237804.jpg'),
(0, 'Upama', 'Acharya', '29101', '9841009743', 'upamaacharya@gmail.com', 'mmm', 'Chapagaun', 'Lalitpur', 'Niranjan Acharya', 2009, 'Student', 'ICT', 'Upama_Acharya__28-08-2014_1409237752.jpg'),
(0, 'Trilok', 'Karki', '30892', '9841792681', 'karki_trilok@yahoo.com', 'Trilok', 'Kathmandu', 'Dhading, Nepal', 'Bharat Kumar Karki', 2009, 'Student', 'ICT', 'Trilok_Karki__29-08-2014_1409303907.jpg'),
(0, 'Suraj', 'Mahat', '31728', '9851145401', 'mahat_sm@hotmail.com', 'suraj', 'Kupondole', 'Kathmandu', '', 2009, 'Student', 'ICT', 'Suraj_Mahat__28-08-2014_1409237738.jpg'),
(0, 'Dipa', 'Thapa', '47010', '+61410594661', 'dipat23@yahoo.com', 'deepa23', 'NSW, Australia', 'Dhading, Nepal', 'Atma Ram Thapa', 2009, 'Student', 'ICT', 'Dipa_Thapa__28-08-2014_1409237713.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
