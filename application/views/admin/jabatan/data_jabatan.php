
<link href="<?php echo base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?>
    </h1>
    </div>

    <a class = "btn btn-sm btn-success mb-3" 
                    href="<?php echo base_url('admin/jabatan/tambah_data/') ?>">
                    <i class="fas fa-plus"></i>Tambah Data</a> 
    <?php echo $this->session->flashdata('pesan') ?>
    <table class="table table-bordered table-striped mp-2">
        <tr>
            <th class="text-center">NO</th>
            <th class="text-center">Nama Jabatan</th>
            <th class="text-center">Gaji Pokok</th>
            <th class="text-center">Tunjangan Transportasi</th>
            <th class="text-center">Uang Makan</th>
            <th class="text-center">Total</th>
            <th class="text-center">Update</th>
        </tr>

    <?php $no=1; foreach($jabatan as $j) : ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $j->nama_jabatan ?></td>
            <td>Rp. <?php echo number_format($j->gaji_pokok,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($j->tj_transport,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($j->uang_makan,0,',','.') ?></td>
            <td>Rp. <?php echo number_format($j->gaji_pokok + $j->tj_transport + $j->uang_makan,0,',','.') ?></td>
            <td>    
                <center>
                    <a class = "btn btn-sm btn-primary" 
                    href="<?php echo base_url('admin/jabatan/update_data/'.$j->id_jabatan) ?>">
                    <i class="fas fa-edit"></i></a>
                    <a onclick="return confirm('Hapus')" class = "btn btn-sm btn-danger" 
                    href="<?php echo base_url('admin/jabatan/delete_data/'.$j->id_jabatan) ?>">
                    <i class="fas fa-trash"></i></a>
                </center>
            </td>
        </tr>
    <?php endforeach; ?>


    </table>

</div>


</div>

