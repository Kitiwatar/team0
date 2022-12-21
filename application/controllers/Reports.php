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
		$data['projectCount'] = array(0, 0, 0, 0);
		if(is_array($data['projectData'])) {
			foreach($data['projectData'] as $value) {
				for($i=0; $i<count($data['projectCount']); $i++) {
					if($value->p_status == $i+1) {
						$data['projectCount'][$i]++;
						break;
					}
				}
			}
		}
		$data['projectStatus'] = $this->genlib->getProjectStatus();
		$json['html'] = $this->load->view('reports/projects/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function users() {
        $values['pageTitle'] = "รายงานพนักงาน";
		$values['breadcrumb'] = "รายงานพนักงาน";
		$values['pageContent'] = $this->load->view('reports/users/index', $values, TRUE);
		$this->load->view('main', $values);
    }
	
	public function getUsers() {
		$users = $this->genmod->getAll('pms_user', '*', '', 'u_createdate desc', '', '');
		$projectCount = array();
		if (is_array($users)) {
			$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
			foreach ($users as $key => $value) {
				$projectCount[$key] = 0;
				for($i=1; $i<=2; $i++) {
					$permissionNow = $this->genmod->getAll('pms_permission', '*', array('per_u_id'=>$value->u_id, 'p_status'=>$i), '', $arrayJoin, '');
					if(is_array($permissionNow)) {
						$projectCount[$key] += count($permissionNow);
					} 
				}
			}
		}
		for ($i = 0; $i <  count($users) - 1; $i++) {
			for ($j = 0; $j <  count($users) - $i - 1; $j++) {
				if ($projectCount[$j] < $projectCount[$j + 1]) {
					$temp = $users[$j];
					$users[$j] = $users[$j + 1];
					$users[$j + 1] = $temp;

					$tempCount = $projectCount[$j];
					$projectCount[$j] = $projectCount[$j + 1];
					$projectCount[$j + 1] = $tempCount;
				}
			}
		}

		$data['projectCount'] = $projectCount;
		$data['users'] = $users;
		$json['html'] = $this->load->view('reports/users/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getUserProject() {
		$formData = $this->input->post();
		$arrayJoin = array('pms_project' => 'pms_project.p_id=pms_permission.per_p_id','pms_user' => 'pms_user.u_id=pms_permission.per_u_id');
		$data['projectData'] = $this->genmod->getAll('pms_permission', '*', array('per_u_id'=>$formData['u_id'], 'p_status'=>1), 'p_createdate desc', $arrayJoin, '');
		if($data['projectData'] == null) {
			$data['projectData'] = $this->genmod->getAll('pms_permission', '*', array('per_u_id'=>$formData['u_id'], 'p_status'=>2), 'p_createdate desc', $arrayJoin, '');
		} else {
			$data['projectData'] += $this->genmod->getAll('pms_permission', '*', array('per_u_id'=>$formData['u_id'], 'p_status'=>2), 'p_createdate desc', $arrayJoin, '');
		}
		$json['title'] = "รายชื่อโครงการของ ".$data['projectData'][0]->u_firstname." ".$data['projectData'][0]->u_lastname;
		$json['body'] = $this->load->view('reports/users/listProject', $data, TRUE);
		$json['footer'] = '<button type="button" class="btn btn-secondary" style="background-color: grey; color:white;" data-dismiss="modal" aria-hidden="true">'.lang('md_ap_close').'</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
}
?>
