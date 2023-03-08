<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*++ define short letter
pj = project
ct = customer
*/
//++ Table ++//
$lang['tl_no.'] = "ลำดับ";
//++ Cause Close Project ++//
$lang['cause'] = "สาเหตุยุติ";
$lang['Amount'] = "จำนวนทั้งหมด";
//++ End ++//

//++ Main ++//

$lang['Home'] = 'แดชบอร์ด';
$lang['Calendar'] = 'ปฏิทิน';
$lang['Em-inp'] = 'พนักงานในโครงการ';
// menu side bar
$lang['dashboard'] = 'แดชบอร์ด';
$lang['project'] = 'โครงการ';
$lang['setting'] = 'ตั้งค่าระบบ';
$lang['user'] = 'จัดการพนักงาน';
$lang['taskList'] = 'จัดการชื่อกิจกรรม';
$lang['log'] = 'ฐานข้อมูล';
$lang['signin'] = 'เข้าสู่ระบบ';
$lang['report'] = 'รายงาน';
$lang['lang'] = 'การแสดงผลภาษา';
$lang['my_project'] = 'โครงการที่รับผิดชอบ';
$lang['all_project'] = 'โครงการทั้งหมด';
$lang['employee'] = 'พนักงาน';

// menu top bar
$lang['login'] = "ระบบสำหรับเจ้าหน้าที่ภายใน";
$lang['profile'] = 'ข้อมูลส่วนตัว';
$lang['password'] = 'เปลี่ยนรหัสผ่าน';
$lang['logout'] = 'ออกจากระบบ';
//++ End ++//

//++ Login ++ //
//++ Header
$lang['Email'] = "อีเมล";
$lang['Password'] = "รหัสผ่าน";
//-- Result
$lang['l_result-pw'] = "รหัสผ่านไม่ถูกต้อง";
$lang['l_result-nf'] = "ไม่พบบัญชีผู้ใช้นี้ในระบบ";
$lang['l_result-usem'] = "บัญชีผู้ใช้ถูกระงับ กรุณาติดต่อผู้ดูแลระบบ";
// placeholder
$lang['p_login_email'] = "กรอกอีเมล";
$lang['p_login_password'] = "กรอกรหัสผ่าน";
// Button
$lang['b_login'] = "เข้าสู่ระบบ";
//++ End ++//

//++ Home ++//
$lang['h_project'] = "โครงการ";
$lang['admin_home'] = "แดชบอร์ดผู้ดูแลระบบ";
$lang['admin'] = "ผู้ดูแลระบบ";
$lang['pp'] = "ส่วนบุคคล";
$lang['pp_home'] = "แดชบอร์ดส่วนบุคคล";
$lang['h_status'] = "ที่";
$lang['todo'] = "งานของฉันวันนี้";
$lang['no_todo'] = "ยังไม่มีงานใด ๆ ในขณะนี้";
$lang['system_message'] = "ข้อความจากระบบ";
$lang['overview_relate'] = "ภาพรวมโครงการที่มีส่วนเกี่ยวข้อง พ.ศ. ";
$lang['overview_Cstatus'] = "กราฟแสดงจำนวนโครงการที่มีส่วนเกี่ยวข้องตามสถานะ";
$lang['overview_all'] = "ภาพรวมโครงการทั้งหมด พ.ศ. ";
$lang['cancel_rank'] = "อันดับสาเหตุการยุติโครงการ 5 อันดับ";
// Button
$lang['b_viewmore']= "ดูเพิ่มเติม...";
// status of Project
$lang['sp_home_allproject'] = "จำนวนโครงการทั้งหมด";
$lang['sp_home_responproject'] = "โครงการที่มีส่วนเกี่ยวข้อง";
$lang['sp_home_pendproject'] = "รอดำเนินการ";
$lang['sp_home_inprogress'] = "กำลังดำเนินการ";
$lang['sp_home_finish'] = "สิ้นสุด";
$lang['sp_home_cancel'] = "ถูกยุติ";
// Ranke
$lang['tl_home_listofrank'] = "อันดับพนักงานที่มีส่วนเกี่ยวข้องกับโครงการมากที่สุด 5 อันดับ";
$lang['tl_home_amountworkpiece'] = "จำนวนภาระงาน";
$lang['tl_home_name'] = "ชื่อ-นามสกุล";
$lang['tl_home_update'] = "อัปเดตลำดับล่าสุดวันที่";
//++ End ++//

