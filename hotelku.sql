-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table hotelku.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `room_id` bigint unsigned NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `guest` int unsigned NOT NULL,
  `total_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','confirmed','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_room_id_foreign` (`room_id`),
  CONSTRAINT `bookings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.bookings: ~2 rows (approximately)
INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `check_in`, `check_out`, `guest`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, '2026-10-29', '2026-10-30', 1, 250000.00, 'confirmed', '2026-07-18 11:03:28', '2026-07-18 11:14:42'),
	(2, 2, 2, '2026-10-30', '2026-10-31', 2, 250000.00, 'confirmed', '2026-07-18 12:08:57', '2026-07-18 12:10:21');

-- Dumping structure for table hotelku.booking_details
CREATE TABLE IF NOT EXISTS `booking_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `room_id` bigint unsigned NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_details_booking_id_foreign` (`booking_id`),
  KEY `booking_details_room_id_foreign` (`room_id`),
  CONSTRAINT `booking_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_details_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.booking_details: ~0 rows (approximately)

-- Dumping structure for table hotelku.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.cache: ~0 rows (approximately)

-- Dumping structure for table hotelku.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.cache_locks: ~0 rows (approximately)

-- Dumping structure for table hotelku.facilities
CREATE TABLE IF NOT EXISTS `facilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.facilities: ~6 rows (approximately)
INSERT INTO `facilities` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'Free WiFi', NULL, 'facilities/H211BKm2RCEUVDy4ZU1I8ZB1xwlnD03vKRIhq9xU.jpg', '2026-07-18 07:53:54', '2026-07-18 08:08:41'),
	(2, 'Kolam Renang', NULL, 'facilities/m6IVDDzjS4rglRFv1d1CxrI1BI1Sh4NPcBWqbCgd.jpg', '2026-07-18 07:53:54', '2026-07-18 08:10:11'),
	(3, 'Restaurant', NULL, NULL, '2026-07-18 07:53:54', '2026-07-18 07:53:54'),
	(4, 'Spa', NULL, NULL, '2026-07-18 07:53:54', '2026-07-18 07:53:54'),
	(5, 'Gym', NULL, NULL, '2026-07-18 07:53:54', '2026-07-18 07:53:54'),
	(6, 'Parkir Gratis', NULL, NULL, '2026-07-18 07:53:54', '2026-07-18 07:53:54');

-- Dumping structure for table hotelku.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table hotelku.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.jobs: ~0 rows (approximately)

-- Dumping structure for table hotelku.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.job_batches: ~0 rows (approximately)

-- Dumping structure for table hotelku.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.migrations: ~10 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_07_04_174316_add_role_phone_address_to_users_table', 1),
	(5, '2026_07_04_185425_create_room_types_table', 1),
	(6, '2026_07_04_185436_create_rooms_table', 1),
	(7, '2026_07_04_185444_create_facilities_table', 1),
	(8, '2026_07_04_185505_create_bookings_table', 1),
	(9, '2026_07_04_185514_create_booking_details_table', 1),
	(10, '2026_07_04_185522_create_payments_table', 1);

-- Dumping structure for table hotelku.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table hotelku.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','paid','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_booking_id_foreign` (`booking_id`),
  CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.payments: ~1 rows (approximately)
INSERT INTO `payments` (`id`, `booking_id`, `amount`, `payment_method`, `proof`, `status`, `created_at`, `updated_at`) VALUES
	(1, 2, 250000.00, 'Transfer BCA', 'payments/uldcm4YzLJBhqPBqOm7Fmd9kVGjT9kCFy3vlWK2i.jpg', 'paid', '2026-07-18 12:09:51', '2026-07-18 12:10:45');

