<?php

class Student_model extends CI_Model {

	protected $table = 'student';
	protected $id_name = 'student_id';

	public function __construct() {
		parent::__construct();
	}

	public function getAll() {
		$query = $this->db->get($table);
		return $query->result_array();
	}

	public function getByStatus($status) {
		$this->db->where('status', $status);
		$query = $this->db->get($table);
		return $query->result_array();
	}

	public function register($params) {
		$this->db->insert($table, $params);
	}

	public function checkAccount($email, $password) {
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get($table);
		if($query->num_row() > 0)
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

	public function disable($params, $id) {
		$this->db->where($id_name, $id);
		$this->db->update($table, $params);
	}

	public function enable($params, $id) {
		$this->db->where($id_name, $id);
		$this->db->update($table, $params);
	}
}
