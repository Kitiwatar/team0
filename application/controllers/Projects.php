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

    public function index()	{
		// Create by: Jiradat Pomyai 19-09-2565 index page
		$values['pageTitle'] = lang('th_project_pj-responsible');
		$values['breadcrumb'] = lang('th_project_pj-responsible');
		$values['pageContent'] = $this->load->view('projects/index', $values, TRUE);
		$this->load->view('main', $values);
	}

    public function getStatus() {
		// Create by: Jiradat Pomyai 19-09-2565 return all status of project
		$arrayStatus = array(1=>lang('sp_home_pendproject'), 2=>lang('sp_home_inprogress'), 3=>lang('sp_home_finish'), 4=>lang('sp_home_cancel'));
		return $arrayStatus;
    }

	public function get() {
		// Create by: Jiradat Pomyai 19-09-2565
		$data['pageTitle'] =  'โครงการที่เกี่ยวข้อง';
		$data['breadcrumb'] = 'โครงการที่เกี่ยวข้อง';
		$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		if($_SESSION['u_role'] > 1) {
			$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('per_u_id'=>$_SESSION['u_id']), 'p_createdate desc', $arrayJoin, '');
		} else {
			$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('per_role'=>1), 'p_createdate desc', $arrayJoin, '');
		}

		$data['arrayStatus'] = $this->getStatus();
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
		$arrayErr = array(
			'required' => 'คุณต้องทำการระบุ  {field} ',
		  'numeric' => 'กรุณาระบุ {field} เป็นตัวเลขเท่านั้น',
		  'min_length' => 'กรุณาระบุ {field} เป็นตัวเลขอย่างน้อย {param} หลัก',
		  'max_length' => 'กรุณาระบุ {field} เป็นตัวเลขไม่เกิน {param} หลัก'
	  );
		$this->form_validation->set_rules('p_name', 'ชื่อโปรเจค', 'required', $arrayErr);
		$this->form_validation->set_rules('p_detail', 'รายละเอียด', 'required', $arrayErr);
		$this->form_validation->set_rules('p_customer', 'ชื่อลูกค้า', 'required', $arrayErr);
		$this->form_validation->set_rules('p_createdate', 'วันที่เพิ่มโครงการ', 'required', $arrayErr);
		if($this->form_validation->run() !== FALSE){	
			if($formData['p_id'] == 'new') {	
					$this->genmod->add('pms_project',$formData);
					$project = $this->genmod->getLastProject();
					$arrayPermission['per_role'] = 1;
					$arrayPermission['per_p_id'] = $project->p_id;
					$arrayPermission['per_u_id'] = $_SESSION['u_id'];
					$this->genmod->add('pms_permission',$arrayPermission);
					$json = ['status'=> 1, 'msg'=>lang('md_vm_ct-save')];				
			} else {		
					$p_id = $formData['p_id'];
					unset($formData['p_id']);
					$this->genmod->update('pms_project', $formData, array('p_id'=>$p_id));
					$json = ['status'=> 1, 'msg'=>lang('md_vm_ct-edit')];
			}
		}else{
			$json = ['status'=> 0, 'msg'=>lang('md_vm_ad-fail') ,'error'=>$this->form_validation->error_array()];
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getAddForm() {
		// Create by: Jiradat Pomyai 28-09-2565 get add form
		$json['title'] = lang('md_tl_a-ap').' <span class="text-danger" style="font-size:12px;">(*'.lang('md_tl-req').')</span>';
		$json['body'] = $this->load->view('projects/formadd', '', TRUE);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormProjectSubmit(\'new\');">'.lang("bt_save").' </button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'เพิ่มโครงการ\')">'.lang("bt_cancel").'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm() {
		// Create by: Patiphan Pansanga 11-10-2565 get edit form 
		$json['title'] = lang('md_tl_e-pj').' <span class="text-danger" style="font-size:12px;">(*'.lang('md_tl-req').')</span>';
		$data['getData'] = $this->genmod->getOne('pms_project', '*', array('p_id'=>$this->input->post('p_id')));
		$json['body'] = $this->load->view('projects/formadd', $data ,true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormProjectSubmit('.$this->input->post('p_id').');">'.lang("bt_save").'</button>
		<button type="button" class="btn btn-danger" id="closeBtn" onclick="closeModal(\'แก้ไขโครงการ\')">'.lang("bt_cancel").'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getDetailForm() {
		// Create by: Jiradat Pomyai 01-10-2565 get form detail projects
		if($this->input->post('p_id')!=null){
			$data['getData'] = $this->genmod->getOne('pms_project', '*', array('p_id'=>$this->input->post('p_id')));
		} else {
			return;
		}
		$data['detail'] = "yes";
		$json['title'] = lang('md_tl_v-pj');
		$json['body'] = $this->load->view('projects/formadd', $data ,true);
		if($_SESSION['u_role'] <= 2 && ($data['getData']->p_status == 1 || $data['getData']->p_status == 2)) {
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
				// $d = new DateTime('+1day');
				// $tomorrow = $d->format('Y/m/d H.i.s');
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
