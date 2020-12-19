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
   header("Location: index.php");
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

         header("Location: index.php");
         exit;
      }
   }

   $error = true;
}

?>


<!DOCTYPE html>
<html>

<head>
   <title>login</title>
</head>

<body>
   <h1>HALAMAN LOGIN</h1>
   <?php if (isset($error)) : ?>
      <p style="color: red; font-style: italic">username / password salah</p>
   <?php endif; ?>

   <div id="form">
      <form action="" method="POST">
         <p>
            <label>Username : </label>
            <input type="text" id="username" name="username">
         </p>
         <p>
            <label>Password : </label>
            <input type="password" id="password" name="password">
         </p>
         <p>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Ingat aku</label>
         </p>
         <p>
            <button type="submit" name="login">LOGIN</button>
         </p>
      </form>
   </div>
</body>

</html>