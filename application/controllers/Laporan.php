<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('laporan_model');
        $this->load->model('mvalidasi');
        $this->mvalidasi->validasiakun();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [ 
            'username' => $this->session->userdata('username')
        ])->row_array(); 

        // Data default untuk view
        $part['user'] = $data['user'];
        $part['content'] = 'laporan/laporan'; // View utama
        $part['laporan'] = []; 

        $this->load->view('dashboard', $part);
    }

    public function cari()
    {
        $data['user'] = $this->db->get_where('user', [ 
            'username' => $this->session->userdata('username')
        ])->row_array();

        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');

        if ($tanggal_awal && $tanggal_akhir) {
            $laporan = $this->laporan_model->getLaporan($tanggal_awal, $tanggal_akhir);
        } else {
            $laporan = [];
        }

        $part['user'] = $data['user'];
        $part['content'] = 'laporan/laporan'; 
        $part['laporan'] = $laporan; 
        $part['tanggal_awal'] = $tanggal_awal;
        $part['tanggal_akhir'] = $tanggal_akhir;

        $this->load->view('dashboard', $part);
    }

    public function cetaklaporan() {
        $tanggal_awal = $this->input->get('tanggal_awal');
        $tanggal_akhir = $this->input->get('tanggal_akhir');
    
        if (!$tanggal_awal || !$tanggal_akhir) {
            show_error('Tanggal awal dan akhir wajib diisi.', 400);
        }
    
        $data = $this->laporan_model->getdatalaporan($tanggal_awal, $tanggal_akhir);
        
        if (is_array($data) || is_object($data)) {
            foreach ($data as $row) {
                $formattedData[] = [
                    'tanggal_transaksi' => isset($row->tanggal_transaksi) ? $row->tanggal_transaksi : '', 
                    'id_transaksi' => isset($row->id_transaksi) ? $row->id_transaksi : '',
                    'tanggal_ambil' => isset($row->tanggal_ambil) ? $row->tanggal_ambil : '',
                    'nama' => isset($row->nama) ? $row->nama : '',
                    'jenis_layanan' => isset($row->jenis_layanan) ? $row->jenis_layanan : '',
                    'harga' => isset($row->harga) ? $row->harga : '',
                    'berat' => isset($row->berat) ? $row->berat : '',
                    'total' => isset($row->total) ? $row->total : ''
                ];
            }
        } else {
            log_message('debug', 'Data bukan array atau objek');
        }
        
        require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
        $pdf = new Dompdf\Dompdf();
        $pdf->setPaper('A4', 'landscape');
        $pdf->set_option('isRemoteEnabled', true);
    
        $html = $this->load->view('laporan/cetaklaporan_pdf', [
            'data' => $data,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ], true);
        
        $pdf->loadHtml($html);
        $pdf->render();
        $pdf->stream('Laporan Transaksi', ['Attachment' => false]);
    }
    
    
    

}
