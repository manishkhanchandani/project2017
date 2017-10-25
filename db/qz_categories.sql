-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2017 at 02:28 PM
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
-- Table structure for table `qz_categories`
--

CREATE TABLE `qz_categories` (
  `cat_id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `qz_categories`
--

INSERT INTO `qz_categories` (`cat_id`, `category`, `parent_id`, `user_id`) VALUES
(1, 'Law', 0, 1),
(2, 'First Year', 1, 1),
(3, 'Contracts', 2, 1),
(4, 'Criminal Law', 2, 1),
(5, 'Torts Law', 2, 1),
(6, 'Web Development', 0, 1),
(7, 'Javascript', 6, 1),
(9, 'Set 1', 3, 1),
(13, 'Definition 1', 3, 1),
(14, 'Set 1', 4, 1),
(15, 'Set 2', 4, 1),
(16, 'Nailing Bar', 0, 1),
(17, 'Criminal', 16, 1),
(18, 'Set 1', 17, 1),
(19, 'MBE 1', 4, 1),
(20, 'Nail 1', 4, 1),
(21, 'MBE 1', 5, 1),
(22, 'MBE 1', 3, 1),
(23, 'Nailing Bar', 5, 1),
(24, 'FYLS 1980 Exam', 2, 1),
(25, 'Nailing Baby Bar', 2, 1),
(26, 'Siegle\'s Law', 2, 1),
(27, 'Contracts', 26, 1),
(28, 'Criminal', 26, 1),
(29, 'Torts', 26, 1),
(30, 'Contracts', 25, 1),
(31, 'Criminal', 25, 1),
(32, 'Torts', 25, 1),
(33, 'TEST #1 CONTRACTS â€“ TERMS AND FORMATION', 25, 1),
(34, 'TEST #2 CONTRACTS â€“ INTERPRETATION AND ENFORCEABILITY', 25, 1),
(35, 'TEST #3 CONTRACTS â€“ THIRD PARTIES AND REMEDIES', 25, 1),
(36, 'TEST #4 UCC', 25, 1),
(37, 'TEST #5 â€“ TORTS â€“ INTENTIONAL TORTS AND DEFENSES', 25, 1),
(38, 'TEST # 6 â€“TORTS â€“ NEGLIGENCE AND DEFENSES', 25, 1),
(39, 'TEST # 7 â€“ TORTS â€“ DEFAMATION / PRODUCT LIABILITY / MISCELLANEOUS', 25, 1),
(40, 'TEST # 8 â€“ CRIMINAL LAW FUNDAMENTALS AND CRIMES AGAINST PROPERTY ', 25, 1),
(42, 'TEST # 9 â€“ CRIMES AGAINST THE PERSON / VICARIOUS LIABILITY / DEFENSES', 25, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qz_categories`
--
ALTER TABLE `qz_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qz_categories`
--
ALTER TABLE `qz_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
