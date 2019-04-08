<?php

class Course_model extends CI_Model {
	protected $table = 'course';

	public function __construct() {
		parent::__construct();
	}

	public function getAll() {
		$query = $this->db->get($table);
		return $query->result_array();
	}

	public function insert($params) {
		$this->db->insert($table, $params);
	}
}