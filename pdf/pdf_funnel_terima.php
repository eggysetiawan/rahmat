<?php
require '../koneksi/koneksi.php';
$pk = $_GET['pk'];
$result2 = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE pk = '$pk'");
$row = mysqli_fetch_assoc($result2);
$gambar = $row['resi_terima'];
if ($gambar == "") {
  echo "<script>alert('Silahkan upload resi terlebih dahulu');
          window.close();</script>";
  exit();
}
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $gambar . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
@readfile($gambar);
