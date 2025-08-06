-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:33033
-- Generation Time: Aug 01, 2025 at 09:13 AM
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
-- Database: `hitech_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply_funcion_for_role`
--

CREATE TABLE `apply_funcion_for_role` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `main_function_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sub_function_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `action_edit` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `action_delete` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apply_funcion_for_role`
--

INSERT INTO `apply_funcion_for_role` (`id`, `role_id`, `main_function_id`, `sub_function_id`, `action_edit`, `action_delete`) VALUES
(8, 70, '1,2,3,4,5,6,7', '1,2,3,4,5,15,6,7,8,16,9,10,11,12,13,14,101', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `borrow_id` bigint(20) UNSIGNED NOT NULL,
  `pro_id` int(11) NOT NULL,
  `staff_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `borrow_date` date DEFAULT NULL,
  `borrow_purpose` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `borrow_qty` int(11) NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `borrow_status` int(11) NOT NULL DEFAULT 0,
  `approve_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `approve_date` date DEFAULT NULL,
  `owner` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `payback_date` date DEFAULT NULL,
  `payback_status` int(11) NOT NULL DEFAULT 1,
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `notification` int(11) DEFAULT 1,
  `flash_notification` int(11) DEFAULT 1,
  `request_datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `add_by`, `create_date`, `delete_status`, `delete_by`, `delete_date`, `year`) VALUES
(16, 'Laptop', 'Ra Mey', '2025-03-21 03:17:59', 1, '', NULL, '2025'),
(17, 'Desktop', 'Ra Mey', '2025-03-21 03:18:06', 1, '', NULL, '2025'),
(18, 'Monitor', 'Ra Mey', '2025-03-21 03:18:17', 1, '', NULL, '2025'),
(19, 'Printer', 'Ra Mey', '2025-03-21 03:18:25', 1, '', NULL, '2025'),
(20, 'Mouse', 'Ra Mey', '2025-03-21 03:18:34', 1, '', NULL, '2025'),
(21, 'Mouse Pad', 'Ra Mey', '2025-03-21 03:18:50', 1, '', NULL, '2025'),
(22, 'Keyboard', 'Ra Mey', '2025-03-21 03:19:12', 1, '', NULL, '2025'),
(23, 'Hardisk', 'Ra Mey', '2025-03-21 03:19:28', 1, '', NULL, '2025'),
(24, 'Toner Printer', 'Ra Mey', '2025-03-21 03:19:48', 1, '', NULL, '2025'),
(25, 'External Hard drive', 'Ra Mey', '2025-03-21 03:20:29', 1, '', NULL, '2025'),
(26, 'USB', 'Ra Mey', '2025-03-21 03:23:39', 1, '', NULL, '2025'),
(27, 'USB Wifi', 'Ra Mey', '2025-03-21 03:23:27', 0, 'Admin', '2025-03-21', '2025'),
(28, 'Adapter', 'Ra Mey', '2025-03-21 03:21:23', 1, '', NULL, '2025'),
(29, 'Cable', 'Ra Mey', '2025-03-21 03:24:28', 1, '', NULL, '2025'),
(30, 'USB wifi', 'Sok Vitou', '2025-03-26 19:50:25', 1, '', NULL, '2025'),
(31, 'SSD', 'Sok Vitou', '2025-03-30 21:13:33', 1, '', NULL, '2025'),
(32, 'bag', 'Sok Vitou', '2025-03-31 02:06:37', 1, '', NULL, '2025'),
(33, 'Battery-UPS', 'Sok Vitou', '2025-03-31 02:09:47', 1, '', NULL, '2025'),
(34, 'UPS', 'Sok Vitou', '2025-04-30 23:53:20', 1, NULL, NULL, '2025'),
(35, 'Tablet', 'Sok Vitou', '2025-05-21 20:00:38', 1, NULL, NULL, '2025'),
(36, 'All in one', 'Sok Vitou', '2025-07-10 20:52:02', 1, NULL, NULL, '2025'),
(37, 'Charger', 'Sok Vitou', '2025-07-10 23:54:35', 1, NULL, NULL, '2025'),
(38, 'TV', 'Sok Vitou', '2025-07-11 21:33:03', 1, NULL, NULL, '2025'),
(39, 'Pen Tablet', 'Sok Vitou', '2025-07-11 21:52:04', 1, NULL, NULL, '2025'),
(40, 'Projector', 'Sok Vitou', '2025-07-11 21:56:33', 1, NULL, NULL, '2025'),
(41, 'HDMI', 'Sok Vitou', '2025-07-12 02:07:51', 1, NULL, NULL, '2025'),
(42, 'Case', 'Sok Vitou', '2025-07-13 19:01:49', 1, NULL, NULL, '2025'),
(43, 'Wi-Fi', 'Sok Vitou', '2025-07-13 19:57:54', 1, NULL, NULL, '2025'),
(44, 'Switch', 'Sok Vitou', '2025-07-29 23:28:47', 1, NULL, NULL, '2025'),
(45, 'Camera', 'Sok Vitou', '2025-07-29 23:32:14', 1, NULL, NULL, '2025');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_code` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `dep_name_kh` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dep_name_en` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_code`, `dep_name_kh`, `dep_name_en`, `add_by`, `create_date`, `delete_status`, `delete_by`, `delete_date`, `year`) VALUES
(2, '12001', 'ព័ត៌មានវិទ្យា', 'Information Technology', 'Voeurn Sokheng', '2025-03-20 09:54:54', 1, '', '0000-00-00', '2025'),
(3, '', 'ផលិតកម្ម', 'Production', 'Voeurn Sokheng', '2025-03-25 07:32:26', 1, '', '0000-00-00', '2025'),
(4, '', 'លក់ទឹកកេស', 'Sale(bottle)', 'Sok Vitou', '2025-03-25 08:07:00', 1, '', '0000-00-00', '2025'),
(5, '10111', 'ឃ្លាំង និងដឹកជញ្ជូន', 'WH&Logistic', 'Sok Vitou', '2025-07-12 08:01:46', 1, '', '0000-00-00', '2025'),
(6, '', 'ទីផ្សារ', 'Marketing', 'Sok Vitou', '2025-03-25 08:08:14', 1, '', '0000-00-00', '2025'),
(7, '', 'ហិរញ្ញវត្ថុ', 'Finance', 'Sok Vitou', '2025-03-25 08:10:31', 1, '', '0000-00-00', '2025'),
(8, '', 'ធនធានមនុស្ស', 'Human resources', 'Sok Vitou', '2025-03-25 08:11:11', 1, '', '0000-00-00', '2025'),
(9, '', 'លក់ទឹកធុង', 'Sale(gallon)', 'Sok Vitou', '2025-03-25 08:12:35', 1, '', '0000-00-00', '2025');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `give_table`
--

