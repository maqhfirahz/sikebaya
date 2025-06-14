<?php
class Cuti_model extends CI_Model {

    // Fungsi untuk menambahkan data cuti
    public function tambah_cuti($data)
    {
        $this->db->insert('data_cuti', $data);
        return $this->db->insert_id();
    }

    // Fungsi untuk mendapatkan semua data cuti
    public function get_all_cuti()
    {
        return $this->db->get('data_cuti')->result();
    }

    // Fungsi untuk mendapatkan data cuti berdasarkan ID
    public function get_cuti_by_id($id_cuti)
    {
        return $this->db->get_where('data_cuti', ['id_cuti' => $id_cuti])->row();
    }

    // Fungsi untuk memperbarui status cuti
    public function update_status_cuti($id_cuti, $status)
    {
        $this->db->where('id_cuti', $id_cuti);
        $this->db->update('data_cuti', ['status' => $status]);
    }

    // Fungsi untuk mendapatkan data pegawai berdasarkan ID
    public function get_pegawai_by_id($id_pegawai)
    {
        return $this->db->get_where('data_pegawai', ['id_pegawai' => $id_pegawai])->row();
    }

    public function get_cuti_by_pegawai($id_pegawai)
    {
        return $this->db->get_where('data_cuti', ['id_pegawai' => $id_pegawai])->result();
    }
}
?>