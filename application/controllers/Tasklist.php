<?php
// Create by: Natakorn Phongsarikit 15-09-2565 Tasklist management
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasklist extends CI_Controller {

	public function __construct() {
		// Create by: Natakorn Phongsarikit 15-09-2565 construct
		parent::__construct();
		$this->genlib->checkLogin();
		$data = $this->genmod->getOne('pms_user', '*', array('u_id'=>$_SESSION['u_id']));
		$this->genlib->updateSession($data);
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
	}

	public function index()	{
		// Create by: Natakorn Phongsarikit 15-09-2565 index
		$values['pageTitle'] = 'เพิ่มรายการกิจกรรมใหม่';
		$values['breadcrumb'] = 'เพิ่มรายการกิจกรรมใหม่';
		$values['pageContent'] = $this->load->view('tasklist/index', $values, TRUE);
		$this->load->view('main', $values);
	}


	public function get() {
		// Create by: Natakorn Phongsarikit 15-09-2565 get task list
		$arrayJoin = array('pms_user'=>'pms_tasklist.tl_u_id=pms_user.u_id');
		$data['getData'] = $this->genmod->getAll('pms_tasklist', '*','','tl_createdate desc',$arrayJoin,'');
		$json['html'] = $this->load->view('tasklist/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

 	public function getAddForm() {
		// Create by: Natakorn Phongsarikit 15-09-2565 get form for add task
		$data = array(); 
		$json['title'] = 'เพิ่มรายการกิจกรรมใหม่';
		$json['body'] = $this->load->view('tasklist/formadd',$data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">บันทึก</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function add() {
		// Create by: Natakorn Phongsarikit 15-09-2565 add tasklist to database
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
		// Create by: Natakorn Phongsarikit 15-09-2565 get form edit task
		$json['title'] = 'แก้ไขข้อมูลรายการกิจกรรม';
		$data['getData'] = $this->genmod->getOne('pms_tasklist', '*', array('tl_id'=>$this->input->post('tl_id')));
		$json['body'] = $this->load->view('tasklist/formadd',$data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit('.$this->input->post('tl_id').');">บันทึก</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getDetailForm() {
		// Create by: Natakorn Phongsarikit 15-09-2565 get detail form
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
		$json['body'] = $this->load->view('users/formadd', $data ,true);
		$json['footer'] = '';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

  	public function updateStatus() {
		// Create by: Natakorn Phongsarikit 15-09-2565 update status of tasklist
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
			if($this->genmod->update('pms_tasklist', array('tl_status'=> ($updateData['tl_status'] == 0? '1':'0')), array('tl_id'=>$updateData['tl_id']))){
				if($updateData['tl_status'] == 1) {
					$msg = "ลบรายการออกจากระบบสำเร็จ";
				} else {
					$msg = "กู้คืนรายการสำเร็จ";
				}
				$json = ['status'=> 1, 'msg'=>$msg];
			
		}else{
			$json = ['status'=> 0, 'msg'=>"เกิดข้อผิดพลาด"];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	
}
