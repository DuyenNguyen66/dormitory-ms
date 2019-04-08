<?php

class Na_Re_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getAllNations() {
		$query = $this->db->get('nation');
		return $query->result_array();
	}

	public function getAllReligions() {
		$query = $this->db->get('religion');
		return $query->result_array();
	}
} 