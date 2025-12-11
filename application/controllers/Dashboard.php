<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load model siswa, jurnal, dan admin
        $this->load->model('M_siswa');
        $this->load->model('M_jurnal'); 
        $this->load->model('M_admin'); 
        $this->load->model('M_pembayaran'); 
        $this->load->model('M_absensi'); 

        // Load session library jika belum diload
        $this->load->library('session');
    }

    // Dashboard Admin
    public function index()
    {
        // Ambil data jumlah admin, siswa, dan kelas
        $data['jumlah_admin'] = $this->M_admin->get_jumlah_admin();
        $data['jumlah_siswa'] = $this->M_siswa->get_jumlah_siswa();
        $data['jumlah_kelas'] = $this->M_jurnal->get_jumlah_kelas();
        $data['kehadiran_hari_ini'] = $this->M_absensi->get_kehadiran_hari_ini(); // Fungsi model untuk kehadiran hari ini
        $data['jumlah_siswa_lunas'] = $this->M_pembayaran->get_siswa_lunas(); // Fungsi model untuk siswa lunas

        // Load view dashboard admin dengan data
        $this->load->view('dashboard/V_dashboard', $data);
    }

    // Dashboard Siswa
    public function dashboard_siswa()
    {
        $nisn = $this->session->userdata('nisn');  // Mengambil NISN dari session
    
        // Ambil status pembayaran dari model M_pembayaran
        $this->load->model('M_pembayaran');
        $status_pembayaran = $this->M_pembayaran->get_status_pembayaran($nisn);
    
        // Tentukan status pembayaran berdasarkan hasil query
        if ($status_pembayaran) {
            if ($status_pembayaran->status === 'approved') {
                $status_pembayaran = 'Lunas';
            } elseif ($status_pembayaran->status === 'pending' || $status_pembayaran->status === 'rejected') {
                $status_pembayaran = 'Belum Lunas';
            }
        } else {
            $status_pembayaran = 'Belum Lunas';  // Default jika tidak ada data pembayaran
        }
    
        // Ambil data absensi bulan ini
        $this->load->model('M_absensi');
        $absensi = $this->M_absensi->get_absensi_bulanan($nisn);
    
        // Ambil data kelas berdasarkan NISN
        $this->load->model('M_jurnal');
        $kelas = $this->M_jurnal->get_kelas_by_nisn($nisn);
    
        // Data untuk view
        $data['status_pembayaran'] = $status_pembayaran;
        $data['absensi'] = $absensi;
        $data['jurnal_terbaru'] = [
            'materi' => 'Pengenalan Algoritma',
            'tanggal' => date('Y-m-d'),
        ];
        $data['kelas'] = $kelas; // Tambahkan data kelas ke view
    
        // Load view dashboard siswa dengan datas
        $this->load->view('dashboard/V_dashboard_siswa', $data);
    }

    public function dashboard_kepsek()
    {
        // Ambil data jumlah admin, siswa, dan kelas
        $data['jumlah_admin'] = $this->M_admin->get_jumlah_admin();
        $data['jumlah_siswa'] = $this->M_siswa->get_jumlah_siswa();
        $data['jumlah_kelas'] = $this->M_jurnal->get_jumlah_kelas();
        $data['kehadiran_hari_ini'] = $this->M_absensi->get_kehadiran_hari_ini(); // Fungsi model untuk kehadiran hari ini
        $data['jumlah_siswa_lunas'] = $this->M_pembayaran->get_siswa_lunas(); // Fungsi model untuk siswa lunas

        $data['riwayat_pembayaran'] = $this->M_pembayaran->get_riwayat_pembayaran(10);
        
        $this->load->view('dashboard/V_dashboard_kepsek', $data);
    }
    
}
