<?php
// Create by: Natakorn Phongsarikit 15-09-2565 Tasklist management
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancellist extends CI_Controller {

	public function __construct() {
		// Create by: Natakorn Phongsarikit 15-09-2565 construct
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
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
	}

	public function index()	{
		// Create by: Patiphan Pansanga 25-01-2565 index
		$values['pageTitle'] = "รายชื่อสาเหตุการยุติโครงการ";
		$values['breadcrumb'] = "รายชื่อสาเหตุการยุติโครงการ";
		$values['pageContent'] = $this->load->view('cancellist/index', $values, TRUE);
		$this->load->view('main', $values);
	}

	public function get() {
		// Create by: Natakorn Phongsarikit 15-09-2565 get task list
		$arrayJoin = array('pms_user'=>'pms_cancellist.cl_u_id=pms_user.u_id');
		$getData = $this->genmod->getAll('pms_cancellist', '*','','cl_createdate desc',$arrayJoin,'');
		$cancelCheck = array();
		if(is_array($getData)) {
			for($i=0; $i<count($getData); $i++) {
				$cancelCheck[$i] = $this->genmod->getAll('pms_cancel', '*',array('c_cl_id'=>$getData[$i]->cl_id),'','','');
			}
		}
		$data['cancelCheck'] = $cancelCheck;
		$data['getData'] = $getData;
		$json['html'] = $this->load->view('cancellist/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

 	public function getAddForm() {
		// Create by: Natakorn Phongsarikit 15-09-2565 get form for add task
		$json['title'] = lang('md_tl_a-tl');
		$json['body'] = $this->load->view('cancellist/formadd', '', true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">'.lang('bt_save') .'</button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'เพิ่มรายชื่อยุติโครงการ\')">'.lang('bt_cancel') .'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function add() {
		// Create by: Natakorn Phongsarikit 15-09-2565 add cancellist to database
		$this->genlib->ajaxOnly();
		$formData = $this->input->post();

		$dataRequires = array('cl_id','cl_name');
		foreach ($dataRequires as $value) {
			if(!isset($formData[$value])) {
				$json = ['status'=> 0, 'msg'=>lang('md_vm_ad-fail')];
				$this->output->set_content_type('application/json')->set_output(json_encode($json));
				return;
			}
		}
		if($formData['cl_id'] == 'new') {
			$formData['cl_name'] = strtolower($formData['cl_name']);
			$formData['cl_u_id'] = $_SESSION['u_id'];
			$this->genmod->add('pms_cancellist',$formData);
			$json = ['status'=> 1, 'msg'=>lang('md_vm_ct-save')];
		} else {
			$cl_id = $formData['cl_id'];
			unset($formData['cl_id']);
			$this->genmod->update('pms_cancellist', $formData, array('cl_id'=>$cl_id));
			$json = ['status'=> 1, 'msg'=>lang('md_vm_ct-edit')];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm() {
		// Create by: Natakorn Phongsarikit 15-09-2565 get form edit task
		$json['title'] = lang('md_tl_e-tl');
		$data['getData'] = $this->genmod->getOne('pms_cancellist', '*', array('cl_id'=>$this->input->post('cl_id')));
		$json['body'] = $this->load->view('cancellist/formadd',$data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit('.$this->input->post('cl_id').');">'. lang('bt_save') .'</button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'แก้ไขรายชื่อยุติโครงการ\')">'. lang('bt_cancel') .'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

  	public function updateStatus() {
		// Create by: Natakorn Phongsarikit 15-09-2565 update status of cancellist
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
			if($this->genmod->update('pms_cancellist', array('cl_status'=> ($updateData['cl_status'] == 0? '1':'0')), array('cl_id'=>$updateData['cl_id']))){
				if($updateData['cl_status'] == 1) {
					$msg = lang('md_dtl_vm-msg');
				} else {
					$msg = "กู้คืนรายการสำเร็จ";
				}
				$json = ['status'=> 1, 'msg'=>$msg];
			
		}else{
			$json = ['status'=> 0, 'msg'=>lang('md_vm-fail')];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function checkRepeat() {
		// Create by: Patiphan Pansanga 16-12-2565 find repeat cancellist name
		$this->genlib->ajaxOnly();
		$checkData = $this->genmod->getOne('pms_cancellist', '*', array('cl_name'=>$this->input->post('cl_name'), 'cl_status'=>1));
		if(isset($checkData->cl_name)) {
			$json = ['status'=> 0, 'msg'=>"มีรายชื่อกิจกรรมนี้อยู่แล้ว"];
		} else {
			$json = ['status'=> 1, 'msg'=>""];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	
}
