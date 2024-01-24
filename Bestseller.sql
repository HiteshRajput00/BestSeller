-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 24, 2024 at 09:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Bestseller`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `title`, `message`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Testuser', 'subscribe to our Basic plan', 0, '2024-01-09 06:58:00', '2024-01-10 00:27:59'),
(4, 'user', 'newuserregistered', 0, '2024-01-09 07:03:55', '2024-01-10 00:27:59'),
(5, 'user', 'subscribe to our Basic plan', 0, '2024-01-09 07:04:48', '2024-01-10 00:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_price` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `product_price`, `created_at`, `updated_at`) VALUES
(48, 3, 6, 1, 1499.00, '2023-12-18 00:09:29', '2024-01-10 03:24:40'),
(49, 3, 5, 1, 1399.00, '2023-12-18 00:09:31', '2024-01-10 03:24:34'),
(50, 3, 4, 1, 899.00, '2023-12-18 00:09:33', '2024-01-10 03:22:02'),
(54, 15, 2, 1, 1399.00, '2024-01-09 04:50:37', '2024-01-09 04:50:37'),
(56, 1, 1, 1, 1200.00, '2024-01-19 08:28:46', '2024-01-19 08:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `designer_id`, `name`, `slug`, `image`, `parent_category_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'Women\'s', 'women-s', '1700553772.jpg', NULL, '2023-11-19 23:44:52', '2023-11-19 23:44:52'),
(2, 2, 'Men\'s', 'men-s', '1700553851.jpg', NULL, '2023-11-19 23:44:52', '2023-11-19 23:44:52'),
(3, 2, 'kids', 'kids', '1700553889.jpg', NULL, '2023-11-19 23:44:52', '2023-11-19 23:44:52'),
(4, 2, 'Accessories', 'accessories', '1700553949.jpg', NULL, '2023-11-19 23:44:52', '2023-11-19 23:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `user`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Vansh Rajput', 'hello', '2024-01-11 01:19:48', '2024-01-11 01:19:48'),
(2, 'Test', 'hello', '2024-01-11 01:20:09', '2024-01-11 01:20:09'),
(3, 'Vansh Rajput', 'hello', '2024-01-11 01:20:56', '2024-01-11 01:20:56'),
(4, 'Vansh Rajput', 'hello', '2024-01-11 01:25:12', '2024-01-11 01:25:12'),
(5, 'Vansh Rajput', 'hello', '2024-01-11 01:25:46', '2024-01-11 01:25:46'),
(6, 'Vansh Rajput', 'hello', '2024-01-11 01:30:39', '2024-01-11 01:30:39'),
(7, 'Vansh Rajput', 'hello', '2024-01-11 01:31:50', '2024-01-11 01:31:50'),
(8, 'Vansh Rajput', 'hello', '2024-01-11 01:33:14', '2024-01-11 01:33:14'),
(9, 'Vansh Rajput', 'hello', '2024-01-11 01:42:31', '2024-01-11 01:42:31'),
(10, 'Vansh Rajput', 'hellp', '2024-01-11 01:44:17', '2024-01-11 01:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `discount` int(11) NOT NULL,
  `available_for` varchar(255) NOT NULL DEFAULT 'everyone',
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `discount`, `available_for`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 'Cx23Z', 5, 'everyone', '2024-01-20', '2024-01-10 00:06:06', '2024-01-10 00:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `designer_details`
--

CREATE TABLE `designer_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designer_id` int(11) NOT NULL,
  `year_experiance` int(11) DEFAULT NULL,
  `work_in` int(11) DEFAULT NULL,
  `web_url` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designer_details`
--

INSERT INTO `designer_details` (`id`, `designer_id`, `year_experiance`, `work_in`, `web_url`, `street`, `city`, `state`, `zip`, `country`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, NULL, NULL, 'd-123', 'karnal', 'Haryana', '132054', 'BHARAT', '2023-11-21 05:54:37', '2023-11-21 05:54:37'),
(3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-12 02:12:20', '2023-12-12 02:12:20'),
(4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-05 05:24:22', '2024-01-05 05:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `designer_notifications`
--

CREATE TABLE `designer_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designer_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disapproved_designers`
--

CREATE TABLE `disapproved_designers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designer_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `disapproved_products`
--

CREATE TABLE `disapproved_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `master_pages`
--

CREATE TABLE `master_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, '1700468772.jpg', '2023-11-20 02:56:12', '2023-11-20 02:56:12'),
(2, 2, '1700474753.jpg', '2023-11-20 04:35:53', '2023-11-20 04:35:53'),
(3, 3, '1700571385.jpg', '2023-11-21 02:50:54', '2023-11-21 07:26:25'),
(4, 4, '1700555050.jpg', '2023-11-21 02:54:10', '2023-11-21 02:54:10'),
(5, 5, '1700555736.jpg', '2023-11-21 03:05:36', '2023-11-21 03:05:36'),
(6, 6, '1700555802.jpg', '2023-11-21 03:06:42', '2023-11-21 03:06:42'),
(7, 7, '1700555901.jpg', '2023-11-21 03:08:21', '2023-11-21 03:08:21'),
(8, 8, '1700555951.jpg', '2023-11-21 03:09:11', '2023-11-21 03:09:11'),
(9, 9, '1700555995.jpg', '2023-11-21 03:09:55', '2023-11-21 03:09:55');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_15_112956_create_categories_table', 1),
(6, '2023_11_16_065345_create_products_table', 1),
(7, '2023_11_16_065433_create_media_table', 1),
(8, '2023_11_20_071004_create_disapproved_designers_table', 2),
(10, '2023_11_20_071500_create_disapprovedproducts_table', 3),
(14, '2023_11_20_101429_create_admin_notifications_table', 4),
(15, '2023_11_20_101441_create_designer_notifications_table', 5),
(16, '2023_11_20_101450_create_user_notifications_table', 6),
(17, '2023_11_20_120318_create_user_images_table', 7),
(18, '2023_11_21_095444_create_designer_details_table', 8),
(19, '2023_11_22_115114_create_wishlists_table', 9),
(20, '2023_11_23_061954_create_carts_table', 10),
(21, '2019_05_03_000001_create_customer_columns', 11),
(26, '2023_12_05_074621_create_product_reviews_table', 13),
(28, '2023_12_11_053155_create_subscription_plans_table', 14),
(29, '2023_11_30_115450_create_subscriptions_table', 15),
(30, '2023_12_18_074212_create_master_pages_table', 16),
(32, '2024_01_09_134047_create_coupons_table', 17),
(33, '2024_01_11_062849_create_chats_table', 18);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `is_approved` int(11) DEFAULT 0,
  `is_disapproved` int(11) DEFAULT 0,
  `stock` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `designer_id`, `name`, `slug`, `categories_id`, `price`, `description`, `is_approved`, `is_disapproved`, `stock`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Classic Spring', 'classic-spring', 2, '1200', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '10', 1, '2023-11-20 02:56:12', '2023-11-20 04:33:37'),
