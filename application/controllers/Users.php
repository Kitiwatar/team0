<?php
// Create by: Patiphan Pansanga 07-09-2565 Users management
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		// Create by: Patiphan Pansanga 07-09-2565 construct
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
		// Create by: Patiphan Pansanga 07-09-2565 index page
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$values['pageTitle'] = lang('tp_user_em-name');
		$values['breadcrumb'] = lang('tp_user_em-name');
		$values['pageContent'] = $this->load->view('users/index', $values, TRUE);
		$this->load->view('main', $values);
	}

	public function get() {
		// Create by: Patiphan Pansanga 08-09-2565 return table user
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$data['arrayRole'] = $this->genlib->getUserRole();
		$data['getData'] = $this->genmod->getAll('pms_user', '*','','u_createdate desc','','');
		$json['html'] = $this->load->view('users/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
		
	}

 	public function getAddForm() {
		// Create by: Patiphan Pansanga 08-09-2565 get add user form
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$json['title'] = '<h1><b>'.lang('md_tl_a-aes').'</b></h1>'.lang('md_tl_an-aes').' <span class="text-danger" style="font-size:12px;">(* '.lang('md_tl_a-req').' )</span>';
		$data['arrayRole'] = $this->genlib->getUserRole();
		$json['body'] = $this->load->view('users/formadd', $data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">'.lang('bt_save').'</button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'เพิ่มพนักงาน\')">'.lang('bt_cancel').'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function add() {
		// Create by: Patiphan Pansanga 08-09-2565 add user in database
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$this->genlib->ajaxOnly();
		$formData = $this->input->post();
		$dataRequires = array('u_id','u_firstname','u_lastname','u_email','u_tel','u_role','u_position');
		foreach ($dataRequires as $value) {
			if(!isset($formData[$value])) {
				$json = ['status'=> 0, 'msg'=>lang('md_vm_ad-fail')];
				$this->output->set_content_type('application/json')->set_output(json_encode($json));
				return;
			}
		}
		$formData['u_email'] = strtolower($formData['u_email']);
		$validCheck = $this->genmod->getOne('pms_user', '*',array('u_email'=>$formData['u_email']));
		if($formData['u_id'] == 'new') {
			if(!$validCheck) {
				$formData['u_password'] = hash('sha256', $formData['u_tel']);
				$formData['u_creator'] = $_SESSION['u_id'];
				$this->genmod->add('pms_user',$formData);
				$json = ['status'=> 1, 'msg'=>lang('md_vm_ct-save')];
			} else {
				$json = ['status'=> 0, 'msg'=>lang('md_vm_aem-fail'), 'sql'=> $this->db->last_query()];
			}
		} else {
			if(!$validCheck || $validCheck->u_id == $formData['u_id']) {
				$u_id = $formData['u_id'];
				unset($formData['u_id']);
				$this->genmod->update('pms_user', $formData, array('u_id'=>$u_id));
				$json = ['status'=> 1, 'msg'=>lang('md_vm_ct-edit')];
			} else {
				$json = ['status'=> 0, 'msg'=>lang('md_vm_aem-fail'), 'sql'=> $this->db->last_query()];
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm() {
		// Create by: Patiphan Pansanga 08-09-2565 get form edit user
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$json['title'] = lang('md_tl_e-em').'<span class="text-danger" style="font-size:12px;"> (* '.lang('md_tl_a-req').' )</span>';
		$data['arrayRole'] = $this->genlib->getUserRole();
		$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>$this->input->post('u_id')));
		$json['body'] = $this->load->view('users/formadd', $data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit('.$this->input->post('u_id').');">'.lang('bt_save') .'</button>
		<button type="button" class="btn btn-danger" id="closeBtn" onclick="closeModal(\'แก้ไขพนักงาน\')">'.lang('bt_cancel') .'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getDetailForm() {
		// Create by: Jiradat Pomyai 14-09-2565 get form detail user
		$isPersonal = $this->input->post('person');
		if($isPersonal != null){
			$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>($_SESSION['u_id'])));
		}
		else{
			if($_SESSION['u_role'] > 1) {
				redirect(base_url());
			}
			$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>$this->input->post('u_id')));
		}
		$json['title'] = lang('md_tl_v-em');
		$data['detail'] = "yes";
		$data['arrayRole'] = $this->genlib->getUserRole();
		$json['body'] = $this->load->view('users/formadd', $data ,true);
		if($data['getData']->u_status == 1 && $this->input->post('person') == null) {
			$json['footer'] = '<button type="button" class="btn btn-warning" onclick="edit(' . $this->input->post('u_id') . ')" title="แก้ไขข้อมูลพนักงาน">'.lang('bt_edit') .'</button>';
		} else {
			$json['footer'] = '';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getPasswordForm() {
		// Create by: Natakorn Phongsarikit 14-09-2565 get form password
		if($this->input->post('person')!=null) { 
			$data['personPassword'] = "yes";
			$json['title'] = lang('md_tl_e-ps') ." ". $_SESSION['u_fullname'].'<span class="text-danger" style="font-size:12px;"> (* '.lang('md_tl_a-req').' )</span>';
			$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>($_SESSION['u_id'])));
			$json['footer'] = '<span id="errMsg"></span><button type="button" class="btn btn-success" onclick="submitPersonPassword()">'.lang('bt_save') .'</button>
			<button type="button" class="btn btn-danger" onclick="closeModal(\'เปลี่ยนรหัสผ่าน\')">'.lang('bt_cancel') .'</button>';
		} else {
			if($_SESSION['u_role'] > 1) {
				redirect(base_url());
			}
			$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>$this->input->post('u_id')));
			$json['title'] = lang('md_tl_e-ps') ." ". $data['getData']->u_firstname . " " . $data['getData']->u_lastname.'<span class="text-danger" style="font-size:12px;"> (* '.lang('md_tl_a-req').' )</span>';
			$json['footer'] = '<span id="errMsg"></span><button type="button" class="btn btn-success" onclick="submitPwdForm('.$this->input->post('u_id').');">'.lang('bt_save') .'</button>
			<button type="button" class="btn btn-danger" onclick="closeModal(\'เปลี่ยนรหัสผ่าน\')">'.lang('bt_cancel') .'</button>';
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
						$json = ['status'=> 1, 'msg'=>lang('md_cpes_vm-msg')];
					}else{
						$json = ['status'=> 0, 'msg'=>lang('md_cpes_vm_fc1-msg')];
					}
				}

			} else {
				$json = ['status'=> 0, 'msg'=>lang('md_cpes_vm_fc2-msg')];
			}     
		} else {
			$validCheck = $this->genmod->getOne('pms_user', '*', array('u_id' => $updateData['u_id']));
			if(isset($validCheck) && $_SESSION['u_role'] <= $validCheck->u_role) {
				if($updateData['pwd'] == $updateData['cfPwd']) {
					$updateData['pwd'] = hash('sha256', $updateData['pwd']);
					$this->genmod->update('pms_user', array('u_password'=> $updateData['pwd']), array('u_id' => $updateData['u_id']));
					$json = ['status'=> 1, 'msg'=>lang('md_cpes_vm-msg')];
				}
			} else {
				$json = ['status'=> 0, 'msg'=>lang('md_vm-fail')];
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
				$json = ['status'=> 1, 'msg'=>lang('md_cpme_main_s-msg')];
			}
		} else {
			$json = ['status'=> 0, 'msg'=>lang('md_vm-fail')];
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
					$msg = lang('md_sem_vm_s-msg');
				} else {
					$msg = lang('md_rem_vm_s-msg');
				}
				$json = ['status'=> 1, 'msg'=>$msg];
			}
		}else{
			$json = ['status'=> 0, 'msg'=>lang('md_vm-fail')];
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
