<?php

class Building_model extends CI_Model {

	protected $table = 'building';
	protected $id_name = 'building_id';

	public function __construct() {
		parent::__construct();
	}

	public function getAll() {
		$this->db->select('b.*, count(f.floor_id) total_floors');
		$this->db->from('building b');
		$this->db->join('floor f', 'b.building_id = f.building_id', 'left');
		$this->db->group_by('building_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function add($params) {
		$this->db->insert($this->table, $params);
	}

	public function edit($params, $id) {
		$this->db->where($this->id_name, $id);
		$this->db->update($this->table, $params);
	}
} 