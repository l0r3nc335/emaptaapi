-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 12:06 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emapta`
--

-- --------------------------------------------------------

--
-- Table structure for table `agiles`
--

CREATE TABLE `agiles` (
  `id` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agiles`
--

INSERT INTO `agiles` (`id`, `description`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Early and Continuous Delivery of Valuable Software', 'principles', '2021-05-25 06:01:39', '2021-05-25 06:01:39', NULL),
(2, 'Adapt to Change', 'principles', '2021-05-25 06:01:39', '2021-05-25 02:01:55', NULL),
(3, 'Frequent Delivery', 'principles', '2021-05-25 00:58:58', '2021-05-25 01:31:30', NULL),
(4, 'Frequent Delivery', 'principle', '2021-05-25 00:59:14', '2021-05-25 01:53:03', '2021-05-25 01:53:03'),
(6, 'BUsiness and Developer Cooperation', 'principles', '2021-05-25 02:02:19', '2021-05-25 02:02:19', NULL),
(7, 'Motivated Individuals', 'principles', '2021-05-25 02:02:35', '2021-05-25 02:02:35', NULL),
(8, 'Face-to-Face Interaction', 'principles', '2021-05-25 02:02:59', '2021-05-25 02:02:59', NULL),
(9, 'Working Software', 'principles', '2021-05-25 02:03:14', '2021-05-25 02:03:14', NULL),
(10, 'Maintain a Constant Pace', 'principles', '2021-05-25 02:03:34', '2021-05-25 02:03:34', NULL),
(11, 'Technical Brilliance', 'principles', '2021-05-25 02:03:52', '2021-05-25 02:03:52', NULL),
(12, 'Simplicity', 'principles', '2021-05-25 02:04:08', '2021-05-25 02:04:08', NULL),
(13, 'Teams Self-Organization', 'principles', '2021-05-25 02:04:24', '2021-05-25 02:09:22', NULL),
(14, 'Regular Reflection and Adjustment', 'principles', '2021-05-25 02:04:50', '2021-05-25 02:04:50', NULL),
(18, 'Individual Interaction', 'values', '2021-05-25 02:32:54', '2021-05-25 02:32:54', NULL),
(19, 'Working Software', 'values', '2021-05-25 02:33:08', '2021-05-25 02:33:08', NULL),
(20, 'Customer Colaboration', 'values', '2021-05-25 02:33:32', '2021-05-25 02:33:40', NULL),
(21, 'Responding to change', 'values', '2021-05-25 02:34:05', '2021-05-25 02:34:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agiles`
--
ALTER TABLE `agiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agiles`
--
ALTER TABLE `agiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
