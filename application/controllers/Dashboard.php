<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
    {
        public function __construct()
		{ 
			parent::__construct();
			$this->load->model('mvalidasi');
			$this->load->model('dashboard_model');
			$this->mvalidasi->validasiakun();
           
		} 
 
        public function index()
        { 
            // Ambil data user berdasarkan session
            $data['user'] = $this->db->get_where('user', [
                'username' => $this->session->userdata('username'),
                'image' => $this->session->userdata('image')
            ])->row_array(); 
            
            // Mengambil jumlah transaksi untuk berbagai status
            $jumlah_transaksi_baru = $this->dashboard_model->get_jumlah_transaksi_baru();
            $jumlah_member = $this->dashboard_model->get_jumlah_member();
            $jumlah_tenggat_pengambilan = $this->dashboard_model->get_jumlah_tenggat_pengambilan();
            $total_pendapatan_perbulan = $this->dashboard_model->get_total_pendapatan_perbulan();

            $username = $this->session->userdata('username'); 
            $total_pendapatan_perhari = $this->dashboard_model->get_total_pendapatan_perhari($username);
            
            // Ambil data pendapatan
            $pendapatan = $this->dashboard_model->get_pendapatan();
            
            //Data untuk dikirim ke view
            $part['user'] = $data['user'];
            $part['content'] = 'home';
            $part['title'] = 'Dashboard';
            $part['jumlah_transaksi_baru'] = $jumlah_transaksi_baru;
            $part['jumlah_member'] = $jumlah_member;
            $part['jumlah_tenggat_pengambilan'] = $jumlah_tenggat_pengambilan;
            $part['total_pendapatan_perbulan'] = $total_pendapatan_perbulan;
            $part['total_pendapatan_perhari'] = $total_pendapatan_perhari;
            $part['pendapatan'] = $pendapatan;
            $part['data'] = $this->dashboard_model->join_table();   

            
            // Mengirim data ke view
            $this->load->view('dashboard', $part);
        }

        public function get_pendapatan() {
            $this->load->model('dashboard_model');  // Memuat model yang sesuai
            $data = $this->dashboard_model->get_pendapatan();  // Mendapatkan data pendapatan dari model
            echo json_encode($data);  // Mengirimkan data dalam format JSON
        }




    }

    
?>