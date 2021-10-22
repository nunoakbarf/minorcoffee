<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Vendor extends CI_Model
{

	function nonaktif($data, $username)
	{
		$this->db->where('username', $username);
		$this->db->update('mitra', $data);
		return TRUE;
	}

	public function getAllKategori()
	{
		return $this->db->get('category')->result_array();
	}

	public function getBarang($id)
	{
		$this->db->where('prod_id', $id);
		return $this->db->get('products_vend')->result_array();
	}
	function tampil_data_limit($limit, $start, $keyword = null)
	{
		if ($keyword) {
			$this->db->like('prod_name', $keyword);
		}
		$sql = "products_vend";
		$this->db->order_by("prod_id",'DESC');
		$this->db->join('category', 'products_vend.cat_id = category.cat_id');
		$query = $this->db->get($sql, $limit, $start);
		return $query->result_array();
	}

	function input_data($data, $table)
	{
		$this->db->insert($table, $data);
	}
	function edit_data($where, $table)
	{
		return $this->db->get_where($table, $where);
	}
	function update_data($data, $prod_id)
	{
		$this->db->where('prod_id', $prod_id);
		$this->db->update('products_vend', $data);
		return TRUE;
	}
	function hapus_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
}
