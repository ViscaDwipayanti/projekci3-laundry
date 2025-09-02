<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->model('mvalidasi'); 
        $this->load->model('mcari');
        $this->load->library('form_validation');


        $this->mvalidasi->validasiakun();
        
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', [  
            'username' => $this->session->userdata('username')
        ])->row_array();


        $part['user'] = $data['user'];
        $part['content'] ='transaksi/transaksi_view';
        $part['title'] = 'Data Transaksi';
        $part['data'] = $this->transaksi_model->get_all();  
        $part['data'] = $this->transaksi_model->join_table();
    
        $this->load->view('dashboard', $part);

 

    }

    // menambahkan data
    public function add()
    {
         $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();


        $part['user'] = $data['user'];
        $part['content'] = 'transaksi/transaksi_add';
        $part['title'] = 'Form Tambah Transaksi';
        $part['id_transaksi'] = $this->transaksi_model->generate_id_transaksi();
        
        $this->load->view('dashboard',$part);
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


//Save dan cetak
public function save()
{
    $tanggal_transaksi = $this->input->post('tanggal_transaksi');
    $id_layanan = $this->input->post('id_layanan');

    $layanan = $this->db->get_where('layanan', ['id_layanan' => $id_layanan])->row_array();
    $waktu_pengerjaan = $layanan['waktu_pengerjaan'];
    $satuan_waktu = $layanan['satuan_waktu'];

    $tanggal_ambil = $this->hitungTanggalAmbil($tanggal_transaksi, $waktu_pengerjaan, $satuan_waktu);

    $id_transaksi = $this->input->post('id_transaksi');

    // Data dari form
    $data = array(
        'id_transaksi' => $id_transaksi, 
        'user_id_user' => $this->session->userdata('id_user'),
        'no_invoice' => $this->buatnoinvoice(),
        'tanggal_transaksi' => $tanggal_transaksi,
        'tanggal_ambil' => $tanggal_ambil,
        'member_id_member' => $this->input->post('id_member'),
        'diskon' => $this->input->post('diskon'), 
        'layanan_id_layanan' => $this->input->post('id_layanan'),
        'berat' => $this->input->post('berat') ?: 0, 
        'metode_pembayaran' => $this->input->post('metode_pembayaran'),
        'jumlah_item' => $this->input->post('jumlah_item') ?: 0, 
        'status_transaksi' => $this->input->post('status_transaksi') ?: 'Baru',
        'total' => floatval(str_replace('.', '', $this->input->post('total'))) ?: 0                          
    );

    // Simpan data ke database
    if ($this->db->insert('transaksi', $data)) {
        $id_member = $this->input->post('id_member');
        if ($id_member) { 
            $diskon = $this->transaksi_model->hitung_diskon($id_member);
            if ($diskon > 0) {
                $data_update = ['diskon' => $diskon];
                $this->db->update('transaksi', $data_update, ['id_transaksi' => $id_transaksi]);
            }
            $this->transaksi_model->tambah_poin_member($id_member, 1);
        }


        $this->cetaknota($id_transaksi);
        $this->session->set_flashdata('message', 'Data berhasil disimpan'); 
        
    } else {
        $this->session->set_flashdata('message', 'Data gagal disimpan');
    }

    redirect('transaksi');

}



    

        

    function cetaknota($id_transaksi, $filename = 'Struk Pembayaran', $paper = [70, 300], $orientation = 'portrait') {

        $data = $this->transaksi_model->getTransaksiById($id_transaksi);
    
        if ($data) {
            
            $data = [
                'id_transaksi' => $data->id_transaksi,
                'no_invoice' => $data->no_invoice,
                'tanggal_transaksi' => $data->tanggal_transaksi,
                'tanggal_ambil' => $data->tanggal_ambil,
                'nama' => $data->nama,
                'alamat' => $data->alamat,
                'no_telepon' => $data->no_telepon,
                'jenis_layanan' => $data->jenis_layanan,
                'harga' => $data->harga,
                'berat' => $data->berat,
                'jumlah_item' => $data->jumlah_item,
                'diskon' => $data->diskon,
                'total' => $data->total,
                
            ];
    
            
            require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
            $pdf = new Dompdf\Dompdf();
    
            
            $customPaper = [0, 0, $paper[0] * 2.83465, $paper[1] * 2.83465];
            $pdf->setPaper($customPaper, $orientation);
    
           
            $pdf->set_option('isRemoteEnabled', TRUE);
            $pdf->set_option('isHtml5ParserEnabled', true);
            $pdf->set_option('isPhpEnabled', true);
            $pdf->set_option('isFontSubsettingEnabled', true);
    
            $pdf->loadHtml($this->load->view('transaksi/cetaknota_pdf', $data, true));
    
            $pdf->render();
            $pdf->stream($filename, ["Attachment" => 0]);
    
        } else {
            show_404();
        }
    }

    



        


        public function get_diskon()
    {
        $id_member = $this->input->post('id_member');
        if ($id_member) {
            $diskon = $this->transaksi_model->hitung_diskon($id_member);
            echo json_encode(['diskon' => $diskon]);
        } else {
            echo json_encode(['diskon' => 0]);
        }
    }



    //mengambil harga layanan untuk dihitung 
    public function getHargaLayanan() {
        header('Content-Type: application/json');
        $id_layanan = $this->input->post('id_layanan'); // Ambil ID dari POST
        $query = $this->db->get_where('layanan', ['id_layanan' => $id_layanan]);
        $result = $query->row_array();
        $harga = isset($result['harga']) ? $result['harga'] : 0;
        echo json_encode(['harga' => $harga]);
    }



    public function detail($id) {
        // Data user yang sedang login
        $data['user'] = $this->db->get_where('user', [
            'username' => $this->session->userdata('username')
        ])->row_array();
    
        // Ambil data transaksi berdasarkan ID
        $transaksi = $this->transaksi_model->get_transaksi_by_id($id);
    
        // Hitung tanggal ambil
        if ($transaksi) {
            $tanggal_transaksi = $transaksi->tanggal_transaksi;
            $waktu_pengerjaan = $transaksi->waktu_pengerjaan;
            $satuan_waktu = $transaksi->satuan_waktu;
    
            $tanggal_ambil = $this->hitungTanggalAmbil($tanggal_transaksi, $waktu_pengerjaan, $satuan_waktu);
        } else {
            $tanggal_ambil = null; // Jika transaksi tidak ditemukan
        }
    
        $part['user'] = $data['user'];
        $part['content'] = 'transaksi/transaksi_detail';
        $part['title'] = 'Detail Transaksi';
        $part['data'] = $transaksi;
        $part['tanggal_ambil'] = $tanggal_ambil;
    
        $this->load->view('dashboard', $part);
    }
    

    public function edit_status_transaksi($id){
        $data = array( 
            'id_transaksi' => $id,
            'status_transaksi' => $this->input->post('status_transaksi')
        );
     
        $query = $this->transaksi_model->update_data($data, 'transaksi');
        if ($query) {
            $this->session->set_flashdata('message', 'Data berhasil diubah!');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data gagal diubah!
                </div>');
        }
        redirect('transaksi');
    }


    public function cetak_detail($id_transaksi){
        $this->cetaknota($id_transaksi);
    }
    

    
            

    



    
}


