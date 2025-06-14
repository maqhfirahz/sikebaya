<?php
class Absensi_model extends CI_Model
{
    public function cekAbsensiHariIni($id_pegawai, $tanggal)
    {
        return $this->db->get_where('absensi_harian', [
            'id_pegawai' => $id_pegawai,
            'tanggal' => $tanggal
        ])->row();
    }

    public function simpanAbsensi($data)
    {
        $this->db->insert('absensi_harian', $data);
    }

    public function updateRekapKehadiran($nik, $bulan)
    {
        $id_pegawai = $this->getIdPegawaiByNik($nik);
        if (!$id_pegawai || !$bulan) return;

        $bulan_angka = substr($bulan, 0, 2); // mm
        $tahun_angka = substr($bulan, 2, 4); // yyyy

        $this->db->select('status');
        $this->db->from('absensi_harian');
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->where('MONTH(tanggal)', $bulan_angka);
        $this->db->where('YEAR(tanggal)', $tahun_angka);
        $status_hari_ini = $this->db->get()->result();

        $hadir = $sakit = $alpha = 0;
        foreach ($status_hari_ini as $s) {
            if ($s->status == 'Hadir') $hadir++;
            if ($s->status == 'Sakit') $sakit++;
            if ($s->status == 'Alpha') $alpha++;
        }

        $data_update = [
            'hadir' => $hadir,
            'sakit' => $sakit,
            'alpha' => $alpha
        ];

        $this->db->where(['bulan' => $bulan, 'nik' => $nik]);
        $cek = $this->db->get('data_kehadiran')->row();

        if ($cek) {
            $this->db->update('data_kehadiran', $data_update, ['bulan' => $bulan, 'nik' => $nik]);
        } else {
            $pegawai = $this->db->get_where('data_pegawai', ['nik' => $nik])->row();
            if (!$pegawai) return;

            $data_update['bulan'] = $bulan;
            $data_update['nik'] = $nik;
            $data_update['nama_pegawai'] = $pegawai->nama_pegawai;
            $data_update['jenis_kelamin'] = $pegawai->jenis_kelamin;
            $data_update['nama_jabatan'] = $pegawai->jabatan;

            $this->db->insert('data_kehadiran', $data_update);
        }
    }

    public function getIdPegawaiByNik($nik)
    {
        $pegawai = $this->db->get_where('data_pegawai', ['nik' => $nik])->row();
        return $pegawai ? $pegawai->id_pegawai : null;
    }

    // Ambil rekap absensi bulanan
    public function getAbsensiBulanan($bulantahun)
    {
        $this->db->select('data_kehadiran.*, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_pegawai.jabatan');
        $this->db->from('data_kehadiran');
        $this->db->join('data_pegawai', 'data_kehadiran.nik = data_pegawai.nik');
        $this->db->join('data_jabatan', 'data_pegawai.jabatan = data_jabatan.nama_jabatan');
        $this->db->where('data_kehadiran.bulan', $bulantahun);
        $this->db->order_by('data_pegawai.nama_pegawai', 'ASC');
        return $this->db->get()->result();
    }

    // Ambil pegawai yang belum input absensi untuk bulan tertentu
    public function getPegawaiBelumAbsensi($bulantahun)
    {
        $this->db->select('data_pegawai.*, data_jabatan.nama_jabatan');
        $this->db->from('data_pegawai');
        $this->db->join('data_jabatan', 'data_pegawai.jabatan = data_jabatan.nama_jabatan');
        $this->db->where("NOT EXISTS (
            SELECT * FROM data_kehadiran 
            WHERE bulan = '$bulantahun' 
            AND data_pegawai.nik = data_kehadiran.nik
        )", null, false);
        $this->db->order_by('data_pegawai.nama_pegawai', 'ASC');
        return $this->db->get()->result();
    }

    // Ambil data untuk laporan absensi bulanan
    public function getLaporanAbsensi($bulantahun)
    {
        $this->db->select('data_kehadiran.*, data_pegawai.nama_pegawai, data_jabatan.nama_jabatan');
        $this->db->from('data_kehadiran');
        $this->db->join('data_pegawai', 'data_kehadiran.nik = data_pegawai.nik');
        $this->db->join('data_jabatan', 'data_pegawai.jabatan = data_jabatan.nama_jabatan');
        $this->db->where('data_kehadiran.bulan', $bulantahun);
        $this->db->order_by('data_pegawai.nama_pegawai', 'ASC');
        return $this->db->get()->result();
    }

    // Simpan absensi bulanan secara batch
    public function simpanAbsensiBulanan($data)
    {
        $this->db->insert_batch('data_kehadiran', $data);
    }
}
