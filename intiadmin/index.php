<?php
require '../functionsales.php';
session_start();
if ($_SESSION['level'] == "intiadmin") {
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
      <div class="bc-icons-2">
        <?php include('breadcrumb.php'); ?>

        <li class="breadcrumb-item active">Home</li>
        </ol>
        </nav>
      </div>


      <div class="jumbotron card card-image img-fluid" style="background-image: url(../image/back.png); width: 100%; background-size: cover;" alt="Responsive image">
        <div class="text-white text-center py-5 px-4">
          <div class="container-fluid">
            <div class="row">

              <div class="col-md-5">
                <h2 class="card-title h1-responsive pt-3 mb-5 font-bold" style="color: #fff;"><strong>Selamat Datang di Portal Sales Intimedika</strong></h2>

                <a class="btn btn-success btn-md" href="targeting.php"><i class="fas fa-clone left"></i> Targeting</a>
              </div>
            </div>
          </div>
        </div>
      </div>


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
    <?php include('script-footer.php'); ?>


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


  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>