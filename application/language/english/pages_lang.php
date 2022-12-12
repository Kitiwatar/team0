<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
//++ Table ++//
$lang['tl_no.'] = "No.";
//++ End ++//

//++ Main ++//
$lang['Home'] = 'Home';
// menu sidebar
$lang['dashboard'] = 'Dashboard';
$lang['project'] = 'Projects';
$lang['setting'] = 'Settings';
$lang['user'] = 'Users';
$lang['taskList'] = 'TaskList';
$lang['log'] = 'Logs';


// menu top bar
$lang['login'] = "Login";
$lang['profile'] = 'Profile';
$lang['password'] = 'Password';
$lang['logout'] = 'Logout';
//++ End ++//

//++ Login ++ //
//-- Result
$lang['l_result-pw'] = "Password incorrect.";
$lang['l_result-nf'] = "Not found this User.";
$lang['l_result-usem'] = "This User got suspended please contact to admin.";
// placeholder
$lang['p_login_email'] = "Email";
$lang['p_login_password'] = "Password";
// Button
$lang['b_login'] = "Log in";
//++ End ++//

//++ Home ++//
$lang['h_project'] = "Project";
// Button
$lang['b_viewmore']= "More...";

// status of Project
$lang['sp_home_allproject'] = "All of Projects";
$lang['sp_home_pendproject'] = "Pending";
$lang['sp_home_inprogress'] = "In Progress";
$lang['sp_home_finish'] = "Finish";
$lang['sp_home_cancel'] = "Cancel";
// Ranke
$lang['tl_home_listofrank'] = "List Of Employees With The Highest Job Responsibilities ";
$lang['tl_home_amountworkpiece'] = "Amount of Workpiece";
$lang['tl_home_name'] = "Name of Employee";
$lang['tl_home_update'] = "Update Date";
//++ End ++//

//++ Project ++//
// topic
$lang['tp_project_pj-responsible'] = "Project in Responsible";
// table header
$lang['th_project_pj-responsible'] = "List of Project in Responsible";
$lang['th_project_at-task'] = "List of Tasks in Project";
$lang['th_project_em-associated'] = "List of Associated Employees";

// modal button
$lang['m_project_addproject'] = "Add Project";
$lang['m_project_addtask'] = "Add Task";
$lang['m_project_addaemployee'] = "Add Employee";
$lang['m_project_finishproject'] = "Finish Project";
$lang['m_project_cancelproject'] = "Cancel Project";
$lang['m_project_reinstateproject'] = "Reinstate  Project";
// genaral data in PMS project
$lang['gd_project_pj-required'] = "(*required field)";
$lang['gd_project_pj-add'] = "Add Project";
$lang['gd_dateadded'] = "Date Added";
$lang['gd_project_pj-detail'] = "Project Description";
$lang['gd_project_pj-ct-name'] = "Customer Name";
$lang['gd_project_pj-startdate'] = "Start Project";
$lang['gd_project_pj-enddate'] = "End Project";
$lang['gd_project_pj-ct-contact'] = "Customer Contact";
$lang['gd_project_em-phone'] = "Phone Number";
$lang['gd_project_em-fullname'] = "Full-name";
$lang['gd_project_em-email'] = "Email";
$lang['gd_project_em-permission'] = "Permission";

// table list
$lang['tl_table_title'] = "List Of ";
$lang['tl_project_pj-no'] = "No.";
$lang['tl_project_pj-name'] = "Name of Project";
$lang['tl_project_pj-mainperson'] = "Main Person";
$lang['tl_project_pj-task'] = "Tasks";
$lang['tl_project_pj-status'] = "Status";
$lang['tl_project_actionbutton'] = "Action Button";
$lang['tl_project_pj-numbershow'] = "Show";
$lang['tl_project_pj-list'] = "List";
$lang['tl_project_at-nametask'] = "Name of Tasks";
$lang['tl_project_at-implementationdate'] = "Implementation date";
$lang['tl_project_at-operator'] = "Operator";

