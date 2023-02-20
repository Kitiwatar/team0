-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 08:03 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `pms_announcement`
--

CREATE TABLE `pms_announcement` (
  `an_id` int(11) NOT NULL COMMENT 'ไอดีประกาศ (ตัวอย่าง 1)',
  `an_text` varchar(255) NOT NULL COMMENT 'ประกาศ (ตัวอย่าง วันนี้มีประชุมนะ)',
  `an_createdate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่เพิ่มประกาศ (ตัวอย่าง 2023-02-14 \r\n 10:20:33)',
  `an_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะประกาศ (0 ถูกลบ, 1 แสดงประกาศ, 2 ซ่อนประกาศ)',
  `an_u_id` int(11) NOT NULL COMMENT 'ไอดีคนเพิ่มประกาศ (ตัวอย่าง 1)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางประกาศ';

ALTER TABLE `pms_announcement`
  ADD PRIMARY KEY (`an_id`);

ALTER TABLE `pms_announcement`
  MODIFY `an_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีประกาศ (ตัวอย่าง 1)';

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


ALTER TABLE `pms_task`
  ADD PRIMARY KEY (`t_id`);

ALTER TABLE `pms_task`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีกิจกรรม (ตัวอย่าง 1)';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
