<!-- Load CSS -->
<link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
</div>

<div class="d-flex justify-content-left mb-4">
    <div class="card mx-auto" style="width: 80%;">
        <div class="card-body">

            <?php foreach ($jabatan as $j): ?>
            <form method="POST" action="<?php echo base_url('admin/jabatan/update_data_aksi') ?>">
                <!-- ID Jabatan hidden -->
                <input type="hidden" name="id_jabatan" value="<?php echo $j->id_jabatan ?>">

                <div class="form-group">
                    <label>Nama Jabatan</label>
                    <input type="text" name="nama_jabatan" class="form-control" value="<?php echo set_value('nama_jabatan', $j->nama_jabatan) ?>">
                    <?php echo form_error('nama_jabatan', '<div class="text-small text-danger mt-1">', '</div>') ?>
                </div>

                <div class="form-group">
                    <label>Gaji Pokok</label>
                    <input type="number" name="gaji_pokok" class="form-control" value="<?php echo set_value('gaji_pokok', $j->gaji_pokok) ?>">
                    <?php echo form_error('gaji_pokok', '<div class="text-small text-danger mt-1">', '</div>') ?>
                </div>

                <div class="form-group">
                    <label>Tunjangan Transportasi</label>
                    <input type="number" name="tj_transport" class="form-control" value="<?php echo set_value('tj_transport', $j->tj_transport) ?>">
                    <?php echo form_error('tj_transport', '<div class="text-small text-danger mt-1">', '</div>') ?>
                </div>

                <div class="form-group">
                    <label>Uang Makan</label>
                    <input type="number" name="uang_makan" class="form-control" value="<?php echo set_value('uang_makan', $j->uang_makan) ?>">
                    <?php echo form_error('uang_makan', '<div class="text-small text-danger mt-1">', '</div>') ?>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="<?php echo base_url('admin/jabatan') ?>" class="btn btn-secondary ml-2">Kembali</a>
            </form>
            <?php endforeach; ?>

        </div>
    </div>
</div>
