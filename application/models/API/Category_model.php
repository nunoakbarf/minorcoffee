<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'category';
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    
}