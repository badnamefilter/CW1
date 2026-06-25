-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2026 at 06:20 AM
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
-- Database: `community_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `Reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `email`, `password`, `role`, `Reg_date`) VALUES
(1, 'jayvan', 'jayvan@gmail.com', '$2y$10$RpidKinQUIpCYQ3V.c1XRu1qyZ0mwip8S5S2P10mwGH8q5xdcDGg2', 'admin', '2026-06-13 16:49:10'),
(2, 'john', 'john@gmail.com', '$2y$10$MkHEpceZzLpobRTijChllOH/roE5hQpMwAOrgE62g9isaPIc5hiM6', 'user', '2026-06-14 17:49:54'),
(3, 'Bob', 'bobert@gmail.com', '$2y$10$dZ4BL.xa9Bt7Jsk4TiwWMuULJklFpQEhnVL7MHoUt3hC9b.HQg0xq', 'user', '2026-06-14 18:15:12'),
(4, 'ebi', 'ebishrimp@gmail.asdasd', '$2y$10$VuByg1YfEsffLaf9PHYNPOhjBwaPt6MEofwhaenAUDLUv4iJPLG8y', 'user', '2026-06-14 21:22:04'),
(5, 'skibidi', 'skibidi@gmail.com', '$2y$10$QrC.TvyWhZhkV0VvTmAgduVEVPduMH5qb6JKe8GN4z.wkVtx/gj1a', 'user', '2026-06-15 12:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `location` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `title`, `event_date`, `start_time`, `end_time`, `location`, `description`) VALUES
(1, 'Community Clean-Up Day', '2026-07-04', '08:00:00', '12:00:00', 'Riverside Park', 'Join neighbors for a morning of litter pickup, weeding, and beautifying our local park. Gloves and bags provided.'),
(2, 'Neighborhood Watch Orientation', '2026-07-10', '18:30:00', '20:00:00', 'Community Hall, Room A', 'An introductory session for residents interested in joining the neighborhood watch program. Learn safety protocols and reporting procedures.'),
(3, 'Summer Youth Basketball Camp', '2026-07-15', '09:00:00', '15:00:00', 'Community Sports Complex', 'A full-day basketball camp for kids ages 8-14, focusing on fundamentals, teamwork, and friendly competition.'),
(4, 'Senior Wellness Workshop', '2026-07-18', '10:00:00', '11:30:00', 'Senior Activity Center', 'Light exercises, nutrition tips, and a guest speaker on healthy aging. Open to all seniors in the community.'),
(5, 'Local Food Drive', '2026-07-22', '09:00:00', '17:00:00', 'Community Hall Main Lobby', 'Donate non-perishable food items to support local families in need. Volunteers needed for sorting and packing.'),
(6, 'Digital Literacy for Beginners', '2026-07-25', '14:00:00', '16:00:00', 'Public Library, Computer Lab', 'A beginner-friendly class covering email, internet safety, and basic computer skills for adults.'),
(7, 'Community Garden Planting Day', '2026-08-01', '07:30:00', '11:00:00', 'Maple Street Community Garden', 'Help plant vegetables and flowers in the shared community garden. All tools and seeds provided.'),
(8, 'Family Movie Night', '2026-08-08', '19:00:00', '21:30:00', 'Riverside Park Amphitheater', 'Free outdoor movie screening for the whole family. Bring blankets and chairs. Snacks available for purchase.'),
(9, 'Job Fair & Career Workshop', '2026-08-14', '10:00:00', '14:00:00', 'Community Hall, Main Hall', 'Connect with local employers and attend resume-building and interview skills workshops.'),
(10, 'Town Hall Q&A with Local Officials', '2026-08-20', '18:00:00', '19:30:00', 'Community Hall, Room A', 'An open forum for residents to ask questions and share feedback with local council members.');

-- --------------------------------------------------------

--
-- Table structure for table `user_program`
--

CREATE TABLE `user_program` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `Reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_program`
--

INSERT INTO `user_program` (`id`, `user_id`, `program_id`, `status`, `Reg_date`) VALUES
(1, 2, 1, 'registered', '2026-06-15 09:12:00'),
(2, 2, 3, 'registered', '2026-06-15 09:15:00'),
(3, 3, 1, 'registered', '2026-06-16 14:30:00'),
(4, 3, 5, 'registered', '2026-06-16 14:35:00'),
(5, 3, 8, 'attended', '2026-06-16 14:40:00'),
(6, 4, 2, 'registered', '2026-06-17 11:00:00'),
(7, 4, 6, 'cancelled', '2026-06-17 11:05:00'),
(8, 5, 3, 'registered', '2026-06-18 16:20:00'),
(9, 5, 4, 'registered', '2026-06-18 16:25:00'),
(10, 5, 7, 'attended', '2026-06-18 16:30:00'),
(11, 2, 9, 'registered', '2026-06-19 10:00:00'),
(12, 3, 10, 'registered', '2026-06-20 13:45:00'),
(13, 4, 10, 'registered', '2026-06-20 13:50:00'),
(14, 5, 1, 'attended', '2026-06-21 08:10:00'),
(15, 2, 8, 'registered', '2026-06-22 19:30:00'),
(16, 5, 5, 'Pending', '2026-06-25 12:07:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_program`
--
ALTER TABLE `user_program`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_program`
--
ALTER TABLE `user_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
