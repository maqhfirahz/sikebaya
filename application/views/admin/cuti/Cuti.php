<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <?php if ($this->session->flashdata('pesan')) : ?>
        <?= $this->session->flashdata('pesan'); ?>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Pegawai</th>
                <th>Jenis Cuti</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($cuti as $c): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $this->Cuti_model->get_pegawai_by_id($c->id_pegawai)->nik; ?></td>
                <td><?php echo $this->Cuti_model->get_pegawai_by_id($c->id_pegawai)->nama_pegawai; ?></td>
                <td><?php echo $c->jenis_cuti; ?></td>
                <td><?php echo date('d-m-Y', strtotime($c->tanggal_mulai)); ?></td>
                <td><?php echo date('d-m-Y', strtotime($c->tanggal_selesai)); ?></td>
                <td>
                    <?php 
                    if ($c->status == 'Pending') {
                        echo '<span class="badge badge-warning">Pending</span>';
                    } elseif ($c->status == 'Disetujui') {
                        echo '<span class="badge badge-success">Disetujui</span>';
                    } else {
                        echo '<span class="badge badge-danger">Ditolak</span>';
                    }
                    ?>
                </td>
                <td>
                    <a href="<?php echo base_url('admin/cuti/set_status/' . $c->id_cuti . '/Disetujui'); ?>" class="btn btn-sm btn-success">Setujui</a>
                    <a href="<?php echo base_url('admin/cuti/set_status/' . $c->id_cuti . '/Ditolak'); ?>" class="btn btn-sm btn-danger">Tolak</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>