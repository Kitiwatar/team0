-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2022 at 05:40 PM
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
  `f_createdate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'วันที่อัปโหลด',
  `f_status` int(11) NOT NULL COMMENT 'สถานะไฟล์',
  `f_t_id` int(11) NOT NULL COMMENT 'ไอดีกิจกรรม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางไฟล์';

-- --------------------------------------------------------

--
-- Table structure for table `pms_log`
--

CREATE TABLE `pms_log` (
  `l_id` int(11) NOT NULL COMMENT 'ไอดีบันทึก',
  `l_action` varchar(100) NOT NULL COMMENT 'การกระทำ',
  `l_table` varchar(100) NOT NULL COMMENT 'ชื่อตาราง',
  `l_data` varchar(1000) NOT NULL COMMENT 'ข้อมูล',
  `l_command` varchar(1000) NOT NULL COMMENT 'คำสั่ง',
  `l_createdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `l_u_id` int(11) NOT NULL COMMENT 'ไอดีผู้กระทำ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางบันทึกประวัติของระบบ';

--
-- Dumping data for table `pms_log`
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

-- --------------------------------------------------------

--
-- Table structure for table `pms_project`
--

CREATE TABLE `pms_project` (
  `p_id` int(11) NOT NULL COMMENT 'ไอดีโครงการ',
  `p_name` varchar(100) NOT NULL COMMENT 'ชื่อโครงการ',
  `p_customer` varchar(100) NOT NULL COMMENT 'ชื่อลูกค้า',
  `p_contact` varchar(100) NOT NULL COMMENT 'ช่องทางติดต่อลูกค้า',
  `p_detail` varchar(1000) NOT NULL COMMENT 'รายละเอียดโครงการ',
  `p_createdate` date NOT NULL COMMENT 'วันที่เริ่มโครงการ',
  `p_status` int(11) NOT NULL DEFAULT 1 COMMENT 'สถานะโครงการ',
  `p_u_id` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้(หัวหน้าโครงการ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางโครงการ';

--
-- Dumping data for table `pms_project`
--

INSERT INTO `pms_project` (`p_id`, `p_name`, `p_customer`, `p_contact`, `p_detail`, `p_createdate`, `p_status`, `p_u_id`) VALUES
(1, 'โครงการบริจาคคอมพิวเตอร์ เพื่อน้อง', 'อัญชิสา ธนากานต์', '0801422517', 'โครงการคอมพิวเตอร์เพื่อน้อง มูลนิธิกระจกเงา รับบริจาคคอมพิวเตอร์ Notebook , Printer , Mouse , Keyboard , Scanner และอุปกรณ์พ่วงต่อทุกชนิด \r\nทุกสภาพการใช้งาน (พังแล้วก็รับครับ) ทาง จนท.จะตรวจเช็คสภาพ ทำให้อุปกรณ์สมบูรณ์พร้อมใช้งาน\r\nและจะนำส่งมอบต่อให้กับโรงเรียนในต่างจังหวัด ที่ยังขาดแคลนคอมพิวเตอร์เพื่อใช้เป็นสื่อการเรียนการสอน \r\nให้กับเด็กนักเรียน ซึ่งในแต่ละเดือนจะมีโรงเรียนติดต่อมาขอรับคอมพิวเตอร์กับทางโครงการฯ ไม่ต่ำกว่า 20 โรงเรียน\r\n*อุปกรณ์พ่วงต่อคอมพิวเตอร์ที่ไม่สามารถซ่อมแซมได้ จะอยู่ในโหมดของขยะอิเล็กทรอนิกส์* “ คอมพิวเตอร์ของคุณ คอมพิวเตอร์เพื่อน้อง” \r\n( มูลนิธิกระจกเงา รับบริจาค หนังสือ, เสื้อผ้า , คอมพิวเตอร์, เฟอร์นิเจอร์ ,เครื่องใช้ไฟฟ้า ,ผ้าอ้อมผู้ใหญ่ \r\n,อุปกรณ์การแพทย์ ,ข้าวสาร อาหารแห้ง,ของใช้ในครัวเรือน และสิ่งของสภาพดีทุกประเภท )', '2022-09-01', 1, 12),
(2, 'Document Management System', 'ภาธร วิเชียรชาญ', '0601422517', 'ระบบจัดการไฟล์เอกสารในบริษัท', '2022-09-01', 1, 13),
(3, 'SE Delivery (Moblie application)', 'ชนายุส แสนสุวรรณวงศ์', '0948756931', 'SE Delivery คือ ฟีเจอร์ส่งอาหารที่มอบความสะดวกสบายให้กับร้านอาหารและลูกค้าไปพร้อม ๆ กัน มาพร้อม Automation ระบบอัตโนมัติที่ช่วยให้เจ้าของร้านอาหารปิดการขายได้เร็วขึ้น ในส่วนของลูกค้าก็เลือกเมนูบนเว็บไซต์ของร้านได้เลย ไม่ต้องทักแชท หรือรอร้านตอบให้เสียเวลา', '2022-09-01', 1, 12),
(4, 'ระบบจองตั๋วหนัง SE MAJOR GROUP', 'วรรณภา ชัยภูมิ', '032698741', 'SE MAJOR GROUP เป็นระบบจองตั๋วหนัง โดยมีการแสดงรายละเอียดเกี่ยวกับภาพยนตร์ มีชื่อภาพยนตร์ ความยาวของภาพยนตร์ที่จะฉาย \r\nประเภทภาพยนตร์ และภาพยนตร์ที่นำมาฉายสังกัดค่ายภาพยนตร์ใด จำนวนฟิลด์ที่ใช้ฉาย และชนิดของเสียงภาพยนตร์เป็นแบบใด\r\nโรงภาพยนตร์ (Theater) รายละเอียดของโรงภาพยนตร์ต้องมีหมายเลขของโรงภาพยนตร์ จำนวนที่นั่งของผู้ชมและสามารถจุจำนวนที่นั่งสูงสุดของผู้เข้าชม จำนวนผู้เข้าชมในแต่ละโรงภาพนยนตร์\r\nลูกค้า (Customer) ผู้ที่จะมาดูภาพยนตร์โดยที่ผู้ชมจะดูรายการภาพยนตร์ของโรงภาพยนตร์แต่ละโรง ดูเวลาเริ่มฉาย เดินเข้าไปซื้อบัตรเข้าชมโดยต้องบอกชื่อภาพยนตร์ \r\nหมายเลขโรง รอบที่ฉายให้กับพนักงานทราบ พนักงานก็จะถามตำแหน่งและจำนวนที่นั่งที่ต้องการ ชำระเงินและรับตั๋ว', '2022-08-01', 1, 20),
(5, 'ระบบจองห้องพัก ณ โรงแรมปวันรัตน์ กรุ๊ป', 'นาถินี เจริญผลวัฒนา', '0666966699', 'ระบบจองโรงแรม ปวันรัตน์ กรุ๊ป ซึ่งในระบบจะประกอบไปด้วยผู้ดูแล\r\nระบบ (admin) และส่วนของลูกค้า ซึ่งในส่วนผู้ดูแลระบบ (admin) จะสามารถกดเพิ่ม ลบ แก้ไข\r\nข้อมูลห้องพัก ข้อมูลข่าวประชาสัมพันธ์ ยืนยันการจอง และตรวจสอบการชำระเงินของลูกค้า และ\r\nในส่วนลูกค้าจะสามารถสมัครสมาชิก เรียกดูข่าวประชาสัมพันธ์ จองห้องพัก ทำาการชำระเงิน\r\nนอกจากนี้ระบบยังมีการจัดเก็บข้อมูลที่เป็นระเบียบซึ่งส่งผลดีต่อผู้ใช้งานและผู้ดูแลระบบ ทำให้ข้อมูล\r\nถูกเก็บอย่างปลอดภัย ทำให้ง่ายต่อการค้นหาและใช้งาน ', '2022-05-04', 1, 12),
(6, 'ระบบตรวจวัดสารเคมีปนเปื้อนในน้ำแบบดิจิทัล', 'โสรยา ปานประกอบ', '0902205522', 'การตรวจวัดปริมาณสารเคมีปนเปื้อนในน้ำ โดยวัดความเข้มข้นของสีของน้ำตัวอย่างที่เปลี่ยนไปตามความเข้มข้นของสารเคมีในน้ำที่ทำปฏิกิริยาเคมีกับสารละลายทดสอบ \r\nซึ่งระบบนี้สามารถใช้ทดสอบคุณภาพน้ำได้ในหลายๆ ด้าน เช่น บ่อเพาะเลี้ยงสัตว์น้ำเศรษฐกิจ บ่อน้ำทิ้งหลังจากการบำบัดจากโรงงานอุตสาหกรรม \r\nสีย้อมจากโรงงานสีย้อมผ้า และระบบน้ำประปา ซึ่งจะทำให้ผู้ใช้งานเห็นแนวโน้มของสิ่งปนเปื้อนในน้ำ อันจะนำไปสู่การวางแผนในกระบวนการผลิตและการบำบัดน้ำเสียได้อย่างมีประสิทธิภาพต่อไป', '2022-09-01', 1, 13),
(7, 'โครงการถนนคนละสาย', 'นีรา นันทภักดิ์', '0857522413', 'ถนนสายหน้ามหาวิทยลัยบูณพา เป็นถนนถายในเขตเทศบาลตำบลแสนสุขที่มีความสำคัญสายหนึ่ง ซึ่งมีราษฏรจำนวนมากได้ใช้\r\nเดินทางสัญจรไป - มาและใช้ในการขนส่งผลผลิตทางการเกษตรออกสู่ตลาดนอกจากนั้น ยังมีราษฏรในเขตพื้นที่ใกล้เคียงที่ได้ใช้\r\nปรโยชน์จากถนนสายนี้ในการสัญจรไป - มา', '2022-08-12', 1, 20),
(8, 'โปรเจคติดตาม ตรวจสอบ สถานะของโครงการ', 'ณิชมน พิชิตชัย', '0812366770', 'ระบบติดตาม ตรวจสอบ สถานะของโครงการ (Project Monitoring System : PMS)\r\nเป็นระบบงานที่เกี่ยวกับการจัดการเก็บข้อมูลของโปรเจคที่บริษัทท า ผู้ดูแลโปรเจคที่ท า และท า\r\nสถิติของงานทั้งหมดอัตโนมัติด้วยซอฟต์แวร์ โดยการท างานของระบบที่สามารถท างานได้มีดังนี้\r\nระบบสามารถดูภาพรวมของระบบได้ เข้าสู ่ระบบ ออกจากระบบ จัดการข้อมูลส ่วนตัวของ\r\nผู้ใช้งาน', '2022-08-14', 1, 22),
(9, 'โปรเจคทัวร์เที่ยวไทย', 'วริศ เลิศวิทยา', '0639633693', 'เป็นโปรเจค เพื่อเป็นการส่งเสริมการท่องเที่ยวในประเทศ เพิ่มประสบการณ์ของนักท่องเที่ยว ตลอดจนเพิ่มช่องทางการเข้าถึงผู้ประกอบการท่องเที่ยวได้มากขึ้น \r\nเว็บไซต์ “ทัวร์เที่ยวไทย.ไทย” (www.ทัวร์เที่ยวไทย.ไทย) จึงเป็นเว็บไซต์ที่มีโดเมนเนมเป็นภาษาไทย โดยการท่องเที่ยวแห่งประเทศไทย (ททท.) \r\nได้ร่วมกับคณะกรรมการธุรกรรมทางอิเล็กทรอนิกส์ (คธอ.), สำนักงานพัฒนาธุรกรรมทางอิเล็กทรอนิกส์ (สพธอ. หรือ ETDA) และมูลนิธิศูนย์สารสนเทศเครือข่ายไทย (THNIC) \r\nได้ร่วมมือกันเพื่อเป็นการนำร่องการใช้โดเมนภาษาไทย ที่จะช่วยสร้างความเชื่อมั่นให้กับผู้ใช้งานว่าเป็นเว็บไซต์ที่น่าเชื่อถือ ช่วยลดความเสี่ยงของการหลอกลวงชื่อเว็บไซต์ (Phishing) \r\nทางออนไลน์ได้ และยังเป็นการส่งเสริมการท่องเที่ยวไปยังชุนชนต่างๆ ของประเทศได้แพร่หลายมากขึ้น', '2022-08-06', 1, 12),
(10, 'โครงการคนละข้าง', 'จักรภพ ปรีดาศิริกุล', '0877533578', 'โครงการคนละข้าง จัดขึ้นเพื่อกระตุ้นการจับจ่ายใช้สอยภายในประเทศ บรรเทาภาระค่าใช้จ่ายให้ประชาชน \r\nและช่วยเพิ่มสภาพคล่องให้ร้านค้ารายย่อย เป็นการสนับสนุนเศรษฐกิจฐานรากและฟื้นฟูเศรษฐกิจของประเทศในองค์รวม', '2022-07-29', 1, 13),
(11, 'ระบบตรวจเช็คสถานะสินค้า', 'จันทรา ถนอมจิต', '0951599632', 'ระบบตรวจสอบสามารถใช้ได้กับการส่งไปรษณีย์ด่วนพิเศษในประเทศ (EMS), \r\nโลจิสโพสต์ในประเทศ, โลจิสโพสต์ระหว่างประเทศ, ไปรษณีย์ด่วนพิเศษระหว่างประเทศ, \r\nพัสดุไปรษณีย์ระหว่างประเทศ, ไปรษณีย์ลงทะเบียนระหว่างประเทศ และไปรษณีย์ลงทะเบียนในประเทศเท่านั้น', '2022-08-01', 1, 20),
(12, 'ระบบตู้น้ำมันหยอดเหรียญออนไลน์', 'กุลนันท์ อุดมวงศ์', '0866322365', 'น้ำมันหยอดเหรียญออนไลน์ เป็นมากกว่าแค่ตู้เติมน้ำมันทั่วไป เพราะเราได้คิดนวัตกรรมเพื่อให้ตอบโจทย์ลูกค้าและให้ทันกับยุคสมัยที่จะมีการนำเทคโนโลยี \r\nระบบออนไลน์ และ Big data เข้ามาใช้ ตู้น้ำมันออนไลน์ โดยผู้ขายสามารถตรวจสอบข้อมูลน้ำมันคงเหลือภายในตู้ ข้อมูลผู้ใช้บริการ และข้อมูลอีกจำนวนมาถ \r\nรวมถึงการตั้ง Promotion ในการขายได้เอง และนอกจากนี้ยังมีบริการอื่นๆ ร่วมด้วยในตู้น้ำมันหยอดเหรียญออนไลน์นี้ เช่น บริการเติมเงิน ชําระบิล และโอนเงิน \r\nและยังขยายไปยังการขายกาแฟและบริการอื่นๆ ได้อีกด้วย', '2022-08-01', 1, 12),
(13, 'assets management system', 'กุลจิรา สิริวาณิชย์', 'line: kuljira', 'ระบบจัดการทรัพย์สินในบริษัท', '2022-09-01', 1, 13),
(14, 'ระบบจัดการเอกสารอัตโนมัติ Document Management', 'เมริสา เรืองสมัย', '0811919111', 'ระบบ AI และ Computer Vision สำหรับจัดการเอกสารและรูปภาพ ให้ทุกขั้นตอนเป็นระบบอัตโนมัติ ทำให้ช่วยลดเรื่องของค่าใช้จ่าย และเวลาในการจัดการเอกสารได้ หรือเพิ่มความรวดเร็วในการบริการได้ ตัวอย่างเช่น การทำธุรกรรมทางการเงินกับธนาคารที่ต้องรอสาขาเปิด รอเจ้าหน้าที่ตรวจสอบเอกสาร กรอกข้อมูลทีละใบๆ รอเจ้าหน้าที่อนุมัติขั้นตอนเหล่านี้อาจใช้เวลานานถึงสัปดาห์ ระบบของเราสามารถเข้าไปช่วยตั้งแต่การคัดแยก อ่าน และวิเคราะห์เอกสาร ให้ขั้นตอนเหล่านี้เป็นอัตโนมัติ และสามารถลดเวลาได้เหลือเพียงแค่ 5 นาที นอกจากนี้ ระบบของเรายังสามารถเข้าไปช่วยค้นหาเอกสารที่มีจำนวนมาก เราเข้าไปทำให้ระบบเอกสารสามารถค้นหาและหาเจอได้ทันที', '2022-08-22', 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `pms_task`
--

CREATE TABLE `pms_task` (
  `t_id` int(11) NOT NULL COMMENT 'ไอดีกิจกรรม',
  `t_detail` date NOT NULL COMMENT 'รายละเอียด',
  `t_createdate` date NOT NULL COMMENT 'วันที่เพิ่ม',
  `t_status` int(11) NOT NULL COMMENT 'สถานะกิจกรรม',
  `t_tl_id` int(11) NOT NULL COMMENT 'ไอดีชื่อกิจกรรม',
  `t_p_id` int(11) NOT NULL COMMENT 'ไอดีโครงการ',
  `t_u_id` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางกิจกรรม';

-- --------------------------------------------------------

--
-- Table structure for table `pms_tasklist`
--

CREATE TABLE `pms_tasklist` (
  `tl_id` int(11) NOT NULL COMMENT 'ไอดีชื่อกิจกรรม',
  `tl_name` varchar(100) NOT NULL COMMENT 'ชื่อกิจกรรม',
  `tl_createdate` datetime NOT NULL COMMENT 'วันที่เพิ่ม',
  `tl_u_id` int(11) NOT NULL COMMENT 'คนเพิ่ม'
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
(15, 'ronnaporn.tada@gmail.com', 'f9194e73f9e9459e3450ea10a179cdf77aafa695beecd3b9344a98d111622243', 'รณพร', 'ธาดาวรวงศ์', '0644219211', '2022-08-01 03:00:00', 1, 1, 3),
(16, 'phonlaphat.pi@gmail.com', 'f9194e73f9e9459e3450ea10a179cdf77aafa695beecd3b9344a98d111622243', 'พลภัทร', 'พิจิตเจริญวงศ์', '0832438221', '2022-08-01 03:00:00', 1, 1, 3),
(17, 'yodsaphat2907@gmail.com', 'f9194e73f9e9459e3450ea10a179cdf77aafa695beecd3b9344a98d111622243', 'ยศพัฒน์', 'พิชิตชัย', '0617610871', '2022-08-01 03:00:00', 1, 1, 3),
(18, 'bawornwit.ko@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'บวรวิทย์', 'คมปราชญ์', '0839386762', '2022-08-01 03:00:00', 1, 1, 3),
(19, 'piyarom.sri@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ปิยรมย์', 'ศรีวรรณวิไล', '0651338630', '2022-08-01 03:00:00', 1, 1, 3),
(20, 'apple.kulanan@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'กุลนันท์', 'พงษ์ธนาพัฒน์', '0637237718', '2022-08-01 03:00:00', 1, 1, 2),
(21, 'pongsit1010@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'พงษ์สิทธิ์', 'อุดมเสก', '0937237799', '2022-08-01 03:00:00', 1, 1, 3),
(22, 'thanaphat0901@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'ธนภัทร', 'จรัสธรรม', '0836949645', '2022-08-01 03:00:00', 1, 1, 2),
(23, 'napassorn.jan@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'นภัสสร', 'จันทรพร', '0906219227', '2022-08-01 03:00:00', 1, 1, 3),
(24, 'sopol2406@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'โสพล', 'จันทรทรัพย์', '0816804298', '2022-08-01 03:00:00', 1, 1, 3),
(25, 'suchada1512@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'สุชาดา', 'พินิจนันท์', '0652864431', '2022-08-01 03:00:00', 1, 1, 3),
(26, 'sommat@gmail.com', 'c7efcbe959b502b170891067d656bddb254b62fb087038075f39bf3da444c3c5', 'สมมาตร', 'รักดี', '0612412412', '2022-09-11 14:07:28', 1, 11, 3);

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
-- Indexes for table `pms_project`
--
ALTER TABLE `pms_project`
  ADD PRIMARY KEY (`p_id`);

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
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีไฟล์';

--
-- AUTO_INCREMENT for table `pms_log`
--
ALTER TABLE `pms_log`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีบันทึก';

--
-- AUTO_INCREMENT for table `pms_project`
--
ALTER TABLE `pms_project`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีโครงการ';

--
-- AUTO_INCREMENT for table `pms_tasklist`
--
ALTER TABLE `pms_tasklist`
  MODIFY `tl_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีชื่อกิจกรรม';

--
-- AUTO_INCREMENT for table `pms_user`
--
ALTER TABLE `pms_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้ใช้';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