//++ Project ++//
// topic
$lang['tp_project_pj-responsible'] = "รายชื่อโครงการที่รับผิดชอบ";
// table header
$lang['th_project_pj-responsible'] = "ตารางรายชื่อโครงการที่รับผิดชอบ";
$lang['th_project_pj-task'] = "ตารางแสดงกิจกรรมโครงการ";
$lang['th_project_em-associated'] = "ตารางรายชื่อพนักงานในโครงการ";
// modal button
$lang['m_project_addproject'] = "เพิ่มโครงการ";
$lang['m_project_addtask'] = "เพิ่มกิจกรรมโครงการ";
$lang['m_project_addaemployee'] = "เพิ่มพนักงานในโครงการ";
$lang['m_project_finishproject'] = "สิ้นสุดโครงการ";
$lang['m_project_cancelproject'] = "ยุติโครงการ";
$lang['m_project_reinstateproject'] = "กู้คืนสถานะโครงการ";
// genaral data in PMS project
$lang['gd_project_pj-required'] = "(*จำเป็นต้องกรอกข้อมูล)";
$lang['gd_project_pj-add'] = "เพิ่มโครงการ";
$lang['gd_dateadded'] = "วันที่เพิ่ม";
$lang['gd_project_pj-name'] = "ชื่อโครงการ";
$lang['gd_project_pj-detail'] = "รายละเอียดโครงการ";
$lang['gd_project_pj-ct-name'] = "ชื่อลูกค้า";
$lang['gd_project_pj-startdate'] = "วันที่เริ่มโครงการ";
$lang['gd_project_pj-enddate'] = "วันที่สิ้นสุดโครงการ";
$lang['gd_project_pj-ct-contact'] = "ช่องทางการติดต่อลูกค้า";
$lang['gd_project_em-phone'] = "เบอร์มือถือ";
$lang['gd_project_em-fullname'] = "ชื่อ-นามสกุล";
$lang['gd_project_em-email'] = "อีเมล";
$lang['gd_project_em-permission'] = "สิทธิ์ในโครงการ";
// table list
$lang['tl_table_title'] = "รายชื่อ";
$lang['tl_project_pj-no'] = "ลำดับ";
$lang['tl_project_pj-name'] = "ชื่อโครงการ";
$lang['tl_project_pj-mainperson'] = "ชื่อผู้รับผิดชอบหลัก";
$lang['tl_project_pj-task'] = "กิจกรรมล่าสุด";
$lang['tl_project_pj-status'] = "สถานะ";
$lang['tl_project_actionbutton'] = "ปุ่มดำเนินการ";
$lang['tl_project_pj-numbershow'] = "แสดง";
$lang['tl_project_pj-list'] = "รายการ";
$lang['tl_project_at-nametask'] = "ชื่อกิจกรรม";
$lang['tl_project_at-implementationdate'] = "วันที่ดำเนินการ / กำหนดการ";
$lang['tl_project_at-operator'] = "ผู้เพิ่ม";
// button
$lang['b_project_previous'] = "ก่อนหน้า";
$lang['b_project_next'] = "ถัดไป";
$lang['b_project_back'] = "ถอยกลับ";
// Input Field
$lang['in_project_search'] = "ค้นหา";
$lang['in_project_zerorecords'] = "ไม่พบข้อมูล";
//++ End ++//

//++ Page/bread Title  ++//
$lang['pbt_pj-finish'] = "โครงการที่สิ้นสุด";
$lang['pbt_pj-cancel'] = "โครงการที่ถูกยุติ";
$lang['pbt_pj-all'] = "โครงการทั้งหมด";
$lang['pbt_pj-pending'] = "โครงการที่รอดำเนินการ";
$lang['pbt_pj-inprogress'] = "โครงการที่กำลังดำเนินการ";
//++ End ++//

