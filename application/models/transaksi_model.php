<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class transaksi_model extends CI_Model {
    public function generate_id_transaksi()
    {
        $this->db->select('RIGHT(transaksi.id_transaksi,3) as id', false);
        $this->db->order_by('id_transaksi', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('transaksi');
        if ($query->num_rows() > 0) { 
            $data = $query->row();
            $id = intval($data->id) + 1;
        } else {
            $id = 1;
        }

        $idmax = str_pad($id, 3, "0", STR_PAD_LEFT);
        $idjadi = "T" . $idmax;
        return $idjadi;
    }

    public function get_all()
    {
        $query = $this->db->get('transaksi'); // Mengambil semua data transaksi
        $this->db->order_by('id_transaksi', 'DESC');
        return $query->result(); // Mengembalikan hasil query dalam bentuk array objek
        
    }

        public function join_table()
    {
        $this->db->select('transaksi.*, member.nama'); // Pilih data dari transaksi dan nama_member dari tabel member
        $this->db->from('transaksi');
        $this->db->join('member', 'member.id_member = transaksi.member_id_member'); // Join tabel transaksi dan member berdasarkan id_member
        return $this->db->get()->result(); 
    }

    public function get_transaksi_by_id($id) {
        $this->db->select('transaksi.*, member.nama,alamat,no_telepon, layanan.jenis_layanan,harga,waktu_pengerjaan,satuan_waktu');
        $this->db->from('transaksi');
        $this->db->join('member', 'member.id_member = transaksi.member_id_member');
        $this->db->join('layanan', 'layanan.id_layanan = transaksi.layanan_id_layanan');
        $this->db->where('id_transaksi', $id); 
        return $this->db->get()->row();
    }
    
 
    public function tambah_poin_member($id_member, $jumlah_poin) {
        // Update poin pada tabel member
        $this->db->set('poin', 'poin + ' . (int) $jumlah_poin, FALSE);
        $this->db->where('id_member', $id_member);
        $this->db->update('member');
    }

    public function hitung_diskon($id_member) {
        // Ambil poin member
        $this->db->select('poin');
        $this->db->from('member');
        $this->db->where('id_member', $id_member);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $result = $query->row();
            $poin = $result->poin;
    
            // Jika poin 3 atau lebih, berikan diskon dan reset poin
            if ($poin >= 3) {
                
                // Reset poin member
                $this->db->set('poin', 0);
                $this->db->where('id_member', $id_member);
                $this->db->update('member');

                return 0.30; // Diskon 30%
    
                
            }
        }
    
        // Tidak ada diskon
        return 0.00;
    }

    public function update_data($data, $table)
{
    $this->db->where('id_transaksi', $data['id_transaksi']);
    return $this->db->update($table, $data); 
}

    // mengambil id_transaksi untuk cetak invoice
    public function getTransaksiById($id_transaksi)
    {
        $this->db->select('transaksi.*, member.nama, member.alamat, member.no_telepon, layanan.jenis_layanan, layanan.harga, layanan.waktu_pengerjaan, layanan.satuan_waktu');
        $this->db->from('transaksi');
        $this->db->join('member', 'member.id_member = transaksi.member_id_member');
        $this->db->join('layanan', 'layanan.id_layanan = transaksi.layanan_id_layanan');
        $this->db->where('transaksi.id_transaksi', $id_transaksi);
        return $this->db->get()->row();
    }

    
public function getTransaksi($id = null)
{
    $this->db->select('transaksi.*, member.nama, layanan.jenis_layanan'); 
    $this->db->from('transaksi');
    $this->db->join('member', 'transaksi.member_id_member = member.id_member', 'left');
    $this->db->join('layanan', 'layanan.id_layanan = transaksi.layanan_id_layanan');

    if ($id === null) {
        $this->db->order_by('id_transaksi', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    } else {
        $this->db->where('id_transaksi', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
}



    
    public function createTransaksi($data){
        $this->db->insert('transaksi', $data);
        return $this->db->affected_rows();
    }


    public function updateTransaksi($id_transaksi, $data)
    {
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->update('transaksi', $data);
    }


    public function deleteTransaksi($id){
        $this->db->delete('transaksi', ['id_transaksi' => $id]);
        return $this->db->affected_rows();
    } 

    



    
    





    

    
     
}
