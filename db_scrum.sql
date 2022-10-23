-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2022 at 04:48 AM
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
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `start_work` datetime DEFAULT NULL,
  `end_work` datetime DEFAULT NULL,
  `start_rest` datetime DEFAULT NULL,
  `end_rest` datetime DEFAULT NULL,
  `note` text,
  `location` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 3, 'Main Section', '2022-05-14 02:23:32', '2022-05-14 02:23:32'),
(2, 4, 'Revisi', '2022-05-19 19:33:15', '2022-05-19 19:33:15'),
(3, 3, 'Secondary Section', '2022-06-03 20:50:49', '2022-06-03 20:50:49');

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
(11, 1, 'Item', '', 'Completed', '2022-05-15 04:35:43', '2022-05-15 04:37:40'),
(12, 1, 'Item', '', 'Completed', '2022-05-15 04:35:43', '2022-06-03 20:48:28'),
(13, 1, 'Item', NULL, NULL, '2022-05-15 04:35:51', '2022-05-15 04:35:51'),
(14, 2, 'Rubah website font. Use Quicken Font ', NULL, NULL, '2022-05-19 19:33:30', '2022-05-19 19:33:30'),
(15, 2, 'VA Loan Forms', ' - Gunakan icon dimana memungkinkan, masih banyak yg text (more user friendly)\n - Beberapa Buttons perlu dibuat centered\n - Slider dibagian yg input nominal $:\n     Minimum number $100,000\n     Maximum number $2,000,0000\n     slide increment $25,000', '', '2022-05-19 19:33:37', '2022-05-19 19:33:54'),
(16, 2, 'Pop-Up agreement to accept cookies', ' (check plugin WP yg cocok, cth: https://wordpress.org/plugins/cookie-law-info/)', 'Completed', '2022-05-19 19:34:05', '2022-05-20 03:04:47'),
(17, 2, 'Tolong periksa lagi no telp pastikan  833-888-3863', '', 'Completed', '2022-05-19 19:34:26', '2022-05-20 03:05:00'),
(18, 2, ' Masih ada beberapa link ke justfundedmortgage.com dan unitemortgage.com', '', 'Completed', '2022-05-19 19:34:37', '2022-05-20 03:05:04'),
(19, 2, 'Tulisan VA pastikan pakai huruf kapital VA', '', 'Completed', '2022-05-19 19:35:29', '2022-05-20 03:05:08'),
(21, 3, 'Secondary Item', NULL, NULL, '2022-06-03 20:50:59', '2022-06-03 20:50:59');

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
  `customer_id` bigint(20) NOT NULL,
  `project_id` bigint(20) DEFAULT NULL,
  `order_code` varchar(150) DEFAULT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_note` text,
  `total_amount` double NOT NULL DEFAULT '0',
  `receive_amount` double NOT NULL DEFAULT '0',
  `status` varchar(30) NOT NULL DEFAULT 'NOT PAID',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_id`, `project_id`, `order_code`, `issue_date`, `due_date`, `payment_date`, `payment_note`, `total_amount`, `receive_amount`, `status`, `created_at`, `updated_at`) VALUES
(8, 27, 3, NULL, '2022-05-13', '2022-05-13', NULL, NULL, 1000000, 0, 'Paid', '2022-05-13 00:26:22', '2022-05-13 18:34:31'),
(9, 43, NULL, NULL, '2022-05-19', '2022-05-31', NULL, NULL, 1000000, 0, 'Not Paid', '2022-05-19 00:27:36', '2022-05-19 00:27:36'),
(10, 65, 3, NULL, '2022-06-04', '2022-06-04', NULL, NULL, 1000000, 0, 'Not Paid', '2022-06-03 20:35:11', '2022-06-03 20:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) NOT NULL,
  `invoice_id` bigint(20) NOT NULL,
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
  `code` varchar(150) DEFAULT NULL,
  `customer_id` bigint(20) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `code`, `customer_id`, `name`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 27, 'Pembuatan Aplikasi S', '2022-05-07', '2022-05-07', 'Active', '2022-02-20 18:52:28', '2022-05-07 08:51:27'),
(3, 'No. Kontrak', 64, 'Project Pemasangan Lampu', '2022-05-08', '2022-05-16', 'Completed', '2022-05-07 08:42:05', '2022-05-07 09:12:30'),
(4, '', 65, 'Justfunded.com', '2022-05-20', '2022-05-29', 'Active', '2022-05-19 19:22:09', '2022-05-19 19:22:09');

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
(6, 5, 'Developer', 'developer@gmail.com', 'developer', '2022-02-20 17:29:53', '2022-02-20 17:29:53'),
(40, 1, 'Unit', 'unit@gmail.com', NULL, '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(42, 5, 'Developer', 'developer@gmail.com', 'developer', '2022-05-06 10:24:15', '2022-05-06 10:24:15'),
(65, 4, 'Rangga Djati', 'rangga101@gmail.com', NULL, '2022-05-19 19:15:09', '2022-06-03 22:44:23'),
(66, 4, 'Another Customer', 'another@gmail.com', NULL, '2022-06-03 20:43:36', '2022-06-03 22:44:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `card_comments`
--
ALTER TABLE `card_comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `card_items`
--
ALTER TABLE `card_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `card_members`
--
ALTER TABLE `card_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
