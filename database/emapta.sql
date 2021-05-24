-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 06:58 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

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
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` int(11) NOT NULL,
  `dinstar_url` varchar(100) DEFAULT NULL,
  `receive_ports` varchar(100) DEFAULT NULL,
  `globe_ports` varchar(100) DEFAULT NULL,
  `smart_ports` varchar(100) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `is_auto_respone` tinyint(4) NOT NULL DEFAULT 0,
  `auto_response` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `dinstar_url`, `receive_ports`, `globe_ports`, `smart_ports`, `token`, `project_id`, `is_auto_respone`, `auto_response`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(1, 'http://172.21.0.17', '1,2', '1', '2', 'aXRzdXBwb3J0OklUU3VwcG9ydEA1MXRhbGtwaA==', 1, 0, NULL, '2021-04-10 13:09:58', '2021-04-28 22:49:53', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mail_jobs`
--

CREATE TABLE `mail_jobs` (
  `id` bigint(20) NOT NULL,
  `template` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `send_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mobile_brands`
--

CREATE TABLE `mobile_brands` (
  `id` int(11) DEFAULT NULL,
  `prefix` varchar(5) DEFAULT NULL,
  `brand` varchar(15) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobile_brands`
--

INSERT INTO `mobile_brands` (`id`, `prefix`, `brand`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '63817', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(2, '63905', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(3, '63906', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(4, '63915', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(5, '63916', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(6, '63917', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(7, '63926', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(8, '63927', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(9, '63935', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(10, '63936', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(11, '63937', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(12, '63945', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(13, '63956', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(14, '63965', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(15, '63966', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(16, '63967', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(17, '63975', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(18, '63977', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(19, '63995', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(20, '63997', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(21, '63999', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(22, '63998', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(23, '63950', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(24, '63949', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(25, '63948', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(26, '63947', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(27, '63946', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(28, '63944', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(29, '63943', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(30, '63942', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(31, '63939', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(32, '63938', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(33, '63933', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(34, '63932', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(35, '63931', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(36, '63930', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(37, '63929', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(38, '63928', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(39, '63925', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(40, '63923', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(41, '63922', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(42, '63921', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(43, '63920', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(44, '63919', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(45, '63918', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(46, '63912', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(47, '63910', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(48, '63909', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(49, '63908', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(50, '63907', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(51, '63813', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(52, '63976', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(53, '63977', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(54, '63994', 'GLOBE', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL),
(55, '63983', 'SMART', 0, 0, '2021-04-10 14:05:24', '2021-04-10 14:05:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`) VALUES
(1, 'Lesson Support', 'LS001', '2021-04-10 13:02:46', '2021-04-10 13:02:46', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(21) NOT NULL,
  `code` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `code`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'alpha', 'Alpha', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL),
(2, 'jmt', 'JMT', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL),
(3, 'edy', 'EDY', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL),
(4, 'cya', 'CYA', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL),
(5, 'bacolod', 'Bacolod', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL),
(6, 'cbt-angeles', 'CBT - Angeles', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL),
(7, 'cbt-cavite', 'CBT - Cavite', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL),
(8, 'cbt-qc', 'CBT - QC', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL),
(9, 'cbt-davao', 'CBT - Davao', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL),
(10, 'cbt-cebu', 'CBT - Cebu', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL),
(11, 'bacolod', 'Bacolod', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL),
(12, 'others', 'Others', '2021-04-07 12:52:32', '2021-04-07 12:52:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms_blasts`
--

CREATE TABLE `sms_blasts` (
  `id` int(11) NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `success_count` int(11) DEFAULT NULL,
  `error_count` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `send_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_blast_numbers`
--

CREATE TABLE `sms_blast_numbers` (
  `id` int(11) NOT NULL,
  `sms_blast_id` int(11) DEFAULT NULL,
  `mobile_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `assigned_to` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `project_id`, `mobile`, `port`, `message`, `status`, `assigned_to`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '+639458438252', 16, 'Gud morning, im lalyn one of the trainee of 51talk..i have a trouble in completing my profile,cqn i ask for help..', 1, 4, 0, 4, '2021-04-18 15:27:40', '2021-04-19 17:15:18', NULL),
(2, 1, '+639458438252', 16, 'Hi 51 Talk! I\'m scheduled to do my orientation today however I had a family emergency I have to attend to. How can I reschedule my orientation? Thanks! - Cathleen Wu', 4, 1, 0, 1, '2021-04-18 15:27:41', '2021-05-29 23:36:17', NULL),
(3, 1, '+639458438252', 16, 'YES/CHARLYN JOY NAVARRO', 2, 1, 0, 1, '2021-04-18 15:27:41', '2021-04-29 08:56:21', NULL),
(4, 1, '+639458438252', 16, 'Hi. I had my initial interview last 2 weeks ago. I was advised that I pass the interview and that they will just call me to schedule my technical check. Is there a way to check my application?', 3, 1, 0, 1, '2021-04-18 15:27:41', '2021-04-29 22:21:41', NULL),
(5, 1, '+639458438252', 19, 'Goodam sir sorry for missing your call, uhhmm sir can I hold my application cause there\'s alot going on here kn the house and I\'m helping my parents, I hope you understand', 4, 1, 0, 1, '2021-04-18 15:27:41', '2021-04-29 09:15:19', NULL),
(6, 1, '+639458438252', 2, 'Good morning maam this is Ma. Annalyn Nalla.  I wasn\'t able to attend my PSO yesterday due to time conflict can I request for another schedule? Thank you ', 1, 4, 0, 0, '2021-04-18 15:27:42', '2021-04-18 15:27:42', NULL),
(7, 1, '+639458438252', 2, 'Hir sir/ maam good morning. Im one of the applicant. There will be communicating skill sched later at 10:30. Problem is i did not able to complete my requirement. One of it is audio recording. I dont where to find the script il going to read. Please help me on that. Where can i find fdf file of ntt. The sricpt exactly i have to rn\'é )çäÜ>f audio recording. Thanks', 1, 1, 0, 1, '2021-04-18 15:27:42', '2021-05-07 16:00:00', NULL),
(8, 1, '+639458438252', 1, 'Sino po sila?', 0, 0, 0, 0, '2021-04-18 15:27:42', '2021-04-18 15:27:42', NULL),
(9, 1, '+639458438252', 2, 'Hello. Good morning. This is Cristy-Mae Marquezes, I have a scheduled PSO today @ 9AM with Miss Anne. I already informed her that I cannot attend as much as I want to because right now we are experiencing a typhoon and there\'s power interruption. Hopefully I could re schedule my PSO by Wednesday April 21,2021 if possible? Thank you! ', 1, 4, 0, 4, '2021-04-18 15:27:43', '2021-04-19 17:16:31', NULL),
(10, 1, '+639458438252', 16, 'Good morning, this is Rexell Gamo. I would like to move the schedule of my interview on Friday 10am. Is that possible? Thank you!', 4, 1, 0, 1, '2021-04-18 15:27:43', '2021-05-01 09:12:19', NULL),
(11, 1, '+639458438252', 3, 'sino po sila', 3, 1, 0, 1, '2021-04-18 15:27:44', '2021-05-01 09:15:53', NULL),
(12, 1, '+639458438252', 9, 'Good morning Ma\'am, I would like to move my schedule for the technical check on April 26 2021. This is due to network loss since last week and i\'m still waiting for the technical team to conduct visit. ', 0, 0, 0, 0, '2020-05-18 15:27:44', '2021-04-18 15:27:44', NULL),
(13, 1, '+639458438252', 9, 'Sino to?', 0, 0, 0, 0, '2021-04-18 15:27:45', '2021-04-18 15:27:45', NULL),
(14, 1, '+639458438252', 20, 'who\'s this?', 0, 0, 0, 0, '2021-04-18 15:27:45', '2021-04-18 15:27:45', NULL),
(15, 1, '+639458438252', 2, 'Hi good morning. This is teacher Kliezyl Moe of 51talk. Can i reschedule my NTT? I had a power interruption in the middle of our training and up until now. Thank you so much.', 0, 0, 0, 0, '2021-04-18 15:27:45', '2021-04-18 15:27:45', NULL),
(16, 1, '+639458438252', 3, 'Sino po sila', 0, 0, 0, 0, '2021-04-18 15:27:46', '2021-04-18 15:27:46', NULL),
(17, 1, '+639458438252', 4, 'Hello! Who\'s this? ', 0, 0, 0, 0, '2021-04-18 15:27:46', '2021-04-18 15:27:46', NULL),
(18, 1, '+639458438252', 16, 'Hi sir, I didnt receive a call for my initial interview.', 1, 1, 0, 1, '2021-04-18 15:27:47', '2021-05-07 16:00:00', NULL),
(19, 1, '+639458438252', 1, 'Kinsa ni po?', 0, 0, 0, 0, '2021-04-18 15:27:47', '2021-04-18 15:27:47', NULL),
(20, 1, '+639458438252', 3, 'Hello you may now call again. Apologies', 4, 1, 0, 1, '2021-04-18 15:27:48', '2021-05-02 09:53:26', NULL),
(21, 1, '+639458438252', 16, 'Hi. Good day this is Mary Jane Barriga can i schedule for another tech check? My cpu is already fix. I can set up tom', 0, 0, 0, 0, '2021-04-18 15:27:48', '2021-04-18 15:27:48', NULL),
(22, 1, '+639458438252', 6, 'Im outside the house now doing grocery maam, will it be okay if you can call me back this afternoon? Thank you so much', 0, 0, 0, 0, '2021-04-18 15:27:48', '2021-04-18 15:27:48', NULL),
(23, 1, '+639458438252', 4, 'Sino po ito bakit po kayo nag call', 0, 0, 0, 0, '2021-04-18 15:27:49', '2021-04-18 15:27:49', NULL),
(24, 1, '+639458438252', 9, 'Hi who\'s this? ', 0, 0, 0, 0, '2021-04-18 15:27:50', '2021-04-18 15:27:50', NULL),
(25, 1, '+639458438252', 15, 'Sino to', 0, 0, 0, 0, '2021-04-18 15:27:50', '2021-04-18 15:27:50', NULL),
(26, 1, '+639458438252', 5, 'Sandali lng po man bigay q xa kanya', 0, 0, 0, 0, '2021-04-18 15:27:50', '2021-04-18 15:27:50', NULL),
(27, 1, '+639458438252', 21, 'FULLNAME', 0, 0, 0, 0, '2021-05-18 15:27:51', '2021-04-18 15:27:51', NULL),
(28, 1, '+639458438252', 16, 'Good morning 51 talk , i was supposed to have Com training today at 8:30 am. something came up importantly ( swab test and gene xpert of my brother who is sick ) if you permit can i schedule for tomorrow april 20. ? thank you so much God Bless', 0, 0, 0, 0, '2021-05-18 15:27:51', '2021-04-18 15:27:51', NULL),
(29, 1, '+639458438252', 0, 'Test', 0, 0, 0, 0, '2021-04-18 22:58:47', '2021-04-18 22:58:47', NULL),
(30, 1, '+639458438252', 2, 'gfgfd', 1, 0, 0, 0, '2021-04-29 07:48:20', '2021-04-29 07:48:20', NULL),
(31, 1, '+639458438252', 2, 'gdfg', 0, 0, 0, 0, '2020-07-29 07:48:20', '2020-04-29 07:48:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_conversations`
--

CREATE TABLE `ticket_conversations` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_send` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_conversations`
--

INSERT INTO `ticket_conversations` (`id`, `ticket_id`, `message`, `is_send`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'rejected si sulit', 0, 0, 0, '2021-04-29 02:29:36', '2021-04-29 02:29:36', NULL),
(2, 2, 'hehehe', 0, 0, 0, '2021-04-29 02:34:02', '2021-04-29 02:34:02', NULL),
(3, 2, 'dasdsd', 0, 0, 0, '2021-04-29 02:35:01', '2021-04-29 02:35:01', NULL),
(4, 2, 'dasdsad', 0, 0, 0, '2021-04-29 02:35:41', '2021-04-29 02:35:41', NULL),
(5, 2, 'dasdsad', 0, 0, 0, '2021-04-29 02:35:52', '2021-04-29 02:35:52', NULL),
(6, 2, 'dsada', 0, 0, 0, '2021-04-29 02:36:29', '2021-04-29 02:36:29', NULL),
(7, 2, 'dasdasd', 0, 0, 0, '2021-04-29 02:36:44', '2021-04-29 02:36:44', NULL),
(8, 2, 'dfdf', 0, 0, 0, '2021-04-29 02:37:13', '2021-04-29 02:37:13', NULL),
(9, 2, 'dasdsad', 0, 0, 0, '2021-04-29 02:37:22', '2021-04-29 02:37:22', NULL),
(10, 2, 'fdfdsf', 0, 0, 0, '2021-04-29 02:38:03', '2021-04-29 02:38:03', NULL),
(11, 2, 'dsadsd', 0, 0, 0, '2021-04-29 07:26:38', '2021-04-29 07:26:38', NULL),
(12, 2, 'ssss', 0, 0, 0, '2021-04-29 07:27:15', '2021-04-29 07:27:15', NULL),
(13, 2, 'dasd', 0, 0, 0, '2021-04-29 07:34:15', '2021-04-29 07:34:15', NULL),
(14, 2, 'dsada', 0, 0, 0, '2021-04-29 07:34:42', '2021-04-29 07:34:42', NULL),
(15, 2, 'fsdfsd', 0, 0, 0, '2021-04-29 07:37:02', '2021-04-29 07:37:02', NULL),
(16, 2, 'jjj', 0, 0, 0, '2021-04-29 07:37:43', '2021-04-29 07:37:43', NULL),
(17, 2, 'My Ticket # 2  STATUS WAS CHANGED', 0, 0, 0, '2021-04-29 07:45:35', '2021-04-29 07:45:35', NULL),
(18, 2, '', 0, 0, 0, '2021-04-29 07:48:20', '2021-04-29 07:48:20', NULL),
(70, 3, 'jjjj', 0, 1, 0, '2021-05-01 05:54:04', '2021-05-01 05:54:04', NULL),
(20, 2, '', 0, 0, 0, '2021-04-29 08:13:48', '2021-04-29 08:13:48', NULL),
(21, 2, 'uuuuuuuuuuuuuuuu', 0, 0, 0, '2021-04-29 08:17:31', '2021-04-29 08:17:31', NULL),
(23, 4, 'Hi. I had my initial interview last 2 weeks ago. I was advised that I pass the interview and that they will just call me to schedule my technical check. Is there a way to check my application?', 1, 0, 0, '2021-04-29 08:53:34', '2021-04-29 08:53:34', NULL),
(25, 5, 'Goodam sir sorry for missing your call, uhhmm sir can I hold my application cause there\'s alot going on here kn the house and I\'m helping my parents, I hope you understand', 1, 0, 0, '2021-04-29 09:12:29', '2021-04-29 09:12:29', NULL),
(26, 5, NULL, 1, 0, 0, '2021-04-29 09:15:19', '2021-04-29 09:15:19', NULL),
(27, 4, NULL, 1, 0, 0, '2021-04-29 21:12:43', '2021-04-29 21:12:43', NULL),
(28, 4, NULL, 1, 0, 0, '2021-04-29 21:13:01', '2021-04-29 21:13:01', NULL),
(29, 4, NULL, 1, 0, 0, '2021-04-29 21:13:21', '2021-04-29 21:13:21', NULL),
(30, 4, 'rtrt', 0, 0, 0, '2021-04-29 21:13:53', '2021-04-29 21:13:53', NULL),
(31, 4, NULL, 1, 0, 0, '2021-04-29 21:13:58', '2021-04-29 21:13:58', NULL),
(32, 4, 'number ko|||||+639458438252', 0, 0, 0, '2021-04-29 21:30:55', '2021-04-29 21:30:55', NULL),
(33, 4, 'lorenzo kain na', 0, 0, 0, '2021-04-29 21:46:03', '2021-04-29 21:46:03', NULL),
(34, 4, 'matatapos mo din yan ', 0, 0, 0, '2021-04-29 21:48:43', '2021-04-29 21:48:43', NULL),
(35, 4, 'kain na ho master', 0, 0, 0, '2021-04-29 21:49:27', '2021-04-29 21:49:27', NULL),
(36, 4, NULL, 1, 0, 0, '2021-04-29 22:04:05', '2021-04-29 22:04:05', NULL),
(37, 4, NULL, 1, 0, 0, '2021-04-29 22:04:29', '2021-04-29 22:04:29', NULL),
(38, 4, NULL, 1, 0, 0, '2021-04-29 22:05:12', '2021-04-29 22:05:12', NULL),
(39, 4, NULL, 1, 0, 0, '2021-04-29 22:05:59', '2021-04-29 22:05:59', NULL),
(40, 4, NULL, 1, 0, 0, '2021-04-29 22:06:03', '2021-04-29 22:06:03', NULL),
(41, 4, NULL, 1, 0, 0, '2021-04-29 22:06:21', '2021-04-29 22:06:21', NULL),
(42, 4, NULL, 1, 0, 0, '2021-04-29 22:06:59', '2021-04-29 22:06:59', NULL),
(43, 4, NULL, 1, 0, 0, '2021-04-29 22:08:26', '2021-04-29 22:08:26', NULL),
(44, 4, NULL, 1, 0, 0, '2021-04-29 22:09:31', '2021-04-29 22:09:31', NULL),
(45, 4, NULL, 1, 0, 0, '2021-04-29 22:09:44', '2021-04-29 22:09:44', NULL),
(46, 4, NULL, 1, 0, 0, '2021-04-29 22:10:33', '2021-04-29 22:10:33', NULL),
(47, 4, NULL, 1, 0, 0, '2021-04-29 22:11:01', '2021-04-29 22:11:01', NULL),
(48, 2, NULL, 1, 0, 0, '2021-04-29 22:11:56', '2021-04-29 22:11:56', NULL),
(49, 2, NULL, 1, 0, 0, '2021-04-29 22:13:09', '2021-04-29 22:13:09', NULL),
(50, 4, NULL, 1, 0, 0, '2021-04-29 22:15:48', '2021-04-29 22:15:48', NULL),
(51, 4, NULL, 1, 0, 0, '2021-04-29 22:17:41', '2021-04-29 22:17:41', NULL),
(52, 4, 'dsad', 0, 0, 0, '2021-04-29 22:18:40', '2021-04-29 22:18:40', NULL),
(53, 4, 'ako si lorenzo the poge', 0, 0, 0, '2021-04-29 22:19:36', '2021-04-29 22:19:36', NULL),
(54, 4, 'gfdgdfg', 0, 0, 0, '2021-04-29 22:21:29', '2021-04-29 22:21:29', NULL),
(55, 4, NULL, 1, 0, 0, '2021-04-29 22:21:41', '2021-04-29 22:21:41', NULL),
(56, 4, NULL, 1, 0, 0, '2021-04-29 22:22:05', '2021-04-29 22:22:05', NULL),
(57, 2, 'dsfsdfsdf', 0, 0, 0, '2021-04-29 22:22:37', '2021-04-29 22:22:37', NULL),
(58, 4, 'fsdfsdf', 0, 0, 0, '2021-04-29 22:52:52', '2021-04-29 22:52:52', NULL),
(60, 2, NULL, 1, 0, 0, '2021-04-29 23:36:17', '2021-04-29 23:36:17', NULL),
(61, 2, 'Close ko na ito lorenzo', 0, 0, 0, '2021-04-29 23:36:18', '2021-04-29 23:36:18', NULL),
(63, 3, 'user', 0, 1, 0, '2021-05-01 05:29:46', '2021-05-01 05:29:46', NULL),
(71, 4, 'g', 0, 1, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(72, 10, 'Good morning, this is Rexell Gamo. I would like to move the schedule of my interview on Friday 10am. Is that possible? Thank you!', 1, 0, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(73, 10, NULL, 1, 0, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(74, 10, 'replying to your messages', 0, 1, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(75, 10, NULL, 1, 0, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(76, 10, NULL, 1, 0, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(77, 10, NULL, 1, 0, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(78, 10, NULL, 1, 0, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(79, 20, 'Hello you may now call again. Apologies', 1, 0, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(80, 20, NULL, 1, 0, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(81, 20, NULL, 1, 0, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(82, 11, 'sino po sila', 1, 0, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(83, 11, NULL, 1, 0, 0, '2021-04-30 16:00:00', '2021-04-30 16:00:00', NULL),
(84, 20, NULL, 1, 0, 0, '2021-05-01 16:00:00', '2021-05-01 16:00:00', NULL),
(85, 20, NULL, 1, 0, 0, '2021-05-01 16:00:00', '2021-05-01 16:00:00', NULL),
(86, 7, NULL, 1, 0, 0, '2021-05-07 16:00:00', '2021-05-07 16:00:00', NULL),
(87, 7, 'hello', 1, 0, 0, '2021-05-07 16:00:00', '2021-05-07 16:00:00', NULL),
(88, 7, 'ganda bango rona', 1, 0, 0, '2021-05-07 16:00:00', '2021-05-07 16:00:00', NULL),
(89, 1, 'Fff', 0, 0, 0, '2021-05-07 16:00:00', '2021-05-07 16:00:00', NULL),
(90, 18, NULL, 1, 0, 0, '2021-05-07 16:00:00', '2021-05-07 16:00:00', NULL),
(91, 1, 'Ggggg', 0, 0, 0, '2021-05-07 16:00:00', '2021-05-07 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_statuses`
--

CREATE TABLE `ticket_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_statuses`
--

INSERT INTO `ticket_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'New', '2021-04-27 06:32:57', '2021-04-16 08:38:29', NULL),
(2, 'Assigned', '2021-04-27 06:33:01', '2021-04-16 08:38:29', NULL),
(3, 'Pending', '2021-04-27 06:33:03', '2021-04-16 08:39:04', NULL),
(4, 'Closed', '2021-04-27 06:33:06', '2021-04-16 08:39:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_temporary_user` smallint(6) DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `token_expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `project_id`, `name`, `username`, `email`, `password`, `is_temporary_user`, `token`, `token_expired_at`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'enzo', 'enzo', 'enzo@gmail.com', 'efe6398127928f1b2e9ef3207fb82663', 0, '71426f9db33e6c84b1c337ed8226153b138c41ab0040fd0fa335705f8ccad4d3', '2021-05-24 12:40:15', NULL, NULL, NULL, '2021-04-15 00:32:13', '2021-05-24 09:40:15'),
(2, 3, 'enzo23', 'enzo2', 'enzo2@gmail.com', 'efe6398127928f1b2e9ef3207fb82663', 0, NULL, '2021-04-29 04:49:01', NULL, NULL, NULL, '2021-04-14 18:33:14', '2021-04-20 14:39:40'),
(3, 2, 'enzo3', 'enzo3', 'enzo3@gmail.com', 'efe6398127928f1b2e9ef3207fb82663', 0, NULL, '2021-04-29 04:49:05', NULL, NULL, NULL, '2021-04-14 18:34:39', '2021-04-20 14:39:52'),
(4, 3, 'enzo4', 'enzo4', 'enzo4@gmail.com', 'b5786d31041ff11d3ea55ea2b80a8ea5', 0, '', '2021-04-20 20:51:25', NULL, NULL, NULL, '2021-04-14 19:07:20', '2021-04-20 14:51:25'),
(5, 3, 'enzo5', 'enzo5', 'enzo5@gmail.com', 'c47f42b3d034e75a8d0fddc694f3e3bc', 0, '', '2021-04-20 22:35:57', NULL, NULL, NULL, '2021-04-14 18:45:44', '2021-04-20 16:35:57'),
(6, 2, '123213', '3213123', '@fdfdf', 'd41d8cd98f00b204e9800998ecf8427e', 0, '', '2021-04-20 23:18:50', NULL, NULL, NULL, '2021-04-14 18:46:45', '2021-04-20 17:18:50'),
(7, 3, '46546546', '456456', '456456', 'efe6398127928f1b2e9ef3207fb82663', 0, '', '2021-04-20 23:33:14', NULL, NULL, NULL, '2021-04-14 18:47:44', '2021-04-20 17:33:14'),
(8, 0, '6666', '6666', '6666', 'efe6398127928f1b2e9ef3207fb82663', 0, NULL, '2021-04-20 23:02:06', NULL, NULL, '2021-04-20 16:36:24', '2021-04-14 18:50:21', '2021-04-20 16:36:24'),
(9, 2, '2222', 'LESS', 'LESS', '1798e8c3621ca53d9e3a80d257306000', 0, '', '2021-04-23 20:57:30', NULL, NULL, NULL, '2021-04-20 17:36:36', '2021-04-23 14:57:30'),
(10, 0, 'LESS1', 'LESS1', 'LESS1', 'd41d8cd98f00b204e9800998ecf8427e', 0, NULL, '2021-04-20 23:37:01', NULL, NULL, NULL, '2021-04-20 17:37:01', '2021-04-20 17:37:01'),
(11, 2, 'LESLES', 'LESLES', 'LESLES', 'd41d8cd98f00b204e9800998ecf8427e', 0, '', '2021-04-23 20:33:57', NULL, NULL, NULL, '2021-04-20 17:39:18', '2021-04-23 14:33:57'),
(64, 0, 'rona', 'rona', 'rona', 'efe6398127928f1b2e9ef3207fb82663', 0, NULL, '2021-04-28 06:04:25', NULL, NULL, NULL, '2021-04-28 00:04:25', '2021-04-28 00:04:25'),
(65, 3, 'ronalyn', 'ronalyn', 'ronalyn', 'efe6398127928f1b2e9ef3207fb82663', 0, NULL, '2021-04-28 06:04:46', NULL, NULL, NULL, '2021-04-28 00:04:46', '2021-04-28 00:04:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_jobs`
--
ALTER TABLE `mail_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_blasts`
--
ALTER TABLE `sms_blasts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_blast_numbers`
--
ALTER TABLE `sms_blast_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_conversations`
--
ALTER TABLE `ticket_conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mail_jobs`
--
ALTER TABLE `mail_jobs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sms_blasts`
--
ALTER TABLE `sms_blasts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_blast_numbers`
--
ALTER TABLE `sms_blast_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ticket_conversations`
--
ALTER TABLE `ticket_conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
