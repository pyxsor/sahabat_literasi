<?php
session_start();
require_once "function.php";


// if (!isset($_SESSION['login'])) {
//     header("Location: index.php");
//     exit;
// }

$conn = mysqli_connect("localhost", "root", "", "sahabat_literasi");

//cek apakah tombol submit sudah ditekan ato blm
if (isset($_POST["submit"])) {

    if (input($_POST) > 0) {
        echo "
				<script>
					alert('data berhasil ditambahkan');
					document.location.href = 'read.php';
				</script>
			";
    } else {
        echo "
				<script>
					alert('data gagal ditambahkan');
					document.location.href = 'input.php';
				</script>
			";
    }
}
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

        <!-- Start Body -->
        <div class="container-fluid page-body-wrapper">
            <!-- Start Sidebar -->
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

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Tambah Koleksi</h4>
                                    <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id">
                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" class="form-control" id="judul" name="judul" placeholder="judul" require>
                                        </div>
                                        <div class="form-group">
                                            <label>Penulis</label>
                                            <input type="text" class="form-control" id="penulis" name="penulis" placeholder="penulis" require>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Tahun">
                                        </div>
                                        <div class="form-group">
                                            <label>Penerbit</label>
                                            <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Penerbit">
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select class="form-control form-control-lg" id="lokasi" name="lokasi">
                                                <option>MOLING-1</option>
                                                <option>MOLING-2</option>
                                                <option>MOLING-3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control form-control-lg" id="status" name="status">
                                                <option>Tersedia</option>
                                                <option>Dipinjam</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cover</label>
                                            </br>
                                            <input type="file" name="cover" id="cover">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success mr-2">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Wrapper -->
                <footer class=" footer">
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