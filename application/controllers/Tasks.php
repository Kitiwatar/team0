<?php
// Create by: Patiphan Pansanga 14-10-2565 tasks management
defined('BASEPATH') OR exit('No direct script access allowed');
class Tasks extends CI_Controller{
    public function __construct() {
		// Create by: Patiphan Pansanga 14-10-2565 construct
		parent::__construct();
		if(isset($_SESSION['lang'])) {
			if($_SESSION['lang'] == "th") {
				$this->lang->load("pages","thai");
			} else {
				$this->lang->load("pages","english");
			}
		} else {
			$_SESSION['lang'] = "th";
			$this->lang->load("pages","thai");
		}
		$this->genlib->checkLogin();
		$data = $this->genmod->getOne('pms_user', '*', array('u_id'=>$_SESSION['u_id']));
		$this->genlib->updateSession($data);
	}

    public function index()	{
		// Create by: Patiphan Pansanga 14-10-2565 index page
		// $projectsCount = $this->genmod->countAll('pms_project', '', '');
		$p_id = $this->input->get('p_id');
		if(isset($p_id)) {
			$project = $this->genmod->getOne('pms_project', '*',array('p_id'=>$p_id),'','','');
			if(!isset($project->p_id) || $project->p_status < 1) {
				redirect(base_url("projects"));
			}
		} else {
			redirect(base_url("projects"));
		}
		
		$values['pageTitle'] = 'ตารางแสดงกิจกรรมโครงการ';
		$values['breadcrumb'] = 'ตารางแสดงกิจกรรมโครงการ';
		$values['p_id'] = $p_id;
		$values['pageContent'] = $this->load->view('tasks/index', $values, TRUE);
		$this->load->view('main', $values);
	}

