<?php
require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM sales_targeting INNER JOIN sales_modality ON sales_targeting.pk_mod_targeting = sales_modality.pk_mod WHERE username = '$username' AND approve = 'approved'");
// $row = mysqli_fetch_assoc($result);
// $pk_mod_funnel = $row['pk_mod_funnel'];
$result3 = mysqli_query($conn, "SELECT * FROM inti_user WHERE username = '$username' ");
$row3 = mysqli_fetch_assoc($result3);
$name3 = $row3['name'];
$target3 = $row3['targett'];
$approvtarget = $row3['approve_target'];
$nowyear = date('Y');
$result5 = mysqli_query($conn, "SELECT SUM(harga_po_targeting) AS totalsum FROM sales_targeting WHERE approve = 'approved' AND username = '$username' AND pengiriman = 'terkirim' AND tahun_targeting = '$nowyear'");
$rows = mysqli_fetch_assoc($result5);
$total = $rows['totalsum'];
@$persen = $total / $target3;
$persen1 = $persen * 100;


// $rowpresen = mysqli_fetch_assoc($resultpresentasi);



// date_default_timezone_set('Asia/Jakarta');


// $tgl1 = strtotime($tgl_presentasi . "- 1 day");
// $reminders = date("l d-m-Y H:i", $tgl1);
// $expired = time() - (0 * 1 * 60 * 60);





