<?php

class Gaji extends CI_Controller{

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

        
    }
    public function index()
    { 
        $data['title'] = "Data Gaji";
        $nik = $this->session->userdata('nik');
        $data['potongan'] = $this->kepegawaian_model->get_alpa_potongan();
        $data['gaji'] = $this->db->query("SELECT data_pegawai
            .nama_pegawai, data_pegawai.nik, data_jabatan.
            gaji_pokok, data_jabatan.tj_transport, data_jabatan.
            uang_makan, data_kehadiran.alpha, data_kehadiran.bulan
            , data_kehadiran.id_kehadiran
            FROM data_pegawai
            INNER JOIN data_kehadiran ON data_kehadiran.nik =
            data_pegawai.nik
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan
            = data_pegawai.jabatan
            WHERE data_kehadiran.nik = '$nik'
            ORDER BY data_kehadiran.bulan DESC")->result();
    
        $this->load->view('templates_pegawai/header',$data);
        $this->load->view('templates_pegawai/sidebar');
        $this->load->view('pegawai/gaji',$data);
        $this->load->view('templates_pegawai/footer');
    
    }

    public function cetakSlip($id)
    {
        $data['title'] = "Cetak Slip Gaji";
    
        // Ambil nilai potongan gaji untuk "Alpha"
        $data['potongan'] = $this->kepegawaian_model->get_alpa_potongan()->jml_potongan;
    
        // Query untuk mendapatkan data slip gaji
        $query = $this->db->query("
            SELECT 
                data_pegawai.nik, 
                data_pegawai.nama_pegawai,
                data_jabatan.nama_jabatan, 
                data_jabatan.gaji_pokok, 
                data_jabatan.tj_transport, 
                data_jabatan.uang_makan, 
                data_kehadiran.alpha, 
                data_kehadiran.bulan
            FROM data_pegawai
            INNER JOIN data_kehadiran ON data_kehadiran.nik = data_pegawai.nik
            INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan
            WHERE data_kehadiran.id_kehadiran = '$id'
        ");
    
        $result = $query->row(); // Ambil satu baris data
    
        if ($result) {
            // Ekstrak bulan dan tahun dari kolom 'bulan'
            $bulantahun = $result->bulan; // Misalnya, format: "012023" (Januari 2023)
            $bulan = date("F", mktime(0, 0, 0, substr($bulantahun, 0, 2), 1)); // Konversi ke nama bulan
            $tahun = substr($bulantahun, 2); // Ambil tahun
    
            // Kirim data ke view
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['print_slip'] = [$result]; // Masukkan hasil query ke array agar bisa di-loop di view
        } else {
            $data['print_slip'] = []; // Kosongkan jika data tidak ditemukan
        }
    
        $this->load->view('templates_pegawai/header', $data);
        $this->load->view('pegawai/cetakSlipGaji', $data);
    }


}

?>