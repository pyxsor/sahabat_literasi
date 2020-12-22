<?php

require "function.php";
global $conn;
$buku = query("SELECT * FROM buku;");

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Lihat Buku</title>
</head>

<body>
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
   </table>
</body>

</html>