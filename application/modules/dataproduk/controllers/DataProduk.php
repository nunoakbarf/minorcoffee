<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataProduk extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('M_Data');
		$this->load->helper('url');
		$this->cek_login->user();
	}
 
	function index(){
		$data['judul'] = "Dashboard | Data Produk";
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah']= $this->M_Cart_Beli->jumlah_cart();
		//Load Library
		$this->load->library('pagination');
		$config['base_url']		= 'http://localhost/minorkopi/dataproduk/index';
		//Tampil data searching
		if($this->input->post('submit')){
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		}else{
			$data['keyword'] = $this->session->userdata('keyword');
		}

		//Pageination
		$this->db->like('prod_name', $data['keyword']);
		$this->db->from('products');
		$this->db->join('category', 'products.cat_id = category.cat_id');
		$config['total_rows']	= $this->db->count_all_results();
		$data['total_rows'] 	= $config['total_rows'];
		$config['per_page'] 	= 6;
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(3);
		$data['products'] = $this->M_Data->tampil_data_limit($config['per_page'], $data['start'], $data['keyword']);
		$data['category'] = $this->M_Data->getAllKategori();
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('dataprodukv',$data);
		$this->load->view('dashboard/template/admin_footer');
	}
 
	function tambah(){
		$this->load->view('dataprodukv');
	}
 
	function tambah_aksi(){
		$config['upload_path']          = './gambar/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 2048;
		$config['max_width']            = 0;
		$config['max_height']           = 0;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('userfile')){
			$_data = array('upload_data' => $this->upload->data());
			$data = array(
				'prod_id'=> $this->input->post('prod_id'),
				'prod_name'=> $this->input->post('prod_name'),
				'prod_price'=> $this->input->post('prod_price'),
				'harga_beli'=> $this->input->post('harga_beli'),
				'prod_desc'=> $this->input->post('prod_desc'),
				'cat_id'=> $this->input->post('cat_id'),
				'vend_id'=> $this->input->post('vend_id'),
				'quantity'=> $this->input->post('quantity'),
				'prod_img' => $_data['upload_data']['file_name']
				);
			$query = $this->db->insert('products',$data);
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('dataproduk');
		}else{
			$error = array('error' => $this->upload->display_errors());
			$_data = array('upload_data' => $this->upload->data());
			$data = array(
				'prod_img' => 'default.jpg'
			);
			$query = $this->db->insert('products',$data);
			redirect('dataproduk',$error);
		}
	}
	public function edit($id){
		$data['judul'] = "Dashboard | edit Produk";
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah']= $this->M_Cart_Beli->jumlah_cart();
        $data['kategori'] = $this->M_Data->getAllKategori();
		$data['edit'] = $this->M_Data->getBarang($id);
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('editprodukv',$data);
		$this->load->view('dashboard/template/admin_footer');
	}
	function update(){
		$prod_id = $this->input->post('prod_id');
		$prod_name = $this->input->post('prod_name');
		$prod_price = $this->input->post('prod_price');
		$harga_beli = $this->input->post('harga_beli');
		$prod_desc = $this->input->post('prod_desc');
		$weight = $this->input->post('weight');
		$cat_id = $this->input->post('cat_id', true);
		$vend_id = $this->input->post('vend_id');
		$quantity = $this->input->post('quantity');

		$config['upload_path'] 		= './gambar/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png';
		$config['max_size'] 		= 2048;
		$config['min_size'] 		= 0;
		$config['max_width'] 		= 0;
		$config['max_height'] 		= 0;
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('userfile')) {
			$_data = array('upload_data' => $this->upload->data());
			$data = array(
				'prod_name' => $prod_name,
				'prod_price' => $prod_price,
				'harga_beli' => $harga_beli,
				'prod_desc' => $prod_desc,
				'weight' => $weight,
				'cat_id' => $cat_id,
				'vend_id' => $vend_id,
				'quantity' => $quantity,
				'prod_img' => $_data['upload_data']['file_name']
			);
			$this->M_Data->update_data($data, $prod_id);
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('dataproduk');

			$where = array(
				'prod_id' => $prod_id
			);

			$this->M_Data->update_data($where, $data, 'products');
		}else{
			$_data = array('upload_data' => $this->upload->data());
			$data = array(
				'prod_name' => $prod_name,
				'prod_price' => $prod_price,
				'harga_beli' => $harga_beli,
				'prod_desc' => $prod_desc,
				'weight' => $weight,
				'cat_id' => $cat_id,
				'vend_id' => $vend_id,
				'quantity' => $quantity
			);
			$this->M_Data->update_data($data, $prod_id);
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('dataproduk');

			$where = array(
				'prod_id' => $prod_id
			);

			$this->M_Data->update_data($where, $data, 'products');
		}
	}

	function hapus($prod_id){
		$where = array('prod_id' => $prod_id);
		$this->M_Data->hapus_data($where,'products');
		redirect('dataproduk');
	}
}
