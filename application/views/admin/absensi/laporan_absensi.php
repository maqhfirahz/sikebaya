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

 <!-- Content Row -->
 <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header bg-primary text-center text-light">
          Filter Laporan Absensi Pegawai
        </div>
        <form action="<?= base_url('admin/absensi/cetaklaporanabsensi'); ?>" method="post" target="_blank">
        <div class="card-body">
          <div class="form-group">
            <select name="bulan" id="bulan" class="form-control">
              <option value="">-- Pilih Bulan --</option>
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
          <div class="form-group">
            <select name="tahun" id="tahun" class="form-control">
              <option value="">-- Pilih Tahun --</option>
              <?php $thn = date('Y'); 
                for($i = 2024; $i < $thn + 5; $i++) { ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
              <?php
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-print"></i> Cetak Laporan Absensi</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Content Row -->

</div>
  <!-- /.container-fluid -->


<!-- End of Main Content --




      
