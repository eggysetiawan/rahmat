<?php

require '../functionsales.php';
session_start();
$username = $_SESSION['username'];
if (isset($_POST['submit'])) {



    if (penawaran($_POST) > 0) {
        echo "<script>alert('data berhasil dimasukkan');
        document.location.href= 'view_penawaran.php';
        </script>";
    } else {
        echo "<script>alert('data gagal dimasukkan');
        document.location.href= 'penawaran.php';
        </script>";
    }
}
if ($_SESSION['level'] == "sales") {
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Masukan Penawaran</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?>
        <div class="container-footer">
            <!-- buat footer -->
            <div class="bc-icons-2">
                <?php include('breadcrumb.php'); ?>
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                <li class="breadcrumb-item active">Penawaran</li>
                </ol>
                </nav>
            </div>

            <div class="container-fluid content1">
                <div class="row justify-content-md-center" style="margin: 0px;">

                    <div class="form-harian col-md-6">
                        <!-- <?php

                                    $i = 0000;
                                    while ($i <= 1000) {
                                        printf('%04d ', $i);
                                        $i++;
                                    }

                                    ?> -->
                        <center>
                            <h1>Input Penawaran</h1>
                        </center>
                        <br>
                        <!-- <a href="generate.php"><button class="btn-success btn-penawaran">Tambahkan Data</button></a><br> -->
                        <form class="pnwrn" action="" method="POST">
                            <input type="hidden" name="total" value="<?php $_POST['count_add']; ?>">

                            <div class="form-group">

                                <label for="exampleFormControlSelect1">Rumah Sakit</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="pk_kunjungan">
                                    <option>---Pilih Rumah Sakit---</option>
                                    <?php
                                        $result = mysqli_query($conn, "SELECT * FROM sales_kunjungan WHERE username = '$username'");
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value=" <?php echo $row['pk_kunjungan'] ?>">
                                            <?php echo $row['rs_kunjungan'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <div class=" form-group">
                                    <label for="exampleFormControlSelect1">Sumber Dana</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="budget_funnel">
                                        <option>---Pilih Sumber Dana---</option>
                                        <option value="APBN">APBN</option>
                                        <option value="APBD">APBD</option>
                                        <option value="APBN-P">APBN-P</option>
                                        <option value="DAK">DAK</option>
                                        <option value="BLUD">BLUD</option>
                                        <option value="Swasta">Swasta</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="referensi">Referensi</label><br>

                                    <label class="radio-admin">
                                        <input type="radio" id="referensi" name="referensi" value="E-Catalogue"> E-Catalogue
                                        <span class="checkmark"></span>
                                    </label><br>

                                    <label class="radio-admin">
                                        <input type="radio" id="referensi" name="referensi" value="Non E-Catalogue" required>
                                        Non E-Catalogue
                                        <span class="checkmark"></span>
                                    </label><br>

                                </div>
                                <hr>
                            </div>







                            <!-- --------------------------------1----------------- -->
                            <div class="penwaran1">
                                <h2><strong>1</strong></h2>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1"><?php echo "Modality 1"; ?></label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="pk_mod1[]">
                                        <option>---Pilih Modality---</option>
                                        <?php
                                            $result = mysqli_query($conn, "SELECT * FROM sales_modality");
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value=" <?php echo $row['pk_mod'] ?>">
                                                <?php echo $row['nama_mod'] . ' Harga : ' . rupiah($row['harga_mod']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="harga_penawaran"><?php echo "Harga Penawaran 1" ?></label>
                                    <input type="text" class="form-control" id="harga_penawaran" name="harga_penawaran1[]" placeholder="Maksimal Disc 50%" pattern="[0-9]+" required>
                                </div>

                                <div class="form-group">
                                    <label for="qty"><?php echo "Qty Penawaran 1" ?></label>
                                    <input type="text" class="form-control" id="qty" name="qty1[]" placeholder="Qty penawaran.." pattern="[0-9]+" required>
                                </div>
                                <br>
                                <hr>

                                <div class="rotate1">
                                    <a href="#" class="toggle1" data-toggle="collapse">
                                        <div class="toggle-penawaran">
                                            <span><i class="fas fa-plus-circle plus-1"></i></span>
                                        </div>
                                    </a>
                                </div>

                                <br><br>
                            </div>
                            <!-- --------------------------------1----------------- -->


                            <!-- --------------------------------2----------------- -->
                            <div class="penawaran2">
                                <h2><strong>2</strong></h2>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1"><?php echo "Modality 2"; ?></label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="pk_mod1[]">
                                        <option>---Pilih Modality---</option>
                                        <?php
                                            $result = mysqli_query($conn, "SELECT * FROM sales_modality");
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value=" <?php echo $row['pk_mod'] ?>">
                                                <?php echo $row['nama_mod'] . ' Harga : ' . rupiah($row['harga_mod']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="harga_penawaran"><?php echo "Harga Penawaran 2" ?></label>
                                    <input type="text" class="form-control" id="harga_penawaran" name="harga_penawaran1[]" placeholder="Maksimal Disc 50%" pattern="[0-9]+">
                                </div>

                                <div class="form-group">
                                    <label for="qty"><?php echo "Qty Penawaran 2" ?></label>
                                    <input type="text" class="form-control" id="qty" name="qty1[]" placeholder="Qty penawaran.." pattern="[0-9]+">
                                </div>
                                <br>
                                <hr>
                                <a href="#" class="toggle2" data-toggle="collapse">
                                    <div class="toggle-penawaran">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                </a>
                                <br><br>
                            </div>
                            <!-- --------------------------------2----------------- -->

                            <!-- --------------------------------3---   -------------- -->
                            <div class="penawaran3">
                                <h2><strong>3</strong></h2>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1"><?php echo "Modality 3"; ?></label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="pk_mod1[]">
                                        <option>---Pilih Modality---</option>
                                        <?php
                                            $result = mysqli_query($conn, "SELECT * FROM sales_modality");
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value=" <?php echo $row['pk_mod'] ?>">
                                                <?php echo $row['nama_mod'] . ' Harga : ' . rupiah($row['harga_mod']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="harga_penawaran"><?php echo "Harga Penawaran 3" ?></label>
                                    <input type="text" class="form-control" id="harga_penawaran" name="harga_penawaran1[]" placeholder="Maksimal Disc 50%" pattern="[0-9]+">
                                </div>

                                <div class="form-group">
                                    <label for="qty"><?php echo "Qty Penawaran 3" ?></label>
                                    <input type="text" class="form-control" id="qty" name="qty1[]" placeholder="Qty penawaran.." pattern="[0-9]+">
                                </div>
                                <br>
                                <hr>
                                <a href="#" class="toggle3" data-toggle="collapse">
                                    <div class="toggle-penawaran">
                                        <i class="fas fa-plus-circle"></i>
                                    </div>
                                </a>
                                <br><br>
                            </div>
                            <!-- --------------------------------3----------------- -->

                            <!-- --------------------------------4----------------- -->
                            <div class="penawaran4">
                                <h2><strong>4</strong></h2>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1"><?php echo "Modality 4"; ?></label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="pk_mod1[]">
                                        <option>---Pilih Modality---</option>
                                        <?php
                                            $result = mysqli_query($conn, "SELECT * FROM sales_modality");
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <option value=" <?php echo $row['pk_mod'] ?>">
                                                <?php echo $row['nama_mod'] . ' Harga : ' . rupiah($row['harga_mod']) ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="harga_penawaran"><?php echo "Harga Penawaran 4" ?></label>
                                    <input type="text" class="form-control" id="harga_penawaran" name="harga_penawaran1[]" placeholder="Maksimal Disc 50%" pattern="[0-9]+">
                                </div>

                                <div class="form-group">
                                    <label for="qty"><?php echo "Qty Penawaran 4" ?></label>
                                    <input type="text" class="form-control" id="qty" name="qty1[]" placeholder="Qty penawaran.." pattern="[0-9]+">
                                </div>
                                <br>
                                <hr>
                            </div>
                            <!-- --------------------------------4----------------- -->




                            <!-- <div class="form-group">
                <label for="pricelist">Pricelist</label>
                <input type="text" class="form-control" id="pricelist" name="pricelist" value="<?= $row['harga_mod']; ?>">
              </div> -->


                            <div class="form-group">
                                <!-- <label for="tanggal">Tanggal Penawaran</label> -->
                                <input type="hidden" class="form-control" id="date" name="tgl_penawaran" placeholder="tanggal penawaran..">
                            </div>


                            <div class="md-form mt-3">
                                <input type="hidden" class="form-control" name="username" value="<?= $username; ?>">
                            </div>

                            <div >
                                <input class="input1" type="text" placeholder="klik maka akan muncul tulisan dibawah..">
                            </div><br>

                            <div class="hide1">Heyyy lihat sini dong</div>


                            <button type="submit" name="submit" class="btn btn-primary">SIMPAN</button>

                        </form>
                    </div>
                </div>



<div class="container-fluid">
  <div class="row">


    <div class="col-md-3">
      <!-- Card 1 -->
      <div class="card">
        <!-- Card image -->
        <div class="view overlay">
          <img class="card-img-top" src="../image/irs.png" alt="Card image cap">
          <a href="#!">
            <div class="mask rgba-white-slight"></div>
          </a>
        </div>
        <!-- Card content -->
        <div class="card-body">
          <!-- Title -->
          <h4 class="card-title">Intiwid Radiology System</h4>
          <!-- Text -->
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <!-- Button -->
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalPush">Read more..</a>
        </div>
      </div>
    </div>
    <!-- Card 1-->


    <div class="col-md-3">
      <!-- Card 2 -->
      <div class="card">
        <!-- Card image -->
        <div class="view overlay">
          <img class="card-img-top" src="../image/cr12x.png" alt="Card image cap">
          <a href="#!">
            <div class="mask rgba-white-slight"></div>
          </a>
        </div>
        <!-- Card content -->
        <div class="card-body">
          <!-- Title -->
          <h4 class="card-title">CR 12-X AGFA</h4>
          <!-- Text -->
          <p class="card-text">An affordable entry into digital radiography that places you in complete control.</p>
          <!-- Button -->
          <a href="#" class="btn btn-primary">Read more..</a>
        </div>
      </div>
    </div>
    <!-- Card 2-->


    <div class="col-md-3">
      <!-- Card 3-->
      <div class="card">
        <!-- Card image -->
        <div class="view overlay">
          <img class="card-img-top" src="../image/xray-film.png" alt="Card image cap">
          <a href="#!">
            <div class="mask rgba-white-slight"></div>
          </a>
        </div>
        <!-- Card content -->
        <div class="card-body">
          <!-- Title -->
          <h4 class="card-title">X-Ray Film AGFA</h4>
          <!-- Text -->
          <p class="card-text">Silver halide based X-ray film
                                Universal, environmental friendly developers and fixers for all types of processors and
                                films
                                General Radiology & Mammography Film/Screen systems offering sharp image quality
                                Long-lasting and shockproof cassettes
                                Processing chemistries</p>
          <!-- Button -->
          <a href="#" class="btn btn-primary">Read more..</a>
        </div>
      </div>
    </div>
    <!-- Card 3-->


    <div class="col-md-3">
      <!-- Card 4-->
      <div class="card">
        <!-- Card image -->
        <div class="view overlay">
          <img class="card-img-top" src="../image/ajex.png" alt="Card image cap">
          <a href="#!">
            <div class="mask rgba-white-slight"></div>
          </a>
        </div>
        <!-- Card content -->
        <div class="card-body">
          <!-- Title -->
          <h4 class="card-title">Ajex Meditech</h4>
          <!-- Text -->
          <p class="card-text">High frequency mobile X-Ray System.</p>
          <!-- Button -->
          <a href="#" class="btn btn-primary">Read more..</a>
        </div>
      </div>
    </div>
    <!-- Card 4-->


  </div>
</div>






            </div>

            <?php include('footer.php'); ?>



        </div><!-- end of container footer -->

        <?php include('script-footer.php'); ?>
        <script>
            $('#date').datetimepicker({
                format: 'd-m-Y H:i'
            });
        </script>

        <!-- <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>

<script type="text/javascript">
            $(document).ready(function(){

                // Format mata uang.
                $( '.uang' ).mask('00.000.000.000', {reverse: true});

            })
        </script> -->
    </body>

    </html>

<?php } else {
    header("location:../index.php");
} ?>