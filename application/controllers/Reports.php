<?php
// Create by: Jiradat Pomyai 15-09-2565 Projects management
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports extends CI_Controller{
    public function __construct() {
		// Create by: Jiradat Pomyai 15-09-2565
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
		$this->genlib->checkLogin();
		$data = $this->genmod->getOne('pms_user', '*', array('u_id'=>$_SESSION['u_id']));
		$this->genlib->updateSession($data);
	}

    public function projects() {
        $values['pageTitle'] = "รายงานโครงการ";
		$values['breadcrumb'] = "รายงานโครงการ";
		$values['pageContent'] = $this->load->view('reports/projects/index', $values, TRUE);
		$this->load->view('main', $values);
    }


	public function getProjects() {
        $formData = $this->input->post();
        if(!isset($formData['begindate']) && !isset($formData['enddate'])) {
            $data['begindate'] = 0;
            $data['enddate'] = 0;
            $data['projectData'] = $this->genmod->getAll('pms_project', '*', '', 'p_createdate desc', '', '');
        } else {
			$data['begindate'] = $formData['begindate'];
            $data['enddate'] = $formData['enddate'];
			if($data['begindate'] == 0 && $data['enddate'] == 0) {
				$data['projectData'] = $this->genmod->getAll('pms_project', '*', '', 'p_createdate desc', '', '');
			}else if($data['begindate'] == 0 && $data['enddate'] != 0) {
            	$data['projectData'] = $this->genmod->getAll('pms_project', '*', array('YEAR(p_enddate)'=>$formData['enddate']), 'p_createdate desc', '', '');
        	} else if($data['begindate'] != 0 && $data['enddate'] == 0) {
				$data['projectData'] = $this->genmod->getAll('pms_project', '*', array('YEAR(p_createdate)'=>$formData['begindate']), 'p_createdate desc', '', '');
			} else {
				$data['projectData'] = $this->genmod->getAll('pms_project', '*', array('YEAR(p_createdate)'=>$formData['begindate'], 'YEAR(p_enddate)'=>$formData['enddate']), 'p_createdate desc', '', '');
			}
		}
		$json['html'] = $this->load->view('reports/projects/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
}
?>