// button
$lang['b_project_previous'] = "Previous";
$lang['b_project_next'] = "Next";
$lang['b_project_back'] = "Back";
// Input Field
$lang['in_project_search'] = "Search";
$lang['in_project_zerorecords'] = "Not Found";
//++ End ++//

//++ Page/bread Title  ++//
$lang['pbt_pj-finish'] = "Finished Project";
$lang['pbt_pj-cancel'] = "Canceled Project";
$lang['pbt_pj-all'] = "All Projects";
$lang['pbt_pj-pending'] = "Pending Prjoect";
$lang['pbt_pj-inprogress'] = "Project In Progress";
//++ End ++//

//++ User ++//
// ==>> ROLE <<==//
$lang['u_role-em1'] = "Employee Level 1";
$lang['u_role-em2'] = "Employee Level 2";
$lang['u_role-am'] = "Admin";
// Topic 
$lang['tp_user_em-name'] = "List Of Employee";
// Button
$lang['b_user_addem'] = "Add Employee";
// table topic data
$lang['tp_user-status'] = "Status";
//++ End ++//

//++ Tasklist ++//
$lang['b_user_addtasklist'] = "Add Tasklist";
// table topic data
$lang['tb_topic_dt-name'] = "Name of Tasklist";
// Topic 
$lang['tp_user_tl-name'] = "List Of Tasklist";
//++ End ++//

//++ Logs ++//
// Topic 
$lang['tp_logs_us-history'] = "List Of Action History";
$lang['tp_logs_bc'] = "Logs";
// table topic data
$lang['tb_topic_dt-action'] = "Action";
$lang['tb_topic_dt-db'] = "Database Table";
$lang['tb_topic_dt-change'] = "Change Data";
$lang['tb_topic_dt-command'] = "Commanded";
$lang['tb_topic_dt-called'] = "Function Called";
$lang['tb_topic_dt-operator'] = "Operator";
//++ End ++//

//++ Modal Adding/View/Edit ++//

//-- Verify Modal Success / Failed
$lang['md_vm-suc'] = "Susccess";
$lang['md_vm-fail'] = "Failed";
$lang['md_vm_aem-fail'] = "Failed This email is already in use.";
$lang['md_vm_ad-fail'] = "There was a problem with the data error. Failed to add data.";
$lang['md_vm_ct-save'] = "Data Saved Successfully.";
$lang['md_vm_ct-edit'] = "Successfully Edited The Information." ;
//--Ttitle
$lang['md_tl_a-ap'] = "Add The New Project"; // Title add new project
$lang['md_tl_a-aes'] = "Add Employee In System"; // Title adding employee in system
$lang['md_tl_a-pt'] = "Add The New Task"; // Title for add new Project task
$lang['md_tl_a-em'] = "Add Employee To This Project"; // Title Employee to handle this project
$lang['md_tl-req'] = "All fields are required"; // Title required
$lang['md_tl_v-pj'] = "Project Information"; // Title for View Project Info
$lang['md_tl_e-pj'] = "Edit Project Information"; // Title for Edit Project Info
$lang['md_tl_e-ps'] = "Change The Password"; // Title for Change password 
$lang['md_tl_e-em'] = "Edit Employee Information"; // Title for Edit Employee Info 
$lang['md_tl_v-em'] = "Employee Information"; // Title for View Employee Info 
$lang['md_tl_e-pt'] = "Edit Task Information"; // Title for Edit Task Info 
$lang['md_tl_v-pt'] = "Task Information"; // Title for View Task Info 
$lang['md_tl_a-tl'] = "Add The New Tasklist"; // Title for add new tasklist  
$lang['md_tl_e-tl'] = "Edit Tasklist Information "; // Title for Edit tasklist Info 


