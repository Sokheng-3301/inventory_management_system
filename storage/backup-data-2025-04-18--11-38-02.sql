DROP TABLE IF EXISTS `apply_funcion_for_role`;
CREATE TABLE `apply_funcion_for_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `main_function_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `sub_function_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `action_edit` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `action_delete` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `apply_funcion_for_role` VALUES ('1', '4', '1,3,4', '4,5,6,7,8,9,10', '', '');
INSERT INTO `apply_funcion_for_role` VALUES ('2', '3', '1,2,3', '1,2,3,4,5,6,7', '1', '1');
INSERT INTO `apply_funcion_for_role` VALUES ('5', '7', '1,2,3,4,5,7', '1,2,3,4,5,8,9,10,11,19,20,12,13,14,15,16,17,18', '', '');
INSERT INTO `apply_funcion_for_role` VALUES ('6', '8', '1,2,3,4,7,8,9', '1,2,3,4,5,28,8,9,10,11,19,20,17,18,25,26,27', '1', '');

DROP TABLE IF EXISTS `borrows`;
CREATE TABLE `borrows` (
  `borrow_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
  `request_datetime` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`borrow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` VALUES ('16', 'Laptop', 'Ra Mey', '2025-03-21 17:17:59', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('17', 'Desktop', 'Ra Mey', '2025-03-21 17:18:06', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('18', 'Monitor', 'Ra Mey', '2025-03-21 17:18:17', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('19', 'Printer', 'Ra Mey', '2025-03-21 17:18:25', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('20', 'Mouse', 'Ra Mey', '2025-03-21 17:18:34', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('21', 'Mouse Pad', 'Ra Mey', '2025-03-21 17:18:50', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('22', 'Keyboard', 'Ra Mey', '2025-03-21 17:19:12', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('23', 'Hardisk', 'Ra Mey', '2025-03-21 17:19:28', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('24', 'Toner Printer', 'Ra Mey', '2025-03-21 17:19:48', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('25', 'External Hard drive', 'Ra Mey', '2025-03-21 17:20:29', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('26', 'USB', 'Ra Mey', '2025-03-21 17:23:39', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('27', 'USB Wifi', 'Ra Mey', '2025-03-21 17:23:27', '0', 'Admin', '2025-03-21', '2025');
INSERT INTO `categories` VALUES ('28', 'Adapter', 'Ra Mey', '2025-03-21 17:21:23', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('29', 'Cable', 'Ra Mey', '2025-03-21 17:24:28', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('30', 'USB wifi', 'Sok Vitou', '2025-03-27 09:50:25', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('31', 'SSD', 'Sok Vitou', '2025-03-31 11:13:33', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('32', 'bag', 'Sok Vitou', '2025-03-31 16:06:37', '1', '', '', '2025');
INSERT INTO `categories` VALUES ('33', 'Battery-UPS', 'Sok Vitou', '2025-03-31 16:09:47', '1', '', '', '2025');

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_code` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `dep_name_kh` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dep_name_en` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  `year` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `departments` VALUES ('2', '12001', 'ព័ត៌មានវិទ្យា', 'Information Technology', 'Voeurn Sokheng', '2025-03-20 16:54:54', '1', '', '', '2025');
INSERT INTO `departments` VALUES ('3', '', 'ផលិតកម្ម', 'Production', 'Voeurn Sokheng', '2025-03-25 14:32:26', '1', '', '', '2025');
INSERT INTO `departments` VALUES ('4', '', 'លក់ទឹកកេស', 'Sale(bottle)', 'Sok Vitou', '2025-03-25 15:07:00', '1', '', '', '2025');
INSERT INTO `departments` VALUES ('5', '', 'ដឹកជញ្ជូន', 'WH&Logistic', 'Sok Vitou', '2025-03-25 15:07:48', '1', '', '', '2025');
INSERT INTO `departments` VALUES ('6', '', 'ទីផ្សារ', 'Marketing', 'Sok Vitou', '2025-03-25 15:08:14', '1', '', '', '2025');
INSERT INTO `departments` VALUES ('7', '', 'ហិរញ្ញវត្ថុ', 'Finance', 'Sok Vitou', '2025-03-25 15:10:31', '1', '', '', '2025');
INSERT INTO `departments` VALUES ('8', '', 'ធនធានមនុស្ស', 'Human resources', 'Sok Vitou', '2025-03-25 15:11:11', '1', '', '', '2025');
INSERT INTO `departments` VALUES ('9', '', 'លក់ទឹកធុង', 'Sale(gallon)', 'Sok Vitou', '2025-03-25 15:12:35', '1', '', '', '2025');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `give_table`;
CREATE TABLE `give_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `year` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `give_table` VALUES ('5', '198', '123', '1', '2025-03-25', 'uploads/give-atts/4SybscnoCI0DzcfIYjRk3Tq8khmCUCdZy5IWxIh1.jpg', 'Sok Vitou', '1', '2025-03-25 15:15:04', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('6', '201', '120', '1', '2025-03-24', 'uploads/give-atts/deqFXgxOA8NmGWu026kJbCdnn0dx5bctQeHVY64Y.jpg', 'Sok Vitou', '1', '2025-03-26 08:55:28', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('7', '201', '110', '1', '2025-03-24', 'uploads/give-atts/3gVu6uH5Vic48ONvth4F5GusOVYx8xyzc6QwS3h4.jpg', 'Sok Vitou', '1', '2025-03-26 09:08:16', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('8', '201', '121', '1', '2025-03-24', 'uploads/give-atts/6Px0MJZeVWDshujgCidllqU5hseWMpndhobSUlSV.jpg', 'Sok Vitou', '1', '2025-03-26 09:09:15', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('9', '201', '128', '1', '2025-03-24', 'uploads/give-atts/4HTgVMTHu4GKmXtt7UwVZ0rFKdBFSFgXVmwbyE2h.jpg', 'Sok Vitou', '1', '2025-03-26 09:09:49', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('10', '202', '125', '1', '2025-03-26', 'uploads/give-atts/xiaWB1AAXMwZ4c600KiRIOMmA4ZXPPzt9V0tK4hX.jpg', 'Sok Vitou', '1', '2025-03-27 09:43:44', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('11', '202', '124', '1', '2025-03-26', 'uploads/give-atts/DVGDCimDhLYQmhj7dYzok5tcv0hk12VW6bFOLZCS.jpg', 'Sok Vitou', '1', '2025-03-27 09:44:20', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('12', '202', '127', '1', '2025-03-26', 'uploads/give-atts/nB891o0VIBubHQunwNLY9TXbLNLigg0TeZcODjLT.jpg', 'Sok Vitou', '1', '2025-03-27 09:45:50', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('13', '202', '126', '1', '2025-03-26', 'uploads/give-atts/kh9xO82jFzQklWq2baeQzKXbQvghTtNbXMYnwZun.jpg', 'Sok Vitou', '1', '2025-03-27 09:46:20', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('14', '202', '129', '1', '2025-03-26', 'uploads/give-atts/YGunpZUFWSp5oPVnlKkVvB0EmObOxSSNhGxvCnTn.jpg', 'Sok Vitou', '1', '2025-03-27 09:47:40', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('15', '202', '131', '1', '2025-03-26', 'uploads/give-atts/1FqqkOW4EyP8XJ27go26imv00UeenQpXCS08AJLJ.jpg', 'Sok Vitou', '1', '2025-03-27 09:52:37', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('16', '203', '137', '1', '2025-03-31', 'uploads/give-atts/KojpEwhzFhtPxBVHXY5Sm6ngTfhrv6rGxBKWgwBF.jpg', 'Sok Vitou', '1', '2025-03-31 16:01:36', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('17', '203', '136', '1', '2025-03-31', 'uploads/give-atts/OkoHHZCc2XdiDJ8kzHOJt3MMaVhdUgePIzyfEaTg.jpg', 'Sok Vitou', '1', '2025-03-31 16:02:31', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('18', '203', '135', '1', '2025-03-31', 'uploads/give-atts/gCiNnMmJiKY7IvGwUESOZUOwqkVTPCtHjYC40nqb.jpg', 'Sok Vitou', '1', '2025-03-31 16:03:12', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('19', '203', '134', '1', '2025-03-31', 'uploads/give-atts/e04ZP5Vak0yheHyatVWuzYsQ6y24vH8SsiGx2VKh.jpg', 'Sok Vitou', '1', '2025-03-31 16:03:39', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('20', '202', '153', '1', '2025-03-26', 'uploads/give-atts/Nbxeur1KQ2LVL4BaGdLOerLkPXFzNYfXsfSnvmjZ.jpg', 'Sok Vitou', '1', '2025-04-02 11:39:36', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('21', '198', '152', '1', '2025-03-25', 'uploads/give-atts/V0tt85EaO65ysLOxVk74Q6dwjNGXNbu50hPRXtwR.jpg', 'Sok Vitou', '1', '2025-04-02 11:40:26', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('22', '202', '109', '1', '2025-03-28', 'uploads/give-atts/SsJ8o21aypP8T4M8TbXZXuRICwwGbL3WMMjJA41X.jpg', 'Sok Vitou', '1', '2025-04-02 11:41:19', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('23', '206', '111', '1', '2025-04-01', 'uploads/give-atts/ZnVMuqvgydIoytAWctn1U5JYEoHhIjJMa2VP6Je9.jpg', 'Sok Vitou', '1', '2025-04-02 15:13:12', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('24', '205', '154', '2', '2025-03-31', 'uploads/give-atts/Lqg6aGch7f7F6AN6JAr4UAiD0kbX6Ofk26h5OyHP.jpg', 'Sok Vitou', '1', '2025-04-02 15:13:56', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('25', '209', '147', '1', '2025-04-02', 'uploads/give-atts/ZHXeP4jEnSllemzciuUjXWd9J6NGcFmyvkoqkXVC.jpg', 'Sok Vitou', '1', '2025-04-05 16:05:13', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('26', '208', '148', '1', '2025-04-02', 'uploads/give-atts/u52mro2bODO52wXSfvcUrhEdnAi1KwIZ4A0gYH89.jpg', 'Sok Vitou', '1', '2025-04-05 16:08:55', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('27', '207', '149', '1', '2025-04-02', 'uploads/give-atts/ZPT7ADAaaqwU9kKHz12x3O5Ghdgm6hf1ASX5g4E9.jpg', 'Sok Vitou', '1', '2025-04-05 16:24:39', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('28', '210', '112', '1', '2025-04-01', 'uploads/give-atts/6rXoZDsUD2lt8k3VGJvOxeynTFn4z8qJADeiFcAg.jpg', 'Sok Vitou', '1', '2025-04-05 16:34:19', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('29', '211', '133', '1', '2025-04-03', 'uploads/give-atts/9kKywEZmJ9QWdsFHlVXbi0vcQ90FNXw00dgmMu0o.jpg', 'Sok Vitou', '1', '2025-04-05 16:39:17', '', '', '1', '', '2025');
INSERT INTO `give_table` VALUES ('30', '202', '132', '1', '2025-04-04', 'uploads/give-atts/sCGAhEMAExpIqnY9mMsAptdtFiLhOhikgLTXXAdL.jpg', 'Sok Vitou', '1', '2025-04-05 16:40:26', '', '', '1', '', '2025');

DROP TABLE IF EXISTS `main_function`;
CREATE TABLE `main_function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `name_kh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `icon_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `main_function` VALUES ('1', 'Dashboard', 'ផ្ទាំងគ្រប់គ្រង', 'mdi-home');
INSERT INTO `main_function` VALUES ('2', 'Master data', 'ទិន្នន័យបឋម', 'mdi-database-outline');
INSERT INTO `main_function` VALUES ('3', 'Products', 'សម្ភារៈ', 'mdi-table');
INSERT INTO `main_function` VALUES ('4', 'Request''s borrow', 'សំណើ', 'mdi-inbox-arrow-down-outline');
INSERT INTO `main_function` VALUES ('5', 'Manage users', 'គ្រប់គ្រងអ្នកប្រើប្រាស់', 'mdi-account-group-outline');
INSERT INTO `main_function` VALUES ('7', 'Given&Returned', 'ផ្តល់ជូន&ប្រគល់ត្រឡប់', 'mdi-hand-coin-outline');
INSERT INTO `main_function` VALUES ('8', 'Purchase request', 'សំណើទិញ', 'mdi-shopping-outline');
INSERT INTO `main_function` VALUES ('9', 'Expense report', 'របាយការណ៍ចំណាយ', 'mdi-finance');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` VALUES ('31', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('32', '2014_10_12_100000_create_password_reset_tokens_table', '1');
INSERT INTO `migrations` VALUES ('33', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('34', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('35', '2025_02_12_013157_create_table_categorys', '1');
INSERT INTO `migrations` VALUES ('36', '2025_02_12_014338_create_table_positions', '1');
INSERT INTO `migrations` VALUES ('37', '2025_02_12_014938_create_table_departments', '1');
INSERT INTO `migrations` VALUES ('38', '2025_02_12_015415_create_table_borrows', '1');
INSERT INTO `migrations` VALUES ('39', '2025_02_12_020134_crate_table_operators', '1');
INSERT INTO `migrations` VALUES ('40', '2025_02_12_021351_create_table_staff_users', '1');
INSERT INTO `migrations` VALUES ('41', '2025_02_12_021752_create_table_user_roles', '1');
INSERT INTO `migrations` VALUES ('42', '2025_02_12_024121_create_table_products', '1');

DROP TABLE IF EXISTS `operators`;
CREATE TABLE `operators` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `add_by` char(255) NOT NULL,
  `crreate_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `block_status` int(11) NOT NULL DEFAULT 1,
  `block_by` char(255) DEFAULT NULL,
  `block_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `operators_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `position_name` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `section_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `add_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `positions` VALUES ('6', 'IT Admin', '7', '', 'Voeurn Sokheng', '2025-03-21 17:30:28', '1', '', '');
INSERT INTO `positions` VALUES ('7', 'IT officer', '8', '', 'Voeurn Sokheng', '2025-03-21 17:30:08', '1', '', '');
INSERT INTO `positions` VALUES ('8', 'PHP Developer', '11', '', 'Ra Mey', '2025-03-21 17:31:41', '1', '', '');
INSERT INTO `positions` VALUES ('9', 'IT Department Director', '12', '', 'Voeurn Sokheng', '2025-03-25 11:08:27', '1', '', '');
INSERT INTO `positions` VALUES ('10', 'ASM', '13', '', 'Sok Vitou', '2025-03-26 07:42:11', '1', '', '');
INSERT INTO `positions` VALUES ('11', 'RSM', '13', '', 'Sok Vitou', '2025-03-26 07:48:54', '1', '', '');
INSERT INTO `positions` VALUES ('12', 'ជំនួយការ', '14', '', 'Sok Vitou', '2025-03-27 09:29:54', '1', '', '');
INSERT INTO `positions` VALUES ('13', 'Designer', '15', '', 'Sok Vitou', '2025-03-31 12:06:22', '1', '', '');
INSERT INTO `positions` VALUES ('14', 'WH& Logistic Manager', '16', '', 'Sok Vitou', '2025-04-01 11:46:49', '1', '', '');
INSERT INTO `positions` VALUES ('15', 'Sr.IT officer', '17', '', 'Sok Vitou', '2025-04-02 14:58:36', '1', '', '');
INSERT INTO `positions` VALUES ('16', 'ជំនួយការគណនេយ្យ', '18', '', 'Sok Vitou', '2025-04-02 15:04:48', '1', '', '');
INSERT INTO `positions` VALUES ('17', 'DMS Officer', '19', '', 'Sok Vitou', '2025-04-05 15:52:30', '1', '', '');
INSERT INTO `positions` VALUES ('18', 'HR IR', '20', '', 'Sok Vitou', '2025-04-05 16:29:15', '1', '', '');
INSERT INTO `positions` VALUES ('19', 'Training', '21', '', 'Sok Vitou', '2025-04-05 16:50:14', '1', '', '');

DROP TABLE IF EXISTS `pr_table`;
CREATE TABLE `pr_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `add_stock_status` varchar(12) DEFAULT '0' COMMENT '0 for not add to stock and 1 for has added to stock',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `pr_table` VALUES ('8', '6880', 'sfdafda', 'dfsdafd', 'sdfasdfsdafs', 'sdfadfdasfs', '1', '', '33', 'fafsdfsf', '2025-04-11 15:45:13', '1', 'Ra Mey', '0', 'uploads/purchase-atts/tfAt0nC9QYgQpZ6IGNRV3OWNsOTapgSTaQXQ1YXM.jpg', '2025', '', '', '', '', '0');

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` VALUES ('106', 'uploads/products/FUJxmfJ8V9XLQzwiTTTzONED90obFjUkPwulZQwi.jpg', 'Mouseខ្សែ', 'Mouse', '', '20', '1', '1', 'Mouseខ្សែពណ៌ខ្មៅ', 'Sok Vitou', '2025-03-22', '1', '', '', '2025', 'Logitech', '2324HS05QQQ9', '');
INSERT INTO `products` VALUES ('107', 'uploads/products/3qYnbG9d5GEb0WrPwgQyYLO03maVrr5wq1HWTVX7.jpg', 'កុំព្យូទ័រយួរដៃ', 'Laptop', '', '16', '1', '1', 'Latopយកពីផ្ទះមីង', 'Voeurn Sokheng', '2025-03-22', '1', '', '', '2025', 'Mac book', 'W893421U7XJ', 'F-OE-01282');
INSERT INTO `products` VALUES ('108', 'uploads/products/OelZMXA3tfIvOxmCawtYJXGjeGAyiQgiEYWhis28.jpg', 'កុំព្យូទ័រយួរដៃ', 'Laptop', '', '16', '1', '1', 'laptopបានមកពីផ្ទះអ្នកមីង', 'Voeurn Sokheng', '2025-03-22', '1', '', '', '2025', 'Sony vaio', 'J002EU8V', 'F-OE-01281');
INSERT INTO `products` VALUES ('109', 'uploads/products/ltcSW8J7nmeqjo6u3Q4uSmrzkFkA47JSmrLAATyG.jpg', 'Mouseខ្សែ', 'Mouse', '', '20', '0', '0', '', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Logitech', '2447APEAAKT9', '');
INSERT INTO `products` VALUES ('110', 'uploads/products/gUwxtJqdwY0WuMgufVHfPdOwVrCIK4zFxTZ0NyrV.jpg', 'Mouseខ្សែ', 'Mouse', '', '20', '0', '0', 'Mouseខ្សែ', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Logitech', '2324HS05QQP9', '');
INSERT INTO `products` VALUES ('111', 'uploads/products/oGJwQOcwUubrUcLmEitMoxWTt1YTIDU6j987RFEF.jpg', 'Mouseខ្សែ', 'Mouse', '', '20', '0', '0', 'Mouseខ្សែ', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Logitech', '2447APSAAKS9', '');
INSERT INTO `products` VALUES ('112', 'uploads/products/4nrw0Idy8Z7sU4lGf1rrsPo0DThTaNiDG7ope8mc.jpg', 'Mouse​​ wireless', 'Mouse​​ wireless', '', '20', '0', '0', 'Mouse wireless', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Logitech', '2444ZERM69', '');
INSERT INTO `products` VALUES ('113', 'uploads/products/TyiBEKmHubIRotmtMEhQjmoE9pZJQp94BJEKZXI6.jpg', '', 'Keyboard', '', '22', '1', '1', 'keyboardប្រើខ្សែ', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Dell', 'CN-066M5G-LO300-3AA-OFFV', '');
INSERT INTO `products` VALUES ('114', 'uploads/products/R3XW1xOsncNEamU1NEzfshZRtseVv53qzPzmizxX.jpg', '', 'Keyboard', '', '22', '1', '1', '', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Logitech', '2232MR1BF579', '');
INSERT INTO `products` VALUES ('115', 'uploads/products/J5JvQjnkjoANrAadQCd5vR0nqTM8SizjiGRA6V5Y.jpg', '', 'Keyboard', '', '22', '1', '1', 'Keyboardប្រើខ្សែ', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Logitech', '2232MR1BF589', '');
INSERT INTO `products` VALUES ('116', 'uploads/products/OTgrc0oww9FgX4GVXkoTyzgOcBCQ2UZ9lzEGycNT.jpg', '', 'Keyboard', '', '22', '1', '1', 'Keyboardប្រើខ្សែ', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Logitech', '2232MR1AEF59', '');
INSERT INTO `products` VALUES ('117', 'uploads/products/BYLMcvuQWO0soKnhhfzq0IngWbAqJpYXA8L243xw.jpg', '', 'Keyboar', '', '22', '1', '1', 'Keyboardប្រើខ្សែ', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Logitech', '2232MR1BF5A9', '');
INSERT INTO `products` VALUES ('118', 'uploads/products/iJnXeTmgNuZHSjSFEHYPYXJmxAEHMNwxNkXxDqSW.jpg', '', 'Keyboard', '', '22', '1', '1', 'Keyboardប្រើខ្សែ', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Logitech', '2232MR1BF599', '');
INSERT INTO `products` VALUES ('119', 'uploads/products/kBULCscDPjDRJGYCiJrsoL25kLeF0zxAuSrd5gVC.jpg', '', 'Laptop', '', '16', '1', '1', 'LaptopបានមកពីខាងHR(ម៉ីស៊ាង)', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Asus Vivo book', 'RBNOCV12M30548E', '');
INSERT INTO `products` VALUES ('120', 'uploads/products/Cyi7lU7xhfymhIc4jaP7RJfhnLagrLhSckGm0x2l.jpg', 'កុំព្យូទ័រយួរដៃ', 'Laptop', '', '16', '0', '0', 'LaptopទទួលបានមកពីខាងHolica Manager', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Asus Vivo book', 'R7N0CV20579230B', 'F-0E-01106');
INSERT INTO `products` VALUES ('121', 'uploads/products/aZYvqL93PLyq3n7fDAOwnHVk67RaHeapyLzMMDQu.jpg', '', 'Adapter', '', '28', '0', '0', 'AdapterទទួលបានមកពីHolica Manager', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Asus Vivo book', '', '');
INSERT INTO `products` VALUES ('122', 'uploads/products/vRrcGGz4zpzDbKsx0nX4hmgQpHTbPtORRbkhcchx.jpg', '', 'Adapter', '', '28', '1', '1', 'AdapterទទួលបានមកពីHR(ម៉ីស៊ាង)', 'Sok Vitou', '2025-03-24', '1', '', '', '2025', 'Asus Vivo book', '0A001-01105100343B00YEL', '');
INSERT INTO `products` VALUES ('123', 'uploads/products/RZmXScdYA53Rhn16RdKoHEblDZCDPGVl8VZifr2Z.jpg', 'ម៉ាស៊ីនព្រីនcolor', 'Printer color', '', '19', '0', '0', 'Printer color', 'Sok Vitou', '2025-03-25', '1', '', '', '2025', 'HP Color LaserJet Pro MFP M283fdw', 'CNBRQCW43B', '');
INSERT INTO `products` VALUES ('124', 'uploads/products/QnGQAFCQqM69iNl2mYA7vN2irqOecVmfEBY9N4Oc.jpg', 'Monitor', 'Moniter', '', '18', '0', '0', 'Monitor', 'Sok Vitou', '2025-03-25', '1', '', '', '2025', 'LED Monitor Dell 22" E2223HN FHD', 'CN-032GTV-FCC00-398-AGJX', '');
INSERT INTO `products` VALUES ('125', 'uploads/products/ndgOryRkS59DyTu39eiatsGgf2dmaP9mb6RMtKag.jpg', 'Desktop', 'Desktop', '', '17', '0', '0', 'Desktop', 'Sok Vitou', '2025-03-25', '1', '', '', '2025', 'Dell OptiPlex 7010 Tower', 'HCYL544', '');
INSERT INTO `products` VALUES ('126', 'uploads/products/oRSDFsGEF9CBgNw2OGmm6Va1xHi5ebjUq0Nkau4P.jpg', 'Keyboard', 'Keyboard', '', '22', '0', '0', 'keyboard', 'Sok Vitou', '2025-03-25', '1', '', '', '2025', 'Dell', 'CN-063Y55-LO300-442-04VR', '');
INSERT INTO `products` VALUES ('127', 'uploads/products/qyrZ4hkl2USMlhmZoruomPCllbD7HZ632zOJGFhq.jpg', 'Mouse', 'Mouse', '', '20', '0', '0', 'Mouseខ្សែ', 'Sok Vitou', '2025-03-25', '1', '', '', '2025', 'Dell', 'CN-0DMV3P-CH400-43P-0D0O-A01', '');
INSERT INTO `products` VALUES ('128', 'uploads/products/2M4JraT0YgvOblaPcvote42DOWz6GdCOvzJnpywb.jpg', 'Mousepad', 'Mousepad', '', '21', '0', '0', 'Mousepad', 'Sok Vitou', '2025-03-25', '1', '', '', '2025', '', '', '');
INSERT INTO `products` VALUES ('129', '', 'Mousepad', 'Mousepad', '', '21', '0', '0', 'Mousepad', 'Sok Vitou', '2025-03-26', '1', '', '', '2025', '', '', '');
INSERT INTO `products` VALUES ('130', 'uploads/products/nmYkwIYKwYnM93KyQUBO3GCmR0VMRezlDtCV5LPO.jpg', 'អំពូលសូឡា', 'Solar light', '', '29', '9', '1', 'សម្រាប់ដាក់នៅទីតាំងព្រែកប្រា', 'Sok Vitou', '2025-03-26', '1', '', '', '2025', '', '', '');
INSERT INTO `products` VALUES ('131', 'uploads/products/NlO1IHteg1ye4ARg5nP5XRKsrUGK4ndsFvdulclR.jpg', 'USB-wifi', 'USB-wifi', '', '30', '0', '0', 'USB-wifi', 'Sok Vitou', '2025-03-27', '1', '', '', '2025', 'TP-link', '2248049004971', '');
INSERT INTO `products` VALUES ('132', 'uploads/products/S3JSbhXyDqbR7OGWVZz0yQwspgUwY2vd1vIrvGZn.jpg', 'SSD-512GB', 'SSD-512BG', '', '31', '0', '0', 'SSD512GB(ហាក់-ប៊ុនថុង)', 'Sok Vitou', '2025-03-31', '1', '', '', '2025', 'COLOFUL-SOLID-STATE-DRIVE', '0100301IPXZ00D2', '');
INSERT INTO `products` VALUES ('133', 'uploads/products/zHFchuugDChylP69TFYPTW6H7B49CwPJxNL0RJb4.jpg', 'SSD-512GB', 'SSD-512GB', '', '31', '0', '0', 'SSD-512GB(ឃុន អីណា)', 'Sok Vitou', '2025-03-31', '1', '', '', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ003N', '');
INSERT INTO `products` VALUES ('134', 'uploads/products/YQyAVNgSOad8SeTsaKWqLqKyDDuihXFCvfTG3vjs.jpg', 'Mouse-AUlA-F816', 'Mouse-AUlA-F816', '', '20', '0', '0', 'Mouse-AUlA-F816', 'Sok Vitou', '2025-03-31', '1', '', '', '2025', 'AUlA-F816', 'MSF816ED240302495', '');
INSERT INTO `products` VALUES ('135', 'uploads/products/IMwItykagL4Y2pcl2WbaHvjTSDJdkSiY5izv0fPy.jpg', 'Keyboard-AULA-F2088', 'Keyboard-AULA-F2088', '', '22', '0', '0', 'Keyboard-AULA-F2088', 'Sok Vitou', '2025-03-31', '1', '', '', '2025', 'AULA-F2088', 'KBF2088EK240314083', '');
INSERT INTO `products` VALUES ('136', '', 'Monitor-Dell27"-U2724D-QHD-2K-UItraSharp', 'Monitor-Dell27"-U2724D-QHD-2K-UItraSharp', '', '18', '0', '0', 'Monitor-Dell27"-U2724D-QHD-2K-UItraSharp', 'Sok Vitou', '2025-03-31', '1', '', '', '2025', 'Dell27"-U2724D-QHD-2K-UItraSharp', 'CN-07VD2T-WSLOO48M-BQ1L', '');
INSERT INTO `products` VALUES ('137', '', 'Desktop', 'Desktop', '', '17', '0', '0', 'Desktop(PC-MB-B760M-DS3H-AX-DDR4)', 'Sok Vitou', '2025-03-31', '1', '', '', '2025', 'PC-MB-B760M-DS3H-AX-DDR4', '', '');
INSERT INTO `products` VALUES ('138', '', 'Laptop', 'Laptop', '', '16', '1', '1', 'Laptop model Dell-Inspiron', 'Sok Vitou', '2025-03-31', '1', '', '', '2025', 'Dell-Inspiron', '7PSZ434', '');
INSERT INTO `products` VALUES ('139', '', 'Mouse-Bluetooth', 'Mouse-Bluetooth', '', '20', '1', '1', 'Mouse-Bluetooth model METOO', 'Sok Vitou', '2025-03-31', '1', '', '', '2025', 'METOO', '2401E042603', '');
INSERT INTO `products` VALUES ('140', '', 'Adapter', 'Adapter', '', '28', '1', '1', 'Adapter model Dell', 'Sok Vitou', '2025-03-31', '1', '', '', '2025', 'Dell', '07JHD3-CH600-42GOGDY-A01', '');
INSERT INTO `products` VALUES ('141', '', 'កាតាប', 'bag', '', '32', '1', '1', '', 'Sok Vitou', '2025-03-31', '1', '', '', '2025', 'Dell', '', '');
INSERT INTO `products` VALUES ('142', '', 'Laptop', 'Laptop', '', '16', '1', '1', 'Laptop', 'Sok Vitou', '2025-04-01', '1', '', '', '2025', 'Asus-Vivo book', 'R2N0CV12X33609H', '');
INSERT INTO `products` VALUES ('143', '', 'Charger', 'Charger', '', '28', '1', '1', 'Charger', 'Sok Vitou', '2025-04-01', '1', '', '', '2025', 'Asus ADP-45BW', 'OA001-01100310C325010330', '');
INSERT INTO `products` VALUES ('144', '', 'Mouse BlueTooth', 'Mouse BlueTooth', '', '20', '1', '1', 'Mouse BlueTooth', 'Sok Vitou', '2025-04-01', '1', '', '', '2025', 'METOO', '2404EOO3339', '');
INSERT INTO `products` VALUES ('145', '', 'Mousepad', 'Mousepad', '', '21', '1', '1', 'Mousepad', 'Sok Vitou', '2025-04-01', '1', '', '', '2025', '', '', '');
INSERT INTO `products` VALUES ('146', '', 'Bag', 'Bag', '', '32', '1', '1', 'Bag', 'Sok Vitou', '2025-04-01', '1', '', '', '2025', '', '', '');
INSERT INTO `products` VALUES ('147', 'uploads/products/uU3Z9BX8zrZlyCXJ4YTFcALRY9AAP62gvnwNBnK5.jpg', 'SSD512GB', 'SSD512GB', '', '31', '0', '0', 'SSD512GB(ស្រីឡៃ)', 'Sok Vitou', '2025-04-02', '1', '', '', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ00DW', '');
INSERT INTO `products` VALUES ('148', 'uploads/products/jduejNO9LvoYNG9B7wMn0BDGcZdcaZyKzncBAeDa.jpg', 'SSD-512GB', 'SSD-512GB', '', '31', '0', '0', 'SSD-512GB(ស្រីតី)', 'Sok Vitou', '2025-04-02', '1', '', '', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ00CK', '');
INSERT INTO `products` VALUES ('149', 'uploads/products/CWoYBtYhWPcgxxhXbjvuV6PLFpE6xjV0LpV4eM24.jpg', 'SSD-512GB', 'SSD-512GB', '', '31', '0', '0', 'SSD-512GB(ស្រីពៅ)', 'Sok Vitou', '2025-04-02', '1', '', '', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ00DV', '');
INSERT INTO `products` VALUES ('150', 'uploads/products/ZZMfGbFXsWaMklPDk1EZhnF02AE4COkLCKuhxF2y.jpg', 'SSD-512GB', 'SSD-512GB', '', '31', '1', '1', 'SSD-512GB(ស្រីសូនី)', 'Sok Vitou', '2025-04-02', '1', '', '', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ00CL', '');
INSERT INTO `products` VALUES ('151', 'uploads/products/AkCMrxlEuAHoQbErkFk7BTv3tw0O1zPgDS3s09Cm.jpg', 'SSD-512GB', 'SSD-512GB', '', '31', '1', '1', 'SSD-512GB(បងណុចរោងជាង)', 'Sok Vitou', '2025-04-02', '1', '', '', '2025', 'COLORFUL-SOLID-STATE-DRIVE', '0100301IPXZ00CJ', '');
INSERT INTO `products` VALUES ('152', 'uploads/products/1bkDeBTVj6NjIqwkr0jRs6Z6ZJVi00zjiENvSW1U.jpg', 'Printer color', 'Printer color', '', '19', '0', '0', 'Printer for IT Department', 'Sok Vitou', '2025-04-02', '1', '', '', '2025', 'HP-Color-Laserjet-Pro-MFP-M283fdw', 'CNBRQCW43B', 'F-OE-01313');
INSERT INTO `products` VALUES ('153', '', 'Desktop', 'Desktop', '', '17', '0', '0', 'Desktop សម្រាប់ហាក់ប៊ុនថុងមួយឆុត
Monitor (22" LED monitor Dell , CN-0326GTV-FCC00-398-AGJX)x 1

Mouse (Dell , cN-ODMV3P-CH400-43P-OD00-A01)x 1

Keyboard (Dell, CN-063Y55-LO300-442-04VR)x1

USB-wifi (TP-link, 2248049004971)x 1
Mousepad', 'Sok Vitou', '2025-04-02', '1', '', '', '2025', 'Dell-Optiplex7010', 'HCYL544', 'F-OE-01314');
INSERT INTO `products` VALUES ('154', '', 'Battery UPS', 'Battery UPS', '', '33', '2', '1', 'Battery UPS', 'Sok Vitou', '2025-04-02', '1', '', '', '2025', 'Power', '', '');

DROP TABLE IF EXISTS `section`;
CREATE TABLE `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_kh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `section_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `department_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `create_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` varchar(255) DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `section` VALUES ('7', 'រដ្ឋបាលព័ត៌មានវិទ្យា', 'IT Administrator', '2', 'Voeurn Sokheng', '2025-03-20', '1', '', '');
INSERT INTO `section` VALUES ('8', 'ជួសជុល និងថែទាំ', 'Help desk', '2', 'Voeurn Sokheng', '2025-03-20', '1', '', '');
INSERT INTO `section` VALUES ('9', 'ថែទាំម៉ាស៊ីនព្រីន និងតាមដានប្រព័ន្ធGPS', 'Maintenance Printer& GPS tracking', '2', 'Ra Mey', '2025-03-21', '1', '', '');
INSERT INTO `section` VALUES ('10', 'រចនា និងតាមដានប្រព័ន្ធGPS', 'Graphic Design & GPS tracking', '2', 'Ra Mey', '2025-03-21', '1', '', '');
INSERT INTO `section` VALUES ('11', 'អភិវឌ្ឍគេហទំព័រ', 'PHP Developer', '2', 'Ra Mey', '2025-03-21', '1', '', '');
INSERT INTO `section` VALUES ('12', 'ប្រធាននាយកដ្ឋាន', 'Director', '2', 'Voeurn Sokheng', '2025-03-25', '1', '', '');
INSERT INTO `section` VALUES ('13', 'Sale', 'Sale', '4', 'Sok Vitou', '2025-03-26', '1', '', '');
INSERT INTO `section` VALUES ('14', 'ផលិតកម្ម', 'Production', '3', 'Sok Vitou', '2025-03-27', '1', '', '');
INSERT INTO `section` VALUES ('15', 'ទីផ្សារ', 'Marketing', '6', 'Sok Vitou', '2025-03-31', '1', '', '');
INSERT INTO `section` VALUES ('16', 'WH& Logistic', 'WH& Logistic', '5', 'Sok Vitou', '2025-04-01', '1', '', '');
INSERT INTO `section` VALUES ('17', 'Designer& GPS', 'Designer& GPS', '2', 'Sok Vitou', '2025-04-02', '1', '', '');
INSERT INTO `section` VALUES ('18', 'គណនេយ្យ', 'Accounting', '7', 'Sok Vitou', '2025-04-02', '1', '', '');
INSERT INTO `section` VALUES ('19', 'លក់ទឹកកេស', 'Sale(case)', '6', 'Sok Vitou', '2025-04-05', '1', '', '');
INSERT INTO `section` VALUES ('20', 'ធនធានមនុស្ស', 'HR', '8', 'Sok Vitou', '2025-04-05', '1', '', '');
INSERT INTO `section` VALUES ('21', 'ធនធានមនុស្ស', 'HR', '8', 'Sok Vitou', '2025-04-05', '1', '', '');

DROP TABLE IF EXISTS `staff_users`;
CREATE TABLE `staff_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `card_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gender` char(255) DEFAULT NULL,
  `position` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `id_card` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phone_number` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email_address` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `staff_users` VALUES ('35', '7832', 'Male', '7', '', '093286724', 'rin.putchandarit@hitech.com.kh');
INSERT INTO `staff_users` VALUES ('36', '7263', 'Female', '6', '', '0313563168', 'sokvitou74@gmail.com');
INSERT INTO `staff_users` VALUES ('37', '7975', 'Male', '7', '', '02356895', 'ramey@gmail.com');
INSERT INTO `staff_users` VALUES ('38', '1012', 'Male', '9', '', '01245789', 'vathvuthy.admin@gmail.com');
INSERT INTO `staff_users` VALUES ('39', '7848', 'Male', '11', '', '093854961', '');
INSERT INTO `staff_users` VALUES ('40', '6996', 'Male', '12', '', '010343342', '');
INSERT INTO `staff_users` VALUES ('41', '7555', 'Female', '13', '', '0962946369', '');
INSERT INTO `staff_users` VALUES ('42', '8253', 'Male', '14', '', '081790080', '');
INSERT INTO `staff_users` VALUES ('43', '6849', 'Male', '15', '', '0964252362', '');
INSERT INTO `staff_users` VALUES ('44', '5307', 'Female', '16', '', '015212227', '');
INSERT INTO `staff_users` VALUES ('45', '7448', 'Female', '17', '', '069556615', '');
INSERT INTO `staff_users` VALUES ('46', '6832', 'Female', '17', '', '016624054', '');
INSERT INTO `staff_users` VALUES ('47', '6842', 'Female', '17', '', '0962155433', '');
INSERT INTO `staff_users` VALUES ('48', '8299', 'Female', '18', '', '093794347', '');
INSERT INTO `staff_users` VALUES ('49', '6880', 'Female', '16', '', '0964707992', '');

DROP TABLE IF EXISTS `sub_function`;
CREATE TABLE `sub_function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_function_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `name_kh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `route_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `url_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sub_function` VALUES ('1', '2', 'Product categories', 'ប្រភេទផលិតផល', 'category.list', 'category/list');
INSERT INTO `sub_function` VALUES ('2', '2', 'Departments', 'នាយកដ្ឋាន', 'department.list', 'department/list');
INSERT INTO `sub_function` VALUES ('3', '2', 'Positions', 'មុខដំណែង', 'position.list', 'position/list');
INSERT INTO `sub_function` VALUES ('4', '3', 'Instocks', 'ក្នុងស្តុក', 'product.instock', 'product/instock');
INSERT INTO `sub_function` VALUES ('5', '3', 'Outstocks', 'អស់ស្តុក', 'product.outstock', 'product/outstock');
INSERT INTO `sub_function` VALUES ('8', '4', 'New request', 'សំណើថ្មី', 'request.index', 'request/new');
INSERT INTO `sub_function` VALUES ('9', '4', 'Accepted', 'យល់ព្រមសំណើរ', 'request.accepted', 'request/accepted');
INSERT INTO `sub_function` VALUES ('10', '4', 'Rejected', 'បដិសេដសំណើ', 'request.rejected', 'request/rejected');
INSERT INTO `sub_function` VALUES ('11', '4', 'History', 'ប្រវត្តិការស្នើ', 'request.history', 'request/history');
INSERT INTO `sub_function` VALUES ('12', '5', 'Viewer', '', 'user/4/Viewer', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('13', '5', 'Operator', '', 'user/7/Operator', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('14', '5', 'User', '', 'user/1/User', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('15', '5', 'Admin', '', 'user/2/Admin', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('16', '5', 'Sub-admin', '', 'user/3/Sub-admin', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('17', '7', 'Given', 'បានផ្តល់ឱ្យ', 'product.given', 'product/givenList');
INSERT INTO `sub_function` VALUES ('18', '7', 'Returned', 'បានប្រគល់ត្រឡប់', 'product.returned', 'product/returned');
INSERT INTO `sub_function` VALUES ('19', '4', 'Return', 'សងសម្ភារៈ', 'product.viewReturn', 'request/return');
INSERT INTO `sub_function` VALUES ('20', '4', 'Overdraft', 'ខ្ចីលើសថ្ងៃ', 'product.overdraft', 'request/overdraft');
INSERT INTO `sub_function` VALUES ('21', '5', 'IT-officer', '', 'user/8/IT-officer', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('22', '5', 'Staff', '', 'user/9/Staff', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('23', '5', 'ASM', '', 'user/10/ASM', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('24', '5', 'RSM', '', 'user/11/RSM', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('25', '7', 'Add new give', 'បន្ថែមការផ្តល់ជូន', 'product.addGive', 'product/add-give');
INSERT INTO `sub_function` VALUES ('26', '8', 'Purchasing', 'កំពុងស្នើទិញ', 'purchase.index', '/pr/purchasing/list');
INSERT INTO `sub_function` VALUES ('27', '8', 'Product received', 'ទំនិញដែលបានទទួល', 'purchase.received', '/pr/received/list');
INSERT INTO `sub_function` VALUES ('28', '3', 'Statistics', 'ស្ថិតិ', 'product.statistic', 'product/statistic');
INSERT INTO `sub_function` VALUES ('29', '5', 'ជំនួយការ', '', 'user/12/ជំនួយការ', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('30', '5', 'Designer', '', 'user/13/Designer', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('31', '5', 'WH& Logistics', '', 'user/14/WH& Logistics', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('32', '5', 'Sr. IT Officer', '', 'user/15/Sr. IT Officer', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('33', '5', 'ជំនួយការគណនេយ្យ', '', 'user/16/ជំនួយការគណនេយ្យ', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('34', '5', 'DMS Officer', '', 'user/17/DMS Officer', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('35', '5', 'HR IR', '', 'user/18/HR IR', 'user/{role}/{name}');
INSERT INTO `sub_function` VALUES ('36', '5', 'Training', '', 'user/19/Training', 'user/{role}/{name}');

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `add_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_status` int(11) NOT NULL DEFAULT 1,
  `delete_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `delete_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_roles` VALUES ('2', 'Admin', 'Developer', '2025-02-26 16:25:05', '1', '', '');
INSERT INTO `user_roles` VALUES ('7', 'Operator', 'Voeurn Sokheng', '2025-02-26 14:44:03', '1', '', '');
INSERT INTO `user_roles` VALUES ('8', 'IT-officer', 'Voeurn Sokheng', '2025-03-20 17:01:10', '1', '', '');
INSERT INTO `user_roles` VALUES ('9', 'Staff', 'Sok Vitou', '2025-03-24 09:21:05', '1', '', '');
INSERT INTO `user_roles` VALUES ('10', 'ASM', 'Sok Vitou', '2025-03-26 07:43:18', '1', '', '');
INSERT INTO `user_roles` VALUES ('11', 'RSM', 'Sok Vitou', '2025-03-26 07:49:20', '1', '', '');
INSERT INTO `user_roles` VALUES ('12', 'ជំនួយការ', 'Sok Vitou', '2025-03-27 09:31:22', '1', '', '');
INSERT INTO `user_roles` VALUES ('13', 'Designer', 'Sok Vitou', '2025-03-31 12:01:43', '1', '', '');
INSERT INTO `user_roles` VALUES ('14', 'WH& Logistics', 'Sok Vitou', '2025-04-01 11:48:10', '1', '', '');
INSERT INTO `user_roles` VALUES ('15', 'Sr. IT Officer', 'Sok Vitou', '2025-04-02 15:00:49', '1', '', '');
INSERT INTO `user_roles` VALUES ('16', 'ជំនួយការគណនេយ្យ', 'Sok Vitou', '2025-04-02 15:05:18', '1', '', '');
INSERT INTO `user_roles` VALUES ('17', 'DMS Officer', 'Sok Vitou', '2025-04-05 15:53:18', '1', '', '');
INSERT INTO `user_roles` VALUES ('18', 'HR IR', 'Sok Vitou', '2025-04-05 16:29:38', '1', '', '');
INSERT INTO `user_roles` VALUES ('19', 'Training', 'Sok Vitou', '2025-04-05 16:50:57', '1', '', '');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `profile` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `card_id` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `name_kh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `block_status` int(11) NOT NULL DEFAULT 1,
  `block_date` date DEFAULT NULL,
  `block_by` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `create_by` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`),
  UNIQUE KEY `users_card_id_unique` (`card_id`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` VALUES ('184', 'uploads/users/wldox3KgUrQ6pYd5PXVPRfxRdRk9iBsrr9NUQSgT.jpg', '8381', 'វឿន សុខហេង', 'Voeurn Sokheng', 'sokheng3301', '', '$2y$12$WQAAUu4K/ZXOvB3N0xxzwelYONIfwEO1lsyH8hUD/pHYTU3NNIfOW', '2', '1', '2025-02-26', 'Voeurn Sokheng', '', '2025-02-15 01:55:17', 'Voeurn Sokheng', '');
INSERT INTO `users` VALUES ('197', 'uploads/users/Ja4jBdBvFKOkrjxAyswbY3JHeSEsklzKorBee5kD.jpg', '7832', 'រិន ពុទ្ធច័ន្ទដារិទ្ធ', 'Rin Putchandarit', 'darit1234', '', '$2y$12$xmIKlcpJ/92o6EB2i0OGM.2BzCKjgGsgd2RNjljupYCQhoBpt5Br.', '8', '1', '', '', '', '2025-03-20 17:02:19', 'Voeurn Sokheng', '');
INSERT INTO `users` VALUES ('198', '', '7263', 'សុខ វិទូ', 'Sok Vitou', 'vitou1235', '', '$2y$12$n.LSaNCBiQtgm4zjzjY8juzFzJGaAvs2vou1pGufie7K9ed2xg70.', '2', '1', '', '', '', '2025-03-20 17:04:48', 'Voeurn Sokheng', '');
INSERT INTO `users` VALUES ('199', 'uploads/users/nqEJwLFjWho0KRFpvSn2FWCJV5W7hR7UCKohcc0p.jpg', '7975', 'រ៉ា ម៉ី', 'Ra Mey', 'mey1236', '', '$2y$12$eJS1nX0OwzpHHsRvVBt0S.OWLWWYjY1EhLwe2Prcgt1/UPPrU86rC', '2', '1', '', '', '', '2025-03-20 17:05:59', 'Voeurn Sokheng', '');
INSERT INTO `users` VALUES ('200', '', '1012', 'វ៉ាត់ វុទ្ធី', 'Vath Vuthy', 'vuthy1012', '', '$2y$12$i5adyZ1zX4IPEhTri0IOUO4HvWIBh7ZcOHFVUWw5vbc9OaXh6eCZu', '2', '1', '', '', '', '2025-03-25 11:53:08', 'Voeurn Sokheng', '');
INSERT INTO `users` VALUES ('201', '', '7848', 'ឯក សេងឡុង', 'Ek Seng Long', '', '', '$2y$12$VQhBrhIVeYH0EFDl/n67duOimlx4bfzfcBv0MILbZplflF1R9E4jW', '11', '1', '', '', '', '2025-03-26 08:43:16', 'Sok Vitou', '');
-- INSERT INTO `users` VALUES ('202', ' ', '6996', 'ហាក់ ប៊ុនថុង', 'Hak Bunthong', '', '', '$2y$12$rDB3LgkHt1XM1EpOEvFRcOtLjgkJnZUMZ.4ZTxJFDf.eCQUiWgXza', '12', '1', '', '', '', '2025-03-27 09:40:00', 'Sok Vitou', '');
INSERT INTO `users` VALUES ('202', NULL, '6996', 'ហាក់ ប៊ុនថុង', 'Hak Bunthong', NULL, NULL, '$2y$12$rDB3LgkHt1XM1EpOEvFRcOtLjgkJnZUMZ.4ZTxJFDf.eCQUiWgXza', 12, 1, NULL, NULL, NULL, '2025-03-27 09:40:00', 'Sok Vitou', NULL);

-- INSERT INTO `users` VALUES ('203', ' ', '7555', 'អ៊ិន ស្រីពេជ្រ', 'Ourn Sreypich', ' ', ' ', '$2y$12$VLJK9qyfD8TaKVXgHlTFqeZLW08kJ06xR7CU3F9Fxymbw1m4VGT72', '13', '1', ' ', ' ', ' ', '2025-03-31 12:07:21', 'Sok Vitou', '');
-- INSERT INTO `users` VALUES ('204', '', '8253', 'ហាក់​ សុខា', 'Hak Sokha', '', '', '$2y$12$EG3h8hH4gosiXHH5UI6kQOvh5GxLXd04oQOFPYSZ.wqBr45qG7O46', '14', '1', '', '', '', '2025-04-01 11:52:39', 'Sok Vitou', '');
-- INSERT INTO `users` VALUES ('205', '', '6849', 'ម៉ី ម៉ានិត', 'Mey Manit', '', '', '$2y$12$Nb9JME2iCdta1qntnXEZdOtpU1EOYmVTPIp5W8qmKsIphUJldNJZu', '15', '1', '', '', '', '2025-04-02 15:02:05', 'Sok Vitou', '');
-- INSERT INTO `users` VALUES ('206', '', '5307', 'រី រដ្ឋរស្មី', 'Ri Rath Raksmey', '', '', '$2y$12$EezNxfGKW4NsH2J8qaexBO.crPcEQFnEW4DafemoM/z1paU8RCTF6', '16', '1', '', '', '', '2025-04-02 15:08:37', 'Sok Vitou', '');
-- INSERT INTO `users` VALUES ('207', '', '7448', 'សែម កែវស្រីពៅ', 'Sem Keosreypov', '', '', '$2y$12$LIo7GJ/P7mK8cV8AfLnTuulxRIP/Aaw37HvVgaTQBLzS0499wVHjO', '17', '1', '', '', '', '2025-04-05 15:58:53', 'Sok Vitou', '');
-- INSERT INTO `users` VALUES ('208', '', '6832', 'ប៊ុនធឿន ចាន់តី', 'Bunthoeun Chanthei', '', '', '$2y$12$WmDA14vmCdW/OLE9CPeIKuuE9.OPf0VY/JpKlgttzkx7TusuzTWkW', '17', '1', '', '', '', '2025-04-05 16:00:22', 'Sok Vitou', '');
-- INSERT INTO `users` VALUES ('209', '', '6842', 'ថា​ ណាល័យ', 'Tha Nalay', '', '', '$2y$12$bq0orbit38SThPIvdPLoLeu97umW0NYn./E0cGT9LNa3tIXoKWMki', '17', '1', '', '', '', '2025-04-05 16:01:44', 'Sok Vitou', '');
-- INSERT INTO `users` VALUES ('210', '', '8299', 'ចាន់​ គឹមលាង', 'Chan Kimleang', '', '', '$2y$12$55H1gtqGzFpVzhASaslCPerOAJYjTOsumH8cxeBhrksgQnKSK1Mti', '18', '1', '', '', '', '2025-04-05 16:31:11', 'Sok Vitou', '');
-- INSERT INTO `users` VALUES ('211', '', '6880', 'ឃួន អ៊ីណា', 'Khoun Aina', '', '', '$2y$12$MAb9geUYRBqV.WcPSRYLwe9mvzIQ3c1VeZXLDIHw.2twz6/YDsNVi', '16', '1', '', '', '', '2025-04-05 16:38:30', 'Sok Vitou', '');
INSERT INTO `users` VALUES 
('203', NULL, '7555', 'អ៊ិន ស្រីពេជ្រ', 'Ourn Sreypich', NULL, NULL, '$2y$12$VLJK9qyfD8TaKVXgHlTFqeZLW08kJ06xR7CU3F9Fxymbw1m4VGT72', '13', '1', NULL, NULL, NULL, '2025-03-31 12:07:21', 'Sok Vitou', ''),
('204', NULL, '8253', 'ហាក់​ សុខា', 'Hak Sokha', NULL, NULL, '$2y$12$EG3h8hH4gosiXHH5UI6kQOvh5GxLXd04oQOFPYSZ.wqBr45qG7O46', '14', '1', NULL, NULL, NULL, '2025-04-01 11:52:39', 'Sok Vitou', ''),
('205', NULL, '6849', 'ម៉ី ម៉ានិត', 'Mey Manit', NULL, NULL, '$2y$12$Nb9JME2iCdta1qntnXEZdOtpU1EOYmVTPIp5W8qmKsIphUJldNJZu', '15', '1', NULL, NULL, NULL, '2025-04-02 15:02:05', 'Sok Vitou', ''),
('206', NULL, '5307', 'រី រដ្ឋរស្មី', 'Ri Rath Raksmey', NULL, NULL, '$2y$12$EezNxfGKW4NsH2J8qaexBO.crPcEQFnEW4DafemoM/z1paU8RCTF6', '16', '1', NULL, NULL, NULL, '2025-04-02 15:08:37', 'Sok Vitou', ''),
('207', NULL, '7448', 'សែម កែវស្រីពៅ', 'Sem Keosreypov', NULL, NULL, '$2y$12$LIo7GJ/P7mK8cV8AfLnTuulxRIP/Aaw37HvVgaTQBLzS0499wVHjO', '17', '1', NULL, NULL, NULL, '2025-04-05 15:58:53', 'Sok Vitou', ''),
('208', NULL, '6832', 'ប៊ុនធឿន ចាន់តី', 'Bunthoeun Chanthei', NULL, NULL, '$2y$12$WmDA14vmCdW/OLE9CPeIKuuE9.OPf0VY/JpKlgttzkx7TusuzTWkW', '17', '1', NULL, NULL, NULL, '2025-04-05 16:00:22', 'Sok Vitou', ''),
('209', NULL, '6842', 'ថា​ ណាល័យ', 'Tha Nalay', NULL, NULL, '$2y$12$bq0orbit38SThPIvdPLoLeu97umW0NYn./E0cGT9LNa3tIXoKWMki', '17', '1', NULL, NULL, NULL, '2025-04-05 16:01:44', 'Sok Vitou', ''),
('210', NULL, '8299', 'ចាន់​ គឹមលាង', 'Chan Kimleang', NULL, NULL, '$2y$12$55H1gtqGzFpVzhASaslCPerOAJYjTOsumH8cxeBhrksgQnKSK1Mti', '18', '1', NULL, NULL, NULL, '2025-04-05 16:31:11', 'Sok Vitou', ''),
('211', NULL, '6880', 'ឃួន អ៊ីណា', 'Khoun Aina', NULL, NULL, '$2y$12$MAb9geUYRBqV.WcPSRYLwe9mvzIQ3c1VeZXLDIHw.2twz6/YDsNVi', '16', '1', NULL, NULL, NULL, '2025-04-05 16:38:30', 'Sok Vitou', '');

DROP TABLE IF EXISTS `year`;
CREATE TABLE `year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `year` VALUES ('1', '2025');

