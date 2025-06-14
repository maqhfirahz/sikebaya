<?php

class Absensi extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Absensi_model');
        $this->load->model('Kepegawaian_model');

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
        $data['title'] = "Data Absensi Pegawai";

        $bulan = $this->input->get('bulan') ?? date('m');
        $tahun = $this->input->get('tahun') ?? date('Y');
        $bulantahun = $bulan . $tahun;

        $data['absensi'] = $this->Absensi_model->getAbsensiBulanan($bulantahun);

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/absensi/data_absensi', $data);
        $this->load->view('templates_admin/footer');
    }

    public function input_absensi()
    {
        $data['title'] = "Form Input Absensi";

        $bulan = $this->input->get('bulan') ?? date('m');
        $tahun = $this->input->get('tahun') ?? date('Y');
        $bulantahun = $bulan . $tahun;

        if ($this->input->post('submit', TRUE) == 'submit') {
            $post = $this->input->post();
            $simpan = [];

            foreach ($post['bulan'] as $key => $value){
                if($post['bulan'][$key] !='' || $post['nik'][$key] !='') {
                    $simpan[] = array(
                        'bulan'         => $post['bulan'][$key],
                        'nik'           => $post['nik'][$key],
                        'nama_pegawai'  => $post['nama_pegawai'][$key],
                        'jenis_kelamin' => $post['jenis_kelamin'][$key],
                        'nama_jabatan'  => $post['nama_jabatan'][$key],
                        'hadir'         => $post['hadir'][$key],
                        'sakit'         => $post['sakit'][$key],
                        'alpha'         => $post['alpha'][$key],
                    );
                }
            }

            $this->Absensi_model->simpanAbsensiBulanan($simpan);
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil ditambahkan </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('admin/absensi');
        }

        $data['input_absensi'] = $this->Absensi_model->getPegawaiBelumAbsensi($bulantahun);

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/absensi/form_data_absensi', $data);
        $this->load->view('templates_admin/footer');
    }

    public function laporan_absensi()
    {
        $data['title'] = 'Laporan Absensi Pegawai';
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/absensi/laporan_absensi', $data);
        $this->load->view('templates_admin/footer');
    }

    public function cetaklaporanabsensi()
    {
        $data['title'] = 'Cetak Absensi Pegawai';

        $bulan = $this->input->post('bulan') ?? date('m');
        $tahun = $this->input->post('tahun') ?? date('Y');
        $bulantahun = $bulan . $tahun;

        $data['absensi'] = $this->Absensi_model->getLaporanAbsensi($bulantahun);

        $this->load->view('templates_admin/header', $data);
        $this->load->view('admin/absensi/cetak_absensi', $data);
    }
}
