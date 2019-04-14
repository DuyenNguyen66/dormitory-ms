<?php

class Registration_model extends CI_Model {

	protected $table = 'registration';
	protected $id_name = 'id';

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

	public function checkStudent($student_id, $term_id) {
		$this->db->where(array('student_id' => $student_id, 'term_id' => $term_id));
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0) {
			return $query->result_array();
		}else {
			return null;
		}
	}

	public function getRegisterList($student_id) {
		$this->db->select('rg.*, t.name as term_name, r.name as room_name, f.name as floor_name, b.name as build_name');
		$this->db->from('registration rg');
		$this->db->join('term t', 'rg.term_id = t.term_id');
		$this->db->join('room r', 'rg.room_id = r.room_id');
		$this->db->join('floor f', 'r.floor_id = f.floor_id');
		$this->db->join('building b', 'r.building_id = b.building_id');
		$this->db->where('rg.student_id', $student_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getRoom($student_id, $term_id) {
		$this->db->select('rg.*, r.name');
		$this->db->from('registration rg');
		$this->db->join('room r', 'rg.room_id = r.room_id');
		$this->db->where(array('student_id' => $student_id, 'term_id' => $term_id));
		$query = $this->db->get();
		return $query->first_row('array');
	}

	public function getRoommates($term_id, $room_id) {
		$this->db->select('s.full_name, s.email, s.phone, c.name as class');
		$this->db->from('registration rg');
		$this->db->join('student s', 'rg.student_id = s.student_id');
		$this->db->join('class c', 's.class_id = c.class_id');
		$this->db->where(array('term_id' => $term_id, 'room_id' => $room_id));
		$query = $this->db->get();
		return $query->result_array();
	}
}	