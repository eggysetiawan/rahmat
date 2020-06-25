<?php

require '../functionsales.php';
session_start();
$username = $_SESSION['username'];

if (isset($_POST['generate'])) {

    echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'profile.php';
			  </script>";
}


if ($_SESSION['level'] == "sales") {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Tambah Penawaran</title>
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
                            <h1>Masukan Tahun Target</h1>

                        </center><br>

                        <form action="metodeTes1.php" method="post">
                            <div class="form-group">
                                <!-- <label for="count_add">Masukan Form Penawaran Modality yang diiginkan (Max 4 Penawaran)</label> -->
                                <?php $nowyear = date('Y'); ?>
                                <label for="exampleFormControlSelect1">Tahun Target</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="tahun1">
                                    <option disabled selected>Pilih Tahun</option>
                                    <?php

                                    for ($j = 7, $k = 2020; $j <= 17; $j += 2, $k++) { ?>
                                        <option value="<?= $j . ',' . $k ?>"><?= $k; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="submit" name="generate" value="Tambah Data" class="btn btn-success">

                            </div>
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