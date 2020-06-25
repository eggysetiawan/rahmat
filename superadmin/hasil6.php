<?php

require '../functionsales.php';
$pk = $_POST['pk'];



$query2 = "SELECT * FROM sales_order2
INNER JOIN sales_modality ON sales_order2.pk_mod_order = sales_modality.pk_mod
INNER JOIN sales_funnel2 ON sales_funnel2.pk = sales_order2.fk_funnel2
INNER JOIN sales_customer ON sales_funnel2.customer_fk = sales_customer.pk_cust
 WHERE sales_order2.fk_funnel2 = '$pk' ORDER BY pk_mod ASC";
$value2 = mysqli_query($conn, $query2);

?>

<div class="fill">


    <?php while ($rowdetail = mysqli_fetch_assoc($value2)) : ?>
        <div class="detail-table">

            <table>
                <tr>
                    <td>Nama Modality</td>
                    <td>:</td>
                    <td> <?= $rowdetail['nama_mod_order'];  ?></td>
                </tr>

                <tr>
                    <td>Type Modality</td>
                    <td>:</td>
                    <td> <?= $rowdetail['model_mod_order'];  ?></td>

                </tr>
                <tr>
                    <td>Merk Modality</td>
                    <td>:</td>
                    <td> <?= $rowdetail['merk_mod_order'];  ?></td>
                </tr>

                <tr>
                    <td>Spek Modality</td>
                    <td>:</td>
                    <td> <?= $rowdetail['spek_mod_order'];  ?></td>
                </tr>
                <tr>
                    <td>Harga Modality Modality</td>
                    <td>:</td>
                    <td> <?= rupiah($rowdetail['harga_mod']);  ?></td>
                </tr>
                <tr>
                    <td>Harga Penawaran/pcs</td>
                    <td>:</td>
                    <td> <?= rupiah($rowdetail['harga_order']); ?></td>
                </tr>
                <?php
                    $hargamod = $rowdetail['harga_mod'];
                    $hargaorder = $rowdetail['harga_order'];
                    $hargatotal = $hargamod - $hargaorder;
                    $persen = ($hargatotal / $hargamod) * 100;
                    ?>
                <tr>
                    <td>Diskon</td>
                    <td>:</td>
                    <td> <?= $persen . '%';  ?></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>:</td>
                    <td> <?= $rowdetail['qty_order'];  ?></td>
                </tr>
                <tr>
                    <td>Total Harga Modality</td>
                    <td>:</td>
                    <td> <?= rupiah($rowdetail['total_order']);  ?></td>
                </tr>
                <br>
            </table><br><br>
        </div>
        <br>
        <p>
        <?php endwhile; ?>
        <?php
        $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order2 WHERE fk_funnel2 = '$pk' "); ?>

        <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
            <h3><?= "Total Harga Penawaran"; ?> <?= rupiah($row332['totalharga']); ?></h3>
        <?php endwhile; ?>
</div>