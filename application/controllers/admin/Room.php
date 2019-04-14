<?php

class Room extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('room_model');
		$this->load->model('floor_model');
		$this->load->model('building_model');
		$this->load->model('student_model');
	}

	public function index() {
		$account = $this->session->userdata('admin');
		if($account == null)
		{
			redirect('login');
		}
		$rooms = $this->room_model->getAll();
		$floors = $this->floor_model->getAll();
		$buildings = $this->building_model->getAll();
		$cmd = $this->input->post('cmd');
		if($cmd != null)
		{
			$params['building_id'] = $this->input->post('building_id');
			$params['floor_id'] = $this->input->post('floor_id');
			$params['name'] = $this->input->post('name');
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
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}
}