-- Dumping structure for table hotelku.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `room_type_id` bigint unsigned NOT NULL,
  `room_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('available','occupied','maintenance') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rooms_room_number_unique` (`room_number`),
  KEY `rooms_room_type_id_foreign` (`room_type_id`),
  CONSTRAINT `rooms_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.rooms: ~8 rows (approximately)
INSERT INTO `rooms` (`id`, `room_type_id`, `room_number`, `status`, `image`, `created_at`, `updated_at`) VALUES
	(1, 1, '101', 'occupied', 'images/rooms/standard.jpg', '2026-07-18 07:53:54', '2026-07-18 11:03:28'),
	(2, 1, '102', 'occupied', 'images/rooms/standard.jpg', '2026-07-18 07:53:54', '2026-07-18 12:08:57'),
	(3, 1, '103', 'available', 'images/rooms/standard.jpg', '2026-07-18 07:53:54', '2026-07-18 07:53:54'),
	(4, 2, '201', 'available', 'images/rooms/deluxe.jpg', '2026-07-18 07:53:54', '2026-07-18 07:53:54'),
	(5, 2, '202', 'available', 'images/rooms/deluxe.jpg', '2026-07-18 07:53:54', '2026-07-18 07:53:54'),
	(6, 2, '203', 'available', 'images/rooms/deluxe.jpg', '2026-07-18 07:53:54', '2026-07-18 07:53:54'),
	(7, 3, '301', 'available', 'images/rooms/suite.jpg', '2026-07-18 07:53:54', '2026-07-18 07:53:54'),
	(8, 3, '302', 'available', 'images/rooms/suite.jpg', '2026-07-18 07:53:54', '2026-07-18 07:53:54');

-- Dumping structure for table hotelku.room_types
CREATE TABLE IF NOT EXISTS `room_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price_per_night` decimal(12,2) NOT NULL,
  `capacity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.room_types: ~3 rows (approximately)
INSERT INTO `room_types` (`id`, `name`, `description`, `price_per_night`, `capacity`, `created_at`, `updated_at`) VALUES
	(1, 'Standard', 'Kamar Standard dengan fasilitas lengkap', 250000.00, 2, '2026-07-18 07:53:54', '2026-07-18 07:53:54'),
	(2, 'Deluxe', 'Kamar Deluxe dengan pemandangan kota', 450000.00, 3, '2026-07-18 07:53:54', '2026-07-18 07:53:54'),
	(3, 'Suite', 'Kamar Suite terbaik HotelKu', 800000.00, 4, '2026-07-18 07:53:54', '2026-07-18 07:53:54');

-- Dumping structure for table hotelku.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('Ag2yTLN90k7MHVPczwOXJBzVOYf7cdTagdCrqBMY', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'eyJfdG9rZW4iOiIwdUxWbTBaTU8weUFYdWdidEZzemtqRHNVcVVzbzRQNXprSDExUTJLIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2N1c3RvbWVyXC9ib29raW5nXC8zIiwicm91dGUiOiJjdXN0b21lci5ib29raW5nLmNyZWF0ZSJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6Mn0=', 1784483953),
	('iic019F5ig2eLJRdyLjs9Yse0uSBpfSgQji7yb4c', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'eyJfdG9rZW4iOiJPbGhRNnIzWkxlQ3dEbWR4ckNJaVZwc0lWYzUzMlRiQ3BmYWJEbEt3IiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9kYXNoYm9hcmQifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1785076152);

-- Dumping structure for table hotelku.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hotelku.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `role`, `phone`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'admin@hotelku.com', 'admin', '081234567890', 'Medan', NULL, '$2y$12$tbg5SzMSrcHP3Poe0HGAyOGb2yL3suCY01innP/X5nq4yWwmR5J1C', NULL, '2026-07-18 07:53:53', '2026-07-18 07:53:53'),
	(2, 'Customer', 'customer@gmail.com', 'customer', NULL, NULL, NULL, '$2y$12$V6.iMCCRj.T3.yPdS1fkZ.olnQmGmsmR25vEewDBxRhIwR6m9aBY6', NULL, '2026-07-18 07:53:54', '2026-07-18 07:53:54');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
