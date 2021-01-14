<?php

require "function.php";

if (!isset($_SESSION['login']) && $_SESSION['login'] = false) {
   echo $_SESSION['login'];
   // header("Location: index.php");
   exit;
}

// Aku tak record dulu yo, ini aku blm nemu solusinya. kok nek masuk read tetep gamau tampil peminjamane, pas tak debug pakek isset session e gak kebuat. tapi nek dashborad mau.
// Saranku nek mau pakek templating ben ga bingung naruh2 sidebar di tiap page harus dikasii $_SESSION $_SESSION apala apala, 
// jadi nek mau. langsung ae yang dikasi session yang satu sidebar.php njejeg dikasi session tapi bisa ditaruh dimana2. (Templating)

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
               document.location.href = 'rak.php';
            </script>
         ";
   } else {
      echo "
				<script>
					alert('data gagal ditambahkan');
					document.location.href = 'rak.php';
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
      </nav>
      <!-- End Navbar -->

      <!-- Start Body -->
      <div class="container-fluid page-body-wrapper">

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
                                          <a class="dropdown-item" href="rak.php">Semua Lokasi</a>
                                          <div class="dropdown-divider"></div>
                                       </li>
                                       <li>
                                          <?php foreach ($moling_select as $data) : ?>
                                             <a class="dropdown-item" href="rak.php?moling=<?= $data['lokasi']; ?>"><?= $data['lokasi'] ?></a>
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
                                          </tr>
                                       <?php $i++;
                                       endforeach ?>
                                    <?php endif ?>
                                 </tbody>
                              </table>
                           </div>
                           <br><br>
                           <a class="btn btn-primary btn-fw" w-40 mb-3" href="index.php">Back Home</a>
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
               <script src="js/js/font-awesome.min.js"></script>

</body>

</html>