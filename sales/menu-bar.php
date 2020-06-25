<?php


require '../koneksi/koneksi.php';
$username = $_SESSION['username'];
$result999 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username'");
$row999 = mysqli_fetch_assoc($result999);
$name = $row999['name'];




?>
<div class="container-fluid logo-ipi">
    <center><img src="../image/logoipi.png" style="width: 220px"></center>
</div>







<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-light sticky-top nav-sales">
    <a class="navbar-brand" href="index.php"><img src="../image/logo-sls.png" height="30" class="d-inline-block align-top animated swing slow"></a>

    <div class="rotate"><button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""><i class="fas fa-angle-down"></i></span>
        </button></div>

    <div class="collapse navbar-collapse nav-sales2" id="navbarSupportedContent-333">

        <div class="container-fluid">
            <div class="row">
                <div class="active-bar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active-bar3" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Kunjungan
                            </a>
                            <div class="dropdown-menu active-bar2">
                                <a class="dropdown-item" href="kunjunganharian.php"> Input Kunjungan Harian</a>
                                <a class="dropdown-item" href="kunjunganreport.php"> Laporan Kunjungan</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Target Plan
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="generate_funnel.php"> Add Plan</a>
                                <a class="dropdown-item" href="view_funnel2.php"> View Plan</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Resource</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Penawaran
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="generate.php"> Penawaran</a>
                                <a class="dropdown-item" href="view_penawaran.php"> View Penawaran</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_funnel.php"> Funnel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="targeting.php"> Targeting</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="metodeTes.php"> Estimasi Target</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="reject.php"> Reject </a>
                        </li> -->


                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Funnel
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="Funnel2.php"> Input Funnel</a>
                                <a class="dropdown-item" href="view_funnel2.php"> View Funnel</a>
                            </div>
                        </li> -->


                    </ul>
                </div>
            </div>
        </div>

        <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </i>&nbsp;&nbsp;<?= $name; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                    <a href="generate_tahun.php"><strong>&nbsp;&nbsp;<i class="fas fa-user"></i>&nbsp;&nbsp;Profil</strong></a>

                    <a class="dropdown-item" href="recycle.php"><i class="fas fa-recycle"></i>&nbsp;&nbsp;
                        Recycle Bin</a>
                    <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;
                        Logout</a>

                </div>
            </li>
            <li class="nav-item info-bar">

                <!-- <button type="button" class="btn btn-sm danger-color" data-toggle="modal" data-target="#basicExampleModal5">msg</button> -->


                <!--Modal: modalRelatedContent-->
                <div class="modal fade right" id="modalRelatedContent1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
                        <!--Content-->
                        <div class="modal-content">
                            <!--Header-->
                            <div class="modal-header">
                                <p class="heading">Information</p>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="white-text">&times;</span>
                                </button>
                            </div>

                            <!--Body-->
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-5">
                                        <img src="../image/info.jpg" class="img-fluid" alt="">
                                    </div>

                                    <div class="col-7">


                                        <?php
                                        date_default_timezone_set('Asia/Jakarta');
                                        $today = date("d-m-Y");
                                        $day = time() + (1 * 24 * 60 * 60);
                                        $besok = date('d-m-Y', $day);
                                        ?>
                                        <?php

                                        $resultpresentasi = mysqli_query($conn, "SELECT * FROM sales_funnel WHERE username = '" . $username . "' AND tgl_presentasi BETWEEN '$today' AND '$besok' ORDER BY tgl_presentasi ASC LIMIT 3 ");

                                        while ($row = mysqli_fetch_assoc($resultpresentasi)) : ?>
                                            <?php
                                            $rs = $row['rs_funnel'];
                                            $kota = $row['kota_funnel'];
                                            $tgl = $row['tgl_presentasi'];
                                            $nopen = $row['no_penawaran'];
                                            $mod = $row['mod_presentasi'];
                                            ?>
                                            <?php if ($tgl) { ?>
                                                <?=

                                                    "
                                                $nopen
                                                Kamu memiliki jadwal Presentasi di $rs, $kota. <br> Pada Tanggal : $tgl
                                                Untuk mempresentasikan $mod
                                                 "; ?>
                                                <hr>

                                            <?php } else { ?>
                                                <?= "Anda Belum Memiliki Jadwal Presentasi"; ?>
                                            <?php  } ?>

                                        <?php endwhile; ?>




                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.Content-->
                    </div>
                </div>
                <!--Modal: modalRelatedContent-->


            </li>


        </ul>
    </div>
</nav>

<!-- Button trigger modal-->





<!--/.Navbar -->

<!-- Modal -->
<div class="modal fade" id="basicExampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tes
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>