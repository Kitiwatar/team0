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
		// Create by: Kitiwat Arunwong 09-09-2565 show dashboard
		$values['pageTitle'] = lang('Home');
		$values['breadcrumb'] = lang('dashboard');
		$values['pageContent'] = $this->load->view('home/index', '', TRUE);
		$this->load->view('main', $values);
	}

	public function changeLang() {
		// Create by: Patiphan Pansanga 24-11-2565 change language
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
		date_default_timezone_set("Asia/Bangkok"); 
		$data[0] = 0;
		for($i=1; $i<=4; $i++) {
			if($i <= 2) {
				$data[$i] = $this->genmod->countAll('pms_project', array('p_status' => $i), '');
			} else {
				$data[$i] = $this->genmod->countAll('pms_project', array('p_status' => $i,'YEAR(p_enddate)'=>date("Y")), '');
			}
			$data[0] += $data[$i];
		}
		
		if(isset($_SESSION['u_id'])){
			$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id');
			$data[5] = $this->genmod->countAll('pms_permission',array('pms_project.p_status ' =>1 ,'per_u_id' => $_SESSION['u_id']),$arrayJoin);
			$data[5] += $this->genmod->countAll('pms_permission',array('pms_project.p_status '=>2 ,'per_u_id' => $_SESSION['u_id']),$arrayJoin);
			$data[5] += $this->genmod->countAll('pms_permission',array('pms_project.p_status '=>3 ,'per_u_id' => $_SESSION['u_id'], 'YEAR(p_enddate)'=>date("Y")),$arrayJoin);
			$data[5] += $this->genmod->countAll('pms_permission',array('pms_project.p_status '=>4 ,'per_u_id' => $_SESSION['u_id'], 'YEAR(p_enddate)'=>date("Y")),$arrayJoin);
			$data[6] = $this->genmod->countAll('pms_permission',array('pms_project.p_status '=>1 ,'per_u_id' => $_SESSION['u_id']),$arrayJoin);
			$data[7] = $this->genmod->countAll('pms_permission',array('pms_project.p_status '=>2 ,'per_u_id' => $_SESSION['u_id']),$arrayJoin);
			$data[8] = $this->genmod->countAll('pms_permission',array('pms_project.p_status '=>3 ,'per_u_id' => $_SESSION['u_id'], 'YEAR(p_enddate)'=>date("Y")),$arrayJoin);
			$data[9] = $this->genmod->countAll('pms_permission',array('pms_project.p_status '=>4 ,'per_u_id' => $_SESSION['u_id'], 'YEAR(p_enddate)'=>date("Y")),$arrayJoin);
			$data[10] = 1;
		}else{
			$data[5]=0;
			$data[6]=0;
			$data[7]=0;
			$data[8]=0;
			$data[9]=0;
			$data[10]= 0;
		}
		$json = ['projectSum' => $data[0],'projectPending' => $data[1], 'projectProgress' => $data[2], 'projectSuccess' => $data[3], 'projectFail' => $data[4],'projectRespon'=>$data[5],'resprojectPending' => $data[6],'resprojectProgress' => $data[7],'resprojectSuccess' => $data[8],'resprojectFail' => $data[9],'session' => $data[10]];
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	
	public function getCause(){
		// Create by: Jiradat Pomyai 03-01-2566
		$json['html'] = $this->load->view('home/list-cause','', TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	public function getToDoList(){
		// Create by: Jiradat Pomyai 03-01-2566 to do list
		date_default_timezone_set("Asia/Bangkok"); 
		$arrayJoin = array('pms_tasklist' => 'pms_task.t_tl_id=pms_tasklist.tl_id','pms_project' => 'pms_project.p_id=pms_task.t_p_id');
		$data['listtodo'] = $this->genmod->getAll('pms_task', '*', array('t_u_id'=>$_SESSION['u_id'],'t_createdate'=>date("Y-m-d")), '', $arrayJoin, '');
		$json['html'] = $this->load->view('home/todolist',$data, TRUE);
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
		$json['html'] = $this->load->view('home/listuser', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	public function getCancelRank() {
		// Create by: Patiphan Pansanga, Kitiwat Arunwong 29-09-2565 get top five employee has most working
		$allCancel = $this->genmod->getAll('pms_cancel', '*', '', 'c_createdate desc', '', '');
		$dataName = array();
		$dataCancel= array();
		if (is_array($allCancel)) {
			 $arrayJoin = array('pms_cancel' => 'pms_cancellist.cl_id=pms_cancel.c_id','pms_cancellist'=>'pms_cancel.c_id=pms_cancellist.cl_id');
			foreach ($allCancel as $key => $value) {
				$dataCancel[$key] = 0;
				for($i=1; $i<=2; $i++) {
					$cancellist = $this->genmod->getAll('pms_cancellist', '*', array('cl_id'=>$value->cl_id, 'cl_status'=>$i), '', $arrayJoin, '');
					if(is_array($cancellist)) {
						$dataCancel[$key] += count($cancellist);
					} 
				}
	             			
				$dataName[$key] = $value->c_detail;
			}
		}
		for ($i = 0; $i <  count($dataCancel) - 1; $i++) {
			// Last i elements are already
			// in place
			for ($j = 0; $j <  count($dataCancel) - $i - 1; $j++) {
				if ($dataCancel[$j] < $dataCancelr[$j + 1]) {
					// swap($dataUser[$j], $dataUser[$j + 1]);
					$temp = $dataCancelr[$j];
					$dataUser[$j] = $dataCancel[$j + 1];
					$dataUser[$j + 1] = $temp;

					$tempName = $dataName[$j];
					$dataName[$j] = $dataName[$j + 1];
					$dataName[$j + 1] = $tempName;
				}
			}
		}
		$data['listcancel'] = $allCancel;
		$data['listName'] = $dataName;
		$json['html'] = $this->load->view('home/listcancel', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	public function getProjects() {
		// Create by: Patiphan Pansanga, Kitiwat Arunwong 29-09-2565 view project by status name
		$p_status = $this->input->post('p_status');
		$u_id = $this->input->post('u_id');
		$arrayStatus = array(lang('pbt_pj-all'), lang('pbt_pj-pending'), lang('pbt_pj-inprogress'), lang('pbt_pj-finish'), lang('pbt_pj-cancel'));
		$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		date_default_timezone_set("Asia/Bangkok"); 
		if($u_id == 0) {
			if($p_status > 0) {
				if ($p_status > 2) {
					$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('p_status'=>$p_status, 'per_role'=>1, 'YEAR(p_enddate)'=>date("Y")), 'p_createdate desc', $arrayJoin, '');
				} else {
					$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('p_status'=>$p_status, 'per_role'=>1), 'p_createdate desc', $arrayJoin, '');
				}
			} else {
				$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('per_role'=>1), 'p_createdate desc', $arrayJoin, '');
			}
		} else {
			if($p_status > 0) {
				if($p_status > 2) {
					$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('p_status'=>$p_status, 'per_u_id'=>$u_id, 'YEAR(p_enddate)'=>date("Y")), 'p_createdate desc', $arrayJoin, '');
				} else {
					$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('p_status'=>$p_status, 'per_u_id'=>$u_id), 'p_createdate desc', $arrayJoin, '');
				}
			} else {
				$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('per_u_id'=>$u_id), 'p_createdate desc', $arrayJoin, '');
			}
		}
		

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

		$json['title'] = "<h3>".$arrayStatus[$p_status]."</h3>";
		$json['body'] = $this->load->view('home/listproject', $data ,true);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
}
