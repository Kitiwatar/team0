-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2023 at 03:47 PM
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
-- Table structure for table `pms_cancel`
--

CREATE TABLE `pms_cancel` (
  `c_id` int(11) NOT NULL COMMENT 'ไอดีการยุติโครงการ (ตัวอย่าง 1)	',
  `c_detail` varchar(1000) NOT NULL COMMENT 'รายละเอียดการยุติโครงการ (ตัวอย่าง ลูกค้าไม่ต้องการ...)	',
  `c_createdate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่ยุติโครงการ (ตัวอย่าง 2022-12-25 11:14:08)	',
  `c_cl_id` int(11) NOT NULL COMMENT 'ไอดีรายชื่อสาเหตุการยุติโครงการ (ตัวอย่าง 1)',
  `c_p_id` int(11) NOT NULL COMMENT 'ไอดีโครงการ',
  `c_u_id` int(11) NOT NULL COMMENT 'ไอดีผู้ดำเนินการยุติโครงการ (ตัวอย่าง 1)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางการยุติโครงการ';

-- --------------------------------------------------------

--
-- Table structure for table `pms_cancellist`
--

CREATE TABLE `pms_cancellist` (
  `cl_id` int(11) NOT NULL COMMENT 'ไอดีสาเหตุยุติโครงการ (ตัวอย่าง 1)',
  `cl_name` varchar(100) NOT NULL COMMENT 'ชื่อสาเหตุยุติโครงการ (ตัวอย่าง ลูกค้ายกเลิก)',
  `cl_createdate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่เพิ่ม (ตัวอย่าง 2022-12-25 11:14:08)	',
  `cl_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะของชื่อสาเหตุยุติโครงการ (0 ถูกลบ, 1 ปกติ)	',
  `cl_u_id` int(11) NOT NULL COMMENT 'ไอดีผู้เพิ่ม (ตัวอย่าง 1)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางรายชื่อของสาเหตุยุติโครงการ';

-- --------------------------------------------------------

--
-- Table structure for table `pms_file`
--

CREATE TABLE `pms_file` (
  `f_id` int(11) NOT NULL COMMENT 'ไอดีไฟล์ (ตัวอย่าง 1)',
  `f_name` varchar(100) NOT NULL COMMENT 'ชื่อไฟล์ (ตัวอย่าง ใบเสนอราคา.pdf)',
  `f_createdate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่อัปโหลด (ตัวอย่าง 2022-09-12 12:14:08)',
  `f_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะไฟล์ (0 ถูกลบ, 1 ปกติ)',
  `f_t_id` int(11) NOT NULL COMMENT 'ไอดีกิจกรรม (ตัวอย่าง 1)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางไฟล์';

-- --------------------------------------------------------

--
-- Table structure for table `pms_log`
--

CREATE TABLE `pms_log` (
  `l_id` int(11) NOT NULL COMMENT 'ไอดีบันทึก (ตัวอย่าง 1)',
  `l_action` varchar(100) NOT NULL COMMENT 'การกระทำ (ตัวอย่าง add)',
  `l_table` varchar(100) NOT NULL COMMENT 'ชื่อตาราง (ตัวย่าง pms_user)',
  `l_data` varchar(1000) NOT NULL COMMENT 'ข้อมูล (ตัวย่าง {"u_role":"2"})',
  `l_command` varchar(1000) NOT NULL COMMENT 'คำสั่ง (ตัวอย่าง UPDATE `pms_user` SET `u_role` = ''2''\r\nWHERE `u_id` = ''20'')',
  `l_createdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'วันที่ทำ (ตัวอย่าง 2022-09-12 01:14:08)',
  `l_u_id` int(11) NOT NULL COMMENT 'ไอดีผู้กระทำ (ตัวอย่าง 1)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางบันทึกประวัติของระบบ';

-- --------------------------------------------------------

--
-- Table structure for table `pms_permission`
--

CREATE TABLE `pms_permission` (
  `per_id` int(11) NOT NULL COMMENT 'ไอดีสิทธิ์ (ตัวอย่าง 1)',
  `per_role` int(11) NOT NULL COMMENT 'หน้าที่ในโครงการนั้น (1 ผู้รับผิดชอบหลัก, 2 ทั่วไป)',
  `per_createdate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่เพิ่มสิทธิ์ (ตัวอย่าง 2022-09-24 04:04:20)',
  `per_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะของสิทธิ์ (0 ถูกลบ, 1 ปกติ)',
  `per_p_id` int(11) NOT NULL COMMENT 'ไอดีโครงการ (ตัวอย่าง 1)',
  `per_u_id` int(11) NOT NULL COMMENT 'ไอดีพนักงาน (ตัวอย่าง 1)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางสิทธิ์ในโครงการ';

-- --------------------------------------------------------

--
-- Table structure for table `pms_project`
--

CREATE TABLE `pms_project` (
  `p_id` int(11) NOT NULL COMMENT 'ไอดีโครงการ (ตัวอย่าง 1)',
  `p_name` varchar(100) NOT NULL COMMENT 'ชื่อโครงการ (ตัวอย่าง ระบบร้านกาแฟ)',
  `p_customer` varchar(100) NOT NULL COMMENT 'ชื่อลูกค้า (ตัวอย่าง ปาริยา สุวรรณวงศ์)',
  `p_telcontact` varchar(10) DEFAULT NULL COMMENT 'เบอร์โทรติดต่อของลูกค้า 10 หลัก (ตัวอย่าง 0987654321)',
  `p_linecontact` varchar(50) DEFAULT NULL COMMENT 'ไอดีไลน์ลูกค้า (ตัวอย่าง pariya99)',
  `p_emailcontact` varchar(100) DEFAULT NULL COMMENT 'อีเมลของลูกค้า (ตัวอย่าง  pariya@gmail.com)',
  `p_othercontact` varchar(100) DEFAULT NULL COMMENT 'ช่องทางติดต่ออื่น ๆ (ตัวอย่าง Facebook : Pariya)',
  `p_detail` varchar(1000) NOT NULL COMMENT 'รายละเอียดโครงการ (ตัวอย่าง ระบบสำหรับ...)',
  `p_address` varchar(1000) DEFAULT NULL COMMENT 'ที่อยู่ลูกค้า(ใช้ iframe จาก Google)',
  `p_createdate` date NOT NULL COMMENT 'วันที่เริ่มโครงการ (ตัวอย่าง 2022-08-01)',
  `p_enddate` date DEFAULT NULL COMMENT 'วันที่สิ้นสุดโครงการ (ตัวอย่าง 2022-09-01)',
  `p_countdown` datetime DEFAULT NULL COMMENT 'กำหนดเวลากู้คืนโครงการ (ตัวอย่าง 2022-10-28 14:15:29)',
  `p_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะโครงการ (น้อยกว่า 1 ถูกลบ, 1 รอดำเนินการ, 2 กำลังดำเนินการ, 3 สำเร็จ, 4 ยกเลิก)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางโครงการ';

-- --------------------------------------------------------

--
-- Table structure for table `pms_task`
--

CREATE TABLE `pms_task` (
  `t_id` int(11) NOT NULL COMMENT 'ไอดีกิจกรรม (ตัวอย่าง 1)',
  `t_detail` varchar(1000) NOT NULL COMMENT 'รายละเอียด (ตัวอย่าง เสนอราคาลูกค้า...)',
  `t_createdate` datetime NOT NULL COMMENT 'วันที่เพิ่ม (ตัวอย่าง 2022-08-01)',
  `t_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะกิจกรรม (0 ถูกลบ , 1 ปกติ)',
  `t_tl_id` int(11) NOT NULL COMMENT 'ไอดีชื่อกิจกรรม (ตัวอย่าง 1)',
  `t_p_id` int(11) NOT NULL COMMENT 'ไอดีโครงการ (ตัวอย่าง 1)',
  `t_u_id` int(11) NOT NULL COMMENT 'ไอดีพนักงาน (ตัวอย่าง 1)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางกิจกรรม';

-- --------------------------------------------------------

--
-- Table structure for table `pms_tasklist`
--

CREATE TABLE `pms_tasklist` (
  `tl_id` int(11) NOT NULL COMMENT 'ไอดีชื่อกิจกรรม (ตัวอย่าง 1)',
  `tl_name` varchar(100) NOT NULL COMMENT 'ชื่อกิจกรรม (ตัวอย่าง เสนอราคา)',
  `tl_createdate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่เพิ่ม (ตัวอย่าง 2022-09-12 11:14:08)',
  `tl_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะของชื่อกิจกรรม (0 ถูกลบ, 1 ปกติ)',
  `tl_u_id` int(11) NOT NULL COMMENT 'ไอดีพนักงาน (ตัวอย่าง 1)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางรายชื่อกิจกรรม';

-- --------------------------------------------------------

--
-- Table structure for table `pms_user`
--

CREATE TABLE `pms_user` (
  `u_id` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้ (ตัวอย่าง 1)',
  `u_email` varchar(100) NOT NULL COMMENT 'อีเมล (ตัวอย่าง supapit@gmail.com)',
  `u_password` varchar(100) NOT NULL COMMENT 'รหัสผ่าน (เข้ารหัสข้อมูล)',
  `u_firstname` varchar(100) NOT NULL COMMENT 'ชื่อ (ตัวอย่าง ศุภาพิชญ์)',
  `u_lastname` varchar(100) NOT NULL COMMENT 'นามสกุล (ตัวอย่าง สุวรรณวงศ์)',
  `u_tel` varchar(10) NOT NULL COMMENT 'เบอร์โทร (ตัวอย่าง 0894456871)',
  `u_createdate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่เพิ่ม (ตัวอย่าง 2022-09-13 16:07:40)',
  `u_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะผู้ใช้ (0 ถูกระงับ, 1 ปกติ)',
  `u_creator` int(11) NOT NULL COMMENT 'ผู้ที่ทำการเพิ่ม (ตัวอย่าง 1)',
  `u_role` int(11) NOT NULL COMMENT 'สิทธิ์ในการใช้งาน (น้อยกว่า 1 super admin, 1 ผู้ดูแลระบบ, 2 หัวหน้าโครงการ, 3 พนักงาน)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางผู้ใช้';

--
-- Dumping data for table `pms_user`
--

INSERT INTO `pms_user` (`u_id`, `u_email`, `u_password`, `u_firstname`, `u_lastname`, `u_tel`, `u_createdate`, `u_status`, `u_creator`, `u_role`) VALUES
(1, 'secret@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ปฏิภาณ', 'ปั้นสง่า', '0912345671', '2022-08-01 03:00:00', 1, 1, -1),
(2, '63160018@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ธนพงศ์', 'หงษ์บิน', '0989340452', '2022-08-01 03:00:00', 1, 1, -1),
(3, '63160290@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ปวันรัตน์', 'ตั้งประเสริฐ', '0675340120', '2022-08-01 03:00:00', 1, 1, -1),
(4, '63160246@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'จิรเดช', 'ป้อมใหญ่', '0860136623', '2022-08-01 03:00:00', 1, 1, -1),
(5, '63160239@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ณัฐกิตติ์', 'ชัยกล้าหาญ', '0927373262', '2022-08-01 03:00:00', 1, 1, -1),
(6, '63160258@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'มติมนต์', 'นรดี', '0912297285', '2022-08-01 03:00:00', 1, 1, -1),
(7, '63160234@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'กิติวัฒน์', 'อรุญวงษ์', '0835297285', '2022-08-01 03:00:00', 1, 1, -1),
(8, '63160238@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ณฐกร', 'พงษ์สาริกิจ', '0978519188', '2022-08-01 03:00:00', 1, 1, -1),
(9, '63160265@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'สิรภัทร', 'ตันเสวตวงษ์', '0870598760', '2022-08-01 03:00:00', 1, 1, -1),
(10, '63160248@go.buu.ac.th', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ปฏิภาณ', 'ปั้นสง่า', '0810584731', '2022-08-01 03:00:00', 1, 1, -1),
(11, 'test@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ขจรศักดิ์', 'ผักใบเขียว', '0838853168', '2022-08-01 03:00:00', 1, 1, 1),
(12, 'nawarat.passakul@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'นวรัตน์', 'พาสกุล', '0822801109', '2022-08-01 03:00:00', 1, 1, 2),
(13, 'sunisa.su@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'สุนิษา', 'สุพรรณภาคิน', '0687025049', '2022-08-01 03:00:00', 1, 1, 2),
(14, 'rachapol@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ธัชพล', 'พงศ์พิโรจ', '0848430664', '2022-08-01 03:00:00', 1, 1, 3),
(15, 'ronnaporn.tada@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'รณพร', 'ธาดาวรวงศ์', '0644219211', '2022-08-01 03:00:00', 1, 1, 3),
(16, 'phonlaphat.pi@gmail.com', 'f9194e73f9e9459e3450ea10a179cdf77aafa695beecd3b9344a98d111622243', 'พลภัทร', 'พิจิตเจริญวงศ์', '0832438221', '2022-08-01 03:00:00', 1, 1, 3),
(17, 'yodsaphat2907@gmail.com', 'f9194e73f9e9459e3450ea10a179cdf77aafa695beecd3b9344a98d111622243', 'ยศพัฒน์', 'พิชิตชัย', '0617610871', '2022-08-01 03:00:00', 1, 1, 3),
(18, 'bawornwit.ko@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'บวรวิทย์', 'คมปราชญ์', '0839386762', '2022-08-01 03:00:00', 1, 1, 3),
(19, 'piyarom.sri@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ปิยรมย์', 'ศรีวรรณวิไล', '0651338630', '2022-08-01 03:00:00', 1, 1, 3),
(20, 'apple.kulanan@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'กุลนันท์', 'พงษ์ธนาพัฒน์', '0637237711', '2022-08-01 03:00:00', 1, 1, 2),
(21, 'pongsit1010@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'พงษ์สิทธิ์', 'อุดมเสก', '0937237799', '2022-08-01 03:00:00', 1, 1, 3),
(22, 'thanaphat0901@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ธนภัทร', 'จรัสธรรม', '0836949645', '2022-08-01 03:00:00', 1, 1, 2),
(23, 'napassorn.jan@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'นภัสสร', 'จันทรพร', '0906219227', '2022-08-01 03:00:00', 1, 1, 3),
(24, 'sopol2406@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'โสพล', 'จันทรทรัพย์', '0816804298', '2022-08-01 03:00:00', 1, 1, 3),
(25, 'suchada1512@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'สุชาดา', 'พินิจนันท์', '0652864431', '2022-08-01 03:00:00', 1, 1, 3),
(26, 'sommat@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'สมมาตร', 'รักดี', '0612412412', '2022-09-11 14:07:28', 0, 11, 3),
(27, 'ponganan@gmail.com', '7e77ef5235e0cfa21343ce5fc578ac8e91c1a30caa8407e2fcd501653b72d35e', 'พงษ์อนันต์', 'ตั้งตระกูลเจริญ', '0698812211', '2022-09-20 06:06:33', 1, 11, 3),
(28, 'anriya@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'อัญริญา', 'ธาดาวรวงศ์', '0891248453', '2022-09-20 06:28:25', 1, 1, 3),
(29, 'test1@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'สมพงษ์', 'ใจดี', '0922222222', '2022-10-05 18:36:56', 1, 11, 3),
(30, 'somrakjaidee@gmail.com', 'f9e8c94f5fbd0d2cb14ba84848d3431e8118d6c42911d5f2138a3804a697f631', 'สมรัก', 'ใจดี', '0912333333', '2022-12-07 14:50:26', 1, 11, 3),
(31, 'somsri@gmail.com', '3f017cf319d70c23dab83ced4e51e506da6393dc72c302e3cd00dfb42ccc5d4b', 'สมศรี', 'ใจดี', '0811111111', '2022-12-28 17:29:33', 1, 11, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pms_cancel`
--
ALTER TABLE `pms_cancel`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `pms_cancellist`
--
ALTER TABLE `pms_cancellist`
  ADD PRIMARY KEY (`cl_id`);

--
-- Indexes for table `pms_file`
--
ALTER TABLE `pms_file`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `pms_log`
--
ALTER TABLE `pms_log`
  ADD PRIMARY KEY (`l_id`);

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
-- AUTO_INCREMENT for table `pms_cancel`
--
ALTER TABLE `pms_cancel`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีการยุติโครงการ (ตัวอย่าง 1)	';

--
-- AUTO_INCREMENT for table `pms_cancellist`
--
ALTER TABLE `pms_cancellist`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีสาเหตุยุติโครงการ (ตัวอย่าง 1)';

--
-- AUTO_INCREMENT for table `pms_file`
--
ALTER TABLE `pms_file`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีไฟล์ (ตัวอย่าง 1)';

--
-- AUTO_INCREMENT for table `pms_log`
--
ALTER TABLE `pms_log`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีบันทึก (ตัวอย่าง 1)';

--
-- AUTO_INCREMENT for table `pms_permission`
--
ALTER TABLE `pms_permission`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีสิทธิ์ (ตัวอย่าง 1)';

--
-- AUTO_INCREMENT for table `pms_project`
--
ALTER TABLE `pms_project`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีโครงการ (ตัวอย่าง 1)';

--
-- AUTO_INCREMENT for table `pms_task`
--
ALTER TABLE `pms_task`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีกิจกรรม (ตัวอย่าง 1)';

--
-- AUTO_INCREMENT for table `pms_tasklist`
--
ALTER TABLE `pms_tasklist`
  MODIFY `tl_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีชื่อกิจกรรม (ตัวอย่าง 1)';

--
-- AUTO_INCREMENT for table `pms_user`
--
ALTER TABLE `pms_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้ใช้ (ตัวอย่าง 1)', AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
