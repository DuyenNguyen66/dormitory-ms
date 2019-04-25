<?php

class Bill_model extends CI_model
{
	protected $table = 'bill';

	public function __construct() {
		parent::__construct();
	}

	public function getAll($building_id, $bill_type) {
		$this->db->select('bi.*, r.name as room_name, t.name as term_name, p.*');
		$this->db->from('bill bi');
		$this->db->join('room r', 'r.room_id = bi.room_id');
		$this->db->join('term t', 'bi.term_id = t.term_id');
		$this->db->join('bill_pay p', 'bi.bill_id = p.bill_id');
		$this->db->where(array('r.building_id' => $building_id, 'bi.bill_type' => $bill_type));
		$this->db->order_by('bi.bill_id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getBill($params) {
		$this->db->where('bill_type', $params['bill_type']);
		$this->db->where('room_id', $params['room_id']);
		$this->db->where('month', $params['month']);
		$this->db->where('term_id', $params['term_id']);
		$query = $this->db->get($this->table);
		return $query->first_row('array');
	}

	public function getRooms($building_id) {
		$this->db->select('r.*');
		$this->db->from('room r');
		$this->db->join('registration rg', 'r.room_id = rg.room_id');
		$this->db->where('r.building_id', $building_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function addBill($params) {
		$this->db->insert($this->table, $params);
		return $this->db->insert_id();
	}

	public function addBillPay($params) {
		$this->db->insert('bill_pay', $params);
	}

	public function getBillType($bill_id) {
		$this->db->select('bill_type');
		$this->db->from('bill');
		$this->db->where('bill_id', $bill_id);
		$query = $this->db->get();
		return $query->first_row('array');
	}

	public function updatePaid($params, $bill_id) {
		$this->db->where('bill_id', $bill_id);
		$this->db->update('bill_pay', $params);
	}

	public function disable($bill_id) {
		$this->db->where('bill_id',$bill_id);
		$this->db->set('status', 0);
		$this->db->update('bill_pay');
	}

	public function getRoomBill() {
		$this->db->select('rp.*, r.name as room_name, t.name as term_name');
		$this->db->from('room_pay rp');
		$this->db->join('term t', 'rp.term_id = t.term_id');
		$this->db->join('room r', 'rp.room_id = r.room_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function addRoomBill($params) {
		$this->db->insert('room_pay', $params);
	}

	public function updatePaidRoom($params, $id) {
		$this->db->where('id', $id);
		$this->db->update('room_pay', $params);
	}

	public function disableRoomPay($id) {
		$this->db->where('id',$id);
		$this->db->set('status', 0);
		$this->db->update('room_pay');
	}
}