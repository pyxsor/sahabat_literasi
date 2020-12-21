<?php

require "function.php";

$id = $_GET["id"];

if (delete($id) > 0) {
   echo
      "<script>
		alert('Data Buku Terhapus');
		document.location.href = 'read.php';
	</script>";
} else {
   echo
      "<script>
		alert('Data Buku Tidak Dapat Terhapus');
	</sciprt>";
   echo "<br> Error : " . mysqli_error($conn);
}
