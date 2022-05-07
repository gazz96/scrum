-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2022 at 03:21 AM
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
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `project_id`, `title`, `created_at`, `updated_at`) VALUES
(33, 1, 'Site Visit', '2022-05-05 05:43:50', '2022-05-05 05:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `card_comments`
--

CREATE TABLE `card_comments` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `card_item_id` bigint(20) NOT NULL,
  `comment` text,
  `comment_parent_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_items`
--

CREATE TABLE `card_items` (
  `id` bigint(20) NOT NULL,
  `card_id` bigint(20) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
  `status` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_items`
--

INSERT INTO `card_items` (`id`, `card_id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'baru test', NULL, '', '2022-05-03 03:27:38', '2022-05-03 03:27:38'),
(2, NULL, 'asdasd', NULL, '', '2022-05-03 03:46:29', '2022-05-03 03:46:29'),
(3, NULL, 'baru lagi', NULL, '', '2022-05-03 03:47:30', '2022-05-03 03:47:30'),
(4, NULL, 'agenda lagi', NULL, '', '2022-05-03 03:47:38', '2022-05-03 03:47:38'),
(5, NULL, 'zczcz', NULL, '', '2022-05-03 03:48:56', '2022-05-03 03:48:56'),
(6, NULL, 'asdasda', NULL, '', '2022-05-03 03:50:42', '2022-05-03 03:50:42'),
(7, NULL, 'xvxvxv', NULL, '', '2022-05-03 03:51:05', '2022-05-03 03:51:05'),
(8, NULL, 'ad', NULL, '', '2022-05-03 04:40:40', '2022-05-03 04:40:40'),
(25, 33, 'Visit Gudang 1 di Peleburan', NULL, NULL, '2022-05-05 05:44:13', '2022-05-05 05:44:13'),
(26, 33, 'Visit Gudang 2 di Paritohan', NULL, NULL, '2022-05-05 05:44:23', '2022-05-05 05:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `card_members`
--

CREATE TABLE `card_members` (
  `id` int(11) NOT NULL,
  `card_item_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) NOT NULL,
  `project_id` bigint(20) DEFAULT NULL,
  `order_code` varchar(150) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `payment_date` date NOT NULL,
  `payment_note` text,
  `receive_amount` double NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'NOT PAID'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
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
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `unit_id`, `pic_id`, `master_id`, `owner_id`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pembuatan Aplikasi S', 1, 3, 4, 5, NULL, NULL, 'DROPPED', '2022-02-20 18:52:28', '2022-02-20 19:10:42');

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
(1, 'Super User', ''),
(3, 'Administrator', ''),
(4, 'Customer', ''),
(5, 'Team', '');

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
(5, 4, 'Owner', 'owner@gmail.com', 'owner', '2022-02-20 17:29:37', '2022-02-20 17:29:37'),
(6, 5, 'Developer', 'developer@gmail.com', 'developer', '2022-02-20 17:29:53', '2022-02-20 17:29:53'),
(7, 4, 'Customer', 'owner@gmail.com', 'owner', '2022-05-06 01:32:26', '2022-05-06 01:32:26'),
(8, 4, 'Owner 1', 'owner@gmail.com', 'owner', '2022-05-06 01:32:30', '2022-05-06 01:32:30'),
(9, 4, 'Owner 2', 'owner@gmail.com', 'owner', '2022-05-06 01:32:41', '2022-05-06 01:32:41'),
(10, 4, 'Owner 3', 'owner@gmail.com', 'owner', '2022-05-06 01:32:41', '2022-05-06 01:32:41'),
(11, 4, 'Owner 4', 'owner@gmail.com', 'owner', '2022-05-06 01:32:52', '2022-05-06 01:32:52'),
(12, 4, 'Owner 5', 'owner@gmail.com', 'owner', '2022-05-06 01:32:52', '2022-05-06 01:32:52'),
(13, 4, 'Owner 6', 'owner@gmail.com', 'owner', '2022-05-06 01:32:52', '2022-05-06 01:32:52'),
(14, 4, 'Owner 7', 'owner@gmail.com', 'owner', '2022-05-06 01:32:52', '2022-05-06 01:32:52'),
(15, 4, 'Owner 8', 'owner@gmail.com', 'owner', '2022-05-06 01:33:06', '2022-05-06 01:33:06'),
(16, 4, 'Owner 9', 'owner@gmail.com', 'owner', '2022-05-06 01:33:06', '2022-05-06 01:33:06'),
(17, 4, 'Owner 10', 'owner@gmail.com', 'owner', '2022-05-06 01:33:06', '2022-05-06 01:33:06'),
(18, 4, 'Owner 11', 'owner@gmail.com', 'owner', '2022-05-06 01:33:06', '2022-05-06 01:33:06'),
(19, 4, 'Owner 12', 'owner@gmail.com', 'owner', '2022-05-06 01:33:06', '2022-05-06 01:33:06'),
(20, 4, 'Owner 13', 'owner@gmail.com', 'owner', '2022-05-06 01:33:06', '2022-05-06 01:33:06'),
(21, 4, 'Owner 14', 'owner@gmail.com', 'owner', '2022-05-06 01:33:06', '2022-05-06 01:33:06'),
(22, 4, 'Owner 15', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(23, 4, 'Owner 16', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(24, 4, 'Owner 17', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(25, 4, 'Owner 18', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(26, 4, 'Owner 19', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(27, 4, 'Owner 20', 'bagas@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(28, 4, 'Owner 21', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(29, 4, 'Owner 22', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(30, 4, 'Owner 23', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(31, 4, 'Owner 24', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(32, 4, 'Owner 25', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(33, 4, 'Owner 26', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(34, 4, 'Owner 27', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(35, 4, 'Owner 28', 'owner@gmail.com', 'owner', '2022-05-06 01:34:02', '2022-05-06 01:34:02'),
(36, 4, 'wew', 'wew@gmail.com', NULL, '2022-05-05 22:04:47', '2022-05-05 22:04:47'),
(37, 4, 'qq', 'qq@gmail.com', NULL, '2022-05-05 22:05:22', '2022-05-05 22:05:22'),
(38, 4, 'zxc', 'zxc@gmail.com', NULL, '2022-05-05 22:07:00', '2022-05-05 22:07:00'),
(39, 4, 'ad', 'ad@gmail.com', NULL, '2022-05-05 22:07:21', '2022-05-05 22:07:21'),
(40, 1, 'Unit', 'unit@gmail.com', NULL, '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(41, 4, 'Owner', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(42, 5, 'Developer', 'developer@gmail.com', 'developer', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(43, 4, 'Customer', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(44, 4, 'Owner 1', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(45, 4, 'Owner 2', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(46, 4, 'Owner 3', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(47, 4, 'Owner 4', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(48, 4, 'Owner 5', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(49, 4, 'Owner 6', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(50, 4, 'Owner 7', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(51, 4, 'Owner 8', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(52, 4, 'Owner 9', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(53, 4, 'Owner 10', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(54, 4, 'Owner 11', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(55, 4, 'Owner 12', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(56, 4, 'Owner 13', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(57, 4, 'Owner 14', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(58, 4, 'Owner 15', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(59, 4, 'Owner 16', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(60, 4, 'Owner 17', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(61, 4, 'Owner 18', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(62, 4, 'Owner 19', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(63, 4, 'Owner 20', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(64, 4, 'Owner 21', 'owner@gmail.com', 'owner', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(65, 4, 'qq', 'wew@gmail.com', NULL, '2022-05-06 07:10:47', '2022-05-06 07:10:47'),
(66, 4, 'awesome', 'awesome@gmail.com', NULL, '2022-05-06 07:13:57', '2022-05-06 07:13:57');

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
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_comments`
--
ALTER TABLE `card_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_items`
--
ALTER TABLE `card_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_members`
--
ALTER TABLE `card_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
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
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `card_comments`
--
ALTER TABLE `card_comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `card_items`
--
ALTER TABLE `card_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `card_members`
--
ALTER TABLE `card_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
