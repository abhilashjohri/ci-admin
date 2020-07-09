-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2020 at 04:15 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_code` varchar(50) NOT NULL,
  `default_landing_page` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 for active 0 for inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_code`, `default_landing_page`, `status`) VALUES
(1, 'Super Admin', 'SA', 'admin/dashboard', 1),
(2, 'Group Admin', 'GA', 'admin/dashboard', 1),
(3, 'Tenant Admin', 'TA', 'admin/dashboard', 1),
(4, 'Tenant User', 'TU', 'admin/dashboard', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_task`
--

CREATE TABLE `role_task` (
  `role_task_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_task`
--

INSERT INTO `role_task` (`role_task_id`, `role_id`, `task_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_controller` varchar(255) NOT NULL,
  `task_function` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1 for active and 0 for inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `task_controller`, `task_function`, `status`) VALUES
(1, 'dashboard', 'admin', 'dashboard', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `buisness_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `default_preferences` varchar(100) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `theme` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for dark and 2 for light',
  `is_email_alerts` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `is_sms_alerts` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `is_chat_alerts` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for active and 0 for inactive',
  `is_email_notification` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for active and 2 for inactive',
  `is_sms_notification` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for active and 2 for inactive',
  `is_chat_notification` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 for active and 2 for inactive',
  `status` tinyint(1) NOT NULL COMMENT '1 for active and 0 for inactive',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `last_login_ip_address` varchar(20) NOT NULL,
  `last_login_date` varchar(20) NOT NULL,
  `access_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role_id`, `parent_id`, `first_name`, `last_name`, `buisness_name`, `email`, `password`, `salt`, `address`, `phone_number`, `default_preferences`, `profile_image`, `theme`, `is_email_alerts`, `is_sms_alerts`, `is_chat_alerts`, `is_email_notification`, `is_sms_notification`, `is_chat_notification`, `status`, `created_date`, `updated_date`, `last_login_ip_address`, `last_login_date`, `access_token`) VALUES
(1, 1, 0, 'Admin', 'Admin', '', 'admin@admin.com', '9beba82a993948c7a51c5a1bedb83725abe486b8', '888d8ba176', 'dsfsdfsdfsdf', '(123) 456-7890', '', '20161026074930.jpeg', 1, 0, 0, 0, 1, 1, 1, 1, '0000-00-00 00:00:00', '2016-10-25 15:52:14', '127.0.0.1', '2016-11-02 12:55:00', ''),
(2, 2, 1, 'Group', 'Admin', '', 'groupadmin@gmail.com', 'f9b6f0299228cb2646454605570faf9b8746776a', '660e6e31f9', 'testing', '(111) 111-1110', '', '', 1, 1, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '2016-10-27 07:44:31', '127.0.0.1', '2016-10-27 07:43:35', ''),
(3, 3, 2, 'Tenant', 'Admin', 'testing', 'tenantadmin@gmail.com', '62c3acc7ce2260700cd81ff06138519de9823f26', '0e3f42a0a5', 'testing', '(111) 111-1110', '', '', 1, 1, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '2016-10-25 15:54:00', '127.0.0.1', '2016-10-26 08:54:26', ''),
(4, 4, 3, 'Tenant User', 'testing', 'testing', 'tenantuser@gmail.com', '505ab7bcfc3448758447ae6c6c409bcf7fb4dcfb', '37d12d18a8', 'testing', '(111) 111-1110', '', '', 1, 1, 1, 1, 1, 1, 1, 1, '0000-00-00 00:00:00', '2016-10-26 09:21:28', '127.0.0.1', '2016-10-26 09:21:16', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_task`
--
ALTER TABLE `role_task`
  ADD PRIMARY KEY (`role_task_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_task`
--
ALTER TABLE `role_task`
  MODIFY `role_task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
