-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2020 at 03:20 PM
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(100) NOT NULL,
  `publication_year` date NOT NULL,
  `author` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `available_copies` int(11) NOT NULL,
  primary key (id)
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groups_permissions`
--

CREATE TABLE `groups_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id),
    FOREIGN KEY (group_id) REFERENCES groups(id)


) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
    PRIMARY KEY (id)


) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `email` varchar(100) DEFAULT NULL,
    PRIMARY KEY (id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `first_name`, `last_name`, `PASSWORD`, `created_at`, `last_login`, `approved`, `email`) VALUES
(1, 'admin', 'admin', 'admin', 'e4fb9b1d7d5388230cc41878654389ea', '2020-05-24 07:29:30', NULL, 1, 'admin@admin.com'),
(4, 'magdy', 'magdy', 'mohammed', '25f9e794323b453885f5181f1b624d0b', '2020-05-24 07:37:50', NULL, 1, 'm@m.com'),
(5, 'mina', 'mina', 'reda', '25f9e794323b453885f5181f1b624d0b', '2020-05-24 07:39:38', NULL, 1, 'm@m.com'),
(6, 'test', 'test', 'test', '202cb962ac59075b964b07152d234b70', '2020-05-24 07:43:04', NULL, 0, 't@m.com');

-- --------------------------------------------------------

--
-- Table structure for table `users_borrow_books`
--

CREATE TABLE `users_borrow_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` DATETIME NOT NULL DEFAULT current_timestamp(),
  `borrow_period` int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (book_id) REFERENCES books(id),
  FOREIGN KEY (user_id) REFERENCES users(id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (group_id) REFERENCES groups(id)


) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

