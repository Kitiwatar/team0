<?php
// Create by : Patiphan Pansanga, Kitiwat Arunwong 07-09-2565 Project Summary
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct() {
		// Create by: Patiphan Pansanga 07-09-2565 construct
		parent::__construct();
		if (isset($_SESSION['u_id'])) {
			$data = $this->genmod->getOne('pms_user', '*', array('u_id' => $_SESSION['u_id']));
			$this->genlib->updateSession($data);
		}
	}

	public function index() {
		// Create by: Patiphan Pansanga, Kitiwat Arunwong 09-09-2565 show dashboard
		$values['pageTitle'] = 'หน้าหลัก';
		$values['breadcrumb'] = 'ภาพรวมระบบ';
		$values['pageContent'] = $this->load->view('home/index', '', TRUE);
		$this->load->view('main', $values);
	}

	public function getProjectSummary() {
		// Create by: Kitiwat Arunwong 19-09-2565 return summary of project
		$data = array();
		for ($i = 0; $i < 5; $i++) {
			if ($i == 0) {
				$data[$i] = $this->genmod->countAll('pms_project', '', '');
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
			foreach ($allUser as $key => $value) {
				$dataUser[$key] = $this->genmod->countAll('pms_permission', array('per_u_id' => $value->u_id), '');
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
		$arrayStatus = array(1 => "รอดำเนินการ", 2 => "กำลังดำเนินการ", 3 => "เสร็จสิ้น", 4 => "ยกเลิก");
		return $arrayStatus;
	}

	public function viewProjects($status) {
		// Create by: Patiphan Pansanga, Kitiwat Arunwong 29-09-2565 view project by status name
		$p_status = null;
		if($status == "pending") {
			$data['pageTitle'] =  'โครงการที่รอดำเนินการ';
			$data['breadcrumb'] = 'โครงการที่รอดำเนินการ';
			$p_status = 1;
		} else if($status == "progress") {
			$data['pageTitle'] =  'โครงการที่กำลังดำเนินการ';
			$data['breadcrumb'] = 'โครงการที่กำลังดำเนินการ';
			$p_status = 2;
		} else if($status == "success") {
			$data['pageTitle'] =  'โครงการที่เสร็จสิ้น';
			$data['breadcrumb'] = 'โครงการที่เสร็จสิ้น';
			$p_status = 3;
		} else if($status == "fail") {
			$data['pageTitle'] =  'โครงการที่ยกเลิก';
			$data['breadcrumb'] = 'โครงการที่ยกเลิก';
			$p_status = 4;
		} else if($status == "all") {
			$data['pageTitle'] =  'โครงการทั้งหมด';
			$data['breadcrumb'] = 'โครงการทั้งหมด';
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
