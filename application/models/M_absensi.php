<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_absensi extends CI_Model {

    // Mengambil tanggal hari kerja (Senin-Jumat)
    public function get_tanggal_hari_kerja() {
        $hari_ini = date('Y-m-d');
        $hari_kerja = [];
        for ($i = 0; $i < 30; $i++) { // 30 hari ke depan
            $tanggal = date('Y-m-d', strtotime("+$i day", strtotime($hari_ini)));
            $hari = date('N', strtotime($tanggal)); // 1 = Senin, 5 = Jumat
            if ($hari >= 1 && $hari <= 5) {
                $hari_kerja[] = $tanggal;
            }
        }
        return $hari_kerja;
    }

    // Mengambil siswa berdasarkan kelas
    public function get_siswa_by_kelas($kelas_id, $tanggal) {
        $this->db->select('siswa.nisn, siswa.nama, absensi.status');
        $this->db->from('siswa');
        $this->db->join('absensi', 'siswa.nisn = absensi.siswa_nisn AND absensi.tanggal = "' . $tanggal . '"', 'left');
        $this->db->where('siswa.kelas_id', $kelas_id);
        return $this->db->get()->result();
    }

    // Menyimpan data absensi
    public function save_absensi($kelas_id, $tanggal, $absensi) {
        foreach ($absensi as $nisn => $status) {
            $data = [
                'siswa_nisn' => $nisn,
                'kelas_id' => $kelas_id,
                'tanggal' => $tanggal,
                'status' => $status
            ];
            
            $this->db->replace('absensi', $data);
    
            // Cek apakah query berhasil
            if ($this->db->affected_rows() > 0) {
                log_message('info', 'Absensi berhasil disimpan untuk NISN: ' . $nisn);
            } else {
                log_message('error', 'Gagal menyimpan absensi untuk NISN: ' . $nisn);
            }
        }
    }

    public function get_absensi_bulanan($nisn)
    {
        $bulan = date('m');
        $tahun = date('Y');

        // Mengambil data absensi berdasarkan nisn dan bulan tahun
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->from('absensi');
        $this->db->where('siswa_nisn', $nisn); // Ganti dengan kolom yang benar
        $this->db->where('MONTH(tanggal)', date('m')); // Bulan ini
        $this->db->where('YEAR(tanggal)', date('Y')); // Tahun ini
        $this->db->group_by('status');
        $query = $this->db->get();
        
        $absensi = [];
        foreach ($query->result() as $row) {
            $absensi[$row->status] = $row->jumlah;
        }
        
        return [
            'hadir' => isset($absensi['hadir']) ? $absensi['hadir'] : 0,
            'izin' => isset($absensi['izin']) ? $absensi['izin'] : 0,
            'alpha' => isset($absensi['alpha']) ? $absensi['alpha'] : 0,
        ];
    }
    
    public function get_kehadiran_hari_ini() {
        $tanggal_hari_ini = date('Y-m-d'); // Mendapatkan tanggal hari ini
        return $this->db->where('tanggal', $tanggal_hari_ini)
                        ->where('status', 'hadir') 
                        ->count_all_results('absensi'); // Menghitung jumlah hasil
    }
    
}
 