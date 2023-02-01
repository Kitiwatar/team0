-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 03:14 PM
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
  `t_createdate` date NOT NULL COMMENT 'วันที่เพิ่ม (ตัวอย่าง 2022-08-01)',
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
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้ใช้ (ตัวอย่าง 1)';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
