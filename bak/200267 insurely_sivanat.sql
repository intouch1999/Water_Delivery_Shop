-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2024 at 08:57 AM
-- Server version: 10.6.8-MariaDB-cll-lve
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Username`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch_info`
--

CREATE TABLE `branch_info` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `create_user` varchar(100) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `lock_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `branch_info`
--

INSERT INTO `branch_info` (`branch_id`, `branch_name`, `create_user`, `create_datetime`, `lock_status`) VALUES
(1, 'สำนักงานใหญ่', 'Administrator', '2023-09-11 17:20:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_category`
--

CREATE TABLE `delivery_category` (
  `delivery_cat_id` int(11) NOT NULL,
  `delivery_cat_name` varchar(100) NOT NULL,
  `create_user` varchar(100) NOT NULL,
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `delivery_category`
--

INSERT INTO `delivery_category` (`delivery_cat_id`, `delivery_cat_name`, `create_user`, `create_datetime`) VALUES
(1, 'น้ำดื่มแพ็ค(ใหญ่)', 'Administrator', '2023-10-07 23:25:26'),
(2, 'น้ำดื่มแพ็ค(กลาง)', 'Administrator', '2023-10-07 03:17:33'),
(3, 'น้ำดื่มแพ็ค(เล็ก)', 'Administrator', '2023-10-07 03:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_customer`
--

CREATE TABLE `delivery_customer` (
  `cus_id` varchar(20) NOT NULL,
  `cus_name` varchar(100) NOT NULL,
  `cus_tel` varchar(20) NOT NULL,
  `cus_contact` varchar(50) NOT NULL,
  `comp_type` varchar(30) NOT NULL,
  `cus_address` varchar(500) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lon` varchar(20) NOT NULL,
  `tax_cus_name` varchar(100) NOT NULL,
  `tax_main_branch` tinyint(4) NOT NULL,
  `tax_cus_branch` varchar(50) NOT NULL,
  `tax_cus_id` varchar(25) NOT NULL,
  `tax_cus_addr` varchar(500) NOT NULL,
  `tax_cus_postcode` varchar(10) NOT NULL,
  `create_user` varchar(100) NOT NULL,
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `delivery_customer`
--

INSERT INTO `delivery_customer` (`cus_id`, `cus_name`, `cus_tel`, `cus_contact`, `comp_type`, `cus_address`, `lat`, `lon`, `tax_cus_name`, `tax_main_branch`, `tax_cus_branch`, `tax_cus_id`, `tax_cus_addr`, `tax_cus_postcode`, `create_user`, `create_datetime`) VALUES
('C00001', 'เสริมสวย YR', '0000000000', '', 'general', 'ซอย ประชาราษฎร์บำเพ็ญ 6/2 แขวงห้วยขวาง เขตห้วยขวาง กรุงเทพมหานคร ประเทศไทย', '13.778315580608', '100.57737395361', '', 0, '', '', '', '', 'Administrator', '2023-10-07 23:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_product`
--

CREATE TABLE `delivery_product` (
  `nIndex` int(11) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `delivery_cat_id` int(11) NOT NULL,
  `delivery_type` varchar(20) NOT NULL,
  `create_user` varchar(100) NOT NULL,
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `delivery_product`
--

INSERT INTO `delivery_product` (`nIndex`, `product_id`, `delivery_cat_id`, `delivery_type`, `create_user`, `create_datetime`) VALUES
(11, 'P00001', 1, 'pack', 'นาย ชวภณ แดนลาดแก้ว', '2023-10-19 08:48:33'),
(12, 'P00002', 2, 'pack', 'นาย ชวภณ แดนลาดแก้ว', '2023-10-19 08:48:53'),
(13, 'P00003', 3, 'pack', 'นาย ชวภณ แดนลาดแก้ว', '2023-10-19 08:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `create_user` varchar(70) NOT NULL,
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`cat_id`, `cat_name`, `create_user`, `create_datetime`) VALUES
(15, 'น้ำดื่ม', 'Administrator', '2023-10-07 23:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `product_category_sub`
--

CREATE TABLE `product_category_sub` (
  `cat_sub_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_sub_name` varchar(100) NOT NULL,
  `cat_create` varchar(100) NOT NULL,
  `cat_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_category_sub`
--

INSERT INTO `product_category_sub` (`cat_sub_id`, `cat_id`, `cat_sub_name`, `cat_create`, `cat_datetime`) VALUES
(16, 15, 'แพ็คใหญ่ 1500 มล.', 'Administrator', '2023-10-07 23:36:10'),
(17, 15, 'แพ็คกลาง 600 มล.', 'Administrator', '2023-10-07 23:36:16'),
(18, 15, 'แพ็คเล็ก 350 มล.', 'Administrator', '2023-10-07 23:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_info`
--

CREATE TABLE `product_info` (
  `nIndex` int(11) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_img` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_sub_id` int(11) NOT NULL,
  `product_barcode` varchar(30) NOT NULL,
  `unit` int(11) NOT NULL,
  `unit_cost` float NOT NULL,
  `unit_price` float NOT NULL,
  `pack` int(11) NOT NULL,
  `pack_cost` float NOT NULL,
  `pack_price` float NOT NULL,
  `product_active` tinyint(4) NOT NULL,
  `create_user` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `edit_user` varchar(100) NOT NULL,
  `edit_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_info`
--

INSERT INTO `product_info` (`nIndex`, `product_id`, `product_name`, `product_img`, `cat_id`, `cat_sub_id`, `product_barcode`, `unit`, `unit_cost`, `unit_price`, `pack`, `pack_cost`, `pack_price`, `product_active`, `create_user`, `create_date`, `edit_user`, `edit_date`) VALUES
(8, 'P00001', 'น้ำดื่ม ชิลล์ชิลล์ (1500 มล.)', 'P00001_301410938.jpg', 15, 16, '', 1, 4.1666, 10, 6, 25, 33.3333, 1, 'Administrator', '2023-10-07 23:47:39', 'Administrator', '2023-10-07 23:48:35'),
(9, 'P00002', 'น้ำดื่ม ชิลล์ชิลล์ (600 มล.)', 'P00002_1812193737.jpg', 15, 17, '', 1, 2.0833, 5, 12, 25, 33.3333, 1, 'Administrator', '2023-10-07 23:51:19', '', '2023-10-07 23:51:19'),
(10, 'P00003', 'น้ำดื่ม ชิลล์ชิลล์ (350 มล.)', 'P00003_1715091414.jpg', 15, 18, '', 1, 2.0833, 5, 12, 25, 33.3333, 1, 'Administrator', '2023-10-07 23:56:18', '', '2023-10-07 23:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `nIndex` int(11) NOT NULL,
  `branch_id` varchar(10) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `emp_fname` varchar(100) NOT NULL,
  `emp_position` varchar(50) NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_address` varchar(350) NOT NULL,
  `emp_tel` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` varchar(50) NOT NULL,
  `emp_img` varchar(255) NOT NULL,
  `create_user` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `user_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`nIndex`, `branch_id`, `emp_id`, `emp_fname`, `emp_position`, `emp_dob`, `emp_address`, `emp_tel`, `username`, `password`, `permission`, `emp_img`, `create_user`, `create_date`, `edit_date`, `user_active`) VALUES
(66, 'vip', 'admin', 'Administrator', 'ผู้ดูแลระบบ', '2023-09-17', 'Official Web Admin', '0812345678', 'admin', '$2y$10$OIr528bnryiCKl8G8o.Zu.ZjUKY9b94sweVEOBiHSBtKHL5fzSRE2', 'admin', 'vip001_2091925443.jpg', 'test_user', '2023-09-16 11:56:49', '2023-09-16 11:56:49', 1),
(67, 'vip', 'vip001', 'นาย ชวภณ แดนลาดแก้ว', 'ผู้จัดการร้าน', '1992-03-12', '1/22 ประชาราษฎร์บำเพ็ญ 9 ', '092-2688-269', 'vip001', '$2y$10$BdXLt8agBciAPjIpjQWP3.s23pq2k.JdvhpeQxiGV0yuI./WCLjmi', 'manager', 'vip001_1909522364.jpg', 'Administrator', '2023-10-19 08:30:33', '2023-10-19 08:46:06', 1),
(68, '1', '1001', 'ชวภณ แดนลาดแก้ว', 'ผู้จัดการร้าน', '1992-03-12', '1/22 ', '0922688269', '1001', '$2y$10$I5GFHOVgrc.3Xn09.l4dAujH8fYuB1cD2kJwk2T9uSgnimh7ugtsW', 'manager', '1001_377735802.jpg', 'Administrator', '2023-10-19 08:40:05', '2023-10-19 08:40:05', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch_info`
--
ALTER TABLE `branch_info`
  ADD PRIMARY KEY (`branch_id`),
  ADD UNIQUE KEY `branch_name` (`branch_name`);

--
-- Indexes for table `delivery_category`
--
ALTER TABLE `delivery_category`
  ADD PRIMARY KEY (`delivery_cat_id`);

--
-- Indexes for table `delivery_customer`
--
ALTER TABLE `delivery_customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `delivery_product`
--
ALTER TABLE `delivery_product`
  ADD PRIMARY KEY (`nIndex`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`,`product_name`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`cat_id`,`cat_name`);

--
-- Indexes for table `product_category_sub`
--
ALTER TABLE `product_category_sub`
  ADD PRIMARY KEY (`cat_sub_id`);

--
-- Indexes for table `product_info`
--
ALTER TABLE `product_info`
  ADD PRIMARY KEY (`nIndex`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`nIndex`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_category`
--
ALTER TABLE `delivery_category`
  MODIFY `delivery_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_product`
--
ALTER TABLE `delivery_product`
  MODIFY `nIndex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_category_sub`
--
ALTER TABLE `product_category_sub`
  MODIFY `cat_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_info`
--
ALTER TABLE `product_info`
  MODIFY `nIndex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `nIndex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
