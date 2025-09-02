<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

    public function get_user_by_id($id_user) 
    { 
        $this->db->where('id_user', $id_user); 
        $query = $this->db->get('user'); 
        return $query->row_array(); 
    }

 
    public function update_data($id, $data) 
{
    $this->db->where('id_user', $id);
    $this->db->update('user', $data);
}

}
