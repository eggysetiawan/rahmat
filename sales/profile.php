<?php
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$query = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username'");
$row = mysqli_fetch_assoc($query);
$name = $row['name'];
$email = $row['email'];
$alamat = $row['address'];
$kota = $row['city'];
$negara = $row['state'];
$zip = $row['zip'];
@$target = $row['targett'];
$tahunTarget = $_GET['x'];
$tahunTarget1 = $_GET['tahun'];
$targetKu = round($_GET['target'], -8);
// echo $tahunTarget1;




if (isset($_POST['submit'])) {
  if (updtprofile($_POST) > 0) {
    echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'index.php';
			  </script>";
  } else {
    echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'generate_tahun.php';
			  </script>";
  }
}
if (isset($_POST['register'])) {
  if (updtprofile2($_POST) > 0) {
    echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'profile.php';
			  </script>";
  } else {
    echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'profile.php';
			  </script>";
  }
}

if (isset($_POST['passwordsubmit'])) {
  $password = $_POST['password'];
  $passwordulang = $_POST['passwordulang'];

  if ($password == $passwordulang) {
    password($_POST);
    echo "<script>alert('Password Berhasil diganti');
document.location.href='profile.php';
</script>";
  } else {
    echo "<script>alert('password tidak sama');</script>";
  }
}
if ($_SESSION['level'] == "sales") {
  // if ($_POST['count_add'] != 0) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('head.php'); ?>
    <title>Target</title>
  </head>

  <body>

    <?php include('menu-bar.php'); ?>
    <div class="container-footer">
      <!-- buat footer -->
      <div class="bc-icons-2">
        <?php include('breadcrumb.php'); ?>

        <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
        <li class="breadcrumb-item active">Profil</li>
        </ol>
        </nav>
      </div>


      <div class="container-fluid">
        <h3>HI <strong style="color: #1f85ff;"><?= $name; ?></strong> lengkapi profilmu dan jangan lupa cek target kalian</h3></br>
        <div class="row">
          <div class="col-md-1">
            <a href="#" class="btn-target"><img class="logo-profil" src="../image/target.png"><br>
              <div class="txt-profil">Edit Target</div>
            </a>
          </div>
          <div class="col-md-1">
            <a href="#" class="btn-profil"><img class="logo-profil" src="../image/user.png"><br>
              <div class="txt-profil">Update Profil</div>
            </a>
          </div>
          <div class="col-md-1">
            <a class="" data-toggle="modal" data-target="#modalCookie1"><img class="logo-profil" src="../image/lock.png"><br>
              <div class="txt-profil">Ganti Password</div>
            </a>
          </div>
        </div>


        <!-- Target -->
        <div class="target-box">
          <div class="form-harian">
            <form action="" method="POST">
              <div class="md-form mt-3 col-md-4">
                <label for="username"></label>
                <input type="hidden" class="forhiddenntrol" id="username" name="username" value="<?php echo $username ?>">
              </div>

              <div class="md-form mt-3 col-md-4">
                <?php
                $nowyear = date('Y');

                $last5 = ($nowyear - 5);

                $result = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS totalpo FROM sales_targeting WHERE username = '$username' AND tahun_targeting BETWEEN '$last5' AND '$nowyear'");
                $row1 = mysqli_fetch_assoc($result);

                $resultTahun = mysqli_query($conn, "SELECT * FROM sales_targeting WHERE NOT tahun_targeting = '2020' GROUP BY tahun_targeting");
                $rowTahun = mysqli_num_rows($resultTahun);



                // $totalpo = $row1['totalpo'];


                // $rangetarget = $totalpo / $rowTahun;


                // $minimum = round($rangetarget, -8);
                // $maximum1 = ((10 / 100) * $rangetarget);
                // $maximum1 = $rangetarget + $maximum1;
                // $maximum = round($maximum1, -8)
                ?>
                <input type="hidden" name="aveTarget" value="<?= $targetKu; ?>">
                <input type="hidden" name="tahun1" value="<?= $tahunTarget1; ?>">


                <label for="target">Target</label>
                <input type="text" class="form-control" id="target" name="target" placeholder="Minimum Target : <?= rupiah($targetKu); ?> ">


              </div>

              <div class=" form-group">
                <div class="ui tag labels">
                  <a class="ui teal label">
                    Tahun Target <?= $tahunTarget1; ?>
                  </a>
                </div>
              </div>
              <button type="submit" class="positive ui button" name="submit">Submit</button>
            </form>
          </div>
        </div>
        <!-- End of target -->


        <!-- Profil -->
        <div class="profil-box container mt-3">
          <div class="form-harian">
            <form action="" method="POST">

              <div class="md-form mt-3 col-md-4">
                <label for="username"></label>
                <input type="hidden" class="forhiddenntrol" id="username" name="username" value="<?php echo $username ?>">
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Ex: @intimedica.co" name="email" value="<?= $email; ?>">
              </div>



              <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukan Nama Lengkap.." name="nama" value="<?= $name; ?>">
              </div>

              <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" class="form-control" id="address" placeholder="1234 Main St" name="address" value="<?= $alamat; ?>">
              </div>

              <div class="form-row">

                <div class="form-group col-md-6">
                  <label for="city">Kota</label>
                  <input type="text" class="form-control" id="city" name="city" value="<?= $kota; ?>">
                </div>
                <?php
                if ($negara) {
                  $selected = 'selected';
                } else {
                  $selected = '';
                }
                ?>
                <div class="form-group col-md-4">
                  <label for="state">Negara</label>
                  <select id="state" class="form-control" name="state">

                    <option style="color:white;" value="<?php echo $username; ?>" <?php echo $selected; ?>><?php echo $negara; ?></option>
                  </select>
                </div>

                <div class="form-group col-md-2">
                  <label for="zip">Zip</label>
                  <input type="text" class="form-control" id="zip" name="zip" value="<?= $zip; ?>">
                </div>
              </div>

              <button type="submit" class="btn btn-primary" name="register">UPDATE</button>


            </form>
          </div>
        </div>
        <!-- End of profil -->

        <br><br>

        <div>



          <!--Modal: modalCookie-->
          <div class="modal fade top" id="modalCookie1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="true">
            <div class="modal-dialog modal-frame modal-top modal-notify modal-info" role="document">
              <!--Content-->
              <div class="modal-content">
                <!--Body-->
                <div class="modal-body">
                  <div class="row d-flex justify-content-center align-items-center">

                    <form action="" method="post">
                      <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" class="form-control" id="password" placeholder="password" name="password" value="" required>

                        <label for="password">password Ulang</label>
                        <input type="password" class="form-control" id="passwordulang" placeholder="passwordulang" name="passwordulang" value="" required>
                      </div>


                      <button type="submit" class="btn btn-default" name="passwordsubmit">Ubah Password</button>
                    </form>

                  </div>
                </div>
              </div>
              <!--/.Content-->
            </div>
          </div>
          <!--Modal: modalCookie-->

        </div>



      </div>
      <br><br><br>



      <?php include('footer.php'); ?>
    </div><!-- end of container footer -->
    <?php include('script-footer.php'); ?>

    <script>
      $(document).ready(function() {
        $(".target-box").show();
        $(".profil-box").hide();
        $(".btn-target").click(function() {
          $(".target-box").toggle(1000);
          $(".profil-box").hide();
        });
        $(".btn-profil").click(function() {
          $(".profil-box").toggle(1000);
          $(".target-box").hide();
        });
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>