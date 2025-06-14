<link href="<?php echo base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
</div>

<div class="d-flex justify-content-left mb-4">
    <div class="card mx-auto" style="width: 80%;">
    <div class="card-body">
        <form method="POST" action="<?php echo base_url('admin/pegawai/update_data_aksi') ?>" enctype="multipart/form-data">
            <input type="hidden" name="id_pegawai" value="<?php echo $pegawai->id_pegawai ?>">
            <input type="hidden" name="old_photo" value="<?php echo $pegawai->photo ?>">

            <div class="form-group">
                <label>NIK</label>
                <input type="number" name="nik" class="form-control" value="<?php echo $pegawai->nik ?>">
                <?php echo form_error('nik', '<div class="text-small text-danger"></div>') ?>
            </div>

            <div class="form-group">
                <label>Nama Pegawai</label>
                <input type="text" name="nama_pegawai" class="form-control" value="<?php echo $pegawai->nama_pegawai ?>">
                <?php echo form_error('nama_pegawai', '<div class="text-small text-danger"></div>') ?>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="">-- PILIH JENIS KELAMIN --</option>
                    <option value="Laki-Laki" <?php echo ($pegawai->jenis_kelamin == 'Laki-Laki') ? 'selected' : '' ?>>Laki-Laki</option>
                    <option value="Perempuan" <?php echo ($pegawai->jenis_kelamin == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                </select>
                <?php echo form_error('jenis_kelamin', '<div class="text-small text-danger"></div>') ?>
            </div>

            <div class="form-group">
                <label>Jabatan</label>
                <select name="jabatan" class="form-control">
                    <option value="">-- PILIH JABATAN --</option>
                    <?php foreach ($jabatan as $j) : ?>
                        <option value="<?php echo $j->nama_jabatan ?>" <?php echo ($pegawai->jabatan == $j->nama_jabatan) ? 'selected' : '' ?>><?php echo $j->nama_jabatan ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo form_error('jabatan', '<div class="text-small text-danger"></div>') ?>
            </div>

            <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" value="<?php echo $pegawai->tanggal_masuk ?>">
                <?php echo form_error('tanggal_masuk', '<div class="text-small text-danger"></div>') ?>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">-- PILIH STATUS --</option>
                    <option value="Pegawai Tetap" <?php echo ($pegawai->status == 'Pegawai Tetap') ? 'selected' : '' ?>>Pegawai Tetap</option>
                    <option value="Pegawai Tidak Tetap" <?php echo ($pegawai->status == 'Pegawai Tidak Tetap') ? 'selected' : '' ?>>Pegawai Tidak Tetap</option>
                </select>
                <?php echo form_error('status', '<div class="text-small text-danger"></div>') ?>
            </div>

            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="photo" class="form-control">
                <?php if ($pegawai->photo) : ?>
                    <img src="<?php echo base_url('assets/img/' . $pegawai->photo) ?>" alt="Foto Pegawai" width="100">
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $pegawai->username ?>">
                <?php echo form_error('username', '<div class="text-small text-danger"></div>') ?>
            </div>

            <div class="form-group">
                <label for="hak_akses">Hak Akses</label>
                <select name="hak_akses" id="hak_akses" class="form-control" required>
                    <option value="">-- PILIH HAK AKSES --</option>
                    <option value="1" <?php echo ($pegawai->hak_akses == '1') ? 'selected' : ''; ?>>Admin</option>
                    <option value="2" <?php echo ($pegawai->hak_akses == '2') ? 'selected' : ''; ?>>Pegawai</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>
    </div>
</div>