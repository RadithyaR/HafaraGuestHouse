-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 03:14 AM
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
-- Database: `new_hafara`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `total_price` varchar(255) NOT NULL DEFAULT '0',
  `status` enum('pending','booked','checked_in','checked_out','cancelled') DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `feedback_message` text DEFAULT NULL,
  `booking_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `fine_price` int(11) DEFAULT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `is_cart` tinyint(1) DEFAULT 1,
  `is_additional_bed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `checkin_date`, `checkout_date`, `total_price`, `status`, `rating`, `feedback_message`, `booking_time`, `created_at`, `updated_at`, `remarks`, `fine_price`, `jumlah_kamar`, `is_cart`, `is_additional_bed`) VALUES
(126, 10, '2025-03-14', '2025-03-15', '450000', 'checked_out', 4, 'mantap', '2025-03-05 22:28:40', '2025-03-05 04:13:08', '2025-03-06 02:47:22', 'merokok', 150000, 2, 1, 1),
(128, 2, '2025-03-10', '2025-03-12', '850000', 'checked_out', 5, 'wassalamualaikum', '2025-03-06 03:41:56', '2025-03-06 03:41:49', '2025-03-06 03:43:57', '-', 0, 2, 1, 1),
(129, 10, '2025-03-10', '2025-03-11', '450000', 'checked_out', NULL, NULL, '2025-03-06 21:11:52', '2025-03-06 21:11:14', '2025-03-06 21:15:57', NULL, 0, 2, 1, 1),
(130, 10, '2025-03-10', '2025-03-11', '450000', 'checked_out', NULL, NULL, '2025-03-06 21:11:52', '2025-03-06 21:11:46', '2025-03-06 21:16:03', NULL, 0, 1, 1, 1),
(131, 5, '2025-03-07', '2025-03-08', '400000', 'booked', NULL, NULL, '2025-03-07 10:02:03', '2025-03-07 10:01:52', '2025-03-07 10:02:03', NULL, NULL, 1, 1, 0),
(132, 5, '2025-03-07', '2025-03-08', '220000', 'booked', NULL, NULL, '2025-03-07 10:02:03', '2025-03-07 10:01:59', '2025-03-07 10:02:03', NULL, NULL, 1, 1, 0),
(133, 5, '2025-03-07', '2025-03-08', '220000', 'booked', NULL, NULL, '2025-03-07 10:10:13', '2025-03-07 10:10:02', '2025-03-07 10:10:13', NULL, NULL, 1, 1, 0),
(134, 5, '2025-03-07', '2025-03-08', '200000', 'booked', NULL, NULL, '2025-03-07 10:10:13', '2025-03-07 10:10:10', '2025-03-07 10:10:13', NULL, NULL, 1, 1, 0),
(135, 5, '2025-03-07', '2025-03-08', '220000', 'booked', NULL, NULL, '2025-03-07 12:14:44', '2025-03-07 12:14:32', '2025-03-07 12:14:44', NULL, NULL, 1, 1, 0),
(136, 5, '2025-03-07', '2025-03-08', '220000', 'booked', NULL, NULL, '2025-03-07 12:14:44', '2025-03-07 12:14:40', '2025-03-07 12:14:44', NULL, NULL, 1, 1, 0),
(137, 5, '2025-03-07', '2025-03-08', '220000', 'booked', NULL, NULL, '2025-03-07 12:17:19', '2025-03-07 12:17:09', '2025-03-07 12:17:19', NULL, NULL, 1, 1, 0),
(138, 5, '2025-03-07', '2025-03-08', '220000', 'booked', NULL, NULL, '2025-03-07 12:17:20', '2025-03-07 12:17:16', '2025-03-07 12:17:20', NULL, NULL, 1, 1, 0),
(139, 5, '2025-03-07', '2025-03-08', '220000', 'booked', NULL, NULL, '2025-03-07 12:23:08', '2025-03-07 12:22:57', '2025-03-07 12:23:08', NULL, NULL, 1, 1, 0),
(140, 5, '2025-03-07', '2025-03-08', '400000', 'booked', NULL, NULL, '2025-03-07 12:23:08', '2025-03-07 12:23:05', '2025-03-07 12:23:08', NULL, NULL, 2, 1, 0),
(141, 5, '2025-03-09', '2025-03-10', '400000', 'booked', NULL, NULL, '2025-03-09 08:24:32', '2025-03-09 08:21:16', '2025-03-09 08:24:32', NULL, NULL, 1, 1, 0),
(142, 5, '2025-03-09', '2025-03-10', '220000', 'booked', NULL, NULL, '2025-03-09 08:24:32', '2025-03-09 08:21:27', '2025-03-09 08:24:32', NULL, NULL, 1, 1, 0),
(143, 5, '2025-03-09', '2025-03-10', '250000', 'booked', NULL, NULL, '2025-03-09 08:24:32', '2025-03-09 08:24:19', '2025-03-09 08:24:32', NULL, NULL, 1, 1, 0),
(144, 5, '2025-03-09', '2025-03-10', '300000', 'booked', NULL, NULL, '2025-03-09 08:24:32', '2025-03-09 08:24:28', '2025-03-09 08:24:32', NULL, NULL, 1, 1, 0),
(145, 5, '2025-03-09', '2025-03-10', '220000', 'booked', NULL, NULL, '2025-03-09 08:29:15', '2025-03-09 08:29:10', '2025-03-09 08:29:15', NULL, NULL, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_detail`
--

CREATE TABLE `booking_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_detail`
--

INSERT INTO `booking_detail` (`id`, `booking_id`, `room_id`, `created_at`, `updated_at`) VALUES
(124, 126, 26, '2025-03-05 04:13:08', '2025-03-05 04:13:08'),
(125, 126, 27, '2025-03-05 04:13:08', '2025-03-05 04:13:08'),
(132, 128, 26, '2025-03-06 03:41:49', '2025-03-06 03:41:49'),
(133, 128, 27, '2025-03-06 03:41:49', '2025-03-06 03:41:49'),
(134, 129, 26, '2025-03-06 21:11:14', '2025-03-06 21:11:14'),
(135, 129, 27, '2025-03-06 21:11:14', '2025-03-06 21:11:14'),
(136, 130, 24, '2025-03-06 21:11:46', '2025-03-06 21:11:46'),
(137, 131, 24, '2025-03-07 10:01:52', '2025-03-07 10:01:52'),
(138, 132, 20, '2025-03-07 10:01:59', '2025-03-07 10:01:59'),
(139, 133, 20, '2025-03-07 10:10:02', '2025-03-07 10:10:02'),
(140, 134, 26, '2025-03-07 10:10:10', '2025-03-07 10:10:10'),
(141, 135, 20, '2025-03-07 12:14:32', '2025-03-07 12:14:32'),
(142, 136, 20, '2025-03-07 12:14:40', '2025-03-07 12:14:40'),
(143, 137, 20, '2025-03-07 12:17:09', '2025-03-07 12:17:09'),
(144, 138, 20, '2025-03-07 12:17:16', '2025-03-07 12:17:16'),
(145, 139, 20, '2025-03-07 12:22:57', '2025-03-07 12:22:57'),
(146, 140, 26, '2025-03-07 12:23:05', '2025-03-07 12:23:05'),
(147, 140, 27, '2025-03-07 12:23:05', '2025-03-07 12:23:05'),
(148, 141, 24, '2025-03-09 08:21:16', '2025-03-09 08:21:16'),
(149, 142, 20, '2025-03-09 08:21:27', '2025-03-09 08:21:27'),
(150, 143, 22, '2025-03-09 08:24:19', '2025-03-09 08:24:19'),
(151, 144, 25, '2025-03-09 08:24:28', '2025-03-09 08:24:28'),
(152, 145, 20, '2025-03-09 08:29:10', '2025-03-09 08:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('0b5ed025495008a307f6b06dd1e4cce2', 'i:1;', 1741257879),
('0b5ed025495008a307f6b06dd1e4cce2:timer', 'i:1741257879;', 1741257879),
('0c827637ba77c621d0421ac8086dc66f', 'i:1;', 1729654405),
('0c827637ba77c621d0421ac8086dc66f:timer', 'i:1729654405;', 1729654405),
('5bb3f71f6dfcb3b5ba48f2f0af2caa12', 'i:1;', 1741533714),
('5bb3f71f6dfcb3b5ba48f2f0af2caa12:timer', 'i:1741533714;', 1741533714),
('653b47229e1a4129727d395fa4347bba', 'i:1;', 1728059586),
('653b47229e1a4129727d395fa4347bba:timer', 'i:1728059586;', 1728059586),
('a3266ba74e7a58b7e9a5c974d9a602bc', 'i:2;', 1741328984),
('a3266ba74e7a58b7e9a5c974d9a602bc:timer', 'i:1741328984;', 1741328984),
('c525a5357e97fef8d3db25841c86da1a', 'i:1;', 1741379299),
('c525a5357e97fef8d3db25841c86da1a:timer', 'i:1741379299;', 1741379299),
('c6be2cf7c13d9a527ee2fe401bbae3c7', 'i:1;', 1741148839),
('c6be2cf7c13d9a527ee2fe401bbae3c7:timer', 'i:1741148839;', 1741148839),
('d2f1e3e5168c45793bed32847bedd22d', 'i:3;', 1737379536),
('d2f1e3e5168c45793bed32847bedd22d:timer', 'i:1737379536;', 1737379536),
('user3@gmail.com|127.0.0.1', 'i:3;', 1737379537),
('user3@gmail.com|127.0.0.1:timer', 'i:1737379537;', 1737379537);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_06_033312_add_two_factor_columns_to_users_table', 1),
(5, '2024_09_06_033356_create_personal_access_tokens_table', 1),
(6, '2024_09_06_034126_add_column_to_users', 2),
(7, '2024_09_06_090049_create_rooms_table', 3),
(8, '2024_09_09_051518_create_bookings_table', 4),
(9, '2024_09_09_103605_add_status_field_to_bookings', 5),
(10, '2024_09_10_030548_create_contacts_table', 6),
(11, '2024_09_10_064213_create_transactions_table', 7),
(12, '2024_09_10_072214_create_room_detail', 8),
(13, '2024_09_10_072611_add_column_to_transactions', 9),
(14, '2024_09_10_073116_add_column_to_bookings', 10),
(15, '2024_09_10_082218_add_column_to_bookings', 11),
(16, '2024_09_10_083744_add_column_to_contacts', 12),
(17, '2024_09_11_035340_create_payments_table', 13),
(18, '2024_09_11_044506_add_to_booking_detail', 14),
(19, '2024_09_11_130443_add_column_to_bookings', 15),
(20, '2024_09_11_133425_create_carts_table', 16),
(21, '2024_09_11_234022_add_column_to_carts', 17),
(22, '2024_09_12_005311_add_column_to_carts', 18),
(23, '2024_09_12_015753_add_column_to_carts', 19),
(24, '2024_09_18_040255_create_payment_table', 20),
(25, '2024_09_25_073440_create_room_types_table', 21),
(26, '2024_09_25_080606_add_column_to_rooms', 22),
(27, '2024_09_25_120018_add_column_to_room_types', 23),
(28, '2024_09_26_064748_add_column_to_rooms', 24),
(29, '2024_09_26_070404_add_column_to_bookings', 25),
(30, '2024_09_26_071942_add_column_to_booking_detail', 26),
(31, '2024_09_27_061443_create_cart_table', 27),
(32, '2024_09_27_144558_add_column_to_cart', 28),
(33, '2024_09_28_044708_add_jumlah_kamar_to_cart_table', 29),
(34, '2024_09_28_112456_add_jumlah_kamar_to_booking_detail', 30),
(35, '2024_09_28_115507_add_total_price_to_bookings', 31),
(36, '2024_10_16_162945_add_column_is_additional_bed', 32),
(37, '2024_10_17_185226_add_column_blob_path', 32),
(38, '2024_10_18_144847_adding_column_remarksand_fine_price', 32),
(39, '2024_10_22_064515_add_column_to_payment', 32),
(40, '2024_10_22_065008_add_column_to_payment', 33),
(41, '2024_10_29_144820_drop_column_jumlah_kamar_on_booking_detail', 34),
(42, '2024_10_29_144924_adding_column_jumlah_kamar_on_booking', 34),
(43, '2024_10_29_181459_adding_column_n_i_k_on_users', 34),
(44, '2024_10_30_160029_adding_column_alamat_on_users', 34),
(45, '2024_11_05_062238_add_column_to_room_types', 35),
(46, '2025_01_18_125944_add_booking_time_to_bookings_table', 36),
(47, '2025_03_05_054600_add_column_to_table_bookings', 37),
(48, '2025_03_05_074322_add_room_type_id_to_bookings_table', 38),
(50, '2025_03_06_063015_add_feedback_columns_to_bookings_table', 39),
(51, '2025_03_07_193011_added_new_table_master_role', 40);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('radithya.romero@gmail.com', '$2y$12$EFEGSdjD3Ns734X0G/ylVeO9t3B9PcSCx4hQQvFxtwvhHo3JJbSC6', '2025-03-03 00:11:13'),
('radithyaromero123@gmail.com', '$2y$12$7L4c4CRmMCpz8s8yTg24KeBJzombj3hlDQTfVZJgzZY9IJFsGtb9C', '2025-02-14 18:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `checkout_link` varchar(255) DEFAULT NULL,
  `external_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `booking_id`, `user_id`, `checkout_link`, `external_id`, `status`, `expired_at`, `created_at`, `updated_at`) VALUES
