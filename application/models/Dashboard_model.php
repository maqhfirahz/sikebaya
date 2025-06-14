<?php

class Dashboard_model extends CI_Model
{
    public function get_total_data()
    {
        return [
            'pegawai'   => $this->db->get('data_pegawai')->num_rows(),
            'admin'     => $this->db->where('jabatan', 'Admin')->get('data_pegawai')->num_rows(),
            'jabatan'   => $this->db->get('data_jabatan')->num_rows(),
            'kehadiran' => $this->db->get('data_kehadiran')->num_rows()
        ];
    }

    public function get_progress_statistik()
    {
        return $this->db->select('SUM(hadir) as hadir, SUM(sakit) as sakit, SUM(alpha) as alpha')
                        ->get('data_kehadiran')
                        ->row();
    }

    public function get_chart_pegawai_per_jabatan()
    {
        return $this->db->select('jabatan, COUNT(*) as jumlah')
                        ->group_by('jabatan')
                        ->get('data_pegawai')
                        ->result_array();
    }

    public function get_chart_alpha_per_bulan()
    {
        $this->db->select("DATE_FORMAT(STR_TO_DATE(bulan, '%m%Y'), '%M %Y') AS bulan, SUM(alpha) AS alpha", false);
        $this->db->from('data_kehadiran');
        $this->db->group_by('bulan');
        $this->db->order_by("STR_TO_DATE(bulan, '%m%Y')", 'ASC', false);
        return $this->db->get()->result_array();
    }
    

    public function get_chart_jenis_kelamin()
    {
        return $this->db->select('jenis_kelamin, COUNT(*) as jumlah')
                        ->group_by('jenis_kelamin')
                        ->get('data_pegawai')
                        ->result_array();
    }
}
