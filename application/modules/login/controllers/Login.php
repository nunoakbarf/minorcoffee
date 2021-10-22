<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){ 
        parent::__construct(); 
        $this->load->library(array('form_validation')); 
        $this->load->helper(array('url','form')); 
        $this->load->model('M_account');
	}
	
	public function index() { 
		$valid = $this->form_validation; 
		$valid->set_rules('username','Username','required|trim');
		$valid->set_rules('password','Password','required|trim'); 
		if($valid->run() == false) {
            if($this->session->userdata('verif_akun') == 1){
                redirect('user_dashboard');
            }else{
                $data['judul'] = "MINOR COFFEE | Masuk";
                $data['users']= $this->db->get_where('users', ['username' =>
		        $this->session->userdata('username')])->row_array();
                $this->load->model('cart/M_Cart');
                $data['cart']= $this->M_Cart->get_data();
                $data['sum_jumlah']= $this->M_Cart->jumlah_cart();
                $this->load->view('beranda/template/user_header', $data);
                $this->load->view('account/loginv');
                $this->db->empty_table('cart');
                $this->load->view('beranda/template/user_footer', $data);
            }
        } else {
            $this->_login();
        }
    }
    private function _login(){
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $user = $this->M_account->get($username);
         
        if(empty($user)){
             //flashdata
			$this->session->set_flashdata('message', '<div class="alert alert-light alert-dismissible text-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Akun belum terdaftar!</div>');
			redirect('login');
        }else{
            if($password == $user->password){
				$session = array(
					'username'	=>$user->username,
					'nama'		=>$user->nama,
					'email'		=>$user->email,
					'alamat'	=>$user->alamat,
					'nohp'		=>$user->nohp,
					'role'		=>$user->role,
					'verif_akun'=>$user->verif_akun
				);
				$this->session->set_userdata($session);
				if($this->session->userdata('verif_akun') == 1){
					if($this->session->userdata('role') == 'admin'){
						redirect('dashboard');
					}else if ($this->session->userdata('role') == 'user') {
						redirect('user_dashboard');
                    }else{
						redirect('vendor');
					}
				}else{
					redirect('login');
				}
			}else{
				//flashdata
				$this->session->set_flashdata('message', '<div class="alert alert-light alert-dismissible text-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Password salah!</div>');
				redirect('login');
			}
        }
    }

	public function register() {
        $valid = $this->form_validation;
        $valid->set_rules('nama','Name','required|trim');
        $valid->set_rules('nohp','Phone Number','required|trim');
        $valid->set_rules('alamat','Your Address','required|trim');
        $valid->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]');
        $valid->set_rules('username','Username','required|trim|is_unique[users.username]');
        $valid->set_rules('password','Password','required|trim|min_length[5]|matches[password_conf]',[
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $valid->set_rules('password_conf','Repeat Password','required|trim|matches[password]');
        if($valid->run() == false){
            $data['judul'] = "MINOR COFFEE | Daftar";
            $data['users']= $this->db->get_where('users', ['username' =>
            $this->session->userdata('username')])->row_array();
            $this->load->model('cart/M_Cart');
            $data['cart']= $this->M_Cart->get_data();
            $data['sum_jumlah']= $this->M_Cart->jumlah_cart();
            $this->load->view('beranda/template/user_header', $data);
            $this->load->view('account/registerv');
            $this->load->view('beranda/template/user_footer', $data);
        }else{
            $email = $this->input->post('email', true);
            $data = [
                'nama'      => htmlspecialchars($this->input->post('nama'), true),
                'nohp'      => $this->input->post('nohp'),
                'alamat'    => $this->input->post('alamat'),
                'j_kel'     => $this->input->post('j_kel'),
                'email'     => htmlspecialchars($email),
                'username'  => htmlspecialchars($this->input->post('username', true)),
                'password'  => md5($this->input->post('password')),
                'verif_akun'=> 0,
                'role' => 'user'
            ];
            
            //TOKEN
            $token = base64_encode(openssl_random_pseudo_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('users', $data);
            $this->db->insert('user_token', $user_token);
            //Kirim email
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('message', '<div id="message-center" class="modal fade"><div class="modal-dialog" style=";margin-top:150px;"><div class="modal-content"><div class="row"><img class="mx-auto bg-white" src="'.base_url('assets/dist/gif/check.gif').'" width="150px" style=";margin-top:-70px;border-radius:100px"></div><div class="modal-body"><p class="font-weight-bold text-left">Registrasi berhasil!<br>Silahkan verifikasi akun diemail anda<br><button class="btn btn-warning btn-block" type="button" data-dismiss="modal" >OK</button></div></div></div></div>');
            redirect('login');
        }
    }

    private function _sendEmail($token, $type){
        $config = [
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'protocol'    => 'smtp',
            'smtp_host'   => 'smtp.gmail.com',
            'smtp_user'   => 'debatkusir666@gmail.com',  // Email gmail
            'smtp_pass'   => 'pakpak123',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'        => "\r\n",
            'newline'     => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('debatkusir666@gmail.com', 'MINOR COFFEE OFFICIAL');
        $this->email->to($this->input->post('email'));

        if($type == 'verify'){
            $this->email->subject('Verifikasi akun | My Account MINOR COFFEE');
            $this->email->message(
                'Klik verifikasi akun untuk melanjutakan <b>My Account MINOR COFFEE</b> anda.<br>
                <a href="'.base_url(). 'login/verify?email=' . $this->input->post('email') . '&token=' . $token . '" class="btn btn-primary">Verifikasi akun</a>'
            );
        }

        if($this->email->send()){
            return true;
        }else{
            echo $this->email->print_debugger();
            die;
        }
        // echo '<pre>';
        // var_dump($this->email->send());die();
        // echo '</pre>';
    }

    public function verify(){
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $users = $this->db->get_where('users', ['email' => $email])->row_array();

        if($users){
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if($user_token){
                $this->db->set('verif_akun', 1);
                $this->db->where('email', $email);
                $this->db->update('users');
                $this->db->delete('user_token', ['email' => $email]);
                $this->session->set_flashdata('message', '<div class="alert alert-light alert-dismissible text-success" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Selamat! '. $email .' sudah terverifikasi<br>Silahkan login!</div>');
                $data['judul'] = "Verifikasi Akun";
                $this->load->model('cart/M_Cart');
                $data['cart']= $this->M_Cart->get_data();
                $data['sum_jumlah']= $this->M_Cart->jumlah_cart();
                $this->load->view('beranda/template/user_header', $data);
                $this->load->view('account/successv');
                $this->load->view('beranda/template/user_footer', $data);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-light alert-dismissible text-danger" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Verifikasi akun gagal!<br>Token anda tidak valid!</div>');
                $data['judul'] = "Verifikasi Akun";
                $this->load->model('cart/M_Cart');
                $data['cart']= $this->M_Cart->get_data();
                $data['sum_jumlah']= $this->M_Cart->jumlah_cart();
                $this->load->view('beranda/template/user_header', $data);
                $this->load->view('account/successv');
                $this->load->view('beranda/template/user_footer', $data);
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-light alert-dismissible text-success" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Verifikasi akun gagal!<br>Email anda salah!</div>');
            redirect('login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div id="message" class="alert alert-dismissible shadow text-left text-success font-weight-bold" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><div class="row"><div class="col-md-2"><img src="'.base_url('assets/dist/gif/check-circle.gif').'" width="70px"></div><div class="col-md">Data akun telah diperbarui!</div></div></div>');
        redirect('login');
    }

    //mitra
    public function register_vendor() {
        $valid = $this->form_validation;
        $valid->set_rules('nama','Name','required|trim');
        $valid->set_rules('nohp','Phone Number','required|trim');
        $valid->set_rules('alamat','Your Address','required|trim');
        $valid->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]');
        $valid->set_rules('username','Username','required|trim|is_unique[users.username]');
        $valid->set_rules('password','Password','required|trim|min_length[5]|matches[password_conf]',[
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $valid->set_rules('password_conf','Repeat Password','required|trim|matches[password]');
        if($valid->run() == false){
            $data['judul'] = "Registrasi Mitra";
            $data['users']= $this->db->get_where('users', ['username' =>
            $this->session->userdata('username')])->row_array();
            $this->load->model('cart/M_Cart');
            $data['cart']= $this->M_Cart->get_data();
            $data['sum_jumlah']= $this->M_Cart->jumlah_cart();
            $this->load->view('beranda/template/user_header', $data);
            $this->load->view('account/registervendorv');
            $this->load->view('beranda/template/user_footer', $data);
        }else{
            $email = $this->input->post('email', true);
            $data = [
                'id_user'   => $this->input->post('id_user'),
                'nama'      => htmlspecialchars($this->input->post('nama'), true),
                'nohp'      => $this->input->post('nohp'),
                'alamat'    => $this->input->post('alamat'),
                'email'     => htmlspecialchars($email),
                'username'  => htmlspecialchars($this->input->post('username', true)),
                'password'  => md5($this->input->post('password')),
                'verif_akun'=> 0,
                'role' => 'mitra'
            ];
            
            //TOKEN
            $token = base64_encode(openssl_random_pseudo_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('users', $data);
            $this->db->insert('user_token', $user_token);
            //Kirim email
            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('message', '<div id="message-center" class="modal fade"><div class="modal-dialog" style=";margin-top:150px;"><div class="modal-content"><div class="row"><img class="mx-auto bg-white" src="'.base_url('assets/dist/gif/check.gif').'" width="150px" style=";margin-top:-70px;border-radius:100px"></div><div class="modal-body"><p class="font-weight-bold text-left">Registrasi berhasil!<br>Silahkan verifikasi akun mitra diemail anda<br><button class="btn btn-warning btn-block" type="button" data-dismiss="modal" >OK</button></div></div></div></div>');
            redirect('login');
        }
    }
}
