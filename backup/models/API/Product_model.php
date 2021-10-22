<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'products';
        $this->_category = 'category';
    }

    public function getProduct($id = null, $category = null, $query = null)
    {
        $this->db->select('p.*, c.cat_name')
            ->from($this->_table.' p')
            ->join($this->_category.' c', 'p.cat_id = c.cat_id', 'left');

        if($id != null){
            $this->db->where('prod_id', $id);
        }
        if($category != null){
            $this->db->where('p.cat_id', $category);
        }
        if($query != null){
            $like = array(
                'prod_name' => $query,
                'prod_desc' => $query,
                'cat_name' => $query,
            );
            $this->db->where("(prod_name LIKE '%".$query."%' OR prod_desc LIKE '%".$query."%' OR cat_name LIKE '%".$query."%')", NULL, FALSE);
        }
        
        
        $result = $this->db->get()->result_array();
        return $result;
    }
}