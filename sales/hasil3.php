<?php

require '../functionsales.php';
$pk_penawaran = $_POST['pk_penawaran'];
$query = "SELECT * FROM sales_order
INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod
INNER JOIN sales_penawaran ON sales_penawaran.pk_penawaran = sales_order.fk_penawaran WHERE fk_penawaran = '$pk_penawaran'";
$value = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($value);

$query2 = "SELECT * FROM sales_order
INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod
INNER JOIN sales_penawaran ON sales_penawaran.pk_penawaran = sales_order.fk_penawaran WHERE fk_penawaran = '$pk_penawaran' ORDER BY pk_mod ASC";
$value2 = mysqli_query($conn, $query2);
?>
<center><?= $row['no_penawaran']; ?></center><br>
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
                    <td>Price List</td>
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
                    <td>Total Harga Penawaran</td>
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
        $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>

        <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
            <h3><?= "Total Harga Penawaran"; ?> <?= rupiah($row332['totalharga']); ?></h3>
        <?php endwhile; ?>
</div>