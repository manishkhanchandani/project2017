-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2017 at 04:19 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alaw`
--

-- --------------------------------------------------------

--
-- Table structure for table `baby_bar_nodes`
--

CREATE TABLE `baby_bar_nodes` (
  `node_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `node_type_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext,
  `node_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sorting` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `baby_bar_nodes`
--

INSERT INTO `baby_bar_nodes` (`node_id`, `subject_id`, `node_type_id`, `title`, `description`, `node_created_date`, `sorting`, `parent_id`) VALUES
(1, 1, 1, 'Does UCC apply?', 'Under contract law UCC Article 2 controls contracts for the sale of GOODS. Goods are movable things at the time of identification to the contract.\r\n\r\nHere the agreement was for a sale of goods because ....\r\nHere the agreement was not for a sale of goods because ...\r\n\r\nTherefore, the UCC does determine the rights of parties.\r\nTherefore, the Common Law determine the rights of parties.', '2017-10-27 02:01:50', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baby_bar_nodes`
--
ALTER TABLE `baby_bar_nodes`
  ADD PRIMARY KEY (`node_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baby_bar_nodes`
--
ALTER TABLE `baby_bar_nodes`
  MODIFY `node_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
