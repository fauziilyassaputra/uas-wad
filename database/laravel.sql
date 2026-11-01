-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20261026.c7bb2a19e5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2026 at 04:20 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1793499018),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1793499018;', 1793499018),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:4;', 1793469305),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1793469305;', 1793469305);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Family', 'Heartwarming and emotional slice-of-life stories centered around family bonds, domestic struggles, and the enduring love between parents and children.', '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(2, 'Comedy', 'Lighthearted, humorous films focused on bringing laughter through absurd situations, eccentric characters, and funny misunderstandings in everyday life.', '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(3, 'Suspense', 'Thrilling and mysterious narratives designed to keep the audience on the edge of their seats, often featuring psychological tension, unsolved mysteries, or mind-bending plot twists.', '2026-10-31 10:20:50', '2026-10-31 10:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_28_123759_add_role_to_user_table', 1),
(5, '2026_10_28_123815_create_categories_table', 1),
(6, '2026_10_28_123834_create_products_table', 1),
(7, '2026_10_28_123848_create_transactions_table', 1),
(8, '2026_10_28_123911_create_transaction_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `sku` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pcs',
  `stock` int UNSIGNED NOT NULL DEFAULT '0',
  `min_stock` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `sku`, `name`, `unit`, `stock`, `min_stock`, `created_at`, `updated_at`) VALUES
(1, 3, 'VDT-SUS-001', 'Enter the Ether', 'pcs', 7, 5, '2026-10-31 10:20:50', '2026-10-31 10:50:35'),
(2, 3, 'VDT-SUS-002', 'Disappearing Elevator', 'pcs', 4, 5, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(3, 3, 'VDT-SUS-003', 'Unlimited Players', 'pcs', 7, 5, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(4, 2, 'VDT-COM-001', 'Coffee Mate', 'pcs', 10, 10, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(5, 2, 'VDT-COM-002', 'Small Body Big Crisis', 'pcs', 10, 10, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(6, 1, 'VDT-FAM-001', 'The Heartbeat', 'pcs', 10, 3, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(7, 1, 'VDT-FAM-002', 'TreCarls', 'pcs', 7, 3, '2026-10-31 10:20:50', '2026-10-31 10:51:31'),
(8, 2, 'VDT-COM-004', 'test produk diperbarui', 'pcs', 0, 2, '2026-10-31 10:42:36', '2026-10-31 10:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EvYRWjk3FYluVmkDeKIJBTVKXIzSQtjiQMrJNcxd', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJSUks1RHRVNHRTTHZidjlyUzdDR0V2cDZ4NnptZWtuUGRyQ2xMWUFUIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6ImRhc2hib2FyZCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sInVybCI6W10sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6ImY1MGJkMDdkM2M5MjkyNzk0OTk5NmNkMzM2YjYxMTNjOTQ2YmQyZGExNGE5NWU1ZjI1ZDQyYzFlOTk2MjY0MmEifQ==', 1793496880),
('iFwEAqKaRpTfAAky2nNH1dy10afZO7PsJF92L5hV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJZUWFhRjZXdm9BUERRaU11bmRxUXBiMnBzWE5SNmllejd3cGVCekhvIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9rYXRlZ29yaSIsInJvdXRlIjoia2F0ZWdvcmkuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiJmNTBiZDA3ZDNjOTI5Mjc5NDk5OTZjZDMzNmI2MTEzYzk0NmJkMmRhMTRhOTVlNWYyNWQ0MmMxZTk5NjI2NDJhIn0=', 1793498960),
('myr7aAPFMAjBm6fvuW68d4gAhyIFAIGOqeDETzo7', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJKbXhyZnQ1cXA3T3dpcFdaQWJtQ1hyaVZFbFc4d3VMejRSclIwZng0IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3RyYW5zYWtzaSIsInJvdXRlIjoidHJhbnNha3NpLmluZGV4In0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyLCJwYXNzd29yZF9oYXNoX3dlYiI6IjU2N2I1MmMzYjhiYzlkNGI3YjlmY2M1MmMyYjU1ZDMzMjIxYWY4MTQzOTQ2YWQyOTQzNGIzMzFhZDM2NDhhNDUifQ==', 1793469302),
('vqNV1WkOiv5meh2Z1S4xVwVtoedOh5rmU80aNwHT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36 OPR/138.0.0.0', 'eyJfdG9rZW4iOiJERXFyYkpxWjRNbkx4d09nellzNm5HRnVtekZqVWdvWXVad2RKMkd0IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL3Byb2R1ayIsInJvdXRlIjoicHJvZHVrLmluZGV4In0sInVybCI6W10sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJwYXNzd29yZF9oYXNoX3dlYiI6ImY1MGJkMDdkM2M5MjkyNzk0OTk5NmNkMzM2YjYxMTNjOTQ2YmQyZGExNGE5NWU1ZjI1ZDQyYzFlOTk2MjY0MmEifQ==', 1793469095);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `type`, `reference_no`, `transaction_date`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'in', 'IN-0001', '2026-10-26', 'Stok awal dari pemasok', '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(2, 2, 'in', 'OUT-0001', '2026-10-29', 'Kirim ke belobog industries', '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(3, 2, 'in', 'IN-20261031-GFLM', '2026-10-31', NULL, '2026-10-31 10:50:35', '2026-10-31 10:50:35'),
(4, 2, 'out', 'OUT-20261031-UCTM', '2026-10-31', NULL, '2026-10-31 10:51:31', '2026-10-31 10:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--
DROP TABLE IF EXISTS `transaction_items`;
CREATE TABLE `transaction_items` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(2, 1, 2, 10, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(3, 1, 3, 10, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(4, 1, 4, 10, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(5, 1, 5, 10, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(6, 1, 6, 10, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(7, 1, 7, 10, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(8, 2, 1, 8, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(9, 2, 2, 6, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(10, 2, 3, 3, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(11, 3, 1, 5, '2026-10-31 10:50:35', '2026-10-31 10:50:35'),
(12, 4, 7, 3, '2026-10-31 10:51:31', '2026-10-31 10:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'wise admin', 'wise@randomplay.id', NULL, '$2y$12$BcOHdfdJ169qGyCJSXiAS.wJTgkvFsDwK3d.PS.N3mGLbjgFFSioW', 'admin', NULL, '2026-10-31 10:20:50', '2026-10-31 10:20:50'),
(2, 'vivian staff', 'vivian@randomplay.id', NULL, '$2y$12$J4PLTHJcVl7/Z8P/vSESD.MejspWT5F3xRQzA4IC9rCmWnFg8//y.', 'staff', NULL, '2026-10-31 10:20:50', '2026-10-31 10:20:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_reference_no_unique` (`reference_no`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_items_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
