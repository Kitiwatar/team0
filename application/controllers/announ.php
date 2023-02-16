<?php
// Create by: Natakorn Phongsarikit 15-09-2565 cancellist management
defined('BASEPATH') OR exit('No direct script access allowed');

class Announ extends CI_Controller {

	public function __construct() {
		// Create by: Create by: Natakorn Phongsarikit 01-02-2566 construct
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
		// Create by: Create by: Natakorn Phongsarikit 01-02-2566 index
		$values['pageTitle'] = "ประกาศจากระบบ";
		$values['breadcrumb'] ="ประกาศจากระบบ";
		$values['pageContent'] = $this->load->view('announcement/index', $values, TRUE);
		$this->load->view('main', $values);
	}

	public function get() {
		// Create by: Create by: Natakorn Phongsarikit 01-02-2566 get task list
		$arrayJoin = array('pms_user'=>'pms_announcement.an_u_id=pms_user.u_id');
		$getData = $this->genmod->getAll('pms_announcement', '*','','an_createdate desc',$arrayJoin,'');
		$anon = array();
		if(is_array($getData)) {
			for($i=0; $i<count($getData); $i++) {
				$anon[$i] = $this->genmod->getAll('pms_announcement', '*',array($getData[$i]->an_id),'','','');
			}
		}
		$data['$anon '] = $anon;
		$data['getData'] = $getData;
		$json['html'] = $this->load->view('announcement/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

 	public function getAddForm() {
		// Create by: Create by: Natakorn Phongsarikit 01-02-2566 get form for add task
		$json['title'] = "ข้อความประกาศจากระบบ";
		$json['body'] = $this->load->view('announcement/formadd', '', true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">'.lang('bt_save') .'</button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'ข้อความจากระบบ\')">'.lang('bt_cancel') .'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function add() {
		// Create by: Create by: Natakorn Phongsarikit 01-02-2566 addannouncement  to database
		$this->genlib->ajaxOnly();
		$formData = $this->input->post();
		$dataRequires = array('an_id','an_text');
		foreach ($dataRequires as $value) {
			if(!isset($formData[$value])) {
				$json = ['status'=> 0, 'msg'=>lang('md_vm_ad-fail')];
				$this->output->set_content_type('application/json')->set_output(json_encode($json));
				return;
			}
		}
		if($formData['an_id'] == 'new') {
			$formData['an_text'] = strtolower($formData['an_text']);
			$formData['an_u_id'] = $_SESSION['u_id'];
			$this->genmod->add('pms_announcement',$formData);
			$json = ['status'=> 1, 'msg'=>lang('md_vm_ct-save')];
		} else {
			$an_id = $formData['an_id'];
			unset($formData['an_id']);
			$this->genmod->update('pms_announcement', $formData, array('an_id'=>$an_id));
			$json = ['status'=> 1, 'msg'=>lang('md_vm_ct-edit')];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm() {
		// Create by: Create by: Natakorn Phongsarikit 01-02-2566 get form edit cancel
		$json['title'] = "แก้ไขประกาศ";
		$data['getData'] = $this->genmod->getOne('pms_announcement', '*', array('an_id'=>$this->input->post('an_id')));
		$json['body'] = $this->load->view('announcement/formadd',$data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit('.$this->input->post('an_id').');">'. lang('bt_save') .'</button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'แก้ไขข้อความจากระบบ\')">'. lang('bt_cancel') .'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

  	public function updateStatus() {
		// Create by: Create by: Natakorn Phongsarikit 01-02-2566 update status of cancellist
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
			if($this->genmod->update('pms_announcement', array('an_status'=> $updateData['an_status']), array('an_id'=>$updateData['an_id']))){
				if($updateData['an_status'] == 1) {
					$msg = "ประกาศข้อความ";
				} else if ($updateData['an_status'] == 2){
					$msg = "ช่อนการประการ";
				}else{
                    $msg = "ลบสำเร็จ";
                }
				$json = ['status'=> 1, 'msg'=>$msg];
			
		}else{
			$json = ['status'=> 0, 'msg'=>lang('md_vm-fail')];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function checkRepeat() {
		// Create by: Create by: Natakorn Phongsarikit 01-02-2566 find repeat cancellist name
		$this->genlib->ajaxOnly();
		$checkData = $this->genmod->getOne('pms_announcement', '*', array('an_text'=>$this->input->post('an_text'), 'an_status'=>1));
		if(isset($checkData->an_text)) {
			$json = ['status'=> 0, 'msg'=>"มีประกาศนี้มีอยู่แล้ว"];
		} else {
			$json = ['status'=> 1, 'msg'=>""];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	
}
