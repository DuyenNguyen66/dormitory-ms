<?php

class Student_model extends CI_Model {

	protected $table = 'student';
	protected $id_name = 'student_id';

	public function __construct() {
		parent::__construct();
	}

	public function getAll() {
		$this->db->select('s.*');
		$this->db->from('student s');
		$this->db->order_by('student_id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getByStatus($status = 1) {
		$this->db->select('s.*');
		$this->db->from('student s');
		$this->db->where('s.status', $status);
		$this->db->order_by('student_id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function register($params) {
		$this->db->insert($this->table, $params);
	}

	public function checkAccount($email, $password) {
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0)
		{
			return $query->result_array()[0];
		}else {
			return null;
		}
	}

	public function checkAccountRegister($email) {
		$this->db->where('email', $email);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0)
		{
			return $query->result_array()[0];
		}else {
			return null;
		}
	}

	public function editInfo($params, $id) {
		$this->db->where($id_name, $id);
		$this->db->update($table, $params);
	}

	public function getProfile($id) {
		$this->db->select('s.*, r.name as religion_name, e.name as ethnic_name');
		$this->db->from('student s');
		$this->db->join('religion r', 's.religion_id = r.religion_id');
		$this->db->join('ethnic e', 's.ethnic_id = e.ethnic_id');
		$this->db->where('student_id', $id);
		$query = $this->db->get();
		return $query->first_row('array');
	}

	public function disable($params, $id) {
		$this->db->where($id_name, $id);
		$this->db->update($table, $params);
	}

	public function enable($params, $id) {
		$this->db->where($id_name, $id);
		$this->db->update($table, $params);
	}

	public function getStudentByEmail($email) {
		$this->db->where('email', $email);
		$query = $this->db->get($this->table);
		return $query->first_row('array');
	}

	public function getClass($id) {
		$this->db->select('c.name');
		$this->db->from('student s');
		$this->db->join('class c', 's.class_id = c.class_id');
		$this->db->where('student_id', $id);
		$query = $this->db->get();
		return $query->first_row('array');
	}

	public function getReligion($id) {
		$this->db->select('r.name');
		$this->db->from('student s');
		$this->db->join('religion r', 's.religion_id = r.religion_id');
		$this->db->where('student_id', $id);
		$query = $this->db->get();
		return $query->first_row('array');
	}

	public function getEthnic($id) {
		$this->db->select('e.name');
		$this->db->from('student s');
		$this->db->join('ethnic e', 's.ethnic_id = e.ethnic_id');
		$this->db->where('student_id', $id);
		$query = $this->db->get();
		return $query->first_row('array');
	}
}
