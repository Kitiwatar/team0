<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  	public function __construct() {
		parent::__construct();
	}

	public function index() {
		if(isset($_SESSION['u_id'])) {
			redirect(base_url());
		}
		$values['pageTitle'] = 'เข้าสู่ระบบ';
		$values['breadcrumb'] = 'เข้าสู่ระบบ';
	    
		$values['pageContent'] = $this->load->view('login', '', TRUE);
		$this->load->view('main', $values);
	}

	public function checkLogin() {
		$formData = $this->input->post();

		if(!isset($formData['u_email']) || !isset($formData['u_password'])) {
			$json = ['status'=> 0];	
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}

		$passwordHash = hash('sha256', $formData['u_password']);

		$data = $this->genmod->getOne('pms_user', '*', array('u_email' => $formData['u_email']));

		if(isset($data->u_id) && $data->u_status != 0) {
			if($data->u_password == $passwordHash) {
				$_SESSION['u_id'] = $data->u_id;
				$_SESSION['u_fullname'] = $data->u_firstname . " " . $data->u_lastname;
				$_SESSION['u_role'] = $data->u_role;
				$_SESSION['u_status'] = $data->u_status;
				$json = ['status'=> 1];
			} else {
				$json = ['status'=> 2];
			}
		} else {
			$json = ['status'=> 0];			
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
    }


	public function logout() {
		session_destroy();
		redirect(base_url());
	}
}
