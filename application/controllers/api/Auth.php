<?php
use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

// Autoload composer untuk JWT
require_once FCPATH . 'vendor/autoload.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Auth extends RestController
{
    private $key = 'SECRETKEYWASH003723';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');

        if (!$username || !$password) {
            $this->response([
                'status' => false,
                'message' => 'Username dan Password wajib diisi'
            ], 400);
            return;
        }

        // Ambil user dari database
        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if (!$user) {
            $this->response([
                'status' => false,
                'message' => 'Username tidak ditemukan'
            ], 404);
            return;
        }

        if (!password_verify($password, $user['password'])) {
            $this->response([
                'status' => false,
                'message' => 'Password salah'
            ], 401);
            return;
        }

        if ($user['role'] != 'kasir') {
            $this->response([
                'status' => false,
                'message' => 'Role tidak diizinkan mengakses mobile'
            ], 403);
            return;
        }

        // Buat payload token
        $payload = [
            'id_user' => $user['id_user'],
            'username' => $user['username'],
            'role' => $user['role'],
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24) // 24 jam
        ];

        $token = JWT::encode($payload, $this->key, 'HS256');

        $data_user = [
            'id_user' => $user['id_user'],
            'username' => $user['username'],
            'email' => $user['email'],
            'image' => $user['image'], 
            'role' => $user['role']
        ];

        $this->response([
            'status' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'data_user' => $data_user
        ], 200);
    }

    // Tambahkan endpoint ini untuk testing verifikasi token
    public function checkToken_get()
    {
        $headers = $this->input->request_headers();
        if (!isset($headers['Authorization'])) {
            $this->response(['status' => false, 'message' => 'Token tidak ada'], 401);
            return;
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);

        try {
            $decoded = JWT::decode($token, new Key($this->key, 'HS256'));

            $this->response([
                'status' => true,
                'message' => 'Token valid',
                'data' => $decoded
            ], 200);
        } catch (Exception $e) {
            $this->response(['status' => false, 'message' => 'Token tidak valid: ' . $e->getMessage()], 401);
        }
    }
}
