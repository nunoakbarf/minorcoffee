<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'cart';
    }

    public function cart($id)
    {
        $index =  $this->db->where('id_user', $id)->join('products', 'products.prod_id = cart.prod_id')->get('cart')->result_array();
        $result = [];
        foreach ($index as $ix) {
        $result[] = [
            'cart_id' => $ix['cart_id'],
            'prod_id' => $ix['prod_id'],
            'qty' => $ix['qty'],
            'price' => $ix['price'],
            'prod_name' => $ix['prod_name'],
            'prod_img' => $ix['prod_img']
        ];
        }
        return $result;
    }

    public function total_harga_cart($id)
    {
        return $this->db->select('sum(qty*price) as total_harga')->where('id_user', $id)->get('cart')->row();
    }
    
}