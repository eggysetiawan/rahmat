<?php

require '../functionsales.php';
session_start();
$username = $_SESSION['username'];


$pnwrn_id = $_GET['no_penawaran'];
$result = mysqli_query($conn, "SELECT * FROM sales_penawaran
INNER JOIN sales_funnel ON sales_penawaran.pk_penawaran = sales_funnel.penawaran_fk
INNER JOIN sales_order ON sales_funnel.penawaran_fk = sales_order.fk_penawaran
INNER JOIN sales_customer ON sales_penawaran.pk_cust_penawaran = sales_customer.pk_cust 
WHERE sales_penawaran.no_penawaran = '$pnwrn_id' ");

$rowpn = mysqli_fetch_array($result);

$pk_penawaran = $rowpn['pk_penawaran'];

$result2 = mysqli_query($conn, "SELECT * FROM sales_order
INNER JOIN sales_penawaran ON sales_order.fk_penawaran = sales_penawaran.pk_penawaran
WHERE fk_penawaran = '$pk_penawaran' ");
$rowpn3 = mysqli_num_rows($result2);




if (isset($_POST['submit'])) {
    if (editpenawaran($_POST) > 0) {
        echo "<script>alert('Penawaran berhasil diperbarui!');
			  document.location.href= 'view_penawaran.php';
			  </script>";
    } else {
        echo "<script>alert('Penawaran berhasil diperbarui!');
			  document.location.href= 'view_penawaran.php';
			  </script>";

        // var_dump($_POST);
    }
}
if ($_SESSION['level'] == "sales") {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Edit Penawaran</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?>
        <div class="container-footer">
            <!-- buat footer -->
            <div class="bc-icons-2">
                <?php include('breadcrumb.php'); ?>
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                <li class="breadcrumb-item active">Penawaran</li>
                </ol>
                </nav>
            </div>

            <div class="container-fluid content1">
                <div class="row justify-content-md-center" style="margin: 0px;">

                    <div class="form-harian col-md-6">
                        <!-- <?php

                                $i = 0000;
                                while ($i <= 1000) {
                                    printf('%04d ', $i);
                                    $i++;
                                }

                                ?> -->
                        <center>
                            <h1>Edit Penawaran</h1>
                        </center><br>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="no_penawaran" value="<?= $rowpn['no_penawaran']; ?>"></input>

                            <input type="hidden" name="pk_penawaran" value="<?= $rowpn['pk_penawaran']; ?>">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Rumah Sakit</label>
                                <?php
                                $pk_kunjungan = $rowpn['pk_cust_penawaran'];
                                $namars = $rowpn['rs_cust'];

                                $result = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE username ='$username'");

                                if ($namars) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                                ?>

                                <select class="form-control" id="exampleFormControlSelect1" name="pk_cust">
                                    <option>---Pilih Rumah Sakit---</option>
                                    <option value="<?= $pk_kunjungan; ?>" <?php echo $selected; ?>><?= $namars; ?></option>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT * FROM sales_customer WHERE username = '$username'");
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $row['pk_cust'] ?>"><?php echo $row['rs_cust'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Sumber Dana</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="budget_penawaran">
                                    <option value="<?php echo $rowpn['budget_penawaran'] ?>"><?php echo $rowpn['budget_penawaran'] ?></option>
                                    <option value="APBN">APBN</option>
                                    <option value="APBD">APBD</option>
                                    <option value="APBN-P">APBN-P</option>
                                    <option value="DAK">DAK</option>
                                    <option value="BLUD">BLUD</option>
                                    <option value="Swasta">Swasta</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="referensi">Referensi</label><br>
                                <input type="radio" id="referensi" name="referensi" <?php if ($rowpn['referensi_penawaran'] == 'E-Catalogue') echo 'checked' ?> value="E-Catalogue"> E-Catalogue<br>
                                <input type="radio" id="referensi" name="referensi" <?php if ($rowpn['referensi_penawaran'] == 'Non E-Catalogue') echo 'checked' ?> value="Non E-Catalogue" required> Non E-Catalogue<br>
                            </div>



                            <?php

                            $result30 = mysqli_query($conn, "SELECT * FROM sales_order INNER JOIN sales_penawaran ON sales_order.fk_penawaran = sales_penawaran.pk_penawaran 
                                INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod
                                WHERE fk_penawaran = '$pk_penawaran' ");

                            $i = 1;
                            while ($rowpn30 = mysqli_fetch_assoc($result30)) : ?>

                                <input type="hidden" name="count_add" value="<?= $rowpn3; ?>">



                                <div class="form-group">
                                    <label for="exampleFormControlSelect1"> <?= $i; ?>Modality</label>
                                    <?php
                                    $fk_penawaran = $rowpn30['fk_penawaran'];
                                    $pk_mod = $rowpn30['pk_mod_order'];
                                    $nama_mod = $rowpn30['nama_mod_order'];
                                    $pk_order = $rowpn30['pk_order'];
                                    $harga_mod = $rowpn30['harga_mod'];

                                    // $result = mysqli_query($conn, "SELECT * FROM sales_order WHERE pk_mod_order = '$pk_mod' ");

                                    if ($nama_mod) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    ?>
                                    <input type="hidden" name="pk_order[]" value="<?= $pk_order; ?>">
                                    <input type="hidden" name="fk_penawaran" value="<?= $fk_penawaran; ?>">
                                    <select class="form-control" id="exampleFormControlSelect1" name="pk_mod[]">
                                        <option>---Pilih Modality---</option>
                                        <option value="<?= $pk_mod; ?>" <?php echo $selected; ?>><?= $nama_mod . ' Harga : ' . rupiah($harga_mod) ?></option>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT * FROM sales_modality");
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value="<?php echo $row['pk_mod'] ?>"><?php echo $row['nama_mod'] . ' Harga : ' . rupiah($row['harga_mod']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label for="harga_penawaran">Harga Penawaran</label>
                                    <input type="text" class="form-control" id="harga_penawaran" name="harga_penawaran[]" value="<?= $rowpn30['harga_order']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="qty">Qty Penawaran</label>
                                    <input type="text" class="form-control" id="qty" name="qty[]" placeholder="Qty penawaran.." value="<?= $rowpn30["qty_order"]; ?>" required>
                                </div>
                                <?php $i++; ?>
                            <?php endwhile; ?>

                            <div class="form-group">
                                <!-- <label for="tanggal">Tanggal Penawaran</label> -->
                                <input type="hidden" class="form-control" id="date" name="tgl_penawaran" placeholder="tanggal penawaran..">
                            </div>


                            <!-- <div class="form-group">
                                <label for="gambar">Upload</label>
                                <input type="file" id="gambar" name="gambar" value="<?= $rowpn30["gambar"]; ?>">
                            </div> -->

                            <div class="md-form mt-3">
                                <input type="hidden" class="form-control" name="username" value="<?= $username; ?>">
                            </div>



                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            <a href="view_penawaran.php">View Penawaran</a>
                        </form>
                    </div>
                </div>
            </div>

            <?php include('footer.php'); ?>



        </div><!-- end of container footer -->

        <?php include('script-footer.php'); ?>
        <script>
            $('#date').datetimepicker({
                format: 'd-m-Y H:i'
            });
        </script>
    </body>

    </html>

<?php } else {
    header("location:../index.php");
} ?>