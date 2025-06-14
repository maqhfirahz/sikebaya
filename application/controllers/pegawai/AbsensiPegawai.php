<?php
class AbsensiPegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Absensi_model');
        $this->load->model('kepegawaian_model'); // Optional, kalau butuh data pegawai lain
        if ($this->session->userdata('hak_akses') != '2') {
            redirect('login');
        }
    }

    public function index()
    {
        $id_pegawai = $this->session->userdata('id_pegawai');
        $tanggal = date('Y-m-d');

        $data['title'] = 'Absensi Hari Ini';
        $data['sudah_absen'] = $this->Absensi_model->cekAbsensiHariIni($id_pegawai, $tanggal);

        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('pegawai/absensi', $data);
        $this->load->view('templates_pegawai/footer');
    }

    public function simpan()
    {
        $id_pegawai = $this->session->userdata('id_pegawai');
        $nik = $this->session->userdata('nik');
        $tanggal = date('Y-m-d');
        $bulan = date('mY');
        $status = $this->input->post('status');

        $cek = $this->Absensi_model->cekAbsensiHariIni($id_pegawai, $tanggal);
        if ($cek) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning">Anda sudah absen hari ini.</div>');
        } else {
            $this->Absensi_model->simpanAbsensi([
                'id_pegawai' => $id_pegawai,
                'tanggal' => $tanggal,
                'status' => $status
            ]);
            $this->Absensi_model->updateRekapKehadiran($nik, $bulan);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Absensi berhasil disimpan.</div>');
        }

        redirect('pegawai/dashboard');
    }
}
