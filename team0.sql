-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2022 at 05:08 PM
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

--
-- Dumping data for table `pms_log`
--

INSERT INTO `pms_log` (`l_id`, `l_action`, `l_table`, `l_data`, `l_command`, `l_createdate`, `l_u_id`) VALUES
(1, 'add', 'pms_user', '{\"u_id\":\"new\",\"u_firstname\":\"สมมาตร\",\"u_lastname\":\"รักดี\",\"u_email\":\"sommat@gmail.com\",\"u_tel\":\"0612412412\",\"u_role\":\"3\",\"u_password\":\"c7efcbe959b502b170891067d656bddb254b62fb087038075f39bf3da444c3c5\",\"u_creator\":\"11\"}', 'INSERT INTO `pms_user` (`u_id`, `u_firstname`, `u_lastname`, `u_email`, `u_tel`, `u_role`, `u_password`, `u_creator`) VALUES (\'new\', \'สมมาตร\', \'รักดี\', \'sommat@gmail.com\', \'0612412412\', \'3\', \'c7efcbe959b502b170891067d656bddb254b62fb087038075f39bf3da444c3c5\', \'11\')', '2022-09-11 18:14:08', 11),
(2, 'update', 'pms_user', '{\"u_role\":\"2\"}', 'UPDATE `pms_user` SET `u_role` = \'2\'\nWHERE `u_id` = \'20\'', '2022-09-11 19:34:44', 1),
(3, 'update', 'pms_user', '{\"u_password\":\"5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5\"}', 'UPDATE `pms_user` SET `u_password` = \'5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5\'\nWHERE `u_id` = \'20\'', '2022-09-12 15:01:07', 11),
(4, 'update', 'pms_user', '{\"u_status\":\"0\"}', 'UPDATE `pms_user` SET `u_status` = \'0\'\nWHERE `u_id` = \'20\'', '2022-09-13 09:07:40', 11),
(5, 'update', 'pms_user', '{\"u_status\":\"1\"}', 'UPDATE `pms_user` SET `u_status` = \'1\'\nWHERE `u_id` = \'20\'', '2022-09-13 09:07:44', 11),
(6, 'update', 'pms_user', '{\"u_password\":\"03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4\"}', 'UPDATE `pms_user` SET `u_password` = \'03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4\'\nWHERE `u_id` = \'18\'', '2022-09-13 09:29:21', 1),
(7, 'update', 'pms_user', '{\"u_status\":\"0\"}', 'UPDATE `pms_user` SET `u_status` = \'0\'\nWHERE `u_id` = \'20\'', '2022-09-13 11:09:09', 11),
(8, 'update', 'pms_user', '{\"u_status\":\"1\"}', 'UPDATE `pms_user` SET `u_status` = \'1\'\nWHERE `u_id` = \'20\'', '2022-09-13 11:09:37', 11),
(9, 'update', 'pms_user', '{\"u_status\":\"0\"}', 'UPDATE `pms_user` SET `u_status` = \'0\'\nWHERE `u_id` = \'20\'', '2022-09-13 11:10:31', 11),
(10, 'update', 'pms_user', '{\"u_status\":\"1\"}', 'UPDATE `pms_user` SET `u_status` = \'1\'\nWHERE `u_id` = \'20\'', '2022-09-13 11:10:37', 11),
(11, 'update', 'pms_user', '{\"u_status\":\"0\"}', 'UPDATE `pms_user` SET `u_status` = \'0\'\nWHERE `u_id` = \'20\'', '2022-09-13 11:16:01', 4),
(12, 'update', 'pms_user', '{\"u_status\":\"1\"}', 'UPDATE `pms_user` SET `u_status` = \'1\'\nWHERE `u_id` = \'20\'', '2022-09-13 11:16:05', 4),
(13, 'update', 'pms_user', '{\"u_status\":\"0\"}', 'UPDATE `pms_user` SET `u_status` = \'0\'\nWHERE `u_id` = \'20\'', '2022-09-13 11:16:14', 4),
(14, 'update', 'pms_user', '{\"u_status\":\"1\"}', 'UPDATE `pms_user` SET `u_status` = \'1\'\nWHERE `u_id` = \'20\'', '2022-09-13 11:16:20', 4),
(15, 'update', 'pms_user', '{\"u_status\":\"0\"}', 'UPDATE `pms_user` SET `u_status` = \'0\'\nWHERE `u_id` = \'20\'', '2022-09-13 11:16:33', 4),
(16, 'update', 'pms_user', '{\"u_status\":\"1\"}', 'UPDATE `pms_user` SET `u_status` = \'1\'\nWHERE `u_id` = \'20\'', '2022-09-13 11:16:39', 4),
(17, 'update', 'pms_user', '{\"u_status\":\"0\"}', 'UPDATE `pms_user` SET `u_status` = \'0\'\nWHERE `u_id` = \'20\'', '2022-09-14 18:08:37', 11),
(18, 'update', 'pms_user', '{\"u_status\":\"1\"}', 'UPDATE `pms_user` SET `u_status` = \'1\'\nWHERE `u_id` = \'20\'', '2022-09-14 18:09:09', 11),
(19, 'update', 'pms_user', '{\"u_password\":\"03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4\"}', 'UPDATE `pms_user` SET `u_password` = \'03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4\'\nWHERE `u_id` = \'26\'', '2022-09-15 17:34:19', 11),
(20, 'update', 'pms_user', '{\"u_password\":\"5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5\"}', 'UPDATE `pms_user` SET `u_password` = \'5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5\'\nWHERE `u_id` = \'11\'', '2022-09-15 17:49:15', 11),
(21, 'update', 'pms_user', '{\"u_status\":\"0\"}', 'UPDATE `pms_user` SET `u_status` = \'0\'\nWHERE `u_id` = \'26\'', '2022-09-15 17:58:20', 1),
(22, 'update', 'pms_user', '{\"u_password\":\"03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4\"}', 'UPDATE `pms_user` SET `u_password` = \'03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4\'\nWHERE `u_id` = \'11\'', '2022-09-15 21:37:06', 11),
(23, 'update', 'pms_user', '{\"u_status\":\"1\"}', 'UPDATE `pms_user` SET `u_status` = \'1\'\nWHERE `u_id` = \'26\'', '2022-09-16 15:58:48', 11),
(24, 'update', 'pms_user', '{\"u_status\":\"0\"}', 'UPDATE `pms_user` SET `u_status` = \'0\'\nWHERE `u_id` = \'26\'', '2022-09-16 15:58:55', 11),
(25, 'update', 'pms_user', '{\"u_status\":\"1\"}', 'UPDATE `pms_user` SET `u_status` = \'1\'\nWHERE `u_id` = \'26\'', '2022-09-16 15:59:09', 11),
(26, 'update', 'pms_user', '{\"u_status\":\"0\"}', 'UPDATE `pms_user` SET `u_status` = \'0\'\nWHERE `u_id` = \'26\'', '2022-09-16 15:59:13', 11),
(27, 'update', 'pms_user', '{\"u_firstname\":\"กุลนันท์\",\"u_lastname\":\"พงษ์ธนาพัฒน์\",\"u_email\":\"apple.kulanan@gmail.com\",\"u_tel\":\"0637237711\",\"u_role\":\"2\"}', 'UPDATE `pms_user` SET `u_firstname` = \'กุลนันท์\', `u_lastname` = \'พงษ์ธนาพัฒน์\', `u_email` = \'apple.kulanan@gmail.com\', `u_tel` = \'0637237711\', `u_role` = \'2\'\nWHERE `u_id` = \'20\'', '2022-09-20 06:05:23', 11),
(28, 'add', 'pms_user', '{\"u_id\":\"new\",\"u_firstname\":\"พงษ์อนันต์\",\"u_lastname\":\"ตั้งตระกูลเจริญ\",\"u_email\":\"ponganan@gmail.com\",\"u_tel\":\"0698812214\",\"u_role\":\"3\",\"u_password\":\"7e77ef5235e0cfa21343ce5fc578ac8e91c1a30caa8407e2fcd501653b72d35e\",\"u_creator\":\"11\"}', 'INSERT INTO `pms_user` (`u_id`, `u_firstname`, `u_lastname`, `u_email`, `u_tel`, `u_role`, `u_password`, `u_creator`) VALUES (\'new\', \'พงษ์อนันต์\', \'ตั้งตระกูลเจริญ\', \'ponganan@gmail.com\', \'0698812214\', \'3\', \'7e77ef5235e0cfa21343ce5fc578ac8e91c1a30caa8407e2fcd501653b72d35e\', \'11\')', '2022-09-20 06:06:33', 11),
(29, 'update', 'pms_user', '{\"u_role\":\"2\"}', 'UPDATE `pms_user` SET `u_role` = \'2\'\nWHERE `u_id` = \'27\'', '2022-09-20 06:27:37', 1),
(30, 'update', 'pms_user', '{\"u_role\":\"3\"}', 'UPDATE `pms_user` SET `u_role` = \'3\'\nWHERE `u_id` = \'27\'', '2022-09-20 06:27:43', 1),
(31, 'add', 'pms_user', '{\"u_id\":\"new\",\"u_firstname\":\"อัญริญา\",\"u_lastname\":\"ธาดาวรวงศ์\",\"u_email\":\"anriya@gmail.com\",\"u_tel\":\"0891248453\",\"u_role\":\"3\",\"u_password\":\"d2c727c5d4ee46d57a27a4a4018bf0aa804d8739f2847fe86e14f845d0870bef\",\"u_creator\":\"1\"}', 'INSERT INTO `pms_user` (`u_id`, `u_firstname`, `u_lastname`, `u_email`, `u_tel`, `u_role`, `u_password`, `u_creator`) VALUES (\'new\', \'อัญริญา\', \'ธาดาวรวงศ์\', \'anriya@gmail.com\', \'0891248453\', \'3\', \'d2c727c5d4ee46d57a27a4a4018bf0aa804d8739f2847fe86e14f845d0870bef\', \'1\')', '2022-09-20 06:28:25', 1),
(32, 'update', 'pms_user', '{\"u_password\":\"03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4\"}', 'UPDATE `pms_user` SET `u_password` = \'03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4\'\nWHERE `u_id` = \'20\'', '2022-09-24 08:54:09', 11),
(33, 'update', 'pms_tasklist', '{\"tl_status\":\"0\"}', 'UPDATE `pms_tasklist` SET `tl_status` = \'0\'\nWHERE `tl_id` = \'3\'', '2022-09-27 10:20:42', 11),
(34, 'update', 'pms_tasklist', '{\"tl_status\":\"1\"}', 'UPDATE `pms_tasklist` SET `tl_status` = \'1\'\nWHERE `tl_id` = \'3\'', '2022-09-27 10:20:56', 11),
(35, 'update', 'pms_tasklist', '{\"tl_status\":\"0\"}', 'UPDATE `pms_tasklist` SET `tl_status` = \'0\'\nWHERE `tl_id` = \'3\'', '2022-09-27 10:21:38', 11),
(36, 'update', 'pms_tasklist', '{\"tl_status\":\"1\"}', 'UPDATE `pms_tasklist` SET `tl_status` = \'1\'\nWHERE `tl_id` = \'3\'', '2022-09-27 10:21:44', 11),
(37, 'add', 'pms_tasklist', '{\"tl_id\":\"new\",\"tl_name\":\"ประชุม\",\"tl_u_id\":\"11\"}', 'INSERT INTO `pms_tasklist` (`tl_id`, `tl_name`, `tl_u_id`) VALUES (\'new\', \'ประชุม\', \'11\')', '2022-09-28 18:55:15', 11),
(38, 'add', 'pms_tasklist', '{\"tl_id\":\"new\",\"tl_name\":\"ทดสอบระบบ\",\"tl_u_id\":\"11\"}', 'INSERT INTO `pms_tasklist` (`tl_id`, `tl_name`, `tl_u_id`) VALUES (\'new\', \'ทดสอบระบบ\', \'11\')', '2022-09-28 20:39:08', 11),
(39, 'add', 'pms_project', '{\"p_id\":\"new\",\"p_name\":\"พัฒนาระบบคลังสินค้า\",\"p_detail\":\"ระบบคลังสินค้าของบริษัท ......\",\"p_customer\":\"บริษัท .....\",\"p_createdate\":\"2022-09-30\",\"p_contact\":\"จคุๅๅ---จ\"}', 'INSERT INTO `pms_project` (`p_id`, `p_name`, `p_detail`, `p_customer`, `p_createdate`, `p_contact`) VALUES (\'new\', \'พัฒนาระบบคลังสินค้า\', \'ระบบคลังสินค้าของบริษัท ......\', \'บริษัท .....\', \'2022-09-30\', \'จคุๅๅ---จ\')', '2022-09-29 09:51:12', 11),
(40, 'add', 'pms_permission', '{\"per_role\":1,\"per_p_id\":\"15\",\"per_u_id\":\"11\"}', 'INSERT INTO `pms_permission` (`per_role`, `per_p_id`, `per_u_id`) VALUES (1, \'15\', \'11\')', '2022-09-29 09:51:12', 11);

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

