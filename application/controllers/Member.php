<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('mvalidasi');
		$this->mvalidasi->validasiakun(); //memvalidasi apakah pengguna telah login
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();

        $part['user'] = $data['user'];
        $part['content'] = 'member/member_view';
        $part['title'] = 'Data Member';
        $part['data'] = $this->member_model->getAllMember();
        $this->load->view('dashboard',$part);
    }  
    public function add()
    {
         // Data user yang sedang login
         $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();
        
        
        $part['user'] = $data['user'];
        $part['content'] = 'member/member_add';
        $part['title'] = 'Form Tambah Member';
        $part['id_member'] = $this->member_model->generate_id_member();
        $this->load->view('dashboard',$part);
    }
    public function save()
    {
        //ditampung dalam array data
        $data = array(
            'id_member' => $this->input->post('id_member'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'), 
            'no_telepon' => $this->input->post('no_telepon'),
        ); 
        $query = $this->db->insert('member', $data); //disimpan dalam table member
        if($query = true){
            $this->session->set_flashdata('message', 'Data berhasil disimpan');
            redirect('member');
        }
    }
    public function edit($id) 
    {
        $data = array(
            'id_member' => $id, // Gunakan $id yang diterima dari parameter
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_telepon' => $this->input->post('no_telepon'),
        );
    
        $query = $this->member_model->update_data($data, 'member');
        if ($query) {
            $this->session->set_flashdata('message', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data gagal diubah!
                </div>');
        }
        redirect('member');
    }

    public function delete($id)
    {
        $query = $this->member_model->delete($id); //disimpan dalam table member
        if($query = true){
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect('member');
        }
    }

 
 

}
