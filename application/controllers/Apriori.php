<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apriori extends CI_Controller {

	private $data;
	private $itemsets = [];
	private $assoc_rules = [];
	private $thresholds = [
		'min_sup' => 40,
		'min_conf' => 75
	];
	private $last_iteration = 0;
	private $current_iteration = 0;

	public function index()
	{
		$data = [
		    'input' => 'keju',
		    'dataset' => [
	            0 => [
	                'id' => 100,
	                'tags' => [
	                    0 => 'roti',
	                    1 => 'keju',
	                    2 => 'jus'
	                ]
	            ],
	            1 => [
	                'id' => 200,
	                'tags' => [
	                    0 => 'susu',
	                    1 => 'roti',
	                    2 => 'yoghurt'
	                ]
	            ],
	            2 => [
	                'id' => 300,
	                'tags' => [
	                    0 => 'roti',
	                    1 => 'jus',
	                    2 => 'susu'
	                ]
	            ],
	            3 => [
	                'id' => 400,
	                'tags' => [
	                    0 => 'telur',
	                    1 => 'roti',
	                    2 => 'keju',
	                    3 => 'jus'
	                ]
	            ],
	            4 => [
	                'id' => 500,
	                'tags' => [
	                    0 => 'keju',
	                    1 => 'jus',
	                    2 => 'susu'
	                ],
	            ]
	        ]
		];
		echo "<pre>";
		print_r($data);

		// $str_data = $_POST['data'];
		// $str_data = $_GET['data'];

		// $data = json_decode($str_data, true);

		// $apr = new Apriori;
		$this->set_data($data);
		while ($this->possible()) {
			$this->itemset_kandidat();
			$this->itemset_besar();
		}
		$this->aturan_asosiasi();
		// echo '<pre>';
		// print_r($apr->get_assoc_rules());
		$aturan = $this->get_assoc_rules();
		// echo json_encode($apr->get_assoc_rules());

		print_r($aturan);
	}

	public function set_data($_data){
		$this->data = $_data;
	}

	public function get_data(){
		return $this->data;
	}

	public function get_itemsets(){
		return $this->itemsets;
	}

	public function get_assoc_rules(){
		return $this->assoc_rules;
	}

	public function possible(){
		return ($this->last_iteration < $this->current_iteration || $this->last_iteration <= 0 || $this->current_iteration <= 0) ? true : false;
	}

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

	public function itemset_exists($_itemset){
		$response = false;
		if($this->itemsets != []){
			foreach ($this->itemsets as $i => $i_value) {
				if($this->match($_itemset, $this->itemsets[$i]['itemset'])){
					$response = true;
				}
			}
		}
		return $response;
	}

	public function match($str_a, $str_b){
		$response = false;
		$items_a = !is_array($str_a) ? explode(' ', $str_a) : $str_a;
		$items_b = !is_array($str_b) ? explode(' ', $str_b) : $str_b;
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

	public function itemset_kandidat(){
		$iteration = $this->buat_iterasi();
		if($iteration == 1){
			foreach ($this->data['dataset'] as $d) {
				foreach ($d['tags'] as $tag) {
					if(!$this->itemset_exists($tag)){
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
			if($this->itemsets[$key]['sup_count'] < $this->get_min_sup()){
				unset($this->itemsets[$key]);
			}
		}
		$this->itemsets = array_values($this->itemsets);
		$this->last_iteration = $this->current_iteration;
		$this->current_iteration = ($this->buat_iterasi() - 1);
	}

	public function aturan_asosiasi(){
		$input_item = $this->data['input'];
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
									$this->assoc_rules[] = [
										'item' => $input_item,
										'assoc_items' => $assoc_items,
										'confidence' => $confidence
									];
								}
							}
						}
					}
				}
			}
		}
	}
}
