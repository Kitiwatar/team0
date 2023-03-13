<?php
// Create by: Natakorn Phongsarikit 15-09-2565 Tasklist management
defined('BASEPATH') or exit('No direct script access allowed');

class Tasklist extends CI_Controller
{

	public function __construct()
	{
		// Create by: Natakorn Phongsarikit 15-09-2565 construct
		parent::__construct();
		if (isset($_SESSION['lang'])) {
			if ($_SESSION['lang'] == "th") {
				$this->lang->load("pages", "thai");
			} else {
				$this->lang->load("pages", "english");
			}
		} else {
			$_SESSION['lang'] = "th";
			$this->lang->load("pages", "thai");
		}
		$this->genlib->checkLogin();
		$data = $this->genmod->getOne('pms_user', '*', array('u_id' => $_SESSION['u_id']));
		$this->genlib->updateSession($data);
		if ($_SESSION['u_role'] > 1) {
			redirect(base_url());
		}
	}

	public function index()
	{
		// Create by: Natakorn Phongsarikit 15-09-2565 index
		$values['pageTitle'] = lang('tp_user_tl-name');
		$values['breadcrumb'] = lang('tp_user_tl-name');
		$values['pageContent'] = $this->load->view('tasklist/index', $values, TRUE);
		$this->load->view('main', $values);
	}

	public function get()
	{
		// Create by: Natakorn Phongsarikit 15-09-2565 get task list
		$arrayJoin = array('pms_user' => 'pms_tasklist.tl_u_id=pms_user.u_id');
		$getData = $this->genmod->getAll('pms_tasklist', '*', '', 'tl_createdate desc', $arrayJoin, '');
		$taskCheck = array();
		if (is_array($getData)) {
			for ($i = 0; $i < count($getData); $i++) {
				$taskCheck[$i] = $this->genmod->getAll('pms_task', '*', array('t_tl_id' => $getData[$i]->tl_id, 't_status' => 1), '', '', '');
			}
		}
		$data['taskCheck'] = $taskCheck;
		$data['getData'] = $getData;
		$json['html'] = $this->load->view('tasklist/list', $data, TRUE);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getAddForm()
	{
		// Create by: Natakorn Phongsarikit 15-09-2565 get form for add task
		$json['title'] = lang('md_tl_a-tl').' <span class="text-danger" style="font-size:12px;">(* '.lang('md_tl_a-req').' )</span>';
		$json['body'] = $this->load->view('tasklist/formadd', '', true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(\'new\');">' . lang('bt_save') . '</button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'เพิ่มรายชื่อกิจกรรม\')">' . lang('bt_cancel') . '</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function add()
	{
		// Create by: Natakorn Phongsarikit 15-09-2565 add tasklist to database
		$this->genlib->ajaxOnly();
		$formData = $this->input->post();

		$dataRequires = array('tl_id', 'tl_name');
		foreach ($dataRequires as $value) {
			if (!isset($formData[$value])) {
				$json = ['status' => 0, 'msg' => lang('md_vm_ad-fail')];
				$this->output->set_content_type('application/json')->set_output(json_encode($json));
				return;
			}
		}
		if ($formData['tl_id'] == 'new') {
			$formData['tl_name'] = strtolower($formData['tl_name']);
			$formData['tl_u_id'] = $_SESSION['u_id'];
			$this->genmod->add('pms_tasklist', $formData);
			$json = ['status' => 1, 'msg' => lang('md_vm_ct-save')];
		} else {
			$tl_id = $formData['tl_id'];
			unset($formData['tl_id']);
			$this->genmod->update('pms_tasklist', $formData, array('tl_id' => $tl_id));
			$json = ['status' => 1, 'msg' => lang('md_vm_ct-edit')];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function getEditForm()
	{
		// Create by: Natakorn Phongsarikit 15-09-2565 get form edit task
		$json['title'] = lang('md_tl_e-tl').' <span class="text-danger" style="font-size:12px;">(* '.lang('md_tl_a-req').' )</span>';
		$data['getData'] = $this->genmod->getOne('pms_tasklist', '*', array('tl_id' => $this->input->post('tl_id')));
		$json['body'] = $this->load->view('tasklist/formadd', $data, true);
		$json['footer'] = '<span id="fMsg"></span><button type="button" class="btn btn-success" onclick="saveFormSubmit(' . $this->input->post('tl_id') . ');">' . lang('bt_save') . '</button>
		<button type="button" class="btn btn-danger" onclick="closeModal(\'แก้ไขรายชื่อกิจกรรม\')">' . lang('bt_cancel') . '</button>';
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function updateStatus()
	{
		// Create by: Natakorn Phongsarikit 15-09-2565 update status of tasklist
		$this->genlib->ajaxOnly();
		$updateData = $this->input->post();
		if ($this->genmod->update('pms_tasklist', array('tl_status' => ($updateData['tl_status'] == 0 ? '1' : '0')), array('tl_id' => $updateData['tl_id']))) {
			if ($updateData['tl_status'] == 1) {
				$msg = lang('md_dtl_vm-msg');
			} else {
				$msg = "กู้คืนรายการสำเร็จ";
			}
			$json = ['status' => 1, 'msg' => $msg];
		} else {
			$json = ['status' => 0, 'msg' => lang('md_vm-fail')];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	public function checkRepeat()
	{
		// Create by: Patiphan Pansanga 16-12-2565 find repeat tasklist name
		$this->genlib->ajaxOnly();
		$checkData = $this->genmod->getOne('pms_tasklist', '*', array('tl_name' => $this->input->post('tl_name'), 'tl_status' => 1));
		if (isset($checkData->tl_name)) {
			$json = ['status' => 0, 'msg' => lang('ad_cancel-sm')];
		} else {
			$json = ['status' => 1, 'msg' => ""];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
}