//-- BUTTON
$lang["bt_save"] = "Save";
$lang["bt_confirm"] = "Confirm";
$lang['bt_cancel'] = "Cancel";
$lang['bt_edit'] = "Edit";
//-- ADD PROJECT
$lang['md_ap-pn'] = "Project Name"; // header
$lang['md_ap-dt'] = "Details Of Project" ;// header
$lang['md_ap-ctn'] = "Customer Name" ;// header
$lang['md_ap-ps'] = "Project Start Date" ;// header
$lang['md_ap-cct'] = "Customer Contact";// header
$lang['md_ap-tln'] = "Telephone Number";// header
$lang['md_ap-line'] = "Line";// header
$lang['md_ap-email'] = "Email";// header
$lang['md_ap-other'] = "Other";// header
$lang['md_ap_ph-pn'] = 'Enter the name of the project (Project Monitoring System)'; // Placeholder
$lang['md_ap_ph-dt'] = 'Enter the detail of the project (Project Monitoring System Is ...)'; // Placeholder
$lang['md_ap_ph-ps'] = 'Day-Month-Year '; // Placeholder
$lang['md_ap_ph-tln'] = 'Enter a 10-digit phone number for contacting customers (0987654321)'; // Placeholder
$lang['md_ap_ph-line'] = 'Enter Line ID for contacting customers (example101)'; // Placeholder
$lang['md_ap_ph-ctn'] = "Enter the name of customer (Pizza company)"; // Placeholder
$lang['md_ap_ph-email'] = 'Enter Email for contacting customers (example@gmail.com)'; // Placeholder
$lang['md_ap_ph-other'] = 'Enter additional customer contact information'; // Placeholder
//- Verify modal of Project Moudule
$lang['md_ap_main-msg'] = "Confirm adding a project";
$lang['md_ap_detail-msg'] = "Do you want to add a new project ?";
$lang['md_ep_main-msg'] = "Confirm editing a project" ;
$lang['md_ep_detail-msg'] = "Do you want to edit this project ?";
$lang['md_dp_main-msg'] = "Confirm deleting a project";
$lang['md_dp_detail-msg'] = "Do you want to delete this project ?";
$lang['md_rp_main-msg'] = "Confirm restoring a project" ;
$lang['md_rp_detail-msg'] = "Do you want to restore this project ?";
$lang['md_rtp_main-msg'] = "Confirm reinstating this project ?";
$lang['md_rtp_detail-msg'] = "Do you want to reinstate this project ?";
$lang['md_aep_s-msg'] = "Successfully add employee to this project.";
$lang['md_aep_f-msg'] = "Failed to add employee to this project.";
$lang['md_dep_s-msg'] = "Successfully delete employee from this project.";
$lang['md_dep_f-msg'] = "Failed to delete employee from this project.";
$lang['md_dep_main-msg'] = "Confirm deleting an employee from this project";
$lang['md_dep_detail-msg'] = "Do you want to delete from this project ?";
$lang['md_rp_vm-msg'] = "Successfully restored project status.";
$lang['md_rp_vm-f'] = "Failed It's due for restore.";
$lang['md_dp_vm-msg'] = "Successfully deleted the project.";
$lang['md_c_main-msg'] = "Confirm ";
$lang['md_c_detail-msg'] = "Do you want to "; // Question
$lang['md_q_detail-msg'] = " ?"; // Question 
$lang['md_fp_main-msg'] = "finsihing this project";
$lang['md_fp_suc'] = "Successfully finsihed this project";
$lang['md_cp_main-msg'] = "canceling this project";
$lang['md_cp_suc'] = "Successfully canceled this project";
$lang['md_rp'] = "Restore in";
$lang['md_rp-hour'] = "Hour";
$lang['md_rqf_sd'] = "Please specify the project start date.";
$lang['md_rqf_sd-f'] = "Please specify the project start date correctly.";
$lang['md_rqf_cm'] = "Please specify customer name.";
$lang['md_rqf_pd'] = "Please specify project detail.";
$lang['md_rqf_pn'] = "Please specify project name.";
$lang['md_rqf_em'] = "Please specify email correctly.";
$lang['md_rqf_cp'] = "Please specify number of 10 digits.";
$lang['md_rqf_sd-f'] = "Can only specify symbols - and number 0-9.";
$lang['md_rqf_pn-f'] = "Can only specify numbers 0-9.";
$lang['md_rqf_ln-f'] = "Can only specify symbols - . _ . , character a-z , and numbers 0-9 ";
$lang['md_rqf_em-f'] = "Can only specify symbols - . _ . @ ,character a-z , and numbers 0-9 ";



