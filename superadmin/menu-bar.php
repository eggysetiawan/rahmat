<?php


require '../koneksi/koneksi.php';
$username = $_SESSION['username'];
$result999 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username'");
$row999 = mysqli_fetch_assoc($result999);
$name = $row999['name'];
// untuk view_funnel.php
$result1111 = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE buy_funnel = '100%' AND approve2 IS NULL AND tujuan_funnel = 'sales'");
$num_row1111 = mysqli_num_rows($result1111);

$resultdistributor = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE buy_funnel = '100%' AND approve2 IS NULL AND tujuan_funnel = 'distributor'");
$num_rowdistributor = mysqli_num_rows($resultdistributor);

$resultactivity = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE buy_funnel = '100%' AND approve2 IS NULL AND tujuan_funnel IN ('sales','distributor')");
$num_rowactivity = mysqli_num_rows($resultactivity);
// untuk view_funnel.php
// untuk approve_target.php
$result2222 = mysqli_query($conn, "SELECT * FROM inti_user WHERE targett IS NOT NULL AND approve_target IS NULL AND level IN ('sales', 'distributor')");
$num_row2222 = mysqli_num_rows($result2222);

$result313 = mysqli_query($conn, "SELECT * FROM sales_penawaran WHERE approve IS NULL AND delete_penawaran = 'ada'");
$num_rowss = mysqli_num_rows($result313);
// untuk approve_target.php
?>
<div class="container-fluid">
  <center><img src="../image/logoipi.png" style="width: 220px; padding: 5px 0px;"></center>
</div>







<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark sticky-top nav-sales">
  <a class="navbar-brand" href="index.php"><img src="../image/logo-sls.png" height="30" class="d-inline-block align-top animated swing slow"></a>

  <div class="rotate"><button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
      <span class=""><i class="fas fa-angle-down"></i></span>
    </button></div>

  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">

    <div class="container-fluid">
      <div class="row">
        <div class="active-bar">
          <ul class="navbar-nav mr-auto">

            <li class="nav-item">
              <a class="nav-link" href="admin.php"> Admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="kunjunganreport.php"> Kunjungan Report</a>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="view_penawaran.php"> Penawaran
                <?php if (!$num_rowss) { ?>

                <?php } else { ?>
                  <div class="notif-bar"></div><span class="counter counter-lg"><?php echo $num_rowss; ?></span>
                <?php } ?></a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="view_funnel2.php"> Sales Funnel </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="view_funnel.php"> Sales Activity
                <?php if (!$num_row1111) { ?>
                <?php } else { ?>
                  <div class="notif-bar"></div><span class="counter counter-lg">
                    <?php echo $num_row1111; ?></span>
                <?php } ?></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="view_distributor.php"> Ditributor Activity
                <?php if (!$num_rowdistributor) { ?>
                <?php } else { ?>
                  <div class="notif-bar"></div><span class="counter counter-lg">
                    <?php echo $num_rowdistributor; ?></span>
                <?php } ?></a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="view_funnel.php"> Sales Funnel
                <?php if (!$num_row1111) { ?>
                <?php } else { ?>
                  <div class="notif-bar"></div><span class="counter counter-lg">
                    <?php echo $num_row1111; ?></span>
                <?php } ?></a>
            </li>


            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Target/Reject
              </a>
              <div class="dropdown-menu">
                <a class="nav-link" href="targeting.php"> Targeting</a>
                <a class="dropdown-item" href="reject.php"> Reject</a>
              </div>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link" data-toggle="modal" data-target="#staticBackdrop"> Estimasi Target</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="target_approve.php">Approval <?php if (!$num_row2222) { ?>
                <?php } else { ?>
                  <div class="notif-bar"></div><span class="counter counter-lg">
                    <?php echo $num_row2222; ?></span>
                <?php } ?></a>
            </li>










            <!-- <li class="nav-item">
              <a class="nav-link" href="chat/indexchat.php"><i class="fas fa-times"></i> Chat </a>
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
          <strong>&nbsp;&nbsp;<i class="fas fa-user"></i>&nbsp;&nbsp;<?= $name; ?></strong>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a href="superadmintarget.php">Edit My Target</a>
          <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp; Logout</a>

        </div>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->

<!-- Modal Penawaran -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Buat Penawaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="metodeTes.php" method="post">
        <div class="modal-body">
          <div class="form-group">
            <!-- <label for="count_add">Masukan Form Penawaran Modality yang diiginkan (Max 4 Penawaran)</label> -->
            <!-- <div class="col-5"> -->
            <label for="exampleFormControlSelect1">Pilih nama Sales</label>
            <select class="form-control" id="exampleFormControlSelect1" name="username">
              <?php $sales = mysqli_query($conn, "SELECT * FROM inti_user WHERE level = 'sales'");
              while ($row = mysqli_fetch_assoc($sales)) :
              ?>
                <option value="<?= $row['username'] ?>"><?= $row['name']; ?></option>
              <?php endwhile; ?>
            </select>
            <!-- <input type="text" class="form-control" id="count_add" name="count_add" placeholder="masukan jumlah modality yang ingin ditambahkan" required maxlength="1" pattern="[1-9]+" autofocus> -->
            <!-- </div> -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <input type="submit" name="generate" value="Go Ahead!" class="btn btn-success">
          <!-- <button type="button" class="btn btn-primary">Understood</button> -->
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Modal Penawaran -->