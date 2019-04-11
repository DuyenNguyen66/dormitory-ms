<?php

class Na_Et_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getAllNations() {
		$query = $this->db->get('nation');
		return $query->result_array();
	}

	public function getAllEthnic() {
		$query = $this->db->get('ethnic');
		return $query->result_array();
	}
} 