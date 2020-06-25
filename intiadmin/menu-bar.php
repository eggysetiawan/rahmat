<?php


require '../koneksi/koneksi.php';
$username = $_SESSION['username'];
$result999 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username'");
$row999 = mysqli_fetch_assoc($result999);
$name = $row999['name'];
// untuk view_penawaran.php
// untuk view_penawaran.php



$result313 = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE approve IS NULL");
$num_rowss = mysqli_num_rows($result313);
$row313 = mysqli_fetch_assoc($result313);

$result2222 = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE approve = 'approved' AND buy_funnel = '100%' AND approve2 = 'approved'");
$num_row2222 = mysqli_num_rows($result2222);



?>
<div class="container-fluid">
  <center><img src="../image/logoipi.png" style="width: 220px"></center>
</div>







<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark sticky-top nav-sales">
  <a class="navbar-brand" href="index.php"><img src="../image/logo-sls.png" height="30" class="d-inline-block align-top animated swing slow"></a>

  <div class="rotate"><button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
      <span class=""><i class="fas fa-angle-down"></i></span>
    </button></div>

  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">


    <div class="container">
      <div class="row">
        <div class="offset-md-2 active-bar">

          <ul class="navbar-nav mr-auto">

            <li class="nav-item">
              <a class="nav-link" href="admin.php"><i class="fas fa-folder-plus"></i> Resource</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="kunjunganreport.php"><i class="fas fa-folder-plus"></i> Kunjungan Report</a>
            </li> -->

            <!-- <li class="nav-item">
              <a class="nav-link" href="view_penawaran.php"><i class="fas fa-money-check"></i> Penawaran <span>
                  <div class="notif-bar">
                    <?php if (!$num_rowss) { ?>
                      <?php } else { ?><?php echo $num_rowss; ?></div><i class="fas fa-circle f1"></i><?php } ?></a></span>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="view_funnel.php"> Pengiriman
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="targeting.php"><i class="fas fa-bullseye"></i> Targeting</a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link" href="reject.php"><i class="fas fa-times"></i> Reject </a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link" href="approvedemo.php"><i class="fas fa-times"></i> approval </a>
            </li> -->

          </ul>
        </div>
      </div>
    </div>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <!-- <li class="nav-item">
          <a class="nav-link waves-effect waves-light">
            <span class="circle-sls"><i class="fab fa-twitter"></i></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect waves-light">
            <span class="circle-sls2"><i class="fab fa-google-plus-g"></i></span>
          </a>
        </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <strong>&nbsp;&nbsp;<i class="fas fa-user"></i></strong>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">

          <a href="profile.php"><strong>&nbsp;&nbsp;<i class="fas fa-user"></i>&nbsp;&nbsp;<?= $name; ?></strong></a>


          <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp; Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->