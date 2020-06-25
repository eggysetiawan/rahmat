<?php
session_start();
require '../functionsales.php';


if (isset($_POST["register"])) {

  if (registrasi($_POST) > 0) {

    echo "<script>alert('user berhasil didaftarkan!');
    document.location.href='index.php';
    </script>";
  } else {
    echo mysqli_error($conn);
  }
}




if ($_SESSION['level'] == "admin") {
  ?>
  <!DOCTYPE html>
  <html>

  <head>
    <?php include('head.php'); ?>
    <title>Sign Up</title>
  </head>

  <body>

    <div class="content1">
      <div class="container">
        <div class="admin-form">
          <center>
            <h2>Sign up</h2>
          </center>
          <form action="" method="POST">



            <div class="form-group">
              <label for="inputNama">Nama Lengkap</label>
              <input type="text" class="form-control" id="inputNama" placeholder="Masukan Nama Lengkap.." name="inputNama">
            </div>

            <div class="form-group">
              <label for="inputUname">Username</label>
              <input type="text" class="form-control" id="inputUname" placeholder="Username.." name="inputUname">
            </div>

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
              <label for="inputPosition">Posisi</label>
              <select id="inputPosition" class="form-control" name="inputPosition">
                <option selected>Pilih...</option>
                <option value="superadmin">Super Admin</option>
                <option value="supervisorsales">Spv. Sales</option>
                <option value="sales">Sales</option>
                <option value="teknisi">Teknisi</option>
                <option value="admin">Register</option>
                <option value="intiadmin">Administrator</option>
                <option value="it">IT</option>
                <option value="users">User</option>
                <option value="distributor">Distributor</option>
              </select>
            </div>

            <div class="form-group">
              <label for="inputAddress">Alamat</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="Alamat Lengkap" name="inputAddress">
            </div>

            <div class="form-row">

              <div class="form-group col-md-6">
                <label for="inputCity">Kota</label>
                <input type="text" class="form-control" id="inputCity" name="inputCity" placeholder="cth: Jakarta Utara">
              </div>

              <div class="form-group col-md-4">
                <label for="inputState">Negara</label>
                <select id="inputState" class="form-control" name="inputState">
                  <option selected>Pilih...</option>
                  <option>Indonesia</option>
                </select>
              </div><br>

              <div class="form-group col-md-2">
                <!-- <label for="inputZip">Kode Pos</label> -->
                <input type="hidden" class="form-control" id="inputZip" name="inputZip">
                <input type="hidden" class="form-control" id="inputZip" name="targett">
              </div>
            </div>

            <button type="submit" class="btn btn-primary" name="register">Sign Up</button>
          </form>
          <a href="logout.php"><button type="submit" class="btn btn-danger">Keluar</button></a>
        </div>
      </div>
    </div>


  </body>

  </html>


<?php } else {
  header("location:../index.php");
} ?>