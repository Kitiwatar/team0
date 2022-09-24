<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Projects extends CI_Controller{
    public function __construct() {
	//   Create by: Jiradat Pomyai   15-09-2022
		parent::__construct();
		$this->genlib->checkLogin();
		$data = $this->genmod->getOne('pms_user', '*', array('u_id'=>$_SESSION['u_id']));
		$this->genlib->updateSession($data);
	}
    public function index()	{
		/*
			Author: Patiphan Pansanga , Jiradat Pomyai
			Create: 2022-09-19
		*/
		$values['pageTitle'] = 'รายชื่อโครงการที่รับผิดชอบ';
		$values['breadcrumb'] = 'รายชื่อโครงการที่รับผิดชอบ';
		$values['pageContent'] = $this->load->view('projects/index', $values, TRUE);
		$this->load->view('main', $values);
	}
    public function getStatus() {
		/*
			Author: Patiphan Pansanga , Jiradat Pomyai
			Create: 2022-09-19
		*/
			$arraystatus = array(1=>"รอดำเนินการ", 2=>"กำลังดำเนินการ", 3=>"เสร็จสิ้น", 4=>"ยกเลิก");
			return $arraystatus;
		
		
    }
	public function get() {
		/*
			Author: Patiphan Pansanga , Jiradat Pomyai
			Create: 2022-09-19
		*/
		$data['pageTitle'] =  'โครงการที่เกี่ยวข้อง';
		$data['breadcrumb'] = 'โครงการที่เกี่ยวข้อง';
		$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		if($_SESSION['u_role'] > 1) {
			$data['getData'] = $this->genmod->getAll('pms_permission', '*', array('per_u_id'=>$_SESSION['u_id']), '', $arrayJoin, '');
		} else {
			$data['getData'] = $this->genmod->getAll('pms_permission', '*', '', '', $arrayJoin, '');
		}

		$data['arrayStatus'] = $this->getStatus();
		$lastTask = array();
		$leader = array();
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		if(is_array($data['getData'])){
			foreach ($data['getData'] as $key => $value){
				$leader[$key] = $this->genmod->getOne('pms_permission', '*',array('per_p_id'=>$value->per_p_id, 'per_level'=>1),'',$arrayJoin,'');
				$lastTask[$key] = $this->genmod->getLastTask($value->per_p_id);
			}
		}
	
		$data['lastTask'] = $lastTask;
		$data['leader'] = $leader;
		$json['html'] = $this->load->view('projects/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
}
?>
