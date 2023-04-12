-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 08:00 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeedb`
--
DROP DATABASE IF EXISTS coffeedb;
CREATE DATABASE IF NOT EXISTS coffeedb;

-- --------------------------------------------------------

--
-- Table structure for table `count_table`
--

CREATE TABLE `count_table` (
  `id` int(11) NOT NULL,
  `ip_address` text NOT NULL,
  `visit_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `page_view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `count_table`
--

INSERT INTO `count_table` (`id`, `ip_address`, `visit_date`, `page_view`) VALUES
(1, '54:54:54', '2021-08-05 02:37:22', 0),
(2, '127.0.0.3', '2021-08-05 02:46:53', 0),
(3, '54:54:56', '2021-08-05 02:47:26', 0),
(4, '127:12:12', '2021-08-05 02:58:25', 0),
(5, '127:12:82', '2021-08-05 03:00:06', 0),
(6, '127:12:62', '2021-08-05 03:00:19', 0),
(7, '127:12:92', '2021-08-05 03:00:40', 0),
(8, '127:12:826', '2021-08-05 03:03:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `onlinepeople`
--

CREATE TABLE `onlinepeople` (
  `session` char(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `onlinepeople`
--

INSERT INTO `onlinepeople` (`session`, `time`) VALUES
('9sua0emb4h2ci2ga0952taopt5', 1628228964);

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE `orderlist` (
  `orderID` int(11) NOT NULL,
  `choices` varchar(20) NOT NULL,
  `orderByWho` varchar(20) NOT NULL,
  `orderTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderlist`
--

ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`orderID`);

ALTER TABLE `orderlist`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

INSERT INTO `orderlist` (`orderID`, `choices`, `orderByWho`, `orderTime`) VALUES
(1, '', '', '2021-08-05 02:29:50'),
(2, '', '', '2021-08-06 02:29:50'),
(3, '', '', '2021-08-06 02:29:50'),
(4, '', '', '2021-08-06 02:29:50'),
(5, '', '', '2021-08-06 02:29:50'),
(6, '', '', '2021-08-06 02:29:50'),
(7, '', '', '2021-08-06 02:29:50'),
(8, '', '', '2021-08-06 02:29:50'),
(9, '', '', '2021-08-06 02:29:50'),
(10, '', '', '2021-08-06 02:29:50'),
(11, '', '', '2021-08-06 02:29:50'),
(12, '', '', '2021-08-06 02:29:50'),
(13, '', '', '2021-08-06 02:29:50'),
(14, '', '', '2021-08-06 02:29:50'),
(15, '', '', '2021-08-06 02:29:50'),
(16, '', '', '2021-08-06 13:28:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `count_table`
--
ALTER TABLE `count_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onlinepeople`
--
ALTER TABLE `onlinepeople`
  ADD PRIMARY KEY (`session`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `count_table`
--
ALTER TABLE `count_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE `queue` (
  `queueID` int(11) NOT NULL,
  `orderTime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `queue`
--

INSERT INTO `queue` (`queueID`, `orderTime`, `status`, `orderID`) VALUES
(1, '2021-08-05 22:13:09', 0, 1),
(2, '2021-08-05 22:39:48', 0, 1),
(3, '2021-08-05 22:42:03', 0, 2),
(4, '2021-08-06 09:51:31', 0, 3),
(5, '2021-08-06 12:23:13', 0, 4),
(6, '0000-00-00 00:00:00', 0, 5),
(7, '2021-08-06 12:27:58', 0, 6),
(8, '0000-00-00 00:00:00', 0, 7),
(9, '2021-08-06 12:28:22', 0, 8),
(10, '2021-08-06 12:29:36', 0, 8),
(11, '0000-00-00 00:00:00', 0, 9),
(12, '2021-08-06 13:13:34', 0, 9),
(13, '2021-08-06 13:14:05', 0, 10),
(14, '0000-00-00 00:00:00', 0, 11),
(15, '2021-08-06 13:15:02', 0, 12),
(16, '0000-00-00 00:00:00', 0, 13),
(17, '2021-08-06 13:20:52', 0, 14),
(18, '2021-08-06 13:22:28', 0, 15),
(19, '2021-08-06 13:30:33', 0, 16);

ALTER TABLE `queue`
  ADD PRIMARY KEY (`queueID`),
  ADD FOREIGN KEY (`orderID`) REFERENCES orderlist(`orderID`);
  
  ALTER TABLE `queue`
  MODIFY `queueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;