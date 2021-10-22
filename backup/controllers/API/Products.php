<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Products extends RestController {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('API/product_model', 'product_model');
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

    }

}