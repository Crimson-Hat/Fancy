-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2022 at 07:56 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fancyliqourbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `sma_addresses`
--

CREATE TABLE `sma_addresses` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `line1` varchar(50) NOT NULL,
  `line2` varchar(50) DEFAULT NULL,
  `city` varchar(25) NOT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `state` varchar(25) NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_addresses`
--

INSERT INTO `sma_addresses` (`id`, `company_id`, `line1`, `line2`, `city`, `postal_code`, `state`, `country`, `phone`, `updated_at`) VALUES
(1, 4, 'ke avenue', '', 'nakuru', '889', '', 'kenya', '0752682', '0000-00-00 00:00:00'),
(2, 6, 'Qui incidunt quia e', 'Neque vero quod corp', 'Quasi anim pariatur', 'Harum illo ut ipsum ', 'Ducimus hic volupta', 'Rerum id dolor irure', '+1 (446) 612-9394', '2022-09-15 14:39:39'),
(3, 8, 'Dolorem ratione enim', 'Maxime eligendi duci', 'Consequuntur ut nost', 'Est ea aut elit ess', 'Aut quis veniam ill', 'Cupiditate neque sit', '+1 (632) 321-9429', '2022-09-18 18:03:53'),
(4, 9, 'Quas ipsam qui sunt', 'Ab cum vero ex corpo', 'Voluptatem eum rem a', 'Incididunt quod dese', 'Facilis corporis qua', 'Culpa omnis voluptat', '+1 (453) 763-7371', '2022-09-21 11:54:54');

-- --------------------------------------------------------

--
-- Table structure for table `sma_adjustments`
--

CREATE TABLE `sma_adjustments` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reference_no` varchar(55) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `count_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_adjustments`
--

