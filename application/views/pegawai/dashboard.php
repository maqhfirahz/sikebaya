<div class="container-fluid">
    <!-- <h4 class="mb-4"><?= $title ?></h4> -->
    <?= $this->session->flashdata('message') ?>

    <!-- Card Data Pegawai dan Absensi -->
    <div class="container-fluid d-flex justify-content-center">
        <div class="card shadow mb-5 mt-4" style="width: 100%; max-width: 850px;">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">Data Pegawai</h6>
            </div>

            <?php foreach ($pegawai as $p) : ?>
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Foto Pegawai -->
                        <div class="col-md-4 d-flex justify-content-center">
                            <?php
                            $photo = $this->session->userdata('photo');
                            $photo_path = !empty($photo) ? base_url('assets/img/' . $photo) : base_url('assets/img/default.jpg');
                            ?>
                            <img src="<?= $photo_path ?>" 
                                 alt="Foto Pegawai" 
                                 class="img-fluid rounded-circle shadow-sm"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>

                        <!-- Informasi Pegawai -->
                        <div class="col-md-8">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th style="width: 40%;">Nama Pegawai</th>
                                        <td>: <?= $p->nama_pegawai ?></td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td>: <?= $p->nik ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jabatan</th>
                                        <td>: <?= $p->jabatan ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Masuk</th>
                                        <td>: <?= date('d F Y', strtotime($p->tanggal_masuk)) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>: <?= $p->status ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Form Absensi -->
                            <div class="mt-4">
                                <?php if (!$sudah_absen) : ?>
                                    <div class="mb-2 font-weight-bold">Absensi Hari Ini:</div>
                                    <div class="d-flex gap-2">
                                        <form method="post" action="<?= base_url('pegawai/AbsensiPegawai/simpan') ?>" class="mr-2">
                                            <input type="hidden" name="status" value="Hadir">
                                            <button type="submit" class="btn btn-success btn-sm">Hadir</button>
                                        </form>
                                        <form method="post" action="<?= base_url('pegawai/AbsensiPegawai/simpan') ?>" class="mr-2">
                                            <input type="hidden" name="status" value="Sakit">
                                            <button type="submit" class="btn btn-warning btn-sm">Sakit</button>
                                        </form>
                                        <form method="post" action="<?= base_url('pegawai/AbsensiPegawai/simpan') ?>">
                                            <input type="hidden" name="status" value="Alpha">
                                            <button type="submit" class="btn btn-danger btn-sm">Alpha</button>
                                        </form>
                                    </div>
                                <?php else : ?>
                                    <div class="alert alert-info mt-3 mb-0">
                                        Anda sudah absen hari ini dengan status: <strong><?= $sudah_absen->status ?></strong>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
