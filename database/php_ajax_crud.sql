-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 12:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_ajax_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `c_id` int(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`c_id`, `city`) VALUES
(1, 'Surat'),
(2, 'Ahemdabad'),
(3, 'Una'),
(4, 'Mumbai'),
(5, 'Pune'),
(6, 'Rajkot'),
(7, 'Vadodara'),
(8, 'Gandhinagar');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `d_id` int(20) NOT NULL,
  `designation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`d_id`, `designation`) VALUES
(1, 'PHP Developer'),
(2, 'Web Developer'),
(3, 'Web Designer'),
(4, 'Teacher'),
(5, 'Laravel Developer'),
(6, 'App Developer'),
(7, 'Software Engineer');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `g_id` int(50) NOT NULL,
  `gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`g_id`, `gender`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(50) NOT NULL,
  `question_id` int(50) NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `options` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `question_id`, `is_correct`, `options`) VALUES
(1, 1, 1, 'PHP: Hypertext Preprocessor'),
(2, 1, 0, 'Private Home Page'),
(3, 1, 0, 'Personal Hypertext Processor'),
(4, 1, 0, 'Personal Home Page'),
(5, 2, 0, '<&>.....</&>'),
(6, 2, 0, '<script>.....</script>'),
(7, 2, 0, '<?php>.....</?>'),
(21, 6, 0, 'v'),
(22, 6, 1, 'a'),
(23, 7, 1, 'b'),
(24, 7, 0, 'b'),
(25, 7, 0, 'b'),
(40, 13, 0, 'u'),
(41, 13, 0, 'u'),
(42, 13, 1, 'u'),
(43, 13, 0, 'u'),
(44, 14, 0, 's'),
(45, 14, 1, 's'),
(46, 14, 0, 's'),
(47, 15, 0, '<javascript>'),
(48, 15, 1, '<script>'),
(49, 15, 0, '<js>'),
(50, 15, 0, '<scripting>');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `questions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `questions`) VALUES
(1, 'What does PHP stand for?'),
(2, 'PHP server scripts are surrounded by delimiters, which?'),
(6, 'aaaaaa'),
(7, 'bbbbbb'),
(13, 'uuuuuu'),
(14, 'ssssss'),
(15, 'Inside which HTML element do we put the JavaScript?');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `quiz_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `time_limit` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quiz_id`, `title`, `description`, `time_limit`) VALUES
(1, 'PHP', 'aaaaaaaaaaaa', '10:00'),
(5, 'HTML', 'hhhhhh', '10:00'),
(10, 'SQL', 'ssssssssss', '10:00'),
(12, 'JavaScript', 'jjjjjjjjjjj', '10:00'),
(13, 'Java', 'jjj', '10:00');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_assignments`
--

CREATE TABLE `quiz_assignments` (
  `assignment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `assignment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_assignments`
--

INSERT INTO `quiz_assignments` (`assignment_id`, `user_id`, `quiz_id`, `assignment_date`) VALUES
(1, 5, 1, '2023-10-11 07:39:43'),
(2, 8, 5, '2023-10-11 07:40:02'),
(3, 9, 5, '2023-10-11 07:40:02'),
(4, 5, 13, '2023-10-11 07:43:29'),
(5, 5, 10, '2023-10-11 07:43:46'),
(6, 10, 10, '2023-10-11 07:43:46'),
(7, 11, 1, '2023-10-11 07:44:50'),
(8, 11, 5, '2023-10-11 07:44:51'),
(9, 12, 1, '2023-10-11 07:44:51'),
(10, 12, 5, '2023-10-11 07:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_question_association`
--

CREATE TABLE `quiz_question_association` (
  `association_id` int(50) NOT NULL,
  `quiz_id` int(50) NOT NULL,
  `question_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_question_association`
--

INSERT INTO `quiz_question_association` (`association_id`, `quiz_id`, `question_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 10, 6),
(4, 10, 7),
(5, 1, 13),
(6, 13, 6);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `taken_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `r_id` int(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`r_id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `r_id` int(255) NOT NULL,
  `image` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` bigint(50) NOT NULL,
  `g_id` int(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `c_id` int(255) NOT NULL,
  `d_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `r_id`, `image`, `name`, `email`, `contact`, `g_id`, `password`, `c_id`, `d_id`) VALUES
(5, 2, 'tanishka.jpg', 'Tanishka', 'tanishka@gmail.com', 9876541230, 2, '123', 2, 6),
(7, 1, 'rose.jfif', 'Admin', 'admin@gmail.com', 9876543210, 1, '123', 2, 1),
(8, 2, 'ARB image.png', 'Ronak', 'ronak@gmail.com', 9876543210, 1, '123', 1, 2),
(9, 2, 'multi.jfif', 'Naitik', 'naitik@gmail.com', 9876543210, 1, '123', 8, 3),
(10, 2, 'img.jfif', 'Avani', 'avani@gmail.com', 9876543210, 2, '123', 3, 3),
(11, 2, 'flower.jfif', 'Shruti', 'shruti@gmail.com', 9876543210, 2, '123', 6, 6),
(12, 2, 'white.jfif', 'Nirali', 'nirali@gmail.com', 9876543210, 2, '123', 4, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `options_ibfk_1` (`question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_assignments`
--
ALTER TABLE `quiz_assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_question_association`
--
ALTER TABLE `quiz_question_association`
  ADD PRIMARY KEY (`association_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_id` (`r_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `d_id` (`d_id`),
  ADD KEY `g_id` (`g_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `c_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `d_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `g_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quiz_assignments`
--
ALTER TABLE `quiz_assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quiz_question_association`
--
ALTER TABLE `quiz_question_association`
  MODIFY `association_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `r_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz_assignments`
--
ALTER TABLE `quiz_assignments`
  ADD CONSTRAINT `quiz_assignments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `quiz_assignments_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);

--
-- Constraints for table `quiz_question_association`
--
ALTER TABLE `quiz_question_association`
  ADD CONSTRAINT `quiz_question_association_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`),
  ADD CONSTRAINT `quiz_question_association_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `quiz_results_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`quiz_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`r_id`) REFERENCES `roles` (`r_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `city` (`c_id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`d_id`) REFERENCES `designation` (`d_id`),
  ADD CONSTRAINT `users_ibfk_4` FOREIGN KEY (`g_id`) REFERENCES `gender` (`g_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
