<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <?php if ($this->session->flashdata('pesan')) : ?>
        <?= $this->session->flashdata('pesan'); ?>
    <?php endif; ?>

    <form action="<?php echo base_url('pegawai/cuti/ajukan'); ?>" method="POST">
        <div class="form-group">
            <label>Jenis Cuti</label>
            <select name="jenis_cuti" class="form-control" required>
                <option value="">-- Pilih Jenis Cuti --</option>
                <option value="Cuti Tahunan">Cuti Tahunan</option>
                <option value="Cuti Sakit">Cuti Sakit</option>
                <option value="Cuti Melahirkan">Cuti Melahirkan</option>
            </select>
        </div>
        <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan Cuti</button>
    </form>
</div>
</div>