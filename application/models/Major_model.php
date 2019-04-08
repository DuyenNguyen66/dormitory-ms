<?php

class Major_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function getAll() {
		$query = $this->db->get('major');
		return $query->result_array();
	}
}