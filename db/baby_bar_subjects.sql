-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2017 at 01:56 AM
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
-- Table structure for table `baby_bar_subjects`
--

CREATE TABLE `baby_bar_subjects` (
  `subject_id` int(11) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `subject_year` enum('1L','2L','3L','4L') DEFAULT NULL,
  `is_visible` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `baby_bar_subjects`
--

INSERT INTO `baby_bar_subjects` (`subject_id`, `subject`, `subject_year`, `is_visible`) VALUES
(1, 'Contracts', '1L', 1),
(2, 'UCC', '1L', 1),
(3, 'Torts', '1L', 1),
(4, 'Criminal', '1L', 1),
(5, 'Agency and Partnership', '2L', 1),
(6, 'Criminal Procedure', '2L', 1),
(7, 'Real Property', '2L', 1),
(8, 'Remedies', '2L', 1),
(9, 'Civil Procedure', '3L', 1),
(10, 'Constitutional law', '3L', 1),
(11, 'Corporations', '3L', 1),
(12, 'Evidence', '3L', 1),
(13, 'Administrative Law', '4L', 0),
(14, 'Community Property', '4L', 1),
(15, 'Professional Responsibility', '4L', 1),
(16, 'Trusts', '4L', 1),
(17, 'Wills', '4L', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baby_bar_subjects`
--
ALTER TABLE `baby_bar_subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baby_bar_subjects`
--
ALTER TABLE `baby_bar_subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
