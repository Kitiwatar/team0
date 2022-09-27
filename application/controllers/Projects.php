<?php
// Create by: Jiradat Pomyai 15-09-2565 Projects management
defined('BASEPATH') OR exit('No direct script access allowed');
class Projects extends CI_Controller{
    public function __construct() {
		// Create by: Jiradat Pomyai 15-09-2565
		parent::__construct();
		$this->genlib->checkLogin();
		$data = $this->genmod->getOne('pms_user', '*', array('u_id'=>$_SESSION['u_id']));
		$this->genlib->updateSession($data);
	}

    public function index()	{
		// Create by: Jiradat Pomyai 19-09-2565 index page
		$values['pageTitle'] = 'รายชื่อโครงการที่รับผิดชอบ';
		$values['breadcrumb'] = 'รายชื่อโครงการที่รับผิดชอบ';
		$values['pageContent'] = $this->load->view('projects/index', $values, TRUE);
		$this->load->view('main', $values);
	}

    public function getStatus() {
		// Create by: Jiradat Pomyai 19-09-2565 return all status of project
		$arraystatus = array(1=>"รอดำเนินการ", 2=>"กำลังดำเนินการ", 3=>"เสร็จสิ้น", 4=>"ยกเลิก");
		return $arraystatus;
    }

	public function get() {
		// Create by: Jiradat Pomyai 19-09-2565
		$data['pageTitle'] =  'โครงการที่เกี่ยวข้อง';
		$data['breadcrumb'] = 'โครงการที่เกี่ยวข้อง';
		$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		if($_SESSION['u_role'] > 1) {
			$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('per_u_id'=>$_SESSION['u_id']), 'p_createdate desc', $arrayJoin, '');
		} else {
			$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('per_role'=>1), 'p_createdate desc', $arrayJoin, '');
		}

		$data['arrayStatus'] = $this->getStatus();
		$lastTask = array();
		$leader = array();
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		if(is_array($data['getData'])){
			foreach ($data['getData'] as $key => $value){
				$leader[$key] = $this->genmod->getOne('pms_permission', '*',array('per_p_id'=>$value->per_p_id, 'per_role'=>1),'',$arrayJoin,'');
				$lastTask[$key] = $this->genmod->getLastTask($value->per_p_id);
			}
		}
	
		$data['lastTask'] = $lastTask;
		$data['leader'] = $leader;
		$json['html'] = $this->load->view('projects/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getAddForm() {
		// Create by: Jiradat Pomyai 19-09-2565
		$json['title'] = 'เพิ่มพนักงานในระบบ (<font class="text-danger">*</font>จำเป็นต้องกรอกข้อมูล)';
		$json['body'] = $this->load->view('projects/formadd', '' ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">บันทึก</button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'เพิ่มโครงการ\')">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	public function viewProjectTasks()	{
		// Create by: Jiradat 25-09-2565 index page
		
		$values['pageTitle'] = 'ตารางแสดงกิจกรรมโครงการ';
		echo $Data;
		$values['breadcrumb'] = 'ตารางแสดงกิจกรรมโครงการ';
		$values['pageContent'] = $this->load->view('projects/projectdetail', $values, TRUE);
		$this->load->view('main', $values);
	}
}
?>
