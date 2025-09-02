<?php

use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');

use RestServer\libraries\REST_Controller;

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

class Layanan extends RestController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('layanan_model');
    }

    public function index_get()
    {
        $id = $this->get('id'); //ini digunaka sebagai parameter misalnya di postman

        if ($id === null) {
            $layanan = $this->layanan_model->getLayanan();
        } else {
            $layanan = $this->layanan_model->getLayanan($id);
        }

        if ($layanan) { //cek data layanan ada
            $this->response([
                'status' => true,
                'data' => $layanan //jika data ada maka seluruh data ditampilkan
            ], self::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], self::HTTP_NOT_FOUND);
        }
    }

}