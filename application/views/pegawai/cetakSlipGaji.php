<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            background-color: #fff;
            padding: 40px;
        }
        .center {
            text-align: center;
            margin-bottom: 30px;
        }
        hr {
            width: 50%;
            border: 2px solid #000;
            margin: 10px auto;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature {
            margin-top: 80px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="center">
        <h1>Kelompok 6 HRIS</h1>
        <h4>Slip Gaji Pegawai</h4>
        <hr>
    </div>

    <?php if (empty($print_slip)) : ?>
    <div class="alert alert-danger">Data slip gaji tidak ditemukan.</div>
<?php else : ?>
    <?php foreach ($print_slip as $ps) :
        // Hitung potongan gaji berdasarkan jumlah alpha dan nilai potongan
        $potongan_gaji = $ps->alpha * $potongan;

        // Variabel untuk komponen gaji
        $gaji_pokok = $ps->gaji_pokok;
        $tj_transport = $ps->tj_transport;
        $uang_makan = $ps->uang_makan;
        $total_gaji = $gaji_pokok + $tj_transport + $uang_makan - $potongan_gaji;
    ?>
    <!-- Informasi Pegawai -->
    <table class="table table-bordered">
        <tr>
            <td width="30%">Nama Pegawai</td>
            <td width="5%">:</td>
            <td><?= $ps->nama_pegawai; ?></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td><?= $ps->nik; ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?= $ps->nama_jabatan; ?></td>
        </tr>
        <tr>
            <td>Bulan</td>
            <td>:</td>
            <td><?= $bulan; ?></td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td><?= $tahun; ?></td>
        </tr>
    </table>

    <!-- Rincian Gaji -->
    <table class="table table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <th style="width: 5%;">No</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Gaji Pokok</td>
                <td>Rp. <?= number_format($gaji_pokok, 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Tunjangan Transportasi</td>
                <td>Rp. <?= number_format($tj_transport, 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Uang Makan</td>
                <td>Rp. <?= number_format($uang_makan, 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Potongan (Alpha)</td>
                <td>Rp. <?= number_format($potongan_gaji, 0, ',', '.'); ?></td>
            </tr>
            <tr class="table-light fw-bold">
                <td colspan="2" style="padding-left: 10px;">Total Gaji Diterima</td>
                <td>Rp. <?= number_format($total_gaji, 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>
    <?php endforeach; ?>
<?php endif; ?>
    <!-- Footer Tanggal dan Tanda Tangan -->
    <div class="footer">
        <p>Banda Aceh, <?= date('d F Y'); ?><br>Keuangan</p>
        <div class="signature">_______________________</div>
    </div>
</div>

<!-- Auto Print -->
<script>
    window.print();
</script>

</body>
</html>
