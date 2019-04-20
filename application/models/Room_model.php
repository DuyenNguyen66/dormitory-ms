<?php

class Room_model extends CI_Model {

	protected $table = 'room';
	protected $id_name = 'room_id';

	public function __construct() {
		parent::__construct();
	}

	public function getAll() {
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function add($params) {
		$this->db->insert($this->table, $params);
	}

	public function edit($params, $id) {
		$this->db->where($this->id_name, $id);
		$this->db->update($this->table, $params);
	}

	public function getByFloor($building_id, $floor_id) {
		$this->db->select('r.*, count(rg.student_id) as total_student');
		$this->db->from('room r');
		$this->db->join('registration rg', 'r.room_id = rg.room_id', 'left');
		$this->db->where(array('building_id' => $building_id, 'floor_id' => $floor_id, 'rg.status' => 1));
		$this->db->group_by('r.room_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getRoomByFloorForAdmin($floor_id) {
		$this->db->select('r.*, count(rg.student_id) as total_student');
		$this->db->from('room r');
		$this->db->join('registration rg', 'r.room_id = rg.room_id', 'left');
		$this->db->where('floor_id', $floor_id);
		$this->db->group_by('r.room_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getRoomById($id) {
		$this->db->where($this->id_name, $id);
		$query = $this->db->get($this->table);
		return $query->first_row('array');
	}
} 