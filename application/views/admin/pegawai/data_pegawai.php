<link href="<?php echo base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?>
    </h1>
    </div>

    <?php echo $this->session->flashdata('pesan') ?>
    <a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('admin/pegawai/tambah_data') ?>">
        <i class="fas fa-plus"></i> Tambah Pegawai </a>


    <table class="table table-bordered table-striped mp-2">
    <tr>
        <th class="text-center">No</th>
        <th class="text-center">Nik</th>
        <th class="text-center">Nama pegawai</th>
        <th class="text-center">Jenis Kelamin</th>
        <th class="text-center">Jabatan</th>
        <th class="text-center">Tanggal Masuk</th>
        <th class="text-center">Status</th>
        <th class="text-center">Photo</th>
        <th class="text-center">Hak Akses</th>
        <th class="text-center">Action</th>
    </tr>

    <?php $no=1; foreach($pegawai as $j) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $j->nik ?></td>
            <td><?php echo $j->nama_pegawai ?></td>
            <td><?php echo $j->jenis_kelamin ?></td>
            <td><?php echo $j->jabatan ?></td>
            <td><?php echo $j->tanggal_masuk ?></td>
            <td><?php echo $j->status ?></td>
            <td><img src="<?php echo base_url().'assets/img/'. $j->photo ?>" width="75px"></td>
            <td><?= ($j->hak_akses == '1') ? 'Admin' : 'Pegawai'; ?></td>

            <td>
                <div class="d-flex justify-content-center">
                    <!-- Tombol Edit -->
                    <a href="<?php echo base_url('admin/pegawai/update_data/' . $j->id_pegawai); ?>" 
                    class="btn btn-sm btn-primary mx-1" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>

                    <!-- Tombol Hapus -->
                    <a href="<?php echo base_url('admin/pegawai/delete_data/' . $j->id_pegawai); ?>" 
                    class="btn btn-sm btn-danger mx-1" 
                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" 
                    title="Hapus">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</div>

</div>