CREATE TABLE `give_table` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `add_by` varchar(255) DEFAULT NULL,
  `return_status` int(11) NOT NULL DEFAULT 1,
  `given_date` datetime DEFAULT current_timestamp(),
  `returned_date` datetime DEFAULT NULL,
  `return_any_product` varchar(255) DEFAULT NULL,
  `any_return_status` int(11) NOT NULL DEFAULT 1 COMMENT '1 for not return and 0 for returned',
  `constant_proid` varchar(255) DEFAULT NULL,
  `year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `give_table`
--

INSERT INTO `give_table` (`id`, `staff_id`, `product_id`, `qty`, `date`, `attachment`, `add_by`, `return_status`, `given_date`, `returned_date`, `return_any_product`, `any_return_status`, `constant_proid`, `year`) VALUES
(5, '198', '123', '1', '2025-03-25', 'uploads/give-atts/4SybscnoCI0DzcfIYjRk3Tq8khmCUCdZy5IWxIh1.jpg', 'Sok Vitou', 1, '2025-03-25 15:15:04', '0000-00-00 00:00:00', '', 1, '', '2025'),
(6, '201', '120', '1', '2025-03-24', 'uploads/give-atts/deqFXgxOA8NmGWu026kJbCdnn0dx5bctQeHVY64Y.jpg', 'Sok Vitou', 1, '2025-03-26 08:55:28', '0000-00-00 00:00:00', '', 1, '', '2025'),
(7, '201', '110', '1', '2025-03-24', 'uploads/give-atts/3gVu6uH5Vic48ONvth4F5GusOVYx8xyzc6QwS3h4.jpg', 'Sok Vitou', 1, '2025-03-26 09:08:16', '0000-00-00 00:00:00', '', 1, '', '2025'),
(8, '201', '121', '1', '2025-03-24', 'uploads/give-atts/6Px0MJZeVWDshujgCidllqU5hseWMpndhobSUlSV.jpg', 'Sok Vitou', 1, '2025-03-26 09:09:15', '0000-00-00 00:00:00', '', 1, '', '2025'),
(9, '201', '128', '1', '2025-03-24', 'uploads/give-atts/4HTgVMTHu4GKmXtt7UwVZ0rFKdBFSFgXVmwbyE2h.jpg', 'Sok Vitou', 1, '2025-03-26 09:09:49', '0000-00-00 00:00:00', '', 1, '', '2025'),
(10, '202', '125', '1', '2025-03-26', 'uploads/give-atts/xiaWB1AAXMwZ4c600KiRIOMmA4ZXPPzt9V0tK4hX.jpg', 'Sok Vitou', 1, '2025-03-27 09:43:44', '0000-00-00 00:00:00', '', 1, '', '2025'),
(11, '202', '124', '1', '2025-03-26', 'uploads/give-atts/DVGDCimDhLYQmhj7dYzok5tcv0hk12VW6bFOLZCS.jpg', 'Sok Vitou', 1, '2025-03-27 09:44:20', '0000-00-00 00:00:00', '', 1, '', '2025'),
(12, '202', '127', '1', '2025-03-26', 'uploads/give-atts/nB891o0VIBubHQunwNLY9TXbLNLigg0TeZcODjLT.jpg', 'Sok Vitou', 1, '2025-03-27 09:45:50', '0000-00-00 00:00:00', '', 1, '', '2025'),
(13, '202', '126', '1', '2025-03-26', 'uploads/give-atts/kh9xO82jFzQklWq2baeQzKXbQvghTtNbXMYnwZun.jpg', 'Sok Vitou', 1, '2025-03-27 09:46:20', '0000-00-00 00:00:00', '', 1, '', '2025'),
(14, '202', '129', '1', '2025-03-26', 'uploads/give-atts/YGunpZUFWSp5oPVnlKkVvB0EmObOxSSNhGxvCnTn.jpg', 'Sok Vitou', 1, '2025-03-27 09:47:40', '0000-00-00 00:00:00', '', 1, '', '2025'),
(15, '202', '131', '1', '2025-03-26', 'uploads/give-atts/1FqqkOW4EyP8XJ27go26imv00UeenQpXCS08AJLJ.jpg', 'Sok Vitou', 1, '2025-03-27 09:52:37', '0000-00-00 00:00:00', '', 1, '', '2025'),
(16, '203', '137', '1', '2025-03-31', 'uploads/give-atts/KojpEwhzFhtPxBVHXY5Sm6ngTfhrv6rGxBKWgwBF.jpg', 'Sok Vitou', 1, '2025-03-31 16:01:36', '0000-00-00 00:00:00', '', 1, '', '2025'),
(17, '203', '136', '1', '2025-03-31', 'uploads/give-atts/OkoHHZCc2XdiDJ8kzHOJt3MMaVhdUgePIzyfEaTg.jpg', 'Sok Vitou', 1, '2025-03-31 16:02:31', '0000-00-00 00:00:00', '', 1, '', '2025'),
(18, '203', '135', '1', '2025-03-31', 'uploads/give-atts/gCiNnMmJiKY7IvGwUESOZUOwqkVTPCtHjYC40nqb.jpg', 'Sok Vitou', 1, '2025-03-31 16:03:12', '0000-00-00 00:00:00', '', 1, '', '2025'),
(19, '203', '134', '1', '2025-03-31', 'uploads/give-atts/e04ZP5Vak0yheHyatVWuzYsQ6y24vH8SsiGx2VKh.jpg', 'Sok Vitou', 1, '2025-03-31 16:03:39', '0000-00-00 00:00:00', '', 1, '', '2025'),
(20, '202', '153', '1', '2025-03-26', 'uploads/give-atts/Nbxeur1KQ2LVL4BaGdLOerLkPXFzNYfXsfSnvmjZ.jpg', 'Sok Vitou', 1, '2025-04-02 11:39:36', '0000-00-00 00:00:00', '', 1, '', '2025'),
(21, '198', '152', '1', '2025-03-25', 'uploads/give-atts/V0tt85EaO65ysLOxVk74Q6dwjNGXNbu50hPRXtwR.jpg', 'Sok Vitou', 1, '2025-04-02 11:40:26', '0000-00-00 00:00:00', '', 1, '', '2025'),
(22, '202', '109', '1', '2025-03-28', 'uploads/give-atts/SsJ8o21aypP8T4M8TbXZXuRICwwGbL3WMMjJA41X.jpg', 'Sok Vitou', 1, '2025-04-02 11:41:19', '0000-00-00 00:00:00', '', 1, '', '2025'),
(23, '206', '111', '1', '2025-04-01', 'uploads/give-atts/ZnVMuqvgydIoytAWctn1U5JYEoHhIjJMa2VP6Je9.jpg', 'Sok Vitou', 1, '2025-04-02 15:13:12', '0000-00-00 00:00:00', '', 1, '', '2025'),
(24, '205', '154', '2', '2025-03-31', 'uploads/give-atts/Lqg6aGch7f7F6AN6JAr4UAiD0kbX6Ofk26h5OyHP.jpg', 'Sok Vitou', 1, '2025-04-02 15:13:56', '0000-00-00 00:00:00', '', 1, '', '2025'),
(25, '209', '147', '1', '2025-04-02', 'uploads/give-atts/ZHXeP4jEnSllemzciuUjXWd9J6NGcFmyvkoqkXVC.jpg', 'Sok Vitou', 1, '2025-04-05 16:05:13', '0000-00-00 00:00:00', '', 1, '', '2025'),
(26, '208', '148', '1', '2025-04-02', 'uploads/give-atts/u52mro2bODO52wXSfvcUrhEdnAi1KwIZ4A0gYH89.jpg', 'Sok Vitou', 1, '2025-04-05 16:08:55', '0000-00-00 00:00:00', '', 1, '', '2025'),
(27, '207', '149', '1', '2025-04-02', 'uploads/give-atts/ZPT7ADAaaqwU9kKHz12x3O5Ghdgm6hf1ASX5g4E9.jpg', 'Sok Vitou', 1, '2025-04-05 16:24:39', '0000-00-00 00:00:00', '', 1, '', '2025'),
(28, '210', '112', '1', '2025-04-01', 'uploads/give-atts/6rXoZDsUD2lt8k3VGJvOxeynTFn4z8qJADeiFcAg.jpg', 'Sok Vitou', 1, '2025-04-05 16:34:19', '0000-00-00 00:00:00', '', 1, '', '2025'),
(29, '211', '133', '1', '2025-04-03', 'uploads/give-atts/9kKywEZmJ9QWdsFHlVXbi0vcQ90FNXw00dgmMu0o.jpg', 'Sok Vitou', 1, '2025-04-05 16:39:17', '0000-00-00 00:00:00', '', 1, '', '2025'),
(30, '202', '132', '1', '2025-04-04', 'uploads/give-atts/sCGAhEMAExpIqnY9mMsAptdtFiLhOhikgLTXXAdL.jpg', 'Sok Vitou', 1, '2025-04-05 16:40:26', '0000-00-00 00:00:00', '', 1, '', '2025'),
(35, '8382', '159,158,157,156,155', NULL, '2025-04-28', 'uploads/give-atts/pOks0iAjuxqgKOilQLrc9InBo7rcjUfffRBNqGAI.jpg', 'Sok Vitou', 1, '2025-05-01 13:43:07', NULL, NULL, 1, '159,158,157,156,155', '2025'),
(36, '8383', '165,164,163,162,161,160', NULL, '2025-04-28', 'uploads/give-atts/6wXROagWNW6gHYheZsSplFujihqV5hLepsZ5mGeN.jpg', 'Sok Vitou', 1, '2025-05-01 13:56:46', NULL, NULL, 1, '165,164,163,162,161,160', '2025'),
(37, '8384', '167,166', NULL, '2025-04-23', 'uploads/give-atts/1i2jnynqVMeCPX9ut5wwkRpzH1qia6bBR9NCaXPH.jpg', 'Sok Vitou', 1, '2025-05-01 14:12:10', NULL, NULL, 1, '167,166', '2025'),
(38, '8385', '168', NULL, '2025-04-23', 'uploads/give-atts/Q2ZO0RH1HPnUkl8lzCjHIHCOlXZ3b6XFvCWiyPX6.jpg', 'Sok Vitou', 1, '2025-05-01 14:54:10', NULL, NULL, 1, '168', '2025'),
(39, '8386', '174,173,172,171,170,169', NULL, '2025-04-23', 'uploads/give-atts/uR01TBDhAoOczWRmhTc4yGsdsO2OkFHXLIJg00Ga.jpg', 'Sok Vitou', 1, '2025-05-01 15:03:41', NULL, NULL, 1, '174,173,172,171,170,169', '2025'),
(40, '8387', '106', NULL, '2025-04-23', 'uploads/give-atts/9d7IEMKlqwCuWvfkrJ4ZMz6JyLrEXoVlMTfUF1aa.jpg', 'Sok Vitou', 1, '2025-05-01 15:17:55', NULL, NULL, 1, '106', '2025'),
(41, '8389', '185,184,183,182,181', NULL, '2025-05-09', 'uploads/give-atts/fdxBGhH1F7zYpT0LxWykzz4DZSVPBtSLSyvde6LV.jpg', 'Sok Vitou', 1, '2025-05-22 11:03:44', NULL, NULL, 1, '185,184,183,182,181', '2025'),
(42, '202', '150', NULL, '2025-05-02', 'uploads/give-atts/E5h60P7tt6Fchh6xTuWWL3P7XVlkx1lBQGSRj00a.jpg', 'Sok Vitou', 1, '2025-05-22 11:06:27', NULL, NULL, 1, '150', '2025'),
(43, '8391', '180,179,178,177,176', NULL, '2025-05-12', 'uploads/give-atts/MGE7WCc45kDaJhPg9PJEnUpymhHgV7u9zxo0tx2s.jpg', 'Sok Vitou', 1, '2025-05-22 11:11:24', NULL, NULL, 1, '180,179,178,177,176', '2025'),
(44, '8388', '186,175', NULL, '2025-05-01', 'uploads/give-atts/wVFTPEHlwfX1VO95SMkIHO48oHB6c4woqAgCj4R3.jpg', 'Sok Vitou', 1, '2025-05-22 11:14:06', NULL, NULL, 1, '186,175', '2025'),
(45, '8392', '187,145,122,119', NULL, '2025-05-01', 'uploads/give-atts/az5pq9ip7sviOq3kSOSChK574S7ALReXG9dllWqd.jpg', 'Sok Vitou', 1, '2025-06-26 09:51:44', NULL, NULL, 1, '187,145,122,119', '2025'),
(46, '202', '151', NULL, '2025-05-02', 'uploads/give-atts/cVMgDbxD1adBO9ejQkuQ6h4BQADuHyw9rQqhBjd6.jpg', 'Sok Vitou', 0, '2025-06-26 09:59:54', '2025-07-17 16:20:30', '151', 0, '151', '2025'),
(47, '8393', '189,188,141,140,138', NULL, '2025-04-23', 'uploads/give-atts/zOdCTVquZskHbJYDdwP2F4ECA1LBA3IW9DFjhDlG.jpg', 'Sok Vitou', 1, '2025-06-26 10:24:38', NULL, NULL, 1, '189,188,141,140,138', '2025'),
(48, '8394', '143,142', NULL, '2025-05-22', 'uploads/give-atts/M5rdnO2F7ixFVIL90x03OwrJTIt9phc7GnN2OZUK.jpg', 'Sok Vitou', 1, '2025-06-26 10:50:28', NULL, NULL, 1, '143,142', '2025'),
(49, '8395', '144', NULL, '2025-01-03', 'uploads/give-atts/sUBqv3sKzIqAPqbYfAQWQWxOXm0g75DK8wz0RHjK.jpg', 'Sok Vitou', 1, '2025-06-26 11:39:08', NULL, NULL, 1, '144', '2025'),
(50, '8397', '196', NULL, '2025-03-31', 'uploads/give-atts/44kH3GZ4iAmPldZ7WMIHFaVZ0HrpRqWABYHcqx4B.jpg', 'Sok Vitou', 1, '2025-06-26 13:59:53', NULL, NULL, 1, '196', '2025'),
(51, '8396', '195,194,193,192,191,190', NULL, '2025-05-22', 'uploads/give-atts/Yz5aY82XnCMwnFiOs22VK4N5Ub3Y5fw7sXP57PqM.jpg', 'Sok Vitou', 1, '2025-06-26 14:02:25', NULL, NULL, 1, '195,194,193,192,191,190', '2025'),
(52, '8398', '197', NULL, '2025-07-07', 'uploads/give-atts/Acb9iQjtSHwE2tSfD0e8y7UAgS2YmexE55b50dG8.jpg', 'Sok Vitou', 1, '2025-07-11 10:27:42', NULL, NULL, 1, '197', '2025'),
(53, '8399', '198', NULL, '2025-07-08', 'uploads/give-atts/JsoYuWYnT9DbqGZGMQAouiHUMbOhWVcppOtcf59K.jpg', 'Sok Vitou', 1, '2025-07-11 10:35:10', NULL, NULL, 1, '198', '2025'),
(54, '8391', '199', NULL, '2025-06-14', 'uploads/give-atts/hbtRPeQDmTjhdPCy91yRWDmjLlwTRLZ8Q1OfejnK.jpg', 'Sok Vitou', 1, '2025-07-11 10:38:00', NULL, NULL, 1, '199', '2025'),
(55, '8400', '203,202,201,200', NULL, '2025-07-03', 'uploads/give-atts/dSou3aAxzGku1hqzg3Pp0Y6d1emEna1lIG0IPpks.jpg', 'Sok Vitou', 1, '2025-07-11 10:48:10', NULL, NULL, 1, '203,202,201,200', '2025'),
(56, '8401', '205,204', NULL, '2025-06-23', 'uploads/give-atts/rk6xnF5Ne2nTM3Wx4MW2yHKA2OFXqjauayr6CP17.jpg', 'Sok Vitou', 1, '2025-07-11 11:01:27', NULL, NULL, 1, '205,204', '2025'),
(57, '8402', '210,209,208,207,206', NULL, '2025-06-03', 'uploads/give-atts/J8dLoVNYaTf3geLk5oJbc537dy8yspwllFdNW7Cs.jpg', 'Sok Vitou', 1, '2025-07-11 11:16:02', NULL, NULL, 1, '210,209,208,207,206', '2025'),
(58, '8403', '211', NULL, '2025-06-04', 'uploads/give-atts/zuJPrHCSOfjudlwFgGKK2KzmieI0TrPSjI0ekrCQ.jpg', 'Sok Vitou', 1, '2025-07-11 11:20:05', NULL, NULL, 1, '211', '2025'),
(59, '8404', '216,215,214,213,212', NULL, '2025-06-02', 'uploads/give-atts/AMm253B4shsL3pewkDr17XABzIaM20DP2KotqcCO.jpg', 'Sok Vitou', 0, '2025-07-11 11:36:44', '2025-07-28 11:12:11', '216,215,214,213,212', 0, '216,215,214,213,212', '2025'),
(60, '8406', '221,220,219,218,217', NULL, '2024-12-09', 'uploads/give-atts/hqXi7TRoc2l4yvNBYTN43s9h31AgvT5eel3UKRCF.jpg', 'Sok Vitou', 1, '2025-07-11 12:00:37', NULL, NULL, 1, '221,220,219,218,217', '2025'),
(61, '8401', '222', NULL, '2024-12-30', 'uploads/give-atts/J9zbZCObfv3f3XLr9OJ7JmPFqxwQEbZcuNBYMLSC.jpg', 'Sok Vitou', 1, '2025-07-11 13:30:44', NULL, NULL, 1, '222', '2025'),
(62, '8407', '226,225,224,223', NULL, '2025-01-04', 'uploads/give-atts/5HDDgqAKXGraNV34e9XNHoxw5CzjW8BdhOYEribR.jpg', 'Sok Vitou', 1, '2025-07-11 13:37:27', NULL, NULL, 1, '226,225,224,223', '2025'),
(63, '8408', '231,230,229,227', NULL, '2025-01-02', 'uploads/give-atts/EQDC9RtFpihPupNgHO77HDXYorIevoeK8WNMLMwR.jpg', 'Sok Vitou', 1, '2025-07-11 13:47:41', '2025-07-12 10:50:35', '228', 0, '231,230,229,228,227', '2025'),
(64, '8409', '233,232', NULL, '2024-12-28', 'uploads/give-atts/U75t6VvrjMUOMrBeAwqB0BrqQeHFrckEOdDFv2Oh.jpg', 'Sok Vitou', 1, '2025-07-11 13:56:06', NULL, NULL, 1, '233,232', '2025'),
(65, '8410', '237,236,235,234', NULL, '2024-10-22', 'uploads/give-atts/ixuW7zD5nnxGSAD8DqloP9SyyXrLySNID7N06E6p.jpg', 'Sok Vitou', 1, '2025-07-11 14:09:35', NULL, NULL, 1, '237,236,235,234', '2025'),
(66, '8411', '239,238', NULL, '2025-03-12', 'uploads/give-atts/znW6qOxJyYllWugNJOQ3PuUKG0nLSDS8efz4YkBp.jpg', 'Sok Vitou', 1, '2025-07-11 14:16:50', NULL, NULL, 1, '239,238', '2025'),
(67, '8412', '241,240', NULL, '2024-12-03', 'uploads/give-atts/xPIY2UdnLOdbT519LKiI3tiNTpdN1mtZZix3LC1o.jpg', 'Sok Vitou', 1, '2025-07-11 14:34:14', NULL, NULL, 1, '241,240', '2025'),
(68, '8413', '246,245,244,243,242', NULL, '2025-01-02', 'uploads/give-atts/Q67m9xHof9WQ7KMruvVzkcfvXWW4nymMrLQMlEac.jpg', 'Sok Vitou', 1, '2025-07-11 14:43:03', NULL, NULL, 1, '246,245,244,243,242', '2025'),
(69, '8414', '248,247', NULL, '2025-01-11', 'uploads/give-atts/vbGgpGCEX3iTbjumZDS6AvmgtaKQAmS0vtKIvvSR.jpg', 'Sok Vitou', 1, '2025-07-12 09:44:17', NULL, NULL, 1, '248,247', '2025'),
(70, '8416', '250', NULL, '2025-02-04', 'uploads/give-atts/HAtXhKHNqdrozMJQMNppmFvM4CnoUtQb3e4vwVGF.jpg', 'Sok Vitou', 1, '2025-07-12 10:17:26', NULL, NULL, 1, '250', '2025'),
(71, '8417', '256,255,254,253,251', NULL, '2025-02-21', 'uploads/give-atts/uf2nX553x7tox9sBQ88czeEiaEI7vx6YwcltKI0D.jpg', 'Sok Vitou', 1, '2025-07-12 10:25:37', NULL, NULL, 1, '256,255,254,253,251', '2025'),
(72, '8398', '258', NULL, '2025-02-10', 'uploads/give-atts/7PUwxJRNJCyEuM8WUDPrDc9eUQ9nwwqZdIazVWyw.jpg', 'Sok Vitou', 1, '2025-07-12 10:27:40', NULL, NULL, 1, '258', '2025'),
(73, '8393', '252', NULL, '2025-04-23', 'uploads/give-atts/jMLQ4DXYWHPEsS25qic0lL0aFxf3HpyjWMiL8zKB.jpg', 'Sok Vitou', 1, '2025-07-12 10:37:15', NULL, NULL, 1, '252', '2025'),
(74, '8400', '265,264', NULL, '2025-01-02', 'uploads/give-atts/YGTyoF0OhBtBv4RnfUhJwnKf46BESuNKjXOjelDe.jpg', 'Sok Vitou', 1, '2025-07-12 10:38:26', NULL, NULL, 1, '265,264', '2025'),
(75, '8403', '266', NULL, '2025-03-06', 'uploads/give-atts/3Xsk0pTDiTlhuUnX2UjG1k5u9YeXWxgDhl6izzC7.jpg', 'Sok Vitou', 1, '2025-07-12 10:38:48', NULL, NULL, 1, '266', '2025'),
(76, '8393', '261,259,257', NULL, '2025-04-23', 'uploads/give-atts/0v84cScTKq9xclWRuOBNzdS7AqkPGxbVZzxSiIVR.jpg', 'Sok Vitou', 1, '2025-07-12 10:39:39', NULL, NULL, 1, '261,259,257', '2025'),
(77, '8423', '260', NULL, '2025-03-21', 'uploads/give-atts/DV94lBo4eveRzWgIEoXkexKHyykpquQb18cds0M0.jpg', 'Sok Vitou', 1, '2025-07-12 10:44:12', NULL, NULL, 1, '260', '2025'),
(78, '8421', '268', NULL, '2025-05-02', 'uploads/give-atts/RcEjMK4LHISxv8h3vJKTN4mKFY0cDYM8No1s2pTG.jpg', 'Sok Vitou', 1, '2025-07-12 10:44:32', NULL, NULL, 1, '268', '2025'),
(79, '8422', '269,267', NULL, '2025-01-06', 'uploads/give-atts/GQ9jQD3AWKZ27aXGgu2U90OpF3Qsjy82GqiMDEJk.jpg', 'Sok Vitou', 1, '2025-07-12 10:44:34', NULL, NULL, 1, '269,267', '2025'),
(80, '8422', '270', NULL, '2025-01-07', 'uploads/give-atts/WG0UlOGr4cpFl82jo0tJASmdPuwCagp4siURKsXl.jpg', 'Sok Vitou', 1, '2025-07-12 10:46:41', NULL, NULL, 1, '270', '2025'),
(81, '8424', '263,262', NULL, '2025-02-10', 'uploads/give-atts/8OIYZs3nedv0iVwo6vnp0K65zOhcpEMvFD5FREEk.jpg', 'Sok Vitou', 1, '2025-07-12 10:48:15', NULL, NULL, 1, '263,262', '2025'),
(82, '8421', '273,272,271,228', NULL, '2025-04-04', 'uploads/give-atts/on6fssNzN83joPdfuWxCg3Cvc3wxaBSJlhqZiqxT.jpg', 'Sok Vitou', 1, '2025-07-12 10:57:51', NULL, NULL, 1, '273,272,271,228', '2025'),
(83, '8425', '280', NULL, '2025-05-07', 'uploads/give-atts/u0OUWfSlR0S61aFsdHmlB23pJyXz1Ub1SvJAlMGP.jpg', 'Sok Vitou', 1, '2025-07-12 11:28:45', NULL, NULL, 1, '280', '2025'),
(84, '8426', '285,284,283,282,281', NULL, '2025-03-25', 'uploads/give-atts/Pe9dohUi90nTrZVvdQAXEtrgFttjpSo7dD4fj58i.jpg', 'Sok Vitou', 1, '2025-07-12 11:29:00', NULL, NULL, 1, '285,284,283,282,281', '2025'),
(85, '8427', '298', NULL, '2025-05-17', 'uploads/give-atts/p85FBUNHP2zGLqJl8ruDm22HZhCGMrsTZCgrYGzU.jpg', 'Sok Vitou', 1, '2025-07-12 11:34:28', NULL, NULL, 1, '298', '2025'),
(86, '8428', '297', NULL, '2025-03-01', 'uploads/give-atts/APBiGJOUXJMVZyEqUD7ZSZe0y4qC8heuVAQ96MEl.jpg', 'Sok Vitou', 1, '2025-07-12 11:34:59', NULL, NULL, 1, '297', '2025'),
(87, '8429', '322,319,317,315,314,312,310,301,299', NULL, '2024-12-20', 'uploads/give-atts/egEcxWSkXVvhy6cTZXrtfPnUOWH3exKYBw9XIZmn.jpg', 'Sok Vitou', 1, '2025-07-12 11:57:01', NULL, NULL, 1, '322,319,317,315,314,312,310,301,299', '2025'),
(88, '8430', '327,326,325,323,320', NULL, '2025-03-06', 'uploads/give-atts/YCKPTuRSnU0zXGAGH6g2plzgpjOus64S0GA15MTD.jpg', 'Sok Vitou', 1, '2025-07-12 12:00:06', NULL, NULL, 1, '327,326,325,323,320', '2025'),
(89, '206', '330', NULL, '2025-10-31', 'uploads/give-atts/7CDJ6N7EX7PLN98w1PMcUR9NUKKc5Wg2pXdIHJGP.jpg', 'Sok Vitou', 1, '2025-07-12 12:01:45', NULL, NULL, 1, '330', '2025'),
(90, '8431', '337,336,335,334,333', NULL, '2024-11-06', 'uploads/give-atts/G45X78elO3hfeGSCU0h3UdIcyKF7AKkCbH3Zx61z.jpg', 'Sok Vitou', 1, '2025-07-12 13:27:39', NULL, NULL, 1, '337,336,335,334,333', '2025'),
(91, '8432', '342,341,340,339,338', NULL, '2024-12-23', 'uploads/give-atts/8qDd5T7t8aMULsV7pe4TZmcxIvHZvW1E68km1x2B.jpg', 'Sok Vitou', 1, '2025-07-12 13:36:03', NULL, NULL, 1, '342,341,340,339,338', '2025'),
(92, '8433', '346,345,344,343', NULL, '2024-12-23', 'uploads/give-atts/BLpt4p1KD0b4kYY2blRakcWHwQdqeHmbqZqlRg9r.jpg', 'Sok Vitou', 1, '2025-07-12 13:42:13', NULL, NULL, 1, '346,345,344,343', '2025'),
(93, '8434', '347', NULL, '2024-12-20', 'uploads/give-atts/dae6aVfBRfBd9IWL94N1v9rCVWyiq08jxoUeQts5.jpg', 'Sok Vitou', 1, '2025-07-12 13:45:48', NULL, NULL, 1, '347', '2025'),
(94, '8435', '349,348', NULL, '2024-12-18', 'uploads/give-atts/Q1FzHd68MZXVvPz96RLqCGXobTXNLouQCf20Egp0.jpg', 'Sok Vitou', 1, '2025-07-12 14:28:59', NULL, NULL, 1, '349,348', '2025'),
(95, '211', '350', NULL, '2025-01-30', 'uploads/give-atts/n7vBMqnBtTHOQv0JQj4KteFvGfz6B3D5vn9vKmdy.jpg', 'Sok Vitou', 1, '2025-07-12 14:34:37', NULL, NULL, 1, '350', '2025'),
(96, '8438', '362,361,360,358,357', NULL, '2025-02-15', 'uploads/give-atts/sf080y5A7thT570QM9eRjMC3kwS7Kaypf4gZsKSM.jpg', 'Sok Vitou', 1, '2025-07-12 14:56:15', NULL, NULL, 1, '362,361,360,358,357', '2025'),
(97, '8439', '367,366,365,364,363', NULL, '2025-02-13', 'uploads/give-atts/4ODDM3KrRcU2EG74ZfcuObLmcR2N3mLvcHpEd8WF.jpg', 'Sok Vitou', 1, '2025-07-12 15:03:00', NULL, NULL, 1, '367,366,365,364,363', '2025'),
(98, '8427', '369,368', NULL, '2025-02-26', 'uploads/give-atts/DwpA3ggfZimSmlbmxpuu6UzSPKMK4cIAWqJc2WJS.jpg', 'Sok Vitou', 1, '2025-07-12 15:05:53', NULL, NULL, 1, '369,368', '2025'),
(99, '8440', '370', NULL, '2025-03-20', 'uploads/give-atts/e09uL9Z6uy2v0kOdzn3vGnjdrbVot68f5LuQxZZO.jpg', 'Sok Vitou', 1, '2025-07-12 15:11:52', NULL, NULL, 1, '370', '2025'),
(100, '8441', '371', NULL, '2025-03-21', 'uploads/give-atts/KfKAu2sMlbFHBEGBpjOlCX0lNvHp9D3DMKuUvXhF.jpg', 'Sok Vitou', 1, '2025-07-12 15:15:37', NULL, NULL, 1, '371', '2025'),
(101, '8429', '372', NULL, '2025-05-01', 'uploads/give-atts/6shybcGtY0W5xmoS9DRlQGhZBUVVXFvph0M2iY7K.jpg', 'Sok Vitou', 1, '2025-07-12 15:21:00', NULL, NULL, 1, '372', '2025'),
(102, '8442', '373', NULL, '2025-05-01', 'uploads/give-atts/C3nvwOwHS4LbYWYPi8aC0JtuyXVafHAC74KwPgTj.jpg', 'Sok Vitou', 1, '2025-07-12 15:25:00', NULL, NULL, 1, '373', '2025'),
(103, '8443', '378,377,376,375,374', NULL, '2025-06-25', 'uploads/give-atts/j1666BKriSRLb0qjtGExgSnP0v398yhoQrsBdvny.jpg', 'Sok Vitou', 1, '2025-07-12 15:43:21', NULL, NULL, 1, '378,377,376,375,374', '2025'),
(104, '8444', '382,381,380,379', NULL, '2025-06-30', 'uploads/give-atts/KlY0KM0BfR8z856fCGcJdsDu7ISpmuFBMeUaDB20.jpg', 'Sok Vitou', 1, '2025-07-12 15:49:29', NULL, NULL, 1, '382,381,380,379', '2025'),
(105, '8397', '387,386,385,384,383', NULL, '2025-06-30', 'uploads/give-atts/lz13tVgAcrm72MQlIt8D5ospFhLuITsxFPjj1N7T.jpg', 'Sok Vitou', 1, '2025-07-12 15:54:39', NULL, NULL, 1, '387,386,385,384,383', '2025'),
(106, '8445', '388', NULL, '2025-05-05', 'uploads/give-atts/e27VDYVWppSlf2ILLpwWDVLGGP5Tk0HGUWzy2eQE.jpg', 'Sok Vitou', 1, '2025-07-12 16:10:36', NULL, NULL, 1, '388', '2025'),
(107, '8392', '359,355,187,122', NULL, '2025-05-01', 'uploads/give-atts/M2mTg4rCMm9bUqlZzWwiz9Onqis4xeQFPR6YlxD3.jpg', 'Sok Vitou', 1, '2025-07-12 16:11:45', NULL, NULL, 1, '359,355,187,122', '2025'),
(108, '8447', '356', NULL, '2025-04-01', 'uploads/give-atts/jzEDe6h8of1TWqBgUiza22k8RAmWaP5hAV25plh1.jpg', 'Sok Vitou', 1, '2025-07-12 16:16:28', NULL, NULL, 1, '356', '2025'),
(109, '210', '392,391,390,389', NULL, '2025-01-17', 'uploads/give-atts/ETA5txu9RLYarxo7rCncGpr3e4igAed2UyuPbsA9.jpg', 'Sok Vitou', 1, '2025-07-12 16:18:00', NULL, NULL, 1, '392,391,390,389', '2025'),
(110, '8448', '393', NULL, '2025-02-20', 'uploads/give-atts/OvYeeE2QjCtGXUhX6chK7DqfEckfk7AXHQ9T7E2m.jpg', 'Sok Vitou', 1, '2025-07-12 16:24:07', NULL, NULL, 1, '393', '2025'),
(111, '8387', '321,318', NULL, '2025-01-01', 'uploads/give-atts/PUgVtHN9uvYbSKskW46zpnU60ZjgLEDsSUoyEpx7.jpg', 'Sok Vitou', 1, '2025-07-12 16:27:21', NULL, NULL, 1, '321,318', '2025'),
(112, '8394', '396,395,394', NULL, '2025-02-20', 'uploads/give-atts/HnAAD6WVgQcYj88Ix0eajVYJicxwgButQrX6sZjH.jpg', 'Sok Vitou', 1, '2025-07-12 16:28:45', NULL, NULL, 1, '396,395,394', '2025'),
(113, '8447', '316,313,311,309', NULL, '2025-01-03', 'uploads/give-atts/7VkSBg8RrTBjKaK2NOadjKG9HcfJJkOm648lGows.jpg', 'Sok Vitou', 1, '2025-07-12 16:30:05', NULL, NULL, 1, '316,313,311,309', '2025'),
(114, '210', '397', NULL, '2025-04-01', 'uploads/give-atts/S9ZTXh4HfBTVwjT3swRavoj3CB6obn8GsxYDgXe6.jpg', 'Sok Vitou', 1, '2025-07-12 16:30:57', NULL, NULL, 1, '397', '2025'),
(115, '8447', '308', NULL, '2024-12-19', 'uploads/give-atts/svC05GXXwqKSHJqzHsU4rxnhgEXGUQbF1vzOI3vC.jpg', 'Sok Vitou', 1, '2025-07-12 16:31:45', NULL, NULL, 1, '308', '2025'),
(116, '8449', '302,293,292,291', NULL, '2025-01-16', 'uploads/give-atts/KsZEIbt2tNr2pYYXkqfoy3JHt7ZjFRDTQzhgarjW.jpg', 'Sok Vitou', 1, '2025-07-12 16:34:02', NULL, NULL, 1, '302,293,292,291', '2025'),
(117, '8450', '307,306', NULL, '2024-12-05', 'uploads/give-atts/IkdGf7mM20epb3vzVY1TbqFyeG1RkLNnC0qO2zSB.jpg', 'Sok Vitou', 1, '2025-07-12 16:36:27', NULL, NULL, 1, '307,306', '2025'),
(118, '8389', '300,290,288,287,286', NULL, '2025-05-30', 'uploads/give-atts/oVznxyfxDF5Qr91m3JM6N1T5CuH1BEilXX33L0nV.jpg', 'Sok Vitou', 1, '2025-07-12 16:36:55', NULL, NULL, 1, '300,290,288,287,286', '2025'),
(119, '8451', '400,399,398', NULL, '2025-04-04', 'uploads/give-atts/sPfshOPwN6PBa2uGQl1JwGPjHLCc7twj8lzmFNlz.jpg', 'Sok Vitou', 1, '2025-07-12 16:40:56', NULL, NULL, 1, '400,399,398', '2025'),
(120, '8452', '294,289,276,275', NULL, '2025-05-31', 'uploads/give-atts/T1sQpfUd02saUlGdzgCAOsI9L1iJklECpL3mUKnx.jpg', 'Sok Vitou', 0, '2025-07-12 16:47:15', '2025-07-29 14:34:37', '294,289,276,275', 0, '294,289,276,275', '2025'),
(121, '8454', '305', NULL, '2025-01-01', 'uploads/give-atts/mHErtOKG6lwcEub4NmIGwXtKlkUzUxpmWdDp8NYO.jpg', 'Sok Vitou', 1, '2025-07-12 16:47:59', NULL, NULL, 1, '305', '2025'),
(122, '8453', '404,403,402,401', NULL, '2025-04-05', 'uploads/give-atts/u0DwixmfYotoTiBK3OJxUpYTFrKG2E534cmpuZpW.jpg', 'Sok Vitou', 1, '2025-07-12 16:48:51', NULL, NULL, 1, '404,403,402,401', '2025'),
(123, '8452', '277', NULL, '2025-05-31', 'uploads/give-atts/LJ3ivPGxzfQAM2KaNjxF3Mid03BjcB67QZeFEjWc.jpg', 'Sok Vitou', 1, '2025-07-12 16:51:07', NULL, NULL, 1, '277', '2025'),
(124, '8455', '304', NULL, '2024-10-29', 'uploads/give-atts/WVOB7eAuIZegXvmY3pq7cVUCUKh8GIyV8cXSXQ1I.jpg', 'Sok Vitou', 1, '2025-07-12 16:52:32', NULL, NULL, 1, '304', '2025'),
(125, '8455', '328,324', NULL, '2025-01-01', 'uploads/give-atts/A56RtBmAugIMk6W4940JR6uV7q5vRv85GRkkrzKJ.jpg', 'Sok Vitou', 1, '2025-07-12 16:54:12', NULL, NULL, 1, '328,324', '2025'),
(126, '8458', '274', NULL, '2025-07-08', 'uploads/give-atts/sCzeDe0Jc9clvjmLbY9sEYOXfXGeGg0qlFOo7XpF.jpg', 'Sok Vitou', 1, '2025-07-12 16:54:28', NULL, NULL, 1, '274', '2025'),
(127, '8387', '303', NULL, '2024-10-29', 'uploads/give-atts/eMcxk3hRcjZOH5RGOQggkBppYoNAFSgJB9wwZ372.jpg', 'Sok Vitou', 1, '2025-07-12 17:00:13', NULL, NULL, 1, '303', '2025'),
(128, '8455', '354,353,352,351,278', NULL, '2025-03-21', 'uploads/give-atts/Kc7Tzj38W3iZkUw1ZPobTyIAiXgis0Jfdb1QbjKh.jpg', 'Sok Vitou', 1, '2025-07-12 17:06:12', NULL, NULL, 1, '354,353,352,351,278', '2025'),
(129, '8460', '332,331', NULL, '2025-03-18', 'uploads/give-atts/ibk0FHfIXqaURp7C3ubO6Y2QWRjNtuK7u9kjXESF.jpg', 'Sok Vitou', 1, '2025-07-12 17:07:30', NULL, NULL, 1, '332,331', '2025'),
(130, '8461', '329', NULL, '2025-02-22', 'uploads/give-atts/OSzA3bMgBnwyxF7HGnCF8r4V56jJDYgiahrTPQ0a.jpg', 'Sok Vitou', 1, '2025-07-12 17:10:43', NULL, NULL, 1, '329', '2025'),
(131, '8447', '316,313', NULL, '2025-01-03', 'uploads/give-atts/o3kudoWM0OvsX5RJzZ0Y67mruNbgM53Bz5Fuf3pJ.jpg', 'Sok Vitou', 1, '2025-07-14 09:05:08', NULL, NULL, 1, '316,313', '2025'),
(132, '8462', '406,405', NULL, '2025-02-24', 'uploads/give-atts/CROKBAvDTmB9n3qklYoOFhZ4VsEwUdvuX08ehk1V.jpg', 'Sok Vitou', 1, '2025-07-14 09:07:19', NULL, NULL, 1, '406,405', '2025'),
(133, '202', '408', NULL, '2025-07-05', 'uploads/give-atts/WGKoBeGPqzl4FUhT8YD3pKIc0TYaSk5PzYroN3x8.jpg', 'Sok Vitou', 1, '2025-07-14 09:14:24', NULL, NULL, 1, '408', '2025'),
(134, '8464', '419,418,416,414,412', NULL, '2025-02-06', 'uploads/give-atts/Y8Bb46ViLYcVjPA9oBnJnxoLywEKAHoes3dhj59y.jpg', 'Sok Vitou', 1, '2025-07-14 09:32:21', NULL, NULL, 1, '419,418,416,414,412', '2025'),
(135, '8466', '421,420,417,415', NULL, '2024-12-23', 'uploads/give-atts/RfIPheOqFU3c62sZEo0rOl3HW2mPYgFY9F9r6yIf.jpg', 'Sok Vitou', 1, '2025-07-14 09:35:39', NULL, NULL, 1, '421,420,417,415', '2025'),
(136, '202', '413', NULL, '2025-05-13', 'uploads/give-atts/bpWKJ1l8Gkw46lzHplSmxR32hFJp2EaXgS5aK7K3.jpg', 'Sok Vitou', 1, '2025-07-14 09:37:26', NULL, NULL, 1, '413', '2025'),
(137, '202', '410', NULL, '2025-05-18', 'uploads/give-atts/Wu1Tk2fMzukHwpmMshRg9IPF24JTTllnVM4yl4U0.jpg', 'Sok Vitou', 1, '2025-07-14 09:38:24', NULL, NULL, 1, '410', '2025'),
(138, '8416', '411', NULL, '2025-05-10', 'uploads/give-atts/BYzchWBzX7eyCvjrYmTNKaDkbJOc6upTyCaHFKJl.jpg', 'Sok Vitou', 1, '2025-07-14 09:39:56', NULL, NULL, 1, '411', '2025'),
(139, '184', '430,428,427,426,146', NULL, '2025-02-13', 'uploads/give-atts/oDrPBBKaBN4RywRm53E49xXB6flIWYDkbeciqCLb.jpg', 'Sok Vitou', 1, '2025-07-14 09:40:19', NULL, NULL, 1, '430,428,427,426,146', '2025'),
(140, '8465', '426,425,424,423,422', NULL, '2025-02-25', 'uploads/give-atts/p8RZm6tDmbcNxgsMCzHudk81vqZYWaZeouqvxjWj.jpg', 'Sok Vitou', 1, '2025-07-14 09:41:33', NULL, NULL, 1, '426,425,424,423,422', '2025'),
(141, '200', '431', NULL, '2025-02-13', 'uploads/give-atts/16qAdpp4DqaykutnLQ6atmO09Vs8g3RSV9c8u07s.jpg', 'Sok Vitou', 1, '2025-07-14 09:43:34', NULL, NULL, 1, '431', '2025'),
(142, '202', '433', NULL, '2025-03-18', 'uploads/give-atts/30zW9NNs7kPE5tlE9zEjcLCR3mXwQZAo5nRkXCIL.jpg', 'Sok Vitou', 1, '2025-07-14 09:44:58', NULL, NULL, 1, '433', '2025'),
(143, '202', '409', NULL, '2025-03-18', 'uploads/give-atts/pEIAo7ibLhlvZhpNO5DGMswfw5Tc8KpbVzVfry8P.jpg', 'Sok Vitou', 1, '2025-07-14 09:46:33', NULL, NULL, 1, '409', '2025'),
(144, '202', '407', NULL, '2025-03-18', 'uploads/give-atts/3rn3uOhurT03NBjblhgtd5fskQwrMDMhpY0i7dXR.jpg', 'Sok Vitou', 1, '2025-07-14 09:47:52', NULL, NULL, 1, '407', '2025'),
(145, '200', '436', NULL, '2025-03-18', 'uploads/give-atts/0c4zmIBO5zMk3NlWwxyUTwdIF4XaF1MwaSmesPsX.jpg', 'Sok Vitou', 1, '2025-07-14 09:48:24', NULL, NULL, 1, '436', '2025'),
(146, '199', '439', NULL, '2025-03-03', 'uploads/give-atts/t1iIK9Y2XthCwmsLyBAN0PjBV17lny8r6cpXxy6v.jpg', 'Sok Vitou', 1, '2025-07-14 09:51:59', NULL, NULL, 1, '439', '2025'),
(147, '8468', '438,437,435,434,432', NULL, '2025-02-25', 'uploads/give-atts/xFVE7X2Tv1ybUBiPvcryUk1Q9qW1bCzy3s3t5Ctt.jpg', 'Sok Vitou', 1, '2025-07-14 09:53:00', NULL, NULL, 1, '438,437,435,434,432', '2025'),
(148, '198', '440', NULL, '2025-03-25', 'uploads/give-atts/7FvqyD5NwMtliVChU2ovw3gOaZ5nf5bgezA1vsLn.jpg', 'Sok Vitou', 1, '2025-07-14 09:58:13', NULL, NULL, 1, '440', '2025'),
(149, '205', '154', NULL, '2025-03-31', 'uploads/give-atts/7AKyOAsfZUvjIixjDoRvGQcn3RzHsRyJjHRvxpDq.jpg', 'Sok Vitou', 1, '2025-07-14 10:03:50', NULL, NULL, 1, '154', '2025'),
(150, '202', '448,444', NULL, '2025-02-06', 'uploads/give-atts/xad8VDjZobmdWqhzJ4Nj92G9fkn9BaZEBNu5ZMlE.jpg', 'Sok Vitou', 1, '2025-07-14 10:06:32', NULL, NULL, 1, '448,444', '2025'),
(151, '8469', '447,446,445,443,442', NULL, '2025-07-09', 'uploads/give-atts/E7iApqHq1UgMsTvufqqJfk77oAOu6FL8xpzb87pX.jpg', 'Sok Vitou', 1, '2025-07-14 10:08:08', NULL, NULL, 1, '447,446,445,443,442', '2025'),
(152, '202', '450', NULL, '2025-01-17', 'uploads/give-atts/QO9PTlJRjhhPv7VQddjEdDo3F0HSXUkQFcRSb2t4.jpg', 'Sok Vitou', 1, '2025-07-14 10:08:30', NULL, NULL, 1, '450', '2025'),
(153, '8382', '441', NULL, '2025-07-05', 'uploads/give-atts/Ed57I7lHprhGERBNF5GB1iDrU07W3Ann9gDNOIfX.jpg', 'Sok Vitou', 1, '2025-07-14 10:10:22', NULL, NULL, 1, '441', '2025'),
(154, '199', '452,451,449', NULL, '2025-06-23', 'uploads/give-atts/AutYQDJvHgm5LDEIUqCNhIbpJswPhqqXestXg5WQ.jpg', 'Sok Vitou', 1, '2025-07-14 10:11:33', NULL, NULL, 1, '452,451,449', '2025'),
(155, '8471', '459,457,455', NULL, '2025-07-11', 'uploads/give-atts/uausy7t4OogZdu1TkkjTw9fWJXZD12uoTs18gBUp.jpg', 'Sok Vitou', 1, '2025-07-14 10:16:23', NULL, NULL, 1, '459,457,455', '2025'),
(156, '197', '466', NULL, '2024-12-18', 'uploads/give-atts/Fx7vFcM0FbsmVXh9Oq7xyMDn4tUZMuxWhcMyHD8p.jpg', 'Sok Vitou', 1, '2025-07-14 10:22:28', NULL, NULL, 1, '466', '2025'),
(157, '200', '469,468,467', NULL, '2025-02-01', 'uploads/give-atts/Ig0Hs2RnXDHEAltV7xGr5o1N3G0qT1e9SRC3NjPW.jpg', 'Sok Vitou', 1, '2025-07-14 10:26:43', NULL, NULL, 1, '469,468,467', '2025'),
(158, '197', '249', NULL, '2025-07-15', 'uploads/give-atts/u7f2sZXjVRwvBD6MBm9S1VJlMVARotSyCBpUaOeb.jpg', 'Sok Vitou', 1, '2025-07-15 11:30:44', NULL, NULL, 1, '249', '2025'),
(159, '8472', '482,481,480,479,478,477', NULL, '2025-07-14', 'uploads/give-atts/tP6aVYTZsF0M3Dgp1cftdzfKh0C1w0h6EgR8uOrY.jpg', 'Sok Vitou', 1, '2025-07-15 11:47:01', NULL, NULL, 1, '482,481,480,479,478,477', '2025'),
(160, '8423', '486,485', NULL, '2025-07-03', 'uploads/give-atts/r2toZ3102Zqm3NDzNdhzfyHpGKMxrN9aClso1Vwy.jpg', 'Sok Vitou', 1, '2025-07-15 15:11:03', NULL, NULL, 1, '486,485', '2025'),
(161, '8473', '488,487', NULL, '2025-07-10', 'uploads/give-atts/G69hthUB8vp0c06MuXs0f4ZE02Av2aUQKGMCZUJq.jpg', 'Sok Vitou', 1, '2025-07-15 15:17:31', NULL, NULL, 1, '488,487', '2025'),
(162, '8474', '494,493,492,491,490', NULL, '2025-07-01', 'uploads/give-atts/c3215rXOy4JbgDWIBIEz9LXZSN4IKyZeHLwd9s4x.jpg', 'Sok Vitou', 1, '2025-07-15 16:14:33', NULL, NULL, 1, '494,493,492,491,490', '2025'),
(163, '8475', '498,497,496,495', NULL, '2025-07-09', 'uploads/give-atts/uX3ntUJ8ZClLWf3MlcJm7wSV4KsvrTeC1JVRtbyq.jpg', 'Sok Vitou', 1, '2025-07-16 09:53:36', NULL, NULL, 1, '498,497,496,495', '2025'),
(164, '8461', '500,499', NULL, '2025-07-09', 'uploads/give-atts/nsU78xftfZeX44zNDb4maTGEIUkTpWjt7oowolrz.jpg', 'Sok Vitou', 1, '2025-07-16 10:38:10', NULL, NULL, 1, '500,499', '2025'),
(165, '8410', '489', NULL, '2025-07-10', 'uploads/give-atts/rqfMvPQ7A6v3MIFwCxUmBh2SgSIsFiMqW9Z49iR9.jpg', 'Sok Vitou', 1, '2025-07-16 10:40:16', NULL, NULL, 1, '489', '2025'),
(166, '8477', '476,475,474,473,464', NULL, '2025-07-16', 'uploads/give-atts/2G6ChS2qtaZ0yaomkJ1etsD8jD2ldsicdjD1VQFb.jpg', 'Sok Vitou', 1, '2025-07-16 14:22:20', NULL, NULL, 1, '476,475,474,473,464', '2025'),
(167, '8476', '504,503,502,501', NULL, '2025-07-16', 'uploads/give-atts/Lzj4WqyGz6OKvgj1GuEAQHUI1tbS4XnN8uc4GiN0.jpg', 'Sok Vitou', 1, '2025-07-16 14:23:32', NULL, NULL, 1, '504,503,502,501', '2025'),
(168, '8478', '151', NULL, '2025-07-17', 'uploads/give-atts/Laj77aqO4FE9KA7ypO9TVjL4388wpfAbmuIEOUGG.jpg', 'Sok Vitou', 1, '2025-07-19 10:04:04', NULL, NULL, 1, '151', '2025'),
(169, '8481', '510', NULL, '2025-07-22', 'uploads/give-atts/kPzwA4xPj5hWE2rXP5NTOvMpe5koW1cfw2fl9aoP.jpg', 'Sok Vitou', 1, '2025-07-22 14:51:25', NULL, NULL, 1, '510', '2025'),
(170, '8481', '513,516,515,514', NULL, '2025-07-28', 'uploads/give-atts/415uEsO9efWipA5ew9ntItdQpd2k4luaRp7IFJ1t.jpg', 'Sok Vitou', 1, '2025-07-28 11:14:01', NULL, NULL, 1, '513,516,515,514', '2025'),
(171, '8394', '512', NULL, '2025-07-29', 'uploads/give-atts/EllpC4frQJjoXiBc9K2KhIhZSqtlGPfdj0m11Vo7.jpg', 'Sok Vitou', 1, '2025-07-29 11:42:29', NULL, NULL, 1, '512', '2025'),
(172, '8473', '511', NULL, '2025-07-29', 'uploads/give-atts/fmG5PDwzqfYE0Fi6MYjLQ8J1my1kbqzZ1LBhsOie.jpg', 'Sok Vitou', 1, '2025-07-29 11:44:00', NULL, NULL, 1, '511', '2025'),
(173, '8483', '522', NULL, '2025-07-29', 'uploads/give-atts/tkoH3zjVcCILAzvf8cIgV1meMUzbCLI4FStLuDOf.jpg', 'Sok Vitou', 1, '2025-07-29 11:54:39', NULL, NULL, 1, '522', '2025');

-- --------------------------------------------------------

--
-- Table structure for table `item_codes`
--

CREATE TABLE `item_codes` (
  `id` int(11) NOT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `item_name_kh` varchar(255) DEFAULT NULL,
  `item_name_en` varchar(255) DEFAULT NULL,
  `item_cat` varchar(255) DEFAULT NULL,
  `equipment_type` varchar(255) DEFAULT NULL,
  `delete_status` int(11) DEFAULT 1 COMMENT '1:active, 0:deleted',
  `deleted_by` varchar(255) DEFAULT NULL,
  `deleted_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item_codes`
--

INSERT INTO `item_codes` (`id`, `item_code`, `item_name_kh`, `item_name_en`, `item_cat`, `equipment_type`, `delete_status`, `deleted_by`, `deleted_date`) VALUES
(1, 'ITE-001', 'កុំព្យូទ័រយួរដៃ', 'Laptop', '16', '1', 1, NULL, NULL),
(2, 'ITE-002', 'កុំព្យូទ័រលើតុ', 'Desktop', '17', '1', 1, NULL, NULL),
(3, 'ITE-003', 'ម៉ូនីទ័រ', 'Monitor', '18', '1', 1, NULL, NULL),
(4, 'ITE-004', 'ផេប្លេត', 'Tablet', '35', '1', 1, NULL, NULL),
(5, 'ITE-005', 'ម៉ាស៊ីនព្រីន', 'Printer', '19', '1', 1, NULL, NULL),
(6, 'ITE-006', 'ឆ្នាំងសាក', 'Adapter', '28', '2', 1, NULL, NULL),
(7, 'ITE-007', 'Mouse', 'Mouse', '20', '2', 1, NULL, NULL),
(8, 'ITE-008', 'ក្តារចុច', 'Keyboard', '22', '2', 1, NULL, NULL),
(9, 'ITE-009', 'Printer Cartridge 107A', 'Printer Cartridge 107A', '24', '2', 1, NULL, NULL),
(10, 'ITE-0010', 'Printer Cartridge color 206A', 'Printer Cartridge color 206A', '24', '2', 1, NULL, NULL),
(11, 'ITE-0011', 'Printer Cartridge 204A', 'Printer Cartridge 204A', '24', '2', 1, NULL, NULL),
(12, 'ITE-0012', 'Printer Cartridge 215A', 'Printer Cartridge 215A', '24', '2', 1, NULL, NULL),
(13, 'ITE-0013', 'Printer Cartridge 85A', 'Printer Cartridge 85A', '24', '2', 1, NULL, NULL),
(14, 'ITE-0014', 'Epos Ribbon LQ 310', 'Epos Ribbon LQ 310', '24', '2', 1, NULL, NULL),
(15, 'ITE-0015', 'Printer Cartridge 110A', 'Printer Cartridge 110A', '24', '2', 1, NULL, NULL),
(16, 'ITE-0016', 'Printer Cartridge 83A', 'Printer Cartridge 83A', '24', '2', 1, NULL, NULL),
(17, 'ITE-0017', 'Printer Cartridge 79A', 'Printer Cartridge 79A', '24', '2', 1, NULL, NULL),
(18, 'ITE-0018', 'Printer Cartridge 069', 'Printer Cartridge 069', '24', '2', 1, NULL, NULL),
(19, 'ITE-0019', 'Printer Cartridge E-STUDIO2309A', 'Printer Cartridge E-STUDIO2309A', '24', '2', 1, NULL, NULL),
(20, 'ITE-0020', 'Printer Toner Powder 83A', 'Printer Toner Powder 83A', '24', '2', 1, NULL, NULL),
(21, 'ITE-0021', 'Printer Toner Powder 206A', 'Printer Toner Powder 206A', '24', '2', 1, NULL, NULL),
(22, 'ITE-0022', 'Printer Cartridge 126A', 'Printer Cartridge 126A', '24', '2', 1, NULL, NULL),
(23, 'ITE-0023', 'Switch', 'Switch', '44', '2', 1, NULL, NULL),
(24, 'ITE-0024', 'ទូរទស្សន៍', 'TV', '38', '1', 1, NULL, NULL),
(25, 'ITE-0025', 'ម៉ាស៊ីនបញ្ចាំងស្លាយ', 'Projector', '40', '1', 1, NULL, NULL),
(26, 'ITE-0026', 'អង្គផ្ទុកទិន្នន័យ', 'SSD', '31', '2', 1, NULL, NULL),
(27, 'ITE-0027', 'ទ្រនាប់ Mouse', 'Mouse Pad', '21', '2', 1, NULL, NULL),
(28, 'ITE-0028', 'កាមេរ៉ា', 'Camera', '45', '2', 1, NULL, NULL),
(29, 'ITE-0029', 'ខ្សែ HDMI', 'HDMI Cable', '41', '2', 1, NULL, NULL),
(30, 'ITE-0030', 'កាតាប', 'Bag', '32', '2', 1, NULL, NULL),
(31, 'ITE-0031', 'UPS', 'UPS', '34', '2', 1, NULL, NULL),
(32, 'ITE-0032', 'Case', 'Case', '42', '2', 1, NULL, NULL),
(33, 'ITE-0033', 'USB', 'USB', '26', '2', 1, NULL, NULL),
(34, 'ITE-0034', 'Router', 'Router', '43', '2', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main_function`
--

