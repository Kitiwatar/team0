<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->genlib->checkLogin();
		if($_SESSION['u_role'] != 1) {
			redirect(base_url());
		}
	}

	public function index()	{
		$values['pageTitle'] = 'รายชื่อพนักงานในระบบ';
		$values['breadcrumb'] = 'รายชื่อพนักงานในระบบ';
		$values['pageContent'] = $this->load->view('users/index', $values, TRUE);
		$this->load->view('main', $values);
	}

	public function get(){
		$data['getData'] = $this->genmod->getAll('pms_user', '*', '','u_createdate desc');
		$json['html'] = $this->load->view('users/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

  public function getAddForm(){
		$json['title'] = 'เพิ่มพนักงานในระบบ';
		$data['arrayRole'] = array("1"=>"ผู้ดูแลระบบ", "2"=>"หัวหน้าโครงการ", "3"=>"พนักงาน");
		$json['body'] = $this->load->view('users/formadd', $data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">บันทึก</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function add(){
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
		$this->form_validation->set_rules('u_tel', 'เบอร์โทรศัพท์', 'required|numeric|min_length[10]|max_length[10]', $arrayErr);
		$this->form_validation->set_rules('u_role', 'สิทธิ์การใช้งาน', 'required|numeric', $arrayErr);

		if($this->form_validation->run() !== FALSE && $formData['u_role'] < 4 && $formData['u_role'] > 0){
			$checkSame = $this->genmod->getOne('pms_user', 'u_id',array('u_email'=>$formData['u_email']));
			$formData['u_email'] = strtolower($formData['u_email']);
			if(!$checkSame || $checkSame->u_id == $formData['u_id']) {
				if($formData['u_id'] == 'new'){
					$formData['u_password'] = hash('sha256', $formData['u_tel']);
					$this->genmod->add('pms_user',$formData);
					$json = ['status'=> 1, 'msg'=>'บันทึกข้อมูลสำเร็จ'];
				}else{
					$u_id = $formData['u_id'];
					unset($formData['u_id']);
					$this->genmod->update('pms_user', $formData, array('u_id'=>$u_id));
					$json = ['status'=> 1, 'msg'=>'แก้ไขข้อมูลสำเร็จ'];
				}
			} else {
				$json = ['status'=> 0, 'msg'=>'เกิดข้อผิดพลาด อีเมลนี้มีผู้ใช้งานแล้ว', 'sql'=> $this->db->last_query()];
			}
		}else{
			$json = ['status'=> 0, 'msg'=>"พบปัญหา ข้อมูลมีความผิดพลาด เพิ่มข้อมูลไม่สำเร็จ ",'error'=>$this->form_validation->error_array()];
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm(){
		$json['title'] = 'แก้ไขข้อมูลพนักงาน';
		$data['arrayRole'] = array(1=>"ผู้ดูแลระบบ", 2=>"หัวหน้าโครงการ", 3=>"พนักงาน");
		$data['getData'] = $this->genmod->getOne('pms_user', '*', array('u_id'=>$this->input->post('u_id')));
		$json['body'] = $this->load->view('users/formadd', $data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit('.$this->input->post('u_id').');">บันทึก</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

  public function updateStatus(){
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		if($this->genmod->update('pms_user', array('u_status'=> ($updateData['u_status'] == 0? '1':'0')), array('u_id'=>$updateData['u_id']))){
			if($updateData['u_status'] == 1) {
				$msg = "ลบพนักงานออกจากระบบสำเร็จ";
			} else {
				$msg = "กู้คืนข้อมูลพนักงานสำเร็จ";
			}
			$json = ['status'=> 1, 'msg'=>$msg];
		}else{
			$json = ['status'=> 0, 'msg'=>"เกิดข้อผิดพลาด"];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
}
