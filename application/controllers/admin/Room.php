<?php

class Room extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('room_model');
		$this->load->model('floor_model');
		$this->load->model('building_model');
		$this->load->model('student_model');
		$this->load->model('admin_model');
		$this->load->model('term_model');
	}

	public function index() {
		$account = $this->session->userdata('admin');
		if($account == null)
		{
			redirect('login');
		}
		$admin = $this->admin_model->getAccountByEmail($account['email']);
		$rooms = $this->room_model->getAll();
		$floors = $this->floor_model->getAll();
		$buildings = $this->building_model->getAll();
		$cmd = $this->input->post('cmd');
		if($cmd != null)
		{
			$params['building_id'] = $this->input->post('building_id');
			$params['floor_id'] = $this->input->post('floor_id');
			$params['name'] = $this->input->post('name');
			$params['type'] = $this->input->post('type');
			$this->room_model->add($params);
			redirect('room');
		}
		$layoutParams = array(
			'rooms' => $rooms,
			'floors' => $floors,
			'buildings' => $buildings
		);
		$content = $this->load->view('admin/room_list', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js');
		$data['parent_id'] = 2;
		$data['sub_id'] = 22;
		$data['group'] = $admin['position_id'] == 1 || $admin['position_id'] == 2 ? 1 : 2;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function getRoomByFloor() {
		$floor_id = $this->input->get('floor_id');
		$rooms = $this->room_model->getRoomByFloorForAdmin($floor_id);
		$params = array(
			'rooms' => $rooms
		);
		echo $this->load->view('admin/room_table', $params, true);
	}

	public function assignStudent($room_id) {
		$account = $this->session->userdata('admin');
		if($account == null)
		{
			redirect('login');
		}
		$admin = $this->admin_model->getAccountByEmail($account['email']);
		$room = $this->room_model->getRoomById($room_id);
		$students = $this->student_model->getAll();
		$layoutParams = array(
			'room' => $room,
			'students' => $students
		);
		$content = $this->load->view('admin/assign_room', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js');
		$data['parent_id'] = 2;
		$data['sub_id'] = 22;
		$data['group'] = $admin['position_id'] == 1 || $admin['position_id'] == 2 ? 1 : 2;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function view($room_id) {
		$account = $this->session->userdata('admin');
		if($account == null)
		{
			redirect('login');
		}
		$term = $this->term_model->getCurrentTerm();
		$params['room'] = $this->room_model->getRoom($room_id);
		$params['students'] = $this->room_model->getStudents($room_id, $term['term_id']);
		$content = $this->load->view('admin/room_view', $params, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js');
		$data['parent_id'] = 2;
		$data['sub_id'] = 22;
		$data['group'] = 1;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function edit($room_id) {
		$account = $this->session->userdata('admin');
		if($account == null)
		{
			redirect('login');
		}
		$data['room'] = $this->room_model->getRoomById($room_id);
		$cmd = $this->input->post('cmd');
		if ($cmd != null) {
			$params['name'] = $this->input->post('name');
			$params['type'] = $this->input->post('type');
			$this->room_model->edit($params, $room_id);
			redirect('room');
		}
		$content = $this->load->view('admin/room_edit', $data, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/settings.js');
		$data['parent_id'] = 2;
		$data['sub_id'] = 22;
		$data['group'] = 1;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}
}