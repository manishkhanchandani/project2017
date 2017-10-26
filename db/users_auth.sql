-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2017 at 05:55 PM
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
-- Table structure for table `users_auth`
--

CREATE TABLE `users_auth` (
  `user_id` int(11) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `provider_id` enum('google.com','facebook.com','twitter.com','github.com','email1','email2') DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `access_level` enum('member','admin') NOT NULL DEFAULT 'member',
  `user_created_dt` datetime DEFAULT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `logged_in_time` bigint(20) DEFAULT NULL,
  `profile_uid` varchar(255) DEFAULT NULL,
  `website` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_auth`
--

INSERT INTO `users_auth` (`user_id`, `display_name`, `profile_img`, `email`, `provider_id`, `password`, `access_level`, `user_created_dt`, `uid`, `logged_in_time`, `profile_uid`, `website`) VALUES
(1, 'Manish Khanchandani', 'https://lh6.googleusercontent.com/-nLg0dFRo0DQ/AAAAAAAAAAI/AAAAAAAArjM/wWzo9wl_lFM/photo.jpg', 'manishkk74@gmail.com', 'google.com', NULL, 'admin', '2017-09-13 05:27:20', 'W5F3YbU9OTdrDccldzyEnulJp3G2', 1509033207, '112913147917981568678', '[\"babybar\",\"babybar2\"]'),
(2, 'Manish Khanchandani', 'https://lh6.googleusercontent.com/-_JOhv_TJLl8/AAAAAAAAAAI/AAAAAAAAAQ0/x9ek_WhsTxA/photo.jpg', NULL, 'google.com', NULL, 'member', '2017-09-13 18:24:14', 'aQxp3KIGpaYB2eefcJCDzybWp273', 1505327054, '100546875099861959996', NULL),
(3, 'Drm Khanchandani', 'https://scontent.xx.fbcdn.net/v/t1.0-1/p100x100/13903197_124863231287983_1880271717412297715_n.jpg?oh=0471fab3e1b73a098f4061b317f6b796&oe=5A14D9EB', NULL, 'facebook.com', NULL, 'member', '2017-09-13 18:26:12', 'PLqXuRBBTBfZ3gN4qckGo07vlHU2', 1505327223, '351898325251138', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_auth`
--
ALTER TABLE `users_auth`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_auth`
--
ALTER TABLE `users_auth`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
