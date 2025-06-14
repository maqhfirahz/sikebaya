<div class="container-fluid">
    <h4 class="mb-4"><?= $title ?></h4>
    <?= $this->session->flashdata('message') ?>

    <?php if (!$sudah_absen) : ?>
        <form action="<?= base_url('pegawai/AbsensiPegawai/simpan') ?>" method="post">
            <div class="form-group">
                <label>Status Kehadiran:</label>
                <select name="status" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Alpha">Alpha</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Absensi</button>
        </form>
    <?php else : ?>
        <div class="alert alert-info">
            Anda sudah mengisi absensi hari ini dengan status: <strong><?= $sudah_absen->status ?></strong>
        </div>
    <?php endif; ?>
</div>
