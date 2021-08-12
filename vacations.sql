-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2021 at 07:11 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vacations`
--

-- --------------------------------------------------------

--
-- Table structure for table `empusers`
--

CREATE TABLE `empusers` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `DOB` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobileno` varchar(20) NOT NULL,
  `section` varchar(30) NOT NULL,
  `city` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `reg_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `empusers`
--

INSERT INTO `empusers` (`id`, `username`, `password`, `fname`, `lname`, `gender`, `DOB`, `email`, `mobileno`, `section`, `city`, `country`, `reg_date`) VALUES
(1, 'ayyob21', '12345678', 'Ayyob', 'Sameer', 'Male', '1996-08-21', 'ayyob69@hotmail.com', '00972599585145', 'Information Technology', 'Gaza', 'Palestine', '2021-05-15 17:51:56'),
(2, 'john66', '11223344', 'Johnny', 'Stones', 'Male', '1968-10-23', 'Jstones22@hotmail.com', '00972595985334', 'Human Resources', 'London', 'UK', '2021-05-15 17:51:56'),
(3, 'lia98', '123456//', 'Lia', 'Sandro', 'Female', '1998-07-23', 'lia12@hotmail.com', '00972597885664', 'Human Resources', 'Milano', 'Italy', '2021-05-15 17:51:56'),
(14, 'Hani22', 'qwerty12', 'Heenoow', 'Elwan', 'Female', '0000-00-00', 'heenoow@gmail.com', '+970592072633', 'Operations', 'Gaza', 'Palestinian Authorit', '2021-05-24 02:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'Waiting for approval',
  `type` varchar(30) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `fromDate`, `toDate`, `description`, `postDate`, `status`, `type`, `emp_id`, `CreationDate`) VALUES
(6, '2021-05-19', '2021-05-22', '', '2021-05-23 23:33:46', 'Approved', 'Casual Leave', 1, '2021-05-19 17:01:48'),
(7, '2021-04-19', '2021-04-25', '', '2021-05-19 17:02:40', 'Not Approved', 'Restricted Holiday', 2, '2021-05-19 17:02:40'),
(8, '2021-03-19', '2021-03-20', '', '2021-05-23 03:57:01', 'Approved', 'Medical Leave test', 3, '2021-05-19 17:03:25'),
(11, '2000-02-01', '2000-02-03', '', '2021-05-24 13:08:37', 'Approved', 'medical-leave', 1, '2021-05-24 13:04:10'),
(12, '2000-02-28', '2000-03-12', 'Eat Breakfast', '2021-05-24 16:20:13', 'Waiting for approval', 'restricted-holiday', 1, '2021-05-24 16:20:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'hani', 'hello'),
(3, '2021-05-14 20:16:04', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empusers`
--
ALTER TABLE `empusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_foreign_key` (`emp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empusers`
--
ALTER TABLE `empusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `id_foreign_key` FOREIGN KEY (`emp_id`) REFERENCES `empusers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