(2, 2, 'New Green Jacket', 'new-green-jacket', 1, '1399', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '10', 1, '2023-11-20 04:35:53', '2023-11-20 06:29:57'),
(3, 2, 'Love Nana\'20', 'love-nana-20', 2, '1400', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '20', 1, '2023-11-21 02:50:54', '2023-11-21 07:26:25'),
(4, 2, 'Air Force X1', 'air-force-x1', 2, '899', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '20', 1, '2023-11-21 02:54:10', '2023-11-21 07:00:30'),
(5, 2, 'Classic Dress', 'classic-dress', 1, '1399', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '15', 1, '2023-11-21 03:05:36', '2023-11-21 07:01:21'),
(6, 2, 'Spring Collection', 'spring-collection', 1, '1499', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '10', 1, '2023-11-21 03:06:42', '2023-11-21 07:01:27'),
(7, 2, 'School Collection', 'school-collection', 3, '599', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '20', 1, '2023-11-21 03:08:21', '2023-11-21 07:01:28'),
(8, 2, 'Summer Cap', 'summer-cap', 3, '399', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '15', 1, '2023-11-21 03:09:11', '2023-11-21 07:01:30'),
(9, 2, 'Classic Kid', 'classic-kid', 3, '899', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '10', 1, '2023-11-21 03:09:55', '2023-11-21 07:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_name`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'Test', 2, 3, 'yhjnuthmkujy,,rf', '2023-12-05 02:25:31', '2023-12-05 02:25:31'),
(2, 'Test', 5, 5, 'ewfcvrbhtykiu;po-\'\\', '2023-12-05 05:18:08', '2023-12-05 05:18:08'),
(3, 'Test', 6, 4, 'deferfjkhusagfdiwegfw', '2023-12-05 05:19:51', '2023-12-05 05:19:51'),
(4, 'Test', 1, 5, 'wqdewrktfgrjh', '2023-12-05 05:20:05', '2023-12-05 05:20:05'),
(5, 'Test', 3, 5, 'esrtgr5uj6uimioynbytvy', '2023-12-05 05:20:24', '2023-12-05 05:20:24'),
(6, 'Test', 4, 5, 'edhewggewgfbdebfc', '2023-12-05 05:20:47', '2023-12-05 05:20:47'),
(7, 'Test', 7, 4, 'xdecfghtyjuykl;o.plk', '2023-12-05 05:21:05', '2023-12-05 05:21:05'),
(8, 'Test', 8, 4, 'wsqeeeeeedrgvfrtbhhhhhhhhhhhhhhd', '2023-12-05 05:21:19', '2023-12-05 05:21:19'),
(9, 'Test', 9, 4, 'desfewrgb6i68rvkcrsxzwaz', '2023-12-05 05:21:34', '2023-12-05 05:21:34'),
(10, 'Test', 9, 3, 'egvtr6ujh8ol8i', '2023-12-05 05:23:51', '2023-12-05 05:23:51'),
(11, 'Test', 9, 4, 'rwefgvegh65i7t8uyj6hhi78', '2023-12-05 05:23:58', '2023-12-05 05:23:58'),
(12, 'Test', 9, 2, 'werf45uh67oipl98906u', '2023-12-05 05:24:04', '2023-12-05 05:24:04'),
(13, 'Test', 9, 5, 'ewcfuiewqy8ufdyhewufc', '2023-12-05 05:24:10', '2023-12-05 05:24:10'),
(14, 'Sagar', 2, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-06 06:59:20', '2023-12-06 06:59:20'),
(15, 'Sagar', 5, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-06 06:59:41', '2023-12-06 06:59:41'),
(16, 'Sagar', 5, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-06 07:05:38', '2023-12-06 07:05:38'),
(17, 'Sagar', 5, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-06 07:05:45', '2023-12-06 07:05:45'),
(18, 'Sagar', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-06 07:07:02', '2023-12-06 07:07:02'),
(19, 'Sagar', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-06 07:08:52', '2023-12-06 07:08:52'),
(20, 'Vansh Rajput', 2, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:02:16', '2023-12-12 08:02:16'),
(21, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:02:39', '2023-12-12 08:02:39'),
(22, 'Vansh Rajput', 5, 5, 'rem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:02:53', '2023-12-12 08:02:53'),
(23, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:03:11', '2023-12-12 08:03:11'),
(24, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:04:16', '2023-12-12 08:04:16'),
(25, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:04:24', '2023-12-12 08:04:24'),
(26, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:04:33', '2023-12-12 08:04:33'),
(27, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:04:43', '2023-12-12 08:04:43'),
(28, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:04:53', '2023-12-12 08:04:53'),
(29, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:05:02', '2023-12-12 08:05:02'),
(30, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:10:05', '2023-12-12 08:10:05'),
(31, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:10:13', '2023-12-12 08:10:13'),
(32, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:10:35', '2023-12-12 08:10:35'),
(33, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:11:17', '2023-12-12 08:11:17'),
(34, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:11:25', '2023-12-12 08:11:25'),
(35, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:11:32', '2023-12-12 08:11:32'),
(36, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:11:42', '2023-12-12 08:11:42'),
(37, 'Vansh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:15:33', '2023-12-12 08:15:33'),
(38, 'Vansh Rajput', 4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:18:42', '2023-12-12 08:18:42'),
(39, 'Vansh Rajput', 4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:20:13', '2023-12-12 08:20:13'),
(40, 'Vansh Rajput', 4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:20:21', '2023-12-12 08:20:21'),
(41, 'Vansh Rajput', 4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:20:31', '2023-12-12 08:20:31'),
(42, 'Vansh Rajput', 4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:20:39', '2023-12-12 08:20:39'),
(43, 'Vansh Rajput', 4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:20:46', '2023-12-12 08:20:46'),
(44, 'Vansh Rajput', 4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:20:53', '2023-12-12 08:20:53'),
(45, 'Vansh Rajput', 4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:21:00', '2023-12-12 08:21:00'),
(46, 'Vansh Rajput', 4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:22:31', '2023-12-12 08:22:31'),
(47, 'Vansh Rajput', 4, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:22:46', '2023-12-12 08:22:46'),
(48, 'Vansh Rajput', 1, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2023-12-12 08:24:29', '2023-12-12 08:24:29'),
(49, 'Hitesh Rajput', 5, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', '2024-01-19 07:47:29', '2024-01-19 07:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `billing_cycle` varchar(255) NOT NULL,
  `stripe_subscription_id` varchar(255) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `auto_renewal` int(11) NOT NULL DEFAULT 0,
  `is_active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `plan_id`, `billing_cycle`, `stripe_subscription_id`, `payment_method`, `payment_status`, `amount`, `start_date`, `end_date`, `auto_renewal`, `is_active`, `created_at`, `updated_at`) VALUES
(19, 3, 1, 'month', 'sub_1OWdJlSHuCTN4d6JIoaIkAGu', 'card', '1', 9900.00, '2024-01-08 18:30:00', '2024-02-07 18:30:00', 1, 1, '2024-01-09 05:48:02', '2024-01-09 05:48:02'),
(20, 7, 1, 'month', 'sub_1OWdMjSHuCTN4d6JoAtw5RCV', 'card', '1', 9900.00, '2024-01-08 18:30:00', '2024-02-07 18:30:00', 1, 1, '2024-01-09 05:51:07', '2024-01-09 05:51:07'),
(21, 16, 1, 'month', 'sub_1OWeGDSHuCTN4d6JMVhhkfkE', 'card', '1', 9900.00, '2024-01-08 18:30:00', '2024-02-07 18:30:00', 1, 1, '2024-01-09 06:48:26', '2024-01-09 06:58:00'),
(22, 17, 1, 'month', 'sub_1OWeVaSHuCTN4d6JOUSXbu5C', 'card', '1', 9900.00, '2024-01-08 18:30:00', '2024-02-07 18:30:00', 1, 1, '2024-01-09 07:04:19', '2024-01-09 07:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_type` varchar(255) DEFAULT NULL,
  `recurring_time` varchar(255) DEFAULT NULL,
  `sub_price` decimal(8,0) NOT NULL,
  `discount` decimal(8,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `sub_type`, `recurring_time`, `sub_price`, `discount`, `created_at`, `updated_at`) VALUES
(1, 'Basic', 'month', 99, 5, '2023-12-13 01:10:05', '2023-12-13 01:10:05'),
(2, 'ultimate', 'year', 399, 20, '2023-12-13 01:24:47', '2023-12-13 01:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `is_approved` int(11) DEFAULT 0,
  `is_disapproved` int(11) DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) DEFAULT NULL,
  `pm_type` varchar(255) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `is_approved`, `is_disapproved`, `email`, `number`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, 'Hitesh Rajput', 'admin', 0, 0, 'hit8708542@gmail.com', '4423422421', NULL, '$2y$12$hes/khN2UyfEvgAFR6CF6.v2Yxy6DS4q4BhRPofiZQ/HtkilQqZV.', NULL, '2023-11-19 23:44:52', '2024-01-10 00:27:03', NULL, NULL, NULL, NULL),
(2, 'Vansh Rajput', 'designer', 1, 0, 'vanshrana3204@gmail.com', '4423422333', NULL, '$2y$12$9.cBHGPerhjhHe.3PtvBWORv/cBENt6pCRQJqGtTro06pP70f8xxG', 'TzB0RhYxriGNDE591BWaPsnHL691m54TbJcjqZpeFIYiCRrmJced4UoAZEzC', '2023-11-19 23:44:52', '2023-11-19 23:44:52', NULL, NULL, NULL, NULL),
(3, 'Test', 'user', 1, 0, 'test@gmail.com', '8708542565', NULL, '$2y$12$9NJ5.hu8n7N0gF/GftTac.IZkzbOzLGOg83CDEn/kePhadx6mgocO', 'M4fXlt8SVrqUcjBhv15APgJG81ANLREaZWtFSOH4oh1MwSWsITMTC92ploSh', '2023-11-19 23:44:52', '2024-01-09 06:21:01', 'cus_PLJxZDDf1StG45', NULL, NULL, NULL),
(7, 'Sagar', 'user', 1, 0, 'sagar@gmail.com', '8706776432', NULL, '$2y$12$DN3oYe55epxgmuFPv6BfwuFWvnHViqkfhtK9fOuqXxdACgdbdqdP.', NULL, '2023-12-06 06:58:45', '2024-01-09 05:51:05', 'cus_PLK0Ot4jdK7KtK', NULL, NULL, NULL),
(15, 'Vansh Rajput', 'user', 1, 0, 'developer1234556@gmail.com', '5566224343', NULL, '$2y$12$BtZvjaZ9UEMwsWBhDy7Yn.HU2juA4nJEgrryzJIyUmMLfrfy5UZlK', NULL, '2023-12-18 01:13:56', '2024-01-09 05:41:05', 'cus_PLJqzSYh6EkM04', NULL, NULL, NULL),
(16, 'Testuser', 'user', 1, 0, 'test12@gmail.com', '11222121211', NULL, '$2y$12$8RziTO9A7MaP6xEKyET/2u6vIlV.fqzGtYz5H1ecgZoGTwttPW7TC', NULL, '2024-01-09 06:48:01', '2024-01-09 06:48:24', 'cus_PLKwcTRf1nszP7', NULL, NULL, NULL),
(17, 'user', 'user', 1, 0, 'user@gmail.com', '1234567892', NULL, '$2y$12$BR11MPCRh0oTilk6Nmw7peanGvkWmDXWVBabMh.0LJK49LZoK4r5C', NULL, '2024-01-09 07:03:55', '2024-01-09 07:04:17', 'cus_PLLB1lYu11hGk3', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`id`, `user_id`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 2, '1700563860.jpg', '2023-11-21 05:21:00', '2023-11-21 05:21:00'),
(2, 1, '1702366940.jpg', '2023-11-21 06:11:29', '2023-12-12 02:12:20'),
(3, 3, '1704452072.jpg', '2024-01-05 05:24:22', '2024-01-05 05:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(76, 3, 7, '2023-11-29 08:23:38', '2023-11-29 08:23:38'),
(80, 3, 1, '2023-12-05 01:25:50', '2023-12-05 01:25:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designer_details`
--
ALTER TABLE `designer_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designer_notifications`
--
ALTER TABLE `designer_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disapproved_designers`
--
ALTER TABLE `disapproved_designers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disapproved_products`
--
ALTER TABLE `disapproved_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `master_pages`
--
ALTER TABLE `master_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designer_details`
--
ALTER TABLE `designer_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `designer_notifications`
--
ALTER TABLE `designer_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disapproved_designers`
--
ALTER TABLE `disapproved_designers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `disapproved_products`
--
ALTER TABLE `disapproved_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_pages`
--
ALTER TABLE `master_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