--
-- Dumping data for table `pms_permission`
--

INSERT INTO `pms_permission` (`per_id`, `per_role`, `per_createdate`, `per_status`, `per_p_id`, `per_u_id`) VALUES
(1, 1, '2022-09-23 21:04:20', 1, 1, 20),
(2, 1, '2022-09-23 21:04:20', 1, 2, 20),
(3, 1, '2022-09-23 21:04:20', 1, 3, 12),
(4, 1, '2022-09-23 21:04:20', 1, 4, 22),
(5, 1, '2022-09-23 21:06:44', 1, 5, 20),
(6, 1, '2022-09-23 21:06:46', 1, 6, 20),
(7, 1, '2022-09-23 21:07:41', 1, 7, 12),
(8, 1, '2022-09-23 21:07:43', 1, 8, 13),
(9, 1, '2022-09-23 21:08:30', 1, 9, 20),
(10, 1, '2022-09-23 21:08:32', 1, 10, 22),
(11, 1, '2022-09-24 08:46:27', 1, 11, 12),
(12, 1, '2022-09-24 08:46:36', 1, 12, 20),
(13, 1, '2022-09-24 08:47:11', 1, 13, 20),
(14, 1, '2022-09-24 08:47:13', 1, 14, 12),
(15, 2, '2022-09-24 08:49:56', 1, 1, 15),
(16, 2, '2022-09-24 08:50:03', 1, 1, 16),
(17, 2, '2022-09-24 08:50:11', 1, 2, 15),
(18, 2, '2022-09-24 08:50:15', 1, 2, 16),
(19, 1, '2022-09-29 09:51:12', 1, 15, 11);

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
  `p_detail` varchar(1000) NOT NULL COMMENT 'รายละเอียดโครงการ (ตัวอย่าง ระบบสำหรับ...)',
  `p_createdate` date NOT NULL COMMENT 'วันที่เริ่มโครงการ (ตัวอย่าง 2022-08-01)',
  `p_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะโครงการ (น้อยกว่า 1 ถูกลบ, 1 รอดำเนินการ, 2 กำลังดำเนินการ, 3 สำเร็จ, 4 ยกเลิก)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางโครงการ';

--
-- Dumping data for table `pms_project`
--

INSERT INTO `pms_project` (`p_id`, `p_name`, `p_customer`, `p_telcontact`, `p_linecontact`, `p_emailcontact`, `p_detail`, `p_createdate`, `p_status`) VALUES
(1, 'โครงการบริจาคคอมพิวเตอร์ เพื่อน้อง', 'อัญชิสา ธนากานต์', '0801422517', NULL, NULL, 'โครงการคอมพิวเตอร์เพื่อน้อง มูลนิธิกระจกเงา รับบริจาคคอมพิวเตอร์ Notebook , Printer , Mouse , Keyboard , Scanner และอุปกรณ์พ่วงต่อทุกชนิด \r\nทุกสภาพการใช้งาน (พังแล้วก็รับครับ) ทาง จนท.จะตรวจเช็คสภาพ ทำให้อุปกรณ์สมบูรณ์พร้อมใช้งาน\r\nและจะนำส่งมอบต่อให้กับโรงเรียนในต่างจังหวัด ที่ยังขาดแคลนคอมพิวเตอร์เพื่อใช้เป็นสื่อการเรียนการสอน \r\nให้กับเด็กนักเรียน ซึ่งในแต่ละเดือนจะมีโรงเรียนติดต่อมาขอรับคอมพิวเตอร์กับทางโครงการฯ ไม่ต่ำกว่า 20 โรงเรียน\r\n*อุปกรณ์พ่วงต่อคอมพิวเตอร์ที่ไม่สามารถซ่อมแซมได้ จะอยู่ในโหมดของขยะอิเล็กทรอนิกส์* “ คอมพิวเตอร์ของคุณ คอมพิวเตอร์เพื่อน้อง” \r\n( มูลนิธิกระจกเงา รับบริจาค หนังสือ, เสื้อผ้า , คอมพิวเตอร์, เฟอร์นิเจอร์ ,เครื่องใช้ไฟฟ้า ,ผ้าอ้อมผู้ใหญ่ \r\n,อุปกรณ์การแพทย์ ,ข้าวสาร อาหารแห้ง,ของใช้ในครัวเรือน และสิ่งของสภาพดีทุกประเภท )', '2022-08-01', 2),
(2, 'Document Management System', 'ภาธร วิเชียรชาญ', '0601422517', NULL, NULL, 'ระบบจัดการไฟล์เอกสารในบริษัท', '2022-08-01', 3),
(3, 'SE Delivery (Moblie application)', 'ชนายุส แสนสุวรรณวงศ์', '0948756931', NULL, NULL, 'SE Delivery คือ ฟีเจอร์ส่งอาหารที่มอบความสะดวกสบายให้กับร้านอาหารและลูกค้าไปพร้อม ๆ กัน มาพร้อม Automation ระบบอัตโนมัติที่ช่วยให้เจ้าของร้านอาหารปิดการขายได้เร็วขึ้น ในส่วนของลูกค้าก็เลือกเมนูบนเว็บไซต์ของร้านได้เลย ไม่ต้องทักแชท หรือรอร้านตอบให้เสียเวลา', '2022-08-01', 4),
(4, 'ระบบจองตั๋วหนัง SE MAJOR GROUP', 'วรรณภา ชัยภูมิ', '032698741', NULL, NULL, 'SE MAJOR GROUP เป็นระบบจองตั๋วหนัง โดยมีการแสดงรายละเอียดเกี่ยวกับภาพยนตร์ มีชื่อภาพยนตร์ ความยาวของภาพยนตร์ที่จะฉาย \r\nประเภทภาพยนตร์ และภาพยนตร์ที่นำมาฉายสังกัดค่ายภาพยนตร์ใด จำนวนฟิลด์ที่ใช้ฉาย และชนิดของเสียงภาพยนตร์เป็นแบบใด\r\nโรงภาพยนตร์ (Theater) รายละเอียดของโรงภาพยนตร์ต้องมีหมายเลขของโรงภาพยนตร์ จำนวนที่นั่งของผู้ชมและสามารถจุจำนวนที่นั่งสูงสุดของผู้เข้าชม จำนวนผู้เข้าชมในแต่ละโรงภาพนยนตร์\r\nลูกค้า (Customer) ผู้ที่จะมาดูภาพยนตร์โดยที่ผู้ชมจะดูรายการภาพยนตร์ของโรงภาพยนตร์แต่ละโรง ดูเวลาเริ่มฉาย เดินเข้าไปซื้อบัตรเข้าชมโดยต้องบอกชื่อภาพยนตร์ \r\nหมายเลขโรง รอบที่ฉายให้กับพนักงานทราบ พนักงานก็จะถามตำแหน่งและจำนวนที่นั่งที่ต้องการ ชำระเงินและรับตั๋ว', '2022-08-01', 4),
(5, 'ระบบจองห้องพัก ณ โรงแรมปวันรัตน์ กรุ๊ป', 'นาถินี เจริญผลวัฒนา', '0666966699', NULL, NULL, 'ระบบจองโรงแรม ปวันรัตน์ กรุ๊ป ซึ่งในระบบจะประกอบไปด้วยผู้ดูแล\r\nระบบ (admin) และส่วนของลูกค้า ซึ่งในส่วนผู้ดูแลระบบ (admin) จะสามารถกดเพิ่ม ลบ แก้ไข\r\nข้อมูลห้องพัก ข้อมูลข่าวประชาสัมพันธ์ ยืนยันการจอง และตรวจสอบการชำระเงินของลูกค้า และ\r\nในส่วนลูกค้าจะสามารถสมัครสมาชิก เรียกดูข่าวประชาสัมพันธ์ จองห้องพัก ทำาการชำระเงิน\r\nนอกจากนี้ระบบยังมีการจัดเก็บข้อมูลที่เป็นระเบียบซึ่งส่งผลดีต่อผู้ใช้งานและผู้ดูแลระบบ ทำให้ข้อมูล\r\nถูกเก็บอย่างปลอดภัย ทำให้ง่ายต่อการค้นหาและใช้งาน ', '2022-08-01', 2),
(6, 'ระบบตรวจวัดสารเคมีปนเปื้อนในน้ำแบบดิจิทัล', 'โสรยา ปานประกอบ', '0902205522', NULL, NULL, 'การตรวจวัดปริมาณสารเคมีปนเปื้อนในน้ำ โดยวัดความเข้มข้นของสีของน้ำตัวอย่างที่เปลี่ยนไปตามความเข้มข้นของสารเคมีในน้ำที่ทำปฏิกิริยาเคมีกับสารละลายทดสอบ \r\nซึ่งระบบนี้สามารถใช้ทดสอบคุณภาพน้ำได้ในหลายๆ ด้าน เช่น บ่อเพาะเลี้ยงสัตว์น้ำเศรษฐกิจ บ่อน้ำทิ้งหลังจากการบำบัดจากโรงงานอุตสาหกรรม \r\nสีย้อมจากโรงงานสีย้อมผ้า และระบบน้ำประปา ซึ่งจะทำให้ผู้ใช้งานเห็นแนวโน้มของสิ่งปนเปื้อนในน้ำ อันจะนำไปสู่การวางแผนในกระบวนการผลิตและการบำบัดน้ำเสียได้อย่างมีประสิทธิภาพต่อไป', '2022-08-01', 2),
(7, 'โครงการถนนคนละสาย', 'นีรา นันทภักดิ์', '0857522413', NULL, NULL, 'ถนนสายหน้ามหาวิทยลัยบูณพา เป็นถนนถายในเขตเทศบาลตำบลแสนสุขที่มีความสำคัญสายหนึ่ง ซึ่งมีราษฏรจำนวนมากได้ใช้\r\nเดินทางสัญจรไป - มาและใช้ในการขนส่งผลผลิตทางการเกษตรออกสู่ตลาดนอกจากนั้น ยังมีราษฏรในเขตพื้นที่ใกล้เคียงที่ได้ใช้\r\nปรโยชน์จากถนนสายนี้ในการสัญจรไป - มา', '2022-08-12', 1),
(8, 'โปรเจคติดตาม ตรวจสอบ สถานะของโครงการ', 'ณิชมน พิชิตชัย', '0812366770', NULL, NULL, 'ระบบติดตาม ตรวจสอบ สถานะของโครงการ (Project Monitoring System : PMS)\r\nเป็นระบบงานที่เกี่ยวกับการจัดการเก็บข้อมูลของโปรเจคที่บริษัทท า ผู้ดูแลโปรเจคที่ท า และท า\r\nสถิติของงานทั้งหมดอัตโนมัติด้วยซอฟต์แวร์ โดยการท างานของระบบที่สามารถท างานได้มีดังนี้\r\nระบบสามารถดูภาพรวมของระบบได้ เข้าสู ่ระบบ ออกจากระบบ จัดการข้อมูลส ่วนตัวของ\r\nผู้ใช้งาน', '2022-08-14', 1),
(9, 'โปรเจคทัวร์เที่ยวไทย', 'วริศ เลิศวิทยา', '0639633693', NULL, NULL, 'เป็นโปรเจค เพื่อเป็นการส่งเสริมการท่องเที่ยวในประเทศ เพิ่มประสบการณ์ของนักท่องเที่ยว ตลอดจนเพิ่มช่องทางการเข้าถึงผู้ประกอบการท่องเที่ยวได้มากขึ้น \r\nเว็บไซต์ “ทัวร์เที่ยวไทย.ไทย” (www.ทัวร์เที่ยวไทย.ไทย) จึงเป็นเว็บไซต์ที่มีโดเมนเนมเป็นภาษาไทย โดยการท่องเที่ยวแห่งประเทศไทย (ททท.) \r\nได้ร่วมกับคณะกรรมการธุรกรรมทางอิเล็กทรอนิกส์ (คธอ.), สำนักงานพัฒนาธุรกรรมทางอิเล็กทรอนิกส์ (สพธอ. หรือ ETDA) และมูลนิธิศูนย์สารสนเทศเครือข่ายไทย (THNIC) \r\nได้ร่วมมือกันเพื่อเป็นการนำร่องการใช้โดเมนภาษาไทย ที่จะช่วยสร้างความเชื่อมั่นให้กับผู้ใช้งานว่าเป็นเว็บไซต์ที่น่าเชื่อถือ ช่วยลดความเสี่ยงของการหลอกลวงชื่อเว็บไซต์ (Phishing) \r\nทางออนไลน์ได้ และยังเป็นการส่งเสริมการท่องเที่ยวไปยังชุนชนต่างๆ ของประเทศได้แพร่หลายมากขึ้น', '2022-08-16', 1),
(10, 'โครงการคนละข้าง', 'จักรภพ ปรีดาศิริกุล', '0877533578', NULL, NULL, 'โครงการคนละข้าง จัดขึ้นเพื่อกระตุ้นการจับจ่ายใช้สอยภายในประเทศ บรรเทาภาระค่าใช้จ่ายให้ประชาชน \r\nและช่วยเพิ่มสภาพคล่องให้ร้านค้ารายย่อย เป็นการสนับสนุนเศรษฐกิจฐานรากและฟื้นฟูเศรษฐกิจของประเทศในองค์รวม', '2022-09-19', 1),
(11, 'ระบบตรวจเช็คสถานะสินค้า', 'จันทรา ถนอมจิต', '0951599632', NULL, NULL, 'ระบบตรวจสอบสามารถใช้ได้กับการส่งไปรษณีย์ด่วนพิเศษในประเทศ (EMS), \r\nโลจิสโพสต์ในประเทศ, โลจิสโพสต์ระหว่างประเทศ, ไปรษณีย์ด่วนพิเศษระหว่างประเทศ, \r\nพัสดุไปรษณีย์ระหว่างประเทศ, ไปรษณีย์ลงทะเบียนระหว่างประเทศ และไปรษณีย์ลงทะเบียนในประเทศเท่านั้น', '2022-09-21', 1),
(12, 'ระบบตู้น้ำมันหยอดเหรียญออนไลน์', 'กุลนันท์ อุดมวงศ์', '0866322365', NULL, NULL, 'น้ำมันหยอดเหรียญออนไลน์ เป็นมากกว่าแค่ตู้เติมน้ำมันทั่วไป เพราะเราได้คิดนวัตกรรมเพื่อให้ตอบโจทย์ลูกค้าและให้ทันกับยุคสมัยที่จะมีการนำเทคโนโลยี \r\nระบบออนไลน์ และ Big data เข้ามาใช้ ตู้น้ำมันออนไลน์ โดยผู้ขายสามารถตรวจสอบข้อมูลน้ำมันคงเหลือภายในตู้ ข้อมูลผู้ใช้บริการ และข้อมูลอีกจำนวนมาถ \r\nรวมถึงการตั้ง Promotion ในการขายได้เอง และนอกจากนี้ยังมีบริการอื่นๆ ร่วมด้วยในตู้น้ำมันหยอดเหรียญออนไลน์นี้ เช่น บริการเติมเงิน ชําระบิล และโอนเงิน \r\nและยังขยายไปยังการขายกาแฟและบริการอื่นๆ ได้อีกด้วย', '2022-09-21', 1),
(13, 'ระบบร้านกาแฟ', 'กุลจิรา สิริวาณิชย์', '0811919111', NULL, NULL, 'ระบบจัดการร้านกาแฟ', '2022-09-24', 1),
(14, 'ระบบจัดการเอกสารอัตโนมัติ Document Management', 'เมริสา เรืองสมัย', '0811919111', NULL, NULL, 'ระบบ AI และ Computer Vision สำหรับจัดการเอกสารและรูปภาพ ให้ทุกขั้นตอนเป็นระบบอัตโนมัติ ทำให้ช่วยลดเรื่องของค่าใช้จ่าย และเวลาในการจัดการเอกสารได้ หรือเพิ่มความรวดเร็วในการบริการได้ ตัวอย่างเช่น การทำธุรกรรมทางการเงินกับธนาคารที่ต้องรอสาขาเปิด รอเจ้าหน้าที่ตรวจสอบเอกสาร กรอกข้อมูลทีละใบๆ รอเจ้าหน้าที่อนุมัติขั้นตอนเหล่านี้อาจใช้เวลานานถึงสัปดาห์ ระบบของเราสามารถเข้าไปช่วยตั้งแต่การคัดแยก อ่าน และวิเคราะห์เอกสาร ให้ขั้นตอนเหล่านี้เป็นอัตโนมัติ และสามารถลดเวลาได้เหลือเพียงแค่ 5 นาที นอกจากนี้ ระบบของเรายังสามารถเข้าไปช่วยค้นหาเอกสารที่มีจำนวนมาก เราเข้าไปทำให้ระบบเอกสารสามารถค้นหาและหาเจอได้ทันที', '2022-09-25', 1),
(15, 'พัฒนาระบบคลังสินค้า', 'บริษัท .....', '0654012131', NULL, NULL, 'ระบบคลังสินค้าของบริษัท ......', '2022-09-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pms_task`
--

