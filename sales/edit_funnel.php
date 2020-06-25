<?php
require '../functionsales.php';

session_start();
$no_penawaran = $_GET['no_penawaran'];
$username = $_SESSION['username'];



$result = mysqli_query($conn, "SELECT * FROM sales_funnel
INNER JOIN sales_order ON sales_funnel.penawaran_fk = sales_order.fk_penawaran
INNER JOIN sales_penawaran ON sales_funnel.penawaran_fk = sales_penawaran.pk_penawaran
 WHERE no_penawaran = '$no_penawaran' ");



if (isset($_POST['submit'])) {
    if (funnel($_POST) > 0) {
        echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'view_funnel.php';
			  </script>";
    } else {
        echo "<script>alert('data berhasil dimasukkan');
			  document.location.href= 'view_funnel.php';
			  </script>";
    }
}

if (isset($_POST['cancel'])) {
    if (cancel($_POST) > 0) {
        echo "<script>alert('data berhasil di cancel, Tetap Semangat');
			  document.location.href= 'view_funnel.php';
			  </script>";
    } else {
        echo "<script>alert('data gagal dimasukkan');
			  document.location.href= 'edit_funnel.php?no_penawaran=$no_penawaran';
			  </script>";
    }
}

if ($_SESSION['level'] == "sales") {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Edit Funnel</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?>
        <div class="container-footer">
            <!-- buat footer -->
            <div class="bc-icons-2">
                <?php include('breadcrumb.php'); ?>
                <li class="breadcrumb-item"><a href="index.php">Home</a><i class="fas fa-angle-right mx-2" aria-hidden="true"></i></li>
                <li class="breadcrumb-item active">Funnel</li>
                </ol>
                </nav>
            </div>

            <div class="container-fluid content1">
                <!-- class content buat footer -->
                <div class="row justify-content-md-center" style="margin: 0px;">

                    <div class="form-harian col-md-7">
                        <center>
                            <h1>Edit Funnel</h1>
                        </center><br>
                        <form action="" method="POST" enctype="multipart/form-data">

                            <?php $row = mysqli_fetch_assoc($result); ?>


                            <div class="form-group">


                                <input type="hidden" class="form-control" id="pk" name="pk" value="<?php echo $row['pk']; ?>">
                                <input type="hidden" class="form-control" id="pk" name="no_penawaran" value="<?php echo $no_penawaran; ?>">
                            </div>

                            <div class=" form-group">
                                <label>
                                    <input type="checkbox" name="buy1" <?php if ($row['buy1'] == '30%') echo 'checked'; ?> value="30%"> Sudah Ada Penawaran Harga
                                </label><br>
                                <label>
                                    <input type="checkbox" id="mycheckbox" name="buy2" <?php if ($row['buy2'] == '50%') echo 'checked'; ?> value="50%"> Presentasi dan demo produk
                                </label><br>
                                <!-- <div class="form-group" id="mycheckboxdiv" style="display:none">

                                    <label for="date_presentasi">Date</label>
                                    <input type="text" class="form-control" id="date" name="date_presentasi" value="<?= $row['now_presentasi']; ?>" size="4" <?php if ($row['buy3'] == '70%') echo  'disabled';  ?>>

                                    <input type="text" class="form-control" id="mod_presentasi" name="mod_presentasi" placeholder="untuk mempresentasikan.." <?php if ($row['buy3'] == '70%') echo  'disabled';  ?>>
                                </div> -->

                                <label>
                                    <input type="checkbox" name="buy3" <?php if ($row['buy3'] == '70%') echo 'checked' ?> value="70%"> User cocok dengan spesifikasi barang
                                </label><br>
                                <label>
                                    <input type="checkbox" name="buy4" <?php if ($row['buy4'] == '85%') echo 'checked' ?> value="85%"> Sudah ada negosiasi harga dengan user/pengadaan
                                </label><br>
                                <label>
                                    <input type="checkbox" name="buy5" <?php if ($row['buy5'] == '90%') echo 'checked' ?> value="90%"> Anggaran sudah ada dan cocok
                                </label><br>


                                <input type="hidden" name="tgl_upload">
                                <input type="hidden" name="now30">
                                <input type="hidden" name="now50">
                                <input type="hidden" name="now70">
                                <input type="hidden" name="now85">
                                <input type="hidden" name="now90">
                                <br>
                            </div>
                            <div class="form-group">

                                <label class="radio-admin">
                                    <input type="radio" name="status" <?php if ($row['status_funnel'] == 'Cold') echo 'checked' ?> value="Cold">
                                    Cold
                                    <span class="checkmark"></span>
                                </label><br>

                                <label class="radio-admin">
                                    <input type="radio" name="status" <?php if ($row['status_funnel'] == 'On Progress') echo 'checked' ?> value="On Progress">
                                    On Progress
                                    <span class="checkmark"></span>
                                </label><br>

                                <label class="radio-admin">
                                    <input type="radio" name="status" <?php if ($row['status_funnel'] == 'Hold') echo 'checked' ?> value="Hold">
                                    Hold
                                    <span class="checkmark"></span>
                                </label><br>



                            </div>

                            <div class="form-group">
                                <a href="#" data-toggle="modal" data-target="#basicExampleDetail">
                                    Lihat detail disini
                                </a>

                                <!-- Modal -->



                                <?php $pk_penawaran = $row['penawaran_fk']; ?>
                                <?php $result323 = mysqli_query($conn, "SELECT * FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>
                                <?php while ($row323 = mysqli_fetch_assoc($result323)) : ?>

                                    <!-- modal detail -->

                                <?php endwhile; ?>
                            </div>


                            <input type="checkbox" id="mycheckbox1" name="buy6" <?php if ($row['buy_funnel'] == '100%') echo 'checked'  ?> value="100%"> Sudah ada
                            PO

                            <div class="form-group" id="mycheckboxdiv1" style="display:none">
                                <input type="file" name="gambar"><br>
                                <label for="harga_po">Harga PO</label>
                                <input type="text" class="form-control" name="harga_po" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                <a href="edit_cust.php?pk_cust=<?= $row['cust_fk']; ?>" target="_blank">Tambah NPWP Customer</a>
                                <br>
                                <!-- <div class=" form-group">
                                    <label for="exampleFormControlSelect1">Estimasi Pengiriman</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="estimasi"> Hari
                                        <option>---Estimasi---</option>
                                        <option value="1">1 Hari</option>
                                        <option value="2">2 Hari</option>
                                        <option value="3">3 Hari</option>
                                        <option value="4">4 Hari</option>
                                        <option value="5">5 Hari</option>
                                        <option value="6">6 Hari</option>
                                        <option value="7">7 Hari</option>
                                        <option value="8">8 Hari</option>
                                        <option value="9">9 Hari</option>
                                        <option value="10">10 Hari</option>
                                        <option value="11">11 Hari</option>
                                        <option value="12">12 Hari</option>
                                        <option value="13">13 Hari</option>
                                        <option value="14">14 Hari</option>
                                        <option value="15">15 Hari</option>
                                        <option value="16">16 Hari</option>
                                        <option value="17">17 Hari</option>
                                        <option value="18">18 Hari</option>
                                        <option value="19">19 Hari</option>
                                        <option value="20">20 Hari</option>
                                        <option value="21">21 Hari</option>
                                        <option value="22">22 Hari</option>
                                    </select>
                                </div> -->
                                <!-- <a href="estimasikirim.php?no_penawaran=<?= $row['no_penawaran']; ?>" target="_blank">Masukan Estimasi Pengiriman</a> -->

                            </div>



                            <div class="form-group">
                                <label for="status1">Status</label>
                                <input type="text" class="form-control" name="status1" value="<?= $row['status2_funnel']; ?>">

                            </div>




                            <div class="ui buttons">
                                <button class="ui red button" type="submit" name="cancel" onclick="return confirm('Note: Jika di CANCEL data tidak dapat di edit lagi')">Cancel</button>
                                <div class="or"></div>
                                <button class="ui teal button" type="submit" name="submit" onclick="return confirm('Apakah anda yakin?')">Save</button>
                            </div>
                            <a href=" view_funnel.php"><button class="ui orange right floated button">View funnel</button></a>  
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="basicExampleDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Funnel</h5>
                            <center>
                                <center> <?= $row['no_penawaran']; ?></center><br><br>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">

                            <?php $pk_order = $row323['pk_order']; ?>
                            <?php $resultdetail = mysqli_query($conn, "SELECT * FROM sales_order INNER JOIN sales_modality ON sales_order.pk_mod_order = sales_modality.pk_mod WHERE fk_penawaran = '$pk_penawaran' "); ?>
                            <?php $j = 1; ?>

                            <?php while ($rowdetail = mysqli_fetch_assoc($resultdetail)) : ?>
                                <strong>

                                    <?php echo "-----Modality #" ?> <?php echo  $j++; ?>------</strong><br>

                                <div class="detail-table">
                                    <table>
                                        <tr>

                                            <td>Nama Modality</td>
                                            <td>:</td>
                                            <td> <?= $rowdetail['nama_mod_order'];  ?></td>
                                        </tr>

                                        <tr>
                                            <td>Type Modality</td>
                                            <td>:</td>
                                            <td> <?= $rowdetail['model_mod_order'];  ?></td>

                                        </tr>
                                        <tr>
                                            <td>Merk Modality</td>
                                            <td>:</td>
                                            <td> <?= $rowdetail['merk_mod_order'];  ?></td>
                                        </tr>

                                        <tr>
                                            <td>Spek Modality</td>
                                            <td>:</td>
                                            <td> <?= $rowdetail['spek_mod_order'];  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Modality Modality</td>
                                            <td>:</td>
                                            <td> <?= rupiah($rowdetail['harga_mod']);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Penawaran/pcs</td>
                                            <td>:</td>
                                            <td> <?= rupiah($rowdetail['harga_order']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Qty</td>
                                            <td>:</td>
                                            <td> <?= $rowdetail['qty_order'];  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Harga Modality</td>
                                            <td>:</td>
                                            <td>
                                                <?= rupiah($rowdetail['total_order']);  ?>
                                            </td>



                                        </tr>
                                    </table><br><br>
                                </div>
                            <?php endwhile; ?>
                            <?php
                            $resultharga = mysqli_query($conn, "SELECT SUM(total_order) AS totalharga FROM sales_order WHERE fk_penawaran = '$pk_penawaran' "); ?>

                            <?php while ($row332 = mysqli_fetch_assoc($resultharga)) : ?>
                                <td>Perkiraan Harga Pre-Order</td>
                                <td>:</td>
                                <td>
                                    <h3><?= rupiah($row332['totalharga']); ?></h3>
                                </td>
                            <?php endwhile; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <!-- <h1 class="modal-title">Modal Heading</h1> -->
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <h3>Keterangan</h3>
                            <p><?php echo $row['pk']; ?></p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <?php include('footer.php'); ?>



        </div><!-- end of container footer -->

        <?php include('script-footer.php'); ?>
        <script>
            $(document).ready(function() {
                $('#mycheckbox').change(function() {
                    $('#mycheckboxdiv').toggle('slow');
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#mycheckbox1').change(function() {
                    $('#mycheckboxdiv1').toggle('slow');
                });
            });
        </script>
        <script>
            $('#date').datetimepicker({
                format: 'd-m-Y'
            });
        </script>

        <script>
            $('.div_entrega_outro').hide();
            $("input[id$='entrega_outro']").click(function() {
                $('.div_entrega_outro').show();
            });

            $("input[id$='entrega_mesmo']").click(function() {
                $('.div_entrega_outro').hide();
            });
        </script>
    </body>

    </html>

<?php } else {
    header("location:../index.php");
} ?>