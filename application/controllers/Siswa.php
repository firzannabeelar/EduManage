<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_siswa');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index()
    {    
        $search = $this->input->get('search');
        $filter = $this->input->get('filter');
    
        // Gunakan hanya satu fungsi untuk mengambil data siswa
        $data['siswa'] = $this->M_siswa->get_siswa($search, $filter);
    
        // Mengirim data siswa ke view
        $this->load->view('siswa/V_siswa', $data);
    }

    public function siswa_kepsek()
    {    
        $search = $this->input->get('search');
        $filter = $this->input->get('filter');
    
        // Gunakan hanya satu fungsi untuk mengambil data siswa
        $data['siswa'] = $this->M_siswa->get_siswa($search, $filter);
    
        // Mengirim data siswa ke view
        $this->load->view('siswa/V_siswa_kepsek', $data);
    }


    public function edit($nisn)
    {
        $data['siswa'] = $this->M_siswa->get_siswa_by_nisn($nisn);
        $data['kelas'] = $this->M_siswa->get_kelas();
        
        if ($data['siswa']) {
            $this->load->view('siswa/V_edit_siswa', $data);
        } else {
            show_404();
        }
    }

    public function edit_kepsek($nisn)
    {
        $data['siswa'] = $this->M_siswa->get_siswa_by_nisn($nisn);
        $data['kelas'] = $this->M_siswa->get_kelas();
        
        if ($data['siswa']) {
            $this->load->view('siswa/V_edit_siswa_kepsek', $data);
        } else {
            show_404();
        }
    }
    

    public function update($nisn)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->edit($nisn);
        } else {    
            $data = [
                'nama' => $this->input->post('nama'),
                'angkatan' => $this->input->post('angkatan'),
                'kelas_id' => $this->input->post('kelas_id'),
            ];
    
            if ($this->M_siswa->update_siswa($nisn, $data)) {
                $this->session->set_flashdata('success', 'Data siswa berhasil diperbarui.');
                redirect('siswa');
            } else {
                $this->session->set_flashdata('error', 'Data siswa gagal diperbarui.');
                redirect('siswa/edit/' . $nisn);
            }
        }
    }    

    public function update_kepsek($nisn)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->edit($nisn);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'angkatan' => $this->input->post('angkatan'),
                'kelas_id' => $this->input->post('kelas_id'),
            ];
    
            if ($this->M_siswa->update_siswa($nisn, $data)) {
                $this->session->set_flashdata('success', 'Data siswa berhasil diperbarui.');
                redirect('siswa/siswa_kepsek');
            } else {
                $this->session->set_flashdata('error', 'Data siswa gagal diperbarui.');
                redirect('siswa/edit_kepsek/' . $nisn);
            }
        }
    }    

    public function hapus($nisn)
    {
        // Cek apakah data siswa dengan NISN yang diberikan ada
        $this->db->where('nisn', $nisn);
        $siswa = $this->db->get('siswa')->row();
    
        if ($siswa) {
            // Hapus data siswa
            $this->db->where('nisn', $nisn);
            $this->db->delete('siswa');
    
            // Cek apakah penghapusan berhasil
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data siswa berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data siswa.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data siswa tidak ditemukan.');
        }
    
        // Redirect kembali ke halaman daftar siswa
        redirect('siswa');
    }

    public function hapus_kepsek($nisn)
    {
        // Cek apakah data siswa dengan NISN yang diberikan ada
        $this->db->where('nisn', $nisn);
        $siswa = $this->db->get('siswa')->row();
    
        if ($siswa) {
            // Hapus data siswa
            $this->db->where('nisn', $nisn);
            $this->db->delete('siswa');
    
            // Cek apakah penghapusan berhasil
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data siswa berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data siswa.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data siswa tidak ditemukan.');
        }
    
        // Ambil data siswa terbaru setelah penghapusan
        $this->db->select('nisn, nama, angkatan, kelas_id'); // Tentukan kolom yang ingin ditampilkan
        $data['siswa'] = $this->db->get('siswa')->result();
    
        // Kirim data siswa ke view V_siswa_kepsek
        redirect('siswa_kepsek');
    }    

    public function tambah()
    {
        // Ambil data jurusan dan kelas
        $data['jurusan'] = $this->M_siswa->get_jurusan();  
        $data['kelas'] = $this->M_siswa->get_kelas();      
    
        // Muat view tambah siswa
        $this->load->view('siswa/V_tambah_siswa', $data);
    }

    public function tambah_kepsek()
    {
        // Ambil data jurusan dan kelas
        $data['jurusan'] = $this->M_siswa->get_jurusan();  
        $data['kelas'] = $this->M_siswa->get_kelas();      
    
        // Muat view tambah siswa
        $this->load->view('siswa/V_tambah_siswa_kepsek', $data);
    }
    
    public function simpan()
    {
        // Ambil data dari form
        $data = array(
            'nisn' => $this->input->post('nisn'),
            'nama' => $this->input->post('nama'),
            'angkatan' => $this->input->post('angkatan'),
            'kelas_id' => $this->input->post('kelas'),  // ID kelas dipilih di dropdown
        );
    
        // Simpan data siswa ke database
        $this->M_siswa->simpan_siswa($data);
        redirect('siswa');
    }

    public function simpan_kepsek()
    {
        // Ambil data dari form
        $data = array(
            'nisn' => $this->input->post('nisn'),
            'nama' => $this->input->post('nama'),
            'angkatan' => $this->input->post('angkatan'),
            'kelas_id' => $this->input->post('kelas'),  // ID kelas dipilih di dropdown
        );
    
        // Simpan data siswa ke database
        $this->M_siswa->simpan_siswa($data);
        redirect('siswa/siswa_kepsek');
    }
    

}

