<?php



require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
if (isset($_POST['submit'])) {



    if (funnel2($_POST) > 0) {
        echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'view_funnel2.php';
			  </script>";
    } else {
        echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'generate_funnel.php';
			  </script>";
    }
}
if ($_SESSION['level'] == "sales") {
    if ($_POST['count_add'] != 0) {
?>

        <!DOCTYPE html>
        <html>

        <head>
            <title>Masukan Penawaran</title>
            <?php include('head.php'); ?>

        </head>

        <body>
            <?php include('menu-bar.php'); ?>
            <div class="container-footer">
                <!-- buat footer -->
                <div class="bc-icons-2">
                    <?php include('breadcrumb.php'); ?>
                    <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item"><a href="generate_funnel.php">Tambah Penawaran</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item active">Funnel Plan</li>
                    </ol>
                    </nav>
                </div>

                <div class="container-fluid content1">
                    <div class="row justify-content-md-center" style="margin: 0px;">

                        <div class="form-harian col-md-6">
                            <h3>Input Funnel Plan</h3>
                            <!-- <?php

                                    $i = 0000;
                                    while ($i <= 1000) {
                                        printf('%04d ', $i);
                                        $i++;
                                    }

                                    ?> -->

                            <!-- <form action="" method="post">
                            <div class="form-group">
                                <label for="count_add">Jumlah Form Penawaran yang diiginkan (numbers only)</label>
                                <input type="text" class="form-control" id="count_add" name="count_add" placeholder="Masukan jumlah penawaran yang ingin ditambahkan" required maxlength="1" pattern="[1-9]+">
                                <input type="submit" name="generate" value="Tambah Data" class="btn btn-success">

                            </div>
                        </form> -->
                            <a href="generate.php"><button class="btn btn-sm btn-success btn-penawaran">Tambahkan Data</button></a><br><br>
                            <form class="pnwrn" action="" method="POST">

                                <div class="form-group">


                                    <label for="exampleFormControlSelect1">Rumah Sakit</label>
                                    <select class="form-control select2" id="exampleFormControlSelect1" name="pk_kunjungan">
                                        <!-- <option>---Pilih Rumah Sakit---</option> -->
                                        <?php
                                        $result = mysqli_query($conn, "SELECT * FROM sales_customer
                                        INNER JOIN inti_rs ON sales_customer.fk_rs = inti_rs.pk_rs WHERE username = '$username'");
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value=" <?php echo $row['pk_cust'] ?>">
                                                <?php echo $row['nama_rs'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <br>
                                    <div class="form-row">
                                        <div class=" form-group col-md-6">
                                            <label for="exampleFormControlSelect1">Funnel Progress</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="progress_funnel2">
                                                <option value="">Funnel Progress</option>
                                                <?php

                                                for ($j = 10; $j <= 100; $j += 10) { ?>
                                                    <option value="<?= $j; ?>%"><?= $j; ?>%</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class=" form-group col-md-6">
                                            <?php $nowyear = date('Y'); ?>
                                            <label for="exampleFormControlSelect1">Tahun</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="tahun1">
                                                <option value="<?= $nowyear; ?>"><?= $nowyear; ?></option>
                                                <?php

                                                for ($j = 2000; $j <= 2050; $j++) { ?>
                                                    <option value="<?= $j; ?>"><?= $j; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan1" placeholder="Keterangan.." required></textarea>
                                </div>

                                <hr>






                                <?php
                                $count_add = $_POST['count_add'];
                                for ($i = 1; $i <= $count_add; $i++) { ?>
                                    <!-- --------------------------------1----------------- -->
                                    <div class="penwaran1">
                                        <h2><strong><?= $i; ?></strong></h2>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1"><?php echo "Modality #$i"; ?></label>
                                            <input type="hidden" name="count_add" value="<?= $count_add; ?>">
                                            <select class="form-control select2" id="exampleFormControlSelect1" name="pk_mod1[]">
                                                <!-- <option>---Pilih Modality---</option> -->
                                                <?php
                                                $result = mysqli_query($conn, "SELECT * FROM sales_modality");
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <option value=" <?php echo $row['pk_mod'] ?>">
                                                        <?php echo $row['nama_mod'] . ' Harga : ' . rupiah($row['harga_mod']) ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="harga_penawaran"><?php echo "Harga Penawaran #$i" ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" class="form-control" name=" harga_penawaran1[]" placeholder="cth: 1000" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="qty"><?php echo "Qty Penawaran #$i" ?></label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="qty" name="qty1[]" placeholder="Qty penawaran.." pattern="[0-9]+" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">/pcs</span>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <hr>



                                        <br><br>
                                    </div>
                                <?php } ?>
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
        header("location:generate_funnel.php");
    } ?>

<?php } else {
    header("location:../index.php");
} ?>