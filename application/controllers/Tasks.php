<?php
// Create by: Jiradat Pomyai 15-09-2565 Projects management
defined('BASEPATH') OR exit('No direct script access allowed');
class Tasks extends CI_Controller{
    public function __construct() {
		// Create by: Jiradat Pomyai 15-09-2565
		parent::__construct();
		$this->genlib->checkLogin();
		$data = $this->genmod->getOne('pms_user', '*', array('u_id'=>$_SESSION['u_id']));
		$this->genlib->updateSession($data);
	}

    public function index($p_id = 0)	{
		// Create by: Jiradat Pomyai 19-09-2565 index page
		$projectsCount = $this->genmod->countAll('pms_project', '', '');
		if($p_id == 0 || $p_id > $projectsCount) {
			redirect(base_url("projects"));
		}
		$values['pageTitle'] = 'ตารางแสดงกิจกรรมโครงการ';
		$values['breadcrumb'] = 'ตารางแสดงกิจกรรมโครงการ';
		$values['p_id'] = $p_id;
		$values['pageContent'] = $this->load->view('tasks/index', $values, TRUE);
		$this->load->view('main', $values);
	}

	public function get() {
		// Create by: Jiradat Pomyai 19-09-2565
		$data['pageTitle'] =  'โครงการที่เกี่ยวข้อง';
		$data['breadcrumb'] = 'โครงการที่เกี่ยวข้อง';
		// $data['p_id'] =  $this->input->post('p_id');
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_task.t_u_id','pms_tasklist' => 'pms_tasklist.tl_id=pms_task.t_tl_id');
		$data['getData'] = $this->genmod->getAll('pms_task', '*',array('t_p_id'=>$this->input->post('p_id'), 't_status'=>1),'t_createdate desc',$arrayJoin,'');
		$data['projectData'] = $this->genmod->getOne('pms_project', '*',array('p_id'=>$this->input->post('p_id')),'','','');
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		$data['permission'] = $this->genmod->getAll('pms_permission', '*',array('per_p_id'=>$this->input->post('p_id'), 'per_status'=>1),'per_createdate desc',$arrayJoin,'');
		$json['html'] = $this->load->view('tasks/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function add() {
		// Create by: Jiradat Pomyai 28-09-2565 add project in database
		$this->genlib->ajaxOnly();
		$formData = $this->input->post('formData');
		$fileNames = $this->input->post('fileNames');
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
				if(is_array($fileNames)) {
				$maxId = $this->genmod->getMaxTask($formData['t_p_id']);
				for($i=0 ;$i<count($fileNames); $i++) {
					$data = array('f_name'=>$fileNames[$i], 'f_t_id'=>$maxId->t_id);
					$this->genmod->add('pms_file', $data);
				}
				}
				$json = ['status'=> 1, 'msg'=>'บันทึกข้อมูลสำเร็จ'];		
			} else {		
				$t_id = $formData['t_id'];
				unset($formData['t_id']);
				$files = $this->genmod->getAll('pms_file', '*', array('f_t_id'=>$t_id, 'f_status'=>1),'','','');
				if(is_array($files)) {
					for($i=0; $i<count($files); $i++) {
						$check = 0;
						for($j=0; $j<count($fileNames); $j++) {
							if($fileNames[$j] == $files[$i]->f_name) {
								$check = 1;
								break;
							}
						}
						if($check == 0) {
							$this->genmod->update('pms_file', array('f_status'=> 0), array('f_name' => $files[$i]->f_name));
						}
					}
					for($i=0; $i<count($fileNames); $i++) {
						$find = null;
						$find = $this->genmod->getOne('pms_file', '*', array('f_name'=>$fileNames[$i]));
						if($find == null) {
							$data = array('f_name'=>$fileNames[$i], 'f_t_id'=>$t_id);
							$this->genmod->add('pms_file', $data);
						}
					}
				} else {
					for($i=0 ;$i<count($fileNames); $i++) {
						$data = array('f_name'=>$fileNames[$i], 'f_t_id'=>$t_id);
						$this->genmod->add('pms_file', $data);
					}
				}

				$this->genmod->update('pms_task', $formData, array('t_id'=>$t_id));
				$json = ['status'=> 1, 'msg'=>'แก้ไขข้อมูลสำเร็จ'];
			}
		// }else{
		// 	$json = ['status'=> 0, 'msg'=>"พบปัญหา ข้อมูลมีความผิดพลาด เพิ่มข้อมูลไม่สำเร็จ ",'error'=>$this->form_validation->error_array()];
		// }

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function uploadFiles() {
		date_default_timezone_set("Asia/Bangkok");
		if($_FILES["files"]["name"] != '') {
			$output = '';
			$config["upload_path"] = './upload/';
			$config["allowed_types"] = '*';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			for($count = 0; $count<count($_FILES["files"]["name"]); $count++) {
				$newName = date("Y-m-d") . "_" .rand(100,999) ."_" . $_FILES["files"]["name"][$count];
				$_FILES["file"]["name"] = $newName;
				$_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
				$_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
				$_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
				$_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
				if($this->upload->do_upload('file')) {
					$data = $this->upload->data();
					$output .= '<tr id="'.$data["file_name"].'"><td class="d-none"><input type="checkbox" class="tmpFiles" name="fileNames" value="'.$data["file_name"].'" checked></td>
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
		// Create by: Jiradat Pomyai 28-09-2565 get add form
		$fileName = $this->input->post('fileName');
		unlink("./upload/" . $fileName);
	}

	public function updateStatusFile() {
		// Create by: Jiradat Pomyai 28-09-2565 get add form
		$this->genmod->update('pms_file', array('f_status'=> 0), array('f_id' => $this->input->post('f_id')));
	}
	
	public function getAddForm() {
		// Create by: Jiradat Pomyai 28-09-2565 get add form
		$data['p_id'] =  $this->input->post('p_id');
		$data['tasks'] = $this->genmod->getAll('pms_tasklist', '*',array('tl_status'=>1));
		$json['title'] = 'เพิ่มกิจกรรม <span class="text-danger" style="font-size:12px;">(*จำเป็นต้องกรอกข้อมูล)</span>';
		$json['body'] = $this->load->view('tasks/formadd', $data, TRUE);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">บันทึก</button>
		<button type="button" class="btn btn-danger" onclick="closeModalTask(\'เพิ่มกิจกรรม\')">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm() {
		// Create by: Patiphan Pansanga 11-10-2565 get edit form 
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_task.t_u_id','pms_tasklist' => 'pms_tasklist.tl_id=pms_task.t_tl_id');
		$data['tasks'] = $this->genmod->getAll('pms_tasklist', '*',array('tl_status'=>1));
		$data['getData'] = $this->genmod->getOne('pms_task', '*', array('t_id'=>$this->input->post('t_id')),'',$arrayJoin);
		$data['getFiles'] = $this->genmod->getAll('pms_file', '*', array('f_t_id'=>$this->input->post('t_id'), 'f_status'=>1),'','','');
		$json['title'] = 'แก้ไขข้อมูลโครงการ <span class="text-danger" style="font-size:12px;">(*จำเป็นต้องกรอกข้อมูล)</span>';
		$json['body'] = $this->load->view('tasks/formadd', $data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit('.$this->input->post('t_id').');">บันทึก</button>
		<button type="button" class="btn btn-danger" id="closeBtn" onclick="closeModalTask(\'แก้ไขกิจกรรม\')">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getDetailForm() {
		// Create by: Jiradat Pomyai 01-10-2565 get form detail projects
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_task.t_u_id','pms_tasklist' => 'pms_tasklist.tl_id=pms_task.t_tl_id', 'pms_project'=>'pms_project.p_id=pms_task.t_p_id');
		$data['tasks'] = $this->genmod->getAll('pms_tasklist', '*',array('tl_status'=>1));
		$data['getData'] = $this->genmod->getOne('pms_task', '*', array('t_id'=>$this->input->post('t_id')),'',$arrayJoin);
		$data['getFiles'] = $this->genmod->getAll('pms_file', '*', array('f_t_id'=>$this->input->post('t_id'), 'f_status'=>1),'','','');
		$data['detail'] = "yes";
		$json['title'] = 'ข้อมูลพนักงาน';
		$json['body'] = $this->load->view('tasks/formadd', $data ,true);
		if($data['getData']->p_id < 3) {
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
		// Create by: Patiphan Pansanga 01-10-2565 update status project in database
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		$validCheck = $this->genmod->getOne('pms_task', '*', array('t_id' => $updateData['t_id']));
		if(isset($validCheck)) {
			if($validCheck->t_status == 1) {
				$this->genmod->update('pms_task', array('t_status'=> 0), array('t_id' => $updateData['t_id']));
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
