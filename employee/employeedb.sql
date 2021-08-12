-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 04:03 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employeedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(4) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `fromDate`, `toDate`, `description`, `postDate`, `status`, `type`) VALUES
(3, '2021-03-30', '2022-02-03', 'I will travel to Spain.', '2021-05-11 12:59:23', '', 'restricted-holiday'),
(3, '2021-04-05', '2021-04-08', 'I have a cough.', '2021-05-11 13:00:10', '', 'medical-leave'),
(1, '2021-01-02', '2022-01-01', 'I will travel to Spain.', '2021-05-11 13:02:03', '', 'medical-leave'),
(2, '2021-02-04', '2021-02-08', 'I have a cough.', '2021-05-11 13:05:23', '', 'medical-leave'),
(1, '2021-05-25', '2021-06-15', 'Tired.', '2021-05-12 13:50:51', '', 'restricted-holiday');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
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
  `country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `gender`, `DOB`, `email`, `mobileno`, `section`, `city`, `country`) VALUES
(1, 'ayyob21', '12345678', 'Ayyob', 'Sameer', 'Male', '1996-08-21', 'ayyob69@hotmail.com', '00972599585145', 'Information Technology', 'Gaza', 'Palestine'),
(2, 'john66', '11223344', 'Jhon', 'Stones', 'Male', '1968-10-23', 'Jstones22@hotmail.com', '00972595985334', 'Human Resources', 'London', 'UK'),
(3, 'lia98', '123456//', 'Lia', 'Sandro', 'Female', '1998-07-23', 'lia12@hotmail.com', '00972597885664', 'Human Resources', 'Milano', 'Italy'),
(4, 'sami32', '11112222', 'Sami', 'Ahmad', 'Male', '1977-02-21', 'sami1212@hotmail.com', '00972594698555', 'Operations', 'Cairo', 'Egypt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD KEY `id_foreign_key` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `id_foreign_key` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
