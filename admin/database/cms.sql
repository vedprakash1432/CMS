-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2022 at 01:53 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `username` varchar(59) NOT NULL,
  `password` varchar(59) NOT NULL,
  `aname` varchar(59) NOT NULL,
  `AdminImage` varchar(34) NOT NULL,
  `datetime` varchar(100) NOT NULL,
  `AddedBy` varchar(40) NOT NULL,
  `headline` varchar(23) NOT NULL,
  `AdminBio` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `aname`, `AdminImage`, `datetime`, `AddedBy`, `headline`, `AdminBio`) VALUES
(12, 'ved@1432', '14325', 'Vedprakash', 'gallery-img-4.jpeg', 'October-26-2021 12:25:04', '', '', 'programmer lover'),
(15, 'ramesh@123', '12345', 'Ramesh', '', 'November-20-2021 22:52:50', '', '', ''),
(16, 'poonam@123', '123456789', 'Poonam', '', 'December-02-2021 17:28:39', '', '', ''),
(17, 'arun@123', '12345', 'Arun', 'gallery-img-5.jpeg', 'March-06-2022 00:58:05', 'Vedprakash', '', 'Restaurants in Gorakhpur, Gorakhpur Restaurants, Golghar restaurants, Best Golghar restaurants, Gorakhpur City restaurants, Casual Dining in Gorakhpur');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(30) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(34) NOT NULL,
  `datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `author`, `datetime`) VALUES
(21, 'covid-20', 'vedprakash', 'October-30-2021 12:40:22'),
(22, 'today news', 'vedprakash', 'November-12-2021 22:56:08'),
(24, 'Media', 'vedprakash', 'November-14-2021 18:26:51'),
(25, 'Amar Ujala', 'vedprakash', 'November-20-2021 21:45:33'),
(27, 'Politics', 'vedprakash', 'November-20-2021 23:07:38'),
(28, 'Entertainments', 'vedprakash', 'November-20-2021 23:08:11'),
(29, 'CurryOn Restaurant ', 'vedprakash', 'March-06-2022 00:40:47'),
(30, 'election', 'vedprakash', 'March-06-2022 00:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(255) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Comments` text NOT NULL,
  `DateTime` varchar(34) NOT NULL,
  `post_id` int(34) NOT NULL,
  `AproveComment` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `Name`, `Email`, `Comments`, `DateTime`, `post_id`, `AproveComment`) VALUES
(1, 'vijafsd@gmail.com', 'shivansh@gmail.com', 'cvvvvvvvvvvvvvv', ' February-14-2022 16:38:55', 3, 0),
(2, 'Ved Prakash', 'vedprakashsharma2246@gmail.com', 'awesome\r\n', ' March-06-2022 00:38:39', 3, 1),
(3, 'Ved Prakash', 'vedprakashsharma2246@gmail.com', 'best', ' March-06-2022 00:45:35', 6, 0),
(4, 'Ved Prakash', 'sharma22@gmail.com', 'handsome employee', ' March-06-2022 01:01:33', 5, 1),
(5, 'Vedprakash', 'sharma22@gmail.com', 'nice', ' March-27-2022 14:44:17', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(20) NOT NULL,
  `datetime` varchar(1000) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category` varchar(30) NOT NULL,
  `author` varchar(49) NOT NULL,
  `image` varchar(40) NOT NULL,
  `post` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(4, 'March-06-2022 00:40:10', 'Curryon products are good or not??????', 'Entertainments', 'Ved', 'gallery-img-4.jpeg', 'Restaurants in Gorakhpur, Gorakhpur Restaurants, Golghar restaurants, Best Golghar restaurants, Gorakhpur City restaurants, Casual Dining in Gorakhpur, Casual Dining near me, Casual Dining in Golghar, in Gorakhpur, near me, in Golghar, in Gorakhpur, near me, in Golghar, Order food online in Golghar, Order food online in Gorakhpur'),
(5, 'March-06-2022 00:42:52', 'CurryOn employee ', 'CurryOn Restaurant', 'Ved', 'chef.jpg', 'Restaurants in Gorakhpur, Gorakhpur Restaurants, Golghar restaurants, Best Golghar restaurants, Gorakhpur City restaurants, Casual Dining in Gorakhpur, Casual Dining near me, Casual Dining in Golghar, in Gorakhpur, near me, in Golghar, in Gorakhpur, near me, in Golghar, Order food online in Golghar, Order food online in Gorakhpur'),
(6, 'March-06-2022 00:43:30', 'by one  get two free', 'CurryOn Restaurant', 'Ved', 'gallery-img-2.jpeg', 'Restaurants in Gorakhpur, Gorakhpur Restaurants, Golghar restaurants, Best Golghar restaurants, Gorakhpur City restaurants, Casual Dining in Gorakhpur, Casual Dining near me, Casual Dining in Golghar, in Gorakhpur, near me, in Golghar, in Gorakhpur, near me, in Golghar, Order food online in Golghar, Order food online in Gorakhpur'),
(7, 'March-27-2022 14:28:59', 'CurryOn Restaurant', 'CurryOn Restaurant', 'Ved', 'nav-img-6.jfif', 'Restaurants in Gorakhpur, Gorakhpur Restaurants, Golghar restaurants, Best Golghar restaurants, Gorakhpur City restaurants, Casual Dining in Gorakhpur, Casual Dining near me, Casual Dining in Golghar, in Gorakhpur, near me, in Golghar, in Gorakhpur, near me, in Golghar, Order food online in Golghar, Order food online in Gorakhpur'),
(8, 'March-27-2022 14:29:44', 'Curryon product', 'CurryOn Restaurant', 'Ved', 'reservation-bg.jpeg', 'Restaurants in Gorakhpur, Gorakhpur Restaurants, Golghar restaurants, Best Golghar restaurants, Gorakhpur City restaurants, Casual Dining in Gorakhpur, Casual Dining near me, Casual Dining in Golghar, in Gorakhpur, near me, in Golghar, in Gorakhpur, near me, in Golghar, Order food online in Golghar, Order food online in Gorakhpur'),
(9, 'March-27-2022 14:30:09', 'CurryOn', 'CurryOn Restaurant', 'Ved', 'nav-img-2.jpeg', 'Restaurants in Gorakhpur, Gorakhpur Restaurants, Golghar restaurants, Best Golghar restaurants, Gorakhpur City restaurants, Casual Dining in Gorakhpur, Casual Dining near me, Casual Dining in Golghar, in Gorakhpur, near me, in Golghar, in Gorakhpur, near me, in Golghar, Order food online in Golghar, Order food online in Gorakhpur'),
(10, 'March-27-2022 14:31:05', 'by one  get two free', 'Entertainments', 'Ved', 'nav-img-3.jpeg', 'Restaurants in Gorakhpur, Gorakhpur Restaurants, Golghar restaurants, Best Golghar restaurants, Gorakhpur City restaurants, Casual Dining in Gorakhpur, Casual Dining near me, Casual Dining in Golghar, in Gorakhpur, near me, in Golghar, in Gorakhpur, near me, in Golghar, Order food online in Golghar, Order food online in Gorakhpur'),
(11, 'March-27-2022 14:31:47', 'by one  get two free', 'Entertainments', 'Ved', 'graphy2.png', 'Restaurants in Gorakhpur, Gorakhpur Restaurants, Golghar restaurants, Best Golghar restaurants, Gorakhpur City restaurants, Casual Dining in Gorakhpur, Casual Dining near me, Casual Dining in Golghar, in Gorakhpur, near me, in Golghar, in Gorakhpur, near me, in Golghar, Order food online in Golghar, Order food online in Gorakhpur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
