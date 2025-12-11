<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_loginregister extends CI_Model {

    // Login Siswa
    public function login_siswa($nisn, $password)
    {
        // SELECT dengan JOIN untuk mengambil data siswa beserta jurusan dan nama_kelas
        $this->db->select('siswa.nisn, siswa.nama, siswa.password, kelas.nama_kelas, kelas.jurusan, kelas.tingkat');
        $this->db->from('siswa');
        $this->db->join('kelas', 'siswa.kelas_id = kelas.id'); // JOIN tabel kelas
        $this->db->where('siswa.nisn', $nisn);
    
        $query = $this->db->get();
        $login_data = $query->row();
        
        // Verifikasi password (tanpa password_hash)
        if ($login_data && $password === $login_data->password) {
            return $login_data;
        }
        
        return null;
    }
    

    // Register Siswa
    public function register_siswa($data)
    {
        // Mendaftar siswa baru, pertama masukkan data ke siswa
        $this->db->insert('siswa', $data);
    
        // Kemudian masukkan data login siswa ke login_siswa
        $login_data = [
            'nisn' => $data['nisn'],
            'password' => $data['password']  // Simpan password dalam bentuk biasa
        ];
        $this->db->insert('login_siswa', $login_data);
    }

    public function login_admin($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('admin');
        $login_data = $query->row();
    
        // Verifikasi password (tanpa password_hash)
        if ($login_data && $password === $login_data->password) {
            return $login_data;
        }
    
        return null;
    }

    public function register_admin($data) {
        $this->db->insert('admin', $data);
        return $this->db->insert_id(); // Mengembalikan ID yang baru dimasukkan
    }

    public function get_admin_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('admin');
        return $query->row(); // Mengembalikan data admin
    }

    // Login Kepsek
    public function login_kepsek($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('kepsek');
        $login_data = $query->row();
    
        // Verifikasi password (tanpa password_hash)
        if ($login_data && $password === $login_data->password) {
            return $login_data;
        }
    
        return null;
    }
}
