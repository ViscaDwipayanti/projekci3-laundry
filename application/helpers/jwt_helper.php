<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php'; 

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

if (!function_exists('verify_jwt')) {
    
    function verify_jwt($key)
    {
        $CI =& get_instance();
        $headers = $CI->input->request_headers();

        if (!isset($headers['Authorization'])) {
            response_unauthorized('Token tidak ditemukan.');
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return $decoded;
        } catch (Exception $e) {
            response_unauthorized('Token tidak valid: ' . $e->getMessage());
        }
    }
}

if (!function_exists('response_unauthorized')) {
    function response_unauthorized($message = 'Unauthorized') {
        $CI =& get_instance();
        $CI->output
            ->set_status_header(401)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode([
                'status' => false,
                'message' => $message
            ]))
            ->_display();
        exit;
    }
}
