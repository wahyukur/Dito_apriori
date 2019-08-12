<?php

class Model extends CI_Model {

	public function cek_user($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
	    $query = $this->db->get('users');
	    return $query->row_array();
	}

	public function getAll($table) {
		return $this->db->get($table);
	}

	public function getMenu() {
		$this->db->order_by('nama_menu', 'asc');
		$query = $this->db->get('menu');
		return $query;
	}

	public function storeData($table, $data){
		$this->db->insert($table, $data);
	}

}