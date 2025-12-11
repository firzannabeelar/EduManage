<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_siswa extends CI_Model {

    public function get_all_siswa()
    {
        $this->db->select('siswa.*, kelas.nama_kelas, kelas.jurusan, kelas.tingkat');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id = siswa.kelas_id');  // Pastikan menggunakan kelas_id
        return $this->db->get()->result();
    }
    

    public function get_siswa($search = NULL, $filter = NULL)
    {
        // Jika pencarian ada
        if ($search) {
            $this->db->like('nama', $search);
        }
    
        // Jika filter jurusan ada
        if ($filter) {
            $this->db->where('kelas.jurusan', $filter);
        }
    
        // Melakukan join dengan tabel kelas untuk mendapatkan data kelas, jurusan, dan tingkat
        $this->db->select('siswa.*, kelas.nama_kelas, kelas.jurusan, kelas.tingkat');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id = siswa.kelas_id');
    
        return $this->db->get()->result();
    }

    public function get_jumlah_siswa()
    {
        return $this->db->count_all('siswa'); 
    }

    public function get_siswa_by_nisn($nisn)
    {
        return $this->db->get_where('siswa', ['nisn' => $nisn])->row();
    }

    public function get_siswa_by_kelas($kelas_id)
    {
        return $this->db->get_where('siswa', ['kelas_id' => $kelas_id])->result();
    }

    public function update_siswa($nisn, $data)
    {
        $this->db->where('nisn', $nisn);
        return $this->db->update('siswa', $data);
    }

    public function hapus_siswa($nisn)
    {
        return $this->db->delete('siswa', ['nisn' => $nisn]);
    }

    public function simpan_siswa($data)
    {
        $this->db->insert('siswa', $data);
    }

    public function find_by_nisn($nisn)
    {
        // Cari siswa berdasarkan NISN
        return $this->db->get_where('siswa', ['nisn' => $nisn])->row();
    }

    public function update_password($nisn, $password)
    {
        // Update password siswa berdasarkan NISN
        $this->db->where('nisn', $nisn);
        $this->db->update('siswa', ['password' => $password]);
    }    
    
    public function get_jurusan()
    {
        // Ambil jurusan dari tabel kelas
        $this->db->select('jurusan');
        $this->db->distinct();  // Pastikan hanya jurusan unik yang diambil
        return $this->db->get('kelas')->result();  // Mengambil data dari tabel kelas
    }

    public function get_kelas()
    {
        // Mengambil data kelas, tingkat, dan jurusan
        $this->db->select('id, tingkat, jurusan, nama_kelas');
        return $this->db->get('kelas')->result();  // Mengambil data dari tabel kelas
    }

}
