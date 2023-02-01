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
		$dataRequires = array('c_detail','c_cl_id','c_p_id');
		foreach ($dataRequires as $value) {
			if(!isset($formData[$value])) {
				$json = ['status'=> 0, 'msg'=>"Error"];
				$this->output->set_content_type('application/json')->set_output(json_encode($json));
				return;
			}
		}
		$formData['c_u_id'] = $_SESSION['u_id'];
		$this->genmod->add('pms_cancel',$formData);

		date_default_timezone_set("Asia/Bangkok");
        $now = date("Y-m-d H:i:s");
		$this->genmod->update('pms_project', array('p_status' => 4, 'p_enddate' => $now), array('p_id' => $formData['c_p_id']));
		$json = ['status'=> 1, 'msg'=> lang('md_vm_ct-save')];		
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getAddForm() {
		// Create by: Patiphan Pansanga 14-09-2565 get add form
		$p_id = $this->input->post('p_id');
        $data['getData'] = $this->genmod->getAll('pms_cancellist', '*', array('cl_status' => 1));
		$json['title'] = "ยุติโครงการ";
		$json['body'] = $this->load->view('cancel/formadd', $data, TRUE);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormCancel('.$p_id.');">'.lang('bt_save') .'</button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'ยุติโครงการ\')">'.lang('bt_cancel') .'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

}
?>
