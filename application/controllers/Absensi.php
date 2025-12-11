<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_absensi');
        $this->load->model('M_jurnal'); // Untuk daftar kelas
    }

    // Menampilkan daftar kelas
    public function index() {
        $data['kelas'] = $this->M_jurnal->get_all_kelas();
        $this->load->view('absensi/V_absensi', $data);
    }

    public function absensi_kepsek() {
        $data['kelas'] = $this->M_jurnal->get_all_kelas();
        $this->load->view('absensi/V_absensi_kepsek', $data);
    }

    // Menampilkan daftar tanggal untuk kelas tertentu
    public function tanggal($kelas_id) {
        $data['kelas'] = $this->M_jurnal->get_kelas_by_id($kelas_id);
        $data['kelas_id'] = $kelas_id;
        $data['tanggal'] = $this->M_absensi->get_tanggal_hari_kerja();
        $this->load->view('absensi/V_absensi_tanggal', $data);
    }

    public function tanggal_kepsek($kelas_id) {
        $data['kelas'] = $this->M_jurnal->get_kelas_by_id($kelas_id);
        $data['kelas_id'] = $kelas_id;
        $data['tanggal'] = $this->M_absensi->get_tanggal_hari_kerja();
        $this->load->view('absensi/V_absensi_tanggal_kepsek', $data);
    }

    // Menampilkan tabel siswa dan absensi untuk tanggal tertentu
    public function detail($kelas_id, $tanggal) {
        $data['kelas_id'] = $kelas_id;
        $data['tanggal'] = $tanggal;
        $data['siswa'] = $this->M_absensi->get_siswa_by_kelas($kelas_id, $tanggal);
        $this->load->view('absensi/V_absensi_detail', $data);
    }

    public function detail_kepsek($kelas_id, $tanggal) {
        $data['kelas_id'] = $kelas_id;
        $data['tanggal'] = $tanggal;
        $data['siswa'] = $this->M_absensi->get_siswa_by_kelas($kelas_id, $tanggal);
        $this->load->view('absensi/V_absensi_detail_kepsek', $data);
    }

    // Proses penyimpanan absensi
    public function simpan() {
        $kelas_id = $this->input->post('kelas_id');
        $tanggal = $this->input->post('tanggal');
        $absensi = $this->input->post('absensi'); // Format: [nisn => status]
    
        // Cek apakah data absensi ada
        if (empty($absensi)) {
            log_message('error', 'Data absensi kosong');
            show_error('Data absensi kosong, harap cek kembali formulir yang dikirim!');
        }
    
        log_message('info', 'Data absensi: ' . print_r($absensi, true));
        
        $this->M_absensi->save_absensi($kelas_id, $tanggal, $absensi);
        $this->session->set_flashdata('success', 'Absensi berhasil disimpan!');
        redirect('absensi/tanggal/' . $kelas_id);
    }
    
}
