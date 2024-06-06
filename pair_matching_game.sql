-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 04:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pair_matching_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$QJdub61Xx0znM1DPiVxXwO5RczFoAxQ2wTgDHhc6RMDPW56w2Tso6');

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `id` int(11) NOT NULL,
  `italian_word` varchar(255) NOT NULL,
  `english_translation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `italian_word`, `english_translation`) VALUES
(1, 'ciao', 'hello'),
(5, 'prego', 'you\'re welcome'),
(6, 'buongiorno', 'good morning'),
(7, 'buonasera', 'good evening'),
(8, 'per favore', 'please'),
(9, 'scusa', 'excuse me'),
(10, 'mi dispiace', 'I\'m sorry'),
(11, 'arrivederci', 'goodbye'),
(14, 'bene', 'well'),
(15, 'male', 'bad'),
(16, 'dove', 'where'),
(17, 'qua', 'here'),
(18, 'lì', 'there'),
(19, 'oggi', 'today'),
(20, 'domani', 'tomorrow'),
(21, 'ieri', 'yesterday'),
(22, 'casa', 'house'),
(23, 'macchina', 'car'),
(24, 'pane', 'bread'),
(25, 'acqua', 'water'),
(26, 'vino', 'wine'),
(27, 'caffè', 'coffee'),
(28, 'tè', 'tea'),
(29, 'latte', 'milk'),
(30, 'formaggio', 'cheese'),
(32, 'pasta', 'pasta'),
(33, 'gelato', 'ice cream'),
(34, 'cibo', 'food'),
(35, 'voglio', 'I want'),
(36, 'posso', 'I can'),
(37, 'fare', 'do'),
(38, 'andare', 'to go'),
(39, 'vedere', 'to see'),
(40, 'essere', 'to be'),
(42, 'potere', 'to be able to'),
(43, 'dovere', 'to have to'),
(44, 'volere', 'to want'),
(45, 'capire', 'to understand'),
(46, 'parlare', 'to speak'),
(47, 'mangiare', 'to eat'),
(48, 'bere', 'to drink'),
(49, 'dormire', 'to sleep');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
