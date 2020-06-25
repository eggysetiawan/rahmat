<?php

require '../functionsales.php';
$pk_penawaran = $_POST['penawaran_fk'];

$query = "SELECT * FROM sales_funnel  WHERE penawaran_fk = '$pk_penawaran'";
$value = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($value);

$query2 =  "SELECT * FROM sales_funnel INNER JOIN inti_user ON sales_funnel.username = inti_user.username  WHERE sales_funnel.penawaran_fk = '$pk_penawaran'";
$value2 = mysqli_query($conn, $query2);

?>
<center><?= $row['no_penawaran']; ?></center><br>
<div class="fill">


    <?php while ($rowdetail = mysqli_fetch_assoc($value2)) : ?>
        <div class="detail-table">

            <table>
                </tr>
                <tr>
                    <td>Nama Rumah Sakit</td>
                    <td>:</td>
                    <td> <?= $rowdetail['rs_funnel'];  ?></td>
                </tr>

                <tr>
                    <td>Kota</td>
                    <td>:</td>
                    <td> <?= $rowdetail['kota_funnel'];  ?></td>
                </tr>
                <tr>
                    <td>Referensi Funnel</td>
                    <td>:</td>
                    <td> <?= $rowdetail['referensi_funnel'];  ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>Nama Sales</td>
                    <td>:</td>
                    <td><?= $rowdetail['name']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Demo</td>
                    <td>:</td>
                    <td><?= $rowdetail['tgl_presentasi']; ?></td>
                </tr>
                <tr>
                    <td>Untuk Mempresentasikan</td>
                    <td>:</td>
                    <td> <?= $rowdetail['mod_presentasi'];  ?></td>
                </tr>
                <br>
            </table><br><br>
        </div>
        <br>
        <p>
        <?php endwhile; ?>
        <?php
        $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>

        <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
            <h3><?= "Total Harga Penawaran"; ?> <?= rupiah($row332['totalharga']); ?></h3>
        <?php endwhile; ?>
</div>