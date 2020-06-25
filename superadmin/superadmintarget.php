<?php
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];

$result = mysqli_query($conn, "SELECT SUM(targett) AS targetsales FROM inti_user WHERE approve_target IS NOT NULL ");
$row = mysqli_fetch_assoc($result);

$minimum = $row['targetsales'];



// $result2 = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE no_penawaran = '$pnwrn_id'");

// $rowpn = mysqli_fetch_array($result2);

if (isset($_POST['submit'])) {
    if (admintargeting($_POST) > 0) {
        echo "<script>alert('update berhasil!');
			  document.location.href= 'targeting.php';
			  </script>";
    } else {
        echo "<script>alert('update gagal!');
			  document.location.href= 'targeting.php';
              </script>";
    }
}

if ($_SESSION['level'] == "superadmin") {
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
                <li class="breadcrumb-item active">Update Target</li>
                </ol>
                </nav>
            </div>


            <div class="container-fluid">

                <form action="" method="POST">
                    <input type="hidden" name="username" value="<?php echo $username; ?>">

                    <label for="target">Masukan Target</label>
                    <input type="text" id="target" class="form-control" name="target" value="<?= $minimum; ?>">
                    <br>
                    <div class=" form-group">
                        <?php $nowyear = date('Y'); ?>
                        <label for="exampleFormControlSelect1">Tahun Target</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="tahun1">
                            <option value="<?= $nowyear; ?>"><?= $nowyear; ?></option>
                            <?php

                            for ($j = $nowyear; $j <= 2021; $j++) { ?>
                                <option value="<?= $j; ?>"><?= $j; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
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