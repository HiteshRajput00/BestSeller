-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2023 at 09:42 AM
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
(2, 7, 'Women\'s', 'women\'s', '1700553772.jpg', NULL, '2023-11-21 02:32:52', '2023-11-21 02:32:52'),
(3, 7, 'Men\'s', 'men\'s', '1700553851.jpg', NULL, '2023-11-21 02:34:11', '2023-11-21 02:34:11'),
(4, 7, 'Kids', 'kids', '1700553889.jpg', NULL, '2023-11-21 02:34:49', '2023-11-21 02:34:49'),
(5, 7, 'Accessories', 'accessories', '1700553949.jpg', NULL, '2023-11-21 02:35:49', '2023-11-21 02:35:49');

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
(2, 7, NULL, NULL, NULL, 'd-123', 'karnal', 'Haryana', '132054', 'BHARAT', '2023-11-21 05:54:37', '2023-11-21 05:54:37');

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

--
-- Dumping data for table `designer_notifications`
--

INSERT INTO `designer_notifications` (`id`, `designer_id`, `title`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'Miltary watch', ' your product has been approved by admin', 1, '2023-11-22 07:15:10', '2023-11-22 07:15:10');

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

--
-- Dumping data for table `disapproved_designers`
--

INSERT INTO `disapproved_designers` (`id`, `designer_id`, `reason`, `created_at`, `updated_at`) VALUES
(4, 2, 'fdhyejrkuk, yi.', '2023-11-20 02:26:52', '2023-11-20 02:26:52');

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
(20, '2023_11_23_061954_create_carts_table', 10);

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
  `category_id` int(11) NOT NULL,
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

INSERT INTO `products` (`id`, `designer_id`, `name`, `slug`, `category_id`, `price`, `description`, `is_approved`, `is_disapproved`, `stock`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'Classic Spring', 'classic-spring', 3, '1200', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '10', 1, '2023-11-20 02:56:12', '2023-11-20 04:33:37'),
(2, 7, 'New Green Jacket', 'new-green-jacket', 2, '1399', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '10', 1, '2023-11-20 04:35:53', '2023-11-20 06:29:57'),
(3, 7, 'Love Nana\'20', 'love-nana\'20', 3, '20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '20', 1, '2023-11-21 02:50:54', '2023-11-21 07:26:25'),
(4, 7, 'Air Force X1', 'air-force-x1', 3, '899', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '20', 1, '2023-11-21 02:54:10', '2023-11-21 07:00:30'),
(5, 7, 'Classic Dress', 'classic-dress', 2, '1399', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '15', 1, '2023-11-21 03:05:36', '2023-11-21 07:01:21'),
(6, 7, 'Spring Collection', 'spring-collection', 2, '1499', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '10', 1, '2023-11-21 03:06:42', '2023-11-21 07:01:27'),
(7, 7, 'School Collection', 'school-collection', 4, '599', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '20', 1, '2023-11-21 03:08:21', '2023-11-21 07:01:28'),
(8, 7, 'Summer Cap', 'summer-cap', 4, '399', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '15', 1, '2023-11-21 03:09:11', '2023-11-21 07:01:30'),
(9, 7, 'Classic Kid', 'classic-kid', 4, '899', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod kon tempor incididunt ut labore.', 1, 0, '10', 1, '2023-11-21 03:09:55', '2023-11-21 07:01:31');

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
  `number` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `is_approved`, `is_disapproved`, `email`, `number`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hitesh Rajput', 'admin', 0, 0, 'hitesh@gmail.com', '7784515643', NULL, '$2y$12$UFqxcCRwI5KWIraCsTlI5.uTxwxNh0u5dW64EN1fnJbVkI20bGDdu', NULL, '2023-11-19 23:44:52', '2023-11-19 23:44:52'),
(2, 'Test', 'user', 1, 0, 'test@gmail.com', '1122112221', NULL, '$2y$12$NmUqxHpNnjMSKKbDCQQwueICcHhYhQ6T6EunG6TewqlAwV9wzgefS', NULL, '2023-11-19 23:48:05', '2023-11-20 02:26:52'),
(3, 'Sagar', 'designer', 1, 0, 'sagar@gmail.com', '8877732435', NULL, '$2y$12$LhbWKd0K43GoLNQgx96oweAmzdAL5vvVrRLFca6Ndwe.i19nqQvpq', NULL, '2023-11-20 01:11:56', '2023-11-20 02:29:56'),
(5, 'test designer', 'designer', NULL, NULL, 'designer@gmail.com', '1122112221', NULL, '$2y$12$Gz3C7YTtEXmmnYsgxyFr9.gF3/KTwGM6BMhzGHW6vqI7mkGqiva8e', NULL, '2023-11-20 08:22:43', '2023-11-20 08:22:43'),
(7, 'vansh Rajput', 'designer', 1, 0, 'vanshrana3204@gmail.com', '7784515643', NULL, '$2y$12$9.cBHGPerhjhHe.3PtvBWORv/cBENt6pCRQJqGtTro06pP70f8xxG', NULL, '2023-11-21 02:25:54', '2023-11-21 02:27:05');

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
(1, 7, '1700563860.jpg', '2023-11-21 05:21:00', '2023-11-21 05:21:00'),
(2, 1, '1700567394.jpg', '2023-11-21 06:11:29', '2023-11-21 06:19:54');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `designer_details`
--
ALTER TABLE `designer_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `designer_notifications`
--
ALTER TABLE `designer_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
