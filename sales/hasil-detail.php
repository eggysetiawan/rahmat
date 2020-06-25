<?php
require '../koneksi/koneksi.php';

?>
<div class="fill">

    <?php $pk_penawaran = $row['pk_penawaran']; ?>
                                        <?php $result323 = mysqli_query($conn, "SELECT * FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>
                                        <?php while ($row323 = mysqli_fetch_assoc($result323)) : ?>
                                            <?= $row323['pk_order']; ?>
                                        <?php endwhile; ?>
        <!-- <?= $row['fill']; ?></p> -->
</div>