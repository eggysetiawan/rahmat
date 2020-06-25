<?php

require '../functionsales.php';
session_start();
$username = $_SESSION['username'];


$pnwrn_id = $_GET['no_penawaran'];
$result2 = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$pnwrn_id'");

$rowpn = mysqli_fetch_array($result2);

if (isset($_POST['submit'])) {
    if (editpenawaran($_POST) > 0) {
        echo "<script>alert('Penawaran berhasil diperbarui!');
			  document.location.href= 'view_penawaran.php';
			  </script>";
    } else {
        echo "<script>alert('Penawaran gagal diperbarui!');
			  document.location.href= 'edit_penawaran.php?no_penawaran=$pnwrn_id';
              </script>";
    }
}
if ($_SESSION['level'] == "sales") {
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Kunjungan Harian</title>
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
                            <input type="hidden" name="no_penawaran" value="<?= $rowpn["no_penawaran"]; ?>"></input>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Rumah Sakit</label>
                                <?php
                                    $pk_kunjungan = $rowpn['pk_cust_penawaran'];
                                    $namars = $rowpn['rs_penawaran'];

                                    $result = mysqli_query($conn, "SELECT * FROM sales_penawaran");

                                    if ($namars) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    ?>

                                <select class="form-control" id="exampleFormControlSelect1" name="pk_kunjungan">
                                    <option>---Pilih Rumah Sakit---</option>
                                    <option value="<?= $pk_kunjungan; ?>" <?php echo $selected; ?>><?= $namars; ?></option>
                                    <?php
                                        $result = mysqli_query($conn, "SELECT * FROM sales_kunjungan");
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $row['pk_kunjungan'] ?>"><?php echo $row['rs_kunjungan'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Modality</label>
                                <?php
                                    $pk_mod = $rowpn['pk_mod_penawaran'];
                                    $nama_mod = $rowpn['nama_mod_penawaran'];

                                    $result = mysqli_query($conn, "SELECT * FROM sales_penawaran");

                                    if ($nama_mod) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    ?>
                                <select class="form-control" id="exampleFormControlSelect1" name="pk_mod">
                                    <option>---Pilih Modality---</option>
                                    <option value="<?= $pk_mod; ?>" <?php echo $selected; ?>><?= $nama_mod; ?></option>
                                    <?php
                                        $result = mysqli_query($conn, "SELECT * FROM sales_modality");
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $row['pk_mod'] ?>"><?php echo $row['nama_mod'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="qty">Qty Penawaran</label>
                                <input type="text" class="form-control" id="qty" name="qty" placeholder="Qty penawaran.." value="<?= $rowpn["qty"]; ?>">
                            </div>

                            <div class="form-group">
                                <label for="tanggal">Tanggal Penawaran</label>
                                <?php $d = date('Y-m-d', strtotime($rowpn["tgl_penawaran"])); ?>
                                <input type="text" class="form-control" id="date" name="tgl_penawaran" placeholder="tanggal penawaran.." value="<?= $d; ?>">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Upload</label>
                                <input type="file" id="gambar" name="gambar" value="<?= $rowpn["gambar"]; ?>">
                            </div>

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