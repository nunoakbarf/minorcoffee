<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'users';
    }
    
    public function checkAvailEmailUsername($email, $username)
    {
        return array(
            'available_email' => $this->db->get_where($this->_table, array('email'=>$email) )->num_rows() > 0 ? false : true,
            'available_username' => $this->db->get_where($this->_table, array('username'=>$username) )->num_rows() > 0 ? false : true,
        );
    }
    
    public function addUser(Array $data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->affected_rows();
    }

    public function chekUser(Array $data)
    {
        $this->db->select('id_user, nama, email, alamat, j_kel, nohp, username, role, verif_akun');
        return $this->db->get_where($this->_table, $data)->row_array();
    }

    public function updateUser(String $user_id, Array $data)
    {
        if($user_id === "" || $user_id === null){
            return false;
        }
        $message = array();

        $last_record = $this->chekUser(array('id_user' => $user_id));

        $this
            ->db
            ->where("id_user = $user_id")
            ->update($this->_table, $data);
        $new_record = $this->chekUser(array('id_user' => $user_id));

        $affected_columns = array_diff($new_record, $last_record);
        foreach ($affected_columns as $field => $value) {
            $message[$field] =  array('old_value'=>$last_record[$field], 'new_value'=>$value);
        }

        if($message === [] && $this->db->affected_rows() > 0){
            $message['password'] =  array('old_value'=>null, 'new_value'=>null);
        }
        return $message;
    }
}