<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jurnal extends CI_Model {

    public function get_all_kelas()
    {
        return $this->db->select('kelas.id, kelas.tingkat, kelas.jurusan, kelas.nama_kelas')
                        ->from('kelas')
                        ->get()
                        ->result();
    }

    public function insert_kelas($data)
    {
        return $this->db->insert('kelas', $data);
    }

    public function get_kelas_by_id($id)
    {
        return $this->db->get_where('kelas', ['id' => $id])->row();
    }

    public function get_kelas_by_nisn($nisn)
    {
        return $this->db->select('kelas.id, kelas.nama_kelas')
                        ->from('siswa')
                        ->join('kelas', 'siswa.kelas_id = kelas.id')
                        ->where('siswa.nisn', $nisn)
                        ->get()
                        ->row();
    }

    public function get_siswa_by_kelas($id)
    {
        return $this->db->get_where('siswa', ['kelas_id' => $id])->result();
    }

    public function get_jumlah_kelas()
    {
        return $this->db->count_all('kelas');  
    }

    public function hapus_kelas($id)
    {
        return $this->db->delete('kelas', ['id' => $id]);
    }

    public function get_mata_pelajaran_by_kelas($kelas_id)
    {
        // Ambil mata pelajaran yang terhubung dengan kelas menggunakan relasi kelas_mata_pelajaran
        return $this->db->select('mata_pelajaran.id_mata_pelajaran, mata_pelajaran.nama_mata_pelajaran')
                        ->from('kelas_mata_pelajaran')
                        ->join('mata_pelajaran', 'kelas_mata_pelajaran.mata_pelajaran_id = mata_pelajaran.id_mata_pelajaran')
                        ->where('kelas_mata_pelajaran.kelas_id', $kelas_id)
                        ->get()
                        ->result();
    }

    public function get_mata_pelajaran_by_tingkat($tingkat)
    {
        return $this->db->select('id_mata_pelajaran, nama_mata_pelajaran')
                        ->from('mata_pelajaran')
                        ->where('tingkat', $tingkat)
                        ->get()
                        ->result();
    }

    public function add_mata_pelajaran_to_kelas($kelas_id, $mata_pelajaran_id)
    {
        // Masukkan relasi antara kelas dan mata pelajaran ke kelas_mata_pelajaran
        return $this->db->insert('kelas_mata_pelajaran', [
            'kelas_id' => $kelas_id,
            'mata_pelajaran_id' => $mata_pelajaran_id
        ]);
    }

    public function remove_mata_pelajaran_from_kelas($kelas_id, $mata_pelajaran_id)
    {
        // Hapus relasi antara kelas dan mata pelajaran dari kelas_mata_pelajaran
        return $this->db->delete('kelas_mata_pelajaran', [
            'kelas_id' => $kelas_id,
            'mata_pelajaran_id' => $mata_pelajaran_id
        ]);
    }

    public function get_all_mata_pelajaran()
    {
        return $this->db->get('mata_pelajaran')->result();
    }
}
