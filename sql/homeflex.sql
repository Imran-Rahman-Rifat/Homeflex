-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2024 at 12:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homeflex`
--

-- --------------------------------------------------------

--
-- Table structure for table `appartment`
--

CREATE TABLE `appartment` (
  `appart_id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `sqft` int(11) DEFAULT NULL,
  `available_date` varchar(20) DEFAULT NULL,
  `short_des` varchar(500) DEFAULT NULL,
  `lift_facility` varchar(10) DEFAULT NULL,
  `bedroom_num` int(11) DEFAULT NULL,
  `bathroom_num` int(11) DEFAULT NULL,
  `total_room` int(11) DEFAULT NULL,
  `whom_to_rent` varchar(100) DEFAULT NULL,
  `floor_no` int(11) DEFAULT NULL,
  `is_booked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appartment`
--

INSERT INTO `appartment` (`appart_id`, `owner_id`, `title`, `price`, `sqft`, `available_date`, `short_des`, `lift_facility`, `bedroom_num`, `bathroom_num`, `total_room`, `whom_to_rent`, `floor_no`, `is_booked`) VALUES
(1, 1, 'Urban Home', 12000, 1000, '2024-10-01', 'A house in Jatrabari,Dhaka', 'Yes', 3, 2, 5, 'Family', 6, 0),
(2, 2, 'Business area', 20000, 1600, '2024-06-01', 'A ', 'Yes', 3, 1, 4, 'Family', 2, 0),
(3, 2, 'Educational Area', 30000, 1500, '2024-01-01', 'B', 'Yes', 3, 3, 5, 'Family', 4, 0),
(4, 3, 'Clean Area', 25000, 1200, '2024-02-01', 'C', 'Yes', 2, 2, 3, 'Bachelor', 6, 0),
(5, 3, 'Rural Area ', 15000, 1099, '2024-03-01', 'D', 'No', 2, 2, 3, 'Family', 1, 0),
(6, 4, 'Urban Area ', 18000, 1000, '2024-04-01', 'E', 'No', 2, 2, 3, 'Bachelor', 2, 0),
(7, 4, 'Rural Area ', 16000, 2000, '2024-05-01', 'F', 'Yes', 4, 3, 5, 'Any', 5, 0),
(8, 4, 'Business area', 30000, 2200, '2024-10-01', 'V', 'Yes', 3, 3, 5, 'Any', 9, 0),
(9, 4, 'Educational Area', 25000, 2000, '2024-08-01', 'R', 'Yes', 3, 3, 5, 'Family', 8, 1),
(10, 5, 'Urban Area', 30000, 2000, '2024-11-01', 'H', 'Yes', 4, 3, 5, 'Family', 8, 0),
(11, 5, 'Urban Area ', 27000, 1200, '2024-12-01', 'T', 'Yes', 3, 3, 5, 'Any', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `from_` int(11) NOT NULL,
  `to_` int(11) NOT NULL,
  `appart_id` int(11) NOT NULL,
  `send_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `status_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `from_`, `to_`, `appart_id`, `send_at`, `status`, `status_updated_at`) VALUES
(2, 5, 1, 1, '2024-09-17 19:41:15', 'rejected', '2024-09-17 19:51:27'),
(3, 5, 3, 4, '2024-09-17 19:41:28', 'pending', '2024-09-17 19:41:28'),
(4, 5, 4, 9, '2024-09-17 19:48:27', 'accepted', '2024-09-17 19:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `conversation_id` int(11) NOT NULL,
  `from_` int(11) NOT NULL,
  `to_` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `send_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`conversation_id`, `from_`, `to_`, `message`, `send_at`) VALUES
(1, 2, 4, 'HI Imran', '2024-09-16 17:38:23'),
(2, 4, 2, 'Hi', '2024-09-16 17:40:24'),
(3, 4, 2, 'How are you', '2024-09-16 17:40:39'),
(4, 2, 4, 'I am fine', '2024-09-16 17:40:50'),
(5, 10, 4, 'Hello there', '2024-09-17 19:53:20'),
(6, 4, 10, 'Hi', '2024-09-17 19:54:03'),
(7, 10, 4, 'l like you apartment named educational area', '2024-09-17 19:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `appart_id` int(11) DEFAULT NULL,
  `title_img` varchar(100) DEFAULT NULL,
  `bedroom_img` varchar(100) DEFAULT NULL,
  `bathroom_img` varchar(100) DEFAULT NULL,
  `kitchen_img` varchar(100) DEFAULT NULL,
  `extra_img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`appart_id`, `title_img`, `bedroom_img`, `bathroom_img`, `kitchen_img`, `extra_img`) VALUES
(1, 'property-3.jpg', 'family.jpg', 'ManageRental.jpg', 'bachelor.jpg', '_b391ae04-0a2d-4554-9513-86f5fc079187.jpeg'),
(2, '16.jpg', '1.jpeg', '1.jpeg', '1.jpeg', '1.png'),
(3, 'property-5.jpg', '2.jpeg', '2.jpeg', '2.jpeg', '2.jpeg'),
(4, '3.jpg', '3.jpeg', '5.jpeg', '3.jpeg', '4.jpg'),
(5, 'property-5.jpg', '12.jpeg', '4.jpeg', '4.jpg', '2.jpeg'),
(6, '6.jpg', '5.jpg', '5.jpeg', '6.jpeg', '8.jpg'),
(7, 'property-4.jpg', '8.jpeg', '10.jpg', '10.jpeg', '11.jpeg'),
(8, '10.jpg', '11.jpeg', '10.jpg', '6.jpeg', '6.jpg'),
(9, 'property-1.jpg', '4.jpg', '7.jpeg', '6.jpg', '11.jpeg'),
(10, 'property-6.jpg', '11.jpeg', '1.jpeg', '8.jpeg', '6.jpg'),
(11, 'property-1.jpg', '9.jpeg', '5.jpeg', '7.jpeg', '10.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `appart_id` int(11) DEFAULT NULL,
  `division` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `thana` varchar(100) DEFAULT NULL,
  `ward_no` int(11) DEFAULT NULL,
  `house_no` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`appart_id`, `division`, `district`, `thana`, `ward_no`, `house_no`, `address`) VALUES