//++ User ++//
// ==>> ROLE <<==//
$lang['u_role-em1'] = "พนักงาน ระดับ 1";
$lang['u_role-em2'] = "พนักงาน ระดับ 2";
$lang['u_role-am'] = "ผู้ดูแลระบบ";
// Topic 
$lang['tp_user_em-name'] = "ตารางรายชื่อพนักงาน";
// Button
$lang['b_user_addem'] = "เพิ่มพนักงาน";
// table topic data
$lang['tp_user-status'] = "สถานะ";
//++ End ++//

//++ Tasklist ++//
$lang['b_user_addtasklist'] = "เพิ่มรายการกิจกรรม";
// table topic data
$lang['tb_topic_dt-name'] = "รายการกิจกรรม";
// Topic 
$lang['tp_user_tl-name'] = "ตารางรายชื่อรายการกิจกรรม";
//++ End ++//

//++ Logs ++//
// Topic 
$lang['tp_logs_us-history'] = "ตารางประวัติฐานข้อมูลในระบบ";
$lang['tp_logs_bc'] = "ประวัติฐานข้อมูล";
// table topic data
$lang['tb_topic_dt-action'] = "การกระทำ";
$lang['tb_topic_dt-db'] = "ชื่อตาราง";
$lang['tb_topic_dt-change'] = "ข้อมูล";
$lang['tb_topic_dt-command'] = "คำสั่ง";
$lang['tb_topic_dt-called'] = "วันที่เรียกใช้";
$lang['tb_topic_dt-operator'] = "ผู้กระทำ";
//++ End ++//

//++ Modal Adding/View/Edit ++//

