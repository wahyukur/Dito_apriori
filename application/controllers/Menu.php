<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function index()
	{
		$data['page'] = 'Menu'; 
		$data['item'] = $this->model->getAll('menu')->result();
		$data['content'] = 'pages/Menu';
		$this->load->view('template/main', $data);
	}
}
