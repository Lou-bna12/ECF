-- phpMyAdmin SQL Dump
-- Serveur : 127.0.0.1 via TCP/IP
-- Version : 5.2.1 (à jour)
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 01:54 PM
-- Server version: 10.4.28-MariaDB - mariadb.org 
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
    `id` int(100) NOT NULL,
    `user_id` int(100) NOT NULL,
    `name` varchar(100) NOT NULL,
    `price` int(100) NOT NULL,
    `quantity` int(100) NOT NULL,
    `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
    `id` int(100) NOT NULL,
    `user_id` int(100) NOT NULL,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `number` varchar(12) NOT NULL,
    `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
    `id` int(100) NOT NULL,
    `user_id` int(100) NOT NULL,
    `name` varchar(100) NOT NULL,
    `number` varchar(12) NOT NULL,
    `email` varchar(100) NOT NULL,
    `method` varchar(50) NOT NULL,
    `address` varchar(500) NOT NULL,
    `total_products` varchar(1000) NOT NULL,
    `total_price` int(100) NOT NULL,
    `placed_on` varchar(50) NOT NULL,
    `payment_status` varchar(20) NOT NULL DEFAULT 'En attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `automobiles`
--

CREATE TABLE `automobiles` (
    `id` int(11) NOT NULL,
    `user_id` INT(100) NOT NULL,
    `imma`  varchar(100) NOT NULL,
    `marque` varchar(100) NOT NULL,
    `prix` int(255) NOT NULL,
    `annee` int(100) NOT NULL,
    `km`int(100) NOT NULL,
    `image` varchar(100) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
    `id` int(100) NOT NULL,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL,
    `user_type` varchar(20) NOT NULL DEFAULT 'employé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
    `id` int(100) NOT NULL,
    `name` varchar(100) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(100) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `voitures`

CREATE TABLE voitures (
    id INT PRIMARY KEY,
    marque VARCHAR(255),
    modele VARCHAR(255),
    prix DECIMAL(10, 2),
    prix_min DECIMAL(10, 2),
    prix_max DECIMAL(10, 2),
    image_url VARCHAR(255)
);


-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `automobiles`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `automobiles`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
