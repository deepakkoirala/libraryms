-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2014 at 11:43 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `books_info`
--

INSERT INTO `books_info` (`flag`, `accession_no`, `call_no`, `authors`, `title`, `publisher`, `published_date`, `published_place`, `edition`, `price`, `pages`, `volume`, `source`, `bill_no`, `subject`, `category`, `type`, `remark`, `date_added`, `cover`, `status`) VALUES
(1, 1, 'JavaBooks', 'Dietel and Dietel', 'Java: How to Program', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Reference', '', 'Friday, 29th August 2014, 03:23:57 PM', '1_JavaBooks_29-08-2014_1409305137.jpg', ''),
(1, 2, 'JavaBooks', 'Dietel and Dietel', 'Java: How to Program', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:23:57 PM', '2_JavaBooks_29-08-2014_1409305137.jpg', ''),
(1, 3, 'JavaBooks', 'Dietel and Dietel', 'Java: How to Program', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:23:57 PM', '3_JavaBooks_29-08-2014_1409305137.jpg', ''),
(1, 4, 'JavaBooks', 'Dietel and Dietel', 'Java: How to Program', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:23:58 PM', '4_JavaBooks_29-08-2014_1409305138.jpg', ''),
(1, 5, 'JavaBooks', 'Dietel and Dietel', 'Java: How to Program', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:23:58 PM', '5_JavaBooks_29-08-2014_1409305138.jpg', ''),
(1, 6, 'JavaBooks', 'Dietel and Dietel', 'Java: How to Program', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:23:58 PM', '6_JavaBooks_29-08-2014_1409305138.jpg', ''),
(1, 7, 'JavaBooks', 'Dietel and Dietel', 'Java: How to Program', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:23:58 PM', '7_JavaBooks_29-08-2014_1409305138.jpg', ''),
(1, 8, 'JavaBooks', 'Dietel and Dietel', 'Java: How to Program', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:23:59 PM', '8_JavaBooks_29-08-2014_1409305139.jpg', ''),
(1, 9, 'JavaBooks', 'Dietel and Dietel', 'Java: How to Program', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:23:59 PM', '9_JavaBooks_29-08-2014_1409305139.jpg', ''),
(1, 10, 'JavaBooks', 'Dietel and Dietel', 'Java: How to Program', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:23:59 PM', '10_JavaBooks_29-08-2014_1409305139.jpg', ''),
(1, 11, 'ACA', 'Kacsuk', 'Advanced Computer Architectures', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Reference', '', 'Friday, 29th August 2014, 03:24:20 PM', '11_ACA_29-08-2014_1409305160.jpg', ''),
(1, 12, 'ACA', 'Kacsuk', 'Advanced Computer Architectures', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:24:20 PM', '12_ACA_29-08-2014_1409305160.jpg', ''),
(1, 13, 'ACA', 'Kacsuk', 'Advanced Computer Architectures', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:24:21 PM', '13_ACA_29-08-2014_1409305161.jpg', ''),
(1, 14, 'ACA', 'Kacsuk', 'Advanced Computer Architectures', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:24:21 PM', '14_ACA_29-08-2014_1409305161.jpg', ''),
(1, 15, 'ACA', 'Kacsuk', 'Advanced Computer Architectures', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:24:21 PM', '15_ACA_29-08-2014_1409305161.jpg', ''),
(1, 16, 'ACA', 'Kacsuk', 'Advanced Computer Architectures', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:24:22 PM', '16_ACA_29-08-2014_1409305162.jpg', ''),
(1, 17, 'ACA', 'Kacsuk', 'Advanced Computer Architectures', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:24:22 PM', '17_ACA_29-08-2014_1409305162.jpg', ''),
(1, 18, 'ACA', 'Kacsuk', 'Advanced Computer Architectures', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:24:22 PM', '18_ACA_29-08-2014_1409305162.jpg', ''),
(1, 19, 'ACA', 'Kacsuk', 'Advanced Computer Architectures', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:24:22 PM', '19_ACA_29-08-2014_1409305162.jpg', ''),
(1, 20, 'ACA', 'Kacsuk', 'Advanced Computer Architectures', 'PHI', '', '', '2005', 0.00, 0, '', 'Purchase', 0, 'Computer Engneering', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:24:22 PM', '20_ACA_29-08-2014_1409305162.jpg', ''),
(1, 21, 'EPP', 'Rajendra Prasad Adhikari', 'Engineerng Professional Practice in Nepal', 'Pashupati Publishing House', '', '', '2010', 0.00, 0, '', 'Purchase', 0, 'Engineering Professional Practice', 'Engineering', 'Reference', '', 'Friday, 29th August 2014, 03:25:44 PM', '21_EPP_29-08-2014_1409305244.jpg', ''),
(1, 22, 'EPP', 'Rajendra Prasad Adhikari', 'Engineerng Professional Practice in Nepal', 'Pashupati Publishing House', '', '', '2010', 0.00, 0, '', 'Purchase', 0, 'Engineering Professional Practice', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:25:44 PM', '22_EPP_29-08-2014_1409305244.jpg', ''),
(1, 23, 'EPP', 'Rajendra Prasad Adhikari', 'Engineerng Professional Practice in Nepal', 'Pashupati Publishing House', '', '', '2010', 0.00, 0, '', 'Purchase', 0, 'Engineering Professional Practice', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:25:45 PM', '23_EPP_29-08-2014_1409305245.jpg', ''),
(1, 24, 'EPP', 'Rajendra Prasad Adhikari', 'Engineerng Professional Practice in Nepal', 'Pashupati Publishing House', '', '', '2010', 0.00, 0, '', 'Purchase', 0, 'Engineering Professional Practice', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:25:45 PM', '24_EPP_29-08-2014_1409305245.jpg', ''),
(1, 25, 'EPP', 'Rajendra Prasad Adhikari', 'Engineerng Professional Practice in Nepal', 'Pashupati Publishing House', '', '', '2010', 0.00, 0, '', 'Purchase', 0, 'Engineering Professional Practice', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:25:45 PM', '25_EPP_29-08-2014_1409305245.jpg', ''),
(1, 26, 'EPP', 'Rajendra Prasad Adhikari', 'Engineerng Professional Practice in Nepal', 'Pashupati Publishing House', '', '', '2010', 0.00, 0, '', 'Purchase', 0, 'Engineering Professional Practice', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:25:45 PM', '26_EPP_29-08-2014_1409305245.jpg', ''),
(1, 27, 'EPP', 'Rajendra Prasad Adhikari', 'Engineerng Professional Practice in Nepal', 'Pashupati Publishing House', '', '', '2010', 0.00, 0, '', 'Purchase', 0, 'Engineering Professional Practice', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:25:45 PM', '27_EPP_29-08-2014_1409305245.jpg', ''),
(1, 28, 'EPP', 'Rajendra Prasad Adhikari', 'Engineerng Professional Practice in Nepal', 'Pashupati Publishing House', '', '', '2010', 0.00, 0, '', 'Purchase', 0, 'Engineering Professional Practice', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:25:46 PM', '28_EPP_29-08-2014_1409305246.jpg', ''),
(1, 29, 'EPP', 'Rajendra Prasad Adhikari', 'Engineerng Professional Practice in Nepal', 'Pashupati Publishing House', '', '', '2010', 0.00, 0, '', 'Purchase', 0, 'Engineering Professional Practice', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:25:46 PM', '29_EPP_29-08-2014_1409305246.jpg', ''),
(1, 30, 'EPP', 'Rajendra Prasad Adhikari', 'Engineerng Professional Practice in Nepal', 'Pashupati Publishing House', '', '', '2010', 0.00, 0, '', 'Purchase', 0, 'Engineering Professional Practice', 'Engineering', 'Book', '', 'Friday, 29th August 2014, 03:25:46 PM', '30_EPP_29-08-2014_1409305246.jpg', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
