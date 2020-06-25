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
			  document.location.href= 'view_penawaran.php';
			  </script>";
  }
}
if ($_SESSION['level'] == "sales") {
  if ($_POST['count_add'] != 0) {
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

              <!-- <form action="" method="post">
                            <div class="form-group">
                                <label for="count_add">Jumlah Form Penawaran yang diiginkan (numbers only)</label>
                                <input type="text" class="form-control" id="count_add" name="count_add" placeholder="Masukan jumlah penawaran yang ingin ditambahkan" required maxlength="1" pattern="[1-9]+">
                                <input type="submit" name="generate" value="Tambah Data" class="btn btn-success">

                            </div>
                        </form> -->
              <a href="generate.php"><button class="btn-success btn-penawaran">Tambahkan Data</button></a><br>
              <form class="pnwrn" action="" method="POST">

                <div class="form-group">

                  <label for="exampleFormControlSelect1">Rumah Sakit</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="pk_kunjungan">
                    <option disabled selected>---Pilih Rumah Sakit---</option>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM sales_customer
                    INNER JOIN inti_rs ON sales_customer.fk_rs = inti_rs.pk_rs
                     WHERE username = '$username'");
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                      <option value=" <?php echo $row['pk_rs'] ?>">
                        <?php echo $row['nama_rs'] ?>
                      </option>
                    <?php } ?>
                  </select>


                  <div class=" form-group">
                    <label for="exampleFormControlSelect1">Sumber Dana</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="budget_funnel">
                      <option disabled selected>---Pilih Sumber Dana---</option>
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






                <?php
                $count_add = $_POST['count_add'];
                for ($i = 1; $i <= $count_add; $i++) { ?>
                  <!-- --------------------------------1----------------- -->
                  <div class="penwaran1">
                    <h2><strong><?= $i; ?></strong></h2>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1"><?php echo "Modality #$i"; ?></label>
                      <input type="hidden" name="count_add" value="<?= $count_add; ?>">
                      <select class="form-control" id="exampleFormControlSelect1" name="pk_mod1[]">
                        <option disabled selected>---Pilih Modality---</option>
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
                      <label for="harga_penawaran"><?php echo "Harga Penawaran #$i" ?></label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Rp</span>
                        </div>

                        <input type="text" class="form-control" name="harga_penawaran1[]" placeholder="cth: 1000" required>

                      </div>
                    </div>

                    <div class="form-group">
                      <label for="qty"><?php echo "Qty Penawaran #$i" ?></label>
                      <div class="input-group mb-3">

                        <input type="text" class="form-control" id="qty" name="qty1[]" placeholder="Qty penawaran.." pattern="[0-9]+" required>

                        <div class="input-group-append">
                          <span class="input-group-text">/pcs</span>
                        </div>

                      </div>
                      <br>
                      <hr>
                      <br><br>
                    </div>
                  </div>
                <?php } ?>
                <!-- --------------------------------1----------------- -->



                <div class="form-group">
                  <!-- <label for="tanggal">Tanggal Penawaran</label> -->
                  <input type="hidden" class="form-control" id="date" name="tgl_penawaran" placeholder="tanggal penawaran..">
                </div>


                <div class="md-form mt-3">
                  <input type="hidden" class="form-control" name="username" value="<?= $username; ?>">
                </div>


                <button type="submit" name="submit" class="btn btn-primary">SIMPAN</button>

              </form>
            </div>
          </div>

          <?php include('footer.php'); ?>



        </div>


        <!-- end of container footer -->

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
    header("location:generate.php");
  } ?>

<?php } else {
  header("location:../index.php");
} ?>