//-- Verify Modal Success / Failed
$lang['md_vm-suc'] = "สำเร็จ";
$lang['md_vm-fail'] = "ล้มเหลว";
$lang['md_vm_ad-fail'] = "พบปัญหา ข้อมูลมีความผิดพลาด เพิ่มข้อมูลไม่สำเร็จ";
$lang['md_vm_aem-fail'] = "เกิดข้อผิดพลาด อีเมลนี้มีผู้ใช้งานแล้ว";
$lang['md_vm_ct-save'] = "บันทึกข้อมูลสำเร็จ";
$lang['md_vm_ct-edit'] = "แก้ไขข้อมูลสำเร็จ" ;
// Ttitle
$lang['md_tl_a-ap'] = "เพิ่มโครงการใหม่"; // Title add new project
$lang['md_tl_a-aes'] = "เพิ่มพนักงานใหม่ภายในระบบ"; // header adding
$lang['md_tl_a-pt'] = "เพิ่มกิจกรรม"; // Title for add new Project task
$lang['md_tl_a-em'] = "เพิ่มพนักงานในโครงการ"; // Title Employee to handle this project
$lang['md_tl_a-req'] = "จำเป็นต้องกรอกข้อมูล"; // Title required
$lang['md_tl_v-pj'] = "ข้อมูลโครงการ"; // Title for Project Info
$lang['md_tl_e-pj'] = "แก้ไขข้อมูลโครงการ"; // Title for Edit Project Info
$lang['md_tl_e-ps'] = "เปลี่ยนรหัสผ่านของ"; // Title for Change password 
$lang['md_tl_e-em'] = "แก้ไขข้อมูลพนักงาน"; // Title for Edit Employee Info 
$lang['md_tl_v-em'] = "ข้อมูลพนักงาน"; // Title for View Employee Info 
$lang['md_tl_e-pt'] = "แก้ไขข้อมูลกิจกรรม"; // Title for Task Info 
$lang['md_tl_v-pt'] = "ข้อมูลกิจกรรม"; // Title for Task Info 
$lang['md_tl_a-tl'] = "เพิ่มรายการกิจกรรมใหม่"; // Title for add new tasklist  
$lang['md_tl_e-tl'] = "แก้ไขข้อมูลรายชื่อกิจกรรม"; // Title for Edit tasklist Info 
// BUTTON
$lang["bt_save"] = "บันทึก";
$lang["bt_confirm"] = "ยืนยัน";
$lang['bt_cancel'] = "ยกเลิก";
$lang['bt_edit'] = "แก้ไขข้อมูล";
// ADD PROJECT
$lang['md_ap-pn'] = "ชื่อโครงการ";  // header 
$lang['md_ap-pm'] = "ชื่อผู้รับผิดชอบหลัก";  // header
$lang['md_ap-dt'] = "รายละเอียดโครงการ"; // header
$lang['md_ap-ctn'] = "ชื่อลูกค้า" ; // header
$lang['md_ap-ps'] = "วันที่เริ่มโครงการ" ; // header
$lang['md_ap-cct'] = "ช่องทางติดต่อลูกค้า"; // header
$lang['md_ap-tln'] = "เบอร์มือถือ"; // header
$lang['md_ap-line'] = "ไอดีไลน์"; // header
$lang['md_ap-email'] = "อีเมล"; // header
$lang['md_ap-other'] = "ช่องทางติดต่อเพิ่มเติม"; // header
$lang['md_ap-address'] = "Iframe"; // header
$lang['md_ap_ph-pn'] = "กรอกชื่อของโครงการ (Project Monitoring System)"; // Placeholder
$lang['md_ap_ph-dt'] = 'กรอกรายละเอียดของโครงการ (Project Monitoring System เป็นระบบ ...)'; // Placeholder
$lang['md_ap_ph-ctn'] = "กรอกชื่อของลูกค้า (บริษัทรักงาน)"; // Placeholder
$lang['md_ap_ph-ps'] = 'วัน-เดือน-ปี(ค.ศ.)'; // Placeholder
$lang['md_ap_ph-tln'] = 'กรอกเบอร์มือถือ 10 หลักสำหรับติดต่อลูกค้า (0987654321)'; // Placeholder
$lang['md_ap_ph-line'] = 'กรอกไอดีไลน์สำหรับติดต่อลูกค้า (example0101)'; // Placeholder
$lang['md_ap_ph-email'] = 'กรอกอีเมลสำหรับติดต่อลูกค้า (example@gmail.com)'; // Placeholder
$lang['md_ap_ph-other'] = 'กรอกข้อมูลสำหรับติดต่อลูกค้าเพิ่มเติม'; // Placeholder
//- Verify modal of Project Moudule
$lang['md_ap_main-msg'] = "ยืนยันการเพิ่มโครงการ";
$lang['md_ap_detail-msg'] = "คุณต้องการเพิ่มโครงการใหม่ใช่หรือไม่";
$lang['md_ep_main-msg'] = "ยืนยันการแก้ไขโครงการ" ;
$lang['md_ep_detail-msg'] = "คุณต้องการแก้ไขโครงการนี้ใช่หรือไม่";
$lang['md_dp_main-msg'] = "ยืนยันการลบโครงการ" ;
$lang['md_dp_detail-msg'] = "คุณต้องการลบโครงการนี้ใช่หรือไม่";
$lang['md_rp_main-msg'] = "ยืนยันการกู้คืนโครงการ" ;
$lang['md_rp_detail-msg'] = "คุณต้องการกู้คืนโครงการนี้ใช่หรือไม่";
$lang['md_rtp_main-msg'] = "ยืนยันการกู้คืนสถานะโครงการ";
$lang['md_rtp_detail-msg'] = "คุณต้องการกู้คืนสถานะโครงการนี้ใช่หรือไม่";
$lang['md_dep_main-msg'] = "ยืนยันการลบพนักงานในโครงการ";
$lang['md_dep_detail-msg'] = "คุณต้องการลบพนักงานในโครงการใช่หรือไม่";
$lang['md_aep_s-msg'] = "เพิ่มพนักงานในโครงการสำเร็จ";
$lang['md_aep_f-msg'] = "เพิ่มพนักงานในโครงการไม่สำเร็จ";
$lang['md_dep_s-msg'] = "ลบพนักงานในโครงการสำเร็จ";
$lang['md_dep_f-msg'] = "ลบพนักงานในโครงการไม่สำเร็จ";
$lang['md_rp_vm-msg'] = "กู้คืนสถานะโครงการสำเร็จ";
$lang['md_dp_vm-msg'] = "ลบโครงการสำเร็จ";
$lang['md_c_main-msg'] = "ยืนยันการ";
$lang['md_c_detail-msg'] = "คุณต้องการ"; // Question
$lang['md_q_detail-msg'] = "ใช่หรือไม่"; // Question 
$lang['md_fp_main-msg'] = "สิ้นสุดโครงการ";
$lang['md_fp_suc'] = "สิ้นสุดโครงการสำเร็จ";
$lang['md_cp_main-msg'] = "ยุติโครงการ";
$lang['md_cp_suc'] = "ยุติโครงการสำเร็จ";
$lang['md_rp'] = "เหลือเวลากู้คืน";
$lang['md_rp-hour'] = "ชม.";
$lang['md_rqf_sd'] = "กรุณาระบุวันที่เริ่มโครงการ";
$lang['md_rqf_sd-f'] = "กรุณาระบุวันที่เริ่มโครงการให้ถูกต้อง";
$lang['md_rqf_cm'] = "กรุณากรอกชื่อลูกค้า";
$lang['md_rqf_pd'] = "กรุณากรอกรายละเอียดโครงการ";
$lang['md_rqf_pn'] = "กรุณากรอกชื่อโครงการ";
$lang['md_rqf_em'] = "กรุณากรอกอีเมลให้ถูกต้อง";
$lang['md_rqf_cp'] = "กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 หลัก";
$lang['md_rqf_sd-f'] = "สามารถกรอกได้เพียง 0-9 และ - เท่านั้น";
$lang['md_rqf_pn-f'] = "สามารถกรอกได้เพียงตัวเลข 0-9 เท่านั้น";
$lang['md_rqf_ln-f'] = "สามารถกรอกได้เพียง a-z, 0-9 และ - . _ เท่านั้น ";
$lang['md_rqf_em-f'] = "สามารถกรอกได้เพียง a-z, 0-9 และ - . _ @ เท่านั้น";
// ADD TASK
$lang['md_at-tl'] = "รายการกิจกรรมโครงการ"; // header
$lang['md_at-dtl'] = "รายละเอียดกิจกรรม"; // header
$lang['md_at-imd'] = "วันที่ดำเนินการ"; // header
$lang['md_at-time'] = "เวลาที่ดำเนินการ"; // header
$lang['md_at-ad'] = "ผู้เพิ่มกิจกรรม";  // header
$lang['md_at-dc'] = "เอกสารที่เกี่ยวข้อง"; // header 
$lang['md_at_bt-dc'] = "เพิ่มเอกสารที่เกี่ยวข้อง"; // header
$lang['md_at_dc-name'] = "ชื่อของเอกสาร"; // header
$lang['md_at_dc-updt'] = "วันที่อัปโหลด"; // header
$lang['md_at_ab'] = "ปุ่มดำเนินการ"; // header
$lang['md_at_ph-t'] = 'เลือกรายการกิจกรรม'; // Placeholder
$lang['md_at_ph-dtl'] = 'กรอกรายละเอียดของกิจกรรม (เสนอราคา...)'; // Placeholder
$lang['md_at_ph-ps'] = 'วัน-เดือน-ปี(ค.ศ.)'; // Placeholder
//- Verify modal of Task Moudule
$lang['md_at_main-msg'] = "ยืนยันการเพิ่มกิจกรรม";
$lang['md_at_detail-msg'] = "คุณต้องการเพิ่มกิจกรรมในระบบใช่หรือไม่";
$lang['md_et_main-msg'] = "ยืนยันการแก้ไขกิจกรรม";
$lang['md_et_detail-msg'] = "คุณต้องการแก้ไขกิจกรรมในระบบใช่หรือไม่";
$lang['md_dt_main-msg'] = "ยืนยันการลบกิจกรรม";
$lang['md_dt_detail-msg'] = "คุณต้องการลบกิจกรรมใช่หรือไม่";
// ADD PERMISSION
$lang['md_ap_close'] = "ปิด";
$lang['md_ap_add'] = "เพิ่ม";
$lang['md_ap_delete'] = "ลบ";
// ADD Employee In System
$lang['md_aes_ufn'] = "ชื่อ"; // header User Firstname
$lang['md_aes_uln'] = "นามสกุล"; // header User Lastname
$lang['md_aes_uem'] = "อีเมล"; // header User Email
$lang['md_aes_upn'] = "เบอร์มือถือ"; // header User Telephone Number
$lang['md_aes_upm'] = "สิทธิ์ในระบบ"; // header Which permission for use system
$lang['md_aes_ph-ufn'] = "กรอกชื่อของพนักงาน"; // Placeholder
$lang['md_aes_ph-uln'] = "กรอกนามสกุลของพนักงาน"; // Placeholder
$lang['md_aes_ph-uem'] = 'Ex. Naris2225@email.com'; // Placeholder
$lang['md_aes_ph-upn'] = 'Ex. 0987654321'; // Placeholder
$lang['md_aes_ph-upm'] = 'เลือกสิทธิ์ของผู้ใช้งาน'; // Placeholder
$lang['md_aes_upm_rqf'] = "กรุณาเลือกสิทธิ์ของพนักงาน";
$lang['md_aes_ufn_rqf'] = "กรุณากรอกชื่อ";
$lang['md_aes_uln_rqf'] = "กรุณากรอกนามสกุล ";
//= Verify modal of User moudule
$lang['md_aes_main-msg'] = "ยืนยันการเพิ่มพนักงาน";
$lang['md_aes_detail-msg'] = "คุณต้องการเพิ่มข้อมูลพนักงานในระบบใช่หรือไม่";
$lang['md_ees_main-msg'] = "ยืนยันการแก้ไขพนักงาน";
$lang['md_ees_detail-msg'] = "คุณต้องการแก้ไขข้อมูลพนักงานในระบบใช่หรือไม่";
$lang['md_cpes_main-msg'] = "ยืนยันการเปลี่ยนรหัสผ่าน" ;
$lang['md_cpes_detail-msg'] = "คุณต้องการเปลี่ยนรหัสผ่านใช่หรือไม่";
$lang['md_cpes_vm-msg'] = "เปลี่ยนรหัสผ่านสำเร็จ";
$lang['md_cpes_vm_fc1-msg'] = "รหัสผ่านใหม่ต้องไม่ตรงกับรหัสผ่านปัจจุบัน";
$lang['md_cpes_vm_fc2-msg'] = "รหัสผ่านปัจุบันไม่ถูกต้อง";
$lang['md_cpme_main-msg'] = "เปลี่ยนสิทธิ์การใช้งาน";
$lang['md_cpme_main_s-msg'] = "เปลี่ยนสิทธิ์การใช้งานสำเร็จ";
$lang['md_cpme_detail-msg'] = "คุณต้องการเปลี่ยนสิทธิ์การใช้งานใช่หรือไม่";
$lang['md_sem_vm_s-msg'] = "ระงับการทำงานของพนักงานสำเร็จ";
$lang['md_rem_vm_s-msg'] = "กู้คืนข้อมูลพนักงานสำเร็จ";
//-- Change Password User 
$lang['md_cp_psc'] = "โปรดกรอกรหัสผ่านปัจจุบัน" ; // header
$lang['md_cp_psn'] = "โปรดกรอกรหัสผ่านใหม่"; // Header
$lang['md_cp_psng'] = "โปรดกรอกรหัสผ่านใหม่อีกครั้ง"; // Header
$lang['md_cp_ph-psc'] = "รหัสผ่านปัจจุบัน" ; // header
$lang['md_cp_ph-psn'] = "รหัสผ่านใหม่"; // Placeholder
$lang['md_cpme_main_s-msg'] = "เปลี่ยนสิทธิ์การใช้งานสำเร็จ";
$lang['md_cp_ph-psng'] = "ยืนยันรหัสผ่านใหม่"; // Placeholder
$lang['md_cp-cb'] = "แสดงรหัสผ่าน" ; // Checkbox
$lang['md_cp_rqf'] = "กรุณาระบุข้อมูลให้ครบถ้วน ";
$lang['md_cp_rqf-curp'] = "รหัสผ่านปัจจุบันไม่ถูกต้อง";
$lang['md_cp_rqf-cpnm'] = "รหัสผ่านไม่ตรงกัน";
$lang['md_cp_rqf-npnm'] = "รหัสผ่านใหม่ไม่ตรงกัน";
//-- ADD TASKLIST
$lang['md_at_tl'] = "รายชื่อกิจกรรม";// Header
$lang['md_at_ph-tl'] = "โปรดกรอกรายชื่อกิจกรรมใหม่"; // Placeholder
//= Verify modal of Tasklist moudule
$lang['md_atl_main-msg'] = "ยืนยันการเพิ่มรายการกิจกรรม";
$lang['md_atl_detail-msg'] = "คุณต้องการเพิ่มรายการกิจกรรมใช่หรือไม่";
$lang['md_etl_main-msg'] = "ยืนยันการแก้ไขรายการกิจกรรม";
$lang['md_etl_detail-msg'] = "คุณต้องการแก้ไขรายการกิจกรรมใช่หรือไม่";
$lang['md_dtl_main-msg'] = "ยืนยันการลบรายการกิจกรรม";
$lang['md_dtl_detail-msg'] = "คุณต้องการลบรายการกิจกรรมใช่หรือไม่";
$lang['md_rtl_main-msg'] = "ยืนยันการกู้คืนรายการกิจกรรม";
$lang['md_rtl_detail-msg'] = "คุณต้องการกู้คืนรายการกิจกรรมใช่หรือไม่";
$lang['md_dtl_vm-msg']= "ลบรายการออกจากระบบสำเร็จ";
$lang['md_at_rqf_imd'] = "กรุณาเลือกวันที่ดำเนินการ";
$lang['md_at_rqf_imt'] = "กรุณาเลือกเวลาที่ดำเนินการ";
$lang['md_at_rqf_td'] = "กรุณากรอกรายระเอียดกิจกรรม";
$lang['md_at_rqf_tl'] = "กรุณาเลือกรายการกิจกรรม";
$lang['md_atl_rqf'] = "กรุณากรอกรายการกิจกรรม ";

