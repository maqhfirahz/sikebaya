<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gantiPassword extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('kepegawaian_model');
        $this->load->library('form_validation');

        // Cek apakah user sudah login
        if (!$this->session->userdata('id_pegawai')) {
            redirect('welcome');
        }
    }

    public function index() {
        $data['title'] = "Ganti Password";
        $this->load->view('templates_admin/header', $data);
        $this->_load_sidebar(); // ✅ Memuat sidebar sesuai hak akses
        $this->load->view('formGantiPassword', $data);
        $this->load->view('templates_admin/footer');
    }

    public function gantiPasswordAksi() {
        $passBaru   = $this->input->post('passBaru');
        $ulangPass  = $this->input->post('ulangPass');

        // Validasi form
        $this->form_validation->set_rules('passBaru', 'Password Baru', 'required|matches[ulangPass]');
        $this->form_validation->set_rules('ulangPass', 'Ulangi Password', 'required');

        if ($this->form_validation->run() != FALSE) {
            $data = array('password' => md5($passBaru));
            $id   = array('id_pegawai' => $this->session->userdata('id_pegawai'));

            // Update password di database
            $this->kepegawaian_model->update_data('data_pegawai', $data, $id);

            // Flash message
            $this->session->set_flashdata('pesan', 
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Password berhasil diganti!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );

            redirect('welcome');
        } else {
            // Jika validasi gagal
            $data['title'] = "Ganti Password";
            $this->load->view('templates_admin/header', $data);
            $this->_load_sidebar(); // ✅ Pastikan sidebar sesuai hak akses
            $this->load->view('formGantiPassword', $data);
            $this->load->view('templates_admin/footer');
        }
    }

    // ✅ Fungsi bantu untuk memuat sidebar sesuai hak akses
    private function _load_sidebar() {
        $hak_akses = $this->session->userdata('hak_akses');
        if ($hak_akses == 1) {
            $this->load->view('templates_admin/sidebar');
        } elseif ($hak_akses == 2) {
            $this->load->view('templates_pegawai/sidebar');
        }
    }
}
?>
