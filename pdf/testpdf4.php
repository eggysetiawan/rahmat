<?php
require '../koneksi/koneksi.php';
$no_penawaran = $_GET['no_penawaran'];
$result2 = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$no_penawaran'");
$row = mysqli_fetch_assoc($result2);
$gambar = $row['gambar'];
if ($gambar == "") {
    echo "<script>alert('Silahkan Upload Penawaran Terlebih Dahulu');
          window.close();</script>";
    exit();
}
  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $gambar . '"');
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
  @readfile($gambar);
?>