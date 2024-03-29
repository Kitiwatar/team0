<?php
// Create by: Patiphan Pansanga 07-09-2565 Login management
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	}

	public function getLoginForm() {
		// Create by: Jiradat Pomyai 15-12-2565 get login form
		$json['body'] = $this->load->view('login', '' ,true); // เรียก form login
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function checkLogin() {
		// Create by: Patiphan Pansanga 07-09-2565 checking for correct login
		$formData = $this->input->post();

		if(!isset($formData['u_email']) || !isset($formData['u_password'])) {
			$json = ['status'=> 0, 'msg'=>'กรุณากรอกข้อมูลให้ครบถ้วน'];	
			$this->output->set_content_type('application/json')->set_output(json_encode($json));
			return;
		}
	
		$passwordHash = hash('sha256', $formData['u_password']); // hash password ที่ user กรอกเข้ามา

		$data = $this->genmod->getOne('pms_user', '*', array('u_email' => $formData['u_email'])); // ค้นหาข้อมูลจาก database

		if(isset($data->u_id)) {
			if($data->u_password == $passwordHash) { // check password
				if($data->u_status != 0) { // ถ้าสถานะ user ไม่ถูกระงับอยู่ในขณะนั้น
					date_default_timezone_set("Asia/Bangkok");
					$_SESSION['u_id'] = $data->u_id;
					$_SESSION['u_fullname'] = $data->u_firstname . " " . $data->u_lastname;
					$_SESSION['u_firstname'] = $data->u_firstname;
					$_SESSION['u_role'] = $data->u_role;
					$_SESSION['u_status'] = $data->u_status;
					$_SESSION['timeout'] = date('Y-m-d H:i:s', strtotime('1 hour'));
					// $_SESSION['timeout'] = date('Y-m-d H:i:s');
					$json = ['status'=> 1];
				} else {
					$json = ['status'=> 0, 'msg'=>lang('l_result-usem')];
				}
			} else {
				$json = ['status'=> 0, 'msg'=>lang('l_result-pw')];
			} 
		} else {
			$json = ['status'=> 0, 'msg'=>lang('l_result-nf')];			
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
    }

	public function updateTimeout() {
		// Create by: Patiphan Pansanga 18-12-2565 update session timeout when user click something in body html
		date_default_timezone_set("Asia/Bangkok");
		$_SESSION['timeout'] = date('Y-m-d H:i:s', strtotime('1 hour'));
		$json = ['status'=> 1, 'time'=>$_SESSION['timeout']];	
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function checkTimeout() {
		// Create by: Patiphan Pansanga 18-12-2565 check session time in session
		date_default_timezone_set("Asia/Bangkok");
		$dateNow = date('Y-m-d H:i:s');
		if($dateNow >= $_SESSION['timeout']) {
			$json = ['status'=> 1];	
		} else {
			$json = ['status'=> 0];	
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function logout() {
		// Create by: Patiphan Pansanga 07-09-2565 logout
		$lang = $_SESSION['lang'];
		session_destroy();
		$_SESSION['lang'] = $lang;
		redirect(base_url());
	}
}
