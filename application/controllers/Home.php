<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  	public function __construct(){
		parent::__construct();
		if(isset($_SESSION['u_id'])) {
			$data = $this->genmod->getOne('pms_user', '*', array('u_id'=>$_SESSION['u_id']));
			$this->genlib->updateSession($data);
		}
	}

	public function index() {
		$values['pageTitle'] = 'หน้าหลัก';
		$values['breadcrumb'] = 'ภาพรวมระบบ';
		$values['pageContent'] = $this->load->view('home/index', '', TRUE);
		$this->load->view('main', $values);
	}

	public function all() {
		$values['pageTitle'] = 'หน้าหลัก';
		$values['breadcrumb'] = 'โครงการทั้งหมด';
		$values['pageContent'] = $this->load->view('home/list', '', TRUE);
		$this->load->view('main', $values);
	}

}