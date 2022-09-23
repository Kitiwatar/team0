<?php
/*
	Author: Patiphan Pansanga, Kitiwat Arunwong
	Create: 2022-09-07
*/
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (isset($_SESSION['u_id'])) {
			$data = $this->genmod->getOne('pms_user', '*', array('u_id' => $_SESSION['u_id']));
			$this->genlib->updateSession($data);
		}
	}

	public function index()
	{
		$values['pageTitle'] = 'หน้าหลัก';
		$values['breadcrumb'] = 'ภาพรวมระบบ';
		$values['pageContent'] = $this->load->view('home/index', '', TRUE);
		$this->load->view('main', $values);
	}

	public function all()
	{
		$values['pageTitle'] = 'หน้าหลัก';
		$values['breadcrumb'] = 'โครงการทั้งหมด';
		$values['pageContent'] = $this->load->view('home/list', '', TRUE);
		$this->load->view('main', $values);
	}

	public function getProjectSummary()
	{
		//Create: Kitiwat Arunwong 19/09/2565
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

	public function getRank()
	{
		//Create by : Patiphan Pansanga , Kitiwat Arunwong 29/09/2565
		$allUser = $this->genmod->getAll('pms_user', '*', '', 'u_createdate desc', '', '');
		$dataUser = array();
		$dataName = array();
		if (is_array($allUser)) {
			foreach ($allUser as $key => $value) {
				$dataUser[$key] = $this->genmod->countAll('pms_project', array('p_u_id' => $value->u_id), '');
				$dataUser[$key] += $this->genmod->countAll('pms_permission', array('per_u_id' => $value->u_id), '');
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

	public function getStatus()
	{
		//Create by : Patiphan Pansanga , Kitiwat Arunwong 29/09/2565
		$arraystatus = array(1 => "รอดำเนินการ", 2 => "กำลังดำเนินการ", 3 => "เสร็จสิ้น", 4 => "ยกเลิก");
		return $arraystatus;
	}
	public function getAllProject()
	{
		//Create by : Patiphan Pansanga , Kitiwat Arunwong 29/09/2565
		$data['pageTitle'] =  'โครงการที่เกี่ยวข้อง';
		$data['breadcrumb'] = 'โครงการที่เกี่ยวข้อง';
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_project.p_u_id');
		$data['getData'] = $this->genmod->getAll('pms_project', '*', '', '', $arrayJoin, '');
		$data['arrayStatus'] = $this->getStatus();
		$lastTask = array();
		if (is_array($data['getData'])) {
			foreach ($data['getData'] as $key => $value) {
				$lastTask[$key] = $this->genmod->getLastTask($value->p_id);
			}
		}

		$data['lasttask'] = $lastTask;
		$values['pageContent'] = $this->load->view('home/listproject', $data, TRUE);
		$this->load->view('main', $values);
	}
}
