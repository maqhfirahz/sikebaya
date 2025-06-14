<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Load CSS -->
<link href="<?php echo base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="<?php echo base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>

    <!-- Form Update Potongan Gaji -->
    <div class="d-flex justify-content-left mb-4">
        <div class="card mx-auto" style="width: 80%;">
            <div class="card-body">

                <?php if ($potongan): ?>
                    <form method="POST" action="<?php echo base_url('admin/potongan_gaji/update_data_aksi'); ?>">
                        <!-- Input Hidden untuk ID Potongan Gaji -->
                        <input type="hidden" name="id_poga" class="form-control" value="<?php echo $potongan['id_poga']; ?>">

                        <!-- Input Jenis Potongan -->
                        <div class="form-group">
                            <label for="potongan">Jenis Potongan</label>
                            <input type="text" name="potongan" id="potongan" class="form-control" value="<?php echo $potongan['potongan']; ?>">
                            <?php echo form_error('potongan', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>

                        <!-- Input Jumlah Potongan -->
                        <div class="form-group">
                            <label for="jml_potongan">Jumlah Potongan</label>
                            <input type="number" name="jml_potongan" id="jml_potongan" class="form-control" value="<?php echo $potongan['jml_potongan']; ?>">
                            <?php echo form_error('jml_potongan', '<div class="text-small text-danger">', '</div>'); ?>
                        </div>

                        <!-- Tombol Simpan dan Kembali -->
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?php echo base_url('admin/potongan_gaji'); ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                <?php else: ?>
                    <!-- Pesan Error Jika Data Tidak Ditemukan -->
                    <div class="alert alert-danger" role="alert">
                        Data tidak ditemukan!
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->