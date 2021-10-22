<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'cart';
    }

    public function getAll($user_id)
    {
        $return =  $this->db
            ->select($this->_table.'.*')
            ->select('products.prod_img')
            ->from($this->_table)
            ->join('products', 'cart.prod_id = products.prod_id', 'left')
            ->where(array('id_user'=>$user_id))
            ->get()
            ->result_array();

        return $return;
    }

    public function getTotalHarga($user_id)
    {
        $return =  $this->db
            ->select('sum(qty * price) as total_harga')
            ->from($this->_table)
            ->where(array('id_user'=>$user_id))
            ->get()
            ->row();

        return $return->total_harga;
    }

    public function getQty($user_id)
    {
        $qty = $this->db->select_sum('qty')
                        ->get_where($this->_table, array('id_user'=>$user_id))
                        ->row()
                        ->qty;
        return $qty!=null ? $qty : 0;
    }

    public function addToCart($user_id, $product_id, $product_qty)
    {

        $isset_data = $this->db->get_where($this->_table, array('prod_id'=>$product_id,'id_user'=>$user_id));
        if($isset_data->num_rows() > 0){
            $data = array(
                'prod_id'   => $product_id,
                'prod_name' => $this->db->select('prod_name')->from('products')->where('prod_id', $product_id)->get()->row()->prod_name,
                'qty'       => $product_qty + $isset_data->row()->qty,
                'price'     => $this->db->select('prod_price')->from('products')->where('prod_id', $product_id)->get()->row()->prod_price,
                'id_user'   => $user_id 
            );
            return $this->db->where(array('prod_id'=>$product_id,'id_user'=>$user_id))->update($this->_table, $data);
        }else{
            $data = array(
                'prod_id'   => $product_id,
                'prod_name' => $this->db->select('prod_name')->from('products')->where('prod_id', $product_id)->get()->row()->prod_name,
                'qty'       => $product_qty,
                'price'     => $this->db->select('prod_price')->from('products')->where('prod_id', $product_id)->get()->row()->prod_price,
                'id_user'   => $user_id 
            );
            return $this->db->insert($this->_table, $data);
        }
    }

    public function deleteCart($cart_id){
        $this->db->delete($this->_table, array('cart_id'=>$cart_id));
        return $this->db->affected_rows();
    }

    public function updateQtyCart($cart_id, $qty){
        return $this->db->where('cart_id', $cart_id)->update($this->_table, array('qty'=>$qty));
    }
}