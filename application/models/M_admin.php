<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

    public function get_all_admin()
    {
        // Mengambil semua data admin
        $this->db->select('id, username, nama, jabatan, telepon');
        $this->db->from('admin');
        return $this->db->get()->result();
    }

    public function get_admin($search = NULL, $filter = NULL)
    {
        // Jika pencarian nama admin ada
        if ($search) {
            $this->db->like('nama', $search);
        }

        // Melakukan query untuk mengambil data admin
        $this->db->select('id, username, nama, jabatan, telepon');
        $this->db->from('admin');

        // Jika filter jurusan ada
        if ($filter) {
            $this->db->where('jurusan', $filter); // Replace 'jurusan' if it's not a column in your table
        }

        return $this->db->get()->result();
    }

    public function get_admin_by_id($id)
    {
        return $this->db->get_where('admin', ['id' => $id])->row();
    }

    public function update_admin($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('admin', $data);
    }

    public function hapus_admin($id)
    {
        return $this->db->delete('admin', ['id' => $id]);
    }

    public function simpan_admin($data)
    {
        $this->db->insert('admin', $data);
    }

    public function get_jumlah_admin()
    {
        return $this->db->count_all('admin');  
    }
}
