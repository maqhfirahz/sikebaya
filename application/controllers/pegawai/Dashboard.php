<?php

class Dashboard extends CI_Controller{

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

        $this->load->model('Absensi_model');

    }
    public function index()
    {
        $id_pegawai = $this->session->userdata('id_pegawai');
        $tanggal = date('Y-m-d');
        $nik = $this->session->userdata('nik');
    
        $data['title'] = 'Dashboard Pegawai';
        $data['sudah_absen'] = $this->Absensi_model->cekAbsensiHariIni($id_pegawai, $tanggal);
        $data['pegawai'] = $this->db->get_where('data_pegawai', ['nik' => $nik])->result();
    
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/dashboard', $data);
        $this->load->view('templates_pegawai/footer');
    }
    

    
}

?>