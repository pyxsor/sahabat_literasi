<?php
session_start();
if (isset($_SESSION["login"])) {
   header("Location: index.php");
   exit;
}

require "function.php";
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
            <button type="submit" name="login">LOGIN</button>
         </p>
      </form>
   </div>
</body>

</html>