<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Model {
    public function generate_id_user()
    {
        $this->db->select('RIGHT(user.id_user,3) as id', false);
        $this->db->order_by('id_user', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) { 
            $data = $query->row();
            $id = intval($data->id) + 1;
        } else {
            $id = 1;
        }

        $idmax = str_pad($id, 3, "0", STR_PAD_LEFT);
        $idjadi = "U" . $idmax;
        return $idjadi;
    }

    public function get_all()
    {
        return $this->db->get('user')->result(); // Mengembalikan semua data dalam bentuk array objek
    }
 
    public function update_data($data, $table)
    {
        $this->db->where('id_user', $data['id_user']); 
        return $this->db->update($table, $data); 
    }

    public function delete($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }

}
