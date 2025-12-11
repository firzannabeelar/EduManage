<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        $this->load->library('session');
    }

    public function index()
    {
        $search = $this->input->get('search');
        $filter = $this->input->get('filter');
    
        // Gunakan fungsi untuk mengambil data admin sesuai pencarian atau filter
        $data['admin'] = $this->M_admin->get_admin($search, $filter);
    
        // Mengirim data admin ke view
        $this->load->view('admin/V_admin', $data);
    }

    public function admin_kepsek()
    {
        $search = $this->input->get('search');
        $filter = $this->input->get('filter');
    
        // Gunakan fungsi untuk mengambil data admin sesuai pencarian atau filter
        $data['admin'] = $this->M_admin->get_admin($search, $filter);
    
        // Mengirim data admin ke view
        $this->load->view('admin/V_admin_kepsek', $data);
    }

    public function edit($id)
    {
        $data['admin'] = $this->M_admin->get_admin_by_id($id);

        if ($data['admin']) {
            $this->load->view('admin/V_edit_admin', $data);
        } else {
            show_404();
        }
    }

    public function edit_kepsek($id)
    {
        $data['admin'] = $this->M_admin->get_admin_by_id($id);

        if ($data['admin']) {
            $this->load->view('admin/V_edit_admin_kepsek', $data);
        } else {
            show_404();
        }
    }

    public function update($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'jabatan' => $this->input->post('jabatan'),
                'telepon' => $this->input->post('telepon')
            ];

            if ($this->M_admin->update_admin($id, $data)) {
                $this->session->set_flashdata('success', 'Data admin berhasil diperbarui.');
                redirect('admin');
            } else {
                $this->session->set_flashdata('error', 'Data admin gagal diperbarui.');
                redirect('admin/edit/' . $id);
            }
        }
    }

    public function update_kepsek($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'jabatan' => $this->input->post('jabatan'),
                'telepon' => $this->input->post('telepon')
            ];

            if ($this->M_admin->update_admin($id, $data)) {
                $this->session->set_flashdata('success', 'Data admin berhasil diperbarui.');
                redirect('admin/admin_kepsek');
            } else {
                $this->session->set_flashdata('error', 'Data admin gagal diperbarui.');
                redirect('admin/edit_kepsek/' . $id);
            }
        }
    }

    public function hapus($id)
    {
        if ($this->M_admin->hapus_admin($id)) {
            $this->session->set_flashdata('success', 'Data admin berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Data admin gagal dihapus.');
        }
        redirect('admin');
    }

    public function tambah()
    {
        // Muat view tambah admin
        $this->load->view('admin/V_tambah_admin');
    }

    public function simpan()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'jabatan' => $this->input->post('jabatan'),
            'telepon' => $this->input->post('telepon')
        ];

        // Simpan data admin ke database
        $this->M_admin->simpan_admin($data);
        redirect('admin');
    }
}
