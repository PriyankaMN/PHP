-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2020 at 01:22 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `your_database_name`
--

-- --------------------------------------------------------


-- --------------------------------------------------------



-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items` varchar(120) NOT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `tq` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `done` varchar(55) NOT NULL DEFAULT 'no',
  `delivered` varchar(5) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `items`, `date`, `time`, `name`, `uid`, `tq`, `price`, `done`, `delivered`) VALUES
(2, 'Veg Noodles', '2019-12-15', '17:00', 'abc', 1, 3, 90, 'no', 'no'),
(3, 'Veg Noodles', '2019-12-15', '17:00', 'xyz', 1, 3, 90, 'no', 'no'),
(4, 'aloo gobi', '2019-12-15', '18:05', 'qwerty', 1, 4, 135, 'yes', 'no'),
(5, 'Veg Noodles ', '2019-12-20', '20:15', 'axby', 1, 1, 30, 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `torder`
--

CREATE TABLE `torder` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `quan` int(11) NOT NULL,
  `cat` varchar(5) NOT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `torder`
--

INSERT INTO `torder` (`id`, `name`, `quan`, `cat`, `date`, `time`) VALUES
(4, 'Veg Noodles', 3, 'c', '2019-12-15', '17:00'),
(5, 'Veg Noodles', 3, 'c', '2019-12-15', '17:00'),
(6, 'aloo gobi', 1, 'ni', '2019-12-15', '18:05'),
(7, 'Paratha', 3, 'ni', '2019-12-15', '18:05'),
(8, 'Veg Noodles', 1, 'c', '2019-12-20', '20:15'),
(9, 'Coffee', 1, 'b', '2019-12-20', '20:55'),
(10, 'Hot chocolate', 1, 'b', '2019-12-20', '20:55'),
(11, 'Masala Dosa', 1, 'si', '2019-12-20', '20:55'),
(12, 'Spring Rolls', 1, 'c', '2019-12-20', '20:55'),
(13, 'chole bhatura', 1, 'ni', '2019-12-20', '20:55'),
(14, 'Naan Roti', 1, 'ni', '2019-12-30', '14:45'),
(15, 'Pongal', 1, 'si', '2019-12-30', '14:45'),
(16, 'Naan Roti', 1, 'ni', '2019-12-30', '17:20'),
(17, 'Momos', 1, 'c', '2019-12-30', '17:20'),
(18, 'chole bhatura', 1, 'ni', '2019-12-30', '18:40'),
(19, 'Dumplings', 1, 'c', '2019-12-30', '18:40'),
(20, 'Masala Dosa', 1, 'si', '2019-12-30', '18:50'),
(21, 'Momos', 1, 'c', '2019-12-30', '18:50'),
(22, 'Masala Dosa', 1, 'si', '2019-12-30', '20:30'),
(23, 'chole bhatura', 1, 'ni', '2019-12-30', '20:30'),
(24, 'Veg Noodles', 1, 'c', '2019-12-30', '20:30'),
(25, 'Hot chocolate', 1, 'b', '2019-12-30', '20:30'),
(26, 'Paratha', 1, 'ni', '2019-12-30', '20:40'),
(27, 'Dumplings', 1, 'c', '2019-12-30', '20:40'),
(28, 'Naan Roti', 1, 'ni', '2019-12-30', '20:55'),
(29, 'Naan Roti', 1, 'ni', '2019-12-31', '14:40'),
(30, 'Masala Dosa', 1, 'si', '2019-12-31', '14:40'),
(31, 'Masala Dosa', 1, 'si', '2020-01-01', '13:30'),
(32, 'Momos', 1, 'c', '2020-01-01', '13:30'),
(33, 'chole bhatura', 5, 'ni', '2020-01-01', '13:30'),
(34, 'Fried Rice', 2, 'c', '2020-01-01', '13:30'),
(35, 'Coca-cola', 1, 'b', '2020-01-01', '13:30'),
(36, 'Masala Dosa', 4, 'si', '2020-01-01', '13:30'),
(37, 'idli', 2, 'si', '2020-01-01', '13:30'),
(38, 'Hot chocolate', 10, 'b', '2020-01-01', '13:35'),
(39, 'Lemonade', 4, 'b', '2020-01-01', '13:35'),
(40, 'Coca-cola', 5, 'b', '2020-01-01', '13:35'),
(41, 'Coffee', 3, 'b', '2020-01-01', '13:35'),
(42, 'Iced tea', 4, 'b', '2020-01-01', '13:35'),
(43, 'chole bhatura', 2, 'ni', '2020-01-01', '13:35'),
(44, 'Naan Roti', 1, 'ni', '2020-01-01', '13:35'),
(45, 'Paratha', 5, 'ni', '2020-01-01', '13:35'),
(46, 'Masala Dosa', 1, 'si', '2020-01-01', '13:35'),
(47, 'idli', 2, 'si', '2020-01-01', '13:35'),
(48, 'Obbattu', 1, 'si', '2020-01-01', '13:35'),
(49, 'Pongal', 1, 'si', '2020-01-01', '13:35'),
(50, 'upma', 1, 'si', '2020-01-01', '13:35'),
(51, 'Spring Rolls', 1, 'c', '2020-01-01', '13:35'),
(52, 'Dumplings', 1, 'c', '2020-01-01', '13:35'),
(53, 'Momos', 1, 'c', '2020-01-01', '13:35'),
(54, 'Fried Rice', 1, 'c', '2020-01-01', '13:35'),
(55, 'idli', 1, 'si', '2020-01-01', '14:05'),
(56, 'Naan Roti', 1, 'ni', '2020-01-01', '14:05'),
(57, 'Masala Dosa', 1, 'si', '2020-01-01', '14:05'),
(58, 'Obbattu', 3, 'si', '2020-01-01', '14:10'),
(59, 'Momos', 1, 'c', '2020-01-01', '14:10'),
(60, 'Lemonade', 4, 'b', '2020-01-01', '14:10'),
(61, 'Naan Roti', 1, 'ni', '2020-01-01', '14:10');

-- --------------------------------------------------------

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `torder`
--
ALTER TABLE `torder`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `torder`
--
ALTER TABLE `torder`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
