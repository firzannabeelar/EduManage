<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembayaran extends CI_Model {

    // Simpan data pembayaran (upload bukti transfer)
    public function simpan_pembayaran($data) {
        return $this->db->insert('pembayaran', $data);
    }

    public function get_pembayaran_by_siswa($nisn) {
        $this->db->select('pembayaran.*, siswa.nama AS nama_siswa');
        $this->db->from('pembayaran');
        $this->db->join('siswa', 'pembayaran.siswa_nisn = siswa.nisn');
        $this->db->where('pembayaran.siswa_nisn', $nisn);
        return $this->db->get()->result();
    }
    
    public function get_riwayat_pembayaran($limit = 10) {
        return $this->db->select('p.id, s.nama, p.bukti_transfer, p.status, p.created_at')
                        ->from('pembayaran p')
                        ->join('siswa s', 'p.siswa_nisn = s.nisn')
                        ->order_by('p.created_at', 'DESC')
                        ->limit($limit)
                        ->get()
                        ->result();
    }    

    public function update_pembayaran($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pembayaran', $data);
    }

    // Ambil semua pembayaran (untuk admin)
    public function get_all_pembayaran() {
        $this->db->select('pembayaran.*, siswa.nama AS nama_siswa');
        $this->db->from('pembayaran');
        $this->db->join('siswa', 'pembayaran.siswa_nisn = siswa.nisn');
        return $this->db->get()->result();
    }

    public function get_status_pembayaran($nisn)
    {
        // Ambil status pembayaran terakhir berdasarkan nisn
        $this->db->select('status');
        $this->db->from('pembayaran');
        $this->db->where('siswa_nisn', $nisn);
        $this->db->order_by('created_at', 'DESC'); // Mengurutkan berdasarkan tanggal pembayaran terakhir
        $this->db->limit(1); // Mengambil data pembayaran terakhir
        $query = $this->db->get();
        
        return $query->row(); // Mengembalikan data pembayaran terakhir
    }

    public function get_siswa_lunas() {
        return $this->db->where('status', 'approved') // Status pembayaran lunas
                        ->count_all_results('pembayaran'); // Menghitung jumlah siswa lunas
    }
    
}
