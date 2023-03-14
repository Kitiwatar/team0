<?php
// Create by : Patiphan Pansanga, Kitiwat Arunwong 07-09-2565 Project Summary

use SebastianBergmann\Environment\Console;

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		// Create by: Patiphan Pansanga 07-09-2565 construct
		parent::__construct();
		if (isset($_SESSION['lang'])) {
			if ($_SESSION['lang'] == "th") {
				$this->lang->load("pages", "thai");
			} else {
				$this->lang->load("pages", "english");
			}
		} else {
			$_SESSION['lang'] = "th";
			$this->lang->load("pages", "thai");
		}
		if (isset($_SESSION['u_id'])) {
			$data = $this->genmod->getOne('pms_user', '*', array('u_id' => $_SESSION['u_id']));
			$this->genlib->updateSession($data);
		}
	}

	public function index() {
		// Create by: Natakorn Phongsarikit 01-02-2566 index
		$arrayJoin = array('pms_user'=>'pms_announcement.an_u_id=pms_user.u_id');
		$temp = $this->genmod->getAll('pms_announcement', '*',array('an_status'=>1),'an_begindate desc',$arrayJoin,'');
		$count=0;
		// if(is_array($temp)) {
			// for($i=0; $i<count($temp); $i++) {
				// $temp = $this->genmod->getAll('pms_announcement', '*',array('an_status'=>1),'an_begindate desc',$arrayJoin,'');
		// 		if($temp[$i]->an_begindate<=date('Y-m-d')&&$temp[$i]->an_enddate>=date('Y-m-d')){
		// 			$data['getData'][$count++]=$temp[$i];
		// 		}

		// 	}
		// }
		if (!isset($_SESSION['u_role'])) {
			$values['pageContent'] = $this->load->view('home/dashboard_Aonnymous','', TRUE);
		} else {
			redirect(base_url("home/dashboard"));
		} 
		$values['pageTitle'] = lang('dashboard');
		$values['breadcrumb'] = lang('dashboard');
		$this->load->view('main', $values);
	}

	public function changeLang()
	{
		// Create by: Patiphan Pansanga 24-11-2565 change language
		$formData = $this->input->post();
		if ($formData['lang'] == "th") {
			$_SESSION['lang'] = "th";
		} else {
			$_SESSION['lang'] = "en";
		}
		$json = ['status' => 1];
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getProjectSummary()
	{
		// Create by: Kitiwat Arunwong 19-09-2565 return summary of project
		$data = array();
		date_default_timezone_set("Asia/Bangkok");
		$data[0] = 0;
		$data[1] = $this->genmod->countAll('pms_project', array('p_status' => 1), '');
		$data[2] = $this->genmod->countAll('pms_project', array('p_status' => 2), '');
		$data[3] = $this->genmod->countAll('pms_project', array('p_status' => 3, 'YEAR(p_enddate)' => date("Y")), '');
		$data[4] = $this->genmod->countAll('pms_project', array('p_status' => 4, 'YEAR(p_enddate)' => date("Y")), '');
		$data[0] += ($data[1] + $data[2] + $data[3] + $data[4]);

		if (isset($_SESSION['u_id'])) {
			$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id');
			$data[5] = $this->genmod->countAll('pms_permission', array('pms_project.p_status ' => 1, 'per_u_id' => $_SESSION['u_id']), $arrayJoin);
			$data[5] += $this->genmod->countAll('pms_permission', array('pms_project.p_status ' => 2, 'per_u_id' => $_SESSION['u_id']), $arrayJoin);
			$data[5] += $this->genmod->countAll('pms_permission', array('pms_project.p_status ' => 3, 'per_u_id' => $_SESSION['u_id'], 'YEAR(p_enddate)' => date("Y")), $arrayJoin);
			$data[5] += $this->genmod->countAll('pms_permission', array('pms_project.p_status ' => 4, 'per_u_id' => $_SESSION['u_id'], 'YEAR(p_enddate)' => date("Y")), $arrayJoin);
			$data[6] = $this->genmod->countAll('pms_permission', array('pms_project.p_status ' => 1, 'per_u_id' => $_SESSION['u_id']), $arrayJoin);
			$data[7] = $this->genmod->countAll('pms_permission', array('pms_project.p_status ' => 2, 'per_u_id' => $_SESSION['u_id']), $arrayJoin);
			$data[8] = $this->genmod->countAll('pms_permission', array('pms_project.p_status ' => 3, 'per_u_id' => $_SESSION['u_id'], 'YEAR(p_enddate)' => date("Y")), $arrayJoin);
			$data[9] = $this->genmod->countAll('pms_permission', array('pms_project.p_status ' => 4, 'per_u_id' => $_SESSION['u_id'], 'YEAR(p_enddate)' => date("Y")), $arrayJoin);
			$data[10] = 1;
		} else {
			$data[5] = 0;
			$data[6] = 0;
			$data[7] = 0;
			$data[8] = 0;
			$data[9] = 0;
			$data[10] = 0;
		}
		$json = ['projectSum' => $data[0], 'projectPending' => $data[1], 'projectProgress' => $data[2], 'projectSuccess' => $data[3], 'projectFail' => $data[4], 'projectRespon' => $data[5], 'resprojectPending' => $data[6], 'resprojectProgress' => $data[7], 'resprojectSuccess' => $data[8], 'resprojectFail' => $data[9], 'session' => $data[10]];
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getCause()
	{
		// Create by: Jiradat Pomyai 03-01-2566
		$json['html'] = $this->load->view('home/list-cause', '', TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	public function dashboard() {
		// Create by: Create by: Natakorn Phongsarikit 01-02-2566 dashboard 
		$arrayJoin = array('pms_user'=>'pms_announcement.an_u_id=pms_user.u_id');
		// $values['getData'] = $this->genmod->getAll('pms_announcement', '*',array('an_status'=>1),'an_begindate desc',$arrayJoin,'');
		$temp = $this->genmod->getAll('pms_announcement', '*',array('an_status'=>1),'an_begindate desc',$arrayJoin,'');
		$count=0;
		$data = array();
		if(is_array($temp)) {
			for($i=0; $i<count($temp); $i++) {
				// $temp = $this->genmod->getAll('pms_announcement', '*',array('an_status'=>1),'an_begindate desc',$arrayJoin,'');
				if($temp[$i]->an_begindate<=date('Y-m-d')&&$temp[$i]->an_enddate>=date('Y-m-d')){
					$data[$count++]=$temp[$i];
				}

			}
		}
		$values['getData'] = $data;
		$values['pageTitle'] = lang('pp_home');
		$values['breadcrumb'] = lang('pp_home');
		$values['pageContent'] = $this->load->view('home/dashboard', $values, TRUE);
		$this->load->view('main', $values);
	}
	public function dashboard_admin() {
		// Create by: Create by: Natakorn Phongsarikit 01-02-2566 dashboard for admin
		$values['pageTitle'] =lang('admin_home');
		$values['breadcrumb'] = lang('admin_home');
		$values['pageContent'] = $this->load->view('home/dashboard_admin', $values, TRUE);
		$this->load->view('main', $values);
	}

	public function getToDoList()
	{
		// Create by: Jiradat Pomyai 03-01-2566 to do list
		date_default_timezone_set("Asia/Bangkok");
		$arrayJoin = array('pms_tasklist' => 'pms_task.t_tl_id=pms_tasklist.tl_id', 'pms_project' => 'pms_project.p_id=pms_task.t_p_id');
		$data['listtodo'] = $this->genmod->getAll('pms_task', '*', array('t_u_id' => $_SESSION['u_id'], 'DATE(t_createdate)' => date("Y-m-d")), 't_createdate asc', $arrayJoin, '');
		$json['html'] = $this->load->view('home/todolist', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getRank()
	{
		// Create by: Patiphan Pansanga, Kitiwat Arunwong 29-09-2565 get top five employee has most working
		$allUser = $this->genmod->getAll('pms_user', '*', '', 'u_createdate desc', '', '');
		$dataUser = array();
		$dataName = array();
		if (is_array($allUser)) {
			$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id', 'pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
			foreach ($allUser as $key => $value) {
				$dataUser[$key] = 0;
				$permissionNow = $this->genmod->getAll('pms_permission', '*', array('per_u_id' => $value->u_id, 'p_status' => 1), '', $arrayJoin, '');
				if (is_array($permissionNow)) {
					$dataUser[$key] += count($permissionNow);
				}
				$permissionNow = $this->genmod->getAll('pms_permission', '*', array('per_u_id' => $value->u_id, 'p_status' => 2), '', $arrayJoin, '');
				if (is_array($permissionNow)) {
					$dataUser[$key] += count($permissionNow);
				}
				$dataName[$key] = $value->u_firstname . " " . $value->u_lastname;
			}
		}
		for ($i = 0; $i < count($dataUser) - 1; $i++) { // sort ข้อมูลจากมากไปน้อย
			for ($j = 0; $j < count($dataUser) - $i - 1; $j++) {
				if ($dataUser[$j] < $dataUser[$j + 1]) {
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
	public function getCancelRank()
	{
		// Create by: Natakorn Phongsarikit 01-02-2566 get top five cancel list
		$allCancel = $this->genmod->getAll('pms_cancellist', '*', array('cl_status' => 1), 'cl_createdate desc', '', '');
		$countCancel = array();
		$NameCancel = array();

		if (is_array($allCancel)) {
			foreach ($allCancel as $key => $value) {
				$countCancel[$key] = $this->genmod->countAll('pms_cancel',array('c_cl_id' =>$value->cl_id,'YEAR(c_createdate)'=>date("Y")));
				$NameCancel[$key] = $value->cl_name;
			}	
		}

		if(count($countCancel) > 1) {
			for ($i = 0; $i <  count($countCancel) - 1; $i++) { // sort ข้อมูลจากมากไปน้อย
				for ($j = 0; $j < count($countCancel) - $i - 1; $j++) {
					if ($countCancel[$j] < $countCancel[$j + 1]) {
						$temp = $countCancel[$j];
						$countCancel[$j] = $countCancel[$j + 1];
						$countCancel[$j + 1] = $temp;
						$tempName = $NameCancel[$j];
						$NameCancel[$j] = $NameCancel[$j + 1];
						$NameCancel[$j + 1] = $tempName;
					}
				}
			}
			$data['listcancel'] = $countCancel;
			$data['listCancelName'] = $NameCancel;
		} else {
			$data['listcancel'] = $countCancel;
			$data['listCancelName'] = $NameCancel;
		}
		
		$json['html'] = $this->load->view('home/listcancel', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}


	public function getProjects()
	{
		// Create by: Patiphan Pansanga, Kitiwat Arunwong 29-09-2565 view project by status name
		$p_status = $this->input->post('p_status');
		$u_id = $this->input->post('u_id');
		$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id', 'pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		date_default_timezone_set("Asia/Bangkok");
		if ($u_id == 0) {
			$arrayStatus = array(lang('pbt_pj-all'), lang('pbt_pj-pending'), lang('pbt_pj-inprogress'), lang('pbt_pj-finish'), lang('pbt_pj-cancel'));
			if ($p_status > 0) {
				if ($p_status > 2) {
					$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('p_status' => $p_status, 'per_role' => 1, 'YEAR(p_enddate)' => date("Y")), 'p_createdate desc', $arrayJoin, '');
				} else {
					$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('p_status' => $p_status, 'per_role' => 1), 'p_createdate desc', $arrayJoin, '');
				}
			} else {
				$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('per_role' => 1), 'p_createdate desc', $arrayJoin, '');
			}
		} else {
			$arrayStatus = array(lang('sp_home_responproject'), lang('pbt_pj-pending'), lang('pbt_pj-inprogress'), lang('pbt_pj-finish'), lang('pbt_pj-cancel'));
			if ($p_status > 0) {
				if ($p_status > 2) {
					$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('p_status' => $p_status, 'per_u_id' => $u_id, 'YEAR(p_enddate)' => date("Y")), 'p_createdate desc', $arrayJoin, '');
				} else {
					$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('p_status' => $p_status, 'per_u_id' => $u_id), 'p_createdate desc', $arrayJoin, '');
				}
			} else {
				$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('per_u_id' => $u_id), 'p_createdate desc', $arrayJoin, '');
			}
		}

		$data['arrayStatus'] = $this->genlib->getProjectStatus();
		$lastTask = array();
		$leader = array();
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		if (is_array($data['getData'])) {
			foreach ($data['getData'] as $key => $value) {
				$leader[$key] = $this->genmod->getOne('pms_permission', '*', array('per_p_id' => $value->per_p_id, 'per_role' => 1), '', $arrayJoin, '');
				$lastTask[$key] = $this->genmod->getLastTask($value->per_p_id);
			}
		}

		$data['lastTask'] = $lastTask;
		$data['leader'] = $leader;

		$json['title'] = "<h3>" . $arrayStatus[$p_status] . "</h3>";
		$json['body'] = $this->load->view('home/listproject', $data, true);
		$json['footer'] = '<button type="button" class="btn btn-secondary" style="background-color: grey; color:white;" data-dismiss="modal" aria-hidden="true">'.lang('md_ap_close').'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
	
}
