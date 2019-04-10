<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('student_model');
	}

	public function index() {

	}

	public function login () {

	}

	public function register () {
		$cmd = $this->input->post("cmd");
		if ($cmd != '') {
			
		} 
		$this->load->view('register');
	}
}
