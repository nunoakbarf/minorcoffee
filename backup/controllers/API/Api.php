<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('login/M_account', 'ma');
    }

    public function users_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
            ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
        ];

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $users )
            {
                // Set the response and exit
                $this->response( $users, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        }
        else
        {
            if ( array_key_exists( $id, $users ) )
            {
                $this->response( $users[$id], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 );
            }
        }
    }
    public function login_post(){
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $user = $this->ma->get($username);

        if (empty($user)) {
            $msg = array('pesan' => 'User Tidak Ditemukan');
            $res = [
                    'status' => false,
                    'data' => $msg
            ];
            $this->response( $res, 200);
        } else {
            if ($password == $user->password) {
                $data = array(
                    'id_user'        => $user->id_user,
                    'username'    => $user->username,
                    'nama'        => $user->nama,
                    'email'        => $user->email,
                    'alamat'        => $user->alamat,
                    'nohp'        => $user->nohp,
                    'role'        => $user->role,
                    'verif_akun' => $user->verif_akun
                );
                $res = [
                        'status' => true,
                        'data' => $data
                ];
                $this->response( $res, 200 );
            } else {
                //flashdata
                $msg = array('pesan' => 'Password Salah');
                $res = [
                        'status' => false,
                        'data' => $msg
                ];
                $this->response( $res, 200);
            }
        }
    }

    public function register_post(){
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $nohp = $this->input->post('nohp');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $data = [
            'nama'      => $nama,
            'email'     => $email,
            'alamat'     => $alamat,
            'nohp'     => $nohp,
            'username'  => $username,
            'password'  => $password,
            'role'      => "user",
            'verif_akun' => 1
        ];

        $save = $this->db->insert('users', $data);
        
        if($save)  {
            $msg = 'Berhasil Mendaftar';
            $res = [
                    'status' => true,
                    'data' => $msg
            ];
            $this->response( $res, 200 );
        }else{
            $msg = 'Gagal Mendaftar';
            $res = [
                    'status' => false,
                    'data' => $msg
            ];
            $this->response( $res, 401 );
        }
    }
}