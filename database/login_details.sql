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
-- Database: `login_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_user` text NOT NULL,
  `account_password` text NOT NULL,
  `account_option1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `account_option2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `account_option3` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_user`, `account_password`, `account_option1`, `account_option2`, `account_option3`) VALUES
('mchre091', 'admin', '', '0', '0'),
('mchre09', '$2y$10$OZs2Y5VidzVvAY8NMxpL2Om1jXRZgs8dUVGqmrdXdeozc9AmDhyEW', '', '0', '0'),
('max', '$2y$10$uKMAYn0BtjYlLzKlR30RBOaS6XTDUBUEKP8PuBGRvnshi4VNex0TS', '68384c466b971', '68b19645c1867', '680ccac471e09'),
('maxdeux', '$2y$10$SjPl8BVz05JKVBURPDHBdOuMGKpBRLK7b5WgdTTug7kr8/p2Pw6Si', '68b19645c1867', '680ccac471e09', '685a9348a3354'),
('bonjour', '$2y$10$CRnnq6.8ce4e.ftE4c.43OlJujCUxkdB9uEJg9PCQfxbeCjJjrROi', NULL, NULL, NULL),
('myname', '$2y$10$WvlL6P.bquRPeAljaPpmsuKiOx5hkWgZvEL16TtlKfvokxW2J7MQi', NULL, NULL, NULL),
('julien', '$2y$10$x2wcUgiMGJSoYv9kQKJaLOhDT4zmXBqsrgfnvMoQW7sQORnaiND92', '68b196460bb0d', '68c95145c60bf', '68ada1c4d6fd2'),
('funtime', '$2y$10$.OpTdmlT5BRpZGkeAJl1LuKBmVTuKU9pfEMXb7w/7UoP97tHYLzae', '68ada1c4d6fd2', '68a46745a4978', '68a9ad4526034');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