(64, 126, 10, 'https://checkout-staging.xendit.co/web/67c93287e8f9c4f4c32b7d54', 'pym-126', 'paid', '2025-03-06 05:28:54', '2025-03-05 22:28:40', '2025-03-05 22:28:54'),
(66, 128, 2, 'https://checkout-staging.xendit.co/web/67c97bf20742a89aa327e5e6', 'pym-128', 'paid', '2025-03-06 10:42:04', '2025-03-06 03:41:56', '2025-03-06 03:42:04'),
(67, 129, 10, 'https://checkout-staging.xendit.co/web/67ca720922fe7668f47f83a6', 'pym-129', 'paid', '2025-03-07 04:14:53', '2025-03-06 21:11:52', '2025-03-06 21:11:55'),
(68, 130, 10, 'https://checkout-staging.xendit.co/web/67ca720922fe7668f47f83a6', 'pym-130', 'paid', '2025-03-07 04:12:29', '2025-03-06 21:11:52', '2025-03-06 21:12:29'),
(69, 131, 5, 'https://checkout-staging.xendit.co/web/67cb268c662982947b97149e', 'pym-131', 'pending', '2025-03-07 17:02:03', '2025-03-07 10:02:03', '2025-03-07 10:02:03'),
(70, 132, 5, 'https://checkout-staging.xendit.co/web/67cb268c662982947b97149e', 'pym-132', 'pending', '2025-03-07 17:02:03', '2025-03-07 10:02:03', '2025-03-07 10:02:03'),
(71, 133, 5, 'https://checkout-staging.xendit.co/web/67cb2877172cc1793348f02e', 'pym-133', 'paid', '2025-03-07 17:19:38', '2025-03-07 10:10:13', '2025-03-07 10:19:38'),
(72, 134, 5, 'https://checkout-staging.xendit.co/web/67cb2877172cc1793348f02e', 'pym-134', 'paid', '2025-03-07 17:19:38', '2025-03-07 10:10:13', '2025-03-07 10:19:38'),
(73, 135, 5, 'https://checkout-staging.xendit.co/web/67cb45a46629826231974315', 'pym-135', 'pending', '2025-03-07 19:14:45', '2025-03-07 12:14:44', '2025-03-07 12:14:45'),
(74, 136, 5, 'https://checkout-staging.xendit.co/web/67cb45a46629826231974315', 'pym-136', 'pending', '2025-03-07 19:14:45', '2025-03-07 12:14:44', '2025-03-07 12:14:45'),
(75, 137, 5, 'https://checkout-staging.xendit.co/web/67cb4640662982bbd09743cc', 'pym-137', 'pending', '2025-03-07 19:17:20', '2025-03-07 12:17:19', '2025-03-07 12:17:20'),
(76, 138, 5, 'https://checkout-staging.xendit.co/web/67cb4640662982bbd09743cc', 'pym-138', 'pending', '2025-03-07 19:17:20', '2025-03-07 12:17:20', '2025-03-07 12:17:20'),
(77, 139, 5, 'https://checkout-staging.xendit.co/web/67cb479c172cc17485491dfc', 'pym-139', 'paid', '2025-03-07 19:23:15', '2025-03-07 12:23:08', '2025-03-07 12:23:15'),
(78, 140, 5, 'https://checkout-staging.xendit.co/web/67cb479c172cc17485491dfc', 'pym-140', 'paid', '2025-03-07 19:23:15', '2025-03-07 12:23:08', '2025-03-07 12:23:15'),
(79, 141, 5, 'https://checkout-staging.xendit.co/web/67cdb2b20bd25f2fb002eb8d', 'pym-141', 'paid', '2025-03-09 15:24:41', '2025-03-09 08:24:32', '2025-03-09 08:24:41'),
(80, 142, 5, 'https://checkout-staging.xendit.co/web/67cdb2b20bd25f2fb002eb8d', 'pym-142', 'paid', '2025-03-09 15:24:41', '2025-03-09 08:24:32', '2025-03-09 08:24:41'),
(81, 143, 5, 'https://checkout-staging.xendit.co/web/67cdb2b20bd25f2fb002eb8d', 'pym-143', 'paid', '2025-03-09 15:24:41', '2025-03-09 08:24:32', '2025-03-09 08:24:41'),
(82, 144, 5, 'https://checkout-staging.xendit.co/web/67cdb2b20bd25f2fb002eb8d', 'pym-144', 'paid', '2025-03-09 15:24:41', '2025-03-09 08:24:32', '2025-03-09 08:24:41'),
(83, 145, 5, 'https://checkout-staging.xendit.co/web/67cdb3cd0bd25f4f0a02ed35', 'pym-145', 'paid', '2025-03-09 15:29:31', '2025-03-09 08:29:15', '2025-03-09 08:29:31');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Admin', '2025-03-07 12:45:17', '2025-03-07 12:45:17'),
(4, 'Owner', '2025-03-07 12:45:17', '2025-03-07 12:45:17'),
(5, 'User', '2025-03-07 12:45:17', '2025-03-07 12:45:17');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `roomType_id` bigint(20) UNSIGNED NOT NULL,
  `room_number` varchar(255) DEFAULT NULL,
  `status` enum('ready','not_ready') NOT NULL DEFAULT 'ready',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `roomType_id`, `room_number`, `status`, `created_at`, `updated_at`) VALUES
