<?php
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];

$pnwrn_id = $_GET['no_penawaran'];

$result2 = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$pnwrn_id'");

$rowpn = mysqli_fetch_array($result2);

if (isset($_POST['submit'])) {
    if (uploads($_POST) > 0) {
        echo "<script>alert('upload penawaran berhasil!');
			  document.location.href= 'view_penawaran.php';
			  </script>";
    } else {
        echo "<script>alert('upload gagal!');
			  document.location.href= 'upload_penawaran.php?no_penawaran=$pnwrn_id';
              </script>";
    }
}

if ($_SESSION['level'] == "sales") {
    ?>
    <!DOCTYPE html>


    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php include('head.php'); ?>
        <title>Document</title>
    </head>

    <body>

        <?php include('menu-bar.php'); ?>
        <div class="container-footer">
            <!-- buat footer -->
            <div class="bc-icons-2">
                <?php include('breadcrumb.php'); ?>

                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                <li class="breadcrumb-item active">Upload Penawaran</li>
                </ol>
                </nav>
            </div>


            <div class="container-fluid">

                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="no_penawaran" value="<?= $rowpn["no_penawaran"]; ?>"></input>
                    <label for="gambar">Upload</label>
                    <input type="file" id="gambar" name="gambar" value="<?= $rowpn["gambar"]; ?>">
                    <br>
                    <input type="hidden" name="tgl_upload">
                    <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                </form>

            </div>
            <br><br><br>



            <?php include('footer.php'); ?>
        </div><!-- end of container footer -->
        <?php include('script-footer.php'); ?>
    </body>

    </html>

<?php } else {
    header("location:../index.php");
} ?>