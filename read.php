<?php

session_start();
require "function.php";


if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

global $conn;
$buku = query("SELECT * FROM buku;");
$moling_select = query("SELECT * FROM buku group by lokasi asc;");

if (!isset($_GET['moling']) && isset($_POST["submitcari"])) {
    $buku = search($_POST["search"]);
} else {
    echo mysqli_error($conn);
}

if (isset($_GET["moling"])) {
    $lokasi = $_GET['moling'];
    $moling = query("SELECT * FROM buku WHERE lokasi = '$lokasi' ");

    if (isset($_POST["submitcari"])) {
        $judul = $_POST['search'];
        $moling = query("SELECT * FROM buku WHERE lokasi = '$lokasi' && judul LIKE '%$judul%'");
    }
} else {
    echo mysqli_error($conn);
}

if (isset($_POST["submit_pinjam"])) {
    if (input_pinjam($_POST) > 0) {
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
					document.location.href = 'read.php';
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
                        <div class="col-lg-6 grid-margin stretch-card">
                            <form action="" method="post">
                                <table border="0px" cellspacing="0px" cellpadding="0px">
                                    <tr>
                                        <td><input type="text" name="search" size="30px" autofocus placeholder="Cari Buku" autocomplete="off" id="search"></td>
                                        <td>
                                            <button type="submit" name="submitcari" id="submitcari" class="btn btn-primary btn-fw"> <i class="mdi mdi-magnify"></i>Cari Buku</button>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                            </form>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="btn-group">
                                <form action="" method="post">
                                    <button type="button" class="btn btn-warning dropdown-toggle btn-fw" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Urutkan
                                    </button>
                                    <div class="dropdown-menu">
                                        <table>
                                            <tr>
                                                <td>
                                                    <li>
                                                        <a class="dropdown-item" href="read.php">Semua Lokasi</a>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li>
                                                        <?php foreach ($moling_select as $data) : ?>
                                                            <a class="dropdown-item" href="read.php?moling=<?= $data['lokasi']; ?>"><?= $data['lokasi'] ?></a>
                                                        <?php endforeach; ?>
                                                    </li>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Koleksi</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        #
                                                    </th>
                                                    <th>
                                                        Gambar
                                                    </th>
                                                    <th>
                                                        Judul
                                                    </th>
                                                    <th>
                                                        Penulis
                                                    </th>
                                                    <th>
                                                        Tahun
                                                    </th>
                                                    <th>
                                                        Penerbit
                                                    </th>
                                                    <th>
                                                        Lokasi
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                    <th>
                                                        Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (isset($_GET['moling'])) : ?>
                                                    <?php $i = 1;
                                                    foreach ($moling as $bk) : ?>
                                                        <tr>
                                                            <td>
                                                                <?= $i ?>
                                                            </td>
                                                            <td>
                                                                <img width="auto" height="100px" src="images/<?= $bk["judul"]; ?>/<?= $bk["cover"] ?>" alt="<?= $bk["cover"] ?>">
                                                            </td>
                                                            <td>
                                                                <?= $bk["judul"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $bk["penulis"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $bk["tahun"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $bk["penerbit"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $bk["lokasi"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $bk["status"]; ?>
                                                            </td>
                                                            <td>

                                                                <a class="pinjam" href="" data-toggle="modal" data-target="#formModal-input" data-id_buku="<?= $bk['id'] ?>" data-status="<?= $bk['status'] ?>">Pinjam</a> |
                                                                <a href="update.php?id=<?= $bk["id"]; ?>">Update</a> |
                                                                <a href="delete.php?id=<?= $bk["id"]; ?>" onclick="return confirm('yakin dihapus?');">Delete</a>

                                                            </td>
                                                        </tr>
                                                    <?php $i++;
                                                    endforeach ?>
                                                <?php else : ?>

                                                    <?php $i = 1;
                                                    foreach ($buku as $bk) : ?>
                                                        <tr>
                                                            <td>
                                                                <?= $i ?>
                                                            </td>
                                                            <td>
                                                                <img width="auto" height="100px" src="images/<?= $bk["judul"]; ?>/<?= $bk["cover"] ?>" alt="<?= $bk["cover"] ?>">
                                                            </td>
                                                            <td>
                                                                <?= $bk["judul"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $bk["penulis"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $bk["tahun"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $bk["penerbit"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $bk["lokasi"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $bk["status"]; ?>
                                                            </td>
                                                            <td>

                                                                <a class="pinjam" href="" data-toggle="modal" data-target="#formModal-input" data-id_buku="<?= $bk['id'] ?>" data-status="<?= $bk['status'] ?>">Pinjam</a> |
                                                                <a href="update.php?id=<?= $bk["id"]; ?>">Update</a> |
                                                                <a href="delete.php?id=<?= $bk["id"]; ?>" onclick="return confirm('yakin dihapus?');">Delete</a>

                                                            </td>
                                                        </tr>
                                                    <?php $i++;
                                                    endforeach ?>
                                                <?php endif ?>
                                            </tbody>
                                        </table>
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

                        <div class="modal fade" id="formModal-input" tabhome="-1" aria-labelledby="judulModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="judulModal">Tambah Peminjaman</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="hidden" class="form-control" id="id_pinjam" name="id_pinjam" placeholder="ID Pinjam">
                                            <input type="hidden" class="form-control" id="id_buku" name="id_buku" placeholder="ID Buku">
                                            <input type="hidden" class="form-control" id="status" name="status" placeholder="Status Buku">

                                            <div class="form-group">
                                                <label for="id_buku">ID_Buku</label>
                                                <input type="text" class="form-control" id="id_buku" name="id_buku" placeholder="ID Buku" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Status Buku</label>
                                                <input type="text" class="form-control" id="status" name="status" placeholder="Status Buku" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="nama_peminjam">Nama Peminjam</label>
                                                <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" placeholder="Nama Peminjam">
                                            </div>

                                            <div class="form-group">
                                                <label for="alamat_peminjam">Alamat Peminjam</label>
                                                <input type="text" class="form-control" id="alamat_peminjam" name="alamat_peminjam" placeholder="Alamat Peminjam">
                                            </div>

                                            <div class="form-group">
                                                <label for="notelp_peminjam">No. Telp Peminjam</label>
                                                <input type="text" class="form-control" id="notelp_peminjam" name="notelp_peminjam" placeholder="No Telp Peminjam">
                                            </div>

                                            <div class="form-group">
                                                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                                <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" placeholder="tanggal_pinjam" value="<?= date("Y-m-d", time()); ?>" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label for="tanggal_kembali">Tanggal Kembali</label>
                                                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" placeholder="tanggal_kembali" value="<?= date("Y-m-d", time() + 3600 * 24 * 14); ?>">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit_pinjam" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="js/vendor.bundle.base.js"></script>
                    <script src="js/vendor.bundle.addons.js"></script>

                    <script src="js/off-canvas.js"></script>
                    <script src="js/misc.js"></script>

                    <script src="js/dashboard.js"></script>
                    <script src="js/js/font-awesome.min.js"></script>

                    <script>
                        // jQuery Tambah Produk
                        $(function() {
                            $('.pinjam').on('click', function() {
                                let id_buku = $(this).data('id_buku');
                                let status = $(this).data('status');
                                $('#formModal-input .modal-body #id_buku').val(id_buku);
                                $('#formModal-input .modal-body #status').val(status);
                            });
                        });
                    </script>
</body>

</html>