-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 15, 2024 at 04:16 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedback_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `age_range` enum('0-18','19-30','31-50','51-70','71-above') NOT NULL,
  `message` text,
  `file_path` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `hospital` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `gender`, `age_range`, `message`, `file_path`, `province`, `district`, `hospital`, `created_at`) VALUES
(1, 'male', '0-18', 'wdasdasd', 'uploads/Screenshot from 2024-02-15 14-17-21.png', 'asdasd', 'asdasd', 'asdasd', '2024-02-15 07:43:25'),
(2, 'male', '0-18', 'wdasdasd', 'uploads/Screenshot from 2024-02-15 14-17-21.png', 'asdasd', 'asdasd', 'asdasd', '2024-02-15 07:47:15'),
(3, 'male', '0-18', 'asdasd', 'uploads/Screenshot from 2024-02-15 14-17-21.png', 'asdasd', 'asdasd', 'asdasd', '2024-02-15 07:57:51'),
(4, 'male', '0-18', 'vbdfbdvb', 'uploads/Screenshot from 2024-02-15 14-17-21.png', 'cv', 'cvb', 'cvb', '2024-02-15 08:06:57'),
(6, 'female', '51-70', 'fgdfgdfg', 'uploads/Screenshot from 2024-02-15 14-17-21.png', 'dfgdfg', 'dfgdfg', 'dfgdf', '2024-02-15 08:43:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
