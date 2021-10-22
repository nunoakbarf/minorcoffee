<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beliproduk extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Beliproduk');
		$this->load->helper('url');
		$this->cek_login->user();
	}

	function index()
	{
		$data['judul'] = "Dashboard | Beli Produk";
		$data['users'] = $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah'] = $this->M_Cart_Beli->jumlah_cart();

		//PAGEINATION
		$this->load->library('pagination');
		$config['base_url']		= 'http://localhost/minorkopi/beliproduk/index';
		$config['total_rows']	= $this->M_Beliproduk->countAllData();
		$config['per_page'] 	= 5;
		$config['num_link'] 	= 3;

		//STYLE
		$config['full_tag_open'] 	= '<nav class="mt-4"><ul class="pagination justify-content-center">';
		$config['full_tag_close'] 	= '</ul></nav>';
		//first
		$config['first_link']		= 'First';
		$config['first_tag_open']	= '<li class="page-item">';
		$config['first_tag_close']	= '</li">';
		//last
		$config['last_link']		= 'Last';
		$config['last_tag_open']	= '<li class="page-item">';
		$config['last_tag_close']	= '</li">';
		//next
		$config['next_link']		= '&raquo';
		$config['next_tag_open']	= '<li class="page-item">';
		$config['next_tag_close']	= '</li">';
		//prev
		$config['prev_link']		= '&laquo';
		$config['prev_tag_open']	= '<li class="page-item">';
		$config['prev_tag_close']	= '</li">';
		$config['prev_link']		= '&laquo';
		//current page
		$config['cur_tag_open']		= '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close']	= '</a></li">';
		//current page
		$config['num_tag_open']		= '<li class="page-item">';
		$config['num_tag_close']	= '</li">';
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(3);
		$data['products'] = $this->M_Beliproduk->tampil_data_limit($config['per_page'], $data['start']);
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('index', $data);
		$this->load->view('dashboard/template/admin_footer');
	}
	function prod_vend()
	{
		$data['judul'] = "Dashboard | Produk Vendor";
		$data['users'] = $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah'] = $this->M_Cart_Beli->jumlah_cart();
		$data['prod_vend'] = $this->M_Beliproduk->get_all_prod_vend()->result_array();
		// echo '<pre>';
		// var_dump($data);
		// echo '</pre>';
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('prod_venv', $data);
		$this->load->view('dashboard/template/admin_footer');
	}

	function edit_prod_vend($id)
	{
		$data['judul'] = "Dashboard | Produk Vendor";
		$data['users'] = $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah'] = $this->M_Cart_Beli->jumlah_cart();
		$data['edit_vend'] = $this->M_Beliproduk->get_all_prod_vend($id)->result_array();
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('edit_venv', $data);
		$this->load->view('dashboard/template/admin_footer');
	}
	function action_edit_prod_vend()
	{
		$id			= $this->input->post('prod_id');
		$vend_id		= $this->input->post('vend_id');
		$prod_name		= $this->input->post('prod_name');
		$prod_price		= $this->input->post('prod_price');
		$prod_desc		= $this->input->post('prod_desc');
		$harga_beli 	= $this->input->post('harga_beli');
		$cat_id			= $this->input->post('cat_id');
		$quantity		= $this->input->post('quantity');

		$config['upload_path'] 		= './gambar/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png';
		$config['max_size'] 		= 2048;
		$config['min_size'] 		= 0;
		$config['max_width'] 		= 0;
		$config['max_height'] 		= 0;
		$this->load->library('upload', $config);
		$this->upload->do_upload('userfile');
		$_data = array('upload_data' => $this->upload->data());

		$data = array(
			'status' => 1
		);
		$data1 = array(
			'status' => 1,
			'vend_id' => $vend_id,
			'prod_name' => $prod_name,
			'prod_price' => $prod_price,
			'prod_desc' => $prod_desc,
			'prod_img' => $_data['upload_data']['file_name'],
			'harga_beli' => $harga_beli,
			'cat_id' => $cat_id,
			'quantity' => $quantity
		);
		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 
		
		$this->db->where('prod_id', $id);
		$this->db->update('products_vend', $data);
		$this->db->insert('products', $data1);
		$this->db->trans_complete(); # Completing transaction

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			return FALSE;
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			return TRUE;
		}
			redirect('beliproduk');
		// }
	}
}
