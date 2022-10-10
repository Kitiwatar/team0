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
		$arrayStatus = array(1=>"รอดำเนินการ", 2=>"กำลังดำเนินการ", 3=>"เสร็จสิ้น", 4=>"ยกเลิก");
		return $arrayStatus;
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

	public function add() {
		// Create by: Jiradat Pomyai 28-09-2565 add project in database
		$this->genlib->ajaxOnly();
		$formData = $this->input->post();
		$arrayErr = array(
			'required' => 'คุณต้องทำการระบุ  {field} ',
		  'numeric' => 'กรุณาระบุ {field} เป็นตัวเลขเท่านั้น',
		  'min_length' => 'กรุณาระบุ {field} เป็นตัวเลขอย่างน้อย {param} หลัก',
		  'max_length' => 'กรุณาระบุ {field} เป็นตัวเลขไม่เกิน {param} หลัก'
	  );
		$this->form_validation->set_rules('p_name', 'ชื่อโปรเจค', 'required', $arrayErr);
		$this->form_validation->set_rules('p_detail', 'รายละเอียด', 'required', $arrayErr);
		$this->form_validation->set_rules('p_customer', 'ชื่อลูกค้า', 'required', $arrayErr);
		$this->form_validation->set_rules('p_createdate', 'วันที่เพิ่มโครงการ', 'required', $arrayErr);
		if($this->form_validation->run() !== FALSE){	
			if($formData['p_id'] == 'new') {	
					$this->genmod->add('pms_project',$formData);
					$project = $this->genmod->getLastProject();
					$arrayPermission['per_role'] = 1;
					$arrayPermission['per_p_id'] = $project->p_id;
					$arrayPermission['per_u_id'] = $_SESSION['u_id'];
					$this->genmod->add('pms_permission',$arrayPermission);
					$json = ['status'=> 1, 'msg'=>'บันทึกข้อมูลสำเร็จ'];				
			} else {		
					$p_id = $formData['p_id'];
					unset($formData['p_id']);
					$this->genmod->update('pms_project', $formData, array('p_id'=>$p_id));
					$json = ['status'=> 1, 'msg'=>'แก้ไขข้อมูลสำเร็จ'];
			}
		}else{
			$json = ['status'=> 0, 'msg'=>"พบปัญหา ข้อมูลมีความผิดพลาด เพิ่มข้อมูลไม่สำเร็จ ",'error'=>$this->form_validation->error_array()];
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getAddForm() {
		// Create by: Jiradat Pomyai 28-09-2565 get add form
		$json['title'] = 'เพิ่มโครงการ <span class="text-danger" style="font-size:12px;">(*จำเป็นต้องกรอกข้อมูล)</span>';
		$json['body'] = $this->load->view('projects/formadd', '', TRUE);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">บันทึก</button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'เพิ่มโครงการ\')">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm() {
		// Create by: Patiphan Pansanga 11-10-2565 get edit form 
		$json['title'] = 'แก้ไขข้อมูลโครงการ <span class="text-danger" style="font-size:12px;">(*จำเป็นต้องกรอกข้อมูล)</span>';
		$data['getData'] = $this->genmod->getOne('pms_project', '*', array('p_id'=>$this->input->post('p_id')));
		$json['body'] = $this->load->view('projects/formadd', $data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit('.$this->input->post('p_id').');">บันทึก</button>
		<button type="button" class="btn btn-danger" id="closeBtn" onclick="closeModal(\'แก้ไขโครงการ\')">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function viewProjectTasks($p_id)	{
		// Create by: Jiradat 01-10-2565 task page
        $arrayJoin = array('pms_user' => 'pms_user.u_id=pms_task.t_u_id','pms_tasklist' => 'pms_tasklist.tl_id=pms_task.t_tl_id');
		$data['getData'] = $this->genmod->getAll('pms_task', '*',array('t_p_id'=>$p_id),'',$arrayJoin,'');
		$data['projectData'] = $this->genmod->getOne('pms_project', '*',array('p_id'=>$p_id),'','','');
		$values['pageTitle'] = 'ตารางแสดงกิจกรรมโครงการ';
		$values['breadcrumb'] = 'ตารางแสดงกิจกรรมโครงการ';
		$values['pageContent'] = $this->load->view('projects/projectdetail', $data, TRUE);
		$this->load->view('main', $values);
	}

	public function getDetailForm() {
		// Create by: Jiradat Pomyai 01-10-2565 get form detail projects
		if($this->input->post('p_id')!=null){
			$data['getData'] = $this->genmod->getOne('pms_project', '*', array('p_id'=>$this->input->post('p_id')));
		} else {
			return;
		}
		$data['detail'] = "yes";
		$json['title'] = 'ข้อมูลพนักงาน';
		$json['body'] = $this->load->view('projects/formadd', $data ,true);
		$json['footer'] = '<button type="button" class="btn btn-warning" onclick="edit(' . $this->input->post('p_id') . ')" title="แก้ไขข้อมูลโครงการ">แก้ไขข้อมูล</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function updateStatus() {
		// Create by: Patiphan Pansanga 01-10-2565 update status project in database
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		$validCheck = $this->genmod->getOne('pms_project', '*', array('p_id' => $updateData['p_id']));
		if(isset($validCheck)) {
			$this->genmod->update('pms_project', array('p_status'=> ($updateData['p_status'])), array('p_id' => $updateData['p_id']));
			if($updateData['p_status'] < 1) {
				$msg = "ลบโครงการสำเร็จ";
			} else {
				$msg = "กู้คืนข้อมูลโครงการสำเร็จ";
			}				 
			$json = ['status'=> 1, 'msg'=>$msg];	
		} else {
			$json = ['status'=> 0, 'msg'=>"เกิดข้อผิดพลาด"];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
}
?>
