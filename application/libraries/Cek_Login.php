<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Simple login Class
 * Class ini digunakan untuk fitur login, proteksi halaman dan logout
 */
Class Cek_Login{
    // SET SUPER GLOBAL
    var $CI = NULL;
    /**
     * Class Construct
     * 
     * @return void
     */
    public function __construct(){
        $this->CI =& get_instance();
    }
    public function user(){
        //cek session username
        if ($this->CI->session->userdata('username') == ''){
            //set notifikasi
            $this->CI->session->set_flashdata('sukses','anda belum login');
            //alihkan ke halaman login
            redirect(site_url('login'));
        }
    }


}