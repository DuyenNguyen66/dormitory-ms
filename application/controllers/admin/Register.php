<?php

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('registration_model');
	}

	public function index() {
		$account = $this->session->userdata('admin');
		if($account == null) {
			redirect('login');
		}
		$forms = $this->registration_model->getAll();
		$layoutParams = array(
			'forms' => $forms,
		);
		$content = $this->load->view('admin/register_list', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/student.js');
		$data['parent_id'] = 6;
		$data['sub_id'] = 0;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}
}