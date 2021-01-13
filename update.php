<?php
require "function.php";

$id = $_GET["id"];

$buku = query("SELECT * FROM buku WHERE id = $id")[0];
global $conn;

if (isset($_POST["submit"])) {
    if (update($_POST) > 0) {
        echo
        "<script>
			alert('Data Buku Terupdate');
			document.location.href = 'read.php';
		</script>";
    } else {
        echo
        "<script>
            alert('Data Buku Tidak Dapat Terupdate');
            document.location.href = 'read.php';
		</script>";
        echo "<br> Error : " . mysqli_error($conn);
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
                            <span class="profile-text">Hello, Handie</span>
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
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Ubah Koleksi</h4>
                                    <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="coverLama" value="<?= $buku["cover"]; ?>">
                                        <input type="hidden" name="id" value="<?= $buku["id"]; ?>">
                                        <div class=" form-group">
                                            <label>Judul</label>
                                            <input type="text" class="form-control" name="judul" id="judul" required value="<?= $buku["judul"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Penulis</label>
                                            <input type="text" class="form-control" name="penulis" required value="<?= $buku["penulis"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="text" class="form-control" name="tahun" required value="<?= $buku["tahun"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Penerbit</label>
                                            <input type="text" class="form-control" name="penerbit" required value="<?= $buku["penerbit"]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select class="form-control form-control-lg" id="lokasi" name="lokasi">
                                                <option value="MOLING-1" <?php echo $buku['lokasi'] == 'MOLING-1' ? 'selected="selected"' : '' ?>>MOLING-1</option>
                                                <option value="MOLING-2" <?php echo $buku['lokasi'] == 'MOLING-2' ? 'selected="selected"' : '' ?>>MOLING-2</option>
                                                <option value="MOLING-3" <?php echo $buku['lokasi'] == 'MOLING-3' ? 'selected="selected"' : '' ?>>MOLING-3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control form-control-lg" id="status" name="status">
                                                <option value="Tersedia" <?php echo $buku['status'] == 'Tersedia' ? 'selected="selected"' : '' ?>>Tersedia</option>
                                                <option value="Dipinjam" <?php echo $buku['status'] == 'Dipinjam' ? 'selected="selected"' : '' ?>>Dipinjam</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cover</label>
                                            </br>
                                            <img width="110px" height="130px" src="images/<?= $buku['judul']; ?>/<?= $buku['cover'] ?>" alt="<?= $buku['judul']; ?>"><br>
                                            <input type="file" name="cover" id="cover">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success mr-2">Update Buku</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
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

                    <script src="js/vendor.bundle.base.js"></script>
                    <script src="js/vendor.bundle.addons.js"></script>

                    <script src="js/off-canvas.js"></script>
                    <script src="js/misc.js"></script>

                    <script src="js/dashboard.js"></script>
                    <script src="js/js/font-awesome.min.js"></script>
</body>

</html>