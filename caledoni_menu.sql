-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 14, 2022 at 05:04 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caledoni_menu`
--

-- --------------------------------------------------------

--
-- Table structure for table `menugroup`
--

CREATE TABLE `menugroup` (
  `id` int(11) NOT NULL,
  `groupnm` varchar(150) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menugroup`
--

INSERT INTO `menugroup` (`id`, `groupnm`, `sort`, `status`) VALUES
(1, 'NIGERIAN MAIN DISH', 1, 0),
(2, 'Main Dish', 2, 0),
(3, 'Soups', 3, 0),
(4, 'Pepper Soup', 4, 0),
(5, 'Rice Meal', 5, 0),
(6, 'Fish/Chips', 6, 0),
(7, 'LAMB CHOPS', 7, 0),
(8, 'SALAD', 8, 0),
(9, 'SPICY EXOTICA', 9, 0),
(10, 'VEGETABLES', 10, 0),
(11, 'PASTA', 11, 0),
(12, 'PIZZA, SHAWARMA AND SANDWICH', 12, 0),
(13, 'Breakfast Menu', 13, 0),
(14, 'DESSERTS', 14, 0),
(15, 'YAM', 15, 0),
(16, 'PLANTAIN', 16, 0),
(17, 'BUFFET', 17, 0),
(18, 'PROTEIN', 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menuitems`
--

CREATE TABLE `menuitems` (
  `id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `descr` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `sort_id` int(11) NOT NULL,
  `menugrp_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuitems`
--

INSERT INTO `menuitems` (`id`, `item`, `descr`, `price`, `sort_id`, `menugrp_id`, `status`) VALUES
(1, 'Swallow, Soup & Beef', '', 4500, 0, 1, 0),
(2, 'Swallow, soup & chicken', '', 4500, 0, 1, 0),
(3, 'Swallow, soup & goatmeat', '', 4500, 0, 1, 0),
(4, 'Swallow, Soup & snail', '', 6000, 0, 1, 0),
(5, 'Swallow, soup & fresh fish', '', 5500, 0, 1, 0),
(7, 'Swallow, soup & stock fish', '', 6000, 0, 1, 0),
(8, 'Swallow, soup & cow tail', '', 5000, 0, 1, 0),
(9, 'Swallow, soup & cow leg', '', 5000, 0, 1, 0),
(10, 'Swallow, soup & dry fish', '', 5500, 0, 1, 0),
(11, 'Swallow, banga soup any protein', '', 5000, 0, 1, 0),
(12, 'Seafood Okoro', '', 6000, 0, 1, 0),
(13, 'Swallow, soup & assorted', '', 4500, 0, 1, 0),
(14, 'Extra pounded yam', '', 1000, 0, 1, 0),
(15, 'Portion of Beans', '', 1000, 0, 1, 0),
(16, 'Out Door Special Delivery (Lunch)', '', 3000, 0, 1, 0),
(17, 'Nigerian Army Dinner (Meat)', '', 2500, 0, 1, 0),
(18, 'Nigerian Army Dinner (Fish)', '', 3000, 0, 1, 0),
(19, 'Full grilled tilapia fish (Big)', '', 7000, 0, 1, 0),
(20, 'Shredded Chicken with Green Pepper served with fri', '', 4000, 0, 2, 0),
(21, 'Grilled Boneless Chicken served with Seasonal Vege', '', 3500, 0, 2, 0),
(22, 'Grilled Fillet Steak served with Seasonal Vegetabl', '', 4000, 0, 2, 0),
(23, 'Escalope Cordon Blue served with Chips', '', 4000, 0, 2, 0),
(24, 'Rice & Beef', '', 3700, 0, 2, 0),
(25, 'Rice and Chicken', '', 3700, 0, 2, 0),
(26, 'Rice & Goatmeat', '', 3700, 0, 2, 0),
(27, 'Rice & bushmeat', '', 3500, 0, 2, 0),
(28, 'Rice & snail', '', 5200, 0, 2, 0),
(29, 'Rice & stock fish', '', 5200, 0, 2, 0),
(30, 'Rice & cow tail', '', 4200, 0, 2, 0),
(31, 'Rice & cow leg', '', 4200, 0, 2, 0),
(32, 'Rice & Dry fish', '', 4700, 0, 2, 0),
(33, 'Rice & Assorted meat', '', 3700, 0, 2, 0),
(36, 'Croacker and Chips', '', 5000, 0, 2, 0),
(37, 'Meat Platter', '', 2500, 0, 2, 0),
(38, 'Meal', '', 3500, 0, 2, 0),
(39, 'Swallow Only', '', 1000, 0, 2, 0),
(40, 'Grilled Steak', '', 3000, 0, 2, 0),
(41, 'Portion of Soup', '', 1000, 0, 2, 0),
(42, 'Fish Finger with mix vegetable', '', 4000, 0, 2, 0),
(43, 'Staff Price', '', 1000, 0, 2, 0),
(44, 'Lunch menu', '', 2600, 0, 2, 0),
(45, 'Edikakong Swallow Beef', '', 5000, 0, 2, 0),
(46, 'Rice stew and assorted', '', 3700, 0, 2, 0),
(47, 'Full Gospel dinner', '', 2500, 0, 2, 0),
(48, 'Portion of Ugba', '', 500, 0, 2, 0),
(49, 'Pepper sauce', '', 500, 0, 2, 0),
(50, 'Portion of Potato', '', 500, 0, 2, 0),
(51, 'Rice portion', '', 1000, 0, 2, 0),
(52, 'Crispy spicy fried fish', '', 3500, 0, 2, 0),
(53, 'Ebes Lunch', '', 5500, 0, 2, 0),
(54, 'Ebes Tea Break', '', 2500, 0, 2, 0),
(55, 'Kpomo', '', 2000, 0, 2, 0),
(56, 'Takeaway', '', 300, 0, 2, 0),
(57, 'Steam vegetables', '', 500, 0, 2, 0),
(58, 'Sweet corn and Egg soup', '', 1200, 0, 3, 0),
(59, 'Cream of Chicken soup', '', 2500, 0, 3, 0),
(60, 'Clear Vegetable Soup', '', 1200, 0, 3, 0),
(61, 'Vegetable soup and Chicken', '', 2000, 0, 3, 0),
(62, 'Goat Pepper Soup', '', 2500, 0, 4, 0),
(63, 'Fresh Fish pepper Soup', '', 3500, 0, 4, 0),
(64, 'Assorted Pepper soup', '', 2500, 0, 4, 0),
(65, 'Cow Tail Pepper Soup', '', 3000, 0, 4, 0),
(66, 'Cow Leg Pepper Soup', '', 3000, 0, 4, 0),
(67, 'DRY FISH PEPPER SOUP', '', 3500, 0, 4, 0),
(68, 'Chinese Fried Rice and Shrimps Sauce Served with S', '', 4000, 0, 5, 0),
(69, 'Tomatoes and Chips Pawns served with Chips or Rice', '', 5000, 0, 5, 0),
(70, 'portn of couscous', '', 1000, 0, 5, 0),
(71, 'BASMATIC RICE SHREDDED GIZZARD', '', 3500, 0, 5, 0),
(72, 'Vegetable Couscous', '', 2000, 0, 5, 0),
(73, 'PORTION OF SPAGHETTI', '', 1500, 0, 5, 0),
(74, 'Portion of rice', '', 1200, 0, 5, 0),
(75, 'basmatic rice chicken', '', 4000, 0, 5, 0),
(76, 'basmatic rice shredded chicken', '', 4000, 0, 5, 0),
(77, 'Veg soup and beef', '', 3500, 0, 5, 0),
(78, 'basmatic rice fish', '', 5500, 0, 5, 0),
(79, 'basmatic rice shredded beef', '', 4000, 0, 5, 0),
(80, 'Chinese fried  rice', '', 2000, 0, 5, 0),
(81, 'Full Gospel Dinner and bottle water', '', 2000, 0, 5, 0),
(82, 'FGBMF  DINNER', '', 1800, 0, 5, 0),
(83, 'Portion of Stew', '', 1000, 0, 5, 0),
(84, 'Tea Break Nsitf', '', 1000, 0, 5, 0),
(85, 'Plated Lunch Nsitf', '', 2000, 0, 5, 0),
(86, 'Plated Lunch', '', 2000, 0, 5, 0),
(87, 'NKWOBI', '', 3000, 0, 5, 0),
(88, 'Portion of Milk', '', 600, 0, 5, 0),
(89, 'Yam in butter Sauce', '', 2000, 0, 5, 0),
(90, 'Scrammble Eggs', '', 1500, 0, 5, 0),
(91, 'periwinkle', '', 500, 0, 5, 0),
(92, 'Beans Porrage', '', 1500, 0, 5, 0),
(93, 'Shredded beef served with seasonal vegetable', '', 4000, 0, 5, 0),
(94, 'Thai style fried rice with shrimps', '', 5000, 0, 5, 0),
(95, 'Stir fried noodles with seasonal vegetable', '', 3500, 0, 5, 0),
(96, 'Poached egg', '', 1000, 0, 5, 0),
(97, 'Sausage Quaker Oat chicken', '', 4000, 0, 5, 0),
(98, 'Vegetable Sauce', '', 1000, 0, 5, 0),
(99, 'Complimentary Breakfast', '', 2500, 0, 5, 0),
(100, 'Tea Break ( Nestoil)', '', 2000, 0, 5, 0),
(101, 'GREEN/GINGER TEA', '', 600, 0, 5, 0),
(102, 'Chinese Rice And Chicken', '', 4500, 0, 5, 0),
(103, 'Swallow Soup and Meat (staff)', '', 1000, 0, 5, 0),
(104, 'Ofakwu and goatmeat', '', 4500, 0, 5, 0),
(105, 'Ofakwu and beef', '', 4500, 0, 5, 0),
(106, 'Breaded Fish with Seasonal Vegetable served with C', '', 4000, 0, 6, 0),
(107, 'Grilled Prawns and Spaghetti', '', 5000, 0, 7, 0),
(108, 'Lamb Curry & Veg', '', 5000, 0, 7, 0),
(109, 'Lamb Chops, Mushroom & Veg', '', 4000, 0, 7, 0),
(110, 'Lamb Chops, Mushroom & Potatoes', '', 4000, 0, 7, 0),
(111, 'Chops', '', 1200, 0, 7, 0),
(112, 'Grilled chichen salad with bred crumbs', '', 3500, 0, 8, 0),
(113, 'Mixed Salad', '', 1700, 0, 8, 0),
(114, 'Chicken Ceaser Salad', '', 3500, 0, 8, 0),
(115, 'Coleslaw', '', 500, 0, 8, 0),
(116, 'Caesar Salad', '', 2000, 0, 8, 0),
(117, 'Chicken Salad', '', 4000, 0, 8, 0),
(118, 'Vegetable Salad', '', 2000, 0, 8, 0),
(119, 'Fruit Salad', '', 1500, 0, 8, 0),
(120, 'Fruit Platter', '', 1000, 0, 8, 0),
(121, 'GRILLED CHICKEN SALAD WITH BREAD CRUMS', '', 4000, 0, 8, 0),
(122, 'colesaw salad', '', 1000, 0, 8, 0),
(123, 'plate and cutleries', '', 500, 0, 8, 0),
(124, 'Crispy Spicy Fried Chicken', '', 3000, 0, 8, 0),
(125, 'Grilled Tillapia Fish And Chips', '', 5000, 0, 8, 0),
(126, 'Porridge Plantain', '', 1500, 0, 8, 0),
(127, 'French Toast', '', 1000, 0, 8, 0),
(128, 'Whole Grilled Chicken served with seasonal Vegetab', '', 7000, 0, 9, 0),
(129, 'Half Grilled Chicken served with Salad', '', 5000, 0, 9, 0),
(130, 'CHICKEN & CHIPS', '', 3500, 0, 9, 0),
(131, 'Grilled chicken served with Basmatic Rice', '', 4000, 0, 9, 0),
(132, 'Chips & Chicken', '', 3500, 0, 9, 0),
(133, 'Spicy Goat Foot (4 legs)', '', 3000, 0, 9, 0),
(134, 'Peppered beef', '', 2500, 0, 9, 0),
(135, 'Marinated & Spiced Gizzard', '', 2000, 0, 9, 0),
(136, 'Spicy Chicken Wings', '', 3000, 0, 9, 0),
(137, 'Spicy Soft Fried Shrimps (Scampi)', '', 2500, 0, 9, 0),
(138, 'Spicy Bush Meat Chops', '', 2800, 0, 9, 0),
(139, 'Grilled Cat Fish', '', 5000, 0, 9, 0),
(140, 'Peppered Chicken', '', 2500, 0, 9, 0),
(141, 'peppered goatmeat', '', 2500, 0, 9, 0),
(142, 'Beef Balls', '', 1000, 0, 9, 0),
(143, 'BBQ Local Chicken', '', 6000, 0, 9, 0),
(144, 'Seasonal Vegetable', '', 1000, 0, 10, 0),
(145, 'Stir Fry Mix  Veg', '', 3500, 0, 10, 0),
(146, 'Spaghetti Bolognaise', '', 4000, 0, 11, 0),
(147, 'Spanish Spaghetti served with Veg and Chicken', '', 3000, 0, 11, 0),
(148, 'spaghetti & g/meat', '', 3500, 0, 11, 0),
(149, 'Spaghetti & Shreeded Chicken', '', 3500, 0, 11, 0),
(150, 'Spaghetti & Shredded Beef', '', 3500, 0, 11, 0),
(151, 'Veg Indomie and shredded', '', 3500, 0, 11, 0),
(152, 'Spagetti & fish', '', 4500, 0, 11, 0),
(153, 'Sea Food Pasta', '', 7500, 0, 12, 0),
(154, 'Chicken Shawarma', '', 1500, 0, 12, 0),
(155, 'Vegetable Pizza', '', 2500, 0, 12, 0),
(156, 'beef sha', '', 3000, 0, 12, 0),
(157, 'Beef Burger with Chips', '', 3000, 0, 12, 0),
(158, 'Chicken Burger with Chips', '', 3000, 0, 12, 0),
(159, 'Club Sandwich with Chips', '', 4000, 0, 12, 0),
(160, 'Chips & Omellette', '', 2000, 0, 13, 0),
(161, 'samosa', '', 2000, 0, 13, 0),
(162, 'Fried potato', '', 1000, 0, 13, 0),
(163, 'portion of Plantain', '', 1000, 0, 13, 0),
(164, 'Scamble /Backed Beans & Oat, Fried Yam', '', 3000, 0, 13, 0),
(165, 'Indomie', '', 1000, 0, 13, 0),
(166, 'Sausages', '', 1000, 0, 13, 0),
(167, 'Fried Plantain with Baked Beans & Fruit Salad', '', 3000, 0, 13, 0),
(168, 'Tea/Coffee', '', 500, 0, 13, 0),
(169, 'Boiled Potatoe', '', 1000, 0, 13, 0),
(170, 'Plain Omellete', '', 1000, 0, 13, 0),
(171, 'Egg Sauce', '', 1500, 0, 13, 0),
(172, 'Tea/coffee, Bread', '', 1300, 0, 13, 0),
(173, 'Hot chocolate', '', 600, 0, 13, 0),
(174, 'Pan Cake', '', 1000, 0, 13, 0),
(175, 'COFFEE', '', 500, 0, 13, 0),
(176, 'FRIED EGGS', '', 1000, 0, 13, 0),
(177, 'Bread And Omellet', '', 1500, 0, 13, 0),
(178, 'Toast bread', '', 500, 0, 13, 0),
(179, 'Oat meal', '', 1000, 0, 13, 0),
(180, 'liver  Sauce', '', 1500, 0, 13, 0),
(181, 'Portn of Chips', '', 1000, 0, 13, 0),
(182, 'Baked Beans', '', 1000, 0, 13, 0),
(183, 'Noodles and Egg', '', 2000, 0, 13, 0),
(184, 'Custard', '', 1000, 0, 13, 0),
(185, 'Tea/Coffee & Bread Breakfast', '', 3000, 0, 13, 0),
(186, 'COOFFEE BREAK AM', '', 2000, 0, 13, 0),
(187, 'COFFEE BREAK PM', '', 2000, 0, 13, 0),
(188, 'Room Service', '', 500, 0, 13, 0),
(189, 'BOILED EGGS', '', 1000, 0, 13, 0),
(190, 'PORTION OF EGG', '', 1000, 0, 13, 0),
(191, 'fried potatoes', '', 1000, 0, 13, 0),
(192, 'Omellete', '', 1000, 0, 13, 0),
(193, 'Full English breakfast', '', 5000, 0, 13, 0),
(194, 'half breakfast', '', 2000, 0, 13, 0),
(195, 'BREAKFAST MEAL', '', 5000, 0, 13, 0),
(196, 'TEA BREAK (N.G.O)', '', 2000, 0, 13, 0),
(197, 'FRIED YAM, SPANISH OMELET', '', 2000, 0, 13, 0),
(198, 'FRIED EGG, BREAD, BAKED BEANS', '', 2000, 0, 13, 0),
(199, 'FRIED PLANTAIN, SAUSAGE, FRIED EGG', '', 2000, 0, 13, 0),
(200, 'SAUSAGE, BAKED BEANS, BREAD', '', 2000, 0, 13, 0),
(201, 'ONIONS, OMELETS, BREAD, OAT MEAL', '', 2000, 0, 13, 0),
(202, 'LIVER/KIDNEY SAUCE, BOILED YAM OATS', '', 2500, 0, 13, 0),
(203, 'OAT, BAKED BEANS, BREAD', '', 2000, 0, 13, 0),
(204, 'BOILED POTATOES, EGG SAUCE, TEA/COFFEE', '', 2500, 0, 13, 0),
(205, 'SCRAMBLED EGG, SAUSAGE, BAKED BEANS', '', 2000, 0, 13, 0),
(206, 'CHIPS, SPANISH OMELET, SAUSAGE', '', 2500, 0, 13, 0),
(207, 'CUSTARD, PLANTAIN, SPANISH OMELET', '', 2000, 0, 13, 0),
(208, 'Fruit And Fibre', '', 2000, 0, 13, 0),
(209, 'GIZZARD, BOILED YAM, OAT OR CUSTARD', '', 2500, 0, 13, 0),
(210, 'TEA BREAK (AM/PM) (CAMBRIDGE)', '', 1800, 0, 13, 0),
(211, 'TEA BREAK  (PM)(CAMBRIDGE)', '', 1550, 0, 13, 0),
(212, 'LOAF OF BREAD (STAFF ', '', 200, 0, 13, 0),
(213, 'Buffet Lunch 2', '', 2300, 0, 13, 0),
(214, 'Tea Break', '', 1000, 0, 13, 0),
(215, 'scoht egg', '', 1000, 0, 13, 0),
(216, 'Tea/coffee break 1', '', 1500, 0, 13, 0),
(217, 'Bacon', '', 1000, 0, 13, 0),
(218, 'Breakfast water', '', 150, 0, 13, 0),
(219, 'Buffet Breakfast', '', 2500, 0, 13, 0),
(220, 'Tea Break Menu', '', 800, 0, 13, 0),
(221, 'TOMATO SAUCE', '', 1000, 0, 13, 0),
(222, 'Cheese Omellete', '', 1500, 0, 13, 0),
(223, 'Portion Of Cheese', '', 500, 0, 13, 0),
(224, 'CBN PLATED LUNCH', '', 3500, 0, 13, 0),
(225, 'CBN TEA BREAK', '', 1800, 0, 13, 0),
(226, 'Projector Screen', '', 5000, 0, 13, 0),
(227, 'Nigeria Army Breakfast', '', 2000, 0, 13, 0),
(228, 'Portion Of Sardine', '', 1200, 0, 13, 0),
(229, 'Chicken in Curry Only', '', 3000, 0, 13, 0),
(230, 'Rice And Fresh Fish', '', 4700, 0, 13, 0),
(231, 'PEPPERED DRY FISH', '', 3500, 0, 13, 0),
(232, 'MIXED BUFFET BREAKFAST', '', 5350, 0, 13, 0),
(233, 'PLATE P', '', 100, 0, 13, 0),
(234, 'Coslow salad', '', 500, 0, 13, 0),
(235, 'CORNED BEEF SAUCE', '', 2000, 0, 13, 0),
(236, 'Cockage', '', 20000, 0, 13, 0),
(237, 'Portage beans and sweet potatoes', '', 2500, 0, 13, 0),
(238, 'Grilled Tillapia Fish (Staff)', '', 2000, 0, 13, 0),
(239, 'irish potatoes portage and sardine', '', 3000, 0, 13, 0),
(240, 'Perewinko', '', 500, 0, 13, 0),
(241, 'Rice And Turkey', '', 4200, 0, 13, 0),
(242, 'Kidney Sauce', '', 2000, 0, 13, 0),
(243, 'Neco Tea Break', '', 2000, 0, 13, 0),
(244, 'Ice Cream', '', 1000, 0, 14, 0),
(245, 'Orange Juice', '', 1000, 0, 14, 0),
(246, 'Cakes', '', 1000, 0, 14, 0),
(247, 'Meat Pie', '', 300, 0, 14, 0),
(248, 'Vegetable Spring roll x4', '', 2000, 0, 14, 0),
(249, 'Meat Pie , LARGE.', '', 400, 0, 14, 0),
(250, 'Dough Nut', '', 100, 0, 14, 0),
(251, 'CAKE (MEDIUM)', '', 3500, 0, 14, 0),
(252, 'CAKE    (SMALL)', '', 2500, 0, 14, 0),
(253, 'MIXED SNACKS (GROUP)', '', 700, 0, 14, 0),
(254, 'Chicken Pie', '', 400, 0, 14, 0),
(255, 'YAM & BUSH MEAT', '', 3500, 0, 15, 0),
(256, 'YAM & COW TAIL', '', 3500, 0, 15, 0),
(257, 'YAM & COW LEG', '', 4000, 0, 15, 0),
(258, 'Yam & Egg', '', 2000, 0, 15, 0),
(259, 'porrige yam', '', 1500, 0, 15, 0),
(260, 'PORTION OF YAM', '', 1000, 0, 15, 0),
(261, 'Fried yam', '', 1000, 0, 15, 0),
(262, 'Boiled Yam', '', 1000, 0, 15, 0),
(263, 'PLANTAIN & SNAIL', '', 4500, 0, 16, 0),
(264, 'PLANTAIN & STOCK FISH', '', 5000, 0, 16, 0),
(265, 'PLANTAIN & DRY FISH', '', 4500, 0, 16, 0),
(266, 'PLANTAIN & COW TAIL', '', 4000, 0, 16, 0),
(267, 'PLANTAIN & COW LEG', '', 4000, 0, 16, 0),
(268, 'PLANTAIN & FRESH FISH', '', 4500, 0, 16, 0),
(269, 'PLANTAIN & GOATMEAL', '', 3500, 0, 16, 0),
(270, 'PLANTAIN & CHICKEN WINGS', '', 4000, 0, 16, 0),
(271, 'Buffet Lunch', '', 2500, 0, 17, 0),
(272, 'BUFFET (PER PERSON)', '', 6000, 0, 17, 0),
(273, 'Lunch 2', '', 4000, 0, 17, 0),
(274, 'BUFFET DINNER MEAL', '', 3000, 0, 17, 0),
(275, 'BUFFET MEAL SERVICE', '', 4000, 0, 17, 0),
(276, 'Beffet meal', '', 6000, 0, 17, 0),
(277, 'buffet Dinner', '', 4700, 0, 17, 0),
(278, 'LAUNCH MEAL', '', 3500, 0, 17, 0),
(279, 'DINNER MEAL', '', 5000, 0, 17, 0),
(280, 'MUSHROOM', '', 1000, 0, 17, 0),
(281, 'BUFFET LUNCH (N.G.O)', '', 3000, 0, 17, 0),
(282, 'DINNER BUFFET', '', 3500, 0, 17, 0),
(283, 'Peppered Chicken (staff)', '', 1000, 0, 18, 0),
(284, 'chicken with black pepper and garlic', '', 4000, 0, 17, 0),
(285, 'Half Local Chicken', '', 3000, 0, 16, 0),
(286, 'White Soup with fress fish', '', 6000, 0, 18, 0),
(287, 'White soup with any protein', '', 5500, 0, 18, 0),
(288, 'Ofe owerri with any protein', '', 5000, 0, 18, 0),
(289, 'Roasted plantain with local sauce', '', 3500, 0, 18, 0),
(290, 'Roasted yam with local sauce', '', 3500, 0, 18, 0),
(291, 'Isi Ewu', '', 3000, 0, 18, 0),
(292, 'Grilled prawns salad with bread crumbs', '', 6000, 0, 18, 0),
(293, 'Honey glazed chicken wings with chips', '', 4000, 0, 18, 0),
(294, 'Beef kebab with chips', '', 2000, 0, 18, 0),
(295, 'Potatoe porrage', '', 1500, 0, 18, 0),
(296, 'Coconut rice', '', 2000, 0, 18, 0),
(297, 'Stock Fish portion', '', 4000, 0, 18, 0),
(298, 'Grilled Croaker ( Whole)', '', 5000, 0, 18, 0),
(299, 'Grilled Full Chiken With Chips', '', 6000, 0, 18, 0),
(300, 'Sardine Omellete', '', 1500, 0, 18, 0),
(301, 'Corn Flakes', '', 1000, 0, 18, 0),
(302, 'Spagetti Carbonara', '', 4000, 0, 18, 0),
(303, 'Mixed pasta with shrimps', '', 4000, 0, 18, 0),
(304, 'Chicken Fettuccine Afredo Pasta', '', 5000, 0, 18, 0),
(305, 'Prawns fettuccine Afredo Basmatic Rice', '', 6000, 0, 18, 0),
(306, 'Crispym spicy fried chicken', '', 3000, 0, 18, 0),
(307, 'Chicken in Curry Served with Rice', '', 3700, 0, 18, 0),
(308, 'PEPPERD TURKEY', '', 3000, 0, 18, 0),
(309, 'Grilled Tillapia Fish Only', '', 4000, 0, 18, 0),
(310, 'Staff Rice & Goat Meat', '', 1000, 0, 18, 0),
(311, 'Grilled Croaker Fish', '', 5000, 0, 18, 0),
(312, 'Birthday Buffet  lunch', '', 5000, 0, 18, 0),
(313, 'SPICY PRAWNS', '', 5000, 0, 18, 0),
(314, 'SWALLOW,SOUP & GOATMEAT', '', 4500, 0, 18, 0),
(315, 'SWALLOW,SOUP & CHICKEN', '', 4500, 0, 18, 0),
(316, 'RICE AND GOATMEAT', '', 3700, 0, 18, 0),
(317, 'BRAED OMELLET & TEA', '', 2500, 0, 18, 0),
(318, 'CHIPS OMELLET & TEA', '', 2500, 0, 18, 0),
(319, 'CHICKEN PP SOUP', '', 2500, 0, 18, 0),
(320, 'GOATMEAT PP SOUP', '', 2500, 0, 18, 0),
(321, 'YAM & EGG SAUCE', '', 2500, 0, 18, 0),
(322, 'CHIPS AND LIVER/KIDNEY SAUCE', '', 2500, 0, 18, 0),
(323, 'F/YAM AND EGG', '', 2500, 0, 18, 0),
(324, 'BEEF AND CHIPS', '', 3500, 0, 18, 0),
(325, 'Goat Meet Pepperd', '', 2500, 0, 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subitems`
--

CREATE TABLE `subitems` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `subNm` varchar(60) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `totprice` decimal(10,0) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `xdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nm` varchar(50) NOT NULL,
  `em` varchar(50) NOT NULL,
  `pn` varchar(11) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `adm` tinyint(1) NOT NULL DEFAULT '0',
  `rvl` tinyint(1) NOT NULL DEFAULT '0',
  `gem` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `xdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nm`, `em`, `pn`, `pw`, `dept`, `adm`, `rvl`, `gem`, `status`, `xdate`) VALUES
(2, 'Administrator', 'menu@caledoniansuites.com', '08033333333', 'menu#123', '4', 1, 1, 1, 0, '2021-05-24 16:46:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menugroup`
--
ALTER TABLE `menugroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subitems`
--
ALTER TABLE `subitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menugroup`
--
ALTER TABLE `menugroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT for table `subitems`
--
ALTER TABLE `subitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
