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
		$data['customJs'] = array('assets/js/settings.js');
		$data['parent_id'] = 5;
		$data['sub_id'] = 52;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function confirm($form_id) {
		$params['confirmed'] = time();
		$params['status'] = 1;
		$this->registration_model->update($form_id, $params);
		return redirect('form');
	}

	public function disable($form_id) {
		$params['status'] = 0;
		$this->registration_model->update($form_id, $params);
		return redirect('form');
	}
}