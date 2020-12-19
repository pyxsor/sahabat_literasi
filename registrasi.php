<?php 
require 'function.php';

if( isset( $_POST["register"]) ){

   if( registrasi($_POST) > 0 ){
      echo "<script>
      alert('user baru berhasil ditambahkan')
      </script> ";
   } else {
      echo mysqli_error($conn);
   }
}
?>

<!DOCOTYPE html>

<html>
   <head>
      <title>Registrasi</title>

      <style>
         label{
            display : block;
         }
      </style>
   </head>
   <body>
      <h1>HALAMAN REGISTRASI</h1>
      <form action="" method="POST">
         <ul>
            <li>
               <label for="username">username : </label>
               <input type="text" name="username" id="username">
            </li>
            <li>
               <label for="password">password : </label>
               <input type="password" name="password" id="password">
            </li>
            <li>
               <label for="password2">repeat password : </label>
               <input type="password" name="password2" id="password2">
            </li>
            <li>
               <button type="submit" name="register"> Sign Up</button>
            </li>
         </ul>
      </form>
   </body>
</html>