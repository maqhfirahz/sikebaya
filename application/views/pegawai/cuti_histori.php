<link href="<?php echo base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="<?php echo base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
        <!-- Tombol Ajukan Cuti -->
        <a href="<?php echo base_url('pegawai/cuti/ajukan'); ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Ajukan Cuti
        </a>
    </div>
    <?php echo $this->session->flashdata('pesan') ?>
    <?php if (empty($cuti)): ?>
        <div class="alert alert-info" role="alert">
            Anda belum memiliki histori pengajuan cuti.
        </div>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Cuti</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($cuti as $c): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
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
                    <td><?php echo $c->keterangan; ?></td>
                    <td class="text-center">
                        <a href="<?php echo base_url('pegawai/cuti/delete_data/' . $c->id_cuti); ?>" 
                        onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</div>