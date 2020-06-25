<?php

require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$pk_funnel2 = $_GET['pk'];

$resultquery = mysqli_query($conn, "SELECT * 
FROM sales_funnel2 
INNER JOIN sales_order2 ON sales_funnel2.pk = sales_order2.fk_funnel2
INNER JOIN sales_customer ON sales_funnel2.customer_fk = sales_customer.pk_cust
WHERE sales_funnel2.pk = '$pk_funnel2' ");

$row1 = mysqli_fetch_array($resultquery);

$result2 = mysqli_query($conn, "SELECT * FROM sales_funnel2 INNER JOIN sales_order2 ON sales_funnel2.pk = sales_order2.fk_funnel2
WHERE sales_funnel2.pk = '$pk_funnel2' ");
$rowpn = mysqli_num_rows($result2);


if (isset($_POST['submit'])) {



    if (editfunnel22($_POST) > 0) {
        echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'view_funnel2.php';
			  </script>";
    } else {
        echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'view_funnel2.php';
			  </script>";
    }
}
if ($_SESSION['level'] == "sales") {

    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Masukan Funnel Plan</title>
        <?php include('head.php'); ?>

    </head>

    <body>
        <?php include('menu-bar.php'); ?>
        <div class="container-footer">
            <!-- buat footer -->
            <div class="bc-icons-2">
                <?php include('breadcrumb.php'); ?>
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                <li class="breadcrumb-item active">Funnel Plan</li>
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
                            <h1>Input Funnel Plan</h1>
                        </center>
                        <br>

                        <!-- <form action="" method="post">
                            <div class="form-group">
                                <label for="count_add">Jumlah Form Penawaran yang diiginkan (numbers only)</label>
                                <input type="text" class="form-control" id="count_add" name="count_add" placeholder="Masukan jumlah penawaran yang ingin ditambahkan" required maxlength="1" pattern="[1-9]+">
                                <input type="submit" name="generate" value="Tambah Data" class="btn btn-success">

                            </div>
                        </form> -->
                        <!-- <a href="generate.php"><button class="btn-success btn-penawaran">Tambahkan Data</button></a><br> -->
                        <form class="pnwrn" action="" method="POST">

                            <div class="form-group">
                                <input type="hidden" name="pk" value="<?= $pk_funnel2; ?>">

                                <label for="exampleFormControlSelect1">Rumah Sakit</label>
                                <input type="text" class="form-control" name="nama_rs" placeholder="Input Nama RS" value="<?= $row1['rs_cust']; ?>" disabled>

                                <label for="exampleFormControlSelect1">Kode RS</label>
                                <input type="text" class="form-control" name="kode_rs" placeholder="Input Kode RS" value="<?= $row1['koders_cust']; ?>" disabled>
                                <br>
                                <div class=" form-group">
                                    <?php
                                        $progress = $row1['progress_funnel2'];

                                        if ($progress) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        ?>
                                    <label for="exampleFormControlSelect1">Funnel Progress</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="progress_funnel2">
                                        <option value="<?= $row1['progress_funnel2']; ?>" <?= $selected; ?>><?= $row1['progress_funnel2']; ?></option>
                                        <?php

                                            for ($j = 10; $j <= 100; $j += 10) { ?>
                                            <option value="<?= $j; ?>%"><?= $j; ?>%</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class=" form-group">
                                    <?php
                                        $tahun = $row1['tahun_funnel2'];

                                        if ($tahun) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        ?>

                                    <?php $nowyear = date('Y'); ?>
                                    <label for="exampleFormControlSelect1">Tahun</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="tahun1">
                                        <option value="<?= $row1['tahun_funnel2']; ?>" <?= $selected; ?>><?= $row1['tahun_funnel2']; ?></option>
                                        <?php

                                            for ($j = 2000; $j <= 2050; $j++) { ?>
                                            <option value="<?= $j; ?>"><?= $j; ?></option>
                                        <?php } ?>

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="keterangan">Keterangan </label>
                                    <textarea class="form-control" id="keterangan" name="keterangan1"><?= $row1['status_funnel2']; ?></textarea>
                                </div>

                                <hr>
                            </div>





                            <div class="penwaran1">
                                <?php

                                    $result30 = mysqli_query($conn, "SELECT * FROM sales_order2 
INNER JOIN sales_funnel2 ON sales_order2.fk_funnel2 = sales_funnel2.pk
INNER JOIN sales_modality ON sales_order2.pk_mod_order = sales_modality.pk_mod 
WHERE fk_funnel2 = '$pk_funnel2' ");
                                    $i = 1;
                                    while ($rowpn30 = mysqli_fetch_assoc($result30)) : ?>

                                    <input type="hidden" name="count_add" value="<?= $rowpn; ?>">

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1"> <?= $i; ?>Modality</label>
                                        <?php
                                                $fk_funnel_order = $rowpn30['fk_funnel2'];
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
                                        <input type="hidden" name="fk_penawaran" value="<?= $fk_funnel_order; ?>">
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
                                        <label for="harga_penawaran"><?php echo "Harga Order#$i" ?></label>
                                        <input type="text" class="form-control" name="harga_penawaran[]" value="<?= $rowpn30['harga_order']; ?>" required>
                                    </div>


                                    <!-- <div class="kotak">
  <span>Nominal Rupiah. :</span>
  <input type="text" id="rupiah" />
</div> -->

                                    <div class="form-group">
                                        <label for="qty"><?php echo "Qty Order #$i" ?></label>
                                        <input type="text" class="form-control" id="qty" name="qty[]" placeholder="Qty penawaran.." pattern="[0-9]+" value="<?= $rowpn30["qty_order"]; ?>" required>

                                    </div>
                                    <br>
                                    <hr>



                                    <br><br>

                                <?php endwhile; ?>
                                <!-- --------------------------------1----------------- -->





                                <!-- <div class="form-group">
								<label for="pricelist">Pricelist</label>
								<input type="text" class="form-control" id="pricelist" name="pricelist" value="<?= $row['harga_mod']; ?>">
							</div> -->


                                <div class="form-group">
                                    <!-- <label for="tanggal">Tanggal Penawaran</label> -->
                                    <input type="hidden" class="form-control" id="date" name="tgl_penawaran" placeholder="tanggal penawaran..">
                                </div>


                                <div class="md-form mt-3">
                                    <input type="hidden" class="form-control" name="username" value="<?= $username; ?>">
                                </div>


                                <button type="submit" name="submit" class="btn btn-primary">SIMPAN</button>

                        </form>
                    </div>
                </div>
            </div>

            <?php include('footer.php'); ?>



        </div><!-- end of container footer -->

        <?php include('script-footer.php'); ?>
        <script>
            $('#tahun').datetimepicker({
                timepicker: false,
                theme: "dark",
                format: 'Y'
            });
        </script>

        <!-- <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>

<script type="text/javascript">
            $(document).ready(function(){

                // Format mata uang.
                $( '.uang' ).mask('00.000.000.000', {reverse: true});

            })
        </script> -->
    </body>

    </html>


<?php } else {
    header("location:../index.php");
} ?>