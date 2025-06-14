<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Daftar Gaji Pegawai</title>
    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
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
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }

    </style>
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <h1>KELOMPOK 6 SISTEM WEB MOBILE</h1>
        <h2>DAFTAR GAJI PEGAWAI</h2>
        <p>Bulan: <strong><?php echo $bulan; ?></strong> Tahun: <strong><?php echo $tahun; ?></strong></p>
    </div>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Pegawai</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Tj. Transport</th>
                <th>Uang Makan</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($gaji)): ?>
                <?php 
                // Ambil nilai potongan per hari
                $alpha = isset($potongan->jml_potongan) ? $potongan->jml_potongan : 0;

                $no = 1;
                foreach ($gaji as $g): 
                    $total_potongan = $g->alpha * $alpha; // Hitung total potongan
                    $total_gaji = $g->gaji_pokok + $g->tj_transport + $g->uang_makan - $total_potongan;
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $g->nik; ?></td>
                    <td><?php echo $g->nama_pegawai; ?></td>
                    <td><?php echo $g->jenis_kelamin; ?></td>
                    <td><?php echo $g->nama_jabatan; ?></td>
                    <td>Rp.<?php echo number_format($g->gaji_pokok, 0, ',', '.'); ?></td>
                    <td>Rp.<?php echo number_format($g->tj_transport, 0, ',', '.'); ?></td>
                    <td>Rp.<?php echo number_format($g->uang_makan, 0, ',', '.'); ?></td>
                    <td>Rp.<?php echo number_format($total_potongan, 0, ',', '.'); ?></td>
                    <td>Rp.<?php echo number_format($total_gaji, 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data gaji untuk bulan dan tahun yang dipilih.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
<!-- <table width='100%'>
    <tr>
        <td></td>
        <td width="200px"></td>
        <p>Banda Aceh, <?php echo date('d F Y'); ?> <br> Keuangan </p>
        <br>
        <br>
        <p>____________________</p>   
    </tr>
</table> -->


    <!-- Footer -->
<!-- Footer -->
<div class="footer">
        <p>Banda Aceh, <?php echo date('d F Y'); ?> <br> Keuangan </p>
        <br>
        <br>
        <p>____________________</p> 
    </div>



</div>

</body>
</html>

<script>
	window.print();
</script>