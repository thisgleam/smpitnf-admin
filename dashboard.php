<?php

session_start();
ob_start();

if (!isset($_SESSION['login'])) {
	echo "<script>
		  document.location.href = 'login';
		  </script>";
	exit;
}

$title = 'Dashboard';

include 'layout/header.php';

$user_logs = select("SELECT * FROM user_logs ORDER BY login_time DESC LIMIT 10");

if (isset($_POST['tambah'])) {
    if (create_data($_POST) > 0) {
        $_SESSION['alert'] = [
            'message' => 'Data dokumen berhasil ditambahkan',
            'type' => 'success'
        ];
    } else {
        $_SESSION['alert'] = [
            'message' => 'Data dokumen gagal ditambahkan',
            'type' => 'danger'
        ];
    }
    
    header("Location: data_dokumen");
    exit();
}

if (isset($_POST['ubah'])) {
    if (update_data($_POST) > 0) {
        $_SESSION['alert'] = [
            'message' => 'Data dokumen berhasil diubah',
            'type' => 'success'
        ];
    } else {
        $_SESSION['alert'] = [
            'message' => 'Data dokumen gagal diubah',
            'type' => 'danger'
        ];
    }
    header("Location: data_dokumen");
    exit();
}

?>

<main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><i class="fa-solid fa-house"></i> Dashboard</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row"> <!-- Start col -->
                        <div class="col-lg-6 connectedSortable">
                            <div class="card card-outline card-primary mb-4">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fa-solid fa-clock"></i> Log Aktivitas</h3>
                                    <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button> </div> <!-- /.card-tools -->
                                </div> <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm mt-3">
                                        <thead>
                                            <tr class="bg-teal">
                                                <th style="width: 10px">No.</th>
                                                <th>Nama</th>
                                                <th>Level</th>
                                                <th>IP</th>
                                                <th style="width: 40px">Tanggal</th>
                                            </tr>
                                            </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($user_logs as $logs) : ?>
                                            <tr class="text-xs">
                                            <td><?= $no++; ?></td>
                                            <td class="text-danger"><?= $logs['nama'] ?></td>
                                            <td>
                                                <?php
                                                if ($logs['level'] == 1) {
                                                    echo 'admin';
                                                } elseif ($logs['level'] == 2) {
                                                    echo 'guru';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-cyan"><?= $logs['ip_address'] ?></td>
                                            <td>
                                                <div style="width:140px"><?= $logs['login_time'] ?></div>
                                            </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div> <!-- /.card-body -->
                            </div> <!-- /.card -->
                        </div>
                        <div class="col-lg-6 connectedSortable">
                        <div class="card card-outline card-primary mb-4">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa-solid fa-image"></i> GALLERY</h3>
                            </div>
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="./layout/image/img1.jpg" class="d-block w-100" alt="Image 1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="./layout/image/img2.jpg" class="d-block w-100" alt="Image 2">
                                    </div>
                                    <div class="carousel-item">
                                        <img src=".//layout/image/img3.jpg" class="d-block w-100" alt="Image 3">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div> <!-- /.row (main row) -->
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> <!--begin::Footer-->

<?php 

include 'layout/footer.php';
ob_end_flush()

?>