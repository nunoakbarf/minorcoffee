<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_account extends CI_Model{
    
    public function get($username){
        $this->db->where('username',$username);
        $result = $this->db->get('users')->row();
        return $result;
    }
}
?>