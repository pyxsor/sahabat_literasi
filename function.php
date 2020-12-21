<?php

$conn = mysqli_connect("localhost", "root", "", "sahabat_literasi");

function query($query)
{
   global $conn;
   $result = mysqli_query($conn, $query);
   $record = [];

   while ($data = mysqli_fetch_assoc($result)) {
      $record[] = $data;
   }
   return $record;
}


function registrasi($data)
{
   global $conn;

   $username = strtolower(stripslashes($data["username"]));
   $password = mysqli_real_escape_string($conn, $data["password"]);
   $password2 = mysqli_real_escape_string($conn, $data["password2"]);

   $result = mysqli_query($conn, "SELECT username FROM user WHERE username= '$username'");
   $row = mysqli_fetch_assoc($result);
   var_dump($row);

   if (mysqli_fetch_assoc($result)) {
      echo "<script>
               alert('username sudah terdaftar'); 
            </script>";
      return false;
   }

   if ($password !== $password2) {
      echo "<script>
      alert('konfirmasi password tidak sesuai') </script>";
      return false;
   }

   $password = password_hash($password, PASSWORD_DEFAULT);
   // $password = md5($password);
   // var_dump($password);
   // die;

   mysqli_query($conn, "INSERT INTO user VALUES ('','$username','$password')");

   echo mysqli_error($conn);
   return mysqli_affected_rows($conn);
}

function input($data)
{
   global $conn;
   $id = htmlspecialchars($data["id"]);
   $judul = htmlspecialchars($data["judul"]);
   $penulis = htmlspecialchars($data["penulis"]);
   $tahun = htmlspecialchars($data["tahun"]);
   $penerbit = htmlspecialchars($data["penerbit"]);
   $lokasi = htmlspecialchars($data["lokasi"]);
   $status = htmlspecialchars($data["status"]);
   $cover = upload();

   if (!$cover) {
      return false;
   }

   $query = "INSERT INTO buku VALUES ('$id','$judul','$penulis','$tahun','$penerbit','$lokasi','$status','$cover');";

   mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}

function upload()
{
   $namaFile = $_FILES['cover']['name'];
   $ukuranFile = $_FILES['cover']['size'];
   $error = $_FILES['cover']['error'];
   $tmpName = $_FILES['cover']['tmp_name'];

   var_dump($_FILES);

   if ($error === 4) {
      echo
         "<script>
			alert('Pilih gambar terlebih dahulu');
		</script>";
      return false;
   }

   $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
   $ekstensiGambar = explode('.', $namaFile);
   $ekstensiGambar = strtolower(end($ekstensiGambar));

   echo $namaFile . $ekstensiGambar;
   if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
      echo
         "<script>
			alert('Yang diupload harus gambar');
		</script>";
      return false;
   }

   if ($ukuranFile > 1000000) {
      echo
         "<script>
			alert('File gambar minimal berukuran 1024kb');
		</script>";
      return false;
   }

   $namaFileBaru = $_POST['judul']  . "_" . uniqid() . "." . $ekstensiGambar;

   $path = "images/" . $_POST['judul'];
   if (file_exists($path)) {
      move_uploaded_file($tmpName, 'images/' . $_POST['judul'] . "/" . $namaFileBaru);
   } else {
      mkdir($path, 0777, true);
      move_uploaded_file($tmpName, 'images/' . $_POST['judul'] . "/" . $namaFileBaru);
   }

   return $namaFileBaru;
}

function delete($id)
{
   global $conn;
   $query = "DELETE FROM buku WHERE id = $id`;";
   mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}
