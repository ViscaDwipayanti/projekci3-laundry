<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

    }  
 
    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        if($this->form_validation->run() == false){
            $this->load->view('login');
        } else{
            //validasi success
            $this->_login(); 
        }
    }


    private function _login()
    {
        $username  = $this->input->post('username');
        $password = $this->input->post('password'); // Password dari input form

        // Ambil data user berdasarkan username
        $user = $this->db->get_where('user', ['username'=> $username])->row_array();

        if ($user) {
            // Verifikasi password terenkripsi
            if (password_verify($password, $user['password'])) { // Menggunakan password_verify untuk membandingkan
                $data = [
                    'id_user' => $user['id_user'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'image' => $user['image']
                ];
                $this->session->set_userdata($data);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password salah!
                    </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Username tidak terdaftar!
                </div>');
            redirect('auth');
        }
    }

  

    
   


    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Anda telah keluar
                </div>');
            redirect('auth');
    }

}