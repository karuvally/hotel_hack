-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2017 at 12:43 AM
-- Server version: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 7.0.19-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_info`
--

CREATE TABLE `booking_info` (
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_info`
--

INSERT INTO `booking_info` (`booking_id`, `room_id`, `user_id`, `check_in_date`, `check_out_date`, `confirmed`) VALUES
(2, 1, 1511049646, '2017-11-19', '2017-11-20', 0),
(3, 6, 1511049679, '2017-11-19', '2017-11-20', 0),
(5, 2, 1511051055, '2017-11-19', '2017-11-20', 1),
(6, 7, 1511051626, '2017-11-19', '2017-11-20', 0),
(7, 8, 1511053792, '2017-11-19', '2017-11-20', 0),
(8, 3, 1511054845, '2017-11-19', '2017-11-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `guests_info`
--

CREATE TABLE `guests_info` (
  `user_id` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guests_info`
--

INSERT INTO `guests_info` (`user_id`, `name`, `email`, `address`, `phone`) VALUES
(1511049646, 'Aswin', 'aswinbabuk@gmail.com', 'Karuvally', 9995054663),
(1511049679, 'Arun', 'akn@gmail.com', 'Kalakkath', 9287656466),
(1511051055, 'Akshay', 'akv@gmail.com', 'Parumala', 9992345772),
(1511051626, 'Vysakh', 'vysakhsurendran@gmail.com', 'Malappuram', 9876541234),
(1511053792, 'Rafsal', 'kukku@gmail.com', 'Touchriver', 8765435678),
(1511054845, 'Anandu', 'chandru@gmail.com', 'PMG', 1234567890);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `type`) VALUES
(1, 'single'),
(2, 'single'),
(3, 'single'),
(4, 'single'),
(5, 'single'),
(6, 'double'),
(7, 'double'),
(8, 'double'),
(9, 'double'),
(10, 'double');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `type`) VALUES
(0, 'admin', 'admin', 'root'),
(1511049646, 'aswinbabuk@gmail.com', '9995054663', 'user'),
(1511049679, 'akn@gmail.com', '9287656466', 'user'),
(1511051055, 'akv@gmail.com', '9992345772', 'user'),
(1511051626, 'vysakhsurendran@gmail.com', '9876541234', 'user'),
(1511053792, 'kukku@gmail.com', '8765435678', 'user'),
(1511054845, 'chandru@gmail.com', '1234567890', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_info`
--
ALTER TABLE `booking_info`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `guests_info`
--
ALTER TABLE `guests_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_info`
--
ALTER TABLE `booking_info`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_info`
--
ALTER TABLE `booking_info`
  ADD CONSTRAINT `booking_info_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `booking_info_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `guests_info`
--
ALTER TABLE `guests_info`
  ADD CONSTRAINT `guests_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