(20, 7, '101', 'ready', '2024-09-25 05:17:29', '2025-03-03 00:15:07'),
(21, 7, '102', 'ready', '2024-09-25 05:17:38', '2024-11-09 00:44:34'),
(22, 10, '103', 'ready', '2024-09-25 05:17:46', '2024-11-04 21:37:31'),
(24, 6, '104', 'ready', '2024-09-26 01:26:29', '2025-03-06 21:16:03'),
(25, 11, '206', 'ready', '2024-09-26 01:26:42', '2024-11-04 21:37:53'),
(26, 8, '201', 'ready', '2024-09-26 01:26:49', '2025-03-06 21:15:57'),
(27, 8, '202', 'ready', '2024-11-04 21:38:10', '2025-03-06 21:15:57'),
(28, 12, '203', 'ready', '2024-11-04 21:38:19', '2024-11-04 21:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `facility` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `capacity_kids` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `price`, `image`, `facility`, `capacity`, `capacity_kids`, `created_at`, `updated_at`) VALUES
(6, 'Family Room', 400000, '1730792847.jpg', 'Double bed, Single bed kamar mandi dalam, TV, WIFI', 3, 1, '2024-09-25 05:13:37', '2024-11-05 00:47:27'),
(7, 'Standard Double', 220000, '1730781293.jpg', 'Double bed, kamar mandi dalam, TV, WIFI', 2, 1, '2024-09-25 05:15:18', '2024-11-04 23:37:12'),
(8, 'Ekonomi', 200000, '1730781262.jpg', 'Double bed, kamar mandi luar, TV, WIFI', 2, 0, '2024-09-25 05:15:59', '2024-11-04 23:37:24'),
(10, 'Twin', 250000, '1730780757.jpg', 'Twin bed, kamar mandi dalam, TV, WIFI', 2, 1, '2024-11-04 21:25:57', '2024-11-04 23:36:53'),
(11, 'Twin besar', 300000, '1730780820.jpg', 'Twin double bed, kamar mandi dalam, TV, WIFI', 2, 2, '2024-11-04 21:27:00', '2024-11-04 23:36:17'),
(12, 'Double Besar', 300000, '1730781086.jpg', 'Double bed, kamar mandi dalam, TV, WIFI', 2, 2, '2024-11-04 21:31:26', '2024-11-04 23:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8qVEjqDK9eJYN2jiXTOm7YKj6v45LLE81M6q4LtC', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRUk1RExzZ2FIRThOb1JYTnhZWk9aZVlERUNYUVhhV1FPTzk5bWlYayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yb2xlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1741535923),
('e9Ob9ip88Yi3Wg4hFqTxHCKkdT94keCe90Kt9lSA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiczBmalowY29vWjZzMHBZUGc0NUFabWtZbHQ1TG5CMkRhUzIydjZtYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1741533098);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `blob_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `nik`, `phone`, `email`, `alamat`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `blob_path`) VALUES
(1, 3, 'Admin', NULL, '081268682931', 'admin@gmail.com', NULL, NULL, '$2y$12$ltIDWFc0ObhMEdAV2NVn/ueEV7otk.KX7wqrgDCEAefkQaV0fGHL.', NULL, NULL, NULL, '6lxbh7Tozdhu8ikFUtvYo0RXEN6ReEQxuqoCoEh9PbECXLLUVQBwmiv4K5LF', NULL, NULL, '2024-09-05 20:48:46', '2025-03-09 08:49:46', NULL),
(2, 3, 'user', NULL, '081268682963', 'user@gmail.com', 'Kota Padang', NULL, '$2y$12$7tc1kglS0cRPqbkIbida2e4g7EHDXOlzsKdmDAFzKN3Y6fmn.Xl6G', NULL, NULL, NULL, 'WComMns6OBPpVoaDGZ6Enrad0HnKH9P5yeEtVM4htuttV0gIF52bI5FS08vA', NULL, NULL, '2024-09-05 20:49:53', '2025-03-09 08:47:59', '/storage/blob/1740980093_1726838838861.jpg'),
(5, 4, 'owner', NULL, '98327470324324', 'owner@gmail.com', NULL, NULL, '$2y$12$5.z829C3YPnbN7iDNSj8auBHFWWmh4nMS8.dWZvMntFSfUcGSkOFq', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-22 00:39:27', '2025-03-08 07:55:18', NULL),
(8, 3, 'radithya', '1027462947295572', '081268682963', 'radithyaromero123@gmail.com', NULL, NULL, '$2y$12$2CqJB4izIaW1/GzCJM/pwOe9SgiesX7HwAZwrwKu5rBw3jFxx6Ho6', NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-16 06:30:08', '2025-03-08 07:56:42', NULL),
(10, 4, 'Radithya', '1371081910020006', '081268682931', 'radithya.romero@gmail.com', NULL, NULL, '$2y$12$2SyWNJSim3KaYKIh4vflKurordBwZ6Us7xkWdwKxhM72O18AY7Gwm', NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-03 00:10:54', '2025-03-03 00:10:54', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_detail_room_id_foreign` (`room_id`),
  ADD KEY `booking_detail_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_roomtype_id_foreign` (`roomType_id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nik_unique` (`nik`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD CONSTRAINT `booking_detail_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_detail_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_roomtype_id_foreign` FOREIGN KEY (`roomType_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
