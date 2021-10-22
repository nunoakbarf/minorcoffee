<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_Beli extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->model('M_Cart_Beli');
		$this->load->helper('url');
		$this->cek_login->user();
	}
	public function detail_cart(){
		$data['judul'] = "Dashboard | Cart Beli";
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('M_Cart_Beli');
		$data['cart_beli']= $this->M_Cart_Beli->get_data();
		$data['sum_jumlah']= $this->M_Cart_Beli->jumlah_cart();
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('cartbeliv', $data);
		$this->load->view('dashboard/template/admin_footer');
	}
	public function delete_cart_beli($id){
		$where = array ('prod_id' => $id);
		$this->M_Cart_Beli->hapus_cart($where, 'cart_beli');
		redirect('cart_beli/detail_cart');
	}
	public function delete_all_cart(){
		$this->M_Cart_Beli->hapus_all_cart();
		redirect('cart_beli/detail_cart');
	}
	public function add_cart($id){
		$this->cek_login->user();
		$id_user = $this->M_Cart_Beli->id_user();

		$rows = $this->db->query('select * from cart_beli where prod_id ="'.$id.'" and id_user = "'.$id_user.'"');
		if ($rows->num_rows() == 1) {
			$prod = $rows->row();
			$qty = $prod->qty + 1;
			$data = array(
					'qty' => $qty
			);
			$this->db->where('prod_id', $id);
			$this->db->update('cart_beli', $data);
		} else {
			$prod = $this->M_Cart_Beli->find($id);
			$data = array(
				'prod_id'	=> $prod->prod_id,
				'qty'		=> 1,
				'price'		=> $prod->prod_price,
				'prod_name'	=> $prod->prod_name,
				'id_user'	=> $id_user
			);
			$this->M_Cart_Beli->input_data($data,'cart_beli');
		}
		redirect('cart_beli/detail_cart');
	}

	public function min_qty($id){
		$rows = $this->db->query('select * from cart_beli where prod_id ="'.$id.'" ');
		if ($rows->num_rows() == 1) {
            $prod = $rows->row();
            $qty = $prod->qty - 1;
            $data = array(
                    'qty' => $qty
            );
            $this->db->where('prod_id', $id);
            $this->db->update('cart_beli', $data);
        } else {
            $prod = $this->M_Cart_Beli->find($id);
			$data = array(
				'prod_id'	=> $prod->prod_id,
				'qty'		=> 1,
				'price'		=> $prod->prod_price,
				'prod_name'	=> $prod->prod_name
			);
			$this->M_Cart_Beli->input_data($data,'cart_beli');
        }
		redirect('cart_beli/detail_cart');
	}
	
	public function transaction(){
		$this->cek_login->user();
		if ($this->cek_login->user() == TRUE ) {
			$this->load->view('dashboard');
		} else {
			$this->M_Cart_Beli->co();
			redirect('beliproduk');
		}
		redirect('dashboard');
	}
}