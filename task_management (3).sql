-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 22, 2024 at 06:39 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` enum('project','task','comment','file','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `task_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(4, 1, 6, '<p>http://localhost:8000/project/8#xxxsaaaa<br></p>', '2024-08-18 07:11:44', '2024-08-18 10:58:47'),
(5, 1, 6, '<p><a href=\"http://localhost:8000/project/8#\" target=\"_blank\">http://localhost:8000/project/8#</a><br></p>', '2024-08-18 07:17:30', '2024-08-18 07:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `path`, `file_type`, `task_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, '1724258490.png', 'uploads/1724258490.png', 'image', 1, 6, '2024-08-21 11:41:30', '2024-08-21 11:41:30'),
(4, '1724258542.png', 'uploads/1724258542.png', 'image', 1, 6, '2024-08-21 11:42:22', '2024-08-21 11:42:22'),
(5, '1724258607.png', 'uploads/1724258607.png', 'image', 1, 6, '2024-08-21 11:43:27', '2024-08-21 11:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `generals`
--

CREATE TABLE `generals` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `light_logo` text COLLATE utf8mb4_unicode_ci,
  `dark_logo` text COLLATE utf8mb4_unicode_ci,
  `favicon` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generals`
--

INSERT INTO `generals` (`id`, `title`, `description`, `email`, `address`, `contact`, `footer_text`, `light_logo`, `dark_logo`, `favicon`, `meta_title`, `meta_description`, `keywords`, `created_at`, `updated_at`) VALUES
(1, 'Task Management System', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum,', 'raahim32006@gmail.com', 'A-135 Asif Colony Bismillah Hotel', '+923470993615', '© 2024 Task Management System', NULL, NULL, 'Untitled design (1).png', 'Task Management System', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum,', 'task management , tms', NULL, '2024-09-22 05:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_08_09_153236_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2024_08_09_153833_create_plans_table', 1),
(8, '2024_08_09_154045_create_organizations_table', 1),
(9, '2024_08_09_154254_create_subscriptions_table', 1),
(10, '2024_08_09_154433_create_projects_table', 1),
(11, '2024_08_09_154750_create_tasks_table', 1),
(12, '2024_08_09_155053_create_task_users_table', 1),
(13, '2024_08_09_155119_create_comments_table', 1),
(14, '2024_08_09_155227_create_files_table', 1),
(15, '2024_08_09_155432_create_activity_logs_table', 1),
(16, '2024_08_09_155659_create_tags_table', 1),
(17, '2024_08_09_155718_create_tag_tasks_table', 1),
(18, '2024_08_11_082342_create_project_users_table', 2),
(21, '2024_09_22_093448_create_generals_table', 3),
(22, '2024_09_22_161003_create_permissions_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `slug`, `plan_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Wade and Ruiz Plc', 'wade-and-ruiz-plc', 1, NULL, '2024-08-09 12:15:11', '2024-08-09 12:15:11'),
(3, 'Poole and Peters Trading', 'poole-and-peters-trading', 1, NULL, '2024-08-09 13:48:37', '2024-08-09 13:48:37'),
(4, 'Watson and Bradshaw Traders', 'watson-and-bradshaw-traders', 1, NULL, '2024-08-10 11:40:06', '2024-09-05 15:03:27'),
(5, 'Test', 'test', 1, NULL, '2024-08-25 05:31:54', '2024-08-25 05:31:54'),
(6, 'Muhammad Rahiim', 'muhammad-rahiim', 1, NULL, '2024-09-05 11:42:19', '2024-09-05 11:42:19'),
(7, 'Lewis Bray Co', 'lewis-bray-co', 1, NULL, '2024-09-05 14:03:48', '2024-09-05 14:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `permissions` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 1, '[\"team_read\",\"team_create\",\"team_edit\",\"team_delete\",\"project_read\",\"project_create\",\"project_edit\",\"project_delete\",\"task_read\",\"task_create\",\"task_edit\",\"task_delete\"]', '2024-09-22 11:19:33', '2024-09-22 11:27:36'),
(2, 2, '[\"team_read\",\"team_create\",\"team_edit\",\"team_delete\",\"project_read\",\"project_create\",\"project_edit\",\"project_delete\",\"task_read\",\"task_create\",\"task_edit\",\"task_delete\"]', '2024-09-22 11:27:56', '2024-09-22 13:27:04'),
(3, 3, '[\"team_read\",\"team_create\",\"team_edit\",\"project_read\",\"project_create\",\"project_edit\",\"task_read\",\"task_create\",\"task_edit\"]', '2024-09-22 11:28:53', '2024-09-22 11:28:53'),
(4, 4, '[\"team_read\",\"project_read\",\"task_read\"]', '2024-09-22 11:29:37', '2024-09-22 13:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_price` float(10,2) NOT NULL,
  `yearly_price` float(10,2) NOT NULL,
  `max_users` int NOT NULL,
  `max_projects` int NOT NULL,
  `max_tasks` bigint DEFAULT NULL,
  `status` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `monthly_price`, `yearly_price`, `max_users`, `max_projects`, `max_tasks`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Free', 0.00, 0.00, 6, 10, 10, 1, NULL, '2024-09-05 14:06:45'),
(3, 'Standard', 49.99, 99.99, 50, 150, 25, 1, '2024-09-06 10:55:34', '2024-09-06 11:29:08'),
(4, 'Premium', 99.99, 199.99, 100, 250, 50, 1, '2024-09-06 11:00:06', '2024-09-06 11:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `organization_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('not_started','in_progress','completed','on_hold') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_started',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `slug`, `color`, `description`, `organization_id`, `user_id`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pascale Cooper', 'pascale-cooper', '#78086f', NULL, 2, 4, '2018-10-25', '2024-09-05', 'not_started', '2024-08-09 13:35:09', '2024-08-10 14:13:15', NULL),
(2, 'Mallory Dillon', 'mallory-dillon', '#6b8ec5', NULL, 2, 4, '2009-07-03', '1984-05-25', 'completed', '2024-08-09 13:35:46', '2024-08-10 14:17:59', NULL),
(3, 'Magee Burris', 'magee-burris', '#ff0a8f', NULL, 2, 4, '1979-02-27', '1995-04-10', 'on_hold', '2024-08-09 13:35:59', '2024-08-09 13:35:59', NULL),
(4, 'Lunea Francis', 'lunea-francis', '#0cca95', NULL, 2, 4, '2000-06-28', '1973-10-18', 'in_progress', '2024-08-09 13:43:18', '2024-08-09 13:43:18', NULL),
(5, 'Hector Robles', 'hector-robles', '#615e2b', NULL, 3, 5, '1991-05-09', '1982-06-25', 'not_started', '2024-08-09 13:53:11', '2024-08-09 13:53:11', NULL),
(6, 'Rylee Mcgee', 'rylee-mcgee', '#4afadb', NULL, 4, 6, '2010-09-25', '2017-10-23', 'completed', '2024-08-10 14:26:05', '2024-08-11 08:56:37', NULL),
(7, 'Jane Graham', 'jane-graham', '#5a87c4', NULL, 4, 6, '2024-08-10', '2024-09-30', 'in_progress', '2024-08-10 14:27:11', '2024-08-10 14:27:52', NULL),
(8, '22k Traders', '22k-traders', '#0008f5', NULL, 4, 6, '2024-08-11', '2024-12-31', 'completed', '2024-08-11 09:01:03', '2024-08-14 09:41:15', NULL),
(9, 'sds', 'sds', '#000000', NULL, 4, 6, '2024-09-17', '2024-09-17', 'completed', '2024-09-05 14:21:50', '2024-09-22 13:19:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_users`
--

CREATE TABLE `project_users` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_users`
--

INSERT INTO `project_users` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '2024-08-11 07:45:33', '2024-08-11 07:45:33'),
(2, 7, 1, '2024-08-11 07:47:10', '2024-08-11 07:47:10'),
(3, 7, 2, '2024-08-11 07:49:06', '2024-08-11 07:49:06'),
(4, 6, 2, '2024-08-11 08:55:09', '2024-08-11 08:55:09'),
(5, 7, 4, '2024-08-11 08:55:24', '2024-08-11 08:55:24'),
(6, 8, 1, '2024-09-01 11:39:53', '2024-09-01 11:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, NULL),
(2, 'Admin', NULL, NULL),
(3, 'Manager', NULL, NULL),
(4, 'Developer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `organization_id` bigint UNSIGNED NOT NULL,
  `plan_id` bigint UNSIGNED NOT NULL,
  `plan_data` text COLLATE utf8mb4_unicode_ci,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `start_date`, `end_date`, `organization_id`, `plan_id`, `plan_data`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, '2024-08-25', '2024-09-25', 5, 1, '{\"name\":\"Free\",\"price\":0,\"max_users\":7,\"max_projects\":4,\"max_tasks\":3,\"duration\":\"monthly\",\"status\":1}', NULL, 1, '2024-08-25 05:31:54', '2024-08-25 05:31:54'),
(2, '2024-08-25', '2024-09-25', 4, 1, '{\"name\":\"Free\",\"price\":\"0\",\"max_users\":\"8\",\"max_projects\":\"4\",\"max_tasks\":\"3\",\"duration\":\"yearly\"}', NULL, 0, NULL, '2024-09-21 14:30:22'),
(3, '2024-09-05', '2024-10-05', 6, 1, '{\"name\":\"Free\",\"price\":0,\"max_users\":10,\"max_projects\":10,\"max_tasks\":10,\"duration\":\"monthly\",\"status\":1}', NULL, 1, '2024-09-05 11:42:19', '2024-09-05 11:42:19'),
(4, '2024-09-05', '2024-10-05', 7, 1, '{\"name\":\"Free\",\"price\":0,\"max_users\":10,\"max_projects\":10,\"max_tasks\":10,\"duration\":\"monthly\",\"status\":1}', NULL, 1, '2024-09-05 14:03:49', '2024-09-05 14:03:49'),
(5, '2024-09-06', '2025-09-06', 4, 1, '{\"name\":\"Premium\",\"monthly_price\":99.99,\"yearly_price\":199.99,\"max_users\":100,\"max_projects\":250,\"max_tasks\":50}', NULL, 0, '2024-09-06 14:46:16', '2024-09-21 14:30:22'),
(6, '2024-09-06', '2025-09-06', 4, 4, '{\"name\":\"Premium\",\"monthly_price\":99.99,\"yearly_price\":199.99,\"max_users\":100,\"max_projects\":250,\"max_tasks\":50}', NULL, 0, '2024-09-06 14:49:34', '2024-09-21 14:30:22'),
(7, '2024-09-06', '2024-09-09', 4, 4, '{\"name\":\"Premium\",\"monthly_price\":99.99,\"yearly_price\":199.99,\"max_users\":100,\"max_projects\":250,\"max_tasks\":50}', 'stripe', 0, '2024-09-06 14:53:33', '2024-09-21 14:30:22'),
(8, '2024-09-21', '2025-09-22', 4, 3, '{\"name\":\"Standard\",\"monthly_price\":49.99,\"yearly_price\":99.99,\"max_users\":50,\"max_projects\":150,\"max_tasks\":25,\"duration\":null}', 'stripe', 1, '2024-09-21 14:30:22', '2024-09-21 14:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag_tasks`
--

CREATE TABLE `tag_tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('todo','in_progress','review','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'todo',
  `priority` enum('low','medium','high','urgent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `due_date` date DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `project_id`, `description`, `status`, `priority`, `due_date`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Details', 8, '<p style=\"color: rgb(41, 43, 58); letter-spacing: 0.3px;\">What is Lorem Ipsum?</p><p style=\"color: rgb(41, 43, 58); letter-spacing: 0.3px;\">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p style=\"color: rgb(41, 43, 58); letter-spacing: 0.3px;\"><br></p><p style=\"color: rgb(41, 43, 58); letter-spacing: 0.3px;\">Why do we use it?</p><p style=\"color: rgb(41, 43, 58); letter-spacing: 0.3px;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'in_progress', 'high', '2024-08-23', 6, '2024-08-18 06:37:02', '2024-08-25 06:33:48', NULL),
(2, 'Add Social Logins', 8, '<p>1.Google Login.</p><p>2.Facebook Login.<br><br>API keys given soon...</p>', 'todo', 'medium', '2024-08-31', 6, '2024-08-25 03:22:09', '2024-08-25 03:22:30', NULL),
(3, 'sdfsdfsdf', 8, '<p><img src=\"/storage/images/Ndzd6mVjsvVjTn4Kci8Hx3iZwdJd0ZAkPq16Qn6P.png\" style=\"width: 25%;\"><br></p>', 'in_progress', 'urgent', '2024-09-02', 6, '2024-09-01 11:16:26', '2024-09-01 11:16:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_users`
--

CREATE TABLE `task_users` (
  `id` bigint UNSIGNED NOT NULL,
  `task_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_users`
--

INSERT INTO `task_users` (`id`, `task_id`, `user_id`, `project_id`, `created_at`, `updated_at`) VALUES
(4, 5, 1, 7, '2024-08-12 10:10:29', '2024-08-12 10:10:29'),
(5, 6, 1, 8, '2024-08-18 06:13:10', '2024-08-18 06:13:10'),
(6, 6, 2, 8, '2024-08-18 06:13:12', '2024-08-18 06:13:12'),
(7, 6, 4, 8, '2024-08-18 06:13:12', '2024-08-18 06:13:12'),
(8, 1, 1, 8, '2024-08-18 06:37:16', '2024-08-18 06:37:16'),
(9, 1, 2, 8, '2024-08-18 06:37:17', '2024-08-18 06:37:17'),
(10, 1, 4, 8, '2024-08-18 06:37:17', '2024-08-18 06:37:17'),
(11, 2, 1, 8, '2024-08-25 03:22:09', '2024-08-25 03:22:09'),
(12, 2, 2, 8, '2024-08-25 03:22:09', '2024-08-25 03:22:09'),
(13, 3, 2, 8, '2024-09-01 11:16:26', '2024-09-01 11:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `organization_id` bigint UNSIGNED DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `role_id`, `organization_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Griffith Haynes', 'zadywici@mailinator.com', NULL, '$2y$10$agt0Xa/nmyNNyBPAH5mhrO2CsAHx0SGB1SAvrnh8JXcwKv1wAD.ue', '1727017467.png', 2, 2, 1, NULL, '2024-08-09 11:21:15', '2024-09-22 10:04:27'),
(2, 'Aladdin Nichols', 'kukepipo@mailinator.com', NULL, '$2y$10$QUG9LiraaEcE0jhsSHVlMO4aml/BnLLxSBMNSK.vj9buzXUM8ueNG', 'download (2).png', 2, 6, 1, NULL, '2024-08-09 12:09:33', '2024-08-12 12:44:35'),
(3, 'Hamilton Mendoza', 'wukoh@mailinator.com', NULL, '$2y$10$jBZpgRbEjzQDY6/RQbngkeNKqZeoKwSA1pA8F7DkTBPBl4aGo8whG', 'download.jfif', 4, 4, 0, NULL, '2024-08-09 12:14:29', '2024-09-22 13:31:09'),
(4, 'Justine Bruce', 'dagol@mailinator.com', NULL, '$2y$10$P1Evast58adjTMCQ8xU20uOOY.9r1jWAyQBIRsCkTjnhmydPuphFa', 'download.png', 4, 4, 1, NULL, '2024-08-09 12:15:11', '2024-08-12 12:45:15'),
(5, 'Kaseem Wolf', 'xyne@mailinator.com', NULL, '$2y$10$0R3IcksDlnu1/qJKKNE2nePZeNF1vi8ycPPvRoJQJsuNkbQ68vL8y', NULL, 2, 3, 1, NULL, '2024-08-09 13:48:37', '2024-08-09 13:48:37'),
(6, 'Nicholas Holmes', 'gomyku@mailinator.com', NULL, '$2y$10$4EhloMmAnBKdUCvojehTT..DMUsNt2Yk287f8N.n8IKQTizTizEqm', NULL, 2, 4, 1, 'idHKP16OWPLHFzNP5Fkoal5dY7w8mCOQZGONc8L9j4WWjT80YdJ84uhNfViK', '2024-08-10 11:40:06', '2024-08-12 12:45:16'),
(13, 'Isadora William', 'xaxok@mailinator.com', NULL, '$2y$10$uzM5Ezy/v0CkLz3qmX1.7Og06oD92IXadFGWi42hNU4CjSQeR4vdm', NULL, 4, 4, 1, NULL, '2024-08-25 05:24:31', '2024-08-25 05:24:31'),
(14, 'Test', 'test@gmail.com', NULL, '$2y$10$4m.ovss7ClrjhRZkSG5rcuCoWE95Kd56xsjmYFtxT.ob9Rd9ck..W', NULL, 2, 5, 1, NULL, '2024-08-25 05:31:54', '2024-08-25 05:31:54'),
(15, 'Muhammad Rahiim', 'raahim32006@gmail.com', NULL, '$2y$10$3N4JHBJolNisPeZBH/6/seuV/GpoKAjuafFtFprgflK54BdkCaFvC', NULL, 1, 6, 1, NULL, '2024-09-05 11:42:19', '2024-09-05 11:42:19'),
(16, 'Ocean Moreno', 'qelosyd@mailinator.com', NULL, '$2y$10$pU16UlJag26/DortIopGQePTmu5vTobvsJ8nEBA7HmVE5fcd8/Iya', NULL, 2, 7, 1, NULL, '2024-09-05 14:03:49', '2024-09-05 14:03:49'),
(17, 'qwe', 'name@aptechgdn.net', NULL, '$2y$10$OKdlnzM3GRlJQGWMkLMrM.rdZW2mtyHqK3Xh0s4Rf2aycnUdNGMAm', NULL, 2, 4, 1, NULL, '2024-09-05 14:12:54', '2024-09-05 14:12:54'),
(22, 'a', 'name@aptechgdn.neta', NULL, '$2y$10$lGPwZANI.YXVITlVFCjyfuTAYlP.ALj.eiqjZh70H.TZSUKy73Fve', NULL, 3, 2, 1, NULL, '2024-09-22 09:46:56', '2024-09-22 10:20:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_task_id_foreign` (`task_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_task_id_foreign` (`task_id`),
  ADD KEY `files_user_id_foreign` (`user_id`);

--
-- Indexes for table `generals`
--
ALTER TABLE `generals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organizations_plan_id_foreign` (`plan_id`),
  ADD KEY `organizations_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_organization_id_foreign` (`organization_id`),
  ADD KEY `projects_user_id_foreign` (`user_id`);

--
-- Indexes for table `project_users`
--
ALTER TABLE `project_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_users_project_id_foreign` (`project_id`),
  ADD KEY `project_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_organization_id_foreign` (`organization_id`),
  ADD KEY `subscriptions_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag_tasks`
--
ALTER TABLE `tag_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_tasks_tag_id_foreign` (`tag_id`),
  ADD KEY `tag_tasks_task_id_foreign` (`task_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`),
  ADD KEY `user_fk` (`user_id`);

--
-- Indexes for table `task_users`
--
ALTER TABLE `task_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_users_task_id_foreign` (`task_id`),
  ADD KEY `task_users_user_id_foreign` (`user_id`),
  ADD KEY `task_users_project_id_foreign` (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `organization_fk` (`organization_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `generals`
--
ALTER TABLE `generals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_users`
--
ALTER TABLE `project_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag_tasks`
--
ALTER TABLE `tag_tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_users`
--
ALTER TABLE `task_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`),
  ADD CONSTRAINT `organizations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `projects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_users`
--
ALTER TABLE `project_users`
  ADD CONSTRAINT `project_users_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `project_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`);

--
-- Constraints for table `tag_tasks`
--
ALTER TABLE `tag_tasks`
  ADD CONSTRAINT `tag_tasks_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  ADD CONSTRAINT `tag_tasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `task_users`
--
ALTER TABLE `task_users`
  ADD CONSTRAINT `task_users_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `task_users_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `task_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `organization_fk` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