if ($_SESSION['level'] == "sales") {
?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Home</title>
    <?php include('head.php'); ?>
  </head>

  <body>
    <?php include('menu-bar.php'); ?>
    <div class="container-footer">
      <!-- buat footer -->


      <div class="jumbotron card card-image img-fluid dashboard1" style=" width: 100%; background-size: cover;" alt="Responsive image">
        <div class="text-white">
          <div class="container-fluid">
            <div class="row">

              <h2 class="card-title h1-responsive pt-3 mb-5 font-bold col-md-12 pd-jdl"><strong>Selamat Datang di Portal
                  Sales
                  Intimedika</strong>
              </h2>


              <div class="col-md-6 myTarget" style="height: 200px; overflow-y: auto;">

                <!-- <div style="float: left;"><h5>My Target</h5></div><br><br><br> -->
                <div class="tgt-name">My Target <?php if ($target3 == !NULL && $approvtarget == 'approved') { ?>
                    <?= $row3['tahun_target']; ?>
                  <?php } ?>
                  <div style="float: right;"><i class="fas fa-user"></i> <?= $name3; ?></div>
                </div>

                <hr style="margin: 0px;">

                <!-- <div class="persen5" style="float: left; font-size: 17px;"><?php echo rupiah($total); ?></div> -->
                <!-- total pendapatan sales -->

                <?php if ($persen1 >= '70') { ?>
                  <div class="persen5" style="float: left; font-size: 17px; color: #4fc678"><?php echo rupiah($total); ?></div>
                <?php } elseif ($persen1 >= '50') { ?>
                  <div class="persen5" style="float: left; font-size: 17px; color: #ffa700"><?php echo rupiah($total); ?></div>
                <?php } else { ?>
                  <div class="persen5" style="float: left; font-size: 17px; color: red"><?php echo rupiah($total); ?></div>
                <?php } ?>


                <div class="persen5 persen3" style="float: right;" onchange="<?php echo round($persen1); ?>"><?php echo round($persen1); ?>% / 100%</div><br>




                <div class="progress" style="margin: 10px 0px 5px 0px;">
                  <?php if ($persen1 >= '70') { ?>
                    <div class="progress-bar" role="progressbar" style="background-color: #4fc678; width: <?php echo round($persen1); ?>%" aria-valuenow='0' aria-valuemin="0" aria-valuemax='100'><?php echo round($persen1); ?>%</div>
                  <?php } elseif ($persen1 >= '50') { ?>
                    <div class="progress-bar" role="progressbar" style="background-color: #ffa700; width: <?php echo round($persen1); ?>%" aria-valuenow='0' aria-valuemin="0" aria-valuemax='100'><?php echo round($persen1); ?>%</div>
                  <?php } else { ?>
                    <div class="progress-bar" role="progressbar" style="background-color: red; width: <?php echo round($persen1); ?>%" aria-valuenow='0' aria-valuemin="0" aria-valuemax='100'><?php echo round($persen1); ?>%</div>
                  <?php } ?>
                </div>

                <?php if ($target3 == !NULL && $approvtarget == 'approved') { ?>
                  <div class="tgt-txt persen5">Target : <?php echo rupiah($target3); ?></div><br>
                <?php } else if ($target3 == !NULL && $approvtarget == 'rejected') { ?>
                  <div style="color: #00d1b2">Target ditolak! masukan target ulang</div>

                <?php } elseif ($target3 == '') { ?>
                  <div style="color: #00d1b2">Target belum di masukan</div>
                <?php } elseif ($target3 == !NULL && $approvtarget == '') { ?>
                  <div style="color: #00d1b2">Target belum di approve</div>
                <?php } ?>

                <?php if ($target3 == !NULL && $approvtarget == 'approved') { ?>
                  <div class="trgt1">
                    Sisa Target&nbsp;&nbsp;: <?php
                                              $hasil = $target3 - $total;
                                              if ($total >= $target3) {
                                                echo 'Target sudah Tercapai';
                                              } else {
                                                echo rupiah($hasil);
                                              } ?>


                    <?php
                    $hasil = $target3 - $total;
                    if ($total >= $target3) {
                      $hasil313 = $total - $target3;
                    ?>
                      <br>
                      Lebih Target&nbsp;:<?php echo rupiah($hasil313); ?>

                    <?php
                    }
                    ?>
                  </div>
                <?php } else { ?>

                <?php } ?>

                <a class="btn btn-success btn-md" href="targeting.php"><i class="fas fa-clone left"></i>
                  Targeting</a>
              </div>

              <!-- <div class="col-md-3 myTarget" style="height: 200px; overflow-y: auto;">
                <div class="tgt-name">Information
                </div> -->
              <!-- <hr style="margin: 0px;"><br>

              <div class="row">
                <div class="col-5">
                  <img src="../image/info.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-7" style="color: #000;">


                  <?php
                  date_default_timezone_set('Asia/Jakarta');
                  $today = date("d-m-Y");
                  $day = time() + (1 * 24 * 60 * 60);
                  $besok = date('d-m-Y', $day);
                  ?>
                  <?php

                  $resultpresentasi = mysqli_query($conn, "SELECT * FROM sales_funnel
                    INNER JOIN sales_customer ON sales_customer.pk_cust = sales_funnel.customer_fk 
                      WHERE sales_funnel.username = '" . $username . "' 
                      AND sales_funnel.tgl_presentasi 
                      BETWEEN '$today' 
                      AND '$besok'   
                      ORDER BY sales_funnel.tgl_presentasi 
                      ASC");

                  while ($row = mysqli_fetch_assoc($resultpresentasi)) : ?>
                    <?php
                    $rs = $row['rs_cust'];
                    $kota = $row['kota_cust'];
                    $tgl = $row['tgl_presentasi'];
                    $nopen = $row['no_penawaran'];
                    $mod = $row['mod_presentasi'];
                    $approve = $row['approve_presentasi'];
                    ?>
                    <?php if ($tgl) { ?>
                      <?=

                        "
                                                $nopen
                                                Kamu memiliki jadwal Presentasi di $rs, $kota. <br> Pada Tanggal : $tgl
                                                Untuk mempresentasikan $mod
                                                 "; ?>
                      <hr>
                    <?php  } ?>

                  <?php endwhile; ?>




                </div>
              </div>
            </div> -->

              <!-- <div class="col-md-2 myTarget" style="height: 200px; overflow-y: auto;">
                <div class="tgt-name">Intiwid Rispacs Demo
                </div>
                <hr style="margin: 0px;">
                <p style="color: #000;"> Demo clik here... </p>

                <a href="#" data-toggle="modal" data-target="#modalConfirmDelete">
                  <div class="intiwid1"><img src="../image/intiwid-logo.png"></div>
                </a>
              </div> -->



              <!--Modal: modalConfirmDelete-->
              <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-notify modal-info" role="document">
                  <!--Content-->
                  <div class="modal-content text-center">
                    <!--Header-->
                    <div class="modal-header d-flex justify-content-center">
                      <p class="heading">Open Intiwid Rispacs?</p>
                    </div>

                    <!--Body-->
                    <div class="modal-body">

                      <img height="50%" src="../image/intiwid-logo.png" class="animated fadeInDown">

                    </div>

                    <!--Footer-->
                    <div class="modal-footer flex-center">
                      <a href="http://36.92.153.227:8089/intiwid" class="btn  btn-outline-info" target="blank">Yes</a>
                      <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
                    </div>
                  </div>
                  <!--/.Content-->
                </div>
              </div>
              <!--Modal: modalConfirmDelete-->



            </div>
          </div>

        </div>

      </div>
      <br>




      <div class="container-fluid">
        <h1 class="h1-responsive font-weight-bold text-center my-5">Our Products</h1>
        <hr>
        <div class="row">



          <div class="col-md-3">
            <!-- Card 1 -->
            <div class="card" style="height: 500px; overflow-y: auto;">
              <!-- Card image -->
              <div class="view overlay zoom">
                <img class="card-img-top" src="../image/irs.png" alt="Card image cap zoom">
                <a href="#!">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!-- Card content -->
              <div class="card-body">
                <!-- Title -->
                <h4 class="card-title title-card">Intiwid Radiology System</h4>
                <!-- Text -->
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <!-- Button -->
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalPush">Read more..</a>
              </div>
            </div>
            <br><br>
          </div>

          <!-- Card 1-->


          <div class="col-md-3">
            <!-- Card 2 -->
            <div class="card" style="height: 500px; overflow-y: auto;">
              <!-- Card image -->
              <div class="view overlay zoom">
                <img class="card-img-top" src="../image/cr12x.png" alt="Card image cap zoom">
                <a href="#!">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!-- Card content -->
              <div class="card-body">
                <!-- Title -->
                <h4 class="card-title title-card">CR 12-X AGFA</h4>
                <!-- Text -->
                <p class="card-text">An affordable entry into digital radiography that places you in complete control.</p>
                <!-- Button -->
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalPush1">Read more..</a>
              </div>
            </div><br><br>
          </div>
          <!-- Card 2-->


          <div class="col-md-3">
            <!-- Card 3-->
            <div class="card" style="height: 500px; overflow-y: auto;">
              <!-- Card image -->
              <div class="view overlay zoom">
                <img class="card-img-top" src="../image/xray-film.png" alt="Card image cap zoom">
                <a href="#!">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!-- Card content -->
              <div class="card-body">
                <!-- Title -->
                <h4 class="card-title title-card">X-Ray Film AGFA</h4>
                <!-- Text -->
                <p class="card-text">Silver halide based X-ray film
                  Universal, environmental friendly developers and fixers...</p>
                <!-- Button -->
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalPush2">Read more..</a>
              </div>
            </div><br><br>
          </div>
          <!-- Card 3-->


          <div class="col-md-3">
            <!-- Card 4-->
            <div class="card" style="height: 500px; overflow-y: auto;">
              <!-- Card image -->
              <div class="view overlay zoom">
                <img class="card-img-top" src="../image/ajex.png" alt="Card image cap zoom">
                <a href="#!">
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!-- Card content -->
              <div class="card-body">
                <!-- Title -->
                <h4 class="card-title title-card">Ajex Meditech</h4>
                <!-- Text -->
                <p class="card-text">High frequency mobile X-Ray System, Powerful output covering most radiographic technique...</p>
                <!-- Button -->
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalPush3">Read more..</a>
              </div>
            </div><br><br>
          </div>
          <!-- Card 4-->


        </div>
      </div>
      <br><br><br><br><br><br><br><br>




      <?php include('footer.php'); ?>
    </div><!-- end of container footer -->




    <!--Modal: Intiwid Radiology System-->
    <div class="modal fade" id="modalPush" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">Intiwid Radiology System</p>
          </div>

          <!--Body-->
          <div class="modal-body">

            <i class="fas fa-bell fa-4x animated rotateIn mb-4"></i>

            <div class="intiwid-system">
              <h3>Intiwid</h3>
              <pre>• Radiation Dose Report
• Dicom Structure Report
• 2D and 3D medical image viewing
• Multiplanar Reconstruction (MPR)
• Maximum Intensity Project (MIP)
• User Access Control (UAC)
• Standard tools :Cine, W/L,Rotation,Measurement (length), angle etc.</pre>
              <h3>CareRay</h3>
              <pre>
• 14×17′′ Wireless/tethered with handle
• Transfer of an image in ~4 seconds
• Full-Field Automatic Exposure Detection (F AED ) Technology
• 154 um pixel pitch
• Dual-bands (2.4/5GHz) at 300Mbps data transmission rate
• Extra long battery life, CesiumDetector (Csl).
        </pre>

              <h3>Epson L1110</h3>
              <pre>• Low cost
• Clear Medical Dry Film (Inkjet)
• The print speed is high with a resolution of 5760 x 1440 dpi.</pre>

            </div>

          </div>

          <!--Footer-->
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--Modal: Intiwid radiology system-->





    <!--Modal: CR AGFA-->
    <div class="modal fade" id="modalPush1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">CR 12-X AGFA</p>
          </div>

          <!--Body-->
          <div class="modal-body">

            <i class="fas fa-bell fa-4x animated rotateIn mb-4"></i>

            <div class="intiwid-system">
              <h3>CR 12X AGFA</h3>



              <h2>Why choose the CR 12-X?</h2>
              <pre>
BALANCE SPEED AND RESOLUTION

An affordable entry into digital radiography that places you in complete control.

One that allows you to make your own decisions when balancing the need for speed versus resolution – without compromising on image quality.

One that enables you to adapt and adjust your choice on a study-by-study basis and harness the power of  MUSICA imaging processing software.
</pre>


              <h2>Streamlined integrated workflow</h2>
              <pre>Making your existing solutions work harder for you is a driving force in today’s economically challenging environment.

With the CR 12-X’s versatility and integration delivering increased workflow, you maximize your return on investment.

Suitable for general radiology, orthopaedics, chiropractic and full-leg/full spine applications, the CR 12-X’s broad range of application capabilities makes it highly versatile and cost-effective.

<strong>Fast and simple service and maintenance</strong>
The modular technology within the CR 12-X shortens installation and service time.

Its single slot cassette and plate handling uses only two motors, resulting in minimal intervention.
Covers, modules and parts are easy to replace, with a single tool making service and maintenance fast and simple.

In addition, smartcard technology (USB) stores the up-to-date site-specific settings and service information. This simplifies access to service data and on-site replacement.</pre>


            </div>

          </div>

          <!--Footer-->
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--Modal: modalPush-->



    <!--Modal: XRAY FILM AGFA-->
    <div class="modal fade" id="modalPush2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">X-RAY Film AGFA</p>
          </div>

          <!--Body-->
          <div class="modal-body">

            <i class="fas fa-bell fa-4x animated rotateIn mb-4"></i>

            <div class="intiwid-system">
              <h3>X-Ray Film and Screen for Diagnostic Imaging</h3>
              <pre>•  Silver halide based X-ray film for General Radiology & Mammography offering sharp image quality
•   Universal, environmental friendly developers and fixers for all types of processors and films
•   Long-lasting and shockproof cassettes
•   Processing chemistry
</pre>



            </div>

          </div>

          <!--Footer-->
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--Modal: XRAY FILM AGFA-->


    <!--Modal: Ajex-->
    <div class="modal fade" id="modalPush3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">Ajex Meditech</p>
          </div>

          <!--Body-->
          <div class="modal-body">

            <i class="fas fa-bell fa-4x animated rotateIn mb-4"></i>

            <div class="intiwid-system">
              <h3>Ajex Meditech</h3>
              <pre>Features
•   High frequency inverter type generator
•   Digital displays of kV, mAs and exposure time(sec.)
•   Self-managible APR function with memory keys
•   Stable output by dynamic voltage compensator
•   Seif-detection of errer conditions
•   Available bucky interface kit (Option)
Advantages
•   Powerful output covering most radiographic technique
•   Superb images from a high quality, small focal spot 

</pre>



            </div>

          </div>

          <!--Footer-->
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!--Modal: Ajex-->






    <?php include('script-footer.php'); ?>


  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>