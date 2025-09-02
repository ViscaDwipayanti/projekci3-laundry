<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class member_model extends CI_Model {

    public function generate_id_member()
    {
        $this->db->select('RIGHT(member.id_member,3) as id', false);
        $this->db->order_by('id_member', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('member');
        if($query->num_rows()>0){
            $data = $query->row();
            $id = intval($data->id) + 1;
        }else{
            $id = 1;
        }

        $idmax = str_pad($id,3,"0",STR_PAD_LEFT);
        $idjadi = "M".$idmax;
        return $idjadi;

    }
 
    public function getAllMember()
    {
        return $this->db->get('member')->result();
    }
  
    public function edit($id)  
    {
        $this->db->select('*');
        $this->db->from('member');
        $this->db->where('id_member', $id);
        return $this->db->get()->row_array();
    }

    public function update_data($data, $table)
    {
        $this->db->where('id_member', $data['id_member']);
        return $this->db->update($table, $data); 
    }

    public function delete($id)
    {
        $this->db->where('id_member', $id);
        $this->db->delete('member');
    }

    public function getMember($id = null)
    {
        if ($id === null) {
            return $this->db->get('member')->result_array(); // result array berfungsi agar data berbentuk array asosiatif
        } else {
            return $this->db->get_where('member', ['id_member' => $id])->row_array();
        }
    }

        public function deleteMember($id)
    {
        if (!$id) return 0;

        $this->db->where('id_member', $id);
        $this->db->delete('member');
        return $this->db->affected_rows();
    }
}
