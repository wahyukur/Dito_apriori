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

}