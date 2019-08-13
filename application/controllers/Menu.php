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

		redirect(base_url('index.php/menu'));
	}

	public function edit($id){
		$data['page'] = 'Menu'; 
		$data['item'] = $this->model->getData('menu', ['id_menu' => $id])->row();
		$data['content'] = 'pages/editMenu';
		$this->load->view('template/main', $data);
	}

	public function update(){
		$id = $this->input->post('id_menu');
		$data = [
			'id_menu' => $id,
			'nama_menu' => $this->input->post('nama_menu'),
			'kode' => $this->input->post('kode'),
			'kategori' => $this->input->post('kategori'),
			'harga' => $this->input->post('harga')
		];

		$this->model->updateData('menu', ['id_menu'=>$id], $data);

		redirect(base_url('index.php/menu'));
	}

	public function delete($id){
		$this->model->deleteData('menu', ['id_menu' => $id]);
		redirect(base_url('index.php/menu'));
	}
}
