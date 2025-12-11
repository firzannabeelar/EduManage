    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Jurnal extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('M_jurnal');
            $this->load->model('M_siswa');
        }

        public function index()
        {
            $data['kelas'] = $this->M_jurnal->get_all_kelas();
            $this->load->view('jurnal/V_jurnal', $data);
        }

        public function jurnal_kepsek()
        {
            $data['kelas'] = $this->M_jurnal->get_all_kelas();
            $this->load->view('jurnal/V_jurnal_kepsek', $data);
        }

        public function tambah_kelas()
        {
            $nama_kelas = $this->input->post('nama_kelas');
            $jurusan = $this->input->post('jurusan');
            $tingkat = $this->input->post('tingkat');

            $this->M_jurnal->insert_kelas([
                'nama_kelas' => $nama_kelas,
                'jurusan' => $jurusan,
                'tingkat' => $tingkat,
            ]);

            redirect('jurnal');
        }

        public function tambah_kelas_kepsek()
        {
            // Ambil data dari input form
            $nama_kelas = $this->input->post('nama_kelas');
            $jurusan = $this->input->post('jurusan');
            $tingkat = $this->input->post('tingkat');
        
            // Masukkan data ke dalam database melalui model
            $this->M_jurnal->insert_kelas([
                'nama_kelas' => $nama_kelas,
                'jurusan' => $jurusan,
                'tingkat' => $tingkat,
            ]);
        
            // Ambil data kelas terbaru untuk dikirim ke view
            $data['kelas'] = $this->M_jurnal->get_all_kelas(); // Pastikan ada metode get_all_kelas() di model
        
            // Siapkan data untuk dikirim ke view (misalnya, bisa berupa pesan sukses atau data kelas)
            $data['success_message'] = 'Kelas berhasil ditambahkan!';
        
            // Load view yang menampilkan halaman jurnal untuk kepala sekolah
            $this->load->view('jurnal/V_jurnal_kepsek', $data);
        }

        public function detail($kelas_id)
        {
            $kelas = $this->M_jurnal->get_kelas_by_id($kelas_id);
            $tingkat = $kelas->tingkat;  // Ambil tingkat kelas dari data kelas
            
            // Ambil mata pelajaran yang sudah ditambahkan untuk kelas ini
            $data['mata_pelajaran'] = $this->M_jurnal->get_mata_pelajaran_by_kelas($kelas_id);
            
            // Ambil mata pelajaran yang relevan dengan tingkat kelas tersebut
            $data['all_mata_pelajaran'] = $this->M_jurnal->get_mata_pelajaran_by_tingkat($tingkat);
            
            $data['kelas'] = $kelas;
            $data['siswa'] = $this->M_siswa->get_siswa_by_kelas($kelas_id);

            $this->load->view('jurnal/V_kelas', $data);
        }

        public function detail_kepsek($kelas_id)
        {
            $kelas = $this->M_jurnal->get_kelas_by_id($kelas_id);
            $tingkat = $kelas->tingkat;  // Ambil tingkat kelas dari data kelas
            
            // Ambil mata pelajaran yang sudah ditambahkan untuk kelas ini
            $data['mata_pelajaran'] = $this->M_jurnal->get_mata_pelajaran_by_kelas($kelas_id);
            
            // Ambil mata pelajaran yang relevan dengan tingkat kelas tersebut
            $data['all_mata_pelajaran'] = $this->M_jurnal->get_mata_pelajaran_by_tingkat($tingkat);
            
            $data['kelas'] = $kelas;
            $data['siswa'] = $this->M_siswa->get_siswa_by_kelas($kelas_id);
        
            $this->load->view('jurnal/V_kelas_kepsek', $data);
        }
        

        public function detail_siswa($kelas_id)
        {
            $kelas = $this->M_jurnal->get_kelas_by_id($kelas_id);
            $tingkat = $kelas->tingkat;  // Ambil tingkat kelas dari data kelas
            
            // Ambil mata pelajaran yang sudah ditambahkan untuk kelas ini
            $data['mata_pelajaran'] = $this->M_jurnal->get_mata_pelajaran_by_kelas($kelas_id);
            
            // Ambil mata pelajaran yang relevan dengan tingkat kelas tersebut
            $data['all_mata_pelajaran'] = $this->M_jurnal->get_mata_pelajaran_by_tingkat($tingkat);
            
            $data['kelas'] = $kelas;
            $data['siswa'] = $this->M_siswa->get_siswa_by_kelas($kelas_id);

            $this->load->view('jurnal/V_kelas_siswa', $data);
        }

        public function hapus($id)
        {
            // Panggil fungsi hapus_kelas di model dan cek apakah berhasil
            if ($this->M_jurnal->hapus_kelas($id)) {
                $this->session->set_flashdata('success', 'Kelas berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Kelas gagal dihapus.');
            }

            // Redirect kembali ke halaman jurnal
            redirect('jurnal');
        }

        public function hapus_kepsek($id)
        {
            // Panggil fungsi hapus_kelas di model dan cek apakah berhasil
            if ($this->M_jurnal->hapus_kelas($id)) {
                $this->session->set_flashdata('success', 'Kelas berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Kelas gagal dihapus.');
            }
        
            // Ambil data kelas terbaru untuk dikirimkan ke view
            $data['kelas'] = $this->M_jurnal->get_all_kelas(); // Pastikan fungsi get_all_kelas() ada di model
        
            // Load view yang menampilkan halaman jurnal kepala sekolah dengan data kelas terbaru
            $this->load->view('jurnal/V_jurnal_kepsek', $data);
        }        
        
        public function tambah_mata_pelajaran($kelas_id) {
            $mata_pelajaran_id = $this->input->post('id_mata_pelajaran');
            $this->M_jurnal->add_mata_pelajaran_to_kelas($kelas_id, $mata_pelajaran_id);
            redirect("jurnal/detail_kepsek/$kelas_id");
        }
        
        public function hapus_mata_pelajaran($kelas_id, $mata_pelajaran_id) {
            $this->M_jurnal->remove_mata_pelajaran_from_kelas($kelas_id, $mata_pelajaran_id);
            redirect("jurnal/detail_kepsek/$kelas_id");
        }
    }
