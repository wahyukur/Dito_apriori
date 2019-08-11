<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['page'] = 'Dashboard';
		$data['content'] = 'pages/Dashboard';
		$this->load->view('template/main', $data);
	}
}
