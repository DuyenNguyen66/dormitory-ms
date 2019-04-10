<?php

class Major_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function getAll() {
		$this->db->select('m.*, count(c.class_id) total_class');
		$this->db->from('major m');
		$this->db->join('class c','m.major_id = c.major_id','left');
		$this->db->group_by('major_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add($params) {
		$this->db->insert('major', $params);
	}
}