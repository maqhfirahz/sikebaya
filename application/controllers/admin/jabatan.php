<?php

class Jabatan extends CI_Controller
{
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
    }

    public function index()
    {
        $data['title'] = "Data Jabatan";
        $data['jabatan'] = $this->kepegawaian_model->get_data('data_jabatan')->result();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/jabatan/data_jabatan', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_data()
    {
        $data['title'] = "Tambah Data Jabatan";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/jabatan/tambah_data_jabatan', $data);
        $this->load->view('templates_admin/footer');
    }

    public function tambah_data_aksi()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->tambah_data();
        } else {
            $data = array(
                'nama_jabatan' => $this->input->post('nama_jabatan'),
                'gaji_pokok' => $this->input->post('gaji_pokok'),
                'tj_transport' => $this->input->post('tj_transport'),
                'uang_makan' => $this->input->post('uang_makan'),
            );

            $this->kepegawaian_model->insert_data($data, 'data_jabatan');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil ditambahkan</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('admin/jabatan');
        }
    }

    public function update_data($id)
    {
        $where = array('id_jabatan' => $id);
        $data['jabatan'] = $this->db->query("SELECT * FROM data_jabatan WHERE id_jabatan='$id'")->result();
        $data['title'] = "Update Data Jabatan";
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/jabatan/update_data_jabatan', $data);
        $this->load->view('templates_admin/footer');
    }

    public function update_data_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update_data($this->input->post('id_jabatan'));
        } else {
            $data = array(
                'nama_jabatan' => $this->input->post('nama_jabatan'),
                'gaji_pokok' => $this->input->post('gaji_pokok'),
                'tj_transport' => $this->input->post('tj_transport'),
                'uang_makan' => $this->input->post('uang_makan'),
            );

            $where = array(
                'id_jabatan' => $this->input->post('id_jabatan')
            );

            $this->kepegawaian_model->update_data('data_jabatan', $data, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil diupdate</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('admin/jabatan');
        }
    }

    public function delete_data($id)
    {
        $where = array('id_jabatan' => $id);
        $this->kepegawaian_model->delete_data($where, 'data_jabatan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil dihapus</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('admin/jabatan');
    }

    public function _rules()
    {
        if ($this->input->post('id_jabatan')) {
            // Update: gunakan callback agar nama tidak duplikat dengan jabatan lain
            $this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'required|callback_nama_jabatan_check');
        } else {
            // Tambah: cek duplikat dari semua data
            $this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'required|is_unique[data_jabatan.nama_jabatan]');
        }

        $this->form_validation->set_rules('gaji_pokok', 'gaji pokok', 'required');
        $this->form_validation->set_rules('tj_transport', 'tunjangan transport', 'required');
        $this->form_validation->set_rules('uang_makan', 'uang makan', 'required');
    }

    public function nama_jabatan_check($str)
    {
        $id = $this->input->post('id_jabatan');
        $this->db->where('nama_jabatan', $str);
        $this->db->where('id_jabatan !=', $id);
        $query = $this->db->get('data_jabatan');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('nama_jabatan_check', 'Nama jabatan sudah digunakan');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
