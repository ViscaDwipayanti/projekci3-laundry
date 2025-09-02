<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class layanan_model extends CI_Model {

    public function generate_id_layanan()
    {
        $this->db->select('RIGHT(layanan.id_layanan,3) as id', false);
        $this->db->order_by('id_layanan', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('layanan');
        if ($query->num_rows() > 0) { 
            $data = $query->row();
            $id = intval($data->id) + 1;
        } else {
            $id = 1;
        } 

        $idmax = str_pad($id, 3, "0", STR_PAD_LEFT);
        $idjadi = "L" . $idmax;
        return $idjadi;
    } 



    public function get_all()
{ 
    return $this->db->get('layanan')->result(); // Mengembalikan semua data dalam bentuk array objek
} 
 

public function update_data($data, $table)
{
    $this->db->where('id_layanan', $data['id_layanan']);
    return $this->db->update($table, $data); 
}

public function delete($id)
{
    $this->db->where('id_layanan', $id);
    $this->db->delete('layanan');
}

public function getLayanan($id = null){
        if ($id === null) {
            return $this->db->get('layanan')->result_array(); // result array berfungsi agar data berbentuk array asosiatif
        } else {
            return $this->db->get_where('layanan', ['id_layanan' => $id])->row_array();
        }
}


}
