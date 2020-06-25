<?php
require 'functionsales.php';
$result = mysqli_query($conn, "SELECT * FROM sales_customer");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css1/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css1/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css1/style.min.css" rel="stylesheet">
</head>

<body>

    <?php include('menu-bar.php'); ?>

    <!--Main layout-->
    <main class="mt-5 pt-5">
        <div class="container-fluid" style="padding: 0px 150px">

            <!--Section: Jumbotron-->
            <section class="card blue-gradient wow fadeIn" id="intro">

                <!-- Content -->
                <div class="card-body text-white text-center py-5 px-5 my-5">

                    <h1>
                        <strong>Welcome to Sales Portal</strong>
                        <h3>PT. INTIMEDIKA PUSPA INDAH</h3>
                    </h1>


                </div>
                <!-- Content -->
            </section>
            <!--Section: Jumbotron-->

            <!--Section: Cards-->
            <section class="pt-5">
                <div id="product">
                    <!-- Heading & Description -->
                    <div class="wow fadeIn pr1">

                        <div class="container-fluid">
                            <h1 class="h1-responsive font-weight-bold text-center">Our Products</h1>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <!-- Card 1 -->
                                    <div class="card">
                                        <!-- Card image -->
                                        <div class="view overlay zoom">
                                            <img class="card-img-top" src="image/irs.png" alt="Card image cap zoom">
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
                                    <div class="card">
                                        <!-- Card image -->
                                        <div class="view overlay zoom">
                                            <img class="card-img-top" src="image/cr12x.png" alt="Card image cap zoom">
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
                                    <div class="card">
                                        <!-- Card image -->
                                        <div class="view overlay zoom">
                                            <img class="card-img-top" src="image/xray-film.png" alt="Card image cap zoom">
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
                                                Universal, environmental friendly developers and fixers for all types of processors and
                                                films
                                                General Radiology & Mammography Film/Screen systems offering sharp image quality
                                                Long-lasting and shockproof cassettes
                                                Processing chemistries</p>
                                            <!-- Button -->
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalPush2">Read more..</a>
                                        </div>
                                    </div><br><br>
                                </div>
                                <!-- Card 3-->
                                <div class="col-md-3">
                                    <!-- Card 4-->
                                    <div class="card">
                                        <!-- Card image -->
                                        <div class="view overlay zoom">
                                            <img class="card-img-top" src="image/ajex.png" alt="Card image cap zoom">
                                            <a href="#!">
                                                <div class="mask rgba-white-slight"></div>
                                            </a>
                                        </div>
                                        <!-- Card content -->
                                        <div class="card-body">
                                            <!-- Title -->
                                            <h4 class="card-title title-card">Ajex Meditech</h4>
                                            <!-- Text -->
                                            <p class="card-text">High frequency mobile X-Ray System.</p>
                                            <!-- Button -->
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalPush3">Read more..</a>
                                        </div>
                                    </div><br><br>
                                </div>
                                <!-- Card 4-->
                            </div>
                        </div>


                    </div>
                </div>
                <!-- Heading & Description -->

                <!--Grid row-->
                <div class="row wow fadeIn">
                    <div class="container-fluid" id="populasi">
                        <!--Grid column-->
                        <div class="pr1">
                            <h1 class="h1-responsive font-weight-bold text-center">Populations</h1>
                            <hr>
                            <table id="dtBasicExample" class="table table-striped table-bordered table-hover table_kunjungan" border="0" cellspacing="0" width="100%" style="margin-top: 0px;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Rumah Sakit</th>
                                        <th>Alamat</th>
                                        <th>Dry film</th>
                                    </tr>
                                </thead>

                                <tr>
                                    <?php
                                    $no = 1;
                                    // result sales_costumer
                                    while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row['rs_cust']; ?></td>
                                        <td><?php echo $row['alamat_cust'] . ', ' . $row['kota_cust']; ?></td>
                                        <td>
                                            <?php
                                                $abc1 = $row['pk_cust'];
                                                $resultdry = mysqli_query($conn, "SELECT SUM(qty_order) AS totaldry 
                                                FROM sales_order 
                                                WHERE pk_mod_order = 5 
                                                AND  cust_fk = $abc1
                                                AND status_order = 'targeting' ");
                                                $rowdry = mysqli_fetch_assoc($resultdry);
                                                echo $rowdry['totaldry'];
                                                ?>
                                        </td>
                                        <?php $no++; ?>
                                </tr>
                            <?php endwhile; ?>
                            </table>
                        </div>
                        <!--Grid column-->
                    </div>

                </div>
                <!--Grid row-->



                <!--Grid row-->
                <div class="row wow fadeIn">
                    <div class="container-fluid" id="about">
                        <!--Grid column-->
                        <div class="pr1">
                            <h1 class="h1-responsive font-weight-bold text-center">About</h1>
                            <hr>
                            <p>PT. Intimedika Puspa Indah is the leading medical devices distributor for pharmaceutical and healthcare institutions. The devices we provide are used in many fields, including pharmaceutical laboratory, medicine, midwifery, nursing, physiotherapy, clinical laboratories.</p>
                            <p>
                                We serve mainly Indonesian customers either directly or through (future) online transactions. We believe that excellent service is a combination of the quality of goods we provide, affordable prices of goods along with maintenance and excellent consulting services that you can trust. With our established experience and happy costumers, we are delighted to provide the solution of your medical devices needs.
                            </p>
                            <p>
                                Kindly use this website as a reference of our company, the products we have for your medical devices needs, and the information on several devices from our healthcare manufacturing partners. If you’re interested in getting certain products that is not found on our website, do not hesitate to contact our costumer service. We would be glad to help!</p>
                            <p>
                                We hope that our strong commitment to provide best quality and affordable goods can help meet your needs.<br><br>

                                Contact us at +62-21-4532648
                            </p>
                        </div>
                        <!--Grid column-->
                    </div>

                </div>
                <!--Grid row-->





            </section>
            <!--Section: Cards-->

        </div>
    </main>
    <!--Main layout-->

    <!--Footer-->
    <footer class="page-footer font-small mdb-color darken-2 mt-4 wow fadeIn">

        <!--Call to action-->
        <div class="col-md-2 offset-5" style="padding-left: 45px; padding-top: 20px;">
            <strong style="float: left;">PT. Intimedika Puspa Indah</strong>
            <table>
                <tr>
                    <td>Phone</td>
                    <td> :</td>
                    <td> (+62)-21-4530583/45877231</td>
                </tr>
                <tr>
                    <td>Fax</td>
                    <td> :</td>
                    <td> (+62)-21-4532648</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td> :</td>
                    <td> sales@intimedika.co</td>
                </tr>
            </table>

        </div>
        <!--/.Call to action-->

        <hr class="my-4">

        <!-- Social icons -->
        <div class="pb-4 text-center">
            <a href="https://www.facebook.com/mdbootstrap" target="_blank">
                <i class="fab fa-facebook-f mr-3"></i>
            </a>

            <a href="https://twitter.com/MDBootstrap" target="_blank">
                <i class="fab fa-twitter mr-3"></i>
            </a>

            <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
                <i class="fab fa-youtube mr-3"></i>
            </a>

            <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
                <i class="fab fa-google-plus-g mr-3"></i>
            </a>

            <a href="https://dribbble.com/mdbootstrap" target="_blank">
                <i class="fab fa-dribbble mr-3"></i>
            </a>

            <a href="https://pinterest.com/mdbootstrap" target="_blank">
                <i class="fab fa-pinterest mr-3"></i>
            </a>

            <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
                <i class="fab fa-github mr-3"></i>
            </a>

            <a href="http://codepen.io/mdbootstrap/" target="_blank">
                <i class="fab fa-codepen mr-3"></i>
            </a>
        </div>
        <!-- Social icons -->

        <!--Copyright-->
        <div class="footer-copyright py-3 text-center">
            © 2020 Copyright:
            <a href="#"> IT Intimedika </a>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->


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


    <!-- SCRIPTS -->
    <!-- JQuery -->
    <?php include('script-footer.php'); ?>
    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>

    <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>

</html>