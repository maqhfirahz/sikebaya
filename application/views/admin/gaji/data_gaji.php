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
            Data Gaji Pegawai
        </div>
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group mb-2 mr-3">
                    <label for="bulan">Bulan:</label>
                    <select class="form-control ml-3" name="bulan">
                        <option value="">--Pilih Bulan--</option>
                        <?php 
                            $bulan_arr = [
                                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                            ];
                            foreach ($bulan_arr as $key => $value) {
                                echo "<option value='$key'>$value</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-2 mr-3">
                    <label for="tahun">Tahun:</label>
                    <select class="form-control ml-3" name="tahun">
                        <option value="">--Pilih Tahun--</option>
                        <?php 
                            $tahun = date('Y');
                            for ($i = 2025; $i < $tahun + 5; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Data</button>
            <?php if(empty($gaji)) : ?>
              <button type="button" class="btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-print"></i> Cetak Daftar Gaji</button>
            <?php else : ?>
            <a href="<?= base_url('admin/data_gaji/cetak_gaji?bulan=') . $bulan . '&tahun=' . $tahun; ?>" class="btn btn-success mb-2 ml-2"><i class="fas fa-print"></i> Cetak Daftar Gaji</a>
            <?php endif; ?>  
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
        Menampilkan Data Gaji Pegawai Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span>
        Tahun: <span class="font-weight-bold"><?php echo $tahun ?></span>
    </div>


        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">NIK</th>
                        <th class="text-center">Nama Pegawai</th>
                        <th class="text-center">Jenis Kelamin</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Gaji Pokok</th>
                        <th class="text-center">Tj. Transport</th>
                        <th class="text-center">Uang Makan</th>
                        <th class="text-center">Potongan</th>
                        <th class="text-center">Total Gaji</th>
                    </tr>

                    <?php 
// Ambil nilai potongan per hari
$alpha = isset($potongan->jml_potongan) ? $potongan->jml_potongan : 0;

$no = 1;
foreach ($gaji as $g): 
    $total_potongan = $g->alpha * $alpha; // Hitung total potongan
    $total_gaji = $g->gaji_pokok + $g->tj_transport + $g->uang_makan - $total_potongan;
?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $g->nik ?></td>
        <td><?php echo $g->nama_pegawai ?></td>
        <td><?php echo $g->jenis_kelamin ?></td>
        <td><?php echo $g->nama_jabatan ?></td>
        <td>Rp.<?php echo number_format($g->gaji_pokok,0,',','.') ?></td>
        <td>Rp.<?php echo number_format($g->tj_transport,0,',','.') ?></td>
        <td>Rp.<?php echo number_format($g->uang_makan,0,',','.') ?></td>
        <td>Rp.<?php echo number_format($total_potongan,0,',','.') ?></td> <!-- Total potongan -->
        <td>Rp.<?php echo number_format($total_gaji,0,',','.') ?></td> <!-- Total gaji bersih -->
    </tr>
<?php endforeach; ?>
</table>
                    <?php if(empty($gaji)) : ?>
                        <div class="alert alert-danger text-center" role="alert">Bulan : <?= $bulan; ?> Tahun : <?= $tahun; ?> Data Tidak ditemukan.</div>
                      <?php endif; ?>

</div>


</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning" role=""><i class="fas fa-info"></i> Data gaji bulan <?= $bulan; ?> dan tahun <?= $tahun; ?> masih kosong. silahkan input absensi terlebih dahulu pada bulan dan tahun yang anda pilih.</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>