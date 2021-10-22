<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'orders';
    }

    public function getAll($user_id)
    {
        return $this->db->get_where($this->_table, array('id_user'=>$user_id))->result_array();
    }

    public function getByOrderId($order_id)
    {
        $orders = $this->db->get_where($this->_table, array('order_id'=>$order_id))->result_array();
        foreach($orders as $key => $order){
            $items = $this
            ->db
            ->select('orderitems.*, products.prod_img')
            ->where(array('order_num'=>$order['order_num']))
            ->from('orderitems')
            ->join('products', 'orderitems.prod_id = products.prod_id')
            ->get()
            ->result_array();
            $orders[$key]['products'] = $items;
        }
        return $orders;
    }

    public function getQty($user_id)
    {
        $qty = $this->db->select_sum('qty')
                        ->get_where($this->_table, array('id_user'=>$user_id))
                        ->row()
                        ->qty;
        return $qty!=null ? $qty : 0;
    }

    /**
     * get all orders and order items
     *
     * @param [String] $user_id
     * @return void it return result array of order and item orders
     */
    public function getAllOrders($user_id)
    {
        $orders = $this->getAll($user_id);
        foreach($orders as $key => $order){
            $items = $this->db
                ->select('orderitems.*, prod_Img')
                ->from('orderitems')
                ->join('products', 'orderitems.prod_id = products.prod_id', 'left')
                ->where('order_num', $order['order_num'])
                ->get()
                ->result_array();
            $orders[$key]['products'] = $items;
        }
        return $orders;
    }

    public function transactions($user_id, $kurir, $ongkos_kirim, $produk, $alamat, $total)
    {
	
        /**
         * get order_num from Faiz Source code
         */
		$nomor = $this->db->query('select max(order_num) as order_num from orders')->row()->order_num;
		$no_order = 1;
		if($nomor == 0){
			$no_orderf= $no_order;
		} else {
			$no_orderf= $nomor+1;
		}

        //insert order
		$tgl=date("Y-m-d H:i:s");
		$data = array(
			'order_num'	    	=> $no_orderf,
			'order_date' 	    => $tgl,
			'id_user' 		    => $user_id,
			'kurir' 	    	=> $kurir,
			'total' 	    	=> $total,
            'alamat_pengiriman' => $alamat,
            'ongkos_kirim'      => $ongkos_kirim
		);
		$this->db->insert('orders', $data);
        $order_id = $this->db->insert_id();

        //insert order items
        $produk = json_decode($produk, true);
        foreach($produk as $key => $P){
            $produk[$key]['order_num'] = $no_orderf;
        }
        $insert_items = $this->db->insert_batch("orderitems", $produk);
        if($insert_items){
            foreach($produk as $del){
                $this->db->delete('cart', array('prod_id'=>$del['prod_id'], 'id_user'=>$del['id_user']));
            }
        }

        return $this->getByOrderId($order_id);
    }
    
}