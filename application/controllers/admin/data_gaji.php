<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class data_gaji extends CI_Controller {


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
    {   $data['title'] = "Data gaji";


        if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        }else{
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        }
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;


        $data['potongan'] = $this->kepegawaian_model->get_alpa_potongan();
    
        $data['gaji'] = $this->db->query("
        SELECT data_kehadiran.*, 
               data_pegawai.nik, 
               data_pegawai.nama_pegawai, 
               data_pegawai.jenis_kelamin, 
               data_jabatan.nama_jabatan, 
               data_jabatan.gaji_pokok, 
               data_jabatan.tj_transport, 
               data_jabatan.uang_makan, 
               data_kehadiran.alpha
        FROM data_kehadiran
        INNER JOIN data_pegawai ON data_kehadiran.nik = data_pegawai.nik
        INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
        WHERE data_kehadiran.bulan = '$bulantahun'
        ORDER BY data_pegawai.nama_pegawai ASC
    ")->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/gaji/data_gaji', $data);
		$this->load->view('templates_admin/footer');
        
    
    }

    public function cetak_gaji(){
        $data['title'] = "Cetak Data gaji Pegawai";
        if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        }else{
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        }
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;


        $data['potongan'] = $this->kepegawaian_model->get_alpa_potongan();
    
        $data['gaji'] = $this->db->query("
        SELECT data_kehadiran.*, 
               data_pegawai.nik, 
               data_pegawai.nama_pegawai, 
               data_pegawai.jenis_kelamin, 
               data_jabatan.nama_jabatan, 
               data_jabatan.gaji_pokok, 
               data_jabatan.tj_transport, 
               data_jabatan.uang_makan, 
               data_kehadiran.alpha
        FROM data_kehadiran
        INNER JOIN data_pegawai ON data_kehadiran.nik = data_pegawai.nik
        INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
        WHERE data_kehadiran.bulan = '$bulantahun'
        ORDER BY data_pegawai.nama_pegawai ASC
    ")->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('admin/gaji/cetak_gaji', $data);

    }

    public function slip_gaji()
    {
        $data['title'] = 'Slip Gaji Pegawai';
        $data['pegawai'] = $this->db->get('data_pegawai')->result_array();

        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/gaji/slip_gaji', $data);
        $this->load->view('templates_admin/footer');
    }

    public function cetakSlipGaji()
    {
        $data['title'] = "Cetak Slip Gaji";
    
        // Ambil nilai potongan gaji untuk "Alpha"
        $potongan = $this->kepegawaian_model->get_alpa_potongan();
        if ($potongan) {
            $data['potongan'] = $potongan->jml_potongan; // Ambil nilai jml_potongan
        } else {
            $data['potongan'] = 0; // Default jika data potongan tidak ditemukan
        }
    
        // Ambil input dari form
        $id_pegawai = $this->input->post('pegawai');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
    
        // Validasi input
        if (empty($id_pegawai) || empty($bulan) || empty($tahun)) {
            $this->session->set_flashdata('error', 'Mohon lengkapi semua field.');
            redirect('admin/data_gaji/slip_gaji');
        }
    
        $bulantahun = $bulan . $tahun;
    
        // Kirim bulan dan tahun ke view
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
    
        // Query untuk mendapatkan data slip gaji
        $data['print_slip'] = $this->db->query("
            SELECT 
                data_pegawai.nik, 
                data_pegawai.nama_pegawai,
                data_jabatan.nama_jabatan, 
                data_jabatan.gaji_pokok, 
                data_jabatan.tj_transport, 
                data_jabatan.uang_makan, 
                data_kehadiran.alpha
            FROM data_pegawai
            INNER JOIN data_kehadiran ON data_kehadiran.nik = data_pegawai.nik
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan
            WHERE data_kehadiran.bulan = '$bulantahun' AND 
                  data_pegawai.id_pegawai = '$id_pegawai'
        ")->result();
    
        // Debugging: Cek apakah data ditemukan
        if (empty($data['print_slip'])) {
            $this->session->set_flashdata('error', 'Data slip gaji tidak ditemukan.');
            redirect('admin/data_gaji/slip_gaji');
        }
    
        $this->load->view('templates_admin/header', $data);
        $this->load->view('admin/gaji/cetak_slip_gaji', $data);
    }
}