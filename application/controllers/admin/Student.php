<?php

class Student extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('student_model');
	}

	public function index() {
		$account = $this->session->userdata('admin');
		if($account == null)
		{
			redirect('login');
		}
		$content = $this->load->view('admin/student_list', '',true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js');
		$data['parent_id'] = 5;
		$data['sub_id'] = 51;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function getStudentsByStatus() {
		$status = $this->input->get('status');
		if ($status == 0 || $status == 1) {
			$students = $this->student_model->getByStatus($status);
		}else {
			$students = $this->student_model->getAll();
		}
		$data['students'] = $students;
		$this->load->view('admin/student_table', $data);
	}

	public function profile($student_id) {
		$params['student'] = $this->student_model->getProfile($student_id);
		$content = $this->load->view('admin/student_profile', $params, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js');
		$data['parent_id'] = 5;
		$data['sub_id'] = 22;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}
}