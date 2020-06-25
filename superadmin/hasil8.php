<?php

require '../functionsales.php';
$pk = $_POST['pk'];

$query = "SELECT * FROM sales_order3
INNER JOIN sales_modality ON sales_order3.pk_mod_order = sales_modality.pk_mod
INNER JOIN sales_funnel ON sales_funnel.pk = sales_order3.fk_funnel3
INNER JOIN sales_customer ON sales_funnel.customer_fk = sales_customer.pk_cust
 WHERE fk_funnel3 = '$pk'";
$value2 = mysqli_query($conn, $query);



// $query2 = "SELECT * FROM sales_order
// INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod
// INNER JOIN sales_funnel ON sales_funnel.penawaran_fk = sales_order.fk_penawaran
// INNER JOIN sales_customer ON sales_funnel.customer_fk = sales_customer.pk_cust
//  WHERE sales_order.fk_penawaran = '$pk_penawaran' ORDER BY pk_mod ASC";
// $value2 = mysqli_query($conn, $query2);

// 
?>
<!-- // <center><?= $row['no_penawaran']; ?></center><br> -->
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
                <td><?php if ($rowdetail['kota_cust'] == NULL) { ?>
                        Belum di input.
                    <?php } else { ?>
                        <?= $rowdetail['kota_cust'];  ?></td>
            <?php } ?></td>
            </tr>
            <tr>
                <td>Kode Rumah Sakit</td>
                <td>:</td>
                <td> <?= $rowdetail['koders_cust'];  ?></td>
            </tr>
            <tr>
                <td>Nama Customer</td>
                <td>:</td>
                <td><?php if ($rowdetail['nama_cust'] == NULL) { ?>
                        Belum di input.
                    <?php } else { ?>
                        <?= $rowdetail['nama_cust'];  ?></td>
            <?php } ?></td>
            </tr>
            <tr>
                <td>Hp/Telp</td>
                <td>:</td>
                <td>
                    <?php if ($rowdetail['hp_cust'] == NULL) { ?>
                        Belum di input.
                    <?php } else { ?>
                        <?= $rowdetail['hp_cust'];  ?></td>
            <?php } ?>
            </tr>
            <tr>
                <td>E-Mail</td>
                <td>:</td>
                <td> <?php if ($rowdetail['email_cust'] == NULL) { ?>
                        Belum di input.
                    <?php } else { ?>
                        <?= $rowdetail['email_cust'];  ?></td>
            <?php } ?></td>
            </tr>

            <br>
        </table><br><br>


        <?php
        $result = mysqli_query($conn, "SELECT * FROM sales_funnel
INNER JOIN sales_order3 ON sales_funnel.pk = sales_order3.fk_funnel3
WHERE fk_funnel3 = '$pk'");
        $row = mysqli_fetch_assoc($result);
        ?>


        <?php if ($row['kirim'] == "50%") { ?>
            <h3>Barang akan dikirim pada : <?= $row['tanggal_kirim']; ?>
            <?php } elseif ($row['kirim'] == "70%") { ?>
                <h3>Barang telah dikirim pada : <?= $row['tanggal_kirim']; ?>
                <?php } elseif ($row['kirim'] == "100%") { ?>
                    <h3>Barang dikirim pada : <?= $row['tanggal_kirim']; ?></h3>
                    <h3>Barang telah diterima pada : <?= $row['tanggal_terima']; ?></h3>
                <?php } else { ?>
                    <h3>Barang sedang disiapkan</h3>
                <?php } ?>
    </div>
    <br>
    <p>