(1, 'Dhaka', 'Dhaka', 'Jatrabari', 50, '02/A', 'Jatrabari,Dhaka'),
(2, 'Dhaka', 'Dhaka', 'Banani', 45, '3/B', 'Banani,Dhaka'),
(3, 'Dhaka', 'Dhaka', 'Dhanmondi', 46, '2/C', 'Dhanmondi,Dhaka'),
(4, 'Dhaka', 'Dhaka', 'Dhanmondi', 47, '4/A', 'Dhanmondi,Dhaka'),
(5, 'Dhaka', 'Dhaka', 'Uttara', 50, '4/B', 'Uttara,Dhaka'),
(6, 'Dhaka', 'Dhaka', 'Uttara', 48, '4/C', 'Uttara,Dhaka'),
(7, 'Dhaka', 'Dhaka', 'Uttara', 51, '3/C', 'Uttara,Dhaka'),
(8, 'Dhaka', 'Ghulshan', 'Ghulshan', 50, '4/A', 'Ghukshan,Dhaka'),
(9, 'Dhaka', 'Dhaka', 'Dhanmondi', 38, '1/A', 'Dhanmondi,Dhaka'),
(10, 'Dhaka', 'Ghulshan', 'Ghulshan', 30, '5/A', 'Ghukshan,Dhaka'),
(11, 'Dhaka', 'Dhaka', 'Banani', 47, '4/B', 'Banani,Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `phone_num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `user_id`, `username`, `phone_num`) VALUES
(1, 1, 'Rifat', 123456),
(2, 2, 'Imran', 123456),
(3, 3, 'Shaon', 1234567),
(4, 4, 'Raduan', 123456),
(5, 5, 'Nur', 134567);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `report_from` int(11) NOT NULL,
  `report_to` int(11) NOT NULL,
  `report_message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `report_from`, `report_to`, `report_message`) VALUES
(1, 1, 10, 'fake request');

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `resident_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `phone_num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`resident_id`, `user_id`, `username`, `phone_num`) VALUES
(1, 6, 'Munna', 172345),
(2, 7, 'Siam', 153246),
(3, 8, 'Kazi', 1932145),
(4, 9, 'Partho', 182134),
(5, 10, 'Shuvo', 1532458);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `passwords` varchar(255) NOT NULL,
  `account_type` varchar(10) NOT NULL,
  `profile_pic` varchar(150) DEFAULT 'profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `passwords`, `account_type`, `profile_pic`) VALUES
(1, 'rifat@gmail.com', '$2y$10$lKzVhpSQAZT1tOFqkzzAcufmuWcEctKArsh1NsK9EV7WNj2KpRWY.', 'Owner', 'profile.png'),
(2, 'imran@gmail.com', '$2y$10$pF1X32dpS0RQ6FD.BJlHsu28x05YU.GKKB6/EDkcFhBEM2kfciHsa', 'Owner', 'profile.png'),
(3, 'shaon@gmail.com', '$2y$10$LfeUfIysT3LvqKixASjsv.eI2HBKyqxV2h7svO2ctHmlG6s2fxNmC', 'Owner', 'profile.png'),
(4, 'raduan@gmail.com', '$2y$10$jxLSIO9cZPewni7Uu8a9mufRPILV2grusXHvoGKeTiDrykX/vIeim', 'Owner', 'profile.png'),
(5, 'nur@gmail.com', '$2y$10$BkddjZMyaE5Kzp.LxEgLKuDC74Ad0YrS.ABE4.5Ezn7/7.I8JuS0a', 'Owner', 'profile.png'),
(6, 'munna@gmail.com', '$2y$10$RYw/1Y3398HVTEX5065vVewSE5pjeSodMUrCaGAfH/XIzFiTKVO0u', 'Resident', 'profile.png'),
(7, 'siam@gmail.com', '$2y$10$V7ca6imJdwCWe8xBNtFtouUZgi/lUJV68AqMyj8vf3VYBlIT4bDoe', 'Resident', 'profile.png'),
(8, 'kazi@gmail.com', '$2y$10$iRrsEDI.Z9glCUKGYiUZQ.HgTqr.4LrgNyc8QgYSsAvZBpU1vmrjG', 'Resident', 'profile.png'),
(9, 'partho@gmail.com', '$2y$10$kRSKkrWbuWLiaCCl6HE18OSzOgRh1/BjpFUSQEGG5Ihg5GQbgGI1e', 'Resident', 'profile.png'),
(10, 'shuvo@gmail.com', '$2y$10$09jBWBXpc6zJ5wZCKGRZDek9O.G4TN7PYbQ7ZXwInqajv1PaQ26j6', 'Resident', 'profile.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appartment`
--
ALTER TABLE `appartment`
  ADD PRIMARY KEY (`appart_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD KEY `appart_id` (`appart_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD KEY `appart_id` (`appart_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`resident_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appartment`
--
ALTER TABLE `appartment`
  MODIFY `appart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appartment`
--
ALTER TABLE `appartment`
  ADD CONSTRAINT `appartment_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`appart_id`) REFERENCES `appartment` (`appart_id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`appart_id`) REFERENCES `appartment` (`appart_id`);

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `owner_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `resident`
--
ALTER TABLE `resident`
  ADD CONSTRAINT `resident_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
