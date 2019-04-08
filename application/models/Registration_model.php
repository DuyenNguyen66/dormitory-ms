<?php

class Admin_model extends CI_Model {

	protected $table = 'registration';
	protected $id_name = 'id';

	public function __construct() {
		parent::__construct();
	}

	public function getAll() {
		$query = $this->db->get($table);
		return $query->result_array();
	}

	public function add($params) {
		$this->db->insert($table, $params);
	}

	
}