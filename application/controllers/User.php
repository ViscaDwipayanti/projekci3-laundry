<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('mvalidasi');
        $this->mvalidasi->validasiakun();
        $this->load->library('upload');
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
        $part['content'] = 'user/user_view';
        $part['title'] = 'Data User';
        $part['data'] = $this->user_model->get_all();

        $this->load->view('dashboard', $part);
    }

    public function add()
    {
         // Data user yang sedang login
         $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();

        $part['user'] = $data['user'];
        $part['content'] = 'user/user_add';
        $part['title'] = 'Form Tambah User';
        $part['id_user'] = $this->user_model->generate_id_user();
        $this->load->view('dashboard',$part);
    }

    function buatnamafile()
    {
        $kata="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
        $namafile=substr(str_shuffle($kata),0,6);
        return $namafile;
    }

    public function save()
    { 
        // Upload Image
        $newName = $this->buatnamafile() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $config['upload_path']   = './uploads/'; 
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size']      = 2048; 
        $config['file_name'] = $newName;
    
        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name']; 
        } else {
            $this->session->set_flashdata('message', $this->upload->display_errors());
            redirect('user');  
            return;
        }
    
        // Data dari form
        $data = array(
            'id_user'  => $this->input->post('id_user'),
            'username' => $this->input->post('username'),
            'email'    => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'image'    => $file_name, 
            'role'     => $this->input->post('role'),
        );
    
        // Simpan data ke database
        $query = $this->db->insert('user', $data);
        if ($query) {
            $this->session->set_flashdata('message', 'Data berhasil disimpan');
        } else {
            $this->session->set_flashdata('message', 'Data gagal disimpan!');
        }
        redirect('user');
    }

    public function edit($id) 
    {
        $data = array( 
            'id_user' => $id, // Gunakan $id yang diterima dari parameter
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'role' => $this->input->post('role'),
        );
    
        $query = $this->user_model->update_data($data, 'user');
        if ($query) {
            $this->session->set_flashdata('message', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data gagal diubah!
                </div>');
        }
        redirect('user');
    }

    public function delete($id)
    {
        $user = $this->db->get_where('user', ['id_user' => $id])->row_array();
    
        if ($user) {
            if (!empty($user['image']) && file_exists('./uploads/' . $user['image'])) {
                unlink('./uploads/' . $user['image']);
            }
    
            $query = $this->user_model->delete($id);
            
            if ($query) {
                $this->session->set_flashdata('message', 'Data berhasil dihapus!');
                redirect('user');
            } else {
                $this->session->set_flashdata('message', 'Data gagal dihapus!');
                redirect('user');
            }
        } else {
            $this->session->set_flashdata('message', 'Data tidak ditemukan!');
            redirect('user');
        }
    }

    

}
