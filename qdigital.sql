-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 23 Oca 2020, 10:47:58
-- Sunucu sürümü: 5.7.28-0ubuntu0.19.04.2
-- PHP Sürümü: 7.2.24-0ubuntu0.19.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `qdigital`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_01_22_143723_create_roles_table', 1),
(4, '2020_01_22_143815_create_role_user_table', 1),
(5, '2020_01_22_153410_create_sales_table', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(2, 2, '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(3, 3, '2020-01-22 13:13:54', '2020-01-22 13:13:54');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 4, 300, '2020-01-22 14:52:59', '2020-01-22 14:52:59'),
(2, 5, 345, '2020-01-22 14:52:59', '2020-01-22 14:52:59'),
(3, 6, 440, '2020-01-22 14:52:59', '2020-01-22 14:52:59'),
(4, 7, 215, '2020-01-22 14:52:59', '2020-01-22 14:52:59'),
(5, 8, 325, '2020-01-22 14:52:59', '2020-01-22 14:52:59'),
(6, 9, 165, '2020-01-22 14:52:59', '2020-01-22 14:52:59'),
(7, 10, 225, '2020-01-22 14:52:59', '2020-01-22 14:52:59'),
(8, 11, 120, '2020-01-22 14:52:59', '2020-01-22 14:52:59'),
(9, 9, 200, '2020-01-23 07:38:34', '2020-01-23 07:38:43');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `started_at` date NOT NULL DEFAULT '2020-01-22',
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `started_at`, `parent`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mehmet Manager', 'mehmet@gmail.com', '$2y$10$vloyiOhPVbZrbbq1o4V/H.L3Tv5QDLV8YduN8AKf49jumMVoOhtTu', '2020-01-22', NULL, '6XGjXSW9XVXLaaS45AX56vtIY9KRUQ4KwE6GxTv5XApwHhxuMRm6UxWJcgcJ', '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(2, 'Ahmet Director', 'ahmet@gmail.com', '$2y$10$Y./BbeQahXUQ40YGp4T1r.mBz/bOYVDJdTuJDEL9AL9w4/udReO2q', '2020-01-22', 1, 'fsIKE0hYdniTR1UzrGt58yU1NRN8ATvt4kSgxjqV4JDCoU4tXPDVMArLHSxE', '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(3, 'Mustafa Director', 'mustafa@gmail.com', '$2y$10$/qMEaMv/MScHKaSD7rU4f.GhK9B.DH/Z1T9YziR3U.IwaFi.A.7Fy', '2020-01-22', 1, 'CtSK41fCrvoaAdd2D10GZ4J5VghdC8Gr8lKQV92HECTMQPpqBtNpQFucEpmZ', '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(4, 'Ali', 'ali@gmail.com', '$2y$10$0tDaQc4WmHpJg17EXV4ZZeRniEQ9fqpcUxvaV8X53kVcdVvTc39YC', '2020-01-20', 2, 'FjRtUBEAhlKoHTNVnG5hqcJbQOY9b9TtD4A3cqPXPJx9gpn1O6JlpMUaa1ZS', '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(5, 'Burak', 'burak@gmail.com', '$2y$10$y/2x47wqm10Yv/55INgwM.54GPnVZOa5To9qpVDHXChAvXIWwI5jy', '2020-01-18', 2, 'mstlXoFfYecxTZQpRagfZWmRKrfYbWc6pghjU7vfyB0lGwkb5HNmY3coRBCa', '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(6, 'Cem', 'cem@gmail.com', '$2y$10$dZs0Csj4uBBMjuV/kdHS7e4Fh6fdiAmjYFfDDGBuhT3Vflo9m7j8.', '2020-01-16', 2, 'SkzT0gPuWLMF02akOygfzBvpoXjppGC8i8JyjAJK4Iwrin12hoRfqGGZwTPI', '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(7, 'Dogukan', 'dogukan@gmail.com', '$2y$10$IbNCca.2Hn4OW.YG/RNJbOVz6yD7tbS3J1EwgW00dF0QRcKRtqtui', '2020-01-14', 2, 'H6nNQ3meqLuys7XCMWo5qt9794ZS4rhKNqJummqAvislGeVzLchLOrZKnnnW', '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(8, 'Erim', 'erim@gmail.com', '$2y$10$C.PI1gfezOOVupEYrrnSYOqlb8yLr1gGZ9tX.d2HoobfKQRuN2zP6', '2020-01-12', 2, 'hy7ziqPeio51CezHakMUqHeJZ0RQpIHiKr4D1k32of3As3BYT6x9swwr3lak', '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(9, 'Cansu', 'cansu@gmail.com', '$2y$10$9TKcZ3e1SLLf2S5XDCO.HetwGKp4FXXXlxEeQ.Vh9yLJcZdCLVUgO', '2020-01-20', 3, 'OoZgTCdEda7MwnqfDBH60b5GNq4FdDJUs5Uyz8OsuVqayOCJRqddIEEzINcP', '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(10, 'Ece', 'ece@gmail.com', '$2y$10$0/ti51LkuAqC1tHZtzU9r.DRmUp8SSpQQU0/I6DvBQsYfJAKy/QFi', '2020-01-18', 3, '7lWQlyc9Vx7uvfRuPIOL7Iu3dSQxnSw4O2pivchYFtzpji7NUhd7u78DsPlz', '2020-01-22 13:13:54', '2020-01-22 13:13:54'),
(11, 'Gizem', 'gizem@gmail.com', '$2y$10$EW5tcEWUEdWNuBXqtMAiJeTobKuRkikfEUc6oIviMEo5pm0fJgvqq', '2020-01-16', 3, 'Sgv6pc2WBCOYgDMcp4Xx9ATl8lXBn12cfbxfgOqEd1Cms1x3VzWvY3Pr1vRm', '2020-01-22 13:13:55', '2020-01-22 13:13:55');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Tablo için indeksler `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Tablo için AUTO_INCREMENT değeri `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
