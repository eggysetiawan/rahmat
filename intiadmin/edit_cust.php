<?php
session_start();
require '../functionsales.php';
$username = $_SESSION['username'];
$id = $_GET['pk_cust'];


$cust = query("SELECT * FROM sales_customer WHERE pk_cust = $id")[0];

if (isset($_POST['submit'])) {
    if (editcustspvsales($_POST) > 0) {
        echo "<script>alert('data berhasil edit');
			  document.location.href= 'view_cust.php';
			  </script>";
    } else {
        echo "<script>alert('data gagal edit');
			  document.location.href= 'edit_cust.php?pk_cust=$id';
			  </script>";
    }
}
if ($_SESSION['level'] == "intiadmin") {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Kunjungan Harian</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?>
        <div class="container-footer">
            <!-- buat footer -->
            <div class="bc-icons-2">
                <?php include('breadcrumb.php'); ?>
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                <li class="breadcrumb-item active">Edit data customer</li>
                </ol>
                </nav>
            </div>

            <div class="container-fluid content1">
                <!-- class content buat footer -->
                <div class="justify-content-md-center">
                    <div class="form-harian">
                        <center>
                            <h1>Edit Data Customer</h1>
                        </center><br>
                        <form action="" method="POST">

                            <input type="hidden" name="pk_cust" value="<?= $cust['pk_cust']; ?>">

                           <!--  <div class="form-group">

                                <input type="hidden" class="form-control" id="username" name="username" value="<?= $username; ?>">
                            </div> -->

                            <div class="form-group">
                                <label for="nama">Full Name Customer</label>
                                <input type="text" class="form-control" id="nama_cust" name="nama_cust" placeholder="Nama.." value="<?= $cust['nama_cust']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="hp">Mobile/HP</label>
                                <input type="text" class="form-control" id="hp" name="hp_cust" placeholder="Nomor HP.." value="<?= $cust['hp_cust']; ?>">
                            </div>
                            <div class=" form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email_cust" placeholder="Email.." value="<?= $cust['email_cust']; ?>">
                            </div>
                            <div class=" form-group">
                                <label for="jabatan">Posisi/Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan_cust" placeholder="Posisi/Jabatan.." value="<?= $cust['jabatan_cust']; ?>">
                            </div>
                            <div class=" form-group">
                                <label for="nama_rs">Company/Hospital/Perusahaan</label>
                                <input type="text" class="form-control" id="nama_rs" name="rs_cust" placeholder="Perusahaan/Rumah Sakit.." value="<?= $cust['rs_cust']; ?>">
                            </div>
                            <div class=" form-group">
                                <label for="nama_rs">Kode Rumah Sakit</label>
                                <input type="text" class="form-control" id="nama_rs" name="koders_cust" placeholder="Perusahaan/Rumah Sakit.." value="<?= $cust['koders_cust']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Address/Alamat</label>
                                <input type="text" class="form-control" id="inputAddress" name="alamat_cust" placeholder="Alamat.." value="<?= $cust['alamat_cust']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputNpwp">Tambahkan NPWP</label>
                                <input type="text" class="form-control" id="inputNpwp" name="npwp_cust" required autofocus placeholder="NPWP.." value="<?= $cust['npwp_cust']; ?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="telp">Telp/.Fax</label>
                                    <input type="text" class="form-control" id="telp" name="tlp_cust" placeholder="Telp/.fax.." value="<?= $cust['tlp_cust']; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCity">City</label>
                                    <input type="text" class="form-control" name="kota_cust" id="inputCity" value="<?= $cust['kota_cust']; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">State</label>
                                    <select id="inputState" class="form-control" name="negara_cust">
                                        <option>Choose...</option>
                                        <option value="indonesia">Indonesia</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <!-- <label for="inputZip">Zip</label> -->
                                    <input type="hidden" class="form-control" id="inputZip" name="pos_cust" value="<?= $cust['pos_cust']; ?>">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
                        </form>
                    </div>


                </div>
            </div>

            <?php include('footer.php'); ?>



        </div><!-- end of container footer -->


        <?php include('script-footer.php'); ?>
    </body>

    </html>

<?php } else {
    header("location:../index.php");
} ?>