<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_Ajax_Model extends CI_Model{

	public function view(){
		return $this->db->get('products')->result();
	}

	public function search($keyword){
		$this->db->like('prod_id', $keyword);
		$this->db->or_like('prod_name', $keyword);
		$this->db->or_like('prod_price', $keyword);
		
		$result = $this->db->get('products')->result();
		return $result;
	}
}