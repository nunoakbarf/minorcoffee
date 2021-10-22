<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dashboard extends CI_Model{

	function fetch_data($query){
		$this->db->like('prod_name', $query);
		$query = $this->db->get('products');
			if($query->num_rows() > 0){
				foreach($query->result_array() as $row)
			{
				$output[] = array(
				'name'	 => $row["prod_name"],
				'price'  => $row["prod_price"],
				'image'  => $row["prod_img"]
				);
			}
		echo json_encode($output);
		}
	}
	
	function search_data($title, $start){
		$sql = "products";
		if($title){
			$this->db->like('prod_name', $title);
		}
		$this->db->order_by('prod_id', 'ASC');
    	$this->db->join('category', 'products.cat_id = category.cat_id');
		$query = $this->db->get($sql, $start,$title);
    	return $query->result_array();
    }

	function kategori(){
		return $this->db->get('category')->result_array();
	}
}