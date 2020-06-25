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


if (isset($_POST['submit'])) {
  if (updtprofile($_POST) > 0) {
    echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'profile.php';
			  </script>";
  } else {
    echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'profile.php';
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
if ($_SESSION['level'] == "intiadmin") {
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
        <li class="breadcrumb-item active">Profil</li>
        </ol>
        </nav>
      </div>


      <div class="container-fluid">
        <h3>Hii <strong style="color: #1f85ff;"><?= $name; ?></strong> lengkapi profilmu dan jangan lupa cek target kalian</h3></br>
        <a href="#" class="btn-target" data-id="">Update Target</a> |
        <a href="#" class="btn-profil" data-id="">Update Profil</a>


        <!-- Target -->
        <div class="target-box">
          <div class="form-harian">
            <form action="" method="POST">
              <div class="md-form mt-3 col-md-4">
                <label for="username"></label>
                <input type="hidden" class="forhiddenntrol" id="username" name="username" value="<?php echo $username ?>">
              </div>

              <div class="md-form mt-3 col-md-4">
                <label for="target">Target</label>
                <input type="text" class="form-control" id="target" name="target" value="<?php echo $target ?>">
              </div>
              <button type="submit" class="btn btn-primary" name="submit">Update</button>
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

      </div>
      <br><br><br>



      <?php include('footer.php'); ?>
    </div><!-- end of container footer -->
    <?php include('script-footer.php'); ?>

    <script>
      $(document).ready(function() {
        $(".target-box").hide();
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