<?php

class pegawai extends CI_Controller{

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
        $data['title']= "Data Pegawai";
        $data['pegawai'] = $this->kepegawaian_model->get_data('data_pegawai')->result();
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/pegawai/data_pegawai',$data);
        $this->load->view('templates_admin/footer');
    
    }

    public function tambah_data()
    {   
        $data['title'] = "Tambah Data pegawai";
        $data['jabatan'] = $this->kepegawaian_model->get_data('data_jabatan')->result();
        $this->load->view('templates_admin/header',$data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/pegawai/form_data_pegawai',$data);
        $this->load->view('templates_admin/footer');
    
    }

    public function tambah_data_aksi()
    {
        $this->_rules();
        if($this->form_validation->run() == FALSE){
            $this->tambah_data();
        }else{
            $nik   = $this->input->post('nik');
            $nama_pegawai       = $this->input->post('nama_pegawai');
            $jenis_kelamin      = $this->input->post('jenis_kelamin');
            $jabatan            = $this->input->post('jabatan');
            $tanggal_masuk      = $this->input->post('tanggal_masuk');
            $status             = $this->input->post('status');
            $hak_akses             = $this->input->post('hak_akses');
            $username             = $this->input->post('username');
            $password             = md5($this->input->post('password'));
            $photo              = $_FILES['photo']['name'];
            if($photo=''){}else{
                $config ['upload_path']     ='./assets/img';
                $config ['allowed_types']   = 'jpg|jpeg|png|svg|tiff';
                $this->load->library('upload',$config);
                if(!$this->upload->do_upload('photo')){
                    echo "Photo Gagal diupload!";
                }else{
                    $photo=$this->upload->data('file_name');
                }
            }
            

            $data = array(
                'nik'           => $nik,
                'nama_pegawai'  => $nama_pegawai,
                'jenis_kelamin' => $jenis_kelamin,
                'jabatan'       => $jabatan,
                'tanggal_masuk' => $tanggal_masuk,
                'status'        => $status,
                'hak_akses'        => $hak_akses,
                'username' => $username,
                'password' => $password,
                'photo'         => $photo,
            );

            $this->kepegawaian_model->insert_data($data, 'data_pegawai');
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil ditambahkan </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('admin/pegawai');
        }

    }

    public function update_data($id)
    {
    $data['title'] = "Update Data Pegawai";
    $data['jabatan'] = $this->kepegawaian_model->get_data('data_jabatan')->result();
    $data['pegawai'] = $this->kepegawaian_model->get_data_where('data_pegawai', 'id_pegawai', $id)->row();

    $this->load->view('templates_admin/header', $data);
    $this->load->view('templates_admin/sidebar');
    $this->load->view('admin/pegawai/form_update_pegawai', $data);
    $this->load->view('templates_admin/footer');
    }

    public function update_data_aksi()
    {
    $this->_rules();
    if ($this->form_validation->run() == FALSE) {
        $id = $this->input->post('id_pegawai');
        $this->update_data($id);
    } else {
        $id = $this->input->post('id_pegawai');
        $nik = $this->input->post('nik');
        $nama_pegawai = $this->input->post('nama_pegawai');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $jabatan = $this->input->post('jabatan');
        $tanggal_masuk = $this->input->post('tanggal_masuk');
        $status = $this->input->post('status');
        $hak_akses = $this->input->post('hak_akses');
        $username             = $this->input->post('username');

        // Proses upload foto (jika ada file baru)
        $photo = $_FILES['photo']['name'];
        if ($photo) {
            $config['upload_path'] = './assets/img';
            $config['allowed_types'] = 'jpg|jpeg|png|svg|tiff';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('photo')) {
                $old_photo = $this->input->post('old_photo'); // Foto lama
                if ($old_photo && file_exists(FCPATH . 'assets/img/' . $old_photo)) {
                    unlink(FCPATH . 'assets/img/' . $old_photo); // Hapus foto lama
                }
                $photo = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengunggah foto: ' . $this->upload->display_errors());
                redirect('admin/pegawai/update_data/' . $id);
            }
        } else {
            $photo = $this->input->post('old_photo'); // Gunakan foto lama jika tidak ada file baru
        }

        $data = array(
            'nik' => $nik,
            'nama_pegawai' => $nama_pegawai,
            'jenis_kelamin' => $jenis_kelamin,
            'jabatan' => $jabatan,
            'tanggal_masuk' => $tanggal_masuk,
            'status' => $status,
            'hak_akses' => $hak_akses,
            'username' => $username,
            'photo' => $photo,

        );

        $where = array('id_pegawai' => $id);

        // Update data ke database
        $this->kepegawaian_model->update_data('data_pegawai', $data, $where);
        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data Berhasil diupdate </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');

        redirect('admin/pegawai');
    }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nik', 'Nik', 'required');
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
    }

    public function delete_data($id)
    {   
        $where = array('id_pegawai'=> $id);

        $pegawai = $this->kepegawaian_model->get_data_where('data_pegawai', 'id_pegawai', $id)->row();
        if ($pegawai->photo && file_exists(FCPATH . 'assets/img/' . $pegawai->photo)) {
            unlink(FCPATH . 'assets/img/' . $pegawai->photo);
        }

        $this->kepegawaian_model->delete_data($where, 'data_pegawai');


        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Berhasil dihapus </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('admin/pegawai');
    }

}

?>