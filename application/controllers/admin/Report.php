<?php

class Report extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('registration_model');
		$this->load->model('admin_model');
	}

	public function index() {
			
	}
}