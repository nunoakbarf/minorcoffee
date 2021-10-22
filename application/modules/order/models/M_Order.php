<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Order extends CI_Model{

	function tampil_data(){
                $this->db->select('*'); // <-- There is never any reason to write this line!
                $this->db->from('orders');
                $this->db->order_by("order_date", "desc");
                $query=$this->db->get();
                return $query->result_array();
	}
        function input_data($data,$table){
		$this->db->insert($table,$data);
	}
	function edit_data($where,$table){		
		return $this->db->get_where($table,$where);
	}
        function update_data($data, $order_id){
		$this->db->where('order_id',$order_id);
		$this->db->update('orders', $data);
		return TRUE;
	}
	public function getOrderItems($id = null){
                $this->db->select('*');
                $this->db->from('orderitems', 'DESC');
                $this->db->join('orders', 'orderitems.order_num = orders.order_num');
                $this->db->join('users', 'users.id_user = orders.id_user');
                if ($id != null) {
                        $this->db->where('orders.order_id', $id); // <-- There is never any reason to write this line!
                }
                $query=$this->db->get();
                return $query->result_array();
        }
        public function getItemOrder($id){
                $this->db->select('*'); // <-- There is never any reason to write this line!
                $this->db->where('users.id_user', $id);
                $this->db->get_where('users', ['username' => $this->session->userdata('username')])->result_array();
                $this->db->from('orderitems', 'DESC');
                $this->db->join('orders', 'orderitems.order_num = orders.order_num');
                $query=$this->db->get()->result_array();
                return $query;
	}
	public function getDetailUser($id){
                $this->db->select('*');
                $this->db->where('orders.id_user', $id); // <-- There is never any reason to write this line!
                $this->db->from('users', 'DESC');
                $this->db->join('orders', 'users.id_user = orders.id_user');
                $query=$this->db->get();
                return $query->result_array();
        }
}