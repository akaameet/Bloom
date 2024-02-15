-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 05:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'Admin@123\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(100) NOT NULL,
  `name` text NOT NULL,
  `price` int(255) NOT NULL,
  `categories` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(150) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `stock` int(100) NOT NULL,
  `timestamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `price`, `categories`, `description`, `image`, `subtitle`, `stock`, `timestamp`) VALUES
(1, 'Monstera Deliciosa', 800, 'Indoor plants', 'Plant Care Tips:\r\n\r\nWater: Keep soil moist but also make sure to let the soil dry between the watering. \r\n\r\nSoil:  Use well-draining and fertile soil.\r\n\r\nSunlight: Prefers bright to medium indirect light.\r\n\r\nFertilizer: Feed with a nitrogen-rich fertilize', 'monstera.jpg', 'Need tropical flair? The Monstera deliciosa is then a must-buy! Known for its iconic natural leaf holes, this tropical beauty can provide an instant jungle vibe and transform any surrounding space.', 30, '2024-02-15 17:48:59'),
(2, 'Tupidanthus', 5000, 'Outdoor Plants', 'Type of plant: Indoor/ outdoor\r\n\r\nWater: Frequently during the growing plants;  dry soil between watering\r\n\r\nSoil: Well-draining sandy loam soil with an acidic to slightly alkaline \r\n\r\nSunlight: Bright but indirect light \r\n\r\nFertilizer: During the growth ', 'Tupidanthus.png', 'An umbrella tree with a dwarf suffix attached to it is what makes this plant attractive. Native to Australia and Taiwan, Tupidanthus is also known as an octopus tree and parasol plant that has smaller, glossy, and broad leaves, and may feature creamy vari', 10, '2024-02-15 17:50:47'),
(3, 'Rhapis Palm', 800, 'Outdoor Plants', 'Plant Care \r\n\r\nWater: Water the palm when the soil slightly dry in the spring and summer. In fall and winter, water the plant only when the soil is completely dry.  \r\n\r\nSoil: perform best in a rich, well-drained soil with plenty of organic matter\r\n\r\nSunli', 'rhapis palm.png', 'Rhapis Palm also known as a Lady Palm is an elegant durable plant that can adapt to almost all conditions. These palm trees are slow growers but what makes it attractive is its broad, dark green, fan shaped foliage with blunt tips. They’re exceptionally g', 20, '2024-02-15 17:51:54'),
(4, 'Philodendron Lemon Lime', 400, 'Indoor plants', 'Water: Keep the soil moist at all times but also allow the top of the soil to dry out slightly before re-watering\r\n\r\nSoil: Well-draining potting mix is best suited for this plant\r\n\r\nSunlight: Thrives in medium or bright indirect light\r\n\r\nFertilizer: Use a', 'neon.png', 'Philodendron ‘Lemon Lime’ is as bright as its name sounds! The bright neon-golden leaves prove why it has two bright words: \'lemon’ and ‘lime’. With its small heart-shaped bright leaves; this evergreen plant will bring life and light to any space or inter', 18, '2024-02-15 17:56:17'),
(5, 'Hoya Vine Hanging Big', 2000, 'Indoor plants', 'Plant Care Tips: \r\n\r\nWater: Follow drying out in between watering.\r\n\r\nSoil: Well-drained potting mix\r\n\r\nLight: Thrives well in  bright indirect Light\r\n\r\nFertilizer: A light solution of balanced, water-soluble houseplant fertilizer mixed at a rate of ¼  te', 'hoya-house-plant-with-flowersOG.jpg', 'Known as the wax plant for having thick waxy leaves, Hoya Vine makes the classic tropical indoor plants. It grows to be enormous and is known for its long, vining tendrils, and sweet-smelling flowers.', 10, '2024-02-15 17:59:49'),
(7, 'Echeveria', 600, 'Succulent', 'Sunlight: Put your Echeveria in a spot with plenty of bright, indirect sunlight.\r\n\r\nWatering: Only water when the soil has completely dried out.\r\n\r\nSoil: Use soil made for succulents and cacti, which drains well.\r\n\r\nTemperature: Keep your Echeveria warm a', 'echivera.jpg', 'Echeverias are popular with collectors of succulent plants for their compact rosette structure and are a great choice for any novice gardener as they are very easy to care for. ', 15, '2024-02-15 18:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`) VALUES
(1, 'Ameet', 'raiamit078@gmail.com', '$2y$10$mgwROgEGsNayS4lzuP9EQOOUlLXg0yqVNcxdWpdgd39UHmJuYJKA.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
