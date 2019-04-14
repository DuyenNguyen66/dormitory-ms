<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('student_model');
		$this->load->model('class_model');
		$this->load->model('Na_Et_model');
		$this->load->model('floor_model');
		$this->load->model('building_model');
	}

	public function index() {
		$account = $this->session->userdata('student');
		if($account == null) {
			redirect('login');
		}
		$data = array();
		$data['parent_id'] = 10;
		$data['sub_id'] = 0;
		$data['group'] = $account['group'];
		$data['content'] = $this->load->view('dashboard', array(), true);
		$this->load->view('admin_main_layout', $data);
	}

	public function login () {
		$cmd = $this->input->post("cmd");
		if ($cmd != '') {
			$params['email'] = $this->input->post('email');
			$params['password'] = md5($this->input->post('password'));
			$account = $this->student_model->checkAccount($params['email'], $params['password']);
			if($account != null) {
				$this->session->set_userdata('student', array('email' => $account['email'], 'group' => 3));
				redirect('dashboard');
			}else {
				$this->session->set_flashdata('error', 'ERROR. Account does not exist.');
				$this->load->view('login');
			}
		}
		$this->load->view('login');
	}

	public function register () {
		$data['classes'] = $this->class_model->getAll();
		$data['nations'] = $this->Na_Et_model->getAllNations();
		$data['ethnics'] = $this->Na_Et_model->getAllEthnic();
		$cmd = $this->input->post("cmd");
		if ($cmd != '') {
			$params['full_name'] = $this->input->post('name');
			$params['student_code'] = $this->input->post('code');
			$params['email'] = $this->input->post('email');
			$params['password'] = md5($this->input->post('password'));
			$params['phone'] = $this->input->post('phone');
			$params['address'] = $this->input->post('address');
			$params['gender'] = $this->input->post('gender');
			$params['birthday'] = strtotime($this->input->post('birthday'));
			$params['class_id'] = $this->input->post('class_id');
			$params['nation_id'] = $this->input->post('nation_id');
			$params['ethnic_id'] = $this->input->post('ethnic_id');

			$this->load->model('file_model');
			$image = isset($_FILES['image']) ? $_FILES['image'] : null;
			if ($image != null && $image['error'] == 0) {
				$path = $this->file_model->createFileName($image, 'media/student/', 'card');
				$this->file_model->saveFile($image, $path);
				$params['student_card'] = $path;
			}

			$params['status'] = 0;
			$check = $this->student_model->checkAccountRegister($params['email']);
			if($check == null) {
				$this->student_model->register($params);
				$this->session->set_flashdata('success', 'Registration successful.');
				redirect('login');
			}else {
				$this->session->set_flashdata('error', 'ERROR. Account already exists.');
				redirect('register');
			}
		} 
		$this->load->view('register', $data);
	}

}
