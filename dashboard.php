<?php
session_start();
require_once "function.php";

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$buku = query("SELECT COUNT(judul) as 'jumlahbuku' FROM buku;");
$pinjam = query("SELECT COUNT(id_pinjam) as 'total_pinjam' FROM peminjaman WHERE status_peminjaman = 'Belum Kembali' ;");
$member = query("SELECT COUNT(nama_peminjam) as 'jumlah_mem' FROM peminjaman;");

$peminjaman = query("SELECT * FROM peminjaman;");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sahabat Literasi Dashboard</title>
    <!-- Framework MDI -->
    <link rel="stylesheet" href="css/mdi/css/materialdesignicons.min.css">
    <!-- Framework SCSS Compass (Bootstraps 4 Include)  -->
    <link rel="stylesheet" href="css/style_dash.css">
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- Start Navbar -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="index.php">
                    <img src="images/logo-black.png" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.php">
                    <img src="images/logo-black.png" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown d-none d-xl-inline-block">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <span class="profile-text">Hello, Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            </br>
                            <a class="dropdown-item" href="logout.php">
                                Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Start Sidebar -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="menu-icon mdi mdi-television"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="menu-icon mdi mdi-content-copy"></i>
                            <span class="menu-title">Koleksi</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="input.php">Tambah Koleksi Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="read.php">Lihat Koleksi Buku</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="peminjaman.php">Lihat Peminjaman</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="menu-icon mdi mdi-restart"></i>
                            <span class="menu-title">Management Akun</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="registrasi.php"> Daftar Akun </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar -->

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="mdi mdi-cube text-danger icon-lg"></i>
                                        </div>
                                        <div class="float-right">
                                            <p class="mb-0 text-right">Total Koleksi</p>
                                            <div class="fluid-container">
                                                <?php foreach ($buku as $data) : ?>
                                                    <h3 class="font-weight-medium text-right mb-0"><?= $data['jumlahbuku'] ?> Buku</h3>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="mdi mdi-receipt text-warning icon-lg"></i>
                                        </div>
                                        <div class="float-right">
                                            <p class="mb-0 text-right">Buku Terpinjam</p>
                                            <div class="fluid-container">
                                                <?php foreach ($pinjam as $data) : ?>
                                                    <h3 class="font-weight-medium text-right mb-0"><?= $data['total_pinjam'] ?> Buku</h3>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="mdi mdi-poll-box text-success icon-lg"></i>
                                        </div>
                                        <div class="float-right">
                                            <?php $denda = [] ?>
                                            <?php foreach ($peminjaman as $pmj) : ?>
                                                <?php
                                                $tanggal_kembali_timestamp = strtotime($pmj['tanggal_kembali']);
                                                $tanggal_kembali = date('Y-m-d', $tanggal_kembali_timestamp);
                                                $curdate = date('Y-m-d', time());

                                                if ($tanggal_kembali < $curdate) {
                                                    $hari_kelebihan = date('d', time()) - date('d', $tanggal_kembali_timestamp);
                                                    $denda[] = $hari_kelebihan * 3000;
                                                }
                                                ?>
                                            <?php endforeach; ?>
                                            <p class="mb-0 text-right">Total Denda</p>
                                            <div class="fluid-container">
                                                <h3 class="font-weight-medium text-right mb-0">Rp.<?= array_sum($denda); ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-left">
                                            <i class="mdi mdi-account-location text-info icon-lg"></i>
                                        </div>
                                        <div class="float-right">
                                            <p class="mb-0 text-right">Jumlah Member</p>
                                            <div class="fluid-container">
                                                <?php foreach ($member as $data1) : ?>
                                                    <h3 class="font-weight-medium text-right mb-0"><?= $data1['jumlah_mem'] ?> Member</h3>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020/2021
                            <a href="https://github.com/pyxsor/sahabat_literasi" target="_blank">Kelompok 10</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Made with
                            <i class="mdi mdi-heart text-danger"></i>
                        </span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="js/vendor.bundle.base.js"></script>
    <script src="js/vendor.bundle.addons.js"></script>

    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>

    <script src="js/dashboard.js"></script>
</body>

</html>