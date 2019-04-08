<?php

class Admin_model extends CI_Model {

	protected $table = 'admin';
	protected $id_name = 'admin_id';

	public function __construct() {
		parent::__construct();
	}

	public function getAdminAccount($email, $password) {
		$sql = "select * from admin where email = '$email' and password=md5('$password')";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result_array()[0];
		} else {
			return null;
		}
	}

	public function getInfo($id) {
		$this->db->where($id_name, $id);
		$query = $this->db->get($table);
		return $query->result_array();
	}

	public function getManagers() {
		$this->db->where('group_id', 2);
		$query = $this->db->get($table);
		return $query->result_array();
	}

	public function assignManager($params) {
		$this->db->insert('assignment', $params);
	}

	public function editAssignManager($admin_id, $params) {
		$this->db->where('admin_id', $admin_id);
		$this->db->update('assignment', $params);
	}

	public function disableManager($id, $params) {
		$this->db->where($id_name, $id);
		$this->db->update($table, $params);
	}

	public function enableManager($id, $params) {
		$this->db->where($id_name, $id);
		$this->db->update($table, $params);
	}

	// public function 
}