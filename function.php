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
