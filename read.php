<?php

require "function.php";
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
   $moling = query("SELECT * FROM buku WHERE lokasi = '$lokasi' group by lokasi asc");

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
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lihat Buku</title>

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
   <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
   <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>

<body>

   <form action="" method="post">
      <table border="0 px">
         <tr>
            <td>
               <!-- INI NANTI DIBIKIN DROPDOWN -->
               <!-- ======== RESOURCE ======== -->
               <!-- https://getbootstrap.com/docs/5.0/components/dropdowns/ -->
               <li><a href="read.php">Search All</a></li>
               <?php foreach ($moling_select as $data) : ?>
                  <li><a href="read.php?moling=<?= $data['lokasi']; ?>"><?= $data['lokasi'] ?></a></li>
               <?php endforeach; ?>
            </td>
         </tr>
      </table>
   </form>

   <form action="" method="post">
      <table border="0px" cellspacing="0px" cellpadding="4px">
         <tr>
            <td><input type="text" name="search" size="30px" autofocus placeholder="Cari Buku" autocomplete="off" id="search"></td>
            <td>
               <button type="submit" name="submitcari" id="submitcari">Cari Buku</button>
            </td>
         </tr>
      </table>
      <br>

   </form>

   <table border="1px" cellpadding="6px">
      <tr>
         <th>NO</th>
         <th>GAMBAR</th>
         <th>JUDUL</th>
         <th>PENULIS</th>
         <th>TAHUN</th>
         <th>PENERBIT</th>
         <th>LOKASI</th>
         <th>STATUS</th>
         <th>PILIH</th>
      </tr>

      <?php if (isset($_GET['moling'])) : ?>
         <?php $i = 1;
         foreach ($moling as $bk) : ?>
            <tr>
               <td align="center"><?= $i ?></td>
               <td align="center"><img width="auto" height="100px" src="images/<?= $bk["judul"]; ?>/<?= $bk["cover"] ?>" alt="<?= $bk["cover"] ?>"></td>
               <td><?= $bk["judul"]; ?></td>
               <td><?= $bk["penulis"]; ?></td>
               <td><?= $bk["tahun"]; ?></td>
               <td><?= $bk["penerbit"]; ?></td>
               <td><?= $bk["lokasi"]; ?></td>
               <td><?= $bk["status"]; ?></td>
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
               <td align="center"><?= $i ?></td>
               <td align="center"><img width="auto" height="100px" src="images/<?= $bk["judul"]; ?>/<?= $bk["cover"] ?>" alt="<?= $bk["cover"] ?>"></td>
               <td><?= $bk["judul"]; ?></td>
               <td><?= $bk["penulis"]; ?></td>
               <td><?= $bk["tahun"]; ?></td>
               <td><?= $bk["penerbit"]; ?></td>
               <td><?= $bk["lokasi"]; ?></td>
               <td><?= $bk["status"]; ?></td>
               <td>
                  <a class="pinjam" href="" data-toggle="modal" data-target="#formModal-input" data-id_buku="<?= $bk['id'] ?>" data-status="<?= $bk['status'] ?>">Pinjam</a> |
                  <a href="update.php?id=<?= $bk["id"]; ?>">Update</a> |
                  <a href="delete.php?id=<?= $bk["id"]; ?>" onclick="return confirm('yakin dihapus?');">Delete</a>
               </td>
            </tr>
         <?php $i++;
         endforeach ?>
      <?php endif ?>
   </table>

   <!-- tambah peminjaman -->
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
   <!-- ------------------------ -->

   <script src="js/js/jquery-3.5.1.js"></script>
   <script src="js/js/jquery-3.5.1.min.js"></script>
   <script src="js/js/popper.min.js"></script>
   <script src="js/js/bootstrap.js"></script>
   <script src="js/js/bootstrap.min.js"></script>
   <!-- <script src="js/js/bootstrap.bundle.js"></script> -->
   <!-- <script src="js/js/bootstrap.bundle.min.js"></script> -->
   <script src="js/js/font-awesome.min.js"></script>
   <!-- <script src="js/script.js"></script> -->

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