CREATE TABLE `pms_task` (
  `t_id` int(11) NOT NULL COMMENT 'ไอดีกิจกรรม (ตัวอย่าง 1)',
  `t_detail` varchar(1000) NOT NULL COMMENT 'รายละเอียด (ตัวอย่าง เสนอราคาลูกค้า...)',
  `t_createdate` date NOT NULL COMMENT 'วันที่เพิ่ม (ตัวอย่าง 2022-08-01)',
  `t_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะกิจกรรม (0 ถูกลบ , 1 ปกติ)',
  `t_tl_id` int(11) NOT NULL COMMENT 'ไอดีชื่อกิจกรรม (ตัวอย่าง 1)',
  `t_p_id` int(11) NOT NULL COMMENT 'ไอดีโครงการ (ตัวอย่าง 1)',
  `t_u_id` int(11) NOT NULL COMMENT 'ไอดีพนักงาน (ตัวอย่าง 1)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางกิจกรรม';

--
-- Dumping data for table `pms_task`
--

INSERT INTO `pms_task` (`t_id`, `t_detail`, `t_createdate`, `t_status`, `t_tl_id`, `t_p_id`, `t_u_id`) VALUES
(1, 'พูดคุยเก็บความต้องการ', '2022-09-24', 1, 1, 1, 15);

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

--
-- Dumping data for table `pms_tasklist`
--

INSERT INTO `pms_tasklist` (`tl_id`, `tl_name`, `tl_createdate`, `tl_status`, `tl_u_id`) VALUES
(1, 'เก็บความต้องการ', '2022-09-23 21:09:48', 1, 1),
(2, 'เสนอราคา', '2022-09-23 21:10:06', 1, 1),
(3, 'นำเสนองาน', '2022-09-23 21:11:16', 1, 1),
(4, 'ประชุม', '2022-09-28 18:55:15', 1, 11),
(5, 'ทดสอบระบบ', '2022-09-28 20:39:08', 1, 11);

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
(14, 'pol12@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ธัชพล', 'พงศ์พิโรจ', '0848430664', '2022-08-01 03:00:00', 1, 1, 3),
(15, 'ronnaporn.tada@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'รณพร', 'ธาดาวรวงศ์', '0644219211', '2022-08-01 03:00:00', 1, 1, 3),
(16, 'phonlaphat.pi@gmail.com', 'f9194e73f9e9459e3450ea10a179cdf77aafa695beecd3b9344a98d111622243', 'พลภัทร', 'พิจิตเจริญวงศ์', '0832438221', '2022-08-01 03:00:00', 1, 1, 3),
(17, 'yodsaphat2907@gmail.com', 'f9194e73f9e9459e3450ea10a179cdf77aafa695beecd3b9344a98d111622243', 'ยศพัฒน์', 'พิชิตชัย', '0617610871', '2022-08-01 03:00:00', 1, 1, 3),
(18, 'bawornwit.ko@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'บวรวิทย์', 'คมปราชญ์', '0839386762', '2022-08-01 03:00:00', 1, 1, 3),
(19, 'piyarom.sri@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ปิยรมย์', 'ศรีวรรณวิไล', '0651338630', '2022-08-01 03:00:00', 1, 1, 3),
(20, 'apple.kulanan@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'กุลนันท์', 'พงษ์ธนาพัฒน์', '0637237711', '2022-08-01 03:00:00', 1, 1, 2),
(21, 'pongsit1010@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'พงษ์สิทธิ์', 'อุดมเสก', '0937237799', '2022-08-01 03:00:00', 1, 1, 3),
(22, 'thanaphat0901@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ธนภัทร', 'จรัสธรรม', '0836949645', '2022-08-01 03:00:00', 1, 1, 2),
(23, 'napassorn.jan@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'นภัสสร', 'จันทรพร', '0906219227', '2022-08-01 03:00:00', 1, 1, 3),
(24, 'sopol2406@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'โสพล', 'จันทรทรัพย์', '0816804298', '2022-08-01 03:00:00', 1, 1, 3),
(25, 'suchada1512@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'สุชาดา', 'พินิจนันท์', '0652864431', '2022-08-01 03:00:00', 1, 1, 3),
(26, 'sommat@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'สมมาตร', 'รักดี', '0612412412', '2022-09-11 14:07:28', 0, 11, 3),
(27, 'ponganan@gmail.com', '7e77ef5235e0cfa21343ce5fc578ac8e91c1a30caa8407e2fcd501653b72d35e', 'พงษ์อนันต์', 'ตั้งตระกูลเจริญ', '0698812214', '2022-09-20 06:06:33', 1, 11, 3),
(28, 'anriya@gmail.com', 'd2c727c5d4ee46d57a27a4a4018bf0aa804d8739f2847fe86e14f845d0870bef', 'อัญริญา', 'ธาดาวรวงศ์', '0891248453', '2022-09-20 06:28:25', 1, 1, 3);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `pms_file`
--
ALTER TABLE `pms_file`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีไฟล์ (ตัวอย่าง 1)';

--
-- AUTO_INCREMENT for table `pms_log`
--
ALTER TABLE `pms_log`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีบันทึก (ตัวอย่าง 1)', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pms_permission`
--
ALTER TABLE `pms_permission`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีสิทธิ์ (ตัวอย่าง 1)', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pms_project`
--
ALTER TABLE `pms_project`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีโครงการ (ตัวอย่าง 1)', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pms_task`
--
ALTER TABLE `pms_task`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีกิจกรรม (ตัวอย่าง 1)', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pms_tasklist`
--
ALTER TABLE `pms_tasklist`
  MODIFY `tl_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีชื่อกิจกรรม (ตัวอย่าง 1)', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pms_user`
--
ALTER TABLE `pms_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้ใช้ (ตัวอย่าง 1)', AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
