<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('M_Order');
		$this->load->helper('url');
		$this->cek_login->user();
	}
	
	function index(){
		$data['judul'] = "Dashboard | User Order";
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['Order'] = $this->M_Order->tampil_data();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah']= $this->M_Cart_Beli->jumlah_cart();
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('index',$data);
		$this->load->view('dashboard/template/admin_footer');
	}
	public function delete($order_num){
        $this->db->where('order_num', $order_num);
        $this->db->delete('orders');
        redirect('order');
	}
	public function deleteitems($order_num){
        $this->db->where('order_num', $order_num);
        $this->db->delete('orderitems');
        redirect('order');
	}
	
	public function detail(){
		$data['judul'] = "Dashboard | Order Detail";
        $data['Order'] = $this->M_Order->getOrderItems();
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah']= $this->M_Cart_Beli->jumlah_cart();
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('order_detail',$data);
		$this->load->view('dashboard/template/admin_footer');
	}
	public function detailuser($id){
		$data['judul'] = "Dashboard | Detail User";
        $data['Cust'] = $this->M_Order->getDetailUser($id);
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah']= $this->M_Cart_Beli->jumlah_cart();
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('customer/index',$data);
		$this->load->view('dashboard/template/admin_footer');
	}
	public function edit($id){
		$data['judul'] = "Dashboard | Update Pesanan";
        $data['edit'] = $this->M_Order->getOrderItems($id);
		$data['users']= $this->db->get_where('users', ['username' =>
		$this->session->userdata('username')])->row_array();
		$this->load->model('cart_beli/M_Cart_Beli');
		$data['sum_jumlah']= $this->M_Cart_Beli->jumlah_cart();
		$this->load->view('dashboard/template/admin_header', $data);
		$this->load->view('dashboard/template/admin_sidebar');
		$this->load->view('pesanan',$data);
		$this->load->view('dashboard/template/admin_footer');
	}
	function update(){
		$order_id = $this->input->post('order_id');
		$order_num = $this->input->post('order_num');
		$order_date = $this->input->post('order_date');
		$id_user = $this->input->post('id_user');
		$alamat_pengiriman = $this->input->post('alamat_pengiriman');
		$kurir = $this->input->post('kurir');
		$status = $this->input->post('status');
		$ongkos_kirim = $this->input->post('ongkos_kirim');
		$bukti_img = $this->input->post('bukti_img');
		$no_resi = $this->input->post('no_resi');

		$config['upload_path'] 		= './bukti/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png';
		$config['max_size'] 		= 2048;
		$config['min_size'] 		= 0;
		$config['max_width'] 		= 0;
		$config['max_height'] 		= 0;
		$this->load->library('upload', $config);


		if ($this->upload->do_upload('userfile')) {
			$_data = array('upload_data' => $this->upload->data());
			$data = array(
				'order_id' => $order_id,
				'order_num' => $order_num,
				'order_date' => $order_date,
				'id_user' => $id_user,
				'alamat_pengiriman' => $alamat_pengiriman,
				'status' => $status,
				'ongkos_kirim' => $ongkos_kirim,
				'kurir' => $kurir,
				'no_resi' => $no_resi,
				'bukti_img' => $_data['upload_data']['file_name']
			);
			$this->M_Order->update_data($data, $order_id);
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('order/detail');

			$where = array(
				'order_id' => $order_id
			);

			$this->M_Order->update_data($where, $data, 'products');
		}else{
			$_data = array('upload_data' => $this->upload->data());
			$data = array(
				'order_id' => $order_id,
				'order_num' => $order_num,
				'order_date' => $order_date,
				'id_user' => $id_user,
				'alamat_pengiriman' => $alamat_pengiriman,
				'status' => $status,
				'ongkos_kirim' => $ongkos_kirim,
				'kurir' => $kurir,
				'no_resi' => $no_resi
			);
			$this->M_Order->update_data($data, $order_id);
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"> Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('order/detail');

			$where = array(
				'order_id' => $order_id
			);

			$this->M_Order->update_data($where, $data, 'orders');
		}
	}
}
