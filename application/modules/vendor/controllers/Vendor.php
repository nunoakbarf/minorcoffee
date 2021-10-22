<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendor extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Vendor');
		$this->load->helper('url');
		// $data['users']= $this->db->get_where('users', ['username' =>
		// $this->session->userdata('username')])->row_array();
		// $this->load->model('cart/M_Cart');
		// $data['cart']= $this->M_Cart->get_data();
		// $data['sum_jumlah']= $this->M_Cart->jumlah_cart();
		// $this->cek_login->user();
	}

	function index()
	{
		$data['judul'] = "MINOR COFFEE | Akun Mitra";
		$data['users'] = $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart/M_Cart');
		$data['cart'] = $this->M_Cart->get_data();
		$data['sum_jumlah'] = $this->M_Cart->jumlah_cart();
		$config['base_url']		= base_url('Vendor/index');
		$this->load->view('beranda/template/user_header', $data);
		$this->load->view('vendor/template/header', $data);
		$this->load->view('account/akunvendor', $data);
		$this->load->view('vendor/template/footer', $data);
		$this->load->view('beranda/template/user_footer', $data);
	}

	function akunvendor()
	{
		$data['judul'] = "MINOR COFFEE | Akun Mitra";
		$data['users'] = $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart/M_Cart');
		$data['cart'] = $this->M_Cart->get_data();
		$data['sum_jumlah'] = $this->M_Cart->jumlah_cart();
		$this->load->view('beranda/template/user_header', $data);
		$this->load->view('vendor/template/header', $data);
		$this->load->view('vendorv', $data);
		$this->load->view('vendor/template/footer', $data);
		$this->load->view('beranda/template/user_footer', $data);
	}

	function jualproduk()
	{
		$data['judul'] = "MINOR COFFEE | Akun Mitra";
		$data['users'] = $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['id'] = $this->db->get_where('users', ['id_user' =>
		$this->session->userdata('id_user')])->row_array();
		$this->load->model('cart/M_Cart');
		$data['cart'] = $this->M_Cart->get_data();
		$data['sum_jumlah'] = $this->M_Cart->jumlah_cart();
		//Load Library
		$this->load->library('pagination');
		$config['base_url']		= 'http://localhost/minorkopi/vendor/jualproduk';
		//Tampil data searching
		if ($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}
		//Pageination
		$this->db->like('prod_name', $data['keyword']);
		$this->db->from('products_vend');
		$this->db->join('category', 'products_vend.cat_id = category.cat_id');
		$config['total_rows']	= $this->db->count_all_results();
		$data['total_rows'] 	= $config['total_rows'];
		$config['per_page'] 	= 6;
		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(3);
		$data['products'] = $this->M_Vendor->tampil_data_limit($config['per_page'], $data['start'], $data['keyword']);
		$data['category'] = $this->M_Vendor->getAllKategori();
		$this->load->view('beranda/template/user_header', $data);
		$this->load->view('vendor/template/header', $data);
		$this->load->view('vendor/jualprodukvendorv', $data);
		$this->load->view('vendor/template/footer', $data);
		$this->load->view('beranda/template/user_footer', $data);
	}

	function jualproduk_aksi()
	{
		$config['upload_path']          = './gambar/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 2048;
		$config['max_width']            = 0;
		$config['max_height']           = 0;
		$this->load->library('upload', $config);

		$data['users'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
		$data['id'] = $this->db->get_where('users', ['id_user' => $this->session->userdata('id_user')])->row_array();
		if ($_FILES['prod_img']['name'] != NULL) {
			if ($this->upload->do_upload('prod_img')) {
				$_data = array('upload_data' => $this->upload->data());
				$data = array(
					'vend_id' => $this->input->post('vend_id'),
					'prod_id' => $this->input->post('prod_id'),
					'prod_name' => $this->input->post('prod_name'),
					'prod_price' => $this->input->post('prod_price'),
					'prod_desc' => $this->input->post('prod_desc'),
					'cat_id' => $this->input->post('cat_id'),
					'vend_id' => $this->input->post('vend_id'),
					'quantity' => $this->input->post('quantity'),
					'prod_img' => $_data['upload_data']['file_name']
				);
				$query = $this->db->insert('products_vend', $data);
				redirect('vendor/jualproduk');

				// echo '<pre>';
				// var_dump($data);
				// echo '</pre>';
			} else {
				$err = $this->upload->display_errors();
				$this->session->set_flashdata('error', $err);
				redirect('vendor/jualproduk');
			}
		} else {
			$data = array(
				'vend_id' => $this->input->post('vend_id'),
				'prod_id' => $this->input->post('prod_id'),
				'prod_name' => $this->input->post('prod_name'),
				'prod_price' => $this->input->post('prod_price'),
				'prod_desc' => $this->input->post('prod_desc'),
				'cat_id' => $this->input->post('cat_id'),
				'vend_id' => $this->input->post('vend_id'),
				'quantity' => $this->input->post('quantity'),
				'prod_img' => 'default.jpg'
			);
			$query = $this->db->insert('products_vend', $data);
			redirect('vendor/jualproduk');
		}

		// if ($image) {
		// 	$_data = array('upload_data' => $this->upload->data());
		// 	$query = $this->db->insert('products_vend', $data);
		// 	// $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data berhasil ditambahkan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		// 	// redirect('vendor');
		// }else{
		// 	$error = array('error' => $this->upload->display_errors());
		// 	$_data = array('upload_data' => $this->upload->data());
		// 	$data = array(
		// 		'prod_img' => 'default.jpg'
		// 	);
		// 	$query = $this->db->insert('products_vend', $data);
		// 	echo '<pre>';
		// 	var_dump($data);
		// 	echo '</pre>';
		// 	// redirect('vendor/jualproduk', $error);
		// }
	}

	public function edit($id)
	{
		$data['judul'] = "Minor Coffee | Edit Produk";
		$data['users'] = $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart/M_Cart');
		$data['cart'] = $this->M_Cart->get_data();
		$data['sum_jumlah'] = $this->M_Cart->jumlah_cart();
		$data['kategori'] = $this->M_Vendor->getAllKategori();
		$data['edit'] = $this->M_Vendor->getBarang($id);
		$this->load->view('beranda/template/user_header', $data);
		$this->load->view('vendor/template/header', $data);
		$this->load->view('vendor/editprodukvendv', $data);
		$this->load->view('vendor/template/footer', $data);
		$this->load->view('beranda/template/user_footer', $data);
	}
	function update()
	{
		$prod_id = $this->input->post('prod_id');
		$prod_name = $this->input->post('prod_name');
		$prod_price = $this->input->post('prod_price');
		$harga_beli = $this->input->post('harga_beli');
		$prod_desc = $this->input->post('prod_desc');
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
				'prod_desc' => $prod_desc,
				'cat_id' => $cat_id,
				'vend_id' => $vend_id,
				'quantity' => $quantity,
				'prod_img' => $_data['upload_data']['file_name']
			);
			$this->M_Vendor->update_data($data, $prod_id);
			redirect('vendor/jualproduk');

			$where = array(
				'prod_id' => $prod_id
			);

			$this->M_Vendor->update_data($where, $data, 'products_vend');
		} else {
			$_data = array('upload_data' => $this->upload->data());
			$data = array(
				'prod_name' => $prod_name,
				'prod_price' => $prod_price,
				'prod_desc' => $prod_desc,
				'cat_id' => $cat_id,
				'vend_id' => $vend_id,
				'quantity' => $quantity
			);
			$this->M_Vendor->update_data($data, $prod_id);
			redirect('vendor/jualproduk');

			$where = array(
				'prod_id' => $prod_id
			);

			$this->M_Vendor->update_data($where, $data, 'products_vend');
		}
	}

	function hapus($prod_id)
	{
		$where = array('prod_id' => $prod_id);
		$this->M_Vendor->hapus_data($where, 'products_vend');
		redirect('vendor/jualproduk');
	}

	function editdata()
	{
		$data['judul'] = "Edit | My Account";
		$data['users'] = $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('nama', 'Full Name', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Address', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('nohp', 'Phone Number', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->model('cart/M_Cart');
			$data['cart'] = $this->M_Cart->get_data();
			$data['sum_jumlah'] = $this->M_Cart->jumlah_cart();
			$this->load->view('beranda/template/user_header', $data);
			$this->load->view('vendor/template/header', $data);
			$this->load->view('account/update_akun', $data);
			$this->load->view('vendor/template/footer', $data);
			$this->load->view('beranda/template/user_footer', $data);
		} else {
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$email = $this->input->post('email');
			$nohp = $this->input->post('nohp');
			$username = $this->input->post('username');
			$this->db->set('nama', $nama);
			$this->db->set('alamat', $alamat);
			$this->db->set('email', $email);
			$this->db->set('nohp', $nohp);
			$this->db->where('username', $username);
			$this->db->update('users');
			//flashdata
			$this->session->set_flashdata('message', '<div id="message" class="alert alert-dismissible shadow text-left text-success font-weight-bold" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><div class="row"><div class="col-md-2"><img src="' . base_url('assets/dist/gif/edit-ok.gif') . '" width="70px"></div><div class="col-md">Data akun telah diperbarui!</div></div></div>');
			redirect('vendor');
		}
	}
}
