<link href="<?php echo base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="<?php echo base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Input Data Absensi Pegawai
        </div>
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group mb-2 mr-3">
                    <label for="bulan">Bulan:</label>
                    <select class="form-control ml-3" name="bulan">
                        <option value="">--Pilih Bulan--</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="form-group mb-2 mr-3">
                    <label for="tahun">Tahun:</label>
                    <select class="form-control ml-3" name="tahun">
                        <option value="">--Pilih Tahun--</option>
                        <?php 
                            $tahun = date('Y');
                            for ($i = 2025; $i < $tahun + 5; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Data</button>
                <a href="<?php echo base_url('admin/absensi/input_absensi') ?>" class="btn btn-success mb-2 ml-3"><i class="fas fa-plus"></i> Input Kehadiran</a>
            </form>
        </div>
    </div>

    <?php 
    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan . $tahun;
    } else {
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan . $tahun;
    }
    ?>

    <div class="alert alert-info mt-3">
        Menampilkan Data Kehadiran Pegawai Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span>
        Tahun: <span class="font-weight-bold"><?php echo $tahun ?></span>
    </div>

    <?php
    $jml_data = count($absensi);
    if ($jml_data > 0) {
    ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">NIK</th>
                        <th class="text-center">Nama Pegawai</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Hadir</th>
                        <th class="text-center">Sakit</th>
                        <th class="text-center">Alpha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($absensi as $a) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $a->nik ?></td>
                            <td><?php echo $a->nama_pegawai ?></td>
                            <td><?php echo $a->jenis_kelamin ?></td>
                            <td><?php echo $a->nama_jabatan ?></td>
                            <td><?php echo $a->hadir ?></td>
                            <td><?php echo $a->sakit ?></td>
                            <td><?php echo $a->alpha ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <span class="badge badge-danger ml-5"><i class="fas fa-info-circle"></i> Data masih kosong, Silahkan input pada bulan dan tahun yang dipilih</span>
    <?php } ?>

</div>
</div>