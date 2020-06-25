<?php

require 'functionsales.php';

session_start();

if (isset($_COOKIE['log_id']) && isset($_COOKIE['user'])) {

  $log_id = $_COOKIE['log_id'];
  $user = $_COOKIE['user'];

  // ambil username berdasarkan log_id
  $hasil = mysqli_query($conn, "SELECT username FROM inti_login WHERE log_id = $log_id");
  $row = mysqli_fetch_assoc($hasil);

  // cek cookie dan username
  if ($user === hash('sha256', $data['username'])) {

    $_SESSION['login'] = true;
  }
}



if (isset($_POST["login"])) {


  $username = $_POST["username"];
  $password = $_POST["password"];

  if (empty($username)) {
    echo "<script>alert('Username belum diisi!'); </script>";
  } elseif (empty($password)) {
    echo "<script>alert('Password belum diisi!'); </script>";
  } else {
    //---------------------------- query untuk mendapatkan username --------------------------------

    $query = "SELECT * FROM inti_login WHERE username = '$username' ";
    $hasil = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($hasil);

    //---------------------------- cek kesesuaian password -------------------------------
    if (password_verify($password, $data['password'])) {

      // set session
      $_SESSION['last_login_timestamp'] = time();

      // cek remember me
      if (isset($_POST['remember'])) {
        // buat cookie

        setcookie('log_id', $data['log_id'], time() + 86400);

        setcookie('user', hash('sha256', $data['username']), time() + 86400);
      }

      echo "<script>document.location.href='menu.php';</script>";

      //----------------------------- menyimpan username dan level ke dalam session ----------------------------------------
      $_SESSION['level'] = $data['level'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['fill'] = $data_temp['fill'];
    }
    echo "<script>alert('username atau password salah silahkan ulangi kembali'); </script>";
  }
}



?>
<?php
@$username = $_SESSION['username'];
$query = "SELECT * FROM inti_login WHERE username = '$username' ";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);

if (!($_SESSION['username'] = $data['username'])) {
  ?>

  <!DOCTYPE html>
  <html>

  <head>
    <title>Intimedika</title>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style1.css">
  </head>

  <body>
    <div class="container-fluid container-home">
      <!-- <div class="row justify-content-lg-center">
      <div class="col-lg-5">
          <img class="logoipi" src="image/logoipi.png"><br>
        </div>
      </div> -->
      <div class="row justify-content-lg-center">

        <div class="col-lg-5 head_home">
          <a href="index.php"> <img class="logoipi" src="image/logoipi.png"></a><br>

          <center>
            <h1>SIGN IN</h1>
          </center>
          <!-- <a href="#" class="btn signup">SIGN UP</a> -->

          <!-- <div class="content1">
            <div class="container">
              <h2>Sign up</h2>
              <form action="" method="POST">

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Ex: @intimedica.co" name="inputEmail4">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="inputPassword4">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputNama">Nama Lengkap</label>
                  <input type="text" class="form-control" id="inputNama" placeholder="Masukan Nama Lengkap.." name="inputNama">
                </div>

                <div class="form-group">
                  <label for="inputUname">Username</label>
                  <input type="text" class="form-control" id="inputUname" placeholder="Username" name="inputUname">
                </div>

                <div class="form-group">
                  <label for="inputPosition">Position</label>
                  <select id="inputPosition" class="form-control" name="inputPosition">
                    <option selected>Choose...</option>
                    <option>Sales</option>
                    <option>Teknisi</option>
                    <option>Admin</option>
                    <option>IT</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="inputAddress">Address</label>
                  <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="inputAddress">
                </div>

                <div class="form-row">

                  <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name="inputCity">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control" name="inputState">
                      <option selected>Choose...</option>
                      <option>...</option>
                    </select>
                  </div>

                  <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip" name="inputZip">

                  </div>

                  <input type="hidden" name="targett">
                </div>

                <div class="form-group">

                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Check me out
                    </label>
                  </div>

                </div>
                <button type="submit" class="btn btn-primary" name="register">Sign Up</button>
              </form>
            </div>
          </div> -->


          <div class="content2">
            <div class="container">
              <form method="post" action="">
                <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="username" class="form-control" id="username" placeholder="Enter username" autofocus name="username">
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                </div>
                <!-- <div class="form-group form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                  </label>
                </div> -->
                <button type="submit" class="btn btn-primary" name="login">Sign in</button>
              </form>
            </div>
          </div>


        </div>
      </div>
    </div>






    <?php include('script-footer.php'); ?>
    <script>
      $(document).ready(function() {
        $(".content1").hide();
        $(".signup").click(function() {
          $(".content1").show();
          $(".content2").hide();
        });
      });
      $(document).ready(function() {

        $(".signin").click(function() {
          $(".content2").show();
          $(".content1").hide();
        });
      });
    </script>
  </body>

  </html>
<?php } else {
  if ($_SESSION['level'] == "sales") {
    header("location:sales/index.php");
  } else if ($_SESSION['level'] == "superadmin") {
    header("location:superadmin/index.php");
  } else if ($_SESSION['level'] == "supervisorsales") {
    header("location:supervisorsales/index.php");
  } else if ($_SESSION['level'] == "distributor") {
    header("location:distributor/index.php");
  } else if ($_SESSION['level'] == "radiographer") {
    header("location:radiographer/index.php");
  } else if ($_SESSION['level'] == "admin") {
    header("location:admin/index.php");
  } else if ($_SESSION['level'] == "users") {
    header("location:users/index.php");
  } else if ($_SESSION['level'] == "intiadmin") {
    header("location:intiadmin/index.php");
  }
} ?>