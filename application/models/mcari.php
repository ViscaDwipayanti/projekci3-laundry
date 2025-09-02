<?php
	class Mcari extends CI_Model
    {
        public function combomember($namafield)
        {
            // Menggunakan Active Record untuk mendapatkan data dari tabel member
            $query = $this->db->get('member');
    
            // Inisialisasi array data dengan pilihan default
            $data = [" " => "--Pilih Member--"];
            $no = 1; 
    
            foreach ($query->result() as $row) {
                $data[$row->id_member] = $no . ". " . $row->nama;
                $no++;
            }
    
            // Mengembalikan dropdown menggunakan form_dropdown
            return form_dropdown($namafield, $data, "", "class='form-control form-custom' id='" . $namafield . "'");
        }

        public function combolayanan($namafield)
        {
            // Menggunakan Active Record untuk mendapatkan data dari tabel member
            $query = $this->db->get('layanan');
    
            // Inisialisasi array data dengan pilihan default
            $data = [" " => "--Pilih Layanan--"];
            $no = 1;
    
            foreach ($query->result() as $row) {
                $data[$row->id_layanan] = $no . ". " . $row->jenis_layanan ." | ".$row->harga." | ".$row->waktu_pengerjaan." ".$row->satuan_waktu;
                $no++;
            }
    
            // Mengembalikan dropdown menggunakan form_dropdown
            return form_dropdown($namafield, $data, "", "class='form-control form-custom' id='" . $namafield . "'");
        }


        





    }
    
?> 