-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2018 at 08:04 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ajaxcrudtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `pass`, `gender`, `country`, `created_at`, `updated_at`) VALUES
(19, 'Rubi', 'rubi@gmail.com', '$2y$10$PQhW8hbZ//Gf7nf0FSIZGuJoFD4P90OHmoihMtUWtniSc4O/4.Pvi', 'Female', 'Algeria', '2018-11-16 23:29:55', '2018-11-17 04:03:00'),
(23, 'Jessi', 'jessi@gmail.com', '$2y$10$K.ZLBNkEhwnfZqUcfx8iXuW5KlrToz0at/mldxrMIJ8n4OJNaR0JK', 'Female', 'Costa Rica', '2018-11-17 04:02:27', '2018-11-17 04:02:50'),
(31, 'Sujan', 'sujan@gmail.com', '$2y$10$W5Mw6CDTU7c0lcbidsMuQu8.QF3ccj654DnXyMTAZMXPuoX6UH3WO', 'Male', 'Bangladesh', '2018-11-18 00:59:33', '2018-11-18 00:59:33'),
(32, 'Mehedi', 'mehedi@gmail.com', '$2y$10$J1grzhBkY3BAR9Hdm1jp6.wj5.WItBoKvRDRTXZkM26G/eK1x/un6', 'Male', 'Bangladesh', '2018-11-18 09:08:03', '2018-11-18 09:08:15'),
(33, 'Robiul', 'robiul@gmail.com', '$2y$10$QmGdA52i6TMrJ8JvtYeuSeXDqcwafWPLIypy33pleZrS.17B3xmRO', 'Male', 'Bangladesh', '2018-11-18 23:00:26', '2018-11-18 23:00:26'),
(34, 'Ketty', 'ketty@gmail.com', '$2y$10$zXtTvZ9hx/WoWIEBx9kaKO81Y.MAcXIT2mzvHs4F/FOqtyHbABAte', 'Female', 'Denmark', '2018-11-19 09:42:42', '2018-11-19 09:42:42'),
(35, 'Asif', 'asif@gmail.com', '$2y$10$DB64heuiMMRJ.a9WbTAreufOTAkm6Ly8O8o9.mBWJL7.NPdc6/BsK', 'Male', 'Bangladesh', '2018-11-20 00:51:44', '2018-11-20 00:51:44'),
(40, 'Dipankar', 'sahadipankar1059@gmail.com', '$2y$10$Tq9udNFMRNLnXSfWjDNGS.TnTn0dy8YoC3mgQj5hx8jPy.JFlVM9O', 'Male', 'Bangladesh', '2018-11-21 23:55:13', '2018-11-21 23:55:13'),
(41, 'Mijan', 'mijan@gmail.com', '$2y$10$PCXRuo45tML5JIDBVIX2LOQN/DtkbAb99DbFzCyU7uLL76qYEQtaG', 'Male', 'Bangladesh', '2018-11-22 00:11:40', '2018-11-22 00:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `cid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `mssg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `cid`, `fid`, `mssg`, `created_at`, `updated_at`) VALUES
(153, 27, 19, 'Hi rubi...', '2018-11-21 21:28:15', '2018-11-21 21:28:15'),
(154, 19, 27, 'Hi Dipankar', '2018-11-21 21:28:26', '2018-11-21 21:28:26'),
(155, 27, 23, 'Hi jessi', '2018-11-21 21:30:32', '2018-11-21 21:30:32'),
(156, 23, 27, 'Hi Dipankar', '2018-11-21 21:30:42', '2018-11-21 21:30:42'),
(157, 27, 23, 'How r u?', '2018-11-21 22:32:38', '2018-11-21 22:32:38'),
(158, 23, 27, 'I am fine. u?', '2018-11-21 22:32:51', '2018-11-21 22:32:51'),
(159, 27, 19, 'How r u?', '2018-11-21 22:33:27', '2018-11-21 22:33:27'),
(160, 19, 27, 'I am fine .u?', '2018-11-21 22:33:45', '2018-11-21 22:33:45'),
(161, 27, 19, 'jhsdvhfshahc', '2018-11-21 22:57:37', '2018-11-21 22:57:37'),
(162, 27, 19, 'asdvasjh', '2018-11-21 22:57:39', '2018-11-21 22:57:39'),
(163, 27, 19, 'asdvasjhdas', '2018-11-21 22:57:43', '2018-11-21 22:57:43'),
(164, 27, 19, 'ashvdashjdas', '2018-11-21 22:57:46', '2018-11-21 22:57:46'),
(165, 27, 19, 'asjhdvasgda', '2018-11-21 22:57:49', '2018-11-21 22:57:49'),
(166, 27, 19, 'asghdags', '2018-11-21 22:57:52', '2018-11-21 22:57:52'),
(167, 27, 19, 'asdgfagsgas', '2018-11-21 22:57:55', '2018-11-21 22:57:55'),
(168, 27, 19, 'sadhaga', '2018-11-21 22:57:58', '2018-11-21 22:57:58'),
(169, 27, 19, 'asdgfagh', '2018-11-21 22:58:02', '2018-11-21 22:58:02'),
(170, 27, 19, 'sadfassha', '2018-11-21 22:58:10', '2018-11-21 22:58:10'),
(171, 27, 19, 'asgdghas', '2018-11-21 22:58:14', '2018-11-21 22:58:14'),
(172, 27, 19, 'asghghas', '2018-11-21 22:58:18', '2018-11-21 22:58:18'),
(173, 19, 27, 'Helllo', '2018-11-21 22:58:37', '2018-11-21 22:58:37'),
(174, 27, 35, 'Vai', '2018-11-21 23:15:52', '2018-11-21 23:15:52'),
(175, 35, 27, 'hello', '2018-11-21 23:16:34', '2018-11-21 23:16:34'),
(176, 27, 35, 'ha vai', '2018-11-21 23:16:42', '2018-11-21 23:16:42'),
(177, 27, 35, 'msg paicen?', '2018-11-21 23:16:54', '2018-11-21 23:16:54'),
(178, 35, 27, 'hmm. paichi.', '2018-11-21 23:17:12', '2018-11-21 23:17:12'),
(179, 27, 35, 'thik ace eibar?', '2018-11-21 23:17:22', '2018-11-21 23:17:22'),
(180, 27, 35, 'dan pase selected frnd green hoye thakbe', '2018-11-21 23:17:39', '2018-11-21 23:17:39'),
(181, 27, 35, 'jhsvja\nashdjha\nasdadja\nasdasjh\'\nasdbahs\nasdbash\'asbash\nasdvahv\nsadvahsjasv\nasvdjha\nasvdajhs\nasdjaj\nasdajh\'asbdaskj\nashvdjka\nsahdvaks\nasjhavk\nasdbaks\'sbakas\'', '2018-11-21 23:19:03', '2018-11-21 23:19:03'),
(182, 27, 35, 'asdas', '2018-11-21 23:19:08', '2018-11-21 23:19:08'),
(183, 27, 35, 'asjhvas', '2018-11-21 23:19:11', '2018-11-21 23:19:11'),
(184, 27, 35, 'asdjhvjas', '2018-11-21 23:19:15', '2018-11-21 23:19:15'),
(185, 27, 35, 'ashdva', '2018-11-21 23:19:17', '2018-11-21 23:19:17'),
(186, 27, 35, 'asgas', '2018-11-21 23:19:20', '2018-11-21 23:19:20'),
(187, 27, 35, 'latest one', '2018-11-21 23:19:35', '2018-11-21 23:19:35'),
(188, 27, 35, 'latest one will show first', '2018-11-21 23:19:48', '2018-11-21 23:19:48'),
(189, 35, 27, 'ggg', '2018-11-21 23:24:36', '2018-11-21 23:24:36'),
(190, 40, 41, 'Hello Mijan... got the message?', '2018-11-22 00:15:00', '2018-11-22 00:15:00'),
(191, 41, 40, 'Yap', '2018-11-22 00:15:23', '2018-11-22 00:15:23'),
(192, 40, 41, 'Okay now send another msg', '2018-11-22 00:15:42', '2018-11-22 00:15:42'),
(193, 41, 40, 'Here is the another message', '2018-11-22 00:15:54', '2018-11-22 00:15:54'),
(194, 40, 41, 'Yess... It\'s working ... Thanks', '2018-11-22 00:16:14', '2018-11-22 00:16:14'),
(195, 41, 40, 'Nice work keep it up', '2018-11-22 00:16:30', '2018-11-22 00:16:30');

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
(1, '2018_11_14_054036_create_customers_table', 1),
(2, '2018_11_18_161847_create_messages_table', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
