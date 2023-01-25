<?php
// Create by: Patiphan Pansanga 15-09-2565 permission management
defined('BASEPATH') OR exit('No direct script access allowed');
class Cancel extends CI_Controller{
    public function __construct() {
		// Create by: Patiphan Pansanga 14-09-2565
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

	public function add() {
		// Create by: Patiphan Pansanga 14-10-2565 add task in database
		$this->genlib->ajaxOnly();
		$formData = $this->input->post('formData');
		$dataRequires = array('c_id','c_detail','c_createdate','c_cl_id','c_u_id');
		foreach ($dataRequires as $value) {
			if(!isset($formData[$value])) {
				$json = ['status'=> 0, 'msg'=>"Error"];
				$this->output->set_content_type('application/json')->set_output(json_encode($json));
				return;
			}
		}
		if($formData['c_id'] == 'new') {
			$formData['c_u_id'] = $_SESSION['u_id'];
			$this->genmod->add('pms_cancel',$formData);
			$this->genmod->update('pms_project', array('p_status'=> 4), array('p_id' => $formData['t_p_id']));
			$json = ['status'=> 1, 'msg'=> lang('md_vm_ct-save')];		
		} 
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}


	public function remove() {
		// Create by: Patiphan Pansanga 14-09-2565 update per_status to 0
		$this->genlib->ajaxOnly();
		$p_id = $this->input->post('p_id');
		$u_id = $this->input->post('u_id');
		$validCheck = $this->genmod->getOne('pms_permission', '*', array('per_p_id'=>$p_id, 'per_u_id'=>$u_id));
		if(isset($validCheck->per_u_id)) {
			$this->genmod->update('pms_permission', array('per_status' => 0), array('per_id'=> $validCheck->per_id));
			$json = ['status'=> 1, 'msg'=>lang('md_dep_s-msg')];
		} else {
			$json = ['status'=> 0, 'msg'=>lang('md_dep_f-msg')];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getAddForm() {
		// Create by: Patiphan Pansanga 14-09-2565 get add form
		$data['p_id'] = $this->input->post('p_id');
        $data['users'] = $this->genmod->getAll('pms_user', '*', array('u_role' => 2));
		$data['users'] += $this->genmod->getAll('pms_user', '*', array('u_role' => 3));
        $data['permissions'] = $this->genmod->getAll('pms_permission', '*', array('per_p_id' =>  $this->input->post('p_id'), 'per_status' => 1));
		$json['title'] = lang('md_tl_a-em');
		$json['body'] = $this->load->view('permissions/formadd', $data, TRUE);
		$json['footer'] = '<button type="button" class="btn btn-secondary" style="background-color: grey; color:white;" data-dismiss="modal" aria-hidden="true">'.lang('md_ap_close').'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

}
?>
