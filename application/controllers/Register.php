<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('floor_model');
		$this->load->model('building_model');
		$this->load->model('room_model');
		$this->load->model('term_model');
	}

	public function index() {
		$account = $this->session->userdata('student');
		if($account == null) {
			redirect('login');
		}
		$floors = $this->floor_model->getAll();
		$buildings = $this->building_model->getAll();
		$term = $this->term_model->getCurrentTerm();
		$layoutParams = array(
			'floors' => $floors,
			'buildings' => $buildings,
			'term' => $term
		);
		$content = $this->load->view('room_list', $layoutParams, true);

		$data = array();
		$data['customCss'] = array('assets/css/settings.css');
		$data['customJs'] = array('assets/js/student.js');
		$data['parent_id'] = 11;
		$data['group'] = 3;
		$data['content'] = $content;
		$this->load->view('admin_main_layout', $data);
	}

	public function getFloorByBuilding() {
		$building_id = $this->input->get('building_id');
		$floors = $this->floor_model->getByBuilding($building_id);
		$params = array(
			'floors' => $floors
		);
		echo $this->load->view('floor_select', $params, true);
	}

	public function getRoomByFloor() {
		$floor_id = $this->input->get('floor_id');
		$rooms = $this->room_model->getByFloor($floor_id);
		$params = array(
			'rooms' => $rooms
		);
		echo $this->load->view('room_table', $params, true);
	}
}