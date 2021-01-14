<?php
session_start();
require "function.php";


if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

global $conn;
$peminjaman = query("SELECT * FROM peminjaman, buku WHERE peminjaman.id_buku = buku.id;");
$buku = query("SELECT * FROM buku;");
$moling_select = query("SELECT * FROM peminjaman, buku;");

if (!isset($_GET['moling']) && isset($_POST["submitcari"])) {
    $cari = $_POST['cari'];
    $peminjaman = query("
      SELECT * FROM peminjaman, buku WHERE peminjaman.id_buku = buku.id AND 
      (buku.lokasi LIKE '%$cari%' OR
      buku.judul LIKE '%$cari%' OR
      peminjaman.nama_peminjam LIKE '%$cari%' OR
      peminjaman.alamat_peminjam LIKE '%$cari%' OR
      peminjaman.notelp_peminjam LIKE '%$cari%' OR
      peminjaman.status_peminjaman LIKE '%$cari%')  
      ");
} else {
    echo mysqli_error($conn);
}

if (isset($_GET["moling"])) {
    $lokasi = $_GET['moling'];
    $peminjaman_filter = query("SELECT * FROM peminjaman, buku WHERE peminjaman.id_buku = buku.id AND buku.lokasi = '$lokasi' group by buku.lokasi asc");

    if (isset($_POST["submitcari"])) {
        $cari = $_POST['cari'];
        $peminjaman_filter = query("
      SELECT * FROM peminjaman, buku WHERE peminjaman.id_buku = buku.id AND buku.lokasi = '$lokasi' AND 
      (buku.judul LIKE '%$cari%' OR
      peminjaman.nama_peminjam LIKE '%$cari%' OR
      peminjaman.alamat_peminjam LIKE '%$cari%' OR
      peminjaman.notelp_peminjam LIKE '%$cari%' OR
      peminjaman.status_peminjaman LIKE '%$cari%')  
      group by buku.lokasi asc");
    }
} else {
    echo mysqli_error($conn);
}

if (isset($_POST["dikembalikan"])) {
    if (dikembalikan($_POST) > 0) {
        echo "
            <script>
               alert('data berhasil dikembalikan');
               document.location.href = 'peminjaman.php';
            </script>
         ";
    } else {
        echo "
				<script>
					alert('data gagal dikembalikan');
					document.location.href = 'peminjaman.php';
				</script>
			";
    }
}


if (isset($_POST["update_pengembalian"])) {
    if (update_pengembalian($_POST) > 0) {
        echo "
            <script>
               alert('Perpanjangan berhasil');
               document.location.href = 'peminjaman.php';
            </script>
         ";
    } else {
        echo "
				<script>
					alert('Perpanjangan tidak berhasil');
					document.location.href = 'peminjaman.php';
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
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <form action="" method="post">
                                <table border="0px" cellspacing="0px" cellpadding="0px">
                                    <tr>
                                        <td><input type="text" name="cari" size="30px" autofocus placeholder="Cari Buku" autocomplete="off" id="search"></td>
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
                                                        <a class="dropdown-item" href="peminjaman.php">Semua Lokasi</a>
                                                        <div class="dropdown-divider"></div>
                                                    </li>
                                                    <li>
                                                        <?php foreach ($moling_select as $data) : ?>
                                                            <a class="dropdown-item" href="peminjaman.php?moling=<?= $data['lokasi']; ?>"><?= $data['lokasi'] ?></a>
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
                                                        Lokasi
                                                    </th>
                                                    <th>
                                                        Nama
                                                    </th>
                                                    <th>
                                                        Alamat
                                                    </th>
                                                    <th>
                                                        No Telpon
                                                    </th>
                                                    <th>
                                                        Tanggal Pinjam
                                                    </th>
                                                    <th>
                                                        Tanggal Kembali
                                                    </th>
                                                    <th>
                                                        Status Peminjaman
                                                    </th>
                                                    <th>
                                                        Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <!-- Body Goes Here -->
                                            <tbody>
                                                <?php if (isset($_GET['moling'])) : ?>
                                                    <?php $i = 1;
                                                    foreach ($peminjaman_filter as $pmj) : ?>
                                                        <tr>
                                                            <td>
                                                                <?= $i ?>
                                                            </td>
                                                            <td>
                                                                <img width="auto" height="100px" src="images/<?= $pmj["judul"]; ?>/<?= $pmj["cover"] ?>" alt="<?= $pmj["cover"] ?>">
                                                            </td>
                                                            <td>
                                                                <?= $pmj["judul"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["lokasi"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["nama_peminjam"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["alamat_peminjam"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["notelp_peminjam"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["tanggal_pinjam"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["tanggal_kembali"]; ?>
                                                            </td>
                                                            <?php
                                                            $tanggal_kembali_timestamp = strtotime($pmj['tanggal_kembali']);
                                                            $tanggal_kembali = date('Y-m-d', $tanggal_kembali_timestamp);
                                                            $curdate = date('Y-m-d', time());
                                                            $hari_kelebihan = date('d', time()) - date('d', $tanggal_kembali_timestamp);
                                                            ?>
                                                            <?php if ($tanggal_kembali < $curdate) : ?>
                                                                <td>
                                                                    <p>Terlambat: <?= $hari_kelebihan ?> Hari </p>
                                                                    <p>Total Denda: Rp. <?= $hari_kelebihan * 3000 ?></p>
                                                                </td>
                                                            <?php else : ?>
                                                                <td>
                                                                    <?= $pmj["status_peminjaman"]; ?><p></p>
                                                                </td>
                                                            <?php endif; ?>
                                                            <td>
                                                                <?php if ($tanggal_kembali > $curdate) : ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" name="id_pinjam" value="<?= $pmj["id_pinjam"]; ?>">
                                                                        <input type="hidden" name="id_buku" value="<?= $pmj["id_buku"]; ?>">
                                                                        <input type="hidden" name="tanggal_kembali" value="<?= $pmj["tanggal_kembali"]; ?>">
                                                                        <button type="submit" id="update_pengembalian" name="update_pengembalian" class="btn btn-info btn-fw">Perpanjangan</button>
                                                                    </form>
                                                                <?php else : ?>
                                                                    <p>Terlambat, Harus Bayar Denda</p>
                                                                <?php endif; ?>
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="id_pinjam" value="<?= $pmj["id_pinjam"]; ?>">
                                                                    <input type="hidden" name="id_buku" value="<?= $pmj["id_buku"]; ?>">
                                                                    <button type="submit" id="dikembalikan" name="dikembalikan" class="btn btn-success btn-fw">Kembali</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php $i++;
                                                    endforeach ?>
                                                <?php else : ?>



                                                    <?php $i = 1;
                                                    foreach ($peminjaman as $pmj) : ?>
                                                        <tr>
                                                            <td>
                                                                <?= $i ?>
                                                            </td>
                                                            <td>
                                                                <img width="auto" height="100px" src="images/<?= $pmj["judul"]; ?>/<?= $pmj["cover"] ?>" alt="<?= $pmj["cover"] ?>">
                                                            </td>
                                                            <td>
                                                                <?= $pmj["judul"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["lokasi"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["nama_peminjam"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["alamat_peminjam"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["notelp_peminjam"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["tanggal_pinjam"]; ?>
                                                            </td>
                                                            <td>
                                                                <?= $pmj["tanggal_kembali"]; ?>
                                                            </td>
                                                            <?php
                                                            $tanggal_kembali_timestamp = strtotime($pmj['tanggal_kembali']);
                                                            $tanggal_kembali = date('Y-m-d', $tanggal_kembali_timestamp);
                                                            $curdate = date('Y-m-d', time());
                                                            $hari_kelebihan = date('d', time()) - date('d', $tanggal_kembali_timestamp);
                                                            ?>
                                                            <?php if ($tanggal_kembali < $curdate) : ?>
                                                                <td>
                                                                    <p>Terlambat: <?= $hari_kelebihan ?> Hari </p>
                                                                    <p>Total Denda: Rp. <?= $hari_kelebihan * 3000 ?></p>
                                                                </td>
                                                            <?php else : ?>
                                                                <td>
                                                                    <?= $pmj["status_peminjaman"]; ?> <p></p>
                                                                </td>
                                                            <?php endif; ?>
                                                            <td>
                                                                <?php if ($tanggal_kembali > $curdate) : ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" name="id_pinjam" value="<?= $pmj["id_pinjam"]; ?>">
                                                                        <input type="hidden" name="id_buku" value="<?= $pmj["id_buku"]; ?>">
                                                                        <input type="hidden" name="tanggal_kembali" value="<?= $pmj["tanggal_kembali"]; ?>">
                                                                        <button type="submit" id="update_pengembalian" name="update_pengembalian" class="btn btn-info btn-fw">Perpanjangan</button>

                                                                    </form>
                                                                <?php else : ?>
                                                                    <p>Terlambat, Harus Bayar Denda</p>
                                                                <?php endif; ?>
                                                                <form action="" method="post">
                                                                    <input type="hidden" name="id_pinjam" value="<?= $pmj["id_pinjam"]; ?>">
                                                                    <input type="hidden" name="id_buku" value="<?= $pmj["id_buku"]; ?>">
                                                                    <button type="submit" id="dikembalikan" name="dikembalikan" class="btn btn-success btn-fw">Kembali</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php $i++;
                                                    endforeach ?>
                                                <?php endif ?>
                                            </tbody>
                                        </table>
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