-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Aug 18, 2023 at 02:32 PM
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

--
-- Dumping data for table `statuspermohonan`
--

INSERT INTO `statuspermohonan` (`id`, `statuspermohonan`, `created_at`, `updated_at`) VALUES
(1, 'Proses [analisa]', '2023-08-18 12:36:21', '2023-08-18 12:37:00'),
(2, 'Proses [disetujui]', '2023-08-18 12:36:32', '2023-08-18 12:37:06'),
(3, 'Ditolak', '2023-08-18 12:36:41', '2023-08-18 12:36:49'),
(4, 'Selesai', '2023-08-18 12:36:55', '2023-08-18 12:36:55');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
