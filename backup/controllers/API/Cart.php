<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Cart extends RestController {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('API/cart_model', 'cart_model');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $index = $this->cart_model->cart($id);
        $total_harga = $this->cart_model->total_harga_cart($id);

        if ($index) {
        $this->response([
            'status' => true,
            'total_harga' => $total_harga->total_harga,
            'data' => $index
        ], 200);
        } else {
        $this->response([
            'status' => false
        ], 200);
        }
    }

}