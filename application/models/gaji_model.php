<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gaji_model extends CI_Model {

    // Join data pegawai, jabatan, dan kehadiran berdasarkan bulan
    public function joinJabatanPGajiPegawai($bulanTahun)
    {
        $this->db->select('data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, 
                           data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, 
                           data_jabatan.uang_makan, data_kehadiran.alpha');
        $this->db->from('data_pegawai');
        $this->db->join('data_kehadiran', 'data_kehadiran.nik = data_pegawai.nik');
        $this->db->join('data_jabatan', 'data_jabatan.id_jabatan = data_pegawai.jabatan');
        $this->db->where('data_kehadiran.bulan', $bulanTahun);
        $this->db->order_by('data_pegawai.nama_pegawai', 'asc');
        return $this->db->get()->result_array();
    }

    // Get data pegawai berdasarkan nama dan bulan
    public function getJabatanPegawaiWhereName($bulanTahun, $pegawai)
    {
        $this->db->select('*');
        $this->db->from('data_kehadiran');
        $this->db->join('data_jabatan', 'data_jabatan.id_jabatan = data_kehadiran.jabatan');
        $this->db->join('data_pegawai', 'data_pegawai.nik = data_kehadiran.nik');
        $this->db->where('data_kehadiran.bulan', $bulanTahun);
        $this->db->where('data_pegawai.nik', $pegawai);
        return $this->db->get()->row_array();
    }

    // Ambil data pegawai yang terhubung dengan jabatan dan kehadiran
    public function getJoinPegawaiJabatan()
    {
        $this->db->select('data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, 
                           data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, 
                           data_jabatan.uang_makan, data_kehadiran.alpha, data_kehadiran.bulan, data_kehadiran.id_kehadiran'); // Diganti dari alpa ke alpha
        $this->db->from('data_pegawai');
        $this->db->join('user', 'user.id_user = data_pegawai.id_pegawai');
        $this->db->join('data_kehadiran', 'data_kehadiran.nik = data_pegawai.nik');
        $this->db->join('data_jabatan', 'data_jabatan.nama_jabatan = data_pegawai.jabatan');
        $this->db->where('user.id_user', $this->session->userdata('id_user'));
        $this->db->order_by('data_kehadiran.bulan', 'desc');
        return $this->db->get()->result_array();
    }

    // Ambil data pegawai berdasarkan ID kehadiran untuk cetak gaji
    public function getCetakJoinPegawaiJabatan($idKehadiran)
    {
        $this->db->select('data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, 
                           data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, 
                           data_jabatan.uang_makan, data_kehadiran.alpha, data_kehadiran.bulan, data_kehadiran.id_kehadiran'); // Diganti dari alpa ke alpha
        $this->db->from('data_pegawai');
        $this->db->join('user', 'user.id_user = data_pegawai.id_pegawai');
        $this->db->join('data_kehadiran', 'data_kehadiran.nik = data_pegawai.nik');
        $this->db->join('data_jabatan', 'data_jabatan.id_jabatan = data_pegawai.jabatan');
        $this->db->where('data_kehadiran.id_kehadiran', $idKehadiran);
        return $this->db->get();
    }

    public function getAllPotonganGaji()
    {
        return $this->db->get('potongan_gaji')->result_array();
    }


    // Ambil data potongan gaji berdasarkan ID
    public function getPotonganById($id)
    {
        return $this->db->get_where('potongan_gaji', ['id_poga' => $id])->row_array();
    }

    // Tambah data potongan gaji
    public function tambahDataPotonganGaji()
    {
        $data = [
            'potongan' => html_escape($this->input->post('potongan', true)),
            'jml_potongan' => html_escape($this->input->post('jml', true))
        ];

        $this->db->insert('potongan_gaji', $data);
    }

    // Ubah data potongan gaji
    public function ubahDataPotonganGaji($data, $where)
    {
        $this->db->where($where);
        $this->db->update('potongan_gaji', $data);

        // Debugging: Cek apakah query berhasil
        if ($this->db->affected_rows() > 0) {
            return true; // Berhasil
        } else {
            return false; // Gagal
        }
    }



}