<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Login extends RestController {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('API/user_model', 'user_model');
    }

    public function index_post()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password') ;

        if( $username == null || 
            $password == null)
        {
            $this->response([
                'success'  => FALSE,
                'message' => 'Parameter tidak lengkap'
            ], 400);
        }else
        {
            $data = [
                'username'  => $username,
                'password'  => md5($password),
            ];

            if( $this->user_model->chekUser($data))
            {
                $this->response([
                    'success'  => TRUE,
                    'data'    => $this->user_model->chekUser($data),
                    'message' => 'Login berhasil'
                ], 200);
            }else
            {
                $this->response([
                    'success'  => FALSE,
                    'message' => 'User tidak ditemukan'
                ], 200);
            }
        }
    }

    public function register_post()
    {
        $nama = $this->input->post('nama');
        $nohp = $this->input->post('nohp');
        $alamat = $this->input->post('alamat');
        $j_kel = $this->input->post('j_kel');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password') ;
        
        if( $nama == null || 
            $nohp == null || 
            $alamat  == null || 
            $j_kel == null || 
            $email == null || 
            $username == null || 
            $password == null)
        {
            $this->response([
                'success'  => FALSE,
                'message' => 'Parameter tidak lengkap'
            ], 400);
        }else
        {
            $data = [
                'nama'      => $nama,
                'nohp'      => $nohp,
                'alamat'    => $alamat,
                'j_kel'     => $j_kel,
                'email'     => $email,
                'username'  => $username,
                'password'  => md5($password),
                'verif_akun'=> 1
            ];

            $availEmailUsername = $this->user_model->checkAvailEmailUsername($email,$username);

            if($availEmailUsername['available_email'] && $availEmailUsername['available_username'] ) //check available email/username
            {
                if( $this->user_model->addUser($data) > 0) //check is data saved into db
                {
                    $this->response([
                        'success'  => TRUE,
                        'message' => 'Register sukses'
                    ], 200);
                }else
                {
                    $this->response([
                        'success'  => FALSE,
                        'message' => 'Register gagal'
                    ], 500);
                }
            }else
            {
                $this->response([
                    'success'  => FALSE,
                    'data'    => $availEmailUsername ,
                    'message' => 'Email/Username sudah dipakai'
                ], 200);
            }
            
        }
    }

    public function get_user_info_get()
    {
        $user_id = $this->input->get('user_id');

        if( $user_id != null)
        {
            $this->response([
                'success'  => TRUE,
                'data'    => $this->user_model->chekUser(array('id_user' => $user_id)),
            ], 200);
        }else
        {
            $this->response([
                'success'  => FALSE,
                'message' => 'Masukkan user_id'
            ], 400);
        }
    }

    public function update_user_info_post()
    {
        $user_id = $this->input->post('user_id');
        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $gender = $this->input->post('gender');
        $phone = $this->input->post('phone');
        $username = $this->input->post('username');
        $data = array();

        if($fullname != null){
            $data['nama'] = $fullname;
        }
        if($email != null){
            $data['email'] = $email;
        }
        if($address != null){
            $data['alamat'] = $address;
        }
        if($gender != null){
            $data['j_kel'] = $gender;
        }
        if($phone != null){
            $data['nohp']= $phone;
        }
        if($username != null){
            $data['username']= $username;
        }
        
        if( $user_id == null)
        {

            $this->response([
                'success'  => FALSE,
                'message' => 'Masukkan user_id'
            ], 400);
        }else if($fullname == null && $email == null && $address == null && $gender == null && $phone == null && $username == null)
        {

            $this->response([
                'success'  => FALSE,
                'message' => 'Masukkan parameter'
            ], 400);
        }else
        {
            
            $this->response([
                'success'  => TRUE,
                'data'    => $this->user_model->updateUser($user_id, $data),
                'message' => ''
            ], 200);
        } 
    }

    public function change_password_post()
    {
        $user_id = $this->input->post('user_id');
        $new_password = $this->input->post('new_password');
        $old_password = $this->input->post('old_password');
        $old_data = array(
            'id_user' => $user_id,
            'password' => md5($old_password)
        );
        $new_data = array(
            'id_user' => $user_id,
            'password' => md5($new_password)
        );

        if($user_id != null && $new_password != null && $old_password != null)
        {
            if($this->user_model->chekUser($old_data) == null)
            {
                //user tidak ditemukan
                $this->response([
                    'success'  => FALSE,
                    'data'    => null,
                    'message' => "Password lama salah"
                ], 200);
            }else{
                $this->response([
                    'success'  => TRUE,
                    'data'    => $this->user_model->updateUser($user_id, $new_data),
                    'message' => "Password diubah"
                ], 200);
            }
            
        }else
        {
            $this->response([
                'success'  => FALSE,
                'message' => 'Masukkan user_id, new_password dan old_password'
            ], 400);
        }
    }

}