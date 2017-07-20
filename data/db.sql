-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2017 at 09:58 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `communic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`id`, `userId`, `postId`, `creation_date`, `text`) VALUES
(1, 1, 1, '2017-06-28 21:52:42', 'asdasdasd'),
(2, 1, 1, '2017-06-28 21:52:45', 'asdasdasd'),
(3, 2, 4, '2017-06-29 00:02:42', 'nowy komentarz'),
(4, 2, 4, '2017-06-29 00:02:45', 'nowy komentarz');

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE `Messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_text` varchar(140) NOT NULL,
  `message_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Messages`
--

INSERT INTO `Messages` (`message_id`, `user_id`, `message_text`, `message_datetime`) VALUES
(1, 1, 'dsaasdasd', '2017-06-28 21:24:30'),
(2, 1, 'nowawiadomosc123', '2017-06-28 23:47:25'),
(3, 1, 'nowawiadomosc123', '2017-06-28 23:47:29'),
(4, 2, 'nowawiadomosc456', '2017-06-28 23:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `PrivateMessage`
--

CREATE TABLE `PrivateMessage` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `privatemessage_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `privatemessage_text` text NOT NULL,
  `privatemessage_readstatus` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PrivateMessage`
--

INSERT INTO `PrivateMessage` (`id`, `sender_id`, `receiver_id`, `privatemessage_datetime`, `privatemessage_text`, `privatemessage_readstatus`) VALUES
(4, 2, 1, '2017-06-28 23:49:15', 'asdasdasda', 1),
(5, 2, 1, '2017-06-28 23:55:05', 'dsadasdasdasdsadasdsadasdsadasdasdasdasdasd', 1),
(6, 2, 1, '2017-06-28 23:59:17', 'fajnanowaprywatnawiadomosc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hash_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `email`, `username`, `hash_password`) VALUES
(1, 'mazgajmaciek@gmail.com', 'mazgajmaciek2', '$2y$11$.3UVQKS1qJc4ZBtUUP9QNej87pA5dJpjJ/CUk580bqEXfZ4.c9QQu'),
(2, 'stefan@stefan.pl', 'stefan', '$2y$11$mN2knp5Qf9bJiv.2x20fte0g4EUykXw6aXfE.O4DWzqBizcCS57Ky');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `PrivateMessage`
--
ALTER TABLE `PrivateMessage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Messages`
--
ALTER TABLE `Messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `PrivateMessage`
--
ALTER TABLE `PrivateMessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`);

--
-- Constraints for table `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);

--
-- Constraints for table `PrivateMessage`
--
ALTER TABLE `PrivateMessage`
  ADD CONSTRAINT `PrivateMessage_ibfk_1` FOREIGN KEY (`receiver_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `PrivateMessage_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `Users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
