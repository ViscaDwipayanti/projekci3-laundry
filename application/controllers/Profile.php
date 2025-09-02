<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Profile extends CI_Controller {

    public function __construct() 
    {
        parent::__construct(); 
        $this->load->model('profile_model');
        $this->load->model('mvalidasi');
        $this->mvalidasi->validasiakun(); // Memvalidasi apakah pengguna telah login
        $this->load->library('form_validation');
    } 

    public function index()
    {
        $id_user = $this->session->userdata('id_user'); 
        
        if (!$id_user) {
            redirect('auth'); 
        }

        $part['user'] = $this->profile_model->get_user_by_id($id_user);
        $part['content'] = 'profile';
        $part['title'] = 'Profile Setting';

        $this->load->view('dashboard', $part);
    }


    function buatnamafile()
    {
        $kata="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
        $namafile=substr(str_shuffle($kata),0,6);
        return $namafile;
    }

public function edit($id)  
{
    $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim', [
        'required' => 'Kata sandi saat ini diperlukan.'
    ]);

    if ($this->form_validation->run() == false) {
        // Ambil data user lagi untuk ditampilkan di view
        $data['title'] = 'Edit Profile';
        $data['user']  = $this->db->get_where('user', ['id_user' => $id])->row_array();
        $data['content'] = 'profile';

        // Tampilkan view edit, biar form_error() bisa muncul
        $this->load->view('dashboard', $data);
    } else {
        $current_password = $this->input->post('current_password');
        $new_password     = $this->input->post('new_password');

        $user = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        if (!password_verify($current_password, $user['password'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Kata sandi saat ini salah!</div>');
            redirect('profile/edit/' . $id);
        }

        // Update password jika ada input new_password
        if ($new_password) {
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $this->db->set('password', $hashed_new_password);
        }

        // Upload gambar baru
        $newName = $this->buatnamafile() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']      = 2048;
        $config['file_name']     = $newName;
        $this->load->library('upload', $config);

        $avatar = $this->input->post('old_image');
        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $avatar = $upload_data['file_name'];
        }

        // Update data user
        $data = [
            'username' => $this->input->post('username', true),
            'email'    => $this->input->post('email', true),
            'image'    => $avatar
        ];

        $this->db->where('id_user', $id);
        $this->db->update('user', $data);

        // Update session data
        $this->session->set_userdata([
            'username' => $this->input->post('username', true),
            'image'    => $avatar
        ]);

        $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil diubah!</div>');
        redirect('dashboard');
    }
}



    public function delete_image() {
        $image_name = $this->input->post('image_name');
        
        if ($image_name && file_exists('./uploads/' . $image_name)) {
            unlink('./uploads/' . $image_name); // Menghapus file
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
    
    
    
    

}
?>
