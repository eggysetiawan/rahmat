<?php
require '../koneksi/koneksi.php';
$pk_mod = $_POST['pk_mod'];
$query = "SELECT * FROM sales_modality WHERE pk_mod = '$pk_mod'";
$value = mysqli_query($conn, $query);
$row1 = mysqli_fetch_assoc($value);
?>
<div class="fill">

    <h4><strong><label>Spek :</label>&nbsp;<label><?= $row1['spek_mod']; ?></label></strong></h4>
    <br>
    <p>
        <!-- <?= $row['fill']; ?></p> -->
</div>