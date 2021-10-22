<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Orders extends RestController {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('API/cart_model', 'cart_model');
        $this->load->model('API/order_model', 'order_model');
    }

    public function cart_get()
    {
       $user_id = $this->input->get('user_id');
       if($user_id != null)
       {
            $this->response([
                'success'   => TRUE,
                'data'      => $this->cart_model->getAll($user_id),
                'qty'       => $this->cart_model->getQty($user_id),
                'message'   => ''
            ], 200);
       }else
       {
            $this->response([
                'success'  => FALSE,
                'message'  => 'Masukkan user_id'
            ], 400);
       }
    }
    
    public function cart_qty_get()
    {
       $user_id = $this->input->get('user_id');
       if($user_id != null)
       {
            $this->response([
                'success'   => TRUE,
                'qty'       => $this->cart_model->getQty($user_id),
                'message'   => ''
            ], 200);
       }else
       {
            $this->response([
                'success'  => FALSE,
                'message'  => 'Masukkan user_id'
            ], 400);
       }
    }

    public function add_to_cart_post()
    {
        $user_id = $this->input->post('user_id');
        $product_id = $this->input->post('product_id');
        $product_qty = $this->input->post('product_qty');
        $qty = $product_qty===null? 1 : $product_qty;

        if($user_id != null && $product_id != null)
        {
            $this->response([
                'success'   => TRUE,
                'message'   => $this->cart_model->addToCart($user_id, $product_id, $qty) ? "Ditambahkan ke keranjang" : "Gagal ditambahkan ke keranjang"
            ], 200);
        }else
        {
            $this->response([
                'success'  => FALSE,
                'message' => 'Parameter tidak lengkap'
            ], 400);
        }
    }

    public function cart_delete_post()
    {
        $user_id = $this->input->post('user_id');
        $cart_id = $this->input->post('cart_id');

        if($user_id != null && $cart_id != null)
        {
            $this->response([
                'success'   => $this->cart_model->deleteCart($cart_id) ? TRUE : FALSE ,
                'data'      => $this->cart_model->getAll($user_id)
            ], 200);
        }else
        {
            $this->response([
                'success'  => FALSE,
                'message' => 'Parameter tidak lengkap'
            ], 400);
        }
    }


    public function cart_update_qty_post()
    {
        $user_id = $this->input->post('user_id');
        $cart_id = $this->input->post('cart_id');
        $qty = $this->input->post('qty');

        if($user_id != null && $cart_id != null)
        {
            $this->response([
                'success'   => $this->cart_model->updateQtyCart($cart_id, $qty) ? TRUE : FALSE ,
                'data'      => $this->cart_model->getAll($user_id)
            ], 200);
        }else
        {
            $this->response([
                'success'  => FALSE,
                'message' => 'Parameter tidak lengkap'
            ], 400);
        }
    }

    public function index_get()
    {
        $user_id = $this->input->get('user_id');
        $order_id = $this->input->get('order_id');

        if($order_id != null)
        {
                $this->response([
                    'success'   => TRUE,
                    'data'      => $this->order_model->getByOrderId($order_id),
                    'message'   => ''
                ], 200);
        }
        else if($user_id != null)
        {
                $this->response([
                    'success'   => TRUE,
                    'data'      => $this->order_model->getAllOrders($user_id),
                    'message'   => ''
                ], 200);
        }
        else
        {
                $this->response([
                    'success'  => FALSE,
                    'message'  => 'Masukkan user_id'
                ], 400);
        }
    }

    public function index_post()
    {
        $user_id = $this->input->post('user_id');
        $kurir = $this->input->post('kurir');
        $ongkos_kirim = $this->input->post('ongkos_kirim');
        $produk = $this->input->post('produk');
        $alamat = $this->input->post('alamat');
        

        if($user_id != null && $kurir != null && $ongkos_kirim != null && $produk != null && $alamat != null)
        {
            $this->response([
                'success'   => TRUE,
                'data' => $this->order_model->transactions($user_id, $kurir, $ongkos_kirim, $produk, $alamat),
                'message'   => ""
            ], 200);
        }else
        {
            $this->response([
                'success'  => FALSE,
                'message' => 'Parameter tidak lengkap'
            ], 400);
        }
    }

    public function upload_payment_post()
    {
        $image = $this->input->post('image');
        $order_id = $this->input->post('order_id');

        if($image != null){
            $image_name = 'payment'.$order_id.'.jpg';
            file_put_contents(APPPATH . '../bukti/'.$image_name, base64_decode($image));
            $this->db
                ->where('order_id', $order_id)
                ->update(
                    'orders',
                    array(
                        'status' => 'Menunggu konfirmasi',
                        'bukti_Img' => $image_name
                    )
                );

            $this->response([
                'success'  => TRUE,
            ], 200);
        }else{
            $this->response([
                'success'  => FALSE,
                'message' => 'Parameter tidak lengkap'
            ], 400);
        }
    }


}