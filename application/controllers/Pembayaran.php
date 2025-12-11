<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_pembayaran');
        $this->load->model('M_siswa'); // Pastikan model siswa ada
        $this->load->model('M_jurnal');
        $this->load->library('upload');
    }

    public function index() {
        $data['siswa'] = $this->M_siswa->get_all_siswa(); // Ambil semua siswa
        $this->load->view('pembayaran/V_pembayaran_admin', $data);
    }


    public function upload_bukti() {

        $kelas = $this->M_jurnal->get_kelas_by_nisn($this->session->userdata('nisn'));
    
        $data['kelas'] = $kelas; // Pastikan $kelas berisi data valid
        $data['pembayaran'] = $this->M_pembayaran->get_pembayaran_by_siswa($this->session->userdata('nisn'));
        $this->load->view('pembayaran/V_pembayaran_siswa', $data);
    }

    // Proses upload bukti transfer
    public function simpan_bukti() {
        $config['upload_path']   = './uploads/bukti_transfer/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']      = 2048; // 2MB

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('bukti_transfer')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('pembayaran/upload_bukti');
        } else {
            $upload_data = $this->upload->data();
            $data = [
                'siswa_nisn' => $this->session->userdata('nisn'), // Asumsi siswa login
                'bukti_transfer' => $upload_data['file_name'],
                'status' => 'pending'
            ];

            $this->M_pembayaran->simpan_pembayaran($data);
            $this->session->set_flashdata('success', 'Bukti transfer berhasil diupload. Menunggu konfirmasi admin.');
            redirect('pembayaran/upload_bukti');
        }
    }

    public function detail($nisn) {
        $data['siswa'] = $this->M_siswa->get_siswa_by_nisn($nisn); // Mengambil data siswa berdasarkan nisn
        $data['pembayaran'] = $this->M_pembayaran->get_pembayaran_by_siswa($nisn);
        $this->load->view('pembayaran/V_detail_pembayaran_admin', $data);
    }
    
    // Admin mengubah status pembayaran
    public function acc_pembayaran($id) {
        $this->M_pembayaran->update_pembayaran($id, ['status' => 'approved']);
        $this->session->set_flashdata('success', 'Pembayaran telah disetujui.');
        redirect($_SERVER['HTTP_REFERER']); // Kembali ke halaman sebelumnya
    }

    public function tolak_pembayaran($id) {
        $this->M_pembayaran->update_pembayaran($id, ['status' => 'rejected']);
        $this->session->set_flashdata('error', 'Pembayaran telah ditolak.');
        redirect($_SERVER['HTTP_REFERER']); // Kembali ke halaman sebelumnya
    }
}
