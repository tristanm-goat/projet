-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2025 at 03:51 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_request`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `contact_name` text COMMENT 'contact name',
  `contact_email` text COMMENT 'contact email',
  `contact_subject` text COMMENT 'contact subject',
  `contact_request` text COMMENT 'contact description of request',
  `contact_id` int NOT NULL COMMENT 'unique ID for requests',
  `contact_time` datetime DEFAULT NULL COMMENT 'date/time identifier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_requests`
--

INSERT INTO `contact_requests` (`contact_name`, `contact_email`, `contact_subject`, `contact_request`, `contact_id`, `contact_time`) VALUES
('max', 'max@max.max', 'max', 'max', 3, '2025-11-12 20:08:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`contact_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `contact_id` int NOT NULL AUTO_INCREMENT COMMENT 'unique ID for requests', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
