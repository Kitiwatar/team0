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
		/*
			Author: Kitiwat Arunwong
			Create: 2022-09-19
		*/
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
		/*
			Author: Kitiwat Arunwong
			Create: 2022-09-07
		*/
		$data = $this->genmod->getAll('pms_user', '*','','u_createdate desc','','');
		$dataUser = array();
		if(is_array($data)){
			foreach ($data as $key => $value){
				$dataUser[$key] = $this->genmod->countAll('pms_project', array('p_u_id' => $value->u_id), '');
				$dataUser[$key] += $this->genmod->countAll('pms_permission', array('per_u_id' => $value->u_id), '');
				// echo $value->u_firstname.$dataUser.'<br>';
			}
		}
		arsort($dataUser);
	}
}
