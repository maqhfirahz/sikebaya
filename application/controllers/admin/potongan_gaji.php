<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Potongan_gaji extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
 
    
        if ($this->session->userdata('hak_akses') != 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda Belum Login</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('welcome');
        }
        $this->load->model('Gaji_model');
    }

    public function index() {
        $data['title'] = 'Setting Potongan Gaji';
        $data['pot_gaji'] = $this->Gaji_model->getAllPotonganGaji();

        $this->form_validation->set_rules('potongan', 'Jenis Potongan', 'required|trim');
        $this->form_validation->set_rules('jml', 'Jumlah Potongan', 'required|trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar', $data);
            $this->load->view('admin/gaji/potongan_gaji', $data);
            $this->load->view('templates_admin/footer');
        } else {
            $this->Gaji_model->tambahDataPotonganGaji();
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil ditambah </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            redirect('admin/potongan_gaji');
        }
    }

    public function getpotongan() {
        $id = $this->input->post('id', true);
        echo json_encode($this->Gaji_model->getPotonganById($id));
    }

    
    public function update_data($id)
    {
        // Ambil data potongan gaji berdasarkan ID
        $data['potongan'] = $this->Gaji_model->getPotonganById($id);
        $data['title'] = "Update Potongan Gaji";
    
        // Validasi apakah data ditemukan
        if (!$data['potongan']) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Data tidak ditemukan!
            </div>');
            redirect('admin/potongan_gaji');
        }
    
        // Load view untuk halaman update
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/gaji/update_potongan_gaji', $data);
        $this->load->view('templates_admin/footer');
    }

    public function update_data_aksi()
    {
        // Aturan validasi
        $this->form_validation->set_rules('potongan', 'Jenis Potongan', 'required|trim');
        $this->form_validation->set_rules('jml_potongan', 'Jumlah Potongan', 'required|trim|numeric');
    
        // Jalankan validasi
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Periksa kembali input Anda!
            </div>');
            redirect('admin/potongan_gaji/update_data/' . $this->input->post('id_poga'));
        } else {
            // Ambil data dari form
            $id = $this->input->post('id_poga');
            $potongan = $this->input->post('potongan');
            $jml_potongan = $this->input->post('jml_potongan');
    
            // Siapkan data untuk update
            $data = [
                'potongan' => $potongan,
                'jml_potongan' => $jml_potongan,
            ];
    
            // Update data di database
            $this->Gaji_model->ubahDataPotonganGaji($data, ['id_poga' => $id]);
    
            // Set pesan sukses
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil diperbaharui </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('admin/potongan_gaji');
        }
    }

    public function hapus($id) {
        $this->db->delete('potongan_gaji', ['id_poga' => $id]);
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Berhasil dihapus</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>');
        redirect('admin/potongan_gaji');
    }

    
}
