<?php

class Payment_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function addPayment($table, $params) {
		$this->db->insert($table, $params);
	}

	public function updateStatus($table, $params, $id) {
		$this->db->where('id', $id);
		$this->db->update($table, $params);
	}
}