//++ LOGS
$lang['md_log_topic'] = "ข้อมูลประวัติ";
$lang['md_log_action'] = "การกระทำ";
$lang['md_log_table'] = "ชื่อตาราง";
$lang['md_log_data'] = "ข้อมูล";
$lang['md_log_command'] = "คำสั่ง";
$lang['md_log_calldate'] = "วันที่เรียกใช้";
$lang['md_log_operator'] = "ผู้กระทำ";

// REPORT
$lang['rp_project'] = "กราฟรายงานโครงการ";
$lang['rp_user'] = "รายงานพนักงาน";
$lang['pc-s'] = "กราฟวงกลมแสดงสถานะโครงการที่อยู่ในระบบ";
$lang['v-emp'] = "ดูรายชื่อโครงการของพนักงาน";
$lang['v-emp-c'] = "พนักงานไม่มีโครงการที่รับผิดชอบอยู่ในขณะนี้";
$lang['rp_user'] = "กราฟรายงานพนักงาน";
$lang['start_project'] = "ปีที่เริ่มโครงการ";
$lang['end_project'] = "ปีที่สิ้นสุดโครงการ";
$lang['num-project'] = "จำนวนโครงการที่";
$lang['st-project'] = "วันที่เริ่มโครงการ";
$lang['et-project'] = "วันที่สิ้นสุดโครงการ";
$lang['listPro'] = "รายขื่อโครงการของ ";
$lang['all'] = "ทั้งหมด";
// $lang['count']

