-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2022 at 11:58 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `password`) VALUES
(1000001, '7c222fb2927d828af22f592134e8932480637c0d');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` tinyint(11) NOT NULL DEFAULT 1,
  `store_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ID`, `name`, `image`, `description`, `price`, `status`, `store_ID`) VALUES
(1, 'desktop', '69056164_desktop.jpg', 'Dell Inspiron 3880 10th Gen Intel Core i3 Desktop (8GB RAM/1TB HDD/Windows 10/Ms Office 2019/WiFi,Bluetooth) (Desktop with Dell E2016HV, 20\" Monitor) 1 Year Warranty', '300', 1, 2),
(5, 'Gaming chair', '78019287_gaming_chair.jpg', 'OHAHO Gaming Chair Racing Style Office Chair Adjustable Massage Lumbar Cushion Swivel Rocker Recliner Leather High Back Ergonomic Computer Desk Chair with Retractable Arms and Footrest (Black/Red)', '250', 1, 2),
(6, 'HP Laptop 15-dy1059ms', '15839844_laptop.jpg', '15.6\" Full HD Touch Screen Intel Core i5-1035G1 12GB Memory 256GB SSD Windows 10 Silver', '800', 1, 2),
(7, '2020 Apple iPad', '23139507_Ipad.jpg', 'Air (10.9-inch, Wi-Fi, 64GB) - Space Gray (4th Generation)', '700', 1, 2),
(8, 'Mens Batman Basic Logo T-Shirt', '2719527_matman_T-shirt.jpg', '100% cotton - made in UK', '20', 1, 9),
(9, 'Highlander Mens Slim Fit Jeans', '30927288_jeans-slimfit.jpg', 'Color: Indigo\r\n100% Cotton\r\nMade in India', '30', 1, 9),
(10, 'Packable Down Jacket Heat Keep Jacket Womens Down Jacket Ultra Light Down Jacket', '38086801_mowen_jacket.jpg', ' BEST IN DESIGN. Our stylish down jacket features a breathable 100% nylon shell, natural 90% duck down feather filling, front zippered closure, elasticized cuffs and a detachable hood to provide maximum warmth and comfort during the winter season! Also, t', '50', 1, 9),
(11, 'TBMPOY Mens Tracksuit Athletic Sports Casual Full Zip Sweatsuit', '37806369_sports_men_clothes.jpg', '95% Polyester, 5% Spandex\r\nZipper closure\r\nLightweight, Comfortable Quality Polyester Material with Stylish Design, fits for all seasons Active wear', '45', 1, 9),
(12, 'Jastore Girls Letter Love Flower Clothing Sets Top+Short Skirt Kids Clothes', '93257728_girl-clothes.jpg', 'Material: Cotton Blend\r\nSize For Baby Girls 2-7 Years', '35', 1, 9),
(13, 'Laverapelle Mens Genuine Lambskin Leather Jacket (Black, Biker Jacket) - 1501200', '42621789_jacket_men.jpg', '100% Real Leather\r\nZipper closure\r\nColor: Black - With polyester Lining | Size: Custom', '100', 1, 9),
(14, 'TP-LINK TL WR840N WIFI Router N300', '45202037_router.jpg', 'Mbps 2.4 GHz\r\n2 Antenna\r\n4 LAN Ports\r\n1 WAN Port', '35', 1, 2),
(15, 'Apple AirPods with Charging Case', '14801849_airpods.jpg', 'Color: White\r\nIOS Phone Control, Lightweight, Microphone Feature, Sports & Exercise', '180', 1, 2),
(16, 'Add On Under dash A/C Evaporator ', '64158572_automive_part-1.jpg', 'with 4 Round vents 1965 1966 1967 1968 Mustang', '400', 1, 10),
(18, 'break pads', '76912607_automive-2-2.png', 'Made in USA , extra power', '90', 1, 10),
(19, 'Allison 2500 SP Transmission ', '38126245_automove-3.jpg', 'Max input power: 340\r\nMax input torque:700', '1000', 1, 10),
(20, 'yukon 2017 engine', '44637767_automove-4.jpg', '6.2 litter - 360 horse power', '2500', 1, 10),
(21, 'Agricultural Shovel', '1835723_garden-shovel-500x500.jpg', '- Best grade materials\r\n- Superlative performance\r\n- Robustness', '30', 1, 13),
(22, 'SPACEWOOD - Office Table a Best Product', '74364620_table.jpg', 'Office/Study Table with 3 Drawers and one Rack (5 x 2.5 ft)', '450', 1, 14),
(23, 'Black Leather Revolving Office Chair', '80362922_office_chair.jpg', 'Seat Material: Leather -\r\nColor: Black - \r\nSeating Height: 17 Inches -\r\nArm Type: Fixed Arms -', '90', 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`ID`, `name`, `image`, `status`) VALUES
(2, 'TR tech', '39608360_c88d958cfd624529a821ddf8baca31f8.png', 1),
(9, 'ARMA for fashion', '24033753_c88d958cfd624529a821ddf8baca31f8 (1).png', 1),
(10, 'MC for mechanical parts', '31862768_c88d958cfd624529a821ddf8baca31f8.png', 1),
(12, 'Books world', '35736357_books-store_logo.png', 1),
(13, 'Fresh farm', '36664169_farm_logo.png', 1),
(14, 'Perfect home', '36273120_percfectHome_logo.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000002;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
