<?php
// Create by: Jiradat Pomyai 15-09-2565 Projects management
defined('BASEPATH') OR exit('No direct script access allowed');
class Projects extends CI_Controller{
    public function __construct() {
		// Create by: Jiradat Pomyai 15-09-2565
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

    public function index() {
		// Create by: Jiradat Pomyai 19-09-2565 index page
		$values['pageTitle'] = lang('th_project_pj-responsible');
		$values['breadcrumb'] = lang('th_project_pj-responsible');
		$values['pageContent'] = $this->load->view('projects/index', $values, TRUE);
		$this->load->view('main', $values);
	}

	public function all() {
		// Create by: Patiphan Pansanga 28-12-2565 show all project for admin
		$values['all'] = 1;
		$values['pageTitle'] = lang('all_project');
		$values['breadcrumb'] = lang('all_project');
		$values['pageContent'] = $this->load->view('projects/index', $values, TRUE);
		$this->load->view('main', $values);
	}

	public function getAllProject() {
		// Create by: Patiphan Pansanga 28-12-2565 get all project for admin
		$data['tableName'] = lang('all_project');
		$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('per_role'=>1), 'p_createdate desc', $arrayJoin, '');
		$data['arrayStatus'] = $this->genlib->getProjectStatus();
		$lastTask = array();
		$leader = array();
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		if(is_array($data['getData'])){
			foreach ($data['getData'] as $key => $value){
				$leader[$key] = $this->genmod->getOne('pms_permission', '*',array('per_p_id'=>$value->per_p_id, 'per_role'=>1),'',$arrayJoin,'');
				$lastTask[$key] = $this->genmod->getLastTask($value->per_p_id);
			}
		}
		$data['lastTask'] = $lastTask;
		$data['leader'] = $leader;
		$json['html'] = $this->load->view('projects/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function get() {
		// Create by: Jiradat Pomyai 19-09-2565 get project
		$data['tableName'] = lang('th_project_pj-responsible');
		$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('per_u_id'=>$_SESSION['u_id']), 'p_createdate desc', $arrayJoin, '');
		$data['arrayStatus'] = $this->genlib->getProjectStatus();
		$lastTask = array();
		$leader = array();
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		if(is_array($data['getData'])){
			foreach ($data['getData'] as $key => $value){
				$leader[$key] = $this->genmod->getOne('pms_permission', '*',array('per_p_id'=>$value->per_p_id, 'per_role'=>1),'',$arrayJoin,'');
				$lastTask[$key] = $this->genmod->getLastTask($value->per_p_id);
			}
		}
		$data['lastTask'] = $lastTask;
		$data['leader'] = $leader;
		$json['html'] = $this->load->view('projects/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function add() {
		// Create by: Jiradat Pomyai 28-09-2565 add project in database
		$this->genlib->ajaxOnly();
		$formData = $this->input->post();
		$dataRequires = array('p_id', 'p_name', 'p_detail', 'p_customer', 'p_createdate');
		foreach ($dataRequires as $value) {
			if(!isset($formData[$value])) {
				$json = ['status'=> 0, 'msg'=>lang('md_vm_ad-fail')];
				$this->output->set_content_type('application/json')->set_output(json_encode($json));
				return;
			}
		}
		if($formData['p_id'] == 'new') { // โครงการถูกเพิ่มมาใหม่
			$this->genmod->add('pms_project',$formData);
			$project = $this->genmod->getLastProject();
			$arrayPermission['per_role'] = 1;
			$arrayPermission['per_p_id'] = $project->p_id;
			$arrayPermission['per_u_id'] = $_SESSION['u_id'];
			$this->genmod->add('pms_permission',$arrayPermission);
			$json = ['status'=> 1, 'msg'=>lang('md_vm_ct-save')];				
		} else { // แก้ไขโครงการ
			$p_id = $formData['p_id'];
			unset($formData['p_id']);
			$this->genmod->update('pms_project', $formData, array('p_id'=>$p_id));
			$json = ['status'=> 1, 'msg'=>lang('md_vm_ct-edit')];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function addProject() { 
		// Create by: Patiphan Pansanga 23-12-2565 add project page
		$values['pageTitle'] = lang('md_tl_a-ap');
		$values['breadcrumb'] = lang('md_tl_a-ap');
		$values['addForm'] = 1;
		$values['pageContent'] = $this->load->view('projects/index', $values, TRUE); // หน้าจอเพิ่มโครงการ
		$this->load->view('main', $values);
	}

	public function getAddForm() {
		// Create by: Jiradat Pomyai 28-09-2565 get add form
		$json['title'] = lang('md_tl_a-ap').' <span class="text-danger" style="font-size:12px;">(* '.lang('md_tl_a-req').')</span>';
		$json['body'] = $this->load->view('projects/formadd', '', TRUE);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormProjectSubmit(\'new\');">'.lang("bt_save").' </button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'เพิ่มโครงการ\')">'.lang("bt_cancel").'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm() {
		// Create by: Patiphan Pansanga 11-10-2565 get edit form 
		$json['title'] = lang('md_tl_e-pj').' <span class="text-danger" style="font-size:12px;">(* '.lang('md_tl_a-req').')</span>';
		$arrayJoin = array('pms_permission' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		$data['getData'] = $this->genmod->getOne('pms_project', '*', array('p_id'=>$this->input->post('p_id'),'per_role'=>1),'',$arrayJoin,'');
		$json['body'] = $this->load->view('projects/formadd', $data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormProjectSubmit('.$this->input->post('p_id').');">'.lang("bt_save").'</button>
		<button type="button" class="btn btn-danger" id="closeBtn" onclick="closeModal(\'แก้ไขโครงการ\')">'.lang("bt_cancel").'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getDetailForm() {
		// Create by: Jiradat Pomyai 01-10-2565 get form detail projects
		if($this->input->post('p_id') != null) {
			$arrayJoin = array('pms_permission' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
			$data['getData'] = $this->genmod->getOne('pms_project', '*', array('p_id'=>$this->input->post('p_id'), 'per_role'=>1), '', $arrayJoin, '');
		} else {
			return;
		}
		$data['detail'] = "yes";
		$json['title'] = lang('md_tl_v-pj');
		$json['body'] = $this->load->view('projects/formadd', $data ,true);
		if($_SESSION['u_role'] < 2 || $_SESSION['u_id'] == $data['getData']->per_u_id && ($data['getData']->p_status == 1 || $data['getData']->p_status == 2)) {
			$json['footer'] = '<button type="button" class="btn btn-warning" onclick="editProject(' . $this->input->post('p_id') . ')" title="'. lang('tt_pj_eproject').'">'.lang("bt_edit").'</button>';
		} else {
			$json['footer'] = '';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function endProject() {
		// Create by: Patiphan Pansanga 15-10-2565 end a project
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		$validCheck = $this->genmod->getOne('pms_project', '*', array('p_id' => $updateData['p_id']));
		if(isset($validCheck)) {
			date_default_timezone_set("Asia/Bangkok");
            $now = date("Y-m-d H:i:s");
			$this->genmod->update('pms_project', array('p_status' => ($updateData['p_status']), 'p_enddate' => $now), array('p_id' => $updateData['p_id']));
			if($updateData['p_status'] == 3) {
				$msg = lang('md_fp_suc');
			} else {
				$msg = lang('md_cp_suc');
			}				 
			$json = ['status'=> 1, 'msg'=>$msg];	
		} else {
			$json = ['status'=> 0, 'msg'=>lang('md_vm-fail')];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function restoreProject() {
		// Create by: Patiphan Pansanga 15-10-2565 restore a project
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		$validCheck = $this->genmod->getOne('pms_project', '*', array('p_id' => $updateData['p_id']));
		if(isset($validCheck)) {
			$this->genmod->update('pms_project', array('p_status'=> 2, 'p_enddate' => NULL), array('p_id' => $updateData['p_id']));
			$msg = lang('md_rp_vm-msg');
			$json = ['status'=> 1, 'msg'=>$msg];	
		} else {
			$json = ['status'=> 0, 'msg'=>lang('md_vm-fail')];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function updateStatus() {
		// Create by: Jiradat Pomyai, Patiphan Pansanga 01-10-2565 update status project in database
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		$validCheck = $this->genmod->getOne('pms_project', '*', array('p_id' => $updateData['p_id']));
		if(isset($validCheck)) {
			if($validCheck->p_countdown!=NULL){
				date_default_timezone_set("Asia/Bangkok");
                $now = date("Y-m-d H:i:s");
				if($now > $validCheck->p_countdown){
					$json = ['status'=> 0, 'msg'=>lang('md_rp_vm-f')];
					$this->output->set_content_type('application/json')->set_output(json_encode($json));
					return ;
				}
			}
			$this->genmod->update('pms_project', array('p_status'=> ($updateData['p_status'])), array('p_id' => $updateData['p_id']));
			if($updateData['p_status'] < 1) {
				date_default_timezone_set("Asia/Bangkok");
				$tomorrow = date("Y-m-d H:i:s", strtotime('+23 hours +59 mins +59 seconds'));
				$this->genmod->update('pms_project', array('p_countdown'=> $tomorrow), array('p_id' => $updateData['p_id']));
				$msg = lang('md_dp_vm-msg');
				
			} else {
				$this->genmod->update('pms_project', array('p_countdown'=> NULL), array('p_id' => $updateData['p_id']));
				$msg = lang('md_rp_vm-msg');
			}				 
			$json = ['status'=> 1, 'msg'=>$msg];	
		} else {
			$json = ['status'=> 0, 'msg'=>lang('md_vm-fail')];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

}
?>
