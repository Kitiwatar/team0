<?php
/*
	Author: Patiphan Pansanga, Kitiwat Arunwong
	Create: 2022-09-07
*/
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
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
		$values['pageContent'] = $this->load->view('test', '', TRUE);
		$this->load->view('main', $values);
	}

}
