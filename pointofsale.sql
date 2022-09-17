-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 20, 2021 at 02:54 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pointofsale`
--

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

DROP TABLE IF EXISTS `main_menu`;
CREATE TABLE IF NOT EXISTS `main_menu` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` int(10) UNSIGNED NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `controller` varchar(250) NOT NULL,
  `controller_function` varchar(255) NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `root_menu` int(10) UNSIGNED NOT NULL,
  `sequence` int(10) UNSIGNED NOT NULL,
  `createdby` int(10) UNSIGNED NOT NULL,
  `modifiedby` int(10) UNSIGNED NOT NULL,
  `createddate` datetime NOT NULL,
  `modifieddate` datetime NOT NULL,
  `isactive` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`id`, `company_id`, `menu_name`, `controller`, `controller_function`, `module_id`, `root_menu`, `sequence`, `createdby`, `modifiedby`, `createddate`, `modifieddate`, `isactive`) VALUES
(1, 0, 'Dashboard', 'dashboard', 'viewdashboard', 0, 0, 1, 1, 0, '2018-02-07 17:32:23', '0000-00-00 00:00:00', 1),
(2, 0, 'Project', '', '', 0, 0, 1, 1, 1, '2018-02-11 23:59:56', '2018-03-21 14:47:28', 1),
(3, 0, 'Company', 'company', 'view1', 0, 0, 5, 1, 1, '2018-06-21 00:00:00', '2018-06-28 00:00:00', 1),
(4, 0, 'Add Project', 'project', 'view1', 0, 2, 1, 1, 1, '2018-03-09 01:19:16', '2018-03-21 14:48:17', 1),
(5, 0, 'Tool Box Talk', 'project', 'view2', 0, 2, 2, 1, 0, '2018-03-14 17:06:24', '0000-00-00 00:00:00', 1),
(6, 0, 'Wind Speed', 'project', 'view3', 0, 2, 2, 1, 0, '2018-03-15 16:31:08', '0000-00-00 00:00:00', 1),
(7, 0, 'profile', 'profile', 'viewprofile', 0, 3, 7, 1, 1, '2018-06-13 00:00:00', '2018-06-29 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

DROP TABLE IF EXISTS `tbl_accounts`;
CREATE TABLE IF NOT EXISTS `tbl_accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `acoount_name` varchar(100) DEFAULT NULL,
  `parent_account` int(11) DEFAULT '0',
  `account_number` varchar(50) DEFAULT NULL,
  `initial_balance` decimal(10,2) DEFAULT '0.00',
  `note` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`account_id`, `acoount_name`, `parent_account`, `account_number`, `initial_balance`, `note`) VALUES
(1, 'Bank', 0, '123443545', '-390.00', 'sdf'),
(2, 'Purchase', 0, '005', '11700.00', 'test account'),
(3, 'Sales', 0, '006', '-1818.00', 'test sales');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(18) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `balance` int(11) NOT NULL,
  `note` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `insert_by` tinyint(4) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` tinyint(4) DEFAULT '0',
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `email`, `phone`, `address`, `balance`, `note`, `status`, `insert_by`, `insert_date`, `update_by`, `update_date`) VALUES
(1, 'MD. RAMZAN ALI', 'aramzan11@yahoo.coms', '01916442058', 'pabna', 0, 'ftgh', 0, 0, '2019-08-04 22:08:03', 0, NULL),
(2, 'Momin', 'momin11@gmail.com', '01616313174', '', 0, '', 0, 1, '2020-11-27 22:45:59', 0, NULL),
(3, 'Momin', 'momin15@gmail.com', '01616313174', 'tangail', 0, '', 0, 1, '2020-11-27 22:46:26', 0, NULL),
(4, 'Momin', 'mdtareqislam7@gmail.com', '01737001672', 'DHAKA', 0, '', 0, 1, '2020-11-27 23:00:29', 0, NULL),
(5, 'Shamim Anterprise', '', '01736031483', 'Gopalpur', 0, '', 0, 1, '2020-12-05 12:51:10', 0, NULL),
(6, 'MD Sobus Miah', 'acinmanus93@gmail.com', '01738740980', 'Shokepur Borocona', 0, 'Dealer', 1, 1, '2021-02-20 12:16:39', 0, NULL),
(7, 'MD Rased Miah', 'rahamanm763@gmail.com', '01720057789', 'Potol Bazer', 0, 'Dealer', 1, 1, '2021-02-20 12:18:11', 0, NULL),
(8, 'MD Momin Miah', 'momin153@gmail.com', '01768607222', 'Bowapur Shollabazer', 0, 'Dealer', 1, 1, '2021-02-20 12:20:23', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grants`
--

DROP TABLE IF EXISTS `tbl_grants`;
CREATE TABLE IF NOT EXISTS `tbl_grants` (
  `permission_id` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  PRIMARY KEY (`permission_id`,`person_id`),
  KEY `ospos_grants_ibfk_2` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_grants`
--

INSERT INTO `tbl_grants` (`permission_id`, `person_id`) VALUES
('accounts', 1),
('customer', 1),
('employees', 1),
('purchase', 1),
('replacement', 1),
('reports', 1),
('sales', 1),
('settings', 1),
('stock', 1),
('suppliers', 1),
('transaction', 1),
('warehouse', 1),
('employees', 8),
('purchase', 8),
('employees', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

DROP TABLE IF EXISTS `tbl_modules`;
CREATE TABLE IF NOT EXISTS `tbl_modules` (
  `sort` int(10) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_modules`
--

INSERT INTO `tbl_modules` (`sort`, `module_id`) VALUES
(100, 'accounts'),
(90, 'customer'),
(80, 'employees'),
(20, 'purchase'),
(110, 'replacement'),
(50, 'reports'),
(70, 'sales'),
(150, 'settings'),
(60, 'stock'),
(40, 'suppliers'),
(30, 'transaction'),
(10, 'warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

DROP TABLE IF EXISTS `tbl_permissions`;
CREATE TABLE IF NOT EXISTS `tbl_permissions` (
  `permission_id` varchar(255) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  `location_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`permission_id`),
  KEY `module_id` (`module_id`),
  KEY `ospos_permissions_ibfk_2` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`permission_id`, `module_id`, `location_id`) VALUES
('config', 'config', NULL),
('customers', 'customers', NULL),
('employees', 'employees', NULL),
('giftcards', 'giftcards', NULL),
('items', 'items', NULL),
('items_stock', 'items', 1),
('item_kits', 'item_kits', NULL),
('receivings', 'receivings', NULL),
('receivings_stock', 'receivings', 1),
('reports', 'reports', NULL),
('reports_categories', 'reports', NULL),
('reports_customers', 'reports', NULL),
('reports_discounts', 'reports', NULL),
('reports_employees', 'reports', NULL),
('reports_inventory', 'reports', NULL),
('reports_items', 'reports', NULL),
('reports_payments', 'reports', NULL),
('reports_receivings', 'reports', NULL),
('reports_sales', 'reports', NULL),
('reports_suppliers', 'reports', NULL),
('reports_taxes', 'reports', NULL),
('sales', 'sales', NULL),
('sales_stock', 'sales', 1),
('suppliers', 'suppliers', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_replacement`
--

DROP TABLE IF EXISTS `tbl_replacement`;
CREATE TABLE IF NOT EXISTS `tbl_replacement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(200) NOT NULL,
  `mobile` varchar(16) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `product_name` varchar(200) NOT NULL,
  `model` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `receive_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivery_date` datetime DEFAULT NULL,
  `transaction_type` tinyint(4) NOT NULL COMMENT '1 => ''Receive'', 2 => ''Return''',
  `replacement_charge` float DEFAULT NULL,
  `item_qnty` int(11) NOT NULL,
  `insert_by` tinyint(4) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` tinyint(4) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `remarks` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_replacement`
--

INSERT INTO `tbl_replacement` (`id`, `customer_name`, `mobile`, `email`, `address`, `product_name`, `model`, `code`, `receive_date`, `delivery_date`, `transaction_type`, `replacement_charge`, `item_qnty`, `insert_by`, `insert_date`, `update_by`, `update_date`, `is_active`, `remarks`) VALUES
(1, 'Shafiq', '017485214587', 'abc@abc.com', 'Rangpur Cadet College, Rangpur Sadar', 'aa', 'aa', 'asw', '2019-12-16 00:00:00', '2019-12-19 00:00:00', 1, 10, 12, 1, '2019-12-16 22:08:34', 1, '2019-12-21 16:22:59', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

DROP TABLE IF EXISTS `tbl_settings`;
CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `type`, `description`) VALUES
(1, 'system_name', 'Wonder Electronics'),
(2, 'system_title', 'An Ideal Store'),
(3, 'system_email', 'support@wonderelectronics.com'),
(4, 'system_mobile', '09636221188'),
(5, 'system_address', 'House 15, Road 19, Block D, Section 6. Mirpur, Dhaka 1216');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_avail`
--

DROP TABLE IF EXISTS `tbl_stock_avail`;
CREATE TABLE IF NOT EXISTS `tbl_stock_avail` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_category`
--

DROP TABLE IF EXISTS `tbl_stock_category`;
CREATE TABLE IF NOT EXISTS `tbl_stock_category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(120) NOT NULL,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stock_category`
--

INSERT INTO `tbl_stock_category` (`id`, `parent_id`, `name`, `description`) VALUES
(27, 0, 'Abid Chaps', 'Chaps'),
(29, 0, 'Abid Tang', 'Tang'),
(30, 27, 'A B C D Chaps', 'Abid 2 Taker Chaps'),
(32, 27, 'Doremoto Chaps', '3 Taker Chaps'),
(33, 27, 'Nonta Fonta Chaps', 'Nonta Fonta Chaps'),
(34, 27, 'Dal Vaja', 'Dal Vaja'),
(35, 27, 'Motor Vaja', 'Motor Vaja'),
(36, 27, '10 Taker Potato', '10 Taker Potato'),
(39, 0, 'Abid Cleaner ', 'Cleaner'),
(41, 0, 'Abid Detergent', 'Detergent'),
(43, 39, 'Toilet Cleaner 750g', 'Toilet Cleaner'),
(44, 39, 'Toilet Cleaner 500g', 'Toilet Cleaner'),
(45, 39, 'Dis Wash 500g', 'Dis Wash'),
(46, 41, 'Detergent 500g', 'Detergent'),
(47, 41, 'Detergent 200g', 'Detergent'),
(48, 41, 'Super Excel 20g', 'Super Excel'),
(49, 41, 'Lemon Detergent 30g', 'Lemon Detergent '),
(50, 29, 'Tang 08g', 'Tang'),
(51, 29, 'Tang 70g', 'Tang'),
(52, 29, 'Tang 125g', 'Tang'),
(53, 29, 'Tang 250g', 'Tang'),
(54, 29, 'Jock Tang 250g ', 'Tang'),
(55, 29, 'Jock Tang 350g', 'Tang'),
(56, 29, 'Jock Tang 500g', 'Tang'),
(57, 29, 'Jock Tang 900g', 'Tang'),
(58, 0, 'Abid Tasty saline ', 'Tasty saline '),
(59, 58, 'Tasty saline  14g', 'Tasty saline '),
(60, 0, 'Abid Robo pipe', 'Robo pipe'),
(61, 60, 'Robo pipe 90ml', 'Robo pipe'),
(62, 0, 'Seam Chips', 'Seam Chips'),
(63, 62, 'Potato Chips (25g)', 'Potato Chips '),
(64, 62, ' Potato Chips 15g', 'Potato Chips '),
(65, 62, 'Noodles Chips (25g)', 'Noodles Chips'),
(66, 62, 'Kurmuray Chaps 15g', 'Kurmuray Chaps'),
(67, 62, 'Ring Chips 15g', 'Ring Chips 25g'),
(68, 62, 'Jal Mori 25g', 'Chaps'),
(69, 62, 'motor vaja 25g', 'Chaps'),
(70, 0, 'Seam  Chanachur ', 'Seam Chanachur '),
(71, 70, ' Kamranga Chanachur 25g', 'chanachur'),
(72, 70, 'Namkin  Chanachur  120g', 'chanachur'),
(73, 70, 'Namkin Chanachur 320g', 'chanachur'),
(74, 0, 'Seam Detergent', 'Seam Detergent'),
(75, 74, 'Seam Detergent 500g', 'Detergent'),
(76, 74, 'Seam Detergent 200g', 'Detergent'),
(77, 0, 'Vip Tara Oil', 'Oil'),
(78, 77, 'Oil 500ml', 'Oil'),
(79, 77, 'Oil 1L', 'Oil'),
(80, 77, 'Oil 2L', 'Oil'),
(81, 77, 'Oil 5L', 'Oil'),
(82, 0, 'Vip Tara Rice/Ata/Dal/Salt', 'Vip Tara Rice/Ata/Dal'),
(83, 82, 'Polao Rice', 'Rice'),
(84, 0, 'VIP Tara Candy', 'Candy'),
(85, 84, 'Milk Candy', 'Candy'),
(86, 84, 'Mango Candy', 'Candy'),
(87, 84, 'Hojom Candy', 'Candy'),
(88, 84, 'Loli Pop', 'Candy'),
(89, 84, 'Love Candy Jok', 'Candy'),
(90, 84, 'Love Candy', 'Candy'),
(91, 84, 'Doraimon', 'Candy'),
(92, 84, 'Chokho Chokho', 'Candy'),
(93, 84, 'Dairy Milk 10g', 'Candy'),
(94, 84, 'Puls Candy', 'Candy'),
(95, 84, 'Cup Chocklate', 'Candy'),
(96, 0, 'Vip Tara Tissue', 'Tissue'),
(97, 96, 'Gold Tissue', 'Tissue'),
(98, 96, 'White Tissue', 'Tissue'),
(99, 77, 'Master Oil 80ml', 'Master Oil'),
(100, 77, 'Master 250ml', 'Master 250ml'),
(101, 82, 'Mosuri Dal - A 500g', 'Mosuri Dal - A '),
(102, 82, 'Mosuri Dal - B 500g', 'Mosuri Dal - B'),
(103, 82, 'Ata  1 Kg', 'Ata '),
(104, 82, 'Moida  1Kg', 'Moida'),
(105, 0, 'Vip Tara Drinks', 'Drinks'),
(106, 105, 'Ice Loly ', 'Drinks'),
(107, 105, 'Ice Pop', 'Drinks'),
(108, 105, 'Mango Drinks 250ml', 'Drinks'),
(109, 105, 'Mango Drinks 500ml', 'Drinks'),
(110, 105, 'Mango Drinks 1L', 'Drinks'),
(111, 82, 'Salt 1kg', 'salt'),
(112, 96, 'Pocket Tissue', 'Poket Tissue'),
(113, 0, 'SSG Blink LED', 'SSG Blink'),
(114, 113, '3 W', 'LED'),
(115, 113, '5 W', 'LED'),
(116, 113, '7 W', 'LED'),
(117, 113, '9 W', 'LED'),
(118, 113, '12 W', 'LED'),
(119, 113, '15 W', 'LED'),
(120, 113, '18 W', 'LED'),
(121, 113, '20 W', 'LED'),
(122, 113, '30 W', 'LED'),
(123, 113, '40 W', 'LED'),
(124, 113, '50 W', 'LED'),
(125, 113, '60 W', 'LED'),
(126, 113, 'LED TUBE Round ', 'LED'),
(127, 113, 'LED TUBE Flat', 'LED'),
(128, 0, 'Blink GLS', 'GLS'),
(129, 128, '25 W', 'GLS'),
(130, 128, '40 W', 'GLS'),
(131, 128, '60 W', 'GLS'),
(132, 128, '100 W', 'GLS'),
(133, 128, '200 W', 'GLS'),
(134, 128, '200 W', 'GLS'),
(135, 0, 'Blink Bord Switch', 'Bord '),
(136, 135, 'Switch', 'bord'),
(137, 135, 'Socket', 'bord'),
(138, 135, 'indicator', 'bord'),
(139, 135, 'Regulator', 'bord'),
(140, 135, 'fuse', 'bord'),
(141, 135, '2 Way Switch', 'bord'),
(142, 0, 'Blink Gang ', 'Gang '),
(143, 142, '1 Gang 1 Way Switch (GS 01)', 'Switch'),
(144, 142, '1 Gang 2 Way Switch (GS 02)', 'Gang'),
(145, 142, '2 Gang 1 Way Switch (GS 03)', 'Gang'),
(146, 142, '2 Gang 2 Way Switch (GS 04)', 'Gang'),
(147, 142, '3 Gang 1 Way Switch (GS 05)', 'Gang'),
(148, 142, '4 Gang 1 Way Switch (GS 06)', 'Gang'),
(149, 142, '2 & 3 Multy Socket (GS 25)', 'Gang'),
(150, 142, '2 Pin Socket (GS 13)', 'Gang'),
(151, 142, 'Internet Socket (GS 22)', 'Gang'),
(152, 142, 'Fan Regulator (GS 20)', 'Gang'),
(153, 142, '20A DP Switch (GS 16)', 'Gang'),
(154, 142, '45A DP Switch (GS 16)', '40A DP Switch (GS 16)'),
(155, 142, 'Bell Push (GS 12)', 'Gang'),
(156, 113, 'Dim light', 'LED'),
(157, 113, 'motion Light ', 'LED'),
(158, 113, 'Emergency LED 5w', 'LED'),
(159, 113, 'Emergency LED 10w', 'LED'),
(160, 142, 'TV socket  GS-18', 'Gang'),
(161, 0, 'Blink Breaker', 'Breaker'),
(162, 161, 'SP 6 AH', 'Breaker'),
(163, 161, 'SP 10 AH', 'Breaker'),
(164, 161, 'SP 16 AH', 'Breaker'),
(165, 161, 'SP 20 AH', 'Breaker'),
(166, 161, 'SP 25 AH', 'Breaker'),
(167, 161, 'SP 32 AH', 'Breaker'),
(168, 161, 'SP 40 AH', 'Breaker'),
(169, 161, 'SP 63 AH', 'Breaker'),
(170, 161, 'DP 6 AH', 'Breaker'),
(171, 161, 'DP 10 AH', 'Breaker'),
(172, 161, 'DP 16 AH', 'Breaker'),
(173, 161, 'DP 20 AH', 'Breaker'),
(174, 161, 'DP 25 AH', 'Breaker'),
(175, 161, 'DP 32 AH', 'Breaker'),
(176, 161, 'DP 40 AH', 'Breaker'),
(177, 161, 'DP 63 AH', 'Breaker'),
(178, 0, 'Blink BekoLight', 'Holder'),
(179, 178, 'batten holder 22', 'Holder'),
(180, 178, 'batten holder 27', 'Holder'),
(181, 178, 'Pandent  holder 22', 'Holder'),
(182, 178, '2 pin plug  ', 'plug'),
(183, 178, 'bed switch', 'switch'),
(184, 178, 'Ceiling rose', 'ceiling rose'),
(185, 142, '3 pin Round Socket  (AC) GS-15', 'Gang'),
(186, 178, 'mosquit bad', 'bad'),
(187, 0, 'Blink Fan ', 'Fan'),
(188, 187, '56\'\' Fan', 'Fan'),
(189, 187, '48\'\' Fan', 'Fan'),
(190, 187, 'Table Fan 16\'\'', 'Fan'),
(191, 187, 'Net Fan', 'Fan'),
(192, 187, '9\'\' Fan', 'Fan'),
(193, 0, 'SSG Solar Panel', 'Solar'),
(194, 193, 'panel 20W', 'solar'),
(195, 193, 'Panel 30W', 'solar'),
(196, 193, 'Panel 40W', 'solar'),
(197, 193, 'Panel 50W', 'solar'),
(198, 193, 'Panel 65W', 'solar'),
(199, 193, 'Panel 85W', 'solar'),
(200, 193, 'Panel 100W', 'solar'),
(201, 193, 'Panel 130W', 'solar'),
(202, 193, 'Panel 150W', 'solar'),
(203, 0, 'SSG Solar Fan', 'solar'),
(204, 203, 'DC 56\'\' Fan', 'solar'),
(205, 203, 'DC 48\'\' Fan', 'solar'),
(206, 203, 'DC Net Fan', 'solar'),
(207, 203, 'DC 12\'\' Fan', 'solar'),
(208, 203, 'DC 14\" Fan', 'solar'),
(209, 203, 'DC 16\" Fan', 'solar'),
(210, 203, 'DC 16\" Stan Fan', 'solar'),
(211, 0, 'SSG Solar LED', 'LED'),
(212, 211, 'DC 3W Bulb', 'LED'),
(213, 211, 'DC 5W Bulb', 'LED'),
(214, 211, 'DC 3W (T5)', 'LED'),
(215, 211, 'DC 5W (T5)', 'LED'),
(216, 211, 'DC 7W (T8)', 'LED'),
(217, 0, 'SSG Solar Controller', 'Controller'),
(218, 217, 'Mini Controller', 'Controller'),
(219, 217, 'Classic Controller', 'Controller'),
(220, 217, 'Premium Controller', 'Controller'),
(221, 217, 'Premium Digital Controller', 'Controller'),
(222, 217, '12/24 Volt Digital Controller', 'Controller'),
(223, 0, 'SSG Solar Battery ', 'Battery '),
(224, 223, '20A Battery ', 'Battery '),
(225, 223, '30A Battery ', 'Battery '),
(226, 223, '40A Battery ', 'Battery '),
(227, 223, '60A Battery ', 'Battery '),
(228, 223, '80A Battery ', 'Battery '),
(229, 223, '100A Battery ', 'Battery '),
(230, 223, '130A Battery ', 'Battery '),
(231, 0, 'SSG Solar Other Product', 'Solar '),
(232, 231, 'Panel structure', 'Panel structure'),
(233, 231, 'Battery cables', 'Battery cables'),
(234, 231, 'Solar Bed Switch', 'Switch'),
(235, 203, 'AC/DC 12\" Charger Fan', 'Fan'),
(236, 203, 'AC/DC 16\" Charger Fan', 'Fan'),
(237, 203, 'AC/DC 12\" High Speed Fan', 'Fan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_details`
--

DROP TABLE IF EXISTS `tbl_stock_details`;
CREATE TABLE IF NOT EXISTS `tbl_stock_details` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stock_name` varchar(120) NOT NULL,
  `stock_quatity` int(11) NOT NULL DEFAULT '0',
  `reorder_level` int(11) DEFAULT '0',
  `supplier_id` varchar(250) NOT NULL,
  `company_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `unit_price_single` int(11) DEFAULT NULL,
  `unit_price_per_pcs` int(11) DEFAULT NULL,
  `unit_price_carton` int(11) DEFAULT NULL,
  `category` varchar(120) NOT NULL,
  `model_no` varchar(50) DEFAULT NULL,
  `made_by` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expire_date` datetime NOT NULL,
  `uom` varchar(10) NOT NULL,
  `warehouse` tinyint(4) DEFAULT '0',
  `note` varchar(120) DEFAULT NULL,
  `insert_by` tinyint(4) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` tinyint(4) NOT NULL DEFAULT '0',
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stock_details`
--

INSERT INTO `tbl_stock_details` (`id`, `stock_name`, `stock_quatity`, `reorder_level`, `supplier_id`, `company_price`, `selling_price`, `unit_price_single`, `unit_price_per_pcs`, `unit_price_carton`, `category`, `model_no`, `made_by`, `date`, `expire_date`, `uom`, `warehouse`, `note`, `insert_by`, `insert_date`, `update_by`, `update_date`) VALUES
(12, 'Nonta Fonta Chaps', 8, 3, '5', '1481.00', '1600.00', NULL, NULL, 1600, '33', '', '', '2021-02-20 04:35:30', '0000-00-00 00:00:00', 'pcs', 0, '', 1, '2021-02-20 16:35:30', 0, NULL),
(14, 'A B C D Chaps', 20, 3, '5', '700.00', '741.00', NULL, NULL, 700, '30', '', '', '2021-02-20 05:00:19', '0000-00-00 00:00:00', 'pcs', 0, '', 1, '2021-02-20 17:00:19', 0, NULL),
(15, 'Doremoto Chaps', 17, 3, '5', '1176.00', '1250.00', NULL, NULL, 1176, '32', '', '', '2021-02-20 05:01:31', '0000-00-00 00:00:00', 'pcs', 0, '', 1, '2021-02-20 17:01:31', 0, NULL),
(16, 'motor Vaja', 10, 3, '5', '1570.00', '1667.00', NULL, NULL, 1570, '35', '', '', '2021-02-20 05:03:25', '0000-00-00 00:00:00', 'pcs', 0, '', 1, '2021-02-20 17:03:25', 0, NULL),
(17, '10 Taker Potato', 63, 10, '5', '455.00', '481.00', NULL, NULL, 455, '36', '', '', '2021-02-20 05:05:33', '0000-00-00 00:00:00', 'pcs', 0, '', 1, '2021-02-20 17:05:33', 0, NULL),
(18, 'Dal Vaja', 4, 3, '5', '1570.00', '1667.00', NULL, NULL, 1570, '34', '', '', '2021-02-20 05:06:41', '0000-00-00 00:00:00', 'pcs', 0, '', 1, '2021-02-20 17:06:41', 0, NULL),
(19, 'Toilet Cleaner ', 96, 24, '5', '83.00', '88.00', NULL, NULL, 83, '43', '', '', '2021-02-20 05:12:49', '0000-00-00 00:00:00', 'pcs', 0, '', 1, '2021-02-20 17:12:49', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_entries`
--

DROP TABLE IF EXISTS `tbl_stock_entries`;
CREATE TABLE IF NOT EXISTS `tbl_stock_entries` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stock_id` varchar(120) NOT NULL,
  `account_id` int(11) NOT NULL,
  `stock_name` varchar(260) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `category` varchar(120) NOT NULL,
  `quantity` int(11) NOT NULL,
  `company_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `opening_stock` int(11) NOT NULL,
  `closing_stock` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(120) NOT NULL,
  `type` varchar(50) NOT NULL,
  `salesid` varchar(120) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `mode` varchar(150) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `due` decimal(10,2) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `billnumber` varchar(120) NOT NULL,
  `insert_by` tinyint(4) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` tinyint(4) NOT NULL DEFAULT '0',
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stock_entries`
--

INSERT INTO `tbl_stock_entries` (`id`, `stock_id`, `account_id`, `stock_name`, `supplier_id`, `category`, `quantity`, `company_price`, `selling_price`, `opening_stock`, `closing_stock`, `date`, `username`, `type`, `salesid`, `total`, `payment`, `balance`, `mode`, `description`, `due`, `subtotal`, `billnumber`, `insert_by`, `insert_date`, `update_by`, `update_date`) VALUES
(6, '10', 0, 'A B C D Chaps', 5, 'A B C D Chaps', 6, '700.00', '700.00', 0, 0, '2021-02-20 06:42:29', 'admin', 'receive', '6030af5523253', '3705.00', '4200.00', '0.00', 'Cash', 'Depo', '-495.00', 4200, '', 0, '2021-02-20 12:42:29', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_sales`
--

DROP TABLE IF EXISTS `tbl_stock_sales`;
CREATE TABLE IF NOT EXISTS `tbl_stock_sales` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `transactionid` varchar(250) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `stock_name` varchar(200) NOT NULL,
  `category` varchar(120) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(120) NOT NULL,
  `customer_id` varchar(120) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `tax_dis` varchar(100) NOT NULL,
  `dis_amount` decimal(10,0) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `due` int(11) NOT NULL,
  `mode` varchar(250) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `billnumber` varchar(50) DEFAULT NULL,
  `insert_by` tinyint(4) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` tinyint(4) NOT NULL DEFAULT '0',
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stock_sales`
--

INSERT INTO `tbl_stock_sales` (`id`, `transactionid`, `stock_id`, `account_id`, `stock_name`, `category`, `supplier_name`, `selling_price`, `quantity`, `amount`, `date`, `username`, `customer_id`, `subtotal`, `payment`, `balance`, `discount`, `tax`, `tax_dis`, `dis_amount`, `grand_total`, `due`, `mode`, `description`, `billnumber`, `insert_by`, `insert_date`, `update_by`, `update_date`) VALUES
(4, '6030b0071f0f4', 10, 3, 'A B C D Chaps', 'A B C D Chaps', '', '741.00', '6.00', '741.00', '2021-02-20 06:45:27', 'admin', '6', '4446.00', '4446.00', '0.00', '0', '0', '', '0', '741.00', 0, 'Cash', 'Dealer', NULL, 0, '2021-02-20 12:45:27', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_details`
--

DROP TABLE IF EXISTS `tbl_store_details`;
CREATE TABLE IF NOT EXISTS `tbl_store_details` (
  `name` varchar(100) NOT NULL,
  `log` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `web` varchar(100) NOT NULL,
  `pin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_store_details`
--

INSERT INTO `tbl_store_details` (`name`, `log`, `type`, `address`, `place`, `city`, `phone`, `email`, `web`, `pin`) VALUES
('ABC', 'logo.png', 'image/png', 'Pabna', 'Pabna', 'Pabna', '14785214587', 'nai', 'nai', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

DROP TABLE IF EXISTS `tbl_supplier`;
CREATE TABLE IF NOT EXISTS `tbl_supplier` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(18) DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `com_name` varchar(150) DEFAULT NULL,
  `balance` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `insert_by` tinyint(4) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` tinyint(4) NOT NULL DEFAULT '0',
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id`, `name`, `email`, `phone`, `address`, `com_name`, `balance`, `status`, `insert_by`, `insert_date`, `update_by`, `update_date`) VALUES
(2, 'Vip Tara Food ', 'viptarafoodbeverage@gmail.com', '01690272250', 'Dakshinkhan Uttara Dhaka', 'Vip Tara Food & Bevarage', 0, 1, 1, '2020-11-27 22:19:55', 0, NULL),
(4, 'superstar Bling', ' info@ssgbd.com', '+88-09610-774774', 'DHAKA', 'superstar Bling', 0, 1, 1, '2020-12-05 12:42:22', 0, NULL),
(5, 'Abid Food', 'abidfoodinfo@gmail.com', '01720038647', 'East Badda, Dhaka', 'Abid Food & Consumer', 0, 1, 1, '2021-02-20 12:23:46', 0, NULL),
(6, 'Seam Food ', 'seamfood02@gmail.com', '01711660587', 'Mogbazer Dhaka', 'Seam Food & Bevarage LTD', 0, 1, 1, '2021-02-20 12:55:41', 0, NULL),
(7, 'SSG Solar', 'monizaman57@gmail.com', '01737001672', 'kaspur Narayanganj Dhaka', 'SSG Solar', 0, 1, 1, '2021-02-20 13:05:14', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

DROP TABLE IF EXISTS `tbl_transactions`;
CREATE TABLE IF NOT EXISTS `tbl_transactions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) NOT NULL,
  `transaction_id` varchar(30) NOT NULL,
  `reference_no` varchar(30) DEFAULT NULL,
  `party_code` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `debit_credit` varchar(30) DEFAULT NULL,
  `transaction_type` varchar(50) NOT NULL,
  `mode` varchar(20) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `date` datetime NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `insert_by` tinyint(4) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` tinyint(4) NOT NULL DEFAULT '0',
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`id`, `account_id`, `transaction_id`, `reference_no`, `party_code`, `subtotal`, `payment`, `balance`, `due`, `debit_credit`, `transaction_type`, `mode`, `note`, `date`, `is_active`, `insert_by`, `insert_date`, `update_by`, `update_date`) VALUES
(1, '0', '5e65082e870cf', NULL, 1, '200.00', '200.00', '-200.00', '0.00', NULL, 'receive', 'Cash', 'as', '2020-03-08 14:58:54', 0, 0, '2020-03-08 20:58:54', 0, NULL),
(2, '0', '5fc12e70ce0c9', NULL, 2, '2640.00', '2640.00', '-2640.00', '0.00', NULL, 'receive', 'Cash', '1', '2020-11-27 16:50:56', 0, 0, '2020-11-27 22:50:56', 0, NULL),
(3, '3', '5fc12ed3803d3', NULL, 3, '56.00', '672.00', '2828.00', '0.00', NULL, 'sales', 'Cash', 'kkk', '2020-11-27 16:52:35', 0, 0, '2020-11-27 22:52:35', 0, NULL),
(4, '3', '5fc132803b701', NULL, 4, '672.00', '200.00', '2628.00', '472.00', NULL, 'sales', 'Cash', '1', '2020-11-27 17:08:16', 0, 0, '2020-11-27 23:08:16', 0, NULL),
(5, '0', '5fc13518ef8b4', NULL, 2, '1696.00', '1696.00', '-1696.00', '0.00', NULL, 'receive', 'Cash', 'kkk', '2020-11-27 17:19:21', 0, 0, '2020-11-27 23:19:21', 0, NULL),
(6, '0', '5fc1379125527', NULL, 2, '106.00', '5088.00', '-5088.00', '0.00', NULL, 'receive', 'Cash', '1', '2020-11-27 17:29:53', 0, 0, '2020-11-27 23:29:53', 0, NULL),
(7, '0', '5fc138e73f88f', NULL, 2, '240.00', '240.00', '-240.00', '0.00', NULL, 'receive', 'Cash', '1', '2020-11-27 17:35:35', 0, 0, '2020-11-27 23:35:35', 0, NULL),
(8, '1', '5fc9cd5694526', NULL, 2, '240.00', '240.00', '-390.00', '0.00', NULL, 'sales', 'Cash', '1', '2020-12-04 05:47:02', 0, 0, '2020-12-04 11:47:02', 0, NULL),
(9, '3', '6030b0071f0f4', NULL, 6, '741.00', '4446.00', '-1818.00', '0.00', NULL, 'sales', 'Cash', 'Dealer', '2021-02-20 06:45:27', 0, 0, '2021-02-20 12:45:27', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `address` varchar(250) DEFAULT NULL,
  `salary` varchar(50) DEFAULT NULL,
  `insert_by` tinyint(4) NOT NULL DEFAULT '0',
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` tinyint(4) NOT NULL DEFAULT '0',
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `designation`, `email`, `contact`, `username`, `password`, `is_active`, `address`, `salary`, `insert_by`, `insert_date`, `update_by`, `update_date`) VALUES
(1, 'BIMBs', 'Administrator', 'admin@admin.com', '01728504623', 'admin', 'fc76c4a86c56becc717a88f651264622', 1, '', NULL, 0, '2019-08-02 23:31:15', 1, '2019-08-24 16:18:00'),
(6, 'Shafiq', 'Manager', 'albrators@gmail.com', '7787876786', 'shafiq', 'fc76c4a86c56becc717a88f651264622', 0, '', NULL, 0, '2019-08-02 23:31:15', 0, '0000-00-00 00:00:00'),
(7, 'MD. RAMZAN ALI', 'CEO', 'aramzan11@yahoo.coms', '7787876786', 'ramzan', 'fc76c4a86c56becc717a88f651264622', 0, '', NULL, 0, '2019-08-02 23:31:15', 0, '0000-00-00 00:00:00'),
(8, 'abc', 'aaa', 'rudronabil80@gmail.com', '01916442058', 'abc', '25d55ad283aa400af464c76d713c07ad', 0, NULL, NULL, 0, '2019-08-02 23:48:00', 0, NULL),
(9, 'zaman', 'aaa', 'zamandcs@gmail.com', '015478954411', 'zaman', '25f9e794323b453885f5181f1b624d0b', 0, 'Rangpur Cadet College, Rangpur Sadar', '1000', 1, '2019-08-22 21:28:14', 1, '2019-12-11 14:58:39'),
(10, 'MD Tareq Miah', 'Manager', 'bhaibhaitraders00@gmail.com', '01616313174', 'mdtareq1672', '737eb9747007b922772e3d0f0c626bcf', 1, 'Tangail', '', 1, '2021-02-20 12:07:51', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warehouse`
--

DROP TABLE IF EXISTS `tbl_warehouse`;
CREATE TABLE IF NOT EXISTS `tbl_warehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse` varchar(200) DEFAULT NULL,
  `insert_by` tinyint(4) NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` tinyint(4) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_warehouse`
--

INSERT INTO `tbl_warehouse` (`id`, `warehouse`, `insert_by`, `insert_date`, `update_by`, `update_date`) VALUES
(1, 'Test', 0, '2019-12-11 21:40:12', 1, '2019-12-11 15:47:43'),
(2, 'Test2', 1, '2019-12-11 21:54:02', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
