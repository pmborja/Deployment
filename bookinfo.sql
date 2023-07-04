-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2018 at 06:59 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book information`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookinfo`
--

CREATE TABLE `bookinfo` (
  `Book_no` int(3) NOT NULL,
  `Title_of_the_Book` varchar(40) NOT NULL,
  `Authors_Name` varchar(40) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `Genre` varchar(40) NOT NULL,
  `Types_of_Book` varchar(40) NOT NULL,
  `Price` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookinfo`
--

INSERT INTO `bookinfo` (`Book_no`, `Title_of_the_Book`, `Authors_Name`, `Country`, `Genre`, `Types_of_Book`, `Price`) VALUES
(101, 'Milk and Honey', 'Rupi Kaur', 'canada', 'Science fiction', 'Poetry book', '$15.99'),
(102, 'Everyday', 'David Lavithan', 'canada', 'drama', 'Science book', '$10.90');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
