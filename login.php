<?php
session_start();
require "function.php";

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];

   $query = "SeLECT username FROM user WHERE id = '$id';";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_assoc($result);

   if ($key === hash('sha256', $row['username'])) {
      $_SESSION['login'] = true;
   }
}

if (isset($_SESSION["login"])) {
   header("Location: dashboard.php");
   exit;
}

if (isset($_POST["login"])) {

   $username = $_POST["username"];
   $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username';");

   // cek username
   if (mysqli_num_rows($result) === 1) {
      //cek password
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {
         // set session
         $_SESSION['login'] = true;

         if (isset($_POST['remember'])) {
            setcookie('id', $row['id'], time() + 60);
            setcookie('key', hash('sha256', $row['username']), time() + 60);
         }

         header("Location: dashboard.php");
         exit;
      }
   }

   $error = true;
}

?>


<!DOCTYPE html>
<html lang="id">

<head>
   <title>Halaman Login</title>
   <!-- Meta Tag untuk Bootstrap & PHP -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstraps File -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

   <!-- CSS File -->
   <link rel="stylesheet" href="css/login.css">

</head>

<body>

   <!-- jQuery + Bootstraps Bundle -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
   <script src="js/font-awesome.min.js"></script>

   <?php if (isset($error)) : ?>
      <div class="alert alert-danger" role="alert">
         Username / Password Anda Salah, Silahkan Coba Lagi!
      </div>
   <?php endif; ?>

   <div class="container">
      <div class="row d-flex justify-content-center">
         <div class="col">
         </div>
         <div class="col-md pt-5 mt-5">
            <div class="login-box align-self-center mt-5">
               <h3 class="login-header"><i class="fas fa-user"></i> Login</h3>
               <div id="form">
                  <form action="" method="POST">
                     <div class="form-group">
                        <label for="inputUsername">Username</label>
                        <input placeholder="Masukkan Username Anda" type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
                     </div>
                     <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input placeholder="Masukkan Password Anda" type="password" class="form-control" name="password" id="password">
                     </div>
                     <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ingat Aku</label>
                     </div>
                     <button type="submit" name="login" class="btn btn-success w-100 mb-3">Submit</button>
                  </form>
               </div>
            </div>
            <a class="btn btn-primary btn-fw" w-40 mb-3" href="index.php">Back Home</a>
         </div>
      </div>
</body>

</html>