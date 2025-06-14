<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <!-- Info Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Pegawai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pegawai ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $admin ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jabatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jabatan ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kehadiran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kehadiran ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Row -->
    <div class="row d-flex align-items-stretch">
        <!-- Bar Chart Pegawai per Jabatan -->
        <div class="col-xl-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart Pegawai per Jabatan</h6>
                </div>
                <div class="card-body">
                    <canvas id="barJabatan" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart Jenis Kelamin -->
        <div class="col-xl-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Pie Chart Jenis Kelamin</h6>
                </div>
                <div class="card-body">
                    <canvas id="pieGender" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Kehadiran -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Progress Statistik Kehadiran Bulan Ini</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">Hadir</div>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $hadir_percent ?>%" aria-valuenow="<?= $hadir_percent ?>" aria-valuemin="0" aria-valuemax="100"><?= $hadir_percent ?>%</div>
                    </div>
                    <div class="mb-2">Sakit</div>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= $sakit_percent ?>%" aria-valuenow="<?= $sakit_percent ?>" aria-valuemin="0" aria-valuemax="100"><?= $sakit_percent ?>%</div>
                    </div>
                    <div class="mb-2">Alpha</div>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $alpha_percent ?>%" aria-valuenow="<?= $alpha_percent ?>" aria-valuemin="0" aria-valuemax="100"><?= $alpha_percent ?>%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart Pegawai per Jabatan
    const barJabatan = new Chart(document.getElementById("barJabatan"), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($chart_pegawai_per_jabatan, 'jabatan')) ?>,
            datasets: [{
                label: 'Jumlah Pegawai',
                data: <?= json_encode(array_column($chart_pegawai_per_jabatan, 'jumlah')) ?>,
                backgroundColor: 'rgba(78, 115, 223, 0.5)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1000,
                easing: 'easeOutBounce'
            },
            scales: {
                    y: {
                        beginAtZero: false,
                        min: 1,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }

        }
    });

    // Pie Chart Jenis Kelamin
    const pieGender = new Chart(document.getElementById("pieGender"), {
        type: 'pie',
        data: {
            labels: <?= json_encode(array_column($chart_jenis_kelamin, 'jenis_kelamin')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($chart_jenis_kelamin, 'jumlah')) ?>,
                backgroundColor: ['#36b9cc', '#f6c23e', '#e74a3b'],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1000,
                easing: 'easeOutQuart'
            }
        }
    });
</script>
