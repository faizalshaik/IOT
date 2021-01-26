-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2020 at 03:12 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digit_animal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, 'admin@admin.com', '$2y$10$QtXVA/Lk0iNWb5nWlyGUK.7aWNLtHtgV6qD/fqHT4KXuXvY4Fh3KW', '2019-12-18 09:20:09', '2019-12-18 09:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `area_name` varchar(255) NOT NULL,
  `area_type` enum('green','yellow') NOT NULL DEFAULT 'green',
  `area_region` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `customer_id`, `area_name`, `area_type`, `area_region`, `created_at`, `updated_at`) VALUES
(18, 5, 'Madrid', 'green', '[[\"39.42614081138908\",\"-4.3812881443811875\"],[\"39.7394268487103\",\"-3.7660537693811875\"],[\"39.532139082354526\",\"-3.0299697850061875\"],[\"39.01760797305151\",\"-3.1288467381311875\"],[\"39.128486998740435\",\"-3.6452041600061875\"],[\"38.88945425733637\",\"-4.0956436131311875\"],[\"39.128486998740435\",\"-4.4966445896936875\"]]', '2019-12-26 12:12:36', '2019-12-27 09:33:37'),
(21, 5, 'HHHTest', 'yellow', '[[\"40.28570264597571\",\"-4.266841777577042\"],[\"39.90330615388316\",\"-4.233882793202042\"],[\"39.84639407031571\",\"-3.168208965077042\"],[\"40.26474765545126\",\"-3.418147929920792\"]]', '2019-12-26 18:13:45', '2019-12-26 18:13:45'),
(25, 5, 'Madrid01', 'green', '[[\"41.28163934517219\",\"-5.057314866165484\"],[\"41.08733603460204\",\"-5.348452561477984\"],[\"40.90179892434128\",\"-4.988650315384234\"],[\"41.07025530296333\",\"-4.610308640579547\"],[\"41.13182859791699\",\"-4.907626145462359\"],[\"41.21865731019002\",\"-4.858187668899859\"],[\"41.15199552070289\",\"-5.055254929642047\"]]', '2020-01-03 21:55:10', '2020-01-03 21:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `area_notify`
--

CREATE TABLE `area_notify` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `thing_id` bigint(20) NOT NULL,
  `area_id` bigint(20) NOT NULL,
  `get_out` tinyint(1) NOT NULL,
  `get_in` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area_notify`
--

INSERT INTO `area_notify` (`id`, `customer_id`, `thing_id`, `area_id`, `get_out`, `get_in`, `created_at`, `updated_at`) VALUES
(7, 5, 4, 18, 0, 0, '2020-01-03 18:45:39', '2020-01-03 18:45:39'),
(9, 5, 4, 21, 0, 0, '2020-01-03 18:45:39', '2020-01-03 18:45:39'),
(12, 5, 2, 18, 0, 0, '2020-01-03 18:46:01', '2020-01-03 18:46:01'),
(13, 5, 2, 21, 0, 0, '2020-01-03 18:46:01', '2020-01-03 18:46:01'),
(16, 5, 1, 18, 1, 1, '2020-01-03 19:43:23', '2020-01-03 19:43:23'),
(18, 5, 1, 21, 0, 0, '2020-01-03 19:43:23', '2020-01-03 19:43:23'),
(22, 5, 2, 25, 0, 0, '2020-01-08 09:22:34', '2020-01-08 09:22:34'),
(23, 5, 1, 25, 0, 0, '2020-01-08 09:25:25', '2020-01-08 09:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `map_type` enum('google','mapbox') NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `notify_email` tinyint(1) UNSIGNED DEFAULT 0,
  `notify_phone` tinyint(1) UNSIGNED DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `surname`, `email`, `phone`, `map_type`, `email_verified_at`, `password`, `remember_token`, `notify_email`, `notify_phone`, `created_at`, `updated_at`) VALUES
(5, 'SSS235', 'tt', 'admin@admin.com', '861873789109', 'google', NULL, '$2y$10$B0jF4Jw/UFOUwYGdokAqd.Ykx2XRl7N3yZPimUclOhNWj1Aya0aH6', '7af0d87f1694341f3a56ed59b040b8b9', 1, 1, '2019-12-18 19:29:46', '2020-01-22 17:48:20'),
(6, 'TT', 'AA', '1235@admin.com', '8618737891098', 'google', NULL, '$2y$10$A.AQPkB3iWgmu01TBV5ZoOn9aGivEB8RbiJ86NUqAQTDonBUpb972', NULL, 0, 0, '2019-12-18 19:31:30', '2019-12-18 19:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `devicemodels`
--

CREATE TABLE `devicemodels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_name` varchar(255) NOT NULL DEFAULT '',
  `brand` varchar(255) DEFAULT '',
  `kind` varchar(255) DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `devicemodels`
--

INSERT INTO `devicemodels` (`id`, `model_name`, `brand`, `kind`, `created_at`, `updated_at`) VALUES
(1, 'AH4563', 'FG1', '1234km', '2020-01-07 22:52:17', '2020-01-07 22:52:58'),
(3, 'AH123', 'Canada/FF', '1234-AM', '2020-01-07 22:54:20', '2020-01-07 22:54:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_18_004106_create-admins_table', 2),
(6, '2014_10_12_000000_create_users_table', 3),
(7, '2019_12_18_074602_create_customers_table', 4),
(8, '2019_12_23_025507_create_areas_table', 5),
(9, '2019_12_24_141549_create-things-table', 6),
(11, '2019_12_24_142237_create-things-table', 8),
(12, '2019_12_24_142220_create-thingkinds-table', 9),
(13, '2019_12_30_070514_create_tracks_table', 10),
(14, '2020_01_03_060723_create_area_notify_table', 10),
(15, '2020_01_06_004741_create_notify_table', 11),
(16, '2020_01_07_144152_create_devicemodels_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `thing_id` bigint(20) NOT NULL,
  `message` varchar(255) DEFAULT '',
  `read` tinyint(1) UNSIGNED DEFAULT 0,
  `type` enum('normal','warnning','critical') DEFAULT 'normal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`id`, `customer_id`, `thing_id`, `message`, `read`, `type`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 'Adsadsad dsfdsf', 1, 'normal', '2020-01-04 20:00:00', '2020-01-06 15:26:47'),
(2, 5, 2, 'Get out from Area XXX', 1, 'warnning', '2020-01-04 19:00:00', '2020-01-06 15:26:47'),
(3, 5, 1, 'Get in this area', 1, 'normal', '2020-01-04 20:40:00', '2020-01-06 15:26:47'),
(4, 5, 1, 'get in to HHHTest', 1, 'warnning', '2020-01-06 15:15:53', '2020-01-06 15:26:47'),
(5, 5, 1, 'get in to HHHTest', 1, 'warnning', '2020-01-06 15:16:19', '2020-01-06 15:26:47'),
(6, 5, 1, 'get in to HHHTest', 1, 'warnning', '2020-01-06 15:17:03', '2020-01-06 15:26:47'),
(7, 5, 1, 'get in to HHHTest', 1, 'warnning', '2020-01-06 15:17:48', '2020-01-06 15:26:47'),
(8, 5, 1, 'get in to HHHTest', 1, 'warnning', '2020-01-06 15:18:53', '2020-01-06 15:26:47'),
(9, 5, 1, 'get in to HHHTest', 1, 'warnning', '2020-01-06 15:21:48', '2020-01-06 15:26:47'),
(10, 5, 1, 'get out from HHHTest', 1, 'critical', '2020-01-06 15:25:08', '2020-01-06 15:26:47'),
(11, 5, 1, 'get in to HHHTest', 1, 'warnning', '2020-01-06 15:25:48', '2020-01-06 15:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `things`
--

CREATE TABLE `things` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `device_id` bigint(20) UNSIGNED DEFAULT 0,
  `about` varchar(255) DEFAULT '',
  `kind_id` bigint(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `state` enum('ok','medium','critical') NOT NULL,
  `monitor_settings` bigint(20) UNSIGNED DEFAULT 0,
  `temperature_range` varchar(255) DEFAULT '',
  `lat` double(10,6) DEFAULT 0.000000,
  `lng` double(10,6) DEFAULT 0.000000,
  `temperature` double(5,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `things`
--

INSERT INTO `things` (`id`, `customer_id`, `name`, `device_id`, `about`, `kind_id`, `image`, `state`, `monitor_settings`, `temperature_range`, `lat`, `lng`, `temperature`, `created_at`, `updated_at`) VALUES
(1, 5, 'Lola001567', 1, NULL, 2, 'uploads/thing-imgs/1578012330.png', 'medium', 23, '25.5~27.9', 40.000000, -4.000000, 27.70, NULL, '2020-01-08 09:25:24'),
(2, 5, 'FinaLa789', 3, 'dsfds1', 3, 'uploads/thing-imgs/1578012283.png', 'ok', 7, NULL, 41.000000, -4.903790, 27.70, NULL, '2020-01-08 09:22:34'),
(4, 5, 'New Man2', 1, NULL, 7, 'uploads/thing-imgs/1578012240.png', 'ok', 31, '', 41.061038, -4.887866, 27.70, '2019-12-29 15:55:28', '2020-01-03 21:58:21'),
(8, 5, 'Car1010', 1, NULL, 7, '', 'critical', 0, '', 41.022931, -4.435240, 0.00, '2020-01-08 00:46:43', '2020-01-08 00:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `thing_kinds`
--

CREATE TABLE `thing_kinds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kind_name` varchar(255) NOT NULL,
  `descr` varchar(255) DEFAULT '',
  `thumb_image` varchar(255) DEFAULT '',
  `marker_image_ok` varchar(255) DEFAULT '',
  `marker_image_medium` varchar(255) DEFAULT '',
  `marker_image_critical` varchar(255) DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `thing_kinds`
--

INSERT INTO `thing_kinds` (`id`, `kind_name`, `descr`, `thumb_image`, `marker_image_ok`, `marker_image_medium`, `marker_image_critical`, `created_at`, `updated_at`) VALUES
(2, 'Man', 'people', 'uploads/kind-imgs/1577929614.png', 'uploads/kind-imgs/1577929789.png', 'uploads/kind-imgs/1577929798.png', 'uploads/kind-imgs/1577929806.png', '2019-12-25 01:33:54', '2020-01-02 09:50:06'),
(3, 'Cow', 'Animal', 'uploads/kind-imgs/1577929571.png', 'uploads/kind-imgs/1577929757.png', 'uploads/kind-imgs/1577929765.png', 'uploads/kind-imgs/1577929779.png', '2019-12-25 01:36:09', '2020-01-02 09:49:39'),
(7, 'Car', NULL, 'uploads/kind-imgs/1577929703.png', 'uploads/kind-imgs/1577929722.png', 'uploads/kind-imgs/1577929731.png', 'uploads/kind-imgs/1577929740.png', '2020-01-02 09:48:12', '2020-01-02 09:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `thing_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `temperature` double(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `thing_id`, `customer_id`, `lat`, `lng`, `temperature`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 40.04, -3.904, NULL, '2020-01-06 15:15:53', '2020-01-06 15:15:53'),
(2, 1, 5, 40.031000000000006, -3.905, NULL, '2020-01-06 15:16:19', '2020-01-06 15:16:19'),
(3, 1, 5, 40.02, -3.906, 20.56, '2020-01-06 15:17:03', '2020-01-06 15:17:03'),
(4, 1, 5, 40.04, -3.907, 20.56, '2020-01-06 15:17:48', '2020-01-06 15:17:48'),
(5, 1, 5, 40.02, -3.908, 20.56, '2020-01-06 15:18:53', '2020-01-06 15:18:53'),
(6, 1, 5, 40.03, -3.909, 20.56, '2020-01-06 15:21:48', '2020-01-06 15:21:48'),
(7, 1, 5, 40.050000000000004, -3.919, 20.56, '2020-01-06 15:24:16', '2020-01-06 15:24:16'),
(8, 1, 5, 40, -3.959, 20.56, '2020-01-06 15:24:35', '2020-01-06 15:24:35'),
(9, 1, 5, 40.09, -4.159, 20.56, '2020-01-06 15:24:51', '2020-01-06 15:24:51'),
(10, 1, 5, 40.04, -4.259, 20.56, '2020-01-06 15:25:08', '2020-01-06 15:25:08'),
(11, 1, 5, 40.02, -4.09, 20.56, '2020-01-06 15:25:48', '2020-01-06 15:25:48'),
(12, 1, 5, 40.04, -4, 20.56, '2020-01-06 15:49:13', '2020-01-06 15:49:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `map_type` enum('google','mapbox') NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`,`area_name`);

--
-- Indexes for table `area_notify`
--
ALTER TABLE `area_notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`);

--
-- Indexes for table `devicemodels`
--
ALTER TABLE `devicemodels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `things`
--
ALTER TABLE `things`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`,`name`);

--
-- Indexes for table `thing_kinds`
--
ALTER TABLE `thing_kinds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thing_kinds_kind_name_unique` (`kind_name`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `area_notify`
--
ALTER TABLE `area_notify`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `devicemodels`
--
ALTER TABLE `devicemodels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `things`
--
ALTER TABLE `things`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `thing_kinds`
--
ALTER TABLE `thing_kinds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
