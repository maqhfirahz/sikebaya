<?php

class Dashboard extends CI_Controller {

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

        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $total = $this->Dashboard_model->get_total_data();
        $data = array_merge($data, $total);

        $statistik = $this->Dashboard_model->get_progress_statistik();
        $total = $statistik->hadir + $statistik->sakit + $statistik->alpha;

        $data['statistik'] = $statistik;
        $data['hadir_percent'] = $total ? round($statistik->hadir / $total * 100) : 0;
        $data['sakit_percent'] = $total ? round($statistik->sakit / $total * 100) : 0;
        $data['alpha_percent'] = $total ? round($statistik->alpha / $total * 100) : 0;

        $data['chart_pegawai_per_jabatan'] = $this->Dashboard_model->get_chart_pegawai_per_jabatan();
        $data['chart_alpha_per_bulan'] = $this->Dashboard_model->get_chart_alpha_per_bulan();
        $data['chart_jenis_kelamin'] = $this->Dashboard_model->get_chart_jenis_kelamin();

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates_admin/footer');
    }
}