INSERT INTO `sma_adjustments` (`id`, `date`, `reference_no`, `warehouse_id`, `note`, `attachment`, `created_by`, `updated_by`, `updated_at`, `count_id`) VALUES
(1, '2022-07-15 10:17:00', '2022/07/0001', 1, '', NULL, 4, NULL, NULL, NULL),
(2, '2022-09-18 12:33:00', '2022/09/0002', 1, '', NULL, 4, NULL, NULL, NULL),
(3, '2022-09-18 12:34:00', '2022/09/0003', 1, '', NULL, 4, NULL, NULL, NULL),
(4, '2022-09-18 12:34:00', '2022/09/0004', 1, '', NULL, 4, NULL, NULL, NULL),
(5, '2022-09-18 12:35:00', '2022/09/0005', 1, '', NULL, 4, NULL, NULL, NULL),
(6, '2022-09-18 12:35:00', '2022/09/0006', 1, '', NULL, 4, NULL, NULL, NULL),
(7, '2022-09-18 12:36:00', '2022/09/0007', 1, '', NULL, 4, NULL, NULL, NULL),
(8, '2022-09-18 12:36:00', '2022/09/0008', 1, '', NULL, 4, NULL, NULL, NULL),
(9, '2022-09-18 12:37:00', '2022/09/0009', 1, '', NULL, 4, NULL, NULL, NULL),
(10, '2022-09-18 12:37:00', '2022/09/0010', 1, '', NULL, 4, NULL, NULL, NULL),
(11, '2022-09-18 12:38:00', '2022/09/0011', 1, '', NULL, 4, NULL, NULL, NULL),
(12, '2022-09-18 12:38:00', '2022/09/0012', 1, '', NULL, 4, NULL, NULL, NULL),
(13, '2022-09-18 12:38:00', '2022/09/0013', 1, '', NULL, 4, NULL, NULL, NULL),
(14, '2022-09-18 12:39:00', '2022/09/0014', 1, '', NULL, 4, NULL, NULL, NULL),
(15, '2022-09-18 12:40:00', '2022/09/0015', 1, '', NULL, 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_adjustment_items`
--

CREATE TABLE `sma_adjustment_items` (
  `id` int(11) NOT NULL,
  `adjustment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `option_id` int(11) DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_adjustment_items`
--

INSERT INTO `sma_adjustment_items` (`id`, `adjustment_id`, `product_id`, `option_id`, `quantity`, `warehouse_id`, `serial_no`, `type`) VALUES
(30, 7, 13, NULL, '5000.0000', 1, '', 'addition'),
(29, 6, 15, NULL, '5000.0000', 1, '', 'addition'),
(28, 5, 12, NULL, '5000.0000', 1, '', 'addition'),
(27, 4, 11, NULL, '10000.0000', 1, '', 'addition'),
(26, 3, 10, NULL, '5000.0000', 1, '', 'addition'),
(25, 2, 9, NULL, '5000.0000', 1, '', 'addition'),
(24, 1, 8, NULL, '10000.0000', 1, '', 'addition'),
(31, 8, 14, NULL, '5000.0000', 1, '', 'addition'),
(32, 9, 16, NULL, '5000.0000', 1, '', 'addition'),
(33, 10, 17, NULL, '5000.0000', 1, '', 'addition'),
(34, 11, 18, NULL, '5000.0000', 1, '', 'addition'),
(35, 12, 19, NULL, '5000.0000', 1, '', 'addition'),
(36, 13, 20, NULL, '3500.0000', 1, '', 'addition'),
(37, 14, 21, NULL, '3000.0000', 1, '', 'addition'),
(38, 15, 22, NULL, '4500.0000', 1, '', 'addition');

-- --------------------------------------------------------

--
-- Table structure for table `sma_api_keys`
--

CREATE TABLE `sma_api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference` varchar(40) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_api_limits`
--

CREATE TABLE `sma_api_limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_api_logs`
--

CREATE TABLE `sma_api_logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text DEFAULT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_attachments`
--

CREATE TABLE `sma_attachments` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject_type` varchar(55) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `orig_name` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_brands`
--

CREATE TABLE `sma_brands` (
  `id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_brands`
--

INSERT INTO `sma_brands` (`id`, `code`, `name`, `image`, `slug`, `description`) VALUES
(1, '001', 'Aspen', NULL, 'aspen', 'Dosage:1*2'),
(2, '002', 'AstraZeneca', NULL, 'astrazeneca', 'Dosage:1*2'),
(3, '003', 'Ferring', NULL, 'ferring', 'Dosage:1*2'),
(4, '004', 'GlaxoSmithKline', NULL, 'glaxosmithkline', 'Dosage:1*1'),
(5, '005', 'Novartis', NULL, 'novartis', 'Dosage:1*3'),
(6, '006', 'Regal Pharmaceuticals Ltd', NULL, 'regal-pharmaceuticals-ltd', 'Dosage:1*3'),
(7, '007', 'Roche', NULL, 'roche', 'Dosage:1*2'),
(8, '008', 'United Pharma K  Ltd', NULL, 'united-pharma-k-ltd', 'Dosage:1*3');

-- --------------------------------------------------------

--
-- Table structure for table `sma_calendar`
--

CREATE TABLE `sma_calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `color` varchar(7) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_captcha`
--

CREATE TABLE `sma_captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `word` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_cart`
--

CREATE TABLE `sma_cart` (
  `id` varchar(40) NOT NULL,
  `time` varchar(30) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `data` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_cart`
--

INSERT INTO `sma_cart` (`id`, `time`, `user_id`, `data`) VALUES
('58e256390df9a1686bfe2659f2a20bd6', '1663524423', NULL, '{\"cart_total\":1290,\"total_item_tax\":0,\"total_items\":4,\"total_unique_items\":4,\"385449827f721e2d9c15343799b7403e\":{\"id\":\"84e2bcc4678c517d18582562cae53964\",\"product_id\":\"20\",\"qty\":1,\"name\":\" Benedryl (diphenhydramine)\",\"slug\":\"benedryl-diphenhydramine\",\"code\":\"99168487\",\"price\":500,\"tax\":\"0.00\",\"image\":\"no_image.png\",\"option\":false,\"options\":null,\"rowid\":\"385449827f721e2d9c15343799b7403e\",\"row_tax\":\"0.0000\",\"subtotal\":\"500.0000\"},\"c02b489e6e5dcd352017dfb5e739a619\":{\"id\":\"b205fb844537c8f419df1e2f8251002b\",\"product_id\":\"18\",\"qty\":1,\"name\":\"Paxil (paroxetine)\",\"slug\":\"59005628\",\"code\":\"59005628\",\"price\":430,\"tax\":\"0.00\",\"image\":\"no_image.png\",\"option\":false,\"options\":null,\"rowid\":\"c02b489e6e5dcd352017dfb5e739a619\",\"row_tax\":\"0.0000\",\"subtotal\":\"430.0000\"},\"c97dd19f590afa23cda814f863afbf30\":{\"id\":\"a9761858cd4c7b654b9192faeec2e4d5\",\"product_id\":\"19\",\"qty\":1,\"name\":\"Clozaril (clozapine)\",\"slug\":\"67388129\",\"code\":\"67388129\",\"price\":10,\"tax\":\"0.00\",\"image\":\"no_image.png\",\"option\":false,\"options\":null,\"rowid\":\"c97dd19f590afa23cda814f863afbf30\",\"row_tax\":\"0.0000\",\"subtotal\":\"10.0000\"},\"e70cccd5e58a4a88395f5c8ddfcd9ff6\":{\"id\":\"b076804025280d3e3e1bb4dc37fd2d01\",\"product_id\":\"8\",\"qty\":1,\"name\":\"Aluminium Hydroxide gel\",\"slug\":\"81965763\",\"code\":\"81965763\",\"price\":350,\"tax\":\"0.00\",\"image\":\"no_image.png\",\"option\":false,\"options\":null,\"rowid\":\"e70cccd5e58a4a88395f5c8ddfcd9ff6\",\"row_tax\":\"0.0000\",\"subtotal\":\"350.0000\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `sma_categories`
--

CREATE TABLE `sma_categories` (
  `id` int(11) NOT NULL,
  `code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `image` varchar(55) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_categories`
--

INSERT INTO `sma_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`) VALUES
(3, '002', 'Antianemics', NULL, 0, 'antianemics', 'Ae'),
(2, '001', 'Antiacids', NULL, 0, 'antiacids', 'A'),
(4, '003', 'Anticholinergics', NULL, 0, 'anticholinergics', 'Ag'),
(5, '004', 'Anticoagulants', NULL, 0, 'anticoagulants', 'Ac'),
(7, '005', 'Anticonvulsants', NULL, 0, 'anticonvulsants', 'Av'),
(9, '007', 'Antihistamines', NULL, 0, 'antihistamines', 'As'),
(8, '006', 'Antidiarrheals', NULL, 0, 'antidiarrheals', 'Ah'),
(10, '009', 'Antihypertensives', NULL, 0, 'antihypertensives', 'At'),
(11, '008', 'Ant-Infectives', NULL, 0, 'ant-infectives', 'Ai');

-- --------------------------------------------------------

--
-- Table structure for table `sma_combo_items`
--

CREATE TABLE `sma_combo_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `quantity` decimal(12,4) NOT NULL,
  `unit_price` decimal(25,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_companies`
--

CREATE TABLE `sma_companies` (
  `id` int(11) NOT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `group_name` varchar(20) NOT NULL,
  `customer_group_id` int(11) DEFAULT NULL,
  `customer_group_name` varchar(100) DEFAULT NULL,
  `name` varchar(55) NOT NULL,
  `company` varchar(255) NOT NULL,
  `vat_no` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(55) DEFAULT NULL,
  `state` varchar(55) DEFAULT NULL,
  `postal_code` varchar(8) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `cf1` varchar(100) DEFAULT NULL,
  `cf2` varchar(100) DEFAULT NULL,
  `cf3` varchar(100) DEFAULT NULL,
  `cf4` varchar(100) DEFAULT NULL,
  `cf5` varchar(100) DEFAULT NULL,
  `cf6` varchar(100) DEFAULT NULL,
  `invoice_footer` text DEFAULT NULL,
  `payment_term` int(11) DEFAULT 0,
  `logo` varchar(255) DEFAULT 'logo.png',
  `award_points` int(11) DEFAULT 0,
  `deposit_amount` decimal(25,4) DEFAULT NULL,
  `price_group_id` int(11) DEFAULT NULL,
  `price_group_name` varchar(50) DEFAULT NULL,
  `gst_no` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_companies`
--

INSERT INTO `sma_companies` (`id`, `group_id`, `group_name`, `customer_group_id`, `customer_group_name`, `name`, `company`, `vat_no`, `address`, `city`, `state`, `postal_code`, `country`, `phone`, `email`, `cf1`, `cf2`, `cf3`, `cf4`, `cf5`, `cf6`, `invoice_footer`, `payment_term`, `logo`, `award_points`, `deposit_amount`, `price_group_id`, `price_group_name`, `gst_no`) VALUES
(1, 3, 'customer', 1, 'General', 'Walk-in Customer', 'Walk-in Customer', '', 'Customer Address', 'Nairobi', 'Nairobi', '', '', '0123456789', 'customer@fancyliqourbox.com', '', '', '', '', '', '', NULL, 0, 'logo.png', 0, NULL, NULL, NULL, ''),
(2, 4, 'supplier', NULL, NULL, 'Test Supplier', 'mel sip', '', 'Supplier Address', 'test', '', '46050', 'Malaysia', '0123456789', 'supplier@meldeonpos.co.ke', '-', '-', '-', '-', '-', '-', NULL, 0, 'logo.png', 0, NULL, NULL, NULL, ''),
(3, NULL, 'biller', NULL, NULL, 'FANCY LIQOUR BOX', 'FANCY LIQOUR BOX', '', '657 Villagemarket', 'Nairobi', 'Nairobi', '657 - Vi', 'Kenya', '0112357698', 'quotaions@fancyliqourbox.com', '', '', '', '', '', '', ' Thank you for trusting FANCY LIQOUR BOX . Please come again', 0, 'LiqourboxB.png', 0, NULL, NULL, NULL, ''),
(11, 4, 'supplier', NULL, NULL, 'DERRICK', 'MAGNOCLOUD LIMITED', '', '657 Villagemarket', 'Nairobi', 'Kenya', '657 - vi', 'Kenya', '0112357698', 'ngingaderrick@gmail.com', '', '', '', '', '', '', NULL, 0, 'logo.png', 0, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `sma_costing`
--

CREATE TABLE `sma_costing` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sale_item_id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `purchase_item_id` int(11) DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `purchase_net_unit_cost` decimal(25,4) DEFAULT NULL,
  `purchase_unit_cost` decimal(25,4) DEFAULT NULL,
  `sale_net_unit_price` decimal(25,4) NOT NULL,
  `sale_unit_price` decimal(25,4) NOT NULL,
  `quantity_balance` decimal(15,4) DEFAULT NULL,
  `inventory` tinyint(1) DEFAULT 0,
  `overselling` tinyint(1) DEFAULT 0,
  `option_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `transfer_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_currencies`
--

CREATE TABLE `sma_currencies` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(55) NOT NULL,
  `rate` decimal(12,4) NOT NULL,
  `auto_update` tinyint(1) NOT NULL DEFAULT 0,
  `symbol` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_currencies`
--

INSERT INTO `sma_currencies` (`id`, `code`, `name`, `rate`, `auto_update`, `symbol`) VALUES
(1, 'USD', 'US Dollar', '1.0000', 0, NULL),
(2, 'KES', 'Kenyan Shillings', '100.0000', 1, 'Ksh');

-- --------------------------------------------------------

--
-- Table structure for table `sma_customer_groups`
--

CREATE TABLE `sma_customer_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `percent` int(11) NOT NULL,
  `discount` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_customer_groups`
--

INSERT INTO `sma_customer_groups` (`id`, `name`, `percent`, `discount`) VALUES
(1, 'General', 0, NULL),
(2, 'Reseller', -5, NULL),
(3, 'Distributor', -15, NULL),
(4, 'New Customer (+10)', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_date_format`
--

CREATE TABLE `sma_date_format` (
  `id` int(11) NOT NULL,
  `js` varchar(20) NOT NULL,
  `php` varchar(20) NOT NULL,
  `sql` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_date_format`
--

INSERT INTO `sma_date_format` (`id`, `js`, `php`, `sql`) VALUES
(1, 'mm-dd-yyyy', 'm-d-Y', '%m-%d-%Y'),
(2, 'mm/dd/yyyy', 'm/d/Y', '%m/%d/%Y'),
(3, 'mm.dd.yyyy', 'm.d.Y', '%m.%d.%Y'),
(4, 'dd-mm-yyyy', 'd-m-Y', '%d-%m-%Y'),
(5, 'dd/mm/yyyy', 'd/m/Y', '%d/%m/%Y'),
(6, 'dd.mm.yyyy', 'd.m.Y', '%d.%m.%Y');

-- --------------------------------------------------------

--
-- Table structure for table `sma_deliveries`
--

CREATE TABLE `sma_deliveries` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `sale_id` int(11) NOT NULL,
  `do_reference_no` varchar(50) NOT NULL,
  `sale_reference_no` varchar(50) NOT NULL,
  `customer` varchar(55) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `attachment` varchar(50) DEFAULT NULL,
  `delivered_by` varchar(50) DEFAULT NULL,
  `received_by` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_deposits`
--

CREATE TABLE `sma_deposits` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `company_id` int(11) NOT NULL,
  `amount` decimal(25,4) NOT NULL,
  `paid_by` varchar(50) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_expenses`
--

CREATE TABLE `sma_expenses` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference` varchar(50) NOT NULL,
  `amount` decimal(25,4) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_expense_categories`
--

CREATE TABLE `sma_expense_categories` (
  `id` int(11) NOT NULL,
  `code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_gift_cards`
--

CREATE TABLE `sma_gift_cards` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `card_no` varchar(20) NOT NULL,
  `value` decimal(25,4) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `balance` decimal(25,4) NOT NULL,
  `expiry` date DEFAULT NULL,
  `created_by` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_gift_card_topups`
--

CREATE TABLE `sma_gift_card_topups` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `card_id` int(11) NOT NULL,
  `amount` decimal(15,4) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_groups`
--

CREATE TABLE `sma_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_groups`
--

INSERT INTO `sma_groups` (`id`, `name`, `description`) VALUES
(1, 'owner', 'Owner'),
(2, 'admin', 'Administrator'),
(3, 'customer', 'Customer'),
(4, 'supplier', 'Supplier'),
(5, 'sales', 'Sales Staff');

-- --------------------------------------------------------

--
-- Table structure for table `sma_login_attempts`
--

CREATE TABLE `sma_login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_logs`
--

CREATE TABLE `sma_logs` (
  `id` int(11) NOT NULL,
  `detail` varchar(190) NOT NULL,
  `model` longtext DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_logs`
--

INSERT INTO `sma_logs` (`id`, `detail`, `model`, `date`) VALUES
(1, 'Product is being deleted by neuce (User Id: 3)', '{\"model\":{\"id\":\"1\",\"code\":\"24259676\",\"name\":\"Bread Loaf\",\"unit\":\"1\",\"cost\":\"40.0000\",\"price\":\"55.0000\",\"alert_quantity\":\"1.0000\",\"image\":\"no_image.png\",\"category_id\":\"1\",\"subcategory_id\":null,\"cf1\":\"\",\"cf2\":\"\",\"cf3\":\"\",\"cf4\":\"\",\"cf5\":\"\",\"cf6\":\"\",\"quantity\":\"1.0000\",\"tax_rate\":\"1\",\"track_quantity\":\"1\",\"details\":\"\",\"warehouse\":null,\"barcode_symbology\":\"code128\",\"file\":\"\",\"product_details\":\"\",\"tax_method\":\"1\",\"type\":\"standard\",\"supplier1\":\"2\",\"supplier1price\":\"40.0000\",\"supplier2\":null,\"supplier2price\":null,\"supplier3\":null,\"supplier3price\":null,\"supplier4\":null,\"supplier4price\":null,\"supplier5\":null,\"supplier5price\":null,\"promotion\":null,\"promo_price\":null,\"start_date\":null,\"end_date\":null,\"supplier1_part_no\":\"7\",\"supplier2_part_no\":null,\"supplier3_part_no\":null,\"supplier4_part_no\":null,\"supplier5_part_no\":null,\"sale_unit\":\"1\",\"purchase_unit\":\"1\",\"brand\":\"0\",\"slug\":\"24259676\",\"featured\":\"1\",\"weight\":\"0.5000\",\"hsn_code\":null,\"views\":\"0\",\"hide\":\"0\",\"second_name\":\"\",\"hide_pos\":\"0\"}}', '2022-09-15 12:54:02'),
(2, 'Sale is being deleted by neuce (User Id: 3)', '{\"model\":{\"id\":\"4\",\"date\":\"2022-07-18 07:17:21\",\"reference_no\":\"SALE\\/POS2022\\/07\\/0003\",\"customer_id\":\"1\",\"customer\":\"Walk-in Customer\",\"biller_id\":\"3\",\"biller\":\"Test Biller\",\"warehouse_id\":\"1\",\"note\":\"\",\"staff_note\":\"\",\"total\":\"55.0000\",\"product_discount\":\"0.0000\",\"order_discount_id\":\"\",\"total_discount\":\"0.0000\",\"order_discount\":\"0.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"0.0000\",\"grand_total\":\"55.0000\",\"sale_status\":\"completed\",\"payment_status\":\"paid\",\"payment_term\":\"0\",\"due_date\":null,\"created_by\":\"1\",\"updated_by\":null,\"updated_at\":null,\"total_items\":\"1\",\"pos\":\"1\",\"paid\":\"55.0000\",\"return_id\":null,\"surcharge\":\"0.0000\",\"attachment\":null,\"return_sale_ref\":null,\"sale_id\":null,\"return_sale_total\":\"0.0000\",\"rounding\":\"0.0000\",\"suspend_note\":null,\"api\":\"0\",\"shop\":\"0\",\"address_id\":null,\"reserve_id\":null,\"hash\":\"8ad1a6086a0562912be32c964378dfa666931663f404ff0a50b8dbbef0b76ed3\",\"manual_payment\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"payment_method\":null},\"items\":[{\"id\":\"9\",\"sale_id\":\"4\",\"product_id\":\"1\",\"product_code\":\"24259676\",\"product_name\":\"Bread Loaf\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"55.0000\",\"unit_price\":\"55.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"55.0000\",\"serial_no\":\"\",\"real_unit_price\":\"55.0000\",\"sale_item_id\":null,\"product_unit_id\":\"1\",\"product_unit_code\":\"grams\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null}]}', '2022-09-15 14:27:57'),
(3, 'Sale is being deleted by neuce (User Id: 3)', '{\"model\":{\"id\":\"2\",\"date\":\"2022-07-15 13:19:52\",\"reference_no\":\"SALE\\/POS2022\\/07\\/0002\",\"customer_id\":\"1\",\"customer\":\"Walk-in Customer\",\"biller_id\":\"3\",\"biller\":\"Test Biller\",\"warehouse_id\":\"1\",\"note\":\"\",\"staff_note\":\"\",\"total\":\"275.0000\",\"product_discount\":\"0.0000\",\"order_discount_id\":\"\",\"total_discount\":\"0.0000\",\"order_discount\":\"0.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"0.0000\",\"grand_total\":\"275.0000\",\"sale_status\":\"completed\",\"payment_status\":\"paid\",\"payment_term\":\"0\",\"due_date\":null,\"created_by\":\"1\",\"updated_by\":null,\"updated_at\":null,\"total_items\":\"5\",\"pos\":\"1\",\"paid\":\"275.0000\",\"return_id\":null,\"surcharge\":\"0.0000\",\"attachment\":null,\"return_sale_ref\":null,\"sale_id\":null,\"return_sale_total\":\"0.0000\",\"rounding\":\"0.0000\",\"suspend_note\":null,\"api\":\"0\",\"shop\":\"0\",\"address_id\":null,\"reserve_id\":null,\"hash\":\"e5607d78a5e408cf6fe21243ebbcd554149c429d1ca3d88c933240b2ef3f68fe\",\"manual_payment\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"payment_method\":null},\"items\":[{\"id\":\"2\",\"sale_id\":\"2\",\"product_id\":\"1\",\"product_code\":\"24259676\",\"product_name\":\"Bread Loaf\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"55.0000\",\"unit_price\":\"55.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"55.0000\",\"serial_no\":\"\",\"real_unit_price\":\"55.0000\",\"sale_item_id\":null,\"product_unit_id\":\"1\",\"product_unit_code\":\"grams\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null},{\"id\":\"3\",\"sale_id\":\"2\",\"product_id\":\"1\",\"product_code\":\"24259676\",\"product_name\":\"Bread Loaf\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"55.0000\",\"unit_price\":\"55.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"55.0000\",\"serial_no\":\"\",\"real_unit_price\":\"55.0000\",\"sale_item_id\":null,\"product_unit_id\":\"1\",\"product_unit_code\":\"grams\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null},{\"id\":\"4\",\"sale_id\":\"2\",\"product_id\":\"1\",\"product_code\":\"24259676\",\"product_name\":\"Bread Loaf\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"55.0000\",\"unit_price\":\"55.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"55.0000\",\"serial_no\":\"\",\"real_unit_price\":\"55.0000\",\"sale_item_id\":null,\"product_unit_id\":\"1\",\"product_unit_code\":\"grams\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null},{\"id\":\"5\",\"sale_id\":\"2\",\"product_id\":\"1\",\"product_code\":\"24259676\",\"product_name\":\"Bread Loaf\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"55.0000\",\"unit_price\":\"55.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"55.0000\",\"serial_no\":\"\",\"real_unit_price\":\"55.0000\",\"sale_item_id\":null,\"product_unit_id\":\"1\",\"product_unit_code\":\"grams\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null},{\"id\":\"6\",\"sale_id\":\"2\",\"product_id\":\"1\",\"product_code\":\"24259676\",\"product_name\":\"Bread Loaf\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"55.0000\",\"unit_price\":\"55.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"55.0000\",\"serial_no\":\"\",\"real_unit_price\":\"55.0000\",\"sale_item_id\":null,\"product_unit_id\":\"1\",\"product_unit_code\":\"grams\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null}]}', '2022-09-15 14:28:04'),
(4, 'Sale is being deleted by neuce (User Id: 3)', '{\"model\":{\"id\":\"1\",\"date\":\"2022-07-15 13:18:23\",\"reference_no\":\"SALE\\/POS2022\\/07\\/0001\",\"customer_id\":\"1\",\"customer\":\"Walk-in Customer\",\"biller_id\":\"3\",\"biller\":\"Test Biller\",\"warehouse_id\":\"1\",\"note\":\"\",\"staff_note\":\"\",\"total\":\"55.0000\",\"product_discount\":\"0.0000\",\"order_discount_id\":\"\",\"total_discount\":\"0.0000\",\"order_discount\":\"0.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"0.0000\",\"grand_total\":\"55.0000\",\"sale_status\":\"completed\",\"payment_status\":\"paid\",\"payment_term\":\"0\",\"due_date\":null,\"created_by\":\"1\",\"updated_by\":null,\"updated_at\":null,\"total_items\":\"1\",\"pos\":\"1\",\"paid\":\"55.0000\",\"return_id\":null,\"surcharge\":\"0.0000\",\"attachment\":null,\"return_sale_ref\":null,\"sale_id\":null,\"return_sale_total\":\"0.0000\",\"rounding\":\"0.0000\",\"suspend_note\":null,\"api\":\"0\",\"shop\":\"0\",\"address_id\":null,\"reserve_id\":null,\"hash\":\"f3d25f892518cc9aa04736f26664f21412e01541d05f5b89d7b466a8c21539df\",\"manual_payment\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"payment_method\":null},\"items\":[{\"id\":\"1\",\"sale_id\":\"1\",\"product_id\":\"1\",\"product_code\":\"24259676\",\"product_name\":\"Bread Loaf\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"55.0000\",\"unit_price\":\"55.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"55.0000\",\"serial_no\":\"\",\"real_unit_price\":\"55.0000\",\"sale_item_id\":null,\"product_unit_id\":\"1\",\"product_unit_code\":\"grams\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null}]}', '2022-09-15 14:28:10'),
(5, 'Sale is being deleted by neuce (User Id: 3)', '{\"model\":{\"id\":\"3\",\"date\":\"2022-07-15 13:31:23\",\"reference_no\":\"SALE2022\\/07\\/0001\",\"customer_id\":\"4\",\"customer\":\"deno\",\"biller_id\":\"3\",\"biller\":\"Test Biller\",\"warehouse_id\":\"1\",\"note\":\"\",\"staff_note\":null,\"total\":\"110.0000\",\"product_discount\":\"0.0000\",\"order_discount_id\":null,\"total_discount\":\"0.0000\",\"order_discount\":\"0.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"0.0000\",\"grand_total\":\"110.0000\",\"sale_status\":\"completed\",\"payment_status\":\"paid\",\"payment_term\":null,\"due_date\":null,\"created_by\":null,\"updated_by\":null,\"updated_at\":null,\"total_items\":\"2\",\"pos\":\"0\",\"paid\":\"110.0000\",\"return_id\":null,\"surcharge\":\"0.0000\",\"attachment\":null,\"return_sale_ref\":null,\"sale_id\":null,\"return_sale_total\":\"0.0000\",\"rounding\":null,\"suspend_note\":null,\"api\":\"0\",\"shop\":\"1\",\"address_id\":\"1\",\"reserve_id\":null,\"hash\":\"d8d7249267279c83f1c73a3dc5bbf243ce01e33a30cc6229a64ffeff07554197\",\"manual_payment\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"payment_method\":\"cod\"},\"items\":[{\"id\":\"7\",\"sale_id\":\"3\",\"product_id\":\"1\",\"product_code\":\"24259676\",\"product_name\":\"Bread Loaf\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"55.0000\",\"unit_price\":\"55.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":null,\"item_discount\":\"0.0000\",\"subtotal\":\"55.0000\",\"serial_no\":null,\"real_unit_price\":\"55.0000\",\"sale_item_id\":null,\"product_unit_id\":\"1\",\"product_unit_code\":\"grams\",\"unit_quantity\":\"1.0000\",\"comment\":null,\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null},{\"id\":\"8\",\"sale_id\":\"3\",\"product_id\":\"1\",\"product_code\":\"24259676\",\"product_name\":\"Bread Loaf\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"55.0000\",\"unit_price\":\"55.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":null,\"item_discount\":\"0.0000\",\"subtotal\":\"55.0000\",\"serial_no\":null,\"real_unit_price\":\"55.0000\",\"sale_item_id\":null,\"product_unit_id\":\"1\",\"product_unit_code\":\"grams\",\"unit_quantity\":\"1.0000\",\"comment\":null,\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null}]}', '2022-09-15 14:28:45'),
(6, 'Product is being deleted by neuce (User Id: 3)', '{\"model\":{\"id\":\"2\",\"code\":\"001\",\"name\":\"Decorative paint\",\"unit\":\"2\",\"cost\":\"1100.0000\",\"price\":\"1350.0000\",\"alert_quantity\":\"3.0000\",\"image\":\"db95e00fc1715d3bf9661322442b07a1.png\",\"category_id\":\"1\",\"subcategory_id\":null,\"cf1\":\"\",\"cf2\":\"\",\"cf3\":\"\",\"cf4\":\"\",\"cf5\":\"\",\"cf6\":\"\",\"quantity\":\"7.0000\",\"tax_rate\":\"1\",\"track_quantity\":\"1\",\"details\":\"\",\"warehouse\":null,\"barcode_symbology\":\"code128\",\"file\":\"\",\"product_details\":\"\",\"tax_method\":\"1\",\"type\":\"standard\",\"supplier1\":\"2\",\"supplier1price\":\"1000.0000\",\"supplier2\":null,\"supplier2price\":null,\"supplier3\":null,\"supplier3price\":null,\"supplier4\":null,\"supplier4price\":null,\"supplier5\":null,\"supplier5price\":null,\"promotion\":null,\"promo_price\":null,\"start_date\":null,\"end_date\":null,\"supplier1_part_no\":\"1\",\"supplier2_part_no\":null,\"supplier3_part_no\":null,\"supplier4_part_no\":null,\"supplier5_part_no\":null,\"sale_unit\":\"2\",\"purchase_unit\":\"2\",\"brand\":\"0\",\"slug\":\"decorative-paint\",\"featured\":\"1\",\"weight\":\"10.0000\",\"hsn_code\":null,\"views\":\"0\",\"hide\":\"0\",\"second_name\":\"deco paint\",\"hide_pos\":\"0\"}}', '2022-09-17 15:58:00'),
(7, 'Product is being deleted by neuce (User Id: 3)', '{\"model\":{\"id\":\"3\",\"code\":\"002\",\"name\":\"Varnishes\",\"unit\":\"2\",\"cost\":\"1000.0000\",\"price\":\"1400.0000\",\"alert_quantity\":\"3.0000\",\"image\":\"ed53eeff90e8d28e3e9f93af5e84810e.png\",\"category_id\":\"1\",\"subcategory_id\":null,\"cf1\":\"\",\"cf2\":\"\",\"cf3\":\"\",\"cf4\":\"\",\"cf5\":\"\",\"cf6\":\"\",\"quantity\":\"29.0000\",\"tax_rate\":\"1\",\"track_quantity\":\"1\",\"details\":\"\",\"warehouse\":null,\"barcode_symbology\":\"code128\",\"file\":\"\",\"product_details\":\"\",\"tax_method\":\"1\",\"type\":\"standard\",\"supplier1\":\"2\",\"supplier1price\":null,\"supplier2\":null,\"supplier2price\":null,\"supplier3\":null,\"supplier3price\":null,\"supplier4\":null,\"supplier4price\":null,\"supplier5\":null,\"supplier5price\":null,\"promotion\":\"1\",\"promo_price\":\"1320.0000\",\"start_date\":\"2022-09-14\",\"end_date\":\"2022-09-22\",\"supplier1_part_no\":\"\",\"supplier2_part_no\":null,\"supplier3_part_no\":null,\"supplier4_part_no\":null,\"supplier5_part_no\":null,\"sale_unit\":\"2\",\"purchase_unit\":\"2\",\"brand\":\"0\",\"slug\":\"varnishes\",\"featured\":\"1\",\"weight\":\"20.0000\",\"hsn_code\":null,\"views\":\"0\",\"hide\":\"0\",\"second_name\":\"varn\",\"hide_pos\":\"0\"}}', '2022-09-17 15:58:00'),
(8, 'Product is being deleted by neuce (User Id: 3)', '{\"model\":{\"id\":\"4\",\"code\":\"003\",\"name\":\"Water Proofing solutions\",\"unit\":\"2\",\"cost\":\"950.0000\",\"price\":\"1250.0000\",\"alert_quantity\":\"3.0000\",\"image\":\"2806f14714bd81a8898d418985045fbd.png\",\"category_id\":\"1\",\"subcategory_id\":null,\"cf1\":\"\",\"cf2\":\"\",\"cf3\":\"\",\"cf4\":\"\",\"cf5\":\"\",\"cf6\":\"\",\"quantity\":\"25.0000\",\"tax_rate\":\"1\",\"track_quantity\":\"1\",\"details\":\"\",\"warehouse\":null,\"barcode_symbology\":\"code128\",\"file\":\"\",\"product_details\":\"\",\"tax_method\":\"1\",\"type\":\"standard\",\"supplier1\":\"0\",\"supplier1price\":null,\"supplier2\":null,\"supplier2price\":null,\"supplier3\":null,\"supplier3price\":null,\"supplier4\":null,\"supplier4price\":null,\"supplier5\":null,\"supplier5price\":null,\"promotion\":null,\"promo_price\":null,\"start_date\":null,\"end_date\":null,\"supplier1_part_no\":\"\",\"supplier2_part_no\":null,\"supplier3_part_no\":null,\"supplier4_part_no\":null,\"supplier5_part_no\":null,\"sale_unit\":\"2\",\"purchase_unit\":\"2\",\"brand\":\"0\",\"slug\":\"water-proofing-solutions\",\"featured\":\"1\",\"weight\":\"22.0000\",\"hsn_code\":null,\"views\":\"0\",\"hide\":\"0\",\"second_name\":\"wps\",\"hide_pos\":\"0\"}}', '2022-09-17 15:58:00'),
(9, 'Product is being deleted by neuce (User Id: 3)', '{\"model\":{\"id\":\"5\",\"code\":\"004\",\"name\":\"Textured coatings\",\"unit\":\"2\",\"cost\":\"550.0000\",\"price\":\"1460.0000\",\"alert_quantity\":\"3.0000\",\"image\":\"15e2739b4773eedd8b2481e8398eb97b.png\",\"category_id\":\"1\",\"subcategory_id\":null,\"cf1\":\"\",\"cf2\":\"\",\"cf3\":\"\",\"cf4\":\"\",\"cf5\":\"\",\"cf6\":\"\",\"quantity\":\"24.0000\",\"tax_rate\":\"1\",\"track_quantity\":\"1\",\"details\":\"\",\"warehouse\":null,\"barcode_symbology\":\"code128\",\"file\":\"\",\"product_details\":\"\",\"tax_method\":\"1\",\"type\":\"standard\",\"supplier1\":\"2\",\"supplier1price\":null,\"supplier2\":null,\"supplier2price\":null,\"supplier3\":null,\"supplier3price\":null,\"supplier4\":null,\"supplier4price\":null,\"supplier5\":null,\"supplier5price\":null,\"promotion\":\"1\",\"promo_price\":\"1300.0000\",\"start_date\":\"2022-09-14\",\"end_date\":\"2022-09-22\",\"supplier1_part_no\":\"\",\"supplier2_part_no\":null,\"supplier3_part_no\":null,\"supplier4_part_no\":null,\"supplier5_part_no\":null,\"sale_unit\":\"2\",\"purchase_unit\":\"2\",\"brand\":\"0\",\"slug\":\"textured-coatings\",\"featured\":\"1\",\"weight\":\"30.0000\",\"hsn_code\":null,\"views\":\"0\",\"hide\":\"0\",\"second_name\":\"Tc\",\"hide_pos\":\"0\"}}', '2022-09-17 15:58:00'),
(10, 'Product is being deleted by neuce (User Id: 3)', '{\"model\":{\"id\":\"6\",\"code\":\"005\",\"name\":\"Industrial Flooring\",\"unit\":\"2\",\"cost\":\"1100.0000\",\"price\":\"1400.0000\",\"alert_quantity\":\"3.0000\",\"image\":\"aaf388be589d8478fc6b41b3967fca75.png\",\"category_id\":\"1\",\"subcategory_id\":null,\"cf1\":\"\",\"cf2\":\"\",\"cf3\":\"\",\"cf4\":\"\",\"cf5\":\"\",\"cf6\":\"\",\"quantity\":\"15.0000\",\"tax_rate\":\"1\",\"track_quantity\":\"1\",\"details\":\"\",\"warehouse\":null,\"barcode_symbology\":\"code128\",\"file\":\"\",\"product_details\":\"\",\"tax_method\":\"1\",\"type\":\"standard\",\"supplier1\":\"2\",\"supplier1price\":\"1000.0000\",\"supplier2\":null,\"supplier2price\":null,\"supplier3\":null,\"supplier3price\":null,\"supplier4\":null,\"supplier4price\":null,\"supplier5\":null,\"supplier5price\":null,\"promotion\":null,\"promo_price\":null,\"start_date\":null,\"end_date\":null,\"supplier1_part_no\":\"3\",\"supplier2_part_no\":null,\"supplier3_part_no\":null,\"supplier4_part_no\":null,\"supplier5_part_no\":null,\"sale_unit\":\"2\",\"purchase_unit\":\"2\",\"brand\":\"0\",\"slug\":\"industrial-flooring\",\"featured\":\"1\",\"weight\":\"25.0000\",\"hsn_code\":null,\"views\":\"0\",\"hide\":\"0\",\"second_name\":\"IF\",\"hide_pos\":\"0\"}}', '2022-09-17 15:58:00'),
(11, 'Product is being deleted by neuce (User Id: 3)', '{\"model\":{\"id\":\"7\",\"code\":\"006\",\"name\":\"Road Marking\",\"unit\":\"2\",\"cost\":\"550.0000\",\"price\":\"1000.0000\",\"alert_quantity\":\"3.0000\",\"image\":\"a830254b363261f98c1d3583a1b00e83.png\",\"category_id\":\"1\",\"subcategory_id\":null,\"cf1\":\"\",\"cf2\":\"\",\"cf3\":\"\",\"cf4\":\"\",\"cf5\":\"\",\"cf6\":\"\",\"quantity\":\"39.0000\",\"tax_rate\":\"1\",\"track_quantity\":\"1\",\"details\":\"\",\"warehouse\":null,\"barcode_symbology\":\"code128\",\"file\":\"\",\"product_details\":\"\",\"tax_method\":\"1\",\"type\":\"standard\",\"supplier1\":\"2\",\"supplier1price\":\"350.0000\",\"supplier2\":null,\"supplier2price\":null,\"supplier3\":null,\"supplier3price\":null,\"supplier4\":null,\"supplier4price\":null,\"supplier5\":null,\"supplier5price\":null,\"promotion\":null,\"promo_price\":null,\"start_date\":null,\"end_date\":null,\"supplier1_part_no\":\"4\",\"supplier2_part_no\":null,\"supplier3_part_no\":null,\"supplier4_part_no\":null,\"supplier5_part_no\":null,\"sale_unit\":\"2\",\"purchase_unit\":\"2\",\"brand\":\"0\",\"slug\":\"road-marking\",\"featured\":\"1\",\"weight\":\"34.0000\",\"hsn_code\":null,\"views\":\"0\",\"hide\":\"0\",\"second_name\":\"rm\",\"hide_pos\":\"0\"}}', '2022-09-17 15:58:00'),
(12, 'Sale is being deleted by dobet (User Id: 4)', '{\"model\":{\"id\":\"5\",\"date\":\"2022-09-15 17:20:06\",\"reference_no\":\"SALE\\/POS2022\\/09\\/0004\",\"customer_id\":\"1\",\"customer\":\"Walk-in Customer\",\"biller_id\":\"3\",\"biller\":\"Test Biller\",\"warehouse_id\":\"1\",\"note\":\"\",\"staff_note\":\"\",\"total\":\"6370.0000\",\"product_discount\":\"0.0000\",\"order_discount_id\":\"\",\"total_discount\":\"0.0000\",\"order_discount\":\"0.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"0.0000\",\"grand_total\":\"6370.0000\",\"sale_status\":\"completed\",\"payment_status\":\"paid\",\"payment_term\":\"0\",\"due_date\":null,\"created_by\":\"3\",\"updated_by\":null,\"updated_at\":null,\"total_items\":\"5\",\"pos\":\"1\",\"paid\":\"6370.0000\",\"return_id\":null,\"surcharge\":\"0.0000\",\"attachment\":null,\"return_sale_ref\":null,\"sale_id\":null,\"return_sale_total\":\"0.0000\",\"rounding\":\"0.0000\",\"suspend_note\":null,\"api\":\"0\",\"shop\":\"0\",\"address_id\":null,\"reserve_id\":null,\"hash\":\"43051988a43e578a5b8867747bd4f282cb6c6e1b2b61133087a6e84db6ad4f28\",\"manual_payment\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"payment_method\":null},\"items\":[{\"id\":\"10\",\"sale_id\":\"5\",\"product_id\":\"2\",\"product_code\":\"001\",\"product_name\":\"Decorative paint\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"1350.0000\",\"unit_price\":\"1350.0000\",\"quantity\":\"3.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"4050.0000\",\"serial_no\":\"\",\"real_unit_price\":\"1350.0000\",\"sale_item_id\":null,\"product_unit_id\":\"2\",\"product_unit_code\":\"kg\",\"unit_quantity\":\"3.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null},{\"id\":\"11\",\"sale_id\":\"5\",\"product_id\":\"3\",\"product_code\":\"002\",\"product_name\":\"Varnishes\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"1320.0000\",\"unit_price\":\"1320.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"1320.0000\",\"serial_no\":\"\",\"real_unit_price\":\"1320.0000\",\"sale_item_id\":null,\"product_unit_id\":\"2\",\"product_unit_code\":\"kg\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null},{\"id\":\"12\",\"sale_id\":\"5\",\"product_id\":\"7\",\"product_code\":\"006\",\"product_name\":\"Road Marking\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"1000.0000\",\"unit_price\":\"1000.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"1000.0000\",\"serial_no\":\"\",\"real_unit_price\":\"1000.0000\",\"sale_item_id\":null,\"product_unit_id\":\"2\",\"product_unit_code\":\"kg\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null,\"base_unit_id\":null,\"base_unit_code\":null}]}', '2022-09-18 05:18:55'),
(13, 'Customer is being deleted by dobet (User Id: 4)', '{\"model\":{\"id\":\"4\",\"group_id\":\"3\",\"group_name\":\"customer\",\"customer_group_id\":\"1\",\"customer_group_name\":\"General\",\"name\":\"deno\",\"company\":\"\",\"vat_no\":null,\"address\":\"Po BOX 1234<br>Po BOX 1234\",\"city\":\"Eldoret\",\"state\":\"Rift Valley\",\"postal_code\":\"01001\",\"country\":\"Kenya\",\"phone\":\"0724020846\",\"email\":\"dennisyunky@gmail.com\",\"cf1\":null,\"cf2\":null,\"cf3\":null,\"cf4\":null,\"cf5\":null,\"cf6\":null,\"invoice_footer\":null,\"payment_term\":\"0\",\"logo\":\"logo.png\",\"award_points\":\"0\",\"deposit_amount\":null,\"price_group_id\":\"1\",\"price_group_name\":\"Default\",\"gst_no\":null}}', '2022-09-18 05:40:17'),
(14, 'Customer is being deleted by dobet (User Id: 4)', '{\"model\":false}', '2022-09-18 05:40:23'),
(15, 'Customer is being deleted by dobet (User Id: 4)', '{\"model\":false}', '2022-09-18 05:40:27'),
(16, 'Sale is being deleted by dobet (User Id: 4)', '{\"model\":{\"id\":\"6\",\"date\":\"2022-09-15 17:39:39\",\"reference_no\":\"SALE2022\\/09\\/0002\",\"customer_id\":\"6\",\"customer\":\"Briggs Roy Plc\",\"biller_id\":\"3\",\"biller\":\"Test Biller\",\"warehouse_id\":\"1\",\"note\":\"\",\"staff_note\":null,\"total\":\"5340.0000\",\"product_discount\":\"0.0000\",\"order_discount_id\":null,\"total_discount\":\"0.0000\",\"order_discount\":\"0.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"0.0000\",\"grand_total\":\"5340.0000\",\"sale_status\":\"pending\",\"payment_status\":\"pending\",\"payment_term\":null,\"due_date\":null,\"created_by\":null,\"updated_by\":null,\"updated_at\":null,\"total_items\":\"4\",\"pos\":\"0\",\"paid\":\"0.0000\",\"return_id\":null,\"surcharge\":\"0.0000\",\"attachment\":null,\"return_sale_ref\":null,\"sale_id\":null,\"return_sale_total\":\"0.0000\",\"rounding\":null,\"suspend_note\":null,\"api\":\"0\",\"shop\":\"1\",\"address_id\":\"2\",\"reserve_id\":null,\"hash\":\"6451a74060f79a863fd7ed74af5c714017af1439c0ee8251f8b73df9cd9978f1\",\"manual_payment\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"payment_method\":\"cod\"},\"items\":null}', '2022-09-18 05:40:56'),
(17, 'Customer is being deleted by dobet (User Id: 4)', '{\"model\":{\"id\":\"6\",\"group_id\":\"3\",\"group_name\":\"customer\",\"customer_group_id\":\"1\",\"customer_group_name\":\"General\",\"name\":\"Uma Medina\",\"company\":\"Briggs Roy Plc\",\"vat_no\":null,\"address\":\"Aut magnam assumenda<br>Voluptatem totam fug\",\"city\":\"Quod et id debitis\",\"state\":\"Facere et in qui del\",\"postal_code\":\"Exercita\",\"country\":\"Dolore fugit qui vo\",\"phone\":\"+1 (319) 826-7273\",\"email\":\"pozu@mailinator.com\",\"cf1\":null,\"cf2\":null,\"cf3\":null,\"cf4\":null,\"cf5\":null,\"cf6\":null,\"invoice_footer\":null,\"payment_term\":\"0\",\"logo\":\"logo.png\",\"award_points\":\"53\",\"deposit_amount\":null,\"price_group_id\":\"1\",\"price_group_name\":\"Default\",\"gst_no\":null}}', '2022-09-18 05:41:13'),
(18, 'Customer is being deleted by dobet (User Id: 4)', '{\"model\":false}', '2022-09-18 05:41:19'),
(19, 'Customer is being deleted by dobet (User Id: 4)', '{\"model\":false}', '2022-09-18 05:41:26'),
(20, 'Customer is being deleted by dobet (User Id: 4)', '{\"model\":{\"id\":\"5\",\"group_id\":\"3\",\"group_name\":\"customer\",\"customer_group_id\":\"1\",\"customer_group_name\":\"General\",\"name\":\"Neuce Admin\",\"company\":\"NEUCE PAINT\",\"vat_no\":null,\"address\":null,\"city\":null,\"state\":null,\"postal_code\":null,\"country\":null,\"phone\":\"0798994420\",\"email\":\"neucepaint@gmail.com\",\"cf1\":null,\"cf2\":null,\"cf3\":null,\"cf4\":null,\"cf5\":null,\"cf6\":null,\"invoice_footer\":null,\"payment_term\":\"0\",\"logo\":\"logo.png\",\"award_points\":\"0\",\"deposit_amount\":null,\"price_group_id\":\"1\",\"price_group_name\":\"Default\",\"gst_no\":null}}', '2022-09-18 05:41:42'),
(21, 'Customer is being deleted by dobet (User Id: 4)', '{\"model\":false}', '2022-09-18 05:42:16'),
(22, 'Customer is being deleted by dobet (User Id: 4)', '{\"model\":false}', '2022-09-18 05:42:22'),
(23, 'Quotation is being deleted by admin (User Id: 1)', '{\"model\":{\"id\":\"1\",\"date\":\"2022-09-15 15:28:00\",\"reference_no\":\"002\",\"customer_id\":\"1\",\"customer\":\"Walk-in Customer\",\"warehouse_id\":\"1\",\"biller_id\":\"3\",\"biller\":\"Test Biller\",\"note\":\"\",\"internal_note\":null,\"total\":\"99668.0000\",\"product_discount\":\"1288.0000\",\"order_discount\":\"0.0000\",\"order_discount_id\":\"0\",\"total_discount\":\"1288.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"500.0000\",\"grand_total\":\"100168.0000\",\"status\":\"pending\",\"created_by\":\"3\",\"updated_by\":null,\"updated_at\":null,\"attachment\":null,\"supplier_id\":\"2\",\"supplier\":\"mel sip\",\"hash\":\"0c9b412d64da422657c11f506595655077edb373f3746a5132f0847ecb35a0c2\",\"cgst\":null,\"sgst\":null,\"igst\":null},\"items\":[{\"id\":\"1\",\"quote_id\":\"1\",\"product_id\":\"2147483647\",\"product_code\":\"321rtf5654\",\"product_name\":\"Decorative Paint\",\"product_type\":\"manual\",\"option_id\":\"0\",\"net_unit_price\":\"1282.0000\",\"unit_price\":\"1282.0000\",\"quantity\":\"10.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"0\",\"tax\":\"\",\"discount\":\"68\",\"item_discount\":\"680.0000\",\"subtotal\":\"12820.0000\",\"serial_no\":null,\"real_unit_price\":\"1350.0000\",\"product_unit_id\":\"0\",\"product_unit_code\":null,\"unit_quantity\":\"10.0000\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":null,\"tax_name\":null,\"tax_rate\":null,\"unit\":null,\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null},{\"id\":\"2\",\"quote_id\":\"1\",\"product_id\":\"2147483647\",\"product_code\":\"0988uyh6777\",\"product_name\":\"Varnishes\",\"product_type\":\"manual\",\"option_id\":\"0\",\"net_unit_price\":\"1086.0000\",\"unit_price\":\"1086.0000\",\"quantity\":\"12.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"0\",\"tax\":\"\",\"discount\":\"14\",\"item_discount\":\"168.0000\",\"subtotal\":\"13032.0000\",\"serial_no\":null,\"real_unit_price\":\"1100.0000\",\"product_unit_id\":\"0\",\"product_unit_code\":null,\"unit_quantity\":\"12.0000\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":null,\"tax_name\":null,\"tax_rate\":null,\"unit\":null,\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null},{\"id\":\"3\",\"quote_id\":\"1\",\"product_id\":\"2147483647\",\"product_code\":\"876yth6544\",\"product_name\":\"Waterproofing Solutions\",\"product_type\":\"manual\",\"option_id\":\"0\",\"net_unit_price\":\"1383.0000\",\"unit_price\":\"1383.0000\",\"quantity\":\"16.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"0\",\"tax\":\"\",\"discount\":\"17\",\"item_discount\":\"272.0000\",\"subtotal\":\"22128.0000\",\"serial_no\":null,\"real_unit_price\":\"1400.0000\",\"product_unit_id\":\"0\",\"product_unit_code\":null,\"unit_quantity\":\"16.0000\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":null,\"tax_name\":null,\"tax_rate\":null,\"unit\":null,\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null},{\"id\":\"4\",\"quote_id\":\"1\",\"product_id\":\"2147483647\",\"product_code\":\"iuy765rt45\",\"product_name\":\"Textured coatings\",\"product_type\":\"manual\",\"option_id\":\"0\",\"net_unit_price\":\"1150.0000\",\"unit_price\":\"1150.0000\",\"quantity\":\"21.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"0\",\"tax\":\"\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"24150.0000\",\"serial_no\":null,\"real_unit_price\":\"1150.0000\",\"product_unit_id\":\"0\",\"product_unit_code\":null,\"unit_quantity\":\"21.0000\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":null,\"tax_name\":null,\"tax_rate\":null,\"unit\":null,\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null},{\"id\":\"5\",\"quote_id\":\"1\",\"product_id\":\"2147483647\",\"product_code\":\"yh7665trf\",\"product_name\":\"Industrial Flooring\",\"product_type\":\"manual\",\"option_id\":\"0\",\"net_unit_price\":\"838.0000\",\"unit_price\":\"838.0000\",\"quantity\":\"13.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"0\",\"tax\":\"\",\"discount\":\"12\",\"item_discount\":\"156.0000\",\"subtotal\":\"10894.0000\",\"serial_no\":null,\"real_unit_price\":\"850.0000\",\"product_unit_id\":\"0\",\"product_unit_code\":null,\"unit_quantity\":\"13.0000\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":null,\"tax_name\":null,\"tax_rate\":null,\"unit\":null,\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null},{\"id\":\"6\",\"quote_id\":\"1\",\"product_id\":\"2147483647\",\"product_code\":\"09iuujh788\",\"product_name\":\"Road marking paint\",\"product_type\":\"manual\",\"option_id\":\"0\",\"net_unit_price\":\"1387.0000\",\"unit_price\":\"1387.0000\",\"quantity\":\"12.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"0\",\"tax\":\"\",\"discount\":\"1\",\"item_discount\":\"12.0000\",\"subtotal\":\"16644.0000\",\"serial_no\":null,\"real_unit_price\":\"1388.0000\",\"product_unit_id\":\"0\",\"product_unit_code\":null,\"unit_quantity\":\"12.0000\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":null,\"tax_name\":null,\"tax_rate\":null,\"unit\":null,\"image\":null,\"details\":null,\"variant\":null,\"hsn_code\":null,\"second_name\":null}]}', '2022-09-18 13:06:53'),
(24, 'Sale is being deleted by admin (User Id: 1)', '{\"model\":{\"id\":\"11\",\"date\":\"2022-09-21 04:54:54\",\"reference_no\":\"SALE2022\\/09\\/0004\",\"customer_id\":\"9\",\"customer\":\"Decker Vincent Co\",\"biller_id\":\"3\",\"biller\":\"THE DOBET PHARMACY\",\"warehouse_id\":\"1\",\"note\":\"\",\"staff_note\":null,\"total\":\"4610.0000\",\"product_discount\":\"0.0000\",\"order_discount_id\":null,\"total_discount\":\"0.0000\",\"order_discount\":\"0.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"0.0000\",\"grand_total\":\"4610.0000\",\"sale_status\":\"pending\",\"payment_status\":\"pending\",\"payment_term\":null,\"due_date\":null,\"created_by\":null,\"updated_by\":null,\"updated_at\":null,\"total_items\":\"7\",\"pos\":\"0\",\"paid\":\"0.0000\",\"return_id\":null,\"surcharge\":\"0.0000\",\"attachment\":null,\"return_sale_ref\":null,\"sale_id\":null,\"return_sale_total\":\"0.0000\",\"rounding\":null,\"suspend_note\":null,\"api\":\"0\",\"shop\":\"1\",\"address_id\":\"4\",\"reserve_id\":null,\"hash\":\"33fc44b28b21cd0669aa3272aca75a98ab02bb538af5e820c2a943033c07462f\",\"manual_payment\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"payment_method\":\"cod\"},\"items\":null}', '2022-10-05 21:07:33'),
(25, 'Sale is being deleted by admin (User Id: 1)', '{\"model\":{\"id\":\"9\",\"date\":\"2022-09-18 11:03:53\",\"reference_no\":\"SALE2022\\/09\\/0003\",\"customer_id\":\"8\",\"customer\":\"Hudson and Ewing Inc\",\"biller_id\":\"3\",\"biller\":\"THE DOBET PHARMACY\",\"warehouse_id\":\"1\",\"note\":\"\",\"staff_note\":null,\"total\":\"1150.0000\",\"product_discount\":\"0.0000\",\"order_discount_id\":null,\"total_discount\":\"0.0000\",\"order_discount\":\"0.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"0.0000\",\"grand_total\":\"1150.0000\",\"sale_status\":\"pending\",\"payment_status\":\"pending\",\"payment_term\":null,\"due_date\":null,\"created_by\":null,\"updated_by\":null,\"updated_at\":null,\"total_items\":\"2\",\"pos\":\"0\",\"paid\":\"0.0000\",\"return_id\":null,\"surcharge\":\"0.0000\",\"attachment\":null,\"return_sale_ref\":null,\"sale_id\":null,\"return_sale_total\":\"0.0000\",\"rounding\":null,\"suspend_note\":null,\"api\":\"0\",\"shop\":\"1\",\"address_id\":\"3\",\"reserve_id\":null,\"hash\":\"241bc8d577de78b2014fb9fa7e3b4f1f554f43881995ae3abd8104dedfb5b1bf\",\"manual_payment\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"payment_method\":\"cod\"},\"items\":null}', '2022-10-05 21:07:33'),
(26, 'Sale is being deleted by admin (User Id: 1)', '{\"model\":{\"id\":\"10\",\"date\":\"2022-09-21 04:49:32\",\"reference_no\":\"SALE\\/POS2022\\/09\\/0007\",\"customer_id\":\"1\",\"customer\":\"Walk-in Customer\",\"biller_id\":\"3\",\"biller\":\"THE DOBET PHARMACY\",\"warehouse_id\":\"1\",\"note\":\"\",\"staff_note\":\"\",\"total\":\"2855.0000\",\"product_discount\":\"0.0000\",\"order_discount_id\":\"\",\"total_discount\":\"0.0000\",\"order_discount\":\"0.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"0.0000\",\"grand_total\":\"2855.0000\",\"sale_status\":\"completed\",\"payment_status\":\"paid\",\"payment_term\":\"0\",\"due_date\":null,\"created_by\":\"1\",\"updated_by\":null,\"updated_at\":null,\"total_items\":\"6\",\"pos\":\"1\",\"paid\":\"2855.0000\",\"return_id\":null,\"surcharge\":\"0.0000\",\"attachment\":null,\"return_sale_ref\":null,\"sale_id\":null,\"return_sale_total\":\"0.0000\",\"rounding\":\"0.0000\",\"suspend_note\":null,\"api\":\"0\",\"shop\":\"0\",\"address_id\":null,\"reserve_id\":null,\"hash\":\"ac8b09c22b05d11e891797ff4de75d4e11a4a4356510387473e4ad154c3adaa2\",\"manual_payment\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"payment_method\":null},\"items\":[{\"id\":\"25\",\"sale_id\":\"10\",\"product_id\":\"8\",\"product_code\":\"81965763\",\"product_name\":\"Aluminium Hydroxide gel\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"350.0000\",\"unit_price\":\"350.0000\",\"quantity\":\"4.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"1400.0000\",\"serial_no\":\"\",\"real_unit_price\":\"350.0000\",\"sale_item_id\":null,\"product_unit_id\":\"3\",\"product_unit_code\":\"pc\",\"unit_quantity\":\"4.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":\"no_image.png\",\"details\":\"\",\"variant\":null,\"hsn_code\":null,\"second_name\":\"Ahg\",\"base_unit_id\":\"3\",\"base_unit_code\":\"pc\"},{\"id\":\"26\",\"sale_id\":\"10\",\"product_id\":\"11\",\"product_code\":\"66542564\",\"product_name\":\"Pepto-Bismol\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"1450.0000\",\"unit_price\":\"1450.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"1450.0000\",\"serial_no\":\"\",\"real_unit_price\":\"1450.0000\",\"sale_item_id\":null,\"product_unit_id\":\"3\",\"product_unit_code\":\"pc\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":\"no_image.png\",\"details\":\"\",\"variant\":null,\"hsn_code\":null,\"second_name\":\"Pb\",\"base_unit_id\":\"3\",\"base_unit_code\":\"pc\"},{\"id\":\"27\",\"sale_id\":\"10\",\"product_id\":\"9\",\"product_code\":\"73086706\",\"product_name\":\"Calcium Carbonate(Alka-Seltzer\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"5.0000\",\"unit_price\":\"5.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"5.0000\",\"serial_no\":\"\",\"real_unit_price\":\"5.0000\",\"sale_item_id\":null,\"product_unit_id\":\"1\",\"product_unit_code\":\"grams\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":\"no_image.png\",\"details\":\"\",\"variant\":null,\"hsn_code\":null,\"second_name\":\"Cc\",\"base_unit_id\":\"1\",\"base_unit_code\":\"grams\"}]}', '2022-10-05 21:07:47'),
(27, 'Sale is being deleted by admin (User Id: 1)', '{\"model\":{\"id\":\"8\",\"date\":\"2022-09-18 06:05:07\",\"reference_no\":\"SALE\\/POS2022\\/09\\/0006\",\"customer_id\":\"1\",\"customer\":\"Walk-in Customer\",\"biller_id\":\"3\",\"biller\":\"THE DOBET PHARMACY\",\"warehouse_id\":\"1\",\"note\":\"\",\"staff_note\":\"\",\"total\":\"2556.0000\",\"product_discount\":\"0.0000\",\"order_discount_id\":\"\",\"total_discount\":\"0.0000\",\"order_discount\":\"0.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"0.0000\",\"grand_total\":\"2556.0000\",\"sale_status\":\"completed\",\"payment_status\":\"paid\",\"payment_term\":\"0\",\"due_date\":null,\"created_by\":\"1\",\"updated_by\":null,\"updated_at\":null,\"total_items\":\"3\",\"pos\":\"1\",\"paid\":\"2556.0000\",\"return_id\":null,\"surcharge\":\"0.0000\",\"attachment\":null,\"return_sale_ref\":null,\"sale_id\":null,\"return_sale_total\":\"0.0000\",\"rounding\":\"0.0000\",\"suspend_note\":null,\"api\":\"0\",\"shop\":\"0\",\"address_id\":null,\"reserve_id\":null,\"hash\":\"ed06db7d2e0862c037aaf7a27b1a0e58e9cf8eaf0023654cb1d4be1d24ffcadf\",\"manual_payment\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"payment_method\":null},\"items\":[{\"id\":\"20\",\"sale_id\":\"8\",\"product_id\":\"20\",\"product_code\":\"99168487\",\"product_name\":\" Benedryl (diphenhydramine)\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"500.0000\",\"unit_price\":\"500.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"500.0000\",\"serial_no\":\"\",\"real_unit_price\":\"500.0000\",\"sale_item_id\":null,\"product_unit_id\":\"3\",\"product_unit_code\":\"pc\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":\"no_image.png\",\"details\":\"\",\"variant\":null,\"hsn_code\":null,\"second_name\":\"bd\",\"base_unit_id\":\"3\",\"base_unit_code\":\"pc\"},{\"id\":\"21\",\"sale_id\":\"8\",\"product_id\":\"10\",\"product_code\":\"22632500\",\"product_name\":\"Magnesium Hydroxide(milk of magnesia)\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"1500.0000\",\"unit_price\":\"1500.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"1500.0000\",\"serial_no\":\"\",\"real_unit_price\":\"1500.0000\",\"sale_item_id\":null,\"product_unit_id\":\"3\",\"product_unit_code\":\"pc\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":\"no_image.png\",\"details\":\"\",\"variant\":null,\"hsn_code\":null,\"second_name\":\"mm\",\"base_unit_id\":\"3\",\"base_unit_code\":\"pc\"},{\"id\":\"22\",\"sale_id\":\"8\",\"product_id\":\"14\",\"product_code\":\"33506152\",\"product_name\":\"Ferrous Sulfate\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"556.0000\",\"unit_price\":\"556.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"556.0000\",\"serial_no\":\"\",\"real_unit_price\":\"556.0000\",\"sale_item_id\":null,\"product_unit_id\":\"3\",\"product_unit_code\":\"pc\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":\"no_image.png\",\"details\":\"\",\"variant\":null,\"hsn_code\":null,\"second_name\":\"Fs\",\"base_unit_id\":\"3\",\"base_unit_code\":\"pc\"}]}', '2022-10-05 21:07:47'),
(28, 'Sale is being deleted by admin (User Id: 1)', '{\"model\":{\"id\":\"7\",\"date\":\"2022-09-18 05:41:55\",\"reference_no\":\"SALE\\/POS2022\\/09\\/0005\",\"customer_id\":\"1\",\"customer\":\"Walk-in Customer\",\"biller_id\":\"3\",\"biller\":\"THE DOBET PHARMACY\",\"warehouse_id\":\"1\",\"note\":\"\",\"staff_note\":\"\",\"total\":\"3449.0000\",\"product_discount\":\"0.0000\",\"order_discount_id\":\"\",\"total_discount\":\"0.0000\",\"order_discount\":\"0.0000\",\"product_tax\":\"0.0000\",\"order_tax_id\":\"1\",\"order_tax\":\"0.0000\",\"total_tax\":\"0.0000\",\"shipping\":\"0.0000\",\"grand_total\":\"3449.0000\",\"sale_status\":\"completed\",\"payment_status\":\"paid\",\"payment_term\":\"0\",\"due_date\":null,\"created_by\":\"4\",\"updated_by\":null,\"updated_at\":null,\"total_items\":\"3\",\"pos\":\"1\",\"paid\":\"3449.0000\",\"return_id\":null,\"surcharge\":\"0.0000\",\"attachment\":null,\"return_sale_ref\":null,\"sale_id\":null,\"return_sale_total\":\"0.0000\",\"rounding\":\"0.0000\",\"suspend_note\":null,\"api\":\"0\",\"shop\":\"0\",\"address_id\":null,\"reserve_id\":null,\"hash\":\"2cffd23ba6f8387ccf2cc87dbf75b5c09027b2a18e1f2affbc054d7e87c00b69\",\"manual_payment\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"payment_method\":null},\"items\":[{\"id\":\"17\",\"sale_id\":\"7\",\"product_id\":\"11\",\"product_code\":\"66542564\",\"product_name\":\"Pepto-Bismol\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"1450.0000\",\"unit_price\":\"1450.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"1450.0000\",\"serial_no\":\"\",\"real_unit_price\":\"1450.0000\",\"sale_item_id\":null,\"product_unit_id\":\"4\",\"product_unit_code\":\"ml\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":\"no_image.png\",\"details\":\"\",\"variant\":null,\"hsn_code\":null,\"second_name\":\"Pb\",\"base_unit_id\":\"3\",\"base_unit_code\":\"pc\"},{\"id\":\"18\",\"sale_id\":\"7\",\"product_id\":\"16\",\"product_code\":\"92257284\",\"product_name\":\"Deferoxamine\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"999.0000\",\"unit_price\":\"999.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"999.0000\",\"serial_no\":\"\",\"real_unit_price\":\"999.0000\",\"sale_item_id\":null,\"product_unit_id\":\"4\",\"product_unit_code\":\"ml\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":\"no_image.png\",\"details\":\"\",\"variant\":null,\"hsn_code\":null,\"second_name\":\"Dx\",\"base_unit_id\":\"3\",\"base_unit_code\":\"pc\"},{\"id\":\"19\",\"sale_id\":\"7\",\"product_id\":\"17\",\"product_code\":\"66845984\",\"product_name\":\"Folic acid\",\"product_type\":\"standard\",\"option_id\":null,\"net_unit_price\":\"1000.0000\",\"unit_price\":\"1000.0000\",\"quantity\":\"1.0000\",\"warehouse_id\":\"1\",\"item_tax\":\"0.0000\",\"tax_rate_id\":\"1\",\"tax\":\"0\",\"discount\":\"0\",\"item_discount\":\"0.0000\",\"subtotal\":\"1000.0000\",\"serial_no\":\"\",\"real_unit_price\":\"1000.0000\",\"sale_item_id\":null,\"product_unit_id\":\"4\",\"product_unit_code\":\"ml\",\"unit_quantity\":\"1.0000\",\"comment\":\"\",\"gst\":null,\"cgst\":null,\"sgst\":null,\"igst\":null,\"tax_code\":\"NT\",\"tax_name\":\"No Tax\",\"tax_rate\":\"0.0000\",\"image\":\"no_image.png\",\"details\":\"\",\"variant\":null,\"hsn_code\":null,\"second_name\":\"Fa\",\"base_unit_id\":\"3\",\"base_unit_code\":\"pc\"}]}', '2022-10-05 21:07:47');
INSERT INTO `sma_logs` (`id`, `detail`, `model`, `date`) VALUES
(29, 'Customer is being deleted by admin (User Id: 1)', '{\"model\":{\"id\":\"9\",\"group_id\":\"3\",\"group_name\":\"customer\",\"customer_group_id\":\"1\",\"customer_group_name\":\"General\",\"name\":\"Iris Ortega\",\"company\":\"Decker Vincent Co\",\"vat_no\":null,\"address\":\"Quae quos soluta ut<br>Eaque dolore ipsum \",\"city\":\"Debitis pariatur Se\",\"state\":\"Impedit reprehender\",\"postal_code\":\"Et ut mi\",\"country\":\"Molestias reprehende\",\"phone\":\"+1 (778) 997-9749\",\"email\":\"palukohug@mailinator.com\",\"cf1\":null,\"cf2\":null,\"cf3\":null,\"cf4\":null,\"cf5\":null,\"cf6\":null,\"invoice_footer\":null,\"payment_term\":\"0\",\"logo\":\"logo.png\",\"award_points\":\"46\",\"deposit_amount\":null,\"price_group_id\":\"1\",\"price_group_name\":\"Default\",\"gst_no\":null}}', '2022-10-05 21:08:21'),
(30, 'Customer is being deleted by admin (User Id: 1)', '{\"model\":{\"id\":\"8\",\"group_id\":\"3\",\"group_name\":\"customer\",\"customer_group_id\":\"1\",\"customer_group_name\":\"General\",\"name\":\"Dawn Sweeney\",\"company\":\"Hudson and Ewing Inc\",\"vat_no\":null,\"address\":\"Aliqua Nihil sequi<br>Nostrum sapiente sun\",\"city\":\"Et omnis in quisquam\",\"state\":\"Pariatur Ut iure au\",\"postal_code\":\"Eiusmod \",\"country\":\"Deleniti fugiat ea\",\"phone\":\"+1 (254) 914-7276\",\"email\":\"tyhixi@mailinator.com\",\"cf1\":null,\"cf2\":null,\"cf3\":null,\"cf4\":null,\"cf5\":null,\"cf6\":null,\"invoice_footer\":null,\"payment_term\":\"0\",\"logo\":\"logo.png\",\"award_points\":\"11\",\"deposit_amount\":null,\"price_group_id\":\"1\",\"price_group_name\":\"Default\",\"gst_no\":null}}', '2022-10-05 21:08:21'),
(31, 'Customer is being deleted by admin (User Id: 1)', '{\"model\":{\"id\":\"7\",\"group_id\":\"3\",\"group_name\":\"customer\",\"customer_group_id\":\"1\",\"customer_group_name\":\"General\",\"name\":\"Online-Customer\",\"company\":\"Online-Customer\",\"vat_no\":\"\",\"address\":\"002\",\"city\":\"kenya\",\"state\":\"kenya\",\"postal_code\":\"\",\"country\":\"Kenya\",\"phone\":\"0123456789\",\"email\":\"online@dobetpharmacy.co.ke\",\"cf1\":\"\",\"cf2\":\"\",\"cf3\":\"\",\"cf4\":\"\",\"cf5\":\"\",\"cf6\":\"\",\"invoice_footer\":null,\"payment_term\":\"0\",\"logo\":\"logo.png\",\"award_points\":\"0\",\"deposit_amount\":null,\"price_group_id\":null,\"price_group_name\":null,\"gst_no\":\"\"}}', '2022-10-05 21:08:21'),
(32, 'Customer is being deleted by admin (User Id: 1)', '{\"model\":{\"id\":\"10\",\"group_id\":\"3\",\"group_name\":\"customer\",\"customer_group_id\":\"1\",\"customer_group_name\":\"General\",\"name\":\"######Hotel\",\"company\":\"######Hotel\",\"vat_no\":\"\",\"address\":\"Rwaka -- next to Sahara West\",\"city\":\"Nairobi\",\"state\":\"Kenya\",\"postal_code\":\"\",\"country\":\"\",\"phone\":\"0721226919\",\"email\":\"####hotel@gmail.com\",\"cf1\":\"\",\"cf2\":\"\",\"cf3\":\"\",\"cf4\":\"\",\"cf5\":\"\",\"cf6\":\"\",\"invoice_footer\":null,\"payment_term\":\"0\",\"logo\":\"logo.png\",\"award_points\":\"0\",\"deposit_amount\":null,\"price_group_id\":\"1\",\"price_group_name\":\"Default\",\"gst_no\":\"\"}}', '2022-10-05 21:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `sma_migrations`
--

CREATE TABLE `sma_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_migrations`
--

INSERT INTO `sma_migrations` (`version`) VALUES
(315);

-- --------------------------------------------------------

--
-- Table structure for table `sma_notifications`
--

CREATE TABLE `sma_notifications` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `from_date` datetime DEFAULT NULL,
  `till_date` datetime DEFAULT NULL,
  `scope` tinyint(1) NOT NULL DEFAULT 3
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_notifications`
--

INSERT INTO `sma_notifications` (`id`, `comment`, `date`, `from_date`, `till_date`, `scope`) VALUES
(1, '<p>Thank you for purchasing Magnocloud software , for support please call 0112357698</p>', '2014-08-15 03:00:57', '2015-01-01 00:00:00', '2017-01-01 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sma_order_ref`
--

CREATE TABLE `sma_order_ref` (
  `ref_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `so` int(11) NOT NULL DEFAULT 1,
  `qu` int(11) NOT NULL DEFAULT 1,
  `po` int(11) NOT NULL DEFAULT 1,
  `to` int(11) NOT NULL DEFAULT 1,
  `pos` int(11) NOT NULL DEFAULT 1,
  `do` int(11) NOT NULL DEFAULT 1,
  `pay` int(11) NOT NULL DEFAULT 1,
  `re` int(11) NOT NULL DEFAULT 1,
  `rep` int(11) NOT NULL DEFAULT 1,
  `ex` int(11) NOT NULL DEFAULT 1,
  `ppay` int(11) NOT NULL DEFAULT 1,
  `qa` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_order_ref`
--

INSERT INTO `sma_order_ref` (`ref_id`, `date`, `so`, `qu`, `po`, `to`, `pos`, `do`, `pay`, `re`, `rep`, `ex`, `ppay`, `qa`) VALUES
(1, '2015-03-01', 5, 1, 1, 1, 8, 1, 9, 1, 1, 1, 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `sma_pages`
--

CREATE TABLE `sma_pages` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` varchar(180) NOT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `body` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_no` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_payments`
--

CREATE TABLE `sma_payments` (
  `id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `sale_id` int(11) DEFAULT NULL,
  `return_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `reference_no` varchar(50) NOT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `paid_by` varchar(20) NOT NULL,
  `cheque_no` varchar(20) DEFAULT NULL,
  `cc_no` varchar(20) DEFAULT NULL,
  `cc_holder` varchar(25) DEFAULT NULL,
  `cc_month` varchar(2) DEFAULT NULL,
  `cc_year` varchar(4) DEFAULT NULL,
  `cc_type` varchar(20) DEFAULT NULL,
  `amount` decimal(25,4) NOT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `pos_paid` decimal(25,4) DEFAULT 0.0000,
  `pos_balance` decimal(25,4) DEFAULT 0.0000,
  `approval_code` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_paypal`
--

CREATE TABLE `sma_paypal` (
  `id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `paypal_currency` varchar(3) NOT NULL DEFAULT 'USD',
  `fixed_charges` decimal(25,4) NOT NULL DEFAULT 2.0000,
  `extra_charges_my` decimal(25,4) NOT NULL DEFAULT 3.9000,
  `extra_charges_other` decimal(25,4) NOT NULL DEFAULT 4.4000
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_paypal`
--

INSERT INTO `sma_paypal` (`id`, `active`, `account_email`, `paypal_currency`, `fixed_charges`, `extra_charges_my`, `extra_charges_other`) VALUES
(1, 1, 'mypaypal@paypal.com', 'USD', '0.0000', '0.0000', '0.0000');

-- --------------------------------------------------------

--
-- Table structure for table `sma_permissions`
--

CREATE TABLE `sma_permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `products-index` tinyint(1) DEFAULT 0,
  `products-add` tinyint(1) DEFAULT 0,
  `products-edit` tinyint(1) DEFAULT 0,
  `products-delete` tinyint(1) DEFAULT 0,
  `products-cost` tinyint(1) DEFAULT 0,
  `products-price` tinyint(1) DEFAULT 0,
  `quotes-index` tinyint(1) DEFAULT 0,
  `quotes-add` tinyint(1) DEFAULT 0,
  `quotes-edit` tinyint(1) DEFAULT 0,
  `quotes-pdf` tinyint(1) DEFAULT 0,
  `quotes-email` tinyint(1) DEFAULT 0,
  `quotes-delete` tinyint(1) DEFAULT 0,
  `sales-index` tinyint(1) DEFAULT 0,
  `sales-add` tinyint(1) DEFAULT 0,
  `sales-edit` tinyint(1) DEFAULT 0,
  `sales-pdf` tinyint(1) DEFAULT 0,
  `sales-email` tinyint(1) DEFAULT 0,
  `sales-delete` tinyint(1) DEFAULT 0,
  `purchases-index` tinyint(1) DEFAULT 0,
  `purchases-add` tinyint(1) DEFAULT 0,
  `purchases-edit` tinyint(1) DEFAULT 0,
  `purchases-pdf` tinyint(1) DEFAULT 0,
  `purchases-email` tinyint(1) DEFAULT 0,
  `purchases-delete` tinyint(1) DEFAULT 0,
  `transfers-index` tinyint(1) DEFAULT 0,
  `transfers-add` tinyint(1) DEFAULT 0,
  `transfers-edit` tinyint(1) DEFAULT 0,
  `transfers-pdf` tinyint(1) DEFAULT 0,
  `transfers-email` tinyint(1) DEFAULT 0,
  `transfers-delete` tinyint(1) DEFAULT 0,
  `customers-index` tinyint(1) DEFAULT 0,
  `customers-add` tinyint(1) DEFAULT 0,
  `customers-edit` tinyint(1) DEFAULT 0,
  `customers-delete` tinyint(1) DEFAULT 0,
  `suppliers-index` tinyint(1) DEFAULT 0,
  `suppliers-add` tinyint(1) DEFAULT 0,
  `suppliers-edit` tinyint(1) DEFAULT 0,
  `suppliers-delete` tinyint(1) DEFAULT 0,
  `sales-deliveries` tinyint(1) DEFAULT 0,
  `sales-add_delivery` tinyint(1) DEFAULT 0,
  `sales-edit_delivery` tinyint(1) DEFAULT 0,
  `sales-delete_delivery` tinyint(1) DEFAULT 0,
  `sales-email_delivery` tinyint(1) DEFAULT 0,
  `sales-pdf_delivery` tinyint(1) DEFAULT 0,
  `sales-gift_cards` tinyint(1) DEFAULT 0,
  `sales-add_gift_card` tinyint(1) DEFAULT 0,
  `sales-edit_gift_card` tinyint(1) DEFAULT 0,
  `sales-delete_gift_card` tinyint(1) DEFAULT 0,
  `pos-index` tinyint(1) DEFAULT 0,
  `sales-return_sales` tinyint(1) DEFAULT 0,
  `reports-index` tinyint(1) DEFAULT 0,
  `reports-warehouse_stock` tinyint(1) DEFAULT 0,
  `reports-quantity_alerts` tinyint(1) DEFAULT 0,
  `reports-expiry_alerts` tinyint(1) DEFAULT 0,
  `reports-products` tinyint(1) DEFAULT 0,
  `reports-daily_sales` tinyint(1) DEFAULT 0,
  `reports-monthly_sales` tinyint(1) DEFAULT 0,
  `reports-sales` tinyint(1) DEFAULT 0,
  `reports-payments` tinyint(1) DEFAULT 0,
  `reports-purchases` tinyint(1) DEFAULT 0,
  `reports-profit_loss` tinyint(1) DEFAULT 0,
  `reports-customers` tinyint(1) DEFAULT 0,
  `reports-suppliers` tinyint(1) DEFAULT 0,
  `reports-staff` tinyint(1) DEFAULT 0,
  `reports-register` tinyint(1) DEFAULT 0,
  `sales-payments` tinyint(1) DEFAULT 0,
  `purchases-payments` tinyint(1) DEFAULT 0,
  `purchases-expenses` tinyint(1) DEFAULT 0,
  `products-adjustments` tinyint(1) NOT NULL DEFAULT 0,
  `bulk_actions` tinyint(1) NOT NULL DEFAULT 0,
  `customers-deposits` tinyint(1) NOT NULL DEFAULT 0,
  `customers-delete_deposit` tinyint(1) NOT NULL DEFAULT 0,
  `products-barcode` tinyint(1) NOT NULL DEFAULT 0,
  `purchases-return_purchases` tinyint(1) NOT NULL DEFAULT 0,
  `reports-expenses` tinyint(1) NOT NULL DEFAULT 0,
  `reports-daily_purchases` tinyint(1) DEFAULT 0,
  `reports-monthly_purchases` tinyint(1) DEFAULT 0,
  `products-stock_count` tinyint(1) DEFAULT 0,
  `edit_price` tinyint(1) DEFAULT 0,
  `returns-index` tinyint(1) DEFAULT 0,
  `returns-add` tinyint(1) DEFAULT 0,
  `returns-edit` tinyint(1) DEFAULT 0,
  `returns-delete` tinyint(1) DEFAULT 0,
  `returns-email` tinyint(1) DEFAULT 0,
  `returns-pdf` tinyint(1) DEFAULT 0,
  `reports-tax` tinyint(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_permissions`
--

INSERT INTO `sma_permissions` (`id`, `group_id`, `products-index`, `products-add`, `products-edit`, `products-delete`, `products-cost`, `products-price`, `quotes-index`, `quotes-add`, `quotes-edit`, `quotes-pdf`, `quotes-email`, `quotes-delete`, `sales-index`, `sales-add`, `sales-edit`, `sales-pdf`, `sales-email`, `sales-delete`, `purchases-index`, `purchases-add`, `purchases-edit`, `purchases-pdf`, `purchases-email`, `purchases-delete`, `transfers-index`, `transfers-add`, `transfers-edit`, `transfers-pdf`, `transfers-email`, `transfers-delete`, `customers-index`, `customers-add`, `customers-edit`, `customers-delete`, `suppliers-index`, `suppliers-add`, `suppliers-edit`, `suppliers-delete`, `sales-deliveries`, `sales-add_delivery`, `sales-edit_delivery`, `sales-delete_delivery`, `sales-email_delivery`, `sales-pdf_delivery`, `sales-gift_cards`, `sales-add_gift_card`, `sales-edit_gift_card`, `sales-delete_gift_card`, `pos-index`, `sales-return_sales`, `reports-index`, `reports-warehouse_stock`, `reports-quantity_alerts`, `reports-expiry_alerts`, `reports-products`, `reports-daily_sales`, `reports-monthly_sales`, `reports-sales`, `reports-payments`, `reports-purchases`, `reports-profit_loss`, `reports-customers`, `reports-suppliers`, `reports-staff`, `reports-register`, `sales-payments`, `purchases-payments`, `purchases-expenses`, `products-adjustments`, `bulk_actions`, `customers-deposits`, `customers-delete_deposit`, `products-barcode`, `purchases-return_purchases`, `reports-expenses`, `reports-daily_purchases`, `reports-monthly_purchases`, `products-stock_count`, `edit_price`, `returns-index`, `returns-add`, `returns-edit`, `returns-delete`, `returns-email`, `returns-pdf`, `reports-tax`) VALUES
(1, 5, 1, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sma_pos_register`
--

CREATE TABLE `sma_pos_register` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `cash_in_hand` decimal(25,4) NOT NULL,
  `status` varchar(10) NOT NULL,
  `total_cash` decimal(25,4) DEFAULT NULL,
  `total_cheques` int(11) DEFAULT NULL,
  `total_cc_slips` int(11) DEFAULT NULL,
  `total_cash_submitted` decimal(25,4) DEFAULT NULL,
  `total_cheques_submitted` int(11) DEFAULT NULL,
  `total_cc_slips_submitted` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `transfer_opened_bills` varchar(50) DEFAULT NULL,
  `closed_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_pos_register`
--

INSERT INTO `sma_pos_register` (`id`, `date`, `user_id`, `cash_in_hand`, `status`, `total_cash`, `total_cheques`, `total_cc_slips`, `total_cash_submitted`, `total_cheques_submitted`, `total_cc_slips_submitted`, `note`, `closed_at`, `transfer_opened_bills`, `closed_by`) VALUES
(1, '2022-07-15 09:49:05', 1, '0.0000', 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2022-07-17 21:04:00', 2, '0.0000', 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2022-09-15 12:52:44', 3, '0.0000', 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2022-09-17 17:25:16', 4, '0.0000', 'open', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_pos_settings`
--

CREATE TABLE `sma_pos_settings` (
  `pos_id` int(1) NOT NULL,
  `cat_limit` int(11) NOT NULL,
  `pro_limit` int(11) NOT NULL,
  `default_category` int(11) NOT NULL,
  `default_customer` int(11) NOT NULL,
  `default_biller` int(11) NOT NULL,
  `display_time` varchar(3) NOT NULL DEFAULT 'yes',
  `cf_title1` varchar(255) DEFAULT NULL,
  `cf_title2` varchar(255) DEFAULT NULL,
  `cf_value1` varchar(255) DEFAULT NULL,
  `cf_value2` varchar(255) DEFAULT NULL,
  `receipt_printer` varchar(55) DEFAULT NULL,
  `cash_drawer_codes` varchar(55) DEFAULT NULL,
  `focus_add_item` varchar(55) DEFAULT NULL,
  `add_manual_product` varchar(55) DEFAULT NULL,
  `customer_selection` varchar(55) DEFAULT NULL,
  `add_customer` varchar(55) DEFAULT NULL,
  `toggle_category_slider` varchar(55) DEFAULT NULL,
  `toggle_subcategory_slider` varchar(55) DEFAULT NULL,
  `cancel_sale` varchar(55) DEFAULT NULL,
  `suspend_sale` varchar(55) DEFAULT NULL,
  `print_items_list` varchar(55) DEFAULT NULL,
  `finalize_sale` varchar(55) DEFAULT NULL,
  `today_sale` varchar(55) DEFAULT NULL,
  `open_hold_bills` varchar(55) DEFAULT NULL,
  `close_register` varchar(55) DEFAULT NULL,
  `keyboard` tinyint(1) NOT NULL,
  `pos_printers` varchar(255) DEFAULT NULL,
  `java_applet` tinyint(1) NOT NULL,
  `product_button_color` varchar(20) NOT NULL DEFAULT 'default',
  `tooltips` tinyint(1) DEFAULT 1,
  `paypal_pro` tinyint(1) DEFAULT 0,
  `stripe` tinyint(1) DEFAULT 0,
  `rounding` tinyint(1) DEFAULT 0,
  `char_per_line` tinyint(4) DEFAULT 42,
  `pin_code` varchar(20) DEFAULT NULL,
  `purchase_code` varchar(100) DEFAULT 'purchase_code',
  `envato_username` varchar(50) DEFAULT 'envato_username',
  `version` varchar(10) DEFAULT '3.4.47',
  `after_sale_page` tinyint(1) DEFAULT 0,
  `item_order` tinyint(1) DEFAULT 0,
  `authorize` tinyint(1) DEFAULT 0,
  `toggle_brands_slider` varchar(55) DEFAULT NULL,
  `remote_printing` tinyint(1) DEFAULT 1,
  `printer` int(11) DEFAULT NULL,
  `order_printers` varchar(55) DEFAULT NULL,
  `auto_print` tinyint(1) DEFAULT 0,
  `customer_details` tinyint(1) DEFAULT NULL,
  `local_printers` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_pos_settings`
--

INSERT INTO `sma_pos_settings` (`pos_id`, `cat_limit`, `pro_limit`, `default_category`, `default_customer`, `default_biller`, `display_time`, `cf_title1`, `cf_title2`, `cf_value1`, `cf_value2`, `receipt_printer`, `cash_drawer_codes`, `focus_add_item`, `add_manual_product`, `customer_selection`, `add_customer`, `toggle_category_slider`, `toggle_subcategory_slider`, `cancel_sale`, `suspend_sale`, `print_items_list`, `finalize_sale`, `today_sale`, `open_hold_bills`, `close_register`, `keyboard`, `pos_printers`, `java_applet`, `product_button_color`, `tooltips`, `paypal_pro`, `stripe`, `rounding`, `char_per_line`, `pin_code`, `purchase_code`, `envato_username`, `version`, `after_sale_page`, `item_order`, `authorize`, `toggle_brands_slider`, `remote_printing`, `printer`, `order_printers`, `auto_print`, `customer_details`, `local_printers`) VALUES
(1, 22, 50, 1, 1, 3, '1', '', 'Mpesa Till', '', '6473829', NULL, 'x1C', 'Ctrl+F3', 'Ctrl+Shift+M', 'Ctrl+Shift+C', 'Ctrl+Shift+A', 'Ctrl+F11', 'Ctrl+F12', 'F4', 'F7', 'F9', 'F8', 'Ctrl+F1', 'Ctrl+F2', 'Ctrl+F10', 1, NULL, 0, 'warning', 1, NULL, NULL, 0, 42, '1234', 'purchase_code', 'envato_username', '3.4.47', 0, 0, NULL, '', 1, NULL, 'null', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sma_price_groups`
--

CREATE TABLE `sma_price_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_price_groups`
--

INSERT INTO `sma_price_groups` (`id`, `name`) VALUES
(1, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `sma_printers`
--

CREATE TABLE `sma_printers` (
  `id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `type` varchar(25) NOT NULL,
  `profile` varchar(25) NOT NULL,
  `char_per_line` tinyint(3) UNSIGNED DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `ip_address` varbinary(45) DEFAULT NULL,
  `port` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_products`
--

CREATE TABLE `sma_products` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` int(11) DEFAULT NULL,
  `cost` decimal(25,4) DEFAULT NULL,
  `price` decimal(25,4) NOT NULL,
  `alert_quantity` decimal(15,4) DEFAULT 20.0000,
  `image` varchar(255) DEFAULT 'no_image.png',
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `cf1` varchar(255) DEFAULT NULL,
  `cf2` varchar(255) DEFAULT NULL,
  `cf3` varchar(255) DEFAULT NULL,
  `cf4` varchar(255) DEFAULT NULL,
  `cf5` varchar(255) DEFAULT NULL,
  `cf6` varchar(255) DEFAULT NULL,
  `quantity` decimal(15,4) DEFAULT 0.0000,
  `tax_rate` int(11) DEFAULT NULL,
  `track_quantity` tinyint(1) DEFAULT 1,
  `details` varchar(1000) DEFAULT NULL,
  `warehouse` int(11) DEFAULT NULL,
  `barcode_symbology` varchar(55) NOT NULL DEFAULT 'code128',
  `file` varchar(100) DEFAULT NULL,
  `product_details` text DEFAULT NULL,
  `tax_method` tinyint(1) DEFAULT 0,
  `type` varchar(55) NOT NULL DEFAULT 'standard',
  `supplier1` int(11) DEFAULT NULL,
  `supplier1price` decimal(25,4) DEFAULT NULL,
  `supplier2` int(11) DEFAULT NULL,
  `supplier2price` decimal(25,4) DEFAULT NULL,
  `supplier3` int(11) DEFAULT NULL,
  `supplier3price` decimal(25,4) DEFAULT NULL,
  `supplier4` int(11) DEFAULT NULL,
  `supplier4price` decimal(25,4) DEFAULT NULL,
  `supplier5` int(11) DEFAULT NULL,
  `supplier5price` decimal(25,4) DEFAULT NULL,
  `promotion` tinyint(1) DEFAULT 0,
  `promo_price` decimal(25,4) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `supplier1_part_no` varchar(50) DEFAULT NULL,
  `supplier2_part_no` varchar(50) DEFAULT NULL,
  `supplier3_part_no` varchar(50) DEFAULT NULL,
  `supplier4_part_no` varchar(50) DEFAULT NULL,
  `supplier5_part_no` varchar(50) DEFAULT NULL,
  `sale_unit` int(11) DEFAULT NULL,
  `purchase_unit` int(11) DEFAULT NULL,
  `brand` int(11) DEFAULT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `weight` decimal(10,4) DEFAULT NULL,
  `hsn_code` int(11) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `hide` tinyint(1) NOT NULL DEFAULT 0,
  `second_name` varchar(255) DEFAULT NULL,
  `hide_pos` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_products`
--

INSERT INTO `sma_products` (`id`, `code`, `name`, `unit`, `cost`, `price`, `alert_quantity`, `image`, `category_id`, `subcategory_id`, `cf1`, `cf2`, `cf3`, `cf4`, `cf5`, `cf6`, `quantity`, `tax_rate`, `track_quantity`, `details`, `warehouse`, `barcode_symbology`, `file`, `product_details`, `tax_method`, `type`, `supplier1`, `supplier1price`, `supplier2`, `supplier2price`, `supplier3`, `supplier3price`, `supplier4`, `supplier4price`, `supplier5`, `supplier5price`, `promotion`, `promo_price`, `start_date`, `end_date`, `supplier1_part_no`, `supplier2_part_no`, `supplier3_part_no`, `supplier4_part_no`, `supplier5_part_no`, `sale_unit`, `purchase_unit`, `brand`, `slug`, `featured`, `weight`, `hsn_code`, `views`, `hide`, `second_name`, `hide_pos`) VALUES
(14, '33506152', 'Ferrous Sulfate', 3, '300.0000', '556.0000', '500.0000', 'no_image.png', 3, NULL, '', '', '', '', '', '', '5000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 3, 3, 7, '33506152', 1, '250.0000', NULL, 0, 0, 'Fs', 0),
(13, '35307740', 'Erythropoietin (Epoetin alpha)', 3, '350.0000', '500.0000', '1000.0000', 'no_image.png', 3, NULL, '', '', '', '', '', '', '5000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 3, 3, 4, '35307740', 1, '165.0000', NULL, 0, 0, 'Ee', 0),
(12, '51040882', 'Gariscon', 3, '150.0000', '201.0000', '500.0000', 'no_image.png', 2, NULL, '', '', '', '', '', '', '5000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '195.0000', '2022-09-17', '2022-09-21', '', NULL, NULL, NULL, NULL, 3, 3, 6, '51040882', 1, '100.0000', NULL, 0, 0, 'Gg', 0),
(11, '66542564', 'Pepto-Bismol', 3, '1100.0000', '1450.0000', '1750.0000', 'no_image.png', 2, NULL, '', '', '', '', '', '', '10000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 3, 3, 5, '66542564', 1, '250.0000', NULL, 0, 0, 'Pb', 0),
(10, '22632500', 'Magnesium Hydroxide(milk of magnesia)', 3, '1375.0000', '1545.0000', '2000.0000', 'no_image.png', 2, NULL, '', '', '', '', '', '', '5000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1500.0000', '2022-09-17', '2022-09-26', '', NULL, NULL, NULL, NULL, 3, 3, 3, '22632500', 1, '250.0000', NULL, 0, 0, 'mm', 0),
(9, '73086706', 'Calcium Carbonate(Alka-Seltzer', 1, '1.0000', '5.0000', '50.0000', 'no_image.png', 2, NULL, '', '', '', '', '', '', '5000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 1, 2, '73086706', 1, '0.0000', NULL, 0, 0, 'Cc', 0),
(8, '81965763', 'Aluminium Hydroxide gel', 3, '249.0000', '355.0000', '800.0000', 'no_image.png', 2, NULL, '', '', '', '', '', '', '10000.0000', 1, 1, '', NULL, 'code128', '', '<p>Dosage:1*3</p>', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '350.0000', '2022-09-13', '2022-09-27', '', NULL, NULL, NULL, NULL, 3, 3, 1, '81965763', 1, '250.0000', NULL, 0, 0, 'Ahg', 0),
(15, '79250038', 'Iron Dextran', 3, '100.0000', '150.0000', '2500.0000', 'no_image.png', 3, NULL, '', '', '', '', '', '', '5000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 3, 3, 1, '79250038', 1, '125.0000', NULL, 0, 0, '', 0),
(16, '92257284', 'Deferoxamine', 3, '500.0000', '1000.0000', '1800.0000', 'no_image.png', 3, NULL, '', '', '', '', '', '', '5000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '999.0000', '2022-09-17', '2022-09-29', '', NULL, NULL, NULL, NULL, 3, 3, 5, '92257284', 1, '250.0000', NULL, 0, 0, 'Dx', 0),
(17, '66845984', 'Folic acid', 3, '750.0000', '1000.0000', '1500.0000', 'no_image.png', 3, NULL, '', '', '', '', '', '', '5000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 3, 3, 1, '66845984', 1, '125.0000', NULL, 0, 0, 'Fa', 0),
(18, '59005628', 'Paxil (paroxetine)', 3, '200.0000', '430.0000', '1500.0000', 'no_image.png', 4, NULL, '', '', '', '', '', '', '5000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '400.0000', '2022-09-19', '2022-09-27', '', NULL, NULL, NULL, NULL, 3, 3, 8, '59005628', 1, '100.0000', NULL, 0, 0, 'Pp', 0),
(19, '67388129', 'Clozaril (clozapine)', 1, '4.0000', '10.0000', '100.0000', 'no_image.png', 4, NULL, '', '', '', '', '', '', '5000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 1, 6, '67388129', 1, '5.0000', NULL, 0, 0, 'Cc', 0),
(20, '99168487', ' Benedryl (diphenhydramine)', 3, '200.0000', '500.0000', '1000.0000', 'no_image.png', 4, NULL, '', '', '', '', '', '', '3500.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 3, 3, 3, 'benedryl-diphenhydramine', 1, '125.0000', NULL, 0, 0, 'bd', 0),
(21, '60490808', 'Ditropan (oxybutynin)', 3, '200.0000', '650.0000', '750.0000', 'no_image.png', 4, NULL, '', '', '', '', '', '', '3000.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 3, 3, 1, '60490808', 1, '200.0000', NULL, 0, 0, 'do', 0),
(22, '55911961', 'Norflex (orphenadrine)', 5, '9.0000', '15.0000', '100.0000', 'no_image.png', 4, NULL, '', '', '', '', '', '', '4500.0000', 1, 1, '', NULL, 'code128', '', '', 1, 'standard', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 5, 5, 6, '55911961', 1, '2.5000', NULL, 0, 0, 'No', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sma_product_photos`
--

CREATE TABLE `sma_product_photos` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_product_prices`
--

CREATE TABLE `sma_product_prices` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price_group_id` int(11) NOT NULL,
  `price` decimal(25,4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_product_variants`
--

CREATE TABLE `sma_product_variants` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `cost` decimal(25,4) DEFAULT NULL,
  `price` decimal(25,4) DEFAULT NULL,
  `quantity` decimal(15,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_promos`
--

CREATE TABLE `sma_promos` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `product2buy` int(11) NOT NULL,
  `product2get` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_purchases`
--

CREATE TABLE `sma_purchases` (
  `id` int(11) NOT NULL,
  `reference_no` varchar(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `supplier_id` int(11) NOT NULL,
  `supplier` varchar(55) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `note` varchar(1000) NOT NULL,
  `total` decimal(25,4) DEFAULT NULL,
  `product_discount` decimal(25,4) DEFAULT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `order_discount` decimal(25,4) DEFAULT NULL,
  `total_discount` decimal(25,4) DEFAULT NULL,
  `product_tax` decimal(25,4) DEFAULT NULL,
  `order_tax_id` int(11) DEFAULT NULL,
  `order_tax` decimal(25,4) DEFAULT NULL,
  `total_tax` decimal(25,4) DEFAULT 0.0000,
  `shipping` decimal(25,4) DEFAULT 0.0000,
  `grand_total` decimal(25,4) NOT NULL,
  `paid` decimal(25,4) NOT NULL DEFAULT 0.0000,
  `status` varchar(55) DEFAULT '',
  `payment_status` varchar(20) DEFAULT 'pending',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `payment_term` tinyint(4) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `return_id` int(11) DEFAULT NULL,
  `surcharge` decimal(25,4) NOT NULL DEFAULT 0.0000,
  `return_purchase_ref` varchar(55) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `return_purchase_total` decimal(25,4) NOT NULL DEFAULT 0.0000,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_purchase_items`
--

CREATE TABLE `sma_purchase_items` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `transfer_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `option_id` int(11) DEFAULT NULL,
  `net_unit_cost` decimal(25,4) NOT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(20) DEFAULT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `expiry` date DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `quantity_balance` decimal(15,4) DEFAULT 0.0000,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `unit_cost` decimal(25,4) DEFAULT NULL,
  `real_unit_cost` decimal(25,4) DEFAULT NULL,
  `quantity_received` decimal(15,4) DEFAULT NULL,
  `supplier_part_no` varchar(50) DEFAULT NULL,
  `purchase_item_id` int(11) DEFAULT NULL,
  `product_unit_id` int(11) DEFAULT NULL,
  `product_unit_code` varchar(10) DEFAULT NULL,
  `unit_quantity` decimal(15,4) NOT NULL,
  `gst` varchar(20) DEFAULT NULL,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL,
  `base_unit_cost` decimal(25,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_purchase_items`
--

INSERT INTO `sma_purchase_items` (`id`, `purchase_id`, `transfer_id`, `product_id`, `product_code`, `product_name`, `option_id`, `net_unit_cost`, `quantity`, `warehouse_id`, `item_tax`, `tax_rate_id`, `tax`, `discount`, `item_discount`, `expiry`, `subtotal`, `quantity_balance`, `date`, `status`, `unit_cost`, `real_unit_cost`, `quantity_received`, `supplier_part_no`, `purchase_item_id`, `product_unit_id`, `product_unit_code`, `unit_quantity`, `gst`, `cgst`, `sgst`, `igst`, `base_unit_cost`) VALUES
(1, NULL, NULL, 1, '24259676', 'Bread Loaf', NULL, '40.0000', '10.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '400.0000', '1.0000', '2022-07-15', 'received', '40.0000', '40.0000', '10.0000', NULL, NULL, 1, 'grams', '10.0000', NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, 2, '001', 'Decorative paint', NULL, '1100.0000', '10.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '11000.0000', '7.0000', '2022-09-15', 'received', '1100.0000', '1100.0000', '10.0000', NULL, NULL, 2, 'kg', '10.0000', NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, 3, '002', 'Varnishes', NULL, '1000.0000', '30.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '30000.0000', '29.0000', '2022-09-15', 'received', '1000.0000', '1000.0000', '30.0000', NULL, NULL, 2, 'kg', '30.0000', NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, 4, '003', 'Water Proofing solutions', NULL, '950.0000', '25.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '23750.0000', '25.0000', '2022-09-15', 'received', '950.0000', '950.0000', '25.0000', NULL, NULL, 2, 'kg', '25.0000', NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, 5, '004', 'Textured coatings', NULL, '550.0000', '24.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '13200.0000', '24.0000', '2022-09-15', 'received', '550.0000', '550.0000', '24.0000', NULL, NULL, 2, 'kg', '24.0000', NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, 6, '005', 'Industrial Flooring', NULL, '1100.0000', '15.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '16500.0000', '15.0000', '2022-09-15', 'received', '1100.0000', '1100.0000', '15.0000', NULL, NULL, 2, 'kg', '15.0000', NULL, NULL, NULL, NULL, NULL),
(7, NULL, NULL, 7, '006', 'Road Marking', NULL, '550.0000', '20.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '11000.0000', '39.0000', '2022-09-15', 'received', '550.0000', '550.0000', '20.0000', NULL, NULL, 2, 'kg', '20.0000', NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, 8, '81965763', 'Aluminium Hydroxide gel', NULL, '249.0000', '10000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '2490000.0000', '10000.0000', '2022-09-18', 'received', '249.0000', '249.0000', '10000.0000', NULL, NULL, 4, 'ml', '10000.0000', NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, 9, '73086706', 'Calcium Carbonate(Alka-Seltzer', NULL, '1.0000', '5000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '5000.0000', '5000.0000', '2022-09-18', 'received', '1.0000', '1.0000', '5000.0000', NULL, NULL, 1, 'grams', '5000.0000', NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, 10, '22632500', 'Magnesium Hydroxide(milk of magnesia)', NULL, '1375.0000', '5000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '6875000.0000', '5000.0000', '2022-09-18', 'received', '1375.0000', '1375.0000', '5000.0000', NULL, NULL, 1, 'grams', '5000.0000', NULL, NULL, NULL, NULL, NULL),
(11, NULL, NULL, 11, '66542564', 'Pepto-Bismol', NULL, '1100.0000', '10000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '11000000.0000', '10000.0000', '2022-09-18', 'received', '1100.0000', '1100.0000', '10000.0000', NULL, NULL, 4, 'ml', '10000.0000', NULL, NULL, NULL, NULL, NULL),
(12, NULL, NULL, 12, '51040882', 'Gariscon', NULL, '150.0000', '5000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '750000.0000', '5000.0000', '2022-09-18', 'received', '150.0000', '150.0000', '5000.0000', NULL, NULL, 4, 'ml', '5000.0000', NULL, NULL, NULL, NULL, NULL),
(13, NULL, NULL, 15, '79250038', 'Iron Dextran', NULL, '100.0000', '5000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '500000.0000', '5000.0000', '2022-09-18', 'received', '100.0000', '100.0000', '5000.0000', NULL, NULL, 1, 'grams', '5000.0000', NULL, NULL, NULL, NULL, NULL),
(14, NULL, NULL, 13, '35307740', 'Erythropoietin (Epoetin alpha)', NULL, '350.0000', '5000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '1750000.0000', '5000.0000', '2022-09-18', 'received', '350.0000', '350.0000', '5000.0000', NULL, NULL, 4, 'ml', '5000.0000', NULL, NULL, NULL, NULL, NULL),
(15, NULL, NULL, 14, '33506152', 'Ferrous Sulfate', NULL, '300.0000', '5000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '1500000.0000', '5000.0000', '2022-09-18', 'received', '300.0000', '300.0000', '5000.0000', NULL, NULL, 4, 'ml', '5000.0000', NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, 16, '92257284', 'Deferoxamine', NULL, '500.0000', '5000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '2500000.0000', '5000.0000', '2022-09-18', 'received', '500.0000', '500.0000', '5000.0000', NULL, NULL, 4, 'ml', '5000.0000', NULL, NULL, NULL, NULL, NULL),
(17, NULL, NULL, 17, '66845984', 'Folic acid', NULL, '750.0000', '5000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '3750000.0000', '5000.0000', '2022-09-18', 'received', '750.0000', '750.0000', '5000.0000', NULL, NULL, 4, 'ml', '5000.0000', NULL, NULL, NULL, NULL, NULL),
(18, NULL, NULL, 18, '59005628', 'Paxil (paroxetine)', NULL, '200.0000', '5000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '1000000.0000', '5000.0000', '2022-09-18', 'received', '200.0000', '200.0000', '5000.0000', NULL, NULL, 4, 'ml', '5000.0000', NULL, NULL, NULL, NULL, NULL),
(19, NULL, NULL, 19, '67388129', 'Clozaril (clozapine)', NULL, '4.0000', '5000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '20000.0000', '5000.0000', '2022-09-18', 'received', '4.0000', '4.0000', '5000.0000', NULL, NULL, 1, 'grams', '5000.0000', NULL, NULL, NULL, NULL, NULL),
(20, NULL, NULL, 20, '99168487', ' Benedryl (diphenhydramine)', NULL, '200.0000', '3500.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '700000.0000', '3500.0000', '2022-09-18', 'received', '200.0000', '200.0000', '3500.0000', NULL, NULL, 1, 'grams', '3500.0000', NULL, NULL, NULL, NULL, NULL),
(21, NULL, NULL, 21, '60490808', 'Ditropan (oxybutynin)', NULL, '200.0000', '3000.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '600000.0000', '3000.0000', '2022-09-18', 'received', '200.0000', '200.0000', '3000.0000', NULL, NULL, 4, 'ml', '3000.0000', NULL, NULL, NULL, NULL, NULL),
(22, NULL, NULL, 22, '55911961', 'Norflex (orphenadrine)', NULL, '9.0000', '4500.0000', 1, '0.0000', 1, '0', NULL, NULL, NULL, '40500.0000', '4500.0000', '2022-09-18', 'received', '9.0000', '9.0000', '4500.0000', NULL, NULL, 1, 'grams', '4500.0000', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_quotes`
--

CREATE TABLE `sma_quotes` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference_no` varchar(55) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer` varchar(55) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `biller_id` int(11) NOT NULL,
  `biller` varchar(55) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `internal_note` varchar(1000) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL,
  `product_discount` decimal(25,4) DEFAULT 0.0000,
  `order_discount` decimal(25,4) DEFAULT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `total_discount` decimal(25,4) DEFAULT 0.0000,
  `product_tax` decimal(25,4) DEFAULT 0.0000,
  `order_tax_id` int(11) DEFAULT NULL,
  `order_tax` decimal(25,4) DEFAULT NULL,
  `total_tax` decimal(25,4) DEFAULT NULL,
  `shipping` decimal(25,4) DEFAULT 0.0000,
  `grand_total` decimal(25,4) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `supplier` varchar(55) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_quotes`
--

INSERT INTO `sma_quotes` (`id`, `date`, `reference_no`, `customer_id`, `customer`, `warehouse_id`, `biller_id`, `biller`, `note`, `internal_note`, `total`, `product_discount`, `order_discount`, `order_discount_id`, `total_discount`, `product_tax`, `order_tax_id`, `order_tax`, `total_tax`, `shipping`, `grand_total`, `status`, `created_by`, `updated_by`, `updated_at`, `attachment`, `supplier_id`, `supplier`, `hash`, `cgst`, `sgst`, `igst`) VALUES
(2, '2022-09-18 13:09:00', '11123456', 7, 'Online-Customer', 1, 3, 'THE DOBET PHARMACY', '', NULL, '231000.0000', '0.0000', '0.0000', '0', '0.0000', '0.0000', 1, '0.0000', '0.0000', '200.0000', '231200.0000', 'pending', 1, NULL, NULL, NULL, 2, 'mel sip', '1348f214574c776693f711387a0947355b17bfb4a7c09220350567a6d8aefe18', NULL, NULL, NULL),
(3, '2022-09-27 09:07:00', '032', 10, '######Hotel', 1, 3, 'MAGNOCLOUD MANAGEMENT SYSTEMS', '', NULL, '300000.0000', '0.0000', '0.0000', '0.00', '0.0000', '0.0000', 1, '0.0000', '0.0000', '0.0000', '300000.0000', 'pending', 1, 1, '2022-09-27 09:46:53', NULL, 11, 'MAGNOCLOUD LIMITED', 'c58e9c3d43fc387400517629518638bddaa73f5007306da653275ed704bbfbe9', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_quote_items`
--

CREATE TABLE `sma_quote_items` (
  `id` int(11) NOT NULL,
  `quote_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(20) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `net_unit_price` decimal(25,4) NOT NULL,
  `unit_price` decimal(25,4) DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `real_unit_price` decimal(25,4) DEFAULT NULL,
  `product_unit_id` int(11) DEFAULT NULL,
  `product_unit_code` varchar(10) DEFAULT NULL,
  `unit_quantity` decimal(15,4) NOT NULL,
  `gst` varchar(20) DEFAULT NULL,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_quote_items`
--

INSERT INTO `sma_quote_items` (`id`, `quote_id`, `product_id`, `product_code`, `product_name`, `product_type`, `option_id`, `net_unit_price`, `unit_price`, `quantity`, `warehouse_id`, `item_tax`, `tax_rate_id`, `tax`, `discount`, `item_discount`, `subtotal`, `serial_no`, `real_unit_price`, `product_unit_id`, `product_unit_code`, `unit_quantity`, `gst`, `cgst`, `sgst`, `igst`) VALUES
(20, 3, 2147483647, '004', 'Restaurant Management Software(with KOT & BOT)', 'manual', 0, '50000.0000', '50000.0000', '1.0000', 1, '0.0000', 0, '', '0.00', '0.0000', '50000.0000', NULL, '50000.0000', 0, NULL, '1.0000', NULL, NULL, NULL, NULL),
(17, 3, 2147483647, '001', 'Micro Point Touch POS - All In One 15\"', 'manual', 0, '48000.0000', '48000.0000', '4.0000', 1, '0.0000', 0, '', '0.00', '0.0000', '192000.0000', NULL, '48000.0000', 3, 'pc', '4.0000', NULL, NULL, NULL, NULL),
(19, 3, 2147483647, '003', 'Cash Drawer', 'manual', 0, '7000.0000', '7000.0000', '1.0000', 1, '0.0000', 0, '', '0.00', '0.0000', '7000.0000', NULL, '7000.0000', 0, NULL, '1.0000', NULL, NULL, NULL, NULL),
(18, 3, 2147483647, '002', 'XPRINTER XP -K200L(USB+LAN)', 'manual', 0, '8500.0000', '8500.0000', '6.0000', 1, '0.0000', 0, '', '0.00', '0.0000', '51000.0000', NULL, '8500.0000', 0, NULL, '6.0000', NULL, NULL, NULL, NULL),
(8, 2, 2147483647, '22637800', 'Folic Acid', 'manual', 0, '250.0000', '250.0000', '24.0000', 1, '0.0000', 0, '', '0', '0.0000', '6000.0000', NULL, '250.0000', 0, NULL, '24.0000', NULL, NULL, NULL, NULL),
(7, 2, 2147483647, '22632500', 'Iron Dextron', 'manual', 0, '500.0000', '500.0000', '450.0000', 1, '0.0000', 1, '0', '0', '0.0000', '225000.0000', NULL, '500.0000', 3, 'pc', '450.0000', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_returns`
--

CREATE TABLE `sma_returns` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference_no` varchar(55) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer` varchar(55) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `biller` varchar(55) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `staff_note` varchar(1000) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL,
  `product_discount` decimal(25,4) DEFAULT 0.0000,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `total_discount` decimal(25,4) DEFAULT 0.0000,
  `order_discount` decimal(25,4) DEFAULT 0.0000,
  `product_tax` decimal(25,4) DEFAULT 0.0000,
  `order_tax_id` int(11) DEFAULT NULL,
  `order_tax` decimal(25,4) DEFAULT 0.0000,
  `total_tax` decimal(25,4) DEFAULT 0.0000,
  `grand_total` decimal(25,4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_items` smallint(6) DEFAULT NULL,
  `paid` decimal(25,4) DEFAULT 0.0000,
  `surcharge` decimal(25,4) NOT NULL DEFAULT 0.0000,
  `attachment` varchar(55) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL,
  `shipping` decimal(25,4) DEFAULT 0.0000
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_return_items`
--

CREATE TABLE `sma_return_items` (
  `id` int(11) NOT NULL,
  `return_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(20) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `net_unit_price` decimal(25,4) NOT NULL,
  `unit_price` decimal(25,4) DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `real_unit_price` decimal(25,4) DEFAULT NULL,
  `product_unit_id` int(11) DEFAULT NULL,
  `product_unit_code` varchar(10) DEFAULT NULL,
  `unit_quantity` decimal(15,4) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `gst` varchar(20) DEFAULT NULL,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_sales`
--

CREATE TABLE `sma_sales` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference_no` varchar(55) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer` varchar(55) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `biller` varchar(55) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `staff_note` varchar(1000) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL,
  `product_discount` decimal(25,4) DEFAULT 0.0000,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `total_discount` decimal(25,4) DEFAULT 0.0000,
  `order_discount` decimal(25,4) DEFAULT 0.0000,
  `product_tax` decimal(25,4) DEFAULT 0.0000,
  `order_tax_id` int(11) DEFAULT NULL,
  `order_tax` decimal(25,4) DEFAULT 0.0000,
  `total_tax` decimal(25,4) DEFAULT 0.0000,
  `shipping` decimal(25,4) DEFAULT 0.0000,
  `grand_total` decimal(25,4) NOT NULL,
  `sale_status` varchar(20) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `payment_term` tinyint(4) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_items` smallint(6) DEFAULT NULL,
  `pos` tinyint(1) NOT NULL DEFAULT 0,
  `paid` decimal(25,4) DEFAULT 0.0000,
  `return_id` int(11) DEFAULT NULL,
  `surcharge` decimal(25,4) NOT NULL DEFAULT 0.0000,
  `attachment` varchar(55) DEFAULT NULL,
  `return_sale_ref` varchar(55) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `return_sale_total` decimal(25,4) NOT NULL DEFAULT 0.0000,
  `rounding` decimal(10,4) DEFAULT NULL,
  `suspend_note` varchar(255) DEFAULT NULL,
  `api` tinyint(1) DEFAULT 0,
  `shop` tinyint(1) DEFAULT 0,
  `address_id` int(11) DEFAULT NULL,
  `reserve_id` int(11) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `manual_payment` varchar(55) DEFAULT NULL,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL,
  `payment_method` varchar(55) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_sale_items`
--

CREATE TABLE `sma_sale_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(20) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `net_unit_price` decimal(25,4) NOT NULL,
  `unit_price` decimal(25,4) DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `real_unit_price` decimal(25,4) DEFAULT NULL,
  `sale_item_id` int(11) DEFAULT NULL,
  `product_unit_id` int(11) DEFAULT NULL,
  `product_unit_code` varchar(10) DEFAULT NULL,
  `unit_quantity` decimal(15,4) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `gst` varchar(20) DEFAULT NULL,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_sessions`
--

CREATE TABLE `sma_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_sessions`
--

INSERT INTO `sma_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('jdluk7odu1clmfq3nfafq8nl9q5phpou', '::1', 1664272078, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237323037383b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('buutqttha9k24amlnp204htb0e3vvlg9', '::1', 1664272078, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237323037383b),
('4ln2f0qe8jjrc2agku611ge5k8eu5rns', '::1', 1664272081, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237323031333b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633373632303532223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636343236383738343b),
('krrbthp98far47csj3oo3e57t0lv140m', '::1', 1664272077, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237323037373b),
('kqvrf73o9jhia5so4kjoivi355biplf9', '::1', 1664272013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237323031333b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633373632303532223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636343236383738343b),
('gu1u9gnudgnucerlks7gsu4pdr7ndqau', '::1', 1664271699, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237313639393b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633373632303532223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636343236383738343b),
('48lnhjfupfljoe628cmrh3k4346c4irc', '::1', 1664270412, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237303431323b),
('57d080b9shhc6tbtdoe6l6ptf1bui35v', '::1', 1664271388, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237313338383b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633373632303532223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636343236383738343b72656d6f76655f71756c737c733a313a2231223b),
('ve25qj22lq57t9umvv5e75tmmr0lplp5', '::1', 1664270240, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237303234303b),
('mjigsqvdeo2ars6v60vmqftdijbm5t9q', '::1', 1664270411, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237303431313b),
('fh57jkr1gotb0jp7l2jhodvhn8cb7grh', '::1', 1664270411, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237303431313b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('qvucduk4aqsjm9mtanr5g5a6eoh6am90', '::1', 1664270238, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237303233383b),
('5llgur0q20gnjbp2eao9f73svct0kcfd', '::1', 1664270240, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237303234303b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('8lhd60gs9akqnnug23meommfl1tsk70e', '::1', 1664270917, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237303931373b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633373632303532223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636343236383738343b),
('0qtv7tmtv1dcj3ob52gj9nlju1vm952u', '::1', 1664270169, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343237303136393b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633373632303532223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636343236383738343b),
('e4fado3v6t1th371s40o1r4uiav2iro4', '::1', 1664268532, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343236383533323b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633373632303532223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636343236373930343b),
('esdss1io728p5jn20ua1mo21uc2fs6ep', '::1', 1664269392, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636343236393339323b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633373632303532223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636343236383738343b),
('ea7b74cki1qq8n5t91maqri0re79qd84', '::1', 1663762052, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333736323034323b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633373631363736223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d),
('umigop121ttki48okt849bat79d6sh43', '::1', 1663762042, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333736323034323b7265717565737465645f706167657c733a31333a2273686f702f70726f6475637473223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633373630373931223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b637372666b65797c733a383a225770783448774645223b5f5f63695f766172737c613a323a7b733a373a22637372666b6579223b733a333a226e6577223b733a393a226373726676616c7565223b733a333a226e6577223b7d6373726676616c75657c733a32303a225641324f39797447316248684d304b69534e786c223b),
('8eqvnv9817gk5dtnhhbtcer92cpj07hl', '::1', 1663761346, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333736313334363b),
('rfcmarghqatjcsl7luvpiec7pgk4iq6b', '::1', 1663761676, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333736313637363b7265717565737465645f706167657c733a31333a22636172742f636865636b6f7574223b),
('e4h3o976pkmu5pm878ubg52ml2bnos06', '::1', 1663761295, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333736313239353b),
('9e5snlmi7gv1ilgh6vki0lq562dpg9qe', '::1', 1663761296, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333736313239363b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('dbkh3rps7hff4jkefl3l1nncm9hm07ea', '::1', 1663761296, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333736313239363b),
('c2kcgkdcolocfalt5kkqv06ug6tqn1p1', '::1', 1663761191, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333736313139313b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633353035343335223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333736303937323b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b72656d6f76655f706f736c737c693a313b),
('g54691ddvocnb77qcqbjc0p0nh4al0vu', '::1', 1663760556, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333736303535363b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('ke66f53rp4507gohv36tsi80jchuji7b', '::1', 1663761345, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333736313334353b),
('qutso602lgtl9hal7gujbsf8hdt1eopo', '::1', 1663761346, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333736313334363b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('lkvfunjre7hvl061atico9q7uhuidon7', '::1', 1663525157, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532353037313b7265717565737465645f706167657c733a31313a226272616e642f617370656e223b6964656e746974797c733a353a22646f626574223b757365726e616d657c733a353a22646f626574223b656d61696c7c733a32353a2261646d696e40646f626574706861726d6163792e636f2e6b65223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633353138353737223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2232223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b68696464656e317c693a313b),
('vo5qvqtiukm16enhnou0uaqauqvea1q6', '::1', 1663524293, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532343239333b),
('jcjib88g3vbeed15rsc9ta82nl7ij79e', '::1', 1663525071, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532353037313b7265717565737465645f706167657c733a31313a226272616e642f617370656e223b6964656e746974797c733a353a22646f626574223b757365726e616d657c733a353a22646f626574223b656d61696c7c733a32353a2261646d696e40646f626574706861726d6163792e636f2e6b65223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633353138353737223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2232223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b68696464656e317c693a313b),
('4ou9680dl2rsgtad55j9er4r0he1t137', '::1', 1663524746, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532343734363b7265717565737465645f706167657c733a31313a226272616e642f617370656e223b),
('napabhmoo7embdjap56kef8m8dt7oe5h', '::1', 1663524235, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532343233343b),
('r2rb03714bciha987mbjhkbi7i2pvtgd', '::1', 1663524236, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532343233363b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('8h0cdq6vb35kgt90r46c72qv6i8veje1', '::1', 1663524236, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532343233363b),
('sa16qp5gfiuat5hsaechscoo3pkbj9kd', '::1', 1663524293, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532343239333b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('fk8hjoilgup0qb6lhia34abmq8ut48al', '::1', 1663524293, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532343239323b),
('ik7i9deee01mj7a6ifmlaf10eht8pdgk', '::1', 1663520898, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532303839383b6964656e746974797c733a353a2273616c6573223b757365726e616d657c733a353a2273616c6573223b656d61696c7c733a32303a22746573746173616c657340676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363538303931383330223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2235223b77617265686f7573655f69647c733a313a2231223b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c733a313a2233223b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b68696464656e317c693a313b6c6173745f61637469766974797c693a313636333531393334373b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31382030303a30343a3030223b7265717565737465645f706167657c733a343a2263617274223b),
('vkf3ucnhct8kgf3eg4toi4uooi7i9l5t', '::1', 1663524080, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532343038303b6964656e746974797c733a353a2273616c6573223b757365726e616d657c733a353a2273616c6573223b656d61696c7c733a32303a22746573746173616c657340676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363538303931383330223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2235223b77617265686f7573655f69647c733a313a2231223b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c733a313a2233223b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b68696464656e317c693a313b6c6173745f61637469766974797c693a313636333531393334373b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31382030303a30343a3030223b7265717565737465645f706167657c733a343a2263617274223b),
('kakn3g0agkvnm0tt7uvmlnnvtoop4t10', '::1', 1663506809, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363830393b),
('3c92456un34fpfc8mcc79dp44rusvkel', '::1', 1663506813, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363831333b),
('juvlt5eof5ikmncq2mm4ojsptbf30ikj', '::1', 1663506813, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363831333b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('6f8kb4410vujgocpukrgf2es20q1h6k4', '::1', 1663506803, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363830333b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('hfnjdtp7c98qlbtmin8ebrg41avh1p1a', '::1', 1663506803, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363830333b),
('tr967q4to8435a64uubkmpliea63a9in', '::1', 1663506808, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363830383b),
('eu6hqnjv933qnb88gsj9ro7507k076nu', '::1', 1663506808, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363830383b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('mut59g31jfrn8cgob01ki25jtt1d5u8h', '::1', 1663506795, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363739343b),
('lm8c7ueo08s6htdhujvb83fefgqsjcqf', '::1', 1663506796, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363739363b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('cb7jo3kama29o6ud8btu8g8kab7ktqr2', '::1', 1663506796, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363739363b),
('laecnj5lqngq6fsq1idu0s8bi4jv4dqi', '::1', 1663506803, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363830333b),
('sna2sjm6raa5chkbi5bcbq4sh10a9k5c', '::1', 1663506749, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363734393b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343934303236223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333530363335393b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b),
('6bogutcd3mr0bgilr9qvfqvmqpor8261', '::1', 1663505727, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530353732373b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343934303236223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('dolbacjte3774bnmgnj4bkh550rmi8dp', '::1', 1663506043, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363034333b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343934303236223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('ed2s04gpursoi011k0neoa22koge0t0v', '::1', 1663506359, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363335393b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343934303236223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333530363330373b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b72656d6f76655f706f736c737c693a313b),
('gqh8laopk1ulhrpkv1ua2vmhp4gols1l', '::1', 1663505192, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530353139323b6964656e746974797c733a353a22646f626574223b757365726e616d657c733a353a22646f626574223b656d61696c7c733a32353a2261646d696e40646f626574706861726d6163792e636f2e6b65223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343830373238223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2232223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b68696464656e317c693a313b6c6173745f61637469766974797c693a313636333530343931353b72656769737465725f69647c733a313a2234223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30392d31372032303a32353a3136223b72656d6f76655f706f736c737c693a313b),
('5upbdvjt0ki0q1ka8e2jupq5pn5smkmb', '::1', 1663504524, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530343532343b6964656e746974797c733a353a22646f626574223b757365726e616d657c733a353a22646f626574223b656d61696c7c733a32353a2261646d696e40646f626574706861726d6163792e636f2e6b65223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343830373238223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2232223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b68696464656e317c693a313b),
('778l74he992p8m3m3co16d55mkhlqsbm', '::1', 1663504825, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530343832353b6964656e746974797c733a353a22646f626574223b757365726e616d657c733a353a22646f626574223b656d61696c7c733a32353a2261646d696e40646f626574706861726d6163792e636f2e6b65223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343830373238223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2232223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b68696464656e317c693a313b),
('d1i2r4mg83vi2grm0p1l7cneipo4tpv8', '::1', 1663504067, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530343036373b7265717565737465645f706167657c733a33323a2261646d696e2f73797374656d5f73657474696e67732f63617465676f72696573223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343832333431223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333530333735353b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b),
('hm0nvl1638uv9tk6bf3n5h9stdpncu9o', '::1', 1663503662, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530333636323b7265717565737465645f706167657c733a33323a2261646d696e2f73797374656d5f73657474696e67732f63617465676f72696573223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343832333431223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333530313430383b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b),
('pbcko2kaum37unqgirsgr0qfc43ja639', '::1', 1663507755, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530373735353b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343934303236223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333530363937383b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b),
('pgve6mju58kcgmpa71qkgjvmh1ktjbve', '::1', 1663519568, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333531393536383b6964656e746974797c733a353a2273616c6573223b757365726e616d657c733a353a2273616c6573223b656d61696c7c733a32303a22746573746173616c657340676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363538303931383330223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2235223b77617265686f7573655f69647c733a313a2231223b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c733a313a2233223b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b68696464656e317c693a313b6c6173745f61637469766974797c693a313636333531393334373b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31382030303a30343a3030223b),
('7a8h2dkimpoem0rk66q37vjuut9n955s', '::1', 1663520050, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333532303035303b6964656e746974797c733a353a2273616c6573223b757365726e616d657c733a353a2273616c6573223b656d61696c7c733a32303a22746573746173616c657340676d61696c2e636f6d223b757365725f69647c733a313a2232223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363538303931383330223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2235223b77617265686f7573655f69647c733a313a2231223b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c733a313a2233223b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b68696464656e317c693a313b6c6173745f61637469766974797c693a313636333531393334373b72656769737465725f69647c733a313a2232223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31382030303a30343a3030223b7265717565737465645f706167657c733a343a2263617274223b),
('nj9gu96nisj86jfv4f0qlj1mp89jmsg7', '::1', 1663518893, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333531383839333b6964656e746974797c733a353a22646f626574223b757365726e616d657c733a353a22646f626574223b656d61696c7c733a32353a2261646d696e40646f626574706861726d6163792e636f2e6b65223b757365725f69647c733a313a2234223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633353034323634223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2232223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b68696464656e317c693a313b6c6173745f61637469766974797c693a313636333531383738343b),
('j5n3rg8romadf7599qf54h4eo6otr4ip', '::1', 1663507755, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530373735353b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343934303236223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333530363937383b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b),
('t6u74rnrjm2hks1okfvpgrkev4givink', '::1', 1663506818, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363831383b),
('5hnnbtmihupm855ugbe1219qu9kj98t4', '::1', 1663506814, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363831343b),
('d3q8eme46csc1n9jai9lifisd0l92oa8', '::1', 1663506817, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363831373b),
('36mj58ldtcajmbf1t5dq9m0a3jc01o36', '::1', 1663506817, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530363831373b6572726f727c733a37363a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226e6577223b7d),
('f50u0jo3fg5ga8m0tvlpqkp4t1a547s9', '::1', 1663500083, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530303038333b7265717565737465645f706167657c733a33323a2261646d696e2f73797374656d5f73657474696e67732f63617465676f72696573223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343832333431223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('u90q3vk3apqqkmk4qqi78np9297mr3lu', '::1', 1663500529, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530303532393b7265717565737465645f706167657c733a33323a2261646d696e2f73797374656d5f73657474696e67732f63617465676f72696573223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343832333431223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('5t64nf74n012s4mlc709nlsbsa6kfmob', '::1', 1663500899, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530303839393b7265717565737465645f706167657c733a33323a2261646d696e2f73797374656d5f73657474696e67732f63617465676f72696573223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343832333431223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('gfft0jdubp3rkaif46erj0qs401cktg9', '::1', 1663501294, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530313239343b7265717565737465645f706167657c733a33323a2261646d696e2f73797374656d5f73657474696e67732f63617465676f72696573223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343832333431223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('ggo17lv4l8tlesbhvfpvqu3ut6bnbh4a', '::1', 1663501655, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530313635353b7265717565737465645f706167657c733a33323a2261646d696e2f73797374656d5f73657474696e67732f63617465676f72696573223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343832333431223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333530313430383b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b),
('tots2tofdf6hln56aq74tno26e7jn5nd', '::1', 1663502029, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530323032393b7265717565737465645f706167657c733a33323a2261646d696e2f73797374656d5f73657474696e67732f63617465676f72696573223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343832333431223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333530313430383b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b),
('kvsffj98rva1d972jbr3cikotka6ljt0', '::1', 1663502433, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530323433333b7265717565737465645f706167657c733a33323a2261646d696e2f73797374656d5f73657474696e67732f63617465676f72696573223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343832333431223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333530313430383b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b),
('ffcrhfcb7bqsui27knmh4ntr8jp16kjg', '::1', 1663502811, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530323831313b7265717565737465645f706167657c733a33323a2261646d696e2f73797374656d5f73657474696e67732f63617465676f72696573223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343832333431223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333530313430383b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b),
('5l5i9q9ootj3585as9i88tbm13b909ml', '::1', 1663503203, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636333530333230333b7265717565737465645f706167657c733a33323a2261646d696e2f73797374656d5f73657474696e67732f63617465676f72696573223b6964656e746974797c733a353a2261646d696e223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363633343832333431223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636333530313430383b72656769737465725f69647c733a313a2231223b636173685f696e5f68616e647c733a363a22302e30303030223b72656769737465725f6f70656e5f74696d657c733a31393a22323032322d30372d31352031323a34393a3035223b),
('t8n6v9v3i8hvf6fmda4bg0mmm4rte23k', '::1', 1665003940, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636353030333934303b6964656e746974797c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363634323637383533223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636353030333831323b),
('tik6e82k3chj71j19unjilu2dpea3do6', '::1', 1665004155, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636353030333934303b6964656e746974797c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363634323637383533223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6c6173745f61637469766974797c693a313636353030343036373b),
('t5lnib9rfto0um1n2j5macn5hljspech', '::1', 1665034285, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636353033343238353b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363635303033353931223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('utc131iqsksa0ufo2v5crbmat1bhqvt7', '::1', 1665034748, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636353033343734383b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363635303033353931223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('rucprqnd9f7or5nq3bbehojkfoov5i5o', '::1', 1665035564, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636353033353536343b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363635303033353931223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d);
INSERT INTO `sma_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('k9fsk6tv4f5n5bj45d8tv94506rf70q7', '::1', 1665035667, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636353033353536343b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365726e616d657c733a353a2261646d696e223b656d61696c7c733a32333a226e67696e67616465727269636b40676d61696c2e636f6d223b757365725f69647c733a313a2231223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231363635303033353931223b6c6173745f69707c733a333a223a3a31223b6176617461727c4e3b67656e6465727c733a343a226d616c65223b67726f75705f69647c733a313a2231223b77617265686f7573655f69647c4e3b766965775f72696768747c733a313a2230223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b);

-- --------------------------------------------------------

--
-- Table structure for table `sma_settings`
--

CREATE TABLE `sma_settings` (
  `setting_id` int(1) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `logo2` varchar(255) NOT NULL,
  `site_name` varchar(55) NOT NULL,
  `language` varchar(20) NOT NULL,
  `default_warehouse` int(2) NOT NULL,
  `accounting_method` tinyint(4) NOT NULL DEFAULT 0,
  `default_currency` varchar(3) NOT NULL,
  `default_tax_rate` int(2) NOT NULL,
  `rows_per_page` int(2) NOT NULL,
  `version` varchar(10) NOT NULL DEFAULT '1.0',
  `default_tax_rate2` int(11) NOT NULL DEFAULT 0,
  `dateformat` int(11) NOT NULL,
  `sales_prefix` varchar(20) DEFAULT NULL,
  `quote_prefix` varchar(20) DEFAULT NULL,
  `purchase_prefix` varchar(20) DEFAULT NULL,
  `transfer_prefix` varchar(20) DEFAULT NULL,
  `delivery_prefix` varchar(20) DEFAULT NULL,
  `payment_prefix` varchar(20) DEFAULT NULL,
  `return_prefix` varchar(20) DEFAULT NULL,
  `returnp_prefix` varchar(20) DEFAULT NULL,
  `expense_prefix` varchar(20) DEFAULT NULL,
  `item_addition` tinyint(1) NOT NULL DEFAULT 0,
  `theme` varchar(20) NOT NULL,
  `product_serial` tinyint(4) NOT NULL,
  `default_discount` int(11) NOT NULL,
  `product_discount` tinyint(1) NOT NULL DEFAULT 0,
  `discount_method` tinyint(4) NOT NULL,
  `tax1` tinyint(4) NOT NULL,
  `tax2` tinyint(4) NOT NULL,
  `overselling` tinyint(1) NOT NULL DEFAULT 0,
  `restrict_user` tinyint(4) NOT NULL DEFAULT 0,
  `restrict_calendar` tinyint(4) NOT NULL DEFAULT 0,
  `timezone` varchar(100) DEFAULT NULL,
  `iwidth` int(11) NOT NULL DEFAULT 0,
  `iheight` int(11) NOT NULL,
  `twidth` int(11) NOT NULL,
  `theight` int(11) NOT NULL,
  `watermark` tinyint(1) DEFAULT NULL,
  `reg_ver` tinyint(1) DEFAULT NULL,
  `allow_reg` tinyint(1) DEFAULT NULL,
  `reg_notification` tinyint(1) DEFAULT NULL,
  `auto_reg` tinyint(1) DEFAULT NULL,
  `protocol` varchar(20) NOT NULL DEFAULT 'mail',
  `mailpath` varchar(55) DEFAULT '/usr/sbin/sendmail',
  `smtp_host` varchar(100) DEFAULT NULL,
  `smtp_user` varchar(100) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(10) DEFAULT '25',
  `smtp_crypto` varchar(10) DEFAULT NULL,
  `corn` datetime DEFAULT NULL,
  `customer_group` int(11) NOT NULL,
  `default_email` varchar(100) NOT NULL,
  `mmode` tinyint(1) NOT NULL,
  `bc_fix` tinyint(4) NOT NULL DEFAULT 0,
  `auto_detect_barcode` tinyint(1) NOT NULL DEFAULT 0,
  `captcha` tinyint(1) NOT NULL DEFAULT 1,
  `reference_format` tinyint(1) NOT NULL DEFAULT 1,
  `racks` tinyint(1) DEFAULT 0,
  `attributes` tinyint(1) NOT NULL DEFAULT 0,
  `product_expiry` tinyint(1) NOT NULL DEFAULT 0,
  `decimals` tinyint(2) NOT NULL DEFAULT 2,
  `qty_decimals` tinyint(2) NOT NULL DEFAULT 2,
  `decimals_sep` varchar(2) NOT NULL DEFAULT '.',
  `thousands_sep` varchar(2) NOT NULL DEFAULT ',',
  `invoice_view` tinyint(1) DEFAULT 0,
  `default_biller` int(11) DEFAULT NULL,
  `envato_username` varchar(50) DEFAULT NULL,
  `purchase_code` varchar(100) DEFAULT NULL,
  `rtl` tinyint(1) DEFAULT 0,
  `each_spent` decimal(15,4) DEFAULT NULL,
  `ca_point` tinyint(4) DEFAULT NULL,
  `each_sale` decimal(15,4) DEFAULT NULL,
  `sa_point` tinyint(4) DEFAULT NULL,
  `update` tinyint(1) DEFAULT 0,
  `sac` tinyint(1) DEFAULT 0,
  `display_all_products` tinyint(1) DEFAULT 0,
  `display_symbol` tinyint(1) DEFAULT NULL,
  `symbol` varchar(50) DEFAULT NULL,
  `remove_expired` tinyint(1) DEFAULT 0,
  `barcode_separator` varchar(2) NOT NULL DEFAULT '-',
  `set_focus` tinyint(1) NOT NULL DEFAULT 0,
  `price_group` int(11) DEFAULT NULL,
  `barcode_img` tinyint(1) NOT NULL DEFAULT 1,
  `ppayment_prefix` varchar(20) DEFAULT 'POP',
  `disable_editing` smallint(6) DEFAULT 90,
  `qa_prefix` varchar(55) DEFAULT NULL,
  `update_cost` tinyint(1) DEFAULT NULL,
  `apis` tinyint(1) NOT NULL DEFAULT 0,
  `state` varchar(100) DEFAULT NULL,
  `pdf_lib` varchar(20) DEFAULT 'dompdf',
  `use_code_for_slug` tinyint(1) DEFAULT NULL,
  `ws_barcode_type` varchar(10) DEFAULT 'weight',
  `ws_barcode_chars` tinyint(4) DEFAULT NULL,
  `flag_chars` tinyint(4) DEFAULT NULL,
  `item_code_start` tinyint(4) DEFAULT NULL,
  `item_code_chars` tinyint(4) DEFAULT NULL,
  `price_start` tinyint(4) DEFAULT NULL,
  `price_chars` tinyint(4) DEFAULT NULL,
  `price_divide_by` int(11) DEFAULT NULL,
  `weight_start` tinyint(4) DEFAULT NULL,
  `weight_chars` tinyint(4) DEFAULT NULL,
  `weight_divide_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_settings`
--

INSERT INTO `sma_settings` (`setting_id`, `logo`, `logo2`, `site_name`, `language`, `default_warehouse`, `accounting_method`, `default_currency`, `default_tax_rate`, `rows_per_page`, `version`, `default_tax_rate2`, `dateformat`, `sales_prefix`, `quote_prefix`, `purchase_prefix`, `transfer_prefix`, `delivery_prefix`, `payment_prefix`, `return_prefix`, `returnp_prefix`, `expense_prefix`, `item_addition`, `theme`, `product_serial`, `default_discount`, `product_discount`, `discount_method`, `tax1`, `tax2`, `overselling`, `restrict_user`, `restrict_calendar`, `timezone`, `iwidth`, `iheight`, `twidth`, `theight`, `watermark`, `reg_ver`, `allow_reg`, `reg_notification`, `auto_reg`, `protocol`, `mailpath`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `smtp_crypto`, `corn`, `customer_group`, `default_email`, `mmode`, `bc_fix`, `auto_detect_barcode`, `captcha`, `reference_format`, `racks`, `attributes`, `product_expiry`, `decimals`, `qty_decimals`, `decimals_sep`, `thousands_sep`, `invoice_view`, `default_biller`, `envato_username`, `purchase_code`, `rtl`, `each_spent`, `ca_point`, `each_sale`, `sa_point`, `update`, `sac`, `display_all_products`, `display_symbol`, `symbol`, `remove_expired`, `barcode_separator`, `set_focus`, `price_group`, `barcode_img`, `ppayment_prefix`, `disable_editing`, `qa_prefix`, `update_cost`, `apis`, `state`, `pdf_lib`, `use_code_for_slug`, `ws_barcode_type`, `ws_barcode_chars`, `flag_chars`, `item_code_start`, `item_code_chars`, `price_start`, `price_chars`, `price_divide_by`, `weight_start`, `weight_chars`, `weight_divide_by`) VALUES
(1, 'LiqourboxA.png', 'LiqourboxA1.png', 'FANCY LIQOUR BOX', 'english', 1, 0, 'KES', 1, 10, '3.4.47', 1, 5, 'SALE', 'QUOTE', 'PO', 'TR', 'DO', 'IPAY', 'SR', 'PR', '', 0, 'default', 1, 1, 1, 1, 1, 1, 0, 1, 0, 'Africa/Nairobi', 800, 800, 150, 150, 0, 0, 0, 0, NULL, 'mail', '/usr/sbin/sendmail', 'pop.gmail.com', 'contact@sma.tecdiary.org', '29882833', '25', NULL, NULL, 1, 'info@fancyliqourbox.com', 0, 4, 1, 0, 2, 1, 1, 0, 2, 2, '.', ',', 0, 3, 'denniso93', 'gdhdhddfhdjdjdbhdjsd', 0, '100.0000', 1, '5000.0000', 1, 0, 0, 0, 0, '', 0, '-', 0, 1, 1, 'POP', 90, '', 0, 1, 'AN', 'dompdf', 0, 'weight', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sma_shop_settings`
--

CREATE TABLE `sma_shop_settings` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(55) NOT NULL,
  `description` varchar(160) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `biller` int(11) NOT NULL,
  `about_link` varchar(55) NOT NULL,
  `terms_link` varchar(55) NOT NULL,
  `privacy_link` varchar(55) NOT NULL,
  `contact_link` varchar(55) NOT NULL,
  `payment_text` varchar(100) NOT NULL,
  `follow_text` varchar(100) NOT NULL,
  `facebook` varchar(55) NOT NULL,
  `twitter` varchar(55) DEFAULT NULL,
  `google_plus` varchar(55) DEFAULT NULL,
  `instagram` varchar(55) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `cookie_message` varchar(180) DEFAULT NULL,
  `cookie_link` varchar(55) DEFAULT NULL,
  `slider` text DEFAULT NULL,
  `shipping` int(11) DEFAULT NULL,
  `purchase_code` varchar(100) DEFAULT 'purchase_code',
  `envato_username` varchar(50) DEFAULT 'envato_username',
  `version` varchar(10) DEFAULT '3.4.47',
  `logo` varchar(55) DEFAULT NULL,
  `bank_details` varchar(255) DEFAULT NULL,
  `products_page` tinyint(1) DEFAULT NULL,
  `hide0` tinyint(1) DEFAULT 0,
  `products_description` varchar(255) DEFAULT NULL,
  `private` tinyint(1) DEFAULT 0,
  `hide_price` tinyint(1) DEFAULT 0,
  `stripe` tinyint(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_shop_settings`
--

INSERT INTO `sma_shop_settings` (`shop_id`, `shop_name`, `description`, `warehouse`, `biller`, `about_link`, `terms_link`, `privacy_link`, `contact_link`, `payment_text`, `follow_text`, `facebook`, `twitter`, `google_plus`, `instagram`, `phone`, `email`, `cookie_message`, `cookie_link`, `slider`, `shipping`, `purchase_code`, `envato_username`, `version`, `logo`, `bank_details`, `products_page`, `hide0`, `products_description`, `private`, `hide_price`, `stripe`) VALUES
(1, 'THE FANCY LIQOUR BOX', 'LIQOUR BOX - AFFORDABLE LIQOUR NEXT DOOR', 1, 3, '', '', '', '', 'We accept MPESA Payment ', 'Please click the link below to follow us on social media.', 'https://www.facebook.com/fancyliqourbox', 'https://www.facebook.com/fancylqourbox', '', '', '0710943017', 'info@fancyliqourbox.com', 'We use cookies to improve your experience on our website. By browsing this website, you agree to our use of cookies.', '', '[{\"image\":\"72bf61db20fa377fb637d42372be1c1c.png\",\"link\":\"https:\\/\\/www.instagram.com\\/magno_cloud.13?r=nametag\",\"caption\":\"\"},{\"image\":\"109cde393dee2c7b66fcedac08d06aa2.png\",\"link\":\"https:\\/\\/www.instagram.com\\/magno_cloud.13?r=nametag\",\"caption\":\"\"},{\"image\":\"12f802d3d21681a2645aba96d1a6e98b.png\",\"link\":\"https:\\/\\/www.instagram.com\\/magno_cloud.13?r=nametag\",\"caption\":\"\"},{\"image\":\"fc198862b1613c395df36f9b3a32619e.png\",\"link\":\"https:\\/\\/www.instagram.com\\/magno_cloud.13?r=nametag\",\"caption\":\"\"},{\"image\":\"83326ba824748a7b89752db12f22fd89.png\",\"link\":\"https:\\/\\/www.instagram.com\\/magno_cloud.13?r=nametag\",\"caption\":\"\"}]', 0, '', 'envato_username', '3.4.47', 'LiqourboxA2.png', '', 1, 0, 'Buy Quality Liqour at the comfort of your home', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sma_skrill`
--

CREATE TABLE `sma_skrill` (
  `id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `account_email` varchar(255) NOT NULL DEFAULT 'testaccount2@moneybookers.com',
  `secret_word` varchar(20) NOT NULL DEFAULT 'mbtest',
  `skrill_currency` varchar(3) NOT NULL DEFAULT 'USD',
  `fixed_charges` decimal(25,4) NOT NULL DEFAULT 0.0000,
  `extra_charges_my` decimal(25,4) NOT NULL DEFAULT 0.0000,
  `extra_charges_other` decimal(25,4) NOT NULL DEFAULT 0.0000
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_skrill`
--

INSERT INTO `sma_skrill` (`id`, `active`, `account_email`, `secret_word`, `skrill_currency`, `fixed_charges`, `extra_charges_my`, `extra_charges_other`) VALUES
(1, 1, 'testaccount2@moneybookers.com', 'mbtest', 'USD', '0.0000', '0.0000', '0.0000');

-- --------------------------------------------------------

--
-- Table structure for table `sma_sms_settings`
--

CREATE TABLE `sma_sms_settings` (
  `id` int(11) NOT NULL,
  `auto_send` tinyint(1) DEFAULT NULL,
  `config` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_sms_settings`
--

INSERT INTO `sma_sms_settings` (`id`, `auto_send`, `config`) VALUES
(1, NULL, '{\"gateway\":\"Log\",\"Log\":{}');

-- --------------------------------------------------------

--
-- Table structure for table `sma_stock_counts`
--

CREATE TABLE `sma_stock_counts` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reference_no` varchar(55) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `initial_file` varchar(50) NOT NULL,
  `final_file` varchar(50) DEFAULT NULL,
  `brands` varchar(50) DEFAULT NULL,
  `brand_names` varchar(100) DEFAULT NULL,
  `categories` varchar(50) DEFAULT NULL,
  `category_names` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `products` int(11) DEFAULT NULL,
  `rows` int(11) DEFAULT NULL,
  `differences` int(11) DEFAULT NULL,
  `matches` int(11) DEFAULT NULL,
  `missing` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `finalized` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_stock_counts`
--

INSERT INTO `sma_stock_counts` (`id`, `date`, `reference_no`, `warehouse_id`, `type`, `initial_file`, `final_file`, `brands`, `brand_names`, `categories`, `category_names`, `note`, `products`, `rows`, `differences`, `matches`, `missing`, `created_by`, `updated_by`, `updated_at`, `finalized`) VALUES
(1, '2022-09-15 13:06:00', '', 1, 'full', 'd661ddad05b81ee8d15d3238026046ab.csv', NULL, '', '', '', '', NULL, 1, 1, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(2, '2022-09-15 13:10:00', '', 1, 'partial', '4ae9ad854d48747f8f95f3cd1f062233.csv', NULL, '', '', '1', 'Category 1', NULL, 1, 1, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(3, '2022-09-15 13:31:00', '', 1, 'full', 'e400bef246bef9c950c995705c0a7d34.csv', NULL, '', '', '', '', NULL, 6, 6, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(4, '2022-09-15 13:33:00', '', 1, 'full', '40f1408bc2d61ebe93c50e8795a9ca25.csv', NULL, '', '', '', '', NULL, 6, 6, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(5, '2022-09-15 14:30:00', '', 1, 'full', '32644be94a3debcc7cd935b24d509724.csv', NULL, '', '', '', '', NULL, 6, 6, NULL, NULL, NULL, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_stock_count_items`
--

CREATE TABLE `sma_stock_count_items` (
  `id` int(11) NOT NULL,
  `stock_count_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_variant` varchar(55) DEFAULT NULL,
  `product_variant_id` int(11) DEFAULT NULL,
  `expected` decimal(15,4) NOT NULL,
  `counted` decimal(15,4) NOT NULL,
  `cost` decimal(25,4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_suspended_bills`
--

CREATE TABLE `sma_suspended_bills` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL,
  `customer` varchar(55) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `order_tax_id` int(11) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL,
  `biller_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `suspend_note` varchar(255) DEFAULT NULL,
  `shipping` decimal(15,4) DEFAULT 0.0000,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_suspended_bills`
--

INSERT INTO `sma_suspended_bills` (`id`, `date`, `customer_id`, `customer`, `count`, `order_discount_id`, `order_tax_id`, `total`, `biller_id`, `warehouse_id`, `created_by`, `suspend_note`, `shipping`, `cgst`, `sgst`, `igst`) VALUES
(1, '2022-07-18 08:17:53', 1, 'Walk-in Customer', 1, '', 1, '55.0000', 3, 1, 1, '34', '0.0000', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_suspended_items`
--

CREATE TABLE `sma_suspended_items` (
  `id` int(11) NOT NULL,
  `suspend_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `net_unit_price` decimal(25,4) NOT NULL,
  `unit_price` decimal(25,4) NOT NULL,
  `quantity` decimal(15,4) DEFAULT 0.0000,
  `warehouse_id` int(11) DEFAULT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `product_type` varchar(20) DEFAULT NULL,
  `real_unit_price` decimal(25,4) DEFAULT NULL,
  `product_unit_id` int(11) DEFAULT NULL,
  `product_unit_code` varchar(10) DEFAULT NULL,
  `unit_quantity` decimal(15,4) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `gst` varchar(20) DEFAULT NULL,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_suspended_items`
--

INSERT INTO `sma_suspended_items` (`id`, `suspend_id`, `product_id`, `product_code`, `product_name`, `net_unit_price`, `unit_price`, `quantity`, `warehouse_id`, `item_tax`, `tax_rate_id`, `tax`, `discount`, `item_discount`, `subtotal`, `serial_no`, `option_id`, `product_type`, `real_unit_price`, `product_unit_id`, `product_unit_code`, `unit_quantity`, `comment`, `gst`, `cgst`, `sgst`, `igst`) VALUES
(1, 1, 1, '24259676', 'Bread Loaf', '55.0000', '55.0000', '1.0000', 1, '0.0000', 1, '0', '0', '0.0000', '55.0000', '', NULL, 'standard', '55.0000', 1, 'grams', '1.0000', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_tax_rates`
--

CREATE TABLE `sma_tax_rates` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `rate` decimal(12,4) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_tax_rates`
--

INSERT INTO `sma_tax_rates` (`id`, `name`, `code`, `rate`, `type`) VALUES
(1, 'No Tax', 'NT', '0.0000', '2'),
(2, 'VAT', 'VAT', '16.0000', '1'),
(4, 'VAT@8', 'VT8', '8.0000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sma_transfers`
--

CREATE TABLE `sma_transfers` (
  `id` int(11) NOT NULL,
  `transfer_no` varchar(55) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `from_warehouse_id` int(11) NOT NULL,
  `from_warehouse_code` varchar(55) NOT NULL,
  `from_warehouse_name` varchar(55) NOT NULL,
  `to_warehouse_id` int(11) NOT NULL,
  `to_warehouse_code` varchar(55) NOT NULL,
  `to_warehouse_name` varchar(55) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `total` decimal(25,4) DEFAULT NULL,
  `total_tax` decimal(25,4) DEFAULT NULL,
  `grand_total` decimal(25,4) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'pending',
  `shipping` decimal(25,4) NOT NULL DEFAULT 0.0000,
  `attachment` varchar(55) DEFAULT NULL,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_transfer_items`
--

CREATE TABLE `sma_transfer_items` (
  `id` int(11) NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `option_id` int(11) DEFAULT NULL,
  `expiry` date DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `net_unit_cost` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) DEFAULT NULL,
  `quantity_balance` decimal(15,4) NOT NULL,
  `unit_cost` decimal(25,4) DEFAULT NULL,
  `real_unit_cost` decimal(25,4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `product_unit_id` int(11) DEFAULT NULL,
  `product_unit_code` varchar(10) DEFAULT NULL,
  `unit_quantity` decimal(15,4) NOT NULL,
  `gst` varchar(20) DEFAULT NULL,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_units`
--

CREATE TABLE `sma_units` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(55) NOT NULL,
  `base_unit` int(11) DEFAULT NULL,
  `operator` varchar(1) DEFAULT NULL,
  `unit_value` varchar(55) DEFAULT NULL,
  `operation_value` varchar(55) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_units`
--

INSERT INTO `sma_units` (`id`, `code`, `name`, `base_unit`, `operator`, `unit_value`, `operation_value`) VALUES
(1, 'grams', 'gms', NULL, NULL, NULL, NULL),
(2, 'kg', 'KG', NULL, NULL, NULL, NULL),
(3, 'pc', 'pc', NULL, NULL, NULL, NULL),
(4, 'ml', 'Milliliter', NULL, NULL, NULL, NULL),
(5, 'tablets', 'Tablets', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_users`
--

CREATE TABLE `sma_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `last_ip_address` varbinary(45) DEFAULT NULL,
  `ip_address` varbinary(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(55) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `warehouse_id` int(10) UNSIGNED DEFAULT NULL,
  `biller_id` int(10) UNSIGNED DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `show_cost` tinyint(1) DEFAULT 0,
  `show_price` tinyint(1) DEFAULT 0,
  `award_points` int(11) DEFAULT 0,
  `view_right` tinyint(1) NOT NULL DEFAULT 0,
  `edit_right` tinyint(1) NOT NULL DEFAULT 0,
  `allow_discount` tinyint(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_users`
--

INSERT INTO `sma_users` (`id`, `last_ip_address`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `avatar`, `gender`, `group_id`, `warehouse_id`, `biller_id`, `company_id`, `show_cost`, `show_price`, `award_points`, `view_right`, `edit_right`, `allow_discount`) VALUES
(1, 0x3a3a31, 0x0000, 'admin', 'd0428cf3716ff4d7f5912037b788ac74908bc853', NULL, 'ngingaderrick@gmail.com', NULL, NULL, NULL, NULL, 1351661704, 1665033927, 1, 'Owner', 'Derrick', 'Magnocloud ltd', '0112357698', NULL, 'male', 1, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0),
(2, 0x3a3a31, 0x3a3a31, 'sales', '1283ec5a2be7c93e4f11e28a48b2159276e6fcb2', NULL, 'testasales@gmail.com', NULL, NULL, NULL, NULL, 1658091799, 1663519184, 1, 'test', 'admin', 'testa', '32528', NULL, 'male', 5, 1, 3, NULL, 0, 0, 0, 0, 0, 0),
(4, 0x3a3a31, 0x3a3a31, 'dobet', '6e0388615046712b4ff6bde7bff3e38624a6708f', NULL, 'admin@fancyliqourbox.com', NULL, NULL, NULL, NULL, 1663435401, 1663760655, 1, 'Fancy', 'Admin', 'The Fancy Liqour Box', '0725204780', NULL, 'male', 2, NULL, NULL, NULL, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sma_user_logins`
--

CREATE TABLE `sma_user_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_user_logins`
--

INSERT INTO `sma_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES
(1, 1, NULL, 0x3a3a31, 'owner@tecdiary.com', '2022-07-15 09:47:50'),
(2, 1, NULL, 0x3a3a31, 'admin', '2022-07-15 10:22:14'),
(3, 1, NULL, 0x3a3a31, 'admin', '2022-07-15 10:33:37'),
(4, 1, NULL, 0x3a3a31, 'admin', '2022-07-15 15:28:06'),
(5, 1, NULL, 0x3a3a31, 'admin', '2022-07-15 18:46:32'),
(6, 1, NULL, 0x3a3a31, 'admin', '2022-07-16 07:30:20'),
(7, 1, NULL, 0x3a3a31, 'admin', '2022-07-17 18:43:20'),
(8, 1, NULL, 0x3a3a31, 'admin', '2022-07-17 19:08:33'),
(9, 1, NULL, 0x3a3a31, 'admin', '2022-07-17 20:27:34'),
(10, 2, NULL, 0x3a3a31, 'testa', '2022-07-17 21:03:50'),
(11, 1, NULL, 0x3a3a31, 'admin', '2022-07-17 21:19:26'),
(12, 1, NULL, 0x3a3a31, 'admin', '2022-07-17 21:20:30'),
(13, 1, NULL, 0x3a3a31, 'admin', '2022-07-18 02:47:24'),
(14, 1, NULL, 0x3a3a31, 'admin', '2022-07-18 08:17:22'),
(15, 3, NULL, 0x3a3a31, 'Neuce', '2022-09-15 11:42:59'),
(16, 3, NULL, 0x3a3a31, 'Neuce', '2022-09-15 17:09:07'),
(17, 3, NULL, 0x3a3a31, 'Neuce', '2022-09-15 17:10:45'),
(18, 3, NULL, 0x3a3a31, 'Neuce', '2022-09-17 14:56:31'),
(19, 3, NULL, 0x3a3a31, 'Neuce', '2022-09-17 17:18:50'),
(20, 3, NULL, 0x3a3a31, 'Neuce', '2022-09-17 17:21:15'),
(21, 4, NULL, 0x3a3a31, 'DOBET', '2022-09-17 17:24:15'),
(22, 4, NULL, 0x3a3a31, 'DOBET', '2022-09-18 05:18:08'),
(23, 3, NULL, 0x3a3a31, 'Neuce', '2022-09-18 05:31:45'),
(24, 4, NULL, 0x3a3a31, 'DOBET', '2022-09-18 05:34:00'),
(25, 4, NULL, 0x3a3a31, 'DOBET', '2022-09-18 05:53:54'),
(26, 1, NULL, 0x3a3a31, 'admin', '2022-09-18 05:55:31'),
(27, 4, NULL, 0x3a3a31, 'DOBET', '2022-09-18 05:58:48'),
(28, 1, NULL, 0x3a3a31, 'admin', '2022-09-18 06:25:41'),
(29, 1, NULL, 0x3a3a31, 'admin', '2022-09-18 09:40:26'),
(30, 4, NULL, 0x3a3a31, 'DOBET', '2022-09-18 12:31:04'),
(31, 1, NULL, 0x3a3a31, 'admin', '2022-09-18 12:50:35'),
(32, 4, NULL, 0x3a3a31, 'DOBET', '2022-09-18 16:29:37'),
(33, 2, NULL, 0x3a3a31, 'sales', '2022-09-18 16:39:44'),
(34, 4, NULL, 0x3a3a31, 'DOBET', '2022-09-18 18:13:06'),
(35, 4, NULL, 0x3a3a31, 'dobet', '2022-09-21 11:44:15'),
(36, 1, NULL, 0x3a3a31, 'admin', '2022-09-21 11:46:31'),
(37, 1, NULL, 0x3a3a31, 'admin', '2022-09-21 12:01:16'),
(38, 1, NULL, 0x3a3a31, 'admin', '2022-09-21 12:07:32'),
(39, 1, NULL, 0x3a3a31, 'admin', '2022-09-27 08:37:33'),
(40, 1, NULL, 0x3a3a31, 'ngingaderrick@gmail.com', '2022-10-06 06:59:51'),
(41, 1, NULL, 0x3a3a31, 'ngingaderrick@gmail.com', '2022-10-06 15:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `sma_variants`
--

CREATE TABLE `sma_variants` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_variants`
--

INSERT INTO `sma_variants` (`id`, `name`) VALUES
(1, '250 ml'),
(2, '125 ml');

-- --------------------------------------------------------

--
-- Table structure for table `sma_warehouses`
--

CREATE TABLE `sma_warehouses` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `map` varchar(255) DEFAULT NULL,
  `phone` varchar(55) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `price_group_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_warehouses`
--

INSERT INTO `sma_warehouses` (`id`, `code`, `name`, `address`, `map`, `phone`, `email`, `price_group_id`) VALUES
(1, 'WHI', 'Nyeri', '<p>657, Villagemarket</p>', NULL, '0710943017', 'nyeri@fancyliqourbox.com', 0),
(2, 'WHII', 'Warehouse 2', '<p>Nairobi</p>', NULL, '0105292122', 'whii@magnocloudpos.co.ke', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sma_warehouses_products`
--

CREATE TABLE `sma_warehouses_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `rack` varchar(55) DEFAULT NULL,
  `avg_cost` decimal(25,4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_warehouses_products`
--

INSERT INTO `sma_warehouses_products` (`id`, `product_id`, `warehouse_id`, `quantity`, `rack`, `avg_cost`) VALUES
(27, 12, 1, '5000.0000', NULL, '150.0000'),
(26, 11, 2, '0.0000', NULL, '1100.0000'),
(5, 1, 1, '1.0000', NULL, '0.0000'),
(25, 11, 1, '10000.0000', NULL, '1100.0000'),
(24, 10, 2, '0.0000', NULL, '1375.0000'),
(23, 10, 1, '5000.0000', NULL, '1375.0000'),
(22, 9, 2, '0.0000', NULL, '1.0000'),
(21, 9, 1, '5000.0000', NULL, '1.0000'),
(20, 8, 2, '0.0000', NULL, '249.0000'),
(19, 8, 1, '10000.0000', NULL, '249.0000'),
(18, 7, 1, '39.0000', NULL, '0.0000'),
(17, 3, 1, '29.0000', NULL, '0.0000'),
(16, 2, 1, '7.0000', NULL, '0.0000'),
(28, 12, 2, '0.0000', NULL, '150.0000'),
(29, 13, 1, '5000.0000', NULL, '350.0000'),
(30, 13, 2, '0.0000', NULL, '350.0000'),
(31, 14, 1, '5000.0000', NULL, '300.0000'),
(32, 14, 2, '0.0000', NULL, '300.0000'),
(33, 15, 1, '5000.0000', NULL, '100.0000'),
(34, 15, 2, '0.0000', NULL, '100.0000'),
(35, 16, 1, '5000.0000', NULL, '500.0000'),
(36, 16, 2, '0.0000', NULL, '500.0000'),
(37, 17, 1, '5000.0000', NULL, '750.0000'),
(38, 17, 2, '0.0000', NULL, '750.0000'),
(39, 18, 1, '5000.0000', NULL, '200.0000'),
(40, 18, 2, '0.0000', NULL, '200.0000'),
(41, 19, 1, '5000.0000', NULL, '4.0000'),
(42, 19, 2, '0.0000', NULL, '4.0000'),
(43, 20, 1, '3500.0000', NULL, '200.0000'),
(44, 20, 2, '0.0000', NULL, '200.0000'),
(45, 21, 1, '3000.0000', NULL, '200.0000'),
(46, 21, 2, '0.0000', NULL, '200.0000'),
(47, 22, 1, '4500.0000', NULL, '9.0000'),
(48, 22, 2, '0.0000', NULL, '9.0000'),
(49, 4, 1, '25.0000', NULL, '0.0000'),
(50, 5, 1, '24.0000', NULL, '0.0000'),
(51, 6, 1, '15.0000', NULL, '0.0000');

-- --------------------------------------------------------

--
-- Table structure for table `sma_warehouses_products_variants`
--

CREATE TABLE `sma_warehouses_products_variants` (
  `id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `rack` varchar(55) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_wishlist`
--

CREATE TABLE `sma_wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sma_addresses`
--
ALTER TABLE `sma_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `sma_adjustments`
--
ALTER TABLE `sma_adjustments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `sma_adjustment_items`
--
ALTER TABLE `sma_adjustment_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adjustment_id` (`adjustment_id`);

--
-- Indexes for table `sma_api_keys`
--
ALTER TABLE `sma_api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_api_limits`
--
ALTER TABLE `sma_api_limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_api_logs`
--
ALTER TABLE `sma_api_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_attachments`
--
ALTER TABLE `sma_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_brands`
--
ALTER TABLE `sma_brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `sma_calendar`
--
ALTER TABLE `sma_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_captcha`
--
ALTER TABLE `sma_captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);

--
-- Indexes for table `sma_cart`
--
ALTER TABLE `sma_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_categories`
--
ALTER TABLE `sma_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sma_combo_items`
--
ALTER TABLE `sma_combo_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_companies`
--
ALTER TABLE `sma_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `group_id_2` (`group_id`);

--
-- Indexes for table `sma_costing`
--
ALTER TABLE `sma_costing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_currencies`
--
ALTER TABLE `sma_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_customer_groups`
--
ALTER TABLE `sma_customer_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_date_format`
--
ALTER TABLE `sma_date_format`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_deliveries`
--
ALTER TABLE `sma_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_deposits`
--
ALTER TABLE `sma_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_expenses`
--
ALTER TABLE `sma_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_expense_categories`
--
ALTER TABLE `sma_expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sma_gift_cards`
--
ALTER TABLE `sma_gift_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `card_no` (`card_no`);

--
-- Indexes for table `sma_gift_card_topups`
--
ALTER TABLE `sma_gift_card_topups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_id` (`card_id`);

--
-- Indexes for table `sma_groups`
--
ALTER TABLE `sma_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_login_attempts`
--
ALTER TABLE `sma_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_logs`
--
ALTER TABLE `sma_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_notifications`
--
ALTER TABLE `sma_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_order_ref`
--
ALTER TABLE `sma_order_ref`
  ADD PRIMARY KEY (`ref_id`);

--
-- Indexes for table `sma_pages`
--
ALTER TABLE `sma_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_payments`
--
ALTER TABLE `sma_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_paypal`
--
ALTER TABLE `sma_paypal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_permissions`
--
ALTER TABLE `sma_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_pos_register`
--
ALTER TABLE `sma_pos_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_pos_settings`
--
ALTER TABLE `sma_pos_settings`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `sma_price_groups`
--
ALTER TABLE `sma_price_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `sma_printers`
--
ALTER TABLE `sma_printers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_products`
--
ALTER TABLE `sma_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `category_id_2` (`category_id`),
  ADD KEY `unit` (`unit`),
  ADD KEY `brand` (`brand`);

--
-- Indexes for table `sma_product_photos`
--
ALTER TABLE `sma_product_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_product_prices`
--
ALTER TABLE `sma_product_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `price_group_id` (`price_group_id`);

--
-- Indexes for table `sma_product_variants`
--
ALTER TABLE `sma_product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_product_id_name` (`product_id`,`name`);

--
-- Indexes for table `sma_promos`
--
ALTER TABLE `sma_promos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_purchases`
--
ALTER TABLE `sma_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sma_purchase_items`
--
ALTER TABLE `sma_purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_id` (`purchase_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sma_quotes`
--
ALTER TABLE `sma_quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sma_quote_items`
--
ALTER TABLE `sma_quote_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quote_id` (`quote_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sma_returns`
--
ALTER TABLE `sma_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sma_return_items`
--
ALTER TABLE `sma_return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_id` (`return_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_id_2` (`product_id`,`return_id`),
  ADD KEY `return_id_2` (`return_id`,`product_id`);

--
-- Indexes for table `sma_sales`
--
ALTER TABLE `sma_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sma_sale_items`
--
ALTER TABLE `sma_sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_id_2` (`product_id`,`sale_id`),
  ADD KEY `sale_id_2` (`sale_id`,`product_id`);

--
-- Indexes for table `sma_sessions`
--
ALTER TABLE `sma_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `sma_settings`
--
ALTER TABLE `sma_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `sma_shop_settings`
--
ALTER TABLE `sma_shop_settings`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `sma_skrill`
--
ALTER TABLE `sma_skrill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_sms_settings`
--
ALTER TABLE `sma_sms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_stock_counts`
--
ALTER TABLE `sma_stock_counts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `sma_stock_count_items`
--
ALTER TABLE `sma_stock_count_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_count_id` (`stock_count_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sma_suspended_bills`
--
ALTER TABLE `sma_suspended_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_suspended_items`
--
ALTER TABLE `sma_suspended_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_tax_rates`
--
ALTER TABLE `sma_tax_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_transfers`
--
ALTER TABLE `sma_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sma_transfer_items`
--
ALTER TABLE `sma_transfer_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfer_id` (`transfer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sma_units`
--
ALTER TABLE `sma_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `base_unit` (`base_unit`);

--
-- Indexes for table `sma_users`
--
ALTER TABLE `sma_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`,`warehouse_id`,`biller_id`),
  ADD KEY `group_id_2` (`group_id`,`company_id`);

--
-- Indexes for table `sma_user_logins`
--
ALTER TABLE `sma_user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_variants`
--
ALTER TABLE `sma_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_warehouses`
--
ALTER TABLE `sma_warehouses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sma_warehouses_products`
--
ALTER TABLE `sma_warehouses_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `sma_warehouses_products_variants`
--
ALTER TABLE `sma_warehouses_products_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `option_id` (`option_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `sma_wishlist`
--
ALTER TABLE `sma_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sma_addresses`
--
ALTER TABLE `sma_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sma_adjustments`
--
ALTER TABLE `sma_adjustments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sma_adjustment_items`
--
ALTER TABLE `sma_adjustment_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `sma_api_keys`
--
ALTER TABLE `sma_api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_api_limits`
--
ALTER TABLE `sma_api_limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_api_logs`
--
ALTER TABLE `sma_api_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_attachments`
--
ALTER TABLE `sma_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_brands`
--
ALTER TABLE `sma_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sma_calendar`
--
ALTER TABLE `sma_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_captcha`
--
ALTER TABLE `sma_captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_categories`
--
ALTER TABLE `sma_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sma_combo_items`
--
ALTER TABLE `sma_combo_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_companies`
--
ALTER TABLE `sma_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sma_costing`
--
ALTER TABLE `sma_costing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sma_currencies`
--
ALTER TABLE `sma_currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sma_customer_groups`
--
ALTER TABLE `sma_customer_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sma_date_format`
--
ALTER TABLE `sma_date_format`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sma_deliveries`
--
ALTER TABLE `sma_deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_deposits`
--
ALTER TABLE `sma_deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_expenses`
--
ALTER TABLE `sma_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_expense_categories`
--
ALTER TABLE `sma_expense_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_gift_cards`
--
ALTER TABLE `sma_gift_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_gift_card_topups`
--
ALTER TABLE `sma_gift_card_topups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_groups`
--
ALTER TABLE `sma_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sma_login_attempts`
--
ALTER TABLE `sma_login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sma_logs`
--
ALTER TABLE `sma_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sma_notifications`
--
ALTER TABLE `sma_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sma_order_ref`
--
ALTER TABLE `sma_order_ref`
  MODIFY `ref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sma_pages`
--
ALTER TABLE `sma_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_payments`
--
ALTER TABLE `sma_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sma_permissions`
--
ALTER TABLE `sma_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sma_pos_register`
--
ALTER TABLE `sma_pos_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sma_price_groups`
--
ALTER TABLE `sma_price_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sma_printers`
--
ALTER TABLE `sma_printers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_products`
--
ALTER TABLE `sma_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sma_product_photos`
--
ALTER TABLE `sma_product_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_product_prices`
--
ALTER TABLE `sma_product_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_product_variants`
--
ALTER TABLE `sma_product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_promos`
--
ALTER TABLE `sma_promos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_purchases`
--
ALTER TABLE `sma_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_purchase_items`
--
ALTER TABLE `sma_purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sma_quotes`
--
ALTER TABLE `sma_quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sma_quote_items`
--
ALTER TABLE `sma_quote_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sma_returns`
--
ALTER TABLE `sma_returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_return_items`
--
ALTER TABLE `sma_return_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_sales`
--
ALTER TABLE `sma_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sma_sale_items`
--
ALTER TABLE `sma_sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sma_sms_settings`
--
ALTER TABLE `sma_sms_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sma_stock_counts`
--
ALTER TABLE `sma_stock_counts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sma_stock_count_items`
--
ALTER TABLE `sma_stock_count_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_suspended_bills`
--
ALTER TABLE `sma_suspended_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sma_suspended_items`
--
ALTER TABLE `sma_suspended_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sma_tax_rates`
--
ALTER TABLE `sma_tax_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sma_transfers`
--
ALTER TABLE `sma_transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_transfer_items`
--
ALTER TABLE `sma_transfer_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_units`
--
ALTER TABLE `sma_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sma_users`
--
ALTER TABLE `sma_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sma_user_logins`
--
ALTER TABLE `sma_user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sma_variants`
--
ALTER TABLE `sma_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sma_warehouses`
--
ALTER TABLE `sma_warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sma_warehouses_products`
--
ALTER TABLE `sma_warehouses_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sma_warehouses_products_variants`
--
ALTER TABLE `sma_warehouses_products_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_wishlist`
--
ALTER TABLE `sma_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
