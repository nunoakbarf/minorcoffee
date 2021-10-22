<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_Ajax extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Search_Ajax_Model');
	}

	function index(){
		$data['judul'] = "Search Ajax";
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart/M_Cart');
		$data['cart']= $this->M_Cart->get_data();
		$data['sum_jumlah']= $this->M_Cart->jumlah_cart();
		$data['products'] = $this->Search_Ajax_Model->view();
		$this->load->view('index', $data);
	}

	public function search(){
		$keyword = $this->input->post('keyword');
		$products = $this->Search_Ajax_Model->search($keyword);
		$hasil = $this->load->view('view', array('products'=>$products), true);
		$callback = array(
			'hasil' => $hasil,
		);
		echo json_encode($callback);
	}	   

}
