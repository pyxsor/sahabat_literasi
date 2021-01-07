<?php

require "function.php";
global $conn;
$peminjaman = query("SELECT * FROM peminjaman, buku WHERE peminjaman.id_buku = buku.id;");
$buku = query("SELECT * FROM buku;");
$moling_select = query("SELECT * FROM peminjaman, buku group by buku.lokasi asc;");

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
      group by buku.lokasi asc");
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
               <li><a href="peminjaman.php">Search All</a></li>
               <?php foreach ($moling_select as $data) : ?>
                  <li><a href="peminjaman.php?moling=<?= $data['lokasi']; ?>"><?= $data['lokasi'] ?></a></li>
               <?php endforeach; ?>
            </td>
         </tr>
      </table>
   </form>

   <form action="" method="post">
      <table border="0px" cellspacing="0px" cellpadding="4px">
         <tr>
            <td><input type="text" name="cari" size="30px" autofocus placeholder="Cari Buku" autocomplete="off" id="search"></td>
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
         <th>BUKU</th>
         <th>JUDUL</th>
         <th>LOKASI</th>
         <th>NAMA</th>
         <th>ALAMAT</th>
         <th>NO TELP</th>
         <th>TANGGAL PINJAM</th>
         <th>TANGGAL KEMBALI</th>
         <th>STATUS PEMINJAMAN</th>
         <th>PILIH</th>
      </tr>

      <?php if (isset($_GET['moling'])) : ?>
         <?php $i = 1;
         foreach ($peminjaman_filter as $pmj) : ?>
            <tr>
               <td align="center"><?= $i ?></td>
               <td align="center"><img width="auto" height="100px" src="images/<?= $pmj["judul"]; ?>/<?= $pmj["cover"] ?>" alt="<?= $pmj["cover"] ?>"></td>
               <td><?= $pmj["judul"]; ?></td>
               <td><?= $pmj["lokasi"]; ?></td>
               <td><?= $pmj["nama_peminjam"]; ?></td>
               <td><?= $pmj["alamat_peminjam"]; ?></td>
               <td><?= $pmj["notelp_peminjam"]; ?></td>
               <td><?= $pmj["tanggal_pinjam"]; ?></td>
               <td><?= $pmj["tanggal_kembali"]; ?></td>
               <?php
               $tanggal_kembali_timestamp = strtotime($pmj['tanggal_kembali']);
               $tanggal_kembali = date('Y-m-d', $tanggal_kembali_timestamp);
               $curdate = date('Y-m-d', time());
               $hari_kelebihan = date('d', time()) - date('d', $tanggal_kembali_timestamp);
               ?>
               <?php if ($tanggal_kembali < $curdate) : ?>
                  <td>Denda
                     <p>Terlambat: <?= $hari_kelebihan ?> Hari </p>
                     <p>Total Denda: Rp. <?= $hari_kelebihan * 3000 ?></p>
                  </td>
               <?php else : ?>
                  <td><?= $pmj["status_peminjaman"]; ?> <p></p>
                  </td>
               <?php endif; ?>
               <td>
                  <?php if ($tanggal_kembali > $curdate) : ?>
                     <form action="" method="post">
                        <input type="hidden" name="id_pinjam" value="<?= $pmj["id_pinjam"]; ?>">
                        <input type="hidden" name="id_buku" value="<?= $pmj["id_buku"]; ?>">
                        <input type="hidden" name="tanggal_kembali" value="<?= $pmj["tanggal_kembali"]; ?>">
                        <button type="submit" id="update_pengembalian" name="update_pengembalian">Perpanjangan</button>
                     </form>
                  <?php else : ?>
                     <p>Dibayar boz dendae</p>
                  <?php endif; ?>
                  <form action="" method="post">
                     <input type="hidden" name="id_pinjam" value="<?= $pmj["id_pinjam"]; ?>">
                     <input type="hidden" name="id_buku" value="<?= $pmj["id_buku"]; ?>">
                     <button type="submit" id="dikembalikan" name="dikembalikan">Kembali</button>
                  </form>
               </td>
            </tr>
         <?php $i++;
         endforeach ?>
      <?php else : ?>


         <?php $i = 1;
         foreach ($peminjaman as $pmj) : ?>
            <tr>
               <td align="center"><?= $i ?></td>
               <td align="center"><img width="auto" height="100px" src="images/<?= $pmj["judul"]; ?>/<?= $pmj["cover"] ?>" alt="<?= $pmj["cover"] ?>"></td>
               <td><?= $pmj["judul"]; ?></td>
               <td><?= $pmj["lokasi"]; ?></td>
               <td><?= $pmj["nama_peminjam"]; ?></td>
               <td><?= $pmj["alamat_peminjam"]; ?></td>
               <td><?= $pmj["notelp_peminjam"]; ?></td>
               <td><?= $pmj["tanggal_pinjam"]; ?></td>
               <td><?= $pmj["tanggal_kembali"]; ?></td>
               <?php
               $tanggal_kembali_timestamp = strtotime($pmj['tanggal_kembali']);
               $tanggal_kembali = date('Y-m-d', $tanggal_kembali_timestamp);
               $curdate = date('Y-m-d', time());
               $hari_kelebihan = date('d', time()) - date('d', $tanggal_kembali_timestamp);
               ?>
               <?php if ($tanggal_kembali < $curdate) : ?>
                  <td>Denda
                     <p>Terlambat: <?= $hari_kelebihan ?> Hari </p>
                     <p>Total Denda: Rp. <?= $hari_kelebihan * 3000 ?></p>
                  </td>
               <?php else : ?>
                  <td><?= $pmj["status_peminjaman"]; ?> <p></p>
                  </td>
               <?php endif; ?>
               <td>
                  <?php if ($tanggal_kembali > $curdate) : ?>
                     <form action="" method="post">
                        <input type="hidden" name="id_pinjam" value="<?= $pmj["id_pinjam"]; ?>">
                        <input type="hidden" name="id_buku" value="<?= $pmj["id_buku"]; ?>">
                        <input type="hidden" name="tanggal_kembali" value="<?= $pmj["tanggal_kembali"]; ?>">
                        <button type="submit" id="update_pengembalian" name="update_pengembalian">Perpanjangan</button>
                     </form>
                  <?php else : ?>
                     <p>Dibayar boz dendae</p>
                  <?php endif; ?>
                  <form action="" method="post">
                     <input type="hidden" name="id_pinjam" value="<?= $pmj["id_pinjam"]; ?>">
                     <input type="hidden" name="id_buku" value="<?= $pmj["id_buku"]; ?>">
                     <button type="submit" id="dikembalikan" name="dikembalikan">Kembali</button>
                  </form>
               </td>
            </tr>
         <?php $i++;
         endforeach ?>
      <?php endif ?>
   </table>

</body>

</html>