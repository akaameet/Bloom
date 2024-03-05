-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 07:09 PM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(100) NOT NULL,
  `product_id` int(120) NOT NULL,
  `image` text NOT NULL,
  `name` text NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `product_id`, `image`, `name`, `price`, `quantity`) VALUES
(0, 1, 'monstera.jpg', 'Monstera Deliciosa', 800, 2),
(1, 10, 'Monstera pinnatipartita.png', 'Monstera pinnatipartita ', 750, 1),
(3, 11, 'Areca Palm.png', 'Areca Palm', 800, 1),
(1, 1, 'monstera.jpg', 'Monstera Deliciosa', 800, 1),
(3, 10, 'Monstera pinnatipartita.png', 'Monstera pinnatipartita ', 750, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(100) NOT NULL,
  `name` text NOT NULL,
  `price` int(255) NOT NULL,
  `categories` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(150) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `stock` int(100) NOT NULL,
  `timestamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `price`, `categories`, `description`, `image`, `subtitle`, `stock`, `timestamp`) VALUES
(1, 'Monstera Deliciosa', 800, 'Indoor ', '\r\nFor Monstera deliciosa, also known as the Swiss cheese plant, proper care is essential for its iconic fenestrated leaves to flourish. Keep the soil consistently moist, allowing the top layer to dry between waterings to prevent root rot. Opt for well-draining, fertile soil to promote healthy growth and root development. Place it in bright to medium indirect light, replicating its natural habitat under tree canopies where it receives filtered sunlight. Regularly feed with a nitrogen-rich fertilizer to sustain its lush green foliage and encourage robust growth. ', 'monstera.jpg', 'Need tropical flair? The Monstera deliciosa is then a must-buy! Known for its iconic natural leaf holes, this tropical beauty can provide an instant jungle vibe and transform any surrounding space.', 30, '2024-02-15 17:48:59'),
(2, 'Tupidanthus', 5000, 'Outdoor ', '\r\nTupidanthus, also known as the Flame Vine, requires consistent moisture in well-draining soil and thrives in bright, indirect light. Maintaining temperatures between 18°C to 25°C (65°F to 77°F) during the day and above 10°C (50°F) at night is crucial for its health. Enhance humidity levels through misting or a humidifier, as Tupidanthus appreciates tropical conditions. Regular pruning helps control its size and shape while promoting new growth. Watch for pests like aphids and spider mites, treating promptly with appropriate measures.', 'Tupidanthus.png', 'An umbrella tree with a dwarf suffix attached to it is what makes this plant attractive. Native to Australia and Taiwan, Tupidanthus is also known as an octopus tree and parasol plant that has smaller, glossy, and broad leaves, and may feature creamy vari', 10, '2024-02-15 17:50:47'),
(3, 'Rhapis Palm', 800, 'Outdoor ', '\r\nRhapis palm, also known as Lady Palm, thrives with proper care. Keep its soil consistently moist but not waterlogged, allowing the top inch to dry out between waterings. Place it in bright, indirect light, avoiding direct sunlight which can scorch its leaves. Maintain temperatures between 18°C to 25°C (65°F to 77°F) and avoid sudden fluctuations. Provide high humidity levels and mist the foliage regularly to replicate its native tropical habitat. Ensure well-draining soil and occasional fertilization to support its growth.', 'rhapis palm.png', 'Rhapis Palm also known as a Lady Palm is an elegant durable plant that can adapt to almost all conditions. These palm trees are slow growers but what makes it attractive is its broad, dark green, fan shaped foliage with blunt tips. They’re exceptionally g', 20, '2024-02-15 17:51:54'),
(4, 'Philodendron Lemon Lime', 400, 'Indoor ', '\r\nPhilodendron Lemon Lime, a vibrant and popular houseplant, thrives with attentive care. Keep its soil consistently moist during the growing season, allowing the top layer to dry out slightly between waterings. Position it in bright, indirect light to maintain its vibrant foliage, avoiding direct sunlight that can scorch its leaves. Maintain temperatures between 18°C to 25°C (65°F to 77°F) and provide moderate humidity levels for optimal growth. Use well-draining soil and fertilize occasionally during the growing season to promote lush foliage.', 'neon.png', 'Philodendron ‘Lemon Lime’ is as bright as its name sounds! The bright neon-golden leaves prove why it has two bright words: \'lemon’ and ‘lime’. With its small heart-shaped bright leaves; this evergreen plant will bring life and light to any space or inter', 18, '2024-02-15 17:56:17'),
(5, 'Hoya Vine Hanging Big', 2000, 'Indoor ', '\r\nHoya Vine Hanging Big, an enchanting trailing plant, thrives with consistent care. Keep its soil slightly dry between waterings to prevent root rot, but ensure thorough watering when needed. Place it in bright, indirect light, shielding it from direct sunlight to avoid leaf burn. Maintain temperatures between 18°C to 25°C (65°F to 77°F) and provide adequate humidity levels, especially in drier indoor environments. Use well-draining soil and fertilize sparingly during the growing season to encourage blooming. ', 'hoya-house-plant-with-flowersOG.jpg', 'Known as the wax plant for having thick waxy leaves, Hoya Vine makes the classic tropical indoor plants. It grows to be enormous and is known for its long, vining tendrils, and sweet-smelling flowers.', 10, '2024-02-15 17:59:49'),
(7, 'Echeveria', 600, 'Succulent', '\r\nEcheveria, a stunning succulent prized for its rosette-shaped foliage, thrives with simple yet attentive care. Allow its soil to dry out completely between waterings, ensuring good drainage to prevent root rot. Position it in a sunny location where it can receive at least 6 hours of direct sunlight daily, especially during the growing season. Maintain temperatures between 18°C to 24°C (65°F to 75°F) during the day and slightly cooler at night to mimic its natural desert habitat. Use a well-draining cactus or succulent soil mix and fertilize sparingly during the growing season to avoid over-fertilization.', 'echivera.jpg', 'Echeverias are popular with collectors of succulent plants for their compact rosette structure and are a great choice for any novice gardener as they are very easy to care for. ', 15, '2024-02-15 18:11:37'),
(8, ' Sansevieria trifasciata, Snake Plant\r\n', 700, 'Indoor ', 'Sansevieria trifasciata, commonly known as the Snake Plant (var. laurentii), is a resilient and low-maintenance plant that thrives with minimal care. Allow its soil to dry out between waterings, as overwatering can lead to root rot. Place it in bright to ', 'Sansevieria-Trifasciata-Snake-Plant-var.-laurentii.png', ' Looking for Elegance? Sansevieria trifasciata, the epitome of sophistication, is a must-have! With its striking variegated leaves and timeless appeal, this plant effortlessly elevates any interior with its minimalist charm.', 29, '2024-03-05 21:32:40'),
(9, 'Philodendron Broken Heart, Monstera adansonii ', 800, 'Indoor ', 'For Philodendron Broken Heart, Monstera adansonii, providing attentive care ensures its thriving presence in your home. Keep its soil consistently moist but avoid waterlogging, allowing the top inch to dry out between waterings. Position it in bright, indirect light, shielding it from direct sunlight to prevent leaf burn. Maintain temperatures between 18°C to 24°C (65°F to 75°F) during the day and slightly cooler at night to mimic its tropical habitat. Utilize a well-draining potting mix rich in organic matter and fertilize sparingly during the growing season to support healthy growth. ', 'Monstera adansonii.png', ' Seeking Whimsy? Philodendron Broken Heart, Monstera adansonii - Plant is a Must-Have! With its unique heart-shaped leaves and playful demeanor, this delightful plant injects a touch of charm and character into any living space.', 20, '2024-03-05 21:39:10'),
(10, 'Monstera pinnatipartita ', 750, 'Indoor ', 'Monstera pinnatipartita - Plant Flourishes with Proper Care. Maintain its soil consistently moist, allowing slight drying between waterings to prevent root rot. Place it in bright, indirect light, shielding it from direct sunlight to avoid leaf damage. Ensure temperatures remain between 18°C to 24°C (65°F to 75°F) during the day and slightly cooler at night for optimal growth. Utilize well-draining soil to prevent waterlogging and fertilize sparingly during the growing season to support its lush foliage.', 'Monstera pinnatipartita.png', ' Craving Exotic Beauty? Monstera pinnatipartita - Plant is a Must-Own! With its intricate leaf patterns and unique charm, this tropical wonder brings a touch of the exotic into any living space.', 15, '2024-03-05 21:50:22'),
(11, 'Areca Palm', 800, 'Indoor ', '\r\nDreaming of Tropical Paradise? The Areca Palm Thrives with Proper Care. Keep its soil consistently moist, avoiding waterlogging while allowing the top layer to dry between waterings. Position it in bright, indirect light, shielding it from harsh sunlight to prevent leaf scorching. Maintain temperatures between 18°C to 24°C (65°F to 75°F) during the day and slightly cooler at night for optimal growth. Utilize well-draining soil to prevent root rot and fertilize monthly during the growing season with a balanced fertilizer.', 'Areca Palm.png', ' Yearning for Tropical Tranquility? The Areca Palm is Your Oasis! Transforming any space into a lush paradise with its graceful fronds and soothing presence.', 14, '2024-03-05 21:56:23'),
(12, 'Cycas', 650, 'Outdoor ', 'Seeking Timeless Elegance? The Cycas Plant Flourishes with Careful Attention. Keep its soil consistently moist but well-drained, avoiding water stagnation which can lead to root rot. Place it in bright, indirect light, shielding it from direct sunlight to prevent leaf burn. Maintain temperatures between 18°C to 24°C (65°F to 75°F) during the day and slightly cooler at night for optimal growth. Utilize a well-draining potting mix and fertilize sparingly during the growing season to support its lush foliage. ', 'Cycas.png', ' Craving Timeless Elegance? The Cycas Plant: A Classic Addition to Your Space! Enhancing any environment with its regal presence and enduring charm.', 20, '2024-03-05 22:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` bigint(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `address`, `phone`) VALUES
(2, 'Ameet', 'raiamit078@gmail.com', '$2y$10$oiaWFkFZx1hII56UV3VTEOqkOGXGS.4/HmlYNy37jrk6L0JsidauG', 'Unregistered', 0),
(3, 'luffy', 'luffyrai108@gmail.com', '$2y$10$.yc6P2BWyO4JlCrj1ILwteF4QMZkVtTRlumEX2FantnQp4jCE8acm', 'LA', 9800000006);

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
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
