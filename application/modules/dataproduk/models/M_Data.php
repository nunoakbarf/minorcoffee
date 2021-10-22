<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Data extends CI_Model{

	public function getAllKategori(){
        return $this->db->get('category')->result_array();
	}
	public function getBarang($id){   
        $this->db->where('prod_id', $id);
        return $this->db->get('products')->result_array();
    }
	function tampil_data_limit($limit, $start, $keyword = null){
		if($keyword){
			$this->db->like('prod_name', $keyword);
		}
		$sql = "products";
		$this->db->order_by("prod_id");
        $this->db->join('category', 'products.cat_id = category.cat_id');
		$query = $this->db->get($sql, $limit, $start);
        return $query->result_array();
	}

	function input_data($data,$table){
		$this->db->insert($table,$data);
	}
	function edit_data($where,$table){		
		return $this->db->get_where($table,$where);
	}
	function update_data($data, $prod_id){
		$this->db->where('prod_id',$prod_id);
		$this->db->update('products', $data);
		return TRUE;
	}
	function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
}