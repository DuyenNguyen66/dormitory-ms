<?php

class Class_model extends CI_Model {
	protected $table = 'class';
	protected $id_name = 'class_id';

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

	public function edit($params, $id) {
		$this->db->where($id_name, $id);
		$this->db->update($table, $params);
	}
}