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

	public function store(){
		$data = [
			'nama_menu' => $this->input->post('nama_menu'),
			'kode' => $this->input->post('kode'),          
			'kategori' => $this->input->post('kategori'),  
			'harga' => $this->input->post('harga')         
		];

		$this->model->storeData('menu', $data);

		// redirect('menu', 'refresh');
		redirect(base_url('index.php/menu'));
	}
}
