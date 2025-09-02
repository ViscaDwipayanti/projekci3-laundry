<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan_model extends CI_Model {
    public function getLaporan($tanggal_awal, $tanggal_akhir) {
        $tanggal_akhir_plus_satu = date('Y-m-d', strtotime($tanggal_akhir . ' +1 day'));
        // Join tabel transaksi dengan tabel member
        $this->db->select('transaksi.id_transaksi, transaksi.tanggal_transaksi, transaksi.total, member.nama');
        $this->db->from('transaksi');
        $this->db->join('member', 'transaksi.member_id_member = member.id_member', 'inner'); // Join ke tabel member
        $this->db->where('transaksi.tanggal_transaksi >=', $tanggal_awal);
        $this->db->where('transaksi.tanggal_transaksi <', $tanggal_akhir_plus_satu);
        $query = $this->db->get();

        return $query->result_array();
}

// mengambil id_transaksi untuk cetak invoice
public function getdatalaporan($tanggal_awal, $tanggal_akhir)
{
    $tanggal_akhir_plus_satu = date('Y-m-d', strtotime($tanggal_akhir . ' +1 day'));

    $this->db->select('transaksi.*, member.nama, layanan.jenis_layanan, layanan.harga');
    $this->db->from('transaksi');
    $this->db->join('member', 'member.id_member = transaksi.member_id_member');
    $this->db->join('layanan', 'layanan.id_layanan = transaksi.layanan_id_layanan');
    $this->db->where('transaksi.tanggal_transaksi >=', $tanggal_awal);
    $this->db->where('transaksi.tanggal_transaksi <', $tanggal_akhir_plus_satu);
    $query = $this->db->get();
    log_message('debug', $this->db->last_query());

    return $query->result_array();


}




}