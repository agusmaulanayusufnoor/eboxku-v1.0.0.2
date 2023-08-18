-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Aug 18, 2023 at 02:31 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eboxku`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `type`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `kantor_id`) VALUES
(1, 'agus maulana yusuf noor', 'agus', 'admin', 'agus@bprku.com', NULL, '$2y$10$QdQkp34aErSGOS8w6Q6ciuqSMHrK6/WbKAH0qGjcRvFo61/rggOZu', NULL, '2022-02-28 11:09:42', '2022-02-28 11:09:42', 1),
(2, 'dikdik', 'dikdik', 'admin', NULL, NULL, '$2y$10$norXwxkAr3pd0PkNSwHh6.MaBHMeg6dFH8pRwv8cWfMUhFCwJI3kO', NULL, '2022-02-28 12:03:08', '2022-03-06 11:02:30', 1),
(3, 'tanti aja', 'tanti', 'akunting', NULL, NULL, '$2y$10$ef7QZaK8fNAkfHigeVri4usPIKUZoV3OlAtc89/KEABor1wt90hYW', NULL, '2022-03-07 02:38:19', '2022-03-07 02:38:19', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
