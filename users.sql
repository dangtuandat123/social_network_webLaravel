-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th1 04, 2026 lúc 06:22 PM
-- Phiên bản máy phục vụ: 10.11.15-MariaDB-cll-lve
-- Phiên bản PHP: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sx8g2iatb3kc_web_social`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `level` tinyint(4) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `level`, `password`, `gender`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'VTV24', 'a@a.com', NULL, 1, '$2y$12$1jLETK1z2aHJ2R.UIVMeVeL/gMcSLzRip9QlsDuB0LEI8p7X9c5XC', 'male', 'avatars/A68RGXbhv8lclfbOcrrfzGceVgMaL8LuwMT8oqGa.jpg', NULL, '2026-01-03 02:57:51', '2026-01-03 22:05:30'),
(3, 'dang tuan', 'b@b.com', NULL, 1, '$2y$12$i0hNgM/i3utZfKRB95wceeo3oBjtCJ9En9XWPEIsd7BWLUubQ.Nc.', 'male', 'avatars/bYIPgG33oKpUnWeOr4mmDIaOwofl5ycZHShLq3So.jpg', NULL, '2026-01-03 22:16:19', '2026-01-03 22:17:02'),
(4, 'dang tuan2', 'adsad@gmail.com', NULL, 0, '$2y$12$zQNd60W3QPyMXBKEJJnLpubbtYHYlzeabXceJ3waCcoYfUsl9ObyO', 'male', NULL, NULL, '2026-01-04 04:18:31', '2026-01-04 04:18:31'),
(5, 'ádasdasdas', 'aa@b.com', NULL, 0, '$2y$12$V56vIrgtJX4In5g03u1Wc.xphgVFIM.ZlujKhUkX5zno5At441Bwm', 'male', NULL, NULL, '2026-01-04 04:19:32', '2026-01-04 04:19:32');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