//==>> ToolTips Project List <<==//
$lang['tt_pj_mproject'] = "จัดการกิจกรรมของโครงการ";
$lang['tt_pj_vproject'] = "ดูข้อมูลโครงการ";
$lang['tt_pj_dproject'] = "ลบโครงการ ";
$lang['tt_pj_eproject'] = "แก้ไขข้อมูลโครงการ";
$lang['tt_pj_cn-dproject'] = "ไม่สามารถลบโครงการได้ เนื่องจากยังมีกิจกรรมอยู่ในโครงการ";
$lang['tt_pj_rproject'] = "กู้คืนข้อมูลโครงการ ";

//==>> ToolTips Project Task List <<==//
$lang['tt_pt_vtask'] = "ดูข้อมูลกิจกรรม";
$lang['tt_pt_etask'] = "แก้ไขกิจกรรม";
$lang['tt_pt_dtask'] = "ลบกิจกรรม";
$lang['tt_pt_cn-etask'] = "ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากคุณไม่ใช่เจ้าของกิจกรรมนี้";
$lang['tt_pt_cn-dtask'] = "ไม่สามารถลบได้ เนื่องจากคุณไม่ใช่เจ้าของกิจกรรมนี้";
//==>> ToolTips Employee in Project List <<==//
$lang['tt_ep_demp'] = "ลบพนักงานออกจากโครงการ";
$lang['tt_ep_cdemp'] = "ไม่สามารถลบได้ เนื่องจากเป็นหัวหน้าของโครงการ";

