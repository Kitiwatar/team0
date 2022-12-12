<?php
// Create by : Patiphan Pansanga, Kitiwat Arunwong 07-09-2565 Project Summary
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

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
		if (isset($_SESSION['u_id'])) {
			$data = $this->genmod->getOne('pms_user', '*', array('u_id' => $_SESSION['u_id']));
			$this->genlib->updateSession($data);
		}
	}

	public function index() {
		// Create by: Patiphan Pansanga, Kitiwat Arunwong 09-09-2565 show dashboard
		$values['pageTitle'] = lang('Home');
		$values['breadcrumb'] = lang('dashboard');
		$values['pageContent'] = $this->load->view('home/index', '', TRUE);
		$this->load->view('main', $values);
	}

	public function changeLang() {
		$formData = $this->input->post();
		if($formData['lang'] == "th") {
			$_SESSION['lang'] = "th";
		} else {
			$_SESSION['lang'] = "en";
		}
		$json = ['status'=>1];
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getProjectSummary() {
		// Create by: Kitiwat Arunwong 19-09-2565 return summary of project
		$data = array();
		for ($i = 0; $i < 5; $i++) {
			if ($i == 0) {
				$data[$i] = 0;
				for($j=1; $j<=4; $j++) {
					$data[$i] += $this->genmod->countAll('pms_project', array('p_status' => $j), '');
				}
			} else {
				$data[$i] = $this->genmod->countAll('pms_project', array('p_status' => $i), '');
			}
			if ($data[$i] == 0) {
				$data[$i] = 0;
			}
		}
		$json = ['projectSum' => $data[0], 'projectPending' => $data[1], 'projectProgress' => $data[2], 'projectSuccess' => $data[3], 'projectFail' => $data[4]];
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getRank() {
		// Create by: Patiphan Pansanga, Kitiwat Arunwong 29-09-2565 get top five employee has most working
		$allUser = $this->genmod->getAll('pms_user', '*', '', 'u_createdate desc', '', '');
		$dataUser = array();
		$dataName = array();
		if (is_array($allUser)) {
			$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
			foreach ($allUser as $key => $value) {
				$dataUser[$key] = 0;
				for($i=1; $i<=2; $i++) {
					$permissionNow = $this->genmod->getAll('pms_permission', '*', array('per_u_id'=>$value->u_id, 'p_status'=>$i), '', $arrayJoin, '');
					if(is_array($permissionNow)) {
						$dataUser[$key] += count($permissionNow);
					} 
				}
				$dataName[$key] = $value->u_firstname . " " . $value->u_lastname;
			}
		}
		for ($i = 0; $i <  count($dataUser) - 1; $i++) {
			// Last i elements are already
			// in place
			for ($j = 0; $j <  count($dataUser) - $i - 1; $j++) {
				if ($dataUser[$j] < $dataUser[$j + 1]) {
					// swap($dataUser[$j], $dataUser[$j + 1]);
					$temp = $dataUser[$j];
					$dataUser[$j] = $dataUser[$j + 1];
					$dataUser[$j + 1] = $temp;

					$tempName = $dataName[$j];
					$dataName[$j] = $dataName[$j + 1];
					$dataName[$j + 1] = $tempName;
				}
			}
		}
		$data['listProject'] = $dataUser;
		$data['listName'] = $dataName;
		$json['html'] = $this->load->view('home/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getStatus() {
		// Create by: Patiphan Pansanga , Kitiwat Arunwong 29-09-2565 return all status of project
		$arrayStatus = array(1=>lang('sp_home_pendproject'), 2=>lang('sp_home_inprogress'), 3=>lang('sp_home_finish'), 4=>lang('sp_home_cancel'));
		return $arrayStatus;
	}

	public function viewProjects($status) {
		// Create by: Patiphan Pansanga, Kitiwat Arunwong 29-09-2565 view project by status name
		$p_status = null;
		if($status == "pending") {
			
			$data['pageTitle'] =  lang('pbt_pj-pending');
			$data['breadcrumb'] = lang('pbt_pj-pending');
			$p_status = 1;
		} else if($status == "progress") {
			$data['pageTitle'] =  lang('pbt_pj-inprogress');
			$data['breadcrumb'] = lang('pbt_pj-inprogress');
			$p_status = 2;
		} else if($status == "success") {
			$data['pageTitle'] =  lang('pbt_pj-finish');
			$data['breadcrumb'] = lang('pbt_pj-finish');
			$p_status = 3;
		} else if($status == "fail") {
			$data['pageTitle'] =  lang('pbt_pj-cancel');
			$data['breadcrumb'] = lang('pbt_pj-cancel');
			$p_status = 4;
		} else if($status == "all") {
			$data['pageTitle'] =  lang('pbt_pj-all');
			$data['breadcrumb'] = lang('pbt_pj-all');
			$p_status = 0;
		} else {
			redirect(base_url());
		}
		
		$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		if($p_status > 0) {
			$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('p_status'=>$p_status, 'per_role'=>1), 'p_createdate desc', $arrayJoin, '');
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
		$values['pageContent'] = $this->load->view('home/listproject', '', TRUE);
		$this->load->view('main', $values);
	}
}
