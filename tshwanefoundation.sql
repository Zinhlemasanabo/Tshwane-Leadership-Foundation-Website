-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2026 at 10:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tshwanefoundation`
--

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `name`, `amount`, `donation_date`) VALUES
(1, 'Zinhle', 50.00, '2026-06-09 21:57:51'),
(2, 'Zinhle', 500.00, '2026-06-09 21:59:07'),
(3, 'Zinhle', 1.00, '2026-06-09 22:08:16'),
(4, 'Zinhle', 1.00, '2026-06-09 22:08:29'),
(5, 'Zinhle', 500.00, '2026-06-09 22:12:54'),
(6, 'Zinhle', 1.00, '2026-06-09 22:13:05'),
(7, 'Zinhle', 15.00, '2026-06-09 22:15:06'),
(8, 'Zinhle', 500.00, '2026-06-09 22:36:13'),
(9, 'Zinhle', 100.00, '2026-06-09 22:36:26'),
(10, 'Zinhle', 500.00, '2026-06-09 22:36:37'),
(11, 'Mogau Mokwena', 100.00, '2026-06-09 23:26:38'),
(12, 'Mogau Mokwena', 56.00, '2026-06-09 23:26:49'),
(13, 'John', 500.00, '2026-06-09 23:27:31'),
(14, 'Thato', 1.00, '2026-06-09 23:35:19'),
(15, 'bottle', 500.00, '2026-06-11 10:49:57'),
(16, 'bottle', 99999999.99, '2026-06-11 10:50:31'),
(17, 'Thato', 10.00, '2026-06-11 11:40:04'),
(18, 'Zinhle', 500.00, '2026-06-11 20:24:58'),
(19, 'Zinhle', 15.00, '2026-06-11 20:28:33'),
(20, 'Zinhle', 500.00, '2026-06-11 20:29:48'),
(21, 'Zinhle', 1.00, '2026-06-11 20:30:49'),
(22, 'Zinhle', 1.00, '2026-06-11 20:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `donation_id` int(11) NOT NULL,
  `Acc_number` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`donation_id`, `Acc_number`, `pin`, `bank_name`) VALUES
(1, 2147483647, 1212, 'CAPITEC'),
(2, 2147483647, 1212, 'CAPITEC'),
(3, 2147483647, 1212, 'CAPITEC'),
(4, 2147483647, 12345, 'CAPITEC'),
(5, 2147483647, 0, 'CAPITEC'),
(6, 2147483647, 0, 'fnb');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'John', 'john@mail.com', '$2y$10$30rH4jZ/ZeMdSXo3GbzgXunWdY2UsI7phsnrG0MUGaCF512oYPk9q', '1'),
(2, 'Thato', 't1@mail.com', '$2y$10$YpszSaQPZh0xb7SpE5tbxuR9LrqOYGlasLoqnSy9BpW7Kun7mLBI.', '2'),
(3, 'Zinhle', 'zinhle@mail.com', '$2y$10$nPes4D.WWstUTq1Mr4/b9Oh2K5OpfHAx4S2lxs9QWT30hkv0AYL1S', '3'),
(4, 'Kgaogelo Mokwena', 'kg@mail.com', '$2y$10$Xzla02gmpArVbpoMaWYvhee0MbjqAdwG7/Mf5u3O9B8OjSWB/CbwC', ''),
(8, 'Mogau Mokwena', 'mm@mail.com', '$2y$10$ZbCPaBEur83HmOmz9b/WPOr7.afhy2aEVPcuLiv3EElYdKWxo.zEy', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`donation_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
