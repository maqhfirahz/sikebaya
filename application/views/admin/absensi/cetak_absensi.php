<?php 
// Mengambil bulan dan tahun dari POST request atau default ke tanggal saat ini
if ((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $bulanTahun = $bulan . $tahun;
} else {
    $bulan = date('m');
    $tahun = date('Y');
    $bulanTahun = $bulan . $tahun;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Absensi Pegawai</title>
    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature-line {
            border-top: 2px solid #000;
            width: 200px;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <h3>KELOMPOK 6 Sistem Web Mobile</h3>
        <p>Laporan Data Kehadiran Pegawai</p>
        <p>Bulan: <strong><?= $bulan; ?></strong> Tahun: <strong><?= $tahun; ?></strong></p>
    </div>

    <!-- Table -->
    <?php if (!empty($absensi)): ?>
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
                <?php 
                $no = 1;
                foreach ($absensi as $a): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $a->nik; ?></td>
                    <td><?= $a->nama_pegawai; ?></td>
                    <td><?= $a->jenis_kelamin == 'L' ? 'Pria' : 'Perempuan'; ?></td>
                    <td><?= $a->nama_jabatan; ?></td>
                    <td><?= $a->hadir; ?></td>
                    <td><?= $a->sakit; ?></td>
                    <td><?= $a->alpha; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-danger text-center" role="alert">
            Data tidak ditemukan untuk Bulan: <?= $bulan; ?> Tahun: <?= $tahun; ?>.
        </div>
    <?php endif; ?>

    <!-- Footer -->
    <div class="footer">
        <p>Banda Aceh, <?= date('d M Y'); ?><br>HRD</p>

        
    </div>

</div>

<script>
    window.print();
</script>

</body>
</html>