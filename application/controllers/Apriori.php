<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apriori extends CI_Controller {

	private $data;
	private $itemsets = [];
	private $assoc_rules = [];
	private $thresholds = [];
	private $last_iteration = 0;
	private $current_iteration = 0;

	public function index()
	{
		$data['page'] = 'Buat Paket';
		$data['assoc'] = $this->model->get_assoc()->result();
		$data['kategori'] = $this->model->getAll('menu_grup')->result();
		$data['detail'] = $this->model->get_detail_assoc('1')->result();
		$data['content'] = 'pages/Buat_paket';
		$this->load->view('template/main', $data);
	}

	public function start()
	{
		$min_sup = $this->input->post('min_sup');
		$min_conf = $this->input->post('min_conf');

		$this->set_threshold($min_sup,$min_conf);
		$this->kosongkan();
		$datas = $this->ambil_dataset();
		$this->set_data($datas); // digunakan untuk inisalisasi private $data
		
		while ($this->possible()) {
			$this->itemset_kandidat();
			$this->itemset_besar();
		}

		$this->aturan_asosiasi();
		$aturan = $this->get_assoc_rules();

		// echo "<pre>";
		// print_r($datas);
		// print_r($aturan);

		$data['page'] = 'Buat Paket';
		$data['assoc'] = $this->model->get_assoc()->result();
		$data['kategori'] = $this->model->getAll('menu_grup')->result();
		$data['detail'] = $this->model->get_detail_assoc('1')->result();
		$data['content'] = 'pages/Buat_paket';
		$this->load->view('template/main', $data);
	}

	public function set_threshold($min_sup,$min_conf)
	{
		# code...
		$this->thresholds = [
			'min_sup' => $min_sup,
			'min_conf' => $min_conf           
		];
	}

	public function kosongkan()
	{
		# code...
		$this->db->truncate('temp_assoc');
		$this->db->truncate('temp_assoc_detail');
	}

	public function ambil_dataset()
	{
		# code...
		$tgl = date('Y-m');

		$dataset = [];
		$get_id = $this->model->getIDdate('transaksi',$tgl)->result();
		foreach ($get_id as $key) {
			$id = $key->id_trans;
			$jml = $this->model->get_menu($id)->result();
			foreach ($jml as $menu) {
				$kode[] = $menu->kode;
				$arr[] = $menu->nama_menu;
			}
			array_push($dataset, [
				'id' => $id,
				'tags' => $kode,
				'menu' => $arr
			]);
			unset($kode);
			unset($arr); // menghapus array yang bernilai sama
		}

		$in = $this->model->get_input()->result();
		foreach ($in as $a) {
			# code...
			$inputan[] = $a->kode;
		}

		$data = [
			'input' => $inputan,
			'dataset' => $dataset 
		];

		return $data;
	}

	public function set_data($_data){
		$this->data = $_data;
	}

	public function get_assoc_rules(){
		return $this->assoc_rules;
	}

	// Step 1
	// Cek Jika Iterasi Terakhir Kurang Dari Iterasi Saat ini atau
	// Iterasi Terakhir  Kurang dari sama dengan 0 atau
	// Iterasi Saat ini Kurang dari sama dengan 0 maka akan me-return 'true' jika tidak maka 'false'
	public function possible(){
		return ($this->last_iteration < $this->current_iteration || $this->last_iteration <= 0 || $this->current_iteration <= 0) ? true : false;
	}

	//Step 3
	//Jika itemset == nul maka return  $max = 1
	public function buat_iterasi(){
		$max = 0;
		if($this->itemsets == []){ 
			$max = 1;
		}else{
			foreach ($this->itemsets as $itemset) {
				if($itemset['iteration'] >= $max){
					$max = $itemset['iteration'] + 1;
				}
			}
		}
		return $max;
	}

	public function get_min_sup(){
		return floor(count($this->data['dataset'])*($this->thresholds['min_sup']/100));
	}

	// Step 4 
	public function itemset_exists($_itemset){
		$response = false;
		if($this->itemsets != []){ // Tidak sama dengan null
			foreach ($this->itemsets as $i => $i_value) {
				if($this->match($_itemset, $this->itemsets[$i]['itemset'])){
					$response = true;
				}
			}
		}
		// var_dump($response);
		return $response;
	}

	public function match($str_a, $str_b){
		$response = false;
		// var_dump($str_b);
		$items_a = !is_array($str_a) ? explode(' ', $str_a) : $str_a;
		$items_b = !is_array($str_b) ? explode(' ', $str_b) : $str_b;
		// var_dump($items_a);
		if($this->itemsets){
			natsort($items_a);
			natsort($items_b);
			if(implode(' ', $items_a) == implode(' ', $items_b)){
				$response = true;
			}
		}
		return $response;
	}

	public function tambah_itemset($iteration, $tag){
		$this->itemsets[] = [
			'iteration' => $iteration,
			'itemset' => $tag,
			'sup_count' => 0
		];
	}

	//Step 2
	public function itemset_kandidat(){
		$iteration = $this->buat_iterasi(); // iteration == $max di function buat iterasi
		// var_dump($iteration);        
		if($iteration == 1){
			foreach ($this->data['dataset'] as $d) {
				foreach ($d['tags'] as $tag) {
					// var_dump($tag);
					if(!$this->itemset_exists($tag)){ // -> Step 4
						$this->tambah_itemset($iteration, $tag);
					}
				}
			} 
		} else {
			foreach ($this->itemsets as $key_prev => $value_prev) {
				if($this->itemsets[$key_prev]['iteration'] == $iteration - 1){
					foreach ($this->data['dataset'] as $key_data => $value_data) {
						foreach ($this->data['dataset'][$key_data]['tags'] as $key_tag => $value_tag) {
							if(!in_array($this->data['dataset'][$key_data]['tags'][$key_tag], explode(' ', $this->itemsets[$key_prev]['itemset']))){
								$new_itemset = implode(' ', [$this->itemsets[$key_prev]['itemset'], $this->data['dataset'][$key_data]['tags'][$key_tag]]);
								// var_dump($new_itemset);
								if(!$this->itemset_exists($new_itemset)){
									$this->tambah_itemset($iteration, $new_itemset);
								}
							}
						}
					}
				}
			}
		}
		$this->tambah_frekuensi_itemset($iteration);
	}

	public function tambah_frekuensi_itemset($iteration){
		foreach ($this->data['dataset'] as $d => $d_value) {
			foreach ($this->itemsets as $i => $i_value) {
				// var_dump($this->itemsets[$i]['itemset']);
				if($this->itemsets[$i]['iteration'] == $iteration){
					$intersect_count = 0;
					foreach (explode(' ', $this->itemsets[$i]['itemset']) as $single_item) {
						if(in_array($single_item, $this->data['dataset'][$d]['tags'])){
							$intersect_count++;
						}
					}
					if($intersect_count == count(explode(' ', $this->itemsets[$i]['itemset']))){
						foreach ($this->itemsets as $existing_itemset => $value) {
							if($this->itemsets[$existing_itemset]['itemset'] === $this->itemsets[$i]['itemset']){
								$this->itemsets[$existing_itemset]['sup_count']++;
							}
						}
					}
				}
			}
		}
	}

	public function itemset_besar(){
		foreach ($this->itemsets as $key => $value) {
			// var_dump($this->get_min_sup());
			if($this->itemsets[$key]['sup_count'] < $this->get_min_sup()){ // eleminasi / scan
				unset($this->itemsets[$key]);
			}
		}
		$this->itemsets = array_values($this->itemsets);
		$this->last_iteration = $this->current_iteration;
		$this->current_iteration = ($this->buat_iterasi() - 1);
	}

	public function aturan_asosiasi(){
		$num = 1;
		$assoc_detail = [];
		foreach ($this->data['input'] as $input_item) {
			
			foreach ($this->itemsets as $i => $i_value) {
				if($this->itemsets[$i]['iteration'] >= 2){
					$items = explode(' ', $this->itemsets[$i]['itemset']);
					if(in_array($input_item, $items)){
						$dataset_count = 0;
						foreach ($this->data['dataset'] as $d => $d_value) {
							$item_count = 0;
							foreach ($items as $item) {
								if(in_array($item, $this->data['dataset'][$d]['tags'])) $item_count++;
							}
							if($item_count == count($items)){
								$dataset_count++;
							}
						}
						
						foreach ($this->itemsets as $j => $j_value) {
							if($this->itemsets[$j]['iteration'] == 1){
								if($this->match($this->itemsets[$j]['itemset'], $input_item)){
									$sup_count = $this->itemsets[$j]['sup_count'];
									$confidence = floor(($dataset_count/$sup_count)*100);
									
									if($confidence >= $this->thresholds['min_conf']){
										$assoc_items = implode(' ', array_diff($items, explode(' ', $input_item)));
										// var_dump($items);

										$this->insert_assoc($num,$confidence);

										$assoc_detail[] = [
											'items' => $items
										];


										$this->assoc_rules[] = [
											'item' => $input_item,
											'assoc_items' => $assoc_items,
											'confidence' => $confidence
										];
										$num++;

										
									}
								}
							}
						}
					}
				}
			}
		}

		$this->insert_assoc_detail($assoc_detail);
	}


	public function insert_assoc($num,$conf)
	{
		# code...
		$cek_assoc = $this->model->get_temp()->result();
		
		if ($num == 1) {
			# code...
			$data = array(
		        'id_assoc'=>$num,
		        'confidence' => $conf,
		        'tgl_assoc'=>date('Y-m-d')
			);
			$this->db->insert('temp_assoc',$data);
		} else if ($cek_assoc != $num && $cek_assoc != null) {
			# code...
			$data = array(
		        'id_assoc'=>$num,
		        'confidence' => $conf,
		        'tgl_assoc'=>date('Y-m-d')
			);
			$this->db->insert('temp_assoc',$data);
		}
	}

	public function insert_assoc_detail($assoc_detail)
	{
		$k = 1;
		for ($i=0; $i < count($assoc_detail); $i++) { 
			for ($j=0; $j < count($assoc_detail[$i]['items']); $j++) { 
				
				$data = [
					'id_assoc' => $k,
					'kode' => $assoc_detail[$i]['items'][$j]
				];					

				$this->db->insert('temp_assoc_detail',$data);
			}
			$k++;
				
		}
	}

	public function detail_assoc($id){
		$data['page'] = 'Buat Paket';
		$data['assoc'] = $this->model->get_assoc()->result();
		$data['kategori'] = $this->model->getAll('menu_grup')->result();
		$data['detail'] = $this->model->get_detail_assoc($id)->result();
		$data['content'] = 'pages/Buat_paket';
		$this->load->view('template/main', $data);
	}

	public function fajar($id) {
		$hitung_ = $this->model->ambilID_assc($id)->result();
        $total = 0;
        foreach ($hitung_ as $k) {
			$kode_ = $k->kode;
			$harga_ = $this->model->harga_items($kode_)->result();
			foreach ($harga_ as $key) {
				$total = $total + $key->harga;
			}
        }

        $data = [
        	'responseCode' => '00',
        	'data' => [
        		'total' => $total
        	]
        ];
        // var_dump($total);
        echo json_encode($data);
	}
}