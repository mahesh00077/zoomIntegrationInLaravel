-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2021 at 02:51 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zoomdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `meeting_tbl`
--

CREATE TABLE `meeting_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meeting_id` varchar(80) NOT NULL,
  `host_id` varchar(200) NOT NULL,
  `host_email` varchar(200) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `chstatus` varchar(50) NOT NULL,
  `start_time` varchar(100) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `timezone` varchar(100) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `start_url` text NOT NULL,
  `join_url` text NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meeting_tbl`
--

INSERT INTO `meeting_tbl` (`id`, `user_id`, `meeting_id`, `host_id`, `host_email`, `topic`, `type`, `chstatus`, `start_time`, `duration`, `timezone`, `created_date`, `start_url`, `join_url`, `password`, `created_at`, `updated_at`) VALUES
(3, 1, '82715003202', 'gF6Z6XQuRxuWgCLmnHDvjg', '6r.mahesh99cena@gmail.com', 'eror black screen', 2, 'waiting', '2021-01-22T12:37:24Z', '10', 'Asia/Calcutta', '2021-01-22T12:37:24Z', 'https://us05web.zoom.us/s/82715003202?zak=eyJ6bV9za20iOiJ6bV9vMm0iLCJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJjbGllbnQiLCJ1aWQiOiJnRjZaNlhRdVJ4dVdnQ0xtbkhEdmpnIiwiaXNzIjoid2ViIiwic3R5IjoxMDAsIndjZCI6InVzMDUiLCJjbHQiOjAsInN0ayI6IjVITE5MS1lpMEFhQ1BhTHJva0dranh1d1p5SzJVWVNOcmp1WEdkRE82QXcuQmdZc1dHdFZXa1JQWVUxbVkybzNkR0ZPY1ZwemNXOUpXRUZ3Tm1KR1QwVnZRMnd3U0VGVmJFZ3JUVEJ5YnoxQVkySTNNMkl4T0RkbE56RXlaVEpoWXpZMk9Ea3pPVGs1TnpBMk1tUm1Zekk0WTJVMlpXUmpaR0kzWXpZNE9ERTJOamhtWTJNM1pXTXpPRGMyTW1ObFpRQU1NME5DUVhWdmFWbFRNM005QUFSMWN6QTFBQUFCZHlvWmF0Z0FFblVBQUFBIiwiZXhwIjoxNjExMzI2MjQ0LCJpYXQiOjE2MTEzMTkwNDQsImFpZCI6Ing1ZXlES243VFdPMTZwWThrdm9OanciLCJjaWQiOiIifQ.aZXK24J6d7C7rwLVxFd7Mu4j1_9fsFBN8-61rsdVXH4', 'https://us05web.zoom.us/j/82715003202?pwd=R0RRRFBzMk9SZVI0aTNhRk1qR0dRZz09', '123456', '2021-01-22 07:07:25', '2021-01-22 07:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

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
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `access_token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `access_token`) VALUES
(4, '{\"access_token\":\"eyJhbGciOiJIUzUxMiIsInYiOiIyLjAiLCJraWQiOiJjMGNmYjlhYS1lZTdkLTRhZTctYTc3My1jZGMzOTIxNmZkOGUifQ.eyJ2ZXIiOjcsImF1aWQiOiI1OGRmZmFiYWU2ODk2MWFhMmJhNTY0MTAxZWEwNmNjYiIsImNvZGUiOiJCcTZCU1ZDTDMzX2dGNlo2WFF1Unh1V2dDTG1uSER2amciLCJpc3MiOiJ6bTpjaWQ6d3liUEFHV1JScUNGVTdYRHVsWG9tUSIsImdubyI6MCwidHlwZSI6MCwidGlkIjowLCJhdWQiOiJodHRwczovL29hdXRoLnpvb20udXMiLCJ1aWQiOiJnRjZaNlhRdVJ4dVdnQ0xtbkhEdmpnIiwibmJmIjoxNjExMTM1NjkwLCJleHAiOjE2MTExMzkyOTAsImlhdCI6MTYxMTEzNTY5MCwiYWlkIjoieDVleURLbjdUV08xNnBZOGt2b05qdyIsImp0aSI6IjUwMjhhMWRkLWViNWQtNDE3ZC05YmU4LWFiNWY4YWYyNjVmNSJ9.9QB1oYTKOXnngtC0ibr24GvUcILCohFtztbiA45618PWSpYRE0rjhU-ig6qEYawzqO_XeWO2Fj7CTBhnziEKtA\",\"token_type\":\"bearer\",\"refresh_token\":\"eyJhbGciOiJIUzUxMiIsInYiOiIyLjAiLCJraWQiOiJlODI4MDY5ZC1iNDM1LTQyN2MtOGZhYS1iNjllODk2OWFlZWUifQ.eyJ2ZXIiOjcsImF1aWQiOiI1OGRmZmFiYWU2ODk2MWFhMmJhNTY0MTAxZWEwNmNjYiIsImNvZGUiOiJCcTZCU1ZDTDMzX2dGNlo2WFF1Unh1V2dDTG1uSER2amciLCJpc3MiOiJ6bTpjaWQ6d3liUEFHV1JScUNGVTdYRHVsWG9tUSIsImdubyI6MCwidHlwZSI6MSwidGlkIjowLCJhdWQiOiJodHRwczovL29hdXRoLnpvb20udXMiLCJ1aWQiOiJnRjZaNlhRdVJ4dVdnQ0xtbkhEdmpnIiwibmJmIjoxNjExMTM1NjkwLCJleHAiOjIwODQxNzU2OTAsImlhdCI6MTYxMTEzNTY5MCwiYWlkIjoieDVleURLbjdUV08xNnBZOGt2b05qdyIsImp0aSI6Ijg4ODdkZDQzLTVlOGQtNDE4My1hOTI3LTE5ZDYyOGU4OGUxMyJ9.wCEf3R9zcJpG6nVieUMwbuierP2cZvHUEkOjiIhlDAOVOSDaBC37891H2Nrn7Z0n5fWXBfcijdvHDdYGCQYnTg\",\"expires_in\":3599,\"scope\":\"meeting:master meeting:read:admin meeting:write:admin webinar:master webinar:read:admin webinar:write:admin\"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile_no`, `email`, `email_verified_at`, `role`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '9876543212', 'admin@gmail.com', NULL, '1', '$2y$10$gwdV0UCZD5GxNAJsb7F0pOVRBv.VOruRegunuY7Qe4z24sbv4BDIG', '1', NULL, '2021-01-21 02:08:25', '2021-01-21 02:08:25'),
(2, 'kk', '9876543212', 'kk@gmail.com', NULL, '2', '$2y$10$gwdV0UCZD5GxNAJsb7F0pOVRBv.VOruRegunuY7Qe4z24sbv4BDIG', '1', NULL, '2021-01-21 02:08:25', '2021-01-21 02:08:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meeting_tbl`
--
ALTER TABLE `meeting_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `meeting_tbl`
--
ALTER TABLE `meeting_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