//-- ADD TASK
$lang['md_at-tl'] = "Project TaskList"; // header
$lang['md_at-dtl'] = "Detail Of Task"; // header
$lang['md_at-imd'] = "Implementation date"; // header
$lang['md_at-ad'] = "Task Adder"; // header
$lang['md_at-dc'] = "Related documentst"; // header
$lang['md_at_bt-dc'] = "Add Related documentst"; // header
$lang['md_at_dc-name'] = "Name Of The Document"; // header
$lang['md_at_dc-updt'] = "Upload Date"; // header
$lang['md_at_ab'] = "Action Button"; // header
$lang['md_at_ph-tl'] = 'Select Tasklist '; // Placeholder
$lang['md_at_ph-dtl'] = 'Enter the detail of the task (Today we have ..)'; // Placeholder
$lang['md_at_ph-imd'] = 'Day-Month-Year '; // Placeholder
//- Verify modal of Task Moudule
$lang['md_at_main-msg'] = "Confirm adding a task";
$lang['md_at_detail-msg'] = "Do you want to add a new task ?";
$lang['md_et_main-msg'] = "Confirm editing a task";
$lang['md_et_detail-msg'] = "Do you want to edit this task ?";
$lang['md_dt_main-msg'] = "Confirm deleting a task";
$lang['md_dt_detail-msg'] = "Do you want to delete this task ?";
$lang['md_dt_vm-msg'] = "Successfully deleted the task.";
$lang['md_at_rqf_imd'] = "Please specify an action date.";
$lang['md_at_rqf_td'] = "Please specify task detail.";
$lang['md_at_rqf_tl'] = "Please select tasklist.";



//-- ADD PERMISSION
$lang['md_ap_close'] = "Close";
$lang['md_ap_add'] = "Add";
$lang['md_ap_delete'] = "Delete";
//-- ADD Employee In System
$lang['md_aes_ufn'] = "Firstname"; // header User Firstname
$lang['md_aes_uln'] = "Lastname"; // header User Lastname
$lang['md_aes_uem'] = "Email"; // header User Email
$lang['md_aes_upn'] = "Telephone Number"; // header User Telephone Number
$lang['md_aes_upm'] = "Permission for system use"; // header Which permission for use system
$lang['md_aes_ph-ufn'] = "Enter the firstname of employee (Somsak)"; // Placeholder
$lang['md_aes_ph-uln'] = "Enter the lastname of employee (Ruckngan)"; // Placeholder
$lang['md_aes_ph-uem'] = 'Enter Email of employee (example@gmail.com)'; // Placeholder
$lang['md_aes_ph-upn'] = 'Enter a 10-digit phone number for contacting employee (0987654321)'; // Placeholder
$lang['md_aes_ph-upm'] = 'Select permission of system use for employee  '; // Placeholder
$lang['md_aes_upm_rqf'] = "Please select employee privileges.";
$lang['md_aes_ufn_rqf'] = "Please specify employee firstname. ";
$lang['md_aes_uln_rqf'] = "Please specify employee lastname. ";


//- Verify modal of User moudule
$lang['md_aes_main-msg'] = "Confirm adding a new employee";
$lang['md_aes_detail-msg'] = "Do you want to add a new employee ?";
$lang['md_ees_main-msg'] = "Confirm editing this employee";
$lang['md_ees_detail-msg'] = "Do you want to edit this employee ?";
$lang['md_cpes_main-msg'] = "Confirm changing the password" ;
$lang['md_cpes_detail-msg'] = "Do you want to change password ?";
$lang['md_cpes_vm-msg'] = "Successfully changed the password";
$lang['md_cpes_vm_fc1-msg'] = "The new password cannot match the current password.";
$lang['md_cpes_vm_fc2-msg'] = "The current password is not correct.";
$lang['md_cpme_main-msg'] = "Change permission ";
$lang['md_cpme_main_s-msg'] = "Successfully changed permssion ";
$lang['md_cpme_detail-msg'] = "Do you want to change permission ? ";
$lang['md_sem_vm_s-msg'] = "The suspension of the employee was successful.";
$lang['md_rem_vm_s-msg'] = "Successfully restored employee status.";

