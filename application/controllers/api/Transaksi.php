<?php

use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');



class Transaksi extends RestController {

    private $key = 'SECRETKEYWASH003723';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('layanan_model', 'layanan');
        $this->load->model('member_model', 'member');
        $this->load->model('transaksi_model', 'transaksi');
        $this->load->model('dashboard_model', 'dashboard');
        $this->load->helper('jwt_helper');

        $this->decoded_token = verify_jwt($this->key);
    }

    public function index_get()
    {
        $id = $this->get('id'); 

        if ($id === null) {
            $transaksi = $this->transaksi->getTransaksi();
        } else {
            $transaksi = $this->transaksi->getTransaksi($id);
        }

        if ($transaksi) { //cek data transaksi ada
            $this->response([
                'status' => true,
                'data' => $transaksi //jika data ada maka seluruh data ditampilkan
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Id tidak ditemukan'
            ], self::HTTP_NOT_FOUND);
        }
    }

    //Menghitung tanggal ambil
    public function hitungTanggalAmbil($tanggal_transaksi, $waktu_pengerjaan, $satuan_waktu)
    {

        $datetime = new DateTime($tanggal_transaksi);

        if(strtolower($satuan_waktu) === 'hari') {
            $datetime->modify("+{$waktu_pengerjaan} days");
        } elseif(strtolower($satuan_waktu) === 'jam') {
            $datetime->modify("+{$waktu_pengerjaan} hours");
        } else {
            throw new Exception("Satuan waktu tidak valid. Gunakan 'hari' atau 'jam'.");
        }

        return $datetime->format('Y-m-d H:i:s');
    } 

 //Membuat No Invoice acak
    function buatnoinvoice() 
    {
        $kata = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
        $tahun = date('Y');
        $bulan = date('m');
        $nomoracak = substr(str_shuffle($kata), 0, 4);	
        $noTransaksi = "EZW-" . $tahun . $bulan . "-" . $nomoracak;
        return $noTransaksi;
    }

    //Post Function
    public function index_post() {
        $tanggal_transaksi = date('Y-m-d H:i:s');
        $id_layanan = $this->post('id_layanan');
        $id_member = $this->post('id_member');
        $berat = floatval($this->post('berat'));
        
        // validasi layanan
        $layanan = $this->db->get_where('layanan', ['id_layanan' => $id_layanan])->row_array();

        if (!$layanan) {
            return $this->response([
                'status' => false,
                'message' => 'Layanan tidak ditemukan'
            ], self::HTTP_BAD_REQUEST);
        }

        //Hitung tanggal ambil
        $waktu_pengerjaan = $layanan['waktu_pengerjaan'];
        $satuan_waktu = $layanan['satuan_waktu'];
        $tanggal_ambil = $this->hitungTanggalAmbil($tanggal_transaksi, $waktu_pengerjaan, $satuan_waktu);

        //Hitung diskon
        $diskon = $this->transaksi->hitung_diskon($id_member);
        
        //Hitung total
        $total_awal = $layanan['harga'] * $berat;
        $total_akhir = $total_awal - ($total_awal * $diskon);

        // Data transaksi
        $data = [
            'id_transaksi' => $this->transaksi->generate_id_transaksi(),
            'user_id_user' => $this->decoded_token->id_user,  // ambil dari token
            'no_invoice' => $this->buatnoinvoice(),
            'tanggal_transaksi' => $tanggal_transaksi,
            'tanggal_ambil' => $tanggal_ambil,
            'member_id_member' => $id_member,
            'diskon' => $diskon,
            'layanan_id_layanan' => $id_layanan,
            'berat' => $berat,
            'metode_pembayaran' => $this->post('metode_pembayaran'),
            'jumlah_item' => intval($this->post('jumlah_item')),
            'status_transaksi' => $this->post('status_transaksi') ?: 'Baru',
            'total' => $total_akhir
        ];

        if($this->transaksi->createTransaksi($data) > 0) {
            // Tambahkan poin member
            $this->transaksi->tambah_poin_member($id_member, 1);

            return $this->response([
                'status' => true, 
                'message' => 'Transaksi berhasil disimpan'
            ], self::HTTP_OK);
        } else {
            return $this->response(
                ['status' => false, 
                'message' => 'Gagal menyimpan transaksi'], 
                self::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id_transaksi = $this->put('id');
        if (!$id_transaksi) {
            return $this->response([
                'status' => false,
                'message' => 'ID transaksi wajib diisi'
            ], self::HTTP_BAD_REQUEST);
        }

        $transaksi_lama = $this->transaksi->getTransaksi($id_transaksi);
        if (!$transaksi_lama) {
            return $this->response([
                'status' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], self::HTTP_NOT_FOUND);
        }

        $status_transaksi_baru = $this->put('status_transaksi');
        if (!$status_transaksi_baru) {
            return $this->response([
                'status' => false,
                'message' => 'Status transaksi wajib diisi'
            ], self::HTTP_BAD_REQUEST);
        }

        $status_valid = ['Baru', 'Diproses', 'Selesai', 'Diambil'];
        if (!in_array($status_transaksi_baru, $status_valid)) {
            return $this->response([
                'status' => false,
                'message' => 'Status transaksi tidak valid'
            ], self::HTTP_BAD_REQUEST);
        }

        $data = [
            'status_transaksi' => $status_transaksi_baru
        ];

        if ($this->transaksi->updateTransaksi($id_transaksi, $data) > 0) {
            return $this->response([
                'status' => true,
                'message' => 'Status transaksi berhasil diupdate'
            ], self::HTTP_OK);
        } else {
            return $this->response([
                'status' => false,
                'message' => 'Tidak ada perubahan data atau gagal update'
            ], self::HTTP_BAD_REQUEST);
        }
    }


    public function index_delete()
    {
        $id_transaksi = $this->delete('id');
        if (!$id_transaksi) {
            return $this->response([
                'status' => false,
                'message' => 'ID transaksi wajib diisi'
            ], self::HTTP_BAD_REQUEST);
        }

        if ($this->transaksi->deleteTransaksi($id_transaksi) > 0) {
            return $this->response([
                'status' => true,
                'message' => 'Transaksi berhasil dihapus'
            ], self::HTTP_OK);
        } else {
            return $this->response([
                'status' => false,
                'message' => 'Transaksi tidak ditemukan atau gagal menghapus'
            ], self::HTTP_NOT_FOUND);
        }
    }

    public function priority_get()
{
    $transaksi = $this->dashboard->join_table(); 

    if ($transaksi) {
        $this->response([
            'status' => true,
            'data' => $transaksi
        ], self::HTTP_OK);
    } else {
        $this->response([
            'status' => false,
            'message' => 'Tidak ada transaksi prioritas'
        ], self::HTTP_NOT_FOUND);
    }
}



    
}