	public function get() {
		// Create by: Patiphan Pansanga 14-10-2565 get tasks list
		$data['pageTitle'] =  'โครงการที่เกี่ยวข้อง';
		$data['breadcrumb'] = 'โครงการที่เกี่ยวข้อง';
		if($_SESSION['u_role'] > 1) {
			$checkPermission = $this->genmod->getOne('pms_permission', '*',array('per_u_id'=>$_SESSION['u_id'], 'per_p_id'=>$this->input->post('p_id'), 'per_status'=>1),'','','');
			if(isset($checkPermission->per_id)) {
				$data['isPermission'] = 1;
			} else {
				$data['isPermission'] = 0;
			}
		} else {
			$data['isPermission'] = 1;
		}
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_task.t_u_id','pms_tasklist' => 'pms_tasklist.tl_id=pms_task.t_tl_id');
		$data['getData'] = $this->genmod->getAll('pms_task', '*',array('t_p_id'=>$this->input->post('p_id'), 't_status'=>1),'t_createdate desc',$arrayJoin,'');
		$data['projectData'] = $this->genmod->getOne('pms_project', '*',array('p_id'=>$this->input->post('p_id')),'','','');
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		$data['permission'] = $this->genmod->getAll('pms_permission', '*',array('per_p_id'=>$this->input->post('p_id'), 'per_status'=>1),'per_createdate desc',$arrayJoin,'');
		$json['html'] = $this->load->view('tasks/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function add() {
		// Create by: Patiphan Pansanga 14-10-2565 add task in database
		$this->genlib->ajaxOnly();
		$formData = $this->input->post('formData');
		$fileAdd = $this->input->post('fileAdd');
		$fileRemove = $this->input->post('fileRemove');
		$arrayErr = array(
			'required' => 'คุณต้องทำการระบุ  {field} ',
		  	'numeric' => 'กรุณาระบุ {field} เป็นตัวเลขเท่านั้น',
		  	'min_length' => 'กรุณาระบุ {field} เป็นตัวเลขอย่างน้อย {param} หลัก',
		  	'max_length' => 'กรุณาระบุ {field} เป็นตัวเลขไม่เกิน {param} หลัก'
	  	);
		$this->form_validation->set_rules('t_tl_id', 'ไอดีชื่อกิจกรรม', 'required', $arrayErr);
		$this->form_validation->set_rules('t_p_id', 'ไอดีโครงการ', 'required', $arrayErr);
		$this->form_validation->set_rules('t_createdate', 'วันที่เพิ่มกิจกรรม', 'required', $arrayErr);
		$this->form_validation->set_rules('t_detail', 'รายละเอียด', 'required', $arrayErr);
		// if($this->form_validation->run() !== FALSE){	
			if($formData['t_id'] == 'new') {
				$formData['t_u_id'] = $_SESSION['u_id'];
				$this->genmod->add('pms_task',$formData);
				$this->genmod->update('pms_project', array('p_status'=> 2), array('p_id' => $formData['t_p_id']));
				if(is_array($fileAdd)) {
				$maxId = $this->genmod->getMaxTask($formData['t_p_id']);
				for($i=0 ;$i<count($fileAdd); $i++) {
					$data = array('f_name'=>$fileAdd[$i], 'f_t_id'=>$maxId->t_id);
					$this->genmod->add('pms_file', $data);
				}
				}
				$json = ['status'=> 1, 'msg'=>'บันทึกข้อมูลสำเร็จ'];		
			} else {		
				$t_id = $formData['t_id'];
				unset($formData['t_id']);
				if(is_array($fileAdd)) {
					for($i=0 ;$i<count($fileAdd); $i++) {
						$checkFile = $this->genmod->getOne('pms_file', '*', array('f_t_id'=>$t_id, 'f_name'=>$fileAdd[$i]),'','',''); // find file in database
						if(!isset($checkFile->f_id)) { // not found file
							$data = array('f_name'=>$fileAdd[$i], 'f_t_id'=>$t_id);
							$this->genmod->add('pms_file', $data);
						}
					}
				}
				if(is_array($fileRemove)) {
					for($i=0 ;$i<count($fileRemove); $i++) {
						$checkFile = $this->genmod->getOne('pms_file', '*', array('f_t_id'=>$t_id, 'f_name'=>$fileRemove[$i]),'','',''); // find file in database
						if(isset($checkFile->f_id)) { // found file
							$this->genmod->update('pms_file', array('f_status'=> 0), array('f_id' => $checkFile->f_id));
						}
					}
				}
				$this->genmod->update('pms_task', $formData, array('t_id'=>$t_id));
				$json = ['status'=> 1, 'msg'=>'แก้ไขข้อมูลสำเร็จ'];
			}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function uploadFiles() {
		// Create by: Patiphan Pansanga 14-10-2565 upload file to database
		date_default_timezone_set("Asia/Bangkok");
		if($_FILES["files"]["name"] != '') {
			$output = '';
			$config["upload_path"] = './upload/';
			$config["allowed_types"] = 'gif|jpg|jpeg|png|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			for($count = 0; $count<count($_FILES["files"]["name"]); $count++) {
				$newName = date("Y-m-d") . "_" .rand(100,999) ."_" . $_FILES["files"]["name"][$count]; // rename file
				$_FILES["file"]["name"] = $newName;
				$_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
				$_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
				$_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
				$_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
				if($this->upload->do_upload('file')) {
					$data = $this->upload->data();
					$output .= '<tr id="'.$data["file_name"].'"><td class="d-none"><input type="checkbox" class="tmpFiles" name="fileAdd" value="'.$data["file_name"].'" checked></td>
					<td onclick="openInNewTab(`'. base_url().'upload/'.$data["file_name"].'`)" class="name" style="cursor:pointer;"><u>'.substr($data["file_name"], 15).'</u></td>
					<td>'.thaiDate(date("Y-m-d")).'</td>
					<td class="text-center"><button type="button" class="btn btn-danger" title="ลบไฟล์" onclick="deleteFile(`'.$data["file_name"].'`)"><i class="mdi mdi-delete"></i></button></td>
					</tr>';
				}
			}
		 	// echo $output;
			$json['output'] = $output;
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
		}
	}

	public function deleteFile() {
		// Create by: Patiphan Pansanga 14-10-2565 delete temporary file
		$fileName = $this->input->post('fileName');
		unlink("./upload/" . $fileName);
	}

	public function updateStatusFile() {
		// Create by: Patiphan Pansanga 14-10-2565 update status file to 0
		$this->genmod->update('pms_file', array('f_status'=> 0), array('f_id' => $this->input->post('f_id')));
	}
	
	public function getAddForm() {
		// Create by: Patiphan Pansanga 14-10-2565 get add form
		$data['p_id'] =  $this->input->post('p_id');
		$data['tasks'] = $this->genmod->getAll('pms_tasklist', '*',array('tl_status'=>1));
		$json['title'] = 'เพิ่มกิจกรรม <span class="text-danger" style="font-size:12px;">(*จำเป็นต้องกรอกข้อมูล)</span>';
		$json['body'] = $this->load->view('tasks/formadd', $data, TRUE);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">บันทึก</button>
		<button type="button" class="btn btn-danger" onclick="closeModalTask(\'เพิ่มกิจกรรม\')">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm() {
		// Create by: Patiphan Pansanga 14-10-2565 get edit form
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_task.t_u_id','pms_tasklist' => 'pms_tasklist.tl_id=pms_task.t_tl_id');
		$data['tasks'] = $this->genmod->getAll('pms_tasklist', '*',array('tl_status'=>1));
		$data['getData'] = $this->genmod->getOne('pms_task', '*', array('t_id'=>$this->input->post('t_id')),'',$arrayJoin);
		$data['getFiles'] = $this->genmod->getAll('pms_file', '*', array('f_t_id'=>$this->input->post('t_id'), 'f_status'=>1),'','','');
		$json['title'] = 'แก้ไขข้อมูลกิจกรรม <span class="text-danger" style="font-size:12px;">(*จำเป็นต้องกรอกข้อมูล)</span>';
		$json['body'] = $this->load->view('tasks/formadd', $data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit('.$this->input->post('t_id').');">บันทึก</button>
		<button type="button" class="btn btn-danger" id="closeBtn" onclick="closeModalTask(\'แก้ไขกิจกรรม\')">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getDetailForm() {
		// Create by: Patiphan Pansanga 14-10-2565 get detail form
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_task.t_u_id','pms_tasklist' => 'pms_tasklist.tl_id=pms_task.t_tl_id', 'pms_project'=>'pms_project.p_id=pms_task.t_p_id');
		$data['tasks'] = $this->genmod->getAll('pms_tasklist', '*',array('tl_status'=>1));
		$data['getData'] = $this->genmod->getOne('pms_task', '*', array('t_id'=>$this->input->post('t_id')),'',$arrayJoin);
		$data['getFiles'] = $this->genmod->getAll('pms_file', '*', array('f_t_id'=>$this->input->post('t_id'), 'f_status'=>1),'','','');
		$data['detail'] = "yes";
		$json['title'] = 'รายละเอียดกิจกรรม';
		$json['body'] = $this->load->view('tasks/formadd', $data ,true);
		if($data['getData']->p_status < 3) {
			if($_SESSION['u_id'] == $data['getData']->t_u_id || $_SESSION['u_id'] <= 2) {
				$json['footer'] = '<button type="button" class="btn btn-warning" onclick="edit(' . $this->input->post('t_id') . ')" title="แก้ไขข้อมูลกิจกรรม">แก้ไขข้อมูล</button>';
			} else {
				$json['footer'] = '';
			}
		} else {
			$json['footer'] = '';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function updateStatus() {
		// Create by: Patiphan Pansanga 14-10-2565 update status task
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		$validCheck = $this->genmod->getOne('pms_task', '*', array('t_id' => $updateData['t_id']));
		if(isset($validCheck)) {
			if($validCheck->t_status == 1) {
				$this->genmod->update('pms_task', array('t_status'=> 0), array('t_id' => $updateData['t_id']));
				$tasksCount = $this->genmod->countAll('pms_task', array('t_status' => 1, 't_p_id' => $updateData['p_id']), '');
				if($tasksCount == 0) {
					$this->genmod->update('pms_project', array('p_status'=> 1), array('p_id' => $updateData['p_id']));
				}
				$msg = "ลบกิจกรรมสำเร็จ";
			} else {
				$this->genmod->update('pms_task', array('t_status'=> 1), array('t_id' => $updateData['t_id']));
				$msg = "กู้คืนกิจกรรมสำเร็จ";
			}				 
			$json = ['status'=> 1, 'msg'=>$msg];	
		} else {
			$json = ['status'=> 0, 'msg'=>"เกิดข้อผิดพลาด"];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
}
?>
