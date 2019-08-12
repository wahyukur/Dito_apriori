<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function index()
	{
		$data['page'] = 'Order Here'; 
		$data['item'] = $this->model->getMenu()->result();
		$data['content'] = 'pages/Order';
		$this->load->view('template/main', $data);
	}
}
