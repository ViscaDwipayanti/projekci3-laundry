<?php
class Dashboard_model extends CI_Model {

    public function get_jumlah_transaksi_baru() {
        $sql = "SELECT COUNT(*) AS jumlah
                FROM transaksi
                WHERE status_transaksi = 'Baru'
                AND DATE(tanggal_transaksi) = CURDATE()";
        
        // Menjalankan query
        $query = $this->db->query($sql);
        
        // Mengembalikan hasil
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah;
        } else {
            return 0;
        }
    }
    public function get_jumlah_member() {
        $sql = "SELECT COUNT(*) AS jumlah
                FROM member";
        
        // Menjalankan query
        $query = $this->db->query($sql);
        
        // Mengembalikan hasil
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah;
        } else {
            return 0;
        }
    }
    public function get_jumlah_tenggat_pengambilan() {
        $sql = "SELECT COUNT(*) AS jumlah
                FROM transaksi
                WHERE status_transaksi != 'diambil'
                AND DATE(tanggal_ambil) = CURDATE()";
        
        // Menjalankan query
        $query = $this->db->query($sql);
        
        // Mengembalikan hasil
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah;
        } else {
            return 0;
        }
    }

    public function get_total_pendapatan_perbulan() {
        $sql = "SELECT SUM(total) AS pendapatan
                FROM transaksi
                WHERE MONTH(tanggal_transaksi) = MONTH(CURDATE()) 
                AND YEAR(tanggal_transaksi) = YEAR(CURDATE())"; 
    
        // Menjalankan query
        $query = $this->db->query($sql);
    
        // Mengembalikan hasil 
        if ($query->num_rows() > 0) {
            return $query->row()->pendapatan;
        } else {
            return 0;
        }
    }
    public function get_total_pendapatan_perhari($username) {
        $sql = "SELECT SUM(total) AS pendapatan
                FROM transaksi
                JOIN user 
                ON transaksi.user_id_user = user.id_user
                WHERE DATE(tanggal_transaksi) = CURDATE()
                AND user.username = ?"; 
    
        // Menjalankan query dengan mengikat parameter
        $query = $this->db->query($sql, array($username));
    
        // Mengembalikan hasil 
        if ($query->num_rows() > 0) {
            return $query->row()->pendapatan;
        } else {
            return 0;
        }
    }
    
    
    

    function get_pendapatan() {
        $this->db->select('YEAR(tanggal_transaksi) AS tahun, MONTH(tanggal_transaksi) AS bulan, WEEK(tanggal_transaksi) AS minggu, SUM(total) AS pendapatan');
        $this->db->from('transaksi');
        $this->db->group_by('YEAR(tanggal_transaksi), MONTH(tanggal_transaksi), WEEK(tanggal_transaksi)');
        $this->db->order_by('YEAR(tanggal_transaksi), MONTH(tanggal_transaksi), WEEK(tanggal_transaksi)');
        return $this->db->get()->result_array();
    }
    
    

    public function join_table()
    {
        $sql = "SELECT transaksi.*, member.nama
                FROM transaksi
                JOIN member 
                ON transaksi.member_id_member = member.id_member
                WHERE status_transaksi != 'diambil'
                AND DATE(tanggal_ambil) = CURDATE()"; 

        // $sql = "SELECT transaksi.*, member.nama
        // FROM transaksi
        // JOIN member 
        // ON transaksi.member_id_member = member.id_member
        // ORDER BY transaksi.tanggal_transaksi DESC";

    
        // Menjalankan query dan mengembalikan hasilnya
        $query = $this->db->query($sql);
        return $query->result();  // Mengembalikan hasil dalam bentuk array objek
    }
    
    

    
    
}
?>
