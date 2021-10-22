<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Products extends RestController {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('API/product_model', 'product_model');
        $this->load->model('API/category_model', 'category_model');
    }

    public function index_get()
    {

        $id = $this->get( 'id' );
        $category = $this->get( 'category' );
        $query = $this->get( 'query' );

        $this->response([
            'success'  => TRUE,
            'data'    => $this->product_model->getProduct($id, $category, $query),
        ], 200);

        // if($id === null)
        // {
        //     $this->response([
        //         'success'  => TRUE,
        //         'data'    => $this->product_model->getAll(),
        //         'message' => 'Suskes'
        //     ], 200);
        // }else
        // {
        //     $this->response([
        //         'success'  => TRUE,
        //         'data'    => $this->product_model->getById($id),
        //         'message' => 'Sukses'
        //     ], 200);
        // }

    }

    public function category_get()
    {
        $id = $this->get( 'id' );
        if($id === null)
        {
            $this->response([
                'success'  => FALSE,
                'data'    => [],
                'message' => 'Masukkan id kategori'
            ], 200);
        }else
        {
            $this->response([
                'success'  => TRUE,
                'data'    => $this->product_model->getByCategory($id),
                'message' => 'Suskes'
            ], 200);
        }
    }

    public function category_list_get()
    {
        $this->response([
            'success'  => TRUE,
            'data'    => $this->category_model->getAll(),
            'message' => 'Suskes'
        ], 200);
    }



}