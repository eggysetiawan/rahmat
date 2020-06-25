<?php

require '../functionsales.php';
$pk_penawaran = $_POST['penawaran_fk'];

$query = "SELECT * FROM sales_order
INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod
INNER JOIN sales_funnel ON sales_funnel.penawaran_fk = sales_order.fk_penawaran
 WHERE sales_order.fk_penawaran = '$pk_penawaran'";
$value = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($value);

$query2 = "SELECT * FROM sales_order
INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod
INNER JOIN sales_funnel ON sales_funnel.penawaran_fk = sales_order.fk_penawaran
INNER JOIN sales_customer ON sales_funnel.customer_fk = sales_customer.pk_cust
 WHERE sales_order.fk_penawaran = '$pk_penawaran' ORDER BY pk_mod ASC";
$value2 = mysqli_query($conn, $query2);

?>
<center><?= $row['no_penawaran']; ?>``</center><br>
<div class="fill">


    <?php $rowdetail = mysqli_fetch_assoc($value2); ?>

    <div class="detail-table">

        <table>
            <tr>
                <td>Pengiriman ke</td>
                <td>:</td>
                <td> <?= $rowdetail['rs_cust'];  ?></td>
            </tr>
            <tr>
                <td>Kota</td>
                <td>:</td>
                <td> <?= $rowdetail['kota_cust'];  ?></td>
            </tr>
            <tr>
                <td>Kode Rumah Sakit</td>
                <td>:</td>
                <td> <?= $rowdetail['koders_cust'];  ?></td>
            </tr>
            <tr>
                <td>Nama Customer</td>
                <td>:</td>
                <td> <?= $rowdetail['nama_cust'];  ?></td>
            </tr>
            <tr>
                <td>Hp/Telp</td>
                <td>:</td>
                <td> <?= $rowdetail['hp_cust'];  ?></td>
            </tr>
            <tr>
                <td>E-Mail</td>
                <td>:</td>
                <td> <?= $rowdetail['email_cust'];  ?></td>
            </tr>


            <br>
        </table><br><br>

    </div>
    <br>
    <p>
        <?php if ($row['kirim'] == "50%") { ?>
            <h3>Barang akan dikirim pada : <?= $row['tanggal_kirim']; ?>
            <?php } elseif ($row['kirim'] == "70%") { ?>
                <h3>Barang telah dikirim pada : <?= $row['tanggal_kirim']; ?>
                <?php } elseif ($row['kirim'] == "100%") { ?>
                    <h3>Waktu Pengiriman : <?= $row['tanggal_kirim']; ?>
                        <h3>Barang telah diterima pada : <?= $row['tanggal_terima']; ?></h3>
                    <?php } else { ?>
                        <h3>Barang sedang disiapkan</h3>
                    <?php } ?>
                    <?php
