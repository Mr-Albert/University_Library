-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2020 at 07:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `ISBN` varchar(100) NOT NULL,
  `publication_year` date NOT NULL,
  `author` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `available_copies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `ISBN`, `publication_year`, `author`, `name`, `description`, `available_copies`) VALUES
(0, '9780230747937 ', '0000-00-00', 'Julia Donaldson', 'The Gruffalo', 'A classic children\'s book enjoyed by many', 9),
(0, '0241003008  ', '0000-00-00', 'Eric Carle', 'The Very Hungry Caterpillar', 'A classic tale with iconic illustrations', 5),
(0, '0241003009  ', '0000-00-00', 'J.k Rowling', 'Harry potter 1', 'the first of harry potter adventures', 12),
(0, '0241003009  ', '0000-00-00', 'J.k Rowling', 'Harry potter 2', 'the second of harry potter adventures', 10),
(0, '0241003009  ', '0000-00-00', 'J.k Rowling', 'Harry potter 3', 'the third of harry potter adventures', 8),
(0, '0241003009  ', '0000-00-00', 'J.k Rowling', 'Harry potter 4', 'the foruth of harry potter adventures', 7),
(0, '0241003009  ', '0000-00-00', 'J.k Rowling', 'Harry potter 5', 'the fifth of harry potter adventures', 13),
(0, '0241003009  ', '0000-00-00', 'J.k Rowling', 'Harry potter 6', 'the sixth of harry potter adventures', 11);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
