-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 11:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wt_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `phone_number` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone_number`, `address`, `email`, `password`, `type`) VALUES
(1, 'Abdullah', 'Noman', 1714021072, 'AIUB CAMPUS', '22-47509-2@student.aiub.edu', 'admin123', 'admin'),
(2, 'Md Abdullah', 'Al Noman', 1714021072, 'AIUB CAMPUS', 'aa@gmail.com', '12341234', ''),
(4, 'Abdullah', 'Al Noman', 1714021072, '', 'anomannoman0@gmail.com', 'aiub1234', ''),
(5, 'Abdullah', 'Al', 1714021072, 'AIUB CAMPUS', 'anomannoman@gmail.com', '12345678', ''),
(7, 'Abdullahhh', 'Al Noman', 1714021072, 'AIUB CAMPUS', 'hh@gmail.com', '12345678', ''),
(8, 'Abdullah', 'Al Noman', 1714021072, 'AIUB CAMPUS', 'mm@gmail.com', '12345678', ''),
(10, 'Abdullah', 'Al Noman', 1714021072, 'AIUB CAMPUS', 'ss@gmail.com', '12345678', ''),
(11, 'Hasem', 'Mama', 1714021072, 'AIUB CAMPUS', 'hasem@gmail.com', '12345678', ''),
(13, 'Avoid', 'Noman', 1700000000, 'AIUB CAMPUS', 'mdabdullahaln30@gmail.com', '12345678', ''),
(19, 'Abdullah', 'Al Noman', 1714021072, 'AIUB CAMPUS', 'anman0@gmail.com', '12345678', ''),
(21, 'Hasan', 'Alam', 1714021072, 'AIUB CAMPUS', 'hasan@gmail.com', '12345678', ''),
(22, 'Abdullah', 'Al Noman', 1714021072, 'AIUB CAMPUS', 'uuuu@gmail.com', '12345678', ''),
(23, 'Abdullah', 'Mooo', 1714021072, 'AIUB CAMPUS', 'kkkkkkk@gmail.com', '12345678', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
