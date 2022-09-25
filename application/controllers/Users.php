<?php
// Create by: Patiphan Pansanga 07-09-2565 Users management
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		// Create by: Patiphan Pansanga 07-09-2565 construct
		parent::__construct();
		$this->genlib->checkLogin();
		$data = $this->genmod->getOne('pms_user', '*', array('u_id'=>$_SESSION['u_id']));
		$this->genlib->updateSession($data);
	}

	public function index()	{
		// Create by: Patiphan Pansanga 07-09-2565 index page
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$values['pageTitle'] = 'รายชื่อพนักงาน';
		$values['breadcrumb'] = 'รายชื่อพนักงาน';
		$values['pageContent'] = $this->load->view('users/index', $values, TRUE);
		$this->load->view('main', $values);
	}

	public function getAllRole($dataType = "php") {
		// Create by: Patiphan Pansanga 13-09-2565 return all user role
		if($dataType == "php") {
			$arrayRole = array(1=>"ผู้ดูแลระบบ", 2=>"หัวหน้าโครงการ", 3=>"พนักงาน");
			return $arrayRole;
		} else {
			$json = ['arrayRole'=> ["ผู้ดูแลระบบ", "หัวหน้าโครงการ", "พนักงาน"]];
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
		}
    }

	public function get() {
		// Create by: Patiphan Pansanga 08-09-2565 return table user
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$data['arrayRole'] = $this->getAllRole();
		$data['getData'] = $this->genmod->getAll('pms_user', '*','','u_createdate desc','','');
		$json['html'] = $this->load->view('users/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

 	public function getAddForm() {
		// Create by: Patiphan Pansanga 08-09-2565 get form add user
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$json['title'] = 'เพิ่มพนักงานในระบบ (<font class="text-danger">*</font>จำเป็นต้องกรอกข้อมูล)';
		$data['arrayRole'] = $this->getAllRole();
		$json['body'] = $this->load->view('users/formadd', $data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">บันทึก</button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'เพิ่มพนักงาน\')">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function add() {
		// Create by: Patiphan Pansanga 08-09-2565 add user in database
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$this->genlib->ajaxOnly();
		$formData = $this->input->post();
		$arrayErr = array(
      		'required' => 'คุณต้องทำการระบุ  {field} ',
			'numeric' => 'กรุณาระบุ {field} เป็นตัวเลขเท่านั้น',
			'min_length' => 'กรุณาระบุ {field} เป็นตัวเลขอย่างน้อย {param} หลัก',
			'max_length' => 'กรุณาระบุ {field} เป็นตัวเลขไม่เกิน {param} หลัก'
    	);
		$this->form_validation->set_rules('u_firstname', 'ชื่อ', 'required', $arrayErr);
		$this->form_validation->set_rules('u_lastname', 'นามสกุล', 'required', $arrayErr);
		$this->form_validation->set_rules('u_email', 'อีเมล', 'required|valid_email', $arrayErr);
		$this->form_validation->set_rules('u_tel', 'เบอร์โทรศัพท์', 'required|min_length[10]|max_length[10]', $arrayErr);
		$this->form_validation->set_rules('u_role', 'สิทธิ์การใช้งาน', 'required|numeric', $arrayErr);

		if($this->form_validation->run() !== FALSE && $formData['u_role'] < 4 && $formData['u_role'] > 0){
			$formData['u_email'] = strtolower($formData['u_email']);
			$validCheck = $this->genmod->getOne('pms_user', '*',array('u_email'=>$formData['u_email']));
			if($formData['u_id'] == 'new') {
				if(!$validCheck) {
					$formData['u_password'] = hash('sha256', $formData['u_tel']);
					$formData['u_creator'] = $_SESSION['u_id'];
					$this->genmod->add('pms_user',$formData);
					$json = ['status'=> 1, 'msg'=>'บันทึกข้อมูลสำเร็จ'];
				} else {
					$json = ['status'=> 0, 'msg'=>'เกิดข้อผิดพลาด อีเมลนี้มีผู้ใช้งานแล้ว', 'sql'=> $this->db->last_query()];
				}
			} else {
				if(isset($validCheck->u_role) && $validCheck->u_role <= 1) {
					$json = ['status'=> 0, 'msg'=>'เกิดข้อผิดพลาด ไม่มีสิทธิ์ในการแก้ไขข้อมูล', 'sql'=> $this->db->last_query()];
				} else if(!$validCheck || $validCheck->u_id == $formData['u_id']) {
					$u_id = $formData['u_id'];
					unset($formData['u_id']);
					$this->genmod->update('pms_user', $formData, array('u_id'=>$u_id));
					$json = ['status'=> 1, 'msg'=>'แก้ไขข้อมูลสำเร็จ'];
				} else {
					$json = ['status'=> 0, 'msg'=>'เกิดข้อผิดพลาด อีเมลนี้มีผู้ใช้งานแล้ว', 'sql'=> $this->db->last_query()];
				}
			}
		}else{
			$json = ['status'=> 0, 'msg'=>"พบปัญหา ข้อมูลมีความผิดพลาด เพิ่มข้อมูลไม่สำเร็จ ",'error'=>$this->form_validation->error_array()];
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm() {
		// Create by: Patiphan Pansanga 08-09-2565 get form edit user
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$json['title'] = 'แก้ไขข้อมูลพนักงาน';
		$data['arrayRole'] = $this->getAllRole();
		$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>$this->input->post('u_id')));
		$json['body'] = $this->load->view('users/formadd', $data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit('.$this->input->post('u_id').');">บันทึก</button>
		<button type="button" class="btn btn-danger" id="closeBtn" onclick="closeModal(\'แก้ไขพนักงาน\')">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getDetailForm() {
		// Create by: Jiradat Pomyai 14-09-2565 get form detail user
		if($this->input->post('person')!=null){
			$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>($_SESSION['u_id'])));
		}
		else{
			if($_SESSION['u_role'] > 1) {
				redirect(base_url());
			}
			$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>$this->input->post('u_id')));
		}
		$json['title'] = 'ข้อมูลพนักงาน';
		$data['detail'] = "yes";
		$data['arrayRole'] = $this->getAllRole();
		$json['body'] = $this->load->view('users/formadd', $data ,true);
		$json['footer'] = '';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getPasswordForm() {
		// Create by: Natakorn Phongsarikit 14-09-2565 get form password
		if($this->input->post('person')!=null) { 
			$data['personPassword'] = "yes";
			$json['title'] = 'เปลี่ยนรหัสผ่าน';
			$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>($_SESSION['u_id'])));
			$json['footer'] = '<span id="errMsg"></span><button type="button" class="btn btn-success" onclick="submitPersonPassword()">บันทึก</button>
			<button type="button" class="btn btn-danger" onclick="closeModal(\'เปลี่ยนรหัสผ่าน\')">ยกเลิก</button>';
		} else {
			if($_SESSION['u_role'] > 1) {
				redirect(base_url());
			}
			$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>$this->input->post('u_id')));
			$json['title'] = 'เปลี่ยนรหัสผ่านของ : ' . $data['getData']->u_firstname . " " . $data['getData']->u_lastname;
			$json['footer'] = '<span id="errMsg"></span><button type="button" class="btn btn-success" onclick="submitPwdForm('.$this->input->post('u_id').');">บันทึก</button>
			<button type="button" class="btn btn-danger" onclick="closeModal(\'เปลี่ยนรหัสผ่าน\')">ยกเลิก</button>';
		}
		
		$json['body'] = $this->load->view('users/formpassword', $data ,true);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}


	public function updatePassword() {
		// Create by: Patiphan Pansanga, Natakorn Phongsarikit 07-09-2565 update password in database
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		if(isset($updateData['curPwd'])) {
			$validCheck = $this->genmod->getOne('pms_user', '*', array('u_id' => $_SESSION['u_id']));
			$passwordHash = hash('sha256', $updateData['curPwd']); // เข้ารหัส Password รูปแบบ SHA-256 (Secure Hash Algorithm 256-bit)
			if(isset($validCheck) && $validCheck->u_password == $passwordHash) {
				if($updateData['pwd'] == $updateData['cfPwd']) {
					if(hash('sha256', $updateData['pwd']) != $validCheck->u_password) {
						$updateData['pwd'] = hash('sha256', $updateData['pwd']);
						$this->genmod->update('pms_user', array('u_password'=> $updateData['pwd']), array('u_id' => $_SESSION['u_id']));
						$json = ['status'=> 1, 'msg'=>"เปลี่ยนรหัสผ่านสำเร็จ"];
					}else{
						$json = ['status'=> 0, 'msg'=>"รหัสผ่านตรงใหม่ต้องไม่ตรงกับรหัสผ่านปัจจุบัน"];
					}
				}

			} else {
				$json = ['status'=> 0, 'msg'=>"รหัสผ่านปัจุบันไม่ถูกต้อง"];
			}     
		} else {
			$validCheck = $this->genmod->getOne('pms_user', '*', array('u_id' => $updateData['u_id']));
			if(isset($validCheck) && $_SESSION['u_role'] <= $validCheck->u_role) {
				if($updateData['pwd'] == $updateData['cfPwd']) {
					$updateData['pwd'] = hash('sha256', $updateData['pwd']);
					$this->genmod->update('pms_user', array('u_password'=> $updateData['pwd']), array('u_id' => $updateData['u_id']));
					$json = ['status'=> 1, 'msg'=>"เปลี่ยนรหัสผ่านสำเร็จ"];
				}
			} else {
				$json = ['status'=> 0, 'msg'=>"เกิดข้อผิดพลาด"];
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function updateRole() {
		// Create by: Patiphan Pansanga 07-09-2565 update role user in database
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		$validCheck = $this->genmod->getOne('pms_user', '*', array('u_id' => $updateData['u_id']));
		if(isset($validCheck) && $_SESSION['u_role'] <= $validCheck->u_role) {
			if($updateData['u_role'] < 4 && $updateData['u_role'] > 0) {
				$this->genmod->update('pms_user', array('u_role'=> $updateData['u_role']), array('u_id' => $updateData['u_id']));
				$json = ['status'=> 1, 'msg'=>"เปลี่ยนสิทธิ์การใช้งานสำเร็จ"];
			}
		} else {
			$json = ['status'=> 0, 'msg'=>"เกิดข้อผิดพลาด"];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

  	public function updateStatus() {
		// Create by: Patiphan Pansanga 07-09-2565 update status user in database
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		$validCheck = $this->genmod->getOne('pms_user', '*', array('u_id' => $updateData['u_id']));
		if(isset($validCheck) && $_SESSION['u_role'] <= $validCheck->u_role) {
			if($this->genmod->update('pms_user', array('u_status'=> ($updateData['u_status'] == 0? '1':'0')), array('u_id'=>$updateData['u_id']))){
				if($updateData['u_status'] == 1) {
					$msg = "ระงับการทำงานของพนักงานสำเร็จ";
				} else {
					$msg = "กู้คืนข้อมูลพนักงานสำเร็จ";
				}
				$json = ['status'=> 1, 'msg'=>$msg];
			}
		}else{
			$json = ['status'=> 0, 'msg'=>"เกิดข้อผิดพลาด"];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function checkCurrentPassword() {
		// Create by: Patiphan Pansanga 15-09-2565 check current password
		$data = $this->input->post();
		$validCheck = $this->genmod->getOne('pms_user', '*', array('u_id' => $_SESSION['u_id']));
		if($validCheck->u_password == hash('sha256', $data['pwd'])) {
			$json = ['result'=> 1];
		} else {
			$json = ['result'=> 0];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
}
