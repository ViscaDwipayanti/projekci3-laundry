<?php
use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends RestController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('member_model', 'member');
    }

    public function index_get()
    {
        $id = $this->get('id'); //ini digunaka sebagai parameter misalnya di postman

        if ($id === null) {
            $member = $this->member->getMember();
        } else {
            $member = $this->member->getMember($id);
        }

        if ($member) { //cek data member ada
            $this->response([
                'status' => true,
                'data' => $member //jika data ada maka seluruh data ditampilkan
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], self::HTTP_NOT_FOUND);
        }
    }  

     public function index_delete()
    {
        $id = $this->delete('id_member');

        if (!$id) {
            return $this->response([
                'status' => false,
                'message' => 'ID member wajib diisi'
            ], 400); // Bad Request
        }

        if ($this->member->deleteMember($id) > 0) {
            return $this->response([
                'status' => true,
                'message' => 'Member berhasil dihapus'
            ], 200); // OK
        } else {
            return $this->response([
                'status' => false,
                'message' => 'Member tidak ditemukan atau gagal menghapus'
            ], 404); // Not Found
        }
}



 public function index_post()
{
    $id_member = $this->post('id_member');
    $nama = $this->post('nama');
    $alamat = $this->post('alamat');
    $no_telepon = $this->post('no_telepon');

    // Validasi input
    if (!$id_member || !$nama || !$alamat || !$no_telepon) {
        return $this->response([
            'status' => false,
            'message' => 'Semua field wajib diisi: id_member, nama, alamat, no_telepon'
        ], self::HTTP_BAD_REQUEST);
    }

    // Cek apakah member sudah ada
    $existing = $this->db->get_where('member', ['id_member' => $id_member])->row_array();
    if ($existing) {
        return $this->response([
            'status' => false,
            'message' => 'ID Member sudah terdaftar'
        ], self::HTTP_NOT_MODIFIED); // karena tidak bisa pakai 409
    }

    // Data baru
    $data = [
        'id_member' => $id_member,
        'nama' => $nama,
        'alamat' => $alamat,
        'no_telepon' => $no_telepon,
        'poin' => 0
    ];

    if ($this->db->insert('member', $data)) {
        return $this->response([
            'status' => true,
            'message' => 'Member berhasil ditambahkan',
            'data' => $data
        ], self::HTTP_CREATED);
    } else {
        return $this->response([
            'status' => false,
            'message' => 'Gagal menambahkan member'
        ], self::HTTP_INTERNAL_ERROR);
    }
}

public function index_put()
{
    $id_member = $this->put('id_member');
    if (!$id_member) {
        return $this->response([
            'status' => false,
            'message' => 'ID member wajib diisi'
        ], self::HTTP_BAD_REQUEST);
    }

    // Cek apakah member ada
    $member_lama = $this->db->get_where('member', ['id_member' => $id_member])->row_array();
    if (!$member_lama) {
        return $this->response([
            'status' => false,
            'message' => 'Member tidak ditemukan'
        ], self::HTTP_NOT_FOUND);
    }

    // Ambil data baru
    $nama = $this->put('nama');
    $alamat = $this->put('alamat');
    $no_telepon = $this->put('no_telepon');

    if (!$nama || !$alamat || !$no_telepon) {
        return $this->response([
            'status' => false,
            'message' => 'Field nama, alamat, dan no_telepon wajib diisi'
        ], self::HTTP_BAD_REQUEST);
    }

    $data = [
        'nama' => $nama,
        'alamat' => $alamat,
        'no_telepon' => $no_telepon
    ];

    // Proses update
    $this->db->where('id_member', $id_member);
    if ($this->db->update('member', $data)) {
        return $this->response([
            'status' => true,
            'message' => 'Data member berhasil diupdate'
        ], self::HTTP_OK);
    } else {
        return $this->response([
            'status' => false,
            'message' => 'Tidak ada perubahan data atau gagal update'
        ], self::HTTP_BAD_REQUEST);
    }
}




}

?>