<?php

class Major extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('major_model');
	}

	public function index() {
		$majors = $this->major_model->getAll();
		$cmd = $this->input->post('cmd');
		if($cmd != '') {
			$params['abb_name'] = $this->input->post('abb_name');
			$params['full_name'] = $this->input->post('full_name');
			$this->major_model->add($params);
			redirect('major');
		}
		$layoutParams = array(
			'majors' => $majors,
		);
		$content = $this->load->view('admin/major_list', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js', 'assets/app/search.js');
		$data['parent_id'] = 3;
		$data['sub_id'] = 31;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}
}