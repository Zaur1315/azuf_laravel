-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 26 2023 г., 09:22
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `azuf_lar`
--

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
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
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(20, '2014_10_12_000000_create_users_table', 1),
(21, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(22, '2019_08_19_000000_create_failed_jobs_table', 1),
(23, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(24, '2023_07_27_064830_create_payment_info_table', 1),
(25, '2023_08_22_070433_create_payment_pages_table', 1),
(26, '2023_08_22_080639_add_slug_to_payment_pages', 1),
(27, '2023_08_22_082558_add_payment_page_id_to_payment_info_table', 1),
(34, '2014_10_12_100000_create_password_resets_table', 2),
(35, '2023_09_11_070219_add_login_role_to_user_table', 2),
(36, '2023_09_13_123958_add_active_col_to_users_table', 2),
(38, '2023_09_15_101311_add_show_column_to_payment_pages_table', 3),
(39, '2023_09_20_053155_add_deleted_at_to_users_table', 4),
(40, '2023_10_18_072221_create_sessions_table', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `payment_info`
--

CREATE TABLE `payment_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `public_id` varchar(100) NOT NULL,
  `order_num` varchar(100) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `card` varchar(20) NOT NULL,
  `date` varchar(25) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fin` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `order_amount` varchar(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_page_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `payment_info`
--

INSERT INTO `payment_info` (`id`, `public_id`, `order_num`, `order_status`, `card`, `date`, `card_name`, `customer_email`, `customer_ip`, `phone`, `fin`, `first_name`, `last_name`, `order_amount`, `subject`, `description`, `created_at`, `updated_at`, `payment_page_id`) VALUES
(1, 'public_id1', 'order_num1', 'order_status	1', 'dasdsadsa', 'dasdsadasdsa', 'dsadsafdgsadfdfgf', 'Мейл', '1a1.23s5', '+456778', 'sd56as4d', 'zaur', 'Huseynzade', '100', 'sadasf', 'dasdf', NULL, NULL, 1),
(2, 'public_id2', 'order_num2', 'order_status3', 'gfzxcfvgbhnjmk,', 'dsa1d564', 'xcvbnm,', 'zaza@fdd', 'xcvbnm,', 'cvbnm,', 'xcvbnm', 'xcvbnm', 'xcvbnmxdfg', '50', 'reerbsdfgdsf', 'fghjklsrtrytuyiokccvfbgnhmjkj', NULL, NULL, 5),
(3, 'DASDASDASD1213', '1D23SA1D3AS1', '', '', '', 'DSADSA', 'DASD', '1AS2D132SA', '216354651.21561', 'DS2A3', 'ASDD', 'ASDDAA', '150', 'dsada', '', NULL, NULL, 1),
(4, 'dcfvgbhnmj', 'sxdcfvgbhnjmk,l', '12345678', '213453657853', '', '4325774898798652', '3246556774553', '34243424', '4324234242', '43234324234', '4324324324234324234', 'ewrwerewrwe', '500', 'test Subject 1', '', NULL, NULL, 1),
(5, 'вфывыф', 'фывфывфывфы', 'Success', 's3a1d32as1d', '', 'sdfdsf', 'fsdfdsf', 'dsfsdfds', 'fdsfdsf', 'fsdfds', 'sdfdsfs', 'sdfdsf', '50', '', '', NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `payment_pages`
--

CREATE TABLE `payment_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `show` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `payment_pages`
--

INSERT INTO `payment_pages` (`id`, `subject`, `description`, `is_active`, `created_at`, `updated_at`, `slug`, `show`) VALUES
(1, 'test Subject 12', 'Test Description 1', 1, '2023-08-23 09:49:32', '2023-09-27 01:16:46', 'string', 1),
(4, 'Test subject 2aa', 'Test descriprion 22', 1, '2023-08-23 09:49:32', '2023-10-25 01:47:46', 'sluf2', 0),
(5, 'Test subject 3', 'Test description 3', 1, '2023-08-23 09:49:32', '2023-10-25 09:34:29', 'sluf3\r\n', 1),
(6, 'fsdfjhgj', 'fdsf', 1, '2023-08-23 09:49:32', '2023-09-18 04:05:20', 'fsdfjhgj', 0),
(7, 'Новая страница', 'fdsf', 1, '2023-08-23 09:49:46', '2023-09-18 04:07:29', 'novaia-stranica', 1),
(8, 'Title 189', '12255646sdad5a6sd785', 1, '2023-09-11 03:21:47', '2023-09-11 03:21:47', 'title-189', 1),
(9, 'Another Titleяя', 'Another desc', 1, '2023-09-13 07:19:43', '2023-09-18 03:39:19', 'another-title', 1),
(10, 'subject123', '56456', 1, '2023-09-13 08:16:21', '2023-09-13 08:16:21', 'subject123', 1),
(11, 'dsds8889', '78944456', 1, '2023-09-13 08:17:31', '2023-09-13 08:17:31', 'dsds8889', 1),
(12, 'hgfh', 'hfgh11', 1, '2023-09-14 08:41:19', '2023-09-18 03:42:52', 'hgfh', 1),
(13, 'subject', 'ddasdsadas', 1, '2023-09-18 01:48:30', '2023-09-18 01:48:30', 'subject', 1),
(14, 'asd', 'asd', 1, '2023-09-22 03:56:46', '2023-09-22 03:56:46', 'asd', 1),
(15, 'asd', 'asdasd', 1, NULL, NULL, '', 1),
(17, 'subjectzaq', '14455123456', 1, '2023-09-27 06:23:46', '2023-09-27 06:23:46', 'subjectzaq', 1),
(18, 'Zaur Test', 'dsa21d3as1d321as', 1, '2023-09-27 06:28:56', '2023-10-25 01:46:53', 'zaur-test', 0),
(19, 'subject145', '123123213', 1, '2023-10-25 09:31:33', '2023-10-25 09:31:33', 'subject145', 1),
(20, 'фывыфв', 'ыфвыфвф', 1, '2023-10-25 09:34:35', '2023-10-25 09:34:35', 'fyvyfv', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
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
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'User',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `active`, `deleted_at`) VALUES
(2, 'Zaur Huseynzade1', 'zaur.quseynzade@gmail.com', NULL, '$2y$10$BH1oC9.SC7AXR08A.kbMz.W90JNA1oGhxOivJ9jhx5CeGAAqGgGti', 'U5jjZmLkhmBtbXOHZY5t8B1LlFYxnzBMzZURx4BJgYmaN7hlarhJAHGKFD8T', '2023-09-14 02:34:34', '2023-09-26 09:37:53', 'Admin', 1, NULL),
(3, 'William Shackspear Otto', 'ailetv1315@gmail.com', NULL, '$2y$10$V0TjYFCowis2znwKFix8SOobPGZW42RQLmM73su0AeB19lcsEmtgK', NULL, '2023-09-14 08:11:28', '2023-10-10 09:35:56', 'Admin', 1, NULL),
(4, 'Zaur Huseynzade', 'zaur.quseynzadze@gmail.com', NULL, '$2y$10$L6cHRTE4rC5tcH/QDwn9XeKmxzOYkcdDB9CmlRrUkolHOHRgBtd.G', NULL, '2023-09-15 04:00:23', '2023-10-11 05:05:17', 'Admin', 1, '2023-10-11 05:05:17'),
(5, 'Zaur Huseynzade', 'zaur.quseynzadzea@gmail.com', NULL, '$2y$10$DK2AEjboIhFmz.onpCVcNOF6eNE8MR13FeUwNOtgXiQeUqo/6qH.K', NULL, '2023-09-15 04:01:15', '2023-10-11 05:06:24', 'User', 1, '2023-10-11 05:06:24'),
(6, 'Zaur Huseynzade', 'zaur.quseynzade7@gmail.com', NULL, '$2y$10$8rTLoWj.HNnXj0KDKUJuteTyjYjhyYBjpbcRnQwMD.UtjOZ//kZ52', NULL, '2023-09-15 04:02:22', '2023-09-20 01:48:21', 'User', 1, '2023-09-20 01:48:21'),
(7, 'William Shackspear Otto2', 'ailetv1315@gmail.com1', NULL, '$2y$10$ZboPVFX7mAO7T16HNwAsfuYGwCKMq2DKGSDr7EDZLp8QNrcYcUd.q', NULL, '2023-09-15 07:09:53', '2023-10-11 05:03:39', 'User', 1, '2023-10-11 05:03:39'),
(8, 'test886', 'zaur@gmail.com', NULL, '$2y$10$W5htg.mD.PTe09HSjmufieLFuU4H1QSzUk.FXWBRzl52jiofTKVze', 'GS16jj8i92btvSiOlPxDD9MT4qLzAKOerET8pl8LBfbvjX7yeliItJcj5rlX', '2023-09-18 01:38:43', '2023-10-11 06:15:48', 'User', 1, '2023-10-11 06:15:48'),
(9, 'Zaur Huseynzade8669', 'zaur.quseynzade1478@gmail.com', NULL, '$2y$10$.SiboWDrXcO5M7G4gvgcD.Sss92DnjgDgd2ChjwA.og0oEeH6U/fK', NULL, '2023-09-18 01:48:22', '2023-09-22 03:55:25', 'Admin', 1, '2023-09-22 03:55:25'),
(10, 'zazaza', 'zazaza@zz', NULL, '$2y$10$Lg7ceLM29aneZJHy8MnI6.qMOtpu1kZIW0nDX1raQiycBZtED5uti', NULL, '2023-09-18 06:06:36', '2023-09-20 01:50:51', 'User', 1, '2023-09-20 01:50:51'),
(11, 'hfgh', 'fhfg@fddf', NULL, '$2y$10$F6G8BetR9695KnTT5W.06.JyYgxSZ.eZwjvRLHXeU1xtWXbucHtSS', NULL, '2023-09-19 03:09:11', '2023-09-20 01:51:11', 'User', 1, '2023-09-20 01:51:11'),
(12, 'William Shackspear Otto', 'ailetv1315@gmail.com5', NULL, '$2y$10$91lVRPamK1ANW2kDxVUaAOiD69lt.oGVZ8CHGf8YyCKiGeT44m92G', NULL, '2023-09-20 09:22:26', '2023-09-20 09:22:33', 'User', 1, '2023-09-20 09:22:33'),
(13, 'William Shackspear Ottozzzaqzaq', 'ailetv13115@gmail.com', NULL, '$2y$10$BRb8F2vHrjS9SdEggLPZau6CX9koSgmI4HnYy2lYmqaAsgHBfy5De', 'GMfVevNw96LMR2jBw6lxHm6Lf2vKWWLCDSOjgzKXSQ7sLITSP7ffHZ3ziHWT', '2023-09-22 03:55:10', '2023-10-10 08:11:48', 'User', 1, '2023-10-10 08:11:48'),
(14, 'Тест', 'test@gmail.com', NULL, '$2y$10$he9IuhuNhufE.f5FvHGy3u1QXYm/.kWPRTQHKzNVDf54xTEf../Mi', NULL, '2023-09-26 09:24:40', '2023-09-26 09:34:25', 'User', 1, '2023-09-26 09:34:25'),
(15, 'zaza', 'tim@tom.aom', NULL, '$2y$10$vvLXTDQITf1dzYbGjrpcLudvY1b/89GhrXA9Ub0SiYrso3TZsZTKO', NULL, '2023-10-11 01:23:19', '2023-10-11 05:00:30', 'User', 1, '2023-10-11 05:00:30'),
(16, 'gfh', 'dasda@fd.dd', NULL, '$2y$10$VemQkscaj2Ac5onlYd0LfOmGvQisxhvU/CiubNqg7PqlFbcZjIiHS', NULL, '2023-10-11 05:26:40', '2023-10-11 05:27:40', 'User', 1, '2023-10-11 05:27:40'),
(17, 'dsfdsf', 'sss@ds.15', NULL, '$2y$10$oGLFAcpWz.l7JpQ4b/HZmOET1pycJhbc0v2YTnh.AcHbQQTKTg8U6', NULL, '2023-10-11 05:43:40', '2023-10-11 05:46:40', 'User', 1, '2023-10-11 05:46:40'),
(18, 'ыфвыфвыф', 'aqq@aa.aa', NULL, '$2y$10$JxnnT655fqFJ2JH81SUuS.fCoWKCtNZlHwO8z1mPCyIFRoVM5HeZC', NULL, '2023-10-11 05:48:15', '2023-10-11 05:52:04', 'Admin', 1, '2023-10-11 05:52:04'),
(19, 'William Shackspear Otto1558611', 'ailetv131145@gmail.com', NULL, '$2y$10$YNGZDm20wlFvZejN9PkBzOW4Nw/wCDGt1tmRiuXKSB0pwLVOcF.qK', NULL, '2023-10-18 09:37:08', '2023-10-25 05:16:54', 'User', 1, NULL),
(20, 'zzaza', 'zaz@gmail.com', NULL, '$2y$10$mm500R1p.XMO1COZwxBhL.NdBJrja//co8zFBgO8jQmr51sP67.lS', NULL, '2023-10-25 01:30:11', '2023-10-25 09:34:18', 'User', 1, '2023-10-25 09:34:18'),
(21, 'z1z1z1z', 'z1z1z@gmail.com', NULL, '$2y$10$N3j5xg.cJv8ys54qXI6zaee/xDOUfd9s/pwberZi3yopFlHH4/moK', NULL, '2023-10-25 01:48:41', '2023-10-25 01:49:15', 'User', 1, '2023-10-25 01:49:15');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_info_payment_page_id_foreign` (`payment_page_id`);

--
-- Индексы таблицы `payment_pages`
--
ALTER TABLE `payment_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_pages_slug_unique` (`slug`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `payment_pages`
--
ALTER TABLE `payment_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `payment_info`
--
ALTER TABLE `payment_info`
  ADD CONSTRAINT `payment_info_payment_page_id_foreign` FOREIGN KEY (`payment_page_id`) REFERENCES `payment_pages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
