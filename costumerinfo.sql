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
-- Table structure for table `costumerinfo`
--

CREATE TABLE `costumerinfo` (
  `Costumer_no` varchar(4) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Age` int(2) NOT NULL,
  `Barangay` varchar(30) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Province` varchar(20) NOT NULL,
  `Email_Address` varchar(40) NOT NULL,
  `Contact_no` varchar(12) NOT NULL,
  `Telephone_no` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `costumerinfo`
--

INSERT INTO `costumerinfo` (`Costumer_no`, `FirstName`, `LastName`, `Age`, `Barangay`, `City`, `Province`, `Email_Address`, `Contact_no`, `Telephone_no`) VALUES
('0101', 'Kris', 'Diaz', 10, 'Calauag', 'Davao City', 'Masbate', 'angelinediaz90@gmail.com', '09678598667', '234567987'),
('0102', 'Paul', 'Despuig', 18, 'Carolina', 'Iriga', 'Masbate', 'angelinediaz90@gmail.com', '09396275998', '234567890');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
