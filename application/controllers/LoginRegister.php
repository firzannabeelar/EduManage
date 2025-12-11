<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LoginRegister extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_siswa');
        $this->load->model('M_loginregister');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('V_index');
    }

    // Login Siswa
    public function login_siswa()
    {
        if ($this->input->post()) {
            $nisn = $this->input->post('nisn');
            $password = $this->input->post('password');
            
            // Ambil data login dari model
            $login_data = $this->M_loginregister->login_siswa($nisn, $password);
    
            if ($login_data) {
                // Set session dengan data lengkap
                $this->session->set_userdata([
                    'nisn' => $login_data->nisn,
                    'nama' => $login_data->nama,
                    'nama_kelas' => $login_data->nama_kelas, // nama kelas dari tabel kelas
                    'jurusan' => $login_data->jurusan,       // jurusan dari tabel kelas
                    'tingkat' => $login_data->tingkat
                ]);
                redirect('dashboard/dashboard_siswa');
            } else {
                $this->session->set_flashdata('error', 'NISN atau Password salah');
                redirect('loginregister/login_siswa');
            }
        }
    
        $this->load->view('login/V_login_siswa');
    }
      

    // Register Siswa
    public function register_siswa()
    {
        if ($this->input->post()) {
            // Mendapatkan data kelas dan jurusan dari model
            $data['jurusan'] = $this->M_siswa->get_jurusan();  
            $data['kelas'] = $this->M_siswa->get_kelas();  
    
            // Menyusun data untuk registrasi
            $register_data = array(
                'nisn' => $this->input->post('nisn'),
                'nama' => $this->input->post('nama'),
                'angkatan' => $this->input->post('angkatan'),
                'kelas' => $this->input->post('kelas'),
                'password' => $this->input->post('password')
            );
    
            // Menyimpan data siswa ke database
            $this->M_loginregister->register_siswa($register_data);
    
            // Memberikan pesan sukses
            $this->session->set_flashdata('success', 'Registrasi Berhasil');
            
            // Mengalihkan pengguna ke halaman login
            redirect('loginregister/login_siswa');
        }
    
        // Jika form belum disubmit, load view dengan data kelas dan jurusan
        $data['jurusan'] = $this->M_siswa->get_jurusan();  
        $data['kelas'] = $this->M_siswa->get_kelas(); 
    
        $this->load->view('register/V_register_siswa', $data);
    }
    

    public function login_admin()
    {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            // Cek login data admin
            $login_data = $this->M_loginregister->login_admin($username, $password);
    
            if ($login_data) {
                // Jika login berhasil, set session dan redirect
                $this->session->set_userdata('username', $login_data->username);
                redirect('dashboard');  // Redirect ke dashboard admin
            } else {
                // Jika login gagal, beri pesan error
                $this->session->set_flashdata('error', 'Username atau Password Salah');
                redirect('loginregister/login_admin');
            }
        }
    
        // Jika form belum disubmit, load login view admin
        $this->load->view('login/V_login_admin');
    }


    public function register_admin()
    {
        // Cek apakah form sudah disubmit
        if ($this->input->post()) {
            // Mengambil data kelas dan jurusan (bisa disesuaikan jika perlu)
            // $data['jurusan'] = $this->M_admin->get_jurusan();  // Jika membutuhkan data jurusan, sesuaikan di model
    
            // Menyusun data untuk registrasi admin
            $register_data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nama' => $this->input->post('nama'),
                'jabatan' => $this->input->post('jabatan'),
                'telepon' => $this->input->post('telepon')
            );
    
            // Menyimpan data admin ke database
            $this->M_loginregister->register_admin($register_data);
    
            // Memberikan pesan sukses
            $this->session->set_flashdata('success', 'Registrasi Admin Berhasil');
    
            // Mengalihkan pengguna ke halaman login admin
            redirect('loginregister/login_admin');
        }
    
        // Jika form belum disubmit, load view registrasi admin
        $this->load->view('register/V_register_admin');
    }    
    

    // Login Kepsek
    public function login_kepsek()
    {
        if($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            // Cek login data kepala sekolah
            $login_data = $this->M_loginregister->login_kepsek($username, $password);
    
            if ($login_data) {
                // Jika login berhasil, set session atau lakukan hal lainnya
                $this->session->set_userdata('username', $login_data->username);
                $this->session->set_userdata('role', $login_data->role);  // Simpan role
                redirect('dashboard/dashboard_kepsek');
            } else {
                // Jika login gagal, beri pesan error
                $this->session->set_flashdata('error', 'Username atau Password Salah');
                redirect('loginregister/login_kepsek');
            }
        }
    
        // Jika form belum disubmit, load login view kepala sekolah
        $this->load->view('login/V_login_kepsek');
    }

    // Logout Siswa
    public function logout_siswa()
    {
        $this->session->sess_destroy();
        redirect('loginregister/login_siswa');
    }

    public function set_password_siswa()
    {
        $this->load->model('M_siswa');

        $nisn = $this->input->post('nisn');
        $password = $this->input->post('password');

        // Validasi NISN di database
        $siswa = $this->M_siswa->find_by_nisn($nisn);

        if ($siswa) {
            // Jika siswa ditemukan, update password tanpa hashing
            $this->M_siswa->update_password($nisn, $password);

            // Redirect dengan pesan sukses
            $this->session->set_flashdata('success', 'Password berhasil diatur ulang. Silakan login.');
            redirect('loginregister/login_siswa');
        } else {
            // Jika NISN tidak ditemukan, tampilkan pesan error
            $this->session->set_flashdata('error', 'NISN tidak ditemukan. Silakan coba lagi.');
            redirect('loginregister/register_siswa');
        }
    }

    // Logout Admin
    public function logout_admin()
    {
        $this->session->sess_destroy();
        redirect('loginregister/login_admin');
    }

    // Logout Kepsek
    public function logout_kepsek()
    {
        $this->session->sess_destroy();
        redirect('loginregister/login_kepsek');
    }
}
