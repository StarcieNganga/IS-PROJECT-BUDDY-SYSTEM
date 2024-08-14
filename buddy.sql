-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 09:15 AM
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
-- Database: `buddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `house_id` int(11) DEFAULT NULL,
  `your_name` varchar(255) DEFAULT NULL,
  `your_phone` varchar(255) DEFAULT NULL,
  `roomate_name` varchar(255) DEFAULT NULL,
  `roomate_phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `house_id`, `your_name`, `your_phone`, `roomate_name`, `roomate_phone`, `created_at`) VALUES
(1, 3, 'Nelson Onyando', '0710517189', 'Alex', '0716077601', '2024-07-23 07:57:21'),
(2, 2, 'Alexous', '0723874498', 'Sam', '0716077698', '2024-07-23 07:59:31'),
(8, 5, 'Test User', '0710203040', 'Ogutu', '0716077601', '2024-07-23 13:28:55'),
(9, 3, 'Nelson Onyando', '0710517189', 'Susan Jane', '0710517188', '2024-07-24 06:32:37'),
(10, 5, 'Nelson Onyando', '0710517189', 'jane', '0716077601', '2024-07-24 07:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `rent` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `vacancies` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `name`, `category`, `location`, `contact`, `rent`, `image`, `vacancies`) VALUES
(2, 'Vestavia', 'Bedsitters', 'Rongai', '0710617189', '7000', 'house3.jpg', '4'),
(3, 'Pillar House', '1 bedroom', 'Rongai', '0710617189', '7000', 'house4.jpg', '6'),
(5, 'Pillar House', '2 bedroom', 'Rongai', '0710617189', '7000', 'house5.jpg', '7'),
(6, 'Pillar House', '2 bedroom', 'Rongai', '0710617189', '7000', 'house1.jpg', '8'),
(7, 'Pillar House', '1 bedroom', 'Rongai', '0710617189', '7000', 'house6.jpg', '2'),
(8, 'Pillar House', '1 bedroom', 'Rongai', '0710617189', '7000', 'house7.jpg', '3'),
(9, 'Pillar House', '1 bedroom', 'Rongai', '0710617189', '7000', 'house2.jpg', '4'),
(10, 'Imperial Villas', 'bedsitters', 'Rongai', '0710617189', '7000', 'house8.jpg', '4'),
(11, 'Imperial Villas', 'bedsitters', 'Rongai', '0710617189', '5000', 'house5.jpg', '5'),
(12, 'Imperial Villas', 'bedsitters', 'Rongai', '0710617189', '7000', 'house6.jpg', '4');

-- --------------------------------------------------------

--
-- Table structure for table `matched_profile`
--

CREATE TABLE `matched_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `matched_profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matched_profile`
--

INSERT INTO `matched_profile` (`id`, `user_id`, `matched_profile_id`) VALUES
(1, 14, 22),
(2, 14, 32),
(3, 16, 22),
(4, 17, 22),
(5, 17, 32),
(6, 17, 35),
(7, 13, 22);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `budget` double(6,2) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `phone_number` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `name`, `age`, `gender`, `budget`, `photo`, `bio`, `phone_number`) VALUES
(21, 2, 'Joy Achieng', 22, 'female', 9999.99, 'model1.jpg', '                           Hey, l like modeling.     ', 711111111),
(22, 3, 'Susan Jane', 20, 'female', 9999.99, 'md2.jfif', '                                Hi, l love swimming.', 722222222),
(23, 4, 'John Kai', 23, 'male', 9999.99, 'md3.jfif', '                          Hi, l love wrestling.      ', 733333333),
(24, 5, 'James King', 24, 'male', 9999.99, 'md4.jpg', '                             I like Poetry.   ', 744444444),
(25, 6, 'Steve King', 20, 'male', 9999.99, 'md5.jpg', '                                                    Hi, l like chess                                            ', 755555555),
(26, 7, 'Mercy Snow', 25, 'female', 9999.99, 'md6.jfif', '                          I love painting      ', 766666666),
(27, 8, 'Gabriela Jones', 20, 'female', 9999.99, 'md7.jpg', '                                i love to study', 777777777),
(28, 9, 'Darius James', 27, 'male', 9999.99, 'md8.jpg', '                                Hi, l Love football', 788888888),
(29, 10, 'Matthew Kamau', 24, 'male', 50.00, 'md9.jpg', '                                Hi, l like films', 79999999),
(30, 11, 'Jane Kendi', 23, 'female', 9999.99, 'md10.jpg', '                               l love swimming ', 712111111),
(31, 12, 'Breona Taylor', 22, 'female', 9999.99, 'md11.jpg', '                                l love boat riding', 723456890),
(32, 13, 'Nelson Onyando', 25, 'male', 5000.00, 'bmw-m4-gt3-evo-bmw-3840x2160-16968.jpg', 'Computer Science', 710517187),
(33, 14, 'Test User', 25, 'male', 5000.00, 'faq_graphic.jpg', 'Computer Science', 710203040),
(34, 15, 'Admin', 25, 'male', 6000.00, '13dfecd06e10b22f7e6376712956beee.jpg', 'Actuarial Science', 712345678),
(35, 16, 'Test User', 26, 'male', 7000.00, 'bmw-m4-gt3-evo-bmw-3840x2160-16968.jpg', 'Education', 710203040),
(36, 17, 'Lorem Ipsum', 25, 'male', 6000.00, 'bmw-m4-gt3-evo-bmw-3840x2160-16968.jpg', 'Computer Science', 710203040);

-- --------------------------------------------------------

--
-- Table structure for table `survey_answer`
--

CREATE TABLE `survey_answer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `friendship` int(1) NOT NULL,
  `privacy` int(1) NOT NULL,
  `cleanliness_level` int(1) NOT NULL,
  `entertainment` int(1) NOT NULL,
  `religious_beliefs` int(1) NOT NULL,
  `friend_over` int(1) NOT NULL,
  `study_mate` int(1) NOT NULL,
  `same_course` int(1) NOT NULL,
  `sharing` int(1) NOT NULL,
  `sleep_schedule` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_answer`
--

INSERT INTO `survey_answer` (`id`, `user_id`, `friendship`, `privacy`, `cleanliness_level`, `entertainment`, `religious_beliefs`, `friend_over`, `study_mate`, `same_course`, `sharing`, `sleep_schedule`) VALUES
(11, 2, 3, 4, 5, 4, 3, 3, 4, 2, 4, 5),
(12, 3, 4, 5, 5, 4, 3, 4, 5, 3, 3, 2),
(13, 4, 2, 3, 4, 5, 1, 3, 4, 5, 2, 4),
(14, 5, 3, 4, 5, 1, 5, 3, 5, 2, 4, 3),
(15, 6, 3, 5, 2, 4, 1, 4, 4, 5, 3, 4),
(16, 7, 3, 5, 3, 2, 4, 4, 5, 2, 1, 3),
(17, 8, 1, 4, 2, 4, 5, 2, 4, 5, 2, 4),
(18, 9, 3, 2, 2, 2, 1, 1, 2, 3, 1, 2),
(19, 10, 2, 4, 3, 2, 4, 1, 3, 3, 4, 1),
(20, 11, 3, 1, 3, 4, 4, 2, 3, 4, 2, 5),
(21, 12, 2, 3, 1, 2, 4, 2, 1, 2, 3, 3),
(23, 14, 4, 4, 4, 1, 2, 1, 1, 2, 2, 1),
(25, 16, 4, 5, 4, 1, 3, 2, 3, 2, 2, 1),
(26, 17, 4, 4, 4, 1, 2, 2, 3, 2, 2, 1),
(27, 13, 4, 5, 4, 1, 2, 1, 3, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `date_created`, `role`) VALUES
(2, 'JoyAchieng', '$2y$10$EJJ3ICg0/cQrJ3IMcuNAC.d9TyCZK/4x014S1nSViNU', '0000-00-00 00:00:00', 0),
(3, 'Susan_Jane', '$2y$10$2mlf2wn5pU.Q/AoftqS1KerkNM7rhbLXCUw.SIyLbiN', '0000-00-00 00:00:00', 0),
(4, 'John_kai', '$2y$10$D7RlExNP5a.VZFXh.gS32.vRLvEnLzA1mzH5JmbkpCY', '0000-00-00 00:00:00', 0),
(5, 'James_King', '$2y$10$5VR8ZOP5rWysB7bvhZ/nXerpYHkZ06sA2Q1voCo5E.d', '0000-00-00 00:00:00', 0),
(6, 'Steve_king', '$2y$10$WPwI/hNeCde3ic7aC8Tu3.a02ZaRygt61Q.TbO0/r9p', '0000-00-00 00:00:00', 0),
(7, 'Mercy_snow', '$2y$10$Z2yhU3eJBZbjcoXyN7n6yuQcO3xI0xnqyyG8iC/VN9E', '0000-00-00 00:00:00', 0),
(8, 'Gabriela', '$2y$10$xOeyBV7xM/2bWMrV.xMM/uxf4hltOf4GgzTboYz6eHd', '0000-00-00 00:00:00', 0),
(9, 'Darius_james', '$2y$10$ffvXwYocAkiFfS5FngvA1OZbdHCSnOmq.2TkdOC7258', '0000-00-00 00:00:00', 0),
(10, 'Matthew', '$2y$10$pjuPHKdFVsRYp0b0TKV2CeVAgjq65t3FRR/wMnyJDPO', '0000-00-00 00:00:00', 0),
(11, 'Jane', '$2y$10$d/I.Q/HCBcTWmSP2lyC06ukFzmMTjqLVDo89OJO1pVm', '0000-00-00 00:00:00', 0),
(12, 'Breona', '$2y$10$YbnmO0r9XmRQ7ANyHC5D8efX0Y/TTQGluTzYJu/2LE3', '0000-00-00 00:00:00', 0),
(13, 'Nelson', '25d55ad283aa400af464c76d713c07ad', '0000-00-00 00:00:00', 1),
(14, 'Test', '25d55ad283aa400af464c76d713c07ad', '0000-00-00 00:00:00', 0),
(15, 'Admin', '25d55ad283aa400af464c76d713c07ad', '0000-00-00 00:00:00', 0),
(16, 'TestUser', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', 1),
(17, 'Lorem', 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `house_id` (`house_id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matched_profile`
--
ALTER TABLE `matched_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `matched_profile_id` (`matched_profile_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_fk` (`user_id`);

--
-- Indexes for table `survey_answer`
--
ALTER TABLE `survey_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id_fk` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `matched_profile`
--
ALTER TABLE `matched_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `survey_answer`
--
ALTER TABLE `survey_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`);

--
-- Constraints for table `matched_profile`
--
ALTER TABLE `matched_profile`
  ADD CONSTRAINT `matched_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `matched_profile_ibfk_2` FOREIGN KEY (`matched_profile_id`) REFERENCES `profile` (`id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
