<?php
session_start();
require "function.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Meta Tag -->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   <!-- CSS File -->
   <link rel="stylesheet" href="css/index.css">

   <title>Sahabat Literasi: Teman Baca Terbaik Anda</title>
</head>

<body>
   <!-- Bootstraps Bundle + jQuery -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
   <!-- Local File JS -->
   <script src="js/font-awesome.min.js"></script>

   <!-- Kotak Kanan Untuk Index -->
   <div class="container-md welcome-box">
      <div class="row d-flex justify-content-center">
         <div class="col">
         </div>
         <div class="col-md mb-3 pb-3">
            <!-- Logo -->
            <img src="images/logo.png" class="img-fluid" alt="Logo Sahabat Literasi">


            <!-- Kotak Index -->
            <div class="login-box align-self-center mt-5">
               <h3 class="login-header"><i class="fas fa-book-reader"></i> Selamat Datang</h3>
               <div class="tombol mt-3 align-self-center ml-5 p-3">
                  <a class="btn btn-success ml-5" href="login.php" role="button">Login</a>
                  <a class="btn btn-success ml-5" href="lokasi.php" role="button">Lokasi</a>
                  <a class="btn btn-success ml-5" href="read.php" role="button">Rak Kita</a>
               </div>
            </div>
         </div>
      </div>
   </div>

   </br></br></br>
   <!-- Social Media Connect -->

   <div class="container-md">
      <div class="row align-self-md-center">
         <div class="col">
         </div>
         <div class="col-5 social-box p-3">
            <h6 class="social-info align-self-md-center"><i class="fab fa-instagram mr-3"></i><i class="fab fa-spotify mr-3"></i><i class=" fab fa-line mr-3"></i> @sahabat_literasi</h6>
         </div>
         <div class="col">
         </div>
      </div>
   </div>


</body>

</html>