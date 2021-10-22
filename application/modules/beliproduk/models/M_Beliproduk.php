<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Beliproduk extends CI_Model
{

	function tampil_data_limit($limit, $start)
	{
		$sql = "products";
		$this->db->order_by("prod_id");
		$this->db->join('category', 'products.cat_id = category.cat_id');
		$query = $this->db->get($sql, $limit, $start);
		return $query->result_array();
	}
	function countAllData()
	{
		return $this->db->get('products')->num_rows();
	}

	function get_all_prod_vend($id = null)
	{
		$this->db->select('products_vend.*,
							category.cat_name AS join_cat_name,
							users.nama AS join_name_mitra
		');
		$this->db->from('products_vend');
		$this->db->join('category', 'category.cat_id = products_vend.cat_id');
		$this->db->join('users', 'users.id_user = products_vend.vend_id');
		$this->db->where('status = 0');
		if ($id != null) {
			$this->db->where('prod_id', $id);
		}
		$this->db->order_by('prod_id', 'DESC');
		$query = $this->db->get();
		return $query;
	}

	function update_prod_vend($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}	
	function insert_after_prod_vend($data,$table){
		$this->db->insert($table,$data);
	}	
}
