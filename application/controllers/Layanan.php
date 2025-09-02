<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends CI_Controller {

    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('layanan_model');
        $this->load->model('mvalidasi');
        $this->mvalidasi->validasiakun();
    } 
 
        public function index()
    {
        // Data user yang sedang login
        $data['user'] = $this->db->get_where('user', [ 
            'username' => $this->session->userdata('username')
        ])->row_array(); 

        $id = $this->input->get('id'); 

        // Data untuk view
        $part['user'] = $data['user'];
        $part['content'] = 'layanan/layanan_view';
        $part['title'] = 'Data Layanan';
        $part['data'] = $this->layanan_model->get_all();

        $this->load->view('dashboard', $part);
    }

    public function add()
    {
         // Data user yang sedang login
         $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();


        $part['user'] = $data['user'];
        $part['content'] = 'layanan/layanan_add';
        $part['title'] = 'Form Tambah Layanan';
        $part['id_layanan'] = $this->layanan_model->generate_id_layanan();
        $this->load->view('dashboard',$part);
    }


    public function save()
    {
        // Data dari form
        $data = array(
            'id_layanan' => $this->input->post('id_layanan'), 
            'jenis_layanan' => $this->input->post('jenis_layanan'),
            'harga' => $this->input->post('harga'),
            'waktu_pengerjaan' => $this->input->post('waktu_pengerjaan'),
            'satuan_waktu' => $this->input->post('satuan_waktu')
        );

        // Simpan data ke database
        $query = $this->db->insert('layanan', $data);
        if ($query) {
            $this->session->set_flashdata('message', 'Data berhasil disimpan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data gagal disimpan!
                </div>');
        }
        redirect('layanan');
    }
    

    public function edit($id) 
    {
        $data = array( 
            'id_layanan' => $id, // Gunakan $id yang diterima dari parameter
            'jenis_layanan' => $this->input->post('jenis_layanan'),
            'harga' => $this->input->post('harga'),
            'waktu_pengerjaan' => $this->input->post('waktu_pengerjaan'),
            'satuan_waktu' => $this->input->post('satuan_waktu')
        );
    
        $query = $this->layanan_model->update_data($data, 'layanan');
        if ($query) {
            $this->session->set_flashdata('message', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data gagal diubah!
                </div>');
        }
        redirect('layanan');
    }

    public function delete($id)
    {
        $query = $this->layanan_model->delete($id); //disimpan dalam table member
        if($query = true){
            $this->session->set_flashdata('message', 'Data berhasil dihapus!');
            redirect('layanan');
        }
    }


    


 
}
