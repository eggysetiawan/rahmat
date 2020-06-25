<?php


require '../koneksi/koneksi.php';
$username = $_SESSION['username'];
$result999 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username'");
$row999 = mysqli_fetch_assoc($result999);
$name = $row999['name'];
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.1/css/bulma.min.css" rel="stylesheet">
<style type="text/css">
  .navbar-item.is-mega {
  position: static;

  .is-mega-menu-title {
    margin-bottom: 0;
    padding: .375rem 1rem;
  }
}

</style>


<nav class="navbar is-transparent is-fixed-top">
  <div class="navbar-brand">
    <a class="navbar-item" href="index.php">
      <img src="../image/sale.png"  height="58">
    </a>
    <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div id="navbarExampleTransparentExample" class="navbar-menu">
    <div class="navbar-start">

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">
          Laporan Kunjungan
        </a>
        <div class="navbar-dropdown is-boxed">
          <a class="navbar-item" href="kunjunganharian.php">
            Laporan Kunjungan Harian
          </a>
          <a class="navbar-item" href="kunjunganreport.php">
            Laporan Kunjungan
          </a>
        </div>
      </div>

      <a class="navbar-item" href="admin.php">
        Admin
      </a>

      <a class="navbar-item" href="penawaran.php">
        Penawaran
      </a>

      <a class="navbar-item" href="view_funnel.php">
        Laporan Funnel
      </a>
      <a class="navbar-item" href="targeting.php">
        Targeting
      </a>

      <a class="navbar-item" href="logout.php">
        Logout
      </a>   
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="field is-grouped">
          <p class="control">
            <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">
          <i class="fas fa-user"></i>
        </a>
        <div class="navbar-dropdown is-boxed">
          <a href="profile.php"><strong>&nbsp;&nbsp;<i class="fas fa-user"></i>&nbsp;&nbsp;<?= $name; ?></strong></a>
          <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp; Logout</a>
        </div>
      </div>
          </p>
        </div>
      </div>
    </div>
  </div>
</nav>
</nav>
<section class="hero is-primary">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Selamat datang di portal Sales Intimedika
      </h1>
      <h2 class="subtitle">
        Let's get the target
      </h2>
    </div>
  </div>
</section>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {

  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any nav burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {

        // Get the target from the "data-target" attribute
        var target = $el.dataset.target;
        var $target = document.getElementById(target);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

});
</script>