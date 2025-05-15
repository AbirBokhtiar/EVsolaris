-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 12:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `user_id` int(128) NOT NULL,
  `st_name` varchar(128) NOT NULL,
  `st_address` varchar(128) NOT NULL,
  `st_slot` varchar(128) NOT NULL,
  `st_status` varchar(128) NOT NULL,
  `st_price` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`user_id`, `st_name`, `st_address`, `st_slot`, `st_status`, `st_price`) VALUES
(1, 'das', 'dasdasd', 'adasd', 'asdas', 1111),
(2, 'shimanto 1', '40/A, Moneshwar road, Dhanmondi, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1200),
(1, 'shimanto 2', 'Dhanmondi 5a, Dhaka-1205', '2:00 AM - 4:00 PM', 'confirmed', 1300),
(1, 'shimanto 3', 'Dhanmondi 6a, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1600),
(2, 'shimanto 4', 'Dhanmondi 6a, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1600),
(1, 'shimanto 5', 'Dhanmondi 6a, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1600),
(2, 'shimanto 6', 'Dhanmondi 6a, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1600),
(2, 'shimanto 7', 'Dhanmondi 6a, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1600),
(1, 'shimanto 8', 'Dhanmondi 6a, Dhaka-1205', '2:00 AM - 4:00 PM', 'pending', 1600);

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `st_name` varchar(128) NOT NULL,
  `st_address` varchar(128) NOT NULL,
  `st_slot` varchar(128) NOT NULL,
  `st_status` varchar(128) NOT NULL,
  `st_price` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`st_name`, `st_address`, `st_slot`, `st_status`, `st_price`) VALUES
('das', 'dasdasd', 'adasd', 'asdas', 1111),
('shimanto 1', '40/A, Moneshwar road, Dhanmondi, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1200),
('shimanto 2', 'Dhanmondi 5a, Dhaka-1205', '2:00 AM - 4:00 PM', 'confirmed', 1300),
('shimanto 3', 'Dhanmondi 6a, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1600),
('shimanto 4', 'Dhanmondi 6a, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1600),
('shimanto 5', 'Dhanmondi 6a, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1600),
('shimanto 6', 'Dhanmondi 6a, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1600),
('shimanto 7', 'Dhanmondi 6a, Dhaka-1205', '10:00 AM - 12:00 PM', 'confirmed', 1600),
('shimanto 8', 'Dhanmondi 6a, Dhaka-1205', '2:00 AM - 4:00 PM', 'pending', 1600);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `user_id` int(128) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `city` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(128) NOT NULL,
  `station_company` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`user_id`, `transaction_id`, `amount`, `city`, `date`, `status`, `station_company`) VALUES
(1, 1, 120, 'Dhaka', '2025-01-01', 'Done', 'Elecro Company'),
(2, 2, 110, 'Chittagong', '2025-01-03', 'Pending', 'Charzer'),
(2, 3, 160, 'Rangpur', '2025-01-05', 'Done', 'VehicleCharge'),
(1, 4, 222, 'dasfasf', '2025-01-15', 'Done', 'werwerwe'),
(1, 5, 222, 'sasasf', '2025-01-22', 'Pending', 'ghfghfgghf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `subscription` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `subscription`) VALUES
(1, 'ab', '11', 'ab@gmail.com', 'premium'),
(2, 'bokhtiar', '123456', 'bokhtiarbooks@gmail.com', 'regular');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`st_name`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`st_name`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
