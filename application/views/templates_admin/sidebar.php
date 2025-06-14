<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:rgb(143, 74, 189);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin/dashboard') ?>">
                <div class="sidebar-brand-text mx-3 text-white">SIKEBAYA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0 bg-white">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo base_url('admin/dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt text-white"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Master Data -->
            <li class="nav-item">
                <a class="nav-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-database text-white"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-light py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url('admin/pegawai') ?>">Pegawai</a>
                        <a class="collapse-item" href="<?php echo base_url('admin/jabatan') ?>">Jabatan</a>
                    </div>
                </div>
            </li>

            <!-- Manajemen -->
            <li class="nav-item">
                <a class="nav-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-money-check text-white"></i>
                    <span>Manajemen</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-light py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url('admin/absensi') ?>">Absensi</a>
                        <a class="collapse-item" href="<?php echo base_url('admin/potongan_gaji') ?>">Potongan Gaji</a>
                        <a class="collapse-item" href="<?php echo base_url('admin/cuti') ?>">Cuti</a>
                    </div>
                </div>
            </li>

            <!-- Laporan -->
            <li class="nav-item">
                <a class="nav-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-receipt text-white"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-light py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url('admin/absensi/laporan_absensi') ?>">Laporan Absensi</a>
                        <a class="collapse-item" href="<?php echo base_url('admin/data_gaji') ?>">Laporan Gaji</a>
                        <a class="collapse-item" href="<?php echo base_url('admin/data_gaji/slip_gaji') ?>">Slip Gaji</a>
                    </div>
                </div>
            </li>

            <!-- Ubah Password -->
            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo base_url('gantiPassword')?>">
                    <i class="fas fa-fw fa-lock text-white"></i>
                    <span>Ubah Password</span></a>
            </li>

            <!-- Logout -->
            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo base_url('welcome/logout')?>">
                    <i class="fas fa-fw fa-sign-out-alt text-white"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Sidebar Toggler -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background-color: #0d1a26;">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars text-white"></i>
                    </button>

                    <!-- Title -->
                    <p class="mb-0 font-weight-bold text-white">RS BHAYANGKARA</p>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- User Info -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white small">
                                    Selamat Datang <?php echo $this->session->userdata('nama_pegawai')?>
                                </span>
                                <img class="img-profile rounded-circle"
                                     src="<?php echo base_url('assets/img/').$this->session->userdata('photo')?>">
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->