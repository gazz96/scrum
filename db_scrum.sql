-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2022 at 04:39 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_scrum`
--

-- --------------------------------------------------------

--
-- Table structure for table `backlogs`
--

CREATE TABLE `backlogs` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `module_name` varchar(150) NOT NULL,
  `plan` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `developer_id` bigint(20) DEFAULT NULL,
  `period_start` date DEFAULT NULL,
  `period_end` date DEFAULT NULL,
  `actual_period_start` date DEFAULT NULL,
  `actual_period_end` date DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `backlogs_rules`
--

CREATE TABLE `backlogs_rules` (
  `id` bigint(20) NOT NULL,
  `backlog_id` bigint(20) DEFAULT NULL,
  `name` text,
  `is_done` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `id` bigint(20) NOT NULL,
  `sprint_id` bigint(20) NOT NULL,
  `comment` text NOT NULL,
  `solution` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `unit_id` bigint(20) DEFAULT NULL,
  `pic_id` bigint(20) DEFAULT NULL,
  `master_id` bigint(20) DEFAULT NULL,
  `owner_id` bigint(20) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `unit_id`, `pic_id`, `master_id`, `owner_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pembuatan Aplikasi S', 1, 3, 4, 5, 'DROPPED', '2022-02-20 18:52:28', '2022-02-20 19:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `info`) VALUES
(1, 'Unit', ''),
(2, 'Pic', ''),
(3, 'Scrum master', ''),
(4, 'Owner', ''),
(5, 'Developer', '');

-- --------------------------------------------------------

--
-- Table structure for table `sprints`
--

CREATE TABLE `sprints` (
  `id` bigint(20) NOT NULL,
  `backlog_id` bigint(20) NOT NULL,
  `plan` text,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `actual_start` date DEFAULT NULL,
  `actual_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) NOT NULL,
  `name` varchar(75) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Finance', '2022-02-21 00:43:40', '2022-02-21 01:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `userpass` varchar(75) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `userpass`, `created_at`, `updated_at`) VALUES
(2, 1, 'Unit', 'unit@gmail.com', NULL, '2022-02-20 08:23:19', '2022-02-20 17:28:45'),
(3, 2, 'PIC', 'pic@gmail.com', 'pic', '2022-02-20 17:28:30', '2022-02-20 17:28:30'),
(4, 3, 'Scrum Master', 'scrum_master@gmail.com', 'scrummaster', '2022-02-20 17:29:20', '2022-02-20 17:29:20'),
(5, 4, 'Owner', 'owner@gmail.com', 'owner', '2022-02-20 17:29:37', '2022-02-20 17:29:37'),
(6, 5, 'Developer', 'developer@gmail.com', 'developer', '2022-02-20 17:29:53', '2022-02-20 17:29:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backlogs`
--
ALTER TABLE `backlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backlogs_rules`
--
ALTER TABLE `backlogs_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sprints`
--
ALTER TABLE `sprints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_constraint` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backlogs`
--
ALTER TABLE `backlogs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backlogs_rules`
--
ALTER TABLE `backlogs_rules`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sprints`
--
ALTER TABLE `sprints`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `roles_constraint` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
