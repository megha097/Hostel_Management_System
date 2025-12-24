-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 10:08 AM
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
-- Database: `hostel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'Akshita', '$2y$10$bHvp2k/m05pbOD6jcxguAuRsiyVapotsawCUcm/rpWGEEJc4hqhPu'),
(2, 'Megha', '$2y$10$r9Du5RCu98I1KEzxYj5sQ.jpNZWB377UcH9qbN.0GBqgp.ILbPbwK');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `message` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `message`, `created_at`) VALUES
(12, 'Notice', 'Pay your fees before due date. Otherwise you have to pay late-fees.', '2025-10-15 02:29:29'),
(13, 'Notice', 'Girls, who are going home this week please meet me today at 9:45 PM.', '2025-11-25 16:37:35'),
(16, 'Notice', 'Today food will be served at 9:00 PM.\r\n', '2025-11-27 15:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_views`
--

CREATE TABLE `announcement_views` (
  `id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement_views`
--

INSERT INTO `announcement_views` (`id`, `announcement_id`, `student_id`, `viewed_at`) VALUES
(96, 12, 38, '2025-10-15 02:33:51'),
(99, 12, 41, '2025-10-15 02:40:03'),
(103, 13, 42, '2025-11-25 16:50:41'),
(104, 12, 42, '2025-11-25 16:50:41'),
(106, 13, 69, '2025-11-27 07:08:17'),
(107, 12, 69, '2025-11-27 07:08:17'),
(111, 13, 39, '2025-11-27 07:27:17'),
(112, 12, 39, '2025-11-27 07:27:17'),
(117, 13, 70, '2025-11-27 08:38:44'),
(118, 12, 70, '2025-11-27 08:38:44'),
(123, 13, 51, '2025-11-27 12:54:27'),
(124, 12, 51, '2025-11-27 12:54:27'),
(129, 13, 49, '2025-11-27 13:16:19'),
(130, 12, 49, '2025-11-27 13:16:19'),
(135, 13, 38, '2025-11-27 15:20:39'),
(136, 16, 38, '2025-11-27 15:28:14'),
(137, 16, 57, '2025-11-28 08:34:31'),
(138, 13, 57, '2025-11-28 08:34:31'),
(139, 12, 57, '2025-11-28 08:34:31'),
(140, 16, 69, '2025-11-28 19:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `complaint` varchar(150) NOT NULL,
  `status` varchar(15) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `student_id`, `complaint`, `status`, `created_at`) VALUES
(12, 42, '2nd Floor is to much noicy and dirty.', 'Pending', '2025-10-13 16:14:03'),
(13, 42, 'Tell your clean worker to clean every corner of the hostel. She is not listening us.', 'Resolved', '2025-10-14 05:34:10'),
(17, 70, 'There is too much noise from other rooms.', 'Pending', '2025-11-27 08:37:24'),
(18, 51, 'My locker is damaged.', 'In Progress', '2025-11-27 12:53:14'),
(19, 49, 'The switchboard in my room is not working.\r\n', 'Resolved', '2025-11-27 13:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(17, 'Raval Aastha', 'aastha@gmail.com', 'The hostel environment feels safe and comfortable for daily living.', '2025-11-27 12:35:07'),
(18, 'Modi Pooja', 'pooja@gmail.com', 'The food tastes good and is served fresh.\r\n', '2025-11-27 12:35:39'),
(19, 'Solanki Devanshi', 'devanshi@gmail.com', 'I feel at home living in this hostel.\r\n', '2025-11-27 12:36:04'),
(20, 'Dalki Mudrika', 'mudrika@gmail.com', 'The staff behavior sometimes feels unprofessional.', '2025-11-27 12:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(25) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `months` int(10) NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('Unpaid','Paid') DEFAULT 'Unpaid',
  `payment_method` varchar(15) DEFAULT NULL,
  `transaction_id` varchar(30) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `student_id`, `student_name`, `amount`, `months`, `due_date`, `status`, `payment_method`, `transaction_id`, `payment_date`) VALUES
(87, 38, '', 39000.00, 6, '2025-12-31', 'Paid', 'UPI', 'TXN1764356185965', '2025-11-28'),
(88, 39, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(89, 40, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(90, 41, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(91, 42, '', 39000.00, 6, '2025-12-31', 'Paid', 'Card', 'TXN1764356254689', '2025-11-28'),
(92, 44, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(93, 45, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(94, 46, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(95, 48, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(96, 49, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(97, 50, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(98, 51, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(99, 52, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(100, 53, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(101, 54, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(102, 55, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(103, 56, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(104, 57, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(105, 58, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(106, 59, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(107, 60, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(108, 62, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(109, 69, '', 39000.00, 6, '2025-12-31', 'Paid', 'Card', 'TXN1764358320385', '2025-11-28'),
(110, 70, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL),
(111, 71, '', 39000.00, 6, '2025-12-31', 'Unpaid', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees_payments`
--

CREATE TABLE `fees_payments` (
  `id` int(11) NOT NULL,
  `student_name` varchar(20) NOT NULL,
  `room_no` int(11) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `payment_date` datetime DEFAULT current_timestamp(),
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_no` int(11) NOT NULL,
  `status` varchar(15) DEFAULT 'Available',
  `floor_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_no`, `status`, `floor_no`) VALUES
(1, 'Available', 1),
(2, 'Available', 1),
(3, 'Available', 1),
(4, 'Available', 1),
(5, 'Available', 1),
(6, 'Available', 2),
(7, 'Available', 2),
(8, 'Available', 2),
(9, 'Available', 2),
(10, 'Available', 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `room_no` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `room_no`, `password`) VALUES
(38, 'Kakkad Het', 'hetk@gmail.com', 3, '$2y$10$P195SnzRuM.vWMC7o6hAQuohw6kCBSUzqzyhDP8TBdD8iIK4Lw4IK'),
(39, 'Zatakiya Rushita', 'rushitaz@gmail.com', 5, '$2y$10$mWqyi05MHJDMPg7qSi6CJ.tsGFD2v0Q.6AqMQSdB0hWO1KPPXlBL6'),
(40, 'Pandya Riddhi', 'riddhi@gmail.com', 4, '$2y$10$/60R8WgfVQfxuw0CcKhMpuVZQyhqQ0fDmJuwhiFiH973WtUwDtDJ2'),
(41, 'Solanki Krinal', 'krinal@gmail.com', 5, '$2y$10$OPDS9GuKpvQ1QmcYweFSaelnhYB64U0adzBocjlEZWpyEUICGUDoq'),
(42, 'Kansagra Krisha', 'krisha@gmail.com', 7, '$2y$10$a6827VYj3vjEQXRRLvWhZ.3h3EHnhC9Ig.p/dqEmHpK8KAfO/BS/O'),
(44, 'Thakkar Riddhi', 'riddhit@gmail.com', 2, '$2y$10$Lmz/YGSKgbyXqqEFqTuxc./kb2IQwXSYxIV7BQbtuqVeUaamxmIOu'),
(45, 'Thanki Meera', 'meera@gmail.com', 3, '$2y$10$vZ4EBjAgLCHZkSd4SsWRwucIvNfN.EnvuUeX3je9VYBgYrki0ENoK'),
(46, 'Makda Zainab', 'zainab@gmail.com', 9, '$2y$10$OGylvk8YVKWmqYqIMsFxv.0/GphQXAzibTqxFOlZWFtWxobZL4f4i'),
(48, 'Dhodakiya Maitri', 'maitri@gmail.com', 7, '$2y$10$66LjrbdJ.Ada7VmI3MkfUO6mZpgvThMlhj3fYJUuucDx12qgACgX.'),
(49, 'Bhogayta Saloni', 'saloni@gmail.com', 4, '$2y$10$1it2ii4QyVna5YkUZo7q9.osJQd5yQ1PAc1.8ZOJynORnvt.IcIqa'),
(50, 'Rajyaguru Rashmi', 'rashmi@gmail.com', 1, '$2y$10$VaTYxhUJF7x6E3R.rtk4oOVa19beWgWR9gugCxF7H3.qPkQUwTQvi'),
(51, 'Dalki Mudrika', 'mudrika11@gmail.com', 7, '$2y$10$ozLABQsPc76FbJMfvsB9yOKTcqpjsW6NAg7MwGfhuYf/k6mONb9yS'),
(52, 'Rathod Mital', 'mital@gmail.com', 2, '$2y$10$saHfEADsJqngdIWSMvaufujW/ghvXU47ePCKrLjwPDDXRmqxWwEWK'),
(53, 'Desai Kajal', 'kajal@gmail.com', 8, '$2y$10$jh4eXOHcGyW8YlEvontbT..8PcOzEJO8IlOL.07clI3QQGxnrlkly'),
(54, 'Parmar Yashvi', 'yashvi@gmail.com', 6, '$2y$10$k1EaSbjF0HEunvYoUYYGoOw7sNxdVISBpygxe0ctHlTkp/TmpxAJ2'),
(55, 'Bhatt Shivangi', 'shivangi@gmail.com', 6, '$2y$10$K8ZAOUjQTgNVLs5RK.gu8ODmqrCr9qmTR4wqbYobFCkVFBDiwBrFu'),
(56, 'Gohil Nisha', 'nisha@gmail.com', 5, '$2y$10$xU5psk.fO66z76gifIcs/eMX8vDr3Aif2k/Y30.JCPDXFf1f7MzZy'),
(57, 'Trivedi Poonam', 'poonam@gmail.com', 1, '$2y$10$vASDDBrH00pi5va2hZPwb.O4jUsqNUJuGAv6zJagF2vpMpHU5TwnO'),
(58, 'Joshi Tanvi', 'tanvi@gmail.com', 1, '$2y$10$5g.Orv8.fPs2UpaRNABGh.bxvUtxgezSYIX96nsB48UGZBMDYZIya'),
(59, 'Patel Anika', 'anika@gmail.com', 2, '$2y$10$jrbE4lkrJKION4YOeyB0veN1hjuVRfKF0.uqzez2Uf7KfZ.y1a3tm'),
(60, 'Shah Shreya', 'shreya@gmail.com', 3, '$2y$10$uUoLbTIYSME4Y/fKmZf7mO2e7Ora4hu8RTebU3m2rdu8OJvEP.rfa'),
(62, 'Solanki Devanshi', 'devanshi@gmail.com', 6, '$2y$10$v8JW45KKEfI1ODNifg/UqOW7ufMP1ItPrm9gdnRJYZJbngRhVJ/SK'),
(69, 'Raval Aastha', 'aastha@gmail.com', 9, '$2y$10$qXPrEvjUj2ZqYXSA1JbG9uYl7RFCsEgff1OIIKiVxGV.hK/Snj7k2'),
(70, 'Modi Pooja', 'pooja@gmail.com', 8, '$2y$10$2LnmbubYtDTiSYRvMdusB..ff7R2iP2OryvrarYd/bAZhm3N8mjmW'),
(71, 'Laxmidhar Sakina', 'sakina@gmail.com', 9, '$2y$10$xkZWuQEa/4oW9Sa2zBeDm.Lj7/vQ7b5uujmeIp1LJF7ZYstpUGhF2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement_views`
--
ALTER TABLE `announcement_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcement_id` (`announcement_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student` (`student_id`);

--
-- Indexes for table `fees_payments`
--
ALTER TABLE `fees_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_no`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `announcement_views`
--
ALTER TABLE `announcement_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `fees_payments`
--
ALTER TABLE `fees_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement_views`
--
ALTER TABLE `announcement_views`
  ADD CONSTRAINT `announcement_views_ibfk_1` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `announcement_views_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fees_payments`
--
ALTER TABLE `fees_payments`
  ADD CONSTRAINT `fees_payments_ibfk_1` FOREIGN KEY (`id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
