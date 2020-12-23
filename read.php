<?php

require "function.php";
global $conn;
$buku = query("SELECT * FROM buku;");
$moling_select = query("SELECT * FROM buku;");

if (!isset($_GET['moling']) && isset($_POST["submitcari"])) {
   $buku = search($_POST["search"]);
} else {
   echo mysqli_error($conn);
}

if (isset($_GET["moling"])) {
   $lokasi = $_GET['moling'];
   $moling = query("SELECT * FROM buku WHERE lokasi = '$lokasi'");

   if (isset($_POST["submitcari"])) {
      $judul = $_POST['search'];
      $moling = query("SELECT * FROM buku WHERE lokasi = '$lokasi' && judul LIKE '%$judul%'");
   }
} else {
   echo mysqli_error($conn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lihat Buku</title>
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
                  <a href="update.php?id=<?= $bk["id"]; ?>">Update</a> |
                  <a href="delete.php?id=<?= $bk["id"]; ?>" onclick="return confirm('yakin dihapus?');">Delete</a>
               </td>
            </tr>
         <?php $i++;
         endforeach ?>
      <?php endif ?>
   </table>
</body>

</html>