//-- CHANGE PASSWORD
$lang['md_cp_psc'] = "Please enter the current password" ; // header
$lang['md_cp_psn'] = "Please enter the new password"; // Header
$lang['md_cp_psng'] = "Please enter the new password again"; // Header
$lang['md_cp_ph-psc'] = "Current password" ; // header
$lang['md_cp_ph-psn'] = "Password"; // Placeholder
$lang['md_cp_ph-psng'] = "Confirm Password"; // Placeholder
$lang['md_cp-cb'] = "Show password" ; // Checkbox
$lang['md_cp_rqf'] = "Please provide complete information. ";
$lang['md_cp_rqf-curp'] = "The current password is incorrect.";
$lang['md_cp_rqf-cpnm'] = "Passwords do not match.";
$lang['md_cp_rqf-npnm'] = "The new password does not match.";



//-- ADD TASKLIST
$lang['md_at_tl'] = "Tasklist";// Header
$lang['md_at_ph-tl'] = "Please enter the new tasklist"; // Placeholder
//= Verify modal of Tasklist moudule
$lang['md_atl_main-msg'] = "Confirm adding a new tasklist";
$lang['md_atl_detail-msg'] = "Do you want to add a new tasklist ?";
$lang['md_etl_main-msg'] = "Confirm editing a new tasklist";
$lang['md_etl_detail-msg'] = "Do you want to edit this tasklist ?";
$lang['md_dtl_main-msg'] = "Confirm deleting this tasklist";
$lang['md_dtl_detail-msg'] = "Do you want to delete this tasklist ?";
$lang['md_dtl_vm-msg']= "Successfully deleted the tasklist";
$lang['md_atl_rqf'] = "Please specify tasklist name. ";

//++ LOGS
$lang['md_log_topic'] = "History";
$lang['md_log_action'] = "Action";
$lang['md_log_table'] = "Table";
$lang['md_log_data'] = "Data";
$lang['md_log_command'] = "Commanded";
$lang['md_log_calldate'] = "Called Date";
$lang['md_log_operator'] = "Operator";


//==>> ToolTips Project List <<==//
$lang['tt_pj_mproject'] = "Manage project task";
$lang['tt_pj_vproject'] = "View project information";
$lang['tt_pj_eproject'] = "Edit project information";
$lang['tt_pj_dproject'] = "Delete project ";
$lang['tt_pj_cn-dproject'] = "Project cannot be deleted. because there are still activities in the project.";
$lang['tt_pj_rproject'] = "Restore project ";

//==>> ToolTips Project Task List <<==//
$lang['tt_pt_vtask'] = "View task information";
$lang['tt_pt_etask'] = "Edit task information";
$lang['tt_pt_dtask'] = "Delete task";
$lang['tt_pt_cn-etask'] = "Can't edit information because you are not the owner of this activity.";
$lang['tt_pt_cn-dtask'] = "Cannot be deleted because you are not the owner of this activity.";
//==>> ToolTips Employee in Project list <<==//
$lang['tt_ep_demp'] = "Remove an employee from a project";
$lang['tt_ep_cn-demp'] = "Cannot be deleted Because he is the main person responsible for the project.";

//==>> ToolTips Employee in System List <<==//
$lang['tt_es_muser'] = "Manage Usage Status";
$lang['tt_es_vuser'] = "View Employee Information";
$lang['tt_es_euser'] = "Edit Employee Information";
$lang['tt_es_cpuser'] = "Change Employee Password";
$lang['tt_es_cn-cpuser'] = "Unable to change password Because the user status is currently suspended.";
$lang['tt_es_cn-euser'] = "Can't edit information Because the user status is currently suspended.";

//==>> ToolTips Tasklis List <<==//
$lang['tt_tl_etl'] = "Edit Tasklist";
$lang['tt_tl_dtl'] = "Delete Tasklist";
$lang['tt_tl_cn-dtl'] = "This tasklist cannot be deleted. because this tasklist is already in use.";

//==>> ToolTips Logs List <<==//
$lang['tt_log_vinfo'] = "View Information";

