<?php

class Course_model extends CI_Model {
	protected $table = 'course';

	public function __construct() {
		parent::__construct();
	}

	public function getAll() {
		$this->db->select('co.*, count(cl.class_id) as total_class');
		$this->db->from('course co');
		$this->db->join('class cl', 'co.course_id = cl.course_id', 'left');
		$this->db->group_by('co.course_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add($params) {
		$this->db->insert($this->table, $params);
	}
}