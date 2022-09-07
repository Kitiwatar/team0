-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2022 at 10:06 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team0`
--

-- --------------------------------------------------------

--
-- Table structure for table `pms_file`
--

CREATE TABLE `pms_file` (
  `f_id` int(11) NOT NULL COMMENT 'ไอดีไฟล์',
  `f_name` varchar(100) NOT NULL COMMENT 'ชื่อไฟล์',
  `f_createdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'วันที่อัปโหลด',
  `f_t_id` int(11) NOT NULL COMMENT 'ไอดีกิจกรรม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางไฟล์';

--
-- Dumping data for table `pms_file`
--

-- --------------------------------------------------------

--
-- Table structure for table `pms_permission`
--

CREATE TABLE `pms_permission` (
  `per_id` int(11) NOT NULL COMMENT 'ไอดีสิทธิ์',
  `per_p_id` int(11) NOT NULL COMMENT 'ไอดีโครงการ',
  `per_u_id` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้(พนักงานในโครงการ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางสิทธิ์ในโครงการ';

--
-- Dumping data for table `pms_permission`
--

-- --------------------------------------------------------

--
-- Table structure for table `pms_project`
--

CREATE TABLE `pms_project` (
  `p_id` int(11) NOT NULL COMMENT 'ไอดีโครงการ',
  `p_name` varchar(100) NOT NULL COMMENT 'ชื่อโครงการ',
  `p_customer` varchar(100) NOT NULL COMMENT 'ชื่อลูกค้า',
  `p_contact` varchar(100) NOT NULL COMMENT 'ช่องทางติดต่อลูกค้า',
  `p_detail` varchar(255) NOT NULL COMMENT 'รายละเอียดโครงการ',
  `p_createdate` date NOT NULL COMMENT 'วันที่เริ่มโครงการ',
  `p_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะโครงการ',
  `p_u_id` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้(หัวหน้าโครงการ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางโครงการ';

--
-- Dumping data for table `pms_project`
--

INSERT INTO `pms_project` (`p_id`, `p_name`, `p_customer`, `p_contact`, `p_detail`, `p_createdate`, `p_status`, `p_u_id`) VALUES
(1, 'Human Resource Management System', 'จันทรัตว์ แก้วมาลา', 'line: jantav.123', 'ระบบบริหารจัดการบุคลากรภายในบริษัท', '2022-08-10', 1, 11),
(2, 'Document Management System', 'ภูวเดช เลิศคุณวงส์', 'line: tame555', 'ระบบจัดเก็บเอกสารต่าง ๆ ในบริษัท', '2022-08-11', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `pms_task`
--

CREATE TABLE `pms_task` (
  `t_id` int(11) NOT NULL COMMENT 'ไอดีกิจกรรม',
  `t_detail` date NOT NULL COMMENT 'รายละเอียด',
  `t_createdate` date NOT NULL COMMENT 'วันที่เพิ่ม',
  `t_tl_id` int(11) NOT NULL COMMENT 'ไอดีชื่อกิจกรรม',
  `t_p_id` int(11) NOT NULL COMMENT 'ไอดีโครงการ',
  `t_u_id` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางกิจกรรม';

--
-- Dumping data for table `pms_task`
--
-- --------------------------------------------------------

--
-- Table structure for table `pms_tasklist`
--

CREATE TABLE `pms_tasklist` (
  `tl_id` int(11) NOT NULL COMMENT 'ไอดีชื่อกิจกรรม',
  `tl_name` varchar(100) NOT NULL COMMENT 'ชื่อกิจกรรม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางรายชื่อกิจกรรม';

-- --------------------------------------------------------

--
-- Table structure for table `pms_user`
--

CREATE TABLE `pms_user` (
  `u_id` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้',
  `u_email` varchar(100) NOT NULL COMMENT 'อีเมล',
  `u_password` varchar(100) NOT NULL COMMENT 'รหัสผ่าน',
  `u_firstname` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `u_lastname` varchar(100) NOT NULL COMMENT 'นามสกุล',
  `u_tel` varchar(10) NOT NULL COMMENT 'เบอร์โทร',
  `u_createdate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่เพิ่ม',
  `u_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะผู้ใช้',
  `u_creator` int(11) NOT NULL COMMENT 'ผู้ที่ทำการเพิ่ม',
  `u_role` int(11) NOT NULL COMMENT 'สิทธิ์ในการใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางผู้ใช้';

--
-- Dumping data for table `pms_user`
--

INSERT INTO `pms_user` (`u_id`, `u_email`, `u_password`, `u_firstname`, `u_lastname`, `u_tel`, `u_createdate`, `u_status`, `u_creator`, `u_role`) VALUES
(1, 'test@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ขจรศักดิ์', 'ผักใบเขียว', '0912345678', '2022-08-01 03:00:00', 1, 1, 1),
(2, '63160018@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ธนพงศ์', 'หงษ์บิน', '0989340452', '2022-08-01 03:00:00', 1, 1, 2),
(3, '63160290@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ปวันรัตน์', 'ตั้งประเสริฐ', '0675340120', '2022-08-01 03:00:00', 1, 1, 2),
(4, '63160246@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'จิรเดช', 'ป้อมใหญ่', '0860136623', '2022-08-01 03:00:00', 1, 1, 2),
(5, '63160239@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ณัฐกิตติ์', 'ชัยกล้าหาญ', '0927373262', '2022-08-01 03:00:00', 1, 1, 2),
(6, '63160258@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'มติมนต์', 'นรดี', '0912297285', '2022-08-01 03:00:00', 1, 1, 2),
(7, '63160234@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'กิติวัฒน์', 'อรุญวงษ์', '0835297285', '2022-08-01 03:00:00', 1, 1, 2),
(8, '63160238@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ณฐกร', 'พงษ์สาริกิจ', '0978519188', '2022-08-01 03:00:00', 1, 1, 2),
(9, '63160265@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'สิรภัทร', 'ตันเสวตวงษ์', '0870598760', '2022-08-01 03:00:00', 1, 1, 2),
(10, '63160248@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ปฏิภาณ', 'ปั้นสง่า', '0810584731', '2022-08-01 03:00:00', 1, 1, 2),
(11, 'kitithorn.kiti@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'กิตติธร', 'กิตติเตชะคุณ', '0838853168', '2022-08-01 03:00:00', 1, 1, 2),
(12, 'nawarat.passakul@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'นวรัตน์', 'พาสกุล', '0822801109', '2022-08-01 03:00:00', 1, 1, 2),
(13, 'sunisa.su@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'สุนิษา', 'สุพรรณภาคิน', '0687025049', '2022-08-01 03:00:00', 1, 1, 3),
(14, 'pol12@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ธัชพล', 'พงศ์พิโรจ', '0848430664', '2022-08-01 03:00:00', 1, 1, 3),
(15, 'ronnaporn.tada@gmail.com', 'f9194e73f9e9459e3450ea10a179cdf77aafa695beecd3b9344a98d111622243', 'รณพร', 'ธาดาวรวงศ์', '0644219211', '2022-08-01 03:00:00', 1, 1, 3),
(16, 'phonlaphat.pi@gmail.com', 'f9194e73f9e9459e3450ea10a179cdf77aafa695beecd3b9344a98d111622243', 'พลภัทร', 'พิจิตเจริญวงศ์', '0832438221', '2022-08-01 03:00:00', 1, 1, 3),
(17, 'yodsaphat2907@gmail.com', 'f9194e73f9e9459e3450ea10a179cdf77aafa695beecd3b9344a98d111622243', 'ยศพัฒน์', 'พิชิตชัย', '0617610871', '2022-08-01 03:00:00', 1, 1, 3),
(18, 'bawornwit.ko@gmail.com', 'f9194e73f9e9459e3450ea10a179cdf77aafa695beecd3b9344a98d111622243', 'บวรวิทย์', 'คมปราชญ์', '0839386762', '2022-08-01 03:00:00', 1, 1, 3),
(19, 'piyarom.sri@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ปิยรมย์', 'ศรีวรรณวิไล', '0651338630', '2022-08-01 03:00:00', 1, 1, 3),
(20, 'apple.kulanan@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'กุลนันท์', 'พงษ์ธนาพัฒน์', '0637237718', '2022-08-01 03:00:00', 1, 1, 3),
(21, 'pongsit1010@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'พงษ์สิทธิ์', 'อุดมเสก', '0937237799', '2022-08-01 03:00:00', 1, 1, 3),
(22, 'thanapat0901@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ธนภัทร', 'จรัสธรรม', '0836949645', '2022-08-01 03:00:00', 1, 1, 3),
(23, 'napassorn.jan@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'นภัสสร', 'จันทรพร', '0906219227', '2022-08-01 03:00:00', 1, 1, 3),
(24, 'sopol2406@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'โสพล', 'จันทรทรัพย์', '0816804298', '2022-08-01 03:00:00', 1, 1, 3),
(25, 'suchada1512@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'สุชาดา', 'พินิจนันท์', '0652864431', '2022-08-01 03:00:00', 1, 1, 3),
(26, 'neera95@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'นีรา', 'ตันฑการุณ', '0647990546', '2022-08-01 03:00:00', 1, 1, 3),
(27, 'chanawan.in@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ชนวรรณ', 'อินทรประสาท', '0832157872', '2022-08-01 03:00:00', 1, 1, 3),
(28, 'thanathong.tham@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ธนาธง', 'ธรรมวงศ์', '0988421765', '2022-08-01 03:00:00', 1, 1, 3),
(29, 'palika.prasanwong@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ปาลิกา', 'ประสานวงศ์', '0873347391', '2022-08-01 03:00:00', 1, 1, 3),
(30, 'nichapa0101@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ณิชาภา', 'หงษ์ทอง', '0841923769', '2022-08-01 03:00:00', 1, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pms_file`
--
ALTER TABLE `pms_file`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `pms_permission`
--
ALTER TABLE `pms_permission`
  ADD PRIMARY KEY (`per_id`);

--
-- Indexes for table `pms_project`
--
ALTER TABLE `pms_project`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `pms_task`
--
ALTER TABLE `pms_task`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `pms_tasklist`
--
ALTER TABLE `pms_tasklist`
  ADD PRIMARY KEY (`tl_id`);

--
-- Indexes for table `pms_user`
--
ALTER TABLE `pms_user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pms_file`
--
ALTER TABLE `pms_file`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีไฟล์', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pms_permission`
--
ALTER TABLE `pms_permission`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีสิทธิ์', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pms_project`
--
ALTER TABLE `pms_project`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีโครงการ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pms_task`
--
ALTER TABLE `pms_task`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีกิจกรรม', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pms_tasklist`
--
ALTER TABLE `pms_tasklist`
  MODIFY `tl_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีชื่อกิจกรรม';

--
-- AUTO_INCREMENT for table `pms_user`
--
ALTER TABLE `pms_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้ใช้', AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
