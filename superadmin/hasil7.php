<?php
require '../functionsales.php';
$pk = $_POST['pk'];
$query = "SELECT * FROM sales_funnel2 WHERE pk = '$pk'";
$value = mysqli_query($conn, $query);
$row1 = mysqli_fetch_assoc($value);
?>
<div class="fill">

    <h4><strong><label>Keterangan :</label>&nbsp;<label><?= $row1['status_funnel2']; ?></label></strong></h4>
    <br>
    <p>
        <!-- <?= $row['fill']; ?></p> -->
</div>