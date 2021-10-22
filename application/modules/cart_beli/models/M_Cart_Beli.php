<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Cart_Beli extends CI_Model {

	function tampil_data(){
		$hasil=$this->db->order_by('prod_id')->get('products');
		return $hasil->result();
	}
	public function get_data(){
		$sql = "SELECT prod_id, prod_name, qty, price, (price * qty) as total_harga FROM cart_beli order by prod_id";
		return $this->db->query($sql);
	}
	// jumlah cart
	public function jumlah_cart(){
		$this->db->select_sum('qty','jumlah');
		$this->db->from('cart_beli');
		return $this->db->get('')->row();
	}
	public function hapus_cart($where, $table){
		$this->db->where($where);
		$this->db->delete($table);
	}
	public function hapus_cart_transaction($where, $table){
		$this->db->where($where);
		$this->db->delete($table);
	}
	public function hapus_all_cart(){
		$this->db->empty_table('cart_beli');
	}

	public function find($id){
		$result = $this->db->where('prod_id', $id)
						   ->limit(1)
						   ->get('products');
		if($result->num_rows() > 0){
			return $result->row();
		}else{
			return array();
		}
	}
	function input_data($data,$table){
		$this->db->insert($table,$data);
	}

	






	public function id_user(){
		$username = $this->session->userdata('username');
		$row = $this->db->query('select id_user from users where username ="'.$username.'"');
		$user = $row->row();
        return $id_user = $user->id_user;
	}
	public function co(){
        $id_user = $this->id_user();

		$row = $this->db->query('select max(beli_num) as beli_num from beli');
		$beli_num = $row->row();
        $nomor = $beli_num->beli_num;
        $no_order = 1;
        if($nomor == 0){
            $no_orderf= $no_order;
        } else {
            $no_orderf= $nomor+1;
        }

        $query = $this->db->query('select * from cart_beli where id_user = "'.$id_user.'"')->result_array();
		$tgl=date("Y-m-d H:i:s");

        $data = array(
            'beli_num'		=> $no_orderf,
            'beli_date' 	=> $tgl,
            'id_user' 		=> $id_user
        );
        $this->db->insert('beli', $data);

        foreach ($query as $q ) {
			$query = $this->db->query('select * from cart_beli where id_user = "'.$id_user.'"')->result_array();
            $prod_id 		= $q['prod_id'];
            $prod_price 	= $q['price'];
            $prod_name 		= $q['prod_name'];
            $data_d = array(
                'beli_num' 		=> $no_orderf,
                'prod_name'		=> $prod_name,
                'prod_id' 		=> $prod_id,
                'prod_price'	=> $prod_price,
				'quantity' 		=> $q['qty'],
				'id_user' 		=> $id_user
            );
            $this->db->insert('beliitems', $data_d);
        }
        $this->db->where('id_user', $id_user);
        $this->db->delete('cart_beli');
    }
	
}