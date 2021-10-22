<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('M_Cust');
		$this->load->helper('url');
		$this->cek_login->user();
	}
	
	function index(){
		$data['judul'] = "Dashboard | Data Customer";
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['Cust'] = $this->M_Cust->tampil_data();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah']= $this->M_Cart_Beli->jumlah_cart();
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('index',$data);
		$this->load->view('dashboard/template/admin_footer');
	}
	public function delete($id){
        $this->db->where('id_user', $id);
        $this->db->delete('users');
        redirect('customer');
	}
	
	public function detail($id){
		$data['judul'] = "Dashboard | Order Detail";
        $data['Order'] = $this->M_Order->getOrderItems($id);
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('order_detail',$data);
		$this->load->view('dashboard/template/admin_footer');
	}
}
