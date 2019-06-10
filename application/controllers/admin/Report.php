<?php

class Report extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('registration_model');
		$this->load->model('admin_model');
		$this->load->model('term_model');
		$this->load->model('report_model');
		$this->load->model('bill_model');
	}

	//auto insert report
	public function index() {
		$admin = $this->session->userdata('admin');
		if ($admin == null) {
			redirect(base_url('login'));
		}
		$admin = $this->admin_model->getAccountByEmail($admin['email']);
		$arr = explode('/', date('d/n/Y', time()));
		if ($arr[0] == 9) {
			$term = $this->term_model->getCurrentTerm();
			$params = array(
				'term_id' => $term['term_id'],
				'month' => $arr[1],
				'total' => 0
			);
			$count = $this->report_model->checkIfExist($arr[1], $term['term_id']);
			if ($count == 0) {
				$this->report_model->create($params);
			}
		}
		$reports = $this->report_model->getAll();
		$layoutParams = array(
			'reports' => $reports
		);
		$content = $this->load->view('admin/report_list', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js');
		$data['parent_id'] = 9;
		$data['sub_id'] = 0;
		$data['group'] = $admin['position_id'] == 1 || $admin['position_id'] == 2 ? 1 : 2;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function view($report_id) {
		$admin = $this->session->userdata('admin');
		if ($admin == null) {
			redirect(base_url('login'));
		}
		$report = $this->report_model->getReportById($report_id);
		$content = $this->load->view('admin/report_list', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js');
		$data['parent_id'] = 9;
		$data['sub_id'] = 0;
		$data['group'] = $admin['position_id'] == 1 || $admin['position_id'] == 2 ? 1 : 2;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function getReports() {
		$admin = $this->session->userdata('admin');
		if ($admin == null) {
			redirect(base_url('login'));
		}
		$admin = $this->admin_model->getAccountByEmail($admin['email']);
		$assignment = $this->admin_model->getBuildingByManager($admin['admin_id']);
		$building_id = $assignment['building_id'];
		$arr = explode('/', date('d/n/Y', time()));
		$term = $this->term_model->getCurrentTerm();
		
		$cmd = $this->input->post('cmd');
		if (!empty($cmd)) {
			$report_id = $this->report_model->getReportId($arr[1], $term['term_id'])['report_id'];
			$num_paid = $this->bill_model->getNumPaid($building_id, $arr[1], $term['term_id']);
			$num_not_paid = $this->bill_model->getNumNotPaid($building_id, $arr[1], $term['term_id']);
			$expected_total = $this->bill_model->getExpectedTotal($building_id, $arr[1], $term['term_id'])['expected_total'];
			$actual_total = $this->bill_model->getActualTotal($building_id, $arr[1], $term['term_id'])['actual_total'];
			$created_at = time();
			$created_by = $admin['admin_id'];
			
			$params = array(
				'building_id' => $building_id,
				'report_id' => $report_id,
				'num_paid' => $num_paid,
				'num_not_paid' => $num_not_paid,
				'expected_total' => $expected_total,
				'actual_total' => $actual_total,
				'created_at' => $created_at,
				'created_by' => $created_by
			);
			$this->report_model->createReportDetail($params);
			redirect('report-m');
		}
		//get list report
		$reports = $this->report_model->getReportByBuilding($building_id);
		$layoutParams = array(
			'reports' => $reports
		);
		$content = $this->load->view('admin/report_list_manager', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js');
		$data['parent_id'] = 19;
		$data['sub_id'] = 0;
		$data['group'] = $admin['position_id'] == 1 || $admin['position_id'] == 2 ? 1 : 2;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}	
}