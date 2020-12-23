<?php
require 'function.php';

if (isset($_POST["register"])) {

   if (registrasi($_POST) > 0) {
      echo "<script>
      alert('user baru berhasil ditambahkan')
      </script> ";
   } else {
      echo mysqli_error($conn);
   }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
   <!-- Meta Tag -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!-- Bootstraps File -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   <!-- CSS File -->
   <link rel="stylesheet" href="css/registrasi.css">

   <title>Laman Registrasi</title>

   <style>
      label {
         display: block;
      }
   </style>

</head>

<body>
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

   <!-- Grid Untuk Logo -->
   <div class="container-md">
      <div class="row">
         <div class="col-sm">
         </div>
         <div class="col-sm">
            <img src="images/logo.png" class="rounded mx-auto d-block logo-box" alt="Logo Sahabat Literasi">
         </div>
         <div class="col-sm">
         </div>
      </div>
   </div>

   </br></br>
   <!-- Grid Untuk Form -->
   <div class="container-md">
      <div class="row">
         <div class="col">
         </div>
         <div class="col regis-box mt-5">
            <!-- Form Registrasi -->
            <form action="" method="POST">
               <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword2">Ulangi Password</label>
                  <input type="password" class="form-control" id="password2" name="password2">
               </div>
               <a href="login.php">Login</a>
               <a href="index.php">Beranda</a>
               </br>
               <button type="submit" name="register" class="btn btn-primary">Register</button>
            </form>
         </div>
         <div class="col">
         </div>
      </div>
   </div>

</body>

</html>