<?php
/*
	Author: Patiphan Pansanga, Jiradat Pomyai, Natakorn Phongsarikit
	Create: 2022-09-07
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class tasks extends CI_Controller {

	public function index()	{
		/*
			Author: Patiphan Pansanga
			Create: 2022-09-07
		*/
		
		$values['pageTitle'] = 'เพิ่มรายการกิจกรรมใหม่';
		$values['breadcrumb'] = 'เพิ่มรายการกิจกรรมใหม่';
		$values['pageContent'] = $this->load->view('tasks/index', $values, TRUE);
		$this->load->view('main', $values);
	}


	public function get() {
		/*
			Author: Patiphan Pansanga
			Create: 2022-09-07
		*/

		$arrayJoin = array('pms_user'=>'pms_tasklist.tl_u_id=pms_user.u_id');
		$data['getData'] = $this->genmod->getAll('pms_tasklist', '*','','tl_createdate desc',$arrayJoin,'');
		$json['html'] = $this->load->view('tasks/tasklist', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

 	public function getAddForm() {
		/*
			Author: Patiphan Pansanga
			Create: 2022-09-08
		*/
		$data =array(); 
		$json['title'] = 'เพิ่มรายการกิจกรรมใหม่';
		$json['body'] = $this->load->view('tasks/formadd',$data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">บันทึก</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function add() {
		/*
			Author: Patiphan Pansanga
			Create: 2022-09-08
		*/
		
	
		$this->genlib->ajaxOnly();
		$formData = $this->input->post();
		$arrayErr = array(
      		'required' => 'คุณต้องทำการระบุ  {field} ',
			'numeric' => 'กรุณาระบุ {field} เป็นตัวเลขเท่านั้น',
			'min_length' => 'กรุณาระบุ {field} เป็นตัวเลขอย่างน้อย {param} หลัก',
			'max_length' => 'กรุณาระบุ {field} เป็นตัวเลขไม่เกิน {param} หลัก'
    	);
		$this->form_validation->set_rules('tl_name','ชื่อกิจกรรม', 'required', $arrayErr);
		if($this->form_validation->run() !== FALSE){
			if($formData['tl_id'] == 'new') {
				$formData['tl_name'] = strtolower($formData['tl_name']);
				$formData['tl_u_id'] = $_SESSION['u_id'];
				$this->genmod->add('pms_tasklist',$formData);
					$json = ['status'=> 1, 'msg'=>'บันทึกข้อมูลสำเร็จ'];
			}   else{
						$tl_id = $formData['tl_id'];
						unset($formData['tl_id']);
						$this->genmod->update('pms_tasklist', $formData, array('tl_id'=>$tl_id));
						$json = ['status'=> 1, 'msg'=>'แก้ไขข้อมูลสำเร็จ'];
			}
		}else{
			$json = ['status'=> 0, 'msg'=>"พบปัญหา ข้อมูลมีความผิดพลาด เพิ่มข้อมูลไม่สำเร็จ ",'error'=>$this->form_validation->error_array()];
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm() {
		/*
			Author: Patiphan Pansanga
			Create: 2022-09-08
		*/
		$json['title'] = 'แก้ไขข้อมูลรายการกิจกรรม';
		$data['getData'] = $this->genmod->getOne('pms_tasklist', '*', array('tl_id'=>$this->input->post('tl_id')));
		$json['body'] = $this->load->view('tasks/formadd',$data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit('.$this->input->post('tl_id').');">บันทึก</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getDetailForm() {
		/*
			Author: Jiradat Pomyai
			Create: 2022-09-08
		*/
		if($this->input->post('person')!=null){
			$data['getData'] = $this->genmod->getOne('pms_user', '*', array('tl_id'=>($_SESSION['tl_id'])));
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
		/*
			Author: Natakorn Phongsarikit
			Create: 2022-09-14
		*/
		if($this->input->post('person')!=null) { 
			$data['personPassword'] = "yes";
			$json['title'] = 'เปลี่ยนรหัสผ่าน';
			$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>($_SESSION['u_id'])));
			$json['footer'] = '<span id="errMsg"></span><button type="button" class="btn btn-success" onclick="submitPersonPassword()">บันทึก</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';
		} else {
			if($_SESSION['u_role'] > 1) {
				redirect(base_url());
			}
			$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>$this->input->post('u_id')));
			$json['title'] = 'เปลี่ยนรหัสผ่านของ : ' . $data['getData']->u_firstname . " " . $data['getData']->u_lastname;
			$json['footer'] = '<span id="errMsg"></span><button type="button" class="btn btn-success" onclick="submitPwdForm('.$this->input->post('u_id').');">บันทึก</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';
		}
		
		$json['body'] = $this->load->view('users/formpassword', $data ,true);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}


	public function updatePassword() {
		/*
			Author: Patiphan Pansanga, Natakorn Phongsarikit
			Create: 2022-09-07
		*/
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		if(isset($updateData['curPwd'])) {
			$validCheck = $this->genmod->getOne('pms_user', '*', array('u_id' => $_SESSION['u_id']));
			$passwordHash = hash('sha256', $updateData['curPwd']);
			if(isset($validCheck) && $validCheck->u_password == $passwordHash) {
				if($updateData['pwd'] == $updateData['cfPwd']) {
					if(hash('sha256', $updateData['pwd']) != $validCheck->u_password) {
						$updateData['pwd'] = hash('sha256', $updateData['pwd']);
						$this->genmod->update('pms_user', array('u_password'=> $updateData['pwd']), array('u_id' => $_SESSION['u_id']));
						$json = ['status'=> 1, 'msg'=>"เปลี่ยนรหัสผ่านสำเร็จ"];
					}else{
						$json = ['status'=> 0, 'msg'=>"รหัสผ่านตรงใหม่ต้องไม่ตรงกับรหัสผ่านปัจุบัน"];
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
		/*
			Author: Patiphan Pansanga
			Create: 2022-09-07
		*/
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
		/*
			Author: Patiphan Pansanga
			Create: 2022-09-07
		*/
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		$validCheck = $this->genmod->getOne('pms_user', '*', array('u_id' => $updateData['u_id']));
		if(isset($validCheck) && $_SESSION['u_role'] <= $validCheck->u_role) {
			if($this->genmod->update('pms_user', array('u_status'=> ($updateData['u_status'] == 0? '1':'0')), array('u_id'=>$updateData['u_id']))){
				if($updateData['u_status'] == 1) {
					$msg = "ลบพนักงานออกจากระบบสำเร็จ";
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
}
