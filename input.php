<?php
session_start();
require_once "function.php";

if (!isset($_SESSION['login'])) {
   header("Location: login.php");
   exit;
}


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
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Input Buku</title>
</head>

<body>
   <h1>Input Data Buku</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <table border=" 0px">
         <tr>
            <input type="hidden" name="id">
         </tr>
         <tr>
            <td>
               <label for="judul">JUDUL </label>
            <td align="center">:</td>
            <td><input type="text" name="judul" id="judul" required></td>
            </td>
         </tr>
         <tr>
            <td>
               <label>PENULIS </label>
            <td align="center">:</td>
            <td><input type="text" name="penulis" required></td>
            </td>
         </tr>
         <tr>
            <td>
               <label for="id">TAHUN </label>
            <td align="center">:</td>
            <td><input type="text" name="tahun" required></td>
            </td>
         </tr>
         <tr>
            <td>
               <label for="id">PENERBIT </label>
            <td align="center">:</td>
            <td><input type="text" name="penerbit" required></td>
            </td>
         </tr>
         <tr>
            <td>
               <label for="id">LOKASI </label>
            <td align="center">:</td>
            <td>
               <select name="lokasi" id="lokasi">
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
               <select name="status" id="status">
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
            <td><input type="file" name="cover" id="cover"></td>
            </td>
         </tr>
         <tr>
            <td>
               <br>
               <button type="submit" name="submit" align="center">INPUT BUKU</button>
            </td>
         </tr>
      </table>
   </form>


</body>

</html>