CREATE TABLE `main_function` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `name_kh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `icon_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_function`
--

INSERT INTO `main_function` (`id`, `name`, `name_kh`, `icon_name`) VALUES
(1, 'Dashboard', 'ផ្ទាំងគ្រប់គ្រង', 'mdi-home'),
(2, 'Master Data', 'ទិន្នន័យបឋម', 'mdi-database-outline'),
(3, 'Items Management', 'គ្រប់គ្រងសម្ភារៈ', 'mdi-table'),
(4, 'Given&Returned', 'ផ្តល់ជូន&ប្រគល់ត្រឡប់', 'mdi-hand-coin-outline'),
(5, 'Expense Reports', 'របាយការណ៍ចំណាយ', 'mdi-finance'),
(6, 'Reports', 'របាយការណ៍', 'mdi-chart-bar'),
(7, 'Manage Users', 'គ្រប់គ្រងអ្នកប្រើប្រាស់', 'mdi-account-group-outline');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(31, '2014_10_12_000000_create_users_table', 1),
(32, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(33, '2019_08_19_000000_create_failed_jobs_table', 1),
(34, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(35, '2025_02_12_013157_create_table_categorys', 1),
(36, '2025_02_12_014338_create_table_positions', 1),
(37, '2025_02_12_014938_create_table_departments', 1),
(38, '2025_02_12_015415_create_table_borrows', 1),
(39, '2025_02_12_020134_crate_table_operators', 1),
(40, '2025_02_12_021351_create_table_staff_users', 1),
(41, '2025_02_12_021752_create_table_user_roles', 1),
(42, '2025_02_12_024121_create_table_products', 1);

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `add_by` char(255) NOT NULL,
  `crreate_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `block_status` int(11) NOT NULL DEFAULT 1,
  `block_by` char(255) DEFAULT NULL,
  `block_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_name` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `section_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `add_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `delete_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position_name`, `section_id`, `department_id`, `add_by`, `create_date`, `delete_status`, `delete_by`, `delete_date`) VALUES
