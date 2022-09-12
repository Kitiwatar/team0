<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

  	public function __construct(){
		parent::__construct();
		$this->genlib->checkLogin();
		$data = $this->genmod->getOne('pms_user', '*', array('u_id'=>$_SESSION['u_id']));
		$this->genlib->updateSession($data);
		if($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
	}

	public function index() {
		$values['pageTitle'] = 'หน้าหลัก';
		$values['breadcrumb'] = 'ฐานข้อมูล';
		$values['pageContent'] = $this->load->view('logs/index', '', TRUE);
		$this->load->view('main', $values);
	}

	public function get(){
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_log.l_u_id');
		$data['getData'] = $this->genmod->getAll('pms_log', '*', '', 'l_createdate desc', $arrayJoin, '');
		$json['html'] = $this->load->view('logs/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getDetailForm(){
		$json['title'] = 'ข้อมูลประวัติ';
		$data['detail'] = "yes";
		$arrayJoin = array('pms_user' => 'pms_user.u_id=pms_log.l_u_id');
		$data['getData'] = $this->genmod->getOne('pms_log', '*', array('l_id'=>$this->input->post('l_id')), '', $arrayJoin);
		$json['body'] = $this->load->view('logs/form', $data ,true);
		$json['footer'] = '';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

}
