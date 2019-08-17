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
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1000;
		$config['file_name']    		= base64_encode("" . mt_rand());
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('photo_menu')) {
			$error = array('error' => $this->upload->display_errors());
			var_dump($error);
        } else {
        	$data = [
        		'nama_menu' => $this->input->post('nama_menu'),
				'kode' => $this->input->post('kode'),
				'harga' => $this->input->post('harga'),
				'gambar' => '/uploads/'.$this->upload->data()['file_name']
			];

			$this->model->storeData('menu', $data);

			redirect(base_url('index.php/menu'));
        }
	}

	public function edit($id){
		$data['page'] = 'Menu'; 
		$data['item'] = $this->model->getData('menu', ['id_menu' => $id])->row();
		$data['content'] = 'pages/editMenu';
		$this->load->view('template/main', $data);
	}

	public function update(){
		$id = $this->input->post('id_menu');

		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1000;
		$config['file_name']    		= base64_encode("" . mt_rand());
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('photo_menu')) {
			$error = array('error' => $this->upload->display_errors());
			var_dump($error);
        } else {
        	$data = [
        		'nama_menu' => $this->input->post('nama_menu'),
				'kode' => $this->input->post('kode'),
				'harga' => $this->input->post('harga'),
				'gambar' => '/uploads/'.$this->upload->data()['file_name']
			];

			$this->model->updateData('menu', ['id_menu'=>$id], $data);

			redirect(base_url('index.php/menu'));
        }
	}

	public function delete($id){
		$this->model->deleteData('menu', ['id_menu' => $id]);
		redirect(base_url('index.php/menu'));
	}
}
