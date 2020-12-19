<?php
session_start();

if (!isset($_SESSION["login"])) {
   header("Location: login.php");
   exit;
}

require "function.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   <h1>Sahabat Literasi</h1>
   <a href="logout.php">Logout</a>

</body>

</html>