//==>> ToolTips Employee in System List <<==//
$lang['tt_es_muser'] = "จัดการสถานะการใช้งาน";
$lang['tt_es_vuser'] = "ดูข้อมูลพนักงาน";
$lang['tt_es_euser'] = "แก้ไขข้อมูลพนักงาน";
$lang['tt_es_cpuser'] = "เปลี่ยนรหัสผ่าน";
$lang['tt_es_cn-cpuser'] = "ไม่สามารถเปลี่ยนรหัสผ่านได้ เนื่องจากสถานะผู้ใช้ถูกระงับการใช้งานอยู่ในขณะนี้";
$lang['tt_es_cn-euser'] = "ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากสถานะผู้ใช้ถูกระงับการใช้งานอยู่ในขณะนี้";

//==>> ToolTips Tasklis List <<==//
$lang['tt_tl_etl'] = "แก้ไขรายชื่อกิจกรรม";
$lang['tt_tl_dtl'] = "ลบรายชื่อกิจกรรม";
$lang['tt_tl_cn-dtl'] = "ไม่สามารถลบรายชื่อกิจกรรมนี้ได้ เนื่องจากมีการเรียกใช้งานชื่อกิจกรรมนี้อยู่";

//==>> ToolTips Logs List <<==//
$lang['tt_log_vinfo'] = "ดูรายละเอียด";
// Cancel Project
$lang['p-cancel-cause'] = "สาเหตุยุติโครงการ";
$lang['p-cause-detail'] = "รายละเอียดการยุติโครงการ";
$lang['ch-cause-detail'] = "เลือกสาเหตุการยุติโครงการ";
$lang['cancel-project'] = "ยุติโครงการ";
//Cancel List
$lang['m-cancel_list'] = "จัดการสาเหตุยุติโครงการ";
$lang['cancel_list'] = "รายชื่อสาเหตุยุติโครงการ";
$lang['name_cancel'] = "ชื่อสาเหตุยุติโครงการ";
$lang['add_date'] = "วันที่เพิ่ม";
$lang['ad-cancel'] = "เพิ่มสาเหตุการยุติโครงการ";
$lang['ph-ad_cancel'] = "โปรดกรอกชื่อสาเหตุการยุติโครงการ";
$lang['ad_cancel-fg'] = "กรุณากรอกชื่อกิจกรรม";
$lang['ad_cancel-sm'] = "มีรายชื่อกิจกรรมนี้อยู่แล้ว";
$lang['ed_button'] = "แก้ไขสาเหตุยุติโครงการ";
$lang['de_button'] = "ลบสาเหตุยุติโครงการ";
// Modal
$lang['main-cancel'] = "ยืนยันการลบสาเหตุการยุติโครงการ";
$lang['detail-cancel'] = "คุณต้องการลบสาเหตุการยุติโครงการใช่หรือไม่";

//Announcement List
$lang['m-announcement'] = "จัดการประกาศจากระบบ";
$lang['announcement'] = "ประกาศจากระบบ";
$lang['ms-announcement'] = "ข้อความประกาศจากระบบ";
$lang['an-status'] = "สถานะการประกาศ";
$lang['ad-announcement'] = "เพิ่มข้อความประกาศจากระบบ";
$lang['ph-ad_an'] = "โปรดกรอกประกาศ";
$lang['ed-announcement'] = "แก้ไขข้อความประกาศจากระบบ";
$lang['eda_button'] = "แก้ไขประกาศจากระบบ";
$lang['dea_button'] = "ลบประกาศจากระบบ";
// Toggle
$lang['active'] = "ประกาศข้อความ";
$lang['no-active'] = "ซ่อนประกาศ";
$lang['de-active'] = "ลบสำเร็จ";

// Modal
$lang['main-announcement'] = "ยืนยันการลบข้อความจากระบบ";
$lang['detail-announcement'] = "คุณต้องการลบข้อความจากระบบใช่หรือไม่";

