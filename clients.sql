-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 11:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `case_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `client_id` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `case_worker` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `second_client` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `full_name`, `email`, `client_id`, `address`, `phone_number`, `case_worker`, `password`, `second_client`) VALUES
(1, 'Kelvin Williams', 'wkelvin2023@gmail.com', 'C81730', 'No.3 Adams Road Washington D.C', '01516506480', 'John Peters', 'bffa454874273709dbbce1bd5670ed30', ''),
(2, 'onyemaechi yobachukwu', 'onyemaechiyobachukwu@gmail.com', '', 'No.3 Adams Road', '08034839287', 'John', 'bffa454874273709dbbce1bd5670ed30', ''),
(8, 'onyemaechi yobachukwu', 'preccypromail@gmail.com', 'C76769', 'No.3 Adams Road', '08034839287', 'Peter', 'bffa454874273709dbbce1bd5670ed30', ''),
(9, 'UK Immigration Attorney in US', 'p@gmail.com', 'C667940', 'No.3 Adams Street', '08034839287', 'John Peters', 'bffa454874273709dbbce1bd5670ed30', ''),
(13, 'Mary Jones', 'maryp@yahoo.com', 'C1348', 'No. 15 English Street California', '01234837483', 'Mary James', 'bffa454874273709dbbce1bd5670ed30', 'Peter Jones'),
(14, 'Mary Jones', 'maryp123@yahoo.com', 'C6956', 'No. 15 English Street California', '01234837483', 'Mary James', 'bffa454874273709dbbce1bd5670ed30', 'Peter Jones');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
