<?php

require '../functionsales.php';

session_start();



if (isset($_POST["from"], $_POST["to"], $_POST['username'])) {
    $username = $_POST['username'];
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
$resultName = mysqli_query($conn, "SELECT * FROM inti_user WHERE username =  '$username'");
$rowNama = mysqli_fetch_assoc($resultName);
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <?php include('head.php'); ?>
</head>

<div class="mt-1">


</div>

<body>
    <div class="fill" id="div-id-name">
        <div class="container-fluid logo-ipi">
            <center><img src="../image/logoipi.png" style="width: 220px"></center>
        </div>

        <div class="justify-content-md-center">
            Nama Sales : <?= $rowNama['name']; ?><br>
            Email : <?= $rowNama['email']; ?><br><br>

            <div style="overflow-x: auto; padding: 5px;">
                <table id="" class="table_kunjungan" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
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

                            <?php $no++; ?>
                    </tr>
                <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
    <div align="center">

        <?php
        date_default_timezone_set('Asia/Jakarta');
        $datePrint = date('Y-m-d H:i');
        echo "Printed on : $datePrint"
        ?>
    </div>

    </div>
    </div>
    <center> <a href="#" name="printTime" id="print" onclick="javascript: printlayer('div-id-name')" class="btn btn-warning">Print Report!</a></center>
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

    <script type="text/javascript">
        function printlayer(layer) {
            var generator = window.open(",'name',")
            var layertext = document.getElementById(layer);
            generator.document.write(layertext.innerHTML.replace("Print Me"));

            generator.document.close();
            generator.print();
            generator.close();
        }
    </script>
</body>

</html>