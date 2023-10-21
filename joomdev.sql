-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 21, 2023 at 10:11 AM
-- Server version: 10.10.2-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joomdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `jd_employees`
--

DROP TABLE IF EXISTS `jd_employees`;
CREATE TABLE IF NOT EXISTS `jd_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last_login` varchar(255) DEFAULT NULL,
  `last_password_changed` varchar(255) DEFAULT NULL,
  `role` enum('admin','employee') NOT NULL DEFAULT 'employee',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jd_employees`
--

INSERT INTO `jd_employees` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `last_login`, `last_password_changed`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '9123456789', '$2y$12$jLh2ZEriA2btXXNQf2OcSu4l70e.bvM6Me7PxSA3Wu3QuwOPj1ee6', NULL, NULL, 'admin', '2023-10-21 14:49:42', '2023-10-21 15:29:33'),
(3, 'test', 'test', 'test@test.com', '1234567890', '$2y$12$6HvsbfW0of2QmyPqgFuUWe2FLiWdVZXzQvYsiIhNaTLHjFXkbQzkC', '2023-10-21', '2023-10-21', 'employee', '2023-10-21 15:32:43', '2023-10-21 15:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `jd_tasks`
--

DROP TABLE IF EXISTS `jd_tasks`;
CREATE TABLE IF NOT EXISTS `jd_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `stop_time` varchar(255) DEFAULT NULL,
  `notes` text NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jd_tasks`
--

INSERT INTO `jd_tasks` (`id`, `title`, `start_time`, `stop_time`, `notes`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'aaaaaaaaaaa', '2023-10-06T05:45', '2023-10-07T06:45', 'aaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1, '2023-10-20 20:16:07', '2023-10-20 20:25:46'),
(2, 'demo', '2023-10-21T02:58', '2023-10-31T01:58', 'ggggggggggggggggggggggggggggggggggg', 'ggggggggggggggggggggggggggggggggggg', NULL, '2023-10-20 20:28:46', '0000-00-00 00:00:00'),
(3, 'aaaaaaaaaa', '2023-10-21T02:24', '2023-10-21T02:24', 'aaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaa', 1, '2023-10-20 20:55:08', '0000-00-00 00:00:00'),
(4, 'task', '2023-10-21T14:09', '2023-10-31T14:09', 'notes', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 4, '2023-10-21 08:39:38', '0000-00-00 00:00:00'),
(5, 'task2', '2023-10-21T14:10', '2023-10-21T14:12', 'notes', 'AAAAAAAAssss', 4, '2023-10-21 08:40:33', '0000-00-00 00:00:00'),
(6, 'title', '2023-09-30T15:43', '2023-10-21T15:37', 'notes', 'aaaaaaaaaaaaaaaaaa', 3, '2023-10-21 10:07:44', '0000-00-00 00:00:00'),
(7, 'aaaaaaaaaaaa', '2023-10-21T15:39', '2023-10-21T15:39', 'aaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaa', 3, '2023-10-21 10:09:25', '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
