<link href="<?php echo base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="<?php echo base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <table class="table table-striped table-bordered">
        <tr>
            <th>Bulan/Tahun</th>
            <th>Gaji Pokok</th>
            <th>Tj. Transportasi</th>
            <th>Uang Makan</th>
            <th>Potongan</th>
            <th>Total Gaji</th>
            <th>Cetak Slip</th>
        </tr>

        <?php 
        // Ambil nilai potongan alpha langsung dari hasil query
        $alpha = isset($potongan->jml_potongan) ? $potongan->jml_potongan : 0;
        ?>

        <?php foreach($gaji as $g) : ?>
        <?php 
            $pot_gaji = $g->alpha * $alpha;
            $total_gaji = $g->gaji_pokok + $g->tj_transport + $g->uang_makan - $pot_gaji;
        ?>
        <tr>
            <td><?php echo $g->bulan ?></td>
            <td>Rp. <?php echo number_format($g->gaji_pokok,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($g->tj_transport,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($g->uang_makan,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($pot_gaji,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($total_gaji,0,',','.') ?></td>
            <td>
                <center>
                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('pegawai/gaji/cetakSlip/'.$g->id_kehadiran) ?>">
                        <i class="fas fa-print"></i>
                    </a>
                </center>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</div>