<?php

require '../functionsales.php';

session_start();



if (isset($_POST["from"], $_POST["to"])) {
  $username = $_SESSION['username'];
  $from = $_POST["from"];
  $to = $_POST["to"];
  // $from1 = date("Y-m-d", strtotime($from));
  // $to1 = date("Y-m-d", strtotime($to));
  if ($username == "other") {
    $result = mysqli_query($conn, "
    SELECT * FROM sales_kunjungan
    WHERE now_kunjungan BETWEEN '" . $_POST["from"] . "' AND '" . $_POST["to"] . "' ");
  } else {
    $result = mysqli_query($conn, "
    SELECT * FROM sales_kunjungan
    WHERE now_kunjungan BETWEEN '" . $_POST["from"] . "' AND '" . $_POST["to"] . "'
    AND username = '$username'
   ");
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title></title>
  <?php include('head.php'); ?>
</head>

<div class="mt-1">
  <form action="printKunjungan.php" method="POST" target="_blank">
    <input type="hidden" name="from" value="<?= $_POST['from']; ?>">
    <input type="hidden" name="to" value="<?= $_POST['to']; ?>">
    <input type="hidden" name="username" value="<?= $_SESSION['username']; ?>">
    <button type="submit" name="submit" class="btn btn-success">Print</button>
  </form>

</div>

<body>
  <div class="container-footer">
    <!-- buat footer -->


    <div class="container-fluid content1">
      <!-- class content buat footer -->
      <div class="justify-content-md-center kunjungan_rprt">

        <div style="overflow-x: auto; padding: 5px;">
          <table id="example" class="table_kunjungan" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
            <thead>
              <tr>
                <th>
                  <center>No</center>
                </th>
                <th>
                  <center>Nama Customer</center>
                </th>
                <th>
                  <center>Mobile/HP</center>
                </th>
                <th>
                  <center>Email</center>
                </th>
                <th>
                  <center>Posisi</center>
                </th>
                <th>
                  <center>Perusahaan</center>
                </th>
                <th>
                  <center>Alamat</center>
                </th>
                <th>
                  <center>Telp/.Fax</center>
                </th>
                <th>
                  <center>In/Q/R</center>
                </th>
                <th>
                  <center>Tgl Kunjungan</center>
                </th>
                <th>
                  <center>Nama Sales</center>
                </th>
              </tr>
            </thead>
            <tr>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) : ?>
                <td><?php echo $no; ?></td>
                <td><?php echo $row['nama_kunjungan']; ?></td>
                <td><?php echo $row['hp_kunjungan']; ?></td>
                <td><?php echo $row['email_kunjungan']; ?></td>
                <td><?php echo $row['jabatan_kunjungan']; ?></td>
                <td><?php echo $row['rs_kunjungan']; ?></td>
                <td>

                  <?php echo $row['kota_kunjungan']; ?>
                </td>
                <td><?php echo $row['tlp_kunjungan']; ?></td>
                <td><?php echo $row['req_kunjungan']; ?></td>
                <td><?php echo $row['now_kunjungan']; ?></td>
                <?php
                $username313 = $row['username'];
                $result2 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username313' "); ?>
                <?php ($rownama = mysqli_fetch_assoc($result2)) ?>
                <td><?php echo $rownama['name']; ?></td>

                <?php $no++; ?>
            </tr>
          <?php endwhile; ?>
          </table>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $('#example').DataTable({
          "order": [
            [0, "dsc"]
          ],
          "deferRender": true
        });
      });
    </script>
</body>

</html>