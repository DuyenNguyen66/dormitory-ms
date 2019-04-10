<?php

class Class_model extends CI_Model {
	protected $table = 'class';
	protected $id_name = 'class_id';

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

	public function getClassBy($major_id, $course_id) {
		$this->db->where('major_id', $major_id);
		$this->db->where('course_id', $course_id);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function getClassByMajor($major_id) {
		$this->db->where('major_id', $major_id);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function getClassByCourse($course_id) {
		$this->db->where('course_id', $course_id);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
}