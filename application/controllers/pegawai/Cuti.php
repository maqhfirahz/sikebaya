<?php
class Cuti extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('hak_akses') != 2) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda Belum Login</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('welcome');
        }
        $this->load->model('Cuti_model');
    }

    // Halaman pengajuan cuti
    public function ajukan()
    {
        $data['title'] = "Ajukan Cuti";

        $this->form_validation->set_rules('jenis_cuti', 'Jenis Cuti', 'required');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates_pegawai/header', $data);
            $this->load->view('templates_pegawai/sidebar');
            $this->load->view('pegawai/ajukan', $data);
            $this->load->view('templates_pegawai/footer');
        } else {
            $data = [
                'id_pegawai' => $this->session->userdata('id_pegawai'),
                'jenis_cuti' => $this->input->post('jenis_cuti'),
                'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                'tanggal_selesai' => $this->input->post('tanggal_selesai'),
                'keterangan' => $this->input->post('keterangan')
            ];

            $this->Cuti_model->tambah_cuti($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Pengajuan cuti berhasil dikirim!</div>');
            redirect('pegawai/cuti/histori');
        }
    }

    public function histori()
    {
        $data['title'] = "Histori Pengajuan Cuti";

        // Ambil ID pegawai dari session
        $id_pegawai = $this->session->userdata('id_pegawai');

        // Ambil data cuti berdasarkan ID pegawai
        $data['cuti'] = $this->Cuti_model->get_cuti_by_pegawai($id_pegawai);

        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/cuti_histori', $data);
        $this->load->view('templates_pegawai/footer');
    }

    public function delete_data($id)
    {   
        $where = array('id_cuti'=> $id);

        $pegawai = $this->kepegawaian_model->get_data_where('data_cuti', 'id_cuti', $id)->row();

        $this->kepegawaian_model->delete_data($where, 'data_cuti');


        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Berhasil dihapus </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('pegawai/cuti/histori');
    }

}
?>