<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	
	function __construct(){
		parent::__construct();		
		$this->load->helper('url');
		$this->cek_login->user();
		$this->load->model('M_Dashboard');
	}
 
	function index(){
		$data['judul'] = "Dashboard | Admin";
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah']= $this->M_Cart_Beli->jumlah_cart();
		$this->load->view('template/admin_header', $data);
		$this->load->view('template/admin_sidebar');
		$this->load->view('dashboardv',$data);
		$this->load->view('template/admin_footer');

		$this->form_validation->set_rules('nama', 'Full Name', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Address', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('nohp', 'Phone Number', 'required|trim');
	}

	function fetch(){
		echo $this->M_Dashboard->fetch_data($this->uri->segment(3));
	}

	function search(){
		$data['judul'] = "Dashboard | Data Produk";
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah']= $this->M_Cart_Beli->jumlah_cart();

		//Pencarian Data
		if($title = $this->input->post('caridata')){
			$this->db->like('prod_name', $title);
			$this->db->from('products');
			$this->db->join('category', 'products.cat_id = category.cat_id');
			$config['total_rows']	= $this->db->count_all_results();
			$data['total_rows'] 	= $config['total_rows'];
			$data['start'] = $this->uri->segment(3);
			$data['products'] = $this->M_Dashboard->search_data($title, $data['start']);
			$data['category'] = $this->M_Dashboard->kategori();
			$this->load->view('dashboard/template/admin_header', $data);
			$this->load->view('dashboard/template/admin_sidebar');
			$this->load->view('dataproduk/dataprodukv',$data);
			$this->load->view('dashboard/template/admin_footer');
		}else{
			redirect('dataproduk');
		}
		
    }
}
