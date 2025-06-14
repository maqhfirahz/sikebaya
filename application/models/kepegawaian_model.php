<?php 

class kepegawaian_model extends CI_model {
    public function get_data($table){
        return $this->db->get($table);
    }

    public function insert_data($data,$table){
        $this->db->insert($table,$data);
    }

    public function update_data($table,$data, $where){
        $this->db->update($table,$data, $where);
    }

    public function delete_data($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function get_data_where($table, $where_key, $where_value)
    {
    $this->db->where($where_key, $where_value);
    return $this->db->get($table);
    }

    public function insert_batch($table = null, $data = array())
    {
        $jumlah = count($data);
        if($jumlah > 0 )
        {
            $this->db->insert_batch($table,$data);
        }
    }

    public function get_alpa_potongan()
{
    return $this->db->query("
        SELECT jml_potongan 
        FROM potongan_gaji 
        WHERE potongan = 'Alpha'
    ")->row();
}

public function cek_login($username, $password)
{
    $result = $this->db->where('username', $username)
                       ->where('password', md5($password))
                       ->limit(1)
                       ->get('data_pegawai');

    if ($result->num_rows() > 0) {
        return $result->row();
    } else {
        return FALSE;
    }
}

public function getPegawaiById($id)
{
    return $this->db->get_where('data_pegawai', ['id_pegawai' => $id])->row();
}

public function getIdPegawaiByNik($nik)
{
    $pegawai = $this->db->get_where('data_pegawai', ['nik' => $nik])->row();
    return $pegawai ? $pegawai->id_pegawai : null;
}

}
?>