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
		</script>";
      echo "<br> Error : " . mysqli_error($conn);
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Buku</title>

</head>

<body>
   <h1>Update Data Buku</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <table border=" 0px" cellspacing="0px" cellpadding="5px">
         <input type="hidden" name="coverLama" value="<?= $buku["cover"]; ?>">
         <tr>
            <input type="hidden" name="id" value="<?= $buku["id"]; ?>">
         </tr>
         <tr>
            <td>
               <label for="judul">JUDUL </label>
            <td align="center">:</td>
            <td><input type="text" name="judul" id="judul" required value="<?= $buku["judul"]; ?>"></td>
            </td>
         </tr>
         <tr>
            <td>
               <label>PENULIS </label>
            <td align="center">:</td>
            <td><input type="text" name="penulis" required value="<?= $buku["penulis"]; ?>"></td>
            </td>
         </tr>
         <tr>
            <td>
               <label for="id">TAHUN </label>
            <td align="center">:</td>
            <td><input type="text" name="tahun" required value="<?= $buku["tahun"]; ?>"></td>
            </td>
         </tr>
         <tr>
            <td>
               <label for="id">PENERBIT </label>
            <td align="center">:</td>
            <td><input type="text" name="penerbit" required value="<?= $buku["penerbit"]; ?>"></td>
            </td>
         </tr>
         <tr>
            <td>
               <label for="id">LOKASI </label>
            <td align="center">:</td>
            <td>
               <select name="lokasi" id="lokasi" required value="<?= $buku["lokasi"]; ?>">
                  <option value="MOLING-1">MOLING-1</option>
                  <option value="MOLING-2">MOLING-2</option>
                  <option value="MOLING-3">MOLING-3</option>
               </select>
            </td>
            </td>
         </tr>
         <tr>
            <td>
               <label for="id">STATUS </label>
            <td align="center">:</td>
            <td>
               <select name="status" id="status" required value="<?= $buku["status"]; ?>">
                  <option value="Tersedia">TERSEDIA</option>
                  <option value="Dipinjam" name="dipinjam">DIPINJAM</option>
               </select>
            </td>
            </td>
         </tr>
         <tr>
            <td>
               <label for="id">COVER </label>
            <td align="center">:</td>
            <td>
               <img width="80px" height="100px" src="images/<?= $buku['judul']; ?>/<?= $buku['cover'] ?>" alt="<?= $buku['judul']; ?>"><br>
               <input type="file" name="cover" id="cover">
            </td>
         </tr>
         <tr>
            <td>
               <br>
               <button type="submit" name="submit" align="center">UPDATE BUKU</button>
            </td>
         </tr>
      </table>
   </form>

</body>

</html>