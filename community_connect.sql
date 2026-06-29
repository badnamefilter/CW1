-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2026 at 12:47 PM
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
(1, 'jayvan', 'jayvan@gmail.com', '$2y$10$/JCWXSVsg3UjsLpAurD3AexyuwlfI0EbTsHOq6TZLsiHRAgj3SaUC', 'admin', '2026-06-13 16:49:10'),
(2, 'john', 'john@gmail.com', '$2y$10$MkHEpceZzLpobRTijChllOH/roE5hQpMwAOrgE62g9isaPIc5hiM6', 'user', '2026-06-14 17:49:54'),
(3, 'Bob', 'bobert@gmail.com', '$2y$10$dZ4BL.xa9Bt7Jsk4TiwWMuULJklFpQEhnVL7MHoUt3hC9b.HQg0xq', 'user', '2026-06-14 18:15:12'),
(4, 'ebi', 'ebishrimp@gmail.asdasd', '$2y$10$VuByg1YfEsffLaf9PHYNPOhjBwaPt6MEofwhaenAUDLUv4iJPLG8y', 'user', '2026-06-14 21:22:04'),
(5, 'skibidi', 'skibidi@gmail.com', '$2y$10$QrC.TvyWhZhkV0VvTmAgduVEVPduMH5qb6JKe8GN4z.wkVtx/gj1a', 'user', '2026-06-15 12:33:28'),
(6, 'johnson', 'johnson@gmail.com', '$2y$10$gZqlz4QaVUor12IZ/MgVu.wq2fLhMTrml.J27sTbBFNhex6oTZVpi', 'user', '2026-06-28 17:35:10'),
(7, 'yz', 'yz@gmail.com', '$2y$10$4Bw/7MIJNw8ox7VxOeJEseKo85YFBVvkNuCF9eNuV4JyIE6S8/Hdq', 'user', '2026-06-29 13:22:53'),
(8, 'dasdasd', 'jayvanliang77@gmail.com', '$2y$10$BoX5J42tva7mVoULbO0qSejj4WcOvi9aeDukMnfQOllY2k9H6zfGa', 'user', '2026-06-29 17:25:04'),
(9, 'aaa', 'aaa@gmail.com', '$2y$10$9NK1yfl5z3vGeAt7uC1xXO0uRdRQptlALTbG5OSX5x3XvMb5EQ/8a', 'user', '2026-06-29 17:27:44'),
(10, 'Fish', 'water@gmail.com', '$2y$10$RikRtSOo4HEBAkF3P.khZu8TMZrFBpSzJoJqD3qTjAQe8OSqkChg.', 'user', '2026-06-29 17:31:31');

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
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'Images/gotong-royong.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `title`, `event_date`, `start_time`, `end_time`, `location`, `description`, `image`) VALUES
(1, 'Community Clean-Up Day', '2026-05-04', '08:00:00', '12:00:00', 'Riverside Park', 'Join neighbors for a morning of litter pickup, weeding, and beautifying our local park. Gloves and bags provided.', 'Images/gotong-royong.jpg'),
(2, 'Neighborhood Watch Orientation', '2026-07-10', '18:30:00', '20:00:00', 'Community Hall, Room A', 'An introductory session for residents interested in joining the neighborhood watch program. Learn safety protocols and reporting procedures.', 'Images/gotong-royong.jpg'),
(3, 'Summer Youth Basketball Camp', '2026-07-15', '09:00:00', '15:00:00', 'Community Sports Complex', 'A full-day basketball camp for kids ages 8-14, focusing on fundamentals, teamwork, and friendly competition.', 'Images/gotong-royong.jpg'),
(4, 'Senior Wellness Workshop', '2026-07-18', '10:00:00', '11:30:00', 'Senior Activity Center', 'Light exercises, nutrition tips, and a guest speaker on healthy aging. Open to all seniors in the community.', 'Images/gotong-royong.jpg'),
(5, 'Local Food Drive', '2026-07-22', '09:00:00', '17:00:00', 'Community Hall Main Lobby', 'Donate non-perishable food items to support local families in need. Volunteers needed for sorting and packing.', 'Images/gotong-royong.jpg'),
(6, 'Digital Literacy for Beginners', '2026-07-25', '14:00:00', '16:00:00', 'Public Library, Computer Lab', 'A beginner-friendly class covering email, internet safety, and basic computer skills for adults.', 'Images/gotong-royong.jpg'),
(7, 'Community Garden Planting Day', '2026-08-01', '07:30:00', '11:00:00', 'Maple Street Community Garden', 'Help plant vegetables and flowers in the shared community garden. All tools and seeds provided.', 'Images/gotong-royong.jpg'),
(8, 'Family Movie Night', '2026-08-08', '19:00:00', '21:30:00', 'Riverside Park Amphitheater', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Images/gotong-royong.jpg'),
(9, 'Job Fair & Career Workshop', '2026-08-14', '10:00:00', '14:00:00', 'Community Hall, Main Hall', 'Connect with local employers and attend resume-building and interview skills workshops.', 'Images/gotong-royong.jpg'),
(10, 'Town Hall Q&A with Local Officials', '2026-08-20', '18:00:00', '19:30:00', 'Community Hall, Room A', 'An open forum for residents to ask questions and share feedback with local council members.', 'Images/gotong-royong.jpg'),
(11, 'd', '2026-06-30', '02:34:00', '14:31:00', 'a', 'abbbb', 'Images/gotong-royong.jpg'),
(12, 'Cleaning My House', '2026-07-07', '10:30:00', '18:25:00', 'My house, clearly, i\'m sure you know where that is', 'You will not be paid for doing this. I will be taking all of the credit. Bring your cleaning supplies, I will give free candy though so pls come help :DDDDD', 'Images/programs/program_1782635713_6a40dcc136196.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_program`
--

CREATE TABLE `user_program` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `Reg_date` datetime NOT NULL,
  `notified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_program`
--

INSERT INTO `user_program` (`id`, `user_id`, `program_id`, `status`, `Reg_date`, `notified`) VALUES
(18, 5, 3, 'Rejected', '2026-06-25 16:04:07', 1),
(21, 5, 6, 'Rejected', '2026-06-25 16:04:39', 1),
(22, 5, 8, 'Rejected', '2026-06-25 16:04:43', 1),
(24, 5, 1, 'Approved', '2026-06-25 16:05:08', 1),
(25, 5, 11, 'Rejected', '2026-06-25 16:20:22', 1),
(27, 5, 12, 'Rejected', '2026-06-28 16:35:44', 1),
(28, 6, 12, 'Approved', '2026-06-28 17:35:25', 0),
(29, 6, 2, 'Approved', '2026-06-28 23:47:30', 0),
(30, 6, 3, 'Approved', '2026-06-28 23:47:35', 0),
(31, 6, 6, 'Approved', '2026-06-28 23:47:38', 0),
(32, 6, 4, 'Approved', '2026-06-28 23:47:42', 0),
(33, 6, 7, 'Approved', '2026-06-28 23:47:44', 0),
(34, 6, 5, 'Approved', '2026-06-28 23:47:46', 0),
(35, 6, 9, 'Pending', '2026-06-28 23:47:49', 0),
(36, 7, 4, 'Approved', '2026-06-29 13:23:29', 0),
(39, 7, 5, 'Approved', '2026-06-29 15:43:32', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_program`
--
ALTER TABLE `user_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
