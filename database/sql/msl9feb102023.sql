-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for msl9
DROP DATABASE IF EXISTS `msl9`;
CREATE DATABASE IF NOT EXISTS `msl9` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `msl9`;

-- Dumping structure for table msl9.activity_log
DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=331 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.activity_log: ~24 rows (approximately)
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
REPLACE INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
	(305, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2022-11-07 10:54:16', '2022-11-07 10:54:16'),
	(306, 'default', 'updated', 'App\\Models\\User', 'updated', '97a3a713-7f2e-4d5c-ab64-5429b703c99d', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "STAF STAF", "text": null}, "attributes": {"name": "STAF STAF", "text": null}}', NULL, '2022-11-07 18:03:27', '2022-11-07 18:03:27'),
	(307, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2022-11-10 12:13:40', '2022-11-10 12:13:40'),
	(308, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2022-11-29 06:24:21', '2022-11-29 06:24:21'),
	(309, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2022-11-30 07:16:42', '2022-11-30 07:16:42'),
	(310, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2022-11-30 07:20:47', '2022-11-30 07:20:47'),
	(311, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2022-11-30 07:26:04', '2022-11-30 07:26:04'),
	(312, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2022-12-01 06:06:12', '2022-12-01 06:06:12'),
	(313, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2022-12-07 13:57:19', '2022-12-07 13:57:19'),
	(314, 'default', 'deleted', 'App\\Models\\User', 'deleted', '976b760d-bbf5-426f-8d7a-8105e183dfb7', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "MOHD IZZAT", "text": null}}', NULL, '2023-01-05 09:50:42', '2023-01-05 09:50:42'),
	(315, 'default', 'updated', 'App\\Models\\User', 'updated', '97a3a713-7f2e-4d5c-ab64-5429b703c99d', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "STAF STAF", "text": null}, "attributes": {"name": "STAF STAF", "text": null}}', NULL, '2023-01-05 09:51:32', '2023-01-05 09:51:32'),
	(316, 'default', 'created', 'App\\Models\\User', 'created', '0', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"attributes": {"name": "ALI PROJECT MANAGER", "text": null}}', NULL, '2023-01-12 09:18:10', '2023-01-12 09:18:10'),
	(317, 'default', 'created', 'App\\Models\\User', 'created', '0', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"attributes": {"name": "ALI PROJECT MANAGER", "text": null}}', NULL, '2023-01-12 09:19:00', '2023-01-12 09:19:00'),
	(318, 'default', 'created', 'App\\Models\\Profile', 'created', '101', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"attributes": {"name": "ALI PROJECT MANAGER", "text": null}}', NULL, '2023-01-12 09:19:00', '2023-01-12 09:19:00'),
	(319, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2023-01-14 05:27:24', '2023-01-14 05:27:24'),
	(320, 'default', 'updated', 'App\\Models\\Profile', 'updated', '7', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2023-01-14 05:27:24', '2023-01-14 05:27:24'),
	(321, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2023-01-14 05:32:35', '2023-01-14 05:32:35'),
	(322, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2023-01-14 05:34:49', '2023-01-14 05:34:49'),
	(323, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2023-01-14 05:36:52', '2023-01-14 05:36:52'),
	(324, 'default', 'updated', 'App\\Models\\User', 'updated', '98348f8b-5fc2-47e8-b966-d5118bf38865', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ALI PROJECT MANAGER", "text": null}, "attributes": {"name": "ALI PROJECT MANAGER", "text": null}}', NULL, '2023-01-25 02:39:27', '2023-01-25 02:39:27'),
	(325, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2023-02-09 03:58:33', '2023-02-09 03:58:33'),
	(326, 'default', 'updated', 'App\\Models\\User', 'updated', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"old": {"name": "ADMIN@ADMIN", "text": null}, "attributes": {"name": "ADMIN@ADMIN", "text": null}}', NULL, '2023-02-09 03:58:49', '2023-02-09 03:58:49'),
	(329, 'default', 'created', 'App\\Models\\User', 'created', '0', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"attributes": {"name": "AHMAD SUFI BIN ABDUL HAMID1", "text": null}}', NULL, '2023-02-10 02:50:17', '2023-02-10 02:50:17'),
	(330, 'default', 'created', 'App\\Models\\User', 'created', '0', 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8', '{"attributes": {"name": "AHMAD SUFI BIN ABDUL HAMID1", "text": null}}', NULL, '2023-02-10 02:55:20', '2023-02-10 02:55:20');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;

-- Dumping structure for table msl9.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.migrations: ~63 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2022_12_01_060947_create_activity_log_table', 0),
	(2, '2022_12_01_060947_create_models_table', 0),
	(3, '2022_12_01_060947_create_model_has_permissions_table', 0),
	(4, '2022_12_01_060947_create_model_has_roles_table', 0),
	(5, '2022_12_01_060947_create_password_resets_table', 0),
	(6, '2022_12_01_060947_create_permissions_table', 0),
	(7, '2022_12_01_060947_create_profiles_table', 0),
	(8, '2022_12_01_060947_create_projects_table', 0),
	(9, '2022_12_01_060947_create_roles_table', 0),
	(10, '2022_12_01_060947_create_role_has_permissions_table', 0),
	(11, '2022_12_01_060947_create_sites_table', 0),
	(12, '2022_12_01_060947_create_users_table', 0),
	(13, '2022_12_01_060947_create_user_login_histories_table', 0),
	(14, '2022_12_01_060948_add_foreign_keys_to_model_has_permissions_table', 0),
	(15, '2022_12_01_060948_add_foreign_keys_to_model_has_roles_table', 0),
	(16, '2022_12_01_060948_add_foreign_keys_to_role_has_permissions_table', 0),
	(17, '2022_12_07_094041_create_activity_log_table', 1),
	(18, '2022_12_07_094041_create_models_table', 1),
	(19, '2022_12_07_094041_create_model_has_permissions_table', 1),
	(20, '2022_12_07_094041_create_model_has_roles_table', 1),
	(21, '2022_12_07_094041_create_permissions_table', 1),
	(22, '2022_12_07_094041_create_profiles_table', 1),
	(23, '2022_12_07_094041_create_projects_table', 1),
	(24, '2022_12_07_094041_create_roles_table', 1),
	(25, '2022_12_07_094041_create_role_has_permissions_table', 1),
	(26, '2022_12_07_094041_create_users_table', 1),
	(27, '2022_12_07_094041_create_user_login_histories_table', 1),
	(28, '2022_12_07_094042_add_foreign_keys_to_model_has_permissions_table', 1),
	(29, '2022_12_07_094042_add_foreign_keys_to_model_has_roles_table', 1),
	(30, '2022_12_07_094042_add_foreign_keys_to_role_has_permissions_table', 1),
	(31, '2023_01_09_040100_create_activity_log_table', 0),
	(32, '2023_01_09_040100_create_model_has_permissions_table', 0),
	(33, '2023_01_09_040100_create_model_has_roles_table', 0),
	(34, '2023_01_09_040100_create_permissions_table', 0),
	(35, '2023_01_09_040100_create_profiles_table', 0),
	(36, '2023_01_09_040100_create_projects_table', 0),
	(37, '2023_01_09_040100_create_project_user_table', 0),
	(38, '2023_01_09_040100_create_roles_table', 0),
	(39, '2023_01_09_040100_create_role_has_permissions_table', 0),
	(40, '2023_01_09_040100_create_tasks_table', 0),
	(41, '2023_01_09_040100_create_users_table', 0),
	(42, '2023_01_09_040100_create_user_login_histories_table', 0),
	(43, '2023_01_09_040101_add_foreign_keys_to_model_has_permissions_table', 0),
	(44, '2023_01_09_040101_add_foreign_keys_to_model_has_roles_table', 0),
	(45, '2023_01_09_040101_add_foreign_keys_to_role_has_permissions_table', 0),
	(46, '2023_01_12_090252_create_activity_log_table', 0),
	(47, '2023_01_12_090252_create_model_has_permissions_table', 0),
	(48, '2023_01_12_090252_create_model_has_roles_table', 0),
	(49, '2023_01_12_090252_create_permissions_table', 0),
	(50, '2023_01_12_090252_create_profiles_table', 0),
	(51, '2023_01_12_090252_create_projects_table', 0),
	(52, '2023_01_12_090252_create_project_user_table', 0),
	(53, '2023_01_12_090252_create_resources_table', 0),
	(54, '2023_01_12_090252_create_roles_table', 0),
	(55, '2023_01_12_090252_create_role_has_permissions_table', 0),
	(56, '2023_01_12_090252_create_tasks_table', 0),
	(57, '2023_01_12_090252_create_task_user_table', 0),
	(58, '2023_01_12_090252_create_users_table', 0),
	(59, '2023_01_12_090252_create_user_login_histories_table', 0),
	(60, '2023_01_12_090253_add_foreign_keys_to_model_has_permissions_table', 0),
	(61, '2023_01_12_090253_add_foreign_keys_to_model_has_roles_table', 0),
	(62, '2023_01_12_090253_add_foreign_keys_to_role_has_permissions_table', 0),
	(63, '2019_12_14_000001_create_personal_access_tokens_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table msl9.model_has_permissions
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table msl9.model_has_roles
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.model_has_roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
REPLACE INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(7, 'App\\Models\\User', '0'),
	(7, 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8'),
	(8, 'App\\Models\\User', '976cf75e-138f-4ccb-bf3f-0ba528e712e8');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table msl9.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.permissions: ~5 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
REPLACE INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(3, 'project-create', 'web', '2023-01-11 08:46:35', '2023-01-11 08:46:35'),
	(4, 'project-read', 'web', '2023-01-11 08:46:52', '2023-01-11 08:46:52'),
	(5, 'project-update', 'web', '2023-01-11 08:47:06', '2023-01-11 08:47:06'),
	(6, 'project-delete', 'web', '2023-01-11 08:47:19', '2023-01-11 08:47:19'),
	(7, 'superadmin-all', 'web', '2023-01-14 05:24:49', '2023-01-14 05:24:49');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table msl9.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table msl9.profiles
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) DEFAULT NULL,
  `name` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `no_ic` varchar(225) DEFAULT NULL,
  `t_lahir` date DEFAULT NULL,
  `jantina` varchar(225) DEFAULT NULL,
  `no_phone` varchar(225) DEFAULT NULL,
  `acc_status` varchar(15) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

-- Dumping data for table msl9.profiles: ~14 rows (approximately)
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
REPLACE INTO `profiles` (`id`, `user_id`, `name`, `email`, `no_ic`, `t_lahir`, `jantina`, `no_phone`, `acc_status`, `created_by`, `created_at`, `updated_at`) VALUES
	(3, '97616091-48a7-4191-a385-f9fb5b3a76cc', 'AHMAD SUFI BIN ABDUL HAMID', 'sufi@admin.my', '11111', '2009-11-12', 'Lelaki', '1231231231', '0', NULL, '2022-09-29 17:47:58', '2022-10-20 09:59:24'),
	(4, '976af75a-c082-442b-91b4-09e31af785d4', 'NURUL QAMARINA', 'akkk@gmail.com', '676754545423', '2009-12-30', 'Lelaki', '1612314444', 'Tidak Aktif', NULL, '2022-10-04 12:12:06', '2022-10-17 18:06:47'),
	(6, '976b760d-bbf5-426f-8d7a-8105e183dfb7', 'MOHD IZZAT', 'zaman@army.mil.my', '565656353434', '2009-10-01', 'Lelaki', '1233322333', 'Tidak Aktif', NULL, '2022-10-04 18:06:19', '2022-10-13 16:26:13'),
	(7, '976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'ADMIN@ADMIN', 'admin@gmail.com', '213123123133', '2002-12-09', 'Perempuan', '119989999', 'Inactive', NULL, '2022-10-05 04:04:00', '2023-01-14 05:27:24'),
	(13, '9779965c-3a6f-4e57-bbf2-17980fb4c9d7', 'AISHAH', 'afla@army.net', '676754666666', '2009-11-11', 'Lelaki', '4746864946', 'Tidak Aktif', NULL, '2022-10-11 10:38:15', '2022-10-17 15:09:15'),
	(14, '977d631f-27af-41e2-b566-a0ba8e03419d', 'SYAMIM BIN ABU', 'syamim@army.mil.my', '788536346626', '2009-12-01', 'Lelaki', '1231241413', 'Tidak Aktif', NULL, '2022-10-13 15:58:17', '2022-10-20 21:43:23'),
	(15, '97879e77-4b4d-43df-b35b-56558670ca1a', 'ALI RAHMAN BIN BUDIN', 'alirahman@army.mil.my', '556262525252', '2006-02-01', 'Perempuan', '15355135', 'Tidak Aktif', NULL, '2022-10-18 18:02:30', '2022-10-18 18:02:30'),
	(16, '978bdc4f-f7d3-479c-9be0-2abafe500d8c', 'NAZRI HASSAN BIN AHMAD', 'nazrihassan@gmail.com', '445544322212', '1996-01-01', 'Lelaki', '1253351513', 'Tidak Aktif', NULL, '2022-10-20 20:38:46', '2022-10-20 20:38:46'),
	(17, '979b7817-2c14-40a7-86b4-7b45ef7ce9f4', 'AFAN BIN MUHAMMAD', 'afan@gmail.com', '992515321342', '2009-06-01', 'Lelaki', '0132341242', 'Tidak Aktif', NULL, '2022-10-28 14:51:45', '2022-10-28 14:51:45'),
	(18, '97a11e77-de0f-402e-8398-9a3f00c067ae', 'AFIQ BIN ABDUL HAMID', 'afiq1233@gmail.com', '123412342323', '1991-03-01', 'Lelaki', '01378967833', 'Tidak Aktif', NULL, '2022-10-31 10:16:08', '2022-10-31 10:16:08'),
	(98, '97a34ed7-8eff-4f29-b827-ec1f95db7f4c', '211DAGSDGSDG', 'asdasd@gmail.com', '135135135135', '2010-01-01', 'Lelaki', '01241123124', 'Tidak Aktif', NULL, '2022-11-01 12:23:02', '2022-11-01 12:23:02'),
	(99, '97a3a713-7f2e-4d5c-ab64-5429b703c99d', 'STAF STAF', 'stafstaf@gmail.com', '134135135135', '2009-12-30', 'Lelaki', '01234939325', 'Tidak Aktif', NULL, '2022-11-01 16:29:45', '2022-11-04 10:26:51'),
	(100, '97a3a765-eee1-4f53-a6dc-17566962c322', 'STAF AKTIF', 'stafaktif@gmail.com', '624622314141', '2009-12-30', 'Lelaki', '15135315135', 'Aktif', NULL, '2022-11-01 16:30:39', '2022-11-01 16:30:39'),
	(101, '98348f8b-5fc2-47e8-b966-d5118bf38865', 'ALI PROJECT MANAGER', 'ali@gmail.com', NULL, NULL, NULL, '0125576964', 'Active', NULL, '2023-01-12 09:19:00', '2023-01-12 09:19:00');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;

-- Dumping structure for table msl9.projects
DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_leader` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_budget` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spent_budget` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.projects: ~30 rows (approximately)
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
REPLACE INTO `projects` (`id`, `name`, `description`, `status`, `client_company`, `project_leader`, `estimated_budget`, `spent_budget`, `project_duration`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 'Pembangunan Siap Guna Sistem Perakaunan Dan Kewangan Berasaskan Standard Accounting System For Government Agency (SAGA)', 'To migrate current data centre to new location.', 'Success', 'Nestle', 'Saiful', '1000', '999', '20', '2021-12-02', '2023-12-01', '2022-01-14 11:31:33', '2022-04-25 12:21:24', NULL),
	(7, 'Data Centre Migration', 'To migrate current data centre to new location.', 'Ongoing', 'Disney', 'Mazlan', '10000', '9999', '30', '2022-02-01', '2022-02-23', '2022-02-14 19:38:23', '2022-12-08 03:00:13', '2022-12-08 03:00:13'),
	(9, 'Contract The Appointment of Broadband Fiberisation (BBF) Partner - Northern', 'To migrate current data centre to new location.', 'On Hold', 'SPACEX', 'Zahid Hamidi', '50000', '45000', '100', '2020-01-01', '2021-06-30', '2022-04-25 13:15:37', '2022-12-09 04:10:37', NULL),
	(11, 'Data Centre Migration Alpha', 'Sed quis nam id quis. Praesentium eum ut blanditiis magni laborum itaque. Molestiae quam commodi rem dolorem et quia vel. Aut est laborum qui quam dolor.', 'Success', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:16:04', '2022-11-30 09:16:04', NULL),
	(12, 'Data Centre Migration Beta', 'Ab et nesciunt quae ipsa aut. Qui id aut vel expedita est est. Voluptatem enim laudantium aut earum aut eos et.', 'Success', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:16:04', '2022-11-30 09:16:04', NULL),
	(13, 'Data Centre Migration KL', 'Commodi odio sapiente aut id quam tenetur. Est voluptas ipsum omnis laudantium quia. Doloribus et aut officia beatae voluptatibus accusamus in.', 'Success', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:16:04', '2022-11-30 09:16:04', NULL),
	(15, 'Contract supply Gamma', 'At non unde adipisci numquam voluptates et explicabo. Earum possimus rerum voluptatem rerum ut vero. Rem autem molestiae quis eum. Sed ut quasi dignissimos corrupti.', 'Success', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2023-01-18 08:32:50', '2023-01-18 08:32:50'),
	(16, 'Contract supply Alpha', 'Corrupti nostrum sunt maiores error non autem. Omnis dolor quaerat nam. Repellendus sint eveniet sunt a et. Omnis nam omnis eos.', 'Success', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(17, 'Contract supply Beta', 'Aut facilis ut placeat est repellendus error exercitationem. Minus qui atque facilis iste cumque reiciendis ad. Voluptatibus minima aut porro consequatur recusandae et voluptatem aut.', 'Success', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-12-08 03:05:11', '2022-12-08 03:05:11'),
	(18, 'TEGAS supply', 'Nam a ullam nemo quas aspernatur. Est corrupti at quis et est repellat. Ullam deserunt et quaerat vel quod autem consequuntur.', 'Success', 'TEGAS', 'Jeremiah', NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(19, 'KKM supply', 'Dolore ipsam exercitationem natus labore provident assumenda. Provident aut consectetur dolore amet voluptate pariatur ut.', 'On-hold', 'KKM', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(20, 'MITI supply', 'Beatae maxime provident quod. Ad dolor eius explicabo provident deleniti vitae. Alias rerum qui voluptas amet accusamus praesentium illum.', 'On-hold', 'MITI', 'Emi', NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(21, 'Maintainance infra Celcom', 'Optio voluptatum eos velit est ut. Dolorem ab eum tenetur et laboriosam. Non temporibus nemo rerum qui ea tempore. Aperiam beatae id non nam accusantium aut a.', 'On-hold', 'CELCOM', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(22, 'Telco maintainance', 'Unde ut incidunt et voluptate iusto praesentium. Enim recusandae alias repudiandae excepturi assumenda. Laboriosam asperiores laborum ea magnam iure.', 'On-hold', 'CELCOM', 'Aidil', NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(23, 'Telco Training', 'Qui mollitia consectetur in et esse est est. Eum qui modi harum veritatis. Placeat ea consequuntur et aut. Et at velit ut molestias est.', 'On-hold', 'CELCOM', 'Jonathan', NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(24, 'Maintainance Cabel', 'Vitae iure nobis architecto est minima quis qui. Omnis repudiandae ex rerum omnis quis enim. Eum quia et minima. Ipsam rerum non optio nemo laboriosam est repellat.', 'On-hold', 'DIGI', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(25, 'Maintainance Lift', 'Voluptatem quis quia doloribus nesciunt numquam voluptates. Totam error aut doloremque deserunt eos illo.', 'On-hold', 'MATRADE', 'Wee', NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(26, 'Project Innovate', 'Alias ut dignissimos nobis natus dolorem laudantium eligendi. Culpa asperiores sint eos velit doloremque mollitia. Voluptatum et vero maxime aut recusandae.', NULL, 'MITI', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(27, 'Supply cabel', 'Sit ab ut deleniti quo laudantium. Dicta molestiae itaque ducimus numquam qui nisi quo. Qui possimus autem cum. Ut et voluptas sit iusto.', NULL, NULL, 'Aina', NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(28, 'Restructure network', 'Vitae placeat fuga et quos temporibus et quisquam suscipit. Ut nulla magni ut non aut voluptate. Labore nihil ut quia amet consectetur deleniti.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(29, 'Project training', 'Et possimus quibusdam beatae voluptas aut incidunt. Eius minima modi hic molestias unde deserunt qui. Quod dolorem quas perspiciatis quo quis quae et non.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(30, 'Event Launching', 'In non rerum voluptate dicta labore explicabo repudiandae. Autem est harum vel a magnam. Dolorem consequatur ad occaecati. Nostrum rerum voluptatem officia.', NULL, NULL, 'Shaun', NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(32, 'Hardware Supply', 'Nulla sit ea dignissimos itaque. Sit quis voluptatum aut in modi rem sunt rerum. Autem quidem ratione et perspiciatis non sit ea. Quia et accusamus sed accusantium velit quidem.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(33, 'Software training', 'Omnis labore quis magni maxime in repellendus. Sequi doloremque ipsam molestias voluptas. Assumenda sit quo in veritatis.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:20:27', '2022-11-30 09:20:27', NULL),
	(35, 'project Telco', 'Corrupti nostrum sunt maiores error non autem. Omnis dolor quaerat nam. Repellendus sint eveniet sunt a et. Omnis nam omnis eos.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:44:19', '2022-11-30 09:44:19', NULL),
	(36, 'project Alpha', 'Corrupti nostrum sunt maiores error non autem. Omnis dolor quaerat nam. Repellendus sint eveniet sunt a et. Omnis nam omnis eos.', NULL, NULL, 'Manap', NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:44:43', '2022-11-30 09:44:43', NULL),
	(37, 'project Z', 'Corrupti nostrum sunt maiores error non autem. Omnis dolor quaerat nam. Repellendus sint eveniet sunt a et. Omnis nam omnis eos.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:45:25', '2022-11-30 09:45:25', NULL),
	(38, 'project X', 'Quis deserunt corrupti officiis consectetur. Rerum soluta pariatur dolorem sed tempora non temporibus sit. Labore minima quam placeat accusantium. Non qui illo ipsam aliquid.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-30 09:51:44', '2022-11-30 09:51:44', NULL),
	(39, 'project Beta', 'Nulla sit ea dignissimos itaque. Sit quis voluptatum aut in modi rem sunt rerum. Autem quidem ratione et perspiciatis non sit ea. Quia et accusamus sed accusantium velit quidem.', 'On Going', NULL, 'Akhil', '10000000', '232333', '23', NULL, NULL, '2022-11-30 09:54:50', '2022-11-30 09:54:50', NULL),
	(42, 'project many to many', 'ddd ddd ddd ddd ddd ddd', 'On Hold', 'SPACEX', 'Sufi', '12', '123', '1234', NULL, NULL, '2023-01-09 03:55:06', '2023-01-09 03:55:06', NULL);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;

-- Dumping structure for table msl9.project_resource
DROP TABLE IF EXISTS `project_resource`;
CREATE TABLE IF NOT EXISTS `project_resource` (
  `project_id` bigint(20) unsigned NOT NULL,
  `resource_id` bigint(20) unsigned NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.project_resource: ~5 rows (approximately)
/*!40000 ALTER TABLE `project_resource` DISABLE KEYS */;
REPLACE INTO `project_resource` (`project_id`, `resource_id`, `start_time`, `end_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(30, 2, NULL, NULL, '2023-01-17 04:20:28', '2023-01-17 04:20:28', NULL),
	(29, 1, NULL, NULL, '2023-01-17 04:52:34', '2023-01-17 04:52:34', NULL),
	(18, 1, NULL, NULL, '2023-01-17 06:49:59', '2023-01-17 06:49:59', NULL),
	(27, 1, NULL, NULL, '2023-01-18 02:43:48', '2023-01-18 02:43:48', NULL),
	(27, 2, NULL, NULL, '2023-01-25 02:36:55', '2023-01-25 02:36:55', NULL);
/*!40000 ALTER TABLE `project_resource` ENABLE KEYS */;

-- Dumping structure for table msl9.project_user
DROP TABLE IF EXISTS `project_user`;
CREATE TABLE IF NOT EXISTS `project_user` (
  `user_id` varchar(36) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table msl9.project_user: ~4 rows (approximately)
/*!40000 ALTER TABLE `project_user` DISABLE KEYS */;
REPLACE INTO `project_user` (`user_id`, `project_id`) VALUES
	('97616091-48a7-4191-a385-f9fb5b3a76cc', 42),
	('976cf75e-138f-4ccb-bf3f-0ba528e712e8', 42),
	('977d631f-27af-41e2-b566-a0ba8e03419d', 42),
	('976cf75e-138f-4ccb-bf3f-0ba528e712e8', 12);
/*!40000 ALTER TABLE `project_user` ENABLE KEYS */;

-- Dumping structure for table msl9.resources
DROP TABLE IF EXISTS `resources`;
CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `location` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `availability` varchar(255) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `mainenance_schedule` date DEFAULT NULL,
  `cost` decimal(20,6) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `manual_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table msl9.resources: ~2 rows (approximately)
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
REPLACE INTO `resources` (`id`, `type`, `name`, `description`, `location`, `quantity`, `availability`, `assigned_to`, `mainenance_schedule`, `cost`, `image`, `manual_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, NULL, 'cars BMW 3', 'for VIP3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-14 14:36:53', '2023-01-17 06:49:59', NULL),
	(2, NULL, 'cars Mercedes', 'company', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-17 04:20:28', '2023-01-17 04:20:28', NULL);
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;

-- Dumping structure for table msl9.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
REPLACE INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(7, 'PROJECT MANAGER', 'web', '2023-01-11 08:47:56', '2023-01-11 08:48:13'),
	(8, 'superadmin', 'web', '2023-01-14 05:25:32', '2023-01-14 05:25:32');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table msl9.role_has_permissions
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.role_has_permissions: ~5 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
REPLACE INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(3, 7),
	(4, 7),
	(5, 7),
	(6, 7),
	(7, 8);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table msl9.tasks
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.tasks: ~5 rows (approximately)
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
REPLACE INTO `tasks` (`id`, `project_id`, `parent_id`, `name`, `description`, `status`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, NULL, NULL, 'task A', 'monthly maintainance', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, NULL, NULL, 'task kickoff project Z', 'ini ialah description task kickoff project Z', 'ongoing', '2023-01-30 00:00:00', NULL, '2023-01-09 10:01:19', '2023-01-09 10:01:19', NULL),
	(5, 9, NULL, 'task kickoff project TEGAS 1', 'ini ialah description task project TEGAS', 'ongoing', NULL, NULL, '2023-01-11 03:20:57', '2023-01-11 03:20:57', NULL),
	(6, 18, NULL, 'task kickoff project TEGAS', 'ini ialah description task project TEGAS', 'ongoing', NULL, NULL, '2023-01-11 03:22:08', '2023-01-11 03:22:08', NULL),
	(7, 19, 7, 'Meeting Project A', 'Meeting Project A description', 'Completed', NULL, NULL, '2023-02-09 06:55:49', '2023-02-09 07:05:59', NULL);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;

-- Dumping structure for table msl9.task_user
DROP TABLE IF EXISTS `task_user`;
CREATE TABLE IF NOT EXISTS `task_user` (
  `user_id` varchar(36) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table msl9.task_user: ~4 rows (approximately)
/*!40000 ALTER TABLE `task_user` DISABLE KEYS */;
REPLACE INTO `task_user` (`user_id`, `task_id`) VALUES
	('976cf75e-138f-4ccb-bf3f-0ba528e712e8', 4),
	('976cf75e-138f-4ccb-bf3f-0ba528e712e8', 5),
	('976cf75e-138f-4ccb-bf3f-0ba528e712e8', 6),
	('976cf75e-138f-4ccb-bf3f-0ba528e712e8', 7);
/*!40000 ALTER TABLE `task_user` ENABLE KEYS */;

-- Dumping structure for table msl9.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `last_login` timestamp NULL DEFAULT NULL,
  `status_id` int(11) DEFAULT '0',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `user_id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.users: ~16 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `acc_status`, `last_login`, `status_id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	('12345', 'AHMAD SUFI BIN ABDUL HAMID1', 'Inactive', NULL, 0, 'sufi1@admin.my', NULL, NULL, NULL, '2023-02-10 02:55:20', '2023-02-10 02:55:20', NULL),
	('97616091-48a7-4191-a385-f9fb5b3a76cc', 'AHMAD SUFI BIN ABDUL HAMID', 'Active', '2022-10-20 09:59:48', 0, 'sufi@admin.my', NULL, '$2y$10$JQjoJmmQKEVS7q637sprnOkccAtp19doSZFtD7ngZCWaVAmFZ5ooy', NULL, '2022-09-29 17:47:57', '2022-10-20 09:59:48', NULL),
	('976af75a-c082-442b-91b4-09e31af785d4', 'NURUL QAMARINA', 'Active', '2022-10-13 16:26:43', 0, 'akkk@gmail.com', NULL, '$2y$10$QO1hAoWyy4buVCh4U8wgpeQXnC9T2tDMru5Df1H7/Au.wati7IAIy', NULL, '2022-10-04 12:12:02', '2022-10-20 15:48:34', '2022-10-20 15:48:34'),
	('976b760d-bbf5-426f-8d7a-8105e183dfb7', 'MOHD IZZAT', 'Active', '2022-10-13 16:26:31', 0, 'zaman@army.mil.my', NULL, '$2y$10$yND7AJr12XfNxEOIS6yyl.tKH9sVNQsph.H5.6Fy0Dg7E0PlsCeuO', NULL, '2022-10-04 18:06:19', '2023-01-05 09:50:42', '2023-01-05 09:50:42'),
	('976cf75e-138f-4ccb-bf3f-0ba528e712e8', 'ADMIN@ADMIN', 'Active', '2022-10-26 17:37:39', 0, 'admin@gmail.com', '2023-02-09 03:58:49', '$2y$10$RlCjbaZD1MbbG0JdWH5KP.PC3WHMiO.uDNTnWYLBerePOjkEd.a.S', 'yhiYwx5WErC2S2fA6lCT4swNadct8W0DDHpxDesjLXBqNQGB4DwX4NRHnJGk', '2022-10-05 04:03:44', '2023-02-09 03:58:49', NULL),
	('9779965c-3a6f-4e57-bbf2-17980fb4c9d7', 'AISHAH', 'Active', '2022-10-13 16:26:43', 0, 'afla@army.net', NULL, '$2y$10$7AfX1o2hFLPzLr245OSY7.y5lMQRhie/Dm9zBIPRDFoAsWYqWCuki', NULL, '2022-10-11 10:38:14', '2022-10-20 15:37:56', '2022-10-20 15:37:56'),
	('977d631f-27af-41e2-b566-a0ba8e03419d', 'SYAMIM BIN ABU', 'Active', '2022-10-13 16:08:59', 0, 'syamim@army.mil.my', NULL, '$2y$10$5J1phT.UzAfuTUkDm6xeiuWtbMWIEQOt8qyRYnkghtpR/b4levndm', NULL, '2022-10-13 15:58:17', '2022-10-27 14:40:00', NULL),
	('97879e77-4b4d-43df-b35b-56558670ca1a', 'ALI RAHMAN BIN BUDIN', 'Inactive', '2022-10-18 18:02:30', 0, 'alirahman@army.mil.my', NULL, '$2y$10$ojtJ.aVDtrdRnBcVX6.sG.JSMnb8R5C5oUS2NScCdCK8aDq6bjU/K', NULL, '2022-10-18 18:02:30', '2022-10-26 12:20:00', '2022-10-26 12:20:00'),
	('978bdc4f-f7d3-479c-9be0-2abafe500d8c', 'NAZRI HASSAN BIN AHMAD', 'Inactive', '2022-10-20 20:38:45', 0, 'nazrihassan@gmail.com', NULL, '$2y$10$8D9pYsyJXz5UdKvFxPlq8uPmfEx2z1Gq.G.tFW9f0Nu1MRelTxnYK', NULL, '2022-10-20 20:38:45', '2022-10-26 12:29:44', '2022-10-26 12:29:44'),
	('979b7817-2c14-40a7-86b4-7b45ef7ce9f4', 'AFAN BIN MUHAMMAD', 'Active', '2022-10-28 14:51:45', 0, 'afan@gmail.com', NULL, '$2y$10$fF1nbf8nuGKuF8qNNm3Nu.uHHGWsyhmonBpaJJ9ri5sHs3c/lcEQK', NULL, '2022-10-28 14:51:45', '2022-10-28 14:52:29', NULL),
	('97a11e77-de0f-402e-8398-9a3f00c067ae', 'AFIQ BIN ABDUL HAMID', 'Inactive', '2022-10-31 10:16:07', 0, 'afiq1233@gmail.com', NULL, '$2y$10$5ngASaC1XhWAN737HRIL5ed80/7KU3vN7prkySzDJptw1PSoOP7Da', NULL, '2022-10-31 10:16:07', '2022-11-01 15:27:41', NULL),
	('97a345ec-3ae9-4a52-bf68-054638281483', 'STAF', 'Inactive', '0000-00-00 00:00:00', 0, 'sataf@www.com', NULL, '$2y$10$3Ynufe76ApB8C29xlhPZZuXT/pUWI3sUHNwkyW4DZ.efHM0OHw7Ki', NULL, '2022-11-01 11:58:05', '2022-11-01 12:20:57', '2022-11-01 12:20:57'),
	('97a34ed7-8eff-4f29-b827-ec1f95db7f4c', '211DAGSDGSDG', 'Inactive', '2022-11-01 12:23:02', 0, 'asdasd@gmail.com', NULL, '$2y$10$JOpd2sdNPj6vENU7odFe8OEcZIQn8kgpovleEpfzOdffP85TQ3P4e', NULL, '2022-11-01 12:23:02', '2022-11-01 15:18:13', '2022-11-01 15:18:13'),
	('97a3a713-7f2e-4d5c-ab64-5429b703c99d', 'STAF STAF', 'Active', '2022-11-01 16:29:45', 0, 'stafstaf@gmail.com', '2022-11-07 18:03:27', '$2y$10$.OevqDU6WnNisNGn8NAOcO2oAHSzQcSrTt.NJz8mns4gMKB/UP9UW', NULL, '2022-11-01 16:29:45', '2023-01-05 09:51:32', NULL),
	('97a3a765-eee1-4f53-a6dc-17566962c322', 'STAF AKTIF', 'Active', '2022-11-01 16:30:39', 0, 'stafaktif@gmail.com', NULL, '$2y$10$lDXY4jh3lrjnjTtxVDgRd.9gaDFM64fpXAuZhGRMB3PTnUg2LOPSa', NULL, '2022-11-01 16:30:39', '2022-11-03 16:49:03', '2022-11-03 16:49:03'),
	('98348f8b-5fc2-47e8-b966-d5118bf38865', 'ALI PROJECT MANAGER', 'Inactive', '2023-01-12 09:19:00', 0, 'ali@gmail.com', '2023-01-12 09:19:00', '$2y$10$Pd6tMSTzHnDXhA7Oxp4pQe4Z0JlywmWZSqYy04wkncQyZ.pICc.Mq', NULL, '2023-01-12 09:19:00', '2023-01-25 02:39:26', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table msl9.user_login_histories
DROP TABLE IF EXISTS `user_login_histories`;
CREATE TABLE IF NOT EXISTS `user_login_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `logout_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table msl9.user_login_histories: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_login_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_login_histories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
