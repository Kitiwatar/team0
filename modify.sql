-- อัปเดต 08-03-2023 
-- 1. เพิ่มตาราง pms_announcement 
-- 2. เปลี่ยน type ของคอลัมน์ t_createdate ใน pms_task จาก date เป็น datetime

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

ALTER TABLE `pms_task` CHANGE `t_createdate` `t_createdate` DATETIME NOT NULL COMMENT 'วันที่ดำเนินกิจกรรม (2022-12-23 10:12:45)';