(6, 'IT Admin', '7', 0, 'Voeurn Sokheng', '2025-03-21 10:30:28', 1, '', '0000-00-00'),
(7, 'IT officer', '8', 0, 'Voeurn Sokheng', '2025-03-21 10:30:08', 1, '', '0000-00-00'),
(8, 'PHP Developer', '11', 0, 'Ra Mey', '2025-03-21 10:31:41', 1, '', '0000-00-00'),
(9, 'IT Department Director', '12', 0, 'Voeurn Sokheng', '2025-03-25 04:08:27', 1, '', '0000-00-00'),
(10, 'ASM', '13', 0, 'Sok Vitou', '2025-03-26 00:42:11', 1, '', '0000-00-00'),
(11, 'RSM', '13', 0, 'Sok Vitou', '2025-03-26 00:48:54', 1, '', '0000-00-00'),
(12, 'ជំនួយការ', '14', 0, 'Sok Vitou', '2025-03-27 02:29:54', 1, '', '0000-00-00'),
(13, 'Graphic Designer', '15', 0, 'Sok Vitou', '2025-06-26 06:13:05', 1, '', '0000-00-00'),
(14, 'WH& Logistic Manager', '16', 0, 'Sok Vitou', '2025-04-01 04:46:49', 1, '', '0000-00-00'),
(15, 'Sr.IT officer', '17', 0, 'Sok Vitou', '2025-04-02 07:58:36', 1, '', '0000-00-00'),
(16, 'ជំនួយការគណនេយ្យ', '18', 0, 'Sok Vitou', '2025-04-02 08:04:48', 1, '', '0000-00-00'),
(17, 'DMS Officer', '19', 0, 'Sok Vitou', '2025-04-05 08:52:30', 1, '', '0000-00-00'),
(18, 'HR IR', '20', 0, 'Sok Vitou', '2025-04-05 09:29:15', 1, '', '0000-00-00'),
(19, 'Training', '21', 0, 'Sok Vitou', '2025-04-05 09:50:14', 1, '', '0000-00-00'),
(20, 'Packaging Manager', '22', NULL, 'Sok Vitou', '2025-05-01 06:24:29', 1, NULL, NULL),
(21, 'Accounting Manager', '23', NULL, 'Sok Vitou', '2025-05-01 06:44:25', 1, NULL, NULL),
(22, 'Accounting Officer', '24', NULL, 'Sok Vitou', '2025-05-01 06:57:48', 1, NULL, NULL),
(23, 'Payroll Manager', '25', NULL, 'Sok Vitou', '2025-05-01 07:51:10', 1, NULL, NULL),
(24, 'AR', '26', NULL, 'Sok Vitou', '2025-05-01 07:55:11', 1, NULL, NULL),
(25, 'ប្រធានក្រុមដឹកជញ្ជូន', '27', NULL, 'Sok Vitou', '2025-05-01 08:14:32', 1, NULL, NULL),
(26, 'Sale', '13', NULL, 'Sok Vitou', '2025-05-22 03:08:25', 1, NULL, NULL),
(27, 'Sale Support Supervisor', '28', NULL, 'Sok Vitou', '2025-05-22 03:13:13', 1, NULL, NULL),
(28, 'អនុប្រធានបច្ចេកទេស', '16', NULL, 'Sok Vitou', '2025-05-22 03:29:06', 1, NULL, NULL),
(29, 'Stock', '29', NULL, 'Sok Vitou', '2025-06-26 02:32:35', 1, NULL, NULL),
(30, 'Horeca Manager', '28', NULL, 'Sok Vitou', '2025-06-26 03:09:55', 1, NULL, NULL),
(31, 'HR Manager', '25', NULL, 'Sok Vitou', '2025-06-26 03:41:41', 1, NULL, NULL),
(32, 'Marketing Manager', '30', NULL, 'Sok Vitou', '2025-06-26 06:38:22', 1, NULL, NULL),
(33, 'Sale Manager', '28', NULL, 'Sok Vitou', '2025-07-11 04:26:12', 1, NULL, NULL),
(34, 'ASM Function', '28', NULL, 'Sok Vitou', '2025-07-11 04:57:02', 1, NULL, NULL),
(35, 'Call Center', '32', NULL, 'Sok Vitou', '2025-07-11 06:50:24', 1, NULL, NULL),
(36, 'DMS Supervisor', '33', NULL, 'Sok Vitou', '2025-07-11 07:03:35', 1, NULL, NULL),
(37, 'Sale Horica', '34', NULL, 'Sok Vitou', '2025-07-11 07:13:23', 1, NULL, NULL),
(38, 'Horica Supervisor', '35', NULL, 'Sok Vitou', '2025-07-11 07:29:25', 1, NULL, NULL),
(39, 'Sale Director', '36', NULL, 'Sok Vitou', '2025-07-11 07:36:07', 1, NULL, NULL),
(40, 'Sale Executive', '19', NULL, 'Sok Vitou', '2025-07-12 02:37:03', 1, NULL, NULL),
(41, 'ប្រធានភូមិភាគ', '37', NULL, 'Sok Vitou', '2025-07-17 06:06:03', 1, NULL, NULL),
(42, 'Sale Admin', '37', NULL, 'Sok Vitou', '2025-07-12 03:14:55', 1, NULL, NULL),
(43, 'Area Sale Manager', '19', NULL, 'Sok Vitou', '2025-07-12 03:18:31', 1, NULL, NULL),
(44, 'Sale supervisor', '19', NULL, 'Sok Vitou', '2025-07-12 03:33:28', 1, NULL, NULL),
(45, 'Key Account', '19', NULL, 'Sok Vitou', '2025-07-12 03:40:51', 1, NULL, NULL),
(46, 'Accounting Manager', '23', NULL, 'Sok Vitou', '2025-07-12 04:20:07', 1, NULL, NULL),
(47, 'Assistant Finance Director', '26', NULL, 'Sok Vitou', '2025-07-12 04:29:53', 1, NULL, NULL),
(48, 'Finance Manager', '26', NULL, 'Sok Vitou', '2025-07-12 04:35:18', 1, NULL, NULL),
(49, 'គណនេយ្យ', '23', NULL, 'Sok Vitou', '2025-07-12 06:21:35', 1, NULL, NULL),
(50, 'Procurement Supervisor', '26', NULL, 'Sok Vitou', '2025-07-12 06:29:47', 1, NULL, NULL),
(51, 'AP Officer', '26', NULL, 'Sok Vitou', '2025-07-12 07:30:24', 1, NULL, NULL),
(52, 'Procurement Executive', '26', NULL, 'Sok Vitou', '2025-07-12 07:35:55', 1, NULL, NULL),
(53, 'Tax Officer', '26', NULL, 'Sok Vitou', '2025-07-12 08:12:26', 1, NULL, NULL),
(54, 'ប្រធានផ្នែកពន្ធ', '26', NULL, 'Sok Vitou', '2025-07-12 08:21:41', 1, NULL, NULL),
(55, 'Trade Marketing Officer', '39', NULL, 'Sok Vitou', '2025-07-12 08:38:02', 1, NULL, NULL),
(56, 'ប្រធានក្រុមដឹកជញ្ជូន', '27', NULL, 'Sok Vitou', '2025-07-12 08:54:36', 1, NULL, NULL),
(57, 'Satefy', '21', NULL, 'Sok Vitou', '2025-07-12 09:04:34', 1, NULL, NULL),
(58, 'HR IR Manager', '25', NULL, 'Sok Vitou', '2025-07-12 09:11:26', 1, NULL, NULL),
(59, 'ប្រធានឃ្លាំង', '29', NULL, 'Sok Vitou', '2025-07-12 09:13:59', 1, NULL, NULL),
(60, 'ជំនួយការHR', '25', NULL, 'Sok Vitou', '2025-07-12 09:18:57', 1, NULL, NULL),
(61, 'Delivery&fleet Manager', '16', NULL, 'Sok Vitou', '2025-07-12 09:31:55', 1, NULL, NULL),
(62, 'Training', '25', NULL, 'Sok Vitou', '2025-07-12 09:32:12', 1, NULL, NULL),
(63, 'ជំនួយការEA', '16', NULL, 'Sok Vitou', '2025-07-12 09:41:07', 1, NULL, NULL),
(64, 'Assistant Fleet', '16', NULL, 'Sok Vitou', '2025-07-12 09:41:09', 1, NULL, NULL),
(65, 'HR Director', '21', NULL, 'Sok Vitou', '2025-07-12 09:41:51', 1, NULL, NULL),
(66, 'Inventory Executive', '16', NULL, 'Sok Vitou', '2025-07-12 09:44:39', 1, NULL, NULL),
(67, 'Fleet Supervisor', '16', NULL, 'Sok Vitou', '2025-07-12 09:48:54', 1, NULL, NULL),
(68, 'Payroll Manager', '25', NULL, 'Sok Vitou', '2025-07-12 09:49:36', 1, NULL, NULL),
(69, 'ប្រធានបច្ចេកទេស', '16', NULL, 'Sok Vitou', '2025-07-12 09:57:52', 1, NULL, NULL),
(70, 'Stock Officer', '16', NULL, 'Sok Vitou', '2025-07-12 10:03:57', 1, NULL, NULL),
(71, 'ប្រធានផ្នែក', '29', NULL, 'Sok Vitou', '2025-07-12 10:07:25', 1, NULL, NULL),
(72, 'Web Developer', '40', NULL, 'Sok Vitou', '2025-07-14 02:21:53', 1, NULL, NULL),
(73, 'Production Admin', '22', NULL, 'Sok Vitou', '2025-07-14 02:29:23', 1, NULL, NULL),
(74, 'អនុប្រធានផលិតទឹកកេស', '14', NULL, 'Sok Vitou', '2025-07-14 02:32:35', 1, NULL, NULL),
(75, 'QA', '22', NULL, 'Sok Vitou', '2025-07-14 02:50:16', 1, NULL, NULL),
(76, 'Peakaging Manager', '22', NULL, 'Sok Vitou', '2025-07-14 02:55:04', 1, NULL, NULL),
(77, 'Brand Manager', '39', NULL, 'Sok Vitou', '2025-07-15 04:45:01', 1, NULL, NULL),
(78, 'Payment Verification', '26', NULL, 'Sok Vitou', '2025-07-15 08:12:03', 1, NULL, NULL),
(79, 'Area Sale Manager', '19', NULL, 'Sok Vitou', '2025-07-15 09:05:11', 1, NULL, NULL),
(80, 'Sale Director', '37', NULL, 'Sok Vitou', '2025-07-16 02:50:09', 1, NULL, NULL),
(81, 'Regional Sale Manager', '37', NULL, 'Sok Vitou', '2025-07-16 03:47:04', 1, NULL, NULL),
(82, 'បេឡា', '18', NULL, 'Sok Vitou', '2025-07-19 03:02:05', 1, NULL, NULL),
(83, 'ប្រធានផ្នែក', '41', NULL, 'Sok Vitou', '2025-07-22 07:46:07', 1, NULL, NULL),
(84, 'Brand Supervisor', '39', NULL, 'Sok Vitou', '2025-07-24 07:23:09', 1, NULL, NULL),
(85, 'ប្រធានផ្នែកទឹកធុង&ទឹកកេស', '42', NULL, 'Sok Vitou', '2025-07-29 04:52:08', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pro_img` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pro_name_kh` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pro_name_en` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `pro_code` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `stock_status` int(11) NOT NULL DEFAULT 1,
  `pro_description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `add_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` char(255) DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `fix_asset_code` varchar(255) DEFAULT NULL,
  `fix_qty` varchar(255) DEFAULT NULL,
  `equipment_type` varchar(255) DEFAULT NULL COMMENT '1:equipemtn, 2:accessories	',
  `price` varchar(255) DEFAULT NULL,
  `expense_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `pro_img`, `pro_name_kh`, `pro_name_en`, `pro_code`, `cat_id`, `qty`, `stock_status`, `pro_description`, `add_by`, `create_date`, `delete_status`, `delete_by`, `delete_date`, `year`, `model`, `serial_number`, `fix_asset_code`, `fix_qty`, `equipment_type`, `price`, `expense_date`) VALUES
(106, 'uploads/products/FUJxmfJ8V9XLQzwiTTTzONED90obFjUkPwulZQwi.jpg', 'Mouseខ្សែ', 'Mouse', '1', 20, 0, 0, 'Mouseខ្សែពណ៌ខ្មៅ', 'Sok Vitou', '2025-03-22', 1, '', '0000-00-00', '2025', 'Logitech', '2324HS05QQQ9', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(107, 'uploads/products/3qYnbG9d5GEb0WrPwgQyYLO03maVrr5wq1HWTVX7.jpg', 'កុំព្យូទ័រយួរដៃ', 'Laptop', '1', 16, 1, 1, 'Latop យកពីផ្ទះមីង', 'Voeurn Sokheng', '2025-03-22', 1, '', '0000-00-00', '2025', 'Mac book', 'W893421U7XJ', 'F-OE-01282', '1', NULL, NULL, '2025-07-21 10:42:27'),
(108, 'uploads/products/OelZMXA3tfIvOxmCawtYJXGjeGAyiQgiEYWhis28.jpg', 'កុំព្យូទ័រយួរដៃ', 'Laptop', '1', 16, 1, 1, 'laptop បានមកពីផ្ទះអ្នកមីង', 'Voeurn Sokheng', '2025-03-22', 1, '', '0000-00-00', '2025', 'Sony vaio', 'J002EU8V', 'F-OE-01281', '1', NULL, NULL, '2025-07-21 10:42:27'),
(109, 'uploads/products/ltcSW8J7nmeqjo6u3Q4uSmrzkFkA47JSmrLAATyG.jpg', 'Mouseខ្សែ', 'Mouse', '1', 20, 0, 0, '', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Logitech', '2447APEAAKT9', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(110, 'uploads/products/gUwxtJqdwY0WuMgufVHfPdOwVrCIK4zFxTZ0NyrV.jpg', 'Mouseខ្សែ', 'Mouse', '1', 20, 0, 0, 'Mouseខ្សែ', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Logitech', '2324HS05QQP9', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(111, 'uploads/products/oGJwQOcwUubrUcLmEitMoxWTt1YTIDU6j987RFEF.jpg', 'Mouseខ្សែ', 'Mouse', '1', 20, 0, 0, 'Mouseខ្សែ', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Logitech', '2447APSAAKS9', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(112, 'uploads/products/4nrw0Idy8Z7sU4lGf1rrsPo0DThTaNiDG7ope8mc.jpg', 'Mouse​​ wireless', 'Mouse​​ wireless', '1', 20, 0, 0, 'Mouse wireless', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Logitech', '2444ZERM69', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(113, 'uploads/products/TyiBEKmHubIRotmtMEhQjmoE9pZJQp94BJEKZXI6.jpg', '', 'Keyboard', '8', 22, 1, 1, 'keyboardប្រើខ្សែ', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Dell', 'CN-066M5G-LO300-3AA-OFFV', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(114, 'uploads/products/R3XW1xOsncNEamU1NEzfshZRtseVv53qzPzmizxX.jpg', '', 'Keyboard', '8', 22, 1, 1, NULL, 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Logitech', '2232MR1BF579', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(115, 'uploads/products/J5JvQjnkjoANrAadQCd5vR0nqTM8SizjiGRA6V5Y.jpg', '', 'Keyboard', '8', 22, 1, 1, 'Keyboardប្រើខ្សែ', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Logitech', '2232MR1BF589', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(116, 'uploads/products/OTgrc0oww9FgX4GVXkoTyzgOcBCQ2UZ9lzEGycNT.jpg', '', 'Keyboard', '8', 22, 1, 1, 'Keyboard ប្រើខ្សែ', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Logitech', '2232MR1AEF59', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(117, '', '', 'Keyboar', '8', 22, 1, 1, 'Keyboard ប្រើខ្សែ', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Logitech', '2232MR1BF5A9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(118, '', '', 'Keyboard', '8', 22, 1, 1, 'Keyboard ប្រើខ្សែ', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Logitech', '2232MR1BF599', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(119, 'uploads/products/kBULCscDPjDRJGYCiJrsoL25kLeF0zxAuSrd5gVC.jpg', '', 'Laptop', '1', 16, 0, 0, 'LaptopបានមកពីខាងHR(ម៉ីស៊ាង)', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Asus Vivo book', 'RBNOCV12M30548E', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(120, 'uploads/products/Cyi7lU7xhfymhIc4jaP7RJfhnLagrLhSckGm0x2l.jpg', 'កុំព្យូទ័រយួរដៃ', 'Laptop', '1', 16, 0, 0, 'LaptopទទួលបានមកពីខាងHolica Manager', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Asus Vivo book', 'R7N0CV20579230B', 'F-0E-01106', '1', NULL, NULL, '2025-07-21 10:42:27'),
(121, 'uploads/products/aZYvqL93PLyq3n7fDAOwnHVk67RaHeapyLzMMDQu.jpg', '', 'Adapter', '1', 28, 0, 0, 'AdapterទទួលបានមកពីHolica Manager', 'Sok Vitou', '2025-03-24', 1, '', '0000-00-00', '2025', 'Asus Vivo book', '', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(122, 'uploads/products/vRrcGGz4zpzDbKsx0nX4hmgQpHTbPtORRbkhcchx.jpg', NULL, 'Adapter', '1', 28, 0, 0, 'AdapterទទួលបានមកពីHR(ម៉ីស៊ាង)', 'Sok Vitou', '2025-03-24', 1, NULL, NULL, '2025', 'Asus Vivo book', '0A001-01105100343B00YEL', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(123, 'uploads/products/RZmXScdYA53Rhn16RdKoHEblDZCDPGVl8VZifr2Z.jpg', 'ម៉ាស៊ីនព្រីនcolor', 'Printer color', '1', 19, 0, 0, 'Printer color', 'Sok Vitou', '2025-03-25', 1, '', '0000-00-00', '2025', 'HP Color LaserJet Pro MFP M283fdw', 'CNBRQCW43B', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(124, 'uploads/products/QnGQAFCQqM69iNl2mYA7vN2irqOecVmfEBY9N4Oc.jpg', 'Monitor', 'Moniter', '1', 18, 0, 0, 'Monitor', 'Sok Vitou', '2025-03-25', 1, '', '0000-00-00', '2025', 'LED Monitor Dell 22\" E2223HN FHD', 'CN-032GTV-FCC00-398-AGJX', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(125, 'uploads/products/ndgOryRkS59DyTu39eiatsGgf2dmaP9mb6RMtKag.jpg', 'Desktop', 'Desktop', '1', 17, 0, 0, 'Desktop', 'Sok Vitou', '2025-03-25', 1, '', '0000-00-00', '2025', 'Dell OptiPlex 7010 Tower', 'HCYL544', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(126, 'uploads/products/oRSDFsGEF9CBgNw2OGmm6Va1xHi5ebjUq0Nkau4P.jpg', 'Keyboard', 'Keyboard', '1', 22, 0, 0, 'keyboard', 'Sok Vitou', '2025-03-25', 1, '', '0000-00-00', '2025', 'Dell', 'CN-063Y55-LO300-442-04VR', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(127, 'uploads/products/qyrZ4hkl2USMlhmZoruomPCllbD7HZ632zOJGFhq.jpg', 'Mouse', 'Mouse', '1', 20, 0, 0, 'Mouseខ្សែ', 'Sok Vitou', '2025-03-25', 1, '', '0000-00-00', '2025', 'Dell', 'CN-0DMV3P-CH400-43P-0D0O-A01', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(128, 'uploads/products/2M4JraT0YgvOblaPcvote42DOWz6GdCOvzJnpywb.jpg', 'Mousepad', 'Mousepad', '1', 21, 0, 0, 'Mousepad', 'Sok Vitou', '2025-03-25', 1, '', '0000-00-00', '2025', '', '', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(129, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, 'Mousepad', 'Sok Vitou', '2025-03-26', 1, '', '0000-00-00', '2025', '', '', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(130, 'uploads/products/nmYkwIYKwYnM93KyQUBO3GCmR0VMRezlDtCV5LPO.jpg', 'អំពូលសូឡា', 'Solar light', '1', 29, 9, 1, 'សម្រាប់ដាក់នៅទីតាំងព្រែកប្រា', 'Sok Vitou', '2025-03-26', 0, 'Sok Vitou', '2025-07-14', '2025', '', '', '', '9', NULL, NULL, '2025-07-21 10:42:27'),
(131, 'uploads/products/NlO1IHteg1ye4ARg5nP5XRKsrUGK4ndsFvdulclR.jpg', 'USB-wifi', 'USB-wifi', '1', 30, 0, 0, 'USB-wifi', 'Sok Vitou', '2025-03-27', 1, '', '0000-00-00', '2025', 'TP-link', '2248049004971', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(132, 'uploads/products/S3JSbhXyDqbR7OGWVZz0yQwspgUwY2vd1vIrvGZn.jpg', 'SSD-512GB', 'SSD-512BG', '1', 31, 0, 0, 'SSD512GB(ហាក់-ប៊ុនថុង)', 'Sok Vitou', '2025-03-31', 1, '', '0000-00-00', '2025', 'COLOFUL-SOLID-STATE-DRIVE', '0100301IPXZ00D2', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(133, 'uploads/products/zHFchuugDChylP69TFYPTW6H7B49CwPJxNL0RJb4.jpg', 'SSD-512GB', 'SSD-512GB', '1', 31, 0, 0, 'SSD-512GB(ឃុន អីណា)', 'Sok Vitou', '2025-03-31', 1, '', '0000-00-00', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ003N', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(134, 'uploads/products/YQyAVNgSOad8SeTsaKWqLqKyDDuihXFCvfTG3vjs.jpg', 'Mouse-AUlA-F816', 'Mouse-AUlA-F816', '1', 20, 0, 0, 'Mouse-AUlA-F816', 'Sok Vitou', '2025-03-31', 1, '', '0000-00-00', '2025', 'AUlA-F816', 'MSF816ED240302495', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(135, 'uploads/products/IMwItykagL4Y2pcl2WbaHvjTSDJdkSiY5izv0fPy.jpg', 'Keyboard-AULA-F2088', 'Keyboard-AULA-F2088', '1', 22, 0, 0, 'Keyboard-AULA-F2088', 'Sok Vitou', '2025-03-31', 1, '', '0000-00-00', '2025', 'AULA-F2088', 'KBF2088EK240314083', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(136, '', 'Monitor-Dell27\"-U2724D-QHD-2K-UItraSharp', 'Monitor-Dell27\"-U2724D-QHD-2K-UItraSharp', '1', 18, 0, 0, 'Monitor-Dell27\"-U2724D-QHD-2K-UItraSharp', 'Sok Vitou', '2025-03-31', 1, '', '0000-00-00', '2025', 'Dell27\"-U2724D-QHD-2K-UItraSharp', 'CN-07VD2T-WSLOO48M-BQ1L', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(137, '', 'Desktop', 'Desktop', '1', 17, 0, 0, 'Desktop(PC-MB-B760M-DS3H-AX-DDR4)', 'Sok Vitou', '2025-03-31', 1, '', '0000-00-00', '2025', 'PC-MB-B760M-DS3H-AX-DDR4', '', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(138, NULL, 'Laptop', 'Laptop', '1', 16, 0, 0, 'Laptop model Dell-Inspiron', 'Sok Vitou', '2025-03-31', 1, '', '0000-00-00', '2025', 'Dell-Inspiron', '7PSZ434', 'F-0E-01199', '1', NULL, NULL, '2025-07-21 10:42:27'),
(139, '', 'Mouse Wireless', 'Mouse Wireless', '7', 20, 1, 1, 'Mouse-Bluetooth model', 'Sok Vitou', '2025-03-31', 1, '', '0000-00-00', '2025', NULL, NULL, NULL, '1', '2', NULL, '2025-07-21 10:42:27'),
(140, '', 'Adapter', 'Adapter', '1', 28, 0, 0, 'Adapter model Dell', 'Sok Vitou', '2025-03-31', 1, '', '0000-00-00', '2025', 'Dell', '07JHD3-CH600-42GOGDY-A01', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(141, '', 'កាតាប', 'bag', '1', 32, 0, 0, '', 'Sok Vitou', '2025-03-31', 1, '', '0000-00-00', '2025', 'Dell', '', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(142, '', 'Laptop', 'Laptop', '1', 16, 0, 0, 'Laptop', 'Sok Vitou', '2025-04-01', 1, '', '0000-00-00', '2025', 'Asus-Vivo book', 'R2N0CV12X33609H', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(143, '', 'Charger', 'Charger', '1', 28, 0, 0, 'Charger', 'Sok Vitou', '2025-04-01', 1, '', '0000-00-00', '2025', 'Asus ADP-45BW', 'OA001-01100310C325010330', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(144, '', 'Mouse BlueTooth', 'Mouse BlueTooth', '1', 20, 0, 0, 'Mouse BlueTooth', 'Sok Vitou', '2025-04-01', 1, '', '0000-00-00', '2025', 'METOO', '2404EOO3339', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(145, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, 'Mousepad', 'Sok Vitou', '2025-04-01', 1, '', '0000-00-00', '2025', '', '', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(146, '', 'Bag', 'Bag', '1', 32, 0, 0, 'Bag', 'Sok Vitou', '2025-04-01', 1, '', '0000-00-00', '2025', '', '', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(147, 'uploads/products/uU3Z9BX8zrZlyCXJ4YTFcALRY9AAP62gvnwNBnK5.jpg', 'SSD512GB', 'SSD512GB', '1', 31, 0, 0, 'SSD512GB(ស្រីឡៃ)', 'Sok Vitou', '2025-04-02', 1, '', '0000-00-00', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ00DW', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(148, 'uploads/products/jduejNO9LvoYNG9B7wMn0BDGcZdcaZyKzncBAeDa.jpg', 'SSD-512GB', 'SSD-512GB', '1', 31, 0, 0, 'SSD-512GB(ស្រីតី)', 'Sok Vitou', '2025-04-02', 1, '', '0000-00-00', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ00CK', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(149, 'uploads/products/CWoYBtYhWPcgxxhXbjvuV6PLFpE6xjV0LpV4eM24.jpg', 'SSD-512GB', 'SSD-512GB', '1', 31, 0, 0, 'SSD-512GB(ស្រីពៅ)', 'Sok Vitou', '2025-04-02', 1, '', '0000-00-00', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ00DV', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(150, 'uploads/products/ZZMfGbFXsWaMklPDk1EZhnF02AE4COkLCKuhxF2y.jpg', 'SSD-512GB', 'SSD-512GB', '1', 31, 0, 0, 'SSD-512GB(ស្រីសូនី)', 'Sok Vitou', '2025-04-02', 1, '', '0000-00-00', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ00CL', '', '1', NULL, NULL, '2025-07-21 10:42:27'),
(151, 'uploads/products/AkCMrxlEuAHoQbErkFk7BTv3tw0O1zPgDS3s09Cm.jpg', 'SSD-512GB', 'SSD-512GB', '1', 31, 0, 0, 'SSD-512GB(បងណុចរោងជាង)', 'Sok Vitou', '2025-04-02', 1, '', '0000-00-00', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ00CJ', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(152, 'uploads/products/1bkDeBTVj6NjIqwkr0jRs6Z6ZJVi00zjiENvSW1U.jpg', 'Printer color', 'Printer color', '1', 19, 0, 0, 'Printer for IT Department', 'Sok Vitou', '2025-04-02', 1, '', '0000-00-00', '2025', 'HP-Color-Laserjet-Pro-MFP-M283fdw', 'CNBRQCW43B', 'F-OE-01313', '1', NULL, NULL, '2025-07-21 10:42:27'),
(153, '', 'Desktop', 'Desktop', '1', 17, 0, 0, 'Desktop សម្រាប់ហាក់ប៊ុនថុងមួយឆុត\nMonitor (22\" LED monitor Dell , CN-0326GTV-FCC00-398-AGJX)x 1\n\nMouse (Dell , cN-ODMV3P-CH400-43P-OD00-A01)x 1\n\nKeyboard (Dell, CN-063Y55-LO300-442-04VR)x1\n\nUSB-wifi (TP-link, 2248049004971)x 1\nMousepad', 'Sok Vitou', '2025-04-02', 1, '', '0000-00-00', '2025', 'Dell-Optiplex7010', 'HCYL544', 'F-OE-01314', '1', NULL, NULL, '2025-07-21 10:42:27'),
(154, '', 'Battery UPS', 'Battery UPS', '31', 33, 1, 1, 'Battery UPS', 'Sok Vitou', '2025-04-02', 1, '', '0000-00-00', '2025', 'Power', NULL, NULL, '2', NULL, NULL, '2025-07-21 10:42:27'),
(155, '', 'Reth soreya', 'Reth soreya', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Asus vivobook', 'T1NCV147931045', 'F-OE-01336', '1', NULL, NULL, '2025-07-21 10:42:27'),
(156, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Asus', 'OA001-01105100442BOOD9P', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(157, '', 'Mouse ខ្សែ', 'Mouse ខ្សែ', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Logitech', '2324HSO05QJL9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(158, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(159, '', 'bag', 'bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(160, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Dell Vostro 3020MT', '6LGCKZ3', 'F-OE-101337', '1', NULL, NULL, '2025-07-21 10:42:27'),
(161, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Dell 27\"FullHD', 'CN-OGNJ7Y-TV200-48R-03QT', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(162, '', 'UPS', 'UPS', '1', 34, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Prolink 650VA', '53O501250800877', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(163, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(164, '', 'Mouse ខ្សែ', 'Mouse ខ្សែ', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(165, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(166, '', 'Desktop(cpu)', 'Desktop(cpu)', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Dell Inspiron 3030', 'CMQP064', 'F-OE-01331', '1', NULL, NULL, '2025-07-21 10:42:27'),
(167, '', 'UPS', 'UPS', '1', 34, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Prolonk 650VA', '5305O1244500658', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(168, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Dell 27\" 2K', 'TH-OC6TWW-TVHOO-4CB-121B', 'F-OE-01330', '1', NULL, NULL, '2025-07-21 10:42:27'),
(169, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Dell Inspiron 3030', 'DWHQ064', 'F-OE-01329', '1', NULL, NULL, '2025-07-21 10:42:27'),
(170, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Dell 21.5\"', '0V078R-FCOO-485-CMGX', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(171, '', 'UPS', 'UPS', '1', 34, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Prolink 650VA', '53O50124450057', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(172, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Dell', 'CN-0006HY-PRCOO-48M-AD5J', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(173, '', 'Mouse ខ្សែ', 'Mouse ខ្សែ', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', 'Dell', 'CN-065K5F-LO300-47Q-OABJ-A03', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(174, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-05-01', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(175, '', 'Tablet', 'Tablet', '1', 35, 0, 0, 'ម៉ាន់ភ័ត្រា អ្នកទទួល', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', 'Galaxy Tab A7lite', 'R83W60B9P4P', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(176, NULL, 'Laptop', 'Laptop', '1', 16, 0, 0, 'យា វិច្ឆិកា', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', 'Asus vivobook', 'R4NOCV02N897142', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(177, '', 'Mouse BlueTooth', 'Mouse BlueTooth', '1', 20, 0, 0, 'យា វិច្ឆិកា', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', 'METOO', '2407E003624', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(178, '', 'Charger', 'Charger', '1', 28, 0, 0, 'យា​ វិច្ឆិកា', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', NULL, 'OA001-01050600305B008JJ', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(179, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, 'យា វិច្ឆិកា', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(180, '', 'កាតាប', 'Bag', '1', 32, 0, 0, 'យា​ វិច្ឆិកា', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(181, '', 'Laptop', 'Laptop', '1', 16, 0, 0, 'សុខ សុវណ្ណពិសិដ្ឌ', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', 'Dell Inspiron', '3B05Y64', 'F-OE-01345', '1', NULL, NULL, '2025-07-21 10:42:27'),
(182, '', 'Mouse BlueTooth', 'Mouse BlueTooth', '1', 20, 0, 0, 'សុខ សុវណ្ណពិសិដ្ឌ', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(183, '', 'Adapter', 'Adapter', '1', 28, 0, 0, 'សុខ សុវណ្ណពិសិដ្ឌ', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', 'Dell', 'CN-07JHD3-CH600-4AE-09T4-A02', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(184, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, 'សុខ សុវណ្ណពិសិដ្ឌ', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(185, '', 'bag', 'bag', '1', 32, 0, 0, 'សុខ សុវណ្ណពិសិដ្ឌ', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(186, '', 'Charger', 'Charger', '1', 28, 0, 0, 'យា វិច្ឆិកា', 'Sok Vitou', '2025-05-22', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(187, NULL, 'Mouse ខ្សែ', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-06-26', 1, NULL, NULL, '2025', NULL, '2447APNABNQ9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(188, '', 'Mouse ខ្សែ', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-06-26', 1, NULL, NULL, '2025', 'Dell', 'CN-065K5F-LO300-47K-0652-A03', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(189, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-06-26', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(190, NULL, 'Desktop(PC)', 'Desktop(PC)', '1', 17, 0, 0, 'Desktop ប្រភេទPC ជាdesktop ថ្មី', 'Sok Vitou', '2025-06-26', 1, NULL, NULL, '2025', 'PC', NULL, 'F-OE-01361', '1', NULL, NULL, '2025-07-21 10:42:27'),
(191, '', 'Monitor 27\"', 'Monitor 27\"', '1', 18, 0, 0, 'Monitor 27\" has Fix asset F-OE-01361', 'Sok Vitou', '2025-06-26', 1, NULL, NULL, '2025', 'Dell', 'CN-07VD2T-WSL00-48M-BPRL', 'F-OE-01361', '1', NULL, NULL, '2025-07-21 10:42:27'),
(192, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, 'Keyboard ឆុតជាមួយDesktop and Monitor', 'Sok Vitou', '2025-06-26', 1, NULL, NULL, '2025', 'AULA T400', 'MBT400FK241101174', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(193, '', 'Mouse', 'Mouse', '1', 20, 0, 0, 'Mouse set with desktop and monitor', 'Sok Vitou', '2025-06-26', 1, NULL, NULL, '2025', 'AULA T400', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(194, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, 'Mouse pad is set with desktop and monitor', 'Sok Vitou', '2025-06-26', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(195, '', 'UPS', 'UPS', '1', 34, 0, 0, NULL, 'Sok Vitou', '2025-06-26', 1, NULL, NULL, '2025', 'Pro 700 SFC', '5305012510O0530', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(196, '', 'Monitor 24\"', 'Monitor 24\"', '1', 18, 0, 0, 'Monitor ទទួលពី Ourn Srey pich', 'Sok Vitou', '2025-06-26', 1, NULL, NULL, '2025', 'Dell', NULL, 'F-OE-00911', '1', NULL, NULL, '2025-07-21 10:42:27'),
(197, '', 'Mouse', 'Mouse', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Logitech', '2447APKAB849', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(198, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(199, '', 'Mouse wireless', 'Mouse wireless', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(200, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Dell Vostro 3520', 'GW!HS64', 'F-OE-01392', '1', NULL, NULL, '2025-07-21 10:42:27'),
(201, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Dell 65.ow', 'CN-03PHNW-LOCOO-4A2-2253-A02', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(202, '', 'Mouse wireless', 'Mouse wireless', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'MIXIE', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(203, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(204, '', 'All in one', 'All in one', '1', 36, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'AOC', 'A24A99KKC00104', 'F-OE-01389', '1', NULL, NULL, '2025-07-21 10:42:27'),
(205, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'AOC', '1203C12418009656', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(206, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus Vivobook Go14', 'SCNOCV043427508', 'F-OE-01270', '1', NULL, NULL, '2025-07-21 10:42:27'),
(207, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus', 'OA001-01105100443B003RM', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(208, '', 'Mouse Bluetooth', 'Mouse Bluetooth', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Dell', 'CN-ONRG41-PRCOO-440-00D3', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(209, '', 'Mouse pad', 'Mouse Pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(210, '', 'Bag', 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Dell', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(211, '', 'Mouse Bluetooth', 'Mouse Bluetooth', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Logitech', '2451ZET2CZ29', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(212, '', 'Laptop', 'Laptop', '1', 16, 1, 1, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus Vivobook', 'R7NOCV20587130C', 'F-OE-00861', '1', NULL, NULL, '2025-07-21 10:42:27'),
(213, '', 'Adapter', 'Adapter', '6', 28, 1, 1, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus ADP-45BW', 'OA00101103100325009408', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(214, '', 'Mouse Bluetooth', 'Mouse Bluetooth', '27', 20, 1, 1, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Logitech', '2431ZFQ7SWW8', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(215, '', 'Mousepad', 'Mousepad', '1', 21, 1, 1, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(216, '', 'Bag', 'Bag', '30', 32, 1, 1, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(217, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Dell ispriron 15', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(218, '', 'Adaptor', 'Adaptor', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Dell  Inc', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(219, '', 'Mouse', 'Mouse', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Logitech', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(220, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(221, '', 'Bag', 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(222, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Logitech', '810-002182', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(223, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus Vivobook', 'R5NOCV050360198', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(224, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Dell', 'CN-ODMV3P-CH400-353-05SK-A01', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(225, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus', 'OA001-01050600309B00239', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(226, '', 'Bag', 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(227, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus', 'S4NOCVOOB182148', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(228, NULL, 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Logitech', '2407AP029CD9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(229, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus', 'OA001-0110310035202410', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(230, '', 'Bag', 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(231, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(232, '', 'Tablet', 'Tablet', '1', 35, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Galaxy Tab A7 lite', 'R83W60B9N9N', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(233, '', 'Charger', 'Charger', '1', 37, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Samsung', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(234, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Optiplex7010', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(235, '', 'Keyboard Cable', 'Keyboard Cable', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Dell', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(236, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Dell', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(237, '', 'UPS', 'UPS', '1', 34, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', '720V', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(238, '', 'Tablet', 'Tablet', '1', 35, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Samsung', '317224', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(239, '', 'Charger', 'Charger', '1', 37, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Samsung', 'R37NAG29365RT3', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(240, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Dell Inspiron 3530', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(241, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Logitech', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(242, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus vivobook 15x', 'S9NOCX00S223368', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(243, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Asus ADP-65DW', 'OA001-01052500426004747', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(244, '', 'Mouse Wireless', 'Mouse Wireless', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', 'Logitech', '24322E30RHS9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(245, '', 'Mouse Pad', 'Mouse Pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(246, '', 'Bag', 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-11', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(247, '', 'Tablet', 'Tablet', '1', 35, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Galaxy Tab A 7', 'R83WBOB9QEF', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(248, '', 'Charger', 'Charger', '1', 37, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Samsung', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(249, NULL, 'SSD 512GB', 'SSD 512GB', '1', 31, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Colorful', '01003011PXZ00DU', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(250, '', 'Mouse', 'Mouse', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'ORWN6P-LO300-46C-02MY', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(251, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', '4RHNM42', 'F-OE-00289', '1', NULL, NULL, '2025-07-21 10:42:27'),
(252, '', NULL, 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell Inspiron', '07JHD3-CH600-42G0GDY-Ao1', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(253, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, 'CN-OG4G24DESOO', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(254, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', 'PN810002182', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(255, '', 'កាតាប', 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(256, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(257, '', NULL, 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'CN-065K5F-L0300-47k-0652-A03', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(258, '', 'KeyBoard', 'KeyBoard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', '2435MRT1FOZ9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(259, '', NULL, 'Mouse pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(260, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'CN-03TMDH-FCCOO-486-COUX', 'F-OE-01306', '1', NULL, NULL, '2025-07-21 10:42:27'),
(261, '', NULL, 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(262, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', NULL, 'F-OE_00370', '1', NULL, NULL, '2025-07-21 10:42:27'),
(263, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Optical', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(264, '', 'Table', 'Table', '1', 35, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Galaxy Tab A7 lite', 'R83W60B9NPT', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(265, '', 'Charger', 'Charger', '1', 37, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(266, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Asus', '001329100ZR1', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(267, '', 'Mouse', 'Mouse', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', 'PN810-002182', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(268, '', NULL, 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'CN-ORWN^P-LO300-46C-02N1', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(269, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(270, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell 24\"', 'CN-OM50G8-74261-13E-1YUL', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(271, '', NULL, 'laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Asus Vivobook', 'S5NOCVOOB62018G', 'F-0E-00130', '1', NULL, NULL, '2025-07-21 10:42:27'),
(272, '', NULL, 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'AD2108020', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(273, '', NULL, 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(274, '', NULL, 'Keyboard', '1', 20, 0, 0, 'New', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'CN-0006HY-PRC00-47H-A9UD', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(275, '', NULL, 'Laptop', '1', 16, 1, 1, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell Vostro', 'J06KS64', 'F-0E-01375', '1', NULL, NULL, '2025-07-21 10:42:27'),
(276, '', NULL, 'adapter', '6', 28, 1, 1, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'CN-07JHD3-CH600-48Q-LOCA-A02', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(277, '', NULL, 'Moues Bluetooth', '1', 20, 0, 0, 'New', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', '2451ZE32CZC9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(278, '', NULL, 'Mouse Pad', '1', 21, 0, 0, 'New', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(279, '', NULL, 'Bag', '30', 32, 1, 1, 'New', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(280, '', 'USP', 'USP', '1', 34, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Prolink Pro 700SFC', '530501245201818', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(281, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'ASUS Vivobook', 'SAN0CV1388188448', 'F-0E-01245', '1', NULL, NULL, '2025-07-21 10:42:27'),
(282, '', 'Charger', 'Charger', '1', 37, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'ASUS', 'QA001-01105100437B02NDM', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(283, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Prolink', '620901235104815', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(284, '', 'Mouse Pad', 'Mouse Pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(285, '', 'Bag', 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(286, '', NULL, 'laptop', '1', 16, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell Vostro15', '67XK854', 'F-0E-01374', '1', NULL, NULL, '2025-07-21 10:42:27'),
(287, '', NULL, 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell Inc 65w', 'CN-07JHD3-CH600-487OSIS-AO1', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(288, '', NULL, 'Mouse Bluetooth', '1', 20, 0, 0, 'New', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', '2451ZEV2CZ49', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(289, '', NULL, 'Mouse Pad', '27', 21, 1, 1, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(290, '', NULL, 'Bag', '1', 32, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(291, '', NULL, 'laptop', '1', 16, 0, 0, 'Old', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell Latitude3540', '2BQCD14', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(292, '', NULL, 'Mouse', '1', 20, 0, 0, 'old', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'METOO', '2404E002836', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(293, '', NULL, 'Charger', '1', 37, 0, 0, 'old', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'CN-MOK947-48661-192-9HFW-A02', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(294, '', NULL, 'bag', '30', 32, 1, 1, 'Old', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(295, '', 'Mouse Bluetooth', 'Mouse Bluetooth', '7', 20, 1, 1, 'Mouse Bluetooth', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'AIETOO', '2404E003286', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(296, '', 'Laptop', 'Laptop', '1', 16, 1, 1, 'New', 'Sok Vitou', '2025-07-12', 0, 'Sok Vitou', '2025-07-12', '2025', 'Dell Inspiron', '3B05Y46', 'F-0E-01345', '1', NULL, NULL, '2025-07-21 10:42:27'),
(297, '', NULL, 'Mouse Bluetooth', '1', 20, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(298, '', 'TV 55 inch', 'TV 55 inch', '1', 38, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Samsung', NULL, 'F-OE-01348', '1', NULL, NULL, '2025-07-21 10:42:27'),
(299, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell latitude 3540', '1M43C04', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(300, '', NULL, 'Mouse Pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(301, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell la65NS2-01', 'CN-03PHNW-LOCOO-3A7-5B71-A01', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(302, '', NULL, 'bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(303, '', NULL, 'adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Asus', 'A20-100PIA', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(304, '', NULL, 'HP Printer', '1', 19, 0, 0, 'Color', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'HP color M282', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(305, '', NULL, 'Keyboard', '1', 22, 0, 0, 'ខ្សែ', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(306, '', NULL, 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell optiplex3000', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(307, '', NULL, 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'E2223HN', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(308, '', NULL, 'Printer ស-ខ្មៅ', '1', 19, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'HP Laser MF130', 'CNZZJC6804044-BALZEX810365', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(309, '', NULL, 'Tablet+Keyboard', '1', 35, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Lenovo Tab P12', 'HA12FQ9X', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(310, '', 'Mouse wireless', 'Mouse wireless', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', '2127L2X4CS29', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(311, '', NULL, 'Tablet+Keyboard', '1', 35, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Lenovo Tab P12', 'HA12CJPS', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(312, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(313, '', NULL, 'Charger', '1', 37, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Lenovo', NULL, NULL, '2', NULL, NULL, '2025-07-21 10:42:27'),
(314, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell Optiplex Tower', 'FOKL524', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(315, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'B6BOP44', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(316, '', NULL, 'Lenovo Pen', '1', 39, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '2', NULL, NULL, '2025-07-21 10:42:27'),
(317, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', '0081N8-LO300', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(318, '', NULL, 'Printer 80mm', '1', 19, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'RONGTA RP326', 'A326080000310150', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(319, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'dell', '065K5F-LO300-3BP-OIOV-A03', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(320, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(321, '', NULL, 'Adapter Printer', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'ADP-60D24', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(322, '', 'bag', 'bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(323, '', 'Charger', 'Charger', '1', 37, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'ASUS', '0A001-01050600249B00FR4', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(324, '', NULL, 'Monitor', '1', 18, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'CN-06NJ7X-TV200-48R-034T-A00', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(325, '', 'Mouse', 'Mouse', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(326, '', 'Bag', 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(327, '', 'Mouse Pad', 'Mouse Pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(328, '', NULL, 'Projector', '1', 40, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Home Theater', 'E501H', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(329, '', NULL, 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'dell', '2435MRU1F0Y8', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(330, '', 'keyboard', 'keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(331, '', NULL, 'Receipt Printer', '1', 19, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Rongta Rp326', 'A326080000520002', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(332, '', NULL, 'Receipt Printer', '1', 19, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Rongta RP326', 'A326080000520006', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(333, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell OptiPlex 7010 Tower', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(334, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(335, '', 'Keyboard Cable', 'Keyboard Cable', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(336, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(337, '', 'Monitor 22 inch', 'Monitor 22 inch', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'EZZ23HN', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(338, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'HB36XY3', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(339, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell OptiPlex', '1GXG554', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(340, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', '065K5F-LO300-45N-01CC', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(341, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', '0081N8-LO300-45L-07JC', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(342, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(343, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell E223HN', '5D79B14', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(344, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell OptiPlex', '3WOL554', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(345, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'CN-065K5F-LO300-45E-OB22', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(346, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'CN-0081N8-LO300-45M-OA06-A04', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(347, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logiech', '2435MR1FOW8', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(348, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', '2435MR31FOX8', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(349, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(350, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, 'ORWN6P-LO300-46C02NE', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(351, '', NULL, 'Monitor', '1', 18, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'dell', 'CN-0326GTV-FCC00398-AE9X', 'F-0E-01307', '1', NULL, NULL, '2025-07-21 10:42:27'),
(352, '', NULL, 'Desktop', '1', 17, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell Optiplex', '9CY1544', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(353, '', NULL, 'mouse Cable', '1', 20, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'dell', 'CN-0DMV3P-CH400-43P-0D08-A01', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(354, '', NULL, 'Keyboard', '1', 22, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', 'CN-063Y55-L0300-442-0449-A04', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(355, '', NULL, 'Mouse Pad', '1', 21, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(356, '', NULL, 'Bag', '1', 32, 0, 0, 'new', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'dell', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(357, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', '9FCS114', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(358, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell', '032GTV-FCCOO-398-ADVX-A03', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(359, '', NULL, 'laptop', '1', 16, 0, 0, 'old', 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Asus Vivobook', 'RBNOCV12M35048E', 'F-0E-01011', '1', NULL, NULL, '2025-07-21 10:42:27'),
(360, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, '0081N8-LO300-3AO-OOMK-A04', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(361, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, '065K5F-L0300-3AP-0338', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(362, '', 'Mouse Pad', 'Mouse Pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(363, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell Optiplex', '032GTV-FCcoo-398ACUX-A03', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(364, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell OptiPlex', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(365, '', 'Mouse Pad', 'Mouse Pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27');
INSERT INTO `products` (`id`, `pro_img`, `pro_name_kh`, `pro_name_en`, `pro_code`, `cat_id`, `qty`, `stock_status`, `pro_description`, `add_by`, `create_date`, `delete_status`, `delete_by`, `delete_date`, `year`, `model`, `serial_number`, `fix_asset_code`, `fix_qty`, `equipment_type`, `price`, `expense_date`) VALUES
(366, '', 'keyboard', 'keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', '0081N8-LO300-3AOOOJO-A04', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(367, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', '065K5F-Lo300-3AP-033I', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(368, '', 'SSD', 'SSD', '1', 31, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(369, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(370, '', 'Mouse', 'Mouse', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', '2444ZEJERCG9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(371, '', 'Printer', 'Printer', '1', 19, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'HP Color LaserJet', 'CN-BRQCW5J1', 'F-OE-01303', '1', NULL, NULL, '2025-07-21 10:42:27'),
(372, '', 'UPS', 'UPS', '1', 34, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Prolink Pro 700SFC', '530501251000624', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(373, '', 'UPS', 'UPS', '1', 34, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Prolink Pro700SFC', '530501251000529', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(374, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, 'F-OE-00807', '1', NULL, NULL, '2025-07-21 10:42:27'),
(375, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(376, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(377, '', 'Mouse', 'Mouse', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(378, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(379, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Asus Vivobook 14/15', 'R7NOCV205838308', 'F-OE00994', '1', NULL, NULL, '2025-07-21 10:42:27'),
(380, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(381, '', 'Mouse', 'Mouse', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(382, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(383, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell XPS 13', '7CQ9DY3', 'F-OE-01393', '1', NULL, NULL, '2025-07-21 10:42:27'),
(384, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell 45.OW', 'CN-09K9gp-DESOO-29K-307-AOO', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(385, '', 'Mouse wireless', 'Mouse wireless', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'K-Snake', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(386, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(387, '', 'Bag', 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(388, '', 'HDMI Cable', 'HDMI Cable', '1', 41, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'DTech', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(389, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Asus vivobook', 'SBNOCV05983346F', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(390, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(391, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Asus', 'OA001-01103100434036562', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(392, '', 'Bag', 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(393, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dell Optiplex', '07HXKC-FCCOO440-C3UX', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(394, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', '2447APKAAKW9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(395, '', 'Mousepad', 'Mousepad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(396, '', 'Bag', 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(397, '', 'Mouse Bluetooth', 'Mouse Bluetooth', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Logitech', '2444ZEYRM69', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(398, NULL, 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Asus Vivobook', 'S8NOCX11W469345', 'F-OE-01246', '1', NULL, NULL, '2025-07-21 10:42:27'),
(399, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Asus', 'OA001-01052500426017597', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(400, '', 'Mouse Wireless', 'Mouse Wireless', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Dval-Made Mouse', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(401, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Lenvo think pad x1  carbon', 'PF2WTNXZ', 'F-OE-01316', '1', NULL, NULL, '2025-07-21 10:42:27'),
(402, '', 'Adapter', 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'Lenvo Max65w', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(403, '', 'Mouse wireless', 'Mouse wireless', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', 'FDE311', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(404, '', 'Mouse pad', 'Mouse pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-12', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(405, '', 'Tablet', 'Tablet', '1', 35, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Honor pad x8a', 'AKWJ9X4C27GO3613', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(406, '', 'Case Keyboard', 'Case Keyboard', '1', 42, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(407, '', 'Monitor', 'Monitor', '1', 18, 0, 0, 'new', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell 24\"', 'CN-03JMDH-FCC00-47H-CG3X', 'F-0E-0R05', '1', NULL, NULL, '2025-07-21 10:42:27'),
(408, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Logitech', '2447APQABNC9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(409, '', NULL, 'Mouse Cable', '1', 20, 0, 0, 'new សម្រាប់ បំ រតនា ប្រធានផ្នែកផ្លុំដបនិងគំរប', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Logitech', '2324H505QJR9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(410, '', NULL, 'Hard Disk SSD 512G', '1', 23, 0, 0, 'គង់ ប៊ុនធឿន ប្រធានផ្នែកថែទាំម៉ាស៊ីន', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Colorful', '01003011PXZ00KB', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(411, '', NULL, 'Hard Disk SSD', '1', 23, 0, 0, 'new', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Colorful', '0100301IPXZ00KF', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(412, '', NULL, 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Asus vivobook', 'SBOCX02pq2247G', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(413, '', NULL, 'Monitor 24\"', '1', 23, 0, 0, 'គង់ ប៊ុនធឿន ប្រធានផ្នែកថែទាំម៉ាស៊ីន', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', 'CN-03JMDH-FC00-47H-CT3X', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(414, NULL, NULL, 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Asus vivobook', '0A001-01052500432006743', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(415, '', NULL, 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell inspiron', '8QVMX04', 'F-0E-01098', '1', NULL, NULL, '2025-07-21 10:42:27'),
(416, '', NULL, 'Mouse Wireless', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Asus vivobook', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(417, '', NULL, 'Mouse Wireeles', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Prolink', 'MOU-5009-CCL', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(418, '', NULL, 'Mousepad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(419, '', NULL, 'Bag', '1', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(420, '', NULL, 'Charger', '1', 37, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell MGJN9', 'CN-OMGJN9-LOC00-77D-E3EK-A04', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(421, '', NULL, 'Mouse Pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(422, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'OptiPlex Tower 7010', 'H8M5K24', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(423, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', '032GTV-FCCOO-398CMDV', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(424, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', '008IN8-LO300-41803BY', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(425, '', 'Mouse Cable', 'Mouse Cable', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', '065K5F-LO300-414OABI-A03', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(426, '', 'Mouse Pad', 'Mouse Pad', '1', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(427, '', NULL, 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Asus vivibook', 'SBNOCX02pq23477', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(428, '', NULL, 'Mouse', '1', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Asus vivibook', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(429, '', NULL, 'Mouse pad', '27', 21, 1, 1, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(430, '', NULL, 'Adapter', '1', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Asus', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(431, '', NULL, 'SSD 2TB', '1', 31, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Transcand', '143160-0147', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(432, '', 'Desktop', 'Desktop', '1', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'OptiPlex Tower 7010', '902YJ24', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(433, '', NULL, 'Mouse Bluetooth', '1', 20, 0, 0, 'គួយ សុវណ្ណមុនីរ័ត្ន', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Logitech', '2444ZEOERM09', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(434, '', 'Monitor', 'Monitor', '1', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', 'CN-032GTV-FCCOO-398-ACCX', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(435, '', 'Keyboard', 'Keyboard', '1', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', '008IN8-LO300-41803WL', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(436, '', NULL, 'External Box', '32', 23, 0, 0, 'External Box', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Docking', 'y-3026Gy01-EU', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(437, '', 'Mouse Cable', 'Mouse Cable', '7', 20, 0, 0, 'Mouse Cable', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', '065K5F-LO300-41408LU-A03', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(438, '', 'Mouse Pad', 'Mouse Pad', '27', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(439, '', NULL, 'External 1T', '26', 25, 0, 0, 'External 1TB', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Transcand', '177375-0063', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(440, '', NULL, 'Printer', '5', 19, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Hp Color Laseriet Pro MFP M283fdw', 'CNBRQCW4313', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(441, '', NULL, 'Monitor', '3', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', 'CN-OXD5WG-FCC00-52P-CELX', 'F-0E-01401', '1', NULL, NULL, '2025-07-21 10:42:27'),
(442, '', NULL, 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell Inpriron', '8TKCQ94', 'F-0G-01402', '1', NULL, NULL, '2025-07-21 10:42:27'),
(443, '', NULL, 'Mouse wireeles', '7', 20, 0, 0, 'Mouse Wireless', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'FD', 'CN-01C4XJ-L0C0025k-05P7-A02', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(444, '', 'Wi-Fi Router', 'Wi-Fi Router', '34', 43, 0, 0, 'Wi-Fi Router', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Huawei 195Mbps 4G', 'NCE7S24B04005757', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(445, '', NULL, 'adapter', '6', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', 'CN-01C4XJ-L0C0052K-05P7-A02', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(446, '', NULL, 'Mouse Pad', '27', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(447, '', NULL, 'Bag', '30', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(448, '', 'Adapter', 'Adapter', '6', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Huawei', 'UL 9742Q9L04666', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(449, '', NULL, 'laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell inspiron', 'GXKCQ94', 'F-OE01388', '1', NULL, NULL, '2025-07-21 10:42:27'),
(450, '', 'HDMI Cable', 'HDMI Cable', '29', 41, 0, 0, 'HDMI Cable', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'DTech', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(451, '', NULL, 'Adapter', '6', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell 65-OW', 'CN-OG4G24-DESOO-53F-6A32-A03', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(452, '', NULL, 'USB-C', '33', 26, 0, 0, 'USB-C', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'CABLETIME', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(453, NULL, NULL, 'Lapto', '1', 16, 1, 1, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell Inspiron', 'BYT4Y64', 'F-OE-01457', '1', NULL, NULL, '2025-07-21 10:42:27'),
(454, '', NULL, 'Charger', '6', 37, 1, 1, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', 'CN-01C4XJ-L0C00-491-8D30-A02', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(455, '', 'Tablet', 'Tablet', '4', 35, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Samsung Galaxy Tab A 7lite', 'R83W60B9P3X', 'F-OE-00772', '1', NULL, NULL, '2025-07-21 10:42:27'),
(456, '', NULL, 'Mouse wireless', '7', 20, 1, 1, 'សុខី (Mouse wireless)', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Prolink', '613407222000592', NULL, '1', '2', NULL, '2025-07-21 10:42:27'),
(457, '', 'Charger', 'Charger', '6', 37, 0, 0, 'Charger', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(458, '', NULL, 'Mouse Pad', '27', 21, 1, 1, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(459, '', 'Case', 'Case', '32', 42, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(460, '', NULL, 'Bag', '30', 32, 1, 1, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(461, NULL, NULL, 'laptop', '1', 16, 1, 1, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell inspiron', 'JNN4Y64', 'F-OE-01458', '1', NULL, NULL, '2025-07-21 10:42:27'),
(462, '', NULL, 'Adapter', '6', 28, 1, 1, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Dell', 'CN-01C4XJ-L0C00-49L-150A-A02', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(463, '', NULL, 'Mouse wireless', '7', 20, 1, 1, 'ស៊ិប បុរី (Mouse wireless)', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Prolink', '613407222000626', NULL, '1', '2', NULL, '2025-07-21 10:42:27'),
(464, '', NULL, 'Mouse Pad', '27', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(465, '', NULL, 'Bag', '30', 32, 1, 1, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(466, '', NULL, 'Mouse Cable', '7', 20, 0, 0, 'Mouse Cable', 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Logitech', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(467, '', NULL, 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Asus Zenbook 14LED', 'SBNOCX01M364451', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(468, '', NULL, 'Adapter', '6', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(469, '', NULL, 'Mouse', '7', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(470, '', 'Keyboard', 'Keyboard', '8', 22, 1, 1, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'AOC', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(471, '', 'Mouse', 'Mouse', '7', 20, 1, 1, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'AOC', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(472, '', 'Keyboard', 'Keyboard', '8', 22, 1, 1, NULL, 'Sok Vitou', '2025-07-14', 1, NULL, NULL, '2025', 'Logitech', '2233MR1FD578', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(473, '', 'Desktop', 'Desktop', '2', 17, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Dell', 'CDBOBP2', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(474, '', 'Monitor', 'Monitor', '3', 18, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Dell', 'CN-OP8G7C-74445-37Q-CVVS', 'F-OE-00987', '1', NULL, NULL, '2025-07-21 10:42:27'),
(475, '', 'Keyboard', 'Keyboard', '8', 22, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Dell', 'CN-0644G3-LO300-9A7-OQOG-A03', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(476, '', 'Mouse Cable', 'Mouse Cable', '7', 18, 0, 0, 'Mouse Cable', 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(477, '', 'Mouse pad', 'Mouse pad', '27', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(478, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Asus Vivo book S14 OLED', 'SANOKD00784743G', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(479, '', 'Mouse Wireless', 'Mouse Wireless', '7', 20, 0, 0, 'Mouse Wireless', 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Logitech', '1630LZOFZQE9', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(480, '', 'Mousepad', 'Mousepad', '27', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(481, '', 'Bag', 'Bag', '30', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(482, '', 'Adapter', 'Adapter', '6', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Asus', 'OA001-01057000435B00XJL', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(483, '', 'Laptop', 'Laptop', '1', 16, 1, 1, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Asus Vivo book S', 'N6NOCV04Y165239', 'F-OE-01120', '1', '1', NULL, '2025-07-21 10:42:27'),
(484, '', 'Adapter', 'Adapter', '6', 28, 1, 1, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Asus', NULL, NULL, '1', '2', NULL, '2025-07-21 10:42:27'),
(485, '', 'Tablet', 'Tablet', '4', 35, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Honor pad x8a', 'AKWJ9X5419G01944', 'F-OE01459', '1', NULL, NULL, '2025-07-21 10:42:27'),
(486, '', 'Charger', 'Charger', '6', 37, 0, 0, 'Charger', 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(487, '', 'Tablet', 'Tablet', '4', 35, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Honor Pad x8a', 'AKWJ9X5419G01957', 'F-OE01456', '1', NULL, NULL, '2025-07-21 10:42:27'),
(488, '', 'Charger', 'Charger', '6', 37, 0, 0, 'Charger', 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Honor', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(489, '', 'Printer Color', 'Printer Color', '5', 19, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Canon MF752cdw', '4ZB52064', 'F-OE-01455', '1', NULL, NULL, '2025-07-21 10:42:27'),
(490, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Asus Vivobook', 'R4NOCV02N90514C', 'F-OE-00969', '1', NULL, NULL, '2025-07-21 10:42:27'),
(491, '', 'Adapter', 'Adapter', '6', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Asus', 'OA001-01050600305BOOBJD', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(492, '', 'Mouse Wireless', 'Mouse Wireless', '7', 20, 0, 0, 'Mouse Wireless', 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', 'Prolink', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(493, '', 'Mousepad', 'Mousepad', '27', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(494, '', 'Bag', 'Bag', '30', 32, 0, 0, NULL, 'Sok Vitou', '2025-07-15', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(495, '', 'All in one', 'All in one', '1', 36, 0, 0, 'All in one', 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', 'AOC', 'A24A99KKC4C00026', 'F-OE-01461', '1', NULL, NULL, '2025-07-21 10:42:27'),
(496, '', 'Keyboard Wireless', 'Keyboard Wireless', '8', 22, 0, 0, 'Keyboard Wireless', 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', 'AOC', 'SKM400BSPB1500265', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(497, '', 'Mouse Wireless', 'Mouse Wireless', '7', 20, 0, 0, 'Mouse Wireless', 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', 'AOC', NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(498, '', 'Mousepad', 'Mousepad', '27', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(499, '', 'All in one', 'All in one', '1', 36, 0, 0, 'All in one', 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', 'AOC', 'A24A99KKC4C00025', 'F-OE-01460', '1', NULL, NULL, '2025-07-21 10:42:27'),
(500, '', 'Adapter', 'Adapter', '6', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', NULL, '1203C12434001280', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(501, '', 'Laptop', 'Laptop', '1', 16, 0, 0, NULL, 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', 'Asus Vivobook Go 14/15', 'S4NOCVOOB077144', 'F-OE-00870', '1', NULL, NULL, '2025-07-21 10:42:27'),
(502, '', 'Mouse Bluetooth', 'Mouse Bluetooth', '7', 20, 0, 0, 'Mouse Bluetooth', 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', 'METOO', '2404E0022870', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(503, '', 'Adapter', 'Adapter', '6', 28, 0, 0, NULL, 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', 'Asus', 'OA001-01103100352024803', NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(504, '', 'Mousepad', 'Mousepad', '27', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', NULL, NULL, '2025-07-21 10:42:27'),
(505, '', 'Monitor', 'Monitor', '3', 18, 1, 1, NULL, 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', 'Dell', 'CN-OT233K-64180-939-1KQL', 'F-OE-00354', '1', NULL, NULL, '2025-07-21 10:42:27'),
(506, '', 'Desktop', 'Desktop', '2', 17, 1, 1, NULL, 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', 'Dell', NULL, 'F-OE-00338', '1', '1', NULL, '2025-07-21 10:42:27'),
(507, '', 'Mouse Cable', 'Mouse Cable', '7', 20, 1, 1, 'Mouse Cable', 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', 'Dell', 'CN-OX78GR-71616524-8Z50', NULL, '1', '2', NULL, '2025-07-21 10:42:27'),
(508, '', 'Keyboard Cable', 'Keyboard Cable', '8', 22, 1, 1, 'Keyboard Cable', 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', 'Dell', 'CN-01HF2Y-71616-14I-OKGQ-AOO', NULL, '1', '2', NULL, '2025-07-21 10:42:27'),
(509, '', 'Mousepad', 'Mousepad', '27', 21, 1, 1, NULL, 'Sok Vitou', '2025-07-16', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', '2', NULL, '2025-07-21 10:42:27'),
(510, NULL, 'ម៉ាស៊ីនព្រីន', 'Printer', '5', 19, 0, 0, NULL, 'Sok Vitou', '2025-07-17', 1, NULL, NULL, '2025', 'HP LaserJet Pro MFP M125a', 'CNB6J6MOM8', 'F-OE-00883', '1', '1', NULL, '2025-07-21 10:42:27'),
(511, NULL, 'ម៉ាស៊ីនព្រីន', 'Printer', '5', 19, 0, 0, NULL, 'Sok Vitou', '2025-07-17', 1, NULL, NULL, '2025', 'HP Laser Jet MFP 139 fnw', 'CNB1SCQ3D2', NULL, '1', '1', NULL, '2025-07-21 10:42:27'),
(512, NULL, 'ម៉ាស៊ីនព្រីន', 'Printer', '5', 19, 0, 0, NULL, 'Sok Vitou', '2025-07-17', 1, NULL, NULL, '2025', 'HP Laser Jet MFP 139 fnw', 'CNB1T2C2BB', NULL, '1', '1', NULL, '2025-07-21 10:42:27'),
(513, '', 'Desktop (All in one)', 'Desktop (All in one)', '2', 36, 0, 0, 'Desktop (All-in-one)', 'Sok Vitou', '2025-07-26', 1, NULL, NULL, '2025', 'AOC', 'A24A99KKC4C00007', NULL, '1', '1', NULL, '2025-07-26 03:02:24'),
(514, '', 'Keyboard Wireless', 'Keyboard Wireless', '8', 22, 0, 0, 'Keyboard Wireless', 'Sok Vitou', '2025-07-26', 1, NULL, NULL, '2025', 'AOC', 'SKM400BSPB1500055', NULL, '1', '2', NULL, '2025-07-26 03:04:10'),
(515, '', 'Mouse Wireless', 'Mouse Wireless', '7', 20, 0, 0, NULL, 'Sok Vitou', '2025-07-26', 1, NULL, NULL, '2025', 'AOC', NULL, NULL, '1', '2', NULL, '2025-07-26 03:05:05'),
(516, '', 'Mousepad', 'Mousepad', '27', 21, 0, 0, NULL, 'Sok Vitou', '2025-07-26', 1, NULL, NULL, '2025', 'AOC', NULL, NULL, '1', '2', NULL, '2025-07-26 03:05:48'),
(517, '', 'Laptop', 'Laptop', '1', 16, 1, 1, NULL, 'Sok Vitou', '2025-07-28', 1, NULL, NULL, '2025', 'Blackview Acebook 8', 'BVAcebook80034061', NULL, '1', '1', NULL, '2025-07-28 04:16:33'),
(518, '', 'Adapter', 'Adapter', '6', 28, 1, 1, NULL, 'Sok Vitou', '2025-07-28', 1, NULL, NULL, '2025', 'M120300-A078', NULL, NULL, '1', '2', NULL, '2025-07-28 04:17:14'),
(519, '', 'Mouse wireless', 'Mouse wireless', '7', 20, 1, 1, 'Mouse wireless', 'Sok Vitou', '2025-07-28', 1, NULL, NULL, '2025', NULL, NULL, NULL, '1', '2', NULL, '2025-07-28 04:18:24'),
(520, '', 'Mousepad', 'Mousepad', '27', 21, 1, 1, NULL, 'Sok Vitou', '2025-07-28', 1, NULL, NULL, '2025', 'Yak Technology', NULL, NULL, '1', '2', NULL, '2025-07-28 04:19:40'),
(521, '', 'Bag', 'Bag', '30', 32, 1, 1, NULL, 'Sok Vitou', '2025-07-28', 1, NULL, NULL, '2025', 'Yak Technology', NULL, NULL, '1', '2', NULL, '2025-07-28 04:20:19'),
(522, NULL, 'Printer', 'Printer', '5', 19, 0, 0, NULL, 'Sok Vitou', '2025-07-29', 1, NULL, NULL, '2025', 'HP Laser Jet pro MFP M125a', 'CNB6J3T6TL', 'F-OE-00276', '1', '1', NULL, '2025-07-29 04:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_locks`
--

CREATE TABLE `product_locks` (
  `id` int(11) NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `give_date` timestamp NULL DEFAULT NULL,
  `give_user` bigint(20) DEFAULT NULL,
  `return_date` timestamp NULL DEFAULT NULL,
  `recieve_user` varchar(255) DEFAULT NULL,
  `return_status` int(11) DEFAULT NULL,
  `return_by` bigint(20) DEFAULT NULL,
  `give_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_locks`
--

INSERT INTO `product_locks` (`id`, `product_id`, `give_date`, `give_user`, `return_date`, `recieve_user`, `return_status`, `return_by`, `give_by`) VALUES
(1, 197, '2025-07-07 03:27:42', 8398, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(2, 198, '2025-07-08 03:35:10', 8399, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(3, 199, '2025-06-14 03:38:00', 8391, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(4, 203, '2025-07-03 03:48:10', 8400, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(5, 202, '2025-07-03 03:48:10', 8400, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(6, 201, '2025-07-03 03:48:10', 8400, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(7, 200, '2025-07-03 03:48:10', 8400, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(8, 205, '2025-06-23 04:01:27', 8401, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(9, 204, '2025-06-23 04:01:27', 8401, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(10, 210, '2025-06-03 04:16:02', 8402, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(11, 209, '2025-06-03 04:16:03', 8402, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(12, 208, '2025-06-03 04:16:03', 8402, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(13, 207, '2025-06-03 04:16:03', 8402, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(14, 206, '2025-06-03 04:16:03', 8402, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(15, 211, '2025-06-04 04:20:05', 8403, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(16, 216, '2025-06-02 04:36:44', 8404, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(17, 215, '2025-06-02 04:36:44', 8404, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(18, 214, '2025-06-02 04:36:44', 8404, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(19, 213, '2025-06-02 04:36:44', 8404, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(20, 212, '2025-06-02 04:36:44', 8404, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(21, 221, '2024-12-09 05:00:37', 8406, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(22, 220, '2024-12-09 05:00:37', 8406, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(23, 219, '2024-12-09 05:00:37', 8406, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(24, 218, '2024-12-09 05:00:37', 8406, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(25, 217, '2024-12-09 05:00:37', 8406, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(26, 222, '2024-12-30 06:30:44', 8401, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(27, 226, '2025-01-04 06:37:27', 8407, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(28, 225, '2025-01-04 06:37:27', 8407, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(29, 224, '2025-01-04 06:37:27', 8407, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(30, 223, '2025-01-04 06:37:27', 8407, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(31, 231, '2025-01-02 06:47:41', 8408, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(32, 230, '2025-01-02 06:47:41', 8408, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(33, 229, '2025-01-02 06:47:41', 8408, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(34, 228, '2025-01-02 06:47:41', 8408, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(35, 227, '2025-01-02 06:47:41', 8408, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(36, 233, '2024-12-28 06:56:06', 8409, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(37, 232, '2024-12-28 06:56:06', 8409, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(38, 237, '2024-10-22 07:09:35', 8410, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(39, 236, '2024-10-22 07:09:35', 8410, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(40, 235, '2024-10-22 07:09:35', 8410, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(41, 234, '2024-10-22 07:09:35', 8410, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(42, 239, '2025-03-12 07:16:50', 8411, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(43, 238, '2025-03-12 07:16:50', 8411, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(44, 241, '2024-12-03 07:34:14', 8412, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(45, 240, '2024-12-03 07:34:14', 8412, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(46, 246, '2025-01-02 07:43:04', 8413, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(47, 245, '2025-01-02 07:43:04', 8413, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(48, 244, '2025-01-02 07:43:04', 8413, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(49, 243, '2025-01-02 07:43:04', 8413, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(50, 242, '2025-01-02 07:43:04', 8413, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(51, 248, '2025-01-11 02:44:17', 8414, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(52, 247, '2025-01-11 02:44:17', 8414, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(53, 250, '2025-02-04 03:17:26', 8416, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(54, 256, '2025-02-21 03:25:37', 8417, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(55, 255, '2025-02-21 03:25:37', 8417, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(56, 254, '2025-02-21 03:25:37', 8417, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(57, 253, '2025-02-21 03:25:37', 8417, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(58, 251, '2025-02-21 03:25:37', 8417, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(59, 258, '2025-02-10 03:27:40', 8398, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(60, 252, '2025-04-23 03:37:15', 8393, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(61, 265, '2025-01-02 03:38:26', 8400, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(62, 264, '2025-01-02 03:38:26', 8400, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(63, 266, '2025-03-06 03:38:48', 8403, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(64, 261, '2025-04-23 03:39:39', 8393, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(65, 259, '2025-04-23 03:39:39', 8393, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(66, 257, '2025-04-23 03:39:39', 8393, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(67, 260, '2025-03-21 03:44:12', 8423, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(68, 268, '2025-05-02 03:44:32', 8421, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(69, 269, '2025-01-06 03:44:35', 8422, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(70, 267, '2025-01-06 03:44:35', 8422, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(71, 270, '2025-01-07 03:46:41', 8422, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(72, 263, '2025-02-10 03:48:15', 8424, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(73, 262, '2025-02-10 03:48:15', 8424, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(74, 228, NULL, NULL, '2025-07-12 03:50:35', 'សុខ វិទូ - Sok Vitou', 1, 8408, NULL),
(75, 273, '2025-04-04 03:57:51', 8421, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(76, 272, '2025-04-04 03:57:51', 8421, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(77, 271, '2025-04-04 03:57:51', 8421, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(78, 228, '2025-04-04 03:57:51', 8421, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(79, 280, '2025-05-07 04:28:45', 8425, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(80, 285, '2025-03-25 04:29:00', 8426, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(81, 284, '2025-03-25 04:29:00', 8426, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(82, 283, '2025-03-25 04:29:00', 8426, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(83, 282, '2025-03-25 04:29:00', 8426, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(84, 281, '2025-03-25 04:29:00', 8426, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(85, 298, '2025-05-17 04:34:29', 8427, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(86, 297, '2025-03-01 04:34:59', 8428, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(87, 322, '2024-12-20 04:57:01', 8429, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(88, 319, '2024-12-20 04:57:01', 8429, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(89, 317, '2024-12-20 04:57:01', 8429, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(90, 315, '2024-12-20 04:57:01', 8429, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(91, 314, '2024-12-20 04:57:01', 8429, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(92, 312, '2024-12-20 04:57:01', 8429, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(93, 310, '2024-12-20 04:57:01', 8429, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(94, 301, '2024-12-20 04:57:01', 8429, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(95, 299, '2024-12-20 04:57:01', 8429, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(96, 327, '2025-03-06 05:00:06', 8430, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(97, 326, '2025-03-06 05:00:06', 8430, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(98, 325, '2025-03-06 05:00:06', 8430, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(99, 323, '2025-03-06 05:00:06', 8430, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(100, 320, '2025-03-06 05:00:06', 8430, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(101, 330, '2025-10-31 05:01:45', 206, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(102, 337, '2024-11-06 06:27:40', 8431, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(103, 336, '2024-11-06 06:27:40', 8431, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(104, 335, '2024-11-06 06:27:40', 8431, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(105, 334, '2024-11-06 06:27:40', 8431, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(106, 333, '2024-11-06 06:27:40', 8431, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(107, 342, '2024-12-23 06:36:03', 8432, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(108, 341, '2024-12-23 06:36:03', 8432, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(109, 340, '2024-12-23 06:36:03', 8432, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(110, 339, '2024-12-23 06:36:03', 8432, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(111, 338, '2024-12-23 06:36:03', 8432, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(112, 346, '2024-12-23 06:42:14', 8433, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(113, 345, '2024-12-23 06:42:14', 8433, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(114, 344, '2024-12-23 06:42:14', 8433, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(115, 343, '2024-12-23 06:42:14', 8433, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(116, 347, '2024-12-20 06:45:48', 8434, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(117, 349, '2024-12-18 07:28:59', 8435, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(118, 348, '2024-12-18 07:28:59', 8435, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(119, 350, '2025-01-30 07:34:37', 211, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(120, 362, '2025-02-15 07:56:15', 8438, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(121, 361, '2025-02-15 07:56:15', 8438, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(122, 360, '2025-02-15 07:56:15', 8438, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(123, 358, '2025-02-15 07:56:15', 8438, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(124, 357, '2025-02-15 07:56:15', 8438, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(125, 367, '2025-02-13 08:03:00', 8439, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(126, 366, '2025-02-13 08:03:00', 8439, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(127, 365, '2025-02-13 08:03:00', 8439, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(128, 364, '2025-02-13 08:03:00', 8439, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(129, 363, '2025-02-13 08:03:00', 8439, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(130, 369, '2025-02-26 08:05:53', 8427, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(131, 368, '2025-02-26 08:05:53', 8427, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(132, 370, '2025-03-20 08:11:52', 8440, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(133, 371, '2025-03-21 08:15:37', 8441, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(134, 372, '2025-05-01 08:21:00', 8429, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(135, 373, '2025-05-01 08:25:00', 8442, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(136, 378, '2025-06-25 08:43:22', 8443, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(137, 377, '2025-06-25 08:43:22', 8443, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(138, 376, '2025-06-25 08:43:22', 8443, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(139, 375, '2025-06-25 08:43:22', 8443, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(140, 374, '2025-06-25 08:43:22', 8443, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(141, 382, '2025-06-30 08:49:29', 8444, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(142, 381, '2025-06-30 08:49:29', 8444, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(143, 380, '2025-06-30 08:49:29', 8444, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(144, 379, '2025-06-30 08:49:29', 8444, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(145, 387, '2025-06-30 08:54:40', 8397, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(146, 386, '2025-06-30 08:54:40', 8397, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(147, 385, '2025-06-30 08:54:40', 8397, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(148, 384, '2025-06-30 08:54:40', 8397, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(149, 383, '2025-06-30 08:54:40', 8397, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(150, 388, '2025-05-05 09:10:36', 8445, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(151, 359, '2025-05-01 09:11:45', 8392, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(152, 355, '2025-05-01 09:11:45', 8392, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(153, 187, '2025-05-01 09:11:45', 8392, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(154, 122, '2025-05-01 09:11:45', 8392, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(155, 356, '2025-04-01 09:16:28', 8447, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(156, 392, '2025-01-17 09:18:00', 210, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(157, 391, '2025-01-17 09:18:00', 210, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(158, 390, '2025-01-17 09:18:00', 210, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(159, 389, '2025-01-17 09:18:00', 210, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(160, 393, '2025-02-20 09:24:07', 8448, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(161, 321, '2025-01-01 09:27:21', 8387, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(162, 318, '2025-01-01 09:27:21', 8387, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(163, 396, '2025-02-20 09:28:45', 8394, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(164, 395, '2025-02-20 09:28:45', 8394, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(165, 394, '2025-02-20 09:28:45', 8394, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(166, 316, '2025-01-03 09:30:05', 8447, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(167, 313, '2025-01-03 09:30:05', 8447, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(168, 311, '2025-01-03 09:30:05', 8447, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(169, 309, '2025-01-03 09:30:05', 8447, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(170, 397, '2025-04-01 09:30:57', 210, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(171, 308, '2024-12-19 09:31:45', 8447, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(172, 302, '2025-01-16 09:34:02', 8449, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(173, 293, '2025-01-16 09:34:02', 8449, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(174, 292, '2025-01-16 09:34:02', 8449, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(175, 291, '2025-01-16 09:34:02', 8449, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(176, 307, '2024-12-05 09:36:27', 8450, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(177, 306, '2024-12-05 09:36:27', 8450, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(178, 300, '2025-05-30 09:36:55', 8389, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(179, 290, '2025-05-30 09:36:55', 8389, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(180, 288, '2025-05-30 09:36:55', 8389, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(181, 287, '2025-05-30 09:36:55', 8389, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(182, 286, '2025-05-30 09:36:55', 8389, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(183, 400, '2025-04-04 09:40:56', 8451, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(184, 399, '2025-04-04 09:40:56', 8451, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(185, 398, '2025-04-04 09:40:56', 8451, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(186, 294, '2025-05-31 09:47:15', 8452, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(187, 289, '2025-05-31 09:47:15', 8452, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(188, 276, '2025-05-31 09:47:15', 8452, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(189, 275, '2025-05-31 09:47:15', 8452, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(190, 305, '2025-01-01 09:47:59', 8454, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(191, 404, '2025-04-05 09:48:51', 8453, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(192, 403, '2025-04-05 09:48:51', 8453, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(193, 402, '2025-04-05 09:48:51', 8453, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(194, 401, '2025-04-05 09:48:51', 8453, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(195, 277, '2025-05-31 09:51:07', 8452, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(196, 304, '2024-10-29 09:52:32', 8455, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(197, 328, '2025-01-01 09:54:12', 8455, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(198, 324, '2025-01-01 09:54:12', 8455, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(199, 274, '2025-07-08 09:54:28', 8458, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(200, 303, '2024-10-29 10:00:13', 8387, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(201, 354, '2025-03-21 10:06:12', 8455, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(202, 353, '2025-03-21 10:06:12', 8455, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(203, 352, '2025-03-21 10:06:12', 8455, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(204, 351, '2025-03-21 10:06:12', 8455, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(205, 278, '2025-03-21 10:06:12', 8455, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(206, 332, '2025-03-18 10:07:30', 8460, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(207, 331, '2025-03-18 10:07:30', 8460, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(208, 329, '2025-02-22 10:10:43', 8461, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(209, 316, '2025-01-03 02:05:08', 8447, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(210, 313, '2025-01-03 02:05:08', 8447, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(211, 406, '2025-02-24 02:07:19', 8462, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(212, 405, '2025-02-24 02:07:19', 8462, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(213, 408, '2025-07-05 02:14:24', 202, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(214, 419, '2025-02-06 02:32:21', 8464, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(215, 418, '2025-02-06 02:32:21', 8464, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(216, 416, '2025-02-06 02:32:21', 8464, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(217, 414, '2025-02-06 02:32:21', 8464, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(218, 412, '2025-02-06 02:32:21', 8464, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(219, 421, '2024-12-23 02:35:39', 8466, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(220, 420, '2024-12-23 02:35:39', 8466, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(221, 417, '2024-12-23 02:35:39', 8466, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(222, 415, '2024-12-23 02:35:39', 8466, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(223, 413, '2025-05-13 02:37:26', 202, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(224, 410, '2025-05-18 02:38:24', 202, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(225, 411, '2025-05-10 02:39:56', 8416, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(226, 430, '2025-02-13 02:40:19', 184, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(227, 428, '2025-02-13 02:40:19', 184, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(228, 427, '2025-02-13 02:40:19', 184, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(229, 426, '2025-02-13 02:40:19', 184, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(230, 146, '2025-02-13 02:40:19', 184, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(231, 426, '2025-02-25 02:41:33', 8465, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(232, 425, '2025-02-25 02:41:33', 8465, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(233, 424, '2025-02-25 02:41:33', 8465, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(234, 423, '2025-02-25 02:41:33', 8465, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(235, 422, '2025-02-25 02:41:33', 8465, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(236, 431, '2025-02-13 02:43:34', 200, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(237, 433, '2025-03-18 02:44:58', 202, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(238, 409, '2025-03-18 02:46:33', 202, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(239, 407, '2025-03-18 02:47:52', 202, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(240, 436, '2025-03-18 02:48:24', 200, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(241, 439, '2025-03-03 02:51:59', 199, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(242, 438, '2025-02-25 02:53:00', 8468, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(243, 437, '2025-02-25 02:53:00', 8468, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(244, 435, '2025-02-25 02:53:00', 8468, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(245, 434, '2025-02-25 02:53:00', 8468, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(246, 432, '2025-02-25 02:53:00', 8468, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(247, 440, '2025-03-25 02:58:13', 198, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(248, 154, '2025-03-31 03:03:50', 205, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(249, 448, '2025-02-06 03:06:32', 202, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(250, 444, '2025-02-06 03:06:32', 202, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(251, 447, '2025-07-09 03:08:08', 8469, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(252, 446, '2025-07-09 03:08:08', 8469, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(253, 445, '2025-07-09 03:08:08', 8469, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(254, 443, '2025-07-09 03:08:08', 8469, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(255, 442, '2025-07-09 03:08:08', 8469, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(256, 450, '2025-01-17 03:08:30', 202, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(257, 441, '2025-07-05 03:10:22', 8382, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(258, 452, '2025-06-23 03:11:33', 199, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(259, 451, '2025-06-23 03:11:33', 199, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(260, 449, '2025-06-23 03:11:33', 199, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(261, 459, '2025-07-11 03:16:23', 8471, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(262, 457, '2025-07-11 03:16:23', 8471, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(263, 455, '2025-07-11 03:16:23', 8471, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(264, 466, '2024-12-18 03:22:28', 197, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(265, 469, '2025-02-01 03:26:43', 200, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(266, 468, '2025-02-01 03:26:43', 200, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(267, 467, '2025-02-01 03:26:43', 200, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(268, 249, '2025-07-15 04:30:44', 197, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(269, 482, '2025-07-14 04:47:01', 8472, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(270, 481, '2025-07-14 04:47:01', 8472, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(271, 480, '2025-07-14 04:47:01', 8472, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(272, 479, '2025-07-14 04:47:01', 8472, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(273, 478, '2025-07-14 04:47:01', 8472, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(274, 477, '2025-07-14 04:47:01', 8472, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(275, 486, '2025-07-03 08:11:03', 8423, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(276, 485, '2025-07-03 08:11:03', 8423, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(277, 488, '2025-07-10 08:17:31', 8473, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(278, 487, '2025-07-10 08:17:31', 8473, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(279, 494, '2025-07-01 09:14:33', 8474, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(280, 493, '2025-07-01 09:14:33', 8474, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(281, 492, '2025-07-01 09:14:33', 8474, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(282, 491, '2025-07-01 09:14:33', 8474, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(283, 490, '2025-07-01 09:14:33', 8474, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(284, 498, '2025-07-09 02:53:36', 8475, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(285, 497, '2025-07-09 02:53:36', 8475, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(286, 496, '2025-07-09 02:53:36', 8475, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(287, 495, '2025-07-09 02:53:36', 8475, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(288, 500, '2025-07-09 03:38:10', 8461, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(289, 499, '2025-07-09 03:38:10', 8461, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(290, 489, '2025-07-10 03:40:16', 8410, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(291, 476, '2025-07-16 07:22:20', 8477, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(292, 475, '2025-07-16 07:22:20', 8477, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(293, 474, '2025-07-16 07:22:20', 8477, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(294, 473, '2025-07-16 07:22:20', 8477, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(295, 464, '2025-07-16 07:22:20', 8477, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(296, 504, '2025-07-16 07:23:32', 8476, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(297, 503, '2025-07-16 07:23:32', 8476, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(298, 502, '2025-07-16 07:23:32', 8476, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(299, 501, '2025-07-16 07:23:32', 8476, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(300, 151, NULL, NULL, '2025-07-17 09:20:30', 'សុខ វិទូ - Sok Vitou', 1, 202, NULL),
(301, 151, '2025-07-17 03:04:04', 8478, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(302, 510, '2025-07-21 17:00:00', 8481, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(303, 212, NULL, NULL, '2025-07-28 04:12:11', 'សុខ វិទូ - Sok Vitou', 1, 8404, NULL),
(304, 213, NULL, NULL, '2025-07-28 04:12:11', 'សុខ វិទូ - Sok Vitou', 1, 8404, NULL),
(305, 214, NULL, NULL, '2025-07-28 04:12:11', 'សុខ វិទូ - Sok Vitou', 1, 8404, NULL),
(306, 215, NULL, NULL, '2025-07-28 04:12:11', 'សុខ វិទូ - Sok Vitou', 1, 8404, NULL),
(307, 216, NULL, NULL, '2025-07-28 04:12:11', 'សុខ វិទូ - Sok Vitou', 1, 8404, NULL),
(308, 513, '2025-07-27 17:00:00', 8481, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(309, 516, '2025-07-27 17:00:00', 8481, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(310, 515, '2025-07-27 17:00:00', 8481, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(311, 514, '2025-07-27 17:00:00', 8481, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(312, 512, '2025-07-28 17:00:00', 8394, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(313, 511, '2025-07-28 17:00:00', 8473, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(314, 522, '2025-07-28 17:00:00', 8483, NULL, NULL, NULL, NULL, 'សុខ វិទូ - Sok Vitou'),
(315, 275, NULL, NULL, '2025-07-29 07:34:37', 'សុខ វិទូ - Sok Vitou', 1, 8452, NULL),
(316, 276, NULL, NULL, '2025-07-29 07:34:37', 'សុខ វិទូ - Sok Vitou', 1, 8452, NULL),
(317, 289, NULL, NULL, '2025-07-29 07:34:37', 'សុខ វិទូ - Sok Vitou', 1, 8452, NULL),
(318, 294, NULL, NULL, '2025-07-29 07:34:37', 'សុខ វិទូ - Sok Vitou', 1, 8452, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pr_table`
--

CREATE TABLE `pr_table` (
  `id` int(11) NOT NULL,
  `requester` varchar(255) DEFAULT NULL,
  `pro_name` varchar(255) DEFAULT NULL,
  `pro_name_kh` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `price_unit` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `pr_date` timestamp NULL DEFAULT current_timestamp(),
  `delete_status` varchar(12) DEFAULT '1' COMMENT '1 for not delete and 0 for deleted',
  `add_by` varchar(255) DEFAULT NULL,
  `purchase_status` varchar(12) NOT NULL DEFAULT '0' COMMENT '0 for purchasing and 1 for done purchase',
  `att` varchar(255) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `delete_date` timestamp NULL DEFAULT NULL,
  `delete_by` varchar(255) DEFAULT NULL,
  `receive_by` varchar(255) DEFAULT NULL,
  `receive_date` timestamp NULL DEFAULT NULL,
  `add_stock_status` varchar(12) DEFAULT '0' COMMENT '0 for not add to stock and 1 for has added to stock'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_outlists`
--

CREATE TABLE `return_outlists` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(255) DEFAULT NULL,
  `returned_date` timestamp NULL DEFAULT current_timestamp(),
  `item_status` text DEFAULT NULL,
  `proname` varchar(255) DEFAULT NULL,
  `pro_code` varchar(255) DEFAULT NULL,
  `cat_id` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `fix_asset_code` varchar(255) DEFAULT NULL,
  `equipment_type` varchar(255) DEFAULT NULL COMMENT '	1:equipment, 2:accessories',
  `attachment` varchar(255) DEFAULT NULL,
  `recieve_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `return_outlists`
--

INSERT INTO `return_outlists` (`id`, `staff_id`, `returned_date`, `item_status`, `proname`, `pro_code`, `cat_id`, `model`, `serial_number`, `fix_asset_code`, `equipment_type`, `attachment`, `recieve_by`) VALUES
(1, '8394', '2025-07-29 04:48:30', NULL, 'Printer', NULL, '19', 'HP Laser Jet pro MFP M125a', 'CNB6J3T6TL', 'F-OE-00276', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `section_kh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `section_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `department_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `create_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` varchar(255) DEFAULT NULL,
  `delete_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `section_kh`, `section_en`, `department_id`, `create_by`, `create_date`, `delete_status`, `delete_by`, `delete_date`) VALUES
(7, 'រដ្ឋបាលព័ត៌មានវិទ្យា', 'IT Administration', '2', 'Voeurn Sokheng', '2025-03-20', 1, '', '0000-00-00'),
(8, 'ជួសជុល និងថែទាំ', 'Help desk', '2', 'Voeurn Sokheng', '2025-03-20', 1, '', '0000-00-00'),
(9, 'ថែទាំម៉ាស៊ីនព្រីន និងតាមដានប្រព័ន្ធGPS', 'Maintenance Printer& GPS tracking', '2', 'Ra Mey', '2025-03-21', 1, '', '0000-00-00'),
(10, 'រចនា និងតាមដានប្រព័ន្ធGPS', 'Graphic Design & GPS tracking', '2', 'Ra Mey', '2025-03-21', 1, '', '0000-00-00'),
(11, 'អភិវឌ្ឍគេហទំព័រ', 'PHP Developer', '2', 'Ra Mey', '2025-03-21', 1, '', '0000-00-00'),
(12, 'នាយកគ្រប់គ្រងព័ត៌មានវិទ្យា', 'IT Director', '2', 'Voeurn Sokheng', '2025-03-25', 1, '', '0000-00-00'),
(13, 'Sale', 'Sale', '4', 'Sok Vitou', '2025-03-26', 1, '', '0000-00-00'),
(14, 'ផលិតកម្ម', 'Production', '3', 'Sok Vitou', '2025-03-27', 1, '', '0000-00-00'),
(15, 'ទីផ្សារ', 'Marketing', '6', 'Sok Vitou', '2025-03-31', 1, '', '0000-00-00'),
(16, 'WH& Logistic', 'WH& Logistic', '5', 'Sok Vitou', '2025-04-01', 1, '', '0000-00-00'),
(17, 'ជី ភី អេស', 'GPS', '2', 'Sok Vitou', '2025-04-02', 1, '', '0000-00-00'),
(18, 'គណនេយ្យ', 'Accounting', '7', 'Sok Vitou', '2025-04-02', 1, '', '0000-00-00'),
(19, 'លក់ទឹកកេស', 'Sale(bottle)', '4', 'Sok Vitou', '2025-04-05', 1, '', '0000-00-00'),
(20, 'ធនធានមនុស្ស', 'HR', '8', 'Sok Vitou', '2025-04-05', 1, '', '0000-00-00'),
(21, 'ធនធានមនុស្ស', 'HR', '8', 'Sok Vitou', '2025-04-05', 1, '', '0000-00-00'),
(22, 'Production', 'Production', '3', 'Sok Vitou', '2025-05-01', 1, NULL, NULL),
(23, 'Accounting', 'Accounting', '7', 'Sok Vitou', '2025-05-01', 1, NULL, NULL),
(24, 'AR', 'AR', '7', 'Sok Vitou', '2025-05-01', 1, NULL, NULL),
(25, 'HR', 'HR', '8', 'Sok Vitou', '2025-05-01', 1, NULL, NULL),
(26, 'Accounting', 'Accounting', '7', 'Sok Vitou', '2025-05-01', 1, NULL, NULL),
(27, 'ដឹកជញ្ជូន', 'delivery', '5', 'Sok Vitou', '2025-05-01', 1, NULL, NULL),
(28, 'លក់', 'Sale', '4', 'Sok Vitou', '2025-05-22', 1, NULL, NULL),
(29, 'ឃ្លាំងគ្រឿងបន្លាស់', 'Warehouse', '5', 'Sok Vitou', '2025-06-26', 1, NULL, NULL),
(30, 'ទីផ្សារ', 'Marketing', '6', 'Sok Vitou', '2025-06-26', 1, NULL, NULL),
(31, 'ទីផ្សារ', 'Marketing', '6', 'Sok Vitou', '2025-06-26', 1, NULL, NULL),
(32, 'Call Center', 'Call Center', '4', 'Sok Vitou', '2025-07-11', 1, NULL, NULL),
(33, 'DMS', 'DMS', '4', 'Sok Vitou', '2025-07-11', 1, NULL, NULL),
(34, 'Sale Horica', 'Sale Horica', '4', 'Sok Vitou', '2025-07-11', 1, NULL, NULL),
(35, 'Horica Supervisor', 'Horica Supervisor', '4', 'Sok Vitou', '2025-07-11', 1, NULL, NULL),
(36, 'Sale Director', 'Sale Director', '4', 'Sok Vitou', '2025-07-11', 1, NULL, NULL),
(37, 'Sale (Gallon)', 'Sale (Gallon)', '9', 'Sok Vitou', '2025-07-12', 1, NULL, NULL),
(38, 'ឃ្លាំងគ្រឿងបន្លាស់(រោងជាង)', 'ឃ្លាំងគ្រឿងបន្លាស់(រោងជាង)', '5', 'Sok Vitou', '2025-07-12', 1, NULL, NULL),
(39, 'Marketing', 'Marketing', '6', 'Sok Vitou', '2025-07-12', 1, NULL, NULL),
(40, 'ស្មៀន', 'Clerk', '2', 'Sok Vitou', '2025-07-14', 1, NULL, NULL),
(41, 'ផ្លុំដបនិងគំរប', 'ផ្លុំដបនិងគំរប', '3', 'Sok Vitou', '2025-07-22', 1, NULL, NULL),
(42, 'ទឹកធុង', 'Gallone', '3', 'Sok Vitou', '2025-07-29', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_fees`
--

CREATE TABLE `service_fees` (
  `id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `add_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_users`
--

CREATE TABLE `staff_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `card_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gender` char(255) DEFAULT NULL,
  `position` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `id_card` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phone_number` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email_address` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_users`
--

INSERT INTO `staff_users` (`id`, `card_id`, `gender`, `position`, `id_card`, `phone_number`, `email_address`) VALUES
(35, '7832', 'Male', '7', '', '093286724', 'rin.putchandarit@hitech.com.kh'),
(36, '7263', 'Female', '6', '', '0313563168', 'sokvitou74@gmail.com'),
(37, '7975', 'Male', '7', '', '02356895', 'ramey@gmail.com'),
(38, '1012', 'Male', '9', '', '01245789', 'vathvuthy.admin@gmail.com'),
(39, '7848', 'Male', '11', '', '093854961', ''),
(40, '6996', 'Male', '12', '', '010343342', ''),
(41, '7555', 'Female', '13', '', '0962946369', ''),
(42, '8253', 'Male', '14', '', '081790080', ''),
(43, '6849', 'Male', '15', '', '0964252362', ''),
(44, '5307', 'Female', '16', '', '015212227', ''),
(45, '7448', 'Female', '17', '', '069556615', ''),
(46, '6832', 'Female', '17', '', '016624054', ''),
(47, '6842', 'Female', '17', '', '0962155433', ''),
(48, '8299', 'Female', '18', '', '093794347', ''),
(49, '6880', 'Female', '16', '', '0964707992', '');

-- --------------------------------------------------------

--
-- Table structure for table `sub_function`
--

CREATE TABLE `sub_function` (
  `id` int(11) NOT NULL,
  `main_function_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `name_kh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `route_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `url_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_function`
--

INSERT INTO `sub_function` (`id`, `main_function_id`, `name`, `name_kh`, `route_name`, `url_name`) VALUES
(1, 2, 'Item Category', 'ប្រភេទសម្ភារៈ', 'category.list', 'category/list'),
(2, 2, 'Departments', 'នាយកដ្ឋាន', 'department.list', 'department/list'),
(3, 2, 'Sections', 'ផ្នែក', 'section.list', 'section/list'),
(4, 2, 'Positions', 'មុខតំណែង/តួនាទី', 'position.list', 'position/list'),
(5, 2, 'Staff Lists', 'បញ្ជីបុគ្គលិក', 'staff.index', 'staff'),
(6, 3, 'Item Stock-In', 'សម្ភារៈក្នុងស្តុក', 'product.instock', 'product/instock'),
(7, 3, 'Item Stock-Out', 'សម្ភារៈក្រៅស្តុក', 'product.outstock', 'product/outstock'),
(8, 3, 'Item Statistic', 'ស្ថិតិសម្ភារៈ', 'product.statistic', 'product/statistic'),
(9, 4, 'Add Given Item', 'បន្ថែមការផ្តល់ជូនសម្ភារៈ', 'product.addGive', 'product/add-give'),
(10, 4, 'Given List', 'បញ្ជីបានផ្តល់ជូន', 'product.givenList', 'product/given'),
(11, 4, 'Returned List', 'បញ្ជីបានប្រគល់ត្រឡប់', 'product.returned', 'product/returned'),
(12, 4, 'Returned (Old item)', 'ប្រគល់ត្រឡប់ (សម្ភារៈចាស់)', 'returnOutList.index', 'returned/item/out-list'),
(13, 5, 'ITE Purchase', 'ចំណាយទិញសម្ភារៈ', 'expense.purchase.index', 'expense/purchase'),
(14, 5, 'Service Fee', 'ចំណាយថ្លៃសេវាកម្ម', 'expense.service.index', 'expense/service/fee'),
(15, 2, 'Item Code', 'លេខកូដសម្ភារៈ', 'item_code.index', 'item/code'),
(16, 3, 'Trashbin', 'ធុងសម្រាម', 'product.trashbin', 'product/item/trash'),
(99, 7, 'Admin', '', 'user/1/Admin', 'user/{role}/{name}'),
(100, 7, 'I', NULL, 'user/69/I', 'user/{role}/{name}'),
(101, 7, 'IT-Administrator', NULL, 'user/70/IT-Administrator', 'user/{role}/{name}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `card_id` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `name_kh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `role_id` varchar(255) DEFAULT NULL,
  `block_status` int(11) NOT NULL DEFAULT 1,
  `block_date` date DEFAULT NULL,
  `block_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `create_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile`, `card_id`, `name_kh`, `name_en`, `gender`, `position`, `phone_number`, `email_address`, `email`, `email_verified_at`, `password`, `role_id`, `block_status`, `block_date`, `block_by`, `remember_token`, `created_at`, `create_by`, `updated_at`) VALUES
(184, 'uploads/users/wldox3KgUrQ6pYd5PXVPRfxRdRk9iBsrr9NUQSgT.jpg', '8381', 'វឿន សុខហេង', 'Voeurn Sokheng', NULL, NULL, NULL, NULL, 'sokheng3301', '0000-00-00 00:00:00', '$2y$12$WQAAUu4K/ZXOvB3N0xxzwelYONIfwEO1lsyH8hUD/pHYTU3NNIfOW', '1', 1, '2025-02-26', 'Voeurn Sokheng', '', '2025-02-14 18:55:17', 'Voeurn Sokheng', '0000-00-00 00:00:00'),
(197, 'uploads/users/Ja4jBdBvFKOkrjxAyswbY3JHeSEsklzKorBee5kD.jpg', '7832', 'រិន ពុទ្ធច័ន្ទដារិទ្ធ', 'Rin Putchandarit', 'Male', '7', '093286724', 'rin.putchandarit@hitech.com.kh', 'darit1234', '0000-00-00 00:00:00', '$2y$12$xmIKlcpJ/92o6EB2i0OGM.2BzCKjgGsgd2RNjljupYCQhoBpt5Br.', 'staff', 1, '0000-00-00', '', '', '2025-03-20 10:02:19', 'Voeurn Sokheng', '0000-00-00 00:00:00'),
(198, '', '7263', 'សុខ វិទូ', 'Sok Vitou', 'Female', '6', '0313563168', NULL, 'vitou1235', '0000-00-00 00:00:00', '$2y$12$n.LSaNCBiQtgm4zjzjY8juzFzJGaAvs2vou1pGufie7K9ed2xg70.', '70', 1, '0000-00-00', '', '', '2025-03-20 10:04:48', 'Voeurn Sokheng', '0000-00-00 00:00:00'),
(199, 'uploads/users/nqEJwLFjWho0KRFpvSn2FWCJV5W7hR7UCKohcc0p.jpg', '7975', 'រ៉ា ម៉ី', 'Ra Mey', 'Male', '7', '02356895', 'ramey@gmail.com', 'mey1236', '0000-00-00 00:00:00', '$2y$12$eJS1nX0OwzpHHsRvVBt0S.OWLWWYjY1EhLwe2Prcgt1/UPPrU86rC', 'staff', 1, '0000-00-00', '', '', '2025-03-20 10:05:59', 'Voeurn Sokheng', '0000-00-00 00:00:00'),
(200, NULL, '7617', 'វ៉ាត់ វុទ្ធី', 'Vath Vuthy', 'Male', '9', '01245789', 'vathvuthy.admin@gmail.com', 'vuthy1012', '0000-00-00 00:00:00', '$2y$12$u64b.lqXJsnl.tUcpxLsmOXRXsLHiEYvFQMchgCdl3GQwAck9VeRC', '2', 1, '0000-00-00', '', '', '2025-03-25 04:53:08', 'Voeurn Sokheng', '0000-00-00 00:00:00'),
(201, '', '7848', 'ឯក សេងឡុង', 'Ek Seng Long', 'Male', '11', '093854961\r\n', NULL, '', '0000-00-00 00:00:00', '$2y$12$VQhBrhIVeYH0EFDl/n67duOimlx4bfzfcBv0MILbZplflF1R9E4jW', 'staff', 1, '0000-00-00', '', '', '2025-03-26 01:43:16', 'Sok Vitou', '0000-00-00 00:00:00'),
(202, NULL, '6996', 'ហាក់ ប៊ុនថុង', 'Hak Bunthong', 'Male', '12', '010343342\r\n', NULL, NULL, NULL, '$2y$12$rDB3LgkHt1XM1EpOEvFRcOtLjgkJnZUMZ.4ZTxJFDf.eCQUiWgXza', 'staff', 1, NULL, NULL, NULL, '2025-03-27 02:40:00', 'Sok Vitou', NULL),
(203, NULL, '7555', 'អ៊ិន ស្រីពេជ្រ', 'Ourn Sreypich', 'Female', '13', '0962946369\r\n', NULL, NULL, NULL, '$2y$12$VLJK9qyfD8TaKVXgHlTFqeZLW08kJ06xR7CU3F9Fxymbw1m4VGT72', 'staff', 1, NULL, NULL, NULL, '2025-03-31 05:07:21', 'Sok Vitou', '0000-00-00 00:00:00'),
(204, NULL, '8253', 'ហាក់​ សុខា', 'Hak Sokha', 'Male', '14', '081790080', NULL, NULL, NULL, '$2y$12$EG3h8hH4gosiXHH5UI6kQOvh5GxLXd04oQOFPYSZ.wqBr45qG7O46', 'staff', 1, NULL, NULL, NULL, '2025-04-01 04:52:39', 'Sok Vitou', '0000-00-00 00:00:00'),
(205, NULL, '6849', 'ម៉ី ម៉ានិត', 'Mey Manit', 'Male', '15', '0964252362', NULL, NULL, NULL, '$2y$12$Nb9JME2iCdta1qntnXEZdOtpU1EOYmVTPIp5W8qmKsIphUJldNJZu', 'staff', 1, NULL, NULL, NULL, '2025-04-02 08:02:05', 'Sok Vitou', '0000-00-00 00:00:00'),
(206, NULL, '5307', 'រី រដ្ឋរស្មី', 'Ri Rath Raksmey', 'Female', '16', '015212227', NULL, NULL, NULL, '$2y$12$EezNxfGKW4NsH2J8qaexBO.crPcEQFnEW4DafemoM/z1paU8RCTF6', 'staff', 1, NULL, NULL, NULL, '2025-04-02 08:08:37', 'Sok Vitou', '0000-00-00 00:00:00'),
(207, NULL, '7448', 'សែម កែវស្រីពៅ', 'Sem Keosreypov', 'Female', '17', '069556615', NULL, NULL, NULL, '$2y$12$LIo7GJ/P7mK8cV8AfLnTuulxRIP/Aaw37HvVgaTQBLzS0499wVHjO', 'staff', 1, NULL, NULL, NULL, '2025-04-05 08:58:53', 'Sok Vitou', '0000-00-00 00:00:00'),
(208, NULL, '6832', 'ប៊ុនធឿន ចាន់តី', 'Bunthoeun Chanthei', 'Female', '17', '016624054', NULL, NULL, NULL, '$2y$12$WmDA14vmCdW/OLE9CPeIKuuE9.OPf0VY/JpKlgttzkx7TusuzTWkW', 'staff', 1, NULL, NULL, NULL, '2025-04-05 09:00:22', 'Sok Vitou', '0000-00-00 00:00:00'),
(209, NULL, '6842', 'ថា​ ណាល័យ', 'Tha Nalay', 'Female', '17', '0962155433', NULL, NULL, NULL, '$2y$12$bq0orbit38SThPIvdPLoLeu97umW0NYn./E0cGT9LNa3tIXoKWMki', 'staff', 1, NULL, NULL, NULL, '2025-04-05 09:01:44', 'Sok Vitou', '0000-00-00 00:00:00'),
(210, NULL, '8299', 'ចាន់​ គឹមលាង', 'Chan Kimleang', 'Female', '18', '093794347\r\n', NULL, NULL, NULL, '$2y$12$55H1gtqGzFpVzhASaslCPerOAJYjTOsumH8cxeBhrksgQnKSK1Mti', 'staff', 1, NULL, NULL, NULL, '2025-04-05 09:31:11', 'Sok Vitou', '0000-00-00 00:00:00'),
(211, NULL, '6880', 'ឃួន អ៊ីណា', 'Khoun Aina', 'Female', '16', '0964707992', NULL, NULL, NULL, '$2y$12$MAb9geUYRBqV.WcPSRYLwe9mvzIQ3c1VeZXLDIHw.2twz6/YDsNVi', 'staff', 1, NULL, NULL, NULL, '2025-04-05 09:38:30', 'Sok Vitou', '0000-00-00 00:00:00'),
(8382, '', '8656', 'Reth Soreya', 'Reth Soreya', 'Male', '20', '016329479', NULL, NULL, NULL, '$2y$12$18k.qmsQrGPXzB//rlcATODAaBxLzaH5jCw7maivVpOPPRO5cvUMe', 'staff', 1, NULL, NULL, NULL, '2025-05-01 06:26:28', 'Sok Vitou', NULL),
(8383, '', NULL, 'Lach Sreypich', 'Lach Sreypich', 'Female', '21', '087494200', NULL, NULL, NULL, '$2y$12$xMeLO2Cei.z/K59LFimlhOBbXmZxNC3YD1k1GI8e/WodbiS5D7jXm', 'staff', 1, NULL, NULL, NULL, '2025-05-01 06:46:30', 'Sok Vitou', NULL),
(8384, '', '8155', 'ហួត ហនុវឌ្ឍន៍', 'Huot Hanuwat', 'Male', '22', '016394466', NULL, NULL, NULL, '$2y$12$CFkgr2Dkw.UeWMFzTWhRGuWQsy0c5jdy2bnMNIQvwA3DcN.ltMRvS', 'staff', 1, NULL, NULL, NULL, '2025-05-01 07:01:22', 'Sok Vitou', NULL),
(8385, '', '8088', 'សែម​ ម៉ាលិកា', 'Sam Malika', 'Female', '23', '086314494', NULL, NULL, NULL, '$2y$12$3lPICof8DWEJuyyh9Xnx/Ox3rtsQXfFlFvg8wEdWgsrH4F9UE5qZq', 'staff', 1, NULL, NULL, NULL, '2025-05-01 07:53:32', 'Sok Vitou', NULL),
(8386, '', NULL, 'បេន ថៃរីយ៉ា', 'Ben thairiya', 'Female', '24', '0963554236', NULL, NULL, NULL, '$2y$12$46gr/b3gJmYPpfMreFZRzu0mdQwBehBWbQP4QZcSRbGdnJMC.0SHe', 'staff', 1, NULL, NULL, NULL, '2025-05-01 08:02:52', 'Sok Vitou', NULL),
(8387, '', '4324', 'ឈ្នាងម៉ាឡុង', 'chhneang mea long', 'Male', '25', '011935527', NULL, NULL, NULL, '$2y$12$KfMq0KVtqfhhkMjf31Bkf.HfTwgwMk7.iGq3axf5POBySEXBa0PUG', 'staff', 1, NULL, NULL, NULL, '2025-05-01 08:17:03', 'Sok Vitou', NULL),
(8388, NULL, '6839', 'ម៉ាន់ ភ័ត្រា', 'mann Phtra', 'Male', '26', '098212497', NULL, NULL, NULL, '$2y$12$wiH5nsIDOwC9Fvap/8xiCelwQUQFs543o2Bs/KTgc/atTlaqL1mhK', 'staff', 1, NULL, NULL, NULL, '2025-05-22 03:09:12', 'Sok Vitou', NULL),
(8389, '', '8625', 'សុខ សុវណ្ណពិសិដ្ឌ', 'Sok Sovann Pisith', 'Male', '28', '098874275', NULL, NULL, NULL, '$2y$12$XQwnoNBq6eoB4IxYnaLypOg1Qutv7pKZwDO9DYclkhXNlaJfF2Tg.', 'staff', 1, NULL, NULL, NULL, '2025-05-22 03:38:06', 'Sok Vitou', NULL),
(8390, '', NULL, 'យា វិច្ឆិកា', 'ya   vichchheka', 'Male', '27', '098477200', NULL, NULL, NULL, '$2y$12$YniMR5okgKPvtQnT7Fvc2OPMbHU7uHBlVkQRustdb/OYGQakPrFya', 'staff', 1, NULL, NULL, NULL, '2025-05-22 04:09:59', 'Sok Vitou', NULL),
(8391, '', NULL, 'យា វិច្ឆិកា', 'ya   vichchheka', 'Male', '27', '098477200', NULL, NULL, NULL, '$2y$12$TGQc4Q1fzb/.dYVyIwLbEufF9vrqjgBv3IfPchITzGdMyyLtdVzMe', 'staff', 1, NULL, NULL, NULL, '2025-05-22 04:10:00', 'Sok Vitou', NULL),
(8392, '', '8655', 'ឈិន ឈៀន', 'ឈិន ឈៀន', 'Male', '29', '0887687403', NULL, NULL, NULL, '$2y$12$WsoksXFjillFTzm9pw047OuUg2Pmno/apspxFHId23WxV7wes20fW', 'staff', 1, NULL, NULL, NULL, '2025-06-26 02:40:59', 'Sok Vitou', NULL),
(8393, '', '8676', 'ពេជ្រ ពិសី', 'Pich Pisey', 'Male', '30', '010411242', NULL, NULL, NULL, '$2y$12$hAFjhPUH262kCIzOU2cGfef2GjZpoXkmxr0rOBQH0Wz.gI.8JwtOG', 'staff', 1, NULL, NULL, NULL, '2025-06-26 03:14:32', 'Sok Vitou', NULL),
(8394, '', '3765', 'Hout Sreypin', 'ហួត ស្រីពីន', 'Female', '31', NULL, NULL, NULL, NULL, '$2y$12$0LQtsnkXuMSVjVB7QYh/teN7eR4SFXxoW0ezP.2EgkBuiD.xvAKfm', 'staff', 1, NULL, NULL, NULL, '2025-06-26 03:49:21', 'Sok Vitou', NULL),
(8395, '', NULL, 'ហាក់​ សុខា', 'Hak Sokha', 'Male', '14', '081790080', NULL, NULL, NULL, '$2y$12$GM7ioQbDK89pvljD.Ege..TWNuxqSJ12En8MDbC6Lat.UOnp0rizC', 'staff', 1, NULL, NULL, NULL, '2025-06-26 04:37:26', 'Sok Vitou', NULL),
(8396, '', '8761', 'ឡេង ដុល្លា', 'Leng Dollar', 'Male', '13', '070360797', NULL, NULL, NULL, '$2y$12$r8Bxx9SB5/bwv41VESC5d.hF9vJCibytvDz9v3/AIugwAi/w1WKKS', 'staff', 1, NULL, NULL, NULL, '2025-06-26 06:14:55', 'Sok Vitou', NULL),
(8397, '', '7779', 'ឆាយ ឡាយ', 'Chhay lay', 'Male', '32', '085567765', NULL, NULL, NULL, '$2y$12$mFGNZxhhmbUHSRMyKPlfGuA193wGHSTkRq9K2m5C0uzfNkkilZiqG', 'staff', 1, NULL, NULL, NULL, '2025-06-26 06:54:43', 'Sok Vitou', NULL),
(8398, '', '4997', 'ឆែម តុលា', 'Chem tola', 'Male', '10', '070212465', NULL, NULL, NULL, '$2y$12$qMyQPWOE5Tz3i0jSG85eKOvm2zFeUKzPTZvD7aoPgiHwCH6o301Ie', 'staff', 1, NULL, NULL, NULL, '2025-07-11 03:25:41', 'Sok Vitou', NULL),
(8399, '', '8624', 'ងន់ សុខលាង', 'Ngann Sok Leang', 'Male', '27', '070212382', NULL, NULL, NULL, '$2y$12$lcta7KM1MuPhF337Pngp4.J8kibnEr0qONhYP9s5IvDP/pl9.uznK', 'staff', 1, NULL, NULL, NULL, '2025-07-11 03:33:03', 'Sok Vitou', NULL),
(8400, NULL, '8187', 'អ៊ុក សូរិយា', 'Ouk Sorya', 'Male', '27', NULL, NULL, NULL, NULL, '$2y$12$rxamJDfOJzawB3H9Ay6sY.bJI1gkQfZUxTbh9ZS9VJbHxD5uQjDNW', 'staff', 1, NULL, NULL, NULL, '2025-07-11 03:46:39', 'Sok Vitou', NULL),
(8401, '', '7015', 'ស៊ាត ថេន', 'Seat Then', 'Male', '10', '098682635', NULL, NULL, NULL, '$2y$12$uMYHEbcGlP4PlVZxgvyemeiw6rbCZbaT5SA/p/WJczdqn6mbISCVe', 'staff', 1, NULL, NULL, NULL, '2025-07-11 03:50:24', 'Sok Vitou', NULL),
(8402, '', '7084', 'តេវ ផុងវិសាល', 'Teav Phong Visal', 'Male', '27', '0963327278', NULL, NULL, NULL, '$2y$12$Jf1pFqqobzi0uq6ymenvCubTwIjrJivP0DuAkWIbf5ABkr.5xyvBG', 'staff', 1, NULL, NULL, NULL, '2025-07-11 04:05:11', 'Sok Vitou', NULL),
(8403, '', '7065', 'ឃ្លោង គឹមឈុន', 'Kluang Kimchun', 'Male', '11', '010682636', NULL, NULL, NULL, '$2y$12$QLJqdOmWWT6xz/UndsqSpu7luY9h4EydDlgw5ZwLWiy/xSAXcyD6i', 'staff', 1, NULL, NULL, NULL, '2025-07-11 04:19:17', 'Sok Vitou', NULL),
(8404, '', NULL, 'ម៉េង សុជាតិ', 'Meng Socheat', 'Male', '33', '012790486', NULL, NULL, NULL, '$2y$12$iGcnlrcBCe0EpTOHEeK.beWiuwJYVc21hHCkQ4LHgQL26sAOmvKeS', 'staff', 1, NULL, NULL, NULL, '2025-07-11 04:26:48', 'Sok Vitou', NULL),
(8405, '', NULL, 'ឡេង សុខហេង', 'Leng Sok Heng', 'Male', '26', '010809999', NULL, NULL, NULL, '$2y$12$EBP5XOn6V7WFxBXU/DkTEOWdcvvb6L/PL3KovxtRgysH70F6ZsOkO', 'staff', 1, NULL, NULL, NULL, '2025-07-11 04:51:12', 'Sok Vitou', NULL),
(8406, '', NULL, 'ឡេង សុខហេង', 'Leng Sok Heng', 'Male', '34', '1010809999', NULL, NULL, NULL, '$2y$12$4JpDbd8/kTso2S47xWLuUO66YW4eRnGABwREbX7HAJr/MafFPuETO', 'staff', 1, NULL, NULL, NULL, '2025-07-11 04:58:15', 'Sok Vitou', NULL),
(8407, '', NULL, 'សាត សាភាន', 'Sat Saphan', 'Male', '10', '0968283958', NULL, NULL, NULL, '$2y$12$zMKM/citjwt4/cuYISnlQuuZ7W93BrV64zs8TXNAGherJMVRIptl6', 'staff', 1, NULL, NULL, NULL, '2025-07-11 06:32:10', 'Sok Vitou', NULL),
(8408, '', NULL, 'ប៊ិត សុភ័ក្ត្រ', 'Beat Sopheak', 'Male', '10', '087330200', NULL, NULL, NULL, '$2y$12$K9XAi06RLgnsype7QXv25uhv1fmL7iHZUQuRtmTMp8ZcTTwSHR4le', 'staff', 1, NULL, NULL, NULL, '2025-07-11 06:40:19', 'Sok Vitou', NULL),
(8409, '', '8102', 'តៃ រាជ្ជនា', 'Tai Reachnea', 'Female', '35', '0963317683', NULL, NULL, NULL, '$2y$12$5SSILuEqTrLqXxRHFEbqMuJCqt8nJojghmE4Sik8EVSuJHI1ZsIhC', 'staff', 1, NULL, NULL, NULL, '2025-07-11 06:53:36', 'Sok Vitou', NULL),
(8410, '', '7033', 'ឱប សុជាតា', 'Orb Socheata', 'Female', '36', '016289826', NULL, NULL, NULL, '$2y$12$iUOvV8Z6ov4pgT1PmT/AseDPDZOefdPD5Dg4sBpgPAx4UnpEfntSS', 'staff', 1, NULL, NULL, NULL, '2025-07-11 07:04:12', 'Sok Vitou', NULL),
(8411, '', '8406', 'អុង វិសាល', 'Ong Visal', 'Female', '37', '098932200', NULL, NULL, NULL, '$2y$12$1QQF1UBn6Blvs87t4TnHHet.n8W13qT3B3AQuXxbsf3HcwWmeB5MG', 'staff', 1, NULL, NULL, NULL, '2025-07-11 07:13:59', 'Sok Vitou', NULL),
(8412, '', 'នែល សុខា', 'Nhel Sokha', 'Nhel Sokha', 'Male', '38', '098682641', NULL, NULL, NULL, '$2y$12$TL0CcH5KTgtZZvJBXi.4P.n28tf6zdynNyVMNQ5y4gWa76/JxKVwS', 'staff', 1, NULL, NULL, NULL, '2025-07-11 07:30:54', 'Sok Vitou', NULL),
(8413, '', '4941', 'ព្រាប សាកល', 'Preab Sakal', 'Male', '39', '011345119', NULL, NULL, NULL, '$2y$12$pP3QsVLkiytA26gPri.pBeJ8xG0z1q02oYAXVIxpz5hs1DvGpC3wK', 'staff', 1, NULL, NULL, NULL, '2025-07-11 07:37:25', 'Sok Vitou', NULL),
(8414, '', '7872', 'ថន សុភក្រ', 'Thorn Sopheak', 'Male', '40', '0965157365', NULL, NULL, NULL, '$2y$12$Z97Qt7k5H04RY.S2z58NHeXnPeSzmAuaFjJ2A0eU6VAYJCFvgHYOK', 'staff', 1, NULL, NULL, NULL, '2025-07-12 02:39:32', 'Sok Vitou', NULL),
(8416, '', '7554', 'ពេន អ៊ីឡាន', 'Pen Elan', 'Female', '42', '081472014', NULL, NULL, NULL, '$2y$12$Zw9xkRLqOTXhP2WZ1d.3J.i332b3Q40/EwM/qXenm0Qy61wrW41ri', 'staff', 1, NULL, NULL, NULL, '2025-07-12 03:15:27', 'Sok Vitou', NULL),
(8417, '', NULL, 'Han Doearn', 'Han Doearn', 'Male', '43', '0766089110', NULL, NULL, NULL, '$2y$12$zDcsSyUMF76G.p/MO432q.XHQdQPd1wFrTxbXUxJ3YXoQS2YHf48.', 'staff', 1, NULL, NULL, NULL, '2025-07-12 03:20:12', 'Sok Vitou', NULL),
(8421, '', '8029', 'សាម វណ្ណះ', 'Sam Vannak', 'Male', '44', '0963444230', NULL, NULL, NULL, '$2y$12$GQSI6fcsee1ePm/tldEBD.dFzRD6YYuuJwcxDjC/hJx9g6UDT5R/K', 'staff', 1, NULL, NULL, NULL, '2025-07-12 03:42:03', 'Sok Vitou', NULL),
(8422, '', NULL, 'Cheam Sokpheng', 'Cheam Sokpheng', 'Female', '45', '0966670345', NULL, NULL, NULL, '$2y$12$AiskTwKDVzLa2H0GDCPLO.TZTdwH4YRdkbuMsqlT45rVwSYWWF.Jq', 'staff', 1, NULL, NULL, NULL, '2025-07-12 03:42:11', 'Sok Vitou', NULL),
(8423, '', '4474', 'សុខពេជ្រ', 'Sok Pich', 'Male', '41', NULL, NULL, NULL, NULL, '$2y$12$OXrFHdsP0GcjfOO8adNy9.yjg.6M8UNgH9pZFy4X1T6B2j3RVmhke', 'staff', 1, NULL, NULL, NULL, '2025-07-12 03:42:17', 'Sok Vitou', NULL),
(8424, '', '8162', 'អេងជីម៉េង', 'Eng Chimeng', 'Male', '34', NULL, NULL, NULL, NULL, '$2y$12$ktkFD1TAk09VtIinNmDiEe8S6dB2.oxd2pwsEDf.6xDB81yxi/bZm', 'staff', 1, NULL, NULL, NULL, '2025-07-12 03:46:34', 'Sok Vitou', NULL),
(8425, '', '7902', 'សូវ៉ាត សុខិតា', 'Sovath Soketa', 'Female', '46', '098422365', NULL, NULL, NULL, '$2y$12$RYV1bF7l.nHtjHUs0holSO42EPyryO8QIjGxwZrWyE4.q6Q2OcdQG', 'staff', 1, NULL, NULL, NULL, '2025-07-12 04:24:25', 'Sok Vitou', NULL),
(8426, '', '8423', 'ធាម​ ស៊្រុយធី', 'Theam Sruythy', 'Male', '44', NULL, NULL, NULL, NULL, '$2y$12$O4XGulrtJKEtYk.E7VNIO.LnYmttp1Vl7LCjhyf.JgsSCG4ZkB.3e', 'staff', 1, NULL, NULL, NULL, '2025-07-12 04:26:00', 'Sok Vitou', NULL),
(8427, '', '4119', 'មាស រស្មី', 'មាស រស្មី', 'Female', '47', NULL, NULL, NULL, NULL, '$2y$12$nkU5x8dL4WZPnsyHSQ/NeO.f7DTeZ1jD3j28FxQDprqHZ8JXNnS/q', 'staff', 1, NULL, NULL, NULL, '2025-07-12 04:31:28', 'Sok Vitou', NULL),
(8428, '', '8124', 'ញែល សុខា', 'Nhel Sokha', 'Male', '10', NULL, NULL, NULL, NULL, '$2y$12$1cncS1Wiuw4Z63HxWt6YkOSNI7kNszROqlXUfpEKzuB4dWG/gthL2', 'staff', 1, NULL, NULL, NULL, '2025-07-12 04:33:10', 'Sok Vitou', NULL),
(8429, '', NULL, 'Sok Vannchanry', 'Sok Vannchanry', 'Female', '48', '087577200', NULL, NULL, NULL, '$2y$12$AVnpsC4YNOSvIEJTfd9HfuPBAOOBuZeMk0H.IrT9uvgtarE/8KFAK', 'staff', 1, NULL, NULL, NULL, '2025-07-12 04:36:49', 'Sok Vitou', NULL),
(8430, '', NULL, 'សៀត ផល្លី', 'Seat Phaly', 'Male', '10', NULL, NULL, NULL, NULL, '$2y$12$HcoFyLl0AU4CiHcVJvvxBeOdVs25LLzj8GUJx8na2jdoNfzB6EG5m', 'staff', 1, NULL, NULL, NULL, '2025-07-12 04:58:00', 'Sok Vitou', NULL),
(8431, '', '6157', 'ហ៊ួ ស្រីនាង', 'ហ៊ួ ស្រីនាង', 'Female', '49', '087302834', NULL, NULL, NULL, '$2y$12$5Nmf9yj2zi70SvzfbDnp8eBUmijU0Y77UnjtLc25cyqvD1VysKmhO', 'staff', 1, NULL, NULL, NULL, '2025-07-12 06:23:04', 'Sok Vitou', NULL),
(8432, '', '7897', 'Phorn Phavy', 'Phorn Phavy', 'Female', '50', '012215158', NULL, NULL, NULL, '$2y$12$GM.A.62EPVuPcUctTsZyR.IkM/jAOJ9EjpJCs0LmkT3di3nowW19m', 'staff', 1, NULL, NULL, NULL, '2025-07-12 06:31:17', 'Sok Vitou', NULL),
(8433, '', '8209', 'ចាន់ សុខស្រីណា', 'ចាន់ សុខស្រីណា', 'Female', '24', '0966678477', NULL, NULL, NULL, '$2y$12$Ib83.GXuMHNW51MSi3za1uYqRIBbpFZqRP0IQ64Kz1/AZcQYEYKvG', 'staff', 1, NULL, NULL, NULL, '2025-07-12 06:37:28', 'Sok Vitou', NULL),
(8434, '', '5046', 'មោក សុជាតា', 'មោក សុជាតា', 'Female', '16', '069868654', NULL, NULL, NULL, '$2y$12$H/49sqqZxKF75uGhP8fbxuPB6tQ8dl2wJBmeediJmLSNHbDBZPJIe', 'staff', 1, NULL, NULL, NULL, '2025-07-12 06:44:24', 'Sok Vitou', NULL),
(8435, '', '6843', 'ទុយ​ តូច', 'ទុយ​ តូច', 'Female', '24', '016264569', NULL, NULL, NULL, '$2y$12$iScjzegLRgjZiyrCMkXal.qzZmVAiixAu.snDrxULT0RJOJPu7jTq', 'staff', 1, NULL, NULL, NULL, '2025-07-12 06:46:57', 'Sok Vitou', NULL),
(8438, '', NULL, 'Khlok Huyleang', 'Khlok Huyleang', 'Female', '52', '010546379', NULL, NULL, NULL, '$2y$12$gJdh40VdN.0gd/AD5ORrJONRsgDyFwyQAPFXuv1BkdUf0zYnE.N2O', 'staff', 1, NULL, NULL, NULL, '2025-07-12 07:38:06', 'Sok Vitou', NULL),
(8439, '', NULL, 'ប៊ុនហឿន ដាលីន', 'ប៊ុនហឿន ដាលីន', 'Female', '24', '078334220', NULL, NULL, NULL, '$2y$12$HA5vpBFkcaPsT92k0bniaOJ//MzWvXINrPhyURSfa6CIShZkQROp6', 'staff', 1, NULL, NULL, NULL, '2025-07-12 07:57:39', 'Sok Vitou', NULL),
(8440, '', '3149', 'មាស ស្រីពេជ្រ', 'Meas Srey Pich', 'Female', '49', '069593888', NULL, NULL, NULL, '$2y$12$BNwRjbuqq/BIrlBtKKqqjuHOhRC3Q2hSMwaadlCbeki0que.bSbXG', 'staff', 1, NULL, NULL, NULL, '2025-07-12 08:08:26', 'Sok Vitou', NULL),
(8441, '', '7991', 'ហុង គីមស្រ៊ាង', 'ហុង គីមស្រ៊ាង', 'Male', '53', '011722800', NULL, NULL, NULL, '$2y$12$Mt5xSOvGrKocNBURj78X6ea2SXvR2ZlF2Fc5CEEJydiwqFivhdaZy', 'staff', 1, NULL, NULL, NULL, '2025-07-12 08:13:27', 'Sok Vitou', NULL),
(8442, '', NULL, 'ហៃ ហ៊ីម', 'ហៃ ហ៊ីម', 'Male', '54', '012767810', NULL, NULL, NULL, '$2y$12$X8/hDgOaETp4HKeMUPxZQe.SPFxab5xcaXcajx9nxnQwJ3TAGrcDW', 'staff', 1, NULL, NULL, NULL, '2025-07-12 08:23:08', 'Sok Vitou', NULL),
(8443, '', '8901', 'ផេង ស្រីណុច', 'Pheng Sreynoch', 'Female', '55', '086418532', NULL, NULL, NULL, '$2y$12$CizXL/jIyxSdfVmZpvJw1.nvTkmrP/XUZWQGkv/8mYAgaMeXeHICW', 'staff', 1, NULL, NULL, NULL, '2025-07-12 08:39:38', 'Sok Vitou', NULL),
(8444, '', '7907', 'រ៉ា ចាន់ពិសិទ្ធ', 'Ra Chanpiseth', 'Male', '55', '0968123897', NULL, NULL, NULL, '$2y$12$ICsj5tSrMdGDwqbppiw/kOyKzxJGHlnE4DkO8noqDdQFXVmrEKgq.', 'staff', 1, NULL, NULL, NULL, '2025-07-12 08:46:04', 'Sok Vitou', NULL),
(8445, '', '7077', 'ស្រស់ ដាលីន', 'Sros Delin', 'Male', '57', '010251666', NULL, NULL, NULL, '$2y$12$wg.5e6CtxmHPZtuxpYZUTuY5dy/WUPUwqk93i4DHcgWgcwokP3/BS', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:06:21', 'Sok Vitou', NULL),
(8447, NULL, '7935', 'ម៉ន សុឌឿន', 'ម៉ន សុឌឿន', 'Male', '59', '012285619', NULL, NULL, NULL, '$2y$12$BFK0G9zFXPc2b6nqABUvL.CPYjBuYJ8qaqLi7Izi7ANHtrzb4xHZ2', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:15:12', 'Sok Vitou', NULL),
(8448, '', '7840', 'ហុង សៀវម៉ៃស៊ាំង', 'Hong Siev Mai Siang', 'Female', '60', '087806183', NULL, NULL, NULL, '$2y$12$EXz3wHc/G04OW7svCiActe5TN3qGv3nABG0S6q9wEoovaP1pZYO0y', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:21:37', 'Sok Vitou', NULL),
(8449, '', '8287', 'សំរិទ្ធ វិចិ្ឆកា', 'សំរិទ្ធ វិចិ្ឆកា', 'Male', '61', NULL, NULL, NULL, NULL, '$2y$12$Avx8F2OnkwHqbIhFenti/OcWatm9p0MmK3BhbPeTySQXNwWv.D56C', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:32:31', 'Sok Vitou', NULL),
(8450, NULL, '7539', 'នី​សុជាតា', 'Ny Socheata', 'Female', '63', NULL, NULL, NULL, NULL, '$2y$12$.9gVOFFhfmvSD1dvEp.FquywfTJ52KrMYtbTXlpJ4LkLvtmoWZQkO', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:33:53', 'Sok Vitou', NULL),
(8451, '', NULL, 'ចែម ចាន់សម្បត្តិ', 'Chaem Chansambat', 'Female', '62', '0882930114', NULL, NULL, NULL, '$2y$12$I4XDbTrhFMKokFJ0lFV4Hecrsh6D1V0AeYNPvfTs60I2O5F5YqJpa', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:35:45', 'Sok Vitou', NULL),
(8452, '', '8770', 'វឿន​ ប៊ុនណយ', 'វឿន​ ប៊ុនណយ', 'Male', '64', '0979608581', NULL, NULL, NULL, '$2y$12$Zu7jlG3B50pqf5iPHjUTXOiEHJQKEJIil98RhXf02oeDf/KcB9gLy', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:41:56', 'Sok Vitou', NULL),
(8453, '', '6837', 'គង់ ផានិត', 'Kong Parneith', 'Female', '65', '0963226622', NULL, NULL, NULL, '$2y$12$WZ.xewgCiqTE6Yv/Wme2U.uEek6wdSOCO0YT8r2eJU1Xa/jepjKai', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:44:47', 'Sok Vitou', NULL),
(8454, '', '8054', 'សាឡេះ ទីនី', 'Sales Tiny', 'Female', '66', NULL, NULL, NULL, NULL, '$2y$12$TIj5jXNd7kiVjg4Aey.xHeFjCNIjoUA1jSzLrdaGB3IyjpwrcL5b.', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:46:16', 'Sok Vitou', NULL),
(8455, '', '7974', 'ព្រំ ដាវី', 'Prom Davy', 'Male', '67', NULL, NULL, NULL, NULL, '$2y$12$B8FlphQX5Im7UWzLbxSWK.B2GBJmNtRWdu2mSjzmpLe6JSWvyvU5u', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:49:52', 'Sok Vitou', NULL),
(8458, '', '7783', 'មុំ ដារ៉ូ', 'មុំ ដារ៉ូ', 'Male', '29', NULL, NULL, NULL, NULL, '$2y$12$AfgOjf8hGROjr.cqyjA71.x.zT/ZYwe.6rUJtES4p4.aYkvv.e9pa', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:52:43', 'Sok Vitou', NULL),
(8459, '', NULL, 'សុខ សុវណ្ណពិសិដ្ឋ', 'សុខ សុវណ្ណពិសិដ្ឋ', 'Male', '69', '098874275', NULL, NULL, NULL, '$2y$12$EOpQETlAPtv7bW49kTiWn.K6hJYtrU9GOe5AlTyQeGKgxIsy7yUsq', 'staff', 1, NULL, NULL, NULL, '2025-07-12 09:58:26', 'Sok Vitou', NULL),
(8460, '', '7264', 'ស៊ីរ៉ាន់ ជែនយូរី', 'Siran January', 'Female', '70', NULL, NULL, NULL, NULL, '$2y$12$CkbkCEsi6KpKe5I00nWzMOjztfZgZXZ3xivX/neC.pm7nQ22YR0pW', 'staff', 1, NULL, NULL, NULL, '2025-07-12 10:05:06', 'Sok Vitou', NULL),
(8461, '', '5142', 'ស៊ុម វ៉ាន់ណុច', 'saoum  vean noch', 'Male', '71', '069656028', NULL, NULL, NULL, '$2y$12$rfkFk060aUpfK46gvdjbrOIff.liqhIF0eHd.P8LbRWka2R9/CxlK', 'staff', 1, NULL, NULL, NULL, '2025-07-12 10:08:55', 'Sok Vitou', NULL),
(8462, NULL, '8248', 'គង់ សីហា', 'Kong Seyha', 'Male', '40', '0967309891', NULL, NULL, NULL, '$2y$12$zJwqaqPcTS7qAzqBTdXplevCs//3fzCXg4Us9aegeBVRiWeFVTZFe', 'staff', 1, NULL, NULL, NULL, '2025-07-14 01:52:05', 'Sok Vitou', NULL),
(8464, '', '8332', 'អ៊ាប វ៉ាន់នី', 'Eap Vanny', 'Male', '72', NULL, NULL, NULL, NULL, '$2y$12$.rIyCyT.mvSdx4IidNBvq.UK6VO54r9FBjNWUN1gIdyMK.CYNlRfu', 'staff', 1, NULL, NULL, NULL, '2025-07-14 02:28:51', 'Sok Vitou', NULL),
(8465, '', '8380', 'សុទ្ធ រក្សា', 'Soth Raksa', 'Female', '73', '0967467966', NULL, NULL, NULL, '$2y$12$lYUrpeh87cfY5z7xeIV2aOQbh3OsSS8TQazRpnT3tT4VoUzmDc31e', 'staff', 1, NULL, NULL, NULL, '2025-07-14 02:30:23', 'Sok Vitou', NULL),
(8466, '', '4848', 'ណុប ច័ន្ទប៊ុនឆៃ', 'ណុប ច័ន្ទប៊ុនឆៃ', 'Male', '74', NULL, NULL, NULL, NULL, '$2y$12$Xgu2Qen6J7WvFWIyFsGHluuimZGnDbN6B3HC3f1QeSO7hd7dUDRjW', 'staff', 1, NULL, NULL, NULL, '2025-07-14 02:33:23', 'Sok Vitou', NULL),
(8468, '', '6541', 'ប៉ោ លីណា', 'Boa Lina', 'Female', '75', '010352887', NULL, NULL, NULL, '$2y$12$9LH0JFGfslugeOu4dhanROaNW5l//1J231alYCSE52bwaJKdmS4ny', 'staff', 1, NULL, NULL, NULL, '2025-07-14 02:51:51', 'Sok Vitou', NULL),
(8469, '', NULL, 'KAO SOVANNY', 'KAO SOVANNY', 'Female', '55', NULL, NULL, NULL, NULL, '$2y$12$CrWZCjEk2vxBIAOqdqD28OBegYRy9Z67NaRCF.Z7Mep30A3m8c0cS', 'staff', 1, NULL, NULL, NULL, '2025-07-14 03:07:10', 'Sok Vitou', NULL),
(8471, '', NULL, 'ឃុត ឧត្ដម', 'ឃុត ឧត្ដម', 'Male', '40', '098559540', NULL, NULL, NULL, '$2y$12$RU2EgdNrteXhVU43ZIKMIOjZfIIzuY0kiFbNZsCyW7TAxv.EZG42C', 'staff', 1, NULL, NULL, NULL, '2025-07-14 03:12:14', 'Sok Vitou', NULL),
(8472, '', '7217', 'សូវ ប៊ុននីន', 'Sov Bunnin', 'Male', '77', '016495857', NULL, NULL, NULL, '$2y$12$cPl0KpY0Rh9VfHy42hUySuQkREv39RsBmmDBeb8ftSW3kpvunCOYK', 'staff', 1, NULL, NULL, NULL, '2025-07-15 04:46:03', 'Sok Vitou', NULL),
(8473, '', '5024', 'សោម ស្រីកា', 'Saom Sreyka', 'Female', '78', '086326602', NULL, NULL, NULL, '$2y$12$4Otig/Vful3AN34lqdIX5ukYvr/6PhWqWoJ1NUH9rgg.NKUIQxxOW', 'staff', 1, NULL, NULL, NULL, '2025-07-15 08:13:49', 'Sok Vitou', NULL),
(8474, '', NULL, 'នាង ណុចត្រា', 'Neang Nochtra', 'Male', '79', '0964446992', NULL, NULL, NULL, '$2y$12$JpNq8RbqtyzLlgQmommYgei3ZjdhE64HQxNNUtJwogRrjopy0Code', 'staff', 1, NULL, NULL, NULL, '2025-07-15 09:06:24', 'Sok Vitou', NULL),
(8475, '', '011', 'គង់ សារ៉ាដូ', 'Kong Sarado', 'Male', '80', '070212394', NULL, NULL, NULL, '$2y$12$cA9BacE6OnWFqbnCMz/KDuo49VqSzpFtUhSkhiaJiSIxTYMtoG1C.', 'staff', 1, NULL, NULL, NULL, '2025-07-16 02:51:24', 'Sok Vitou', NULL),
(8476, '', NULL, 'សុគន្ធ ធារ៉ា', 'Sokonth Theara', 'Male', '81', '067666062', NULL, NULL, NULL, '$2y$12$xJMugMHUuTFkPm6X2bDbeeGDGMVz5mPcIrVXlNv3vZnx2vbsnygg6', 'staff', 1, NULL, NULL, NULL, '2025-07-16 03:49:34', 'Sok Vitou', NULL),
(8477, NULL, '4949', 'ឌឿក វិសាល', 'Duek Visal', 'Male', '41', '070222457', NULL, NULL, NULL, '$2y$12$KQJS5MuY9hIfmjY4wfSOY.gmNwXh5ESX0Us3GmBH31LwzIkuUlVGy', 'staff', 1, NULL, NULL, NULL, '2025-07-16 07:20:23', 'Sok Vitou', NULL),
(8478, '', '1701', 'សុខ ឡាក់', 'Sok Luck', 'Male', '82', '086967696', NULL, NULL, NULL, '$2y$12$3hZRaV34BsgwgA46.eadQezb2QlYNdKr1KbV3urAwjCXzE7GjMyCe', 'staff', 1, NULL, NULL, NULL, '2025-07-19 03:03:16', 'Sok Vitou', NULL),
(8480, '', '00012', 'វឿ​ន សុខហេង', 'Sokheng Viewer', 'Male', '7', NULL, NULL, 'viewer', NULL, '$2y$12$dwi3CJzdD1eL/UtoDnWSDe/.qmoGoD83oSdufuYfSrEsJncBVkqbS', '68', 1, NULL, NULL, NULL, '2025-07-21 14:54:53', 'Sok Vitou', NULL),
(8481, '', '1009', 'បំ រតនា', 'Bom Rathana', 'Male', '83', '069222458', NULL, NULL, NULL, NULL, 'staff', 1, NULL, NULL, NULL, '2025-07-22 07:47:37', 'Sok Vitou', NULL),
(8482, '', '9001', 'ព្រំ ភារម្យ', 'Prum Phearum', 'Male', '84', '0966455714', NULL, NULL, NULL, NULL, 'staff', 1, NULL, NULL, NULL, '2025-07-24 07:24:16', 'Sok Vitou', NULL),
(8483, '', '7205', 'ឡុង ម៉េងលី', 'Long Mengly', 'Male', '85', '0964772337', NULL, NULL, NULL, NULL, 'staff', 1, NULL, NULL, NULL, '2025-07-29 04:53:04', 'Sok Vitou', NULL),
(8484, '', '00000', 'អ្នកអភិវឌ្ឍន៍', 'Super Developer', 'Male', '', '000000000', 'inventory.developer@gamil.com', 'developer@123', NULL, '$2y$12$NgwVDWipxED.5rB0xePy8OVRfOGuIA0ejeeMIQRxmSZVcenn9OgxS', '1', 1, NULL, NULL, NULL, '2025-07-29 10:42:12', 'Developer', NULL),
(8485, '', '00001', 'អ្នកគ្រប់គ្រងប្រព័ន្ធ', 'System Administrator', 'Male', '72', NULL, NULL, 'superadmin@ims', NULL, '$2y$12$B2UoB9L6kvS3DdK1mYtVV.aVW4Z7Ly1Aa80fY5qtSGn63heHoi/HS', '1', 1, NULL, NULL, NULL, '2025-07-31 03:25:36', 'Super Developer', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `delete_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_name`, `add_by`, `create_date`, `delete_status`, `delete_by`, `delete_date`) VALUES
(1, 'Admin', 'Developer', '2025-07-29 10:42:12', 1, NULL, NULL),
(69, 'I', 'Sok Vitou', '2025-07-30 08:12:25', 0, 'Sok Vitou', '2025-07-30'),
(70, 'IT-Administrator', 'Sok Vitou', '2025-07-30 08:12:18', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `id` int(11) NOT NULL,
  `year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`id`, `year`) VALUES
(1, '2025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply_funcion_for_role`
--
ALTER TABLE `apply_funcion_for_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`borrow_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `give_table`
--
ALTER TABLE `give_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_codes`
--
ALTER TABLE `item_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_function`
--
ALTER TABLE `main_function`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `operators_email_unique` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_locks`
--
ALTER TABLE `product_locks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_table`
--
ALTER TABLE `pr_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_outlists`
--
ALTER TABLE `return_outlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_fees`
--
ALTER TABLE `service_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_users`
--
ALTER TABLE `staff_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_function`
--
ALTER TABLE `sub_function`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `users_card_id_unique` (`card_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply_funcion_for_role`
--
ALTER TABLE `apply_funcion_for_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `borrow_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `give_table`
--
ALTER TABLE `give_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `item_codes`
--
ALTER TABLE `item_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `main_function`
--
ALTER TABLE `main_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;

--
-- AUTO_INCREMENT for table `product_locks`
--
ALTER TABLE `product_locks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `pr_table`
--
ALTER TABLE `pr_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `return_outlists`
--
ALTER TABLE `return_outlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `service_fees`
--
ALTER TABLE `service_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_users`
--
ALTER TABLE `staff_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `sub_function`
--
ALTER TABLE `sub_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8486;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
